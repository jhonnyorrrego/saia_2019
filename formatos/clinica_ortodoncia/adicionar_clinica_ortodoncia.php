<html><title>.:ADICIONAR HISTORIA CLINICA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../librerias/dependientes.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">HISTORIA CLINICA</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3243)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(282,3242);?></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>DATOS DEL PACIENTE</center></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA CREACION</td>
                     <?php fecha_formato(282,3343);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_usuario" name="nombre_usuario"  value="<?php echo(validar_valor_campo(3165)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">APELLIDO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="apellido_usuario" name="apellido_usuario"  value="<?php echo(validar_valor_campo(3166)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DOC. IDENTIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3224,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='3'  type="text" size="100" id="numero_doc" name="numero_doc"  value="<?php echo(validar_valor_campo(3171)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE NACIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='4'  type="text" readonly="true"  class="required dateISO"  name="fecha_nacimiento" id="fecha_nacimiento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_nacimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">DEPARTAMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3176,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">EDAD</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"   tabindex='5'  type="text" size="100" id="edad" name="edad"  value="<?php echo(validar_valor_campo(3178)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SEXO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3180,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OCUPACION*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="ocupacion" name="ocupacion"  value="<?php echo(validar_valor_campo(3182)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;DONDE?*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='7'  type="text" size="100" id="donde_usuario" name="donde_usuario"  value="<?php echo(validar_valor_campo(3239)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCION*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='8'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(validar_valor_campo(3184)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='9'  type="text" size="100" id="tel_usuario" name="tel_usuario"  value="<?php echo(validar_valor_campo(3234)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CELULAR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='10'  type="text" size="100" id="cel" name="cel"  value="<?php echo(validar_valor_campo(3186)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ESTADO CIVIL*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3188,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>INFORMACI&Oacute;N CONYUGUE</center></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE Y APELLIDOS DEL CONYUGUE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="nombre_apellidos_conyugue" name="nombre_apellidos_conyugue"  value="<?php echo(validar_valor_campo(3189)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO CONYUGUE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='12'  type="text" size="100" id="tel_conyugue" name="tel_conyugue"  value="<?php echo(validar_valor_campo(3236)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">COMPOSICION DEL NUCLEO FAMILIAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='13'  type="text" size="100" id="nucleo_familiar" name="nucleo_familiar"  value="<?php echo(validar_valor_campo(3192)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">GRADO ESCOLAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"   tabindex='14'  type="text" size="100" id="grado_escolar" name="grado_escolar"  value="<?php echo(validar_valor_campo(3193)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;QUE ACTIVIDADES REALIZA EN SU TIEMPO LIBRE?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='15'  type="text" size="100" id="actividades_tiempo_libre" name="actividades_tiempo_libre"  value="<?php echo(validar_valor_campo(3194)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>INFORMACION MADRE</center></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE MADRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='16'  type="text" size="100" id="nombre_madre" name="nombre_madre"  value="<?php echo(validar_valor_campo(3196)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONO MADRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='17'  type="text" size="100" id="tel_madre" name="tel_madre"  value="<?php echo(validar_valor_campo(3237)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OCUPACION MADRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='18'  type="text" size="100" id="ocupacion_madre" name="ocupacion_madre"  value="<?php echo(validar_valor_campo(3226)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;DONDE?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='19'  type="text" size="100" id="donde_madre" name="donde_madre"  value="<?php echo(validar_valor_campo(3238)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>INFORMACION PADRE</center></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE PADRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='20'  type="text" size="100" id="nombre_padre" name="nombre_padre"  value="<?php echo(validar_valor_campo(3204)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONO PADRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='21'  type="text" size="100" id="tel_padre" name="tel_padre"  value="<?php echo(validar_valor_campo(3205)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OCUPACI&Oacute;N PADRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='22'  type="text" size="100" id="ocupacion_padre" name="ocupacion_padre"  value="<?php echo(validar_valor_campo(3206)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;DONDE?</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='23'  type="text" size="100" id="donde_padre" name="donde_padre"  value="<?php echo(validar_valor_campo(3230)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>TRATAMIENTOS PREVIOS</center></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;HA TENIDO TRATAMIENTO PREVIO DE ORTODONCIA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3203,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;CUANTO TIEMPO?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='24'  type="text" size="100" id="cuanto_tiempo" name="cuanto_tiempo"  value="<?php echo(validar_valor_campo(3208)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;COMO SE ENTER&Oacute; DE NUESTRO SERVICIO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3209,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_clinica_ortodoncia" value="<?php echo(validar_valor_campo(3240)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3241)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3162)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3244)); ?>"><?php activar_campo_tiempo(282,NULL);?><input type="hidden" name="campo_descripcion" value="3165"><tr><td colspan='2'><?php submit_formato(282);?></td></tr></table></form></body></html>