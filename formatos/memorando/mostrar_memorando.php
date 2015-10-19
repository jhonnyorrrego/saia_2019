<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../carta/../carta/funciones.php"); ?><?php include_once("../notificacion_interna/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="font-size: 18px; font-family: arial; width: 100%;" border="0" cellspacing="0" align="center">
<tbody>
<tr>
<td colspan="2"><?php ciudad(2,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">PARA:</td>
<td valign="top" width="80%"><?php lista_destinos(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">DE:</td>
<td valign="top" width="80%"><?php mostrar_origen(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">ASUNTO:</td>
<td width="80%"><?php mostrar_valor_campo('asunto',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">&nbsp;</td>
<td width="80%">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="font-size: 18px; font-family: arial; width: 100%;" border="0" cellspacing="0" align="center">
<tbody>
<tr>
<td>Cordial saludo:</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('contenido',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Atentamente,</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_estado_proceso(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_anexos(2,$_REQUEST['iddoc']);?><?php mostrar_copias_memo(2,$_REQUEST['iddoc']);?><span>Transcriptor: <?php mostrar_iniciales(2,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>