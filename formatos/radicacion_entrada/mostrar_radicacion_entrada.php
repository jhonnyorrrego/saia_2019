<?php if(!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] != 5): ?><!DOCTYPE html>
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
                                    <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><p><?php if(isset($_REQUEST["iddoc"])){llenar_datos_funcion(3,$_REQUEST['iddoc']);}?></p>
<p style="text-align: center;"><strong>INFORMACI&Oacute;N GENERAL</strong></p>
<p style="text-align: center;"><?php if(isset($_REQUEST["iddoc"])){mostrar_informacion_general_radicacion(3,$_REQUEST['iddoc']);}?></p>
<p style="text-align: center;"><strong>INFORMACI&Oacute;N ORIGEN</strong></p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%;"><strong>Tipo de Origen:</strong></td>
<td style="width: 75%;"><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('tipo_origen',3,$_REQUEST['iddoc']);}?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Origen:</strong></td>
<td><?php if(isset($_REQUEST["iddoc"])){obtener_informacion_proveedor(3,$_REQUEST['iddoc']);}?></td>
</tr>
</tbody>
</table>
<p style="text-align: center;">&nbsp;</p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_item_destino_radicacion(3,$_REQUEST['iddoc']);}?></p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_copia_electronica(3,$_REQUEST['iddoc']);}?></p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(3,$_REQUEST['iddoc']);}?></p><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?><?php else: ?><?php
        include_once "../../controllers/autoload.php";
        include_once "../../pantallas/lib/librerias_cripto.php";
        
        global $conn;
        $iddocumento = $_REQUEST["iddoc"];
        $formato = busca_filtro_tabla("", "formato a,documento b", "lower(b.plantilla)= lower(a.nombre) and b.iddocumento=".$iddocumento, "", $conn);
        if ($formato[0]["pdf"] && $formato[0]["mostrar_pdf"] == 1) {
            $ruta = "/pantallas/documento/visor_documento.php?iddoc={$iddocumento}&rnd=" . rand(0, 100);
        } else {
            if ($formato[0]["mostrar_pdf"] == 1) {
                $ruta = "/pantallas/documento/visor_documento.php?iddoc={$iddocumento}&actualizar_pdf=1&rnd=" . rand(0, 100);
            } else if ($formato[0]["mostrar_pdf"] == 2) {
                $ruta = "/pantallas/documento/visor_documento.php?pdf_word=1&iddoc={$iddocumento}&rnd=" . rand(0, 100);
            }
        }
        
        $idfuncionario = encrypt_blowfish($_SESSION["idfuncionario"], LLAVE_SAIA_CRYPTO);
        $url = PROTOCOLO_CONEXION . RUTA_PDF . $ruta . "&idfunc=" . $idfuncionario;
        $ch = curl_init();
        if (strpos(PROTOCOLO_CONEXION, "https") !== false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);
        ?><?php endif; ?>