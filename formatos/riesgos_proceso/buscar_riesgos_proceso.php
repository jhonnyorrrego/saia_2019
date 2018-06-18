<html><title>.: RIESGOS:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RIESGOS</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_documento" id="bqsaiaenlace_estado_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_estado_documento" id="bksaiacondicion_estado_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_documento" name="estado_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_riesgo_antiguo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_riesgo_antiguo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_riesgo_antiguo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_riesgo_antiguo" id="bqsaiaenlace_riesgo_antiguo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="1: Riesgo o documento antiguo
2: Riesgo o documento nuevo">RIESGO ANTIGUO</td><input type="hidden" name="bksaiacondicion_riesgo_antiguo" id="bksaiacondicion_riesgo_antiguo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="riesgo_antiguo" name="riesgo_antiguo"></select><script>
                     $(document).ready(function()
                      {
                      $("#riesgo_antiguo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_identificacion_riesg">
                   <td class="encabezado" width="20%" title="">IDENTIFICACION DEL RIESGO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="identificacion_riesg" value=""></td>
                  </tr><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia" id="bqsaiaenlace_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_dependencia" id="bksaiacondicion_dependencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="dependencia" name="dependencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_riesgo" id="bqsaiaenlace_fecha_riesgo" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_riesgo_1" id="fecha_riesgo_1" tipo="fecha" value=""><?php selector_fecha("fecha_riesgo_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_riesgo_2" id="fecha_riesgo_2" tipo="fecha" value=""><?php selector_fecha("fecha_riesgo_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_estado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado" id="bqsaiaenlace_estado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Estado Actual: ELABORACION,INACTIVO ">ESTADO</td><input type="hidden" name="bksaiacondicion_estado" id="bksaiacondicion_estado" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6360,'',1,'buscar');?></td></tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Riesgos">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_consecutivo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_consecutivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_consecutivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_consecutivo" id="bqsaiaenlace_consecutivo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NUMERO</td><input type="hidden" name="bksaiacondicion_consecutivo" id="bksaiacondicion_consecutivo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo" name="consecutivo"></select><script>
                     $(document).ready(function()
                      {
                      $("#consecutivo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombre" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Actividad">ACTIVIDAD</td><input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_area_responsable" id="bqsaiaenlace_area_responsable" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="Area responsable">AREA RESPONSABLE</td><input type="hidden" name="bksaiacondicion_area_responsable" id="bksaiacondicion_area_responsable" value="like"><td bgcolor="#F5F5F5"><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6364,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_area_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_area_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php");
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_area_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_riesgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_riesgo" id="bqsaiaenlace_riesgo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Definici&oacute;n: Representa la posibilidad de ocurrencia de un evento que pueda entorpecer el normal desarrollo de las funciones de la entidad y afectar el logro de sus objetivos.">RIESGO</td><input type="hidden" name="bksaiacondicion_riesgo" id="bksaiacondicion_riesgo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="riesgo" name="riesgo"></select><script>
                     $(document).ready(function()
                      {
                      $("#riesgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_controles"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_controles',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_controles',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_controles" id="bqsaiaenlace_controles" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="controles existentes">CONTROLES EXISTENTES</td><input type="hidden" name="bksaiacondicion_controles" id="bksaiacondicion_controles" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="controles" name="controles"></select><script>
                     $(document).ready(function()
                      {
                      $("#controles").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion" id="bqsaiaenlace_descripcion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Se refiere a las caracter&iacute;sticas generales o las formas en que se observa o manifiesta el riesgo identificado.">DESCRIPCION DEL RIESGO</td><input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_riesgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_riesgo" id="bqsaiaenlace_tipo_riesgo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="RIESGO ESTRAT&Eacute;GICO: Se asocia con la forma en la que se administra la Entidad. El manejo del riesgo estrat&eacute;gico se enfoca a asuntos globales relacionados con la misi&oacute;n y el cumplimiento de los objetivos estrat&eacute;gicos, la clara definici&oacute;n de pol&iacute;ticas, dise&ntilde;o y conceptualizaci&oacute;n de la entidad por parte de la alta gerencia.


RIESGO DE IMAGEN: Est&aacute;n relacionados con la percepci&oacute;n y la confianza por parte de la ciudadan&iacute;a hacia la instituci&oacute;n.


RIESGOS OPERATIVOS: Comprenden riesgos provenientes del funcionamiento y operatividad de los sistemas de informaci&oacute;n institucional, de la definici&oacute;n de los procesos, de la estructura de la entidad, de la articulaci&oacute;n entre dependencias.


RIESGOS FINACIEROS: Se relacionan con el manejo de los recursos de la entidad que incluyen: la ejecuci&oacute;n presupuestal, la elaboraci&oacute;n de los estados financieros, los pagos, manejo de excedentes de tesorer&iacute;a y el manejo sobre los bienes.


RIESGOS DE CUMPLIMIENTO: Se asocian con la capacidad de la entidad para cumplir con los requisitos legales, contractuales, de &eacute;tica p&uacute;blica y en general con su compromiso con la comunidad.


RIESGOS DE TECNOLOGIA: Est&aacute;n relacionados con la capacidad tecnol&oacute;gica de la entidad para satisfacer sus necesidades actuales y futuras y el cumplimiento de la misi&oacute;n.


CORRUPCI&Oacute;N: Se entiende por Riesgo de Corrupci&oacute;n la posibilidad de que por acci&oacute;n u omisi&oacute;n, mediante el uso indebido del poder, de los recursos o de la informaci&oacute;n, se lesionen los intereses de una entidad y en consecuencia del Estado, para la obtenci&oacute;n de un beneficio particular.">TIPO DE RIESGO</td><input type="hidden" name="bksaiacondicion_tipo_riesgo" id="bksaiacondicion_tipo_riesgo" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6368,'',1,'buscar');?></td></tr><tr id="tr_fuente_causa"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fuente_causa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fuente_causa',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fuente_causa" id="bqsaiaenlace_fuente_causa" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Son los medios, las circunstancias y agentes generadores de riesgo. Los agentes generadores que se atienden como todos los sujetos u objetos que tienen la capacidad de originar un riesgo.">FUENTE/CAUSA</td><input type="hidden" name="bksaiacondicion_fuente_causa" id="bksaiacondicion_fuente_causa" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fuente_causa" name="fuente_causa"></select><script>
                     $(document).ready(function()
                      {
                      $("#fuente_causa").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_consecuencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_consecuencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_consecuencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_consecuencia" id="bqsaiaenlace_consecuencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Constituyen las consecuencias de la ocurrencia del riesgo sobre los objetivos de la entidad; generalmente se dan sobre las personas o bienes materiales o inmateriales con incidencias importantes tales como da&ntilde;os f&iacute;sicos y fallecimiento, sanciones, perdidas econ&oacute;micas, de informaci&oacute;n, de bienes, de imagen, de credibilidad y de confianza, interrupci&oacute;n del servicio y da&ntilde;o ambiental.">CONSECUENCIA O EFECTO</td><input type="hidden" name="bksaiacondicion_consecuencia" id="bksaiacondicion_consecuencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="consecuencia" name="consecuencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#consecuencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_opciones_manejo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_opciones_manejo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_opciones_manejo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_opciones_manejo" id="bqsaiaenlace_opciones_manejo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OPCIONES DE MANEJO</td><input type="hidden" name="bksaiacondicion_opciones_manejo" id="bksaiacondicion_opciones_manejo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="opciones_manejo" name="opciones_manejo"></select><script>
                     $(document).ready(function()
                      {
                      $("#opciones_manejo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_acciones"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_acciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_acciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_acciones" id="bqsaiaenlace_acciones" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ACCIONES</td><input type="hidden" name="bksaiacondicion_acciones" id="bksaiacondicion_acciones" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="acciones" name="acciones"></select><script>
                     $(document).ready(function()
                      {
                      $("#acciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_analisis_riego">
                   <td class="encabezado" width="20%" title="">ANALISIS DE RIESGO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="analisis_riego" value=""></td>
                  </tr><tr id="tr_responsables"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsables',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsables',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsables" id="bqsaiaenlace_responsables" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RESPONSABLES</td><input type="hidden" name="bksaiacondicion_responsables" id="bksaiacondicion_responsables" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="responsables" name="responsables"></select><script>
                     $(document).ready(function()
                      {
                      $("#responsables").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_indicador"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_indicador',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_indicador',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_indicador" id="bqsaiaenlace_indicador" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">INDICADOR</td><input type="hidden" name="bksaiacondicion_indicador" id="bksaiacondicion_indicador" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="indicador" name="indicador"></select><script>
                     $(document).ready(function()
                      {
                      $("#indicador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_cronograma"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_cronograma',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_cronograma',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_cronograma" id="bqsaiaenlace_cronograma" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CRONOGRAMA</td><input type="hidden" name="bksaiacondicion_cronograma" id="bksaiacondicion_cronograma" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="cronograma" name="cronograma"></select><script>
                     $(document).ready(function()
                      {
                      $("#cronograma").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_impacto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_impacto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_impacto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_impacto" id="bqsaiaenlace_impacto" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Por Impacto se entiende las consecuencias que puede ocasionar a la organizaci&oacute;n la materializaci&oacute;n del riesgo.

DESCRIPCION

1	Insignificante	Si el hecho llega a presentarse, tendria consecuencias o efectos minimos sobre la entidad.
2	Menor	Si el hecho llega a presentarse, tendria bajo impacto o efecto sobre la entidad.
3	Moderado	Si el hecho llega a presentarse, tendria medianas consecuencias o efectos sobre la entidad.
4	Mayor	Si el hecho llega a presentarse, tendria altas consecuencias o efectos sobre la entidad.
5	Catastrofico	Si el hecho llega a presentarse, tendria desastrosas consecuencias o efectos sobre la entidad.
">IMPACTO</td><input type="hidden" name="bksaiacondicion_impacto" id="bksaiacondicion_impacto" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6377,'',1,'buscar');?></td></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proceso);} ?><tr id="tr_probabilidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_probabilidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_probabilidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_probabilidad" id="bqsaiaenlace_probabilidad" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Por Probabilidad se entiende la posibilidad de ocurrencia de un riesgo; esta puede ser medida con criterios de frecuencia, si se ha materializado (por ejemplo: n&uacute;mero de veces en un tiempo determinado), o de factibilidad teniendo en cuenta la presencia de factores internos y externos que pueden propiciar el riesgo, aunque esta no se haya materializado.

			
NIVEL 1	DESCRIPTOR Raro DESCRIPCION El evento puede ocurrir solo en circunstancias excepcionales FRECUENCIA No se ha presentado en los ultimos 5 a&ntilde;os.
NIVEL 2 DESCRIPTOR	Improbable DESCRIPCION El evento puede ocurrir en cualquier momento FRECUENCIA Al menos de una vez en los ultimos 5 a&ntilde;os.
NIVEL 3 DESCRIPTOR	Posible DESCRIPCION El evento podria ocurrir en algun momento FRECUENCIA Al menos de una vez en los ultimos 2 a&ntilde;os.
NIVEL 4 DESCRIPTOR	Probable DESCRIPCION El evento probablemente ocurrira en la mayoria de las circunstancias FRECUENCIA Al menos de una vez en el ultimo a&ntilde;o.
NIVEL 5 DESCRIPTOR	Casi Seguro DESCRIPCION Se espera que el evento ocurra en la mayoria de las circunstancias	FRECUENCIA Mas de una vez al a&ntilde;o.
">PROBABILIDAD</td><input type="hidden" name="bksaiacondicion_probabilidad" id="bksaiacondicion_probabilidad" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6379,'',1,'buscar');?></td></tr><tr id="tr_idft_riesgos_proceso"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_riesgos_proceso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_riesgos_proceso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_riesgos_proceso" id="bqsaiaenlace_idft_riesgos_proceso" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RIESGOS_PROCESO</td><input type="hidden" name="bksaiacondicion_idft_riesgos_proceso" id="bksaiacondicion_idft_riesgos_proceso" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_riesgos_proceso" name="idft_riesgos_proceso"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_riesgos_proceso").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_documento_iddocumento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_iddocumento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_iddocumento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_documento_iddocumento" id="bqsaiaenlace_documento_iddocumento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DOCUMENTO ASOCIADO</td><input type="hidden" name="bksaiacondicion_documento_iddocumento" id="bksaiacondicion_documento_iddocumento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="documento_iddocumento" name="documento_iddocumento"></select><script>
                     $(document).ready(function()
                      {
                      $("#documento_iddocumento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_encabezado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_encabezado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_encabezado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_encabezado" id="bqsaiaenlace_encabezado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ENCABEZADO</td><input type="hidden" name="bksaiacondicion_encabezado" id="bksaiacondicion_encabezado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="encabezado" name="encabezado"></select><script>
                     $(document).ready(function()
                      {
                      $("#encabezado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_firma"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_firma',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_firma',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_firma" id="bqsaiaenlace_firma" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FIRMAS DIGITALES</td><input type="hidden" name="bksaiacondicion_firma" id="bksaiacondicion_firma" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="firma" name="firma"></select><script>
                     $(document).ready(function()
                      {
                      $("#firma").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6365,6367"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?>">
             <?php  }
              else{ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?>">
             <?php  } ?></form></body></html>