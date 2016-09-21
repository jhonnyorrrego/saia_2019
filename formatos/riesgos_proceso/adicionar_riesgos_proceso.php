<html><title>.:ADICIONAR RIESGOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../riesgos_proceso/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RIESGOS</td></tr><input type="hidden" name="riesgo_antiguo" value="<?php echo(validar_valor_campo(4225)); ?>"><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><h1><center><strong>IDENTIFICACI&Oacute;N DEL RIESGO</strong></center></h1></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(363,4227);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_bloqueada(363,4228);?></tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual: ELABORACION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(363,4229,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4230)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO*</td>
                     <?php consecutivo_riesgo(363,4231);?></tr><tr>
                     <td class="encabezado" width="20%" title="Actividad">ACTIVIDAD*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="nombre" id="nombre" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4232)); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="Area responsable">AREA RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(363,4233,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_area_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
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
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test_serie.php?tabla=dependencia");
                	        
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
                     <td class="encabezado" width="20%" title="">RIESGO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="riesgo" id="riesgo" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4234)); ?></textarea></td>
                    </tr><input type="hidden" name="controles" value="<?php echo(validar_valor_campo(4235)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Descripci&oacute;n del riesgo">DESCRIPCI&Oacute;N DEL RIESGO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4236)); ?></textarea></td>
                    </tr><tr id="tr_tipo_riesgo" >
                     <td class="encabezado" width="20%" title="">TIPO DE RIESGO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(363,4237,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Fuente o Causa del Riesgo">FUENTE/CAUSA*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="fuente_causa" id="fuente_causa" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4238)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Consecuencia">CONSECUENCIA O EFECTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="consecuencia" id="consecuencia" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4239)); ?></textarea></td>
                    </tr><input type="hidden" name="opciones_manejo" value="<?php echo(validar_valor_campo(4240)); ?>"><input type="hidden" name="acciones" value="<?php echo(validar_valor_campo(4241)); ?>"><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><h1><center><strong>ANALISIS DE RIESGO</strong></center></h1></td>
                    </tr><input type="hidden" name="responsables" value="<?php echo(validar_valor_campo(4243)); ?>"><tr id="tr_probabilidad" >
                     <td class="encabezado" width="20%" title="Probabilidad">PROBABILIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(363,4244,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="indicador" value="<?php echo(validar_valor_campo(4245)); ?>"><input type="hidden" name="cronograma" value="<?php echo(validar_valor_campo(4246)); ?>"><tr id="tr_impacto" >
                     <td class="encabezado" width="20%" title="Impacto">IMPACTO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(363,4247,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4248)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4249)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4250)); ?>"><input type="hidden" name="idft_riesgos_proceso" value="<?php echo(validar_valor_campo(4251)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proceso);} ?><?php selecion_tipo_riesgo(363,NULL);?><?php validar_edicion_adicion_formatos_riesgo_aprobados(363,NULL);?><?php validar_revision_aprobacion(363,NULL);?><input type="hidden" name="campo_descripcion" value="4234"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(363);?></td></tr></table></form></body></html>