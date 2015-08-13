<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><div class="container master-container"><legend>B&Uacute;SQUEDA ACTA DE COMPROMISO</legend><div class="control-group"><label class="string control-label" for="convenio">Convenio<input type="hidden" name="bksaiacondicion_convenio" id="bksaiacondicion_convenio" value="="></label><div class="controls"><input type="text" id="bqsaia_convenio" name="bqsaia_convenio"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_convenio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_convenio',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_convenio" id="bqsaiaenlace_convenio" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="fecha_reunion">Fecha de reunion<input type="hidden" name="bksaiacondicion_fecha_reunion" id="bksaiacondicion_fecha_reunion" value="like"></label><div class="controls">
                       ENTRE &nbsp;<input type="text" readonly="true" maxlength="15"  name="fecha_reunion_1" id="fecha_reunion_1" tipo="fecha" value=""><?php selector_fecha("fecha_reunion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" maxlength="15"  name="fecha_reunion_2" id="fecha_reunion_2" tipo="fecha" value=""><?php selector_fecha("fecha_reunion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_reunion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_fecha_reunion" id="bqsaiaenlace_fecha_reunion" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="dependencia_reunion">Dependencia de la reunion<input type="hidden" name="bksaiacondicion_dependencia_reunion" id="bksaiacondicion_dependencia_reunion" value="like"></label><div class="controls"><div id="esperando_dependencia_reunion"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(81,977,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_dependencia_reunion" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_dependencia_reunion.findItem(htmlentities(document.getElementById('stext_dependencia_reunion').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencia_reunion.findItem(htmlentities(document.getElementById('stext_dependencia_reunion').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_dependencia_reunion.findItem(htmlentities(document.getElementById('stext_dependencia_reunion').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_dependencia_reunion" height="90%"></div><input type="hidden" maxlength="255"  name="dependencia_reunion" id="dependencia_reunion"   value="" ><label style="display:none" class="error" for="dependencia_reunion">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencia_reunion=new dhtmlXTreeObject("treeboxbox_dependencia_reunion","100%","100%",0);
                			tree_dependencia_reunion.setImagePath("../../imgs/");
                			tree_dependencia_reunion.enableIEImageFix(true);tree_dependencia_reunion.enableCheckBoxes(1);
                			tree_dependencia_reunion.enableThreeStateCheckboxes(1);tree_dependencia_reunion.setOnLoadingStart(cargando_dependencia_reunion);
                      tree_dependencia_reunion.setOnLoadingEnd(fin_cargando_dependencia_reunion);tree_dependencia_reunion.enableSmartXMLParsing(true);tree_dependencia_reunion.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_dependencia_reunion.setOnCheckHandler(onNodeSelect_dependencia_reunion);
                      function onNodeSelect_dependencia_reunion(nodeId)
                      {valor_destino=document.getElementById("dependencia_reunion");
                       destinos=tree_dependencia_reunion.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_dependencia_reunion.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_dependencia_reunion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_reunion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_reunion")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencia_reunion"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_dependencia_reunion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_reunion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_reunion")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencia_reunion"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia_reunion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_dependencia_reunion" id="bqsaiaenlace_dependencia_reunion" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="serie_cpu">Serie de la CPU<input type="hidden" name="bksaiacondicion_serie_cpu" id="bksaiacondicion_serie_cpu" value="like"></label><div class="controls"><input type="text" id="bqsaia_serie_cpu" name="bqsaia_serie_cpu"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_cpu',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_cpu',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_serie_cpu" id="bqsaiaenlace_serie_cpu" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="num_stiker">No. del Stiker<input type="hidden" name="bksaiacondicion_num_stiker" id="bksaiacondicion_num_stiker" value="like"></label><div class="controls"><input type="text" id="bqsaia_num_stiker" name="bqsaia_num_stiker"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_num_stiker',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_num_stiker',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_num_stiker" id="bqsaiaenlace_num_stiker" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="sistema_operativo">Sistema Operativo<input type="hidden" name="bksaiacondicion_sistema_operativo" id="bksaiacondicion_sistema_operativo" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,991,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_sistema_operativo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_sistema_operativo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_sistema_operativo" id="bqsaiaenlace_sistema_operativo" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="ofimatico">Ofimatico<input type="hidden" name="bksaiacondicion_ofimatico" id="bksaiacondicion_ofimatico" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,983,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ofimatico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ofimatico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_ofimatico" id="bqsaiaenlace_ofimatico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="ms_project">MS Project<input type="hidden" name="bksaiacondicion_ms_project" id="bksaiacondicion_ms_project" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,980,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ms_project',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ms_project',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_ms_project" id="bqsaiaenlace_ms_project" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="dise_grafico">Dise. Grafico<input type="hidden" name="bksaiacondicion_dise_grafico" id="bksaiacondicion_dise_grafico" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,978,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dise_grafico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dise_grafico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_dise_grafico" id="bqsaiaenlace_dise_grafico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="antivirus">Antivirus<input type="hidden" name="bksaiacondicion_antivirus" id="bksaiacondicion_antivirus" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,975,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_antivirus',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_antivirus',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_antivirus" id="bqsaiaenlace_antivirus" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="oracle">Oracle<input type="hidden" name="bksaiacondicion_oracle" id="bksaiacondicion_oracle" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,984,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_oracle',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_oracle',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_oracle" id="bqsaiaenlace_oracle" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="base_datos">Base de datos en<input type="hidden" name="bksaiacondicion_base_datos" id="bksaiacondicion_base_datos" value="="></label><div class="controls"><?php genera_campo_listados_editar(81,976,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_base_datos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_base_datos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_base_datos" id="bqsaiaenlace_base_datos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="otro1">Otro 1<input type="hidden" name="bksaiacondicion_otro1" id="bksaiacondicion_otro1" value="like"></label><div class="controls"><input type="text" id="bqsaia_otro1" name="bqsaia_otro1"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro1',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_otro1" id="bqsaiaenlace_otro1" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="otro2">Otro 2<input type="hidden" name="bksaiacondicion_otro2" id="bksaiacondicion_otro2" value="like"></label><div class="controls"><input type="text" id="bqsaia_otro2" name="bqsaia_otro2"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro2',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_otro2" id="bqsaiaenlace_otro2" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="otro3">Otro 3<input type="hidden" name="bksaiacondicion_otro3" id="bksaiacondicion_otro3" value="like"></label><div class="controls"><input type="text" id="bqsaia_otro3" name="bqsaia_otro3"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro3',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro3',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_otro3" id="bqsaiaenlace_otro3" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="otro4">Otro 4<input type="hidden" name="bksaiacondicion_otro4" id="bksaiacondicion_otro4" value="like"></label><div class="controls"><input type="text" id="bqsaia_otro4" name="bqsaia_otro4"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro4',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro4',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_otro4" id="bqsaiaenlace_otro4" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="otro5">Otro 5<input type="hidden" name="bksaiacondicion_otro5" id="bksaiacondicion_otro5" value="like"></label><div class="controls"><input type="text" id="bqsaia_otro5" name="bqsaia_otro5"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro5',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro5',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_otro5" id="bqsaiaenlace_otro5" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="observaciones">Observaciones<input type="hidden" name="bksaiacondicion_observaciones" id="bksaiacondicion_observaciones" value="like"></label><div class="controls"><input type="text" id="bqsaia_observaciones" name="bqsaia_observaciones"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_observaciones" id="bqsaiaenlace_observaciones" value="" />
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Convenio">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">