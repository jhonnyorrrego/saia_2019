<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.8"));
echo(librerias_arboles());

if($_REQUEST["idformato"]){
		$idformato =$_REQUEST["idformato"]; 
	$formato = busca_filtro_tabla("","formato","idformato=".$_REQUEST['idformato'],"",$conn);
	$cod_padre=$formato[0]["cod_padre"];
	if($cod_padre){
		$adicional_cod_padre="&seleccionado=".$cod_padre;
	}
	
}
?>
<html>
<body>
  <div id="esperando_formato">
    <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
  </div>
	<div id="treeboxbox_tree3" class="arboles_saia"></div>
<script type="text/javascript">
  var browserType;
  if (document.layers) {browserType = "nn4"}
  if (document.all) {browserType = "ie"}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
     browserType= "gecko"
  }
  tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
  tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree3.enableTreeImages(false);
  tree3.enableIEImageFix(true);
  tree3.setOnLoadingStart(cargando_serie);
  tree3.setOnLoadingEnd(fin_cargando_serie);
  tree3.setOnClickHandler(onNodeSelect);
  tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/formato/test_formatos_admin.php?tabla=formato&id=<?php echo $idformato; ?>");
  function onNodeSelect(nodeId){ 
  	var tipo_nodo=nodeId.split("_");
  	if(tipo_nodo[1]=="v"){
  		conexion="<?php echo($ruta_db_superior);?>formatos/vista_formatoedit.php?key="+tipo_nodo[0];
  		//pantallas/generador/generador_pantalla.php?idformato={*idformato*}
  	}
  	else if(tipo_nodo[0]=='vistasmenu'){
  		conexion="<?php echo($ruta_db_superior);?>formatos/vista_formatoadd.php?formato_padre="+tipo_nodo[1];
  	}
  	else{
   		conexion="<?php echo($ruta_db_superior);?>pantallas/generador/generador_pantalla.php?idformato="+nodeId;
   	}
   // window.parent.frames["iframe_detalle"].location=conexion;
    window.parent.location=conexion;
  }
  function fin_cargando_serie() {
    if (browserType == "gecko" )
       document.poppedLayer =
           eval('document.getElementById("esperando_formato")');
    else if (browserType == "ie")
       document.poppedLayer =
          eval('document.getElementById("esperando_formato")');
    else
       document.poppedLayer =
          eval('document.layers["esperando_formato"]');
    document.poppedLayer.style.visibility = "hidden";
  	tree3.openAllItems(0);
  }
  
  function cargando_serie() {
    if (browserType == "gecko" )
       document.poppedLayer =
           eval('document.getElementById("esperando_formato")');
    else if (browserType == "ie")
       document.poppedLayer =
          eval('document.getElementById("esperando_formato")');
    else
       document.poppedLayer =
           eval('document.layers["esperando_formato"]');
    document.poppedLayer.style.visibility = "visible";
  }              
</script>
</body>
</html>
