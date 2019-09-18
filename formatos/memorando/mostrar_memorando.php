<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'formatos/memorando/funciones.php';

try {
    JwtController::check($_REQUEST["token"], $_REQUEST["key"]);    
} catch (\Throwable $th) {
    die("invalid access");
}

if(
    !$_REQUEST['mostrar_pdf'] && !$_REQUEST['actualizar_pdf'] && (
        ($_REQUEST["tipo"] && $_REQUEST["tipo"] == 5) ||
        0 == 1
    )
): ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
            <meta charset="utf-8" />
            <meta name="viewport"
                content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-touch-fullscreen" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="default">
            <meta content="" name="description" />
            <meta content="" name="Cero K" /> 
        </head>
        <body>
            <div class="container bg-master-lightest mx-0 px-2 px-md-2 mw-100">
                <div id="documento" class="row p-0 m-0">
                    <div id="pag-0" class="col-12 page_border bg-white">
                        <div class="page_margin_top mb-0" id="doc_header">
                        <?php include_once $ruta_db_superior . "formatos/librerias/header_nuevo.php" ?>
                        </div>
                        <div id="pag_content-0" class="page_content">
                            <div id="page_overflow">
                                <table border="\&quot;0\&quot;" cellspacing="\&quot;0\&quot;" style="\&quot;border-collapse:collapse">
	<tbody>
		<tr>
			<td colspan="\&quot;2\&quot;">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="\&quot;2\&quot;">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="\&quot;2\&quot;"><?php ciudad(2, $_REQUEST['iddoc']) ?>, <?php mostrar_fecha(2, $_REQUEST['iddoc']) ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><br />
			DE:</td>
			<td><br />
			<?php mostrar_origen(2, $_REQUEST['iddoc']) ?></td>
			<td rowspan="\&quot;5\&quot;"><?php mostrar_codigo_qr(2, $_REQUEST['iddoc']) ?><br />
			<br />
			No. <?php formato_radicado_interno(2, $_REQUEST['iddoc']) ?></td>
		</tr>
		<tr>
			<td>PARA:</td>
			<td><?php lista_destinos(2, $_REQUEST['iddoc']) ?>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="\&quot;2\&quot;">&nbsp;</td>
		</tr>
		<tr>
			<td>ASUNTO:</td>
			<td><?= mostrar_valor_campo('asunto', 2, $_REQUEST['iddoc']) ?></td>
		</tr>
		<tr>
			<td colspan="\&quot;3\&quot;">
			<p><br />
			Cordial saludo:</p>

			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td colspan="\&quot;3\&quot;"><?= mostrar_valor_campo('contenido', 2, $_REQUEST['iddoc']) ?></td>
		</tr>
		<tr>
			<td colspan="\&quot;3\&quot;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="\&quot;3\&quot;">Atentamente,&nbsp;</td>
		</tr>
		<tr>
			<td colspan="\&quot;3\&quot;">
			<p><?php mostrar_estado_proceso(2, $_REQUEST['iddoc']) ?></p>

			<p><?php mostrar_anexos(2, $_REQUEST['iddoc']) ?><br />
			<?php mostrar_copias_memo(2, $_REQUEST['iddoc']) ?><br />
			Proyect&oacute;: <?php mostrar_iniciales(2, $_REQUEST['iddoc']) ?></p>
			</td>
		</tr>
	</tbody>
</table>

                            </div>
                        </div>
                        <?php include_once $ruta_db_superior . "formatos/librerias/footer_nuevo.php" ?>
                    </div> <!-- end page-n -->
                </div> <!-- end #documento-->
            </div> <!-- end .container -->
        </body>
    </html>
<?php else:
    $documentId = $_REQUEST["iddoc"];
    $Documento = new Documento($documentId);
    $Formato = $Documento->getFormat();

    $params = [
        "iddoc" => $documentId,
        "type" => "TIPO_DOCUMENTO",
        "typeId" => $documentId,
        "exportar" => $Formato->exportar,
        "ruta" => base64_encode($Documento->pdf)
    ];

    if(($Formato->mostrar_pdf == 1 && !$Documento->pdf) || $_REQUEST["actualizar_pdf"]){
        $params["actualizar_pdf"] = 1;
    }else if($Formato->mostrar_pdf == 2){
        $params["pdf_word"] = 1;
    }

    $url = PROTOCOLO_CONEXION . RUTA_PDF . "/views/visor/pdfjs/viewer.php?";
    $url.= http_build_query($params);

    ?>
    <iframe width="100%" frameborder="0" onload="this.height = window.innerHeight - 20" src="<?= $url ?>"></iframe>
<?php endif; ?>