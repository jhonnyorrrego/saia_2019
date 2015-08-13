<html><title>.:BUSCAR PRUEBA:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PRUEBA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_roles" id="condicion_roles"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ROLES</td><td class="encabezado">&nbsp;<select name="compara_roles" id="compara_roles"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_roles"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(244,3819,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_roles" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_roles" height="90%"></div><input type="hidden" maxlength="11"  name="roles" id="roles"   value="" ><label style="display:none" class="error" for="roles">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_roles=new dhtmlXTreeObject("treeboxbox_roles","100%","100%",0);
                			tree_roles.setImagePath("../../imgs/");
                			tree_roles.enableIEImageFix(true);tree_roles.enableCheckBoxes(1);
                			tree_roles.enableThreeStateCheckboxes(1);tree_roles.setOnLoadingStart(cargando_roles);
                      tree_roles.setOnLoadingEnd(fin_cargando_roles);tree_roles.enableSmartXMLParsing(true);tree_roles.loadXML("../../test.php?rol=1");
                      tree_roles.setOnCheckHandler(onNodeSelect_roles);
                      function onNodeSelect_roles(nodeId)
                      {valor_destino=document.getElementById("roles");
                       destinos=tree_roles.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_roles.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_roles() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_roles")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_roles")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_roles"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_roles() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_roles")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_roles")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_roles"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_sexo_funcionario"><td class="encabezado">&nbsp;<select name="condicion_sexo_funcionario" id="condicion_sexo_funcionario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SEXO</td><td class="encabezado">&nbsp;<select name="compara_sexo_funcionario" id="compara_sexo_funcionario"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(244,3820,'',1);?></td></tr><?php submit_formato(244);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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