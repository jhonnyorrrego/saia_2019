<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("recibe_factura"); ?><?php include_once("Nit_funcionario"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php ver_factura(237,$_REQUEST['iddoc']);?></p>
<table style="width: 100%; border-collapse: collapse; font-family: arial;" border="1">
<tbody>
<tr>
<td>
<table style="width: 100%;">
<tbody>
<tr>
<td>
<p><span style="font-size: small;">AREA QUE RECIBE:<strong><br /></strong></span></p>
</td>
<td>
<p><span style="font-size: small;">No EXTENSI&Oacute;N</span></p>
</td>
</tr>
<tr>
<td>
<p><span style="font-size: small;"><strong><strong><?php recibo_caja(237,$_REQUEST['iddoc']);?></strong><br /></strong></span></p>
</td>
<td><span style="font-size: small;">&nbsp;<strong>&nbsp;<?php mostrar_valor_campo('numer_ext',237,$_REQUEST['iddoc']);?></strong></span></td>
</tr>
<tr>
<td><span style="font-size: small;">NOMBRE DE QUIEN RECIBE</span><br /><span style="font-size: small;"><?php quien_recibe(237,$_REQUEST['iddoc']);?></span></td>
<td><span style="font-size: small;">C&Eacute;DULA</span><br /><span style="font-size: small;"><?php recibe_nit(237,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;">NOMBRE DEL PROVEEDOR</span><br /><?php fun_proveedor(237,$_REQUEST['iddoc']);?></td>
<td><span style="font-size: small;">NIT</span><br /><span style="font-size: small;"><?php proveedor_nit(237,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;">Requiere OP?</span><br /><span style="font-size: small;"><?php mostrar_valor_campo('requiere_op',237,$_REQUEST['iddoc']);?></span></td>
<td>
<p><span style="font-size: small;">Es un bien o servicio:</span><br /><span style="font-size: small;"><strong><?php mostrar_valor_campo('bien_servicio',237,$_REQUEST['iddoc']);?>&nbsp;</strong></span></p>
</td>
</tr>
<tr>
<td><span style="font-size: small;">Calificaci&oacute;n del servicio</span><br /><span style="font-size: small;"><strong><span style="text-decoration: underline;"><?php mostrar_valor_campo('califica_servicio',237,$_REQUEST['iddoc']);?></span></strong></span></td>
<td><span style="font-size: small;">Responsable de la OP</span><br /><span style="font-size: small;"><strong><?php mostrar_valor_campo('responsable_op',237,$_REQUEST['iddoc']);?></strong></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',237,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;">OBSERVACIONES: <?php mostrar_valor_campo('observaciones',237,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;"><?php datos_factura(237,$_REQUEST['iddoc']);?></span></p>
<p><span><span style="font-size: small;"><?php mostrar_estado_proceso(237,$_REQUEST['iddoc']);?></span><br /></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>