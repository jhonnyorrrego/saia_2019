<script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php include_once("../memorando/../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0">

<tr>
<td style="text-align: justify;">
<p>&nbsp;</p>
<p><strong>IINOTIFICACI&Oacute;N PERSONAL : ___________; </strong>Que se hace hoy<span style="text-decoration: underline;"> <?php fecha_hoy(4,$_REQUEST['iddoc']);?> </span>&nbsp; hora: <span style="text-decoration: underline;"><?php hora_hoy(4,$_REQUEST['iddoc']);?></span> de la respuesta al Derecho de petici&oacute;n radicado No <span style="text-decoration: underline;"><?php radicado_papa(4,$_REQUEST['iddoc']);?></span> de fecha<span style="text-decoration: underline;"> <?php fecha_papa(4,$_REQUEST['iddoc']);?></span>de la respuesta al Recurso de Reposici&oacute;n radicado No. ______ de fecha ________&nbsp; de la Respuesta al Reclamo No ______ de fecha, presentado por el se&ntilde;or (a) <?php nombre_papa(4,$_REQUEST['iddoc']);?> identificado (a) con cedula No <?php cedula_papa(4,$_REQUEST['iddoc']);?> a quien se le hace entrega de la misma en original y en forma gratuita por parte de la se&ntilde;or (a) <?php nombre_notificacion_funcion(4,$_REQUEST['iddoc']);?> identificado (a) cedula No <?php identificacion_notificacion_funcion(4,$_REQUEST['iddoc']);?>, quien es funcionario (a) de la Empresa Multiproposito de Calarc&aacute;.</p>
<p>Esta notificaci&oacute;n se debe realizar durante los cinco d&iacute;as h&aacute;biles despu&eacute;s de recibir la citaci&oacute;n de la notificaci&oacute;n personal.<br /><br /><br /></p>
</td>
</tr>
<tr>
<td><br /><br /><br />___________________________________<br />NOTIFICADO<br />CC:<?php cedula_papa(4,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br />NOTIFICADOR:<br /><?php mostrar_estado_proceso(4,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>

</table></td></tr><?php include_once("../librerias/footer.php"); ?>