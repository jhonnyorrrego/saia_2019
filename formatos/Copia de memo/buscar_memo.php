<html><title>.:BUSCAR MEMORANDO:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/><?php include_once("../librerias/header_formato.php"); ?></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA MEMORANDO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_destino" id="condicion_destino"><option value="AND">Y</option><option value="OR">O</option></td><td class="encabezado" width="20%" title="">DESTINO</td><td class="encabezado">&nbsp;<select name="compara_destino" id="compara_destino"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><?php arbol_funcionarios(3,46,'',1);?></tr><tr><td class="encabezado">&nbsp;<select name="condicion_contenido" id="condicion_contenido"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONTENIDO</td><td class="encabezado">&nbsp;<select name="compara_contenido" id="compara_contenido"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="contenido" name="contenido"></select><script>
                     $(document).ready(function() 
                      {
                      $("#contenido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia" id="condicion_copia"><option value="AND">Y</option><option value="OR">O</option></td><td class="encabezado" width="20%" title="">CON COPIA A</td><td class="encabezado">&nbsp;<select name="compara_copia" id="compara_copia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><?php arbol_funcionarios(3,47,'',1);?></tr><tr><td class="encabezado">&nbsp;<select name="condicion_mostrar_dependencia" id="condicion_mostrar_dependencia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MOSTRAR DEPENDENCIA AL FIRMAR</td><td class="encabezado">&nbsp;<select name="compara_mostrar_dependencia" id="compara_mostrar_dependencia"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,929,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="campo_descripcion" value="48"><?php submit_formato(3);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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