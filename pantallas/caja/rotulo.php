<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
include_once ($ruta_db_superior . "pantallas/qr/librerias.php");

$cons_logo = busca_filtro_tabla("valor", "configuracion", "nombre='logo' and tipo='empresa'", "", $conn);
if ($cons_logo["numcampos"]) {
	$ruta_archivo = json_decode($cons_logo[0]["valor"]);
	if (is_object($ruta_archivo)) {
		$logo_bin = StorageUtils::get_binary_file($cons_logo[0]["valor"], false);
		if ($logo_bin !== false) {
			$logo = $logo_bin;
		}
	}
}

if (@$_REQUEST["idcaja"]) {
	rotulo_caja($_REQUEST["idcaja"]);
	$enlace = $ruta_db_superior . "pantallas/almacenamiento/caja/cajaview.php?key=" . $_REQUEST["idcaja"];
} else if (@$_REQUEST["idexpediente"]) {
	rotulo_carpeta($_REQUEST["idexpediente"]);
	$enlace = $ruta_db_superior . "pantallas/almacenamiento/carpeta/folderview.php?key=" . $_REQUEST["idexpediente"];
}
if (@$_REQUEST["no_redireccionar"] == 1) {
	$enlace = '';
}

function obntener_niveles_dependencia_rotulo(&$array_dependencias, $iddependencia) {
	global $conn;

	$dependencia = busca_filtro_tabla("A.cod_padre, A.nombre", "dependencia A", "A.iddependencia=" . $iddependencia . " AND (cod_padre is not null or cod_padre<>0)", "", $conn);

	if ($dependencia["numcampos"]) {
		$array_dependencias[] = $dependencia[0]["nombre"];
		if ($dependencia[0]["cod_padre"]) {
			obntener_niveles_dependencia_rotulo($array_dependencias, $dependencia[0]["cod_padre"]);
		}
	}
}

function rotulo_caja($id){
	global $logo, $ruta_db_superior;
 
	$datos=busca_filtro_tabla(fecha_db_obtener('fecha_extrema_i','Y-m-d H:i')." as fecha_i, ".fecha_db_obtener('fecha_extrema_f','Y-m-d H:i')." as fecha_f, a.*","caja a","a.idcaja=".$id,"",$conn);

	$serie=busca_filtro_tabla("nombre,tipo,cod_padre","serie a","a.idserie=".$datos[0]["serie_idserie"],"",$conn);
	$nomb_serie="";
	$nomb_subserie="";
	if($serie[0]["tipo"]==1){
		$nomb_serie=$serie[0]["nombre"];
	}else if($serie[0]["tipo"]==2){
		$nomb_subserie=$serie[0]["nombre"];
		if($serie[0]["cod_padre"]){
			$serie2=busca_filtro_tabla("nombre,tipo,cod_padre","serie a","a.idserie=".$serie[0]["cod_padre"],"",$conn);
			if($serie2["numcampos"] && $serie2[0]["tipo"]==1){
				$nomb_serie=$serie2[0]["nombre"];
			}
		}	
	}

	$dep=busca_filtro_tabla("","dependencia a, dependencia_cargo b","a.iddependencia=b.dependencia_iddependencia and b.funcionario_idfuncionario=".$datos[0]["funcionario_idfuncionario"]." and b.estado=1","",$conn);

	
	$ruta_archivo = json_decode($datos[0]["ruta_qr"]);
	if (is_object($ruta_archivo)) {
		$qr_bin = StorageUtils::get_binary_file($datos[0]["ruta_qr"], false);
		if ($qr_bin !== false) {
			$ruta_qr=$qr_bin;
		}
	}else{
		$cadena="idcaja=".$id;
		$codificada=encrypt_blowfish($cadena,LLAVE_SAIA_CRYPTO);
		$datos_qr = RUTA_INFO_QR . "info_qr_expediente.php?key_cripto=" . $codificada;
		$ruta="caja/".$id."/";
		$info_qr=generar_qr_datos($ruta,$datos_qr);
		if($info_qr["exito"]){
			$sql_documento_qr="UPDATE caja SET ruta_qr='".$info_qr["ruta_qr"]."' WHERE idcaja=".$id;
			phpmkr_query($sql_documento_qr);
			$qr_bin = StorageUtils::get_binary_file($info_qr["ruta_qr"], false);
			if ($qr_bin !== false) {
				$ruta_qr=$qr_bin;
			}
		}else{
			notificaciones($info_qr["msn"],"error");
		}
	}	
?>
<table style="border-collapse:collapse;font-family:arial;font-size:8pt; width:453px; height: 650px; margin: 15px 0px 0px 33px;" border="1px">
	<tr>
		<td colspan="3" style="text-align:center"><img src="<?php echo $logo; ?>" border="0px"><br /><br /><img src="<?php echo($ruta_qr); ?>"></td>
	</tr>
	<tr>
		<td><b>FONDO</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["fondo"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>SECCION</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["seccion"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>SUBSECCION</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["subseccion"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>DIVISION</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["division"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>CODIGO</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["no_consecutivo"]); ?></td>
	</tr>
		<?php
	$expedientes=busca_filtro_tabla("es.serie_idserie","expediente e, entidad_serie es","e.fk_entidad_serie=es.identidad_serie and fk_idcaja=".$datos[0]["idcaja"],"",$conn);
if($expedientes["numcampos"]){
	$listado_series = array();
	for($i=0;$i<$expedientes["numcampos"];$i++){
		$series=busca_filtro_tabla("nombre","serie","idserie=".$expedientes[$i]["serie_idserie"],"",$conn);
		$listado_series[]=$series[0]["nombre"];
	}
}
$listado_series=array_unique($listado_series);
$listado_series=implode(", ", $listado_series);?>
	<tr height="30px">
		<td><b>SERIE</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($listado_series); /*mayusculas($nomb_serie);*/ ?></td>
	</tr>
	<tr height="30px">
		<td><b>SUBSERIE</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($nomb_subserie); ?></td>
	</tr>
	<tr>
		<td><b>No. CARPETA</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["no_carpetas"]); ?></td>
	</tr>
	<tr>
		<td><b>No. CAJA</b></td>
		<td colspan="2" style="text-align:center;font-size:18pt"><?php echo mayusculas($datos[0]["no_cajas"]); ?></td>
	</tr>
	<!--tr>
		<td><b>No. CONSECUTIVO</b></td>
		<td colspan="2" style="text-align:center;"><?php echo mayusculas($datos[0]["no_consecutivo"]); ?></td>
	</tr-->
	<!--tr>
		<td><b>No. CORRELATIVO</b></td>
		<td colspan="2" style="text-align:center;"><?php echo mayusculas($datos[0]["no_consecutivo"]); ?></td>
	</tr-->
	<tr>
		<td rowspan="2" style="text-align:center;">FECHAS EXTREMAS</td>
		<td style="text-align:center;">Fecha inicial</td>
		<td style="text-align:center;">Fecha final</td>
	</tr>
	<tr>
		<td style="text-align:center;"><?php echo ($datos[0]["fecha_extrema_i"]); ?></td>
		<td style="text-align:center;"><?php echo ($datos[0]["fecha_extrema_f"]); ?></td>
	</tr>
</table>
<?php
}

function rotulo_carpeta($id){
	global $conn, $logo, $ruta_db_superior;
        
	$datos=busca_filtro_tabla(fecha_db_obtener('fecha_extrema_i','Y-m-d')." as fecha_i, ".fecha_db_obtener('fecha_extrema_f','Y-m-d')." as fecha_f, a.*","expediente a","a.idexpediente=".$id,"",$conn);
	$caja=busca_filtro_tabla("","caja a","a.idcaja=".$datos[0]["fk_idcaja"],"",$conn);
	
	$serie=busca_filtro_tabla("nombre,tipo,cod_padre","serie a","a.idserie=".$datos[0]["serie_idserie"],"",$conn);
	$buscar_entidad_serie=busca_filtro_tabla("llave_entidad, serie_idserie","entidad_serie","identidad_serie=".$datos[0]["fk_entidad_serie"],"",$conn);
if($buscar_entidad_serie["numcampos"]){
	$iddependencia = $buscar_entidad_serie[0]["llave_entidad"];
	$idserie = $buscar_entidad_serie[0]["serie_idserie"];
	$buscar_dependencia=busca_filtro_tabla("codigo","dependencia","iddependencia=".$iddependencia,"",$conn);
	if($buscar_dependencia["numcampos"]){
		$codigo_dependencia = $buscar_dependencia[0]["codigo"];
	}
	$buscar_serie=busca_filtro_tabla("codigo","serie","idserie=".$idserie,"",$conn);
	if($buscar_serie["numcampos"]){
		$codigo_serie = $buscar_serie[0]["codigo"];
	}
}
	$nomb_serie="";
	$nomb_subserie="";
	if($serie[0]["tipo"]==1){
		$nomb_serie=$serie[0]["nombre"];
	}else if($serie[0]["tipo"]==2){
		$nomb_subserie=$serie[0]["nombre"];
		if($serie[0]["cod_padre"]){
			$serie2=busca_filtro_tabla("nombre,tipo","serie a","a.idserie=".$serie[0]["cod_padre"],"",$conn);
			if($serie2["numcampos"] && $serie2[0]["tipo"]==1){
				$nomb_serie=$serie2[0]["nombre"];
			}
		}	
	}
		
	$secciones = explode(',',$datos[0]["unidad_admin"]);
	
	$array_dependencias = array();
	obntener_niveles_dependencia_rotulo($array_dependencias, $secciones[0]);
	$array_dependencias = array_reverse($array_dependencias);
	
	$subseccioni=busca_filtro_tabla("nombre,cod_padre","dependencia a","a.iddependencia=".$secciones[0],"",$conn);
	$subseccionii=busca_filtro_tabla("nombre","dependencia a","a.iddependencia=".$secciones[1],"",$conn);	
	$seccion=busca_filtro_tabla("nombre","dependencia a","a.iddependencia=".$subseccioni[0]['cod_padre'],"",$conn);
			
	$ruta_archivo = json_decode($datos[0]["ruta_qr"]);
	if (is_object($ruta_archivo)) {
		$qr_bin = StorageUtils::get_binary_file($datos[0]["ruta_qr"], false);
		if ($qr_bin !== false) {
			$ruta_qr=$qr_bin;
		}
	}else{
		$cadena="idexpediente=".$id;
		$codificada=encrypt_blowfish($cadena,LLAVE_SAIA_CRYPTO);
		$datos_qr = RUTA_INFO_QR . "info_qr_expediente.php?key_cripto=" . $codificada;
		$ruta="expediente/".$id."/";
		$info_qr=generar_qr_datos($ruta,$datos_qr);
		if($info_qr["exito"]){
			$sql_documento_qr="UPDATE expediente SET ruta_qr='".$info_qr["ruta_qr"]."' WHERE idexpediente=".$id;
			phpmkr_query($sql_documento_qr);
			$qr_bin = StorageUtils::get_binary_file($info_qr["ruta_qr"], false);
			if ($qr_bin !== false) {
				$ruta_qr=$qr_bin;
			}
		}else{
			notificaciones($info_qr["msn"],"error");
		}
	}
?>
<style>
.vertical {
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>
<table style="border-collapse:collapse; font-family:arial; font-size:8pt; width:453px; height:642px; margin: 33px 0px 0px 33px;" border="1px">
	<tr>
		<td colspan="19" style="text-align:center">DESCRIPCION DEL EXPEDIENTE</td>
	</tr>
	<tr>
		<td style="text-align:center"><b>Nombre<br>Expediente</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["nombre"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>No. de Tomo</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["tomo_no"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>CODIGO No.</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($codigo_dependencia." - ".$codigo_serie." - ".$datos[0]["codigo_numero"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>FONDO</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["fondo"]); ?></td>
	</tr>
	<!--tr>
		<td style="text-align:center"><b>SECCION</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($array_dependencias[0]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSECCION I</b></td>
		<td style="text-align:center" colspan="2">
			<?php 
				echo(mayusculas($array_dependencias[1])); 
			?>
		</td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSECCION II</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($array_dependencias[2]); ?></td>
	</tr-->
	<?php
	/*$expedientes=busca_filtro_tabla("es.serie_idserie","expediente e, entidad_serie es","e.fk_entidad_serie=es.identidad_serie and fk_idcaja=".$caja[0]["idcaja"],"",$conn);
if($expedientes["numcampos"]){
	$listado_series = array();
	for($i=0;$i<$expedientes["numcampos"];$i++){
		$series=busca_filtro_tabla("nombre","serie","idserie=".$expedientes[$i]["serie_idserie"],"",$conn);
		$listado_series[]=$series[0]["nombre"];
	}
}
$listado_series=array_unique($listado_series);
$listado_series=implode(", ", $listado_series);*/?>
	<tr>
		<td style="text-align:center"><b>SERIE</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($nomb_serie); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSERIE</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($nomb_subserie); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>PROCESO</b></td>
		<td colspan="2" style="text-align:center"><?php echo($datos[0]["proceso"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>Observaciones</b></td>
		<td colspan="2" style="text-align:center"><?php echo ($datos[0]["descripcion"]); ?></td>
	</tr>
	<tr>
		<td rowspan="2" style="text-align:center"><b>FECHAS EXTREMAS</b></td>
		<td style="text-align:center"><b>Fecha inicial</b></td>
		<td style="text-align:center"><b>Fecha Final</b></td>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo ($datos[0]["fecha_i"]); ?></td>
		<td style="text-align:center"><?php echo ($datos[0]["fecha_f"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>No. folios</b></td>
		<td style="text-align:center"><b>No. Carpeta</b></td>
		<td style="text-align:center"><b>No. caja</b></td>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo ($datos[0]["no_folios"]); ?></td>
		<td style="text-align:center"><?php echo ($datos[0]["no_carpeta"]); ?></td>
		<td style="text-align:center"><?php echo ($caja[0]["no_cajas"]); ?></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center"><img src="<?php echo $logo; ?>" border="0px">
			<br/>
			<br/>
			<img src="<?php echo $ruta_qr; ?>"/>
		</td>
	</tr>
</table>
<?php
}
?>
<html>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="imprime();">
		<script language="javascript">
		function comando_documento(sComando){
		  if (!document.execCommand){
		      alert("Funcion no disponible en su explorador");
		      return false;
		  }
		  document.execCommand(sComando);
		}
		
		function imprime(atras){
		  window.focus();
		  var url = "<?php echo $enlace; ?>"; 
		  window.print();
		}	
		</script>
	</body>
</html>