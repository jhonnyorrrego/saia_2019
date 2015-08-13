<?php include_once("../informacion_dano/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center;" colspan="2"><strong>Descripci&oacute;n del problema</strong></td>
</tr>
<tr>
<td style="width: 30%;"><strong>Problema</strong></td>
<td><?php mostrar_valor_campo('problema',264,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>