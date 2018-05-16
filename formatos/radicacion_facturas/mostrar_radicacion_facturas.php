<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center; background-color: #319ecd;" colspan="2"><span style="color: #ffffff;"><strong>INFORMACI&Oacute;N GENERAL</strong></span></td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><?php mostrar_informacion_general_factura(473,$_REQUEST['iddoc']);?></p>
<p style="text-align: center;">&nbsp;</p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center; background-color: #319ecd;" colspan="2"><span style="color: #ffffff;"><strong>INFORMACI&Oacute;N ORIGEN</strong></span></td>
</tr>
<tr>
<td style="width: 25%;"><strong>Persona natural/juridica</strong></td>
<td style="width: 75%;">&nbsp;<?php mostrar_valor_campo('natural_juridica',473,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="width: 25%;"><strong>Fecha de emision de la factura:</strong></td>
<td style="width: 75%;">&nbsp;<?php mostrar_valor_campo('fecha_emision',473,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Numero de factura:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('num_factura',473,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Descripcion servicio o producto</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion',473,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Numero de folios</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('num_folios',473,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Copia electronica a</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('copia_electronica',473,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Estado</strong></td>
<td>&nbsp;<?php estado_facturas(473,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php item_factura(473,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(473,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			