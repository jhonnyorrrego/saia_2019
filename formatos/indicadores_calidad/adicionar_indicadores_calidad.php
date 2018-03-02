<html><title>.:ADICIONAR INDICADOR(ES) DE CALIDAD:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INDICADOR(ES) DE CALIDAD</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(487,6180);?></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(6181)); ?>"><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6182,$_REQUEST['iddoc']);?></td></tr><tr id="tr_dependencia_indicador">
                     <td class="encabezado" width="20%" title="Listado de dependencias de la entidad">DEPENDENCIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6183,$_REQUEST['iddoc']);?></td></tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Nombre del indicador">NOMBRE DEL INDICADOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(6184)); ?>"></td>
                    </tr><tr id="tr_fuente_datos">
                     <td class="encabezado" width="20%" title="Fuente de datos ">FUENTE DATOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="fuente_datos" id="fuente_datos" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(6185)); ?></textarea></td>
                    </tr><tr id="tr_objetivo_calidad_indicador">
                     <td class="encabezado" width="20%" title="Objetivo del Indicador">OBJETIVO DE CALIDAD DEL INDICADOR*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="objetivo_calidad_indicador" id="objetivo_calidad_indicador" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(6186)); ?></textarea></td>
                    </tr><tr id="tr_tipo_grafico" >
                     <td class="encabezado" width="20%" title="">TIPO DE GR&Aacute;FICO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6187,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo_indicador" >
                     <td class="encabezado" width="20%" title="">TIPO DE INDICADOR</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(487,6188,$_REQUEST['iddoc']);?></td></tr><tr id="tr_responsable_analisis">
                   <td class="encabezado" width="20%" title="Responsable del an&aacute;lisis">RESPONSABLE DEL AN&Aacute;LISIS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(487,6189,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_responsable_analisis" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem((document.getElementById('stext_responsable_analisis').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem((document.getElementById('stext_responsable_analisis').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable_analisis.findItem((document.getElementById('stext_responsable_analisis').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable_analisis"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable_analisis" height="90%"></div><input type="hidden" maxlength="2000"  class="required"  name="responsable_analisis" id="responsable_analisis"   value="" ><label style="display:none" class="error" for="responsable_analisis">Campo obligatorio.</label><script type="text/javascript">
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
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable_analisis.getAllSubItems(vector[i]);
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
                        document.poppedLayer.style.display = "none";
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
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(6190)); ?>"><input type="hidden" name="idft_indicadores_calidad" value="<?php echo(validar_valor_campo(6191)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proceso);} ?><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(6193)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(6194)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(6195)); ?>"><input type="hidden" name="campo_descripcion" value="6184"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(487);?></td></tr></table></form></body>
              <script type="text/javascript">
              setInterval("auto_save('fuente_datos,objetivo_calidad_indicador','indicadores_calidad')",300000);
              </script></html>