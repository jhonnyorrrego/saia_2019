<html><title>.:EDITAR RIESGOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RIESGOS</td></tr><input type="hidden" name="riesgo_antiguo" value="<?php echo(mostrar_valor_campo('riesgo_antiguo',499,$_REQUEST['iddoc'])); ?>"><tr id="tr_identificacion_riesg">
                     <td class="encabezado" width="20%" title="" colspan="2" id="identificacion_riesg"><h1><center><strong>IDENTIFICACI&Oacute;N DEL RIESGO</strong></center></h1></td>
                    </tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(499,6358,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha_riesgo">
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_bloqueada(499,6359,$_REQUEST['iddoc']);?></tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual: ELABORACION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(499,6360,$_REQUEST['iddoc']);?></td></tr><tr id="tr_consecutivo">
                     <td class="encabezado" width="20%" title="">NUMERO*</td>
                     <?php consecutivo_riesgo(499,6362,$_REQUEST['iddoc']);?></tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Actividad">ACTIVIDAD*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="nombre" id="nombre" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('nombre',499,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_area_responsable">
                   <td class="encabezado" width="20%" title="Area responsable">AREA RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(499,6364,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_area_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_area_responsable" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="area_responsable" id="area_responsable"   value="<?php cargar_seleccionados(499,6364,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
                			tree_area_responsable.setImagePath("../../imgs/");
                			tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                			tree_area_responsable.enableThreeStateCheckboxes(1);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php",checkear_arbol);
                	        
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_area_responsable.getAllSubItems(vector[i]);
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
                      function fin_cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(499,6364,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_area_responsable.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr id="tr_riesgo">
                     <td class="encabezado" width="20%" title="Definici&oacute;n: Representa la posibilidad de ocurrencia de un evento que pueda entorpecer el normal desarrollo de las funciones de la entidad y afectar el logro de sus objetivos.">RIESGO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="riesgo" id="riesgo" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('riesgo',499,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="controles" value="<?php echo(mostrar_valor_campo('controles',499,$_REQUEST['iddoc'])); ?>"><tr id="tr_descripcion">
                     <td class="encabezado" width="20%" title="Se refiere a las caracter&iacute;sticas generales o las formas en que se observa o manifiesta el riesgo identificado.">DESCRIPCION DEL RIESGO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion',499,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_tipo_riesgo" >
                     <td class="encabezado" width="20%" title="RIESGO ESTRAT&Eacute;GICO: Se asocia con la forma en la que se administra la Entidad. El manejo del riesgo estrat&eacute;gico se enfoca a asuntos globales relacionados con la misi&oacute;n y el cumplimiento de los objetivos estrat&eacute;gicos, la clara definici&oacute;n de pol&iacute;ticas, dise&ntilde;o y conceptualizaci&oacute;n de la entidad por parte de la alta gerencia.


RIESGO DE IMAGEN: Est&aacute;n relacionados con la percepci&oacute;n y la confianza por parte de la ciudadan&iacute;a hacia la instituci&oacute;n.


RIESGOS OPERATIVOS: Comprenden riesgos provenientes del funcionamiento y operatividad de los sistemas de informaci&oacute;n institucional, de la definici&oacute;n de los procesos, de la estructura de la entidad, de la articulaci&oacute;n entre dependencias.


RIESGOS FINACIEROS: Se relacionan con el manejo de los recursos de la entidad que incluyen: la ejecuci&oacute;n presupuestal, la elaboraci&oacute;n de los estados financieros, los pagos, manejo de excedentes de tesorer&iacute;a y el manejo sobre los bienes.


RIESGOS DE CUMPLIMIENTO: Se asocian con la capacidad de la entidad para cumplir con los requisitos legales, contractuales, de &eacute;tica p&uacute;blica y en general con su compromiso con la comunidad.


RIESGOS DE TECNOLOGIA: Est&aacute;n relacionados con la capacidad tecnol&oacute;gica de la entidad para satisfacer sus necesidades actuales y futuras y el cumplimiento de la misi&oacute;n.


CORRUPCI&Oacute;N: Se entiende por Riesgo de Corrupci&oacute;n la posibilidad de que por acci&oacute;n u omisi&oacute;n, mediante el uso indebido del poder, de los recursos o de la informaci&oacute;n, se lesionen los intereses de una entidad y en consecuencia del Estado, para la obtenci&oacute;n de un beneficio particular.">TIPO DE RIESGO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(499,6368,$_REQUEST['iddoc']);?></td></tr><tr id="tr_fuente_causa">
                     <td class="encabezado" width="20%" title="Son los medios, las circunstancias y agentes generadores de riesgo. Los agentes generadores que se atienden como todos los sujetos u objetos que tienen la capacidad de originar un riesgo.">FUENTE/CAUSA*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="fuente_causa" id="fuente_causa" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('fuente_causa',499,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_consecuencia">
                     <td class="encabezado" width="20%" title="Constituyen las consecuencias de la ocurrencia del riesgo sobre los objetivos de la entidad; generalmente se dan sobre las personas o bienes materiales o inmateriales con incidencias importantes tales como da&ntilde;os f&iacute;sicos y fallecimiento, sanciones, perdidas econ&oacute;micas, de informaci&oacute;n, de bienes, de imagen, de credibilidad y de confianza, interrupci&oacute;n del servicio y da&ntilde;o ambiental.">CONSECUENCIA O EFECTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="consecuencia" id="consecuencia" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('consecuencia',499,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="opciones_manejo" value="<?php echo(mostrar_valor_campo('opciones_manejo',499,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="acciones" value="<?php echo(mostrar_valor_campo('acciones',499,$_REQUEST['iddoc'])); ?>"><tr id="tr_analisis_riego">
                     <td class="encabezado" width="20%" title="" colspan="2" id="analisis_riego"><h1><center><strong>ANALISIS DE RIESGO</strong></center></h1></td>
                    </tr><input type="hidden" name="responsables" value="<?php echo(mostrar_valor_campo('responsables',499,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="indicador" value="<?php echo(mostrar_valor_campo('indicador',499,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="cronograma" value="<?php echo(mostrar_valor_campo('cronograma',499,$_REQUEST['iddoc'])); ?>"><tr id="tr_impacto" >
                     <td class="encabezado" width="20%" title="Por Impacto se entiende las consecuencias que puede ocasionar a la organizaci&oacute;n la materializaci&oacute;n del riesgo.

DESCRIPCION

1	Insignificante	Si el hecho llega a presentarse, tendria consecuencias o efectos minimos sobre la entidad.
2	Menor	Si el hecho llega a presentarse, tendria bajo impacto o efecto sobre la entidad.
3	Moderado	Si el hecho llega a presentarse, tendria medianas consecuencias o efectos sobre la entidad.
4	Mayor	Si el hecho llega a presentarse, tendria altas consecuencias o efectos sobre la entidad.
5	Catastrofico	Si el hecho llega a presentarse, tendria desastrosas consecuencias o efectos sobre la entidad.
">IMPACTO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(499,6377,$_REQUEST['iddoc']);?></td></tr><tr id="tr_probabilidad" >
                     <td class="encabezado" width="20%" title="Por Probabilidad se entiende la posibilidad de ocurrencia de un riesgo; esta puede ser medida con criterios de frecuencia, si se ha materializado (por ejemplo: n&uacute;mero de veces en un tiempo determinado), o de factibilidad teniendo en cuenta la presencia de factores internos y externos que pueden propiciar el riesgo, aunque esta no se haya materializado.

			
NIVEL 1	DESCRIPTOR Raro DESCRIPCION El evento puede ocurrir solo en circunstancias excepcionales FRECUENCIA No se ha presentado en los ultimos 5 a&ntilde;os.
NIVEL 2 DESCRIPTOR	Improbable DESCRIPCION El evento puede ocurrir en cualquier momento FRECUENCIA Al menos de una vez en los ultimos 5 a&ntilde;os.
NIVEL 3 DESCRIPTOR	Posible DESCRIPCION El evento podria ocurrir en algun momento FRECUENCIA Al menos de una vez en los ultimos 2 a&ntilde;os.
NIVEL 4 DESCRIPTOR	Probable DESCRIPCION El evento probablemente ocurrira en la mayoria de las circunstancias FRECUENCIA Al menos de una vez en el ultimo a&ntilde;o.
NIVEL 5 DESCRIPTOR	Casi Seguro DESCRIPCION Se espera que el evento ocurra en la mayoria de las circunstancias	FRECUENCIA Mas de una vez al a&ntilde;o.
">PROBABILIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(499,6379,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_riesgos_proceso" value="<?php echo(mostrar_valor_campo('idft_riesgos_proceso',499,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',499,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',499,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',499,$_REQUEST['iddoc'])); ?>"><?php selecion_tipo_riesgo(499,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6365,6367'); ?>"><input type="hidden" name="formato" value="499"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(499,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>