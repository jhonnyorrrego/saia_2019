<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" valign="top">Nombre:</td>
<td><?php mostrar_valor_campo('nombre',373,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Documento Soporte:</td>
<td><?php mostrar_valor_campo('soporte',373,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="windowtext 0.5pt solid; border: #000000 1px solid;">Secretarias Participantes:</td>
<td><?php mostrar_valor_campo('secretarias',373,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>