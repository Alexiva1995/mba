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
        
        
        if({{$pop_up}} == 1){
          $('#mostrarpopup').modal();
        }
    
        $('#mostrarpopup').on('hidden.bs.modal', function (e) {
          $("#mostrarpopup").remove();
        });
        
        function showMentorCourses($mentor){
            $("#card-mentor-"+$mentor).css('display', 'none');
            $("#courses-mentor-"+$mentor).slideToggle();
        }
        
        function hideMentorCourses($mentor){
            $("#courses-mentor-"+$mentor).css('display', 'none');
            $("#card-mentor-"+$mentor).slideToggle();
        }

        if ({{$modalVisitante}} == 1){
            $('#visitante-modal').modal();
        }
        
        $(document).ready(function(){ 
            if (screen.width <= 1200){
                $("#streaming-details-div-lg").css("display", "none");
                $("#streaming-details-div-xs").css("display", "block");
            }else{
                $("#streaming-details-div-xs").css("display", "none");
                $("#streaming-details-div-lg").css("display", "block");
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        #new-courses-section .card-img-overlay:hover{
            text-decoration: underline;
        }
        
        .imagen:hover {-webkit-filter: none; filter: none; color: #6EC1E4 0.2em 0.2em 0.6em 0.1em;
        }
        
        .imagen {filter: grayscale(80%);}

        .punto::before{
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #222326;
            border-radius: 50%;
            margin-left: -7px;
            z-index: 2;
        }

        .punto::after{
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            background: rgba(0,123,255,1);
            border-radius: 50%;
            margin-left: -12px;
        }

        .punto-end::before{
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #222326;
            border-radius: 50%;
            margin-left: -10px;
            z-index: 2;
        }

        .punto-end::after{
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            background: rgba(40,167,70,1);
            border-radius: 50%;
            right: 0;
        }
        .punto.bg-success::after{
            background: rgba(0,123,255,0.99);
            background: -moz-linear-gradient(left, rgba(0,123,255,0.99) 0%, rgba(0,123,253,0.99) 1%, rgba(40,167,69,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(0,123,255,0.99)), color-stop(1%, rgba(0,123,253,0.99)), color-stop(100%, rgba(40,167,69,1)));
            background: -webkit-linear-gradient(left, rgba(0,123,255,0.99) 0%, rgba(0,123,253,0.99) 1%, rgba(40,167,69,1) 100%);
            background: -o-linear-gradient(left, rgba(0,123,255,0.99) 0%, rgba(0,123,253,0.99) 1%, rgba(40,167,69,1) 100%);
            background: -ms-linear-gradient(left, rgba(0,123,255,0.99) 0%, rgba(0,123,253,0.99) 1%, rgba(40,167,69,1) 100%);
            background: linear-gradient(to right, rgba(0,123,255,0.99) 0%, rgba(0,123,253,0.99) 1%, rgba(40,167,69,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#007bff', endColorstr='#28a745', GradientType=1 );
        }

        .punto.invertido::after{
            background: rgba(0,6,191,1);
            background: -moz-linear-gradient(left, rgba(0,6,191,1) 0%, rgba(40,167,70,1) 0%, rgba(0,123,253,0.99) 99%, rgba(0,123,255,0.99) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(0,6,191,1)), color-stop(0%, rgba(40,167,70,1)), color-stop(99%, rgba(0,123,253,0.99)), color-stop(100%, rgba(0,123,255,0.99)));
            background: -webkit-linear-gradient(left, rgba(0,6,191,1) 0%, rgba(40,167,70,1) 0%, rgba(0,123,253,0.99) 99%, rgba(0,123,255,0.99) 100%);
            background: -o-linear-gradient(left, rgba(0,6,191,1) 0%, rgba(40,167,70,1) 0%, rgba(0,123,253,0.99) 99%, rgba(0,123,255,0.99) 100%);
            background: -ms-linear-gradient(left, rgba(0,6,191,1) 0%, rgba(40,167,70,1) 0%, rgba(0,123,253,0.99) 99%, rgba(0,123,255,0.99) 100%);
            background: linear-gradient(to right, rgba(0,6,191,1) 0%, rgba(40,167,70,1) 0%, rgba(0,123,253,0.99) 99%, rgba(0,123,255,0.99) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0006bf', endColorstr='#007bff', GradientType=1 );
        }

        .progress {
            display: -ms-flexbox;
            display: flex;
            height: 0.6rem;
            overflow: hidden;
            line-height: 0;
            font-size: .75rem;
            background: transparent linear-gradient(90deg, #2A91FF 0%, #257EDB 30%, #6AB742 100%) 0% 0% no-repeat padding-box;
            border-radius: .25rem;
        }

        .progress-bar-striped {
            background-size: 1rem 1rem;
            background: transparent;
        }

        .punto.bg-info::after{
            background: rgba(40,167,70,0.99);
            background: -moz-linear-gradient(left, rgba(40,167,70,0.99) 0%, rgba(40,167,71,0.99) 1%, rgba(23,163,184,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(40,167,70,0.99)), color-stop(1%, rgba(40,167,71,0.99)), color-stop(100%, rgba(23,163,184,1)));
            background: -webkit-linear-gradient(left, rgba(40,167,70,0.99) 0%, rgba(40,167,71,0.99) 1%, rgba(23,163,184,1) 100%);
            background: -o-linear-gradient(left, rgba(40,167,70,0.99) 0%, rgba(40,167,71,0.99) 1%, rgba(23,163,184,1) 100%);
            background: -ms-linear-gradient(left, rgba(40,167,70,0.99) 0%, rgba(40,167,71,0.99) 1%, rgba(23,163,184,1) 100%);
            background: linear-gradient(to right, rgba(40,167,70,0.99) 0%, rgba(40,167,71,0.99) 1%, rgba(23,163,184,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#28a746', endColorstr='#17a3b8', GradientType=1 );
        }
        .punto.bg-warning::after{
            background: rgba(23,163,184,0.99);
            background: -moz-linear-gradient(left, rgba(23,163,184,0.99) 0%, rgba(25,163,182,0.99) 1%, rgba(255,193,7,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(23,163,184,0.99)), color-stop(1%, rgba(25,163,182,0.99)), color-stop(100%, rgba(255,193,7,1)));
            background: -webkit-linear-gradient(left, rgba(23,163,184,0.99) 0%, rgba(25,163,182,0.99) 1%, rgba(255,193,7,1) 100%);
            background: -o-linear-gradient(left, rgba(23,163,184,0.99) 0%, rgba(25,163,182,0.99) 1%, rgba(255,193,7,1) 100%);
            background: -ms-linear-gradient(left, rgba(23,163,184,0.99) 0%, rgba(25,163,182,0.99) 1%, rgba(255,193,7,1) 100%);
            background: linear-gradient(to right, rgba(23,163,184,0.99) 0%, rgba(25,163,182,0.99) 1%, rgba(255,193,7,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#17a3b8', endColorstr='#ffc107', GradientType=1 );
        }
        .punto.bg-danger::after{
            background: rgba(255,193,7,0.99);
            background: -moz-linear-gradient(left, rgba(255,193,7,0.99) 0%, rgba(255,192,8,0.99) 1%, rgba(220,53,69,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,193,7,0.99)), color-stop(1%, rgba(255,192,8,0.99)), color-stop(100%, rgba(220,53,69,1)));
            background: -webkit-linear-gradient(left, rgba(255,193,7,0.99) 0%, rgba(255,192,8,0.99) 1%, rgba(220,53,69,1) 100%);
            background: -o-linear-gradient(left, rgba(255,193,7,0.99) 0%, rgba(255,192,8,0.99) 1%, rgba(220,53,69,1) 100%);
            background: -ms-linear-gradient(left, rgba(255,193,7,0.99) 0%, rgba(255,192,8,0.99) 1%, rgba(220,53,69,1) 100%);
            background: linear-gradient(to right, rgba(255,193,7,0.99) 0%, rgba(255,192,8,0.99) 1%, rgba(220,53,69,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc107', endColorstr='#dc3545', GradientType=1 );
        }
    </style>
@endpush

@section('content')

    @if (app('request')->input('logout') == "1")
        <script>
            document.getElementById('logout-form').submit();
        </script>
    @endif

    

    @if (Session::has('msj-exitoso'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <strong>{{ Session::get('msj-exitoso') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::has('msj-erroneo'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <strong>{{ Session::get('msj-erroneo') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- SLIDER --}}
    @if ($cursosDestacados->count() > 0)
        <div class="container-fluid courses-slider">
            <div id="mainSlider" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
                @if ($cursosDestacados->count() > 1)
                    @php $contCD = 0; @endphp
                    <ol class="carousel-indicators">
                        @foreach ($cursosDestacados as $cd)
                            <li data-target="#mainSlider" data-slide-to="{{ $contCD }}" @if ($contCD == 0) class="active" @endif></li>
                            @php $contCD++; @endphp
                        @endforeach
                    </ol>
                @endif
                <div class="carousel-inner">
                    @php $cont = 0; @endphp
                    @foreach ($cursosDestacados as $cursoDestacado)
                        @php $cont++; @endphp
                        <div class="carousel-item @if ($cont == 1) active @endif">
                            <div class="overlay" ></div>
                            <img src="{{ asset('uploads/images/courses/featured_covers/'.$cursoDestacado->featured_cover) }}" class="d-block w-100 img-fluid" alt="...">
                            <div class="carousel-caption">
                                <p style="color:#007bff; font-size: 22px; font-weight: bold; margin-top: -20px;">NUEVO CURSO</p>
                                <div class="course-autor text-white">{{$cursoDestacado->mentor->display_name}}</div>
                                <div class="course-title"> <a href="{{ route('courses.show', [$cursoDestacado->slug, $cursoDestacado->id]) }}" style="color: white;">{{ $cursoDestacado->title }}</a></div>
                                <!--<div class="course-category">{{ $cursoDestacado->category->title }}</div>-->
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($cursosDestacados->count() > 1)
                    <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
            </div>
        </div>
    @endif
    {{-- FIN DEL SLIDER --}}

    {{-- SECCIÓN TU AVANCE (USUARIOS LOGGUEADOS)
    @if (!Auth::guest())
        <div class="section-landing">
            <div class="section-title-landing">TU AVANCE</div>
            <div class="row">
                <div class="col text-left">Nivel: Principiante</div>
                <div class="col text-right">Próximo Nivel: Intermedio</div>
                <div class="w-100"></div>
                <div class="col" style="padding: 20px 20px;">
                    <div class="progress" style="background-color: #8E8E8E;">
                        <div class="progress-bar" role="progressbar" style="width: 35%; background-color: #2A91FF;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%; background: linear-gradient(to right, #2A91FF, #6AB742); border-radius: 30px;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <!--<div class="progress-bar bg-info" role="progressbar" style="width: 35%; background-color: #6AB742;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>-->
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col text-left">Cursos Realizados: 7</div>
                <div class="col text-right">Cursos por Realizar: 4</div>
            </div>
        </div><BR><BR>
    @endif
   {{-- FIN DE SECCIÓN TU AVANCE (USUARIOS LOGGUEADOS) --}}

   @auth
   <div class="col-12 section-landing mb-4" style="background: linear-gradient(to bottom, #222326 100%, #1C1D21 100%)">
        <div class="row">
            <div class="col-12">
                <div class="section-title-landing new-courses-section-title" style="color:#6AB742;">Hola {{Auth::user()->display_name}}!, Bienvenido(a) ¿Qué quieres aprender hoy?</div>
                <div class="section-title-landing new-courses-section-title">TU AVANCE</div>
            </div>
            <div class="col-12 col-md-6">
                <h4 class="text-left">
                    Nivel: <span>{{$avance['nivel']}}</span>
                </h4>
            </div>
            <div class="col-12 col-md-6">
            <h4 class="text-right">
                Próximo Nivel: <span>{{$avance['proximo']}}</span>
            </h4>
            </div>
            <div class="col-12 mt-4">
                <div class="progress">
                    @if (Auth::user()->membership_id >= 1)
                    <div class="progress-bar progress-bar-striped punto" role="progressbar" style="width: 20%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                    @if(Auth::user()->membership_id >= 2)
                    <div class="progress-bar progress-bar-striped punto invertido" role="progressbar" style="width: 20%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                    @if(Auth::user()->membership_id >= 3)
                    <div class="progress-bar progress-bar-striped punto invertido" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                    @if(Auth::user()->membership_id >= 4)
                    <div class="progress-bar progress-bar-striped punto invertido" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                    @if(Auth::user()->membership_id >= 5)
                    <div class="progress-bar progress-bar-striped punto invertido" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar progress-bar-striped punto-end bg-danger " role="progressbar" style="width: 0%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
            </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 mt-4">
                <h4 class="">Cursos Realizados: {{$avance['cursos']}}</h4>
            </div>
            @if(!empty($insignia))
            <div class="col-12 col-sm-6 col-md-6 mt-4">
                <h4 class="">Ultima Insignia Ganada: <img src="{{ $insignia }}" height="40px" width="40px" style="margin: 20px;"></h4>
            </div>
              @endif
        </div>
    </div>
   @endauth

    {{-- SECCIÓN CURSOS MAS NUEVOS --}}
    @if ($cursosNuevos->count() > 0)
        <div class="section-landing new-courses-section" id="new-courses-section">
            <div class="row">
                <div class="col">
                    <div class="section-title-landing new-courses-section-title">LOS MÁS NUEVOS</div>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-outline-light btn-arrow btn-arrow-previous" @if ($previous == 0) disabled @endif data-route="{{ route('landing.load-more-courses-new', [$idStart, 'previous'] ) }}"  onclick="loadMoreCoursesNew('previous');"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-outline-success btn-arrow btn-arrow-next" @if ($next == 0) disabled @endif data-route="{{ route('landing.load-more-courses-new', [$idEnd, 'next'] ) }}"  onclick="loadMoreCoursesNew('next');"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div id="newers" class="row" style="padding: 10px 30px;">
                @foreach ($cursosNuevos as $cursoNuevo)
                    <div class="col-xl-4 col-lg-4 col-12 box-courses" style="padding-bottom: 10px;">
                        <div class="card">
                            <a href="{{ route('courses.show', [$cursoNuevo->slug, $cursoNuevo->id]) }}" style="color: white;">

                            @if (!is_null($cursoNuevo->thumbnail_cover))
                                <!-- <img src="{{ asset('uploads/avatar/'.$cursoNuevo->mentor->avatar) }}" class="card-img-top new-course-img" alt="..."> -->
                                <img src="{{ asset('uploads/images/courses/covers/'.$cursoNuevo->thumbnail_cover) }}" class="card-img-top new-course-img" alt="...">
                            @else
                                <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top new-course-img" alt="...">
                            @endif
                            <div class="card-img-overlay d-flex flex-column course-overlay">
                                <div class="mt-auto">
                                    <div class="section-title-landing text-white text-center" style="line-height:1;">{{ $cursoNuevo->title }}</div>
                                    <div class="row">
                                       <div class="col-md-12">
                                           <p class="ico" style="float: right;"> <i class="far fa-user-circle"> {{ $cursoNuevo->users->count()}}</i></p>
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

    {{-- SECCIÓN PRÓXIMO STREAMING--}}
    @if (!is_null($proximoEvento))
        <div class="next-streaming">
            <img src="{{ asset('/uploads/images/banner/'.$proximoEvento->image) }}" class="next-streaming-img">
            <div class="next-streaming-info">
                <a href="{{route('transmisiones')}}" type="button" class="btn btn-primary btn-next-streaming">Próximo Streaming</a><br>

                <div class="next-streaming-title">{{ $proximoEvento->title }}</div>
                <div id="streaming-details-div-lg">
                    <div class="next-streaming-date" style="padding-right: 5%;">
                        <i class="fa fa-calendar"></i> {{ $proximoEvento->weekend_day }} {{ $proximoEvento->date_day }} de {{ $proximoEvento->month }}<br>
                        @if (Auth::guest()) 
                            <i class="fa fa-clock"></i>
                            @foreach ($proximoEvento->countries as $country)
                                {{ date('H:i A', strtotime($country->pivot->time)) }} {{ $country->abbreviation }} /
                            @endforeach
                        @else
                            @if (!is_null($checkPais))
                                <i class="fa fa-clock"></i> {{ date('H:i A', strtotime($horaEvento)) }}
                            @else
                                <i class="fa fa-clock"></i>
                                @foreach ($proximoEvento->countries as $country)
                                    {{ date('H:i A', strtotime($country->pivot->time)) }} {{ $country->abbreviation }} /
                                @endforeach
                            @endif
                        @endif
                    </div>
                    @if (!Auth::guest())
                        <div class="next-streaming-reserve">
                            @if (is_null(Auth::user()->membership_id))
                                {{-- USUARIOS LOGUEADOS SIN MEMBRESÍA  --}}
                                <a href="{{route('shopping-cart.membership')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir Membresía</a>
                            @else
                                @if (Auth::user()->membership_status == 1)
                                    @if (!in_array($proximoEvento->id, $misEventosArray))
                                        @if (Auth::user()->streamings < Auth::user()->membership->streamings)
                                            {{-- USUARIOS LOGUEADOS CON STREAMINGS DISPONIBLES Y QUE NO TIENEN EL EVENTO AGENDADO AÚN--}}
                                            <a href="{{ route('schedule.event', [$proximoEvento->id]) }}">Reservar Plaza <i class="fas fa-chevron-right"></i></a>
                                        @else
                                            @if (Auth::user()->membership_id < 4)
                                                <a href="{{route('shopping-cart.store', [Auth::user()->membership_id+1, 'membresia', 'Mensual'])}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Aumentar Membresía</a>
                                            @else
                                                <i class="fa fa-times" aria-hidden="true"></i> Límite de Eventos Superado
                                            @endif
                                        @endif
                                    @else
                                        <a href="{{ route('timeliveEvent', $proximoEvento->id) }}">Ir al Evento<i class="fas fa-chevron-right"></i></a>
                                    @endif
                                @else
                                    <a href="{{route('shopping-cart.store', [Auth::user()->membership_id, 'membresia', 'Mensual'])}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Renovar Membresía</a>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
                <div class="next-streaming-reserve" id="streaming-details-div-xs" style="display: none;">
                    <a href="#next-streaming-details" data-toggle="modal"><i class="fa fa-info-circle"></i> <b>Ver Detalles</b></a>
                </div>
            </div>
        </div><br><br>
    @endif
    {{-- FIN SECCIÓN PRÓXIMO STREAMING--}}
    
    {{-- SECCIÓN MENTORES --}}
    <div class="section-landing">
            <div class="row">
                <div class="col">
                    <div class="section-title-landing new-courses-section-title">
                        <h1>MENTORES</h1>
                    </div>
                </div>
            </div>
        
            <div id="newers" class="row" style="padding: 10px 30px;">
                @foreach ($mentores as $mentor)
                    <div class="col-xl-3 col-lg-3 col-12" style="padding-bottom: 10px;">
                        <div class="card" id="card-mentor-{{$mentor->mentor_id}}">
                            <a href="" style="color: white;">
                            
                            @if (!is_null($mentor->avatar))
                                <!-- <img src="{{ asset('uploads/avatar/'.$mentor->avatar) }}" class="card-img-top new-course-img" alt="..."> -->
                                <img src="{{ asset('uploads/avatar/'.$mentor->avatar) }}" class="card-img-top new-course-img" alt="..." style="">

                            @else
                                <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top new-course-img" alt="...">
                            @endif
                            <div class="card-img-overlay d-flex flex-column mentor-overlay">
                                <div class="mt-auto">
                                    <div class="text-sm text-white" style="line-height:1;">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <a class="text-white" href="{{ url('courses/mentor/'.$mentor->mentor_id) }}" style="font-size: 18px;"> {{ $mentor->nombre }}</a>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <a href="javascript:;" onclick="showMentorCourses({{$mentor->mentor_id}});" style="font-size: 13px;"><i class="fa fa-search"></i> Cursos</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                   
                                </div>
                            </div>
                          </a>
                        </div>
                        <div class="card" style="display: none;" id="courses-mentor-{{$mentor->mentor_id}}">
                            <a href="" style="color: white;">
                                @if (!is_null($mentor->avatar))
                                    <img src="{{ asset('uploads/avatar/'.$mentor->avatar) }}" class="card-img-top new-course-img" alt="..." style="opacity: 0.1 !important;">
                                @else
                                    <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top new-course-img" alt="...">
                                @endif
                                <div class="card-img-overlay d-flex flex-column">
                                    @foreach ($mentor->courses as $cursoMentor)
                                        <a hreF="{{ route('courses.show', [$cursoMentor->slug, $cursoMentor->id]) }}" style="font-size: 19px;"><i class="fas fa-graduation-cap"></i> {{ $cursoMentor->title }}</a>
                                    @endforeach
                                    <div class="mt-auto">
                                        <div class="text-sm text-white text-right" style="line-height:1;">
                                            <a href="javascript:;" onclick="hideMentorCourses({{$mentor->mentor_id}});"><i class="fas fa-chevron-circle-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    
    
    
    {{-- FIN SECCIÓN MENTORES --}}

    {{-- SECCIÓN REFERIDOS (USUARIOS LOGGUEADOS) --}}
    @if (!Auth::guest())
        <div class="pt-4">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-12 pl-4 pr-4">
                    <div class="referrers-box">
                        <i class="fa fa-user referrers-icon" style="color: #2a91ff;"></i><br>
                        {{ $refeDirec }} Referidos
                    </div>
                    <a href="{{url('/admin')}}" style="color: white; text-decoration: none;">
                     <div class="referrers-button">
                        Panel de referidos
                     </div>
                    </a>
                </div>
                <div class="col-xl-8 col-lg-8 d-none d-lg-block d-xl-block referrers-banner">
                    <div class="referrers-banner-text">EL QUE QUIERE SUPERARSE, NO VE OBSTÁCULOS, VE SUEÑOS.</div>
                </div>
            </div>
        </div><br><br>
    @endif
    {{-- FIN DE SECCIÓN REFERIDOS (USUARIOS LOGGUEADOS) --}}
    
    
    
    {{-- mostrar pop up --}}
    @if($pop->activado == '1')
        <div class="modal fade" id="mostrarpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel" style="color:white;">{!! (!empty($pop->titulo)) ? $pop->titulo : '' !!}   </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">   
                            {!! (!empty($pop->contenido)) ? $pop->contenido : '' !!}   
                        </div>  
                    </div>
                </div>
            </div>
        </div> 
    @endif
    {{-- Fin pop up--}}

    <div class="modal fade" id="visitante-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color:white;">REGÍSTRATE AHORA</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-white pl-5 pr-5 text-center">
                    Te encuentras en modo visitante.<br>
                    Para disfrutar de nuestro contenido a precio preferencial ingresa en este botón.
                    <br><br>
                    <a type="button" class="btn btn-primary btn-register-header d-md-block m-2" href="{{ route('log').'?act=1' }}">REGISTRO</a>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="modal fade" id="next-streaming-details" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" style="color:white;">Detalles del Evento</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-white pl-5 pr-5 text-center">
                    @if (!is_null($proximoEvento))
                        <div class="next-streaming-date">
                            <i class="fa fa-calendar"></i> {{ $proximoEvento->weekend_day }} {{ $proximoEvento->date_day }} de {{ $proximoEvento->month }}<br>
                            @if (Auth::guest()) 
                                <i class="fa fa-clock"></i>
                                @foreach ($proximoEvento->countries as $country)
                                    {{ date('H:i A', strtotime($country->pivot->time)) }} {{ $country->abbreviation }} /
                                @endforeach
                            @else
                                @if (!is_null($checkPais))
                                    <i class="fa fa-clock"></i> {{ date('H:i A', strtotime($horaEvento)) }}
                                @else
                                    <i class="fa fa-clock"></i>
                                    @foreach ($proximoEvento->countries as $country)
                                        {{ date('H:i A', strtotime($country->pivot->time)) }} {{ $country->abbreviation }} /
                                    @endforeach
                                @endif
                            @endif
                        </div>
                        @if (!Auth::guest())
                            <div class="next-streaming-reserve">
                                @if (is_null(Auth::user()->membership_id))
                                    {{-- USUARIOS LOGUEADOS SIN MEMBRESÍA  --}}
                                    <a href="{{route('shopping-cart.membership')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir Membresía</a>
                                @else
                                    @if (Auth::user()->membership_status == 1)
                                        @if (!in_array($proximoEvento->id, $misEventosArray))
                                            @if (Auth::user()->streamings < Auth::user()->membership->streamings)
                                                {{-- USUARIOS LOGUEADOS CON STREAMINGS DISPONIBLES Y QUE NO TIENEN EL EVENTO AGENDADO AÚN--}}
                                                <a href="{{ route('schedule.event', [$proximoEvento->id]) }}">Reservar Plaza <i class="fas fa-chevron-right"></i></a>
                                            @else
                                                @if (Auth::user()->membership_id < 4)
                                                    <a href="{{route('shopping-cart.store', [Auth::user()->membership_id+1, 'membresia', 'Mensual'])}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Aumentar Membresía</a>
                                                @else
                                                    <i class="fa fa-times" aria-hidden="true"></i> Límite de Eventos Superado
                                                @endif
                                            @endif
                                        @else
                                            <a href="{{ route('timeliveEvent', $proximoEvento->id) }}">Ir al Evento<i class="fas fa-chevron-right"></i></a>
                                        @endif
                                    @else
                                        <a href="{{route('shopping-cart.store', [Auth::user()->membership_id, 'membresia', 'Mensual'])}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Renovar Membresía</a>
                                    @endif
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div> 

@endsection
