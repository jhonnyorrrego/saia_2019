<?php include_once('../../librerias_saia.php'); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once('../../formatos/librerias/funciones_generales.php'); ?><?php include_once('../../class_transferencia.php'); ?><?php include_once('../carta/../librerias/encabezado_pie_pagina.php'); ?><?php include_once('funciones.php'); ?><?php include_once('../../formatos/librerias/header_nuevo.php'); ?><style> table{font-size: 11;} </style><tr><td><p><?php if(isset($_REQUEST["iddoc"])){expedientes_vinculados_funcion(343,$_REQUEST['iddoc']);}?>&nbsp;</p>
<p><?php if(isset($_REQUEST["iddoc"])){mostrar_estado_proceso(343,$_REQUEST['iddoc']);}?></p></td></tr><?php include_once('../../formatos/librerias/footer_nuevo.php'); ?>