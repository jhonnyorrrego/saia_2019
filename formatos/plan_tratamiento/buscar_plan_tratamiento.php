<html><title>.:BUSCAR 3. PLAN DE TRATAMIENTO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 3. PLAN DE TRATAMIENTO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_plan_diagnostico" id="condicion_plan_diagnostico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DIAGNOSTICO</td><td class="encabezado">&nbsp;<select name="compara_plan_diagnostico" id="compara_plan_diagnostico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="plan_diagnostico" name="plan_diagnostico"></select><script>
                     $(document).ready(function() 
                      {
                      $("#plan_diagnostico").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_plan_tratamiento" id="condicion_valor_plan_tratamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DEL TRATAMIENTO</td><td class="encabezado">&nbsp;<select name="compara_valor_plan_tratamiento" id="compara_valor_plan_tratamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_plan_tratamiento" name="valor_plan_tratamiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_plan_tratamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_paciente_tratamiento" id="condicion_paciente_tratamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PACIENTE O ACUDIENTE</td><td class="encabezado">&nbsp;<select name="compara_paciente_tratamiento" id="compara_paciente_tratamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="paciente_tratamiento" name="paciente_tratamiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#paciente_tratamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_documento_paciente" id="condicion_documento_paciente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DOCUMENTO DE IDENTIDAD</td><td class="encabezado">&nbsp;<select name="compara_documento_paciente" id="compara_documento_paciente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="documento_paciente" name="documento_paciente"></select><script>
                     $(document).ready(function() 
                      {
                      $("#documento_paciente").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_odontologo_tratamiento" id="condicion_odontologo_tratamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ODONTOLOGO</td><td class="encabezado">&nbsp;<select name="compara_odontologo_tratamiento" id="compara_odontologo_tratamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_odontologo_tratamiento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(295,3428,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_odontologo_tratamiento" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_odontologo_tratamiento" height="90%"></div><input type="hidden" maxlength="255"  name="odontologo_tratamiento" id="odontologo_tratamiento"   value="" ><label style="display:none" class="error" for="odontologo_tratamiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_odontologo_tratamiento=new dhtmlXTreeObject("treeboxbox_odontologo_tratamiento","100%","100%",0);
                			tree_odontologo_tratamiento.setImagePath("../../imgs/");
                			tree_odontologo_tratamiento.enableIEImageFix(true);tree_odontologo_tratamiento.enableCheckBoxes(1);
                    tree_odontologo_tratamiento.enableRadioButtons(true);tree_odontologo_tratamiento.setOnLoadingStart(cargando_odontologo_tratamiento);
                      tree_odontologo_tratamiento.setOnLoadingEnd(fin_cargando_odontologo_tratamiento);tree_odontologo_tratamiento.enableSmartXMLParsing(true);tree_odontologo_tratamiento.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_odontologo_tratamiento.setOnCheckHandler(onNodeSelect_odontologo_tratamiento);
                      function onNodeSelect_odontologo_tratamiento(nodeId)
                      {valor_destino=document.getElementById("odontologo_tratamiento");
                       destinos=tree_odontologo_tratamiento.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_odontologo_tratamiento.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_odontologo_tratamiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_odontologo_tratamiento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_odontologo_tratamiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_odontologo_tratamiento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_registro_tratamiento" id="condicion_registro_tratamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE REGISTRO</td><td class="encabezado">&nbsp;<select name="compara_registro_tratamiento" id="compara_registro_tratamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="registro_tratamiento" name="registro_tratamiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#registro_tratamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3426,3429"><?php submit_formato(295);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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