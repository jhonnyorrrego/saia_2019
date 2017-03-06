<?php
include_once("../../db.php");
?>
<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css">
<?php
$valores=array();
foreach($_REQUEST as $nombre => $valor){
	$valores[]=$nombre."=".$valor;
}
redirecciona("../../pantallas/documento/informacion_resumen_documento.php?".implode("&",$valores));

$iddocumento=0;
$texto='<span class="phpmaker">';
if($_REQUEST["iddoc"]){
$iddocumento=$_REQUEST["iddoc"];
  $formato=busca_filtro_tabla("A.numero,A.descripcion AS etiqueta,B.nombre_tabla,B.idformato,B.nombre, A.iddocumento","documento A,formato B","lower(A.plantilla)=B.nombre AND A.iddocumento=".$iddocumento,"",$conn);
  //print_r($formato);
  if($formato["numcampos"]){
    $numero=$formato[0]["numero"];
    $texto.='<b>'.strtoupper($formato[0]["nombre"]).':</b><br>';
    $texto.="Numero Radicado: ".$formato[0]["numero"]."<br>";
    $texto.=strip_tags(html_entity_decode("Descripcion:".(stripslashes($formato[0]["etiqueta"]))),"<br>");
    $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%'","",$conn);
    if($descripcion["numcampos"]){
      $campo_descripcion=$descripcion[0]["nombre"];
    }
    else{
      $campo_descripcion="id".$formato[0]["nombre_tabla"];
    }
  $papas=busca_filtro_tabla("id".$formato[0]["nombre_tabla"]." AS llave, ".$campo_descripcion." AS etiqueta ,'".$formato[0]["nombre_tabla"]."' AS nombre_tabla",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddocumento,"id".$formato[0]["nombre_tabla"]." ASC",$conn);
 
    if($papas["numcampos"]){
      $iddoc=$formato[0]["idformato"]."-".$papas[0]["llave"]."-id".$formato[0]["nombre_tabla"];
      $iddoc2=$iddoc;                                
      $llave_formato=$formato[0]["idformato"]."-id".$formato[0]["nombre_tabla"]."-".$papas[0]["llave"]."-".$iddocumento;
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
leido(usuario_actual("funcionario_codigo"),$iddocumento);
}
else {
  alerta("No se ha podido encontrar el Documento");
  volver(1);
}
$_SESSION["iddoc"]=$iddocumento;
$texto.="</span>";
if(@$_REQUEST["seleccionar"])
  {$datos_seleccionar=explode("-",$_REQUEST["seleccionar"]);
   $id=busca_filtro_tabla("id".$datos_seleccionar[2],$datos_seleccionar[2],"documento_iddocumento=".$datos_seleccionar[3],"",$conn);
   $nodoinicial=$datos_seleccionar[0]."-".$datos_seleccionar[1]."-".$id[0]["id".$datos_seleccionar[2]]."-".$datos_seleccionar[3];
  }
elseif(@$_REQUEST["llave"]){
  $nodoinicial=$_REQUEST["llave"];
}
else $nodoinicial=$llave_formato;

//echo("<br />".$nodoinicial);
?>
<html>
<body>
<head>
<script type="text/javascript" src="../../js/jquery.js"></script>
<?php
$alto=90;
$ancho=225;
$alto2=150;
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
margin: 1px 0 0 1px;
position: absolute;
text-align:center;
background-color:#FFFFFF;
color:#333333;
font-weight:bold;
padding: 10px;
height:'.($alto-2).'px;
width: '.($ancho+3).'px;
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
/******************************************/

#sliderWrap2 {
margin: 0 auto;
width: '.$ancho.'px;
background-color:#00FF00;
z-index=999;
}
#slider2 {
position: absolute;
background-color:#000000;
background-repeat:no-repeat;
background-position: bottom;
width: '.($ancho+5).'px;
height: '.$alto2.'px;
margin-top: 0px;
z-index=999;
}
#slider img2 {
border: 0;
z-index=999;
}
#sliderContent2 {
margin: 1px 0 0 1px;
position: absolute;
text-align:left;
background-color:#FFFFFF;
color:#333333;
font-size:xx-small;
font-family:verdana;
padding: 10px;
height:'.($alto2-2).'px;
width: '.($ancho+3).'px;
z-index=999;
}
#header2 {
margin: 0 auto;
width: 100%;
background-color: #FFFFFF;
height: '.($alto2+25).'px;
padding: 10px;
z-index=999;
}
#openCloseWrap2 {
position:absolute;
margin: -20px 0 0 '.($ancho-100).'px;
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
	$("#topMenuImage").click( function() {
		click_menu();
	});
});
function click_menu(){
if ($("#openCloseIdentifier").is(":hidden")) {
			$("#slider").animate({
				marginTop: "-<?php echo($alto);?>px"
				}, 500 );
			$("#topMenuImage").html('<font color="blue">Acciones </font> <img src="../../images/open.png" alt="Acciones" />');
			$("#openCloseIdentifier").show();
		} else {
			$("#slider").animate({
				marginTop: "0px"
				}, 500 );
			$("#topMenuImage").html('<font color="blue">Acciones </font> <img src="../../images/close.png" alt="Acciones" />');
			$("#openCloseIdentifier").hide();
		}
} 
$(document).ready(function() {
	$("#topMenuImage2").click( function() {
		click_menu2();
	});
});
function click_menu2(){
if ($("#openCloseIdentifier2").is(":hidden")) {
			$("#slider2").animate({
				marginTop: "0px"
				}, 500 );
			$("#topMenuImage2").html('<font color="blue" style="cursor:pointer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notas</font> <img src="../../images/close.png" alt="Notas Recientes" />');
			$("#openCloseIdentifier2").show();
		} else {
			$("#slider2").animate({
				marginTop: "-90px"
				}, 500 );
			$("#topMenuImage2").html('<font color="blue" style="cursor:pointer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notas</font> <img src="../../images/open.png" alt="Notas Recientes" />');
			$("#openCloseIdentifier2").hide();
		}
} 
</script>
<style type="text/css" media="screen">
#div_contenido {
   overflow: hidden;
}
</style></head>
	<div id="sliderWrap">
		<div id="openCloseIdentifier"></div>
		<div id="slider">
			<div id="sliderContent">
        Por Favor Seleccione un Documento
      </div>
			<div id="openCloseWrap" valign="top">
				<a class="topMenuAction" id="topMenuImage" style="text-decoration:none;cursor:pointer"><font color="blue">Acciones </font><img src="../../images/open.png" alt="Acciones" /></a>
			</div>
		</div>
	</div>
  	<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">
    <link rel="STYLESHEET" type="text/css" href="../librerias/estilo.css">
    <script type="text/javascript" src="../../js/dhtmlXCommon.js"></script>
  	<script type="text/javascript" src="../../js/dhtmlXTree.js"></script>
    <div id="esperando_"><img src="../../imagenes/cargando.gif"></div>
     <?php echo $texto; ?>
     <span class="phpmaker">
  	  <br>
      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,1)">
      <img src="../../botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value,0,1)">
      <img src="../../botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(document.getElementById('stext').value)">
      <img src="../../botones/general/siguiente.png"border="0px"></a>
     </span><br><br>
  	<div id="treeboxbox_tree2" ></div>
          
	<script type="text/javascript">
  <!--
      var nivel=0;
      var browserType;
      var item="<?php echo($nodoinicial);?>";
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","<?php echo($ancho-20);?>","298px",0);
			tree2.setImagePath("../../botones/formatos/");
			tree2.enableAutoTooltips(1);
			tree2.enableTreeImages("false");
      tree2.enableTreeLines("true");
      tree2.enableTextSigns("true");
			tree2.setOnLoadingStart(cargando);
      tree2.setOnLoadingEnd(fin_cargando);
      tree2.setOnClickHandler(onNodeSelect);
			tree2.loadXML("test_formatos_documento2.php?id=<?php echo($iddoc2);?>");
			click_menu();
			function esperar(){
      }
			function onNodeSelect(nodeId)
      { var llave=0;
        llave=tree2.getParentId(nodeId);
        /*tree2.closeAllItems(tree2.getParentId(nodeId))
        tree2.openItem(nodeId);
        tree2.openItem(tree2.getParentId(nodeId)); */
       
        genera_menu(nodeId);
        conexion="../arboles/parsear_accion_arbol.php?id="+nodeId+"&accion=mostrar&llave="+llave+"&enlace_adicionar_formato=1";
        window.parent.frames["detalles"].location=conexion;
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
               eval('document.getElementById("esperando_")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_"]');
        document.poppedLayer.style.visibility = "hidden";
        <?php 
        if(!isset($_REQUEST["no_seleccionar"])) 
           {
        ?>
        tree2.selectItem(item,true,false);
        tree2.openAllItems(0);
        <?php   
           }
        ?>
        
      }

      function cargando() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_"]');
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
	<div id="sliderWrap2">
		<div id="openCloseIdentifier2"></div>
		<div id="slider2">
			<div id="sliderContent2">
<?php
$notas_trans=busca_filtro_tabla("notas,f1.nombres as nombres1,f1.apellidos as apellidos1,f2.nombres as nombres2,f2.apellidos as apellidos2,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida,funcionario f1,funcionario f2","destino=f2.funcionario_codigo and origen=f1.funcionario_codigo and (destino='".usuario_actual("funcionario_codigo")."' or ver_notas=1) and (notas is not null) and archivo_idarchivo=".$_REQUEST["iddoc"],"fecha desc",$conn);
$notas_postit=busca_filtro_tabla("nombres,apellidos,comentario,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","comentario_img,funcionario","funcionario=login and documento_iddocumento=".$_REQUEST["iddoc"],"fecha desc",$conn);
$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn); 
if($notas_trans["numcampos"]){
echo "<b>Notas Transferencias:</b><br />" ;
for($i=0;$i<$notas_trans["numcampos"] && $i<2;$i++ )
  echo ($i+1).". <label title='Autor: ".$notas_trans[$i]["nombres1"]." ".$notas_trans[$i]["apellidos1"]."\nDestino: ".$notas_trans[$i]["nombres2"]." ".$notas_trans[$i]["apellidos2"]."\nFecha: ".$notas_trans[$i]["fecha"]."\nNota: ".$notas_trans[$i]["notas"]."'>".delimita(codifica_encabezado(html_entity_decode($notas_trans[$i]["notas"])),30)."</label><br />";
 
echo "<a href='../../doctransflist.php?doc=".$_REQUEST["iddoc"]."' target='detalles'>Ver mas</a><br />"; 
 }
if($notas_postit["numcampos"]){
echo "<br /><b>Notas Post-it:</b><br />" ;
for($i=0;$i<$notas_postit["numcampos"] && $i<2;$i++ )
  echo ($i+1).". <label title='Autor: ".$notas_postit[$i]["nombres"]." ".$notas_postit[$i]["apellidos"]."\nFecha: ".$notas_postit[$i]["fecha"]."\nNota: ".$notas_postit[$i]["comentario"]."'>".delimita(strip_tags(codifica_encabezado(html_entity_decode($notas_postit[$i]["comentario"]))),30)."</label><br />"; 
echo "<a href='../".$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$_REQUEST["iddoc"]."&ver_notas=1' target='detalles'>Ver mas</a>";  
 }      
 ?>
      </div>
			<div id="openCloseWrap2" valign="top">
				<a class="topMenuAction" id="topMenuImage2" style="text-decoration:none;cursor:pointer"><font color="blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notas</font> <img src="../../images/close.png" alt="Notas" /></a>
			</div>
		</div>
	</div>
</body>
</html>
