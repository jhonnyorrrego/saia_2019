<?php include_once("../memo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../carta/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<p>
<table border="0" width="100%">
<tbody>
<tr>
<td style="text-align: right;">
<p><?php formato_serie(75,$_REQUEST['iddoc']);?><br /><?php formato_numero(75,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p><?php ciudad(75,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(75,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td><?php mostrar_destinos(75,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
<p>&nbsp;&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p>Asunto: <?php mostrar_valor_campo('asunto',75,$_REQUEST['iddoc']);?> <?php mostrar_valor_campo('mes',75,$_REQUEST['iddoc']);?></p>
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
<p>Comedidamente me permito remitirle el informe de Calidad de agua de la Empresa de Acueducto y Alcantarillado de Pereira S.A E.S.P, correspondiente al mes de <?php mostrar_valor_campo('mes',75,$_REQUEST['iddoc']);?>.</p>
<p>Dando la siguiente calificaci&oacute;n del nivel de riesgo en salud:<br /><br />1. &Iacute;ndice de Riesgo por Calidad de agua IRCA: <?php mostrar_valor_campo('irca',75,$_REQUEST['iddoc']);?> % <br />2. Nivel de Riesgo: <?php mostrar_valor_campo('nivel_riesgo',75,$_REQUEST['iddoc']);?>.<br />3. Notificaci&oacute;n: <?php mostrar_valor_campo('notificacion',75,$_REQUEST['iddoc']);?><br />4. Reclamos por Calidad de Agua: <?php mostrar_valor_campo('reclamos_total',75,$_REQUEST['iddoc']);?><br />5. Reclamos Procedentes por Calidad de Agua: <?php mostrar_valor_campo('reclamos_procedentes',75,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>
<p>Cordialmente</p>
</td>
</tr>
<tr>
<td><?php mostrar_estado_proceso(75,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br />Prepar&oacute;: <?php mostrar_valor_campo('iniciales',75,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>