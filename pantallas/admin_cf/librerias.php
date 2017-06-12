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
include_once($ruta_db_superior."db.php");

function barra_superior_cf($idcf,$tabla){
	global $ruta_db_superior;
	
    $texto='
    <div class="btn-group barra_superior">
        <button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar" enlace="pantallas/admin_cf/pantalla_cf_editar.php?key='.$idcf.'&tabla='.$tabla.'&campos=cod_padre" conector="iframe">
            <i class="icon-wrench"></i>
        </button> 
    </div>';
    return(($texto));
}
?>