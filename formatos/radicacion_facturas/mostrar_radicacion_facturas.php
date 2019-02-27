<?php if(($_REQUEST["tipo"] && $_REQUEST["tipo"] == 5) || 0 == 0): ?><!DOCTYPE html>
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
                                <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center; background-color: #319ecd;" colspan="2"><span style="color: #ffffff;"><strong>INFORMACI&Oacute;N GENERAL</strong></span></td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><?php if(isset($_REQUEST["iddoc"])){mostrar_informacion_general_factura(424,$_REQUEST['iddoc']);}?></p>
<p style="text-align: center;">&nbsp;</p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center; background-color: #319ecd;" colspan="2"><span style="color: #ffffff;"><strong>INFORMACI&Oacute;N ORIGEN</strong></span></td>
</tr>
<tr>
<td style="width: 25%;"><strong>Persona natural/juridica</strong></td>
<td style="width: 75%;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('natural_juridica',424,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td style="width: 25%;"><strong>Fecha de emision de la factura:</strong></td>
<td style="width: 75%;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('fecha_emision',424,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Numero de factura:</strong></td>
<td>&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('num_factura',424,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Descripcion servicio o producto</strong></td>
<td>&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('descripcion',424,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Numero de folios</strong></td>
<td>&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('num_folios',424,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Copia electronica a</strong></td>
<td>&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('copia_electronica',424,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Estado</strong></td>
<td>&nbsp;<?php if(isset($_REQUEST["iddoc"])){estado_facturas(424,$_REQUEST['iddoc']);}?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php if(isset($_REQUEST["iddoc"])){item_factura(424,$_REQUEST['iddoc']);}?></p>
<p>&nbsp;</p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(424,$_REQUEST['iddoc']);}?></p><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?><?php else: ?><?php
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