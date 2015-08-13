<html><title>.:ADICIONAR NOVEDADES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">NOVEDADES</td></tr><input type="hidden" name="idft_novedades_servicio" value="<?php echo(validar_valor_campo(3100)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3101)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(270,3102);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3103)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3079)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA CREACION*</td>
                     <?php fecha_disabled(270,3091);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DESTINOS*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  class="required"  name="destinos" id="destinos" value=""><?php componente_ejecutor("3090",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                   <td class="encabezado" width="20%" title="">CON COPIA A</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="2000"  name="copia" id="copia" value=""><?php componente_ejecutor("3087",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(validar_valor_campo(3084)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESPEDIDA</td>
                     <?php despedida(270,3089);?></tr><tr>
                   <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(270,3088,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_copiainterna" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
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
                      tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../../test.php?rol=1");
                	        
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
                     <td class="encabezado" width="20%" title="">ANEXO FISICOS</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="3000"   tabindex='3'  type="text" size="100" id="anexos_fisicos" name="anexos_fisicos"  value="<?php echo(validar_valor_campo(3083)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJERIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3097,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VISIBLE LA COPIA INTERNA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3096,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">TRANSCRIPTOR*</td>
                     <?php iniciales(270,3093);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='4'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="">CREAR UN RADICADO DIFERENTE PARA CADA DESTINO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3095,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MOSTRAR FIRMAS DIGITALIZADA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3092,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="saludo" value="<?php echo(validar_valor_campo(3094)); ?>"><input type="hidden" name="codigo" value="<?php echo(validar_valor_campo(3085)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_verifica_informacion"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_verifica_informacion"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_verifica_informacion);} ?><?php http://75.101.166.85/saia_release1/saia/index_actualizacion.php(270,NULL);?><?php carga_asunto_novedad_servicio(270,NULL);?><input type="hidden" name="campo_descripcion" value="3084"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(270);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>