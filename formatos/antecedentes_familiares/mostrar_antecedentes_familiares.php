<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 20%;">Enfermedades cardiacas</td>
<td><?php mostrar_valor_campo('cardiaca_familia',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">&iquest;Qui&eacute;n?</td>
<td><?php mostrar_valor_campo('cardiaca_quien',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Hipertensi&oacute;n arterial</td>
<td><?php mostrar_valor_campo('hipertension_familia',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span>&iquest;Qui&eacute;n?</span></td>
<td><?php mostrar_valor_campo('hipertension_quien',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">cancer</td>
<td><?php mostrar_valor_campo('cancer_familia',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span>&iquest;Qui&eacute;n?</span></td>
<td><?php mostrar_valor_campo('cancer_quien',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Enfermedades respiratorias</td>
<td><?php mostrar_valor_campo('respiratoria_familia',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span>&iquest;Qui&eacute;n?</span></td>
<td><?php mostrar_valor_campo('respiratorio_quien',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Diabetes mellitus</td>
<td><?php mostrar_valor_campo('diabetes_mellitus',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span>&iquest;Qui&eacute;n?</span></td>
<td><?php mostrar_valor_campo('diabetes_quien',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Asma</td>
<td><?php mostrar_valor_campo('asma_familia',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span>&iquest;Qui&eacute;n?</span></td>
<td><?php mostrar_valor_campo('asma_quien',283,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td><?php mostrar_valor_campo('observacion_familia',283,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(283,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>