<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../carta/../carta/funciones.php"); ?><?php include_once("../notificacion_interna/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 70%;">&nbsp;</td>
<td style="width: 20%; text-align: center;">&nbsp;</td>
<td style="text-align: left; width: 10%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 70%;"><?php ciudad(2,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(2,$_REQUEST['iddoc']);?></td>
<td style="width: 30%; text-align: center;" rowspan="3" colspan="2">
<table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 5%; border-left-style: solid; border-top-style: solid;">&nbsp;</td>
<td style="width: 42%; border-top-style: solid;">&nbsp;</td>
<td style="width: 50%; border-top-style: solid;">&nbsp;</td>
<td style="width: 3%; border-right-style: solid; border-top-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td rowspan="3"><?php mostrar_qr_interna(2,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td style="border-right-style: solid;">&nbsp;</td>
</tr>
<tr>
<td style="border-left-style: solid;">&nbsp;</td>
<td style="font-size: 8pt;">&nbsp;Radicaci&oacute;n No: <?php formato_numero(2,$_REQUEST['iddoc']);?>&nbsp;</td>
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
<td style="border-bottom-style: solid;">&nbsp;</td>
<td style="border-right-style: solid; border-bottom-style: solid;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td colspan="1">&nbsp;</td>
</tr>
<tr>
<td colspan="1">&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">PARA:</td>
<td colspan="2" valign="top" width="80%"><?php lista_destinos(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">DE:</td>
<td colspan="2" valign="top" width="90%"><?php mostrar_origen(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">ASUNTO:</td>
<td colspan="2" width="90%"><?php mostrar_valor_campo('asunto',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">&nbsp;</td>
<td colspan="2" width="90%">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="font-size: 18px; font-family: arial; width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td>Cordial saludo:</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('contenido',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Atentamente,</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<p><?php mostrar_estado_proceso(2,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_anexos(2,$_REQUEST['iddoc']);?><?php mostrar_copias_memo(2,$_REQUEST['iddoc']);?><span>Transcriptor: <?php mostrar_iniciales(2,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>