<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><p><?php transferir_responsa(313,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left;"><strong>&nbsp;Analisis de Causas</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('analisis_causas',313,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_item(313,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(313,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>