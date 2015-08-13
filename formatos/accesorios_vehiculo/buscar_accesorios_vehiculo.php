<html><title>.:BUSCAR ACCESORIOS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ACCESORIOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_accesorio_vehiculo" id="condicion_accesorio_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ACCESORIOS</td><td class="encabezado">&nbsp;<select name="compara_accesorio_vehiculo" id="compara_accesorio_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_accesorio_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(259,2946,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_accesorio_vehiculo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_accesorio_vehiculo" height="90%"></div><input type="hidden" maxlength="255"  name="accesorio_vehiculo" id="accesorio_vehiculo"   value="" ><label style="display:none" class="error" for="accesorio_vehiculo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_accesorio_vehiculo=new dhtmlXTreeObject("treeboxbox_accesorio_vehiculo","100%","100%",0);
                			tree_accesorio_vehiculo.setImagePath("../../imgs/");
                			tree_accesorio_vehiculo.enableIEImageFix(true);tree_accesorio_vehiculo.enableCheckBoxes(1);
                    tree_accesorio_vehiculo.enableRadioButtons(true);tree_accesorio_vehiculo.setOnLoadingStart(cargando_accesorio_vehiculo);
                      tree_accesorio_vehiculo.setOnLoadingEnd(fin_cargando_accesorio_vehiculo);tree_accesorio_vehiculo.enableSmartXMLParsing(true);tree_accesorio_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=942&tabla=serie");
                      tree_accesorio_vehiculo.setOnCheckHandler(onNodeSelect_accesorio_vehiculo);
                      function onNodeSelect_accesorio_vehiculo(nodeId)
                      {valor_destino=document.getElementById("accesorio_vehiculo");
                       destinos=tree_accesorio_vehiculo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_accesorio_vehiculo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_accesorio_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_accesorio_vehiculo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_accesorio_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_accesorio_vehiculo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_accesorio" id="condicion_valor_accesorio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DEL ACCESORIO</td><td class="encabezado">&nbsp;<select name="compara_valor_accesorio" id="compara_valor_accesorio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_accesorio" name="valor_accesorio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_accesorio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2946"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="accesorios_vehiculo"><?php submit_formato(259);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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