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
                                    <meta content="" name="Cero K" /><?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../carta/../../pantallas/qr/librerias.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><table class="table table-bordered" style="width:100%">
	<tbody>
		<tr>
			<td><strong>Fecha</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){fecha_creacion(459,$_REQUEST['iddoc']);}?>&nbsp;</td>
			<td rowspan="2" style="text-align:center">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_codigo_qr(459,$_REQUEST['iddoc']);}?><br />
			Radicado: <?php if(isset($_REQUEST["iddoc"])){formato_numero(459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td><strong>Asunto</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){asunto_documento(459,$_REQUEST['iddoc']);}?></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<table class="table table-bordered" style="width:100%">
	<tbody>
		<tr>
			<td style="width:50%"><strong>T&iacute;tulo de secci&oacute;n</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('etiqueta_titulo_657648566',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>ADJUNTOS</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('adjuntos',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>L&iacute;nea de separaci&oacute;n</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('etiqueta_linea_1840635814',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>FECHA</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('fecha',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>No.CEDULA</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('nocedula',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>NOMBRE COMPLETO</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('nombre_completo',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>TIPO DE SOLICITUD</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('tipo_solicitud',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>MEDIO DE LA SOLICITUD</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('medio_la_solicitud',459,$_REQUEST['iddoc']);}?></td>
		</tr>
		<tr>
			<td style="width:50%"><strong>COMENTARIO O DESCRIPCI&Oacute;N</strong></td>
			<td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('comentario_descripcion',459,$_REQUEST['iddoc']);}?></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;
<p><br />
<?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(459,$_REQUEST['iddoc']);}?></p>
</p>

<p>&nbsp;</p>
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