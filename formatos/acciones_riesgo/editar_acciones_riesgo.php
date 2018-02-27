<html><title>.:EDITAR 2. ACCIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../riesgos_proceso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">2. ACCIONES</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(501,6411,$_REQUEST['iddoc']);?></tr><tr id="tr_acciones_accion">
                     <td class="encabezado" width="20%" title="">ACCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="acciones_accion" id="acciones_accion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('acciones_accion',501,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_acciones_control">
                     <td class="encabezado" width="20%" title="Control:

Si va a establecer una Acci&oacute;n sobre un control existente por favor seleccionelo de la lista desplegable. Si se requiere un Nuevo Control, favor seleccione esta opci&oacute;n.">CONTROL*</td>
                     <?php control_funcion(501,6415,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha_accion">
                       <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCION DE LA ACCION*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_accion" id="fecha_accion" tipo="fecha" value="<?php mostrar_valor_campo('fecha_accion',501,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_accion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_fecha_cumplimiento">
                       <td class="encabezado" width="20%" title="">FECHA DE CUMPLIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_cumplimiento" id="fecha_cumplimiento" tipo="fecha" value="<?php mostrar_valor_campo('fecha_cumplimiento',501,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_cumplimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_indicador">
                     <td class="encabezado" width="20%" title="Indicador:

Resultados obtenidos en la medici&oacute;n del indicador, para evaluar el cumplimiento de las acciones de control.">INDICADOR*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="indicador" id="indicador" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('indicador',501,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_opcio_admin_riesgo" >
                     <td class="encabezado" width="20%" title="Evitar el riesgo, tomar las medidas encaminadas a prevenir su materializaci&oacute;n.
Es siempre la primera alternativa a considerar, se logra cuando al interior de los procesos se generan cambios sustanciales por mejoramiento, redise&ntilde;o o eliminaci&oacute;n, resultado de unos adecuados controles y acciones emprendidas.

Por ejemplo: el control de calidad, manejo de los insumos, mantenimiento preventivo de los equipos, desarrollo tecnol&oacute;gico, etc.

Reducir el riesgo, implica tomar medidas encaminadas a disminuir tanto la probabilidad (medidas de prevenci&oacute;n), como el impacto (medidas de protecci&oacute;n). La reducci&oacute;n del riesgo es probablemente el m&eacute;todo m&aacute;s sencillo y econ&oacute;mico para superar las debilidades antes de aplicar medidas m&aacute;s costosas y dif&iacute;ciles. Por ejemplo: a trav&eacute;s de la optimizaci&oacute;n de los procedimientos y la implementaci&oacute;n de controles.
 
Compartir o transferir el riesgo, reduce su efecto a trav&eacute;s del traspaso de las p&eacute;rdidas a otras organizaciones, como en el caso de los contratos de seguros o a trav&eacute;s de otros medios que permiten distribuir una porci&oacute;n del riesgo con otra entidad, como en los contratos a riesgo compartido. Por ejemplo, la informaci&oacute;n de gran importancia se puede duplicar y almacenar en un lugar distante y de ubicaci&oacute;n segura, en vez de dejarla concentrada en un solo lugar, la tercerizaci&oacute;n.
 
Asumir un riesgo, luego de que el riesgo ha sido reducido o transferido puede quedar un riesgo residual que se mantiene, en este caso, el gerente del proceso simplemente acepta la p&eacute;rdida residual probable y elabora planes de contingencia para su manejo.
   Dicha selecci&oacute;n implica equilibrar los costos y los esfuerzos para su      implementaci&oacute;n, as&iacute; como los beneficios finales, por lo tanto, se          deber&aacute; considerar los siguientes aspectos como:

   * Viabilidad jur&iacute;dica.
   * Viabilidad t&eacute;cnica.
   * Viabilidad institucional.
   * Viabilidad financiera o econ&oacute;mica.
   * An&aacute;lisis de costo-beneficio.">OPCIONES ADMINISTRACION DEL RIESGO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(501,6419,$_REQUEST['iddoc']);?></td></tr><tr id="tr_reponsables">
                   <td class="encabezado" width="20%" title="Responsables:

Seleccione el funcionario responsable de adelantar las acciones de control.">RESPONSABLES*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(501,6420,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_reponsables" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_reponsables.findItem((document.getElementById('stext_reponsables').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_reponsables.findItem((document.getElementById('stext_reponsables').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_reponsables.findItem((document.getElementById('stext_reponsables').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_reponsables"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_reponsables" height="90%"></div><input type="hidden"  class="required"  name="reponsables" id="reponsables"   value="<?php cargar_seleccionados(501,6420,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_reponsables=new dhtmlXTreeObject("treeboxbox_reponsables","100%","100%",0);
                			tree_reponsables.setImagePath("../../imgs/");
                			tree_reponsables.enableIEImageFix(true);tree_reponsables.enableCheckBoxes(1);
                			tree_reponsables.enableThreeStateCheckboxes(1);tree_reponsables.setOnLoadingStart(cargando_reponsables);
                      tree_reponsables.setOnLoadingEnd(fin_cargando_reponsables);tree_reponsables.enableSmartXMLParsing(true);tree_reponsables.loadXML("../../test.php",checkear_arbol);
                	        
                      tree_reponsables.setOnCheckHandler(onNodeSelect_reponsables);
                      function onNodeSelect_reponsables(nodeId)
                      {valor_destino=document.getElementById("reponsables");
                       destinos=tree_reponsables.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_reponsables.getAllSubItems(vector[i]);
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
                      function fin_cargando_reponsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_reponsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_reponsables")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_reponsables"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_reponsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_reponsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_reponsables")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_reponsables"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(501,6420,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_reponsables.setCheck(vector2[m],true);
                    }}
--></script></td></tr><input type="hidden" name="idft_acciones_riesgo" value="<?php echo(mostrar_valor_campo('idft_acciones_riesgo',501,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',501,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',501,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',501,$_REQUEST['iddoc'])); ?>"><?php validar_edicion_adicion_formatos_riesgo_aprobados(501,NULL,$_REQUEST['iddoc']);?><?php validar_opciones_administrativas(501,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6414'); ?>"><input type="hidden" name="formato" value="501"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(501,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>