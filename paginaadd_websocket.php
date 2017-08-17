<?php
include_once ("db.php");
if (@$_REQUEST["iddoc"] || @$_REQUEST["key"]) {
	include_once ("pantallas/documento/menu_principal_documento.php");
	if (!$_REQUEST["iddoc"]) {
		$_REQUEST["iddoc"] = $_REQUEST["key"];
	}
	menu_principal_documento($_REQUEST["iddoc"]);
}

include_once("librerias_saia.php");
echo(librerias_notificaciones());

$x_consecutivo = Null;
$x_id_documento = Null;
$x_imagen = Null;
$fs_x_imagen = 0;
$fn_x_imagen = "";
$ct_x_imagen = "";
$w_x_imagen = 0;
$h_x_imagen = 0;
$a_x_imagen = "";
$x_pagina = Null;
$x_escaneo = Null;

if (isset($_REQUEST["key"])) {
	$key = $_REQUEST["key"];
} else if (isset($_REQUEST["x_id_documento"])) {
	$key = $_REQUEST["x_id_documento"];
} else {
	$key = @$_SESSION["iddoc"];
}
if ($key != 0 && $key != "") {
	$idformato = busca_filtro_tabla("idformato", "formato f,documento d", "lower(f.nombre)=lower(d.plantilla) and iddocumento=" . $key, "", $conn);
	if ($idformato["numcampos"] && $sAction == "") {
		llama_funcion_accion($key, $idformato[0][0], "digitalizar", "ANTERIOR");
	}
}

if (@$_REQUEST["enlace"]) {
	$x_enlace = $_REQUEST["enlace"];
} else if (@$_REQUEST["enlace2"]) {
	$x_enlace = $_REQUEST["enlace2"];
} else if ($_REQUEST["x_enlace"] == "") {
	$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $key, "");
	if ($documento[0]["tipo_radicado"] != 1 && $documento[0]["tipo_radicado"] != 2) {
		$x_enlace = "ordenar.php?key=" . $key . "&accion=mostrar&mostrar_formato=1";
	} else {
		$x_enlace = "ordenar.php?key=" . $key."&accion=mostrar&mostrar_formato=1";
	}
}
if ($_REQUEST["defecto"]) {
	$x_enlace .= "&defecto=" . $_REQUEST["defecto"];
}
if ($_REQUEST["mostrar_formato"]) {
	$x_enlace .= "&mostrar_formato=" . $_REQUEST["mostrar_formato"];
}

include_once ("phpmkrfn.php");

$sAction = @$_POST["a_add"];
$tabla = "pagina";
if (@$_SESSION["tipo_doc"] == "registro") {
	$tabla = "pagina_registro";
}
if (($sAction == "") || (($sAction == NULL))) {
	$sKey = $key;
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey != "") {
		$sAction = "C";
	} else {
		$sAction = "I";
	}
} else {
	$x_consecutivo = @$_POST["x_consecutivo"];
	$x_id_documento = @$_POST["x_id_documento"];
	$x_imagen = @$_POST["x_imagen"];
	$x_pagina = @$_POST["x_pagina"];
	$x_escaneo = @$_POST["x_escaneo"];
	if (@$_POST["x_enlace"]) {
		$x_enlace = @$_POST["x_enlace"];
	}
	sincronizar_carpetas($tabla, $conn);
}

switch ($sAction) {
	case "A" :
		// Add
		if (sincronizar_carpetas($tabla, $conn)) { // Add New Record
			if ($key && $idformato[0][0]) {
				llama_funcion_accion($key, $idformato[0][0], "digitalizar", "POSTERIOR");
			}
		}
		if ($x_escaneo == "1") {
			$x_enlace = "paginaadd.php?key=" . $key . "&" . $x_enlace;
		} else if ($x_enlace == '') {
			$x_enlace = 'documentoadd.php';
		} else {
			$arreglo_enlace = explode(",", $x_enlace);
			if ($arreglo_enlace[0] == 'colilla') {
				$x_enlace = 'colilla.php?key=' . $key;
				if ($arreglo_enlace[1] == 'documentoadd') {
					$x_enlace .= '&enlace=documentoadd.php';
				}
			} else if ($arreglo_enlace[0] == 'documentoaddsal') {
				$x_enlace = 'documentoaddsal.php';
			}
		}
		abrir_url_digitalizacion($key, $x_enlace, "_self");
		exit();
		break;
}
$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
?>

<style type="text/css">
<!--
INPUT, TEXTAREA, SELECT, body {
	font-family: Tahoma;
	font-size: 10px;
	}

	.phpmaker {
	font-family: Verdana;
	font-size: 9px;
	}

	.encabezado {
	background-color: <?php echo($config[0]["valor"]); ?>;
	color:white ;
	padding:10px;
	text-align: left;
	}

	.encabezado_list {
	background-color: <?php echo($config[0]["valor"]); ?>;
	color:white ;
	vertical-align:middle;
	text-align: center;
	font-weight: bold;
	}

	table thead td {
	font-weight:bold;
	cursor:pointer;
	background-color: <?php echo($config[0]["valor"]); ?>;
	text-align: center;
	font-family: Verdana;
	font-size: 9px;
	text-transform:Uppercase;
	vertical-align:middle;
	}

	table tbody td {
	font-family: Verdana;
	font-size: 9px;
	}
	-->
</style>
<script type="text/javascript">
		<!--
	function EW_checkMyForm(EW_this) {
	if (EW_this.x_id_documento && !EW_hasValue(EW_this.x_id_documento, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_id_documento, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - DOCUMENTO ASOCIADO"))
	return false;
	}
	if (EW_this.x_id_documento && !EW_checkinteger(EW_this.x_id_documento.value)) {
	if (!EW_onError(EW_this, EW_this.x_id_documento, "TEXT", "ENTERO INCORRECTO - DOCUMENTO ASOCIADO"))
	return false;
	}
	if (EW_this.x_imagen && !EW_hasValue(EW_this.x_imagen, "FILE" )) {
	if (!EW_onError(EW_this, EW_this.x_imagen, "FILE", "POR FAVOR INGRESE EL CAMPO REQUERIDO - IMAGEN"))
	return false;
	}
	}
	--></script>
<div  align="center">
	<?php
  menu_ordenar($key);
	?>
</div>
<br />
<br />
<span class="internos" style="display:none;font-family:verdana;font-size:10px">&nbsp;&nbsp;<b>ADICI&Oacute;N DE P&Aacute;GINAS AL DOCUMENTO</b></span>
<form name="paginaadd" id="paginaadd" action="paginaadd.php<?php echo("?key=".$key) ?>" method="POST" onSubmit="return EW_checkMyForm(this);">
	<input type="hidden" name="a_add" value="A">
	<?php
	$dir = "";
	$ruta_ftp = "";
	$temporal_usuario = "";
	$usuario = "";
	$clave = "";
	$puerto_ftp = 21;
	$configuracion["numcampos"] = 0;
	$configuracion = busca_filtro_tabla("A.*", "configuracion A", "tipo IN('ruta', 'clave', 'usuario', 'peso', 'imagen', 'ftp')", "", $conn);
	for($i = 0; $i < $configuracion["numcampos"]; $i++) {
		switch ($configuracion[$i]["nombre"]) {
			case "ruta_servidor" :
				$dir = $configuracion[$i]["valor"];
				break;
			case "ruta_ftp" :
				$ruta_ftp = $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
				break;
			case "ruta_temporal" :
				$temporal_usuario = $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
				break;
			case "puerto_ftp" :
				$puerto_ftp = $configuracion[$i]["valor"];
				break;
			case "clave_ftp" :
				if($configuracion[$i]['encrypt']){
					include_once('pantallas/lib/librerias_cripto.php');
					$configuracion[$i]['valor']=decrypt_blowfish($configuracion[$i]['valor'],LLAVE_SAIA_CRYPTO);
				}
				$clave = $configuracion[$i]["valor"];
				break;
			case "usuario_ftp" :
				$usuario = $configuracion[$i]["valor"];
				break;
			case "maximo_tamanio_upload" :
				$peso = $configuracion[$i]["valor"];
				break;
			case "ancho_imagen" :
				$ancho = $configuracion[$i]["valor"];
				break;
			case "alto_imagen" :
				$alto = $configuracion[$i]["valor"];
				break;
			case 'tipo_ftp' :
				$ftp_type = $configuracion[$i]["valor"];
				break;
		}
	}

	if(!$ftp_type || $ftp_type==''){
		$ftp_type = "ftp";
	}

	?>

	<input type="hidden" name="EW_Max_File_Size" value="<?php echo($peso); ?>">
	<input type="hidden" name="x_enlace" value="<?php echo($x_enlace); ?>">
	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
		<tr>
			<td width="205" class="encabezado">
                <span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO ASOCIADO</span></td>
			<td width="335" bgcolor="#F5F5F5"><span class="phpmaker">
<?php
			if ($key) {
				$x_id_documento = $key;
			} else {
				$x_id_documento = 0;
			}
			if (!is_dir($temporal_usuario)) {
				if (!mkdir($temporal_usuario, PERMISOS_CARPETAS)) {
					alerta("no es posible crear una carpeta temporal para su usuario por favor comuniquese con el administrador", 'error', 5000);
				}
				volver("1");
			}
			chmod($temporal_usuario, PERMISOS_CARPETAS);
			?>
				<input type="hidden" name="x_id_documento" id="x_id_documento" size="30" value="<?php echo htmlspecialchars(@$x_id_documento) ?>">
					<?php
					$tabla = "documento";
					if (isset($_SESSION["tipo_doc"]) && $_SESSION["tipo_doc"] == 'registro') {
						$tabla = "archivo";
					}
					$documento = busca_tabla($tabla, $x_id_documento);
					if ($documento["numcampos"] && $tabla != "archivo") {
						echo stripslashes($documento[0]["descripcion"]);
					} else if ($tabla == "archivo") {
						echo ($documento[0]["titulo"]);
					} else {
						echo ($x_id_documento);
					}
					?> </span></td>
			<td width="207" rowspan="2" bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="submit" name="Action" value="CONTINUAR" />
			</span><div align="center"></div></td>
		</tr>
		<tr>
			<td width="205" class="encabezado" ><span class="phpmaker" style="color: #FFFFFF;">ESCANEAR DE NUEVO</span></td>
			<td width="335" bgcolor="#F5F5F5"><span class="phpmaker"> SI
				<input type="radio" name="x_escaneo" value="1">NO
				<input type="radio" name="x_escaneo" value="0" checked>
			</span></td>
		</tr>

	</table>
	<div class="container" id="info_scanner"></div>


</form>


<?php
//poner notificaciones noty
include_once ("librerias_saia.php");
global $raiz_saia;
$raiz_saia = '';
echo (librerias_notificaciones());

$s_https = '';
if (PROTOCOLO_CONEXION == 'https://') {
	$s_https = 's';
}

function abrir_url_digitalizacion($iddocumento, $location, $target = "_blank") {
	if (!@$_SESSION['radicacion_masiva']) {
		if ($target) {
			?>
	<script language="javascript">
		var iddoc = "<?php echo $iddocumento;?>";
		//alert(iddoc);
		//parent.getElementById('arbol_formato').cargar_cantidades_documento(iddoc);
		if(parent.frames['arbol_formato']) {
			parent.frames['arbol_formato'].postMessage({iddocumento: iddoc}, "*");
		}
    	window.open("<?php print($location);?>","<?php print($target);?>");
    </script>
<?php
		} else {
			?>
	<script language="javascript">
		var iddoc = "<?php echo $iddocumento;?>";
		//alert(iddoc);
		//parent.getElementById('arbol_formato').cargar_cantidades_documento(iddoc);
		if(parent.frames['arbol_formato']) {
			parent.frames['arbol_formato'].postMessage({iddocumento: iddoc}, "*");
		}
    	window.open("<?php print($location);?>","centro");
    </script>
<?php
		}
	}
}
?>

    <div id="output"></div>

    <script language="javascript" type="text/javascript">
        //var wsUri = "ws://echo.websocket.org/";
        //var wsUri = "ws://localhost:8025/";
        var wsUri = "ws<?php echo($s_https); ?>://localhost:49888/websockets/wsocketservice";
        var output;
        var websocket;
        var clientId;

        function init() {
            output = document.getElementById("output");
            testWebSocket();
        }

        function getUid() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                var r = Math.random() * 16 | 0,
                        v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        function testWebSocket() {
            try {
                websocket = new WebSocket(wsUri);
            } catch (ex) {
               alert(ex.message);
               return false;
            }
            clientId = getUid();
            websocket.onopen = function (evt) {
                onOpen(evt);
            };
            websocket.onclose = function (evt) {
                onClose(evt);
            };
            websocket.onmessage = function (evt) {
                onMessage(evt);
            };
            websocket.onerror = function (evt) {


                onError(evt);
            };
        }

        function onOpen(evt) {
             notificacion_saia('Ejecutando Scanner...','success','',1500);
             $('#info_scanner').html('<div class="well alert-success" style="text-align:center;"><span style="font-wight:bold;">ATENCI&Oacute;N<br/> El Scanner se encuentra en Ejecuci&oacute;n!</span></div>');
             enviarMensaje();
        }

        function onClose(evt) {
            clientId = null;
        }

        function onMessage(evt) {
            var mensaje = JSON.parse(evt.data);
            switch(mensaje.cmd) {
                case "CMD_ERR":

                    break;
                case "CMD_END":
                	$("[name='Action']").click(); //REDIRECCIONA AL CERRAR SCANNER
                    break;
                case "CMD_DBG": //Mensaje de depuracion
                    console.log(evt.data);
                    break;
                default:
                   // writeToScreen('<span style="color: blue;">MENSAJE DESCONOCIDO: ' + evt.data + '</span>');
            }
            //websocket.close();
        }

        function onError(evt) {
             notificacion_saia('<span style="color:white;">La aplicacion de digitalizacion no se esta ejecutado!</span>','error','',4000);
        }

        function doSend(message) {
            //writeToScreen("SENT: " + message);
            websocket.send(message);
        }

        function writeToScreen(message) {
            var pre = document.createElement("p");
            pre.style.wordWrap = "break-word";
            pre.innerHTML = message;
            output.appendChild(pre);
        }

        window.addEventListener("load", init, false);

        function enviarMensaje() {

            if(!websocket || websocket.readyState == 3) {
                testWebSocket();
            }
                <?php
                    //parseo descripcion
                    $documento[0]["descripcion"]=codifica_encabezado(html_entity_decode($documento[0]["descripcion"]));
                    if($documento[0]["descripcion"]!=''){
                        if(strlen($documento[0]["descripcion"])>30){
                            $documento[0]["descripcion"]=substr( $documento[0]["descripcion"],0,30).'...';
                        }
                    }
                ?>
                var data = {
                    "url": "<?php print($temporal_usuario); ?>",
                    "radica": "<?php print($key); ?>",
                    "port": "<?php print($puerto_ftp); ?>",
                    "host": "<?php print($dir); ?>",
                    "usuario": "<?php print($usuario); ?>",
                    "dftp": "<?php print($ruta_ftp); ?>",
                    "clave": "<?php print($clave); ?>",
                    "verLog": "false",
                    "ancho": "<?php print($ancho); ?>",
                    "alto": "<?php print($alto); ?>",
                    "numero": "<?php print($documento[0]["numero"]); ?>",
                    "maxtabs": "50",
                    "fileFilter" : "jpg,png,pdf,tiff,tif,doc,docx",
                    "descripcion":"<?php print(stripslashes($documento[0]["descripcion"])); ?>",
                    "ftp_type" : "<?php echo $ftp_type;?>"
                };
                var msg = {
                    clientId: clientId,
                    cmd: "CMD_INIT",
                    text: "Digitalizacion Saia",
                    data: data,
                    date: Date.now()
                };
                doSend(JSON.stringify(msg));

        }
    </script>
