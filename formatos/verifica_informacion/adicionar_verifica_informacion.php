<html><title>.:ADICIONAR VERIFICACI&Oacute;N DE INFORMACI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">VERIFICACI&Oacute;N DE INFORMACI&Oacute;N</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3076)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(269,3075);?></tr><tr>
                   <td class="encabezado" width="20%" title="Verificaci&oacute;n de Informaci&oacute;n">SERIE DOCUMENTAL*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(269,3067,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
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
                	--></script></td></tr><input type="hidden" name="fk_idexpediente" value="<?php echo(validar_valor_campo(3122)); ?>"><input type="hidden" name="datos_remitente" value="<?php echo(validar_valor_campo(3068)); ?>"><input type="hidden" name="identifica_afiliado" value="<?php echo(validar_valor_campo(3118)); ?>"><input type="hidden" name="fecha_inicial_verifi" value="<?php echo(validar_valor_campo(3070)); ?>"><input type="hidden" name="numero_folios_verifi" value="<?php echo(validar_valor_campo(3069)); ?>"><input type="hidden" name="numero_folios_recibi" value="<?php echo(validar_valor_campo(3119)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">PRESENTA INCONSISTENCIAS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(269,3120,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observacion_verifica" id="observacion_verifica" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3072)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE AFILIADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="nombre_afiliado" name="nombre_afiliado"  value="<?php echo(validar_valor_campo(3121)); ?>"></td>
                    </tr><input type="hidden" name="idft_verifica_informacion" value="<?php echo(validar_valor_campo(3073)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_radica_doc_mercantil"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_radica_doc_mercantil"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_radica_doc_mercantil);} ?><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3077)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3074)); ?>"><?php carga_lista_verificacion_afiliados(269,NULL);?><input type="hidden" name="campo_descripcion" value="3120"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(269);?></td></tr></table></form></body></html>