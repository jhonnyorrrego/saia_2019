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
?>
<html lang="en">
<?php
clearstatcache();
$no_cache = md5(time()); 

$conf=busca_filtro_tabla("","configuracion a","nombre='logo'","",$conn);
$logo=$conf[0]["valor"];

if(@$_REQUEST["idcaja"]){
	rotulo_caja($_REQUEST["idcaja"]);
	$enlace=$ruta_db_superior."pantallas/almacenamiento/caja/cajaview.php?key=".$_REQUEST["idcaja"];
}
else if(@$_REQUEST["idcarpeta"]){
	rotulo_carpeta($_REQUEST["idcarpeta"]);
	$enlace=$ruta_db_superior."pantallas/almacenamiento/carpeta/folderview.php?key=".$_REQUEST["idcarpeta"];
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
  if(url!="")
     window.open("<?php echo $enlace; ?>","previsualizar");       
  else
  	window.close();
}	
-->
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="imprime();">
</body>
</html>
<?php

function rotulo_caja($id){
	global $logo, $ruta_db_superior;
	$datos=busca_filtro_tabla(fecha_db_obtener('fecha_extrema_i','Y-m-d H:i')." as fecha_i, ".fecha_db_obtener('fecha_extrema_f','Y-m-d H:i')." as fecha_f, a.*","caja a","a.idcaja=".$id,"",$conn);
	$serie=busca_filtro_tabla("","serie a","a.idserie=".$datos[0]["serie_idserie"],"",$conn);
	if($serie[0]["cod_padre"]){
		$serie2=busca_filtro_tabla("","serie a","a.idserie=".$serie[0]["cod_padre"],"",$conn);
		
	}
	$dep=busca_filtro_tabla("","dependencia a, dependencia_cargo b","a.iddependencia=b.dependencia_iddependencia and b.funcionario_idfuncionario=".$datos[0]["funcionario_idfuncionario"]." and b.estado=1","",$conn);
?>
<table style="border-collapse:collapse;font-family:arial;font-size:8pt;width:350px" border="1px">
	<tr>
		<td colspan="3" style="text-align:center"><img src="<?php echo $ruta_db_superior.$logo; ?>" border="0px"></td>
	</tr>
	<tr>
		<td><b>FONDO</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($datos[0]["fondo"]); ?></td>
	</tr>
	<tr height="30px">
		<td><b>SECCION</b></td>
		<td colspan="2" style="text-align:center"><?php echo mayusculas($dep[0]["nombre"]); ?></td>
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
		<td><b>No. CARPETAS</b></td>
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
	global $logo, $ruta_db_superior;
	$datos=busca_filtro_tabla(fecha_db_obtener('fecha_extrema_i','Y-m-d H:i')." as fecha_i, ".fecha_db_obtener('fecha_extrema_f','Y-m-d H:i')." as fecha_f, a.*","folder a","a.idfolder=".$id,"",$conn);
	$caja=busca_filtro_tabla("","caja a","a.idcaja=".$datos[0]["caja_idcaja"],"",$conn);
	$serie=busca_filtro_tabla("","serie a","a.idserie=".$datos[0]["serie_idserie"],"",$conn);
	if($serie[0]["cod_padre"]){
		$serie2=busca_filtro_tabla("","serie a","a.idserie=".$serie[0]["cod_padre"],"",$conn);
		
	}
	$dep=busca_filtro_tabla("","dependencia a, dependencia_cargo b","a.iddependencia=b.dependencia_iddependencia and b.funcionario_idfuncionario=".$datos[0]["funcionario_idfuncionario"]." and b.estado=1","",$conn);
	
	$code=str_replace(".","",$datos[0]["codigo_numero"]);
	$code=str_pad($code,13,0,STR_PAD_LEFT);
?>
<style>
.vertical {
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
</style>
<table style="border-collapse:collapse;font-family:arial;font-size:8pt;width:350px" border="1px">
	<tr>
		<td colspan="3" style="text-align:center">DESCRIPCION DEL EXPEDIENTE</td>
		<td rowspan="16" style="font-size:14pt;width:40px"><p class="vertical"><b><?php echo ($datos[0]["codigo_numero"]); ?></b></p></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>Nombre<br>Expediente</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["nombre_expediente"]); ?></td>
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
		<td style="text-align:center" colspan="2"><?php echo mayusculas($dep[0]["nombre"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSECCION I</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["subseccion_i"]); ?></td>
	</tr>
	<tr>
		<td style="text-align:center"><b>SUBSECCION II</b></td>
		<td style="text-align:center" colspan="2"><?php echo mayusculas($datos[0]["subseccion_ii"]); ?></td>
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
		<td style="text-align:center"><b>Observaciones</b></td>
		<td colspan="2"></td>
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
		<td style="text-align:center"><b>No. Carpetas</b></td>
		<td style="text-align:center"><b>No. caja</b></td>
	</tr>
	<tr>
		<td style="text-align:center"><?php echo ($datos[0]["no_folios"]); ?></td>
		<td style="text-align:center"><?php echo ($datos[0]["no_carpeta"]); ?></td>
		<td style="text-align:center"><?php echo ($caja[0]["no_cajas"]); ?></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center"><img src="<?php echo $ruta_db_superior.$logo; ?>" border="0px"><br><img src="<?php echo $ruta_db_superior; ?>codigo_barras/barcode.php?code=<?php echo $code; ?>&scale=1"></td>
	</tr>
</table>
<?php
//die();
}
?>