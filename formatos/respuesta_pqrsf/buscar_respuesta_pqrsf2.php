<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Comunicaci&oacute;n Externa</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Destinos</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__0" id="bksaiacondicion_f@nombre__0" value="like_total"></b><div class="controls"><input type="text"    id="destinos-nombre" name="g@destinos-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"    id="destinos-identificacion" name="g@destinos-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"    id="destinos-empresa" name="g@destinos-empresa" ></div></div></fieldset><br><div class="control-group"><label class="string control-label" style="font-size:9pt" for="requiere_recogida"><b>Requiere recogida?<input type="hidden" name="bksaiacondicion_g@requiere_recogida" id="bksaiacondicion_g@requiere_recogida" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(307,6627,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@requiere_recogida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@requiere_recogida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@requiere_recogida" id="bqsaiaenlace_g@requiere_recogida" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Con Copia A</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__2" id="bksaiacondicion_f@nombre__2" value="like_total"></b><div class="controls"><input type="text"  maxlength="2000"   id="copia-nombre" name="g@copia-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="2000"   id="copia-identificacion" name="g@copia-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="2000"   id="copia-empresa" name="g@copia-empresa" ></div></div></fieldset><br><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_mensajeria"><b>TIPO DE MENSAJER&Iacute;A<input type="hidden" name="bksaiacondicion_g@tipo_mensajeria" id="bksaiacondicion_g@tipo_mensajeria" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(307,6629,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_mensajeria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_mensajeria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_mensajeria" id="bqsaiaenlace_g@tipo_mensajeria" value="y" />
		</div></div></div><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><b>Contenido<input type="hidden" name="bksaiacondicion_g@contenido" id="bksaiacondicion_g@contenido" value="like_total"></b><div class="controls"><textarea    id="contenido" name="bqsaia_g@contenido"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@contenido" id="bqsaiaenlace_g@contenido" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Con Copia Interna A<input type="hidden" name="bksaiacondicion_copiainterna" id="bksaiacondicion_copiainterna" value="like_total"></b><div id="esperando_copiainterna"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copiainterna" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copiainterna" height=""></div><input type="hidden"  name="g@copiainterna" id="copiainterna"   value="" ><label style="display:none" class="error" for="copiainterna">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copiainterna=new dhtmlXTreeObject("treeboxbox_copiainterna","","",0);
                			tree_copiainterna.setImagePath("../../imgs/");
                			tree_copiainterna.enableIEImageFix(true);tree_copiainterna.enableCheckBoxes(1);
                			tree_copiainterna.enableThreeStateCheckboxes(1);tree_copiainterna.setOnLoadingStart(cargando_copiainterna);
                      tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../../test.php?rol=1");
                      tree_copiainterna.setOnCheckHandler(onNodeSelect_copiainterna);
                      function onNodeSelect_copiainterna(nodeId)
                      {valor_destino=document.getElementById("copiainterna");
                       destinos=tree_copiainterna.getAllChecked();
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
                      function fin_cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="destinos@ejecutor,copia@ejecutor,copiainterna@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_respuesta_pqrsf g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>