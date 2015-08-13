<html><title>.:ADICIONAR 3. PLAN DE TRATAMIENTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">3. PLAN DE TRATAMIENTO</td></tr><input type="hidden" name="idft_plan_tratamiento" value="<?php echo(validar_valor_campo(3430)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3431)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(295,3432);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3433)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3434)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3423)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_clinica_ortodoncia"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_clinica_ortodoncia"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_clinica_ortodoncia);} ?><tr>
                     <td class="encabezado" width="20%" title="">DIAGNOSTICO</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="plan_diagnostico" id="plan_diagnostico" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3424)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DEL TRATAMIENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"   tabindex='2'  type="text" size="100" id="valor_plan_tratamiento" name="valor_plan_tratamiento"  value="<?php echo(validar_valor_campo(3425)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PACIENTE O ACUDIENTE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="paciente_tratamiento" name="paciente_tratamiento"  value="<?php echo(validar_valor_campo(3426)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DOCUMENTO DE IDENTIDAD</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="documento_paciente" name="documento_paciente"  value="<?php echo(validar_valor_campo(3427)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ODONTOLOGO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(295,3428,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_odontologo_tratamiento" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_odontologo_tratamiento"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_odontologo_tratamiento" height="90%"></div><input type="hidden" maxlength="255"  name="odontologo_tratamiento" id="odontologo_tratamiento"   value="" ><label style="display:none" class="error" for="odontologo_tratamiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_odontologo_tratamiento=new dhtmlXTreeObject("treeboxbox_odontologo_tratamiento","100%","100%",0);
                			tree_odontologo_tratamiento.setImagePath("../../imgs/");
                			tree_odontologo_tratamiento.enableIEImageFix(true);tree_odontologo_tratamiento.enableCheckBoxes(1);
                    tree_odontologo_tratamiento.enableRadioButtons(true);tree_odontologo_tratamiento.setOnLoadingStart(cargando_odontologo_tratamiento);
                      tree_odontologo_tratamiento.setOnLoadingEnd(fin_cargando_odontologo_tratamiento);tree_odontologo_tratamiento.enableSmartXMLParsing(true);tree_odontologo_tratamiento.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_odontologo_tratamiento.setOnCheckHandler(onNodeSelect_odontologo_tratamiento);
                      function onNodeSelect_odontologo_tratamiento(nodeId)
                      {valor_destino=document.getElementById("odontologo_tratamiento");

                       if(tree_odontologo_tratamiento.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_odontologo_tratamiento.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_odontologo_tratamiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_odontologo_tratamiento"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_odontologo_tratamiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_odontologo_tratamiento"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE REGISTRO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="registro_tratamiento" name="registro_tratamiento"  value="<?php echo(validar_valor_campo(3429)); ?>"></td>
                    </tr><?php separar_miles_valor_tratamiento(295,NULL);?><input type="hidden" name="campo_descripcion" value="3426,3429"><tr><td colspan='2'><?php submit_formato(295);?></td></tr></table></form></body></html>