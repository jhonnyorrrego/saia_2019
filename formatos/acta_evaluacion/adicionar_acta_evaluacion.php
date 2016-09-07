<html><title>.:ADICIONAR F. ACTA DE EVALUACI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">F. ACTA DE EVALUACI&Oacute;N</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(402,4722);?></tr><tr>
                     <td class="encabezado" width="20%" title="">EVALUACI&Oacute;N T&Eacute;CNICA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="100"  tabindex='1'  type="input" id="evaluacion_tecnica" name="evaluacion_tecnica"  value="<?php echo(validar_valor_campo(4723)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#evaluacion_tecnica").spin({imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">EVALUACI&Oacute;N ECON&Oacute;MICA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="100" min="0" max="100"  tabindex='2'  type="input" id="evaluacion_economica" name="evaluacion_economica"  value="<?php echo(validar_valor_campo(4724)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#evaluacion_economica").spin({imageBasePath:'../../images/',min:0,max:100,interval:1,imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">ANEXAR EVALUACI&Oacute;N T&Eacute;CNICA*</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file"  class="required multi"  name="anexo_tecnica[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="">PROPONENTES QUE NO CUMPLEN</td>
                     <?php proponentes_informacio(402,4736);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS EVALUACI&Oacute;N ECON&Oacute;MICA*</td>
                     <td class="celda_transparente"><input  tabindex='4'  type="file"  class="required multi"  name="anexo_economica[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="">PROPONENTE RECOMENDADO*</td>
                     <?php lista_proponentes(402,4735);?></tr><tr>
                   <td class="encabezado" width="20%" title="">GERENTE DEL &Aacute;REA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(402,4727,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_gerente" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_gerente"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_gerente" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="gerente" id="gerente"   value="" ><label style="display:none" class="error" for="gerente">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gerente=new dhtmlXTreeObject("treeboxbox_gerente","100%","100%",0);
                			tree_gerente.setImagePath("../../imgs/");
                			tree_gerente.enableIEImageFix(true);tree_gerente.enableCheckBoxes(1);
                    tree_gerente.enableRadioButtons(true);tree_gerente.setOnLoadingStart(cargando_gerente);
                      tree_gerente.setOnLoadingEnd(fin_cargando_gerente);tree_gerente.enableSmartXMLParsing(true);tree_gerente.loadXML("../../test.php?sin_padre=1");
                	        tree_gerente.setOnCheckHandler(onNodeSelect_gerente);
                      function onNodeSelect_gerente(nodeId)
                      {valor_destino=document.getElementById("gerente");

                       if(tree_gerente.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_gerente.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_gerente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gerente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gerente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gerente"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_gerente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gerente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gerente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gerente"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXAR ACTA DE EVALUACI&Oacute;N*</td>
                     <td class="celda_transparente"><input  tabindex='6'  type="file"  class="required multi"  name="anexar_acta[]" accept="<?php echo $extensiones;?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_despacho_fisico"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_despacho_fisico"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_despacho_fisico);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4730)); ?>"><input type="hidden" name="idft_acta_evaluacion" value="<?php echo(validar_valor_campo(4731)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4732)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4733)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4734)); ?>"><input type="hidden" name="campo_descripcion" value="4727"><tr><td colspan='2'><?php submit_formato(402);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>