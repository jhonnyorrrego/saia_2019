<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><p><?php mostrar_error_pdf(400,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			