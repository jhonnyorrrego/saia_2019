<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 30%;"><strong>Tipo de acopio</strong></td>
<td style="width: 70%;"><?php tipo_acopio_funcion(322,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Estado de acopio</strong></td>
<td><?php mostrar_valor_campo('estado_acopio',322,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;<?php soporte_documental_funcion(322,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(322,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>