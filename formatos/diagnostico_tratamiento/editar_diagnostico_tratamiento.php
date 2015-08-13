<html><title>.:EDITAR DIAGNOSTICO Y PLAN DE TRATAMIENTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DIAGNOSTICO Y PLAN DE TRATAMIENTO</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(293,3376,$_REQUEST['iddoc']);?></tr><input type="hidden" name="idft_diagnostico_tratamiento" value="<?php echo(mostrar_valor_campo('idft_diagnostico_tratamiento',293,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',293,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',293,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',293,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(293,3379,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL PACIENTE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_diagnosticado" name="nombre_diagnosticado"  value="<?php echo(mostrar_valor_campo('nombre_diagnosticado',293,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2">Esqueletico</td>
                    </tr><tr>
                  <td class="encabezado" width="20%" title="">SNA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3382,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">SNB</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3383,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ANB</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3384,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">MX-MD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3385,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">SNMD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3386,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">WITS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3387,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2">Dental</td>
                    </tr><tr>
                  <td class="encabezado" width="20%" title="">INTERINCISIVO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3389,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">1 - MX</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3390,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">1 - MD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3391,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2">M.E.A.W</td>
                    </tr><tr>
                  <td class="encabezado" width="20%" title="">ODI</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3393,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">APDI</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3394,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">CF</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3395,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2">facial</td>
                    </tr><tr>
                  <td class="encabezado" width="20%" title="">LINEA E SUP</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3397,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">LINEA E INF</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3398,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">FHI - LS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3399,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">< - NL</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3400,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">ORTODONCISTA</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(293,3401,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_ortodoncista" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_ortodoncista"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_ortodoncista" height="90%"></div><input type="hidden" maxlength="11"  name="ortodoncista" id="ortodoncista"   value="<?php cargar_seleccionados(293,3401,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_ortodoncista=new dhtmlXTreeObject("treeboxbox_ortodoncista","100%","100%",0);
                			tree_ortodoncista.setImagePath("../../imgs/");
                			tree_ortodoncista.enableIEImageFix(true);tree_ortodoncista.enableCheckBoxes(1);
                    tree_ortodoncista.enableRadioButtons(true);tree_ortodoncista.setOnLoadingStart(cargando_ortodoncista);
                      tree_ortodoncista.setOnLoadingEnd(fin_cargando_ortodoncista);tree_ortodoncista.enableSmartXMLParsing(true);tree_ortodoncista.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_ortodoncista.setOnCheckHandler(onNodeSelect_ortodoncista);
                      function onNodeSelect_ortodoncista(nodeId)
                      {valor_destino=document.getElementById("ortodoncista");

                       if(tree_ortodoncista.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_ortodoncista.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_ortodoncista() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_ortodoncista")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_ortodoncista")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_ortodoncista"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_ortodoncista() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_ortodoncista")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_ortodoncista")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_ortodoncista"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(293,3401,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_ortodoncista.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">AUXILIAR</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(293,3402,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_auxiliar" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_auxiliar"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_auxiliar" height="90%"></div><input type="hidden" maxlength="255"  name="auxiliar" id="auxiliar"   value="<?php cargar_seleccionados(293,3402,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_auxiliar=new dhtmlXTreeObject("treeboxbox_auxiliar","100%","100%",0);
                			tree_auxiliar.setImagePath("../../imgs/");
                			tree_auxiliar.enableIEImageFix(true);tree_auxiliar.enableCheckBoxes(1);
                    tree_auxiliar.enableRadioButtons(true);tree_auxiliar.setOnLoadingStart(cargando_auxiliar);
                      tree_auxiliar.setOnLoadingEnd(fin_cargando_auxiliar);tree_auxiliar.enableSmartXMLParsing(true);tree_auxiliar.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_auxiliar.setOnCheckHandler(onNodeSelect_auxiliar);
                      function onNodeSelect_auxiliar(nodeId)
                      {valor_destino=document.getElementById("auxiliar");

                       if(tree_auxiliar.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_auxiliar.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_auxiliar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_auxiliar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_auxiliar")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_auxiliar"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_auxiliar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_auxiliar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_auxiliar")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_auxiliar"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(293,3402,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_auxiliar.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ESQUELETICO</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="esqueletico" id="esqueletico" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('esqueletico',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OCLUSAL</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="oclusal" id="oclusal" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('oclusal',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DENTAL</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="dental" id="dental" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('dental',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEJIDOS BLANDOS</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="tejido_blando" id="tejido_blando" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('tejido_blando',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FUNCIONAL</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="funcional" id="funcional" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('funcional',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PLAN DE TRATAMIENTO</td>
                     <td class="celda_transparente"><textarea  tabindex='9'  name="plan_tratamiento" id="plan_tratamiento" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('plan_tratamiento',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">RE-EVALUACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='10'  name="re_evaluaciones" id="re_evaluaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('re_evaluaciones',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">RETENCI&Oacute;N</td>
                     <td class="celda_transparente"><textarea  tabindex='11'  name="retencion" id="retencion" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('retencion',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                  <td class="encabezado" width="20%" title="">PLAN PREVENTIVO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3436,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">EXT. SERIADA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3437,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ORTOPEDIA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3438,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ORTOPEDIA Y ORTODONCIA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3439,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">OTRO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3440,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ORTODONCIA 1/2 CASO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3441,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ORTODONCIA NO COMPLICADA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3442,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ORTODONCIA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3443,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">ORTODONCIA Y CIRUGIA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3444,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">OTRO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3445,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">REMISIONES PARA PROCEDIMIENTOS ESPECIALIZADOS</td>
                     <td class="celda_transparente"><textarea  tabindex='12'  name="remision_procedimiento" id="remision_procedimiento" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('remision_procedimiento',293,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><?php cargar_diagnosticado(293,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3380'); ?>"><input type="hidden" name="formato" value="293"><tr><td colspan='2'><?php submit_formato(293,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>