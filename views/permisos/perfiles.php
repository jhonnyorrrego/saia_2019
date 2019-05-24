<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . "assets/librerias.php";

?>
<!DOCTYPE html>
<html lang="en">
<div class="container-fluid p-0">
    <div class="row mx-0">
        <div class="col-12 p-0">
            <ul class="list-group" id="profile_list"></ul>
        </div>
    </div>
    <div class="row mx-0 align-items-center">
        <div class="col pl-0">
            <div class="form-group my-2">
                <input id="profile_name" class="form-control" type="text" placeholder="Nombre." style="display:none">
                <small class="error pl-2" id="profile_name_error"></small>
            </div>
        </div>
        <div class="col-auto">
            <span class="cursor" id="add_profile">
                <i class="fa fa-plus"></i>
            </span>
            <span class="cursor" id="save_profile" style="display:none">
                <i class="fa fa-save"></i>
            </span>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-12">
            <button class="btn btn-complete float-right" id="save_relation">Guardar</button>
        </div>
    </div>
</div>

<script>
    $(function(){
       

        /*$('#save_relation').on('click', e => {
            let profiles = {};

            $('.checkbox_profile').each(function(i, c){
                let profileId = $(c).parents('li.profile_item').data('profileid');

                if($(c).is(':checked')){
                    profiles[profileId] = 1;
                }else if($(c).is(':indeterminate')){
                    profiles[profileId] = 2;
                }else{
                    profiles[profileId] = 0;
                }
            });

            $.post(`${baseUrl}app/etiquetas/enlace_documento.php`, {
                key: userId,
                selections: selections,
                profiles: profiles
            }, function(response){
                if(response.success){
                    top.notification({
                        message: 'Documentos etiquetados',
                        type: 'success'
                    });
                    top.closeTopModal();
                }else{
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            }, 'json')
        });*/

        
    });
</script>
<script src="<?= $ruta_db_superior ?>views/permisos/js/adicionar.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
<script src="<?= $ruta_db_superior ?>views/permisos/js/eventos.js" data-baseurl="<?= $ruta_db_superior ?>"></script>