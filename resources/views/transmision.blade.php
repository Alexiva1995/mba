@extends('layouts.landing')

@section('content')
                
                
               <div style="width: 100%; position: relative; display: inline-block;">
                    <img src="{{ asset('images/banner_completo.png') }}" alt="" style="height: 500px; width:100%; opacity: 0.5;">
                    <div style="position: absolute; top: 2%; left: 5%;">
                        <div style="color: white; font-size: 70px; font-weight: bold;">
                            <a style="font-weight: bold; width: 180px; font-size: 28px; color: #2A91FF;">PRÓXIMO STREAMING</a><br>
                            
                            <div style="width: 60%; line-height: 70px;">
                                Lorem ipsum up dolor sit amet
                            </div> 
                            <div style="font-size: 25px; font-weight: 500;">
                                <i class="fa fa-calendar"></i> Sábado 25 de Julio
                                <i class="fa fa-clock"></i> 6:00 pm
                            </div>
                            <div style="font-size: 35px; padding-top: 60px;">
                                <a href="" style="color: #6fd843;">Reservar Plaza <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div><br><br>
                
                
                
                
            <div class="section-landing" style="background: linear-gradient(to bottom, #222326 50%, #1C1D21 50.1%);">
                    
                        <div class="col">
                            <div class="section-title-landing" style="padding-bottom: 35px;">PRÓXIMAS TRANSMISIONES EN VIVO</div>
                        </div>

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                     <div class="carousel-inner">

                       <div class="carousel-item active">
                         <div class="row">

                           <div class="col-md-4" style="margin-top: 20px;">
                             <img src="{{ asset('vivo/1.png') }}" class="card-img-top" alt="..." style="height: 320px;">
                             <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                              <h3 class="card-title" style="margin-top: 190px; color: #2A91FF;">Nombre del Live</h3>
                              <p class="card-text" style="margin-top: -10px; font-size: 10px;"> <i class="far fa-calendar" style="font-size: 18px;"></i> Sabado 25 de Julio 

                              <i class="far fa-clock" style="font-size: 18px;"></i> 6:00 Pm 

                               </p>

                              <a href="#" class="btn btn-success btn-block">Agendar</a>
                              </div>
                             </div>

                            <div class="col-md-4" style="margin-top: 20px;">
                             <img src="{{ asset('vivo/2.png') }}" class="card-img-top" alt="..." style="height: 320px;">
                             <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                              <h3 class="card-title" style="margin-top: 190px; color: #2A91FF;">Nombre del Live</h3>
                              <p class="card-text" style="margin-top: -10px; font-size: 10px;"> <i class="far fa-calendar" style="font-size: 18px;"></i> Sabado 25 de Julio 

                              <i class="far fa-clock" style="font-size: 18px;"></i> 6:00 Pm 

                               </p>

                              <a href="#" class="btn btn-success btn-block">Agendar</a>
                              </div>
                             </div>

                            <div class="col-md-4" style="margin-top: 20px;">
                             <img src="{{ asset('vivo/3.png') }}" class="card-img-top" alt="..." style="height: 320px;">
                             <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                              <h3 class="card-title" style="margin-top: 190px; color: #2A91FF;">Nombre del Live</h3>
                              <p class="card-text" style="margin-top: -10px; font-size: 10px;"> <i class="far fa-calendar" style="font-size: 18px;"></i> Sabado 25 de Julio 

                              <i class="far fa-clock" style="font-size: 18px;"></i> 6:00 Pm 

                               </p>

                              <a href="#" class="btn btn-success btn-block">Agendar</a>
                              </div>
                             </div>

                      </div>
                   </div>
                   
                   
                   
                   <div class="carousel-item">
                         <div class="row">

                           <div class="col-md-4" style="margin-top: 20px;">
                             <img src="{{ asset('vivo/1.png') }}" class="card-img-top" alt="..." style="height: 320px;">
                             <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                              <h3 class="card-title" style="margin-top: 190px; color: #2A91FF;">Nombre del Live</h3>
                              <p class="card-text" style="margin-top: -10px; font-size: 10px;"> <i class="far fa-calendar" style="font-size: 18px;"></i> Sabado 25 de Julio 

                              <i class="far fa-clock" style="font-size: 18px;"></i> 6:00 Pm 

                               </p>

                              <a href="#" class="btn btn-success btn-block">Agendar</a>
                              </div>
                             </div>

                            <div class="col-md-4" style="margin-top: 20px;">
                             <img src="{{ asset('vivo/2.png') }}" class="card-img-top" alt="..." style="height: 320px;">
                             <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                              <h3 class="card-title" style="margin-top: 190px; color: #2A91FF;">Nombre del Live</h3>
                              <p class="card-text" style="margin-top: -10px; font-size: 10px;"> <i class="far fa-calendar" style="font-size: 18px;"></i> Sabado 25 de Julio 

                              <i class="far fa-clock" style="font-size: 18px;"></i> 6:00 Pm 

                               </p>

                              <a href="#" class="btn btn-success btn-block">Agendar</a>
                              </div>
                             </div>

                            <div class="col-md-4" style="margin-top: 20px;">
                             <img src="{{ asset('vivo/3.png') }}" class="card-img-top" alt="..." style="height: 320px;">
                             <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                              <h3 class="card-title" style="margin-top: 190px; color: #2A91FF;">Nombre del Live</h3>
                              <p class="card-text" style="margin-top: -10px; font-size: 10px;"> <i class="far fa-calendar" style="font-size: 18px;"></i> Sabado 25 de Julio 

                              <i class="far fa-clock" style="font-size: 18px;"></i> 6:00 Pm 

                               </p>

                              <a href="#" class="btn btn-success btn-block">Agendar</a>
                              </div>
                             </div>

                      </div>
                   </div>
                </div>

                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                  </a>
                   <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                   <span class="sr-only">Next</span>
                   </a>
               </div>
            </div>   



    <div class="section-landing" style="background: linear-gradient(to bottom, #222326 50%, #1C1D21 50.1%);">
                    
       <div class="col">
          <div class="section-title-landing" style="padding-bottom: 35px; text-align:center;">TRANSMISIONES RECIENTES</div>
        </div> 
        
        <div class="form-row">
       
       <div class="col-md-2" style="font-size: 20px;">
        <label>ORDENAR POR:</label>
        </div>
        
        <div class="col-md-3">
        <select name="tipo" class="form-control" required style="height: calc(1.9em + .100rem + 2px); width: 80%; border: none; background-color: #1a1b1d; color: #2A91FF; font-size: 16px; font-weight: bold;
">
            <option value="1">MÁS VISTOS</option>
        </select>
        </div>    
        
    </div>      

         <div class="row">
            
            @for($i=1; $i<=12; $i++)
            <div class="col-md-3" style="margin-top: 20px;">
                <img src="{{ asset('vivo/reciente') }}{{$i}}.png" class="card-img-top" alt="..." style="height: 200px;">

                <div class="card-img-overlay" style="margin-left: 10px; margin-right: 10px;">
                   <h6 class="card-title">Nombre Apellido</h6>
                </div>

                <div class="card-body" style="background-color: #2f343a;">
                  <h6 class="card-title" style="margin-top: -15px;"> <i class="far fa-play-circle" style="font-size: 16px; color: #6fd843;"></i> Nombre del Curso</h6>

                  <h6 style="font-size: 10px; margin-left: 20px; margin-top: -10px;">Categoria</h6>
 
                  <h6 align="right" style="margin-bottom: -20px;"> 
                    <i class="icon fa fa-eye" style="font-size: 16px; margin-right: 10px;"><p style="font-size: 10px;">1310</p></i>
                    <i class="far fa-comment-alt" style="font-size: 16px; margin-right: 10px;"><p style="font-size: 10px;">346</p></i>
                    <i class="fas fa-share-alt" style="font-size: 16px; margin-right: 10px;"><p style="font-size: 10px;">862</p></i>
                    <i class="far fa-thumbs-up" style="font-size: 16px;"><p style="font-size: 10px;">1243</p></i>
                  </h6>
                </div>
            </div>
            @endfor
         </div>
    </div>
    
    
    @endsection