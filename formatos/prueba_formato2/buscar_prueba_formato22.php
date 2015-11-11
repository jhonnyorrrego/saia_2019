<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato prueba formato 2</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="radio"><b>radio<input type="hidden" name="bksaiacondicion_g@radio" id="bksaiacondicion_g@radio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(329,3848,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@radio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@radio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@radio" id="bqsaiaenlace_g@radio" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="lista"><b>lista<input type="hidden" name="bksaiacondicion_g@lista" id="bksaiacondicion_g@lista" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(329,3849,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_lista',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_lista',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_lista" id="bqsaiaenlace_lista" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>remitente</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__2" id="bksaiacondicion_f@nombre__2" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="remitente-nombre" name="g@remitente-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="remitente-identificacion" name="g@remitente-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="remitente-empresa" name="g@remitente-empresa" ></div></div></fieldset><br><div class="control-group"><div class="controls"><b>arbol<input type="hidden" name="bksaiacondicion_arbol" id="bksaiacondicion_arbol" value="like_total"></b><div id="esperando_arbol"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_arbol" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_arbol" height=""></div><input type="hidden" maxlength="255"  name="g@arbol" id="arbol"   value="" ><label style="display:none" class="error" for="arbol">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_arbol=new dhtmlXTreeObject("treeboxbox_arbol","","",0);
                			tree_arbol.setImagePath("../../imgs/");
                			tree_arbol.enableIEImageFix(true);tree_arbol.enableCheckBoxes(1);
                    tree_arbol.enableRadioButtons(true);tree_arbol.setOnLoadingStart(cargando_arbol);
                      tree_arbol.setOnLoadingEnd(fin_cargando_arbol);tree_arbol.enableSmartXMLParsing(true);tree_arbol.loadXML("../../test.php?rol=1");
                      tree_arbol.setOnCheckHandler(onNodeSelect_arbol);
                      function onNodeSelect_arbol(nodeId)
                      {valor_destino=document.getElementById("arbol");
                       destinos=tree_arbol.getAllChecked();
                       var nuevos_valores=destinos.split(",");
						var cantidad=nuevos_valores.length;
						var funcionarios=new Array();
						var indice=0;
						for(var i=0;i<cantidad;i++){
							//if(nuevos_valores[i].indexOf("#")=="-1"){
								if(nuevos_valores[i]!=""){
									funcionarios[indice]=nuevos_valores[i];
									indice++;
								}
							//}
						}
						valor_destino.value=funcionarios.join(",");
                      }
                      function fin_cargando_arbol() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_arbol"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_arbol() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_arbol"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="remitente@ejecutor,arbol@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_prueba_formato2 g @ AND  g.documento_iddocumento=iddocumento "></body>