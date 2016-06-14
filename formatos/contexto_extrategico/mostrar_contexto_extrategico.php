<?php include_once("../carta/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; attr-margin-left: 20; attr-margin-top: 30; width: 80%;" border="1">
<tbody>
<tr>
<td colspan="2" valign="top" width="532">
<p align="center"><strong>CONTEXTO ESTRAT&Eacute;GICO</strong></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top" width="532">
<p>PROCESO:&nbsp;<?php mostrar_valor_campo('proceso',375,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top" width="532">
<p>OBJETIVO:&nbsp;<?php mostrar_valor_campo('objetivo',375,$_REQUEST['iddoc']);?></p>
</td>
</tr>
</tbody>
</table>
<p><?php adiconar_factores_contexto(375,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(375,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>