<html><title>.:ADICIONAR REGISTRO ESPECIAL DE ARCHIVO (READH):.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../librerias/dependientes.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REGISTRO ESPECIAL DE ARCHIVO (READH)</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(317,3728);?></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3714)); ?>"><tr id="tr_tipo_entidad" >
                     <td class="encabezado" width="20%" title="">TIPO DE ENTIDAD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3715,$_REQUEST['iddoc']);?></td></tr><tr id="tr_enfoque_diferencial" >
                     <td class="encabezado" width="20%" title="">ENFOQUE DIFERENCIAL*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3716,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">UBICACI&Oacute;N GEOGR&Aacute;FICA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3717,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">NOMBRE DE LA ENTIDAD*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="11"  class="required"  name="nombre_entidad" id="nombre_entidad" value=""><?php componente_ejecutor("3718",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE PARALELO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="nombre_paralelo" name="nombre_paralelo"  value="<?php echo(validar_valor_campo(3719)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_readh" id="descripcion_readh" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3720)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONTEXTO GEOGR&Aacute;FICO Y CULTURAL</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="contexto_geografico" id="contexto_geografico" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3721)); ?></textarea></td>
                    </tr><tr id="tr_registro_funciones" >
                     <td class="encabezado" width="20%" title="">REGISTRO DE FUNCIONES</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3722,$_REQUEST['iddoc']);?></td></tr><tr id="tr_estado_registro" >
                     <td class="encabezado" width="20%" title="">ESTADO DEL REGISTRO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3723,$_REQUEST['iddoc']);?></td></tr><tr id="tr_palabras_clave" >
                     <td class="encabezado" width="20%" title="">PALABRAS CLAVE</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3724,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='4'  type="file" maxlength="255"  class='multi'  name="anexos_digitales[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_readh" value="<?php echo(validar_valor_campo(3726)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3727)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3729)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3730)); ?>"><?php digitalizar_formato_readh(317,NULL);?><input type="hidden" name="campo_descripcion" value="3718"><tr><td colspan='2'><?php submit_formato(317);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>