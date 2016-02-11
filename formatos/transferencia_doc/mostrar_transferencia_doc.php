<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 30%;"><strong>UNIDAD ADMINISTRATIVA</strong></td>
<td style="width: 70%;"><?php mostrar_valor_campo('unidad_admin',343,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>OFICINA PRODUCTORA</strong></td>
<td><?php mostrar_valor_campo('oficina_productora',343,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>OBSERVACIONES</strong></td>
<td><?php mostrar_valor_campo('observaciones',343,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>ANEXOS</strong></td>
<td><?php mostrar_valor_campo('anexos',343,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php expedientes_vinculados_funcion(343,$_REQUEST['iddoc']);?>&nbsp;</p>
<p><?php mostrar_estado_proceso(343,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>