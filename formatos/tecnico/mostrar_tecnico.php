<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td><strong>Aspectos t&eacute;cnicos</strong></td>
<td><?php mostrar_valor_campo('aspectos_tecnicos',84,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Conclusi&oacute;n t&eacute;cnica</strong></td>
<td><?php mostrar_valor_campo('conclusion_tecnica',84,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php validar_llenar_tecnico(84,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>