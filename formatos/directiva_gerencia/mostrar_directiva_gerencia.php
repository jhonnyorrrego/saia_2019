<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../memo/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table class="tabla_no_borde" style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td>
<p style="text-align: center;"><strong>DIRECTIVA DE GERENCIA N&deg; <?php formato_numero(70,$_REQUEST['iddoc']);?><br /></strong>&nbsp;Del: <?php mostrar_fecha(70,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="text-align: justify;">
<p>La&nbsp; Gerente de la EMPRESA DE ACUEDUCTO Y ALCANTARILLADO DE PEREIRA S.A. ESP, en uso de sus atribuciones legales y estatutarias y considerando.<br /><br /><?php mostrar_valor_campo('contenido',70,$_REQUEST['iddoc']);?>&nbsp;<br /><br />CUMPLASE</p>
</td>
</tr>
<tr>
<td><?php mostrar_estado_proceso(70,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><span style="font-size: x-small;"><br />Proyect&oacute;: <?php mostrar_valor_campo('iniciales',70,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><?php mostrar_anexos_memo(70,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>