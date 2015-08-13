<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado">Funcionario ausente</td>
<td><?php mostrar_valor_campo('funcionario_ausente',310,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Ausencia justificada</td>
<td>&nbsp;<?php mostrar_valor_campo('justificada',310,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>