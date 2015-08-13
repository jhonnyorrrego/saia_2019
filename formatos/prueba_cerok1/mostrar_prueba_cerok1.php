<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php cargar_imagen_fondo(214,$_REQUEST['iddoc']);?></p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center;">&nbsp;PRUEBA</td>
</tr>
<tr>
<td>&nbsp;<?php mostrar_valor_campo('contenido',214,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>