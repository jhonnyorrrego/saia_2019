<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" valign="top">Nombre:</td>
<td><?php mostrar_valor_campo('nombre',371,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Estado:</td>
<td>&nbsp;<?php mostrar_valor_campo('estado',371,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Documento Soporte:</td>
<td>&nbsp;{*mostrar_anexos_memo*}</td>
</tr>
<tr>
<td class="encabezado" style="windowtext 0.5pt solid; border: #000000 1px solid;">Secretaria a la que Pertenece:</td>
<td class="celda_transparente" style="windowtext 0.5pt solid; border: #000000 1px solid;">
<p><?php mostrar_valor_campo('secretarias',371,$_REQUEST['iddoc']);?></p>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>