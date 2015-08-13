<?php include_once("../carta/funciones.php"); ?><?php include_once("../carta/../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Proveedor:</td>
<td><?php proveedor_funcion(299,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Precio de las Cotizaciones:</td>
<td><?php mostrar_valor_campo('precio_cotizaciones',299,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Matriculado en C&aacute;mara:</td>
<td><?php mostrar_valor_campo('matriculado_camara',299,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">La atenci&oacute;n a la solicitud fue:</td>
<td><?php mostrar_valor_campo('atencion',299,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Cumplimiento con las Especificaciones del producto requerido:</td>
<td><?php mostrar_valor_campo('cumplimiento',299,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><br /><?php puntaje_funcion(299,$_REQUEST['iddoc']);?><br /><?php mostrar_estado_proceso(299,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>