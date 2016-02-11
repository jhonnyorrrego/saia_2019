<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado">Fecha</td>
<td>&nbsp;<?php fecha_aprobacion(342,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Calificaci&oacute;n</td>
<td><?php mostrar_valor_campo('calificacion_pqrsf',342,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Descripci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion',342,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>