<html><title>.:BUSCAR INDICADOR(ES) DE CALIDAD:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA INDICADOR(ES) DE CALIDAD</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado" id="condicion_estado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Estado">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado" id="compara_estado"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(261,2909,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_dependencia_indicador" id="condicion_dependencia_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Listado de dependencias de la entidad">DEPENDENCIA</td><td class="encabezado">&nbsp;<select name="compara_dependencia_indicador" id="compara_dependencia_indicador"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(261,2910,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Nombre del indicador">NOMBRE DEL INDICADOR</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fuente_datos" id="condicion_fuente_datos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Fuente de datos ">FUENTE DATOS</td><td class="encabezado">&nbsp;<select name="compara_fuente_datos" id="compara_fuente_datos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fuente_datos" name="fuente_datos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fuente_datos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_objetivo_calidad_indicador" id="condicion_objetivo_calidad_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Objetivo del Indicador">OBJETIVO DE CALIDAD DEL INDICADOR</td><td class="encabezado">&nbsp;<select name="compara_objetivo_calidad_indicador" id="compara_objetivo_calidad_indicador"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="objetivo_calidad_indicador" name="objetivo_calidad_indicador"></select><script>
                     $(document).ready(function() 
                      {
                      $("#objetivo_calidad_indicador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_grafico" id="condicion_tipo_grafico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE GR&Aacute;FICO</td><td class="encabezado">&nbsp;<select name="compara_tipo_grafico" id="compara_tipo_grafico"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(261,2914,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_indicador" id="condicion_tipo_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE INDICADOR</td><td class="encabezado">&nbsp;<select name="compara_tipo_indicador" id="compara_tipo_indicador"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(261,2915,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsable_analisis" id="condicion_responsable_analisis"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="Responsable del an&aacute;lisis">RESPONSABLE DEL AN&AACUTE;LISIS</td><td class="encabezado">&nbsp;<select name="compara_responsable_analisis" id="compara_responsable_analisis"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_responsable_analisis"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(261,2916,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable_analisis" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem(htmlentities(document.getElementById('stext_responsable_analisis').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem(htmlentities(document.getElementById('stext_responsable_analisis').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem(htmlentities(document.getElementById('stext_responsable_analisis').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_responsable_analisis" height="90%"></div><input type="hidden" maxlength="2000"  name="responsable_analisis" id="responsable_analisis"   value="" ><label style="display:none" class="error" for="responsable_analisis">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_analisis=new dhtmlXTreeObject("treeboxbox_responsable_analisis","100%","100%",0);
                			tree_responsable_analisis.setImagePath("../../imgs/");
                			tree_responsable_analisis.enableIEImageFix(true);tree_responsable_analisis.enableCheckBoxes(1);
                			tree_responsable_analisis.enableThreeStateCheckboxes(1);tree_responsable_analisis.setOnLoadingStart(cargando_responsable_analisis);
                      tree_responsable_analisis.setOnLoadingEnd(fin_cargando_responsable_analisis);tree_responsable_analisis.enableSmartXMLParsing(true);tree_responsable_analisis.loadXML("../../test.php");
                      tree_responsable_analisis.setOnCheckHandler(onNodeSelect_responsable_analisis);
                      function onNodeSelect_responsable_analisis(nodeId)
                      {valor_destino=document.getElementById("responsable_analisis");
                       destinos=tree_responsable_analisis.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable_analisis.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable_analisis() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_analisis")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_analisis")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_analisis"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_analisis() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_analisis")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_analisis")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_analisis"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><input type="hidden" name="campo_descripcion" value="2911"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(261);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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