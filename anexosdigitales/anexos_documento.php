<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0) {
if(is_file($ruta."db.php")) {
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("iddoc","key");
desencriptar_sqli('form_info');
echo(librerias_jquery());
if((@$_REQUEST["iddoc"] || @$_REQUEST["key"]) && @$_REQUEST["no_menu"]!=1){
	if(!@$_REQUEST["iddoc"]) {
		$_REQUEST["iddoc"]=@$_REQUEST["key"];
    }
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
?>

<link href="<?php echo $ruta_db_superior;?>dropzone/dist/dropzone.css" type="text/css" rel="stylesheet" />

<script src="<?php echo $ruta_db_superior;?>dropzone/dist/dropzone.js"></script>

<script type="text/javascript" src="highslide-4.0.10/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="highslide-4.0.10/highslide/highslide.css" />

<script type='text/javascript'>
    hs.graphicsDir = 'highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
    hs.Expander.prototype.onAfterClose = function(sender) {
        //console.log(sender);
        var elemento = document.getElementById("key");
        if(elemento) {
        	var idelemento = "listado_anexos_" + elemento.value;
        	refrescar_lista_anexos(idelemento);
        }
   }

    function refrescar_lista_anexos(idelemento) {
        var elemento = document.getElementById(idelemento);

        $.ajax({
            url: "funciones_archivo.php",
            data: { listar_anexos: "listar_anexos", iddocumento: iddocumento},
            type: 'POST',
            success: function (data) {
                if(elemento) {
                	elemento.outerHTML = data;
                	//console.log(data);
                } else {
                    console.log("No se encontro " +  idelemento);
                }
            }
    	});
    }
</script>

<?php

//echo(estilo_bootstrap());
$tabla = null;
if(!isset($_REQUEST["menu"])||$_REQUEST["menu"]!="0") { // Si esta en menu_ordenar omite el header el footer y el menu
include_once("../header.php");
menu_ordenar($_REQUEST["key"]);
	} 
echo "<br>";
if(isset($_REQUEST["key"])) {
   $iddocumento=$_REQUEST["key"];
    $tabla = listar_anexos_documento($iddocumento);
	} else {
  echo "No se recibio la informacion del documento";
    die();
	} 
 
if(empty($tabla)) {
    $tabla = "<table id='listado_anexos_{$iddocumento}'><tr><td></td></tr></table>";
}
echo "<div class='row-fluid'><div align='center'>" . $tabla . "</div>";

if(isset($_REQUEST["Adicionar"])) { // Se procesa el formulario

    $permisos=$_REQUEST["permisos_anexos"];
    //procesar_anexos($iddocumento,$permisos);
    cargar_archivo($iddocumento,$permisos);
    if(!isset($_REQUEST["menu"])||$_REQUEST["menu"]!="0") { // Si esta en menu_ordenar omite el header el footer y el menu
      ?>
      <script>
     
        if(parent.frames['arbol_formato']) {
			parent.frames['arbol_formato'].postMessage({iddocumento: <?php echo($_REQUEST["key"]);?>}, "*");
		}
      
      </script>
      <?php
        //abrir_url("anexos_documento.php?key=" . $iddocumento . "&adicional=" . rand(), "_self");
     } else  { 
        //abrir_url("../ordenar.php?accion=mostrar&key=" . $iddocumento, "centro");
     }
    exit();
  }

global $extensiones; // Extensiones por defecto inicializadas en funciones archivo
if($extensiones =='' || $extensiones =='NULL') {
 $extensiones='jpg|gif|doc|ppt|xls|txt|pdf|pps|crd|cad|xlsx|docx|pptx|ppsx|pps|ppsx|swf|flv';
 }
     
?>
<br>
<div align="center">
	<form id="formulario_anexos" action="anexos_documento.php" method="POST" class="dropzone" enctype="multipart/form-data">
<input type="hidden" value="" id="permisos_anexos" name="permisos_anexos"/>
<input type="hidden" value="<?php echo $iddocumento; ?>" id="key" name="key"/>
		<input type="hidden"
				value="<?php echo (isset($_REQUEST["menu"]) ? $_REQUEST["menu"] : "1"); ?>"
				id="menu" name="menu" />
		<table style="width:255px; border:0; cellspacing:2; cellpadding:2">
<tr>
				<td>
					<div class="dz-message"><span>Adicionar Anexos</span></div>
				<td>
			</tr>
			<!--  <tr>
				<td class="celda_transparente" align='center'>
					<input type="file" name="anexos[]" class="multi" accept="<?php echo $extensiones;?>">
				</td>
</tr>
			<tr>
				<td align='center'>
					<button type="button" value="Adicionar" name="Adicionar" id="adicionar">Adicionar</button>
				</td>
			</tr>-->
</table>
</form>
</div>

<?php

if(!isset($_REQUEST["menu"])||$_REQUEST["menu"]!="0") { // Si esta en menu_ordenar omite el footer y el header
   include_once("../footer.php");
 }

?>
<script type="text/javascript">
Dropzone.autoDiscover = false;

var iddocumento = "<?php echo $iddocumento;?>";
var permisos = "<?php echo $permisos;?>";

$("#document").ready(function(){
	$("#formulario_anexos").dropzone({
		acceptedFiles: "<?php echo($extensiones); ?>",
		paramName: "anexos",
		uploadMultiple: true,
		params: {Adicionar: 5},
		success: function(file, response) {
	    	var idelemento = "listado_anexos_" + iddocumento;
	    	refrescar_lista_anexos(idelemento);
		},
		complete: function(file) {
			this.removeFile(file);
			if(parent.frames['arbol_formato']) {
				parent.frames['arbol_formato'].postMessage({iddocumento: iddocumento}, "*");
			} else if(parent.parent.frames['arbol_formato']) {
				parent.parent.frames['arbol_formato'].postMessage({iddocumento: iddocumento}, "*");
			} else {
				console.log("No existe el frame arbol_formato");
}
}
	});
});
</script>
