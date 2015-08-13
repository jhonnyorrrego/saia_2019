<html><title>.:EDITAR CONFIRMACI&Oacute;N NEGOCIACI&Oacute;N VEH&Iacute;CULO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CONFIRMACI&Oacute;N NEGOCIACI&Oacute;N VEH&Iacute;CULO</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',260,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(260,2961,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA</td>
                     <?php fecha_formato(260,2967,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">PLACA ASIGNADA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="6"  class="required"   tabindex='1'  type="text" size="100" id="placa_asignada_vehiculo" name="placa_asignada_vehiculo"  value="<?php echo(mostrar_valor_campo('placa_asignada_vehiculo',260,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DATOS DEL VEH&Iacute;CULO</td>
                     <?php cargar_datos_vehiculo(260,2965,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">VER INFORMACI&Oacute;N DEL VEH&Iacute;CULO</td>
                     <?php cargar_info_vehiculo(260,2966,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ACCESORIOS</td>
                     <?php cargar_accesorios_vehiculo(260,2968,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DATOS DEL CLIENTE*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="datos_cliente" id="datos_cliente" value="<?php echo(mostrar_valor_campo('datos_cliente',260,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("2958",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><CENTER>MATR&Iacute;CULA</CENTER></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">MATR&Iacute;CULA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="numero_matricula" name="numero_matricula"  value="<?php echo(mostrar_valor_campo('numero_matricula',260,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR MATR&Iacute;CULA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"   tabindex='3'  type="text" size="100" id="valor_matricula" name="valor_matricula"  value="<?php echo(mostrar_valor_campo('valor_matricula',260,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><CENTER>SEGUROS</CENTER></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SEGUROS</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="campo_seguros" name="campo_seguros"  value="<?php echo(mostrar_valor_campo('campo_seguros',260,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR SEGUROS</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"   tabindex='5'  type="text" size="100" id="valor_seguros" name="valor_seguros"  value="<?php echo(mostrar_valor_campo('valor_seguros',260,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="observaciones_negocia" id="observaciones_negocia" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones_negocia',260,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',260,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',260,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_confir_negoci_vehiculo" value="<?php echo(mostrar_valor_campo('idft_confir_negoci_vehiculo',260,$_REQUEST['iddoc'])); ?>"><?php separar_miles_confirmacion(260,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2951'); ?>"><input type="hidden" name="formato" value="260"><tr><td colspan='2'><?php submit_formato(260,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>