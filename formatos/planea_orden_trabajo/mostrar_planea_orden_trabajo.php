<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 12pt; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 20%;">Concepto</td>
<td>&nbsp;<?php mostrar_valor_campo('concepto_trabajo',263,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 20%;">Descripci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion_orden',263,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Cantidad</td>
<td>&nbsp;<?php mostrar_valor_campo('cantidad_solicitada',263,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Costo</td>
<td>&nbsp;<?php mostrar_valor_campo('costo_trabajo',263,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>