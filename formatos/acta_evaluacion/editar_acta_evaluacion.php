<html><title>.:EDITAR F. ACTA DE EVALUACI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
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
                     <?php buscar_dependencia(402,4722,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">EVALUACI&Oacute;N T&Eacute;CNICA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="100"  tabindex='1'  type="input" id="evaluacion_tecnica" name="evaluacion_tecnica"  value="<?php echo(mostrar_valor_campo('evaluacion_tecnica',402,$_REQUEST['iddoc'])); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#evaluacion_tecnica").spin({imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">EVALUACI&Oacute;N ECON&Oacute;MICA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="100" min="0" max="100"  tabindex='2'  type="input" id="evaluacion_economica" name="evaluacion_economica"  value="<?php echo(mostrar_valor_campo('evaluacion_economica',402,$_REQUEST['iddoc'])); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#evaluacion_economica").spin({imageBasePath:'../../images/',min:0,max:100,interval:1,imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">ANEXAR EVALUACI&Oacute;N T&Eacute;CNICA*</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=402&idcampo=4725" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                     <td class="encabezado" width="20%" title="">PROPONENTES QUE NO CUMPLEN</td>
                     <?php proponentes_informacio(402,4736,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS EVALUACI&Oacute;N ECON&Oacute;MICA*</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=402&idcampo=4726" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                     <td class="encabezado" width="20%" title="">PROPONENTE RECOMENDADO*</td>
                     <?php lista_proponentes(402,4735,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">GERENTE DEL &Aacute;REA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(402,4727,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_gerente" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_gerente"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_gerente" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="gerente" id="gerente"   value="<?php cargar_seleccionados(402,4727,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
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
                      tree_gerente.setOnLoadingEnd(fin_cargando_gerente);tree_gerente.enableSmartXMLParsing(true);tree_gerente.loadXML("../../test.php?sin_padre=1",checkear_arbol);
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
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(402,4727,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_gerente.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXAR ACTA DE EVALUACI&Oacute;N*</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=402&idcampo=4728" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="idft_acta_evaluacion" value="<?php echo(mostrar_valor_campo('idft_acta_evaluacion',402,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',402,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',402,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',402,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('4727'); ?>"><input type="hidden" name="formato" value="402"><tr><td colspan='2'><?php submit_formato(402,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>