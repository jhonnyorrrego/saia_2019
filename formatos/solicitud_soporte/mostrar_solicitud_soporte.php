<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="0" align="center">
<tbody>
<tr>
<td><span style="font-size: small;"><strong>Fecha</strong></span><strong></strong>:<?php mostrar_valor_campo('fecha_soporte',218,$_REQUEST['iddoc']);?></td>
<td><span style="font-size: small;"><strong>Hora</strong>:</span><?php mostrar_valor_campo('hora_solicitud',218,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><span style="font-size: small;">Categoria</span></strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp; <span style="font-size: small;"><?php mostrar_categoria(218,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><strong><span style="font-size: small;">Prioridad:</span></strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_prioridad(218,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><strong><span style="font-size: small;">Descripcion:</span></strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong><?php mostrar_valor_campo('descripcion',218,$_REQUEST['iddoc']);?></strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><strong><?php hijo_soporte(218,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><strong><?php mostrar_estado_proceso(218,$_REQUEST['iddoc']);?></strong></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>