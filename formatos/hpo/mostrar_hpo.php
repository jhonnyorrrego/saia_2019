<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>CODIGO DEL PRODUCTO: <?php mostrar_valor_campo('codigo_producto',316,$_REQUEST['iddoc']);?></p>
<p>CODIGO UNIDAD DE MEDIDA: <?php mostrar_valor_campo('codigo_unidad_medida',316,$_REQUEST['iddoc']);?></p>
<p>NUMERO DE REQUISICION: <?php mostrar_valor_campo('numero_requesicion',316,$_REQUEST['iddoc']);?></p>
<p>FECHA DE VENCIMIENTO: <?php mostrar_valor_campo('pddte',316,$_REQUEST['iddoc']);?></p>
<p>IDENTIFICACION DE REGISTRO: <?php mostrar_valor_campo('phid',316,$_REQUEST['iddoc']);?></p>
<p>NUMERO DE LINEA: <?php mostrar_valor_campo('pline',316,$_REQUEST['iddoc']);?></p>
<p>CANTIDAD ORDENADA: <?php mostrar_valor_campo('pqord',316,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>