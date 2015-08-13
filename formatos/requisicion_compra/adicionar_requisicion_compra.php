<html><title>.:ADICIONAR REQUISICION ORDEN DE COMPRA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REQUISICION ORDEN DE COMPRA</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(315,3698);?></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3687)); ?>"><input type="hidden" name="phid" value="<?php echo(validar_valor_campo(3688)); ?>"><input type="hidden" name="phord" value="<?php echo(validar_valor_campo(3689)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ESTADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="phstat" name="phstat"  value="<?php echo(validar_valor_campo(3690)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DE LA COMPA&Ntilde;IA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="phcomp" name="phcomp"  value="<?php echo(validar_valor_campo(3691)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DE LA INSTALACION</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="phfac" name="phfac"  value="<?php echo(validar_valor_campo(3692)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">CODIGO QUIEN RECIBE MERCANCIA</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(315,3693,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_phship" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_phship"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_phship" height="90%"></div><input type="hidden" maxlength="255"  name="phship" id="phship"   value="" ><label style="display:none" class="error" for="phship">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_phship.setOnLoadingEnd(fin_cargando_phship);tree_phship.enableSmartXMLParsing(true);tree_phship.loadXML("../../test.php?rol=1");
                	        
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
                	--></script></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE CREACION ORDEN</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='5'  type="text" readonly="true"  name="phendt" id="phendt" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("phendt","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_phcur" >
                     <td class="encabezado" width="20%" title="">MONEDA DE LA OPERACION</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(315,3695,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_requisicion_compra" value="<?php echo(validar_valor_campo(3696)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3697)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3699)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3700)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">CODIGO SOLICITUD COMPRA</td>
                     <?php phrqid(315,3707);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DEL COMPRADOR</td>
                     <?php phbuyc(315,3708);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO PROVEEDOR </td>
                     <?php phvend(315,3709);?></tr><tr><td colspan='2'><?php submit_formato(315);?></td></tr></table></form></body></html>