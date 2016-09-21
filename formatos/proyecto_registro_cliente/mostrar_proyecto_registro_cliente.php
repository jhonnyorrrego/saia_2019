<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Nombre del proyecto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_proyecto',250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Descripci&oacute;n:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion',250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Empresa asociada:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('empresa_asociada',250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Propuesta aprobada:</strong></span></td>
<td>&nbsp;<?php ultima_propuesta(250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Moneda del proyecto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('moneda',250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Valor del proyecto:</strong></span></td>
<td>&nbsp;$<?php mostrar_valor_campo('valor',250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Forma de pago:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('forma_pago',250,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Tiempo de duraci&oacute;n:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('duracion',250,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><strong><?php mostrar_estado_proceso(250,$_REQUEST['iddoc']);?></strong></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>