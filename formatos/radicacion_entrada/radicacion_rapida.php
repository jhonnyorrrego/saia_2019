<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());

?>    


<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">

     <style type="text/css">
     <!--INPUT, TEXTAREA, SELECT, body {
        font-family: Tahoma; 
        font-size: 10px; 
       } 
       .phpmaker {
       font-family: Verdana; 
       font-size: 9px; 
       } 
       .encabezado {
       background-color:#57B0DE; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list { 
       background-color:#57B0DE; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:#57B0DE;
    		text-align: center;
        font-family: Verdana; 
        font-size: 9px;
        text-transform:Uppercase;
        vertical-align:middle;    
    	 }
    	 table tbody td {	
    		font-family: Verdana; 
        font-size: 9px;
    	 }
    	 .ac_results {
				padding: 0px;
				border: 0px solid black;
				background-color: white;
				overflow: hidden;
				z-index: 99999;
			}
    	 
			.ac_results ul {
				width: 100%;
				list-style-position: outside;
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.ac_results li:hover {
			background-color: A9E2F3;
			}
			
			.ac_results li {
				margin: 0px;
				padding: 2px 5px;
				cursor: default;
				display: block;
				font: menu;
				font-size: 10px;
				line-height:10px;
				overflow: hidden;
			}
       -->
       </style><style type="text/css" media="screen">
	@import "../../css/title2note.css";
	html, body {
   height: 99%;
   width:99%;
   overflow: hidden;
}
#div_contenido {
   height: 100%;
   overflow: auto; 
   width:100%;
   position: relative;
   z-index: 2;
}
</style>
</head>
<body>
<div id="div_contenido">
<script src="../../js/jquery-1.7.min.js" type="text/javascript"></script><link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"><link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css"><link rel="stylesheet" type="text/css" href="../../css/jasny-bootstrap.min.css"><link rel="stylesheet" type="text/css" href="../../css/jasny-bootstrap-responsive.min.css"><link rel="stylesheet" type="text/css" href="../../css/bootstrap_reescribir.css"><link rel="stylesheet" type="text/css" href="../../pantallas/lib/librerias_css.css"><link rel="stylesheet" type="text/css" href="../../css/bootstrap_iconos_segundarios.css"><style type="text/css">
			.btn-primary{
				  background-color: #0044cc;
				  background-image: linear-gradient(to top, #0088cc,#0044cc);
			}
			.btn-primary:hover {
			  background-color: #0044cc;
			  background-image: linear-gradient(to bottom, #0088cc,#0044cc);
			}
			.encabezado_list { 
			    background-color: #57B0DE;
			}
			textarea, input[type="text"], input[type="password"], input[type="datetime"], 
			input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], 
			input[type="week"], input[type="number"], input[type="email"], input[type="url"], 
			input[type="search"], input[type="tel"], input[type="color"], .uneditable-input { 
			  border-color: #cccccc;
			  box-shadow: inset 0 1px 1px #cccccc, 0 0 8px #cccccc;
			}
			textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, 
			input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, 
			input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, 
			input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus,
			 .uneditable-input:focus {
			  border-color: #cccccc;
			  box-shadow: inset 0 1px 1px #cccccc, 0 0 8px #cccccc;
			}
			.label-info, .badge-info {
			    background-color: #0B7BB6;
			}
			</style>
			<form method="POST" action="<?php echo($ruta_db_superior); ?>colilla.php"><br/><br />
                <table class="table-hover" style="font-size:10pt;border-collapse:collapse; width:40%; height: auto;" border="1" align="center">
                    <tr>
                        <td style="font-size:8pt;" class="encabezado_list" colspan="2" align="center">Seleccione Tipo de Radicación</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" id="generar_consecutivo" name="generar_consecutivo"/>
                            <input type="hidden" name="enlace" id="enlace" value="pantallas/buscador_principal.php?idbusqueda=7">
                            
                            <?php

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");

$adicional=Null;
if(@$_REQUEST["idcategoria_formato"]){
	$adicional="&idcategoria_formato=".$_REQUEST["idcategoria_formato"];
}
?><link rel="STYLESHEET" type="text/css" href="<?php echo($ruta_db_superior); ?>css/dhtmlXTree.css">
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/dhtmlXTree.js"></script>
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/dhtmlxtree_xw.js"></script> 
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>asset/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>asset/js/main.js"></script>
    
	<br><div id="esperando_serie">
    <img src="<?php echo($ruta_db_superior); ?>imagenes/cargando.gif"></div>
	<div id="treeboxbox_tree_equipos" style="height:89%;width:95%" ></div>
	<script type="text/javascript">
  <!--		
  	$(document).ready(function  () {
			top.setTitulo("Ingreso de documentos");  
	});	
  	
      var browserType;
      
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_equipos=new dhtmlXTreeObject("treeboxbox_tree_equipos","100%","100%",0);
			tree_equipos.setImagePath("<?php echo $ruta_db_superior;?>imgs/");
			tree_equipos.enableIEImageFix(true);
			//tree_equipos.setOnClickHandler(onNodeSelect);
			tree_equipos.setOnCheckHandler(onNodeSelect);
			tree_equipos.enableCheckBoxes(1);
            tree_equipos.enableRadioButtons(true);
			tree_equipos.setOnLoadingStart(cargando_serie);
            tree_equipos.setOnLoadingEnd(fin_cargando_serie);
            
            tree_equipos.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>test_categoria.php?tipo_radicado=radicacion_entrada<?php echo $adicional; ?>");
      //tree_equipos.enableSmartXMLParsing(true);
			tree_equipos.loadXML("<?php echo($ruta_db_superior); ?>test_categoria.php?tipo_radicado=radicacion_entrada<?php echo $adicional; ?>");
	    function onNodeSelect(nodeId){
	     if(nodeId.indexOf('#',0)==-1){
            $('#generar_consecutivo').val(nodeId);
            if(nodeId=='radicacion_salida'){
                $('#enlace').val("pantallas/buscador_principal.php?idbusqueda=10");
            }else{
                $('#enlace').val("pantallas/buscador_principal.php?idbusqueda=7");
            }
	     }
      }
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.visibility = "hidden";
        tree_equipos.openAllItems(0);
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.visibility = "visible";
      }                            	
	--> 		
	</script>
	        </td>
                    </tr>
                    <tr><td style="font-size:8pt;"  align="center">Numero de folios</td>
                        <td align="center"><input type="number" min="0" value="" id="numero_folios" name="folios"/></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input class="btn btn-primary btn-mini" type="submit" value="Radicar" id="enviar" name="enviar"/></td>
                    </tr>
                </table>
            </form>
    <!--script>
	$(document).ready(function(){
		$("#enviar").click(function(){
			var ingreso=confirm("Esta seguro de generar un nuevo radicado?");
			if(ingreso){
				form.submit();
			}else{
				return false;
			}
		});
	});
</script-->
