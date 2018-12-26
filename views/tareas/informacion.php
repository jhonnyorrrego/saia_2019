<div class="form-group">
    <label class="my-0" for="name">Nombre de la tarea</label>
    <input type="text" class="form-control" id="name" placeholder="Qué desea que se realice?">
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="my-0" for="manager">Responsable</label>
            <select class="form-control" id="manager" multiple="multiple" placeholder="Quien desea que la realice?"></select>                                
        </div>
    </div>
    <div class="col-auto">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="send_notification">
            <label class="form-check-label" for="send_notification">Desea notificar por email?</label>
        </div>                            
    </div>
</div>
<div class="form-group">
    <label class="my-0" for="date_ranger">Fecha limite</label>
    <div class="input-group">
        <input type="datetime-local" class="form-control" id="final_date">
        <div class="input-group-append ">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="my-0" for="description">Instrucciones adicionales</label>
    <textarea class="form-control" id="description" rows="3"></textarea>
</div>
<div class="form-group advanced" style="display:none">
    <label for="description">Instrucciones adicionales</label>
    <textarea class="form-control" id="description" rows="3"></textarea>
</div>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        $.getScript(`${baseUrl}views/tareas/js/informacion.js`);
    })
</script>