<html><title>.:ADICIONAR ACTA DE EVALUACION Y ADJUDICACION:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script>
        <script type="text/javascript">
       $().ready(function() {$('#aprobacion_economico').blur(function(){
$.ajax({url: '../librerias/validar_unico.php', 
        type:'POST',
        data:'nombre=unico&valor='+$('#aprobacion_economico').val()+'&tabla=ft_acta_evaluacion&iddoc=<?php echo $_REQUEST["iddoc"]; ?>',
        success: function(datos){

        if(datos==0){
          alert('El campo aprobacion_economico debe Ser unico');
          $('#aprobacion_economico').val('');
          $('#aprobacion_economico').focus();

         }  
      }});
   });});

       </script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ACTA DE EVALUACION Y ADJUDICACION</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(1008)); ?>"><input type="hidden" name="idft_acta_evaluacion" value="<?php echo(validar_valor_campo(1010)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(1011)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(82,1012);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(1013)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(1014)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA ACTA DE EVALUACI&Oacute;N*</td>
                     <?php fecha_formato(82,1069);?></tr><input type="hidden" name="aprobacion_economico" value="<?php echo(validar_valor_campo(1070)); ?>"><input type="hidden" name="aprobacion_tecnico" value="<?php echo(validar_valor_campo(1071)); ?>"><input type="hidden" name="aprobacion_juridico" value="<?php echo(validar_valor_campo(1072)); ?>"><input type="hidden" name="convenio" value="<?php echo(validar_valor_campo(1073)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">SOLICITUD DE OFERTA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='1'  type="text" size="100" id="solitud_oferta" name="solitud_oferta" obligatorio="obligatorio" value="<?php echo(validar_valor_campo(1074)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">A&Ntilde;O*</td>
                     <?php lista_ano(82,1075);?></tr><tr>
                   <td class="encabezado" width="20%" title="">EVALUADOR TECNICO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(82,1009,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_evaluador_tecnico" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_evaluador_tecnico"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_evaluador_tecnico" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="evaluador_tecnico" id="evaluador_tecnico"   value="" ><label style="display:none" class="error" for="evaluador_tecnico">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_evaluador_tecnico=new dhtmlXTreeObject("treeboxbox_evaluador_tecnico","100%","100%",0);
                			tree_evaluador_tecnico.setImagePath("../../imgs/");
                			tree_evaluador_tecnico.enableIEImageFix(true);tree_evaluador_tecnico.enableCheckBoxes(1);
                    tree_evaluador_tecnico.enableRadioButtons(true);tree_evaluador_tecnico.setOnLoadingStart(cargando_evaluador_tecnico);
                      tree_evaluador_tecnico.setOnLoadingEnd(fin_cargando_evaluador_tecnico);tree_evaluador_tecnico.enableSmartXMLParsing(true);tree_evaluador_tecnico.loadXML("../../test.php?rol=1");
                	        tree_evaluador_tecnico.setOnCheckHandler(onNodeSelect_evaluador_tecnico);
                      function onNodeSelect_evaluador_tecnico(nodeId)
                      {valor_destino=document.getElementById("evaluador_tecnico");

                       if(tree_evaluador_tecnico.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_evaluador_tecnico.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_evaluador_tecnico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_tecnico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_tecnico")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_evaluador_tecnico"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_evaluador_tecnico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_tecnico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_tecnico")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_evaluador_tecnico"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">EVALUADOR ECONOMICO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(82,1015,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_evaluador_economico" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_evaluador_economico"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_evaluador_economico" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="evaluador_economico" id="evaluador_economico"   value="" ><label style="display:none" class="error" for="evaluador_economico">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_evaluador_economico=new dhtmlXTreeObject("treeboxbox_evaluador_economico","100%","100%",0);
                			tree_evaluador_economico.setImagePath("../../imgs/");
                			tree_evaluador_economico.enableIEImageFix(true);tree_evaluador_economico.enableCheckBoxes(1);
                    tree_evaluador_economico.enableRadioButtons(true);tree_evaluador_economico.setOnLoadingStart(cargando_evaluador_economico);
                      tree_evaluador_economico.setOnLoadingEnd(fin_cargando_evaluador_economico);tree_evaluador_economico.enableSmartXMLParsing(true);tree_evaluador_economico.loadXML("../../test.php?rol=1");
                	        tree_evaluador_economico.setOnCheckHandler(onNodeSelect_evaluador_economico);
                      function onNodeSelect_evaluador_economico(nodeId)
                      {valor_destino=document.getElementById("evaluador_economico");

                       if(tree_evaluador_economico.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_evaluador_economico.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_evaluador_economico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_economico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_economico")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_evaluador_economico"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_evaluador_economico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_economico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_economico")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_evaluador_economico"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">EVALUADOR JURIDICO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(82,1016,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_evaluador_juridico" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_evaluador_juridico"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_evaluador_juridico" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="evaluador_juridico" id="evaluador_juridico"   value="" ><label style="display:none" class="error" for="evaluador_juridico">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_evaluador_juridico=new dhtmlXTreeObject("treeboxbox_evaluador_juridico","100%","100%",0);
                			tree_evaluador_juridico.setImagePath("../../imgs/");
                			tree_evaluador_juridico.enableIEImageFix(true);tree_evaluador_juridico.enableCheckBoxes(1);
                    tree_evaluador_juridico.enableRadioButtons(true);tree_evaluador_juridico.setOnLoadingStart(cargando_evaluador_juridico);
                      tree_evaluador_juridico.setOnLoadingEnd(fin_cargando_evaluador_juridico);tree_evaluador_juridico.enableSmartXMLParsing(true);tree_evaluador_juridico.loadXML("../../test.php?rol=1");
                	        tree_evaluador_juridico.setOnCheckHandler(onNodeSelect_evaluador_juridico);
                      function onNodeSelect_evaluador_juridico(nodeId)
                      {valor_destino=document.getElementById("evaluador_juridico");

                       if(tree_evaluador_juridico.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_evaluador_juridico.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_evaluador_juridico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_juridico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_juridico")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_evaluador_juridico"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_evaluador_juridico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_juridico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_juridico")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_evaluador_juridico"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETO CONTRATACION*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="objeto_contratacion" id="objeto_contratacion" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(1017)); ?></textarea></td>
                    </tr><?php llenar_serie(82,NULL);?><input type="hidden" name="campo_descripcion" value="1017,1074"><tr><td colspan='2'><?php submit_formato(82);?></td></tr></table></form></body></html>