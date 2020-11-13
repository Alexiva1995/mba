<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use GuzzleHttp\Client;
use App\Models\Category; use App\Models\Subcategory;
use DB; use Auth;

class CategoryController extends Controller{
    
    /**
     * Admin / Cursos / Listado de Categorías
     */
    public function index(){
       // TITLE
        view()->share('title', 'Listado de Categorías');

        $categorias = Category::with('course')
                        ->orderBy('title', 'ASC')
                        ->get();

        return view('admin.courses.categories')->with(compact('categorias'));
    }

    /**
     * Admin / Cursos / Gestionar Categorías / Agregar Categoría
     */
    public function add_category(Request $request){
        $client = new Client(['base_uri' => 'https://streaming.mybusinessacademypro.com']);

        if (is_null(Auth::user()->streaming_token)){
            $response = $client->request('POST', 'api/auth/login', [
                'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'email' => 'mbapro',
                    'password' => 'mbapro2020',
                    'device_name' => 'admin-device',
                ]
            ]);

            $result = json_decode($response->getBody());

            DB::table('wp98_users')
                ->where('ID', '=', Auth::user()->ID)
                ->update(['streaming_token' => $result->token]);
        }

        $headers = [
            'Accept'        => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '.Auth::user()->streaming_token
        ];
        
        $slug = Str::slug($request->title);
        $creacionCategoria = $client->request('POST', 'api/options', [
            'headers' => $headers,
            'form_params' => [
                'name' => $request->title,
                'description' => $request->title,
                'type' => 'meeting_category',
                'slug' => $slug
            ]
        ]);
        
        $result2 = json_decode($creacionCategoria->getBody());

        $categoria = new Category($request->all());
        $categoria->uuid = $result2->option->uuid;
        $categoria->slug = $slug;
        $categoria->save();
        if ($request->hasFile('cover')){
            $file = $request->file('cover');
            $name = $categoria->id.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/images/categories/covers', $name);
            $categoria->cover = $name;
            $categoria->cover_name = $file->getClientOriginalName();
        }
        $categoria->save();
        return redirect('admin/courses/categories')->with('msj-exitoso', 'La categoría '.$categoria->title.' ha sido agregada con éxito.');
    }

    /**
     * Admin / Cursos / Gestionar Categorías / Editar Categoría
     */
    public function edit_category($categoria){
        $categoria = Category::find($categoria);
        
        return response()->json(
            $categoria
        );
    }

     /**
     * Admin / Cursos / Gestionar Categorías / Actualizar Categoría
     */
    public function update_category(Request $request){
        $client = new Client(['base_uri' => 'https://streaming.mybusinessacademypro.com']);

        if (is_null(Auth::user()->streaming_token)){
            $response = $client->request('POST', 'api/auth/login', [
                'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'email' => 'mbapro',
                    'password' => 'mbapro2020',
                    'device_name' => 'admin-device',
                ]
            ]);

            $result = json_decode($response->getBody());

            DB::table('wp98_users')
                ->where('ID', '=', Auth::user()->ID)
                ->update(['streaming_token' => $result->token]);
        }

        $headers = [
            'Accept'        => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '.Auth::user()->streaming_token
        ];

        $categoria = Category::find($request->category_id);
        $slug = Str::slug($request->title);
        $actualizacionCategoria = $client->request('PATCH', 'api/options/'.$categoria->uuid, [
            'headers' => $headers,
            'form_params' => [
                'name' => $request->title,
                'description' => $request->title,
                'type' => 'meeting_category',
                'slug' => $slug
            ]
        ]);
        
        $result2 = json_decode($actualizacionCategoria->getBody());
        
        $categoria->fill($request->all());
        $categoria->slug = $slug;
        $categoria->save();
         if ($request->hasFile('cover')){
            $file = $request->file('cover');
            $name = $categoria->id.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/images/categories/covers', $name);
            $categoria->cover = $name;
            $categoria->cover_name = $file->getClientOriginalName();
        }
        $categoria->save();
        return redirect('admin/courses/categories')->with('msj-exitoso', 'La categoría '.$categoria->title.' ha sido modificada con éxito.');
    }

     /**
     * Admin / Cursos / Gestionar Categorías / Eliminar Categoría
     */
    public function delete_category($categoria){
        $client = new Client(['base_uri' => 'https://streaming.mybusinessacademypro.com']);

        if (is_null(Auth::user()->streaming_token)){
            $response = $client->request('POST', 'api/auth/login', [
                'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'email' => 'mbapro',
                    'password' => 'mbapro2020',
                    'device_name' => 'luisana',
                ]
            ]);

            $result = json_decode($response->getBody());

            DB::table('wp98_users')
                ->where('ID', '=', Auth::user()->ID)
                ->update(['streaming_token' => $result->token]);
        }

        $headers = [
            'Accept'        => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '.Auth::user()->streaming_token
        ];

        $categoria = Category::find($categoria);

        $eliminarCategoria = $client->request('DELETE', 'api/options/'.$categoria->uuid, [
            'headers' => $headers
        ]);
        
        $result2 = json_decode($eliminarCategoria->getBody());

        $categoria->delete();

        return redirect('admin/courses/categories')->with('msj-exitoso', 'La categoría '.$categoria->title.' ha sido eliminada con éxito.');
    }

    /**
     * Admin / Cursos / Gestionar Categorías / Listado de Subcategorías de una Categoría
     */
    public function subcategories(){
        // TITLE
        view()->share('title', 'Subcategorías');

        $subcategorias = Subcategory::withCount('courses')
                            ->orderBy('title', 'ASC')
                            ->get();
        
        return view('admin.courses.subcategories')->with(compact('subcategorias'));
    }

    /**
     * Admin / Cursos / Gestionar Categorías / Agregar Subcategoría
     */
    public function add_subcategory(Request $request){
        $subcategoria = new Subcategory($request->all());
        $subcategoria->slug = Str::slug($subcategoria->title);
        $subcategoria->save();

        return redirect('admin/courses/subcategories')->with('msj-exitoso', 'La subcategoría '.$subcategoria->title.' ha sido agregada con éxito.');
    }

    /**
     * Admin / Cursos / Gestionar Categorías / Editar SubCategoría
     */
    public function edit_subcategory($id){
        $subcategoria = Subcategory::find($id);
        
        return response()->json(
            $subcategoria
        );
    }

     /**
     * Admin / Cursos / Gestionar Categorías / Actualizar Subcategoría
     */
    public function update_subcategory(Request $request){
        $subcategoria = Subcategory::find($request->subcategory_id);
        $subcategoria->fill($request->all());
        $subcategoria->slug = Str::slug($subcategoria->title);
        $subcategoria->save();
        
        return redirect('admin/courses/subcategories')->with('msj-exitoso', 'La subcategoría '.$subcategoria->title.' ha sido modificada con éxito.');
    }


     /**
     * Admin / Cursos / Gestionar Categorías / Eliminar Subcategoría
     */
    public function delete_subcategory($id){
        $subcategoria = Subcategory::find($id);
        $subcategoria->delete();

        return redirect('admin/courses/subcategories')->with('msj-exitoso', 'La subcategoría '.$subcategoria->title.' ha sido eliminada con éxito.');
    }
}
