<html><title>.:EDITAR SALIDA:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../carta/funciones.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
			<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
			<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../js/jquery.spin.js"></script>
			<style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SALIDA</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',207,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(207,2199,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha_radicacion_entrada">
                     <td class="encabezado" width="20%" title="">FECHA DE RADICACION*</td>
                     <?php fecha_formato(207,2194,$_REQUEST['iddoc']);?></tr><tr id="tr_numero_radicado">
                     <td class="encabezado" width="20%" title="">NUMERO DE RADICADO</td>
                     <?php mostrar_radicado_salida(207,2195,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',207,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',207,$_REQUEST['iddoc'])); ?>"><tr id="tr_area_responsable">
								<td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(207,2196,'5',$_REQUEST['iddoc']);?></div><br/>Buscar: <input  tabindex='1'  type="text" id="stext_area_responsable" width="200px" size="25">
									<a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)">
										<img src="../../botones/general/anterior.png"border="0px">
									</a>
								<a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)">
									<img src="../../botones/general/buscar.png"border="0px">
								</a>
								<a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))">
									<img src="../../botones/general/siguiente.png"border="0px"></a><br/><input type="hidden" maxlength="255"  class="required"  name="area_responsable" id="area_responsable"   value="<?php cargar_seleccionados(207,2196,1,$_REQUEST['iddoc']);?>" ><div id="esperando_area_responsable">
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
									tree_area_responsable.enableThreeStateCheckboxes(1);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
								tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?rol=1",checkear_arbol);
									tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);

									function onNodeSelect_area_responsable(nodeId){
										valor_destino=document.getElementById("area_responsable");
										destinos=tree_area_responsable.getAllChecked();
										nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
										nuevo=nuevo.replace(/\,$/gi,"");
										vector=destinos.split(",");
										for(i=0;i<vector.length;i++){
											if(vector[i].indexOf("_")!=-1){
												vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
											}
											nuevo=vector.join(",");
											if(vector[i].indexOf("#")!=-1){
												hijos=tree_area_responsable.getAllSubItems(vector[i]);
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
										vector2="<?php cargar_seleccionados(207,2196,1,$_REQUEST['iddoc']);?>";
										vector2=vector2.split(",");
										for(m=0;m<vector2.length;m++) {
											tree_area_responsable.setCheck(vector2[m],true);
										}
									}
</script></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',207,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_radicacion_salida" value="<?php echo(mostrar_valor_campo('idft_radicacion_salida',207,$_REQUEST['iddoc'])); ?>"><tr id="tr_persona_natural">
                   <td class="encabezado" width="20%" title="">PERSONA NATURAL O JUR&Iacute;DICA*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="persona_natural" id="persona_natural" value="<?php echo(mostrar_valor_campo('persona_natural',207,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("2190",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr id="tr_descripcion_salida">
                     <td class="encabezado" width="20%" title="">DESCRIPCION O ASUNTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_salida" id="descripcion_salida" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(mostrar_valor_campo('descripcion_salida',207,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_num_folios">
                     <td class="encabezado" width="20%" title="">NUMERO DE FOLIOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="1000"  tabindex='3'  type="input" id="num_folios" name="num_folios"  value="<?php echo(mostrar_valor_campo('num_folios',207,$_REQUEST['iddoc'])); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#num_folios").spin({imageBasePath:'../../images/',min:0,max:1000,interval:1});
              });
              </script><tr id="tr_anexos_fisicos">
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(207,2189,$_REQUEST['iddoc']);?></td></tr><tr id="tr_descripcion_anexos">
                     <td class="encabezado" width="20%" title="">DESCRIPCION ANEXOS FISICOS</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion_anexos" id="descripcion_anexos" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(mostrar_valor_campo('descripcion_anexos',207,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_tipo_mensajeria" >
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJERIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(207,2202,$_REQUEST['iddoc']);?></td></tr><tr id="tr_mensajeros">
                     <td class="encabezado" width="20%" title="">MENSAJEROS</td>
                     <?php mostrar_mensajeros(207,2203,$_REQUEST['iddoc']);?></tr><input type="hidden" name="estado_radicado" value="<?php echo(mostrar_valor_campo('estado_radicado',207,$_REQUEST['iddoc'])); ?>"><?php digitalizacion_formato_salida(207,NULL,$_REQUEST['iddoc']);?><?php quitar_descripcion_salida(207,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2191'); ?>"><input type="hidden" name="formato" value="207"><tr><td colspan='2'><?php submit_formato(207,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>