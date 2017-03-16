<?php
include_once("../../db.php");
?>
<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css">
<?php
$iddocumento=0;
$texto='<span class="phpmaker">';
if($_REQUEST["iddoc"]){
$iddocumento=$_REQUEST["iddoc"];
  $formato=busca_filtro_tabla("A.numero,A.descripcion AS etiqueta,B.nombre_tabla,B.idformato,B.nombre","documento A,formato B","A.plantilla=B.nombre AND A.iddocumento=".$iddocumento,"",$conn);
  //print_r($formato);
  if($formato["numcampos"]){
    $numero=$formato[0]["numero"];
    $texto.='<b>'.strtoupper($formato[0]["nombre"]).':</b><br>';
    $texto.="Numero Radicado: ".$formato[0]["numero"]."<br>";
    $texto.=strip_tags(codifica_encabezado(html_entity_decode("Descripcion:".$formato[0]["etiqueta"])),"<b>");
    $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%'","",$conn);
    if($descripcion["numcampos"]){
      $campo_descripcion=$descripcion[0]["nombre"];
    }
    else{
      $campo_descripcion="id".$formato[0]["nombre_tabla"];
    }
  $papas=busca_filtro_tabla("id".$formato[0]["nombre_tabla"]." AS llave, ".$campo_descripcion." AS etiqueta ,'".$formato[0]["nombre_tabla"]."' AS nombre_tabla",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddocumento,"",$conn);
    if($papas["numcampos"]){
      $iddoc=$formato[0]["idformato"]."-".$papas[0]["llave"]."-id".$formato[0]["nombre_tabla"];
      $llave_formato=$formato[0]["idformato"]."-id".$formato[0]["nombre_tabla"]."-".$papas[0]["llave"];
    }
    else {
      $iddoc=0;
      $llave_formato=0;
    }
  $_SESSION["iddoc"]=$formato[0]["iddocumento"];
  }
  else {
    $iddoc=0;
    $texto="Existen Problemas al buscar el documento";
  }
}
else {
  alerta("No se ha podido encontrar el Documento");
  volver(1);
}
$_SESSION["iddoc"]=$iddocumento;
$texto.="</span>";
if(@$_REQUEST["llave"]){
  $nodoinicial=$_REQUEST["llave"];
}
else $nodoinicial=$iddoc;
//echo("<br />".$iddoc);
?>
<html>
<body>
<head>
<script type="text/javascript" src="../../js/jquery.js"></script>
<?php
$alto=120;
$ancho=225;
$estilo='
<style type="text/css">
#sliderWrap {
margin: 0 auto;
width: '.$ancho.'px;
background-color:#00FF00;
z-index=999;
}
#slider {
position: absolute;
background-color:#000000;
background-repeat:no-repeat;
background-position: bottom;
width: '.($ancho+5).'px;
height: '.$alto.'px;
margin-top: -'.$alto.'px;
z-index=999;
}
#slider img {
border: 0;
z-index=999;
}
#sliderContent {
margin: 5px 0 0 5px;
position: absolute;
text-align:center;
background-color:#FFFFFF;
color:#333333;
font-weight:bold;
padding: 10px;
height:'.($alto-10).'px;
width: '.($ancho-5).'px;
z-index=999;
}
#header {
margin: 0 auto;
width: 100%;
background-color: #FFFFFF;
height: '.($alto+25).'px;
padding: 10px;
z-index=999;
}
#openCloseWrap {
position:absolute;
margin: '.($alto+3).'px 0 0 '.($ancho-60).'px;
font-size:9px;
font-weight:bold;
font-family:verdana;
z-index=999;
}
</style>
';
echo($estilo);
?>
<script type="text/javascript">
$(document).ready(function() {
	$(".topMenuAction").click( function() {
		if ($("#openCloseIdentifier").is(":hidden")) {
			$("#slider").animate({
				marginTop: "-<?php echo($alto);?>px"
				}, 500 );
			$("#topMenuImage").html('Acciones <img src="../../images/open.png" alt="Acciones" />');
			$("#openCloseIdentifier").show();
		} else {
			$("#slider").animate({
				marginTop: "0px"
				}, 500 );
			$("#topMenuImage").html('Acciones <img src="../../images/close.png" alt="Acciones" />');
			$("#openCloseIdentifier").hide();
		}
	});
});
</script>
</head>
	<div id="sliderWrap">
		<div id="openCloseIdentifier"></div>
		<div id="slider">
			<div id="sliderContent">
        Por Favor Seleccione un Documento
        <?php echo($iddoc); ?>
      </div>
			<div id="openCloseWrap" valign="top">
				<a href="#" class="topMenuAction" id="topMenuImage" style="text-decoration:none;">Acciones <img src="../../images/open.png" alt="Acciones" /></a>
			</div>
		</div>
	</div>
  <div id="header">
  	<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
    <link rel="STYLESHEET" type="text/css" href="../librerias/estilo.css">
    <script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
  	<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
    <div id="esperando"><img src="../../imagenes/cargando.gif"></div>
     <?php echo($texto); ?>
     <span class="phpmaker">
  	  <br>
       Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="botones/general/siguiente.png"border="0px"></a>
    </span><br><br>
  	<div id="treeboxbox_tree2" ></div>
  </div>

	<script type="text/javascript">
  <!--
      var nivel=0;
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","<?php echo($ancho-20);?>","298px",0);
			tree2.setImagePath("../../botones/formatos/");
  		//tree2.enableIEImageFix(true);
      //tree2.setImageArrays("plus","plus.gif","plus.gif","plus.gif","plus.gif","plus.gif");
			//tree2.setImageArrays("minus","minus.gif","minus.gif","minus.gif","minus.gif","minus.gif");
			//tree2.enableTreeImages("true");
			tree2.enableAutoTooltips(1);
			tree2.enableTreeImages("false");
      tree2.enableTreeLines("true");
      tree2.enableTextSigns("true");
			tree2.setOnLoadingStart(cargando);
      tree2.setOnLoadingEnd(fin_cargando);
      tree2.enableSmartXMLParsing(true);
      tree2.setOnClickHandler(onNodeSelect);
			tree2.loadXML("test_formatos_documento2.php?id=<?php echo($iddoc);?>");
      tree2.findItem("<?php echo($nodoinicial);?>");
			function onNodeSelect(nodeId)
      {
        /*alert(nodeId);
        var adicion=document.getElementById("adicionar").checked;
        var edicion=document.getElementById("editar").checked;
        var elimina=document.getElementById("eliminar").checked;
        var accion=0;*/
        var llave=0;
        llave=tree2.getParentId(nodeId);
        tree2.closeAllItems(tree2.getParentId(nodeId))
        tree2.openItem(nodeId);
        tree2.openItem(tree2.getParentId(nodeId));
        //tree2.refreshItem(nodeId);
        /*if(adicion)
          accion="adicionar";
        else if(edicion)
          accion="editar";
        else if(elimina)
          accion="eliminar";
        else
          accion="mostrar";*/
        genera_menu(nodeId);
        conexion="../arboles/parsear_accion_arbol.php?id="+nodeId+"&accion=mostrar&llave="+llave;
        window.parent.open(conexion,"detalles");
      }
			function seleccion_accion(accion,id)
      {
        var nodeId=0;
        var llave=0;
        nodeId=tree2.getSelectedItemId();
        if(!nodeId){
          alert("Por Favor seleccione un documento del arbol");
          return;
        }
        llave=tree2.getParentId(nodeId);
        /*if((typeof(id)=="undefined" || id==0)){

        }
        else llave=id;*/
        tree2.closeAllItems(tree2.getParentId(nodeId))
        tree2.openItem(nodeId);
        tree2.openItem(tree2.getParentId(nodeId));
        conexion="parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave;
        window.parent.open(conexion,"detalles");
      }
      function genera_menu(nodeId){
        $.ajax({
          type:'POST',
          url:'../arboles/genera_menu_documento.php',
          data:'nodo='+nodeId,
          success: function(datos,exito){
            $("#sliderContent").empty();
            $("#sliderContent").append(datos);
          }
        });
      }
      function fin_cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
              eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando")');
        else
           document.poppedLayer =
               eval('document.layers["esperando"]');
        document.poppedLayer.style.visibility = "visible";
      }
      function actualizar_papa(nodeId){
        var papa=tree2.getParentId(nodeId);
        tree2.closeItem(papa);
        tree2.deleteItem(nodeId,true);
        //tree2.refreshItem(nodeId);
        tree2.findItem(papa);
      }
	-->
	</script>
	</body>
</html>
