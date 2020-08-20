<div class="row">
            <div class="col">
                <div class="section-title-landing new-courses-section-title">LOS MÁS NUEVOS</div>
            </div>
            <div class="col text-right">
                 <button type="button" class="btn btn-outline-light btn-arrow btn-arrow-previous" @if ($previous == 0) disabled @endif data-route="{{ route('landing.load-more-courses-new', [$idStart, 'previous'] ) }}"  onclick="loadMoreCoursesNew('previous');"><i class="fas fa-chevron-left"></i></button>
                <button type="button" class="btn btn-outline-success btn-arrow btn-arrow-next" @if ($next == 0) disabled @endif data-route="{{ route('landing.load-more-courses-new', [$idEnd, 'next'] ) }}"  onclick="loadMoreCoursesNew('next');"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
               
        <div class="row" style="padding: 10px 30px;">
            @foreach ($cursosNuevos as $cursoNuevo)
                <div class="col">
                    <div class="card" >
                        @if (!is_null($cursoNuevo->cover))
                            <img src="{{ asset('uploads/images/courses/covers/'.$cursoNuevo->cover) }}" class="card-img-top new-course-img" alt="...">
                        @else
                            <img src="{{ asset('uploads/images/courses/covers/default.jpg') }}" class="card-img-top new-course-img" alt="...">
                        @endif
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="mt-auto">
                                <div class="new-course-title">{{ $cursoNuevo->title }}</div>
                                <div class="row">
                                    <div class="col-12 col-xl-6 new-course-category">{{ $cursoNuevo->category->title }}</div>
                                    <div class="col-12 col-xl-6" style="font-size: 16px;">
                                        <div class="row row-cols-3">
                                            <div class="col text-right no-padding-sides">
                                                <i class="far fa-user-circle"></i><br>
                                                <span class="new-course-items-text">1310</span>
                                            </div>
                                            <div class="col text-center no-padding-sides">
                                                <i class="fas fa-share-alt"></i><br>
                                                <span class="new-course-items-text">869</span>
                                            </div>
                                            <div class="col text-left no-padding-sides">
                                                <i class="far fa-thumbs-up"></i><br>
                                                <span class="new-course-items-text">1242</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>