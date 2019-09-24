<?php
include_once "../../core/autoload.php";

try {
    JwtController::check($_REQUEST["token"], $_REQUEST["key"]);    
} catch (\Throwable $th) {
    die("invalid access");
}

if(
    !$_REQUEST['mostrar_pdf'] && !$_REQUEST['actualizar_pdf'] && (
        ($_REQUEST["tipo"] && $_REQUEST["tipo"] == 5) ||
        0 == 0
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
            <?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../memorando/../librerias/funciones_generales.php'); ?><?php include_once('../memorando/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?>
            <table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Asunto</td>
<td style="text-align: left;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('asunto',348,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Oficio Entrada</td>
<td style="text-align: left;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('fecha_oficio_entrada',348,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">De</td>
<td style="text-align: left;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('de',348,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Para</td>
<td style="text-align: left;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('para',348,$_REQUEST['iddoc']);}?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Transferido</td>
<td style="text-align: left;">&nbsp;<?php busca_campo('{"tipo":"multiple","url":"../../autocompletar.php","campoid":"funcionario_codigo","campotexto":["nombres","apellidos"],"tablas":["funcionario"],"condicion":"estado=1","orden":""}','','',mostrar_valor_campo('transferencia_correo','348',$_REQUEST['iddoc'],1)); ?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Con copia</td>
<td style="text-align: left;">&nbsp;{*copia_correo*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Comentario</td>
<td style="text-align: left;">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('comentario',348,$_REQUEST['iddoc']);}?></td>
</tr>
</tbody>
</table>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(348,$_REQUEST['iddoc']);}?></p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_anexos_correo(348,$_REQUEST['iddoc']);}?></p>
            <?php include_once('../../formatos/librerias/footer_nuevo.php'); ?>
<?php else:
    include_once "../../pantallas/lib/librerias_cripto.php";

    $documentId = $_REQUEST["iddoc"];
    $sql = "select b.pdf, a.mostrar_pdf,a.exportar from formato a, documento b where lower(b.plantilla)= lower(a.nombre) and b.iddocumento={$documentId}";
    $record = StaticSql::search($sql);

    $params = [
        "iddoc" => $documentId,
        "type" => "TIPO_DOCUMENTO",
        "typeId" => $documentId,
        "exportar" => $record[0]["exportar"],
        "ruta" => base64_encode($record[0]["pdf"])
    ];

    if(($record[0]["mostrar_pdf"] == 1 && !$record[0]["pdf"]) || $_REQUEST["actualizar_pdf"]){
        $params["actualizar_pdf"] = 1;
    }else if($record[0]["mostrar_pdf"] == 2){
        $params["pdf_word"] = 1;
    }

    $url = PROTOCOLO_CONEXION . RUTA_PDF . "/views/visor/pdfjs/viewer.php?";
    $url.= http_build_query($params);

    ?>
    <iframe width="100%" frameborder="0" onload="this.height = window.innerHeight - 20" src="<?= $url ?>"></iframe>
<?php endif; ?>