<html><title>.:EDITAR DESTINO_RADICACION:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../../formatos/librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../formatos/librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="estado_recogida" value="<?php echo(mostrar_valor_campo('estado_recogida',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_mensajero" value="<?php echo(mostrar_valor_campo('tipo_mensajero',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="ruta_origen" value="<?php echo(mostrar_valor_campo('ruta_origen',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="ruta_destino" value="<?php echo(mostrar_valor_campo('ruta_destino',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="finalizacion_observa" value="<?php echo(mostrar_valor_campo('finalizacion_observa',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_destino_radicacion" value="<?php echo(mostrar_valor_campo('idft_destino_radicacion',403,$_REQUEST['iddoc'])); ?>"><tr id="tr_nombre_destino">
								<td class="encabezado" width="20%" title="">DESTINO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(403,4972,'0',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_nombre_destino" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  name="nombre_destino" id="nombre_destino"   value="<?php cargar_seleccionados(403,4972,1,$_REQUEST['iddoc']);?>" ><div id="esperando_nombre_destino">
									<img src="../../imagenes/cargando.gif">
								</div>
								<div id="treeboxbox_nombre_destino" height="90%"></div><script type="text/javascript">
								var browserType;
								if (document.layers) {browserType = "nn4"}
								if (document.all) {browserType = "ie"}
								if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
								tree_nombre_destino=new dhtmlXTreeObject("treeboxbox_nombre_destino","100%","100%",0);
								tree_nombre_destino.setImagePath("../../imgs/");
								tree_nombre_destino.enableIEImageFix(true);tree_nombre_destino.enableCheckBoxes(1);
									tree_nombre_destino.enableRadioButtons(true);tree_nombre_destino.setOnLoadingStart(cargando_nombre_destino);
								tree_nombre_destino.setOnLoadingEnd(fin_cargando_nombre_destino);tree_nombre_destino.enableSmartXMLParsing(true);tree_nombre_destino.loadXML("../../test.php?sin_padre=1&rol=1",checkear_arbol);tree_nombre_destino.setOnCheckHandler(onNodeSelect_nombre_destino);
									function onNodeSelect_nombre_destino(nodeId) {
										valor_destino=document.getElementById("nombre_destino");
										if(tree_nombre_destino.isItemChecked(nodeId)){
											if(valor_destino.value!=="")
											tree_nombre_destino.setCheck(valor_destino.value,false);
											if(nodeId.indexOf("_")!=-1)
											nodeId=nodeId.substr(0,nodeId.indexOf("_"));
											valor_destino.value=nodeId;
										}else{
											valor_destino.value="";
										}
									}function fin_cargando_nombre_destino() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_nombre_destino"]');
									}
									document.poppedLayer.style.display = "none";
								}
								function cargando_nombre_destino() {
									if (browserType == "gecko" ) {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
									} else if (browserType == "ie") {
										document.poppedLayer = eval('document.getElementById("esperando_nombre_destino")');
									} else {
										document.poppedLayer = eval('document.layers["esperando_nombre_destino"]');
									}
									document.poppedLayer.style.display = "";
								}function checkear_arbol(){
										vector2="<?php cargar_seleccionados(403,4972,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_nombre_destino.setCheck(vector2[m],true);
										}
									}
</script></td></tr><tr id="tr_observacion_destino">
                     <td class="encabezado" width="20%" title="">OBSERVACI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='2'  type="text" size="100" id="observacion_destino" name="observacion_destino"  value="<?php echo(mostrar_valor_campo('observacion_destino',403,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="nombre_origen" value="<?php echo(mostrar_valor_campo('nombre_origen',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_destino" value="<?php echo(mostrar_valor_campo('tipo_destino',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="tipo_origen" value="<?php echo(mostrar_valor_campo('tipo_origen',403,$_REQUEST['iddoc'])); ?>"><tr id="tr_destino_externo">
                   <td class="encabezado" width="20%" title="">DESTINO*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  name="destino_externo" id="destino_externo" value="<?php echo(mostrar_valor_campo('destino_externo',403,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("5012",@$_REQUEST["iddoc"]); ?></td>
                  </tr><input type="hidden" name="origen_externo" value="<?php echo(mostrar_valor_campo('origen_externo',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="mensajero_encargado" value="<?php echo(mostrar_valor_campo('mensajero_encargado',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="numero_item" value="<?php echo(mostrar_valor_campo('numero_item',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="recepcion" value="<?php echo(mostrar_valor_campo('recepcion',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="recepcion_fecha" value="<?php echo(mostrar_valor_campo('recepcion_fecha',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_item" value="<?php echo(mostrar_valor_campo('estado_item',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="anexos" value="<?php echo(mostrar_valor_campo('anexos',403,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="formato" value="403"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="destino_radicacion"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(403,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>