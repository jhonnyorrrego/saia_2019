<?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../novedades_servicio/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 60%;">&nbsp;</td>
<td style="text-align: center; width: 20%;">&nbsp;</td>
<td style="text-align: left; width: 20%;">&nbsp;</td>
</tr>
<tr>
<td><?php ciudad(1,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(1,$_REQUEST['iddoc']);?><br /><br /><br /><?php mostrar_destinos(1,$_REQUEST['iddoc']);?></td>
<td colspan="2">
<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 2%; border-left-style: solid; border-top-style: solid;">&nbsp;</td>
<td style="width: 41%; border-top-style: solid;">&nbsp;</td>
<td style="width: 3%; border-top-style: solid;">&nbsp;</td>
<td style="width: 52%; border-top-style: solid;">&nbsp;</td>
<td style="width: 2%; border-right-style: solid; border-top-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td style="padding-right: 10px; border-bottom-style: solid;" rowspan="3"><?php mostrar_qr_carta(1,$_REQUEST['iddoc']);?>&nbsp;</td>
<td>&nbsp;</td>
<td style="font-size: 7pt; padding: 10px; border-bottom-style: solid;" rowspan="3"><br /><br /> <span style="font-size: 7pt;"><?php mostrar_datos_radicacion(1,$_REQUEST['iddoc']);?></span></td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td>&nbsp;</td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid; border-bottom-style: solid;">&nbsp;</td>
<td style="border-bottom-style: solid;">&nbsp;</td>
<td style="border-right-style: solid; border-bottom-style: solid;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="; width: 100%; font-family: Arial;" border="0" cellspacing="0">
<tbody>
<tr>
<td>&nbsp;</td>
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
<td><br /><?php mostrar_estado_proceso(1,$_REQUEST['iddoc']);?>&nbsp; <span style="width: 30%; text-align: right;">&nbsp;</span></td>
</tr>
<tr>
<td><br /><?php mostrar_anexos_externa(1,$_REQUEST['iddoc']);?><?php tamanio_texto_anexos_ext(1,$_REQUEST['iddoc']);?><?php mostrar_copias_comunicacion_ext(1,$_REQUEST['iddoc']);?>Transcriptor: <?php mostrar_valor_campo('iniciales',1,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>