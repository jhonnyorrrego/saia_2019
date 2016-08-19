<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php editar_riesgos_proceso(393,$_REQUEST['iddoc']);?></p>
<p><?php adicionar_control_riesgo(393,$_REQUEST['iddoc']);?></p>
<p><?php adicionar_acciones_riesgo(393,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" colspan="2">Evaluacion y Valoracion del Riesgo</td>
</tr>
<tr>
<td class="encabezado" valign="top">N&uacute;mero:</td>
<td><?php mostrar_valor_campo('consecutivo',393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Estado:</td>
<td><?php mostrar_valor_campo('estado',393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Actividad:</td>
<td><?php mostrar_nombre_parseo(393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Area Responsable:</td>
<td><?php mostrar_valor_campo('area_responsable',393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Riesgo:</td>
<td><?php mostrar_riesgo_parseo(393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Descripcion:</td>
<td><?php mostrar_descripcion_parseo(393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Tipo de Riesgo</td>
<td><?php mostrar_valor_campo('tipo_riesgo',393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Fuente/causa:</td>
<td><?php mostrar_fuente_causa_parseo(393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Consecuencia:</td>
<td><?php mostrar_consecuencia_parseo(393,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Probabilidad:</td>
<td><?php mostrar_valor_campo('probabilidad',393,$_REQUEST['iddoc']);?></td>
</tr>
<tr id="idfila_impacto">
<td class="encabezado">Impacto:</td>
<td><?php mostrar_valor_campo('impacto',393,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php matriz_riesgo(393,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>