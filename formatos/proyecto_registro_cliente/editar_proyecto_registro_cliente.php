<html><title>.:EDITAR 2. PROYECTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">2. PROYECTO</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(250,2869,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',250,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL PROYECTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_proyecto" name="nombre_proyecto"  value="<?php echo(mostrar_valor_campo('nombre_proyecto',250,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N PROYECTO</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('descripcion',250,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">EMPRESA ASOCIADA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(250,2863,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_empresa_asociada" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_empresa_asociada"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_empresa_asociada" height="90%"></div><input type="hidden"  class="required"  name="empresa_asociada" id="empresa_asociada"   value="<?php cargar_seleccionados(250,2863,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_empresa_asociada=new dhtmlXTreeObject("treeboxbox_empresa_asociada","100%","100%",0);
                			tree_empresa_asociada.setImagePath("../../imgs/");
                			tree_empresa_asociada.enableIEImageFix(true);tree_empresa_asociada.enableCheckBoxes(1);
                    tree_empresa_asociada.enableRadioButtons(true);tree_empresa_asociada.setOnLoadingStart(cargando_empresa_asociada);
                      tree_empresa_asociada.setOnLoadingEnd(fin_cargando_empresa_asociada);tree_empresa_asociada.enableSmartXMLParsing(true);tree_empresa_asociada.loadXML("../../test_serie.php?sin_padre=1&id=932&tabla=serie",checkear_arbol);
                	        tree_empresa_asociada.setOnCheckHandler(onNodeSelect_empresa_asociada);
                      function onNodeSelect_empresa_asociada(nodeId)
                      {valor_destino=document.getElementById("empresa_asociada");

                       if(tree_empresa_asociada.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_empresa_asociada.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(250,2863,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_empresa_asociada.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MONEDA DEL PROYECTO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(250,2864,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DEL PROYECTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="valor" name="valor"  value="<?php echo(mostrar_valor_campo('valor',250,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FORMA DE PAGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="forma_pago" name="forma_pago"  value="<?php echo(mostrar_valor_campo('forma_pago',250,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TIEMPO DE DURACI&Oacute;N*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="duracion" name="duracion"  value="<?php echo(mostrar_valor_campo('duracion',250,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="idft_proyecto_registro_cliente" value="<?php echo(mostrar_valor_campo('idft_proyecto_registro_cliente',250,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',250,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',250,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=250&idcampo=2920" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><?php separar_miles_proyecto(250,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2862'); ?>"><input type="hidden" name="formato" value="250"><tr><td colspan='2'><?php submit_formato(250,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>