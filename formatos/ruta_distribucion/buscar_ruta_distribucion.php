<html><title>.: RUTAS DE DISTRIBUCI&OACUTE;N:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RUTAS DE DISTRIBUCI&Oacute;N</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_fecha_ruta_distribuc"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_ruta_distribuc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_ruta_distribuc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_ruta_distribuc" id="bqsaiaenlace_fecha_ruta_distribuc" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA</td><input type="hidden" name="bksaiacondicion_fecha_ruta_distribuc" id="bksaiacondicion_fecha_ruta_distribuc" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_ruta_distribuc" name="fecha_ruta_distribuc"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_ruta_distribuc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre_ruta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_ruta" id="bqsaiaenlace_nombre_ruta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA RUTA</td><input type="hidden" name="bksaiacondicion_nombre_ruta" id="bksaiacondicion_nombre_ruta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_ruta" name="nombre_ruta"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre_ruta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion_ruta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion_ruta" id="bqsaiaenlace_descripcion_ruta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N RUTA</td><input type="hidden" name="bksaiacondicion_descripcion_ruta" id="bksaiacondicion_descripcion_ruta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_ruta" name="descripcion_ruta"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion_ruta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asignar_dependencias',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asignar_dependencias',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asignar_dependencias" id="bqsaiaenlace_asignar_dependencias" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">DEPENDENCIAS DE LA RUTA</td><input type="hidden" name="bksaiacondicion_asignar_dependencias" id="bksaiacondicion_asignar_dependencias" value="like"><td bgcolor="#F5F5F5"><div id="esperando_asignar_dependencias"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(404,4998,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_asignar_dependencias" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_asignar_dependencias" height="90%"></div><input type="hidden"  name="asignar_dependencias" id="asignar_dependencias"   value="" ><label style="display:none" class="error" for="asignar_dependencias">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_asignar_dependencias=new dhtmlXTreeObject("treeboxbox_asignar_dependencias","100%","100%",0);
                			tree_asignar_dependencias.setImagePath("../../imgs/");
                			tree_asignar_dependencias.enableIEImageFix(true);tree_asignar_dependencias.enableCheckBoxes(1);
                			tree_asignar_dependencias.enableThreeStateCheckboxes(1);tree_asignar_dependencias.setOnLoadingStart(cargando_asignar_dependencias);
                      tree_asignar_dependencias.setOnLoadingEnd(fin_cargando_asignar_dependencias);tree_asignar_dependencias.enableSmartXMLParsing(true);tree_asignar_dependencias.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_asignar_dependencias.setOnCheckHandler(onNodeSelect_asignar_dependencias);
                      function onNodeSelect_asignar_dependencias(nodeId)
                      {valor_destino=document.getElementById("asignar_dependencias");
                       destinos=tree_asignar_dependencias.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_asignar_dependencias.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_asignar_dependencias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_dependencias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_dependencias")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_asignar_dependencias"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_asignar_dependencias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_dependencias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_dependencias")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_asignar_dependencias"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asignar_mensajeros',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asignar_mensajeros',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asignar_mensajeros" id="bqsaiaenlace_asignar_mensajeros" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">MENSAJEROS DE LA RUTA</td><input type="hidden" name="bksaiacondicion_asignar_mensajeros" id="bksaiacondicion_asignar_mensajeros" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(404,4999,'',1,'buscar');?></td></tr><tr id="tr_firma"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_idft_ruta_distribucion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_ruta_distribucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_ruta_distribucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_ruta_distribucion" id="bqsaiaenlace_idft_ruta_distribucion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RUTA_DISTRIBUCION</td><input type="hidden" name="bksaiacondicion_idft_ruta_distribucion" id="bksaiacondicion_idft_ruta_distribucion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_ruta_distribucion" name="idft_ruta_distribucion"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_ruta_distribucion").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="Ruta de Distribuci&oacute;n">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="4987"><?php submit_formato(404);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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