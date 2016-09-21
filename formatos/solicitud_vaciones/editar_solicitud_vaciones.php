<html><title>.:EDITAR SOLICITUD DE VACACIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE VACACIONES</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',216,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(216,2307,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(216,2297,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_gestio_humana" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_gestio_humana"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_gestio_humana" height="90%"></div><input type="hidden"  class="required"  name="gestio_humana" id="gestio_humana"   value="<?php cargar_seleccionados(216,2297,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gestio_humana=new dhtmlXTreeObject("treeboxbox_gestio_humana","100%","100%",0);
                			tree_gestio_humana.setImagePath("../../imgs/");
                			tree_gestio_humana.enableIEImageFix(true);tree_gestio_humana.enableCheckBoxes(1);
                    tree_gestio_humana.enableRadioButtons(true);tree_gestio_humana.setOnLoadingStart(cargando_gestio_humana);
                      tree_gestio_humana.setOnLoadingEnd(fin_cargando_gestio_humana);tree_gestio_humana.enableSmartXMLParsing(true);tree_gestio_humana.loadXML("../../test.php?rol=1&iddependencia=40",checkear_arbol);
                	        tree_gestio_humana.setOnCheckHandler(onNodeSelect_gestio_humana);
                      function onNodeSelect_gestio_humana(nodeId)
                      {valor_destino=document.getElementById("gestio_humana");

                       if(tree_gestio_humana.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_gestio_humana.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_gestio_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestio_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestio_humana")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gestio_humana"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_gestio_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestio_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestio_humana")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gestio_humana"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(216,2297,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_gestio_humana.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA DOCUMENTO*</td>
                     <?php fecha_formato(216,2318,$_REQUEST['iddoc']);?></tr><tr>
                       <td class="encabezado" width="20%" title="">INICIO DE VACACIONES*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_ini_vacaciones" id="fecha_ini_vacaciones" tipo="fecha" value="<?php mostrar_valor_campo('fecha_ini_vacaciones',216,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_ini_vacaciones","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FIN DE LAS VACACIONES*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_fin_vaciones" id="fecha_fin_vaciones" tipo="fecha" value="<?php mostrar_valor_campo('fecha_fin_vaciones',216,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_fin_vaciones","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA INICIO DE LABORES*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='4'  type="text" readonly="true"  class="required dateISO"  name="fecha_ini_labores" id="fecha_ini_labores" tipo="fecha" value="<?php mostrar_valor_campo('fecha_ini_labores',216,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_ini_labores","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',216,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_solicitud_vaciones" value="<?php echo(mostrar_valor_campo('idft_solicitud_vaciones',216,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',216,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('2297'); ?>"><input type="hidden" name="formato" value="216"><tr><td colspan='2'><?php submit_formato(216,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>