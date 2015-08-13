<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><div class="container master-container"><legend>B&Uacute;SQUEDA MEMORANDO</legend><div class="control-group"><label class="string control-label" for="destino">Destino<input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like"></label><div class="controls"><div id="esperando_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,46,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_destino" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_destino" height="90%"></div><input type="hidden" maxlength="2000"  name="destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino=new dhtmlXTreeObject("treeboxbox_destino","100%","100%",0);
                			tree_destino.setImagePath("../../imgs/");
                			tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                			tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
                      tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");
                      tree_destino.setOnCheckHandler(onNodeSelect_destino);
                      function onNodeSelect_destino(nodeId)
                      {valor_destino=document.getElementById("destino");
                       destinos=tree_destino.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_destino.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="asunto">Asunto<input type="hidden" name="bksaiacondicion_asunto" id="bksaiacondicion_asunto" value="like"></label><div class="controls"><input type="text" id="bqsaia_asunto" name="bqsaia_asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_asunto" id="bqsaiaenlace_asunto" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="contenido">Contenido<input type="hidden" name="bksaiacondicion_contenido" id="bksaiacondicion_contenido" value="like"></label><div class="controls"><input type="text" id="bqsaia_contenido" name="bqsaia_contenido"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_contenido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_contenido',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_contenido" id="bqsaiaenlace_contenido" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="copia">Con Copia A<input type="hidden" name="bksaiacondicion_copia" id="bksaiacondicion_copia" value="like"></label><div class="controls"><div id="esperando_copia"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,47,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia.findItem(htmlentities(document.getElementById('stext_copia').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia.findItem(htmlentities(document.getElementById('stext_copia').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia.findItem(htmlentities(document.getElementById('stext_copia').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia" height="90%"></div><input type="hidden" maxlength="2000"  name="copia" id="copia"   value="" ><label style="display:none" class="error" for="copia">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia=new dhtmlXTreeObject("treeboxbox_copia","100%","100%",0);
                			tree_copia.setImagePath("../../imgs/");
                			tree_copia.enableIEImageFix(true);tree_copia.enableCheckBoxes(1);
                			tree_copia.enableThreeStateCheckboxes(1);tree_copia.setOnLoadingStart(cargando_copia);
                      tree_copia.setOnLoadingEnd(fin_cargando_copia);tree_copia.enableSmartXMLParsing(true);tree_copia.loadXML("../../test.php?rol=1");
                      tree_copia.setOnCheckHandler(onNodeSelect_copia);
                      function onNodeSelect_copia(nodeId)
                      {valor_destino=document.getElementById("copia");
                       destinos=tree_copia.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_copia" id="bqsaiaenlace_copia" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="firma_dependencia">Mostrar Dependencia al firmar<input type="hidden" name="bksaiacondicion_firma_dependencia" id="bksaiacondicion_firma_dependencia" value="="></label><div class="controls"><?php genera_campo_listados_editar(3,929,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_firma_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_firma_dependencia',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_firma_dependencia" id="bqsaiaenlace_firma_dependencia" value="" />
		</div></div></div><input type="hidden" name="adicionar_consulta" value="1">
     <?php if(@$_REQUEST["campo__retorno"]){ ?>
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Destino">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">