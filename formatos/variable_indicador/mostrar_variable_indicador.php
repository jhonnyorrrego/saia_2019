<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado" valign="top">Nombre:</td>
<td><?php mostrar_valor_campo('nombre',490,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Descripci&oacute;n:</td>
<td><?php mostrar_valor_campo('descripcion',490,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>