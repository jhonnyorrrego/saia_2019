<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" width="100%">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2">SOLICITUD DE ANULACI&Ograve;N</td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;">DOCUMENTO A ANULAR</td>
<td><?php enlace_padre(74,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">JUSTIFICACI&Ograve;N</td>
<td><?php mostrar_valor_campo('justificacion',74,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(74,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer.php"); ?>