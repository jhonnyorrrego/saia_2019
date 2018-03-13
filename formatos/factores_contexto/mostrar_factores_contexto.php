<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td colspan="2" valign="top" width="532">
<p align="center"><strong>FACTOR</strong></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top" width="532">
<p>Tipo:&nbsp;<?php mostrar_valor_campo('factores_contexto',386,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top" width="532">
<p>Descripci&oacute;n:&nbsp;<?php mostrar_valor_campo('descripcion',386,$_REQUEST['iddoc']);?></p>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>