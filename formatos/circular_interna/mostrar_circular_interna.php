<?php include_once("../memo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2"><?php ciudad(48,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(48,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td valign="top"><strong>PARA:</strong></td>
<td valign="top"><?php lista_destinos(48,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
<tr>
<td valign="top"><strong>DE:</strong></td>
<td valign="top"><?php mostrar_origen(48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top"><strong>ASUNTO:</strong></td>
<td valign="top"><?php mostrar_valor_campo('asunto',48,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2"><?php mostrar_valor_campo('contenido',48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('despedida',48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(48,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos_memo(48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_copias_memo(48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_preparo(48,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>