@extends('layouts.dashboardnew')
@section('content')
<div class="col-12">
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title white">
                    @if ( request()->ref != null )
                    @php
                    $referred = DB::table($settings->prefijo_wp.'users')
                    ->select('display_name')
                    ->where('ID', '=', request()->ref)
                    ->first();
                    @endphp
                    @if ($referred != null)
                    <p>Registro Referido por: <strong>{{  $referred->display_name }}</strong>
                    </p>
                    @endif
                    @endif
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="alert alert-danger" style="display: none;" id="errorEdad">
                <span><strong>¡¡Debe ser mayor de edad para registrarse!!</strong></span>
            </div>
            {{-- fin mensajes --}}

            <!-- form start -->
            <form class="login-form" method="POST" action="{{ route('autenticacion.save-register') }}" enctype="multipart/form-data">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title white">
                                        Información General
                                    </h3>
                                </div>
                                <div class="box-body">

                                    <input type="hidden" name="tip" value="1">


                                    @if(!empty(request()->select))
                                    <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Tipo de Usuario (*)</label>
                                       <select class="form-control" name="rango" id="idrang" onchange="avataresMentor()">
                                        <option value="" selected disabled>Seleccion una opcion</option>
                                        <option value="0">Administrador</option>
                                        <option value="1">Moderador</option>
                                        <option value="2">Mentor</option>
                                        <option value="3">Cliente</option>
                                       </select>
                                    </div>
                                    @endif

                                    <div style="display: none;" id="imagenavatar">

                                      <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Nombre (*)</label>
                                            <input type="text" class="form-control" name="firstname">
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Apellido (*)</label>
                                            <input type="text" class="form-control" name="lastname">
                                      </div>
                                        
                                      <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Imagen de Usuario (*)</label>
                                            <input type="file" name="avatar">
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Descripción(*)</label>
                                           <input class="form-control" type="textarea" name="profession">
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Biografía(*)</label>
                                           <textarea class="form-control" type="textarea" name="contenido"> </textarea>
                                      </div>
                                    </div>
                                    </div>

                                    @foreach($campos as $campo)
                                    @if($campo->tip == 0 || $campo->tip == 1)
                                    @if($campo->tipo == 'select')
                                    <div class="form-group">
                                        <label class="white" for="">{{$campo->label}}
                                            {{($campo->requerido == 1) ? '(*)' : '(Opcional)'}}</label>
                                        <select class="form-control select2" name="{{$campo->nameinput}}"
                                            {{($campo->requerido == 1) ? 'required' : ' '}}>
                                            <option value="" disabled selected>Selecciones una opcion</option>
                                            @foreach($valoresSelect as $valores)
                                            @if ($valores['idselect'] == $campo->id)
                                            <option value="{{$valores['valor']}}">{{$valores['valor']}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif($campo->tipo == 'number')
                                    <div class="form-group">
                                        <label class="white" for="">{{$campo->label}}
                                            {{($campo->requerido == 1) ? '(*)' : '(Opcional)'}}</label>
                                        <input class="form-control " step="1" type="{{$campo->tipo}}"
                                            name="{{$campo->nameinput}}"
                                            min="{{(!empty($campo->min)) ? $campo->min : ''}}"
                                            max="{{(!empty($campo->max)) ? $campo->max : ''}}"
                                            {{($campo->requerido == 1) ? 'required' : ' '}}
                                            value="{{old($campo->nameinput)}}">
                                    </div>
                                    @else
                                    @if($campo->input_edad == 1)
                                    <div class="form-group">
                                        <label class="white" for="">{{$campo->label}}
                                            {{($campo->requerido == 1) ? '(*)' : '(Opcional)'}}</label>
                                        <input class="form-control " type="{{$campo->tipo}}"
                                            name="{{$campo->nameinput}}" value="{{old($campo->nameinput)}}"
                                            onblur="validarEdad(this.value)"
                                            {{($campo->requerido == 1) ? 'required' : ' '}}>
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label class="white" for="">{{$campo->label}}
                                            {{($campo->requerido == 1) ? '(*)' : '(Opcional)'}}</label>
                                        <input class="form-control " type="{{$campo->tipo}}"
                                            name="{{$campo->nameinput}}" value="{{old($campo->nameinput)}}"
                                            minlength="{{(!empty($campo->min)) ? $campo->min : ''}}"
                                            maxlength="{{(!empty($campo->max)) ? $campo->max : ''}}"
                                            {{($campo->requerido == 1) ? 'required' : ' '}}
                                            >
                                    </div>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach


                                    <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Correo Electrónico
                                            (*)</label>
                                        <input class="form-control"
                                            type="text" autocomplete="off" name="user_email" required
                                            style="background-color:f7f7f7;" oncopy="return false"
                                            onpaste="return false" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title white">
                                        Información para el Acceso de la pagina
                                    </h3>
                                </div>
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Contraseña
                                            (*)</label>
                                        <input class="form-control form-control-solid placeholder-no-fix form-group"
                                            type="password" autocomplete="off" name="password" required
                                            style="background-color:f7f7f7;" oncopy="return false"
                                            onpaste="return false" />
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" style="text-align: center; color: white;">Confirmación de
                                            Contraseña (*)</label>
                                        <input class="form-control form-control-solid placeholder-no-fix form-group"
                                            type="password" autocomplete="off" name="password_confirmation" required
                                            style="background-color:f7f7f7;" oncopy="return false"
                                            onpaste="return false" />
                                    </div>


                                    @if (request()->ref == null)
                                    <div class="form-group">
                                        <div class="alert alert-info">
                                            <button class="close" data-close="alert"></button>
                                            <span>
                                                Si no sabes cual es el ID de su Patrocinador, por favor Coloque el 1
                                            </span>
                                        </div>

                    <label class="control-label" style="text-align: center;">ID Patrocinador (*)</label>
            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" required pattern="[0-9]*"
                autocomplete="off" name="referred_id" style="background-color:f7f7f7;" oncopy="return false"
                onpaste="return false" />

                                    </div>

                                    @else
                                    <div class=" form-group">
                                        <label class="white" for="">ID Patrocinador (opcional)</label>
                                        <input type="number" class="form-control" name="referred_id" value="{{ request()->ref }}">
                                    </div>
                                    @endif

                                    {{-- no binario --}}
                                    @if ($settingEstructura->tipoestructura != 'binaria')
                                     @if($settings->posicionamiento == 0)
                                    <div class="form-group">
                                        <label class="control-label" style="text-align: center;">ID Posicionamiento
                                            (Opcional)</label>
                                        <input class="form-control form-control-solid placeholder-no-fix form-group"
                                            type="number" autocomplete="off" name="position_id"
                                            style="background-color:f7f7f7;" oncopy="return false"
                                            onpaste="return false" />
                                    </div>
                                     @endif
                                    @else

                                    @if (!empty(request()->lado))
                                    <input type="hidden" name="ladomatriz" value="{{request()->lado}}" />
                                    @endif

                                    @if(empty(request()->lado))
                                    {{-- binario --}}
                                        <div class=" form-group">
                                            <label class="white" for="">Lado a Ingresar (*)</label>
                                            <select class="form-control " name="ladomatriz" required>
                                                <option value="" disabled selected>Selecciones una opcion</option>
                                                <option value="D">Derecha</option>
                                                <option value="I">Izquierda</option>
                                            </select>
                                        </div>
                                        @endif
                                    @endif


                                    @if (empty(request()->tipouser))
                                    <input type="hidden" name="tipouser" value="Normal" />
                                    @else
                                    <input type="hidden" name="tipouser" value="{{ request()->tipouser }}" />
                                    @endif
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terms" class="custom-control-input"
                                                id="customCheck1" {{ old('terms') ? 'checked' : '' }}>
                                            <label class="custom-control-label white" for="customCheck1">He leído, Acepto
                                                los terminos y condiciones</label>
                                        </div>
                                        <a href="{{route('terms-and-conditions')}}" target="_black">
                                            Visualizar terminos y condiciones</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-danger col-sm-6" href="{{ url('/') }}">Cancelar</a>
                    <button class="btn btn-info col-sm-6" type="submit" id="btn">Registrarme</button>
                </div>
            </form>
        </div>
    </div>
    {{-- footer --}}
    <div class="login-footer">
        <div class="row bs-reset">
            <div class="col-xs-12 bs-reset">
                <div class="login-copyright text-center">
                    <p>2019 © Sineval MLM 13.0 - Desarrollado por <a target="_blank"
                            href="https://sinergiared.com/">Sinergia</a> & Valdusoft</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>

    function validarEdad(edad) {
        var hoy = new Date();
        var cumpleanos = new Date(edad);

        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        if (edad < {{$settings->edad_minino}} ) {
            document.getElementById("btn").disabled = true;
            document.getElementById("errorEdad").style.display = 'block';
        } else {
            document.getElementById("btn").disabled = false;
            document.getElementById("errorEdad").style.display = 'none';
        }
    }


    function avataresMentor(){

    var opt = $('#idrang').val();

    if(opt == "2"){
        $('#imagenavatar').show();
        }else{
            $('#imagenavatar').hide();
        }
    }

</script>
@endpush
