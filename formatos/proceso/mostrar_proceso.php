<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">
<p>Responsable</p>
</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('responsable',194,$_REQUEST['iddoc']);?> <?php icono_detalles(194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">L&iacute;der</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('lider_proceso',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">Objetivo</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('objetivo',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">Alcance</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('alcance',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt; border: #000000 1px solid;">Dependencias participantes:</td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('dependencias_partici',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; text-align: center;" colspan="3"><?php actividades_proceso(194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center; border: font-size:10pt;" colspan="6"><strong>CONTROLES DEL PROCESO</strong></td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; text-align: center;" colspan="3"><?php listar_control_proceso(194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="font-size: 10pt;" colspan="3"><?php link_cuadro_mando(194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center; font-size: 10pt;">Soporte legal (normatividad&nbsp; y documentos de consulta)</td>
<td class="encabezado" style="text-align: center; font-size: 10pt;">Riesgos del Proceso</td>
<td class="encabezado" style="text-align: center; font-size: 10pt;">Listados Maestros</td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" rowspan="2">&nbsp;<?php enlace_normograma(194,$_REQUEST['iddoc']);?></td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" rowspan="2">&nbsp;<?php enlace_riesgos(194,$_REQUEST['iddoc']);?></td>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;"><?php mostrar_valor_campo('listado_maestro_documentos',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_valor_campo('listado_maestro_registros',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" colspan="3" valign="top">Politicas de Operacion de Proceso</td>
</tr>
<tr>
<td style="font-size: 10pt; text-align: center;" colspan="3"><?php listar_politicas_proceso(194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="3">Anexos: <br /><?php mostrar_valor_campo('anexos',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="celda_transparente" style="font-size: 10pt; border: #000000 1px solid;" colspan="3"><?php aprobacion(194,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>