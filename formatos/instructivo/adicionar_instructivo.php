<html><title>.:ADICIONAR INSTRUCTIVOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INSTRUCTIVOS</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4372)); ?>"><input type="hidden" name="idft_instructivo" value="<?php echo(validar_valor_campo(4373)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(374,4374);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4375)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4376)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4377)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Nombre del Instructivo">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(4378)); ?>"></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(374,4379,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Soporte Digital del Instructivo">SOPORTE*</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class="required multi"  name="soporte[]" accept="<?php echo $extensiones;?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proceso);} ?><tr>
                   <td class="encabezado" width="20%" title="Secretarias Vinculadas ">SECRETARIAS VINCULADAS </td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(374,4382,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_secretarias" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_secretarias"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_secretarias" height="90%"></div><input type="hidden" maxlength="255"  name="secretarias" id="secretarias"   value="" ><label style="display:none" class="error" for="secretarias">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_secretarias=new dhtmlXTreeObject("treeboxbox_secretarias","100%","100%",0);
                			tree_secretarias.setImagePath("../../imgs/");
                			tree_secretarias.enableIEImageFix(true);tree_secretarias.enableCheckBoxes(1);
                			tree_secretarias.enableThreeStateCheckboxes(1);tree_secretarias.setOnLoadingStart(cargando_secretarias);
                      tree_secretarias.setOnLoadingEnd(fin_cargando_secretarias);tree_secretarias.enableSmartXMLParsing(true);tree_secretarias.loadXML("../../test_serie.php?tabla=dependencia");
                	        
                      tree_secretarias.setOnCheckHandler(onNodeSelect_secretarias);
                      function onNodeSelect_secretarias(nodeId)
                      {valor_destino=document.getElementById("secretarias");
                       destinos=tree_secretarias.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_secretarias.getAllSubItems(vector[i]);
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
                      function fin_cargando_secretarias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretarias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretarias")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_secretarias"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_secretarias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretarias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretarias")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_secretarias"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="campo_descripcion" value="4378"><tr><td colspan='2'><?php submit_formato(374);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>