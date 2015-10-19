<?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../novedades_servicio/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><tr><td><table style="; width: 100%; font-family: Arial;" border="0" cellspacing="0">
<tbody>
<tr>
<td style="text-align: left;"><?php ciudad(1,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><br /><br /><br /><?php mostrar_destinos(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><br />Asunto: <?php mostrar_valor_campo('asunto',1,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><br /><br />Cordial saludo:&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('contenido',1,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><br /><br />Atentamente,&nbsp;</td>
</tr>
<tr>
<td><br /><?php mostrar_estado_proceso(1,$_REQUEST['iddoc']);?>&nbsp; <span style="width: 30%; text-align: right;">&nbsp;<?php mostrar_qr_carta(1,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><br /><?php mostrar_anexos_externa(1,$_REQUEST['iddoc']);?><?php tamanio_texto_anexos_ext(1,$_REQUEST['iddoc']);?><?php mostrar_copias_comunicacion_ext(1,$_REQUEST['iddoc']);?>Transcriptor: <?php mostrar_valor_campo('iniciales',1,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>