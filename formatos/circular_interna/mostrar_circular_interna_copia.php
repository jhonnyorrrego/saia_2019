<script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php include_once("../memo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>
<table border="0" width="100%" cellspacing="0" >
<tbody>
<tr>
<td colspan="2">Pereira, <?php mostrar_fecha(48,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
</tr>
<tr>
<td style="width: 10%;" valign="top"><strong>PARA:</strong></td>
<td valign="top"><?php listar_funcionarios(48,"destino",$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>DE:</strong></td>
<td><?php mostrar_origen(48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="top"><strong>ASUNTO:</strong></td>
<td><?php mostrar_valor_campo('asunto',48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /><br /><?php mostrar_valor_campo('contenido',48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /><?php mostrar_valor_campo('despedida',48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(48,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /><?php mostrar_preparo(48,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">
<p><?php mostrar_anexos_memo(48,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2">
<p><?php mostrar_copias_memo(48,$_REQUEST['iddoc']);?></p>
</td>
</tr>
</tbody>
</table>
</p></td></tr><?php include_once("../librerias/footer.php"); ?>
