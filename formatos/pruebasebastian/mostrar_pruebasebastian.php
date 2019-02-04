<?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../carta/../../pantallas/qr/librerias.php'); ?><?php include_once('../prueba_formato_saia2/../../formatos/librerias/funciones_cliente.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><style> table{font-size: 8;} </style><tr><td><table class="table table-bordered" style="width: 100%;"><tbody><tr><td><strong>Fecha</strong></td><td><?php if(isset($_REQUEST["iddoc"])){fecha_creacion(427,$_REQUEST['iddoc']);}?>&nbsp;</td><td style="text-align: center;" rowspan="2">&nbsp;<?php if(isset($_REQUEST["iddoc"])){mostrar_codigo_qr(427,$_REQUEST['iddoc']);}?> <br>Radicado: <?php if(isset($_REQUEST["iddoc"])){formato_numero(427,$_REQUEST['iddoc']);}?></td></tr><tr><td><strong>Asunto</strong></td><td>{*asunto_documento*}</td></tr></table><br><table class="table table-bordered" style="width: 100%;"><tbody><tr>
    <td style="width:50%;"><strong>T&iacute;tulo de secci&oacute;n<strong></td>
    <td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('etiqueta_titulo_1857734299',427,$_REQUEST['iddoc']);}?></td>
    </tr><tr>
    <td style="width:50%;"><strong>T&iacute;tulo de secci&oacute;n<strong></td>
    <td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('etiqueta_titulo_915487093',427,$_REQUEST['iddoc']);}?></td>
    </tr><tr>
    <td style="width:50%;"><strong>Texto descriptivo<strong></td>
    <td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('etiqueta_parrafo_1504496047',427,$_REQUEST['iddoc']);}?></td>
    </tr><tr>
    <td style="width:50%;"><strong>Texto en una l&iacute;nea<strong></td>
    <td><?php if(isset($_REQUEST["iddoc"])){mostrar_valor_campo('campo_texto_1220423661',427,$_REQUEST['iddoc']);}?></td>
    </tr></tbody></table><br><br><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(427,$_REQUEST['iddoc']);}?></td></tr><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?>