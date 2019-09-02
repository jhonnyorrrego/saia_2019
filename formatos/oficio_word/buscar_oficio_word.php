<html><title>.: DOCUMENTOS EN FORMATO (WORD):.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DOCUMENTOS EN FORMATO (WORD)</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_radicado" id="bqsaiaenlace_tipo_radicado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">SELECCIONAR TIPO DE RADICADO</td><input type="hidden" name="bksaiacondicion_tipo_radicado" id="bksaiacondicion_tipo_radicado" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(400,6696,'',1,'buscar');?></td></tr><tr id="tr_asunto_word"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asunto_word',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asunto_word',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asunto_word" id="bqsaiaenlace_asunto_word" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ASUNTO</td><input type="hidden" name="bksaiacondicion_asunto_word" id="bksaiacondicion_asunto_word" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="asunto_word" name="asunto_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#asunto_word").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_clasifica_expediente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_clasifica_expediente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_clasifica_expediente" id="bqsaiaenlace_clasifica_expediente" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE</td><input type="hidden" name="bksaiacondicion_clasifica_expediente" id="bksaiacondicion_clasifica_expediente" value="like"><td bgcolor="#F5F5F5"><div id="esperando_clasifica_expediente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(400,6700,'4',$_REQUEST['iddoc']);?></div>
                          <br />  <div id="treeboxbox_clasifica_expediente" height="90%"></div><input type="hidden" maxlength="255"  name="clasifica_expediente" id="clasifica_expediente"   value="" ><label style="display:none" class="error" for="clasifica_expediente">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_clasifica_expediente=new dhtmlXTreeObject("treeboxbox_clasifica_expediente","100%","100%",0);
                			tree_clasifica_expediente.setImagePath("../../imgs/");
                			tree_clasifica_expediente.enableIEImageFix(true);tree_clasifica_expediente.enableCheckBoxes(1);
                    tree_clasifica_expediente.enableRadioButtons(true);tree_clasifica_expediente.setOnLoadingStart(cargando_clasifica_expediente);
                      tree_clasifica_expediente.setOnLoadingEnd(fin_cargando_clasifica_expediente);tree_clasifica_expediente.setXMLAutoLoading("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");tree_clasifica_expediente.loadXML("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");
                      tree_clasifica_expediente.setOnCheckHandler(onNodeSelect_clasifica_expediente);
                      function onNodeSelect_clasifica_expediente(nodeId)
                      {valor_destino=document.getElementById("clasifica_expediente");
                       destinos=tree_clasifica_expediente.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_clasifica_expediente.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_clasifica_expediente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_clasifica_expediente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_clasifica_expediente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_clasifica_expediente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_clasifica_expediente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_clasifica_expediente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_clasifica_expediente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_clasifica_expediente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_contenido_word"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_contenido_word',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_contenido_word',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_contenido_word" id="bqsaiaenlace_contenido_word" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONTENIDO</td><input type="hidden" name="bksaiacondicion_contenido_word" id="bksaiacondicion_contenido_word" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="contenido_word" name="contenido_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#contenido_word").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fk_idexpediente"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fk_idexpediente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fk_idexpediente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fk_idexpediente" id="bqsaiaenlace_fk_idexpediente" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">EXPEDIENTE</td><input type="hidden" name="bksaiacondicion_fk_idexpediente" id="bksaiacondicion_fk_idexpediente" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fk_idexpediente" name="fk_idexpediente"></select><script>
                     $(document).ready(function()
                      {
                      $("#fk_idexpediente").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo_word"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexo_word',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexo_word',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexo_word" id="bqsaiaenlace_anexo_word" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Por favor elija la plantilla recomendada y una vez diligenciada debe cargarla en esta opci&oacute;n">CARGAR ARCHIVO DE WORD</td><input type="hidden" name="bksaiacondicion_anexo_word" id="bksaiacondicion_anexo_word" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_word" name="anexo_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_word").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo_csv"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexo_csv',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexo_csv',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexo_csv" id="bqsaiaenlace_anexo_csv" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="<b>Para combinar Correspondencia:</b>
<br/><br/>
Consideraciones:<br/>
1. La base de informaci&oacute;n puede hacerla en EXCEL.<br/>

2. Cada columna debe tener el TITULO y debajo los datos asociados.<br/>

3. El t&iacute;tulo de cada columna debe ser escrito <b>exactamente</b> igual a como aparece en la plantilla de WORD, ya que esto permitir&aacute; hacer la relaci&oacute;n entre los datos y el WORD. <br/>

4. EL archivo debe subirse en formato <b>CSV o XLSX</b><br/>

5. Recuerde que en la plantilla de WORD  deben aparecer los textos que escribi&oacute; como encabezado de las columnas pero adicionando los s&iacute;mbolos <b>$</b> y <b>{ }</b> al inicio y final.  Ejemplo:  <b>${Nombre del Destino}</b>,  <b>${Direccion}</b>, <b>${Telefono}</b>, etc.">CARGAR ARCHIVO DE EXCEL (PARA COMBINAR CORRESPONDENCIA)</td><input type="hidden" name="bksaiacondicion_anexo_csv" id="bksaiacondicion_anexo_csv" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_csv" name="anexo_csv"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_csv").fcbkcomplete({
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
                    </tr><tr id="tr_idft_oficio_word"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_oficio_word',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_oficio_word',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_oficio_word" id="bqsaiaenlace_idft_oficio_word" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OFICIO_WORD</td><input type="hidden" name="bksaiacondicion_idft_oficio_word" id="bksaiacondicion_idft_oficio_word" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_oficio_word" name="idft_oficio_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_oficio_word").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="6698"><?php submit_formato(400);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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