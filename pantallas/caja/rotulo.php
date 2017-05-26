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
include_once ($ruta_db_superior."db.php");
include_once($ruta_db_superior."StorageUtils.php");
require_once $ruta_db_superior.'filesystem/SaiaStorage.php';

?>
<html lang="en">
<?php
clearstatcache();
$no_cache = md5(time()); 
$almacenamiento=new SaiaStorage(RUTA_LOGO_SAIA);

$conf=busca_filtro_tabla("","configuracion a","nombre='logo'","",$conn);
$logo=json_decode($conf[0]['valor']);
if($almacenamiento->get_filesystem()->has($ruta_imagen->ruta) && $logo){
	$logo=StorageUtils::get_binary_file($conf[0]['valor']);
} else {
$logo=$conf[0]["valor"];
}

if(@$_REQUEST["idcaja"]){
	rotulo_caja($_REQUEST["idcaja"]);
	$enlace=$ruta_db_superior."pantallas/almacenamiento/caja/cajaview.php?key=".$_REQUEST["idcaja"];
}
else if(@$_REQUEST["idexpediente"]){
	rotulo_carpeta($_REQUEST["idexpediente"]);
	$enlace=$ruta_db_superior."pantallas/almacenamiento/carpeta/folderview.php?key=".$_REQUEST["idexpediente"];
}
if(@$_REQUEST["no_redireccionar"]==1){
	$enlace='';
}
?>
<script language="javascript">
<!--
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
  //if(url!="")
     //window.open("<?php echo $enlace; ?>","previsualizar");       
  //else
  	//window.close();
}	
-->
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"
<?php	
	if($_SESSION['LOGIN'] == 'cerok'){
?>
		>
<?php
	}else{
?>
	onLoad="imprime();">
<?php
}
?>
</body>
</html>
<?php

function rotulo_caja($id){
	global $logo, $ruta_db_superior;
  $tipo_almacenamiento = new SaiaStorage(RUTA_QR);
  
	$datos=busca_filtro_tabla(fecha_db_obtener('fecha_extrema_i','Y-m-d H:i')." as fecha_i, ".fecha_db_obtener('fecha_extrema_f','Y-m-d H:i')." as fecha_f, a.*","caja a","a.idcaja=".$id,"",$conn);
	$serie=busca_filtro_tabla("","serie a","a.idserie=".$datos[0]["serie_idserie"],"",$conn);
	if($serie[0]["cod_padre"]){
		$serie2=busca_filtro_tabla("","serie a","a.idserie=".$serie[0]["cod_padre"],"",$conn);
		
	}	
	$dep=busca_filtro_tabla("","dependencia a, dependencia_cargo b","a.iddependencia=b.dependencia_iddependencia and b.funcionario_idfuncionario=".$datos[0]["funcionario_idfuncionario"]." and b.estado=1","",$conn);
  $ruta_imagen=json_decode($datos[0]["ruta_qr"]);
	
	if($tipo_almacenamiento->get_filesystem()->has($ruta_imagen->ruta) && $ruta_imagen){    
    $archivo_binario=StorageUtils::get_binary_file($datos[0]["ruta_qr"]);
	  $ruta_qr=$archivo_binario;
	}
	else{
		include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
		$cadena="idcaja=".$id;
		$codificada=encrypt_blowfish($cadena,LLAVE_SAIA_CRYPTO);
		$datos_qr=PROTOCOLO_CONEXION.RUTA_PDF."/pantallas/caja/info_caja_exp.php?key_cripto=".$codificada;
		$ruta="caja/".$id."/";
		$imagen=generar_qr_datos($ruta,$datos_qr);
    $imagen=json_encode($imagen);
		$sql_documento_qr="UPDATE caja SET ruta_qr='".$imagen."' WHERE idcaja=".$id;	  	  
	  phpmkr_query($sql_documento_qr);
    $archivo_binario=StorageUtils::get_binary_file($imagen);
    
		$ruta_qr=$archivo_binario;
	}	
?>
<table style="border-collapse:collapse;font-family:arial;font-size:8pt; width:453px; height: 650px; margin: 15px 0px 0px 33px;" border="1px">
	<tr>
		<td colspan="3" style="text-align:center"><img src="<?php echo $logo; ?>" border="0px"><br /><img src="<?php echo($ruta_qr); ?>"></td>
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
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["codigo"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>SERIE</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($serie2[0]["nombre"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>SUBSERIE</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($serie[0]["nombre"]); ?></td>
	</tr>
	<tr>
		<td><b>No. CARPETA</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["no_carpetas"]); ?></td>
	</tr>
	<tr>
		<td><b>No. CAJA</b></td>
		<td colspan="2" style="text-align:center;font-size:18pt"><?php echo mayusculas($datos[0]["no_cajas"]); ?></td>
	</tr>
	<tr>
		<td><b>No. CONSECUTIVO</b></td>
		<td colspan="2" style="text-align:center;"><?php echo mayusculas($datos[0]["no_consecutivo"]); ?></td>
	</tr>
	<tr>
		<td><b>No. CORRELATIVO</b></td>
		<td colspan="2" style="text-align:center;"><?php echo mayusculas($datos[0]["no_consecutivo"]); ?></td>
	</tr>
	<tr>
		<td rowspan="2" style="text-align:center;">FECHAS EXTREMAS</td>
		<td style="text-align:center;">Fecha inicial</td>
		<td style="text-align:center;">Fecha final</td>
	</tr>
	<tr>
		<td><?php echo ($datos[0]["fecha_extrema_i"]); ?></td>
		<td><?php echo ($datos[0]["fecha_extrema_f"]); ?></td>
	</tr>
</table>
<?php
}
function rotulo_carpeta($id){
	global $conn, $logo, $ruta_db_superior;
  $tipo_almacenamiento = new SaiaStorage(RUTA_QR);
      
	$datos=busca_filtro_tabla(fecha_db_obtener('fecha_extrema_i','Y-m-d')." as fecha_i, ".fecha_db_obtener('fecha_extrema_f','Y-m-d')." as fecha_f, a.*","expediente a","a.idexpediente=".$id,"",$conn);
	$caja=busca_filtro_tabla("","caja a","a.idcaja=".$datos[0]["fk_idcaja"],"",$conn);
	$serie=busca_filtro_tabla("","serie a","a.idserie=".$datos[0]["serie_idserie"],"",$conn);
	if($serie[0]["cod_padre"]){
		$serie2=busca_filtro_tabla("","serie a","a.idserie=".$serie[0]["cod_padre"],"",$conn);
		
	}
	//$dep=busca_filtro_tabla("","dependencia a, dependencia_cargo b","a.iddependencia=b.dependencia_iddependencia and b.funcionario_idfuncionario=".$datos[0]["funcionario_idfuncionario"]." and b.estado=1","",$conn);
	
	$secciones = explode(',',$datos[0]["unidad_admin"]);
	
	$array_dependencias = array();
	obntener_niveles_dependencia_rotulo($array_dependencias, $secciones[0]);
	$array_dependencias = array_reverse($array_dependencias);
	
	$subseccioni=busca_filtro_tabla("nombre,cod_padre","dependencia a","a.iddependencia=".$secciones[0],"",$conn);
	$subseccionii=busca_filtro_tabla("nombre","dependencia a","a.iddependencia=".$secciones[1],"",$conn);	
	$seccion=busca_filtro_tabla("nombre","dependencia a","a.iddependencia=".$subseccioni[0]['cod_padre'],"",$conn);
	
  $ruta_imagen=json_decode($datos[0]["ruta_qr"]);	  
	
	if($tipo_almacenamiento->get_filesystem()->has($ruta_imagen->ruta) && $ruta_imagen){
    $archivo_binario=StorageUtils::get_binary_file($datos[0]['ruta_qr']);
		$ruta_qr=$archivo_binario;
	}
	else{
		include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
		$cadena="idexpediente=".$id;
		$codificada=encrypt_blowfish($cadena,LLAVE_SAIA_CRYPTO);
		$datos_qr=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/pantallas/caja/info_caja_exp.php?key_cripto=".$codificada;
		$ruta="expediente/".$id."/";
		$imagen=generar_qr_datos($ruta,$datos_qr);
    $imagen=json_encode($imagen);
		$sql_documento_qr="UPDATE expediente SET ruta_qr='".$imagen."' WHERE idexpediente=".$id;	  	  
	  phpmkr_query($sql_documento_qr);
    $archivo_binario=StorageUtils::get_binary_file($imagen);
		$ruta_qr=$archivo_binario;
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
		<!--td rowspan="16" style="font-size:14pt;width:40px"><p class="vertical"><b><?php echo ($datos[0]["codigo_numero"]); ?></b></p></td-->
	</tr>
	<tr>
		<td style="text-align:center"><b>Nombre<br>Expediente</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["nombre"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>No. de Tomo</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["no_tomo"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>CODIGO No.</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["codigo_numero"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>FONDO</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["fondo"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SECCION</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($array_dependencias[0]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSECCION I</b></td>
		<td style="text-align:center" colspan="2">
			<?php 
				echo(mayusculas($array_dependencias[1])); 
				//echo(mayusculas($dep[0]['nombre']));
			?>
		</td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSECCION II</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($array_dependencias[2]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SERIE</b></td>
		<td colspan="2"><?php echo mayusculas($serie2[0]["nombre"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSERIE</b></td>
		<td colspan="2"><?php echo mayusculas($serie[0]["nombre"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>PROCESO</b></td>
		<td colspan="2"><?php echo($datos[0]["proceso"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>Observaciones</b></td>
		<td colspan="2"><?php echo ($datos[0]["descripcion"]); ?></td>
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
			<br>
			<img src="<?php echo $ruta_qr; ?>">
		</td>
	</tr>
</table>
<?php
//die();
}
function generar_qr_datos($filename,$datos,$matrixPointSize = 2,$errorCorrectionLevel = 'L'){      
	global $ruta_db_superior;
	include_once ($ruta_db_superior."phpqrcode/qrlib.php");    
      
	if ($datos){        
		if(trim($datos) == ''){          
			return false;
		}
		else{                              
			$filename .= 'qr'.date('Y_m_d_H_m_s').'.png'; 
      
      ob_start(); 
			QRcode::png($datos,false, $errorCorrectionLevel, $matrixPointSize, 0);
      $imageString = ob_get_contents();
			ob_end_clean();
            
			$almacenamiento = new SaiaStorage(RUTA_QR);
      $almacenamiento->almacenar_contenido($filename, $imageString);
      
      $ruta_qr = array ("servidor" => $almacenamiento->get_ruta_servidor(), "ruta" => $filename);

      return $ruta_qr;
		}  
	}
	else{          
		return false;
	}     
}
function obntener_niveles_dependencia_rotulo(&$array_dependencias, $iddependencia){
	global $conn;
	
	$dependencia = busca_filtro_tabla("A.cod_padre, A.nombre","dependencia A", "A.iddependencia=".$iddependencia." AND (cod_padre is not null or cod_padre<>0)", "", $conn);
	
	if($dependencia["numcampos"]){
		$array_dependencias[] = $dependencia[0]["nombre"];		
		if($dependencia[0]["cod_padre"]){
			obntener_niveles_dependencia_rotulo($array_dependencias, $dependencia[0]["cod_padre"]);
		}	
	}  	
}
?>
