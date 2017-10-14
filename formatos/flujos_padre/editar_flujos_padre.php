<html><title>.:EDITAR FLUJOS PADRE:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">FLUJOS PADRE</td></tr><tr>
                     <td class="encabezado" width="20%" title="">CAMPO ANEXO*</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=401&idcampo=4964" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',401,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',401,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(401,4952,$_REQUEST['iddoc']);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',401,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_flujos_padre" value="<?php echo(mostrar_valor_campo('idft_flujos_padre',401,$_REQUEST['iddoc'])); ?>"><tr>
                   <td class="encabezado" width="20%" title="">ARBOL FUN*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(401,4949,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_arbol_fun" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_arbol_fun.findItem(htmlentities(document.getElementById('stext_arbol_fun').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_arbol_fun.findItem(htmlentities(document.getElementById('stext_arbol_fun').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_arbol_fun.findItem(htmlentities(document.getElementById('stext_arbol_fun').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_arbol_fun"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_arbol_fun" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="arbol_fun" id="arbol_fun"   value="<?php cargar_seleccionados(401,4949,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_arbol_fun=new dhtmlXTreeObject("treeboxbox_arbol_fun","100%","100%",0);
                			tree_arbol_fun.setImagePath("../../imgs/");
                			tree_arbol_fun.enableIEImageFix(true);tree_arbol_fun.enableCheckBoxes(1);
                    tree_arbol_fun.enableRadioButtons(true);tree_arbol_fun.setOnLoadingStart(cargando_arbol_fun);
                      tree_arbol_fun.setOnLoadingEnd(fin_cargando_arbol_fun);tree_arbol_fun.enableSmartXMLParsing(true);tree_arbol_fun.loadXML("../../test.php?sin_padre=1",checkear_arbol);
                	        tree_arbol_fun.setOnCheckHandler(onNodeSelect_arbol_fun);
                      function onNodeSelect_arbol_fun(nodeId)
                      {valor_destino=document.getElementById("arbol_fun");

                       if(tree_arbol_fun.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_arbol_fun.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_arbol_fun() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol_fun")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol_fun")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_arbol_fun"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_arbol_fun() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol_fun")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol_fun")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_arbol_fun"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(401,4949,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_arbol_fun.setCheck(vector2[m],true);
                    }}
--></script></td></tr><input type="hidden" name="formato" value="401"><tr><td colspan='2'><?php submit_formato(401,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>