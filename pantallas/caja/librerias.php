<?php

function barra_superior_busqueda(){
    $permiso=new Permiso();
    $ok2=$permiso->acceso_modulo_perfil('transferencia_doc');
    
	$cadena='
	<li class="divider-vertical"></li>                          
	<li>            
	 <div class="btn-group">                    
	    <button class="btn btn-mini" id="adicionar_caja" idbusqueda_componente="'.$_REQUEST["idbusqueda_componente"].'" title="Adicionar caja" enlace="pantallas/caja/adicionar_caja.php?div_actualiza=resultado_busqueda'.$_REQUEST["idbusqueda_componente"].'&target_actualiza=parent&idbusqueda_componente='.$_REQUEST["idbusqueda_componente"].'">Adicionar Caja</button>
	  </div>
	</li>';
	if($ok2){
		$cadena.='<li class="divider-vertical"></li>                          
		<li>
		 <div class="btn-group">                    
		    <button class="btn btn-mini" id="transferencia_documental" titulo="Transferencia documental">Transferencia documental</button>                                            
		  </div>    
		</li>
		<script>
		$("#transferencia_documental").click(function(){
			var seleccionados=$("#seleccionados_expediente").val();
			if(seleccionados){
				enlace_katien_saia("formatos/transferencia_doc/adicionar_transferencia_doc.php?id="+seleccionados,"Transferencia documental","iframe","");
			}
			else{
				alert("Seleccione por lo menos un expediente");
			}
		});
		</script>';
	}	
	
	return($cadena);
}
function asignar_caja($idcaja, $tipo_entidad, $llave_entidad, $permiso="", $indice=1){
	global $conn;
	$indice++;
	if($indice>100)return false;
	$busqueda=busca_filtro_tabla("","entidad_caja a","entidad_identidad=".$tipo_entidad." and llave_entidad=".$llave_entidad." and caja_idcaja=".$idcaja,"",$conn);
	if(!$busqueda["numcampos"]){
		$sql1="insert into entidad_caja(entidad_identidad, caja_idcaja, llave_entidad, estado, permiso, fecha)values(".$tipo_entidad.",".$idcaja.",".$llave_entidad.",'1', '".$permiso."', '".date('Y-m-d H:i:s')."')";
	}
	else{
		$sql1="update entidad_expediente set entidad_identidad=".$tipo_entidad.", expediente_idexpediente=".$idexp.", llave_entidad=".$llave_entidad.", permiso='".$permiso."' where identidad_expediente=".$busqueda[0]["identidad_caja"];
	}
	phpmkr_query($sql1);
	return true;
}
function enlace_caja($idcaja,$numero){
	global $conn,$componente_exp;
	if(!$componente_exp)
	$componente_exp=busca_filtro_tabla("","busqueda_componente a","a.nombre='expediente'","",$conn);
	return("<div style='' class='link kenlace_saia' enlace='pantallas/busquedas/consulta_busqueda_expediente.php?idbusqueda_componente=".$componente_exp[0]["idbusqueda_componente"]."&idcaja=".$idcaja."' conector='iframe' titulo='".$numero."'><b>".$numero."</b></div>");
}
function enlaces_adicionales_caja($idcaja,$numero){
	global $conn;
	$texto='<div class="btn btn-mini eliminar_caja tooltip_saia pull-right" idregistro="'.$idcaja.'" title="Eliminar '.$numero.'"><i class="icon-remove"></i></div>';
	$texto.='<div class="btn btn-mini enlace_caja tooltip_saia pull-right" idregistro="'.$idcaja.'" title="Editar '.$numero.'" enlace="pantallas/caja/editar_caja.php?idcaja='.$idcaja.'"><i class="icon-pencil"></i></div>';
	$texto.='<div class="btn btn-mini link kenlace_saia tooltip_saia pull-right" title="Imprimir rotulo" titulo="Imprimir rotulo" enlace="pantallas/caja/rotulo.php?idcaja='.$idcaja.'" conector="iframe" onclick=" "><i class="icon-print"></i></div>';
	
	$mostrar_seleccionar='';
	/*if($estado_cierre==1){
	    $mostrar_seleccionar='style="display:none;"';
	}*/	
	$texto.='<div id="seleccionados_expediente_'.$idexpediente.'" idregistro=\''.$idexpediente.'\' titulo=\'Seleccionar\' class=\'btn btn-mini tooltip_saia adicionar_seleccionados_expediente pull-right\' '.$mostrar_seleccionar.'><i class=\'icon-uncheck\' ></i></div>';	
	
	return($texto);
}
function obtener_descripcion_caja($fondo,$seccion,$subseccion,$codigo){
	if($fondo=='fondo'){
		$fondo='';
	}
	if($seccion=='seccion'){
		$seccion='';
	}
if($subseccion=='subseccion'){
		$subseccion='';
	}
if($codigo=='codigo'){
		$codigo='';
	}
	$texto='<b>Fondo:</b> '.$fondo.'<br /><b>Seccion:</b> '.$seccion.'<br /><b>Subseccion:</b> '.$subseccion.' <b>Codigo:</b> '.$codigo;
	return($texto);
}
function usuario_actual_codigo_caja(){
	return usuario_actual('idfuncionario');
}
function dependencia_actual_codigos_caja(){
	global $dependencia;
	$dependencias=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo a","a.estado='1' and funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$dependencia=extrae_campo($dependencias,"dependencia_iddependencia");
	return implode(",",$dependencia);
}
function cargo_actual_codigos_caja(){
	global $dependencia;
	$cargos=busca_filtro_tabla("cargo_idcargo","dependencia_cargo a","a.estado='1' and funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$cargo=extrae_campo($cargos,"cargo_idcargo");
	return implode(",",$cargo);
}
?>