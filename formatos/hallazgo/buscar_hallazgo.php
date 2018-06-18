<html><title>.: HALLAZGO PLAN DE MEJORAMIENTO:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA HALLAZGO PLAN DE MEJORAMIENTO</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_notifica_cump"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_notifica_cump',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_notifica_cump',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_notifica_cump" id="bqsaiaenlace_notifica_cump" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Utilizado para la transferencia de la tarea programda">NOTIFICACION CUMPLIMIENTO</td><input type="hidden" name="bksaiacondicion_notifica_cump" id="bksaiacondicion_notifica_cump" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="notifica_cump" name="notifica_cump"></select><script>
                     $(document).ready(function()
                      {
                      $("#notifica_cump").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_notifica_seg"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_notifica_seg',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_notifica_seg',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_notifica_seg" id="bqsaiaenlace_notifica_seg" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NOTIFICACION SEGUIMIENTO</td><input type="hidden" name="bksaiacondicion_notifica_seg" id="bksaiacondicion_notifica_seg" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="notifica_seg" name="notifica_seg"></select><script>
                     $(document).ready(function()
                      {
                      $("#notifica_seg").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_ft_gestion_calid"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ft_gestion_calid',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ft_gestion_calid',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ft_gestion_calid" id="bqsaiaenlace_ft_gestion_calid" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">GESTION CALIDAD</td><input type="hidden" name="bksaiacondicion_ft_gestion_calid" id="bksaiacondicion_ft_gestion_calid" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="ft_gestion_calid" name="ft_gestion_calid"></select><script>
                     $(document).ready(function()
                      {
                      $("#ft_gestion_calid").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_clase_accion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_clase_accion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_clase_accion" id="bqsaiaenlace_clase_accion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CLASE ACCION</td><input type="hidden" name="bksaiacondicion_clase_accion" id="bksaiacondicion_clase_accion" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6094,'',1,'buscar');?></td></tr><tr id="tr_radicado_plan"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_radicado_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_radicado_plan',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_radicado_plan" id="bqsaiaenlace_radicado_plan" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RADICADO DEL PLAN VINCULADO</td><input type="hidden" name="bksaiacondicion_radicado_plan" id="bksaiacondicion_radicado_plan" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="radicado_plan" name="radicado_plan"></select><script>
                     $(document).ready(function()
                      {
                      $("#radicado_plan").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_consecutivo_hallazgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_consecutivo_hallazgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_consecutivo_hallazgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_consecutivo_hallazgo" id="bqsaiaenlace_consecutivo_hallazgo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td><input type="hidden" name="bksaiacondicion_consecutivo_hallazgo" id="bksaiacondicion_consecutivo_hallazgo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo_hallazgo" name="consecutivo_hallazgo"></select><script>
                     $(document).ready(function()
                      {
                      $("#consecutivo_hallazgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_procesos_vinculados',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_procesos_vinculados',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_procesos_vinculados" id="bqsaiaenlace_procesos_vinculados" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="Procesos Vinculados">PROCESOS VINCULADOS</td><input type="hidden" name="bksaiacondicion_procesos_vinculados" id="bksaiacondicion_procesos_vinculados" value="like"><td bgcolor="#F5F5F5"><div id="esperando_procesos_vinculados"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6097,'3',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_procesos_vinculados" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem((document.getElementById('stext_procesos_vinculados').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem((document.getElementById('stext_procesos_vinculados').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem((document.getElementById('stext_procesos_vinculados').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_procesos_vinculados" height="90%"></div><input type="hidden" maxlength="255"  name="procesos_vinculados" id="procesos_vinculados"   value="" ><label style="display:none" class="error" for="procesos_vinculados">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_procesos_vinculados=new dhtmlXTreeObject("treeboxbox_procesos_vinculados","100%","100%",0);
                			tree_procesos_vinculados.setImagePath("../../imgs/");
                			tree_procesos_vinculados.enableIEImageFix(true);tree_procesos_vinculados.enableCheckBoxes(1);
                			tree_procesos_vinculados.enableThreeStateCheckboxes(1);tree_procesos_vinculados.setOnLoadingStart(cargando_procesos_vinculados);
                      tree_procesos_vinculados.setOnLoadingEnd(fin_cargando_procesos_vinculados);tree_procesos_vinculados.enableSmartXMLParsing(true);tree_procesos_vinculados.loadXML("test_procesos.php");
                      tree_procesos_vinculados.setOnCheckHandler(onNodeSelect_procesos_vinculados);
                      function onNodeSelect_procesos_vinculados(nodeId)
                      {valor_destino=document.getElementById("procesos_vinculados");
                       destinos=tree_procesos_vinculados.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_procesos_vinculados.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_procesos_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_procesos_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_procesos_vinculados")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_procesos_vinculados"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_procesos_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_procesos_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_procesos_vinculados")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_procesos_vinculados"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_clase_observacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_clase_observacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_clase_observacion" id="bqsaiaenlace_clase_observacion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CLASE DE OBSERVACI&Oacute;N</td><input type="hidden" name="bksaiacondicion_clase_observacion" id="bksaiacondicion_clase_observacion" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6098,'',1,'buscar');?></td></tr><tr id="tr_deficiencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_deficiencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_deficiencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_deficiencia" id="bqsaiaenlace_deficiencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">HALLAZGO</td><input type="hidden" name="bksaiacondicion_deficiencia" id="bksaiacondicion_deficiencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="deficiencia" name="deficiencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#deficiencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_correcion_hallazgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_correcion_hallazgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_correcion_hallazgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_correcion_hallazgo" id="bqsaiaenlace_correcion_hallazgo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CORRECCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_correcion_hallazgo" id="bksaiacondicion_correcion_hallazgo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="correcion_hallazgo" name="correcion_hallazgo"></select><script>
                     $(document).ready(function()
                      {
                      $("#correcion_hallazgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_causas"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_causas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_causas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_causas" id="bqsaiaenlace_causas" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CAUSAS</td><input type="hidden" name="bksaiacondicion_causas" id="bksaiacondicion_causas" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="causas" name="causas"></select><script>
                     $(document).ready(function()
                      {
                      $("#causas").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_accion_mejoramiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_accion_mejoramiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_accion_mejoramiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_accion_mejoramiento" id="bqsaiaenlace_accion_mejoramiento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ACCI&Oacute;N CORRECTIVA/PREVENTIVA Y/O MEJORA</td><input type="hidden" name="bksaiacondicion_accion_mejoramiento" id="bksaiacondicion_accion_mejoramiento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="accion_mejoramiento" name="accion_mejoramiento"></select><script>
                     $(document).ready(function()
                      {
                      $("#accion_mejoramiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_secretarias',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_secretarias',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_secretarias" id="bqsaiaenlace_secretarias" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">AREA RESPONSABLE</td><input type="hidden" name="bksaiacondicion_secretarias" id="bksaiacondicion_secretarias" value="like"><td bgcolor="#F5F5F5"><div id="esperando_secretarias"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6104,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_secretarias" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_secretarias.findItem((document.getElementById('stext_secretarias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_secretarias" height="90%"></div><input type="hidden" maxlength="255"  name="secretarias" id="secretarias"   value="" ><label style="display:none" class="error" for="secretarias">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_secretarias=new dhtmlXTreeObject("treeboxbox_secretarias","100%","100%",0);
                			tree_secretarias.setImagePath("../../imgs/");
                			tree_secretarias.enableIEImageFix(true);tree_secretarias.enableCheckBoxes(1);
                			tree_secretarias.enableThreeStateCheckboxes(1);tree_secretarias.setOnLoadingStart(cargando_secretarias);
                      tree_secretarias.setOnLoadingEnd(fin_cargando_secretarias);tree_secretarias.enableSmartXMLParsing(true);tree_secretarias.loadXML("../../test_serie.php?tabla=dependencia");
                      tree_secretarias.setOnCheckHandler(onNodeSelect_secretarias);
                      function onNodeSelect_secretarias(nodeId)
                      {valor_destino=document.getElementById("secretarias");
                       destinos=tree_secretarias.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_secretarias.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_secretarias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretarias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretarias")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_secretarias"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_secretarias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretarias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretarias")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_secretarias"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsables',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsables',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsables" id="bqsaiaenlace_responsables" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">RESPONSABLES DE MEJORAMIENTO</td><input type="hidden" name="bksaiacondicion_responsables" id="bksaiacondicion_responsables" value="like"><td bgcolor="#F5F5F5"><div id="esperando_responsables"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6105,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsables" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsables.findItem((document.getElementById('stext_responsables').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsables.findItem((document.getElementById('stext_responsables').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsables.findItem((document.getElementById('stext_responsables').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsables" height="90%"></div><input type="hidden" maxlength="255"  name="responsables" id="responsables"   value="" ><label style="display:none" class="error" for="responsables">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsables=new dhtmlXTreeObject("treeboxbox_responsables","100%","100%",0);
                			tree_responsables.setImagePath("../../imgs/");
                			tree_responsables.enableIEImageFix(true);tree_responsables.enableCheckBoxes(1);
                			tree_responsables.enableThreeStateCheckboxes(1);tree_responsables.setOnLoadingStart(cargando_responsables);
                      tree_responsables.setOnLoadingEnd(fin_cargando_responsables);tree_responsables.enableSmartXMLParsing(true);tree_responsables.loadXML("../../test.php?sin_padre=1");
                      tree_responsables.setOnCheckHandler(onNodeSelect_responsables);
                      function onNodeSelect_responsables(nodeId)
                      {valor_destino=document.getElementById("responsables");
                       destinos=tree_responsables.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_responsables.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsables")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsables"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsables")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsables"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_tiempo_cumplimiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tiempo_cumplimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tiempo_cumplimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tiempo_cumplimiento" id="bqsaiaenlace_tiempo_cumplimiento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIEMPO PROGRAMADO PARA CUMPLIMIENTO</td><input type="hidden" name="bksaiacondicion_tiempo_cumplimiento" id="bksaiacondicion_tiempo_cumplimiento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="tiempo_cumplimiento" name="tiempo_cumplimiento"></select><script>
                     $(document).ready(function()
                      {
                      $("#tiempo_cumplimiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tiempo_seguimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tiempo_seguimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tiempo_seguimiento" id="bqsaiaenlace_tiempo_seguimiento" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">TIEMPO PROGRAMADO PARA SEGUIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="tiempo_seguimiento_1" id="tiempo_seguimiento_1" tipo="fecha" value=""><?php selector_fecha("tiempo_seguimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="tiempo_seguimiento_2" id="tiempo_seguimiento_2" tipo="fecha" value=""><?php selector_fecha("tiempo_seguimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable_seguimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable_seguimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable_seguimiento" id="bqsaiaenlace_responsable_seguimiento" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">RESPONSABLES DE SEGUIMIENTO</td><input type="hidden" name="bksaiacondicion_responsable_seguimiento" id="bksaiacondicion_responsable_seguimiento" value="like"><td bgcolor="#F5F5F5"><div id="esperando_responsable_seguimiento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6108,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable_seguimiento" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem((document.getElementById('stext_responsable_seguimiento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem((document.getElementById('stext_responsable_seguimiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem((document.getElementById('stext_responsable_seguimiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable_seguimiento" height="90%"></div><input type="hidden" maxlength="255"  name="responsable_seguimiento" id="responsable_seguimiento"   value="" ><label style="display:none" class="error" for="responsable_seguimiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_seguimiento=new dhtmlXTreeObject("treeboxbox_responsable_seguimiento","100%","100%",0);
                			tree_responsable_seguimiento.setImagePath("../../imgs/");
                			tree_responsable_seguimiento.enableIEImageFix(true);tree_responsable_seguimiento.enableCheckBoxes(1);
                			tree_responsable_seguimiento.enableThreeStateCheckboxes(1);tree_responsable_seguimiento.setOnLoadingStart(cargando_responsable_seguimiento);
                      tree_responsable_seguimiento.setOnLoadingEnd(fin_cargando_responsable_seguimiento);tree_responsable_seguimiento.enableSmartXMLParsing(true);tree_responsable_seguimiento.loadXML("../../test.php?sin_padre=1");
                      tree_responsable_seguimiento.setOnCheckHandler(onNodeSelect_responsable_seguimiento);
                      function onNodeSelect_responsable_seguimiento(nodeId)
                      {valor_destino=document.getElementById("responsable_seguimiento");
                       destinos=tree_responsable_seguimiento.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_responsable_seguimiento.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seguimiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_seguimiento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seguimiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_seguimiento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_indicador_cumplimiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_indicador_cumplimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_indicador_cumplimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_indicador_cumplimiento" id="bqsaiaenlace_indicador_cumplimiento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">INDICADOR DE ACCI&Oacute;N DE CUMPLIMIENTO</td><input type="hidden" name="bksaiacondicion_indicador_cumplimiento" id="bksaiacondicion_indicador_cumplimiento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="indicador_cumplimiento" name="indicador_cumplimiento"></select><script>
                     $(document).ready(function()
                      {
                      $("#indicador_cumplimiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_observaciones"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_observaciones" id="bqsaiaenlace_observaciones" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><input type="hidden" name="bksaiacondicion_observaciones" id="bksaiacondicion_observaciones" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function()
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_mecanismo_interno"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_mecanismo_interno',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_mecanismo_interno',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_mecanismo_interno" id="bqsaiaenlace_mecanismo_interno" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="mecanismo_interno">MECANISMO DE SEGUIMIENTO INTERNO</td><input type="hidden" name="bksaiacondicion_mecanismo_interno" id="bksaiacondicion_mecanismo_interno" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="mecanismo_interno" name="mecanismo_interno"></select><script>
                     $(document).ready(function()
                      {
                      $("#mecanismo_interno").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Hallazgo Plan de Mejoramiento">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
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
                    </tr><tr id="tr_idft_hallazgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_hallazgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_hallazgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_hallazgo" id="bqsaiaenlace_idft_hallazgo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">HALLAZGO</td><input type="hidden" name="bksaiacondicion_idft_hallazgo" id="bksaiacondicion_idft_hallazgo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_hallazgo" name="idft_hallazgo"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_hallazgo").fcbkcomplete({
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
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_plan_mejoramiento"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_plan_mejoramiento"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_plan_mejoramiento);} ?><input type="hidden" name="campo_descripcion" value="6095,6096,6099"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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