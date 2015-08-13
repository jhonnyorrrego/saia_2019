<html><title>.:BUSCAR FUNCIONARIOS AUSENTES:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA FUNCIONARIOS AUSENTES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_funcionario_ausente" id="condicion_funcionario_ausente"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">FUNCIONARIO AUSENTE</td><td class="encabezado">&nbsp;<select name="compara_funcionario_ausente" id="compara_funcionario_ausente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_funcionario_ausente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(310,3651,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_funcionario_ausente" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_funcionario_ausente" height="90%"></div><input type="hidden" maxlength="255"  name="funcionario_ausente" id="funcionario_ausente"   value="" ><label style="display:none" class="error" for="funcionario_ausente">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_funcionario_ausente=new dhtmlXTreeObject("treeboxbox_funcionario_ausente","100%","100%",0);
                			tree_funcionario_ausente.setImagePath("../../imgs/");
                			tree_funcionario_ausente.enableIEImageFix(true);tree_funcionario_ausente.enableCheckBoxes(1);
                    tree_funcionario_ausente.enableRadioButtons(true);tree_funcionario_ausente.setOnLoadingStart(cargando_funcionario_ausente);
                      tree_funcionario_ausente.setOnLoadingEnd(fin_cargando_funcionario_ausente);tree_funcionario_ausente.enableSmartXMLParsing(true);tree_funcionario_ausente.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_funcionario_ausente.setOnCheckHandler(onNodeSelect_funcionario_ausente);
                      function onNodeSelect_funcionario_ausente(nodeId)
                      {valor_destino=document.getElementById("funcionario_ausente");
                       destinos=tree_funcionario_ausente.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_funcionario_ausente.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_funcionario_ausente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario_ausente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario_ausente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_funcionario_ausente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_funcionario_ausente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario_ausente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario_ausente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_funcionario_ausente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_justificada" id="condicion_justificada"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">AUSENCIA JUSTIFICADA</td><td class="encabezado">&nbsp;<select name="compara_justificada" id="compara_justificada"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(310,3652,'',1);?></td></tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="ausentes_acta"><?php submit_formato(310);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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