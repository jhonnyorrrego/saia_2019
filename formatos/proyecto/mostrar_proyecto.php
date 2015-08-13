<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="text-align: center; background-color: #57b0de;" colspan="2"><span style="color: #ffffff;"><strong>Proyecto</strong></span></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Nombre del proyecto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_proyecto',247,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Descripcion:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion',247,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Empresa asociada:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('empresa_asociada',247,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Propuesta aprobada:</strong></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Moneda del proyecto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('moneda',247,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Valor del proyecto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('valor',247,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Forma de pago:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('pago',247,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Tiempo de duracion:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('duracion',247,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><strong><?php mostrar_estado_proceso(247,$_REQUEST['iddoc']);?></strong></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>