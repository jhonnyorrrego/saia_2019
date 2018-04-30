<html><title>.:EDITAR RADICACI&Oacute;N DE CORRESPONDENCIA:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../carta/funciones.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php include_once("../../calendario/calendario.php"); ?>
			<script type="text/javascript" src="../../js/jquery.js"></script>
			<script type="text/javascript" src="../../js/jquery.validate.js"></script>
			<script type="text/javascript" src="../../js/title2note.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../dropzone/dist/dropzone.js"></script>
			<?php include_once("../../anexosdigitales/funciones_archivo.php"); ?>
			<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
			<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" /></style><link href="../../dropzone/dist/dropzone_saia.css" type="text/css" rel="stylesheet" /><script type='text/javascript'> hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/'; hs.outlineType = 'rounded-white';</script><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RADICACIÓN DE CORRESPONDENCIA</td></tr><input type="hidden" name="despachado" value="<?php echo(mostrar_valor_campo('despachado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',3,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(3,48,$_REQUEST['iddoc']);?></tr><tr id="tr_etiqueta_datos_gener">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta_datos_gener"><center><strong>DATOS GENERALES</strong></center></td>
                    </tr><tr id="tr_fecha_radicacion_entrada">
                     <td class="encabezado" width="20%" title="">FECHA DE RADICACI&Oacute;N*</td>
                     <?php fecha_formato(3,53,$_REQUEST['iddoc']);?></tr><tr id="tr_tipo_origen" >
                     <td class="encabezado" width="20%" title="">ORIGEN DEL DOCUMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4966,$_REQUEST['iddoc']);?></td></tr><tr id="tr_fecha_oficio_entrada">
                       <td class="encabezado" width="20%" title="">FECHA DOCUMENTO ENTRADA</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  name="fecha_oficio_entrada" id="fecha_oficio_entrada" tipo="fecha" value="<?php mostrar_valor_campo('fecha_oficio_entrada',3,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_oficio_entrada","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_numero_oficio">
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE DOCUMENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255" style="width:350px"  tabindex='2'  type="text" size="100" id="numero_oficio" name="numero_oficio"  value="<?php echo(mostrar_valor_campo('numero_oficio',3,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_descripcion">
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N O ASUNTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(mostrar_valor_campo('descripcion',3,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_descripcion_anexos">
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion_anexos" id="descripcion_anexos" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(mostrar_valor_campo('descripcion_anexos',3,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_anexos_digitales">
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=3&idcampo=42" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?></td></tr><tr id="tr_requiere_recogida" >
                     <td class="encabezado" width="20%" title="">REQUIERE SERVICIO DE RECOGIDA?</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5199,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo_mensajeria" >
                     <td class="encabezado" width="20%" title="">REQUIERE SERVICIO DE ENTREGA?</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4970,$_REQUEST['iddoc']);?></td></tr><tr id="tr_numero_guia">
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE GU&Iacute;A</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="numero_guia" name="numero_guia"  value="<?php echo(mostrar_valor_campo('numero_guia',3,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_empresa_transportado">
                     <td class="encabezado" width="20%" title="">EMPRESA TRANSPORTADORA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5084,$_REQUEST['iddoc']);?></td></tr><tr id="tr_etiqueta_origen">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta_origen"><center><strong>INFORMACI&Oacute;N ORIGEN</strong></center></td>
                    </tr><tr id="tr_persona_natural">
                   <td class="encabezado" width="20%" title="">PERSONA NATURAL/JUR&Iacute;DICA*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  name="persona_natural" id="persona_natural" value="<?php echo(mostrar_valor_campo('persona_natural',3,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("37",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr id="tr_area_responsable">
								<td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(3,4967,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='7'  type="text" id="stext_area_responsable" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="area_responsable" id="area_responsable"   value="<?php cargar_seleccionados(3,4967,1,$_REQUEST['iddoc']);?>" ><div id="esperando_area_responsable">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_area_responsable" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
								tree_area_responsable.setImagePath("../../imgs/");
								tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
									tree_area_responsable.enableRadioButtons(true);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
								tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?sin_padre=1&rol=1",checkear_arbol);tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
									function onNodeSelect_area_responsable(nodeId) {
										valor_destino=document.getElementById("area_responsable");
										if(tree_area_responsable.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_area_responsable.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_area_responsable() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_area_responsable"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_area_responsable() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_area_responsable")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_area_responsable"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(3,4967,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_area_responsable.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_etiqueta_destino">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta_destino"><center><strong>INFORMACI&Oacute;N DESTINO</strong></center></td>
                    </tr><tr id="tr_tipo_destino" >
                     <td class="encabezado" width="20%" title="">DESTINO DEL DOCUMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4968,$_REQUEST['iddoc']);?></td></tr><tr id="tr_destino">
								<td class="encabezado" width="20%" title="">DESTINO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(3,43,'5
',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='8'  type="text" id="stext_destino" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="destino" id="destino"   value="<?php cargar_seleccionados(3,43,1,$_REQUEST['iddoc']);?>" ><div id="esperando_destino">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_destino" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_destino=new dhtmlXTreeObject("treeboxbox_destino","100%","100%",0);
								tree_destino.setImagePath("../../imgs/");
								tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
									tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
								tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_destino.setOnCheckHandler(onNodeSelect_destino);

									function onNodeSelect_destino(nodeId){
										valor_destino=document.getElementById("destino");
										destinos=tree_destino.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_destino.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}function fin_cargando_destino() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_destino"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_destino() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_destino")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_destino"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(3,43,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_destino.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_serie_idserie">
								<td class="encabezado" width="20%" title="Radicacion entrada">TIPO DOCUMENTAL</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(3,52,'1',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='9'  type="text" id="stext_serie_idserie" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="11"  name="serie_idserie" id="serie_idserie"   value="<?php cargar_seleccionados(3,52,1,$_REQUEST['iddoc']);?>" ><div id="esperando_serie_idserie">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_serie_idserie" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_serie_idserie=new dhtmlXTreeObject("treeboxbox_serie_idserie","100%","100%",0);
								tree_serie_idserie.setImagePath("../../imgs/");
								tree_serie_idserie.enableIEImageFix(true);tree_serie_idserie.enableCheckBoxes(1);
									tree_serie_idserie.enableRadioButtons(true);tree_serie_idserie.setOnLoadingStart(cargando_serie_idserie);
								tree_serie_idserie.setOnLoadingEnd(fin_cargando_serie_idserie);tree_serie_idserie.setXMLAutoLoading("../../test_dependencia_serie.php?tabla=dependencia&admin=1&mostrar_nodos=dsa&sin_padre_dependencia=1&solo_dependencias=1&carga_partes_serie=1");tree_serie_idserie.loadXML("../../test_dependencia_serie.php?tabla=dependencia&admin=1&mostrar_nodos=dsa&sin_padre_dependencia=1&solo_dependencias=1&carga_partes_serie=1",checkear_arbol);tree_serie_idserie.setOnCheckHandler(onNodeSelect_serie_idserie);
									function onNodeSelect_serie_idserie(nodeId) {
										valor_destino=document.getElementById("serie_idserie");
										if(tree_serie_idserie.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_serie_idserie.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_serie_idserie() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie_idserie"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_serie_idserie() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_serie_idserie")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_serie_idserie"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(3,52,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_serie_idserie.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_copia_a">
								<td class="encabezado" width="20%" title="">COPIA ELECTR&Oacute;NICA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(3,44,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='10'  type="text" id="stext_copia_a" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden"  name="copia_a" id="copia_a"   value="<?php cargar_seleccionados(3,44,1,$_REQUEST['iddoc']);?>" ><div id="esperando_copia_a">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_copia_a" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_copia_a=new dhtmlXTreeObject("treeboxbox_copia_a","100%","100%",0);
								tree_copia_a.setImagePath("../../imgs/");
								tree_copia_a.enableIEImageFix(true);tree_copia_a.enableCheckBoxes(1);
									tree_copia_a.enableThreeStateCheckboxes(1);tree_copia_a.setOnLoadingStart(cargando_copia_a);
								tree_copia_a.setOnLoadingEnd(fin_cargando_copia_a);tree_copia_a.enableSmartXMLParsing(true);tree_copia_a.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_copia_a.setOnCheckHandler(onNodeSelect_copia_a);

									function onNodeSelect_copia_a(nodeId){
										valor_destino=document.getElementById("copia_a");
										destinos=tree_copia_a.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_copia_a.getAllSubItems(vector[i]);
												hijos=hijos.replace(/\,{2,}(d)*/gi,",");
												hijos=hijos.replace(/\,$/gi,"");
												vectorh=hijos.split(",");

												for(h=0;h<vectorh.length;h++){
													if(vectorh[h].indexOf("_")!=-1)
													vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
													nuevo=eliminarItem(nuevo,vectorh[h]);
												}
											}
										}
										nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										valor_destino.value=nuevo;
									}function fin_cargando_copia_a() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia_a"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_copia_a() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_copia_a")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_copia_a"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(3,44,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_copia_a.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_persona_natural_dest">
                   <td class="encabezado" width="20%" title="">PERSONA NATURAL O JUR&Iacute;DICA*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  name="persona_natural_dest" id="persona_natural_dest" value="<?php echo(mostrar_valor_campo('persona_natural_dest',3,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("4969",@$_REQUEST["iddoc"]); ?></td>
                  </tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_radicacion_entrada" value="<?php echo(mostrar_valor_campo('idft_radicacion_entrada',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_radicado" value="<?php echo(mostrar_valor_campo('estado_radicado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',3,$_REQUEST['iddoc'])); ?>"><?php digitalizar_formato_radicacion(3,NULL,$_REQUEST['iddoc']);?><?php quitar_descripcion_entrada(3,NULL,$_REQUEST['iddoc']);?><?php tipo_radicado_radicacion(3,NULL,$_REQUEST['iddoc']);?><?php datos_editar_radicacion(3,NULL,$_REQUEST['iddoc']);?><?php serie_documental_radicacion(3,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('39'); ?>"><input type="hidden" name="formato" value="3"><tr><td colspan='2'><?php submit_formato(3,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''><input type='hidden' name='form_uuid'       id='form_uuid'       value='<?php echo (uniqid("3-") . "-" . uniqid());?>'></form></body><script type='text/javascript'>
                var upload_url = '../../dropzone/cargar_archivos_formato.php';
                var mensaje = 'Arrastre aquí los archivos';
                Dropzone.autoDiscover = false;
                var lista_archivos = new Object();
                $(document).ready(function () {
                    Dropzone.autoDiscover = false;
                    $('.saia_dz').each(function () {
                        var idformato = $(this).attr('data-idformato');
                    	var idcampo = $(this).attr('id');
                    	var paramName = $(this).attr('data-nombre-campo');
                    	var idcampoFormato = $(this).attr('data-idcampo-formato');
                    	var extensiones = $(this).attr('data-extensiones');
                    	var multiple_text = $(this).attr('data-multiple');
                    	var multiple = false;
                    	var form_uuid = $('#form_uuid').val();
                    	var maxFiles = 1;
                    	if(multiple_text == 'multiple') {
                    		multiple = true;
                    		maxFiles = 10;
                    	}
                        var opciones = {
                        	ignoreHiddenFiles : true,
                        	maxFiles : maxFiles,
                        	acceptedFiles: extensiones,
                       		addRemoveLinks: true,
                       		dictRemoveFile: 'Quitar anexo',
                       		dictMaxFilesExceeded : 'No puede subir mas archivos',
                       		dictResponseError : 'El servidor respondió con código {{statusCode}}',
                    		uploadMultiple: multiple,
                        	url: upload_url,
                        	paramName : paramName,
                        	params : {
                            	idformato : idformato,
                            	idcampo_formato : idcampoFormato,
                            	nombre_campo : paramName,
                            	uuid : form_uuid
                            },
                                removedfile : function(file) {
                                    if(lista_archivos && lista_archivos[file.upload.uuid]) {
                                    	$.ajax({
                                    		url: upload_url,
                                    		type: 'POST',
                                    		data: {
                                        		accion:'eliminar_temporal',
                                            	idformato : idformato,
                                            	idcampo_formato : idcampoFormato,
                                        		archivo: lista_archivos[file.upload.uuid]}
                                    		});
                                    }
                                    if (file.previewElement != null && file.previewElement.parentNode != null) {
                                        file.previewElement.parentNode.removeChild(file.previewElement);
                                    	delete lista_archivos[file.upload.uuid];
                                    	$('#'+paramName).val(Object.values(lista_archivos).join());
                                    }
                                    return this._updateMaxFilesReachedClass();
                                },
                                success : function(file, response) {
                                	for (var key in response) {
                                    	if(Array.isArray(response[key])) {
                                        	for(var i=0; i < response[key].length; i++) {
                                        		archivo=response[key][i];
                                            	if(archivo.original_name == file.upload.filename) {
                                            		lista_archivos[file.upload.uuid] = archivo.id;
                                            	}
                                        	}
                                    	} else {
                                    		if(response[key].original_name == file.upload.filename) {
                                        		lista_archivos[file.upload.uuid] = response[key].id;
                                    		}
                                    	}
                                	}
                                	$('#'+paramName).val(Object.values(lista_archivos).join());
                                    if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                                        $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                                    }
                                }
                        };
                        $(this).dropzone(opciones);
                        $(this).addClass('dropzone');
                    });
                });</script>
		</html><?php include_once("../librerias/footer_plantilla.php");?>