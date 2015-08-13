<html><title>.:ADICIONAR COMUNICACI&Oacute;N EXTERNA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">COMUNICACI&Oacute;N EXTERNA</td></tr><input type="hidden" name="tipo_copia_interna" value="<?php echo(validar_valor_campo(3421)); ?>"><input type="hidden" name="idflujo" value="<?php echo(validar_valor_campo(2216)); ?>"><input type="hidden" name="idft_carta" value="<?php echo(validar_valor_campo(17)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(16)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(15)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(14)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA*</td>
                     <?php buscar_dependencia(1,13);?></tr><tr>
                   <td class="encabezado" width="20%" title="">TIPO DE DOCUMENTO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(1,8,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_serie_idserie"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_serie_idserie" height="90%"></div><input type="hidden" maxlength="11"  name="serie_idserie" id="serie_idserie"   value="" ><label style="display:none" class="error" for="serie_idserie">Campo obligatorio.</label><script type="text/javascript">
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
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="Fecha en la que fue Creada la Carta.">FECHA DE CREACION*</td>
                     <?php fecha_formato(1,3);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DESTINOS*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  class="required"  name="destinos" id="destinos" value=""><?php componente_ejecutor("9",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                   <td class="encabezado" width="20%" title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  name="copia" id="copia" value=""><?php componente_ejecutor("6",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(validar_valor_campo(10)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(1)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</td>
                     <?php despedida(1,7);?></tr><tr>
                   <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(1,2,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_copiainterna" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_copiainterna"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_copiainterna" height="90%"></div><input type="hidden" maxlength="2000"  name="copiainterna" id="copiainterna"   value="" ><label style="display:none" class="error" for="copiainterna">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copiainterna=new dhtmlXTreeObject("treeboxbox_copiainterna","100%","100%",0);
                			tree_copiainterna.setImagePath("../../imgs/");
                			tree_copiainterna.enableIEImageFix(true);tree_copiainterna.enableCheckBoxes(1);
                			tree_copiainterna.enableThreeStateCheckboxes(1);tree_copiainterna.setOnLoadingStart(cargando_copiainterna);
                      tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../../test.php");
                	        
                      tree_copiainterna.setOnCheckHandler(onNodeSelect_copiainterna);
                      function onNodeSelect_copiainterna(nodeId)
                      {valor_destino=document.getElementById("copiainterna");
                       destinos=tree_copiainterna.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copiainterna.getAllSubItems(vector[i]);
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
                      function fin_cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="Persona que Genera la Carta ">PERSONA QUE GENERA LA CARTA*</td>
                     <?php iniciales(1,5);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='5'  type="file" maxlength="2000"  class='multi'  name="anexos_digitales[]" accept="xls|doc|pdf|jpg|zip|rar"><tr>
                     <td class="encabezado" width="20%" title="Listado con Los Anexos de la Carta">ANEXOS FISICOS</td>
                     <?php anexos_fisicos(1,4);?></tr><input type="hidden" name="varios_radicados" value="<?php echo(validar_valor_campo(18)); ?>"><tr id="tr_vercopiainterna" >
                     <td class="encabezado" width="20%" title="">VISIBLE LA COPIA INTERNA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,12,$_REQUEST['iddoc']);?></td></tr><?php cargar_destinos_carta(1,NULL);?><?php asignar_responsables(1,NULL);?><?php guardar_plantilla(1,NULL);?><?php mostrar_imagenes_escaneadas(1,NULL);?><input type="hidden" name="campo_descripcion" value="10"><tr><td colspan='2'><?php submit_formato(1);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body>
              <script type="text/javascript">
              setInterval("auto_save('contenido','carta')",300000);
              </script></html>