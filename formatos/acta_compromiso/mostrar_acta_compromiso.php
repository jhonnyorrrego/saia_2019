<?php include_once("../memo/funciones.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0" width="100%">
<tbody>
<tr>
<td style="text-align: right;" colspan="4">
<p>Version:1</p>
<p>Noviembre 20 de 2011</p>
<p>A-PV-CS-R02</p>
</td>
</tr>
<tr>
<td colspan="4"><br /></td>
</tr>
<tr>
<td colspan="4"></td>
</tr>
<tr>
<td style="text-align: justify;" colspan="4">
<p>El dia&nbsp;<strong><?php fecha_reunion_funcion(81,$_REQUEST['iddoc']);?></strong>, se reunieron en las dependencias de <strong><span style="text-decoration: underline;"><?php nombre_dependencia(81,$_REQUEST['iddoc']);?></span></strong>&nbsp;las personas abajo firmantes, para establecer los compromisos acerca del software instalado en el equipo identificado por la serie de la CPU No.&nbsp;<strong><span style="text-decoration: underline;"><?php mostrar_valor_campo('serie_cpu',81,$_REQUEST['iddoc']);?></span></strong> , Stiker No.&nbsp;<strong><span style="text-decoration: underline;"><?php mostrar_valor_campo('num_stiker',81,$_REQUEST['iddoc']);?></span></strong>.</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td colspan="4"><span style="font-size: x-small;"><strong><span style="font-size: x-small;"><span style="font-size: small;"><span style="font-size: medium;"><span style="font-size: large;"><span style="font-size: small;"><span style="font-size: medium;">Software Instalado:</span></span></span></span></span></span></strong></span></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; border-width: 1px;" border="1" width="100%">
<tbody>
<tr>
<td><strong>Sistema Operativo:</strong></td>
<td><?php mostrar_valor_campo('sistema_operativo',81,$_REQUEST['iddoc']);?></td>
<td><strong>Base de Datos</strong></td>
<td><?php mostrar_valor_campo('base_datos',81,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Ofim&aacute;tico:</strong></td>
<td><?php mostrar_valor_campo('ofimatico',81,$_REQUEST['iddoc']);?></td>
<td><strong>Otro 1</strong></td>
<td><?php mostrar_valor_campo('otro1',81,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>MS Project:</strong></td>
<td><?php mostrar_valor_campo('ms_project',81,$_REQUEST['iddoc']);?></td>
<td><strong>Otro 2</strong></td>
<td><?php mostrar_valor_campo('otro2',81,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Dise&ntilde;o Gr&aacute;fico:</strong></td>
<td><?php mostrar_valor_campo('dise_grafico',81,$_REQUEST['iddoc']);?></td>
<td><strong>Otro 3</strong></td>
<td><?php mostrar_valor_campo('otro3',81,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Antivirus:</strong></td>
<td><?php mostrar_valor_campo('antivirus',81,$_REQUEST['iddoc']);?></td>
<td><strong>Otro 4</strong></td>
<td><?php mostrar_valor_campo('otro4',81,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Oracle:</strong></td>
<td><?php mostrar_valor_campo('oracle',81,$_REQUEST['iddoc']);?></td>
<td><strong>Otro 5</strong></td>
<td><?php mostrar_valor_campo('otro5',81,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Observaciones:</strong></td>
<td colspan="3"><?php mostrar_valor_campo('observaciones',81,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table border="0" width="100%">
<tbody>
<tr>
<td colspan="4">El usuario se compromete a no instalar y no dejar instalar en su equipo de trabajo Software que no se encuentre debidamente Licenciado y Autorizado por la Empresa. Igualmente a no incurrir en cualquier acto violatorio a las leyes sobre Propiedad Intelectual derechos de autor.</td>
</tr>
<tr>
<td colspan="4"><br /></td>
</tr>
<tr>
<td style="text-align: center;" colspan="4"><strong><span style="text-decoration: underline;">POLITICAS DE COPIA DE SEGURIDAD</span></strong></td>
</tr>
<tr>
<td colspan="4">
<p>El usuario conoce y acepta los siguientes elementos de la Pol&iacute;tica Corporativa de Copias de seguridad:</p>
<p>1. Todos los documentos de contenido corporativo, se encuentran ubicados en la carpeta "Mis Documentos" de su equipo; se conoce esta informaci&oacute;n como de propiedad de la Empresa.</p>
<p>2. El usuario conoce el tema de "manejo de archivos y carpetas".</p>
<p>3. En el equipo se encuentra instalado y configurado el software CobianBackup, para el manejo de las copias del usuario; cualquier manipulaci&oacute;n posterior de este software es responsabilidad del usuario.</p>
<p>4. El Grupo de Informaci&oacute;n y Sistemas s&oacute;lo se responsabiliza de la informaci&oacute;n contenida en los servidores de Copias de Seguridad, siempre y cuando no haya existido manipulaci&oacute;n del software de Copias por parte del usuario.</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td colspan="4">Firma Usuario:<?php mostrar_estado_proceso(81,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4"><?php dependencia_creador(81,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>