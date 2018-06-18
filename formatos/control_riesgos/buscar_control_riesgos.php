<html><title>.: 1. VALORACION CONTROLES RIESGOS:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 1. VALORACION CONTROLES RIESGOS</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr></td></tr><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_consecutivo_control"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_consecutivo_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_consecutivo_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_consecutivo_control" id="bqsaiaenlace_consecutivo_control" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td><input type="hidden" name="bksaiacondicion_consecutivo_control" id="bksaiacondicion_consecutivo_control" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo_control" name="consecutivo_control"></select><script>
                     $(document).ready(function()
                      {
                      $("#consecutivo_control").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_valoracion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_valoracion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_valoracion" id="bqsaiaenlace_fecha_valoracion" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA VALORACION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_valoracion_1" id="fecha_valoracion_1" tipo="fecha" value=""><?php selector_fecha("fecha_valoracion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_valoracion_2" id="fecha_valoracion_2" tipo="fecha" value=""><?php selector_fecha("fecha_valoracion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_descripcion_control"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion_control" id="bqsaiaenlace_descripcion_control" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Descripci&oacute;n del control existente:

Hacer una descripci&oacute;n en  forma detallada del control Existente que se tiene implementado.">DESCRIPCION DEL CONTROL EXISTENTE</td><input type="hidden" name="bksaiacondicion_descripcion_control" id="bksaiacondicion_descripcion_control" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_control" name="descripcion_control"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion_control").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_control"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_control" id="bqsaiaenlace_tipo_control" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Los controles luego de su valoraci&oacute;n permiten desplazarse en la matriz, de acuerdo a si afecta probabilidad o impacto, en el caso de la probabilidad desplazar&iacute;a casillas hacia arriba y en el caso del impacto, hacia la izquierda de acuerdo a la valoraci&oacute;n de controles.
Es por ello que se debe seleccionar si el control existente me permite disminuir el nivel de probabilidad o el nivel de impacto.">EL CONTROL AFECTA?</td><input type="hidden" name="bksaiacondicion_tipo_control" id="bksaiacondicion_tipo_control" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6388,'',1,'buscar');?></td></tr><tr id="tr_desplazamiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_desplazamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_desplazamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_desplazamiento" id="bqsaiaenlace_desplazamiento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESPLAZAMIENTO EN LA MATRIZ</td><input type="hidden" name="bksaiacondicion_desplazamiento" id="bksaiacondicion_desplazamiento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="desplazamiento" name="desplazamiento"></select><script>
                     $(document).ready(function()
                      {
                      $("#desplazamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_riesgos_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_riesgos_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_riesgos_proceso);} ?><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="1. Valoracion Controles Riesgos">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_herramientas_ejercer">
                   <td class="encabezado" width="20%" title="">HERRAMIENTAS PARA EJERCER EL CONTROL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="herramientas_ejercer" value=""></td>
                  </tr><tr id="tr_herramienta_ejercer"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_herramienta_ejercer',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_herramienta_ejercer',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_herramienta_ejercer" id="bqsaiaenlace_herramienta_ejercer" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">1. POSEE UNA HERRAMIENTA PARA EJERCER EL CONTROL?</td><input type="hidden" name="bksaiacondicion_herramienta_ejercer" id="bksaiacondicion_herramienta_ejercer" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6393,'',1,'buscar');?></td></tr><tr id="tr_desc_herramienta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_desc_herramienta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_desc_herramienta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_desc_herramienta" id="bqsaiaenlace_desc_herramienta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE LA HERRAMIENTA</td><input type="hidden" name="bksaiacondicion_desc_herramienta" id="bksaiacondicion_desc_herramienta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="desc_herramienta" name="desc_herramienta"></select><script>
                     $(document).ready(function()
                      {
                      $("#desc_herramienta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexar_herramienta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexar_herramienta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexar_herramienta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexar_herramienta" id="bqsaiaenlace_anexar_herramienta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXAR HERRAMIENTA</td><input type="hidden" name="bksaiacondicion_anexar_herramienta" id="bksaiacondicion_anexar_herramienta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexar_herramienta" name="anexar_herramienta"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexar_herramienta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_procedimiento_herram"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_procedimiento_herram',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_procedimiento_herram',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_procedimiento_herram" id="bqsaiaenlace_procedimiento_herram" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">2. EXISTEN MANUALES, INSTRUCTIVOS O PROCEDIMIENTOS PARA EL MANEJO DE LA HERRAMIENTA?</td><input type="hidden" name="bksaiacondicion_procedimiento_herram" id="bksaiacondicion_procedimiento_herram" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6396,'',1,'buscar');?></td></tr><tr id="tr_desc_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_desc_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_desc_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_desc_documento" id="bqsaiaenlace_desc_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_desc_documento" id="bksaiacondicion_desc_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="desc_documento" name="desc_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#desc_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexar_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexar_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexar_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexar_documento" id="bqsaiaenlace_anexar_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXAR DOCUMENTO</td><input type="hidden" name="bksaiacondicion_anexar_documento" id="bksaiacondicion_anexar_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexar_documento" name="anexar_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexar_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_herramienta_efectiva"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_herramienta_efectiva',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_herramienta_efectiva',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_herramienta_efectiva" id="bqsaiaenlace_herramienta_efectiva" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">3. EN EL TIEMPO QUE LLEVA LA HERRAMIENTA, HA DEMOSTRADO SER EFECTIVA?</td><input type="hidden" name="bksaiacondicion_herramienta_efectiva" id="bksaiacondicion_herramienta_efectiva" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6399,'',1,'buscar');?></td></tr><tr id="tr_pregunta_porque"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_pregunta_porque',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_pregunta_porque',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_pregunta_porque" id="bqsaiaenlace_pregunta_porque" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">POR QU&Eacute;?</td><input type="hidden" name="bksaiacondicion_pregunta_porque" id="bksaiacondicion_pregunta_porque" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="pregunta_porque" name="pregunta_porque"></select><script>
                     $(document).ready(function()
                      {
                      $("#pregunta_porque").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_seguimiento_al_contr">
                   <td class="encabezado" width="20%" title="">SEGUIMIENTO AL CONTROL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="seguimiento_al_contr" value=""></td>
                  </tr><tr id="tr_responsables_ejecuci"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsables_ejecuci',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsables_ejecuci',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsables_ejecuci" id="bqsaiaenlace_responsables_ejecuci" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">4. ESTAN DEFINIDOS LOS RESPONSABLES DE LA EJECUCION DEL CONTROL Y DEL SEGUIMIENTO?</td><input type="hidden" name="bksaiacondicion_responsables_ejecuci" id="bksaiacondicion_responsables_ejecuci" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6402,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable_seg',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable_seg',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable_seg" id="bqsaiaenlace_responsable_seg" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">QUIEN ES EL RESPONSABLES DE LA EJECUCI&OACUTE;N DEL CONTROL</td><input type="hidden" name="bksaiacondicion_responsable_seg" id="bksaiacondicion_responsable_seg" value="like"><td bgcolor="#F5F5F5"><div id="esperando_responsable_seg"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6403,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable_seg" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable_seg" height="90%"></div><input type="hidden" maxlength="255"  name="responsable_seg" id="responsable_seg"   value="" ><label style="display:none" class="error" for="responsable_seg">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_seg=new dhtmlXTreeObject("treeboxbox_responsable_seg","100%","100%",0);
                			tree_responsable_seg.setImagePath("../../imgs/");
                			tree_responsable_seg.enableIEImageFix(true);tree_responsable_seg.enableCheckBoxes(1);
                			tree_responsable_seg.enableThreeStateCheckboxes(1);tree_responsable_seg.setOnLoadingStart(cargando_responsable_seg);
                      tree_responsable_seg.setOnLoadingEnd(fin_cargando_responsable_seg);tree_responsable_seg.enableSmartXMLParsing(true);tree_responsable_seg.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable_seg.setOnCheckHandler(onNodeSelect_responsable_seg);
                      function onNodeSelect_responsable_seg(nodeId)
                      {valor_destino=document.getElementById("responsable_seg");
                       destinos=tree_responsable_seg.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_responsable_seg.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_respon_seguimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_respon_seguimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_respon_seguimiento" id="bqsaiaenlace_respon_seguimiento" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">QUIEN ES EL RESPONSABLES DE LA EJECUCI&OACUTE;N DEL SEGUIMIENTO</td><input type="hidden" name="bksaiacondicion_respon_seguimiento" id="bksaiacondicion_respon_seguimiento" value="like"><td bgcolor="#F5F5F5"><div id="esperando_respon_seguimiento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6404,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_respon_seguimiento" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_respon_seguimiento" height="90%"></div><input type="hidden" maxlength="255"  name="respon_seguimiento" id="respon_seguimiento"   value="" ><label style="display:none" class="error" for="respon_seguimiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_respon_seguimiento=new dhtmlXTreeObject("treeboxbox_respon_seguimiento","100%","100%",0);
                			tree_respon_seguimiento.setImagePath("../../imgs/");
                			tree_respon_seguimiento.enableIEImageFix(true);tree_respon_seguimiento.enableCheckBoxes(1);
                			tree_respon_seguimiento.enableThreeStateCheckboxes(1);tree_respon_seguimiento.setOnLoadingStart(cargando_respon_seguimiento);
                      tree_respon_seguimiento.setOnLoadingEnd(fin_cargando_respon_seguimiento);tree_respon_seguimiento.enableSmartXMLParsing(true);tree_respon_seguimiento.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_respon_seguimiento.setOnCheckHandler(onNodeSelect_respon_seguimiento);
                      function onNodeSelect_respon_seguimiento(nodeId)
                      {valor_destino=document.getElementById("respon_seguimiento");
                       destinos=tree_respon_seguimiento.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_respon_seguimiento.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_frecuencia_ejecucion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_frecuencia_ejecucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_frecuencia_ejecucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_frecuencia_ejecucion" id="bqsaiaenlace_frecuencia_ejecucion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">5. LA FRECUENCIA DE LA EJECUCION DEL CONTROL Y SEGUIMIENTO ES ADECUADO?</td><input type="hidden" name="bksaiacondicion_frecuencia_ejecucion" id="bksaiacondicion_frecuencia_ejecucion" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6405,'',1,'buscar');?></td></tr><tr id="tr_cual_frecuencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_cual_frecuencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_cual_frecuencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_cual_frecuencia" id="bqsaiaenlace_cual_frecuencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CUAL ES LA FRECUENCIA</td><input type="hidden" name="bksaiacondicion_cual_frecuencia" id="bksaiacondicion_cual_frecuencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="cual_frecuencia" name="cual_frecuencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#cual_frecuencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_control_riesgos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_control_riesgos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_control_riesgos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_control_riesgos" id="bqsaiaenlace_idft_control_riesgos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONTROL_RIESGOS</td><input type="hidden" name="bksaiacondicion_idft_control_riesgos" id="bksaiacondicion_idft_control_riesgos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_control_riesgos" name="idft_control_riesgos"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_control_riesgos").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="6387"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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