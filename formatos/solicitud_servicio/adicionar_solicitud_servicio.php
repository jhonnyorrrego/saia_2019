<html><title>.:ADICIONAR SOLICITUD DE SERVICIO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_entrada/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../librerias/dependientes.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE SERVICIO</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3050)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(267,3049);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA Y HORA DE SOLICITUD*</td>
                     <?php fecha_formato(267,3033);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto_solicitud" name="asunto_solicitud"  value="<?php echo(validar_valor_campo(3065)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CIUDAD DE ORIGEN*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3034,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="Solicitud de Servicio">SERIE DOCUMENTAL*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(267,3032,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem(htmlentities(document.getElementById('stext_serie_idserie').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_serie_idserie"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_serie_idserie" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="serie_idserie" id="serie_idserie"   value="" ><label style="display:none" class="error" for="serie_idserie">Campo obligatorio.</label><script type="text/javascript">
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
                     <td class="encabezado" width="20%" title="">SELECCIONE EL DOCUMENTO*</td>
                     <?php fk_idsolicitud_afiliacion_funcion(267,3116);?></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3035,$_REQUEST['iddoc']);?></td></tr><tr>
                  <td class="encabezado" width="20%" title="">TIPO DE MERCANCIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3036,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">REFERENCIA DE CAJA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3105,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD (UNIDADES)</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="digits"   tabindex='3'  type="text" size="100" id="cantidad_mercancia" name="cantidad_mercancia"  value="<?php echo(validar_valor_campo(3104)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE PRIVILEGIOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3037,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE ENV&Iacute;O*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3038,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DECLARADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"   tabindex='4'  type="text" size="100" id="valor_declarado" name="valor_declarado"  value="<?php echo(validar_valor_campo(3039)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PESO (KILOS)</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="digits"   tabindex='5'  type="text" size="100" id="peso_envio_solicitud" name="peso_envio_solicitud"  value="<?php echo(validar_valor_campo(3040)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TAMA&Ntilde;O APROXIMADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="tamanio_aproximado" name="tamanio_aproximado"  value="<?php echo(validar_valor_campo(3041)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">REQUIERE RECOLECCI&Oacute;N*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3042,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCI&Oacute;N DE RECOLECCI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='7'  type="text" size="100" id="direccion_recoleccion" name="direccion_recoleccion"  value="<?php echo(validar_valor_campo(3043)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE RECOLECCI&Oacute;N</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  name="fecha_recoleccion" id="fecha_recoleccion" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_recoleccion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='9'  name="observacion_solicitud" id="observacion_solicitud" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3045)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='10'  type="file" maxlength="255"  class='multi'  name="anexos_digitales[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_solicitud_servicio" value="<?php echo(validar_valor_campo(3047)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3048)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3051)); ?>"><?php digitalizar_formato_radicacion(267,NULL);?><?php carga_ciudad_solicitud(267,NULL);?><?php separar_miles_solicitud(267,NULL);?><?php oculta_campos_adicionar_solicitud(267,NULL);?><input type="hidden" name="campo_descripcion" value="3065"><tr><td colspan='2'><?php submit_formato(267);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>