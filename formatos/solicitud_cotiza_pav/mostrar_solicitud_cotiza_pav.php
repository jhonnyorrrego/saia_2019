<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center;" colspan="2"><span style="color: #ff0000;"><strong>Solicitud Cotizaci&oacute;n&nbsp;</strong></span></td>
</tr>
<tr>
<td>Fecha Inicio:</td>
<td><?php mostrar_valor_campo('fecha_inicio',330,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;Anexo:</td>
<td>&nbsp;<?php mostrar_valor_campo('anexo',330,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2">La presente solicitud tiene vigencia desde&nbsp;<span style="text-decoration: underline;"><em><strong><?php mostrar_valor_campo('fecha_inicio',330,$_REQUEST['iddoc']);?></strong></em></span> hasta&nbsp;</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>