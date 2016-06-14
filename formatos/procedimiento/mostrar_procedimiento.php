<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../proceso/funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" valign="top">Objetivo:</td>
<td class="phpmaker" valign="top"><?php mostrar_valor_campo('objetivo',364,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Alcances:</td>
<td class="phpmaker"><?php mostrar_valor_campo('alcance',364,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Definiciones:</td>
<td class="phpmaker"><?php mostrar_valor_campo('definicion',364,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="windowtext 0.5pt solid; text-align: center;" colspan="2"><?php listar_pasos_procedimiento(364,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td colspan="2">DISPOSICIONES GENERALES:<br /><?php mostrar_valor_campo('dispocisiones_generales',364,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos_memo(364,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">Aprob&oacute;:<br /><?php aprobacion(364,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>