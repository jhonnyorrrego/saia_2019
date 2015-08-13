<?php include_once("../memo/funciones.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0" width="100%">
<tbody>
<tr>
<td style="text-align: right;">
<p><?php formato_serie(76,$_REQUEST['iddoc']);?><br /><?php mostrar_valor_campo('consecutivo',76,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p><?php ciudad(76,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(76,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td><?php mostrar_destinos(76,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
<p>&nbsp;&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p>Asunto: <?php mostrar_valor_campo('asunto',76,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p>Cordial Saludo,</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p style="text-align: justify;">Comedidamente me permito anexar el reporte de datos de muestra tomada en <?php mostrar_valor_campo('lugar_muestra',76,$_REQUEST['iddoc']);?>, debido a queja presentada por calidad de agua, espec&iacute;ficamente&nbsp;<?php mostrar_valor_campo('queja',76,$_REQUEST['iddoc']);?> Seg&uacute;n los datos las muestras tomadas en <?php mostrar_valor_campo('lugar_muestra',76,$_REQUEST['iddoc']);?>, cumplen con las caracter&iacute;sticas de agua potable apta para consumo humano.<br /><br />Es responsabilidad de los usuarios mantener las condiciones sanitarias adecuadas en instalaciones y tanques de almacenamiento. Se recomienda lavar como m&iacute;nimo cada 6 meses el tanque de almacenamiento.<br /><br />La empresa sugiere un procedimiento para el lavado y desinfecci&oacute;n de los tanques de almacenamiento, al cual puede acceder a trav&eacute;s de nuestra p&aacute;gina web www.aguasyaguas.com.co, planes y programas, informe de calidad de agua.</p>
<p style="text-align: justify;">Cualquier inquietud con gusto le atenderemos.</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p>Cordialmente</p>
</td>
</tr>
<tr>
<td><?php mostrar_estado_proceso(76,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br />Prepar&oacute;: <?php mostrar_valor_campo('iniciales',76,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>