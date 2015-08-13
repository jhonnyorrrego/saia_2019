<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">
<p class="western" lang="es-ES" align="JUSTIFY"><span style="font-family: Arial, sans-serif;"><span>&iquest;Le han realizado alg&uacute;n procedimiento odontol&oacute;gico anteriormente?</span></span></p>
</td>
<td>&nbsp;<?php mostrar_valor_campo('proceso_odontologico',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 15%;">&iquest;Cu&aacute;l?</td>
<td>&nbsp;<?php mostrar_valor_campo('cual_procedimiento',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 15%;">Ultimna visita al odont&oacute;logo</td>
<td>&nbsp;<?php mostrar_valor_campo('ultima_visita',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 15%;">Cuidado dental</td>
<td>&nbsp;<?php mostrar_valor_campo('tipos_de_limpieza',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 15%;">Labios</td>
<td>&nbsp;<?php mostrar_valor_campo('labios',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Lengua</td>
<td>&nbsp;<?php mostrar_valor_campo('lengua',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Paladar</td>
<td>&nbsp;<?php mostrar_valor_campo('paladar',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Carrillos</td>
<td>&nbsp;<?php mostrar_valor_campo('carrillos',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Piso de boca</td>
<td>&nbsp;<?php mostrar_valor_campo('piso_de_boca',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Frenillos</td>
<td>&nbsp;<?php mostrar_valor_campo('frenillos',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Maxilares</td>
<td>&nbsp;<?php mostrar_valor_campo('maxilares',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Funci&oacute;n de oclusi&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('funcion_oclusion',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">ATM</td>
<td>&nbsp;<?php mostrar_valor_campo('atm',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Apertura maxima</td>
<td>&nbsp;<?php mostrar_valor_campo('apertura_maxima',284,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td>&nbsp;<?php mostrar_valor_campo('observaciones_tejidob',284,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(284,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>