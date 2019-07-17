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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior . "librerias_saia.php");
function procesar_redireccionar($idcampo='',$seleccionado='',$accion='',$campo=''){
  //print_r($campo);  
global $conn;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if($campo==''){
    $dato=busca_filtro_tabla("A.*, B.idpantalla_componente,B.nombre AS nombre_componente","pantalla_campos A,pantalla_componente B","A.etiqueta_html=B.nombre AND A.idpantalla_campos=".$idcampo,"",$conn);      
    //$campo=$dato[0];  
  }	
  $texto='';
  $encabezado_accion_pantalla='';
  $pie_accion_pantalla='';
  $adicionales_accion_pantalla=' type="hidden" ';
  if($seleccionado==''){
    $seleccionado=$campo["predeterminado"];
  }
  if($accion==''){               
    $adicionales_accion_pantalla=' type="text" class="elemento_formulario" placeholder="'.$campo["placeholder"].'"  disabled="disabled" ';
    $encabezado_accion_pantalla='<div class="control-group element" idpantalla_componente="'.$campo["idpantalla_componente"].'" idpantalla_campo="'.$idcampo.'" id="pc_'.$idcampo.'" nombre="'.$campo["nombre_componente"].'">'.clase_eliminar_pantalla_componente($idcampo).'<label class="control-label" for="'.$campo["nombre"].'">'.$campo["etiqueta"];
    if($campo["obligatoriedad"]){
      $encabezado_accion_pantalla.='*';
    }
    $encabezado_accion_pantalla.='</label><div class="controls">';
    $pie_accion_pantalla='</div></div>';
  }
  $texto.=$encabezado_accion_pantalla.'<input "'.$adicionales_accion_pantalla.'" name="'.$campo["nombre"].'" id="'.$campo["nombre"].'" value="'.$seleccionado.'">'.$pie_accion_pantalla;  
	return($texto);
}
function eliminar_acciones_redireccionar($pantalla_campos){
  $idfuncion_exe=$pantalla_campos[0]["valor"];
  $funcion_exe=busca_filtro_tabla("","pantalla_funcion_exe","idpantalla_funcion_exe=".$idfuncion_exe,"",$conn);  
  if($funcion_exe["numcampos"]){
    $sql2="DELETE FROM pantalla_func_param WHERE fk_idpantalla_funcion_exe=".$funcion_exe[0]["idpantalla_funcion_exe"];
    phpmkr_query($sql2);
    $sql2="DELETE FROM pantalla_funcion_exe WHERE idpantalla_funcion_exe=".$funcion_exe[0]["idpantalla_funcion_exe"];
    phpmkr_query($sql2);
  }  
}
?>