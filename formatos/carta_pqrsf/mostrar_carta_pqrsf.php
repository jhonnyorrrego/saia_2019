<?php include_once("../carta/funciones.php"); ?><?php include_once("../carta_responde_pqr/funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../novedades_servicio/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td><?php ciudad(308,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(308,$_REQUEST['iddoc']);?><br /><br /><br /></td>
</tr>
<tr>
<td><?php mostrar_destinos(308,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
</tr>
<tr>
<td>Asunto: <?php mostrar_valor_campo('asunto',308,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
<tr>
<td><br /><?php mostrar_valor_campo('contenido',308,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
<tr>
<td><br /><?php mostrar_valor_campo('despedida',308,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_estado_proceso(308,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_anexos_memo(308,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_copias_carta(308,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><br /><?php mostrar_valor_campo('iniciales',308,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>