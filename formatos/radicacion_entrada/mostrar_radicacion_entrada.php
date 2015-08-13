<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php llenar_datos_funcion(3,$_REQUEST['iddoc']);?></p>
<table style="width: 100%; border-collapse: collapse; font-size: 10pt;" border="1">
<tbody>
<tr>
<td style="width: 20%;"><strong>Fecha de radicaci&oacute;n:</strong></td>
<td><?php mostrar_fecha(3,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;"><strong>N&uacute;mero de radicado:</strong></td>
<td><?php formato_numero(3,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><strong>Tipo de documento:</strong></td>
<td><?php mostrar_valor_campo('serie_idserie',3,$_REQUEST['iddoc']);?></td>
<td><strong>Fecha de oficio entrante:</strong></td>
<td><?php mostrar_valor_campo('fecha_oficio_entrada',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>N&uacute;mero de documento:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('numero_oficio',3,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Persona natural o jur&iacute;dica:</strong></td>
<td colspan="3"><?php obtener_informacion_proveedor(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Descripci&oacute;n o asunto:</strong></td>
<td><?php mostrar_valor_campo('descripcion',3,$_REQUEST['iddoc']);?></td>
<td><strong>Fecha l&iacute;mite respuesta:</strong></td>
<td><?php mostrar_valor_campo('tiempo_respuesta',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Anexos f&iacute;sicos:</strong></td>
<td><?php mostrar_valor_campo('anexos_fisicos',3,$_REQUEST['iddoc']);?></td>
<td><strong>Descripci&oacute;n de anexos f&iacute;sicos:</strong></td>
<td><?php mostrar_valor_campo('descripcion_anexos',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Anexos digitales:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('anexos_digitales',3,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Destino:</strong></td>
<td><?php mostrar_valor_campo('destino',3,$_REQUEST['iddoc']);?></td>
<td><strong>Copia a:</strong></td>
<td><?php mostrar_valor_campo('copia_a',3,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php imagenes_digitalizadas_funcion(3,$_REQUEST['iddoc']);?>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>