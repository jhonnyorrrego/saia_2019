<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 30%;"><strong>Tipo de entidad</strong></td>
<td style="width: 40%;"><?php mostrar_valor_campo('tipo_entidad',317,$_REQUEST['iddoc']);?></td>
<td style="text-align: center; width: 30%;" rowspan="4" colspan="2"><?php generar_codigo_qr_readh(317,$_REQUEST['iddoc']);?><br /><?php radicado_funcion(317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Enfoque diferencial</strong></td>
<td><?php mostrar_valor_campo('enfoque_diferencial',317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Ubicaci&oacute;n geogr&aacute;fica</strong></td>
<td><?php mostrar_valor_campo('ubicacion_geografica',317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Nombre de la entidad</strong></td>
<td><?php nombre_entidad_funcion(317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Nombre paralelo</strong></td>
<td colspan="3"><?php mostrar_valor_campo('nombre_paralelo',317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4"><strong>Descripci&oacute;n</strong></td>
</tr>
<tr>
<td colspan="4"><?php mostrar_valor_campo('descripcion_readh',317,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td colspan="4"><strong>Contexto geogr&aacute;fico y cultural</strong></td>
</tr>
<tr>
<td colspan="4"><?php mostrar_valor_campo('contexto_geografico',317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Registro de funciones</strong></td>
<td><?php mostrar_valor_campo('registro_funciones',317,$_REQUEST['iddoc']);?></td>
<td style="width: 15%;"><strong>Palabras clave</strong></td>
<td style="width: 15%;"><?php mostrar_valor_campo('palabras_clave',317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong></strong><strong>Anexos digitales</strong></td>
<td colspan="3"><?php mostrar_valor_campo('anexos_digitales',317,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td><?php volumen_documental_funcion(317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php contacto_adicional_funcion(317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php estado_registro_funcion(317,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php estado_documento_reserva(317,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>