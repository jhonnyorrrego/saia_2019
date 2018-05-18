<html><title>.:BUSCAR DOCUMENTOS EN FORMATO (WORD):.</title><head><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DOCUMENTOS EN FORMATO (WORD)</td></tr><tr id="tr_asunto_word"><td class="encabezado">&nbsp;<select name="condicion_asunto_word" id="condicion_asunto_word"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_asunto_word" id="compara_asunto_word"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="asunto_word" name="asunto_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#asunto_word").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_contenido_word"><td class="encabezado">&nbsp;<select name="condicion_contenido_word" id="condicion_contenido_word"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONTENIDO</td><td class="encabezado">&nbsp;<select name="compara_contenido_word" id="compara_contenido_word"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="contenido_word" name="contenido_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#contenido_word").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_clasifica_expediente" id="condicion_clasifica_expediente"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE</td><td class="encabezado">&nbsp;<select name="compara_clasifica_expediente" id="compara_clasifica_expediente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_clasifica_expediente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(400,6700,'4',$_REQUEST['iddoc']);?></div>
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
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_clasifica_expediente.getAllSubItems(vector[i]);
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
                	--></script></td></tr><tr id="tr_anexo_word"><td class="encabezado">&nbsp;<select name="condicion_anexo_word" id="condicion_anexo_word"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Por favor elija la plantilla recomendada y una vez diligenciada debe cargarla en esta opci&oacute;n">CARGAR ARCHIVO DE WORD</td><td class="encabezado">&nbsp;<select name="compara_anexo_word" id="compara_anexo_word"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_word" name="anexo_word"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_word").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo_csv"><td class="encabezado">&nbsp;<select name="condicion_anexo_csv" id="condicion_anexo_csv"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="<b>Para combinar Correspondencia:</b>
<br/><br/>
Consideraciones:<br/>
1. La base de informaci&oacute;n puede hacerla en EXCEL.<br/>

2. Cada columna debe tener el TITULO y debajo los datos asociados.<br/>

3. El t&iacute;tulo de cada columna debe ser escrito <b>exactamente</b> igual a como aparece en la plantilla de WORD, ya que esto permitir&aacute; hacer la relaci&oacute;n entre los datos y el WORD. <br/>

4. EL archivo debe subirse en formato <b>CSV</b> export&aacute;ndolo desde EXCEL. <br/>

5. Recuerde que en la plantilla de WORD  deben aparecer los textos que escribi&oacute; como encabezado de las columnas pero adicionando los s&iacute;mbolos <b>$</b> y <b>{ }</b> al inicio y final.  Ejemplo:  <b>${Nombre del Destino}</b>,  <b>${Direccion}</b>, <b>${Telefono}</b>, etc.">CARGAR ARCHIVO EN FORMATO CSV CON LOS DATOS</td><td class="encabezado">&nbsp;<select name="compara_anexo_csv" id="compara_anexo_csv"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_csv" name="anexo_csv"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_csv").fcbkcomplete({
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