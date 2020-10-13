@extends('layouts.landing')

@push('scripts')
    <script>
        function loadMoreCoursesNew($accion) {
            if ($accion == 'next') {
                var route = $(".btn-arrow-next").attr('data-route');
            } else {
                var route = $(".btn-arrow-previous").attr('data-route');
            }
            $.ajax({
                url: route,
                type: 'GET',
                success: function(ans) {
                    $("#new-courses-section").html(ans);
                }
            });
        }
    </script>
@endpush

@push('styles')
    <style>
        #new-courses-section .card-img-overlay:hover{
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    @if (Session::has('msj-exitoso'))
        <div class="alert alert-success" style="margin: 5px 15px;">
            {{ Session::get('msj-exitoso') }}
        </div>
    @endif

    @if (Session::has('msj-erroneo'))
        <div class="alert alert-danger" style="margin: 5px 15px;">
            {{ Session::get('msj-erroneo') }}
        </div>
    @endif

    @if (!Auth::guest())
        <div class="title-page-course col-md"><span class="text-white">
            <h3><span class="text-white">Hola</span><span class="text-primary"> {{$username}}</span><span class="text-white"> ¡Nos alegra verte hoy!</span></h3>
        </div>
        @if(!empty($last_course))
        <div class="container-fluid d-sm-none">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-white text-uppercase ml-4" style="font-size: 12px;">
                                {{$last_course->title}}
                    </h5>
                    <div class="btn btn-none ">
                        <a href="{{ route('courses.show', [$last_course->slug, $last_course->course_id]) }}" class="btn btn-primary float-right text-uppercase mr-2" style="font-size: 12px;"><i class="fa fa-play"></i> Continuar curso</a>
                    </div>

                    <div class="progress progress-course-bar pl-0">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$last_course->progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$last_course->progress}}%">
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @else

        @endif
    @endif

    {{-- BANNER --}}
    @if (!Auth::guest())
        @if(!empty($last_course))

            <div class="container-fluid col-md-12 p-0">
                <img src="{{ asset('uploads/images/courses/covers/'.$last_course->cover) }}" class="course-banner-img img-fluid" alt="..."/>
                <div class="container-fluid pl-0 pr-0 course-banner-caption  d-none d-sm-block d-md-block clearfix">
                    <div class="">
                        <div class="col-md-12 p-0">
                            <h4 class="text-white text-uppercase ml-4 font-weight-bold" >
                                        {{$last_course->title}}
                            </h4>
                            <p class="col-md-6 description-course text-justify pl-0 ml-4">
                                    {!!$last_course->description!!}
                            </p>
                            <div class="float-right mb-2">
                                <div class="row">
                                     <a href="{{ route('courses.show', [$last_course->slug, $last_course->course_id]) }}" class="btn btn-primary float-right text-uppercase mr-4"><i class="fa fa-play"></i> Continuar curso</a>
                                </div>

                            </div>

                            <div class="pl-0 pr-0 col-md-12 progress progress-course-bar">
                                        <div class="progress-bar pl-0" role="progressbar" aria-valuenow="{{$last_course->progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$last_course->progress}}%">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-10 course-banner-caption pl-0 pr-4  d-none d-sm-block d-md-block">
                    <a href="{{ route('courses.show', [$last_course->slug, $last_course->course_id]) }}" class="btn btn-primary float-right text-uppercase mr-2"><i class="fa fa-play"></i> Continuar curso</a>
                    <div class="col-md-10">
                         <h4 class="text-white text-uppercase ml-4">
                                {{$last_course->title}}
                        </h4>
                    </div>
                    <div class="progress col-xs progress-course-bar pl-0">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$last_course->progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$last_course->progress}}%">
                    </div>
                    </div>
                </div>-->
            </div>
            <!--<div class="banner-course">
                <div class="button-container">
                    <img src="{{ asset('uploads/images/courses/covers/'.$last_course->cover) }}" class="course-banner-img" alt="..." height="550px" width="1600px" class="img-fluid" />
                </div>
                <div class="pl-0 pr-0 course-banner-caption">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="text-white text-uppercase ml-4">
                                <a href="{{ route('courses.show', [$last_course->slug, $last_course->id]) }}" class="text-secondary text-sm">{{$last_course->title}}</a>
                            </h4>
                            {{-- <p class="col-md-6 description-course text-justify pl-0 ml-4">
                                {{$last_course->description}}
                            </p> --}}
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <a href="{{ route('courses.show', [$last_course->slug, $last_course->course_id]) }}" class="btn btn-primary float-right text-uppercase mr-2"><i class="fa fa-play"></i> Ver Curso</a>
                                </div>
                            </div>
                            {{-- <div class="progress col-xs progress-course-bar">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$last_course->progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$last_course->progress}}%">
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif-->
    {{-- FIN DEL BANNER --}}
    {{-- SECCIÓN TUS CURSOS--}}
    <!--@if (!Auth::guest())
        @if($cursos->isNotEmpty())
            <div class="row">
                <div class="col-12">
                    <div class="section-title-courses ml-2">Tus Cursos</div>
                    <hr style="border: 1px solid #707070;opacity: 1;" />
                </div>
                @foreach ($cursos as $curso)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card mb-4 card-courses">
                            <img class="card-img-top" src="{{ asset('uploads/images/courses/covers/'.$curso->cover) }}" alt="card-image-cap">
                            <div class="card-body p-2">
                                <div class="row align-items-start">
                                    <h6 class="col-10"><a href="{{ route('courses.show', [$curso->slug, $curso->id]) }}" class="text-secondary text-sm">{{$curso->title}}</a></h6>
                                    <div class="col-2"><img src="{{ asset('images/icons/video-player-blue.svg') }}" alt="" height="20px" width="20px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center">
                    <div class="card-block text-primary">
                        <a href="{{ route('client.my-courses') }}" class="font-weight-bold">Ver todos mis cursos <i class="text-primary fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        @else
            <div class="title-page-course col-md">
                <span class="text-white">
                    <h4 class=""> {{$username}} <span class="text-white"> ¡No has agregado cursos!</span></h4>
                </span>
            </div>
        @endif
    @endif-->

    {{-- SECCIÓN TUS CURSOS--}}
    @if (!Auth::guest())
        @if($cursos->isNotEmpty())
            <div class="row">
                <div class="col-12">
                    <div class="section-title-courses ml-2">
                        <h3 class="">Tus Cursos</h3>
                        <hr style="margin-top:0px; border: 1px solid #707070;opacity: 1;" />
                        </div>

                </div>
                <div class="container-fluid m-2">
                    <div class="wrapper">
                    @foreach ($cursos as $curso)
                      <div>
                         <div class="card h-100 m-2 mb-4 card-courses">
                            <img class="card-img-top" src="{{ asset('uploads/avatar/'.$curso->mentor->avatar) }}" alt="card-image-cap">
                            <div class="card-body p-2">
                            <div class="row align-items-center">
                                <h6 class="col-sm"><a href="{{ route('courses.show', [$curso->slug, $curso->id]) }}" class="text-secondary text-sm">{{$curso->title}}</a>
                                </h6>

                                 <div class="col-3 mr-2"><img src="{{ asset('images/icons/video-player-blue.svg') }}" alt="" height="20px" width="20px"></div>
                            </div>
                            </div>
                       </div>
                    </div>
                    @endforeach
                     <div class="" style="z-index: 3">
                        <div class="row">
                                <div class="card-block w-50 text-primary align-self-center">
                                    <a href="{{ route('client.my-courses') }}" class="font-weight-bold">Ver todos mis cursos</a>
                                </div>
                                <div class="align-self-center">
                                        <i class="text-primary fa fa-arrow-right"></i>
                                </div>
                        </div>
                    </div>

                    </div>

                 </div>
            </div>
        @else
            <div class="title-page-course col-md">
                <span class="text-white">
                    <h4 class=""> {{$username}} <span class="text-white"> ¡No has agregado cursos!</span></h4>
                </span>
            </div>
        @endif
    @endif
    {{-- FIN SECCIÓN TUS CURSOS--}}

    {{-- SECCIÓN RECOMENDACIONES--}}
@if(!empty($cursosRecomendados))
<div class="section-landing mt-3" style="background-color: #121317;">

    <div class="col">
            @if (Auth::guest())
                <h3><span class="text-primary">Recomendados</span></h3>
            @else
                <h3><span class="text-primary">Recomendados</span><span class="text-white"> según tus intereses.</span></h3>
            @endif
        </div>

<!--Carrusel-->

@if($total > 0)
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

 <div class="carousel-inner">

  <div class="carousel-item active">
    <div class="row">

@php
$contador=0;
@endphp
@foreach($cursosRecomendados as $recommended)
@php
$contador++;
@endphp

@if($contador <= 3)

<div class="col-md-4" style="margin-top: 20px;">
  @if (!is_null($recommended->thumbnail_cover))
 <img src="{{ asset('uploads/images/courses/covers/'.$recommended->thumbnail_cover) }}" class="card-img-top img-prox-events" alt="...">
 @else
 <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top img-prox-events" alt="...">
  @endif
 <div class="card-img-overlay clearfix">
<div>
    <h6 class="card-title" style="font-size: 12px">{{$recommended->mentor->display_name}}</h6>
</div>
<div class="row ml-0 d-flex h-100">
    <div class="col-md-9 my-auto" style="margin-bottom: 7px !important">
        <h6 class="col-sm w-100 pl-0" style="font-size: 14px"><img src="{{ asset('images/icons/video-player-green.svg') }}" alt="" height="20px" width="20px"> <a href="{{ route('courses.show', [$recommended->slug, $recommended->id]) }}" class="text-white"> {{$recommended->title}}</a></h6>
    </div>
    <div class="col-md-3 my-auto" style="margin-bottom: 7px !important">
        <h6 class="text-white w-100">
            <i class="far fa-user-circle text-center">
                <p style="font-size: 10px;">{{ $recommended->users->count() }}</p>
            </i>
        </h6>
    </div>
</div>
</div>
 </div>
@endif
@endforeach
</div>
</div>

@if($total >= 4)
<div class="carousel-item">
    <div class="row">

@php
$segundo =0;
@endphp
@foreach($cursosRecomendados as $recommended)
@php
$segundo++;
@endphp

@if($segundo >= 4 && $segundo <= 6)

<div class="col-md-4" style="margin-top: 20px;">
  @if (!is_null($recommended->thumbnail_cover))
 <img src="{{ asset('uploads/images/courses/covers/'.$recommended->thumbnail_cover) }}" class="card-img-top img-prox-events" alt="...">
 @else
 <img src="{{ asset('uploads/images/avatar/default.jpg') }}" class="card-img-top img-prox-events" alt="...">
  @endif
<div class="card-img-overlay clearfix">
<div>
    <h6 class="card-title" style="font-size: 14px">{{$recommended->mentor->display_name}}</h6>
</div>
<div class="row ml-0 d-flex h-100">
    <div class="col-md-9 my-auto" style="margin-bottom: 7px !important">
        <h6 class="col-sm w-100 pl-0" style="font-size: 14px"><img src="{{ asset('images/icons/video-player-green.svg') }}" alt="" height="20px" width="20px"> <a href="{{ route('courses.show', [$recommended->slug, $recommended->id]) }}" class="text-white"> {{$recommended->title}}</a></h6>
    </div>
    <div class="col-md-3 my-auto" style="margin-bottom: 7px !important">
        <h6 class="text-white w-100">
            <i class="far fa-user-circle text-center">
                <p style="font-size: 10px;">{{ $recommended->users->count() }}</p>
            </i>
        </h6>
    </div>
</div>
</div>
 </div>
@endif
@endforeach
</div>
</div>
<div class="carousel-item">
    <div class="row">

@php
$tercero =0;
@endphp
@foreach($cursosRecomendados as $recommended)
@php
$tercero++;
@endphp

@if($tercero >= 7 && $tercero <= 9)

<div class="col-md-4" style="margin-top: 20px;">
  @if (!is_null($recommended->thumbnail_cover))
 <img src="{{ asset('uploads/images/courses/covers/'.$recommended->thumbnail_cover) }}" class="card-img-top img-prox-events" alt="...">
 @else
 <img src="{{ asset('uploads/images/avatar/default.jpg') }}" class="card-img-top img-prox-events" alt="...">
  @endif
<div class="card-img-overlay clearfix">
<div>
    <h6 class="card-title" style="font-size: 14px">{{$recommended->mentor->display_name}}</h6>
</div>
<div class="row ml-0 d-flex h-100">
    <div class="col-md-9 my-auto" style="margin-bottom: 7px !important">
        <h6 class="col-sm w-100 pl-0" style="font-size: 14px"><img src="{{ asset('images/icons/video-player-green.svg') }}" alt="" height="20px" width="20px"> <a href="{{ route('courses.show', [$recommended->slug, $recommended->id]) }}" class="text-white"> {{$recommended->title}}</a></h6>
    </div>
    <div class="col-md-3 my-auto" style="margin-bottom: 7px !important">
        <h6 class="text-white w-100">
            <i class="far fa-user-circle text-center">
                <p style="font-size: 10px;">{{ $recommended->users->count() }}</p>
            </i>
        </h6>
    </div>
</div>
</div>
 </div>
@endif
@endforeach
</div>
</div>
@endif

</div>

@if($total >= 3)
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
<i class="fas fa-chevron-circle-left"></i>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
<i class="fas fa-chevron-circle-right"></i>
<span class="sr-only">Next</span>
</a>
@endif

</div>

@else
<div class="row">
  No se encontraron cursos recomendados...
</div>

@endif
<!--Carrusel-->
</div>
@else
<div class="row">
  No se encontraron cursos recomendados...
</div>

@endif

    {{--FIN SECCIÓN RECOMENDACIONES--}}


    {{-- SECCIÓN CURSOS MAS NUEVOS --}}
    @if ($cursosNuevos->count() > 0)
        <div class="section-landing new-courses-section" id="new-courses-section">
            <div class="row">
                <div class="col">
                    <div class="section-title-landing new-courses-section-title">LOS MÁS NUEVOS</div>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-outline-light btn-arrow btn-arrow-previous" @if ($previous==0) disabled @endif data-route="{{ route('landing.load-more-courses-new', [$idStart, 'previous'] ) }}" onclick="loadMoreCoursesNew('previous');"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-outline-success btn-arrow btn-arrow-next" @if ($next==0) disabled @endif data-route="{{ route('landing.load-more-courses-new', [$idEnd, 'next'] ) }}" onclick="loadMoreCoursesNew('next');"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div id="newers" class="row" style="padding: 10px 30px;">
                @foreach ($cursosNuevos as $cursoNuevo)
                    <div class="col-xl-4 col-lg-4 col-12" style="padding-bottom: 10px;">
                        <div class="card">
                            <a href="{{ route('courses.show', [$cursoNuevo->slug, $cursoNuevo->id]) }}" style="color: white;">

                            @if (!is_null($cursoNuevo->cover))
                                <img src="{{ asset('uploads/images/courses/covers/'.$cursoNuevo->cover) }}" class="card-img-top new-course-img" alt="...">
                            @else
                                <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top new-course-img" alt="...">
                            @endif
                            <div class="card-img-overlay d-flex flex-column">
                                <div class="mt-auto">
                                    <div class="new-course-title">{{ $cursoNuevo->title }}</div>
                                    <div class="row">
                                       <div class="col-md-12">
                                           <p style="float: right;"> <i class="far fa-user-circle"> {{ $cursoNuevo->users->count()}}</i></p>
                                       </div>
                                    </div>
                                </div>
                            </div>
                          </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    {{-- FIN DE SECCIÓN CURSOS MÁS NUEVOS--}}


    {{-- SECCIÓN CURSOS POR CATEGORÍA --}}
    @if(!empty($courses))
    <div class="">
        <div class="container-fluid">
            <div class="col section-title-category mt-4">
                <h1>
                    <b>CURSOS POR CATEGORÍA</b>
                </h1>
            </div>
            <div class="row justify-content-center">
                @foreach ($courses as $course)
                    @if ($course->courses_count > 0)
                        <div class="col-sm-3 d-inline-flex p-2">
                            @if (!is_null($course->cover))
                                <img src="{{ asset('uploads/images/categories/covers/'.$course->cover) }}" class="card-img-top img-fluid course-category1" alt="...">
                            @else
                                <img src="{{ asset('uploads/images/categories/covers/default.jpg') }}" class="card-img-top img-fluid course-category1" alt="...">
                            @endif
                            <div class="course-category-caption ml-1 mr-1">
                                <div class="col-sm-lg text-sm-left font-weight-bold">
                                    <h6 class="pl-2 pr-2 m-0">
                                        <a href="{{ url('courses/category/'.$course->id) }}" class="col-sm-lg text-sm-left text-white">
                                            <small>
                                                <strong>{{$course->title}}</strong>
                                            </small>
                                        </a>
                                    </h6>
                                </div>
                                <div class="col-lg">
                                    <p class="text-white font-weight-bold">
                                        <small>{{$course->courses_count}} Cursos</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="row">
      No se encontraron mentores...
    </div>

    @endif
    {{-- FIN SECCIÓN CURSOS POR CATEGORÍA--}}

    {{-- SECCIÓN TUS MENTORES--}}
    @if (!Auth::guest())
        <div class="section-landing">
            <div class="col-lg-6 offset-lg-3">
                <h4 class=" section-title-landing text-primary text-center">MENTORES</h4>
            </div>
            <div class="container-fluid">
                <div class="mentor-index-seccion row d-flex flex-row p-2">
                    @foreach ($mentores as $mentor)
                    <div class="col-xs-12 mt-2">
                        <div class="card mentors-card">
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <img src="{{ asset('uploads/avatar/'.$mentor->avatar)}}" class="" alt="" height="164px" width="164px">
                                </div>
                                <div class="col">
                                    <div class="card-block px-2">
                                        <h4 class="card-title mt-4">{{$mentor->nombre}}</h4>
                                        <p class="card-text">{{$mentor->categoria}}</p>
                                        <br>

                                        <p class="card-text text-lg-right"><a href="{{ url('courses/mentor/'.$mentor->mentor_id) }}" class="col-sm-lg text-sm-left card-text">Ver perfil</a> <i class=" fa fa-angle-right"> </i></p>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    @endif
    {{-- FIN SECCIÓN TUS MENTORES--}}
@endsection
