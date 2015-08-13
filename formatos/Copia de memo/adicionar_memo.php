<html><title>.:ADICIONAR MEMORANDO:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">MEMORANDO</td></tr><input type="hidden" name="idft_memo" value="<?php echo(validar_valor_campo(498)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(499)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(500)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(501)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA*</td>
                     <?php buscar_dependencia(3,44);?></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE DOCUMENTO*</td>
                     <?php arbol_serie_nuevo(3,54);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(3,45);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DESTINO*</td>
                     <?php arbol_funcionarios(3,46);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   obligatorio="obligatorio" class="required"   type="text" size="100" id="asunto" name="asunto"  value="<?php echo(validar_valor_campo(48)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea name="contenido"  cols="53" rows="3" class="tiny_"></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESPEDIDA*</td>
                     <?php despedida(3,50);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CON COPIA A</td>
                     <?php arbol_funcionarios(3,47);?></tr><tr>
                     <td class="encabezado" width="20%" title="">PREPARó*</td>
                     <?php iniciales(3,51);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td>
                     <?php anexos_fisicos(3,52);?></tr><tr>
                     <td class="encabezado" width="20%" title="Anexos digitales">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input type="file" maxlenght="3000"  name="anexos[]" class="multi"accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="">MOSTRAR DEPENDENCIA AL FIRMAR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,929,$_REQUEST['iddoc']);?></td></tr><?php asignar_responsables(3,NULL);?><?php guardar_plantilla(3,NULL);?><input type="hidden" name="campo_descripcion" value="48"><tr><td colspan='2'><?php submit_formato(3);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>