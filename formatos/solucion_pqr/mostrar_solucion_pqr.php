<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse; font-family: arial;" border="0">
<tbody>
<tr>
<td style="border-color: #000000; border-style: solid; border-width: 1px; text-align: left;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-family: arial,helvetica,sans-serif;"><?php tabla_avance(211,$_REQUEST['iddoc']);?></span></span></td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php mostrar_estado_proceso(211,$_REQUEST['iddoc']);?></p>
<table border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>