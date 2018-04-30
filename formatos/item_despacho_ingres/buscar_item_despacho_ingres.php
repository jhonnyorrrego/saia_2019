<html><title>.:BUSCAR ITEM DESPACHO INGRESADOS:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ITEM DESPACHO INGRESADOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ft_destino_radicacio" id="condicion_ft_destino_radicacio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="idft de la tabla ft_destino_radicacion">DESTINO RADICACION</td><td class="encabezado">&nbsp;<select name="compara_ft_destino_radicacio" id="compara_ft_destino_radicacio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ft_destino_radicacio" name="ft_destino_radicacio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ft_destino_radicacio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_despacho_ingres"><?php submit_formato(407);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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