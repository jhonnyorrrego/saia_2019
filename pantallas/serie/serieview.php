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

include_once ($ruta_db_superior."db.php");

if (!$_REQUEST["key"]) {
	$idmodulo = busca_filtro_tabla("idmodulo", "modulo", "nombre='serie'", "", $conn);
	if ($idmodulo["numcampos"]) {
		abrir_url("pantallas/pantallas_kaiten/principal.php?idmodulo=" . $idmodulo[0]["idmodulo"], "centro");
	} else {
		die();
	}
}
include ($ruta_db_superior."header.php");
$idserie = $_REQUEST["key"];
$idnode = ($_REQUEST["idnode"]!="") ? $_REQUEST["idnode"] : 0 ;

$tipo_serie = array(
	1 => "SERIE",
	2 => "SUBSERIE",
	3 => "TIPO DOCUMENTAL"
);
$tipo=array(0=>"TRD",1=>"TVD");
$categoria=array(2=>"PRODUCCION DOCUMENTAL",3=>"OTRAS CATAGORIAS");

$conservacion=array("TOTAL"=>"CONSERVACION","ELIMINACION"=>"ELIMINACION");
$sel=array(0=>"NO",1=>"SI");
$estado=array(0=>"INACTIVO",1=>"ACTIVO");

$datos = busca_filtro_tabla("", "serie", "idserie=" . $idserie, "", $conn);
$nom_padre="";
if(($datos[0]["tipo"]==2 || $datos[0]["tipo"]==3 && $datos[0]["cod_padre"]) || $datos[0]["categoria"] == 3){
	$padre = busca_filtro_tabla("nombre,codigo", "serie", "idserie=" . $datos[0]["cod_padre"], "", $conn);
	if($padre["numcampos"]){
		$nom_padre=$padre[0]["nombre"]. " - (".$padre[0]["codigo"].")";
	}
}

// Buscar si tiene documentos asociados en algun tipo documental
$filtro_docs = false;
switch ($datos[0]["tipo"]) {
    case 1:
    case 2:
        $filtro_docs = "like '{$datos[0]["cod_arbol"]}.%'";
        break;
    case 3:
        $filtro_docs = "= '{$datos[0]["cod_arbol"]}'";
        break;
    default:
        $filtro_docs = false;
        break;
}

$docs_vinculados = array("numcampos" => 0);

if($filtro_docs) {
    $docs_vinculados = busca_filtro_tabla("iddocumento", "documento", "serie in (select distinct idserie from serie where cod_arbol $filtro_docs)" , "", $conn);
}

$vinculados = $docs_vinculados["numcampos"];

include_once ($ruta_db_superior."librerias_saia.php");
echo librerias_jquery("1.7");
?>
<span style="font-family: Verdana; font-size: 9px;"><br/>
<?php
if($vinculados) {
    echo "Serie de solo lectura. $vinculados documentos vinculados<br>";
} else {
?>
	<a href="serieedit.php?idnode=<?php echo $idnode ;?>&x_idserie=<?php echo $idserie; ?>">EDITAR</a>
	<?php
}

if($datos[0]["tipo"]==1 || $datos[0]["tipo"]==2) {
    echo '&nbsp;<a href="serieadd.php?idnode=' . $idnode . '&x_idserie=' . $idserie . '">ADICIONAR</a>
	<a href="permiso_serie.php?idserie=' . $idserie . '" target="serielist">PERMISOS</a>';
}
	?>
</span><br/><br/>

<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado">CATEGORIA</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $categoria[$datos[0]["categoria"]];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado">TIPO</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $tipo[$datos[0]["tvd"]];?></span></td>
	</tr>

	<tr class="ocultar">
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

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">D&Iacute;AS DE ENTREGA BASE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["dias_entrega"];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["retencion_gestion"];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["retencion_central"];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $conservacion[$datos[0]["conservacion"]];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $sel[$datos[0]["seleccion"]];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $sel[$datos[0]["digitalizacion"]];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["otro"];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $sel[$datos[0]["copia"]];?></span></td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["procedimiento"];?></span></td>
	</tr>

	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $estado[$datos[0]["estado"]];?></span></td>
	</tr>
</table>
<?php
	include_once ($ruta_db_superior."footer.php");
?>
<script>
	$(document).ready(function (){
		var categoria=parseInt(<?php echo $datos[0]["categoria"];?>);
		if(categoria==3){
			$(".ocultar").hide();
		}
	});
</script>