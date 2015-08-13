<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 100%; border-bottom: 1px solid black;" colspan="3"><strong>DIAGN&Oacute;STICO:</strong> <?php mostrar_valor_campo('plan_diagnostico',295,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td style="width: 100%; border-bottom: 1px solid black;" colspan="3">VALOR DEL TRATAMIENTO:&nbsp;<?php mostrar_valor_plan_tratamiento(295,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td style="width: 59%;">&nbsp;</td>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 39%;">&nbsp;</td>
</tr>
<tr>
<td style="border-bottom: 1px solid black;">
<p>PACIENTE O ACUDIENTE:&nbsp;<?php mostrar_valor_campo('paciente_tratamiento',295,$_REQUEST['iddoc']);?></p>
</td>
<td>&nbsp;</td>
<td style="border-bottom: 1px solid black;">&nbsp;FIRMA</td>
</tr>
<tr>
<td style="border-bottom: 1px solid black;">DOCUMENTO DE IDENTIDAD:&nbsp;<?php mostrar_valor_campo('documento_paciente',295,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="border-bottom: 1px solid black;">
<p>ODONTOLOGO:&nbsp;<?php mostrar_valor_campo('odontologo_tratamiento',295,$_REQUEST['iddoc']);?></p>
</td>
<td>&nbsp;</td>
<td style="border-bottom: 1px solid black;">FIRMA</td>
</tr>
<tr>
<td style="border-bottom: 1px solid black;">REGISTRO No:&nbsp;<?php mostrar_valor_campo('registro_tratamiento',295,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>