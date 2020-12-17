<?php

namespace App\Http\Controllers;

use App\Models\CourseOrden;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\ShoppingCart;
use App\Models\Course;
use App\Models\Category;
use App\Models\Addresip;
use App\Models\OffersLive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

use App\Http\Controllers\WalletController;

class CoursesOrdenController extends Controller
{
    
    public $secret_key = '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';

    /**
     * Permite procesar las compras por los diferentes medios de pagos
     *
     * @param Request $request
     * @return void
     */
    public function procesarCompra(Request $request){
        try {
            $iduser = Auth::user()->ID;
            $detalles = $this->getDataillOrden($iduser);
            
            $data = [
                'user_id' => $iduser,
                'total' => $detalles['total'],
                'detalles' => $detalles['detalles'],
                'type_product' => 'membresia'
            ];
            $idorden = $this->saveCourseOrden($data);
            if ($request->metodo == 'stripe') {
                $dataStripe = [
                    'email' => $request->stripeEmail,
                    'token' => $request->stripeToken,
                    'precio' => ($detalles['total'] * 100),
                    'idorden' => $idorden
                ];
                $this->stripe($dataStripe);
                
                return redirect('courses')->with('msj-exitoso', 'Su compra ha sido procesada con éxito.');
            }elseif($request->metodo == 'cripto'){
                $dataCripto = [
                    'total' => $detalles['total'],
                    'idorden' => $idorden,
                    'email' => Auth::user()->user_email,
                    'productos' => $detalles['detalles']
                ];
                $ruta = $this->coinpayment($dataCripto);
                return redirect($ruta);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite guardar la informacion de la orden
     *
     * @param array $data
     * @return integer
     */
    public function saveCourseOrden($data): int
    {
        $orden = CourseOrden::create($data);
        return $orden->id;
    }

    /**
     * Permite procesar las compras con stripe
     *
     * @param array $data
     * @return void
     */
    public function stripe($data){
        try {
            $secret_key = $this->secret_key;
            Stripe::setApiKey($secret_key);

            $customer = Customer::create(array(
                'email' => $data['email'],
                'source'  => $data['token']
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $data['precio'],
                'currency' => 'usd'
            ));

            CourseOrden::where('id', $data['idorden'])->update([
                'idtransacion_stripe' => $data['token'],
                'status' => 1
            ]);

            $carrito = new ShoppingCartController();
            $carrito->process_membership_buy($data['idorden']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    /**
     * Permite procesar el pago por medio de coinpayment
     *
     * @param array $data
     * @return string
     */
    public function coinpayment($data) : string{
        try {
            $transacion = [
                'amountTotal' => $data['total'],
                'note' => 'Compra curso por '.number_format($data['total'], 2, ',', '.').' USD',
                'idorden' => $data['idorden'],
                'buyer_email' => $data['email'],
                'redirect_url' => route('courses')
            ];
            
            $productos = json_decode($data['productos']);
           // dd($productos);
            
            
            $transacion['items'][] = [
                'itemDescription' => $productos[0]->nombre,
                'itemPrice' => $productos[0]->precio, // USD
                'itemQty' => (INT) 1,
                'itemSubtotalAmount' => $productos[0]->precio // USD
            ];
            

            $ruta = \CoinPayment::generatelink($transacion);
            return $ruta;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite obtener los detalles de la compras
     *
     * @param integer $iduser
     * @return array
     */
    public function getDataillOrden($iduser): array{
        $item = ShoppingCart::where('user_id', '=', $iduser)
                    ->orderBy('id', 'DESC')
                    ->first();
        
        $totalItems = 0;
        
        if (!is_null($item->membership_id)){
            $membresia = DB::table('memberships')->where('id', $item->membership_id)->first();
            if ($item->period == 'Mensual'){
                $total = $membresia->descuento;
            }else{
                $total = $membresia->discount_annual;
            }

            $arrayCursos = [
                'idmembresia' => $membresia->id,
                'nombre' => $membresia->name,
                'precio' => $total,
                'tipo' => $item->period,
                'img' => 'no disponible',
                'links' => 0,
            ];
        }else if (!is_null($item->offer_id)){
            $oferta = DB::table('offers_live')->where('id', $item->offer_id)->first();
            $total = $oferta->price;

            $arrayCursos = [
                'idmembresia' => $oferta->id,
                'nombre' => $oferta->title,
                'precio' => $total,
                //'tipo' => $item->period,
                'img' => 'no disponible',
                'links' => 0,
            ];
        }
            
        $totalItems += $total;

        $data = [
            'total' => $totalItems,
            'detalles' => json_encode($arrayCursos)
        ];
        return $data;
    }

    public function getDataMembeship($iduser)
    {
        $items = ShoppingCart::where('user_id', '=', $iduser)->first();
        return $items->membership_id;
    }

    public function pay_membership_stripe(Request $request){
        try {
            $secret_key = $this->secret_key;
            Stripe::setApiKey($secret_key);

            //$idmembresia = $this->getDataMembeship(Auth::user()->ID);
            $item = ShoppingCart::where('user_id', '=', Auth::user()->ID)
                            ->orderBy('id', 'DESC')
                            ->first();
            
            //$enlace = Addresip::where('ip', request()->ip())->first();
            
            if (!is_null($item->membership_id)){
                $membresia = DB::table('memberships')->where('id', $item->membership_id)->first();

                $monto = ((($item->period == 'Mensual') ? $membresia->descuento : $membresia->discount_annual) * 100);
            }else if (!is_null($item->offer_id)){
                $oferta = DB::table('offers_live')->where('id', $item->offer_id)->first();

                $monto = $oferta->price*100;
            }

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source'  => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $monto,
                'currency' => 'usd'
            ));

            $datosMembresia = [
                'idmembresia' => (!is_null($item->membership_id)) ? $item->membership_id : $item->offer_id,
                'nombre' => (!is_null($item->membership_id)) ? $membresia->name : $oferta->title,
                'precio' => $monto/100,
                'tipo' => (!is_null($item->membership_id)) ? $item->period : '',
                'img' => (!is_null($item->membership_id)) ? asset('uploads/images/memberships/'.$membresia->image) : asset('uploads/images/offers/'.$oferta->resource_url),
                'links' => Auth::user()->sponsor_id,
            ];
            
            $orden = new CourseOrden();
            $orden->user_id = Auth::user()->ID;
            $orden->total = $monto/100;
            $orden->detalles = json_encode($datosMembresia);
            $orden->idtransacion_stripe = $request->stripeToken;
            $orden->status = 1;
            $orden->type_product = (!is_null($item->membership_id)) ? 'membresia' : 'oferta';
            $orden->save();

            $carrito = new ShoppingCartController();
            $carrito->process_membership_buy($orden->id);
                
            /* eliminar la direccion ip y el id de la persona que me dio el link*/
             //Addresip::where('ip', request()->ip())->delete();    

            return redirect('/')->with('msj-exitoso', 'Tu compra de membresría ha sido completada con éxito.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    
    
    //comprar con billetera
    public function buy_wallet(Request $datos){
        
        $item = ShoppingCart::where('user_id', '=', Auth::user()->ID)->orderBy('id', 'DESC')->first();
            
        if (!is_null($item->membership_id)){
            $membresia = DB::table('memberships')->where('id', $item->membership_id)->first();

            $total = ($item->period == 'Mensual') ? $membresia->descuento : $membresia->discount_annual;
        }else if (!is_null($item->offer_id)){
            $oferta = DB::table('offers_live')->where('id', $item->offer_id)->first();

            $total = $oferta->price;
        }
      
        if(Auth::user()->wallet_amount < $total){
            return redirect()->back()->with('msj-error', 'Tu compra no pudo ser procesada ya que no tiene fondos suficientes en su billetera.');
        }
      
        $datosMembresia = [
            'idmembresia' => (!is_null($item->membership_id)) ? $item->membership_id : $item->offer_id,
            'nombre' => (!is_null($item->membership_id)) ? $membresia->name : $oferta->title,
            'precio' => $total,
            'tipo' => (!is_null($item->membership_id)) ? $item->period : '',
            'img' => (!is_null($item->membership_id)) ? asset('uploads/images/memberships/'.$membresia->image) : asset('uploads/images/offers/'.$oferta->resource_url),
            'links' => Auth::user()->sponsor_id,
        ];
            
        $orden = new CourseOrden();
        $orden->user_id = Auth::user()->ID;
        $orden->total = $total;
        $orden->detalles = json_encode($datosMembresia);
        $orden->status = 1;
        $orden->type_product = (!is_null($item->membership_id)) ? 'membresia' : 'oferta';
        $orden->save();
        
        $carrito = new ShoppingCartController();
        $carrito->process_membership_buy($orden->id);
                
        /* eliminar la direccion ip y el id de la persona que me dio el link*/
       // Addresip::where('ip', request()->ip())->delete();
        
        $user = User::find(Auth::user()->ID);
        $user->wallet_amount = ($user->wallet_amount - $datosMembresia['precio']);
        $user->save();
        
        $savewallet = [
            'iduser' => $user->ID,
            'idcomision' => 0,
            'usuario' => $user->display_name,
            'descripcion' => 'Orden '.$orden->id.' Compra con billetera del usuario: '.$user->display_name,
            'descuento' => 0,
            'debito' => 0,
            'credito' => $datosMembresia['precio'],
            'balance' => $user->wallet_amount,
            'tipotransacion' => 1,
        ];
        $wallet = new WalletController;
        $wallet->saveWallet($savewallet);
        
        return redirect('/')->with('msj-exitoso', 'Tu compra de membresía ha sido completada con éxito.');
    }
    
   
    //comprar con paypal
    public function buy_paypal(Request $datos){
        
        $item = ShoppingCart::where('user_id', '=', Auth::user()->ID)->orderBy('id', 'DESC')->first();
        //$enlace = Addresip::where('ip', request()->ip())->first();

        if (!is_null($item->membership_id)){
            $membresia = DB::table('memberships')->where('id', $item->membership_id)->first();

            $total = ($item->period == 'Mensual') ? $membresia->descuento : $membresia->discount_annual;
        }else if (!is_null($item->offer_id)){
            $oferta = DB::table('offers_live')->where('id', $item->offer_id)->first();

            $total = $oferta->price;
        }

        $datosMembresia = [
            'idmembresia' => (!is_null($item->membership_id)) ? $item->membership_id : $item->offer_id,
            'nombre' => (!is_null($item->membership_id)) ? $membresia->name : $oferta->title,
            'precio' => $total,
            'tipo' => (!is_null($item->membership_id)) ? $item->period : '',
            'img' => (!is_null($item->membership_id)) ? asset('uploads/images/memberships/'.$membresia->image) : asset('uploads/images/offers/'.$oferta->resource_url),
            'links' => Auth::user()->sponsor_id,
        ];
        
        $orden = new CourseOrden();
        $orden->user_id = Auth::user()->ID;
        $orden->total = $total;
        $orden->detalles = json_encode($datosMembresia);
        $orden->idtransacion_paypal = Carbon::now()->format('YmdHis');
        $orden->status = 0;
        $orden->type_product = (!is_null($item->membership_id)) ? 'membresia' : 'oferta';
        $orden->save();
        
        // eliminar la direccion ip y el id de la persona que me dio el link
        //Addresip::where('ip', request()->ip())->delete();
        
        return \Redirect::route('pago-pay',['pagina' => $membresia->name, 'total' => $total, 'descripcion' => $membresia->name, 'idcompra' => $orden->id]);
    }
    

    public function pay_membership_coinpayment(Request $request){
        try {

            $item = ShoppingCart::where('user_id', '=', Auth::user()->ID)->orderBy('id', 'DESC')->first();
            
            //$enlace = Addresip::where('ip', request()->ip())->first();
            if (!is_null($item->membership_id)){
                $membresia = DB::table('memberships')->where('id', $item->membership_id)->first();

                $monto = ($item->period == 'Mensual') ? $membresia->descuento : $membresia->discount_annual;
            }else if (!is_null($item->offer_id)){
                $oferta = DB::table('offers_live')->where('id', $item->offer_id)->first();

                $monto = $oferta->price;
            }

            $datosMembresia = [
                'idmembresia' => (!is_null($item->membership_id)) ? $item->membership_id : $item->offer_id,
                'nombre' => (!is_null($item->membership_id)) ? $membresia->name : $oferta->title,
                'precio' => $monto,
                'tipo' => (!is_null($item->membership_id)) ? $item->period : '',
                'img' => (!is_null($item->membership_id)) ? asset('uploads/images/memberships/'.$membresia->image) : asset('uploads/images/offers/'.$oferta->resource_url),
                'links' => Auth::user()->sponsor_id,
            ];
            
            $orden = new CourseOrden();
            $orden->user_id = Auth::user()->ID;
            $orden->total = $monto;
            $orden->detalles = json_encode($datosMembresia);
            $orden->status = 0;
            $orden->type_product = (!is_null($item->membership_id)) ? 'membresia' : 'oferta';
            $orden->save();

            $transacion = [
                'amountTotal' => $monto,
                'note' => 'Compra de '.$orden->type_product.' por '.number_format($monto, 2, ',', '.').' USD',
                'idorden' => $orden->id,
                'buyer_email' => Auth::user()->user_email,
                'redirect_url' => route('courses')
            ];

            $transacion['items'][] = [
                'itemDescription' => (!is_null($item->membership_id)) ? $membresia->name : $oferta->title,
                'itemPrice' => $monto, // USD
                'itemQty' => (INT) 1,
                'itemSubtotalAmount' => $monto // USD
            ];
            
            /* eliminar la direccion ip y el id de la persona que me dio el link*/
            //Addresip::where('ip', request()->ip())->delete();
         
            $ruta = \CoinPayment::generatelink($transacion);
            return redirect($ruta);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
