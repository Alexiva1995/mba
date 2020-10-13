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