<html><title>.:BUSCAR PROGRAMAS:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PROGRAMAS</td></tr><tr id="tr_origen_documento"><td class="encabezado">&nbsp;<select name="condicion_origen_documento" id="condicion_origen_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORIGEN DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_origen_documento" id="compara_origen_documento"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(497,6582,'',1);?></td></tr><tr id="tr_nombre"><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="nombre">NOMBRE</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado"><td class="encabezado">&nbsp;<select name="condicion_estado" id="condicion_estado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="estado">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado" id="compara_estado"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(497,6322,'',1);?></td></tr><tr id="tr_anexos_fisicos"><td class="encabezado">&nbsp;<select name="condicion_anexos_fisicos" id="condicion_anexos_fisicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SOPORTE</td><td class="encabezado">&nbsp;<select name="compara_anexos_fisicos" id="compara_anexos_fisicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos" name="anexos_fisicos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_fisicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6321"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(497);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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