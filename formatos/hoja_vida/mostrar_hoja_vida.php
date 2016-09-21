<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>DATOS PERSONALES</strong></span></td>
<td style="text-align: center; border: 1px solid #000000;" rowspan="8" align="center" valign="middle"><span style="font-size: small;"><?php foto_pagina(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td align="Center-aligns content"><span style="font-size: small;"><strong>Nombres y Apellidos:</strong> <?php mostrar_valor_campo('nombre',219,$_REQUEST['iddoc']);?>&nbsp;<?php mostrar_valor_campo('apellidos',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td>
<p><span style="font-size: small;"><strong><strong>No Documento de identidad:</strong>&nbsp;</strong><?php mostrar_valor_campo('documento_identidad',219,$_REQUEST['iddoc']);?> </span></p>
</td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>De:</strong>&nbsp;<?php mostrar_valor_campo('lugar_documento',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Direcci&oacute;n:</strong><?php mostrar_valor_campo('direccion',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Tel&eacute;fonos:</strong><?php mostrar_valor_campo('telefonos',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>E-mail:</strong><?php mostrar_valor_campo('email',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Lugar y Fecha de Nacimiento:</strong> <?php mostrar_valor_campo('lugar_nacimiento',219,$_REQUEST['iddoc']);?> <?php mostrar_valor_campo('fecha_nacimiento',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;"><strong>Edad: </strong><?php calcular_edad_hv(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2">
<p><span style="font-size: small;"><strong>EPS en la que se encuentra afiliado:</strong>&nbsp;<?php mostrar_valor_campo('eps',219,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;"><strong>Fondo de Pensiones en la que se encuentra afiliado:</strong> <?php mostrar_valor_campo('pensiones',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;"><strong>Fonde de Cesant&iacute;as en la que se encuentra afiliado:</strong> <?php mostrar_valor_campo('cesantias',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;"><strong>Cuenta de Ahorro No:</strong>&nbsp;<?php mostrar_valor_campo('cuenta_ahorro',219,$_REQUEST['iddoc']);?> &nbsp; <strong>Banco: </strong><?php mostrar_valor_campo('banco',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: small;"><strong>Talla Blusa:</strong>&nbsp;<?php mostrar_valor_campo('blusa',219,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Talla Pantal&oacute;n:&nbsp;</strong><?php mostrar_valor_campo('pantalon',219,$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Calzado: </strong><?php mostrar_valor_campo('calzado',219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>FORMACI&Oacute;N ACAD&Eacute;MICA</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php mostrar_informacion_academica(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>SEMINARIOS Y CURSOS</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php mostrar_seminarios_cursos(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>&nbsp;EXPERIENCIA LABORAL<strong>(Empleos o contrato anteriores. Inicie por el &uacute;ltimo)</strong></strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php mostrar_experiencia_laboral(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>&nbsp;REFERENCIAS</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php mostrar_referencias(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;">&nbsp;<strong>VERIFICACI&Oacute;N DE LA INFORMACI&Oacute;N: (Este espacio es solo para la Empresa)</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php mostrar_verifiacion_documentos(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>VERIFICACION DE REFERENCIAS LABORALES:(Este espacio es solo para la Empresa)</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php verificacion_experiencias_laborales(219,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>CONTRATO LABORAL</strong></span></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><?php mostrar_contrato_laboral(219,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<table border="0">
<tbody>
<tr>
<td>
<p style="text-align: center;"><span style="font-size: small;">PARA EFECTOS LEGALES HAGO CONSTAR QUE LA INFORMACI&Oacute;N SUMINISTRADA EN LA PRESENTE HOJA DE VIDA ES TOTALMENTE CIERTA&nbsp; (C.S.T. Art. 62 Num. 1&ordm;) Y PUEDE SER VERIFICADA EN SU TOTALIDAD.</span></p>
</td>
</tr>
<tr>
<td>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><span style="font-size: small;">___________________________________________________________</span><br /><span style="font-size: small;">Nombre</span><br /><span style="font-size: small;">FIRMA</span><br /><span style="font-size: small;">C.C.</span></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>