<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>CODIGO SOLICITUD COMPRA:<?php mostrar_valor_campo('campo_phrqid',315,$_REQUEST['iddoc']);?></p>
<p>CODIGO DEL COMPRADO: <?php mostrar_valor_campo('codigo_comprador',315,$_REQUEST['iddoc']);?></p>
<p>CODIGO DEL PROVEEDOR: <?php mostrar_valor_campo('codigo_proveedor',315,$_REQUEST['iddoc']);?></p>
<p>CODIGO DE LA COMPA&Ntilde;IA: <?php mostrar_valor_campo('phcomp',315,$_REQUEST['iddoc']);?></p>
<p>MONEDA DE LA OPERACION: <?php mostrar_valor_campo('phcur',315,$_REQUEST['iddoc']);?></p>
<p>FECHA DE CREACION ORDEN: <?php mostrar_valor_campo('phendt',315,$_REQUEST['iddoc']);?></p>
<p>CODIGO DE LA INSTALACION: <?php mostrar_valor_campo('phfac',315,$_REQUEST['iddoc']);?></p>
<p>IDENTIFICACION DEL REGISTRO: <?php mostrar_valor_campo('phid',315,$_REQUEST['iddoc']);?></p>
<p>NUMERO DE REQUISICION: <?php mostrar_valor_campo('phord',315,$_REQUEST['iddoc']);?></p>
<p>CODIGO DE QUIEN RECIBE LA MERCANCIA: <?php mostrar_valor_campo('phship',315,$_REQUEST['iddoc']);?></p>
<p>ESTADO: <?php mostrar_valor_campo('phstat',315,$_REQUEST['iddoc']);?></p>
<p><?php enlace_item_requisicion_compra(315,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>