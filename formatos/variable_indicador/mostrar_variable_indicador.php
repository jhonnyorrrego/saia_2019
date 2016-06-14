<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado" valign="top">Nombre:</td>
<td><?php mostrar_valor_campo('nombre',382,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Descripci&oacute;n:</td>
<td><?php mostrar_valor_campo('descripcion',382,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>