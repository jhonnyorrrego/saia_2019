<?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../carta_responde_pqr/funciones.php"); ?><?php include_once("../hoja_vida/funciones.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../novedades_servicio/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><tr><td><table style="width: 100%; font-family: Arial;" border="0">
<tbody>
<tr>
<td style="width: 70%;"><?php ciudad(1,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(1,$_REQUEST['iddoc']);?></td>
<td style="text-align: right; width: 30%;"><span><?php mostrar_datos_radicaion(1,$_REQUEST['iddoc']);?></span><br /><br /></td>
</tr>
</tbody>
</table>
<table style="width: 100%; font-family: Arial;" border="0">
<tbody>
<tr>
<td><?php mostrar_destinos(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Asunto: <?php mostrar_valor_campo('asunto',1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('contenido',1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><?php mostrar_valor_campo('despedida',1,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 70%;"><strong><?php mostrar_estado_proceso(1,$_REQUEST['iddoc']);?></strong></td>
<td style="width: 30%; text-align: right;">&nbsp;<?php mostrar_qr_carta(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos(1,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_copias_carta(1,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="2">Elaboro:&nbsp;<?php mostrar_iniciales(1,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>