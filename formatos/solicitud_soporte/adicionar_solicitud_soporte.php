<html><title>.:ADICIONAR SOLICITUD DE SOPORTE:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.clock.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE SOPORTE</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2337)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(218,2336);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA SOLICITUD*</td>
                     <?php fecha_formato(218,2330);?></tr><tr>
                    <td class="encabezado" width="20%" title="">HORA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='1'  type="text"  name="hora_solicitud"  class="required"  id="hora_solicitud" value=""></span></font><script type="text/javascript">
                      $(function(){
                        var now = new Date();
                        var h=(now.getHours());
                        var m=now.getMinutes();
                        var s=now.getSeconds();

                        $('#hora_solicitud').clock({displayFormat:'24',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script></td><tr>
                   <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(218,2333,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_tipo_solitud" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_tipo_solitud"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_tipo_solitud" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="tipo_solitud" id="tipo_solitud"   value="" ><label style="display:none" class="error" for="tipo_solitud">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_solitud=new dhtmlXTreeObject("treeboxbox_tipo_solitud","100%","100%",0);
                			tree_tipo_solitud.setImagePath("../../imgs/");
                			tree_tipo_solitud.enableIEImageFix(true);tree_tipo_solitud.enableCheckBoxes(1);
                    tree_tipo_solitud.enableRadioButtons(true);tree_tipo_solitud.setOnLoadingStart(cargando_tipo_solitud);
                      tree_tipo_solitud.setOnLoadingEnd(fin_cargando_tipo_solitud);tree_tipo_solitud.enableSmartXMLParsing(true);tree_tipo_solitud.loadXML("../../test_serie_funcionario.php?categoria=3&id=884");
                	        tree_tipo_solitud.setOnCheckHandler(onNodeSelect_tipo_solitud);
                      function onNodeSelect_tipo_solitud(nodeId)
                      {valor_destino=document.getElementById("tipo_solitud");

                       if(tree_tipo_solitud.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_tipo_solitud.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_tipo_solitud() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_solitud")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_solitud")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_solitud"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_tipo_solitud() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_solitud")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_solitud")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_solitud"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr id="tr_prioridad" >
                     <td class="encabezado" width="20%" title="">PRIORIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(218,2553,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2331)); ?></textarea></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2335)); ?>"><input type="hidden" name="idft_solicitud_soporte" value="<?php echo(validar_valor_campo(2334)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2329)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><input  tabindex='4'  type="file" maxlength="255"  class='multi'  name="anexos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2338)); ?>"><input type="hidden" name="campo_descripcion" value="2330"><tr><td colspan='2'><?php submit_formato(218);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>