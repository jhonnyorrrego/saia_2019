<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../carta/../carta/funciones.php"); ?><?php include_once("../carta_responde_pqr/funciones.php"); ?><?php include_once("../solicitud_soporte/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="font-family: arial; width: 100%;" border="0" cellspacing="0" align="center">
<tbody>
<tr>
<td style="text-align: left;" colspan="2"><?php ciudad(2,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(2,$_REQUEST['iddoc']);?></td>
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
<td style="text-align: left;" valign="top" width="80%"><?php lista_destinos(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td valign="top">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">DE:</td>
<td style="text-align: left;" valign="top" width="80%"><?php mostrar_origen(2,$_REQUEST['iddoc']);?></td>
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
<td style="text-align: left;" width="80%"><?php mostrar_valor_campo('asunto',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" valign="top" width="10%">&nbsp;</td>
<td width="80%">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">Cordial saludo:</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><?php mostrar_valor_campo('contenido',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">Atentamente,</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><?php mostrar_estado_proceso(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">
<p><?php mostrar_anexos(2,$_REQUEST['iddoc']);?><?php mostrar_copias_carta(2,$_REQUEST['iddoc']);?><?php mostrar_copia_interna(2,$_REQUEST['iddoc']);?>Transcriptor: <?php mostrar_iniciales(2,$_REQUEST['iddoc']);?></p>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>