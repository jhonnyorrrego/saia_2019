<html><title>.: DISTRIBUCI&OACUTE;N F&IACUTE;SICA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DISTRIBUCI&Oacute;N F&Iacute;SICA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_fecha_recibido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_recibido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_recibido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_recibido" id="bqsaiaenlace_fecha_recibido" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA RECIBIDO</td><input type="hidden" name="bksaiacondicion_fecha_recibido" id="bksaiacondicion_fecha_recibido" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_recibido" name="fecha_recibido"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_recibido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_usuario_recibido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_usuario_recibido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_usuario_recibido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_usuario_recibido" id="bqsaiaenlace_usuario_recibido" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">USUARIO RECIBIDO</td><input type="hidden" name="bksaiacondicion_usuario_recibido" id="bksaiacondicion_usuario_recibido" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="usuario_recibido" name="usuario_recibido"></select><script>
                     $(document).ready(function()
                      {
                      $("#usuario_recibido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_entregado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_entregado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_entregado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_entregado" id="bqsaiaenlace_fecha_entregado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA ENTREGADO</td><input type="hidden" name="bksaiacondicion_fecha_entregado" id="bksaiacondicion_fecha_entregado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_entregado" name="fecha_entregado"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_entregado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_usuario_entregado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_usuario_entregado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_usuario_entregado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_usuario_entregado" id="bqsaiaenlace_usuario_entregado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">USUARIO ENTREGADO</td><input type="hidden" name="bksaiacondicion_usuario_entregado" id="bksaiacondicion_usuario_entregado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="usuario_entregado" name="usuario_entregado"></select><script>
                     $(document).ready(function()
                      {
                      $("#usuario_entregado").fcbkcomplete({
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
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_radicacion_entrada"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_radicacion_entrada"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_radicacion_entrada);} ?><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Distribuci&oacute;n F&iacute;sica">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_documento" id="bqsaiaenlace_fecha_documento" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_documento_1" id="fecha_documento_1" tipo="fecha" value=""><?php selector_fecha("fecha_documento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_documento_2" id="fecha_documento_2" tipo="fecha" value=""><?php selector_fecha("fecha_documento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_mensajero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_mensajero',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_mensajero" id="bqsaiaenlace_nombre_mensajero" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">NOMBRE DE MENSAJERO</td><input type="hidden" name="bksaiacondicion_nombre_mensajero" id="bksaiacondicion_nombre_mensajero" value="like"><td bgcolor="#F5F5F5"><div id="esperando_nombre_mensajero"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(272,3126,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre_mensajero" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre_mensajero" height="90%"></div><input type="hidden" maxlength="255"  name="nombre_mensajero" id="nombre_mensajero"   value="" ><label style="display:none" class="error" for="nombre_mensajero">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_mensajero=new dhtmlXTreeObject("treeboxbox_nombre_mensajero","100%","100%",0);
                			tree_nombre_mensajero.setImagePath("../../imgs/");
                			tree_nombre_mensajero.enableIEImageFix(true);tree_nombre_mensajero.enableCheckBoxes(1);
                    tree_nombre_mensajero.enableRadioButtons(true);tree_nombre_mensajero.setOnLoadingStart(cargando_nombre_mensajero);
                      tree_nombre_mensajero.setOnLoadingEnd(fin_cargando_nombre_mensajero);tree_nombre_mensajero.enableSmartXMLParsing(true);tree_nombre_mensajero.loadXML("../../test.php?rol=1");
                      tree_nombre_mensajero.setOnCheckHandler(onNodeSelect_nombre_mensajero);
                      function onNodeSelect_nombre_mensajero(nodeId)
                      {valor_destino=document.getElementById("nombre_mensajero");
                       destinos=tree_nombre_mensajero.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_nombre_mensajero.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre_mensajero() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_mensajero")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_mensajero")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_mensajero"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_mensajero() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_mensajero")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_mensajero")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_mensajero"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_nivel_urgencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nivel_urgencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nivel_urgencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nivel_urgencia" id="bqsaiaenlace_nivel_urgencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO</td><input type="hidden" name="bksaiacondicion_nivel_urgencia" id="bksaiacondicion_nivel_urgencia" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(272,3135,'',1,'buscar');?></td></tr><tr id="tr_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESTINO</td><input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="destino" name="destino"></select><script>
                     $(document).ready(function()
                      {
                      $("#destino").fcbkcomplete({
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
                    </tr><tr id="tr_idft_distribucion_fisica"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_distribucion_fisica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_distribucion_fisica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_distribucion_fisica" id="bqsaiaenlace_idft_distribucion_fisica" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DISTRIBUCION_FISICA</td><input type="hidden" name="bksaiacondicion_idft_distribucion_fisica" id="bksaiacondicion_idft_distribucion_fisica" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_distribucion_fisica" name="idft_distribucion_fisica"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_distribucion_fisica").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="3125"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(272);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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