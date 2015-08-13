<html><title>.:EDITAR EMAIL:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> <script>$(document).ready(function() 
      {/* Para que el enter se comporte como tabulador    */    
        tb = $('input');         
        if ($.browser.mozilla) 
           $(tb).keypress(enter2tab);    
        else 
           $(tb).keydown(enter2tab);        
      });
      
      function enter2tab(e)  
      {         
        if (e.keyCode == 13)  
        {             
          cb = parseInt($(this).attr('tabindex'));                 
          if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null) 
            {                
              $(':input[tabindex=\'' + (cb + 1) + '\']').focus();                
              $(':input[tabindex=\'' + (cb + 1) + '\']').select();                
              e.preventDefault();                     
              return false;            
            }        
        }    
      }</script></head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">EMAIL</td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',41,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',41,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(41,882,$_REQUEST['iddoc']);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',41,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_mensaje" value="<?php echo(mostrar_valor_campo('idft_mensaje',41,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="fecha_mensaje">FECHA*</td>
                     <?php fecha_formato(41,452,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="remitente">REMITENTE*</td>
                     <?php nombre_usuario(41,453,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="destinatario del formato correo">DESTINATARIO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="destinatario" name="destinatario"  value="<?php echo(mostrar_valor_campo('destinatario',41,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="copia">COPIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="copia" name="copia"  value="<?php echo(mostrar_valor_campo('copia',41,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(mostrar_valor_campo('asunto',41,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('contenido',41,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="<?php echo('451,455'); ?>"><input type="hidden" name="formato" value="41"><tr><td colspan='2'><?php submit_formato(41,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>