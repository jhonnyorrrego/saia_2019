<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php enlace_planes(383,$_REQUEST['iddoc']);?></p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado">Fecha Seguimiento:</td>
<td><?php mostrar_valor_campo('fecha_seguimiento',383,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Datos de&nbsp;la Formula:</td>
<td>
<p><?php mostrar_variables(383,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado">Linea Base:</td>
<td><?php mostrar_valor_campo('linea_base',383,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Meta:</td>
<td><?php mostrar_valor_campo('meta_indicador_actual',383,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">An&aacute;lisis de datos:</td>
<td><?php mostrar_valor_campo('observaciones',383,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>