@extends('layouts.dashboardnew')

@section('content')


<div class="col-xs-12">
    <br><br><br>
    <div><h1 class="text-center text-primary font-weight-bold">Base de Conocimiento</h1></div><br><br><br><br>

    <div class="col-md-offset-2">
            <div class="form-group col-md-9" style="background:#4b646f!imporntant; border:none;">
                <form action="{{route('admin.soporte.search.questions')}}" method="GET">
                 <div class="input-group">
                      <div class="input-group-addon" style="background:none; border:none;">
                        <button class="btn btn-none border-0" type="submit" style="background:none!important;"><i class="fa fa-search fa-2x white" aria-hidden="true"></i></button>
                      </div>
                      
                          <input type="text" placeholder="Busca tu pregunta" class="question-search form-control social white" id="question-search" value="" name="question-search">     
                </div>
                </form>
            </div>
    </div>
    <br><br><br><br><br><br>

    <div class="col-md-offset-2">
                <div class="row">
                        <div class="col-md-3 cajita centroc"><a href="{{route('admin.soporte.search.frecuent_questions')}}" class="white"><h3 style="font-size:18px!important; font-weight:bold;"><i class="far fa-comments text-primary"></i>Preguntas frecuentes</h3></a></div>
                <div class="col-md-3 cajita centroc"><a href="{{route('soporte.academy')}}" class="white"><h3 style="font-size:18px!important; font-weight:bold;"><i class="fas fa-graduation-cap text-primary"></i>Academia</h3></a></div>
                        <div class="col-md-3 cajita centroc"><a href="{{ route ('admin.soporte.affiliates')}}" class="white"><h3 style="font-size:18px!important; font-weight:bold;"><i class="fas fa-user-plus text-primary"></i>Afiliados</h3></a></div>

                </div>
    </div>

</div>

@endsection
