<html><title>.:ADICIONAR ACTA DE COMPROMISO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ACTA DE COMPROMISO</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(974)); ?>"><input type="hidden" name="idft_acta_compromiso" value="<?php echo(validar_valor_campo(992)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(993)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(81,994);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(995)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(996)); ?>"><input type="hidden" name="convenio" value="<?php echo(validar_valor_campo(997)); ?>"><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE REUNION*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true" maxlength="15"  class="required dateISO"  name="fecha_reunion" id="fecha_reunion" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_reunion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">DEPENDENCIA DE LA REUNION*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(81,977,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_dependencia_reunion" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_dependencia_reunion.findItem(htmlentities(document.getElementById('stext_dependencia_reunion').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencia_reunion.findItem(htmlentities(document.getElementById('stext_dependencia_reunion').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_dependencia_reunion.findItem(htmlentities(document.getElementById('stext_dependencia_reunion').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_dependencia_reunion"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_dependencia_reunion" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="dependencia_reunion" id="dependencia_reunion"   value="" ><label style="display:none" class="error" for="dependencia_reunion">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencia_reunion=new dhtmlXTreeObject("treeboxbox_dependencia_reunion","100%","100%",0);
                			tree_dependencia_reunion.setImagePath("../../imgs/");
                			tree_dependencia_reunion.enableIEImageFix(true);tree_dependencia_reunion.enableCheckBoxes(1);
                			tree_dependencia_reunion.enableThreeStateCheckboxes(1);tree_dependencia_reunion.setOnLoadingStart(cargando_dependencia_reunion);
                      tree_dependencia_reunion.setOnLoadingEnd(fin_cargando_dependencia_reunion);tree_dependencia_reunion.enableSmartXMLParsing(true);tree_dependencia_reunion.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                	        
                      tree_dependencia_reunion.setOnCheckHandler(onNodeSelect_dependencia_reunion);
                      function onNodeSelect_dependencia_reunion(nodeId)
                      {valor_destino=document.getElementById("dependencia_reunion");
                       destinos=tree_dependencia_reunion.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_dependencia_reunion.getAllSubItems(vector[i]);
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
                      function fin_cargando_dependencia_reunion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_reunion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_reunion")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencia_reunion"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_dependencia_reunion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_reunion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_reunion")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencia_reunion"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SERIE DE LA CPU*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="serie_cpu" name="serie_cpu"  value="<?php echo(validar_valor_campo(990)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NO. DEL STIKER*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="num_stiker" name="num_stiker"  value="<?php echo(validar_valor_campo(981)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SISTEMA OPERATIVO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,991,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OFIMATICO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,983,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MS PROJECT*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,980,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DISE. GRAFICO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,978,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANTIVIRUS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,975,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ORACLE*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,984,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">BASE DE DATOS EN</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,976,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO 1</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="otro1" name="otro1"  value="<?php echo(validar_valor_campo(985)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO 2</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="otro2" name="otro2"  value="<?php echo(validar_valor_campo(986)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO 3</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='7'  type="text" size="100" id="otro3" name="otro3"  value="<?php echo(validar_valor_campo(987)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO 4</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='8'  type="text" size="100" id="otro4" name="otro4"  value="<?php echo(validar_valor_campo(988)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO 5</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='9'  type="text" size="100" id="otro5" name="otro5"  value="<?php echo(validar_valor_campo(989)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='10'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_avanzado"><?php echo(validar_valor_campo(982)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Anexos">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='11'  type="file" maxlength="3000"  class='multi'  name="anexos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="campo_descripcion" value="975"><tr><td colspan='2'><?php submit_formato(81);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>