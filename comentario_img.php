<?php
include_once("db.php");

if (@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]) {
	$_REQUEST["iddoc"] = @$_REQUEST["key"];
	include_once ("pantallas/documento/menu_principal_documento.php");
	echo (menu_principal_documento(@$_REQUEST["iddoc"], 1));
}

include_once ("header.php");

require_once('StorageUtils.php');
require_once('filesystem/SaiaStorage.php');
require('vendor/autoload.php');

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

if (isset($_REQUEST["key"])) // identificador del documento
	$llave = $_REQUEST["key"];
else
	$llave = $_GET["iddoc"]; // $_REQUEST["key"];

$frame = "centro";
$plantilla = busca_filtro_tabla("plantilla", "documento", "iddocumento=$llave", "", $conn);
if ($plantilla[0][0] != "")
	$frame = "detalles";
?>

  <style type="text/css">
.estilotextarea
{   width: 140px;
    height:100px;
    border: none;
    background-color: #ffff99;
    font-family: Verdana;
    font-size: 9px;
}
.ppal{
		margin:0px;
		margin-top:0px;
		width:100%;
		background-color:#CCCCCC;
		font-family: Verdana;
		font-size: 9px;
    overflow:scroll;
	}
.tool_tabla{
    border-width: 10px;
    border-color: blue;
    border: outset 3pt;
    border-spacing: 2pt;
    border: 5px solid #073A78;
}
.tool_td{
    border: 1px solid #073A78;
    padding: 1em;
}
img{
    border: none;
}

</style>
<script text="javascript">

function ocultar_enlaces() {
  window.frames[0].document.getElementById("div3").style.display="none";
  document.getElementById("tool").style.display="none";
}

 function pagina_navegador(doc,pag) {
  if(pag=='0')
   return;
  parent.<?php echo $frame; ?>.location ="comentario_mostrar.php?pagina=pagina&key="+doc+"&pag="+pag;
 }

</script>
<?php
$x_comentario = Null;
$enlace = "";
$tipo_pag = "";

$tipo_doc = @$_SESSION["tipo_doc"];

if (isset($_REQUEST["enlace"]) && $_REQUEST["enlace"] != "") {
	$enlace = $_REQUEST["enlace"];
	if (stristr($enlace, "factura_final.php")) {
		$enlace .= "&mostrar=true";
	}
	if (isset($_REQUEST["id"]) && strpos($enlace, '.pdf') == false) {
		$enlace .= "&iddoc='" . $_REQUEST["id"] . "'";
	}
	$_SESSION["pagina_actual"] = $_REQUEST["id"];
	$pag = $_SESSION["pagina_actual"];
	$_SESSION["tipo_pagina"] = $enlace;
	$tipo_pag = "PLANTILLA";
} elseif (isset($_REQUEST["pag"])) {
	$pag = $_REQUEST["pag"];
	$tipo_pag = "PAGINA";
	$_SESSION["tipo_pagina"] = "pagina";
	$_SESSION["pagina_actual"] = $pag;
} elseif (isset($_REQUEST["tipo"])) {
	$pag = $_REQUEST["pag"];
	$tipo_pag = "REGISTRO";
	$_SESSION["tipo_pagina"] = "pagina";
	$_SESSION["pagina_actual"] = $pag;
} elseif (isset($_REQUEST["rotar"])) {
	$pag = $_SESSION["pagina_actual"];
	$valida_pag = busca_filtro_tabla("*", "pagina", "id_documento=$llave AND consecutivo='$pag'", "", $conn);
	if (!($valida_pag["numcampos"])) {
		echo utf8_encode("<script type='text/javascript'>alert('Debe seleccionar una p�gina del documento'); parent.$frame.location='ordenar.php?key=" . $llave . "&accion=mostrar';</script>");
	}
} elseif (isset($_REQUEST["pagina"])) {
	$pag = $_SESSION["pagina_actual"];
} else {
	echo utf8_encode("<script type='text/javascript'>alert('Debe seleccionar una p�gina del documento'); parent.$frame.location='ordenar.php?key=" . $llave . "&accion=mostrar';</script>");
}
$paginas_doc = busca_filtro_tabla("DISTINCT pagina, consecutivo", "pagina", "id_documento=" . $llave, "pagina", $conn);
if ($paginas_doc["numcampos"] > 0 || $tipo_pag != "PAGINA" || $tipo_pag != "REGISTRO") {
	if (isset($_REQUEST["pagina"])) { // Especifica que hacer en el Navegador de las paginas del documento.
		$num_pag = $paginas_doc["numcampos"];
		$pagina_actual = "";
		$accion = $_REQUEST["pagina"];
		$pag = $_SESSION["pagina_actual"];

		switch ($accion) {
			case "inicio" :
				if ($num_pag >= 1)
					$pag = $paginas_doc[0]["consecutivo"];
				break;

			case "ant" :
				for($j = 0; $j < $num_pag; $j++) {
					if ($paginas_doc[$j]["consecutivo"] == $pag)
						if ($paginas_doc[$j]["pagina"] > $paginas_doc[0]["pagina"]) {
							$pag = $paginas_doc[$j - 1]["consecutivo"];
							$j = $num_pag;
						}
				}
				break;

			case "sig" :
				for($j = 0; $j < $num_pag; $j++) {
					if ($paginas_doc[$j]["consecutivo"] == $pag)
						if ($paginas_doc[$j]["pagina"] < $paginas_doc[($num_pag - 1)]["pagina"]) {
							$pag = $paginas_doc[$j + 1]["consecutivo"];
							$j = $num_pag;
						}
				}
				break;

			case "fin" :
				if ($num_pag >= $paginas_doc[0]["pagina"])
					$pag = $paginas_doc[$num_pag - 1]["consecutivo"];
				break;

			case "pagina" :
				for($j = 0; $j < $num_pag; $j++) {
					if ($paginas_doc[$j]["consecutivo"] == $_REQUEST["pag"])
						if ($paginas_doc[$j]["pagina"] <= $num_pag) {
							$pag = $paginas_doc[$j]["consecutivo"];
							$j = $num_pag;
						}
				}
				break;
		}
		$_SESSION["pagina_actual"] = $pag;
		$tipo_pag = "PAGINA";
	}
	// Busca en la BD la rutra de las imagenes de las paginas - miniatura y imagen normal.
	$listado = busca_filtro_tabla("*", " pagina ", "id_documento=" . $llave . " AND consecutivo='" . $pag . "'", "pagina", $conn);
	if ($listado["numcampos"]) {
		$ruta = $listado[0]["ruta"];
	}
	if (isset($_REQUEST["rotar"])) { // Rota 90 grados la imagen real, guardando los cambios
		$grados = 0;
		if ($_REQUEST["rotar"] == "derecha") {
			$grados = 90;
		} else {
			$grados = -90;
		}
		$imagen = imagecreatefromjpeg($ruta);
		$color = imagecolorallocate($imagen, 220, 220, 200);
		if (function_exists("imagerotate")) {
			$imagen = imagerotate($imagen, $grados, $color);
			if ($imagen) {
				imagejpeg($imagen, $ruta);
				imagedestroy($imagen);
			}
		} else {
			alerta("No es posible rotar la Imagen(Caracteristica no instalada)");
		}
		$tipo_pag = "PAGINA";
	}

	// informacion del documento
	$mostrar = "DOCUMENTO:";
	if ($tipo_doc == "registro") {
		$documento_tabla = "archivo";
		$mostrar = "REGISTRO:";
	} else {
		$documento_tabla = "documento";
	}
	$detalle_doc = busca_filtro_tabla("numero,descripcion,plantilla,pdf", $documento_tabla, "id" . $documento_tabla . "='$llave'", "", $conn);

  ?>
<div  align="center">
<?php
menu_ordenar($llave);
?>
</div>
<div id="tool" style="display:block;"><br /><br />

<span class="internos">&nbsp;&nbsp;DOCUMENTO:&nbsp;</span>

<span class="phpmaker" margin-top="0">
<?php echo $detalle_doc[0]["numero"]." - ".str_replace(chr(10), "<br>", stripslashes($detalle_doc[0]["descripcion"]));?>
</span>
<hr>
<div align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<?php
$aux_formato = strtolower($detalle_doc[0]["plantilla"]);

	if (is_file("formatos/$aux_formato/detalles_mostrar_$aux_formato.php")) {
		$idformato = busca_filtro_tabla('idformato', 'formato', 'nombre like "' . $aux_formato . '"', '', $conn);

		$ruta_detalles = "formatos/$aux_formato/detalles_mostrar_$aux_formato.php?idformato=" . $idformato[0]["idformato"] . "&iddoc=" . $llave;
		// echo "<a href='$ruta_detalles' target='centro'><img src=''></a>";
		echo "<td align='center'>";
		agrega_boton("images", "botones/comentarios/detalles.png", $ruta_detalles, "centro", "Formatos Relacionados", "", "formatos");
		echo "</td>";
	}

	if ($detalle_doc[0]["numero"] > 0 && $detalle_doc[0]["pdf"] != "" && $enlace != "") {
		echo "<td align='center'>";
		agrega_boton("images", "enlaces/imprimir_pdf.png", "borrar_pdf.php?iddoc=$llave", "centro_prueba", "Actualizar PDF", "", "regenerar_pdf");
		echo "</td>";
	}

	if ($paginas_doc["numcampos"] > 0 || ($tipo_pag == 'PLANTILLA' && $detalle_doc[0]["numero"] == 0)) {

		/*
		 if($tipo_pag=="PLANTILLA" && $detalle_doc[0]["numero"]==0) {
		 	echo "<td align='center'>";
		 	agrega_boton("images","botones/comentarios/eliminar_pagina.png","documento_borrar.php?iddoc=$llave","centro","Eliminar Borrador","","eliminar_borrador");
		 	echo "</td>";
		 }
		 */

		if ($paginas_doc["numcampos"] > 0 && $enlace == "") {
			?>
<script src="js/jquery.js"></script>
<script>
	function comprobar_estampa(pagina){
		$.post("digital_signed/estampado_tiempo.php",{idpagina : pagina, verificar : 1},function(respuesta){
			alert(respuesta);
		});
	}
</script>
 	<td align="center">
 	<!--a href="#" onclick="comprobar_estampa(<?php echo $_REQUEST["pag"]; ?>);">Estampa</a-->&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp; <a href="comentario_mostrar.php?rotar=izq&key=<?php echo $_REQUEST["key"]; ?>" target="<?php echo $frame;?>"><img src="botones/comentarios/rotar_derecha.png" alt="Girar a la derecha" border="0" /></a>&nbsp
   <a href="comentario_mostrar.php?rotar=derecha&key=<?php echo $_REQUEST["key"]; ?>" target="<?php echo $frame;?>"><img src="botones/comentarios/rotar_izquierda.png" alt="Girar a la izquierda" border="0"></a>&nbsp&nbsp&nbsp
   </td>
   <td align="center"><br>
     <?php
     agrega_boton("images","botones/comentarios/eliminar_pagina.png","paginadelete.php","$frame","","","eliminar_pagina");
     ?>
   </td>
   <td align="center"><br>
   <form>
   <select name="valor" id="valor" onchange="zoom('+','prueba',valor.value,<?php echo $pag?>); this.blur();">
   <option value="25">25%</option>
   <option value="50">50%</option>
   <option value="75">75%</option>
   <option value="100" selected>100%</option>
   <option value="150">150%</option>
   <option value="200">200%</option>
   </select>
   </form>
  </td>

   <td align="center" valign="middle">
   <a href="comentario_mostrar.php?pagina=inicio&key=<?php echo $_REQUEST["key"]; ?>" target="<?php echo $frame;?>"><img src="imagenes/principio.gif" alt="Primera P&aacute;gina" border="0"></a>
   <a href="comentario_mostrar.php?pagina=ant&key=<?php echo $_REQUEST["key"]; ?>" target="<?php echo $frame;?>"><img src="imagenes/atras.gif" alt="P&aacute;gina anterior" border="0"></a>&nbsp;
   <?php
			$paginas = 0;
			$paginas = $paginas_doc["numcampos"];
			$select_pag = "<select id=\"idpagina\" onchange=\"pagina_navegador(" . $llave . ",idpagina.value);\">";
			for($i = 0; $i < $paginas; $i++) {
				$select_pag .= "<option value=\"" . $paginas_doc[$i]["consecutivo"] . "\"";
				if ($paginas_doc[$i]["consecutivo"] == $pag) {
					$select_pag .= " selected ";
				}
				$select_pag .= ">" . ($paginas_doc[$i]["pagina"]) . "</option>";
			}
			echo $select_pag . "</select>";
   ?>
   <a href="comentario_mostrar.php?pagina=sig&key=<?php echo $_REQUEST["key"]; ?>" target="<?php echo $frame;?>"><img src="imagenes/adelante.gif" alt="Siguiente P&aacute;gina" border="0"></a>
   <a href="comentario_mostrar.php?pagina=fin&key=<?php echo $_REQUEST["key"]; ?>" target="<?php echo $frame;?>"><img src="imagenes/final.gif" alt="&Uacute;ltima P&aacute;gina" border="0"></a>&nbsp;
   </td>
   <?php }
	}
?>
   </tr>
   </table></div><hr>
   </div>
  <div width="50" align="center" >
  <?php
  $var = md5(time());   //para evitar la memoria cache
  if($enlace=="") {      //si es una pagina (imagen) del documento
  	//print_r($ruta);die();
  	$contenido_img = StorageUtils::get_binary_file($ruta);
  ?>
  <br />
  <img id="prueba" src="<?php echo $contenido_img; ?>"><br><br>
</div>
  </div>
  <?php
  } else  {//si es plantilla que corresponde al documento.
  ?>
  <div id="imprimir">
  <br><br></div>
  <iframe id="centro_prueba" name="centro_prueba" style="position:relative; left:10px; top:-20;" height="1150pt" width="900pt" scrolling="auto" frameborder="no" src="<?php echo $enlace; ?>" allowtransparency="yes" onload="ocultar_enlaces();"></iframe>
  <?php
  }
	$componentes = "";
	if ($tipo_pag == 'PAGINA') {
		$comentario = busca_filtro_tabla("*", "comentario_img", "documento_iddocumento=" . $llave . " AND tipo='$tipo_pag' AND pagina='" . $pag . "'", "", $conn);
	} else {
		$comentario = busca_filtro_tabla("*", "comentario_img", "documento_iddocumento=" . $llave . " AND tipo='$tipo_pag' AND pagina='" . $pag . "'", "", $conn);
	}
		// print_r($comentario);
	if ($comentario["numcampos"]) {
		echo '<div id="notas" style="display:block;">';
   ?>
   <div id="bubble_tooltip" >
	<div class="bubble_top"></div>
	<div class="bubble_middle"><span id="bubble_tooltip_content"></span></div>
	<div class="bubble_bottom"></div>
</div>
   <?php
		for($i = 0; $i < $comentario["numcampos"]; $i++) {
			$posx = $comentario[$i]["posx"];
			$posy = $comentario[$i]["posy"];
			$texto = $comentario[$i]["comentario"];
			$id = $comentario[$i]["idcomentario_img"];
			$nombre_usuario_nota = busca_filtro_tabla("nombres, apellidos", "funcionario", "login='" . $comentario[$i]["funcionario"] . "'", "", $conn);
       ?>
       <table class="tooltip_text" href="#" onmousemove="showToolTip(event,'<?php echo trim($texto); ?>','<?php echo ($posy); ?>'); return false" onmouseout="hideToolTip()" width="20px" height="20px" style="position:absolute; top:<?php echo ($posy+85); ?>px; left:<?php echo ($posx+25); ?>px">
       <tr><td  align="center" background="images/mostrar_nota.png"><?php echo ($i+1);?></td></tr>
       </table>
       Comentario N&ordm;
       <?php
			echo ($i + 1) . ": " . $texto . "&nbsp;&nbsp;&nbsp;&nbsp; Autor: " . $nombre_usuario_nota[0]["nombres"] . " " . $nombre_usuario_nota[0]["apellidos"] . "<br>";
		}
		echo '</div>';
	}
} else {
	echo utf8_encode("<script type='text/javascript'>alert('El documento no tiene p�ginas');</script>");
	redirecciona("ordenar.php?key=" . $llave . "&accion=mostrar");
}
include ("footer.php");
?>
