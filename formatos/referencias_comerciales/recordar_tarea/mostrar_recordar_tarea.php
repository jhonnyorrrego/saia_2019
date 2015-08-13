<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><span style="font-size: small;"><?php aeditar_registro_tare(239,$_REQUEST['iddoc']);?> <?php eliminar_registro_tarea(239,$_REQUEST['iddoc']);?></span></p>
<table style="width: 100%; border-collapse: collapse; font-family: arial;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;"><span style="font-size: small;">Fecha</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('fecha_formato',239,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Responsable</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('responsable',239,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Vinculados</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('vinculados',239,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Tareas asignadas</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('tarea_asiganda',239,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Prioridad</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('prioridad',239,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Descripci&oacute;n&nbsp;</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',239,$_REQUEST['iddoc']);?><br /></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Fecha</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('fecha_entraga',239,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Tipo</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('tipo',239,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Recordar</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('dias_recordar',239,$_REQUEST['iddoc']);?><?php mostrar_valor_campo('horas_recordar',239,$_REQUEST['iddoc']);?><?php mostrar_valor_campo('semanas_recordar',239,$_REQUEST['iddoc']);?><?php mostrar_valor_campo('mes_recordar',239,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">&nbsp;Periodicidad</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('periodicidad',239,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">&nbsp;Anexos</span></td>
<td><span style="font-size: small;"><?php mostrar_anexos_tarea(239,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p style="text-align: center;">&nbsp;<span style="font-size: small;"><strong>AVANCES</strong></span></p>
<p style="text-align: center;"><span style="font-size: small;"><?php mostrar_avances(239,$_REQUEST['iddoc']);?></span></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><span style="font-size: small;"><strong>CALIFICACI&Oacute;N </strong></span></p>
<p style="text-align: center;"><span style="font-size: small;"><?php mostrar_calificacion(239,$_REQUEST['iddoc']);?></span></p>
<p style="text-align: left;"><span style="font-size: small;"><?php mostrar_estado_proceso(239,$_REQUEST['iddoc']);?>&nbsp;</span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>