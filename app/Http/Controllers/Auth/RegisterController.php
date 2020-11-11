<?php

namespace App\Http\Controllers\Auth;

// llamado a las funciones de laravel
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Crypt;
use Mail; 
use DB; 
use Auth; 
use Carbon\Carbon;
// llamado a los modelos
use App\Models\User; 
use App\Models\Paises; 
use App\Models\Settings; 
use App\Models\Formulario; 
use App\Models\Notification;
use App\Models\SettingCorreo;
use App\Models\OpcionesSelect;
use App\Models\SettingsEstructura; 
// Llamado a los controladores
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\InstallController;
use Modules\ReferralTree\Http\Controllers\ReferralTreeController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
            view()->share('title', 'Nuevo Registro');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function creater(Request $data)
    {
        // Veririca si un usuario solo se guardo en la tabla principal y lo borra para el registro
        $verificarUser = User::where('user_email', $data['user_email'])->get()->toArray();
        if (!empty($verificarUser)) {
            $verificarUser2 = DB::table('user_campo')->where('ID', $verificarUser[0]['ID'])->get()->toArray();
            if (empty($verificarUser2)) {
                $borrar = User::find($verificarUser[0]['ID']);
                $borrar->delete();
            }
        }

        // Permite validar los campos dinamicos
        //dependiendo si es data->tip == 0 son todos los campos requeridos en ambos formularios
        // data->tip == 1 son todos los campos del formulario interno
        // data->tip == 2 son todos los campos del formulario externo
        $settings = Settings::first();
        
        if($data->validar  == null){
        $campos = Formulario::where('estado', 1)->get();
         foreach($campos as $campo){
             if($campo->unico == 1 && $campo->tip == 0){
                $validatedData = $data->validate([
                    $campo->nameinput => 'unique:user_campo',
                ]);   
             }elseif($campo->unico == 1 && $campo->tip == $data->tip){
                 $validatedData = $data->validate([
                    $campo->nameinput => 'unique:user_campo',
                ]);
             }
          }
        }
        
        if($data->validar  == 'oculto'){
         // Permite validar los campos estaticos que estan en el nuevo login
        $validatedData = $data->validate([
            'user_email' => 'required|string|email|max:100|unique:'.$settings->prefijo_wp.'users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required'
        ]);
        }else{
           // Permite validar los campos estaticos
        $validatedData = $data->validate([
            'user_email' => 'required|string|email|max:100|unique:'.$settings->prefijo_wp.'users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required'
        ]);  
        }

        $funciones = new IndexController;
        $orden = $this->OrdenarSistema($data);
        
        if($orden['error'] != null){
            $funciones->msjSistema($orden['error'], 'warning');
            return redirect()->back()->withInput();
        }
        
        
    if($data['rango'] == null){
        $rol_id = ($data['tipouser'] == 'Cliente') ? 100 : 3;
    }else{
        $rol_id = $data['rango'];
    }

        $user = User::create([
            'user_email' => $data['user_email'],
            'user_status' => '0',
            'user_login' => $data['nameuser'],
            'user_nicename' => $data['nameuser'],
            'display_name' => ($data['firstname'] == null) ? $data['nameuser'] : $data['firstname'].' '.$data['lastname'],
            'gender' => $data['genero'],
            'birthdate' => $data['edad'],
            'user_registered' => Carbon::now(),
            'user_pass' => md5($data['password']),
            'password' => bcrypt($data['password']),
            'clave' => encrypt($data['password']),
            'rol_id' => $rol_id,
            'referred_id' => $orden['referido'],
            'ladomatriz' => $data['ladomatriz'], // esto es para lo binario
            'sponsor_id' => $orden['posicion'],
            'position_id' => $orden['posicion'],
            'tipouser' => $data['tipouser'],
            'status' => '0',
            'correos' =>'{"pago":"1","compra":"1","pc":"1","liquidacion":"1"}',
            'avatar' => ($rol_id != 2) ? 'avatar.png' : $this->avatarMentor($data),
            'profession' => $data['profession'],
            'about' => $data['contenido'],
            'pop_up' => '1',
        ]);

        $this->insertarCampoUser($user->ID, $data);

        // inserta en usermeta
        $this->insertUserMeta($user, $data);     
       
        // enviar correo de bienvenida
        $consulta = $this->EnvioCorreo($data, $orden['referido'], $user);
        
        if($consulta['error'] != null){
            $funciones->msjSistema($consulta['error'], 'warning');
            return redirect()->back()->withInput();
        }
        
        
        if($data['rango'] == 1){

           //registrar permisos Moderador
           $permiso=new PermisosController;
           $permiso->PermisosAdmin($user->ID);

            $funciones->msjSistema('Para Terminar el registro debe asignar al usuario '.$user->display_name.' que opciones del menu tendra acceso ', 'success');
            return redirect('/admin/usuarios/administrador?tip=1');

        }elseif($data['rango'] == 0){
        //registrar permisos Admin
        $permiso=new PermisosController;
        $permiso->PermisosAdmin($user->ID);
        }
        
        if($data['shoping'] != null){
            
         Auth::loginUsingId($user->ID);     
         return redirect()->back()->with('msj-exitoso', 'Su Registro ha sido exitoso su ID es: '.$user->ID);  

        }elseif (Auth::guest()){

        Auth::loginUsingId($user->ID);   
        return redirect('/')->with('msj-exitoso', 'Su Registro ha sido exitoso su ID es: '.$user->ID);

        }else{

         $funciones->msjSistema('Su Registro ha sido exitoso el ID es: '.$user->ID, 'success');
         return redirect()->back();  

        }
    }


    public function avatarMentor($datos){
      
      $nombre_imagen='avatar.png';
      if ($datos->file('avatar')) {
            $imagen = $datos->file('avatar');
            $nombre_imagen = 'user'.'_'.time().'.'.$imagen->getClientOriginalExtension();
            $path = public_path() .'/uploads/avatar';
            //unlink($path.'/'.$user->avatar);
            $imagen->move($path, $nombre_imagen);
        }
       return $nombre_imagen;
    }

    /**
     * Guarda la informacion de los usuario 
     * 
     * Permite Guardar la informacion de lo usuario de los campos nuevos creados
     * 
     * @access private
     * @param int $userid - id usuarios, array $data - informacion del usuario
     */
    public function insertarCampoUser($userid, $data)
    {
        $formulario = Formulario::where('estado', 1)->get();
        $arraytpm [] = ['ID' => $userid];
        $arrayuser = [];
        foreach ($formulario as $campo) {
            $arraytpm [] = [
                ''.$campo->nameinput.'' => $data[$campo->nameinput]
            ];
        }
        
        $arrayuser = $arraytpm[0];
        for ($i= 1 ; $i < count($arraytpm); $i++) { 
            $arrayuser = array_merge($arrayuser,$arraytpm[$i]);
        }
        DB::table('user_campo')->insert($arrayuser);

        DB::table('user_campo')
           ->where('ID', '=', $userid)
           ->update([
            'pais' => $data['pais'], 
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            ]);
    }
    /**
     * crea el nuevo formulario con los campos dinamicos
     * 
     * @access public
     * @return {view}
     */
    public function newRegister()
    {   
        $paises = Paises::all();
        $settings = Settings::first();
        $estructura='';
        $settingEstructura = SettingsEstructura::find(1);
        if(!empty($settingEstructura)){
        $estructura = $settingEstructura->tipoestructura;
        }
        $patrocinadores = User::all();
        $campos = Formulario::where('estado', 1)->get();
        $valoresSelect = [];
        foreach ($campos as $campo) {
            array_push($valoresSelect, OpcionesSelect::find($campo['id']));
        }
        if (!empty(Auth::user()->ID)){
            return view('auth.register')->with(compact('campos', 'valoresSelect', 'settings', 'patrocinadores','paises'));
        }else{
            return view('auth.register2')->with(compact('campos', 'valoresSelect', 'settings', 'patrocinadores','estructura','paises'));
        }
      
    }
    
    
    /**
     * Enviar el correo de bienvenida
     * 
     * @access private
     * @param array $data informacion de los usuarios
     */
    public function EnvioCorreo($data, $referido, $user){
     
     $error = null;
     $seting = Settings::find(1);
        $firma = null;
       if (!empty($seting->firma)) {
           $firma = $seting->firma;
       }
       
        $nombrecompleto = $data['firstname'].' '.$data['lastname'];
        $plantilla = SettingCorreo::find(1);
        if (!empty($plantilla->contenido)) {
            $mensaje = str_replace('@nombre', ' '.$nombrecompleto.' ', $plantilla->contenido);
            $mensaje = str_replace('@clave', ' '.$data['password'].' ', $mensaje);
            $mensaje = str_replace('@correo', ' '.$data['user_email'].' ', $mensaje);
            $mensaje = str_replace('@usuario', ' '.$data['nameuser'].' ', $mensaje);
            $mensaje = str_replace('@idpatrocinio', ' '.$referido.' ', $mensaje);
            $mensaje = str_replace('@Nafiliacion', ' '.$user->ID.' ', $mensaje);
            if (strcasecmp(env('MAIL_HOST'), 'smtp.localhost.com') !== 0) {
                Mail::send('emails.plantilla',  ['data' => $mensaje, 'firma' => $firma], function($msj) use ($plantilla, $data){
                    $msj->subject($plantilla->titulo);
                    $msj->to($data['user_email']);
                });
            }
        }else{
            $deleteuser = User::find($user->ID);
            DB::table('user_campo')->where('ID', $user->ID)->delete();
            $deleteuser->delete();
            $error = 'El Registro no es valido, porque la configuración de correo no esta completa, comuniquese con el administrador';
            
        }
        
        $required = [
            'error' => $error,
                ];
        
        return $required;
    }

    /**
     * Guarda la informacion de los usuario en la tabla de wordpress
     * 
     * @access private
     * @param array $data informacion de los usuarios
     */
    public function insertUserMeta($user, $data)
    {
        $settings = Settings::first();
        $verificar = DB::table($settings->prefijo_wp.'usermeta')->where('user_id', $user->ID)->first();
        if (!empty($verificar)) {
            DB::table($settings->prefijo_wp.'usermeta')->where('user_id', $user->ID)->delete();
        }
        DB::table($settings->prefijo_wp.'usermeta')->insert([
            ['user_id' => $user->ID, 'meta_key' => 'nickname', 'meta_value' => $user->user_email],
            ['user_id' => $user->ID, 'meta_key' => 'first_name', 'meta_value' => $data['firstname']],
            ['user_id' => $user->ID, 'meta_key' => 'last_name', 'meta_value' => $data['lastname']],
            ['user_id' => $user->ID, 'meta_key' => $settings->prefijo_wp.'capabilities', 'meta_value' => 'a:1:{s:10:"subscriber";b:1;}'],
            ['user_id' => $user->ID, 'meta_key' => 'billing_first_name', 'meta_value' => $data['firstname']],
            ['user_id' => $user->ID, 'meta_key' => 'billing_last_name', 'meta_value' => $data['lastname']],
            ['user_id' => $user->ID, 'meta_key' => 'billing_email', 'meta_value' => $user->user_email],
            ['user_id' => $user->ID, 'meta_key' => 'billing_phone', 'meta_value' => $data['phone']],
        ]);
    }
    /**
     * Permite Verificar si los usuarios o id suministrado existen
     *
     * @param int $id
     * @return bolean
     */
    public function VerificarUser($id)
    {
        $resul = true;
        $user = User::where('ID', $id)->get()->toArray();
        if (!empty($user)) {
            $resul = false;
        }
        return $resul;
    }
    
    
    
    public function OrdenarSistema($data){
        
        $requisitos = [];
        
        // Obtenemos las configuraciones por defecto
        $settings = Settings::first();
        $settingEstructura = SettingsEstructura::find(1);
        // Usuario referido por defecto.
        // 0: NONE.
        $user_id_default = $settings->referred_id_default;

         // Obtenemos el referido.
        $referido = $user_id_default;
        if($data['referred_id'] == null){
            $data['referred_id'] = $referido;
            if ($this->VerificarUser($data['referred_id'])) {
                
                $requisitos = [
                    'error' => 'El Usuario con el ID Referido Suministrado ('.$data['referred_id'].') No Se Encuentra Registrado, Pruebe Con Otro'
                    ];
                    
                     
                return $requisitos;
            }
            $referido =  $data['referred_id'];
        }else{
            $referido =  $data['referred_id'];
        }
        $posicion = 0;

        
        if ($settingEstructura->tipoestructura != 'binaria') {
            if (empty($data['position_id'])) {
            
                if ($settingEstructura->tipoestructura != 'arbol') {
                    $consulta=new ReferralTreeController;
                    $auspiciador = $consulta->getPosition($referido, '', $data['tipouser']);
                    $posicion = $auspiciador;
                }else{
                    $posicion = $referido;
                }
                
            } else {
                if ($this->VerificarUser($data['position_id'])) {
                    
                    $requisitos = [
                    'error' => 'El Usuario con el ID Posicionamiento Suministrado ('.$data['position_id'].') No Se Encuentra Registrado, Pruebe Con Otro'
                    ];
                    
                   return $requisitos;
                
                }
                if ($settingEstructura->tipoestructura != 'arbol') {
                    $consulta=new ReferralTreeController;
                    $auspiciador = $consulta->getPosition($data['position_id'], '', $data['tipouser']);
                    if ($auspiciador != $data['position_id']) {
                        
                        $requisitos = [
                    'error' => 'El ID Posicionamiento Suministrado ('.$data['position_id'].') Tiene Sus Lugares LLeno, le Recomendamos este ID Posicionamiento ('.$auspiciador.')'
                    ];
                    
                   return $requisitos;
                   
                    }
                }
                $posicion = $data['position_id'];
            }
        }else{
            $validatedData = $data->validate([
                'ladomatriz' => 'required'
            ]);
            // if ($data['ladomatriz'] == 'I') {
                $consulta=new ReferralTreeController;
                $auspiciador = $consulta->getPosition($referido, $data['ladomatriz'], $data['tipouser']);
                $posicion = $auspiciador;
            // }else{
            //     $consulta=new ReferralTreeController;
            //     $auspiciador = $consulta->getPosition($referido, $data['ladomatriz'], $data['tipouser']);
            //     $posicion = $auspiciador;
            // }
        }
        
        $requisitos = [
            'posicion' => $posicion,
            'referido' => $referido,
            'error' => null,
            ];
            
        return $requisitos;
    }
   
}