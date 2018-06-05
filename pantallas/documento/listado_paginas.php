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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo librerias_jquery("1.8");
$paginas = busca_filtro_tabla("","pagina","id_documento=".$_REQUEST["iddoc"],"pagina asc",$conn);
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>pantallas/lib/librerias_ventana_modal.js"></script>
<?php
if ($paginas["numcampos"]) {
	$ancho_imagen = busca_filtro_tabla("", "configuracion", "nombre='ancho_imagen'", "", $conn);
	$alto_imagen = busca_filtro_tabla("", "configuracion", "nombre='alto_imagen'", "", $conn);
	if (!$alto_imagen["numcampos"]) {
		$alto_imagen[0]["valor"] = 1125;
	}
	if (!$ancho_imagen["numcampos"]) {
		$ancho_imagen[0]["valor"] = 935;
	}
	for ($i = 0; $i < $paginas["numcampos"]; $i++) {
		$url=$ruta_db_superior."filesystem/mostrar_binario.php?ruta=".base64_encode($paginas[$i]["ruta"]);
		echo('<div>                                                        
     <img  src="' . $ruta_db_superior . 'imagenes/gris_imagenes.gif" data-original="' . $url . '" width="' . $ancho_imagen[0]["valor"] . '" height="' . $alto_imagen[0]["valor"] . '" ancho_ventana_modal="550px" alt="" class="img-polaroid enlace_ventana_modal" enlace_ventana_modal="' . PROTOCOLO_CONEXION . RUTA_PDF . '/pantallas/documento/pagina_documento.php?idpagina=' . $paginas[$i]["consecutivo"] . '" encabezado_ventana_modal="P&aacute;gina ' . $paginas[$i]["pagina"] . ' de ' . $paginas["numcampos"] . '">              
  </div>');
	}
}
?>