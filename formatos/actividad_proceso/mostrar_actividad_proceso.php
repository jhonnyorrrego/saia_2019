<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado">Actividad/subproceso</td>
<td><?php mostrar_valor_campo('nombre',368,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Proveedor</td>
<td><?php mostrar_valor_campo('proveedor',368,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Entrada</td>
<td><?php mostrar_valor_campo('entrada',368,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Punto de control</td>
<td><?php mostrar_valor_campo('punto_control',368,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Salida</td>
<td><?php mostrar_valor_campo('salida',368,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Cliente</td>
<td><?php mostrar_valor_campo('cliente',368,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>