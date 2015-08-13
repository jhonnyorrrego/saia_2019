<script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0" width="100%" cellspacing="0" >
<tbody>
<tr>
<td colspan="2"><?php ciudad(3,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(3,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>
<table border="0" width="100%" cellspacing="0" >
<tbody>
<tr>
<td>
<p>&nbsp;</p>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><strong>PARA:</strong></td>
<td valign="top"><?php lista_destinos(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><strong>DE:</strong></td>
<td valign="top"><?php mostrar_origen(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><strong>ASUNTO:</strong></td>
<td valign="top"><?php mostrar_valor_campo('asunto',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('contenido',3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">
<p><br /><?php mostrar_valor_campo('despedida',3,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(3,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">
<p>&nbsp;</p>
<p><?php mostrar_anexos_memo(3,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2"><br /><?php mostrar_copias_memo(3,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /><?php mostrar_preparo(3,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</p></td></tr><?php include_once("../librerias/footer.php"); ?>
