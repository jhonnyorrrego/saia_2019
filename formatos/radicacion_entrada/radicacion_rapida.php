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
			<form method="POST" action="../../colilla.php"><br/><br />
                <table style="font-size:10pt;border-collapse:collapse; width:40%;" border="1" align="center">
                    <tr>
                        <td style="font-size:8pt;" class="encabezado_list" colspan="2" align="center">Seleccione el formato a radicar</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php 
	        echo arbol("radicacion","tipo_radicacion","formatos/radicacion_entrada/text_radicacion_rapida.php?idcategoria_formato=1","","","","","check"); 
	        ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Radicar" id="enviar" name="enviar"/></td>
                    </tr>
                </table>
            </form>
    <script>
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
</script>