<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; font-size: 11pt;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2"><?php ciudad(3,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(3,$_REQUEST['iddoc']);?><br /><br /><br /></td>
</tr>
</tbody>
</table>
<table style="width: 100%; font-size: 11pt;" border="0" cellspacing="0">
<tbody>
<tr>
<td style="width: 15%;" valign="top"><strong><span style="font-size: x-small;">PARA:</span></strong></td>
<td style="width: 85%;" valign="top"><span style="font-size: x-small;"><?php lista_destinos(3,$_REQUEST['iddoc']);?><br /></span></td>
</tr>
<tr>
<td style="width: 15%;" valign="top">&nbsp;</td>
<td style="width: 85%;" valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top"><strong><span style="font-size: x-small;">DE:</span></strong></td>
<td valign="top"><span style="font-size: x-small;"><?php mostrar_origen(3,$_REQUEST['iddoc']);?><br /></span></td>
</tr>
<tr>
<td valign="top"><strong><span style="font-size: x-small;">ASUNTO:</span></strong></td>
<td valign="top"><span style="font-size: x-small;"><?php mostrar_valor_campo('asunto',3,$_REQUEST['iddoc']);?></span><br /><br /></td>
</tr>
<tr>
<td style="width: 100%;" colspan="2"><?php mostrar_valor_campo('contenido',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('despedida',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(3,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2" width="100%"><?php mostrar_anexos_memo(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_copias_memo(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_preparo(3,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>