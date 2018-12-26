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
<br>
<br>
<table class="table table-striped" id="priority_history" style="display:none">
    <tr>
        <th>Fecha</th>
        <th>Responsable</th>
        <th>Prioridad</th>
    </tr>
</table>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        $.getScript(`${baseUrl}views/tareas/js/prioridad.js`);
    })
</script>