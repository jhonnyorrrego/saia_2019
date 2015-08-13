<?php 
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_bootstrap());
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php
echo(librerias_acciones_kaiten());
$ewCurSec = 0; // Initialise
					
// Initialize common variables
$x_idejecutor = Null;
$x_identificacion = Null;
$x_tipo = Null;
$x_telefono = Null;
$x_nombre = Null;
$x_prioridad = Null;
$x_fecha_ingreso = Null;
$x_cargo = Null;
$x_direccion = Null;
$x_ciudad = Null;
$sKey = @$_GET["idejecutor"];

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I":
		if (!LoadData($sKey,$conn)){
		}
}
?>
<legend>Ver ejecutor</legend>
<br />
<table class="table table-bordered" style="width:50%">
	<tr>
		<td class="prettyprint" style="width:20%"><b>Identificaci&oacute;n:</b></td>
		<td style="width:30%"><?php echo $x_identificacion; ?></td>
	</tr>
	<tr>
		<td class="prettyprint"><b>Nombre:</b></td>
		<td><?php echo $x_nombre; ?></td>
	</tr>
	<tr>
		<td class="prettyprint"><b>Fecha ingreso:</b></td>
		<td><?php echo ($x_fecha_ingreso); ?></td>
	</tr>
	</table>
	<a class="link" href="adicionar_datos_ejecutor.php?idejecutor=<?php echo(@$_REQUEST["idejecutor"]); ?>" target="_self">Adicionar datos</a>
	<br />
	<table style="width:100%" class="table table-bordered">
	<tr>
    <td class="prettyprint"><b>T&iacute;tulo</b></td>
    <td class="prettyprint"><b>Cargo</b></td>
    <td class="prettyprint"><b>Empresa</b></td>
    <td class="prettyprint"><b>Tel&eacute;fono</b></td>
		<td class="prettyprint"><b>Direcci&oacute;n</b></td>
		<td class="prettyprint"><b>Email</b></td>
		<td class="prettyprint"><b>Ciudad</b></td>
		<td class="prettyprint"><b>Fecha del cambio</b></td>
	</tr>
<?php 
$datos=busca_filtro_tabla("datos_ejecutor.*,".fecha_db_obtener('fecha','Y-m-d')." as fecha","datos_ejecutor","ejecutor_idejecutor=$sKey","iddatos_ejecutor desc",$conn);

for($i=0;$i<$datos["numcampos"];$i++){
	if($datos[$i]["ciudad"]){
		$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$datos[$i]["ciudad"],"",$conn);
       if($ciudad)
         $datos[$i]["ciudad"]=$ciudad[0]["nombre"];
       else
         $datos[$i]["ciudad"]="";  
	}
  else
  	$datos[$i]["ciudad"]="";  
  echo '<tr>
	<td>'.$datos[$i]["titulo"].'&nbsp;</td>
	<td>'.$datos[$i]["cargo"].'&nbsp;</td>
	<td>'.$datos[$i]["empresa"].'&nbsp;</td>
  <td>'.$datos[$i]["telefono"].'&nbsp;</td>
	<td>'.$datos[$i]["direccion"].'&nbsp;</td>
  <td>'.$datos[$i]["email"].'&nbsp;</td>
	<td>'.$datos[$i]["ciudad"].'&nbsp;</td>
	<td>'.$datos[$i]["fecha"].'&nbsp;</td>
  </tr>';
}
?>	
</table>
<?php
function LoadData($sKey,$conn)
{
	global $_SESSION, $x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad,$x_empresa;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$row = busca_filtro_tabla("A.*,".fecha_db_obtener("fecha_ingreso","Y-m-d")." as fecha_ingreso","ejecutor A","A.idejecutor = ".$sKeyWrk,"idejecutor desc",$conn);
	if (!$row["numcampos"]) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$datos=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$row[0]["idejecutor"],"fecha desc",$conn);
		// Get the field contents
		$x_idejecutor = $row[0]["idejecutor"];
		$x_identificacion = $row[0]["identificacion"];
		$x_tipo = $row[0]["tipo"];
		$x_telefono = $datos[0]["telefono"];
		$x_nombre = $row[0]["nombre"];
		$x_prioridad = $row[0]["prioridad"];
		$x_fecha_ingreso = $row[0]["fecha_ingreso"];
		$x_cargo = $datos[0]["cargo"];
		$x_direccion = $datos[0]["direccion"];
		$x_ciudad = $datos[0]["ciudad"];
		$x_empresa = $datos[0]["empresa"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>