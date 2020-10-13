<!-- Modal Agregar recursos presentation -->
<div class="modal fade" id="modal-settings-presentation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Presentación</h5>
            </div>
            <form action="{{ route('set.event.store', [$event->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Seleccione la presentación</label>
                                    <input type="file" class="form-control" name="presentation" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value='presentation' required>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
