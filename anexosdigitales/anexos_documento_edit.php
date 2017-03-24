<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once ("funciones_archivo.php");
?>

<html>
<head>
<script src="multiple-file-upload/jquery-1.2.6.js" type="text/javascript"></script>
<script type="text/javascript" src="multiple-file-upload/jquery.MultiFile_DOC.js"></script>
<script type="text/javascript" src="highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
	hs.graphicsDir = 'highslide-4.0.10/highslide/graphics/';
	hs.outlineType = 'rounded-white'; 
</script>
</head>
<body>

<?php
$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
if ($config["numcampos"]) {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT 
     {
        font-family: Verdana,Tahoma,arial; 
        font-size: 10px; 
        /*text-transform:Uppercase;*/
       } 
       .phpmaker 
       {
       font-family: Verdana,Tahoma,arial; 
       font-size: 9px; 
       /*text-transform:Uppercase;*/
       } 
       .encabezado 
       {
       background-color:" . $config[0]["valor"] . "; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list 
       { 
       background-color:" . $config[0]["valor"] . "; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td 
       {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:" . $config[0]["valor"] . ";
    		text-align: center;
        font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
        /*text-transform:Uppercase;*/
        vertical-align:middle;    
    	 }
    	 table tbody td 
       {	
    		font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
    	 }
       -->
       </style>";
	echo $style;
}

if (isset($_REQUEST["Adicionar"])) {
	$permisos = $_REQUEST["permisos_anexos"];
	if (isset($_REQUEST["idformato"]) && isset($_REQUEST["idcampo"])) {
		cargar_archivo($_REQUEST["key"], $permisos, $_REQUEST["idformato"], $_REQUEST["idcampo"]);
		redirecciona("anexos_documento_edit.php?key=" . $_REQUEST["key"] . "&idformato=" . $_REQUEST["idformato"] . "&idcampo=" . $_REQUEST["idcampo"]);
		exit();
	} else {
		cargar_archivo($_REQUEST["key"], $permisos);
		redirecciona("anexos_documento_edit.php?key=" . $iddocumento, $_REQUEST["frame"]);
		exit();
	}
}

if (isset($_REQUEST["key"]) && isset($_REQUEST["idformato"]) && isset($_REQUEST["idcampo"])) {
	echo listar_anexos_documento($_REQUEST["key"], $_REQUEST["idformato"], $_REQUEST["idcampo"]);
	$iddocumento = $_REQUEST["key"];
	$idformato = $_REQUEST["idformato"];
	$idcampo = $_REQUEST["idcampo"];
	if ($_REQUEST["frame"]){
		$frame = $_REQUEST["frame"];
	}else{
		$frame = "centro";
	}
} elseif (isset($_REQUEST["key"])) {
	$iddocumento = $_REQUEST["key"];
	$idformato = $idcampo = NULL;
	echo listar_anexos_documento($iddocumento);
} else {
	echo "No se recibio la informacion del documento";
	die("");
}
$validaciones = busca_filtro_tabla("valor", "campos_formato A", "A.idcampos_formato=" . @$_REQUEST["idcampo"], "", $conn);
$adicional = "";
if ($validaciones[0]["valor"]){
		$extensiones_fijas=$validaciones[0]["valor"];
		$mystring = $validaciones[0]["valor"];
		$findme   = '@';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) { //fue encontrada
			$vector_extensiones_tipo=explode($findme,$mystring);
			$tipo_input=$vector_extensiones_tipo[1];
			$extensiones_fijas=$vector_extensiones_tipo[0];
		}
	if($extensiones_fijas!=''){
		$adicional = 'accept="' . $extensiones_fijas . '"';
	}
}
?>
</br>
<form action="anexos_documento_edit.php" method="POST" enctype="multipart/form-data" >
<input type="hidden" value="" id="permisos_anexos" name="permisos_anexos"/>
<input type="hidden" value="<?php echo $iddocumento; ?>" id="key" name="key"/>
<input type="hidden" value="<?php echo $idformato; ?>" id="idformato" name="idformato"/>
<input type="hidden" value="<?php echo $idcampo; ?>" id="idcampo" name="idcampo"/>
<input type="hidden" value="<?php echo $frame; ?>" id="frame" name="frame"/>

<table>
	<tr>
		<td> Adicionar Anexos </td>
	</tr>
	<tr>
		<td class="celda_transparente">
			<input type="file" name="anexos[]" class="multi" <?php echo($adicional); ?>>
		</td>
	</tr>
	<tr>
		<td>
			<input type="submit" value="Adicionar" name="Adicionar">
		</td>
	</tr>
</table>
</form>
</body>
</html>