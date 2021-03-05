@extends('layouts.landing')

@push('styles')
    <style>
    .containerscale:hover{
        transform: scale(1.1);
        z-index: 9;
       }
    
    .aumento{
       font-weight: 700;
       font-size: 18px;
    }
    </style>
@endpush

@section('content')

<div class="container-fluid courses-slider" style="background-color: #1C1D21;margin-bottom: 0px; padding-bottom: 0px;">
    <div class="container-fluid courses-slider" style="padding-bottom: 0px;">
      <div id="mainSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item  active ">
              <div class="overlay"></div>
                  <img src="{{ asset('nosotros/nosotros/nosotros.jpg') }}" class="d-block w-100" alt="...">
                   <div class="carousel-caption">
                    <div class="col-md-5 offset-md-5">
                    <div class="estilobusiness">MY BUSINESS ACADEMY PRO</div>
                  </div>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>

<div class="col-md-12" style="background-color: #EDEDED;">
   <div class="col-md-8 offset-md-2" style="padding: 50px 50px; text-align: center;">
  <h4>Es la mejor academia online de educación financiera y negocios, dirigida a las personas que quieran convertirse en inversionistas PRO</h4>
   </div>
  </div>


  <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
            <div class="col-md-6" style="background-color: #2A91FF; color: #fff; padding: 40px !important;">
                <div class="card-body">
                     <!--<h5 class="card-title" style="font-size: 40px; text-align: center;">MÁS ALLÁ DE LA RIQUEZA</h5>
                     <p class="card-text" style="text-align: center;">Te hacemos crecer personalmente con mucho contenido de desarrollo personal.</p>-->
                     <h4 class="m-4 card-title align-items-center d-flex justify-content-center" style="text-align: center;">Te hacemos crecer personal y profesionalmente con mucho contenido de valor que te ayudará a cumplir tus objetivos.</h4>
                </div>
            </div>
                <div class="col-md-6" style="min-height: 300px; background-image: url('{{ asset('nosotros/nosotros/02.jpg') }}'); background-size: cover; background-position: top;">
                </div>
        </div>
    </div>

  <div class="col-md-12" style="background-color: #1C1D21; margin-bottom: 40px;">
    <div class="col-md-8 offset-md-2" style="margin-top: 50px;">
      <div class="card" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
            <div class="col-md-8 nosotros-text" style="background-color: white; text-align: center; ">
              <p class="mt-2" style="padding: 30px 30px; font-weight: 400; font-size: 17px;">Te ofrecemos variedad en temas en formato de microlecciones que te ayudarán a aprender mucho mejor.</p>
            </div>
             <div class="col-md-4" style="min-height: 200px; background-image: url('{{ asset('nosotros/nosotros/04.jpg') }}'); background-size: cover; background-position: top;">
            </div>
        </div>
      </div>

      <div class="card" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
           <div class="col-md-4">
              <img src="{{ asset('nosotros/nosotros/05.jpg') }}" class="card-img" alt="...">
           </div>
          <div class="col-md-8 nosotros-text" style="background-color: #2A91FF;">
            <div class="card-body row align-items-center justify-content-center">
               <p class="card-text" style="padding: 30px 30px; font-weight: 400; font-size: 19px; color: white;">Contamos con 3 tipos de membresías con contenido especializado para SER - HACER - TENER y TRASCENDER asi como 5 niveles de aprendizaje para medir tu crecimiento en cada uno.</p>
            </div>
          </div>
         </div>
       </div>


       <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
          <div class="col-md-8 nosotros-text" style="background-color: #fff;">
            <div class="card-body row align-items-center">
               <p class="card-text" style="padding: 30px 30px; font-weight: 400; font-size: 19px;">Facilitamos el contenido en los dos idiomas más hablados del mundo entero (inglés y español) además conramos con la traducción por subtítulos en otros más de 10 idiomas.</p>
            </div>
          </div>
           <div class="col-md-4">
              <img src="{{ asset('nosotros/nosotros/06.jpg') }}" class="card-img" alt="...">
           </div>
         </div>
       </div>


       <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
           <div class="col-md-4">
              <img src="{{ asset('nosotros/nosotros/07.jpg') }}" class="card-img" alt="...">
           </div>
          <div class="col-md-8 nosotros-text" style="color: #fff; background-color: #2A91FF;">
            <div class="card-body row align-items-center">
               <p class="card-text" style="padding: 30px 30px; font-weight: 400; font-size: 17px;">Acceso permanente - 24hrs. / 7 días a la semana - 365 días con mucho material didactico modulo especial y cuidadosamente para asegurarnos de tu aprendizaje continuo asi como acompañamiento de multiples clases en vivo todas las semanas </p>
            </div>
          </div>
         </div>
       </div>

    </div>
</div>
<div class="col-md-12 py-5" style="background-color: #FFFFFF;">
        <div class="section-title-landing new-courses-section-title mb-2" style="text-align: center;">
                <h2 style="font-weight: 800; font-size: 40px;">NUESTROS VALORES</h2>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="containerscale">
                    <div class="card m-2">
                            <img class="rounded-circle" src="{{ asset('nosotros/nosotros/09.jpg') }}" alt="Card image"  width="160px" height="160px">
                            <div class="card-img-overlay d-flex flex-column">
                                    <h6 class="text-white my-auto text-center aumento">Conexión</h6>
                            </div>
                    </div>
            </div>
            <div class="containerscale">
                <div class="card m-2">
                        <img class="rounded-circle" src="{{ asset('nosotros/nosotros/10.jpg') }}" alt="Card image"  width="160px" height="160px">
                        <div class="card-img-overlay d-flex flex-column">
                                <h6 class="text-white my-auto text-center aumento">Innovación</h6>
                        </div>
                </div>
            </div>
            <div class="containerscale">
                <div class="card m-2">
                        <img class="rounded-circle" src="{{ asset('nosotros/nosotros/08.jpg') }}" alt="Card image"  width="160px" height="160px">
                        <div class="card-img-overlay d-flex flex-column">
                                <h6 class="text-white my-auto text-center aumento">Crecimiento</h6>
                        </div>
                </div>
            </div>
            <div class="containerscale">
                <div class="card m-2">
                        <img class="rounded-circle" src="{{ asset('nosotros/nosotros/11.jpg') }}" alt="Card image"  width="160px" height="160px">
                        <div class="card-img-overlay d-flex flex-column">
                                <h6 class="text-white my-auto text-center aumento">Calidad</h6>
                        </div>
                </div>
            </div>
            <div class="containerscale">
                <div class="card m-2">
                        <img class="rounded-circle" src="{{ asset('nosotros/nosotros/12.jpg') }}" alt="Card image"  width="160px" height="160px">
                        <div class="card-img-overlay d-flex flex-column">
                                <h6 class="text-white my-auto text-center aumento">Eficacia</h6>
                        </div>
                </div>
            </div>
            <div class="containerscale">
                <div class="card m-2">
                        <img class="rounded-circle" src="{{ asset('nosotros/nosotros/13.jpg') }}" alt="Card image"  width="160px" height="160px">
                        <div class="card-img-overlay d-flex flex-column">
                                <h6 class="text-white my-auto text-center aumento">Trascendencia</h6>
                        </div>
                </div>
            </div>
        </div>
</div>

   <div class="container-fluid img-background-razones" style="padding:50px;">
      <div class="col-md-8 offset-sm-0 offset-md-2 mb-4">
         <h3 class="text-center"><b style="color: #2A91FF; font-weight: 800; font-size: 40px;">NUESTRO ECOSISTEMA</b></h3>
      </div>

      <div class="row">
         <div class="col-md-3 align-self-start mt-2 pt-4">
            <img src="{{ asset('nosotros/nosotros/mta.png') }}" class="card-img img-fluid logo-scale" alt="...">
            <img src="{{ asset('nosotros/nosotros/fentix-1.png') }}" class="mt-5 pt-5 card-img img-fluid logo-scale" alt="...">
            <img src="{{ asset('nosotros/nosotros/revolutte.png') }}" class="card-img img-fluid logo-scale mt-5 pt-5" alt="..." style="width: 200px;">
         </div>
         <div class="col align-self-center mt-2">
            <img src="{{ asset('nosotros/nosotros/world-mba.png') }}" class="card-img img-fluid logo-rotate" alt="...">
         </div>
         <div class="col-md-3 mt-2 pt-4">
          <img src="{{ asset('nosotros/nosotros/ftxlive.png') }}" class="card-img img-fluid logo-scale" alt="...">
          <img src="{{ asset('nosotros/nosotros/no-work-1.png') }}" class="card-img img-fluid logo-scale mt-5 pt-5" alt="...">
          <img src="{{ asset('nosotros/nosotros/revolutte-real-state.png') }}" class="card-img img-fluid logo-scale mt-5 pt-5" alt="..." style="width: 200px;">
         </div>
         <div class="col-md-12 text-center">
           <img src="{{ asset('nosotros/nosotros/revolutte-insurance.png') }}" class="card-img img-fluid logo-scale mt-3" alt="..." style="width: 200px;">
         </div>
      </div>
   </div>


    <!--<div class="col-md-12" style="background-color: #FFFFFF;">
     <div class="section-title-landing new-courses-section-title" style="text-align: center; padding-bottom: 0px; padding-top: 50px;">
      Nuestros Valores
    </div>


     <div class="col-md-8 offset-md-2" style="padding: 40px; padding-top: 40px;">
      <div class="card mb-3">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('nosotros/nosotros/09.jpg') }}" style="max-width: 100%;" class="rounded-circle  w-75">
              <div class="card-img-overlay d-flex flex-column no-margin no-padding" style="color: #fff; text-align: center;">
                    <div class="my-auto w-75">
                        <div class="new-course-title">
                            <h5>Conexión</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('nosotros/nosotros/10.jpg') }}" style="max-width: 100%;" class="rounded-circle w-75">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
                    <div class="my-auto w-75">
                        <div class="new-course-title">
                            <h5>Innovación</h5>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                 <img src="{{ asset('nosotros/nosotros/08.jpg') }}" style="max-width: 100%;" class="rounded-circle w-75">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
                    <div class="my-auto w-75">
                        <div class="new-course-title">
                            <h5>Crecimiento</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div class="card mb-3" style="max-width: 100%;">
        <div class="row">
            <div class="col-md-4">
              <img src="{{ asset('nosotros/nosotros/11.jpg') }}" style="max-width: 100%;" class="rounded-circle w-75">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
                    <div class="my-auto w-75">
                        <div class="new-course-title">
                            <h5>Calidad</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
              <img src="{{ asset('nosotros/nosotros/12.jpg') }}" style="max-width: 100%;" class="rounded-circle w-75">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
                    <div class="my-auto w-75">
                        <div class="new-course-title">
                            <h5>Eficacia</h5>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
              <img src="{{ asset('nosotros/nosotros/13.jpg') }}" style="max-width: 100%;" class="rounded-circle w-75">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
                    <div class="my-auto w-75">
                        <div class="new-course-title">
                            <h5>Trascendencia</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

  </div>
</div>-->


<div class="col-md-12" style="background-color: #1C1D21;">
     <div class="section-title-landing new-courses-section-title" style="text-align: center; padding: 30px; color: #2A91FF;">
      <h2 style="font-weight: 800; font-size: 40px;">NUESTROS FUNDADORES</h2>
    </div>

    <div class="card" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
            <div class="col-md-6">
              <img src="{{ asset('nosotros/fundadores/josegordo.jpg') }}" style="width: 100%;">
            </div>
            <div class="col-md-6 align-items-center d-flex justify-content-center" style="color: #fff; background-color: #1c1d21;">
            <div class="card-body">

                <h2 class="card-title" style="text-align: right; color: #2A91FF; font-size: 35px; font-weight: bold;">
                    JOSÉ GORDO
                </h2>

               <p class="card-text align-items-center d-flex justify-content-center" style="font-weight: 500; font-size: 19px; line-height: 1.6em; color: #2A91FF; text-align: right;">
                Especialista en desarrollo de negocios rentables, sostenibles y de expansión global.
               </p>
               <p class="card-text align-items-center d-flex justify-content-center" style="text-align: right; line-height: 30px; font-weight: 500; font-size: 19px;">
                15 años de experiencia en el mundo financiero, eterno aprendiz y emprendedor, amante de las finanzas, la innovación, y los proyectos de impacto social. Con la experiencia ganada a través los años y su pasión por el desarrollo personal y profesional de sus equipos de trabajo, ha creado diferentes técnicas de entrenamientos altamente efectivo, además de ser escritor y autor de 4 libros de negocios, 2 best seller. Fundador y Co-creador de My Business Academy Pro, así como de Piense y Hágase Rico, El Legado. Su compromiso es dejar huella en todo país que pise y persona que lo acompañe</p>
            </div>
          </div>
        </div>
    </div>


    <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important;">
        <div class="row no-gutters">
          <div class="col-md-6 align-items-center d-flex justify-content-center" style="color: #fff; background-color: #1c1d21;">
          <div class="card-body">

              <p class="card-title" style="text-align: left; color: #2A91FF; font-size: 35px; font-weight: bold;">
                    TANIA TOSTADO
                </p>

               <p class="card-text align-items-center d-flex justify-content-center" style="text-align: left; line-height: 30px; font-weight: 500; font-size: 19px;">
                Licenciada en Administración financiera con especialidad en finanzas corporativas, ha colaborado con bancos de talla mundial como: UBS, Credit Suisse y Deutche Bank en Suiza, Bank Hapoalim en Israel, Baern Stearns Securities en EUA, entre muchos otros. En 2008, fue ganadora del premio Best Development, otorgado por la International Property Awards y CNBC. Como consultora independiente, asesora a múltiples y reconocidas empresas en latinoamérica para hacer importantes transacciones con cifras de millones de dólares.</p>
            </div>
           </div>
            <div class="col-md-6">
              <img src="{{ asset('nosotros/nosotros/16.jpg') }}" style="width: 100%;">
            </div>
          </div>
        </div>
    </div>


    <div class="col-md-12" style="background-color: #EDEDED;">
     <div class="section-title-landing new-courses-section-title" style="text-align: center; padding: 30px; color: #2A91FF;">
      <h2 style="font-weight: 800; font-size: 40px;">NUESTROS ESPECIALISTAS</h2>
    </div>

<div class="col-md-10 offset-md-1">

    <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important;  margin-top: 80px;">
        <div class="row no-gutters">
          <div class="col-md-8" style="background-color: #EDEDED;">
              <div class="card-body">

               <p class="card-text" style="color: #2A91FF; font-size: 35px; font-weight: bold;">Erick Reynaga</p>

               <p class="card-text" style="text-align: left; line-height: 30px; font-weight: 500; font-size: 19px;">Especialista con 6 años de experiencia en el mundo del Trading, Forex y las Criptodivisas, así como de fondos de inversión con marcas de reconocimiento internacional. Cuenta con una maestría en administración y negocios, es líder de proyectos educativos financieros para diferentes cúpulas de negocios de jóvenes empresarios en México y es promotor de una Sociedad Financiera de Operación Múltiple en la que se operan diversas transacciones con crypto.</p>
            </div>
          </div>
          <div class="col-md-4" style="background-color: #EDEDED;">
              <img src="{{ asset('nosotros/nosotros/17.jpg') }}" class="card-img" alt="...">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
               <div class="mt-auto">
                  <div class="new-course-title" style="background-color: #333; padding: 8px; float: left; color: #2A91FF;">
                    Erick Reynaga
                  </div>
                </div>
             </div>
           </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important; margin-top: 80px;">
        <div class="row no-gutters">
           <div class="col-md-4" style="background-color: #EDEDED;">
              <img src="{{ asset('nosotros/nosotros/18.jpg') }}" class="card-img" alt="...">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
               <div class="mt-auto">
                  <div class="new-course-title" style="background-color: #333; padding: 8px; float: right; color: #2A91FF;">
                    Mirela Vuckovic
                  </div>
              </div>
             </div>
           </div>
          <div class="col-md-8" style="background-color: #EDEDED;">
            <div class="card-body">

                <p class="card-text" style="color: #2A91FF; font-size: 35px; font-weight: bold;"> Mirela Vuckovic</p>

               <p class="card-text" style="text-align: left; line-height: 30px; font-weight: 500; font-size: 19px;">Lic. en Economía por la University of Split de Croacia. Colaboró en Londres para importantes marcas de offshore banking. En México tiene 12 años como consultora directiva de reconocidas empresas Fintech en todo Latam. Así como instructora de diversos programas académicos con diferentes marcas de la industria financiera.</p>
            </div>
          </div>
        </div>
    </div>


    <div class="card mb-3" style="max-width: 100%; margin-bottom: 0rem!important; padding-bottom: 20px; margin-top: 80px;">
        <div class="row no-gutters">
          <div class="col-md-8" style="background-color: #EDEDED;">
              <div class="card-body">

                <p class="card-text" style="color: #2A91FF; font-size: 35px; font-weight: bold;"> Manuel Guerrero Aguilar</p>

               <p class="card-text" style="text-align: left; line-height: 30px; font-weight: 500; font-size: 19px;">Lic. en administración Financiera, apasionado del conocimiento y la aplicación de la tecnología en los mercados financieros, desde muy joven se ha interesado por explorar y promover temas de inversiones, forex, trading, IA, entre otros.</p>
            </div>
          </div>
          <div class="col-md-4" style="background-color: #EDEDED;">
              <img src="{{ asset('nosotros/nosotros/19.jpg') }}" class="card-img" alt="...">
              <div class="card-img-overlay d-flex flex-column" style="color: #fff; text-align: center;">
               <div class="mt-auto">
                  <div class="new-course-title" style="background-color: #333; padding: 8px; color: #2A91FF; float: left;">
                    Manuel Guerrero Aguilar
                  </div>
                </div>
             </div>
           </div>
        </div>
    </div>

</div>

   </div>

@endsection
