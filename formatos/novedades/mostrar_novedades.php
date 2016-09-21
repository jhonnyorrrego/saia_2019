<?php include_once("../carta/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 30%;"><strong>Fecha de novedad</strong></td>
<td style="width: 70%;"><?php mostrar_valor_campo('fecha_novedad',320,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><strong>Novedad</strong></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('novedad',320,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(320,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>