<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
global $raiz_saia;
$raiz_saia=$ruta_db_superior;
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");


function validar_activo_inactivo_categoria_formato($estado,$idcategoria_formato){
    if($estado==1){
        $esconder="#enlace_activar_categoria_formato_".$idcategoria_formato;
    }else{
        $esconder="#enlace_inactivar_categoria_formato_".$idcategoria_formato;
    }

    $cadena="
    <style>
        ".$esconder."{display:none;}
    </style>
    ";
    return($cadena);
}

?>