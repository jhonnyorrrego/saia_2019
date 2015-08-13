<html><title>.:EDITAR SOLICITUD DE SERVICIO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_entrada/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../librerias/dependientes.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE SERVICIO</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',267,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(267,3049,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA Y HORA DE SOLICITUD*</td>
                     <?php fecha_formato(267,3033,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto_solicitud" name="asunto_solicitud"  value="<?php echo(mostrar_valor_campo('asunto_solicitud',267,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CIUDAD DE ORIGEN*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3034,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SELECCIONE EL DOCUMENTO*</td>
                     <?php fk_idsolicitud_afiliacion_funcion(267,3116,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3035,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">TIPO DE MERCANCIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3036,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">REFERENCIA DE CAJA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3105,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD (UNIDADES)</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="digits"   tabindex='2'  type="text" size="100" id="cantidad_mercancia" name="cantidad_mercancia"  value="<?php echo(mostrar_valor_campo('cantidad_mercancia',267,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE PRIVILEGIOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3037,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE ENV&Iacute;O*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3038,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DECLARADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"   tabindex='3'  type="text" size="100" id="valor_declarado" name="valor_declarado"  value="<?php echo(mostrar_valor_campo('valor_declarado',267,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PESO (KILOS)</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="digits"   tabindex='4'  type="text" size="100" id="peso_envio_solicitud" name="peso_envio_solicitud"  value="<?php echo(mostrar_valor_campo('peso_envio_solicitud',267,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TAMA&Ntilde;O APROXIMADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="tamanio_aproximado" name="tamanio_aproximado"  value="<?php echo(mostrar_valor_campo('tamanio_aproximado',267,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">REQUIERE RECOLECCI&Oacute;N*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3042,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCI&Oacute;N DE RECOLECCI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="direccion_recoleccion" name="direccion_recoleccion"  value="<?php echo(mostrar_valor_campo('direccion_recoleccion',267,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE RECOLECCI&Oacute;N</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='7'  type="text" readonly="true"  name="fecha_recoleccion" id="fecha_recoleccion" tipo="fecha" value="<?php mostrar_valor_campo('fecha_recoleccion',267,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_recoleccion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="observacion_solicitud" id="observacion_solicitud" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observacion_solicitud',267,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=267&idcampo=3046" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="idft_solicitud_servicio" value="<?php echo(mostrar_valor_campo('idft_solicitud_servicio',267,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',267,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',267,$_REQUEST['iddoc'])); ?>"><?php digitalizar_formato_radicacion(267,NULL,$_REQUEST['iddoc']);?><?php carga_ciudad_solicitud(267,NULL,$_REQUEST['iddoc']);?><?php separar_miles_solicitud(267,NULL,$_REQUEST['iddoc']);?><?php oculta_campos_adicionar_solicitud(267,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3065'); ?>"><input type="hidden" name="formato" value="267"><tr><td colspan='2'><?php submit_formato(267,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>