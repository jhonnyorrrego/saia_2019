<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

require_once $ruta_db_superior . 'db.php';

global $conn;

$idbusquedaComponente = $_REQUEST['idbusqueda_componente'];

if($idbusquedaComponente){
    $component = busca_filtro_tabla('encabezado_componente', 'busqueda_componente', 'idbusqueda_componente=' . $idbusquedaComponente, '', $conn);
    
    if($component['numcampos'] && $component[0][0]){
        $component[0][0]();
    }else{
        defaultOption();
    }
}else{
    defaultOption();
}

function defaultOption(){
?>
    <div class="container-fluid">
        <div class="row w-100 mx-0">
            <div class="col-auto mr-auto text-left px-0">
                <span><small>HOY Septiembre 20 de 2018</small></span>
            </div>
            <div class="col-auto text-right px-0" style="display:none" id="component_actions">
                <span class="btn btn-link py-0 px-1"><i class="fa fa-share"></i></span>
                <span class="btn btn-link py-0 px-1"><i class="fa fa-sign-out"></i></span>
                <span class="btn btn-link py-0 px-1"><i class="fa fa-flag"></i></span>
                <span class="btn btn-link py-0 px-1"><i class="fa fa-tag"></i></span>
                <span class="btn btn-link py-0 px-1"><i class="fa fa-folder"></i></span>
                <span class="btn btn-link py-0 px-1"><i class="fa fa-ellipsis-v"></i></span>
            </div>
        </div>
    </div>    
<?php    
}