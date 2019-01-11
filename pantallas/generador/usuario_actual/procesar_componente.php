<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");
function procesar_usuario_actual($idcampo='',$seleccionado='',$accion='',$campo=''){	
	global $conn;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("A.*, B.idpantalla_componente","campos_formato A,pantalla_componente B","A.etiqueta_html=B.nombre AND A.idcampos_formato=".$idcampo,"",$conn);      
	  $campo=$dato[0];  
	}	
  $texto='';
  $encabezado_hidden='';
  $pie_hidden='';
  $adicionales_hidden=' type="hidden" ';
  if($seleccionado==''){
  	if($campo["valor"]=="now()"){
  		if($campo["tipo_dato"]=="date"){
  			$seleccionado=date('Y-m-d');
  		}
			else if($campo["tipo_dato"]=="datetime"){
				$seleccionado=date('Y-m-d H:i:s');
			}
  	}
		else{
    	$seleccionado=$campo["valor"];
		}
  }
	//if($accion==''){               
    $adicionales_hidden=' type="text" class="elemento_formulario" placeholder="'.$campo["placeholder"].'"  disabled="disabled" ';
    $encabezado_hidden='<div class="control-group element" idpantalla_componente="'.$campo["idpantalla_componente"].'" idpantalla_campo="'.$idcampo.'" id="pc_'.$idcampo.'" nombre="'.$campo["etiqueta_html"].'">'.clase_eliminar_pantalla_componente($idcampo).'<label class="control-label" for="'.$campo["nombre"].'"><b>'.$campo["etiqueta"];
    if($campo["obligatoriedad"]){
      $encabezado_hidden.='*';
    }
    $encabezado_hidden.='</b></label><div class="controls">';
    $pie_hidden='</div></div>';
  //}
  $parsea_valor=explode(";",$campo["valor"]);
  $cadena=array();
  //0->listado de campos a mostrar ; 1->campo a almacenar  
  if($parsear_valor[1]==''){
    $valor_mostrar="nombres,apellidos";
  }
  else{
    $valor_mostrar=$parsear_valor[1];
  }
  if($parsear_valor[0]==''){
    $valor_almacenar="funcionario_codigo";
  }
  else{
    $valor_almacenar=$parsear_valor[0];
  }
  $lvalor_mostrar=explode(",",$valor_mostrar);
  $cant=count($lvalor_mostrar);
  for($i=0;$i<$cant;$i++){
    array_push($cadena,usuario_actual($lvalor_mostrar[$i]));
  }
  $texto.=$encabezado_hidden.implode(" ",$cadena).'<input type="hidden" name="'.$campo["nombre"].'" id="'.$campo["nombre"].'" value="'.usuario_actual($valor_almacenar).'">'.$pie_hidden;  
	return($texto);
}
?>