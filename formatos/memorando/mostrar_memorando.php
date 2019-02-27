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
                                <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../funciones.php'); ?><?php include_once('../carta/../librerias/funciones_generales.php'); ?><?php include_once('../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../librerias/funciones_generales.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../carta/../../pantallas/qr/librerias.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td width="15%">&nbsp;</td>
<td width="35%">&nbsp;</td>
<td width="50%">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php if(isset($_REQUEST["iddoc"])){ciudad(2,$_REQUEST['iddoc']);}?>, <?php if(isset($_REQUEST["iddoc"])){mostrar_fecha(2,$_REQUEST['iddoc']);}?></td>
<td style="text-align: right;" rowspan="5"><?php if(isset($_REQUEST["iddoc"])){mostrar_codigo_qr(2,$_REQUEST['iddoc']);}?><br /><span style="font-size: 8pt;"><?php if(isset($_REQUEST["iddoc"])){formato_radicado_interno(2,$_REQUEST['iddoc']);}?></span></td>
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
<td>PARA:</td>
<td><?php if(isset($_REQUEST["iddoc"])){lista_destinos(2,$_REQUEST['iddoc']);}?>&nbsp;</td>
</tr>
<tr>
<td>DE:</td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_origen(2,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td>ASUNTO:</td>
<td colspan="2"><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('asunto',2,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td colspan="3">
<p><br />Cordial saludo:</p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('contenido',2,$_REQUEST['iddoc']);}?></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;Atentamente,&nbsp;&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(2,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td colspan="3"><?php if(isset($_REQUEST["iddoc"])){mostrar_anexos(2,$_REQUEST['iddoc']);}?><br /><?php if(isset($_REQUEST["iddoc"])){mostrar_copias_memo(2,$_REQUEST['iddoc']);}?><br />Proyect&oacute;: <?php if(isset($_REQUEST["iddoc"])){mostrar_iniciales(2,$_REQUEST['iddoc']);}?></td>
</tr>
</tbody>
</table><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?><?php else: ?><?php
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