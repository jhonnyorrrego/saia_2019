<?php
function nombre_entidad_funcion($idformato,$iddocumento){
	global $conn, $datos_documento;
	$datos_documento=busca_filtro_tabla("","ft_readh A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddocumento,"",$conn);
	
	$ejecutor=busca_filtro_tabla("B.nombre, B.identificacion, A.cargo, A.direccion, A.empresa","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos_documento[0]["nombre_entidad"],"",$conn);
	
	$imprimir=array();
	if($ejecutor[0]["nombre"]){
		$imprimir[]="<b>Nombre:</b> ".$ejecutor[0]["nombre"];
	}
	if($ejecutor[0]["identificacion"]){
		$imprimir[]="<b>Identificacion:</b> ".$ejecutor[0]["identificacion"];
	}
	if($ejecutor[0]["cargo"]){
		$imprimir[]="<b>Cargo:</b> ".$ejecutor[0]["cargo"];
	}
	if($ejecutor[0]["direccion"]){
		$imprimir[]="<b>Direccion:</b> ".$ejecutor[0]["direccion"];
	}
	if($ejecutor[0]["empresa"]){
		$imprimir[]="<b>Empresa:</b> ".$ejecutor[0]["empresa"];
	}
	echo(implode("<br />",$imprimir));
}
function estado_registro_funcion($idformato,$iddocumento){
	global $conn, $datos_documento;
	$serie=busca_filtro_tabla("","serie A","A.idserie=".$datos_documento[0]["estado_registro"],"",$conn);
	echo("<span style='color:red;font-size:14pt'>Estado del registro: ".$serie[0]["nombre"]."</span>");
}
function generar_codigo_qr_readh($idformato,$iddoc){	
  global $conn,$ruta_db_superior;
  $generar=False;
  $codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);
	
	if($codigo_qr['numcampos']){
		if(is_file($ruta_db_superior.$codigo_qr[0]['ruta_qr'])){
			$qr="<img src='".$ruta_db_superior.$codigo_qr[0]['ruta_qr']."'>";
		}
		else{
			$sql1="DELETE FROM documento_verificacion WHERE iddocumento_verificacion=".$codigo_qr[0]["iddocumento_verificacion"];
			phpmkr_query($sql1);
			$generar=True;
		}
	}
	else{
		$generar=True;
	}
	if($generar){
		include_once($ruta_db_superior."pantallas/qr/librerias.php");
		generar_codigo_qr('',$iddoc);
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);	
		$qr="<img src='".$ruta_db_superior.$codigo_qr[0]['ruta_qr']."'>";
	}
	echo($qr);
}
function volumen_documental_funcion($idformato,$iddocumento){
	global $conn,$ruta_db_superior,$datos_documento;
	$formato_hijo=busca_filtro_tabla("","formato A","A.nombre='volumen_documental'","",$conn);
	
	$adicionar='<a href="'.$ruta_db_superior.'formatos/'.$formato_hijo[0]["nombre"].'/'.$formato_hijo[0]["ruta_adicionar"].'?pantalla=padre&idpadre='.$iddoc.'&idformato='.$formato_hijo[0]["idformato"].'&padre='.$datos_documento[0]["idft_readh"].'">Adcionar '.$formato_hijo[0]["etiqueta"].'</a>';
	
	$hijos=busca_filtro_tabla("","ft_volumen_documental A","A.ft_readh=".$datos_documento[0]["idft_readh"],"",$conn);
	
	$estado=True;
	$tabla="";
	if($estado){
		$tabla.=$adicionar;
	}
	if($hijos["numcampos"]){
		$tabla.='<style>.titulos{text-align:center}</style>';
		$tabla.='<table style="width:100%;border-collapse:collapse" border="1px">';
		$tabla.='<tr>';
		$tabla.='<td class="titulos"><b>Tipo de soporte</b></td>';
		$tabla.='<td class="titulos"><b>Cantidad</b></td>';
		$tabla.='<td class="titulos"><b>Riesgos</b></td>';
		$tabla.='<td class="titulos"><b>Descripci&oacute;n</b></td>';
		$tabla.='<td class="titulos"><b>Nivel de pertinencia</b></td>';
		if($estado){
			$tabla.='<td class="titulos">&nbsp;</td>';
		}
		$tabla.='</tr>';
		for($i=0;$i<$hijos["numcampos"];$i++){
			$tabla.='<tr>';
			$tabla.='<td>'.parsear_campos_valores($formato_hijo[0]["idformato"],'tipo_soporte',$hijos[$i]["tipo_soporte"]).'</td>';
			$tabla.='<td>'.$hijos[$i]["cantidad"].'</td>';
			$tabla.='<td>'.parsear_campos_valores($formato_hijo[0]["idformato"],'riesgos',$hijos[$i]["riesgos"]).'</td>';
			$tabla.='<td>'.utf8_encode(html_entity_decode($hijos[$i]["descripcion_volumen"])).'</td>';
			$tabla.='<td>'.parsear_campos_valores($formato_hijo[0]["idformato"],'nivel_pertinencia',$hijos[$i]["nivel_pertinencia"]).'</td>';
			if($estado){
				$tabla.="<td><a href='#' onclick='if(confirm(\"En realidad desea borrar este elemento?\")) window.location=\"../librerias/funciones_item.php?formato=".$formato_hijo[0]["idformato"]."&idpadre=".$iddocumento."&accion=eliminar_item&tabla=".$formato_hijo[0]["nombre_tabla"]."&id=".$hijos[$i]["idft_volumen_documental"]."\";'><img border=0 src='".$ruta_db_superior."images/eliminar_pagina.png' /></a></td>";
			}
			$tabla.='</tr>';
		}
		$tabla.='</table>';
	}
	echo($tabla);
}
function contacto_adicional_funcion($idformato,$iddocumento){
	global $conn,$ruta_db_superior,$datos_documento;
	$formato_hijo=busca_filtro_tabla("","formato A","A.nombre='contacto_adicional'","",$conn);
	
	$adicionar='<a href="'.$ruta_db_superior.'formatos/'.$formato_hijo[0]["nombre"].'/'.$formato_hijo[0]["ruta_adicionar"].'?pantalla=padre&idpadre='.$iddoc.'&idformato='.$formato_hijo[0]["idformato"].'&padre='.$datos_documento[0]["idft_readh"].'">Adcionar '.$formato_hijo[0]["etiqueta"].'</a>';
	
	$hijos=busca_filtro_tabla("","ft_contacto_adicional A","A.ft_readh=".$datos_documento[0]["idft_readh"],"",$conn);
	
	$estado=True;
	$tabla="";
	if($estado){
		$tabla.=$adicionar;
	}
	if($hijos["numcampos"]){
		$tabla.='<style>.titulos{text-align:center}</style>';
		$tabla.='<table style="width:100%;border-collapse:collapse" border="1px">';
		$tabla.='<tr>';
		$tabla.='<td class="titulos"><b>Nombre</b></td>';
		$tabla.='<td class="titulos"><b>Identificaci&oacute;n</b></td>';
		$tabla.='<td class="titulos"><b>Direcci&oacute;n</b></td>';
		$tabla.='<td class="titulos"><b>Telef&oacute;no</b></td>';
		if($estado){
			$tabla.='<td class="titulos">&nbsp;</td>';
		}
		$tabla.='</tr>';
		for($i=0;$i<$hijos["numcampos"];$i++){
			$tabla.='<tr>';
			$tabla.='<td>'.$hijos[$i]["nombre"].'</td>';
			$tabla.='<td>'.$hijos[$i]["identificacion"].'</td>';
			$tabla.='<td>'.$hijos[$i]["direccion"].'</td>';
			$tabla.='<td>'.$hijos[$i]["telefono"].'</td>';
			if($estado){
				$tabla.="<td><a href='#' onclick='if(confirm(\"En realidad desea borrar este elemento?\")) window.location=\"../librerias/funciones_item.php?formato=".$formato_hijo[0]["idformato"]."&idpadre=".$iddocumento."&accion=eliminar_item&tabla=".$formato_hijo[0]["nombre_tabla"]."&id=".$hijos[$i]["idft_volumen_documental"]."\";'><img border=0 src='".$ruta_db_superior."images/eliminar_pagina.png' /></a></td>";
			}
			$tabla.='</tr>';
		}
		$tabla.='</table>';
	}
	echo($tabla);
}
function parsear_campos_valores($idformato,$nombre_campo,$valor){
	$campos_formatos=busca_filtro_tabla("valor","campos_formato A","A.formato_idformato=".$idformato." AND A.nombre='".$nombre_campo."'","",$conn);
	$datos=explode(";",$campos_formatos[0]["valor"]);
	$cant=count($datos);
	$arreglo=array();
	
	$seleccionados=explode(",",$valor);
	$cadena=array();
	for($i=0;$i<$cant;$i++){
		$datos2=explode(",",$datos[$i]);
		$arreglo[$datos2[0]]=$datos2[1];
		if(in_array($datos2[0],$seleccionados)){
			$cadena[]=$datos2[1];
		}
	}
	return(implode(", ",$cadena));
}
function radicado_funcion($idformato,$iddocumento){
	global $conn,$ruta_db_superior;
	$datos_documento=busca_filtro_tabla("","ft_readh A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddocumento,"",$conn);
	$municipio=busca_filtro_tabla("","municipio A","A.idmunicipio=".$datos_documento[0]["ubicacion_geografica"],"",$conn);
	$cadena="Co.".$municipio[0]["departamento_iddepartamento"]."".$municipio[0]["idmunicipio"].".000".$datos_documento[0]["numero"];
	echo($cadena);
}
function radicado_funcion2($idformato,$iddocumento){
	global $conn,$ruta_db_superior;
	$datos_documento=busca_filtro_tabla("","ft_readh A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddocumento,"",$conn);
	$municipio=busca_filtro_tabla("","municipio A","A.idmunicipio=".$datos_documento[0]["ubicacion_geografica"],"",$conn);
	$cadena="Co.".$municipio[0]["departamento_iddepartamento"]."".$municipio[0]["idmunicipio"].".000".$datos_documento[0]["numero"];
	return($cadena);
}
function enviar_adicionar_readh($idformato,$iddoc){
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
		if(is_file($ruta."db.php")){
			$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
		}
		$ruta.="../";
		$max_salida--;
	}
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	if(@$_REQUEST["digitalizacion"]==1){
		if(@$iddoc){
			$enlace="paginaadd.php?key=".$iddoc."&enlace2=ordenar.php?key=".$iddoc."&mostrar_formato=1";
		}
		else{
			$enlace="ordenar.php?key=".$iddoc."&mostrar_formato=1";
		}
	}
	else{
		$enlace="ordenar.php?key=".$iddoc."&mostrar_formato=1";
	}
	abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,"_self");
}
function digitalizar_formato_readh($idformato,$iddoc)
{global $conn;
  echo "<tr><td class='encabezado'>DESEA DIGITALIZAR</td><td><input name='digitalizacion' type='radio' value='1'>Si  <input name='digitalizacion' type='radio' value='0' checked>No</td></tr>";
}
function estado_documento_reserva($idformato,$iddoc){
	global $conn;
	$reserva=busca_filtro_tabla("","ft_reservar_documento A, documento B","doc_relacionado=".$iddoc." AND A.documento_iddocumento=B.iddocumento","B.fecha desc",$conn);
	
	if($reserva["numcampos"]){
		if($reserva[0]["estado_doc"]==1){
			$estado="Reservado";
			$nombres=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$reserva[0]["ejecutor"],"",$conn);
			$datos1=date_parse($reserva[0]["desde"]);
			$datos2=date_parse($reserva[0]["hasta"]);
			
			$adicional="<b>Quien reserv&oacute;:</b> ".ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"]));
			$adicional.="<br /><b>Desde:</b> ".$datos1["day"]." de ".mes($datos1["month"])." del ".$datos1["year"]." <b>Hasta:</b> ".$datos2["day"]." de ".mes($datos2["month"])." del ".$datos2["year"];
		}
		if($reserva[0]["estado_doc"]==2){
			$estado="En prestamo";
			
			$nombres=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$reserva[0]["ejecutor"],"",$conn);
			$datos1=date_parse($reserva[0]["desde"]);
			$datos2=date_parse($reserva[0]["hasta"]);
			
			$adicional="<b>Quien reserv&oacute;:</b> ".ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"]));
			$adicional.="<br /><b>Desde:</b> ".$datos1["day"]." de ".mes($datos1["month"])." del ".$datos1["year"]." <b>Hasta:</b> ".$datos2["day"]." de ".mes($datos2["month"])." del ".$datos2["year"];
		}
		if($reserva[0]["estado_doc"]==3){
			$estado="En sala";
		}
	}
	else{
		$estado="En sala";
	}
	echo("<span style='color:red;font-size:14pt'>Estado del documento: ".$estado."</span><br />".$adicional);
}
?>