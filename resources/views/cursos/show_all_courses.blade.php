@extends('layouts.landing')
@push('scripts')
    <script>
        function loadMoreCoursesNew($accion){
            if ($accion == 'next'){
                var route = $(".btn-arrow-next").attr('data-route');
            }else{
                var route = $(".btn-arrow-previous").attr('data-route');
            }

            $.ajax({
                url:route,
                type:'GET',
                success:function(ans){
                    $("#new-courses-section").html(ans);
                }
            });
        }
    </script>
@endpush


@section('content')
    <div class="section-landing" style="background: linear-gradient(to bottom, #222326 50%, #1C1D21 50.1%);">
        <div class="col mb-4 mt-2">
            <div class="title-page-course col-md-12"><span class="text-white">
            <h2>Todos los Cursos</h2>
            </div>
        </div>

        <div class="row p-4">
            @if ($courses->count() > 0)
                @foreach ($courses  as $course)
                <div class="col-md-3 box-courses" style="margin-top: 20px;">
                        @if (!is_null($course->thumbnail_cover))
                        <img src="{{ asset('uploads/images/courses/covers/'.$course->thumbnail_cover) }}" class="card-img-top" alt="...">
                        @else
                        <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top" alt="...">
                        @endif
                        <div class="card-img-overlay course-overlay">
                        <div class="row ml-0 d-flex h-100 mr-1 ml-1">
                            <div class="col-md-10 my-auto  recomendados-title text-center p-0" style="margin-bottom: 7px !important">
                            <p class="col-sm w-100 text-center" style="font-size: 17px;"> <a href="" class="text-white"> {{ $course->title }}</a></p>
                            </div>
                            <div class="col-md-1 my-auto float-left p-0" style="margin-bottom: 7px !important">
                                <h6 class="text-white w-100">
                                    <i class="far fa-user-circle text-center">
                                        <p style="font-size: 10px;">{{ $course->users->count() }}</p>
                                    </i>
                                    
                                </h6>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="container-fluid">
                    <h3>
                        No se encontraron courses relacionados con la búsqueda...
                    </h3>
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center paginador">
            {{ $courses->links("pagination::bootstrap-4") }}
        </div>


        {{-- SECCIÓN REFERIDOS (USUARIOS LOGGUEADOS) --}}
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
@endsection
