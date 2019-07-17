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
</div>
<script>
    $(function(){
        let baseUrl = Session.getBaseUrl();
        let userId = localStorage.getItem('key');
      
        if(typeof Perfil == 'undefined'){
            $.getScript(`${baseUrl}views/permisos/js/perfiles_adicionar.js`, r => {
                $.getScript(`${baseUrl}views/permisos/js/perfiles_eventos.js`, r => {
                    showProfile(userId);
                }); 
            });
        }else{
            showProfile(userId);
        }

        function showProfile(userId, selections){
            var profile = new Perfil(userId);
            profile.listProfile();
        }
    });
</script>