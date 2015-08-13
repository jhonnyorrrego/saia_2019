<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Motivo De Consulta</td>
<td style="width: 75%;"><?php mostrar_valor_campo('motivo_consulta',285,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Enfermedad actual</td>
<td><?php mostrar_valor_campo('enfermedad_actual',285,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Antecedentes m&eacute;dicos</td>
<td><?php mostrar_valor_campo('antecedentes_medicos',285,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Antecedentes Familiares</td>
<td><?php mostrar_valor_campo('antecedentes_familiares_a',285,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(285,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>