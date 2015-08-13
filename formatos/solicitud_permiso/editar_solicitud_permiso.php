<html><title>.:EDITAR SOLICITUD DE PERMISOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.clock.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE PERMISOS</td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',215,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',215,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_solicitud_permiso" value="<?php echo(mostrar_valor_campo('idft_solicitud_permiso',215,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',215,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(215,2293,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">GESTION HUMANA</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(215,2285,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_gestion_humana" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_gestion_humana"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_gestion_humana" height="90%"></div><input type="hidden" maxlength="255"  name="gestion_humana" id="gestion_humana"   value="<?php cargar_seleccionados(215,2285,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gestion_humana=new dhtmlXTreeObject("treeboxbox_gestion_humana","100%","100%",0);
                			tree_gestion_humana.setImagePath("../../imgs/");
                			tree_gestion_humana.enableIEImageFix(true);tree_gestion_humana.enableCheckBoxes(1);
                    tree_gestion_humana.enableRadioButtons(true);tree_gestion_humana.setOnLoadingStart(cargando_gestion_humana);
                      tree_gestion_humana.setOnLoadingEnd(fin_cargando_gestion_humana);tree_gestion_humana.enableSmartXMLParsing(true);tree_gestion_humana.loadXML("../../test.php?rol=1&iddependencia=50",checkear_arbol);
                	        tree_gestion_humana.setOnCheckHandler(onNodeSelect_gestion_humana);
                      function onNodeSelect_gestion_humana(nodeId)
                      {valor_destino=document.getElementById("gestion_humana");

                       if(tree_gestion_humana.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_gestion_humana.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_gestion_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestion_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestion_humana")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gestion_humana"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_gestion_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestion_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestion_humana")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gestion_humana"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(215,2285,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_gestion_humana.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHAS SOLICITUD*</td>
                     <?php fecha_formato(215,2316,$_REQUEST['iddoc']);?></tr><tr>
                    <td class="encabezado" width="20%" title="">FECHA Y HORA DE LA CITA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='2'  type="text" readonly="true" name="fecha_hora_cita"  class="required dateISO"  id="fecha_hora_cita" value="<?php mostrar_valor_campo('fecha_hora_cita',215,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_hora_cita","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">MOTIVO DE PERMISO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(215,2289,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_motivo_permiso" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_motivo_permiso"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_motivo_permiso" height="90%"></div><input type="hidden" maxlength="11"  name="motivo_permiso" id="motivo_permiso"   value="<?php cargar_seleccionados(215,2289,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_motivo_permiso=new dhtmlXTreeObject("treeboxbox_motivo_permiso","100%","100%",0);
                			tree_motivo_permiso.setImagePath("../../imgs/");
                			tree_motivo_permiso.enableIEImageFix(true);tree_motivo_permiso.enableCheckBoxes(1);
                    tree_motivo_permiso.enableRadioButtons(true);tree_motivo_permiso.setOnLoadingStart(cargando_motivo_permiso);
                      tree_motivo_permiso.setOnLoadingEnd(fin_cargando_motivo_permiso);tree_motivo_permiso.enableSmartXMLParsing(true);tree_motivo_permiso.loadXML("../../test_serie_funcionario.php?categoria=3&id=856",checkear_arbol);
                	        tree_motivo_permiso.setOnCheckHandler(onNodeSelect_motivo_permiso);
                      function onNodeSelect_motivo_permiso(nodeId)
                      {valor_destino=document.getElementById("motivo_permiso");

                       if(tree_motivo_permiso.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_motivo_permiso.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_motivo_permiso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_motivo_permiso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_motivo_permiso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_motivo_permiso"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_motivo_permiso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_motivo_permiso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_motivo_permiso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_motivo_permiso"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(215,2289,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_motivo_permiso.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='4'  type="text" size="100" id="motivo_otro" name="motivo_otro"  value="<?php echo(mostrar_valor_campo('motivo_otro',215,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                    <td class="encabezado" width="20%" title="">HORA ENTRADA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='5'  type="text"  name="hora_entrada"  class="required"  id="hora_entrada" value="<?php mostrar_valor_campo('hora_entrada',215,$_REQUEST['iddoc']); ?>"></span></font><script type="text/javascript">
                      $(function(){
                        var now = $('#hora_entrada').val();
                        vector=now.split(":");
                        var h=vector[0];
                        var m=vector[1];
                        var s=0;

                        $('#hora_entrada').clock({displayFormat:'24',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script></td><tr>
                    <td class="encabezado" width="20%" title="">HORA DE SALIDA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='6'  type="text"  name="hora_salida"  class="required"  id="hora_salida" value="<?php mostrar_valor_campo('hora_salida',215,$_REQUEST['iddoc']); ?>"></span></font><script type="text/javascript">
                      $(function(){
                        var now = $('#hora_salida').val();
                        vector=now.split(":");
                        var h=vector[0];
                        var m=vector[1];
                        var s=0;

                        $('#hora_salida').clock({displayFormat:'24',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script></td><input type="hidden" name="campo_descripcion" value="<?php echo('2286'); ?>"><input type="hidden" name="formato" value="215"><tr><td colspan='2'><?php submit_formato(215,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>