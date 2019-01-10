<div class="row">
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" value="1">
            <label class="form-check-label">
                <i class="fa fa-flag text-danger"></i>
                Alta
            </label>
        </div>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" value="2">
            <label class="form-check-label">
                <i class="fa fa-flag text-warning"></i>
                Media
            </label>
        </div>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" value="3">
            <label class="form-check-label">
                <i class="fa fa-flag"></i>
                Baja
            </label>
        </div>
    </div>
    <div class="col-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" value="4" checked>
            <label class="form-check-label">
                Ninguna
            </label>
        </div>
    </div>
</div>
<div class="row pt-3">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped" id="priority_history" style="display:none">
                <tr>
                    <td class="text-center">Fecha</td>
                    <td class="text-center">Responsable</td>
                    <td class="text-center">Prioridad</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        $.getScript(`${baseUrl}views/tareas/js/prioridad.js`);
    })
</script>