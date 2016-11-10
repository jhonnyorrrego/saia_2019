<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");


//MOSTRAR
function mostrar_unidad_admin_transf($idformato,$iddoc){
    global $conn;
    
    
    $datos=busca_filtro_tabla("b.cod_padre,b.nombre","ft_transferencia_doc a, dependencia b","a.oficina_productora=b.iddependencia AND a.documento_iddocumento=".$iddoc,"",$conn);
    $padre=busca_filtro_tabla("","dependencia","iddependencia=".$datos[0]['cod_padre'],"",$conn);
    if(!$padre['numcampos']){
        $padre=$datos;
    }
    
    echo($padre[0]['nombre']);
}
function mostrar_oficina_productora_transf($idformato,$iddoc){
    global $conn;
}

function validacion_js_transferencia($idformato,$iddoc){
	global $conn;
	/*
	
	if(!@$_REQUEST['iddoc']){  //solo adicionar
	    
	
	
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
	
	}*/
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
	}else if(@$_REQUEST['id_caja']){
	    $ids_caja=$_REQUEST['id_caja'];
        $expedientes=busca_filtro_tabla("A.nombre,A.idexpediente","expediente A","A.fk_idcaja in(".$ids_caja.")","",$conn);
        $etiquetas=extrae_campo($expedientes,"nombre","");
        $idexpedientes=implode(',',extrae_campo($expedientes,"idexpediente","U"));
        $texto.="<td><ul><li>".implode("</li><li>",$etiquetas)."</li></ul>
		<input type='hidden' name='expediente_vinculado' id='expediente_vinculado' value='".$idexpedientes."'>
		</td>";
	}
	else{
		$texto.="<td>No hay expedientes vinculados</td>";
	}
	echo($texto);
}
function expedientes_vinculados_funcion($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	
	/*
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
	*/
	
	//CAMBIO DEL MOSTRAR
	
	$texto='';
	$datos=busca_filtro_tabla("","ft_transferencia_doc A, documento B","A.documento_iddocumento=".$iddoc." and A.documento_iddocumento=B.iddocumento","",$conn);
	$expedientes=busca_filtro_tabla("","expediente A","A.idexpediente in(".$datos[0]["expediente_vinculado"].")","",$conn);
	if($expedientes["numcampos"]){
	    $estilo_general=' style="text-align:center;font-weight:bold;"';
		$texto.='
		<p>&nbsp;</p>
        <table style="width:100%;border-collapse:collapse;" border="1">
          <tr>
            <th rowspan="2" '.$estilo_general.'>NUMERO DE ORDEN</th>
            <th rowspan="2" '.$estilo_general.'>CODIGO</th>
            <th rowspan="2" '.$estilo_general.'>NOMBRE</th>
            <th colspan="2" '.$estilo_general.'>FECHAS EXTREMAS</th>
            <th colspan="4" '.$estilo_general.'>UNIDAD DE CONSERVACION</th>
            <th rowspan="2" '.$estilo_general.'>NUMERO DE FOLIOS</th>
            <th rowspan="2" '.$estilo_general.'>SOPORTE</th>
            <th rowspan="2" '.$estilo_general.'>FRECUENCIA DE CONSULTA</th>
            <th rowspan="2" '.$estilo_general.'>NOTAS</th>
            ';
            
        $texto.='    
          </tr>
          <tr>
            <th '.$estilo_general.'>INICIAL</th>
            <th '.$estilo_general.'>FINAL</th>
            <th '.$estilo_general.'>CAJA</th>
            <th '.$estilo_general.'>CARPETA</th>
            <th '.$estilo_general.'>TOMO</th>
            <th '.$estilo_general.'>OTRO</th>
          </tr>		
		
		';
		$texto.="";
		$vector_soportes=array(1=>'CD-ROM',2=>'DISKETE',3=>'DVD',4=>'DOCUMENTO',5=>'FAX',6=>'REVISTA O LIBRO',7=>'VIDEO',8=>'OTROS ANEXOS');
		$vector_frecuencias=array(1=>'Alta',2=>'Media',3=>'Baja');
		for($i=0;$i<$expedientes["numcampos"];$i++){
		    
		   
		   $x_caja='';
		   if($expedientes[$i]["fk_idcaja"]){
		       $x_caja='x';
		   }
		    
            $tomo_padre=$expedientes[$i]["idexpediente"];
            if($expedientes[$i]['tomo_padre']){
                $tomo_padre=$expedientes[$i]['tomo_padre'];
            }
            $ccantidad_tomos=busca_filtro_tabla("idexpediente","expediente","tomo_padre=".$tomo_padre,"",$conn);
            $cantidad_tomos=$ccantidad_tomos['numcampos']+1; //tomos + el padre  
            $cadena_tomos=("<i><b style='font-size:10px;'></b></i><i style='font-size:10px;'>".$expedientes[$i]['tomo_no']." de ".$cantidad_tomos."</i>");		   
		   
		    
			if(is_object($expedientes[$i]["fecha_extrema_i"]))$expedientes[$i]["fecha_extrema_i"]=$expedientes[$i]["fecha_extrema_i"]->format('Y-m-d');
			if(is_object($expedientes[$i]["fecha_extrema_f"]))$expedientes[$i]["fecha_extrema_f"]=$expedientes[$i]["fecha_extrema_f"]->format('Y-m-d');
			
			$texto.='<tr id="tr_'.$expedientes[$i]["idexpediente"].'">
			<td style="text-align:center">'.($i+1).'</td>
			<td>'.$expedientes[$i]["codigo_numero"].'</td>
			<td>'.$expedientes[$i]["nombre"].'</td>
			<td>'.$expedientes[$i]["fecha_extrema_i"].'</td>
			<td>'.$expedientes[$i]["fecha_extrema_f"].'</td>
			<td style="text-align:center;">'.$x_caja.'</td>
			<td style="text-align:center;">X</td>
			<td style="text-align:center">'.$cadena_tomos.'</td>
			<td style="text-align:center">'.$expedientes[$i]['no_unidad_conservacion'].'</td>
			<td style="text-align:center">'.$expedientes[$i]["no_folios"].'</td>
			<td>'.$vector_soportes[ $expedientes[$i]['soporte'] ].'</td>
			<td>'.$vector_frecuencias[ $expedientes[$i]['frecuencia_consulta'] ].'</td>
			<td>'.$expedientes[$i]['notas_transf'].'</td>
			';
			
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
	
    $mystring = $datos[0]["expediente_vinculado"];
    $findme   = 'cajas_';
    $pos = strpos($mystring, $findme);
    
    if ($pos !== false) {  //son cajas //fue encontrada
        $ids_caja = trim($datos[0]["expediente_vinculado"], "cajas_");
        $sql_c="UPDATE caja SET estado_archivo=".$datos[0]["transferir_a"]." WHERE idcaja IN(".$ids_caja.")";
        phpmkr_query($sql_c);
        $busca_expediente=busca_filtro_tabla("idexpediente","expediente","fk_idcaja IN(".$ids_caja.")","",$conn);
        $expedientes_lista=implode(",",extrae_campo($busca_expediente,'idexpediente'));
        $expedientes=explode(',',$expedientes_lista);
    	obtener_expedientes_hijos($expedientes_lista,$expedientes,1); 
    }else{
    	$expedientes=explode(",",$datos[0]["expediente_vinculado"]);
    	obtener_expedientes_hijos($datos[0]["expediente_vinculado"],$expedientes,1);        
    } 	
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