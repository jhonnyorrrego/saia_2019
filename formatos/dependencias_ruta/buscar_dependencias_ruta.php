<html><title>.: DEPENDENCIAS DE LA RUTA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DEPENDENCIAS DE LA RUTA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_orden_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_orden_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_orden_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_orden_dependencia" id="bqsaiaenlace_orden_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ORDEN_DEPENDENCIA</td><input type="hidden" name="bksaiacondicion_orden_dependencia" id="bksaiacondicion_orden_dependencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="orden_dependencia" name="orden_dependencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#orden_dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_dependencia" id="bqsaiaenlace_estado_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO_DEPENDENCIA</td><input type="hidden" name="bksaiacondicion_estado_dependencia" id="bksaiacondicion_estado_dependencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_dependencia" name="estado_dependencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_item_dependenc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_item_dependenc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_item_dependenc" id="bqsaiaenlace_fecha_item_dependenc" value="y" />
		</div>
                    <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_item_dependenc_1" style="width: 100px;" id="fecha_item_dependenc_1" value=""><?php selector_fecha("fecha_item_dependenc_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_item_dependenc_2" style="width: 100px;" id="fecha_item_dependenc_2" value=""><?php selector_fecha("fecha_item_dependenc_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Dependencias de la Ruta">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia_asignada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia_asignada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia_asignada" id="bqsaiaenlace_dependencia_asignada" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">DEPENDENCIA</td><input type="hidden" name="bksaiacondicion_dependencia_asignada" id="bksaiacondicion_dependencia_asignada" value="like"><td bgcolor="#F5F5F5"><div id="esperando_dependencia_asignada"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(405,4995,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_dependencia_asignada" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),1)"><img src="../../assets/images/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),0,1)"><img src="../../assets/images/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value))"><img src="../../assets/images/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_dependencia_asignada" height="90%"></div><input type="hidden" maxlength="255"  name="dependencia_asignada" id="dependencia_asignada"   value="" ><label style="display:none" class="error" for="dependencia_asignada">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencia_asignada=new dhtmlXTreeObject("treeboxbox_dependencia_asignada","100%","100%",0);
                			tree_dependencia_asignada.setImagePath("../../imgs/");
                			tree_dependencia_asignada.enableIEImageFix(true);tree_dependencia_asignada.enableCheckBoxes(1);
                    tree_dependencia_asignada.enableRadioButtons(true);tree_dependencia_asignada.setOnLoadingStart(cargando_dependencia_asignada);
                      tree_dependencia_asignada.setOnLoadingEnd(fin_cargando_dependencia_asignada);tree_dependencia_asignada.enableSmartXMLParsing(true);tree_dependencia_asignada.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_dependencia_asignada.setOnCheckHandler(onNodeSelect_dependencia_asignada);
                      function onNodeSelect_dependencia_asignada(nodeId)
                      {valor_destino=document.getElementById("dependencia_asignada");
                       destinos=tree_dependencia_asignada.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_dependencia_asignada.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_dependencia_asignada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_asignada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_asignada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencia_asignada"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_dependencia_asignada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_asignada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_asignada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencia_asignada"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_descripcion_dependen"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion_dependen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion_dependen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion_dependen" id="bqsaiaenlace_descripcion_dependen" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESCRIPCIÃ³N</td><input type="hidden" name="bksaiacondicion_descripcion_dependen" id="bksaiacondicion_descripcion_dependen" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_dependen" name="descripcion_dependen"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion_dependen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_dependencias_ruta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_dependencias_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_dependencias_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_dependencias_ruta" id="bqsaiaenlace_idft_dependencias_ruta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DEPENDENCIAS_RUTA</td><input type="hidden" name="bksaiacondicion_idft_dependencias_ruta" id="bksaiacondicion_idft_dependencias_ruta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_dependencias_ruta" name="idft_dependencias_ruta"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_dependencias_ruta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_ruta_distribucion"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_ruta_distribucion"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_ruta_distribucion);} ?><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="dependencias_ruta"><?php submit_formato(405);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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