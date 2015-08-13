<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; ; width: 100%;" border="1">
<tbody>
<tr>
<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
<td><strong><strong>Fecha de elaboraci&oacute;n&nbsp;</strong></strong>&nbsp;<?php mostrar_valor_campo('fecha_elaboracion',287,$_REQUEST['iddoc']);?>&nbsp;<strong></strong></td>
<td><strong>No solicitud</strong></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 10pt; ; width: 100%;" border="1">
<tbody>
<tr align="center">
<td style="text-align: justify; width: 50%;"><strong>Usuario que solicita:&nbsp;</strong><?php mostrar_valor_campo('usuario_que_solita',287,$_REQUEST['iddoc']);?></td>
<td style="text-align: justify; width: 50%;"><strong>Area:&nbsp;</strong><?php mostrar_valor_campo('area',287,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 10pt; ; width: 100%;" border="1">
<tbody>
<tr>
<td colspan="3"><strong>Descripci&oacute;n detallada del requerimiento</strong></td>
</tr>
<tr>
<td colspan="3">
<p><?php mostrar_valor_campo('describe_requerimiento',287,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td style="text-align: justify;" colspan="3"><span style="font-size: xx-small;">Describa claramente el inconveniente presentado y el resultado esperado. si requiere espacio adicional anexe documento soporte (plana,fotografia,dibujo). especifique fecha esperada de solucion y prioridad dentro de la lista de solicitudes que ha presentado su area y estan en cola de trabajo.&nbsp;</span></td>
</tr>
<tr>
<td style="text-align: left;"><strong>Fecha esperada de soluci&oacute;n &nbsp;</strong><?php mostrar_valor_campo('fecha_solucion',287,$_REQUEST['iddoc']);?></td>
<td><strong>Prioridad &nbsp;</strong><?php mostrar_valor_campo('prioridad',287,$_REQUEST['iddoc']);?></td>
<td><strong>Soportes anexos </strong>&nbsp;<?php mostrar_valor_campo('soportes_anexos',287,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 10pt; ; width: 100%;" border="1">
<tbody>
<tr align="center">
<td style="text-align: justify; width: 50%;"><strong>Firma y Fecha&nbsp;</strong>&nbsp;&nbsp;<?php fecha_primera_firma(287,$_REQUEST['iddoc']);?></td>
<td style="text-align: justify; width: 50%;"><strong>Firma y Fecha&nbsp;</strong>&nbsp;&nbsp;<?php fecha_segunda_firma(287,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp; &nbsp; &nbsp; &nbsp;<?php mostrar_estado_proceso(287,$_REQUEST['iddoc']);?>&nbsp;</p>
<p><?php cargar_hijo_solucion(287,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>