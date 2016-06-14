<html><title>.:EDITAR PLANES DE CALIDAD:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PLANES DE CALIDAD</td></tr><input type="hidden" name="idft_plan_calidad" value="<?php echo(mostrar_valor_campo('idft_plan_calidad',366,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(366,4286,$_REQUEST['iddoc']);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',366,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',366,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',366,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="Nombre">NOMBRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',366,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(366,4291,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Soporte Digital Plan de Calidad">SOPORTE*</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=366&idcampo=4292" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                   <td class="encabezado" width="20%" title="Secretarias Vinculadas ">SECRETARIAS VINCULADAS</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(366,4294,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_secretarias" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_secretarias"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_secretarias" height="90%"></div><input type="hidden" maxlength="255"  name="secretarias" id="secretarias"   value="<?php cargar_seleccionados(366,4294,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
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
                      tree_secretarias.setOnLoadingEnd(fin_cargando_secretarias);tree_secretarias.enableSmartXMLParsing(true);tree_secretarias.loadXML("../../test_serie.php?tabla=dependencia",checkear_arbol);
                	        
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
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(366,4294,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_secretarias.setCheck(vector2[m],true);
                    }}
--></script></td></tr><input type="hidden" name="campo_descripcion" value="<?php echo('4290'); ?>"><input type="hidden" name="formato" value="366"><tr><td colspan='2'><?php submit_formato(366,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>