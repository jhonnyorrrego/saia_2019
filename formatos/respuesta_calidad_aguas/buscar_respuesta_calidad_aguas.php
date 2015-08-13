<html><title>.:BUSCAR RESPUESTA A QUEJA POR CALIDAD DEL AGUA:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/><?php include_once("../librerias/header_formato.php"); ?></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RESPUESTA A QUEJA POR CALIDAD DEL AGUA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_consecutivo" id="condicion_consecutivo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="consecutivo">CONSECUTIVO</td><td class="encabezado">&nbsp;<select name="compara_consecutivo" id="compara_consecutivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="consecutivo" name="consecutivo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#consecutivo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_respuesta_calidad_aguas" id="condicion_fecha_respuesta_calidad_aguas"><option value="AND">Y</option><option value="OR">O</option></td><td class="encabezado" width="20%" title="fecha de creaci&oacute;n">FECHA</td><td class="encabezado">&nbsp;<select name="compara_fecha_respuesta_calidad_aguas" id="compara_fecha_respuesta_calidad_aguas"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><?php fecha_formato(76,915,'',1);?></tr><tr><td class="encabezado">&nbsp;<select name="condicion_lugar_muestra" id="condicion_lugar_muestra"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="lugar de toma de la muestra">LUGAR DE TOMA DE LA MUESTRA</td><td class="encabezado">&nbsp;<select name="compara_lugar_muestra" id="compara_lugar_muestra"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="lugar_muestra" name="lugar_muestra"></select><script>
                     $(document).ready(function() 
                      {
                      $("#lugar_muestra").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_queja" id="condicion_queja"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="queja">QUEJA</td><td class="encabezado">&nbsp;<select name="compara_queja" id="compara_queja"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="queja" name="queja"></select><script>
                     $(document).ready(function() 
                      {
                      $("#queja").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="914"><?php submit_formato(76);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?>">
             <?php  }
              else{ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?>">
             <?php  } ?></form></body></html>