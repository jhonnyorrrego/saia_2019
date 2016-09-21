<html><title>.:ADICIONAR CARTA DE RESPUESTA A LA PQR:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CARTA DE RESPUESTA A LA PQR</td></tr><input type="hidden" name="firma_externa" value="<?php echo(validar_valor_campo(2749)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2262)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(212,2261);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(212,2267);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DESTINOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="2000"  class="required"   tabindex='1'  type="text" size="100" id="destinos" name="destinos"  value="<?php echo(validar_valor_campo(2257)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  name="copia" id="copia" value=""><?php componente_ejecutor("2254",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(validar_valor_campo(2252)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SALUDO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(212,2264,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(2253)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</td>
                     <?php despedida(212,2256);?></tr><tr>
                   <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(212,2255,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_copia_interna" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_copia_interna"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_copia_interna" height="90%"></div><input type="hidden" maxlength="2000"  name="copia_interna" id="copia_interna"   value="" ><label style="display:none" class="error" for="copia_interna">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_interna=new dhtmlXTreeObject("treeboxbox_copia_interna","100%","100%",0);
                			tree_copia_interna.setImagePath("../../imgs/");
                			tree_copia_interna.enableIEImageFix(true);tree_copia_interna.enableCheckBoxes(1);
                			tree_copia_interna.enableThreeStateCheckboxes(1);tree_copia_interna.setOnLoadingStart(cargando_copia_interna);
                      tree_copia_interna.setOnLoadingEnd(fin_cargando_copia_interna);tree_copia_interna.enableSmartXMLParsing(true);tree_copia_interna.loadXML("../../test.php");
                	        
                      tree_copia_interna.setOnCheckHandler(onNodeSelect_copia_interna);
                      function onNodeSelect_copia_interna(nodeId)
                      {valor_destino=document.getElementById("copia_interna");
                       destinos=tree_copia_interna.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_interna.getAllSubItems(vector[i]);
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
                      function fin_cargando_copia_interna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_interna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_interna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_interna"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_copia_interna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_interna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_interna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_interna"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="Persona que Genera la Carta ">PERSONA QUE GENERA LA CARTA*</td>
                     <?php iniciales(212,2258);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='5'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2251)); ?>"><input type="hidden" name="idft_carta_responde_pqr" value="<?php echo(validar_valor_campo(2259)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_pqr"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_pqr"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_pqr);} ?><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2260)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2263)); ?>"><?php cargar_asunto_carta(212,NULL);?><?php cargar_destino(212,NULL);?><input type="hidden" name="campo_descripcion" value="2252"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(212);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>