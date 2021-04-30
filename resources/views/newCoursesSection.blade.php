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
                    <img src="{{ asset('uploads/images/courses/covers/'.$cursoNuevo->thumbnail_cover) }}" class="card-img-top new-course-img" alt="...">
                @else
                    <img src="{{ asset('uploads/images/courses/covers/default.png') }}" class="card-img-top new-course-img" alt="...">
                @endif
                <div class="card-img-overlay d-flex flex-column course-overlay">
                    <div class="mt-auto">
                        <div class="section-title-landing text-white" style="line-height:1;">{{ $cursoNuevo->title }}</div>
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
