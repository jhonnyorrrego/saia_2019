<script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td colspan="2"><?php ciudad(3,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(3,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
</tr>
</tbody>
</table>
<table border="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td valign="top"><strong><span style="font-size: x-small;">PARA:</span></strong></td>
<td valign="top"><span style="font-size: x-small;"><?php lista_destinos(3,$_REQUEST['iddoc']);?><br /><br /></span></td>
</tr>
<tr>
<td valign="top"><strong><span style="font-size: x-small;">DE:</span></strong></td>
<td valign="top"><span style="font-size: x-small;"><?php mostrar_origen(3,$_REQUEST['iddoc']);?><br /></span></td>
</tr>
<tr>
<td valign="top"><strong><span style="font-size: x-small;">ASUNTO:</span></strong></td>
<td valign="top"><span style="font-size: x-small;"><?php mostrar_valor_campo('asunto',3,$_REQUEST['iddoc']);?></span><br /><br /></td>
</tr>
</tbody>
</table>
<p><?php mostrar_valor_campo('contenido',3,$_REQUEST['iddoc']);?></p>
<table border="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td colspan="2"><?php mostrar_valor_campo('despedida',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(3,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?><br /><?php mostrar_dependencia_memorando(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos_memo(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_copias_memo(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_preparo(3,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer.php"); ?>