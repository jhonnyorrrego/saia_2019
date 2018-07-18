<?php
include ("db.php");
if (!$_REQUEST["key"]) {
	$idmodulo = busca_filtro_tabla("idmodulo", "modulo", "nombre='serie'", "", $conn);
	if ($idmodulo["numcampos"]) {
		abrir_url("pantallas/pantallas_kaiten/principal.php?idmodulo=" . $idmodulo[0]["idmodulo"], "centro");
	} else {
		die();
	}
}
include ("header.php");
$idserie = $_REQUEST["key"];
$idnode = ($_REQUEST["idnode"]!="") ? $_REQUEST["idnode"] : 0 ;

$tipo_serie = array(
	1 => "SERIE",
	2 => "SUBSERIE",
	3 => "TIPO DOCUMENTAL"
);
$tipo=array(0=>"TRD",1=>"TVD");
$conservacion=array("TOTAL"=>"CONSERVACION","ELIMINACION"=>"ELIMINACION");
$sel=array(0=>"NO",1=>"SI");
$estado=array(0=>"INACTIVO",1=>"ACTIVO");

$datos = busca_filtro_tabla("", "serie", "idserie=" . $idserie, "", $conn);
$nom_padre="";
if($datos[0]["tipo"]==2 || $datos[0]["tipo"]==3 && $datos[0]["cod_padre"]){
	$padre = busca_filtro_tabla("nombre,codigo", "serie", "idserie=" . $datos[0]["cod_padre"], "", $conn);
	if($padre["numcampos"]){
		$nom_padre=$padre[0]["nombre"]. " - (".$padre[0]["codigo"].")";
	}
}
?>
<span style="font-family: Verdana; font-size: 9px;"><br/>
	<a href="serieedit.php?idnode=<?php echo $idnode ;?>&key=<?php echo $idserie; ?>">EDITAR</a>
</span><br/><br/>

<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado">TIPO</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $tipo[$datos[0]["tvd"]];?></span></td>
	</tr>

	<tr>
		<td class="encabezado">TIPO SERIE</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $tipo_serie[$datos[0]["tipo"]];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["codigo"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["nombre"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $nom_padre;?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">D&Iacute;AS DE ENTREGA BASE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["dias_entrega"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["retencion_gestion"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["retencion_central"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $conservacion[$datos[0]["conservacion"]];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $sel[$datos[0]["seleccion"]];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $sel[$datos[0]["digitalizacion"]];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["otro"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $sel[$datos[0]["copia"]];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["procedimiento"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $estado[$datos[0]["estado"]];?></span></td>
	</tr>
</table>
<?php
	include ("footer.php");
 ?>