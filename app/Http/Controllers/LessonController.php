<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUser;
use App\Models\Comment;
use App\Models\User;
use DB;
use Auth;
use App\Models\Subcategory;
use App\Models\CommentResponse;
use Carbon\Carbon;
class LessonController extends Controller{
    /**
    * Admin / Cursos / Listado de Cursos / Temario de un Curso
    */
    public function index($id){
        // TITLE
        view()->share('title', 'Lecciones del Curso');

        $curso = Course::where('id', '=', $id)
                    ->with('lessons', 'lessons.course')
                    ->first();

        $subcategory = Subcategory::all();

        return view('admin.courses.lessons')->with(compact('curso', 'subcategory'));
    }

    /**
    * Admin / Cursos / TEmario de Curso / Agregar Lección
    */
    public function store(Request $request){
        //dd ($request->all());
        $leccion = new Lesson($request->all());
        $leccion->slug = Str::slug($leccion->title);

        $url = explode("https://vimeo.com/", $leccion->url);
        $leccion->url = "https://player.vimeo.com/video/".$url[1];
        
        $url2 = explode("https://vimeo.com/", $leccion->english_url);
        $leccion->english_url = "https://player.vimeo.com/video/".$url2[1];
        
        $leccion->save();

        return redirect('admin/courses/lessons/show/'.$leccion->id)->with('msj-exitoso', 'La lección ha sido creada con éxito.');
    }

      /**
    * Admin / Cursos / Temario / Ver Video de Lección
    */
    public function show($id){
        // TITLE
        view()->share('title', 'Video de Lección');

        $leccion = Lesson::find($id);

        return view('admin.courses.showLesson')->with(compact('leccion'));
    }

    public function load_video_duration($id, $duration){
        $duracion = number_format($duration, 2);
        $leccion = DB::table('lessons')
                        ->where('id', '=', $id)
                        ->update(['duration' => $duracion]);

        return response()->json(
            true
        );
    }

     /**
    * Admin / Cursos / Temario / Editar Lección
    */
    public function edit($id){
        $leccion = Lesson::find($id);

        $subcategory = Subcategory::all();

        return view('admin.courses.editLesson')->with(compact('leccion', 'subcategory'));
    }

     /**
    * Admin / Cursos / Temario / Editar Lección / Guardar Cambios
    */
    public function update(Request $request){
        $leccion = Lesson::find($request->lesson_id);

        $videoUpdate = 0;
        if ($request->url != $leccion->url){
            $videoUpdate = 1;
            $url = explode("https://vimeo.com/", $request->url);
            $leccion->url = "https://player.vimeo.com/video/".$url[1];
        }

        if ($request->english_url != $leccion->english_url){
            $videoUpdate = 1;
            $url2 = explode("https://vimeo.com/", $request->english_url);
            $leccion->english_url = "https://player.vimeo.com/video/".$url2[1];
        }
        $leccion->title = $request->title;
        $leccion->english_title = $request->english_title;
        $leccion->description = $request->description;
        $leccion->subcategory_id = $request->subcategory_id;
        $leccion->slug = Str::slug($leccion->title);
        $leccion->save();
      //  return dd($request->all(), $leccion);
        if ($videoUpdate == 0){
            return redirect('admin/courses/lessons/'.$leccion->course_id)->with('msj-exitoso', 'La lección ha sido actualizada con éxito.');
        }else{
            return redirect('admin/courses/lessons/show/'.$leccion->id)->with('msj-exitoso', 'El video de la lección ha sido actualido con éxito.');
        }

    }

     /**
    * Admin / Cursos / Temario / Eliminar Lección
    */
    public function delete($id){
        $leccion = Lesson::find($id);

        $leccion->delete();

        return redirect('admin/courses/lessons/'.$leccion->course_id)->with('msj-exitoso', 'La lección ha sido eliminada con éxito.');
    }

      /**
    * Courses / Leccion
    */

  /*  public function lesson($lesson_slug, $lesson_id, $course_id)
    {
        $lesson = Lesson::where('id', $lesson_id)->get()->first();
        $all_lessons = Lesson::where('course_id', '=',  $course_id)->get();

        $all_comments = Comment::where('lesson_id', $lesson_id)->get();
        return view('cursos.leccion', compact('lesson', 'all_lessons','all_comments'));
    }*/
    public function lesson($lesson_slug, $lesson_id, $course_id){
        if (Auth::user()->membership_status == 1){
            /**Guarda la lección al acceder*/
            $leccion_guardada = LessonUser::where('lesson_id',$lesson_id)
                                    ->where('user_id', Auth::user()->ID)
                                    ->first();

            //dd($leccion_guardada, Empty($leccion_guardada));
            if(Empty($leccion_guardada)){
                $leccion_vista = new LessonUser;
                $leccion_vista->user_id = Auth::user()->ID;
                $leccion_vista->lesson_id = $lesson_id;
                $leccion_vista->course_id= $course_id;
                $leccion_vista->status = 1;
                $leccion_vista->save();
            }else{
                //$fecha = date('Y-m-d H:i:s');
                $leccion_guardada->updated_at = date('Y-m-d H:i:s');
                $leccion_guardada->save();
            }

            $lecciones_vistas = LessonUser::where('user_id', Auth::user()->ID)
                                    ->where('course_id', $course_id)
                                    ->get();

            /*$leccion_vista = LessonUser::where('user_id', Auth::user()->ID)
                                ->where('course_id', $course_id)
                                ->get();*/

            $total_vista = $lecciones_vistas->count();
            $total_lesson = Lesson::where('course_id',$course_id)->count();
            $progress_bar = ( ($total_vista*100) / $total_lesson);

            $progresoCurso = DB::table('courses_users')
                                ->where('course_id', '=', $course_id)
                                ->where('user_id', '=', Auth::user()->ID)
                                ->first();

            if ($progresoCurso->progress != $progress_bar){
                DB::table('courses_users')
                ->where('course_id', '=', $course_id)
                ->where('user_id', '=', Auth::user()->ID)
                ->update(['progress' => $progress_bar,
                          'updated_at' => date('Y-m-d H:i:s')]);
            }
            /*if($total_lesson == 0){
                $progress_bar = 0;
            }else{
                $progress_bar = (($total_vista*100)/$total_lesson);
            }*/

            $lesson = Lesson::where('id', '=',$lesson_id)
                        ->with('course')
                        ->first();
            $all_lessons = Lesson::where('course_id', '=',  $course_id)->get();

            $all_comments = Comment::with('responses')
                                ->where('lesson_id', $lesson_id)
                                ->orderBy('id', 'DESC')
                                ->get();

            $directos = User::where('referred_id', Auth::user()->ID)->get()->count('ID');

            $last_lesson = LessonUser::where('user_id', Auth::user()->ID)
                                ->where('course_id', $course_id)
                                ->latest('updated_at')
                                ->first();
          
            if (!is_null($last_lesson)){
                $first_lesson = Lesson::where('id', $last_lesson->lesson_id)->first();
            }else{
                $first_lesson = Lesson::where('course_id', '=', $id)->orderBy('id', 'ASC')->first();
            }
                
            $cursosMembresia = DB::table('courses')
                                    ->select('id')
                                    ->where('membership_id', '=', Auth::user()->membership_id)
                                    ->get();
            
            $cantCursosMembresia = $cursosMembresia->count();
            $cantCursosMembresiaUsuario = 0;
            $cantCursosMembresiaFinalizados = 0;
            $cantCursosCertificados = 0;
            $cursosMembresiaArray = array();
            foreach ($cursosMembresia as $cursoMembresia){
                array_push($cursosMembresiaArray, $cursoMembresia->id);
                $cursoUsuario = DB::table('courses_users')
                                    ->where('course_id', '=', $cursoMembresia->id)
                                    ->where('user_id', '=', Auth::user()->ID)
                                    ->first();
                
                if (!is_null($cursoUsuario)){
                    $cantCursosMembresiaUsuario++;

                    if ($cursoUsuario->progress == 100){
                        $cantCursosMembresiaFinalizados++;
                        if ($cursoUsuario->certificate == 1){
                            $cantCursosCertificados++;
                        }
                    }
                }
            }
            
            $checkAward = 0;
            $modalUpgrade = 0;
            if ($cantCursosMembresia == $cantCursosMembresiaUsuario){
                if ($cantCursosMembresia == $cantCursosMembresiaFinalizados){
                    $modalUpgrade = 1;

                    if ($cantCursosMembresia == $cantCursosCertificados){
                        $premio = DB::table('awards_users')
                                ->where('user_id', '=', Auth::user()->ID)
                                ->where('award_id', '=', Auth::user()->membership->award->id)
                                ->first();
                        if (is_null($premio)){
                            Auth::user()->awards()->attach(Auth::user()->membership->award->id);
                            $checkAward = 1;
                        }
                    }
                    
                }else if (($cantCursosMembresia-1) == $cantCursosMembresiaFinalizados){
                    $cursoRestante = DB::table('courses_users')
                                        ->where('user_id', '=', Auth::user()->ID)
                                        ->where('progress', '<>', 100)
                                        ->whereIn('course_id', $cursosMembresiaArray)
                                        ->first();
                    
                    $cantLeccionesCurso = DB::table('lessons')
                                            ->where('course_id', '=', $cursoRestante->course_id)
                                            ->count();
                    
                    
                    $cantLeccionesCursoUsuario = DB::table('lessons_users')
                                                    ->where('user_id', '=', Auth::user()->ID)
                                                    ->where('course_id', '=', $cursoRestante->course_id)
                                                    ->count();
                   
                    
                    if ($cantLeccionesCurso == $cantLeccionesCursoUsuario){
                        $modalUpgrade = 1;
                    }else if (($cantLeccionesCurso-1) == $cantLeccionesCursoUsuario){
                        $modalUpgrade = 1;
                    }  
                }
            }
        
            return view('cursos.leccion', compact('lesson', 'all_lessons','all_comments', 'progresoCurso','directos', 'last_lesson', 'first_lesson', 'lecciones_vistas', 'modalUpgrade', 'checkAward'));
                
        
        }else{
            $datosCurso = DB::table('courses')
                            ->select('id', 'slug')
                            ->where('id', '=', $course_id)
                            ->first();

            return redirect()->route('courses.show', [$datosCurso->slug, $datosCurso->id])->with('msj-erroneo', 'Por favor, renueve su membresía para seguir disfrutando de los cursos.');
        }
    }
    /*AGREGAR COMENTARIOS*/
    public function lesson_comments(Request $request){

         $lesson = Lesson::find($request->lesson_id);
        if (isset($request->response)){
            $respuesta = new CommentResponse($request->all());
            $respuesta->user_id = Auth::user()->ID;
            $respuesta->date = date('Y-m-d');
            $respuesta->save();
        }else{
            $lesson_comments = new Comment($request->all());
            $lesson_comments->user_id = Auth::user()->ID;
            $lesson_comments->date = Carbon::now()->format('Y-m-d');
            $lesson_comments->save();
        } 

        $all_comments = Comment::with('responses')
                            ->where('lesson_id', $request->lesson_id)
                            ->orderBy('id', 'DESC')
                            ->get();

        return view('cursos.commentsSection')->with(compact('all_comments', 'lesson'));
         //return redirect('courses/lesson/'.$datosLeccion->slug.'/'.$datosLeccion->id.'/'.$datosLeccion->course_id);

    }
}
