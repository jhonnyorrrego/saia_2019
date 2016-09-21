<?php include_once("../carta/funciones.php"); ?><?php include_once("../informe_recibo/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php  ver_papa1(238,$_REQUEST['iddoc']);?></p>
<table style="width: 100%; font-family: arial; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>&nbsp;Fecha de expedici&oacute;n</strong></span><br /><span style="font-size: small;"><strong>dd/mm/aaaa</strong></span></td>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>&nbsp;Fecha de vencimiento</strong></span><br /><span style="font-size: small;"><strong>dd/mm/aaaa</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2">&nbsp;</td>
<td style="text-align: center;" colspan="2">&nbsp;</td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Proveedor al que se le paga</strong></span></td>
<td><span style="font-size: small;"><?php proveedor(238,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;"><strong>Usuario de contabilidad</strong></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Usuario que autoriza firmar la orden</strong></span></td>
<td>&nbsp;</td>
<td><span style="font-size: small;"><strong>Centro de costo del documento</strong></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Descripcion del documento</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',238,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;"><strong>Observaciones del documento</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('observaciones',238,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>A&ntilde;o en que se contabiliza</strong></span></td>
<td>&nbsp;</td>
<td><span style="font-size: small;"><strong>Periodo en que se contabiliza</strong></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Valor rete IVA</strong></span></td>
<td>&nbsp;</td>
<td><span style="font-size: small;"><strong>Observaciones de rete IVA</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('observaciones_iva',238,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Valor IVA del documento</strong></span></td>
<td>&nbsp;</td>
<td><span style="font-size: small;"><strong>Urgencia de pago</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('urgencia_pago',238,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Requiere contabilizacion?</strong></span></td>
<td colspan="3">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 100%; font-family: arial; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td><span style="font-size: small;"><strong>Descripci&oacute;n</strong></span><br /><br /></td>
</tr>
</tbody>
</table>
<table style="width: 100%; font-family: arial; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td><span style="font-size: small;">Total bruto: <?php val_bruto(238,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;">&nbsp;<?php descripcion_papa(238,$_REQUEST['iddoc']);?></span></p>
<p><span style="font-size: small;"><?php mostrar_estado_proceso(238,$_REQUEST['iddoc']);?></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>