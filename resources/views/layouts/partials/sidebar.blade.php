@php
    $categoriasSidebar = \App\Models\Category::orderBy('id', 'ASC')->with('course')->get();

        $subcategoriasSidebar = \App\Models\Subcategory::orderBy('id', 'ASC')->get();
        $cursos = \App\Models\Course::orderBy('id', 'ASC')->get();
@endphp

<!-- Sidebar -->
            <div class="bg-dark-gray" id="sidebar-wrapper">
                <div class="sidebar-heading border-right" style="border-bottom: solid white 1px; height: 70px;">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{ asset('images/logo.png') }}" style="width: 40px; height: 40px;">
                        </div>
                        <div class="col-9">
                            <div style="color: white; font-size: 16px; font-weight: bold;">My Business</div>
                            <div style="color: white; font-size: 11px; ">A c a d e m y  p r o</div>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('index') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-home"></i> Home</a>
                    @if(Auth::user())
                        <a href="{{route('transmisiones')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-video"></i> Streaming</a>
                        <a href="{{ route('schedule.calendar') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-calendar"></i></i> Mis Eventos</a>
                        <a href="{{ route('courses') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-user-circle"></i> Cursos</a>
                        <a href="{{url('/admin')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-user"></i> Backoffice</a>
                    @endif
                     <a class="list-group-item bg-dark-gray" data-toggle="collapse" href="{{route('shopping-cart.membership')}}" style="color: white;"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Membresias</a>
                    <a class="list-group-item bg-dark-gray" data-toggle="collapse" href="#searchDiv" style="color: white;"><i class="fa fa-search"></i> Explorar</a>
                    <div class="collapse" id="searchDiv" style="padding-left: 10px; padding-right: 10px;">
                        <form action="{{ route('search') }}" method="GET" class="form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-2">
                            <input class="form-control form-control-sm w-75 border-0" type="text" placeholder="Buscar"
                            aria-label="Buscar" id="search" name="q" >
                            <button class="btn btn-none border-0" type="submit"><i class="fas fa-search text-white" aria-hidden="true"></i></button>
                            <!--<div class="input-group">
                                <input type="text" class="form-control" id="search" name="q" placeholder="Buscar...">
                                <button class="btn btn-light ml-auto"><i class="fas fa-search text-primary"></i></button>
                            </div>-->
                        </form>
                    </div>
                    <a href="{{ route('courses.show.all') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-border-all"></i> Ver todos los cursos</a>
                    <a class="list-group-item bg-dark-gray" data-toggle="collapse" href="#categoriesDiv" style="color: white;"><i class="far fa-list-alt"></i> Contenidos <i class="fas fa-angle-down"></i></a>
                    <div class="collapse" id="categoriesDiv" style="padding-left: 15px;">

                        @foreach ($categoriasSidebar as $categoria)

                            @if (!is_null($categoria->course))
                            <a class="list-group-item bg-dark-gray" href="{{ url ('courses/show/'.$categoria->course->slug.'/'.$categoria->course->id)}}" style="color: white;"><i class="{{ $categoria->icon }}"></i> {{ $categoria->title }} </a>
                            @else
                            <a class="list-group-item bg-dark-gray" href="{{ url ('courses/category/'.$categoria->id)}}" style="color: white;"><i class="{{ $categoria->icon }}"></i> {{ $categoria->title }} </a>
                            @endif


                            <!--<div class="collapse" id="subcategories-{{$categoria->id}}" style="padding-left: 15px;">
                                @foreach ($subcategoriasSidebar as $subcategoria)
                                    <a class="list-group-item bg-dark-gray" href="{{ route('search-by-category', [$categoria->slug, $categoria->id, $subcategoria->slug, $subcategoria->id]) }}" style="color: white;"><i class="far fa-circle"></i> {{ $subcategoria->title }} </a>
                                @endforeach
                            </div>-->
                        @endforeach

                        @foreach ($cursos as $curso)
                            <a class="list-group-item bg-dark-gray" href="{{ url ('courses/show/'.$curso->slug.'/'.$curso->id)}}" style="color: white;"><i class="text-primary fas fa-arrow-circle-right"></i> {{ $curso->title }} </a>
                            <div class="collapse" id="subcategories-{{$categoria->id}}" style="padding-left: 15px;">
                                @foreach ($subcategoriasSidebar as $subcategoria)
                                    <a class="list-group-item bg-dark-gray" href="{{ route('search-by-category', [$categoria->slug, $categoria->id, $subcategoria->slug, $subcategoria->id]) }}" style="color: white;"><i class="far fa-circle"></i> {{ $subcategoria->title }} </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    @if(Auth::user())
                     @if(Auth::user()->rol_id == 0)
                    <a href="{{route('setting-logo')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-gear"></i> Ajustes</a>
                     @endif
                    @endif
                    @guest
                    <a type="button" class="btn btn-primary btn-register-header d-md-block m-2" href="{{ route('log').'?act=1' }}">REGISTRARME</a> <!--/login-->
                    <a type="button" class="btn btn-primary btn-register-header d-md-block m-2" href="{{ route('log').'?act=0' }}">ENTRAR</a> <!--/login-->
                    @endguest
                    @if (!empty($settings->id_no_comision))
                    <div class="text-center p-2">
                        <img src="{{asset($settings->id_no_comision)}}" alt="" height="200" width="200">
                    </div>
                    @endif
                    <div class="text-center col pt-2">
                        <a href="https://m.facebook.com/MyBusinessAcademyPro/"><img class="m-2" src="{{ asset('images/icons/FBA.png') }}"></a>
                        <a href=""><img class="m-2" src="{{ asset('images/icons/TWA.png') }}"></a>
                         <a href="https://instagram.com/mybusinessacademypro?igshid=tdj5prrv1gx1"><img class="m-2" src="{{ asset('images/icons/IGA.png') }}"></a>
                        <a href=""><img class="m-2" src="{{ asset('images/icons/YTA.png') }}"></a>
                    </div>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->
