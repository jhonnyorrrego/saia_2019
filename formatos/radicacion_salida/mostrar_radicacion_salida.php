<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php llenar_datos_funcion_salida(207,$_REQUEST['iddoc']);?></p>
<table style="width: 100%; border-collapse: collapse; font-size: 10pt;" border="1">
<tbody>
<tr>
<td style="width: 20%;"><strong>Fecha de radicaci&oacute;n:</strong></td>
<td><?php mostrar_fecha(207,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;"><strong>N&uacute;mero de radicado:</strong></td>
<td><?php formato_numero(207,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><strong>Tipo de documento:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('serie_idserie',207,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td><strong>Persona natural o jur&iacute;dica:</strong></td>
<td colspan="3"><?php obtener_informacion_proveedor_salida(207,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Descripci&oacute;n o asunto:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('descripcion_salida',207,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td><strong>Anexos f&iacute;sicos:</strong></td>
<td><?php mostrar_valor_campo('anexos_fisicos',207,$_REQUEST['iddoc']);?></td>
<td><strong>Descripci&oacute;n de anexos f&iacute;sicos:</strong></td>
<td><?php mostrar_valor_campo('descripcion_anexos',207,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>No. Folios:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('num_folios',207,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Funcionario responsable:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('area_responsable',207,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>