<html><title>.:ADICIONAR PROCESO:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("funciones.php"); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link type="text/css" rel="stylesheet" media="screen" href="../../css/dhtmlXTree.css"><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.MultiFile.js"></script><?php include_once("../librerias/funciones_archivo.php"); ?>
      <script type="text/javascript">jQuery.noConflict();(function($) {
        
/*        $(window).unload(function(){
          if(!confirm("Desea Enviar los datos?")){
            window.location.href="#";
            alert($("form").serialize());
          }
          else{
            validar_formato();
          }
        });*/
        $(document).ready(function(){
      // run code
        $('#riesgos').focus();});
        })(jQuery);
      </script></head><body bgcolor="#F5F5F5" ><form name="formulario_formato" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" class="tabla_borde" border="1"><tr><td colspan="2" class="encabezado_list">PROCESO<?php datos_documento(@$_REQUEST["iddoc"]); ?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Vincula los Riesgos clon los procesos">RIESGOS*</td>
                     <?php adicionar_proceso(1,61);?></tr><tr>
                     <td class="encabezado" width="20%" title="Adicionar Normograma">NORMOGRAMA</td>
                     <?php adicionar_proceso(1,62);?></tr><tr>
                     <td class="encabezado" width="20%" title="Hace referencia al Codigo del Proceso (Campos Alfa Numericos)">CODIGO*</td>
                     <td class="celda_transparente"><input type="text" size="100"  maxleng="255" id="codigo" name="codigo" obligatorio="obligatorio" value="<?php echo(validar_valor_campo(4)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nombre del proceso">NOMBRE*</td>
                     <td class="celda_transparente"><input type="text" size="100"  maxleng="255" id="nombre" name="nombre" obligatorio="obligatorio" value="<?php echo(validar_valor_campo(6)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Version del Documento">VERSION</td>
                     <td class="celda_transparente"><input type="text" size="100"  maxleng="255" id="version" name="version" obligatorio="" value="<?php echo(validar_valor_campo(55)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Responsable o responsables del Proceso">RESPONSABLE*</td>
                     <?php arbol_funcionarios(1,8);?></tr><tr>
                     <td class="encabezado" width="20%" title="Funcionario que queda encargado para liderar el proceso">LIDER PROCESO*</td>
                     <?php arbol_funcionarios(1,5);?></tr><tr>
                     <td class="encabezado" width="20%" title="Objetivo Principal del Proceso">OBJETIVO*</td>
                     <td class="celda_transparente"><textarea name="objetivo" obligatorio="obligatorio" cols="53" rows="3"><?php echo(validar_valor_campo(7)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Este es el alcance del proceso la delimitacion">ALCANCE*</td>
                     <td class="celda_transparente"><textarea name="alcance" obligatorio="obligatorio" cols="53" rows="3"><?php echo(validar_valor_campo(3)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Secreatraias Vinculadas con el Proceso">SECRETARIAS*</td>
                     <?php arbol_dependencias(1,9);?></tr><input type="hidden" name="idft_proceso" value="<?php echo(validar_valor_campo(10)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(11)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Listado de Anexos  digitales">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input type="file" name="anexos[]" class="multi"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(1,12);?></tr><tr>
                     <td class="encabezado" width="20%" title="Acta que se genera para aprobar el Proceso">ACTA</td>
                     <td class="celda_transparente"><input type="file" name="acta[]" class="multi"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(13)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(14)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(1)); ?>"><?php adicionar_riesgo(1,NULL);?><input type="hidden" name="campo_descripcion" value="4"><tr><td colspan='2'><?php submit_formato(1);?></td></tr></table></form></body></html>