<html><title>.:BUSCAR FORMULA DEL INDICADOR:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA FORMULA DEL INDICADOR</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_naturaleza" id="condicion_naturaleza"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Por favor seleccione la naturaleza del Indicador, si desea especificar otra naturaleza por favor especifiquela en las observaciones">NATURALEZA</td><td class="encabezado">&nbsp;<select name="compara_naturaleza" id="compara_naturaleza"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2926,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Muestra la formula que se va a utilizar en el calculo del indicador">FORMULA</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observacion" id="condicion_observacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Descripci&oacute;n de Variables de la Formula">DESCRIPCI&Oacute;N DE VARIABLES DE LA FORMULA</td><td class="encabezado">&nbsp;<select name="compara_observacion" id="compara_observacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observacion" name="observacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_periocidad" id="condicion_periocidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Tiempo en el cual se debe evaluar el indicador">PERIODICIDAD</td><td class="encabezado">&nbsp;<select name="compara_periocidad" id="compara_periocidad"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2929,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_unidad" id="condicion_unidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Unidad en que se debe medir el indicador porcentaje, documentos, personas, atenciones, etc.">UNIDAD</td><td class="encabezado">&nbsp;<select name="compara_unidad" id="compara_unidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="unidad" name="unidad"></select><script>
                     $(document).ready(function() 
                      {
                      $("#unidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_rango" id="condicion_tipo_rango"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LA MEJORA ES CRECIENTE O DECRECIENTE?</td><td class="encabezado">&nbsp;<select name="compara_tipo_rango" id="compara_tipo_rango"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2932,'',1);?></td></tr><input type="hidden" name="campo_descripcion" value="2927"><?php submit_formato(262);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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