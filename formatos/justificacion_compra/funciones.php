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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function listar_item_justificacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$padre=busca_filtro_tabla("","ft_justificacion_compra A","A.documento_iddocumento=".$iddoc,"",$conn);	
	
	$hijos=busca_filtro_tabla("","ft_item_justificacion_compra A","A.ft_justificacion_compra=".$padre[0]["idft_justificacion_compra"],"",$conn);	

	$formato_hijo=busca_filtro_tabla("","formato A","A.nombre='item_justificacion_compra'","",$conn);
	$texto="";
	$botones=true;
	$estado=busca_filtro_tabla("","documento A","A.iddocumento=".$iddoc,"",$conn);
	if($estado[0]["estado"]!='ACTIVO'){
		$botones=false;
	}
	if($botones){
		$texto.='<a href="'.$ruta_db_superior.'formatos/'.$formato_hijo[0]["nombre"].'/'.$formato_hijo[0]["ruta_adicionar"].'?pantalla=padre&idpadre='.$iddoc.'&idformato='.$formato_hijo[0]["idformato"].'&padre='.$padre[0]["idft_justificacion_compra"].'">Adicionar '.$formato_hijo[0]["etiqueta"].'</a>
		';
	}
	if($hijos["numcampos"]){
		$texto.='<table style="border-collapse:collapse;width:100%" border="1px"><tr class="encabezado_list">
		<td style="width:10%;">Cantidad</td>
		<td style="width:90%;">Descripci&oacute;n</td>
		</tr>';
		for($i=0;$i<$hijos["numcampos"];$i++){
			$texto.='<tr>
			<td style="text-align:center;">'.$hijos[$i]["cantidad"].'</td>
			<td>'.utf8_encode(html_entity_decode($hijos[$i]["descripcion_item"])).'</td>';
			if($botones){
				$texto.="<td><a href='#' onclick='if(confirm(\"En realidad desea borrar este elemento?\")) window.location=\"../librerias/funciones_item.php?formato=".$formato_hijo[0]["idformato"]."&idpadre=".$iddoc."&accion=eliminar_item&tabla=".$formato_hijo[0]["nombre_tabla"]."&id=".$hijos[$i]["idft_item_justificacion_compra"]."\";'><img border=0 src='".$ruta_db_superior."images/eliminar_pagina.png' /></a>
				</td>";
			}
			$texto.='</tr>';
		}
		$texto.='</table>';
	}
	echo($texto);
}
function generar_ruta_justificacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
	$siguiente=busca_filtro_tabla("C.funcionario_codigo","ft_justificacion_compra A, dependencia_cargo B, funcionario C","A.primera_aprobacion=B.iddependencia_cargo AND B.funcionario_idfuncionario=C.idfuncionario AND A.documento_iddocumento=".$iddoc,"",$conn);
	$ruta=array();
	$usuario=usuario_actual('funcionario_codigo');
	if($usuario!=$siguiente[0]["funcionario_codigo"]){
		array_push($ruta,array("funcionario"=>$siguiente[0]["funcionario_codigo"],"tipo_firma"=>1));
	}
	if(count($ruta)>0){
        phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
        //se hace llamado a la funcion siguiente
        insertar_ruta($ruta,$iddoc,1);
    }
}
?>