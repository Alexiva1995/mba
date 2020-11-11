<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt; 
use DB; 
use Auth; 
use Hash;
use Carbon\Carbon; 
// modelo
use App\Models\User; 
use App\Models\Paises; 
use App\Models\Pop;

class LoginController extends Controller
{
    
    /*login del sistema*/
    public function login(Request $request){

        $status = $request->all();
        //return $status; 
        $paises = Paises::all();
        return view('login.login', compact('paises', 'status'));
    }


    public function autenticacion(Request $datos){
      
      if (Auth::attempt(['ID' => $datos->ID, 'password' => $datos->password])) {

           $autenticado = User::find(Auth::user()->ID);
           $autenticado->pop_up = 1;
           $autenticado->save();

         if(Auth::user()->rol_id == 0 || Auth::user()->rol_id == 1){
           return redirect('/admin');
         }else{
          return redirect('/');
         }
           
        }else{
            
         return redirect()->back()->with('msj3', 'Las Credenciales no coinciden con nuestros registros');
        }
    }


     /*login del carrito de compras*/
    public function autshoping(Request $datos){

        if (Auth::attempt(['ID' => $datos->ID, 'password' => $datos->password])) {
         
          return redirect()->back();
           
        }else{
            
         return redirect()->back()->with('msj3', 'Las Credenciales no coinciden con nuestros registros');
        }
    }
    
}