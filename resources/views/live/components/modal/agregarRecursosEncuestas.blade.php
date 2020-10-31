<!-- Modal Agregar recursos encuesta -->
<div class="modal fade" id="modal-settings-survey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Encuesta</h5>
            </div>
            <form id="formQuestion">
                {{ csrf_field() }}
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="list_question">
                                    <div class="form-group">
                                        <label>Escribe la pregunta #1</label>
                                        <textarea required class="form-control fieldQuestion" name="q1"
                                            id="q1"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Escribe la respuesta</label>
                                        <textarea required class="form-control fieldSurvey" name="r1"
                                            id="r1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a title="Agregar una respuesta más" class="btn btn-success btn-circle addResponse"><i
                                        class="fa fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="type" value='survey' required>
                    <input type="hidden" name="questions" class="questionsArray">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success sendFormQuestion" id="store_survey_submit">Enviar</button>
                    <button class="btn btn-success" type="button" disabled id="store_survey_loader" style="display: none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Espere...
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
