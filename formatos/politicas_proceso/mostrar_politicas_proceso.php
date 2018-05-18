<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="width: 20%;" valign="top">Nombre:</td>
<td><?php mostrar_valor_campo('nombre',495,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Documento Soporte:</td>
<td><?php mostrar_anexos_memo(495,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Estado</td>
<td><?php mostrar_valor_campo('estado',495,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Origen Documento</td>
<td><?php mostrar_valor_campo('origen_documento',495,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			