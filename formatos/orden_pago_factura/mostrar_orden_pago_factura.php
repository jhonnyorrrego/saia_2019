<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php cargar_datos(303,$_REQUEST['iddoc']);?></p>
<table style="width: 100%; font-size: 8pt; font-family: arial;" border="0">
<tbody>
<tr>
<td style="width: 20%;"><strong>Fecha Solicitud:</strong></td>
<td style="width: 30%;"><?php ver_fecha_solicitud(303,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;"><strong>Area Solicitante:</strong></td>
<td style="width: 30%;"><?php ver_dependencia_creador(303,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Detalle Factura:</strong></td>
<td colspan="3"><?php ver_papa_detalle_factura(303,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Proyecto y/o Programa:</strong></td>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4">
<table style="width: 100%; font-size: 8pt; font-family: arial;" border="0">
<tbody>
<tr>
<td style="width: 25%;"><strong>Fecha Factura</strong></td>
<td style="width: 75%;">&nbsp;<?php ver_papa_fecha_factura(303,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Nro Factura</strong></td>
<td>&nbsp;<?php ver_papa_nro_factura(303,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Valor Factura</strong></td>
<td>&nbsp;<?php ver_papa_valor_factura(303,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Nombre del Proveedor</strong>&nbsp;</td>
<td>&nbsp;<?php ver_papa_proveedor(303,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4"><span style="text-decoration: underline;">NOTA:</span><br />
<ul>
<li type="disc">Gesti&oacute;n administrativa al realizar la segunda revisi&oacute;n, deber&aacute; devolver al (a la ) supervisor(a) o solicitante los documentos que NO cumplan con el lleno de los requisitos establecidos.</li>
<li type="disc">&Uacute;nicamente se podr&iacute;a radicar en Gesti&oacute;n Financiera los documentos que contengan las dos firmas de revisi&oacute;n con el lleno de los requisitos, de lo contrario ser&aacute;n devueltos al (a la) supervisor(a) o solicitante.</li>
<li type="disc">Se except&uacute;an aquellos documentos autorizados por la tercera firma sin el lleno de los requisitos exigidos.</li>
</ul>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php mostrar_estado_proceso(303,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>