<?php include_once('../../librerias_saia.php'); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../radicacion_entrada/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('../prueba_formato_saia2/../../formatos/librerias/funciones_cliente.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><style> table{font-size: 11;} </style><tr><td><p><?php if(isset($_REQUEST["iddoc"])){formato_numero(426,$_REQUEST['iddoc']);}?><?php if(isset($_REQUEST["iddoc"])){creador_documento(426,$_REQUEST['iddoc']);}?><?php if(isset($_REQUEST["iddoc"])){fecha_aprobacion(426,$_REQUEST['iddoc']);}?></p>
</td></tr><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?>