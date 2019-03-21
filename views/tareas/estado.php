<div class="row">
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="state" value="1">
            <label class="form-check-label">
                <i class="f-20 fa fa-check-circle text-success"></i>
                Realizada
            </label>
        </div>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="state" value="2">
            <label class="form-check-label">
                <i class="f-20 fa fa-pause text-warning"></i>
                En espera
            </label>
        </div>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="state" value="3">
            <label class="form-check-label">
                <i class="f-20 fa fa-play-circle text-complete"></i>
                En proceso
            </label>
        </div>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="state" value="4">
            <label class="form-check-label">
                <i class="f-20 fa fa-times-circle text-danger"></i>
                Cancelada
            </label>
        </div>
    </div>
</div>
<div class="row pt-3">
    <div class="col-12">
        <div class="form-group">
            <textarea class="form-control" id="state_description" rows="3" placeholder="Información del avance"></textarea>
        </div>
    </div>
</div>
<div class="row pt-2">
    <div class="col-12">
        <div class="form-group float-right">
            <button class="btn btn-complete" id="save_state">Guardar</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped pt-3" id="state_history" style="display:none">
                <tr>
                    <td>Fecha</td>
                    <td>Responsable</td>
                    <td>Descripción</td>
                    <td>Estado</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        $.getScript(`${baseUrl}views/tareas/js/estado.js`);
    })
</script>