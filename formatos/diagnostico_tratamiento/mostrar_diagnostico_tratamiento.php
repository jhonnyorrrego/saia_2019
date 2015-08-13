<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 3%;">&nbsp;</td>
<td style="width: 34%;">&nbsp;</td>
<td style="width: 3%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
</tr>
<tr>
<td colspan="5">FECHA:&nbsp;<?php mostrar_valor_campo('fecha_diagnostico',293,$_REQUEST['iddoc']);?><br /><hr />&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="5">NOMBRE DEL PACIENTE:&nbsp;<?php mostrar_valor_campo('nombre_diagnosticado',293,$_REQUEST['iddoc']);?><br /><hr />&nbsp;</td>
</tr>
<tr>
<td colspan="5">HALLAZGOS CEFALOMETRICOS&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 40%; text-align: center;">&nbsp;ESQUELETICO</td>
<td style="width: 30%; text-align: center;">&nbsp;1</td>
<td style="width: 30%; text-align: center;">&nbsp;2</td>
</tr>
<tr>
<td>&nbsp;SNA</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('sna',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;SNB</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('snb',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;ANB</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('anb',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;Mx-Md</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('mx_md',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;SnMd</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('snmd',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;WITS</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('wits',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</td>
<td>&nbsp;</td>
<td>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 40%; text-align: center;">&nbsp;DENTAL</td>
<td style="width: 30%; text-align: center;">&nbsp;1</td>
<td style="width: 30%; text-align: center;">&nbsp;2</td>
</tr>
<tr>
<td>INTERINCISIVO</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('interincisivo',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;1-Mx</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('uno_mx',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;1-Md</td>
<td style="text-align: center;"><?php mostrar_valor_campo('uno_md',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<br />
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: center;" colspan="4">&nbsp;M.E.A.W&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 25%;">ODI</td>
<td style="width: 25%;">&nbsp;74.5(5-6)</td>
<td style="width: 25%; text-align: center;">&nbsp;<?php mostrar_valor_campo('odi',293,$_REQUEST['iddoc']);?></td>
<td style="width: 25%;">&nbsp;</td>
</tr>
<tr>
<td>APDI</td>
<td>&nbsp;81.0(4-4)</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('apdi',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>CF</td>
<td>&nbsp;155&nbsp;</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('cf',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</td>
<td>&nbsp;</td>
<td>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 50%; text-align: center;" colspan="2">FACIAL&nbsp;</td>
<td style="width: 25%; text-align: center;">&nbsp;1</td>
<td style="width: 25%; text-align: center;">&nbsp;2</td>
</tr>
<tr>
<td style="width: 26%;">LINEA E</td>
<td style="width: 26%; text-align: center;">&nbsp;SUP</td>
<td style="width: 24%; text-align: center;">&nbsp;<?php mostrar_valor_campo('linea_e_superior',293,$_REQUEST['iddoc']);?></td>
<td style="width: 24%;">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="text-align: center;">&nbsp;INF</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('linea_e_inferior',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>FHI - LS</td>
<td>&nbsp;</td>
<td style="text-align: center;">&nbsp;<?php mostrar_valor_campo('fhi_ls',293,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="width: 25%;">< - NL</td>
<td style="width: 25%;">&nbsp;</td>
<td style="width: 25%; text-align: center;">&nbsp;<?php mostrar_valor_campo('menor_nl',293,$_REQUEST['iddoc']);?></td>
<td style="width: 25%;">&nbsp;</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5"><strong>ORTODONCISTA:</strong>&nbsp;<?php mostrar_valor_campo('ortodoncista',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="5"><strong>AUXILIAR:</strong>&nbsp;<?php mostrar_valor_campo('auxiliar',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>&nbsp;DIAGN&Oacute;STICO</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Esqueletico</strong>:<?php mostrar_valor_campo('esqueletico',293,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Oclusal</strong>:<?php mostrar_valor_campo('oclusal',293,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Dental</strong>:<?php mostrar_valor_campo('dental',293,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Tejidos Blandos</strong>:<?php mostrar_valor_campo('tejido_blando',293,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Funcional</strong>:<?php mostrar_valor_campo('funcional',293,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 50%;" colspan="2">&nbsp;<strong>PLAN DE TRATAMIENTO&nbsp;&nbsp;&nbsp;</strong></td>
<td style="width: 50%;" colspan="2">&nbsp;<strong>RE-EVALUACIONES&nbsp;&nbsp;</strong></td>
</tr>
<tr>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('plan_tratamiento',293,$_REQUEST['iddoc']);?>&nbsp;</td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('re_evaluaciones',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">
<p>&nbsp;RETENCI&Oacute;N:<?php mostrar_valor_campo('retencion',293,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2"><br />
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 50%;">PLAN &nbsp;PREVENTIVO</td>
<td style="width: 50%;">&nbsp;<?php mostrar_valor_campo('plan_preventivo',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>EXT. SERIADA</td>
<td>&nbsp;<?php mostrar_valor_campo('ext_seriada',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>ORTOPEDIA</td>
<td>&nbsp;<?php mostrar_valor_campo('ortopedia',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>ORTOPEDIA Y ORTODONCIA</td>
<td>&nbsp;<?php mostrar_valor_campo('ortopedia_ortodoncia',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>OTRO</td>
<td>&nbsp;<?php mostrar_valor_campo('otro_tratamiento',293,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
<td colspan="2"><br />
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 50%;">ORTODONCIA 1/2 CASO</td>
<td style="width: 50%;">&nbsp;<?php mostrar_valor_campo('ortodoncia_caso',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>ORTODONCIA NO COMPLICADA</td>
<td>&nbsp;<?php mostrar_valor_campo('ortodoncia_no_complicada',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>ORTODONCIA</td>
<td>&nbsp;<?php mostrar_valor_campo('ortodoncia',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>ORTODONCIA Y CIRUGIA</td>
<td>&nbsp;<?php mostrar_valor_campo('ortodoncia_cirugia',293,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>OTRO</td>
<td>&nbsp;<?php mostrar_valor_campo('otro_evaluaciones',293,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="4"><strong>REMISONES PARA PROCESOS ESPECIALIZADOS</strong></td>
</tr>
<tr>
<td colspan="4"><?php mostrar_valor_campo('remision_procedimiento',293,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(293,$_REQUEST['iddoc']);?></p>
<p>FIRMA DEL PACIENTE</p>
<p><?php cargar_item_evolucion(293,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>