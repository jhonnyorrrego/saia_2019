<script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php include_once("../memorando/../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php mostrar_valor_campo('asunto',4,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_valor_campo('contenido',4,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_valor_campo('despedida',4,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer.php"); ?>