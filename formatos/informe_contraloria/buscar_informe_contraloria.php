<html><title>.:BUSCAR INFORME SEGUIMIENTO:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA INFORME SEGUIMIENTO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_municipio_informe" id="condicion_municipio_informe"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MUNICIPIO</td><td class="encabezado">&nbsp;<select name="compara_municipio_informe" id="compara_municipio_informe"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="municipio_informe" name="municipio_informe"></select><script>
                     $(document).ready(function() 
                      {
                      $("#municipio_informe").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_compromisos" id="condicion_fecha_compromisos"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE SEGUIMIENTO A COMPROMISOS</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_compromisos_1" id="fecha_compromisos_1" tipo="fecha" value=""><?php selector_fecha("fecha_compromisos_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_compromisos_2" id="fecha_compromisos_2" tipo="fecha" value=""><?php selector_fecha("fecha_compromisos_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_proceso_auditado" id="condicion_proceso_auditado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROCESO AUDITADO</td><td class="encabezado">&nbsp;<select name="compara_proceso_auditado" id="compara_proceso_auditado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="proceso_auditado" name="proceso_auditado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#proceso_auditado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cumplimiento_general" id="condicion_cumplimiento_general"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CUMPLIMIENTO DEL OBJETIVO GENERAL DEL PLAN</td><td class="encabezado">&nbsp;<select name="compara_cumplimiento_general" id="compara_cumplimiento_general"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cumplimiento_general" name="cumplimiento_general"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cumplimiento_general").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cumplimiento_especificos" id="condicion_cumplimiento_especificos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CUMPLIMIENTO DE LOS OBJETIVOS ESPECIFICOS</td><td class="encabezado">&nbsp;<select name="compara_cumplimiento_especificos" id="compara_cumplimiento_especificos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cumplimiento_especificos" name="cumplimiento_especificos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cumplimiento_especificos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cumplimiento_plan" id="condicion_cumplimiento_plan"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PORCENTAJE DE CUMPLIMIENTO DEL PLAN</td><td class="encabezado">&nbsp;<select name="compara_cumplimiento_plan" id="compara_cumplimiento_plan"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cumplimiento_plan" name="cumplimiento_plan"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cumplimiento_plan").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_conclusiones" id="condicion_conclusiones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONCLUSIONES</td><td class="encabezado">&nbsp;<select name="compara_conclusiones" id="compara_conclusiones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="conclusiones" name="conclusiones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#conclusiones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_jefe_control" id="condicion_jefe_control"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">JEFE DE CONTROL INTERNO</td><td class="encabezado">&nbsp;<select name="compara_jefe_control" id="compara_jefe_control"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_jefe_control"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(257,2864,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_jefe_control" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_jefe_control.findItem(htmlentities(document.getElementById('stext_jefe_control').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_jefe_control.findItem(htmlentities(document.getElementById('stext_jefe_control').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_jefe_control.findItem(htmlentities(document.getElementById('stext_jefe_control').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_jefe_control" height="90%"></div><input type="hidden" maxlength="255"  name="jefe_control" id="jefe_control"   value="" ><label style="display:none" class="error" for="jefe_control">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_jefe_control=new dhtmlXTreeObject("treeboxbox_jefe_control","100%","100%",0);
                			tree_jefe_control.setImagePath("../../imgs/");
                			tree_jefe_control.enableIEImageFix(true);tree_jefe_control.enableCheckBoxes(1);
                    tree_jefe_control.enableRadioButtons(true);tree_jefe_control.setOnLoadingStart(cargando_jefe_control);
                      tree_jefe_control.setOnLoadingEnd(fin_cargando_jefe_control);tree_jefe_control.enableSmartXMLParsing(true);tree_jefe_control.loadXML("../../test.php?sin_padre=1");
                      tree_jefe_control.setOnCheckHandler(onNodeSelect_jefe_control);
                      function onNodeSelect_jefe_control(nodeId)
                      {valor_destino=document.getElementById("jefe_control");
                       destinos=tree_jefe_control.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_jefe_control.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_jefe_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_control")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_jefe_control"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_jefe_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_control")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_jefe_control"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><input type="hidden" name="campo_descripcion" value="2855"><?php submit_formato(257);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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