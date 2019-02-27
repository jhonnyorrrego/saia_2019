<?php if(($_REQUEST["tipo"] && $_REQUEST["tipo"] == 5) || 0 == 1): ?><!DOCTYPE html>
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
                                <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../librerias/funciones_generales.php'); ?><?php include_once('../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../funciones.php'); ?><?php include_once('../solicitud_prestamo/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../distribucion_fisica/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../../pantallas/qr/librerias.php'); ?><?php include_once('../distribucion_fisica/../../pantallas/qr/librerias.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2"><?php if(isset($_REQUEST["iddoc"])){ciudad(1,$_REQUEST['iddoc']);}?>, <?php if(isset($_REQUEST["iddoc"])){mostrar_fecha(1,$_REQUEST['iddoc']);}?></td>
<td style="text-align: right;" rowspan="4"><?php if(isset($_REQUEST["iddoc"])){mostrar_codigo_qr(1,$_REQUEST['iddoc']);}?><br /> <?php if(isset($_REQUEST["iddoc"])){formato_radicado_enviada(1,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php if(isset($_REQUEST["iddoc"])){mostrar_destinos(1,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td colspan="3">&nbsp;
<p>ASUNTO: &nbsp; &nbsp; <?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('asunto',1,$_REQUEST['iddoc']);}?></p>
</td>
</tr>
<tr>
<td colspan="3">
<p>&nbsp;<br /> Cordial saludo:</p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('contenido',1,$_REQUEST['iddoc']);}?></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;Atentamente,</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(1,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td colspan="3"><?php if(isset($_REQUEST["iddoc"])){mostrar_anexos_externa(1,$_REQUEST['iddoc']);}?><br /> <?php if(isset($_REQUEST["iddoc"])){mostrar_copias_comunicacion_ext(1,$_REQUEST['iddoc']);}?>Proyect&oacute;: <?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('iniciales',1,$_REQUEST['iddoc']);}?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?><?php else: ?><?php
        include_once "../../controllers/autoload.php";
        include_once "../../pantallas/lib/librerias_cripto.php";
        
        $documentId = $_REQUEST["iddoc"];
        $sql = "select b.pdf, a.mostrar_pdf,a.exportar from formato a, documento b where lower(b.plantilla)= lower(a.nombre) and b.iddocumento={$documentId}";
        $record = StaticSql::search($sql);

        $params = [
            "iddoc" => $documentId,
            "exportar" => $record[0]["exportar"],
            "ruta" => base64_encode($record[0]["pdf"]),
            "usuario" => encrypt_blowfish($_SESSION["idfuncionario"], LLAVE_SAIA_CRYPTO)
        ];

        if(($record[0]["mostrar_pdf"] == 1 && !$record[0]["pdf"]) || $_REQUEST["actualizar_pdf"]){
            $params["actualizar_pdf"] = 1;
        }else if($record[0]["mostrar_pdf"] == 2){
            $params["pdf_word"] = 1;
        }
        
        $url = PROTOCOLO_CONEXION . RUTA_PDF . "/views/visor/pdfjs/viewer.php?";
        $url.= http_build_query($params);

        ?>
        <iframe width="100%" frameborder="0" onload="this.height = window.innerHeight - 20" src="<?= $url ?>"></iframe><?php endif; ?>