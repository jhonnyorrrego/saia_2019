<html><title>.:BUSCAR 3. ACOPIO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 3. ACOPIO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_acopio" id="condicion_tipo_acopio"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">TIPO DE ACOPIO</td><td class="encabezado">&nbsp;<select name="compara_tipo_acopio" id="compara_tipo_acopio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_tipo_acopio"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(322,3766,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_tipo_acopio" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_tipo_acopio" height="90%"></div><input type="hidden" maxlength="11"  name="tipo_acopio" id="tipo_acopio"   value="" ><label style="display:none" class="error" for="tipo_acopio">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_acopio=new dhtmlXTreeObject("treeboxbox_tipo_acopio","100%","100%",0);
                			tree_tipo_acopio.setImagePath("../../imgs/");
                			tree_tipo_acopio.enableIEImageFix(true);tree_tipo_acopio.enableCheckBoxes(1);
                    tree_tipo_acopio.enableRadioButtons(true);tree_tipo_acopio.setOnLoadingStart(cargando_tipo_acopio);
                      tree_tipo_acopio.setOnLoadingEnd(fin_cargando_tipo_acopio);tree_tipo_acopio.enableSmartXMLParsing(true);tree_tipo_acopio.loadXML("../../test_serie.php?tabla=serie&id=1083");
                      tree_tipo_acopio.setOnCheckHandler(onNodeSelect_tipo_acopio);
                      function onNodeSelect_tipo_acopio(nodeId)
                      {valor_destino=document.getElementById("tipo_acopio");
                       destinos=tree_tipo_acopio.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_tipo_acopio.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_tipo_acopio() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_acopio")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_acopio")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_acopio"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_acopio() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_acopio")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_acopio")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_acopio"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_estado_acopio"><td class="encabezado">&nbsp;<select name="condicion_estado_acopio" id="condicion_estado_acopio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO DE ACOPIO</td><td class="encabezado">&nbsp;<select name="compara_estado_acopio" id="compara_estado_acopio"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(322,3772,'',1);?></td></tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(322);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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