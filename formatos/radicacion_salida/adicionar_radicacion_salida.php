<html><title>.:ADICIONAR SALIDA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SALIDA</td></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5190)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(207,2199);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA DE RADICACION*</td>
                     <?php fecha_formato(207,2194);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NUMERO DE RADICADO</td>
                     <?php mostrar_radicado_salida(207,2195);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2200)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2201)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(207,2196,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_area_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_area_responsable" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
                			tree_area_responsable.setImagePath("../../imgs/");
                			tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                			tree_area_responsable.enableThreeStateCheckboxes(1);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?rol=1");
                	        
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_area_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="Salida">TIPO DE DOCUMENTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(207,2188,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_serie_idserie"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_serie_idserie" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="serie_idserie" id="serie_idserie"   value="" ><label style="display:none" class="error" for="serie_idserie">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie_idserie=new dhtmlXTreeObject("treeboxbox_serie_idserie","100%","100%",0);
                			tree_serie_idserie.setImagePath("../../imgs/");
                			tree_serie_idserie.enableIEImageFix(true);tree_serie_idserie.enableCheckBoxes(1);
                    tree_serie_idserie.enableRadioButtons(true);tree_serie_idserie.setOnLoadingStart(cargando_serie_idserie);
                      tree_serie_idserie.setOnLoadingEnd(fin_cargando_serie_idserie);tree_serie_idserie.enableSmartXMLParsing(true);tree_serie_idserie.loadXML("../../test_serie_funcionario.php");
                	        tree_serie_idserie.setOnCheckHandler(onNodeSelect_serie_idserie);
                      function onNodeSelect_serie_idserie(nodeId)
                      {valor_destino=document.getElementById("serie_idserie");

                       if(tree_serie_idserie.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_serie_idserie.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_serie_idserie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_idserie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_idserie")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie_idserie"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_serie_idserie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_idserie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_idserie")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie_idserie"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2198)); ?>"><input type="hidden" name="idft_radicacion_salida" value="<?php echo(validar_valor_campo(2197)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">PERSONA NATURAL O JUR&Iacute;DICA*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="persona_natural" id="persona_natural" value=""><?php componente_ejecutor("2190",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION O ASUNTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion_salida" id="descripcion_salida" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(validar_valor_campo(2191)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NUMERO DE FOLIOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="1000"  tabindex='4'  type="input" id="num_folios" name="num_folios"  value="<?php echo(validar_valor_campo(4083)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#num_folios").spin({imageBasePath:'../../images/',min:0,max:1000,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(207,2189,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION ANEXOS FISICOS</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="descripcion_anexos" id="descripcion_anexos" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(validar_valor_campo(2192)); ?></textarea></td>
                    </tr><tr id="tr_tipo_mensajeria" >
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJERIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(207,2202,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MENSAJEROS</td>
                     <?php mostrar_mensajeros(207,2203);?></tr><input type="hidden" name="estado_radicado" value="<?php echo(validar_valor_campo(2193)); ?>"><?php digitalizacion_formato_salida(207,NULL);?><input type="hidden" name="campo_descripcion" value="2191"><tr><td colspan='2'><?php submit_formato(207);?></td></tr></table></form></body></html>