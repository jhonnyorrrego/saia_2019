<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><?php include_once("../memo/funciones.php"); ?><?php include_once("../proceso/funciones.php"); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><style type="text/css" media="screen" src="../../css/dhtmlXTree.css"></style><body bgcolor="#F5F5F5"><form name="formulario_formato" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td class="encabezado_list" height="23" colspan="2">FORMATOS CALIDAD</td></tr><tr>
                     <td class="encabezado" width="20%" title="">ESTRUCTURA CALIDAD*</td>
                     <?php arbol_calidad(40,412);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(40,415);?></tr><?php anexos_digitales(40,NULL);?><tr><td colspan='2'><?php submit_formato(40);?></td></tr></table></form></body>