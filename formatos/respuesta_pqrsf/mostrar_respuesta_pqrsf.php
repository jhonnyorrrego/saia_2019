<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php mostrar_informacion_pqrsf_padre(307,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(307,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>