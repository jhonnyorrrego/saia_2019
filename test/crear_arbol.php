<?php
if ($_REQUEST["xml"] != "" && $_REQUEST["campo"]) {
	$parametros = array(
		"radio" => 0,
		"check_branch" => 0,
		"abrir_cargar" => 0,
		"busqueda_item" => 0,
		"onNodeSelect" => "",
		"ruta_db_superior" => "",
		"seleccionar_todos"=> ""
	);

	if (isset($_REQUEST["radio"])) {
		$parametros["radio"] = $_REQUEST["radio"];
	}
	if (isset($_REQUEST["check_branch"])) {
		$parametros["check_branch"] = $_REQUEST["check_branch"];
	}
	if (isset($_REQUEST["abrir_cargar"])) {
		$parametros["abrir_cargar"] = $_REQUEST["abrir_cargar"];
	}
	if (isset($_REQUEST["onNodeSelect"])) {
		$parametros["onNodeSelect"] = $_REQUEST["onNodeSelect"];
	}
	if (isset($_REQUEST["ruta_db_superior"])) {
		$parametros["ruta_db_superior"] = $_REQUEST["ruta_db_superior"];
	}
	if (isset($_REQUEST["busqueda_item"])) {
		$parametros["busqueda_item"] = $_REQUEST["busqueda_item"];
	}
	if (isset($_REQUEST["seleccionar_todos"])) {
		$parametros["seleccionar_todos"] = $_REQUEST["seleccionar_todos"];
	}
	
	crear_arbol($_REQUEST["xml"], $_REQUEST["campo"], $parametros);
}
function crear_arbol($xml,$campo,$parametros) {
	if($parametros["busqueda_item"]){
	?>
		<input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="20">          
		<a href="javascript:void(0)" onclick="tree<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),1)">
		<img src="<?php echo $parametros["ruta_db_superior"]; ?>botones/general/anterior.png"border="0px"></a>
		
		<a href="javascript:void(0)">
		<img src="<?php echo $parametros["ruta_db_superior"]; ?>botones/general/buscar.png"border="0px"></a>
		<a href="javascript:void(0)" onclick="tree<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value))">
		<img src="<?php echo $parametros["ruta_db_superior"]; ?>botones/general/siguiente.png"border="0px"></a>      
	<?php }?>

	<div id="esperando<?php echo $campo; ?>"><img src="<?php echo $parametros["ruta_db_superior"];?>imagenes/cargando.gif"></div>
	<div id="treeboxbox<?php echo $campo; ?>" width="100px" height="100px"></div>
	<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
	<script type="text/javascript">
	var browserType;
	if (document.layers) {browserType = "nn4"}
	if (document.all) {browserType = "ie"}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {browserType= "gecko"}
	
	tree<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $campo; ?>","auto","auto",0);
	tree<?php echo $campo; ?>.setImagePath("<?php echo $parametros["ruta_db_superior"];?>imgs/");
	tree<?php echo $campo; ?>.enableIEImageFix(true);
	tree<?php echo $campo; ?>.setOnLoadingStart(cargando<?php echo $campo; ?>);
	tree<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando<?php echo $campo; ?>);
	tree<?php echo $campo; ?>.enableCheckBoxes(1);
	
	<?php if($parametros["radio"]){?>
	tree<?php echo $campo; ?>.enableRadioButtons(true);
	<?php }?>
	
	<?php if($parametros["check_branch"]){?>
	tree<?php echo $campo; ?>.enableThreeStateCheckboxes(true);
	<?php }?>
	
	tree<?php echo $campo; ?>.loadXML("<?php echo $parametros["ruta_db_superior"].$xml; ?>");
	tree<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect<?php echo $campo."_".$parametros["radio"]; ?>);
	
	<?php if($parametros["onNodeSelect"]!=""){?>
		tree<?php echo $campo; ?>.setOnCheckHandler(<?php echo $parametros["onNodeSelect"]; ?>);	
	<?php }?>
	
	function onNodeSelect<?php echo $campo."_0"; ?>(nodeId){
		document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $campo; ?>.getAllChecked();
	}
	
	function onNodeSelect<?php echo $campo."_1"; ?>(nodeId){
		valor_destino=document.getElementById("<?php echo $campo; ?>");
		if(tree<?php echo $campo; ?>.isItemChecked(nodeId)){
			if(valor_destino.value!==""){
				tree<?php echo $campo; ?>.setCheck(valor_destino.value,false);
			}
			if(nodeId.indexOf("_")!=-1){
				nodeId=nodeId.substr(0,nodeId.indexOf("_"));
			}
			valor_destino.value=nodeId;
		}else{
			valor_destino.value="";
		}
	}
	
	function cargando<?php echo $campo; ?>() {
		if (browserType == "gecko" ){
			document.poppedLayer =eval('document.getElementById("esperando<?php echo $campo; ?>")');
		}else if (browserType == "ie"){
			document.poppedLayer =eval('document.getElementById("esperando<?php echo $campo; ?>")');
		}else{
			document.poppedLayer =eval('document.layers["esperando<?php echo $campo; ?>"]');
		}   
		document.poppedLayer.style.display = "";
	}
	
	function fin_cargando<?php echo $campo; ?>() {
		if (browserType == "gecko" ){
			document.poppedLayer =eval('document.getElementById("esperando<?php echo $campo; ?>")');
		}else if (browserType == "ie"){
			document.poppedLayer =eval('document.getElementById("esperando<?php echo $campo; ?>")');
		}else{
			document.poppedLayer =eval('document.layers["esperando<?php echo $campo; ?>"]');
		}
		document.poppedLayer.style.display = "none";
		document.getElementById('<?php echo $campo; ?>').value=tree<?php echo $campo; ?>.getAllChecked();
		
		<?php if($parametros["abrir_cargar"]){?>
			tree<?php echo $campo; ?>.openAllItems(0);
		<?php }?>
	}
	
	function todos_check(elemento, campo) {
		seleccionados = elemento.getAllUnchecked();
		nodos = seleccionados.split(",");
		for ( i = 0; i < nodos.length; i++){
			elemento.setCheck(nodos[i], true);
		}
		document.getElementById(campo).value = elemento.getAllChecked();
	}

	function ninguno_check(elemento, campo) {
		seleccionados = elemento.getAllChecked();
		nodos = seleccionados.split(",");
		for ( i = 0; i < nodos.length; i++){
			elemento.setCheck(nodos[i], false);
		}
		document.getElementById(campo).value = "";
	}
	</script><br/>
	
	<?php	
	
	if($parametros["seleccionar_todos"]=="" && $parametros["radio"]==0){?>
	<a onclick="todos_check(tree<?php echo $campo; ?>,'<?php echo $campo; ?>')" href="#">TODOS</a>&nbsp;&nbsp;&nbsp;
	<a onclick="ninguno_check(tree<?php echo $campo; ?>,'<?php echo $campo; ?>')" href="#">NINGUNO</a>
	<?php }?>
<?php
}