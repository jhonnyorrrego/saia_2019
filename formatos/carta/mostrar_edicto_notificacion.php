<script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php include_once("../memorando/../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0">

<tr>
<td style="text-align: justify;"><strong>IINOTIFICACI&Oacute;N POR EDICTO :</strong>Una vez surtida la citaci&oacute;n a la se&ntilde;or (a) <?php nombre_papa(4,$_REQUEST['iddoc']);?>, sin que esta se hubiese hecho presente dentro de los cinco d&iacute;as siguientes al recibo de la misma, procede la Empresa a fijar EDICTO en la Cartelera ubicada en el &Aacute;rea de Gesti&oacute;n Comercial de la Empresa Multiprop&oacute;sito de Calarc&aacute; SA ESP a Respuesta Derecho de petici&oacute;n radicado No <?php radicado_papa(4,$_REQUEST['iddoc']);?> de fecha <?php fecha_papa(4,$_REQUEST['iddoc']);?> de la respuesta al Recurso de Reposici&oacute;n radicado No.&nbsp; de fecha de la Respuesta al Reclamo No&nbsp; por el termino de diez (10) d&iacute;as h&aacute;biles
<p>Fecha de fijaci&oacute;n DIA <?php dia_fij(4,$_REQUEST['iddoc']);?> MES <?php mes_fij(4,$_REQUEST['iddoc']);?> A&Ntilde;O <?php ano_fij(4,$_REQUEST['iddoc']);?>&nbsp; Certifica</p>
<p>Fecha de Desfijaci&oacute;n DIA <?php dia_des(4,$_REQUEST['iddoc']);?> MES <?php mes_des(4,$_REQUEST['iddoc']);?> A&Ntilde;O <?php ano_des(4,$_REQUEST['iddoc']);?> Certifica</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

</table></td></tr><?php include_once("../librerias/footer.php"); ?>