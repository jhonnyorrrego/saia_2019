<?php
function validacion_js_transferencia($idformato,$iddoc){
	global $conn;
	?>
	<script>
	$(document).ready(function(){
		var dependencia=$('input[name$="dependencia"]').val();
		$.ajax({
			type:'POST',
			url: "obtener_dependencia.php",
			data: {rol:dependencia},
			success: function(respuesta){
				var datos=respuesta.split("|");
				$("#unidad_admin").val(datos[1]);
				$("#oficina_productora").val(datos[0]);
			}
		});
	});
	</script>
	<?php
}
function guardar_expedientes_add($idformato,$iddoc){
	global $conn;
	$ids=@$_REQUEST["id"];
	$texto="";
	if($ids){
		$expedientes=busca_filtro_tabla("nombre","expediente A","A.idexpediente in(".$ids.")","",$conn);
		$etiquetas=extrae_campo($expedientes,"nombre","");
		$texto.="<td><ul><li>".implode("</li><li>",$etiquetas)."</li></ul>
		<input type='hidden' name='expediente_vinculado' id='expediente_vinculado' value='".$ids."'>
		</td>";
	}
	else{
		$texto.="<td>No hay expedientes vinculados</td>";
	}
	echo($texto);
}
function expedientes_vinculados_funcion($idformato,$iddoc){
	global $conn, $ruta_db_superior;	
	$datos=busca_filtro_tabla("","ft_transferencia_doc A, documento B","A.documento_iddocumento=".$iddoc." and A.documento_iddocumento=B.iddocumento","",$conn);
	$expedientes=busca_filtro_tabla("","expediente A","A.idexpediente in(".$datos[0]["expediente_vinculado"].")","",$conn);
	if($expedientes["numcampos"]){
		$texto.='<p>&nbsp;</p>
		<table style="width:100%;border-collapse:collapse" border="1px">';
		$texto.='<tr><td rowspan="2" style="width:10%;text-align:center"><b>N&Uacute;MERO DE ORDEN</b></td>
		<td rowspan="2" style="width:10%;text-align:center"><b>C&Oacute;DIGO</b></td>
		<td rowspan="2" style="width:30%;text-align:center"><b>NOMBRE</b></td>
		<td colspan="2" style="width:20%;text-align:center"><b>FECHAS EXTREMAS</b></td>
		<td rowspan="2" style="width:15%;text-align:center"><b>UNIDAD DE CONSERVACI&Oacute;N</b></td>
		<td rowspan="2" style="width:15%;text-align:center"><b>N&Uacute;MERO DE FOLIOS</b></td>
		</tr>
		<tr>
		<td style="text-align:center"><b>INICIAL</b></td>
		<td style="text-align:center"><b>FINAL</b></td>
		</tr>';
		$texto.="";
		for($i=0;$i<$expedientes["numcampos"];$i++){
			if(is_object($expedientes[$i]["fecha_extrema_i"]))$expedientes[$i]["fecha_extrema_i"]=$expedientes[$i]["fecha_extrema_i"]->format('Y-m-d');
			if(is_object($expedientes[$i]["fecha_extrema_f"]))$expedientes[$i]["fecha_extrema_f"]=$expedientes[$i]["fecha_extrema_f"]->format('Y-m-d');
			
			$texto.='<tr id="tr_'.$expedientes[$i]["idexpediente"].'">
			<td style="text-align:center">'.($i+1).'</td>
			<td>'.$expedientes[$i]["codigo"].'</td>
			<td>'.$expedientes[$i]["nombre"].'</td>
			<td>'.$expedientes[$i]["fecha_extrema_i"].'</td>
			<td>'.$expedientes[$i]["fecha_extrema_f"].'</td>
			<td>'.$expedientes[$i]["no_unidad_conservacion"].'</td>
			<td style="text-align:center">'.$expedientes[$i]["no_folios"].'</td>';
			if($datos[0]["estado"]=='ACTIVO' && @$_REQUEST["tipo"]!=5){
				$texto.='<td><i class="icon-remove expulsar_expediente" idexpediente="'.$expedientes[$i]["idexpediente"].'" style="cursor:pointer"></i></td>';
			}
			$texto.="</tr>";
		}
		$texto.="</table>";
		if($datos[0]["estado"]=='ACTIVO' && @$_REQUEST["tipo"]!=5){
			$texto.='<script>
			$(document).ready(function(){
				$(".expulsar_expediente").click(function(){
					var expediente=$(this).attr("idexpediente");
					window.open("desvincular_expediente.php?idexpediente="+expediente+"&iddoc='.$iddoc.'&idformato='.$idformato.'","_self");
				});
			});
			</script>';
		}
	}
	echo($texto);
	
	
	//CAMBIO DEL MOSTRAR
	
	$texto='';
	$datos=busca_filtro_tabla("","ft_transferencia_doc A, documento B","A.documento_iddocumento=".$iddoc." and A.documento_iddocumento=B.iddocumento","",$conn);
	$expedientes=busca_filtro_tabla("","expediente A","A.idexpediente in(".$datos[0]["expediente_vinculado"].")","",$conn);
	if($expedientes["numcampos"]){
		$texto.='
		<p>&nbsp;</p>
        <table style="width:100%;border-collapse:collapse" border="1px">
          <tr>
            <th rowspan="2">NUMERO DE ORDEN</th>
            <th rowspan="2">CODIGO</th>
            <th rowspan="2">NOMBRE</th>
            <th colspan="2">FECHAS EXTREMAS</th>
            <th colspan="4">UNIDAD DE CONSERVACION</th>
            <th rowspan="2">NUMERO DE FOLIOS</th>
            <th rowspan="2">SOPORTE</th>
            <th rowspan="2">FRECUENCIA DE CONSULTA</th>
            <th rowspan="2">NOTAS</th>
          </tr>
          <tr>
            <th>INICIAL</th>
            <th>FINAL</th>
            <th>CAJA</th>
            <th>CARPETA</th>
            <th>TOMO</th>
            <th>OTRO</th>
          </tr>		
		
		';
		$texto.="";
		for($i=0;$i<$expedientes["numcampos"];$i++){
		    
		    $serie_expediente=busca_filtro_tabla('codigo','serie','idserie='.$expedientes[$i]["serie_idserie"],'',conn);
		    
			if(is_object($expedientes[$i]["fecha_extrema_i"]))$expedientes[$i]["fecha_extrema_i"]=$expedientes[$i]["fecha_extrema_i"]->format('Y-m-d');
			if(is_object($expedientes[$i]["fecha_extrema_f"]))$expedientes[$i]["fecha_extrema_f"]=$expedientes[$i]["fecha_extrema_f"]->format('Y-m-d');
			
			$texto.='<tr id="tr_'.$expedientes[$i]["idexpediente"].'">
			<td style="text-align:center">'.($i+1).'</td>
			<td>'.$serie_expediente[0]['codigo'].'</td>
			<td>'.$expedientes[$i]["nombre"].'</td>
			<td>'.$expedientes[$i]["fecha_extrema_i"].'</td>
			<td>'.$expedientes[$i]["fecha_extrema_f"].'</td>
			<td>'.$expedientes[$i]["no_unidad_conservacion"].'</td>
			<td style="text-align:center">'.$expedientes[$i]["no_folios"].'</td>';
			if($datos[0]["estado"]=='ACTIVO' && @$_REQUEST["tipo"]!=5){
				$texto.='<td><i class="icon-remove expulsar_expediente" idexpediente="'.$expedientes[$i]["idexpediente"].'" style="cursor:pointer"></i></td>';
			}
			$texto.="</tr>";
		}
		$texto.="</table>";
		if($datos[0]["estado"]=='ACTIVO' && @$_REQUEST["tipo"]!=5){
			$texto.='<script>
			$(document).ready(function(){
				$(".expulsar_expediente").click(function(){
					var expediente=$(this).attr("idexpediente");
					window.open("desvincular_expediente.php?idexpediente="+expediente+"&iddoc='.$iddoc.'&idformato='.$idformato.'","_self");
				});
			});
			</script>';
		}
	}
	echo($texto);	
	
	
	
	
	
	
}
function cambiar_estado_expedientes($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("a.expediente_vinculado, a.transferir_a","ft_transferencia_doc a","a.documento_iddocumento=".$iddoc,"",$conn);
	$expedientes=explode(",",$datos[0]["expediente_vinculado"]);
	obtener_expedientes_hijos($datos[0]["expediente_vinculado"],$expedientes,1);
	
	$sql1="update expediente set estado_archivo=".$datos[0]["transferir_a"]." where idexpediente in(".implode(",",$expedientes).")";
	phpmkr_query($sql1);
}
function obtener_expedientes_hijos($idexpediente,&$expedientes,$indice){
	global $conn;
	if($indice>=100)return false;
	
	$expediente=busca_filtro_tabla("","expediente a","a.cod_padre in(".$idexpediente.")","",$conn);
	for($i=0;$i<$expediente["numcampos"];$i++){
		$expedientes[]=$expediente[$i]["idexpediente"];
		
		$hijos=busca_filtro_tabla("","expediente a","a.cod_padre=".$expediente[$i]["idexpediente"],"",$conn);
		if($hijos["numcampos"]){
			$indice++;
			obtener_expedientes_hijos($expediente[$i]["idexpediente"],$expedientes,$indice);
		}
	}
	return true;
}
?>