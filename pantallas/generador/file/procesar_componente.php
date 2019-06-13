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
include_once $ruta_db_superior . 'core/autoload.php';
function procesar_file($idcampo='',$seleccionado='',$accion='',$campo=''){	
	global $conn,$ruta_db_superior;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("","pantalla_campos A","A.idpantalla_campos=".$idcampo,"",$conn);
		$campo=$dato[0];
	}	
	if($seleccionado!=''){
		$predeterminado=$seleccionado;
	}
	else{
		$predeterminado=$campo["predeterminado"];
	}
	$datos=explode(",",$campo["valor"]);
	$campo["valor"]=$datos[0];
	$texto="";
	$listado3=array();
	
	$validar="";
	if($campo["valor"]==1)$validar="validar_campos";
	
	$texto.='
	<label for="'.$campo["nombre"]."_".$j.'">
	<span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}"><i class="glyphicon-plus"></i><span>Examinar</span>
      <input type="file" ';		
	  $texto.=' name="'.$campo["nombre"].'[]" multiple ng-disabled="disabled" id="'.$campo["nombre"].'" value="" class="anexos">';
    $texto.=htmlentities($listado3[$j][1]).'</span>
    <input type="hidden" name="'.$campo["nombre"].'_oculto" id="'.$campo["nombre"].'_oculto" value="" class="'.$validar.'">
    <span id="error_'.$campo["nombre"].'_oculto" style="color:red"></span>
    </label>';
    $texto.='<table class="table" style="width:50%;margin-bottom:5px;" cellspacing="-5px" id="archivos_'.$campo["nombre"].'" style="cellspacing">';
		if($accion=="editar"){
			$anexos=busca_filtro_tabla("","anexos a","a.idanexos in(".$predeterminado.")","",$conn);
			for($i=0;$i<$anexos["numcampos"];$i++){
				$texto.="<tr id='fila_".$campo["nombre"]."_".$anexos[$i]["etiqueta"]."'>";
				$texto.="<td colspan='3'><a id='".$campo["nombre"].$i."' style='cursor:pointer;'>".$anexos[$i]["etiqueta"]."</a><div style='display:none' class='anexos_subidos' campo='".$campo["nombre"]."'>100%</div></td>";
				$texto.="<td class='borrar_anexo_original' style='cursor:pointer;text-align:center' pantalla='".$campo["tabla"]."' nombre_campo='".$campo["nombre"]."' idregistro='".@$_REQUEST["id".$campo["tabla"]]."' idanexos='".$anexos[$i]["idanexos"]."'>X</td>";
				$texto.="</tr>";
				$texto.='
				<script>
				$(document).ready(function(){
		      $("#'.$campo["nombre"].$i.'").live("click",function(e){
		        top.hs.htmlExpand(this, { objectType: \'iframe\',width: 1000, height: 600,contentId:\'cuerpo_paso\', preserveContent:false, src:\''.$anexos[$i]["ruta"].'\',outlineType: \'rounded-white\',wrapperClassName: \'highslide-wrapper drag-header\'});
		      });
		    });
				</script>
				';
			}
		}
    $texto.='</table>';
		if($campo["valor"]==1){
			$texto.='<script>
		var capa=$("#pc_'.$campo["idpantalla_campos"].' > label > b").append("*");
		</script>';
		}
	return($texto);
}
function eliminar_funcion_file($pantalla_campos){
	global $conn;
	$funcion_validacion=busca_filtro_tabla("","pantalla_funcion a","a.nombre='validar_anexos_subidos'","",$conn);
	$funcion_validacion2=busca_filtro_tabla("","pantalla_funcion a","a.nombre='sincronizar_anexos_temporales'","",$conn);
	
	$funcion_exe=busca_filtro_tabla("","pantalla_funcion_exe a","pantalla_idpantalla=".$pantalla_campos[0]["pantalla_idpantalla"]." and accion='enviar' and fk_idpantalla_funcion='".$funcion_validacion[0]["idpantalla_funcion"]."' and momento='1'","",$conn);
	
	$funcion_exe2=busca_filtro_tabla("","pantalla_funcion_exe a","pantalla_idpantalla=".$pantalla_campos[0]["pantalla_idpantalla"]." and accion='adicionar' and fk_idpantalla_funcion='".$funcion_validacion2[0]["idpantalla_funcion"]."' and momento='2'","",$conn);
	
	$funcion_exe3=busca_filtro_tabla("","pantalla_funcion_exe a","pantalla_idpantalla=".$pantalla_campos[0]["pantalla_idpantalla"]." and accion='editar' and fk_idpantalla_funcion='".$funcion_validacion2[0]["idpantalla_funcion"]."' and momento='2'","",$conn);
	
	$campos_anexos=busca_filtro_tabla("","pantalla_campos a","a.pantalla_idpantalla=".$pantalla_campos[0]["pantalla_idpantalla"]." and etiqueta_html='file'","",$conn);
	
	if($funcion_exe["numcampos"]&&$campos_anexos["numcampos"]==1){
    $sql2="DELETE FROM pantalla_func_param WHERE fk_idpantalla_funcion_exe=".$funcion_exe[0]["idpantalla_funcion_exe"];
    phpmkr_query($sql2);
    $sql2="DELETE FROM pantalla_funcion_exe WHERE idpantalla_funcion_exe=".$funcion_exe[0]["idpantalla_funcion_exe"];
    phpmkr_query($sql2);
		$sql3="DELETE FROM pantalla_campos WHERE etiqueta_html='acciones_pantalla' and valor='".$funcion_exe[0]["idpantalla_funcion_exe"]."' and pantalla_idpantalla=".$funcion_exe[0]["pantalla_idpantalla"];
		phpmkr_query($sql3);
		
		$sql4="DELETE FROM pantalla_funcion_exe WHERE idpantalla_funcion_exe=".$funcion_exe2[0]["idpantalla_funcion_exe"];
		phpmkr_query($sql4);
		$sql5="DELETE FROM pantalla_campos WHERE etiqueta_html='acciones_pantalla' and valor='".$funcion_exe2[0]["idpantalla_funcion_exe"]."' and pantalla_idpantalla=".$funcion_exe2[0]["pantalla_idpantalla"];
		phpmkr_query($sql5);
		
		
		$sql6="DELETE FROM pantalla_funcion_exe WHERE idpantalla_funcion_exe=".$funcion_exe3[0]["idpantalla_funcion_exe"];
		phpmkr_query($sql6);
		$sql7="DELETE FROM pantalla_campos WHERE etiqueta_html='acciones_pantalla' and valor='".$funcion_exe3[0]["idpantalla_funcion_exe"]."' and pantalla_idpantalla=".$funcion_exe3[0]["pantalla_idpantalla"];
		phpmkr_query($sql7);
  }
}
function mostrar_file($idcampo='',$seleccionado='',$accion='',$campo=''){
	global $conn,$ruta_db_superior;
	if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("","pantalla_campos A","A.idpantalla_campos=".$idcampo,"",$conn);
		$campo=$dato[0];
	}	
	if($seleccionado!=''){
		$predeterminado=$seleccionado;
	}
	else{
		$predeterminado=$campo["predeterminado"];
	}
	$texto="";
	$listado3=array();
	$datos=explode(",",$campo["valor"]);
	$campo["valor"]=$datos[1];
	
	$anexos=busca_filtro_tabla("","anexos a","a.idanexos in(".$seleccionado.")","",$conn);
	$texto=array();
	$extensiones_visualiza=array("jpg","jpeg","png","gif");
	for($i=0;$i<$anexos["numcampos"];$i++){
		if($campo["valor"]==1){
			$texto[]='<a href="" id="anexos_'.$i.'">'.$anexos[$i]["etiqueta"].'</a>
			<script>
				$(document).ready(function(){
		      $("#anexos_'.$i.'").live("click",function(e){
		        top.hs.htmlExpand(this, { objectType: \'iframe\',width: 1000, height: 600,contentId:\'cuerpo_paso\', preserveContent:false, src:\''.$anexos[$i]["ruta"].'\',outlineType: \'rounded-white\',wrapperClassName: \'highslide-wrapper drag-header\'});
		      });
		    });
		  </script>
			';
		}
		else if($campo["valor"]==2){
			if(in_array($anexos[$i]["tipo"],$extensiones_visualiza)){
				$texto[]='<img src="'.$ruta_db_superior.$anexos[$i]["ruta"].'">';
			}
			else{
				$texto[]='<a href="" id="anexos_'.$i.'">'.$anexos[$i]["etiqueta"].'</a>
				<script>
				$(document).ready(function(){
		      $("#anexos_'.$i.'").live("click",function(e){
		        top.hs.htmlExpand(this, { objectType: \'iframe\',width: 1000, height: 600,contentId:\'cuerpo_paso\', preserveContent:false, src:\''.$anexos[$i]["ruta"].'\',outlineType: \'rounded-white\',wrapperClassName: \'highslide-wrapper drag-header\'});
		      });
		    });
		    </script>
		    ';
			}
		}
	}
	
	return implode("<br>",$texto);
}
?>