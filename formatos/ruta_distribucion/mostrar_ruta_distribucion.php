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
                                    <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../carta/../../pantallas/qr/librerias.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><table border="1" cellspacing="0" class="table table-bordered" style="border-collapse:collapse; width:100%">
	<tbody>
		<tr>
			<td colspan="2" style="border-color:#b6b8b7; border-style:solid; border-width:1px; text-align:center"><span><strong>RUTA DE DISTRIBUCI&Oacute;N</strong></span></td>
		</tr>
		<tr>
			<td style="border-color:#b6b8b7; border-style:solid; border-width:1px"><strong>&nbsp;Fecha</strong></td>
			<td style="border-color:#b6b8b7; border-style:solid; border-width:1px">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('fecha_ruta_distribuc',404,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="border-color:#b6b8b7; border-style:solid; border-width:1px"><strong>&nbsp;Nombre de la Ruta&nbsp;</strong></td>
			<td style="border-color:#b6b8b7; border-style:solid; border-width:1px">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('nombre_ruta',404,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="border-color:#b6b8b7; border-style:solid; border-width:1px"><strong>&nbsp;Descripci&oacute;n Ruta&nbsp;</strong></td>
			<td style="border-color:#b6b8b7; border-style:solid; border-width:1px">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('descripcion_ruta',404,$_REQUEST['iddoc']);}?>&nbsp;</td>
		</tr>
	</tbody>
</table>

<p><?php if(isset($_REQUEST["iddoc"])){enlace_item_dependencias_ruta(404,$_REQUEST['iddoc']);}?>&nbsp;</p>

<p><?php if(isset($_REQUEST["iddoc"])){mostrar_datos_dependencias_ruta(404,$_REQUEST['iddoc']);}?></p>

<p>&nbsp;</p>

<p><?php if(isset($_REQUEST["iddoc"])){enlace_item_funcionarios_ruta(404,$_REQUEST['iddoc']);}?></p>

<p><?php if(isset($_REQUEST["iddoc"])){mostrar_datos_funcionarios_ruta(404,$_REQUEST['iddoc']);}?></p>

<p><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(404,$_REQUEST['iddoc']);}?></p>
<?php include_once('../../formatos/librerias/footer_nuevo.php'); ?><?php else: ?><?php
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