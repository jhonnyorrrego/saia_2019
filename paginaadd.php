<?php
include_once ("db.php");
if (@$_REQUEST["iddoc"] || @$_REQUEST["key"]) {
  include_once ("pantallas/documento/menu_principal_documento.php");
  if (!$_REQUEST["iddoc"])
    $_REQUEST["iddoc"] = $_REQUEST["key"];
  menu_principal_documento($_REQUEST["iddoc"]);
}
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

if (isset($_REQUEST["key"]))
  $key = $_REQUEST["key"];
else if (isset($_REQUEST["x_id_documento"]))
  $key = $_REQUEST["x_id_documento"];
else
  $key = @$_SESSION["iddoc"];

if($key!=0 && $key!=""){
  $idformato=busca_filtro_tabla("idformato","formato f,documento d","lower(f.nombre)=lower(d.plantilla) and iddocumento=".$key,"",$conn);
  if($idformato["numcampos"] && $sAction==""){
   llama_funcion_accion($key,$idformato[0][0],"digitalizar","ANTERIOR"); 
  }
}

if (@$_REQUEST["enlace"])
  $x_enlace = $_REQUEST["enlace"];
else if (@$_REQUEST["enlace2"])
  $x_enlace = $_REQUEST["enlace2"];
else if ($_REQUEST["x_enlace"] == "") {
  $documento = busca_filtro_tabla("", "documento", "iddocumento=" . $key, "");
  if ($documento[0]["tipo_radicado"] != 1 && $documento[0]["tipo_radicado"] != 2) {
    $x_enlace = "ordenar.php?key=" . $key . "&accion=mostrar";
  } else
    $x_enlace = "ordenar.php?key=" . $key;
}
if ($_REQUEST["defecto"]) {
  $x_enlace .= "&defecto=" . $_REQUEST["defecto"];
}
if ($_REQUEST["mostrar_formato"]) {
  $x_enlace .= "&mostrar_formato=" . $_REQUEST["mostrar_formato"];
}
?>
<?php
  include_once ("phpmkrfn.php");

  $sAction = @$_POST["a_add"];
  $tabla = "pagina";
  if (@$_SESSION["tipo_doc"] == "registro")
    $tabla = "pagina_registro";
  if (($sAction == "") || (($sAction == NULL))) {
    $sKey = $key;
    $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
    if ($sKey <> "") {
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
    if (@$_POST["x_enlace"])
      $x_enlace = @$_POST["x_enlace"];
    sincronizar_carpetas($tabla, $conn);
  }

  switch ($sAction) {
    case "A" :
      // Add
      if (sincronizar_carpetas($tabla, $conn)) {// Add New Record
       if($key && $idformato[0][0]){
          llama_funcion_accion($key,$idformato[0][0],"digitalizar","POSTERIOR");
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
      abrir_url($x_enlace, "_self");
      exit();
      break;
  }
  $config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
?>
<style type="text/css">
	<!--INPUT, TEXTAREA, SELECT, body {
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
<span class="internos" style="font-family:verdana;font-size:10px">&nbsp;&nbsp;<b>ADICI&Oacute;N DE P&Aacute;GINAS AL DOCUMENTO</b></span>
<form name="paginaadd" id="paginaadd" action="paginaadd.php<?php echo("?key=".$key) ?>" method="POST" onSubmit="return EW_checkMyForm(this);">
	<input type="hidden" name="a_add" value="A">
	<?php
  $dir = "";
  $dir2 = "";
  $dir3 = "";
  $usuario = "";
  $clave = "";
  $puerto_ftp = 21;
  $configuracion["numcampos"] = 0;
  $configuracion = busca_filtro_tabla("A.*", "configuracion A", "tipo='ruta' OR tipo='clave' OR tipo='usuario' or tipo='peso' OR tipo='imagen' OR tipo='ftp'", "", $conn);
  for ($i = 0; $i < $configuracion["numcampos"]; $i++) {
    switch($configuracion[$i]["nombre"]) {
      case "ruta_servidor" :
        $dir = $configuracion[$i]["valor"];
        break;
      case "ruta_ftp" :
        $dir2 = $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
        break;
      case "ruta_temporal" :
        $dir3 = $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
        break;
      case "puerto_ftp" :
        $puerto_ftp = $configuracion[$i]["valor"];
        break;
      case "clave_ftp" :
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
    }
  }
  /*function LoadData($sKey, $conn) {
    global $_SESSION;
    global $x_consecutivo;
    global $x_id_documento;
    global $x_imagen;
    global $x_pagina;
    $sKeyWrk = "" . addslashes($sKey) . "";
    $sSql = "SELECT * FROM pagina";
    $sSql .= " WHERE consecutivo = " . $sKeyWrk;
    $sGroupBy = "";
    $sHaving = "";
    $sOrderBy = "";
    if ($sGroupBy <> "") {
      $sSql .= " GROUP BY " . $sGroupBy;
    }
    if ($sHaving <> "") {
      $sSql .= " HAVING " . $sHaving;
    }
    if ($sOrderBy <> "") {
      $sSql .= " ORDER BY " . $sOrderBy;
    }
    $rs = phpmkr_query($sSql, $conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
    if (phpmkr_num_rows($rs) == 0) {
      $LoadData = false;
    } else {
      $LoadData = true;
      $row = phpmkr_fetch_array($rs);
      $x_consecutivo = $row["consecutivo"];
      $x_id_documento = $row["id_documento"];
      $x_imagen = $row["imagen"];
      $x_pagina = $row["pagina"];
    }
    phpmkr_free_result($rs);
    return $LoadData;
  }*/
	?>
	<input type="hidden" name="EW_Max_File_Size" value="<?php echo($peso); ?>">
	<input type="hidden" name="x_enlace" value="<?php echo($x_enlace); ?>">
	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
		<tr>
			<td width="205" class="encabezado" ><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO
				ASOCIADO</span></td>
			<td width="335" bgcolor="#F5F5F5"><span class="phpmaker"> <?php
      if ($key)
        $x_id_documento = $key;
      else
        $x_id_documento = 0;
      if (!is_dir($dir3)) {
        if (!mkdir($dir3, PERMISOS_CARPETAS))
          alerta("no es posible crear una carpeta temporal para su usuario por favor comuniquese con el administrador", 'error', 5000);
        volver("1");
      }
      chmod($dir3, PERMISOS_CARPETAS);
				?>
				<input type="hidden" name="x_id_documento" id="x_id_documento" size="30" value="<?php echo htmlspecialchars(@$x_id_documento) ?>">
				<?php
				$tabla="documento";
				if(isset($_SESSION["tipo_doc"])&&$_SESSION["tipo_doc"]=='registro'){
				$tabla="archivo";
				}
				$documento=busca_tabla($tabla,$x_id_documento);
				if($documento["numcampos"]&&$tabla<>"archivo")
				echo stripslashes($documento[0]["descripcion"]);
				else if($tabla=="archivo")
				echo($documento[0]["titulo"]);
				else echo($x_id_documento)?> </span></td>
			<td width="207" rowspan="2" bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="submit" name="Action" value="CONTINUAR" />
			</span><div align="center"></div></td>
		</tr>
		<tr>
			<td width="205" class="encabezado" ><span class="phpmaker" style="color: #FFFFFF;">ESCANEAR DE NUEVO</span></td>
			<td width="335" bgcolor="#F5F5F5"><span class="phpmaker"> SI
				<input type="radio" name="x_escaneo" value="1">
				NO
				<input type="radio" name="x_escaneo" value="0" checked>
			</span></td>
		</tr>
		
		
		<!--tr>
			<td colspan="3">
			<applet code="uk.co.mmscomputing.application.imageviewer.MainApp.class"  archive="visor.jar" width="100%" height="640" name="scaner">
				<param name="url" value="<?php print($dir3); ?>">
				<param name="radica" value="<?php print($key); ?>">
				<param name="port" value="<?php print($puerto_ftp); ?>">
				<param name="host" value="<?php print($dir); ?>">
				<param name="usuario" value="<?php print($usuario); ?>">
				<param name="dftp" value="<?php print($dir2); ?>">
				<param name="clave" value="<?php print($clave); ?>">
				<param name="verLog" value="false">
				<param name="ancho" value="<?php print($ancho); ?>">
				<param name="alto" value="<?php print($alto); ?>">
				<param name="maxtabs" value="50">
			</applet></td>
		</tr-->
	</table>

	
	
</form>


<?php
//poner notificaciones noty
include_once("librerias_saia.php");
	global $raiz_saia;
	$raiz_saia='';
    echo(librerias_notificaciones());

?>



          

        
            <div id="output"></div>	

    <script language="javascript" type="text/javascript">
        //var wsUri = "ws://echo.websocket.org/";
        //var wsUri = "ws://localhost:8025/";
        var wsUri = "ws://localhost:8887/websockets/wsocketservice";
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
             enviarMensaje();
        }

        function onClose(evt) {
            clientId = null;
        }

        function onMessage(evt) {
            var mensaje = JSON.parse(evt.data);
            switch(mensaje.cmd) {
                case "CMD_ERR":
                    writeToScreen('<span style="color: red;">MENSAJE: ' + mensaje.text + '</span>');
                    break;
                case "CMD_END":
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
             notificacion_saia('<span style="color:white;">El Scanner No se encuentra ejecutado!</span>','error','',4000);
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
            
                var data = {
                    "url": "<?php print($dir3); ?>",
                    "radica": "<?php print($key); ?>",
                    "port": "<?php print($puerto_ftp); ?>",
                    "host": "<?php print($dir); ?>",
                    "usuario": "<?php print($usuario); ?>",
                    "dftp": "<?php print($dir2); ?>",
                    "clave": "<?php print($clave); ?>",
                    "verLog": "true",
                    "ancho": "<?php print($ancho); ?>",
                    "alto": "<?php print($alto); ?>",
                    "maxtabs": "50"
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
    
    
 