<html><title>.:EDITAR REQUISICION ORDEN DE COMPRA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REQUISICION ORDEN DE COMPRA</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(315,3698,$_REQUEST['iddoc']);?></tr><input type="hidden" name="phid" value="<?php echo(mostrar_valor_campo('phid',315,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="phord" value="<?php echo(mostrar_valor_campo('phord',315,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ESTADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="phstat" name="phstat"  value="<?php echo(mostrar_valor_campo('phstat',315,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DE LA COMPA&Ntilde;IA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="phcomp" name="phcomp"  value="<?php echo(mostrar_valor_campo('phcomp',315,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DE LA INSTALACION</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="phfac" name="phfac"  value="<?php echo(mostrar_valor_campo('phfac',315,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">CODIGO QUIEN RECIBE MERCANCIA</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(315,3693,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_phship" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_phship"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_phship" height="90%"></div><input type="hidden" maxlength="255"  name="phship" id="phship"   value="<?php cargar_seleccionados(315,3693,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_phship=new dhtmlXTreeObject("treeboxbox_phship","100%","100%",0);
                			tree_phship.setImagePath("../../imgs/");
                			tree_phship.enableIEImageFix(true);tree_phship.enableCheckBoxes(1);
                			tree_phship.enableThreeStateCheckboxes(1);tree_phship.setOnLoadingStart(cargando_phship);
                      tree_phship.setOnLoadingEnd(fin_cargando_phship);tree_phship.enableSmartXMLParsing(true);tree_phship.loadXML("../../test.php?rol=1",checkear_arbol);
                	        
                      tree_phship.setOnCheckHandler(onNodeSelect_phship);
                      function onNodeSelect_phship(nodeId)
                      {valor_destino=document.getElementById("phship");
                       destinos=tree_phship.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_phship.getAllSubItems(vector[i]);
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
                      function fin_cargando_phship() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_phship")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_phship")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_phship"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_phship() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_phship")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_phship")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_phship"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(315,3693,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_phship.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE CREACION ORDEN</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='5'  type="text" readonly="true"  name="phendt" id="phendt" tipo="fecha" value="<?php mostrar_valor_campo('phendt',315,$_REQUEST['iddoc']); ?>"><?php selector_fecha("phendt","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_phcur" >
                     <td class="encabezado" width="20%" title="">MONEDA DE LA OPERACION</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(315,3695,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_requisicion_compra" value="<?php echo(mostrar_valor_campo('idft_requisicion_compra',315,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',315,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',315,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',315,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">CODIGO SOLICITUD COMPRA</td>
                     <?php phrqid(315,3707,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DEL COMPRADOR</td>
                     <?php phbuyc(315,3708,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO PROVEEDOR </td>
                     <?php phvend(315,3709,$_REQUEST['iddoc']);?></tr><input type="hidden" name="formato" value="315"><tr><td colspan='2'><?php submit_formato(315,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>