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
                                <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><p>{*cargar_datos_rad_obras*}</p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td><strong>Fecha de radicaci&oacute;n:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('fecha_radicacion',422,$_REQUEST['iddoc']);}?></td>
<td style="text-align: center;" rowspan="3" colspan="2">{*ver_qr_rad_obras*}</td>
</tr>
<tr>
<td><strong><strong>N&uacute;mero de la factura:</strong></strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('numero_factura',422,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Valor de la factura:</strong></td>
<td>{*mostrar_valor_factura*}</td>
</tr>
<tr>
<td style="width: 30%;"><strong>Concepto de la factura:</strong></td>
<td style="width: 25%;"><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('concepto_factura',422,$_REQUEST['iddoc']);}?></td>
<td style="width: 20%;"><strong>Tipo documental:</strong></td>
<td style="width: 25%;">{*ver_tipo_doc*}</td>
</tr>
<tr>
<td><strong>Vencimiento de la factura:</strong></td>
<td>{*color_vence_factura*}</td>
<td><strong>N&uacute;mero de Gu&iacute;a:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('numero_guia',422,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong>Empresa Transportadora:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('empresa_trans',422,$_REQUEST['iddoc']);}?></td>
<td><strong>N&uacute;mero de folios:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('numero_folios',422,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td><strong><strong>Anexos digitales:</strong></strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('anexos_digitales',422,$_REQUEST['iddoc']);}?></td>
<td><strong>Anexos fisicos:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('anexos_fisicos',422,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Persona Natural/Jur&iacute;dica:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('persona_natural',422,$_REQUEST['iddoc']);}?></td>
<td style="vertical-align: middle;"><strong>Fecha de pago:</strong></td>
<td>{*ver_fecha_pago*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Destino:</strong></td>
<td colspan="3">{*mostrar_destino_facturas_obras*}</td>
</tr>
<tr>
<td style="vertical-align: middle;"><strong>Copia electr&oacute;nica:</strong></td>
<td colspan="3"><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('copia',422,$_REQUEST['iddoc']);}?></td>
</tr>
</tbody>
</table>
<p>{*mostrar_listado_distribucion_documento*}</p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(422,$_REQUEST['iddoc']);}?></p><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?><?php else: ?><?php
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