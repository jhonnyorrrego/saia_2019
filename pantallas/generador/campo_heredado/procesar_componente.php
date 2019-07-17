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
include_once($ruta_db_superior . "pantallas/generador/librerias_pantalla.php");
function procesar_campo_heredado($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
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
  $adicionales_conector_hidden=' ';  
  if($seleccionado==''){
  	
  }
	else{
		$seleccionado=$campo["predeterminado"];
	}  
	if($datos[1]==1){
    $heredado=busca_filtro_tabla("","pantalla_campos","idpantalla_campos=".$datos[0],"",$conn);
		
		if($accion!='')$accion='retorno_campo';
	  //$texto_temp=load_pantalla_campos($datos[0],0,0,$accion);
    $texto_temp=load_pantalla_campos($datos[0],0,0,$accion,$heredado[0]);
	  $texto=str_replace('idpantalla_campo="'.$datos[0].'"','idpantalla_campo="'.$idcampo.'"',$texto_temp["codigo_html"]);
	  $texto=str_replace('id="pc_'.$datos[0].'"','id="pc_'.$idcampo.'"',$texto);
	  $texto=str_replace('idpantalla_campos="'.$datos[0].'"','idpantalla_campos="'.$idcampo.'"',$texto);
	  $texto=str_replace('nombre="'.$heredado[0]["etiqueta_html"].'"','nombre="'.$campo["etiqueta_html"].'"',$texto);
		if($accion==''){
	  	$texto=str_replace('control-group element','control-group element alert-warning',$texto);
		}   
    $texto=str_replace("{*clase_eliminar_pantalla_componente*}","",$texto);
	}
	else{
		$texto='';
	  $encabezado_accion_pantalla='';
	  $pie_accion_pantalla='';
	  $adicionales_accion_pantalla=' type="hidden" ';
	  if($seleccionado==''){
	    $seleccionado=$campo["predeterminado"];
	  }
	  if($accion==''){
	    $adicionales_accion_pantalla=' type="text" class="elemento_formulario" placeholder="'.$campo["placeholder"].'"  disabled="disabled" ';
	    $encabezado_accion_pantalla='<div class="control-group element alert-info" idpantalla_componente="'.$campo["idpantalla_componente"].'" idpantalla_campo="'.$idcampo.'" id="pc_'.$idcampo.'" nombre="'.$campo["nombre_componente"].'">'.clase_eliminar_pantalla_componente($idcampo).'<label class="control-label" for="'.$campo["nombre"].'">'.$campo["etiqueta"];
	    if($campo["obligatoriedad"]){
	      $encabezado_accion_pantalla.='*';
	    }
	    $encabezado_accion_pantalla.='</label><div class="controls">';
	    $pie_accion_pantalla='</div></div>';
	  }
	  $texto.=$encabezado_accion_pantalla.'<input '.$adicionales_accion_pantalla.' name="'.$campo["nombre"].'" id="'.$campo["nombre"].'" value="'.$seleccionado.'">'.$pie_accion_pantalla; 
	}         
	return($texto);
}
?>