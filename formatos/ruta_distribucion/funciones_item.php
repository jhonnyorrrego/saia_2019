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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "formatos/ruta_distribucion/funciones.php";

if(!empty($_REQUEST["funcionariosDistribucion"]) && !empty($_REQUEST["idItem"])){
    $item = busca_filtro_tabla(fecha_db_obtener("fecha_mensajero", "Y-m-d") . " AS fecha_mensajero,mensajero_ruta,estado_mensajero,idft_funcionarios_ruta", "ft_funcionarios_ruta", "idft_funcionarios_ruta=" . $_REQUEST["idItem"], "", $conn);
    if($item["numcampos"]){
        echo(crearItemFuncionario($item[0]));
    }
}


if(!empty($_REQUEST["dependenciaDistribucion"]) && !empty($_REQUEST["idItem"])){
    $item = busca_filtro_tabla(fecha_db_obtener("fecha_item_dependenc", "Y-m-d H:i:s") . " AS fecha_item_dependenc,dependencia_asignada,descripcion_dependen,estado_dependencia,ft_ruta_distribucion", "ft_dependencias_ruta", "idft_dependencias_ruta=" . $_REQUEST["idItem"], "", $conn);
    if($item["numcampos"]){
        echo(crearItemDependencia($item[0]));
    }
}


?>