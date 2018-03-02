<?php include_once("../carta/funciones.php"); ?><?php include_once("../transferencia_doc/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php enlace_planes(489,$_REQUEST['iddoc']);?></p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado" style="width: 30%;">Fecha Seguimiento:</td>
<td><?php mostrar_valor_campo('fecha_seguimiento',489,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Datos de&nbsp;la Formula:</td>
<td>
<p><?php mostrar_variables(489,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado">Linea Base:</td>
<td><?php mostrar_valor_campo('linea_base',489,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Meta:</td>
<td><?php mostrar_valor_campo('meta_indicador_actual',489,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">An&aacute;lisis de datos:</td>
<td><?php mostrar_valor_campo('observaciones',489,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(489,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>