<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table style="width: 100%; border-collapse: collapse; font-family: arial;" border="0">
<tbody>
<tr>
<td style="text-align: center; border-color: #000000; border-style: solid; border-width: 1px;"><span style="font-family: arial,helvetica,sans-serif;"><strong>INFORMACION GENERAL</strong></span></td>
</tr>
<tr>
<td style="border-color: #000000; border-style: solid; border-width: 1px; text-align: left;"><span style="font-family: arial,helvetica,sans-serif;"><?php mostrar_formato_funcion(210,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(210,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>