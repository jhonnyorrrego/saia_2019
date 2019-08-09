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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once "funciones_archivo.php";
?>

<html>

<head>
	<?= dropzone() ?>

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
	if ($config["numcampos"]) {
		$style = "
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
			//redirecciona("anexos_documento_edit.php?key=" . $_REQUEST["key"] . "&idformato=" . $_REQUEST["idformato"] . "&idcampo=" . $_REQUEST["idcampo"]);
			exit();
		} else {
			cargar_archivo($_REQUEST["key"], $permisos);
			//redirecciona("anexos_documento_edit.php?key=" . $iddocumento, $_REQUEST["frame"]);
			exit();
		}
	}

	$iddocumento = null;
	$idcampo = null;
	$tabla = null;
	if (isset($_REQUEST["key"]) && isset($_REQUEST["idformato"]) && isset($_REQUEST["idcampo"])) {
		$tabla = listar_anexos_documento($_REQUEST["key"], $_REQUEST["idformato"], $_REQUEST["idcampo"]);
		$iddocumento = $_REQUEST["key"];
		$idformato = $_REQUEST["idformato"];
		$idcampo = $_REQUEST["idcampo"];
		if ($_REQUEST["frame"]) {
			$frame = $_REQUEST["frame"];
		} else {
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

	if (empty($tabla)) {
		$tabla = "<table id='listado_anexos_{$iddocumento}_{$idcampo}'><tr><td></td></tr></table>";
	}
	echo $tabla;

	$validaciones = busca_filtro_tabla("valor", "campos_formato A", "A.idcampos_formato=" . @$_REQUEST["idcampo"], "", $conn);
	$extensiones = "";
	if ($validaciones[0]["valor"]) {
		$extensiones_fijas = $validaciones[0]["valor"];
		$mystring = $validaciones[0]["valor"];
		$findme   = '@';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) { //fue encontrada
			$vector_extensiones_tipo = explode($findme, $mystring);
			$tipo_input = $vector_extensiones_tipo[1];
			$extensiones_fijas = $vector_extensiones_tipo[0];
		}
		if ($extensiones_fijas != "") {
			$new_ext = array_map('trim', explode('|', $extensiones_fijas));
			$extensiones_fijas = "." . implode(', .', $new_ext);
			$extensiones = $extensiones_fijas;
			// $adicional = 'accept="' . $extensiones_fijas . '"';
		}
	}
	?>
	<br>
	<form id="formulario_anexos" action="anexos_documento_edit.php" method="POST" class="dropzone" enctype="multipart/form-data">
		<input type="hidden" value="" id="permisos_anexos" name="permisos_anexos" />
		<input type="hidden" value="<?php echo $iddocumento; ?>" id="key" name="key" />
		<input type="hidden" value="<?php echo $idformato; ?>" id="idformato" name="idformato" />
		<input type="hidden" value="<?php echo $idcampo; ?>" id="idcampo" name="idcampo" />
		<input type="hidden" value="<?php echo $frame; ?>" id="frame" name="frame" />

		<table>
			<tr>
				<td>
					<div class="dz-message"><span>Adicionar Anexos</span></div>
				</td>
			</tr>
		</table>
	</form>
</body>
<script>
	var iddocumento = "<?php echo $iddocumento; ?>";
	var idcampo = "<?php echo $idcampo; ?>";
	var permisos = "<?php echo $permisos; ?>";
	var idformato = "<?php echo $idformato; ?>";

	Dropzone.options.formularioAnexos = {
		acceptedFiles: "<?php echo ($extensiones); ?>",
		paramName: "anexos",
		uploadMultiple: true,
		params: {
			Adicionar: 5
		},
		success: function(file, response) {
			var idelemento = "listado_anexos_" + iddocumento + "_" + idcampo;
			var x = refrescar(iddocumento, idformato, idcampo, permisos);
		},
		complete: function(file) {
			this.removeFile(file);
			if (parent.frames['arbol_formato']) {
				parent.frames['arbol_formato'].postMessage({
					iddocumento: iddocumento
				}, "*");
			} else if (parent.parent.frames['arbol_formato']) {
				parent.parent.frames['arbol_formato'].postMessage({
					iddocumento: iddocumento
				}, "*");
			} else {
				console.log("No existe el frame arbol_formato");
			}
		}
	};

	function refrescar(iddocumento, idformato, idcampo, permisos) {
		var resp = "";
		var idelemento = "listado_anexos_" + iddocumento + "_" + idcampo;

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//console.log(idelemento);
				elemento = document.getElementById(idelemento);
				if (elemento) {
					elemento.outerHTML = this.responseText;
				} else {
					console.log("No se encontro " + idelemento);
				}
				//document.getElementById(idelemento).outerHTML = this.responseText;
			}
		};
		xhttp.open("POST", "funciones_archivo.php", true); //async true
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("listar_anexos=listar_anexos&iddocumento=" + iddocumento + "&idformato=" + idformato + "&idcampo=" + idcampo + "&permisos=" + permisos);
		// Enviar mensaje para actualizar el # de anexos

		return resp;
	}
</script>

</html>