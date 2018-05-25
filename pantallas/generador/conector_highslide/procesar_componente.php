<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior . "db.php");
function procesar_conector_highslide($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn, $ruta_db_superior;
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
  $dato=busca_filtro_tabla("A.*, B.idpantalla_componente,B.nombre AS nombre_componente","campos_formato A,pantalla_componente B","A.etiqueta_html=B.nombre AND A.idcampos_formato=".$idcampo,"",$conn);      
  $campo=$dato[0];  
}
$texto='hs.htmlExpand(this, {objectType: "iframe", width:"600", height:"300", preserveContent:false ,src: "'.$ruta_db_superior.'pantallas/buscador_principal.php?idbusqueda='.$campo["valor"].'&nombre_campo='.$campo["nombre"].'"});';
return($texto);
}
?>