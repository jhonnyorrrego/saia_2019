<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center;" colspan="2"><strong>BIENVENIDO A NUESTRA CLINICA!<br />&nbsp;</strong></td>
</tr>
<tr>
<td style="text-align: justify;" colspan="2">En ODONTOLOGOS SAS ser&aacute; atendido por Ortodoncistas miembros de la Sociedad Colombiana de Ortodoncia, en la consulta de hoy se le realizar&aacute; una evaluaci&oacute;n para determinar si es necesario solicitar ex&aacute;menes diagn&oacute;sticos.<br />&nbsp;</td>
</tr>
<tr>
<td style="width: 25%;">Ciudad y fecha:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('depto',282,$_REQUEST['iddoc']);?> &nbsp;<?php mostrar_valor_campo('creacion_historia',282,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 10pt; width: 25%%;" border="0">
<tbody>
<tr>
<td><?php mostrar_valor_campo('datos_paciente',282,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td>Nombres:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('nombre_usuario',282,$_REQUEST['iddoc']);?></td>
<td>Apellidos:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('apellido_usuario',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Doc.identidad:</td>
<td style="border-bottom: 1px solid black;"><span><?php mostrar_valor_campo('cedula_ciudadania',282,$_REQUEST['iddoc']);?></span></td>
<td>Fecha de nacimiento:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('fecha_nacimiento',282,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td>N&uacute;mero documento:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('numero_doc',282,$_REQUEST['iddoc']);?></td>
<td>Departamento:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('depto',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Edad</td>
<td style="border-bottom: 1px solid black;"><?php calcular_edad(282,$_REQUEST['iddoc']);?></td>
<td>Sexo:</td>
<td style="border-bottom: 1px solid black;"><span><?php mostrar_valor_campo('sexo',282,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<hr />
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td>Ocupaci&oacute;n:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('ocupacion',282,$_REQUEST['iddoc']);?></td>
<td>&iquest;D&oacute;nde?:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('donde_usuario',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Direcci&oacute;n:&nbsp;</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('direccion',282,$_REQUEST['iddoc']);?></td>
<td>Tel&eacute;fono:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('tel_usuario',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Celular:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('cel',282,$_REQUEST['iddoc']);?></td>
<td>Estado civil:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('estado_civil',282,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<hr />
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center; background-color: #d3d3d3;" colspan="4"><strong>INFORMACION CONYUGUE</strong>
<p><span><strong><br /></strong></span></p>
</td>
</tr>
<tr>
<td style="width: 25%;">Nombre y apellidos del conyugue:</td>
<td style="border-bottom: 1px solid black; width: 25%;"><span><?php mostrar_valor_campo('nombre_apellidos_conyugue',282,$_REQUEST['iddoc']);?></span></td>
<td style="width: 20%;"><span>Tel&eacute;fono conyugue:</span></td>
<td style="border-bottom: 1px solid black; width: 30%;"><span><?php mostrar_valor_campo('tel_conyugue',282,$_REQUEST['iddoc']);?></span>&nbsp;</td>
</tr>
<tr>
<td>Composici&oacute;n nucleo familiar:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('nucleo_familiar',282,$_REQUEST['iddoc']);?></td>
<td>Grado escolaridad:</td>
<td style="border-bottom: 1px solid black;"><span><?php mostrar_valor_campo('grado_escolar',282,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td>&iquest;Que actividades realiza en su tiempo libre?:&nbsp;</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('actividades_tiempo_libre',282,$_REQUEST['iddoc']);?></td>
<td colspan="2">&nbsp;</td>
</tr>
</tbody>
</table>
<hr />
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center; background-color: #d3d3d3;" colspan="4"><strong>INFORMACION MADRE<br />&nbsp;</strong></td>
</tr>
<tr>
<td style="width: 20%;">Nombre madre:</td>
<td style="border-bottom: 1px solid black; width: 35%;"><?php mostrar_valor_campo('nombre_madre',282,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;">Tel&eacute;fono madre:</td>
<td style="border-bottom: 1px solid black; width: 25%;"><?php mostrar_valor_campo('tel_madre',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Ocupaci&oacute;n madre:</td>
<td style="border-bottom: 1px solid black;"><span><?php mostrar_valor_campo('ocupacion_madre',282,$_REQUEST['iddoc']);?></span></td>
<td>&iquest;D&oacute;nde?:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('donde_madre',282,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<hr />
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center; background-color: #d3d3d3;" colspan="4"><strong>INFORMACION PADRE</strong>
<p><strong><br /></strong></p>
</td>
</tr>
<tr>
<td style="width: 20%;">Nombre padre:</td>
<td style="border-bottom: 1px solid black; width: 35%;"><?php mostrar_valor_campo('nombre_padre',282,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;">Tel&eacute;fono padre:</td>
<td style="border-bottom: 1px solid black; width: 25%;"><?php mostrar_valor_campo('tel_padre',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Ocupaci&oacute;n:</td>
<td style="border-bottom: 1px solid black;"><?php mostrar_valor_campo('ocupacion_padre',282,$_REQUEST['iddoc']);?></td>
<td>&iquest;D&oacute;nde?:</td>
<td style="border-bottom: 1px solid black;"><span><?php mostrar_valor_campo('donde_padre',282,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<hr />
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="0">
<tbody>
<tr>
<td style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: black; text-align: center; background-color: #d3d3d3;" colspan="4"><strong>TRATAMIENTOS PREVIOS</strong>
<p><strong><br /></strong></p>
</td>
</tr>
<tr>
<td style="width: 25%;">&iquest;Ha tenido alg&uacute;n &nbsp;tratamiento previo de &nbsp;ortodoncia?</td>
<td style="border-bottom: 1px solid black; width: 35%;"><?php mostrar_valor_campo('tratamientos_previos',282,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;">&iquest;Cuanto tiempo?</td>
<td style="border-bottom: 1px solid black; width: 20%;"><?php mostrar_valor_campo('cuanto_tiempo',282,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&iquest;C&oacute;mo se enter&oacute; de &nbsp;nuestro servicio?</td>
<td style="border-bottom: 1px solid black;" colspan="0"><span><?php mostrar_valor_campo('como_se_entero',282,$_REQUEST['iddoc']);?></span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php mostrar_estado_proceso(282,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>