<?php
$max_salida = 6;
$ruta_db_superior=$ruta="";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function mostrar_solicitante($idformato,$iddoc){
	global $conn;
	$usuario=usuario_actual("funcionario_codigo"); 
	 $campo_solitante=busca_filtro_tabla("nombres,apellidos,iddependencia_cargo","vfuncionario_dc","funcionario_codigo=".$usuario,"",$conn);
	 echo "<td><input type='hidden' name='nombre_solicita' id='nombre_solicita' value='".$campo_solitante[0]['iddependencia_cargo']."'>".$campo_solitante[0]['nombres']." ".$campo_solitante[0]['apellidos']."</td>";
	
}

function solicitante($idformato,$iddoc){
	global $conn;
	 $campo_solitante=busca_filtro_tabla("A.nombres,A.apellidos","vfuncionario_dc A,ft_solicitud_prestamo B","A.iddependencia_cargo=B.nombre_solicita and B.documento_iddocumento=".$iddoc,"",$conn);
	 echo $campo_solitante[0]['nombres']."  ".$campo_solitante[0]['apellidos'];
	
}
           
function ruta_autoriza($idformato,$iddoc){
	global $conn;
	/*$autoriza=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_solicitud_prestamo B ","A.iddependencia_cargo=B.persona_autoriza  AND  B.documento_iddocumento=".$iddoc,"",$conn);
	
	$ruta=array();
	$usuario=usuario_actual("funcionario_codigo");
	array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>1));
	if($autoriza[0]["funcionario_codigo"]!=$usuario){
		array_push($ruta,array("funcionario"=>$autoriza[0]['funcionario_codigo'],"tipo_firma"=>1));
	}
	
	if(count($ruta)>1){
		$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=".$iddoc,"idtransferencia desc",$conn);
    array_push($ruta,array("funcionario"=>1,"tipo_firma"=>0)); 
    phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
		phpmkr_query("delete from ruta where documento_iddocumento='$iddoc'");
    insertar_ruta_solicitud_prestamo($ruta,$iddoc);
	}*/
}

function insertar_ruta_solicitud_prestamo($ruta,$iddoc){
	global $conn;
 for($i=0;$i<count($ruta)-1;$i++){
 	if(!isset($ruta[$i]["tipo_firma"]))
    $ruta[$i]["tipo_firma"]=1;
    $sql="insert into ruta (destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio) values('".	$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',1,1,$i,".$ruta[$i]["tipo_firma"].")" ;
    phpmkr_query($sql);
    $idruta=phpmkr_insert_id();
    $sql="insert into buzon_entrada (origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc',1,1,1,$idruta,'POR_APROBAR')" ;
    phpmkr_query($sql);
   }
}
/*POSTERIOR APROBAR*/
function transferir_coordinador_archivo($idformato,$iddoc){
	global $conn;
	$documento=busca_filtro_tabla("documento_archivo","ft_solicitud_prestamo","documento_iddocumento=".$iddoc,"",$conn);
	$archivo=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A","lower(cargo) like 'coordinador(a) archivo'","",$conn);
	if($documento[0]['documento_archivo']==1){
		transferencia_automatica($idformato,$iddoc,$archivo[0]['funcionario_codigo'],3);
	}
}

function seleccion_responsables_solicitud($idformato,$iddoc){
    global $conn,$ruta_db_superior;
  
  ?>
    <script>
    
      $(document).ready(function(){
       
        $('input[name=firmado][value=una]').attr('checked', 'checked');
        $('input[name=obligatorio][value=1]').attr('checked', 'checked');
        
      });
    </script>
    <?php
}
//Se adiciona funcion el dia 12/10/2017
function guardar_expedientes_prestamos($idformato,$iddoc){//Esta funcion se toma del formato transferencia_doc	
	global $conn;
	$ids=@$_REQUEST["id"];
	$texto="";
	if($ids){		
		//$expedientes=busca_filtro_tabla("nombre,codigo","expediente A","A.idexpediente in(".$ids.")","",$conn);
		$expedientes=busca_filtro_tabla("nombre,idexpediente,".fecha_db_obtener('fecha','Y-m-d')." AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie","expediente A","A.idexpediente in(".$ids.")","",$conn);
		$texto.='<td><ul>';
		for($i=0;$i<$expedientes["numcampos"];$i++){
			//$texto.="<li><input type='checkbox' name='transferencia_presta_temp' id='transferencia_presta_temp' value='".$expedientes[$i]["idexpediente"]."'>".$expedientes[$i]["nombre"]."(".$expedientes[$i]["fondo"]." ".$expedientes[$i]["codigo"].")</li>";
			$texto.="<li>".$expedientes[$i]["nombre"]."</li>";
			}
			$texto.="<input type='hidden' name='transferencia_presta' id='transferencia_presta' value='".$ids."'>";
		$texto.="</td>";
	}else if(@$_REQUEST['id_caja']){
	    $ids_caja=$_REQUEST['id_caja'];
        $expedientes=busca_filtro_tabla("A.nombre,A.idexpediente,".fecha_db_obtener('fecha','Y-m-d')." AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie","expediente A","A.fk_idcaja in(".$ids_caja.")","",$conn);
        $etiquetas=extrae_campo($expedientes,"nombre","");
        $idexpedientes=implode(',',extrae_campo($expedientes,"idexpediente","U"));
        $texto.="<td><ul><li>".implode("</li><li>",$etiquetas)."</li></ul>
		<input type='hidden' name='transferencia_presta' id='transferencia_presta' value='".$idexpedientes."'>
		</td>";
	}else if(@$_REQUEST['iddoc']){
	    $datos=busca_filtro_tabla("transferencia_presta","ft_solicitud_prestamo","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
	    $ids=$datos[0]['transferencia_presta'];
	    $expedientes=busca_filtro_tabla("idexpediente,nombre,fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie","expediente A","A.idexpediente in(".$ids.")","",$conn);
		$etiquetas=extrae_campo($expedientes,"nombre","");
		$texto.="<td><ul><li>".implode("</li><li>",$etiquetas)."</li></ul>
		<input type='hidden' name='transferencia_presta' id='transferencia_presta' value='".$ids."'>
		</td>";
	}
	else{
		$texto.="<td>No hay expedientes vinculados</td>";
}
	
	$html="
		<td>
			<table style='width:100%;border-collapse:collapse;border-color:#cac8c8;border-style:solid;border-width:1px;'  border='1'>
				<tr style='font-weight:bold;text-align:center;'>
					<td> <input type='checkbox' name='boton_todos' id='boton_todos' value='todos' checked> </td>
					<td> Nombre </td>
					<td> Fecha de creaci&oacute;n </td>
					<td> Indice uno </td>
					<td> Indice Dos </td>
					<td> Indice Tres </td>
					<td> Caja </td>
					<td> Serie asociada </td>
				</tr>	
	";
	
	
	for($i=0;$i<$expedientes['numcampos'];$i++){
		$caja=busca_filtro_tabla("fondo,codigo_dependencia,codigo_serie,no_consecutivo","caja","idcaja=".$expedientes[$i]['fk_idcaja'],"",$conn);
		$cadena_caja=$caja[0]['codigo_dependencia'].$caja[0]['codigo_serie'].$caja[0]['no_consecutivo']."(".$caja[0]['fondo'].")";
		
		$serie=busca_filtro_tabla("nombre","serie","idserie=".$expedientes[$i]['serie_idserie'],"",$conn);
		$cadena_serie=$serie[0]['nombre'];
		$html.="
			<tr>
				<td style='text-align:center; width:5%'> <input type='checkbox' name='transferencia_presta[]' value='".$expedientes[$i]['idexpediente']."' checked /> </td>
				<td> ".$expedientes[$i]['nombre']." </td>
				<td> ".$expedientes[$i]['fecha']." </td>
				<td> ".$expedientes[$i]['indice_uno']." </td>
				<td> ".$expedientes[$i]['indice_dos']." </td>
				<td> ".$expedientes[$i]['indice_tres']." </td>
				<td> ".$cadena_caja." </td>
				<td> ".$cadena_serie." </td>
			</tr>				
		";		
	}
	
	$html.="
			</table>
		</td>	
    <script>
    	$(document).ready(function(){
    		$('#boton_todos').click(function(){
				if( $(this).is(':checked') ){ //check
					$('[name=\"transferencia_presta[]\"]').attr('checked',true);		
				}else{  //un-check	
					$('[name=\"transferencia_presta[]\"]').attr('checked',false);		
				}	
    		});
    	});
    </script>		
	";
	
	
	echo($html);
}
//Se adiciona funcion el día 12/10/2017
function mostrar_expedientes_prestamos($idformato,$iddoc){//Esta funcion se toma del formato transferencia_doc
	global $conn, $ruta_db_superior;	
	//CAMBIO DEL MOSTRAR
	$texto='';
	$datos=busca_filtro_tabla("","ft_solicitud_prestamo A, documento B, ft_item_prestamo_exp C","A.idft_solicitud_prestamo=C.ft_solicitud_prestamo AND A.documento_iddocumento=".$iddoc." and A.documento_iddocumento=B.iddocumento","",$conn);
	$lista_expedientes=implode(',',extrae_campo($datos,'fk_expediente','U'));
	$expedientes=busca_filtro_tabla("","expediente A","A.idexpediente in(".$lista_expedientes.")","",$conn);
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
function codigo_qr_prestamo($idformato,$iddoc){
	global $conn;
	
	$estado_doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"", $conn);
	if($estado_doc[0]['estado']=='APROBADO'){
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
		if($codigo_qr['numcampos']){
		    if(file_exists($ruta_db_superior.$codigo_qr[0]['ruta_qr'])){
			    $extension=explode(".",$codigo_qr[0]['ruta_qr']);
			    $img='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"  />';		        
		    }else{
    			generar_codigo_qr_carta($idformato,$iddoc);
    			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
    			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
    			$img='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"   />';		        
		    }

		}else{
			generar_codigo_qr_carta($idformato,$iddoc);
			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"   />';
		}
		//echo($img);
	}
}
function habilitar_documento_archivo_function()
{
	?>
	<script type="text/javascript">
		var estado_archivo =  <?php echo $_REQUEST["estado_archivo"]; ?>;
		if(estado_archivo==1)
		{
			jQuery("#documento_archivo1").attr('checked', true);
		}
		else
		{
			if(estado_archivo==2)
			{
				jQuery("#documento_archivo0").attr('checked', true);
			}
			else
			{
				jQuery("#documento_archivo2").attr('checked', true);
			}
		}
	</script>
	<?php 	
}



function insertar_item_prestamo_exp($idformato,$iddoc){ //POSTERIOR AL APROBAR
	global $conn;
	
	$prestamo_expedientes=busca_filtro_tabla("transferencia_presta,idft_solicitud_prestamo","ft_solicitud_prestamo","documento_iddocumento=".$iddoc,"",$conn);
	$vector_prestamo_expedientes=explode(',',$prestamo_expedientes[0]['transferencia_presta']);
	for($i=0;$i<count($vector_prestamo_expedientes);$i++){
		$sql=" INSERT INTO ft_item_prestamo_exp (ft_solicitud_prestamo,fk_expediente)
			VALUES			
				(".$prestamo_expedientes[0]['idft_solicitud_prestamo'].",".$vector_prestamo_expedientes[$i].")
		
		";
		phpmkr_query($sql);
	}	
}
?>
