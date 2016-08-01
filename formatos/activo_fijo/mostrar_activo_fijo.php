<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table style="; width: 100%; border-collapse: collapse;" border="1" align="center">
<tbody>
<tr>
<td style="text-align: center;" rowspan="6"><span><?php mostrar_foto(231,$_REQUEST['iddoc']);?></span></td>
<td class="encabezado_list" style="text-align: left; width: 25%;"><span style="font-size: small;">Activo</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('nombre_activo',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">C&oacute;digo</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('codigo',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Fecha de inicio</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('fecha',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Estado</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('estado',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Consideraciones especiales</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('consideraciones',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;"><span style="font-size: small;">Ubicaci&oacute;n</span></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('ubicacion',231,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<table style="; width: 100%;" border="0" align="center">
<tbody>
<tr>
<td class="encabezado_list" colspan="3"><span style="font-size: small;">Compra</span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Proveedor</strong>:<?php mostrar_valor_campo('proveedor',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;"><strong>Valor:</strong><?php mostrar_valor_campo('valor_compra',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;"><strong>Fecha</strong>:<?php mostrar_valor_campo('fecha_compra',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="3"><span style="font-size: small;">Seguro</span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Propietario:</strong><?php mostrar_valor_campo('propietario',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;"><strong>Valor Seguro:</strong><?php mostrar_valor_campo('valor_seguro',231,$_REQUEST['iddoc']);?></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Seguro 1</strong>:<?php mostrar_valor_campo('Seguro1',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;"><strong>Seguro&nbsp; 2:</strong><?php mostrar_valor_campo('seguro2',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;">&nbsp;<strong>Seguro 3:</strong><?php mostrar_valor_campo('seguro3',231,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" colspan="3"><span style="font-size: small;">Venta</span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>&nbsp;Comprador</strong>:<?php mostrar_valor_campo('comprador',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;">&nbsp;<strong>Valor:</strong><?php mostrar_valor_campo('valor_venta',231,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;">&nbsp;<strong>Fecha:</strong><?php mostrar_valor_campo('fecha_venta',231,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;"><?php mostrar_soporte(231,$_REQUEST['iddoc']);?></span></p>
<p><span style="font-size: small;"><?php mostrar_estado_proceso(231,$_REQUEST['iddoc']);?></span></p>
<p><span style="font-size: small;">Responsable<?php mostrar_valor_campo('nombre',231,$_REQUEST['iddoc']);?><br /></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>