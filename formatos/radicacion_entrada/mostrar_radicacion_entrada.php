<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><p><?php llenar_datos_funcion(3,$_REQUEST['iddoc']);?></p>
<p style="text-align: center;"><strong>INFORMACI&Oacute;N GENERAL</strong></p>
<p style="text-align: center;"><?php mostrar_informacion_general_radicacion(3,$_REQUEST['iddoc']);?></p>
<p style="text-align: center;"><strong>INFORMACI&Oacute;N ORIGEN</strong></p>
<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%;"><strong>Tipo de Origen:</strong></td>
<td style="width: 75%;"><?php mostrar_valor_campo('tipo_origen',3,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Origen:</strong></td>
<td><?php obtener_informacion_proveedor(3,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p style="text-align: center;">&nbsp;</p>
<p><?php mostrar_item_destino_radicacion(3,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_copia_electronica(3,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(3,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			