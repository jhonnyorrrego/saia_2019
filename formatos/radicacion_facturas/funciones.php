<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."app/qr/librerias.php");

function mostrar_radicado_factura($idformato,$iddoc){
	global $conn;
	if($_REQUEST["iddoc"]){
		$doc=busca_filtro_tabla("","documento a","iddocumento=".$_REQUEST["iddoc"],"",$conn);
		echo '<td><b>'.$doc[0]["numero"].'</b></td>'; 
	}
	else
		echo '<td><b>'.muestra_contador("radicacion_entrada").'</b></td>';
}
function add_edit(){
	global $conn;
	$fecha=date('Y-m-d H-i-s');
	?>
	<script>
		$(document).ready(function(){
			$("#fecha_radicado").val('<?php echo $fecha; ?>');
			$("#fecha_radicado").attr("readonly","readonly");
		});
	</script>
	<?php
}

function mostrar_informacion_general_factura($idformato, $iddoc) {
	global $conn, $ruta_db_superior, $datos;
	$datos = busca_filtro_tabla("serie_idserie,numero_radicado,descripcion,anexos_fisicos,anexos_digitales," . fecha_db_obtener("fecha_radicado", "Y-m-d") . " AS fecha_radicado," . fecha_db_obtener("fecha_radicado", "Y-m-d") . " AS fecha_radicado,estado", "ft_radicacion_facturas", "documento_iddocumento=" . $iddoc, "", $conn);
	$documento = busca_filtro_tabla("numero,tipo_radicado," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha", "documento", "iddocumento=" . $iddoc, "", $conn);
	$tipo_documento = busca_filtro_tabla("nombre", "serie", "idserie=" . $datos[0]["serie_idserie"], "", $conn);
	$fecha_radicacion = $documento[0]['fecha'];
	$numero_radicado = $datos[0]['fecha_radicado'] . "-" . $documento[0]['numero'];

	$estado_doc = busca_filtro_tabla("", "documento", "iddocumento=" . $iddoc, "", $conn);
	if ($estado_doc[0]['estado'] == 'APROBADO') {
		$img = mostrar_codigo_qr($idformato, $iddoc, 1);
	}
	$tabla = '<table class="table table-bordered" style="width: 100%;  text-align:left;" border="1">
  <tr>
    <td style="width: 25%;"><b>Fecha de radicaci&oacute;n:</b></td>
    <td style="width: 15%;">' . $fecha_radicacion . '</td>
    <td style="width: 15%;"><b>No. Radicado:</b></td>
    <td style="width: 15%;">' . $numero_radicado . '</td>
    <td style="text-align:center; width: 30%;" colspan="2" rowspan="3">' . $img . '<br><b>Radicado No.</b>' . $numero_radicado . '</td>
  </tr>
  <tr>
    <td><b>Tipo de documento:</b></td>
    <td colspan="3">' . $tipo_documento[0]["nombre"] . '</td> 
  </tr>
  <tr>
    <td><b>Descripci&oacute;n servicio o producto:</b></td>
    <td colspan="3">' . $datos[0]["descripcion"] . '</td>
  </tr>
	  <tr>
	    <td><b>Anexos digitales:</b></td>
	    <td colspan="2">' . ver_anexos_documento($idformato, $iddoc, 1) . '</td>
	    <td><b>Anexos F&iacute;sicos:</b></td>
	    <td>' . $datos[0]["anexos_fisicos"] . '</td>
	  </tr>	    
</table>';
	echo $tabla;
}

function item_factura($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	$anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
	if(!$anexos['numcampos']){
		echo '<span style="color:red; font-weight: bold;">El documento no tiene anexo</span><br><br>';
	}
	$dato=busca_filtro_tabla("","ft_radicacion_facturas A join documento B on A.documento_iddocumento=B.iddocumento left join ft_item_facturas c on A.idft_radicacion_facturas=c.ft_radicacion_facturas","B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);  
	
	if($_REQUEST['tipo']!=5 && empty($dato[0]['idft_item_facturas'])){
			$permiso_mod=new Permiso();
			$ok1=$permiso_mod->acceso_modulo_perfil("permiso_clasificacion_factura");
			if($ok1){
				echo '<a style="color: #FFFFFF;text-decoration:none;" href="../item_facturas/adicionar_item_facturas.php?pantalla=padre&amp;idpadre='.$iddoc.'&amp;idformato='.$idformato.'&amp;padre='.$dato[0]['idft_radicacion_facturas'].'&anterior='.$iddoc.'" target="_self"><button class="btn btn-warning btn-mini">CLASIFICACIÓN DE FACTURA</button></a>'; 	
			} 
	}else{
		$estado_doc=busca_filtro_tabla("activa_admin","documento","iddocumento=".$iddoc,"",$conn);
		if($dato[0]['idft_item_facturas'] && $estado_doc[0]['activa_admin']==1){
			$idform_item=busca_filtro_tabla("idformato","formato","nombre like 'item_facturas'","",$conn);
			echo '<a style="color: #FFFFFF;text-decoration:none;" href="../item_facturas/editar_item_facturas.php?idformato='.$idform_item[0]['idformato'].'&iddoc='.$dato[0]['idft_item_facturas'].'&item='.$dato[0]['idft_item_facturas'].'" target="_self"><button class="btn btn-warning btn-mini">CLASIFICACIÓN DE FACTURA</button></a>';	
		}
	}

	$item=busca_filtro_tabla("concat(b.nombres,' ',b.apellidos,' - ',b.cargo) as nombre,a.*","ft_item_facturas a,vfuncionario_dc b","a.dependencia=b.iddependencia_cargo and ft_radicacion_facturas=".$dato[0]['idft_radicacion_facturas'],"",$conn);
	if($item['numcampos']){
		include_once($ruta_db_superior."class_transferencia.php");
		$tabla='<table class="table table-bordered" style="width: 100%;" border="1">
		<tr>
			<td style="font-weight:bold; text-align:center;">Clasificacion</td><td style="font-weight:bold; text-align:center;">Valor de la factura</td><td style="font-weight:bold; text-align:center;">Fecha programada de pago</td><td style="font-weight:bold; text-align:center;">Prioridad</td><td style="font-weight:bold; text-align:center;">Numero orden compra/contrato</td><td style="font-weight:bold; text-align:center;">Responsable</td><td style="font-weight:bold; text-align:center;">Realizado por</td>
		</tr>';
		for ($i=0; $i < $item['numcampos']; $i++) {
			if($item[$i]["transferido"]!=1 && $item[$i]["responsable"]!=""){
				transferencia_automatica($idformato, $iddoc, $item[$i]["responsable"], 1);
				$update="UPDATE ft_item_facturas SET transferido=1 WHERE idft_item_facturas=".$item[$i]["idft_item_facturas"];
				phpmkr_query($update);
			}
			switch ($item[$i]['clasificacion_fact']) {
				case '1':
					$clasif='Orden de Compra';
					break;
				case '2':
					$clasif='Contrato';
					break;
				case '3':
					$clasif='Servicios públicos - Administración';
					break;
				case '4':
					$clasif='Cuenta de cobro';
					break;
			}
			
			switch ($item[$i]['prioridad']) {
				case '1':
					$prioridad='Baja';
					break;
				case '2':
					$prioridad='Media';
					break;
				case '3':
					$prioridad='Alta';
					break;
			}
			$resp=busca_filtro_tabla("concat(nombres,' ',apellidos) as nombre","vfuncionario_dc","iddependencia_cargo=".$item[$i]['responsable'],"",$conn);
			$tabla.='<tr>
					<td>'.$clasif.'</td><td style="text-align:right;"> $'.number_format($item[$i]['valor_factura']).'</td><td style="text-align:center;">'.$item[$i]['fecha_programada'].'</td><td style="text-align:center;">'.$prioridad.'</td><td style="text-align:center;">'.$item[$i]['numero_orden'].'</td><td style="text-align:left;">'.$resp[0]['nombre'].'</td><td style="text-align:left;">'.$item[$i]['nombre'].'</td>
				</tr>';
		}
		$tabla.='</table>';
		echo $tabla;
		
		//----ITEM APROBACIONES
		$item_recibida=busca_filtro_tabla("a.*,".fecha_db_obtener("fecha_recibida","Y-m-d")." as fecha","ft_item_recibidos a","a.ft_radicacion_facturas=".$dato[0]['ft_radicacion_facturas'],"idft_item_recibidos desc",$conn);
		$cargo_juridica=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","estado=1 and estado_dc=1 and cargo like 'Aprobador Juridica' and funcionario_codigo=".$_SESSION['usuario_actual'],"",$conn);
		if($_REQUEST['tipo']!=5){
			?>
			<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
			 <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
			 <script type='text/javascript'>
			   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			   hs.outlineType = 'rounded-white';
			</script>
			<?php
			$boton1= '<br/><br/><a style="color: #FFFFFF;text-decoration:none;" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 400, height: 485,preserveContent:false} )" href="acciones_aprobaciones.php?idft='.$dato[0]['idft_radicacion_facturas'].'&idformato='.$idformato.'&iddoc='.$iddoc.'&clasificacion='.$dato[0]['clasificacion_fact'].'"><button class="btn btn-warning btn-mini">Aprobaciones</button></a><br><br>'; 
			
			if(($item_recibida[0]['tipo_recibido']==1 || $dato[0]['clasificacion_fact']<>2) && $cargo_juridica[0]['funcionario_codigo']){
				echo $boton1;
			}else if(!$cargo_juridica[0]['funcionario_codigo']){
				echo $boton1;
			}
			
		}
		
		$aprobacion=busca_filtro_tabla("concat(b.nombres,' ',b.apellidos,' - ',b.cargo) as nombre,a.*","ft_item_aprobaciones a,vfuncionario_dc b","a.dependencia=b.iddependencia_cargo and ft_radicacion_facturas=".$dato[0]['ft_radicacion_facturas'],"idft_item_aprobaciones desc",$conn);

		if($aprobacion['numcampos']){
			$tabla_aprobacion='<table class="table table-bordered" style="width: 100%;" border="1">
			<tr><td colspan="5" style="text-align:center; background-color: #319ecd;";><span style="color: #ffffff;"><strong>APROBACIONES</strong></span></td></tr>
			<tr>
				<td style="font-weight:bold; text-align:center;">Fecha</td><td style="font-weight:bold; text-align:center;">Funcionario responsable</td><td style="font-weight:bold; text-align:center;">Transferido a</td><td style="font-weight:bold; text-align:center;">Accion</td><td style="font-weight:bold; text-align:center;">Observacion</td>
			</tr>';
			
			for ($i=0; $i < $aprobacion['numcampos']; $i++) {
				switch ($aprobacion[$i]['accion']) {
					case 'contabilidad':
						$accion="Para aprobacion de contabilidad";
						$tipo_transferencia=1;
						break;
					case 'presupuesto':
						$accion="Para aprobacion de presupuesto";
						$tipo_transferencia=1;
						break;
					case 'tesoreria':
						$accion="Para aprobacion de tesoreria";
						$tipo_transferencia=1;
						break;
					case 'juridica':
						$accion="Para aprobación de jurídica";
						$tipo_transferencia=1;
						break;
					case 'aprobacion_compras':
						$accion="Para aprobación de Compras";
						$tipo_transferencia=1;
						break;
					case 'devolucion_it':
						$accion="Devolucion";
						$tipo_transferencia=2;
						break;
					case 'anulada':
						$accion="Anular";
						break;
					case 'pagada':
						$accion="Pagada";
						break;
				}
				if($tipo_transferencia==1){
					$transferido_a=busca_filtro_tabla("concat(b.nombres,' ',b.apellidos) as nombre","funcionario b","b.estado=1 and b.funcionario_codigo in (".$aprobacion[$i]['transferido_a'].")","",$conn);
				}else if($tipo_transferencia==2){
					$transferido_a=busca_filtro_tabla("concat(b.nombres,' ',b.apellidos) as nombre","funcionario b","b.estado=1 and b.iddependencia_cargo in (".$aprobacion[$i]['arbol_devuelto'].")","",$conn);
				}
				$tabla_aprobacion.='<tr>
					<td style="text-align:center;">'.$aprobacion[$i]['fecha_aprobacion'].'</td><td style="text-align:center;"> '.$aprobacion[$i]['nombre'].'</td><td style="text-align:center;"> '.mayusculas(strip_tags(implode(" - ",extrae_campo($transferido_a,"nombre")))).'</td><td style="text-align:center;">'.$accion.'</td><td style="text-align:center;">'.$aprobacion[$i]['observaciones'].'</td>
				</tr>';
			}
			$tabla_aprobacion.='</table>';
			echo $tabla_aprobacion;
		}	
		if($item_recibida['numcampos']){
			$tabla_recibida='<table class="table table-bordered" style="width: 100%;" border="1">
		<tr><td colspan="4" style="text-align:center; background-color: #319ecd;";><span style="color: #ffffff;"><strong>Documentos fisicos recibidos?</strong></span></td></tr>
		<tr>
			<td style="font-weight:bold; text-align:center;">Fecha</td><td style="font-weight:bold; text-align:center;">Documentos fisicos recibidos?</td><td style="font-weight:bold; text-align:center;">Observaciones</td><td style="font-weight:bold; text-align:center;">Realizado por</td>
		</tr>';
			
			for ($i=0; $i < $item_recibida['numcampos']; $i++) {
				switch ($item_recibida[$i]['tipo_recibido']) {
					case '1':
						$tipo='Si';
						break;
					case '2':
						$tipo='No';
						break;
					case '3':
						$tipo='Incompleto';
						break;
				}
				$funcionario=busca_filtro_tabla("concat(nombres,' ',apellidos) as nombre","funcionario","funcionario_codigo=".$item_recibida[0]['creador_recibida'],"",$conn);
				$tabla_recibida.='<tr>
				<td style="text-align:center;">'.$item_recibida[$i]['fecha'].'</td><td style="text-align:center;"> '.$tipo.'</td><td style="text-align:center;"> '.$item_recibida[0]['observaciones_reci'].'</td><td style="text-align:center;">'.$funcionario[0]['nombre'].'</td>
			</tr>';
			}
			
			$tabla_recibida.="</table>";
			echo $tabla_recibida;
		}
		if($item_recibida[0]['tipo_recibido']<>1 && $cargo_juridica[0]['funcionario_codigo'] && $dato[0]['clasificacion_fact']==2){
			if($_REQUEST['tipo']!=5){
				echo '<br/><br/><a style="color: #FFFFFF;text-decoration:none;" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 400, height: 350,preserveContent:false} )" href="documentos_recibidos.php?idft='.$dato[0]['idft_radicacion_facturas'].'&idformato='.$idformato.'&iddoc='.$iddoc.'"><button class="btn btn-warning btn-mini">Documentos fisicos recibidos?</button></a><br><br>';
			}
		}
	}

}

function transferir_copia($idformato, $iddoc) {
	global $conn;
	$clasificador = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "cargo like lower('clasificador%factura') and estado=1 and estado_dc=1", "", $conn);
	if ($clasificador['numcampos']) {
		$total_funcionarios = extrae_campo($clasificador, "funcionario_codigo");
		transferencia_automatica($idformato, $iddoc, implode("@", $total_funcionarios), 3);
	}
	$dato = busca_filtro_tabla("copia_electronica", "ft_radicacion_facturas", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($dato["numcampos"] && $dato[0]["copia_electronica"] != "") {
		$separado = explode(",", $dato[0]['copia_electronica']);
		$funcionarios = '';
		foreach ($separado as $value) {
			if (strpos($value, "#") > 1) {
				$dato = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and iddependencia=" . $value, "", $conn);
				if ($dato["numcampos"]) {
					$funcionarios = implode(",", extrae_campo($dato, 'funcionario_codigo'));
					transferencia_automatica($idformato, $iddoc, str_replace(",", "@", $funcionarios), 3);
				}
			} else {
				$dato = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "estado=1 and iddependencia_cargo=" . $value, "", $conn);
				if ($dato["numcampos"]) {
					transferencia_automatica($idformato, $iddoc, $dato[0]['funcionario_codigo'], 3);
				}
			}
		}
	}
	return;
}

function estado_facturas($idformato,$iddoc){
	global $conn,$datos;
	$cadena="";
	
	if($datos[0]['estado']==2){
		$estado='Devuelta';
			$cadena.="<button class='btn btn-danger btn-mini'>".$estado."</button>";
	}else if($datos[0]['estado']==5){
		$estado='Pagada';
		$cadena.="<button class='btn btn-success btn-mini'>".$estado."</button>";
	}else if($datos[0]['estado']==4){
		$cadena.="<button class='btn btn-danger btn-mini'>Anulada</button>";
	}else{
		switch ($datos[0]['estado']) {
			case '1':
				$estado='Recibida';
				break;
			
			case '3':
				$estado='En proceso';
				break;
			
		}
		$cadena.="<button class='btn btn-warning btn-mini'>".$estado."</button>";
	}
	if($_REQUEST['tipo']!=5){
		echo $cadena;
	}else{
		echo $estado;
	}
	
}
?>