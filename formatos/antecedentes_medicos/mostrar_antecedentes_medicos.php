<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Padece de alguna enfermedad actualmente?</td>
<td>&nbsp;<?php mostrar_valor_campo('padece_enfermedad',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">
<p>cual?</p>
</td>
<td>&nbsp;<?php mostrar_valor_campo('cual_enfermedad',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Recibe algun medicamento?</td>
<td>&nbsp;<?php mostrar_valor_campo('recibe_medicamento',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">cual?</td>
<td>&nbsp;<?php mostrar_valor_campo('cual_medicamento',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Emfermedades cardiacas&nbsp;</td>
<td>&nbsp;<?php mostrar_valor_campo('enfermedades_cardiacas',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Hipertensi&oacute;n arterial</td>
<td>&nbsp;<?php mostrar_valor_campo('hipertension_arterial',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Enfermedades respiratorias</td>
<td>&nbsp;<?php mostrar_valor_campo('enfer_respiratoria',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Emfermedades renales</td>
<td>&nbsp;<?php mostrar_valor_campo('enfermedad_renal',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Hepatitis</td>
<td>&nbsp;<?php mostrar_valor_campo('hepatitis',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Diabetes</td>
<td>&nbsp;<?php mostrar_valor_campo('diabetes',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Trastornos sanguineos</td>
<td><?php mostrar_valor_campo('trastorno_sanguineo',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fiebre reum&aacute;tica</td>
<td><?php mostrar_valor_campo('fiebre_reumatica',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Alergias</td>
<td><?php mostrar_valor_campo('alergias',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Obstrucci&oacute;n nasal</td>
<td><?php mostrar_valor_campo('obstruccion_nasal',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Cirug&iacute;as</td>
<td><?php mostrar_valor_campo('cirujias',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Adenoides</td>
<td><?php mostrar_valor_campo('adenoides',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Am&iacute;gdalas</td>
<td><?php mostrar_valor_campo('amigdalas',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">otra Cual?</td>
<td><?php mostrar_valor_campo('otro_antecedente',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Edad de la primera menstruaci&oacute;n</td>
<td><?php mostrar_valor_campo('edad_menstruacion',281,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td><?php mostrar_valor_campo('observacion_ante',281,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(281,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>