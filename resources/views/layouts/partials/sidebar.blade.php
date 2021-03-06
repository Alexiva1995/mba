@php
    $membershipsSidebar = \App\Models\Membership::with('categories')
                            ->orderBy('id', 'ASC')
                            ->get();

    $banner = NULL;
    if (request()->is('/')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Home')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('shopping-cart/memberships')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Membresias')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('courses/all')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Cursos')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('nosotrosblog')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Nosotros')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('gratis')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Gratis')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('blog')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Blog')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('transmisiones')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Streaming')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('courses')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Mis Cursos')
                        ->orderBy('id', 'DESC')
                        ->first();
    }else if (request()->is('calendar')){
        $banner = \App\Models\Banner::where('status', '=', 1)
                        ->where('page', '=', 'Mis Eventos')
                        ->orderBy('id', 'DESC')
                        ->first();
    }
    
@endphp

<!-- Sidebar -->
<div class="bg-dark-gray">
    <!--<div class="sidebar-heading border-right" style="border-bottom: solid white 1px; height: 70px;">
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('images/logo.png') }}" style="width: 40px; height: 40px;">
            </div>
            <div class="col-9">
                <div style="color: white; font-size: 16px; font-weight: bold;">My Business</div>
                <div style="color: white; font-size: 11px; ">A c a d e m y p r o</div>
            </div>
        </div>
        <img src="{{ asset('images/mbapro-completo.png') }}" style="width: auto; height: 45px;">
    </div>-->
    <div class="list-group list-group-flush list-sidebar">
        <a href="{{ route('index') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-home"></i> Home</a>
        @if(Auth::user())
        <a href="{{route('transmisiones')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-video"></i> Streaming</a>
        <a href="{{ route('schedule.calendar') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-calendar"></i> Mis Eventos</a>
        <a href="{{ route('courses') }}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-user-circle"></i> Mis Cursos</a>
        <a href="{{url('/admin')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-user"></i> Backoffice</a>
        @endif
        <a href="{{route('shopping-cart.membership')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-shopping-bag"></i> Membresias</a>
        <a class="list-group-item bg-dark-gray" data-toggle="collapse" href="#searchDiv" style="color: white;"><i class="fa fa-search"></i> Explorar</a>
        <div class="collapse" id="searchDiv" style="padding-left: 10px; padding-right: 10px;">
            <form action="{{ route('search') }}" method="GET" class="form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-2">
                <input class="form-control form-control-sm w-75 border-0" type="text" placeholder="Buscar" aria-label="Buscar" id="search" name="q">
                <button class="btn btn-none border-0" type="submit"><i class="fas fa-search text-white" aria-hidden="true"></i></button>
            </form>
        </div>
        

        <a class="list-group-item bg-dark-gray" data-toggle="collapse" href="#categoriesDiv1" style="color: white;"><i class="fas fa-graduation-cap"></i> Todos los cursos <i class="fas fa-angle-down"></i></a>
        <div class="collapse" id="categoriesDiv1" style="padding-left: 15px;">

            @foreach ($membershipsSidebar as $membershipSidebar)
                <a class="list-group-item bg-dark-gray" data-toggle="collapse" href="#membershipDiv{{$membershipSidebar->id}}" style="color: white;"><i class="fa fa-star"></i>  {{ strtoupper($membershipSidebar->name) }} <i class="fas fa-angle-down"></i> </a>

                <div class="collapse" id="membershipDiv{{$membershipSidebar->id}}" style="padding-left: 15px;">
                    @foreach($membershipSidebar->categories as $catSidebar)
                        <a class="list-group-item bg-dark-gray" href="{{ url('courses/category/'.$catSidebar->id) }}" style="color: white;"><i class="{{ $catSidebar->icon }}"></i> {{$catSidebar->title}}</a>
                    @endforeach
                </div>
            @endforeach
        </div> 
        <a href="{{route('legal')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fas fa-balance-scale"></i> Legal</a>
        @if(Auth::user())
            @if(Auth::user()->rol_id == 0)
                <a href="{{route('setting-logo')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-gear"></i> Ajustes</a>
            @endif
            <a href="{{ route ('soporte')}}" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Ayuda</a>
            
             <a class="list-group-item bg-dark-gray" style="color: white;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i> {{ __('Salir') }}
                    </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
            
        @endif
        <a href="#" id="menu-toggle2" class="list-group-item bg-dark-gray" style="color: white;"><i class="fa fa-arrow-left"></i> Ocultar</a>
        <a href="#" data-toggle="collapse" data-target="#social-networks" class="list-group-item bg-dark-gray" style="color: white;"><i class="far fa-thumbs-up"></i> Compartir</a>
        <div class="collapse show text-center" id="social-networks">
            <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//mybusinessacademypro.com/academia/" class="btn btn-social-media-icon btn-rounded facebook mt-2 mb-2" target="_blank"><i class="text-center fa fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text=https%3A//mybusinessacademypro.com/academia/" class="btn btn-social-media-icon btn-rounded twitter mt-2 mb-2" target="_blank"><i class="text-center fa fa-twitter"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//mybusinessacademypro.com/academia/&title=My%20Bussiness%20Academy%20Pro&summary=&source=" class="btn btn-social-media-icon btn-rounded linkedin mt-2 mb-2" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="mailto:?subject=My%20Bussiness%20Academy%20Pro&body=https%3A//mybusinessacademypro.com/academia/" class="btn btn-social-media-icon btn-rounded email-icon mt-2 mb-2" target="_blank"><i class="fas fa-envelope"></i></a>
        </div>
        @guest
            <center>
            <a type="button" class="btn btn-primary btn-register-header d-md-block m-2" href="{{ route('log').'?act=1' }}">REGISTRARME</a>
            <a type="button" class="btn btn-primary btn-register-header d-md-block m-2" href="{{ route('log').'?act=0' }}">ENTRAR</a></center>
        @endguest

        <div class="col-md-12 col-md-12 pt-3">
            <a href="https://m.facebook.com/MyBusinessAcademyPro/" target="_blank" class="btn float-right"><i class="text-white fa fa-facebook-f fa-1x"></i></a>
            <a href="https://twitter.com/GlobalMBApro" class="btn float-right" target="_blank"><i class="text-white fa fa-twitter fa-1x"></i></a>
            <a href="https://instagram.com/mybusinessacademypro?igshid=tdj5prrv1gx1" target="_blank" class="btn float-right"><i class="text-white fa fa-instagram fa-1x"></i></a>
            <a href="https://www.youtube.com/channel/UCQaLkVtbR6RK8HfhajFnikg" target="_blank" class="btn float-right"><i class="text-white fa fa-youtube fa-1x"></i></a>
            <a href="https://www.linkedin.com/in/my-business-academy-pro-1242481b2/" target="_blank" class="btn float-right"><i class="text-white fa fa-linkedin fa-1x"></i></a>
        </div>

        @if (!is_null($banner))
            <div class="text-center p-2">
                <img src="{{ asset('uploads/images/banners/'.$banner->image) }}" alt="" width="200" style="margin-top:80px">
            </div>
        @endif
        <!--@if (!empty($settings->id_no_comision))
            <div class="text-center p-2">
                <img src="{{asset($settings->id_no_comision)}}" alt="" width="200" style="margin-top:80px">
            </div>
        @endif-->
    </div>
</div>
<!-- /#sidebar-wrapper -->