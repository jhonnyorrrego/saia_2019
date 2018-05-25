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
include_once($ruta_db_superior . "librerias_saia.php");
function procesar_conector_hidden($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if($campo==''){
    $dato=busca_filtro_tabla("A.*, B.idpantalla_componente,B.nombre AS nombre_componente","pantalla_campos A,pantalla_componente B","A.etiqueta_html=B.nombre AND A.idpantalla_campos=".$idcampo,"",$conn);      
    $campo=$dato[0];  
  }
	
	$datos=explode("|",$campo["valor"]);
	
  $texto='';
  $encabezado_conector_hidden='';
  $pie_conector_hidden='';
  $adicionales_conector_hidden=' type="hidden" ';
  if($seleccionado==''){
  	if($datos[0]==1){
			$seleccionado=$_SESSION[$datos[1]];
		}
		else if($datos[0]==2){
			$seleccionado=$_REQUEST[$datos[1]];
		}
  }
	else{
		$seleccionado=$campo["predeterminado"];
	}
  if($accion==''){
    $adicionales_conector_hidden=' type="text" class="elemento_formulario" placeholder="'.$campo["placeholder"].'"  disabled="disabled" ';
    $encabezado_conector_hidden='<div class="control-group element" idpantalla_componente="'.$campo["idpantalla_componente"].'" idpantalla_campo="'.$idcampo.'" id="pc_'.$idcampo.'" nombre="'.$campo["nombre_componente"].'">'.clase_eliminar_pantalla_componente($idcampo).'<label class="control-label" for="'.$campo["nombre"].'">'.$campo["etiqueta"];
    if($campo["obligatoriedad"]){
      $encabezado_conector_hidden.='*';
    }
    $encabezado_conector_hidden.='</label><div class="controls">';
    $pie_conector_hidden='</div></div>';
  }
  $texto.=$encabezado_conector_hidden.'<input '.$adicionales_conector_hidden.' name="'.$campo["nombre"].'" id="'.$campo["nombre"].'" value="'.$seleccionado.'">'.$pie_conector_hidden;  
	return($texto);
}
?>