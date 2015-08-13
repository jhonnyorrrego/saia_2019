<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); 
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT, body {
        font-family: Tahoma; 
        font-size: 10px; 
       } 
       .phpmaker {
       font-family: Verdana; 
       font-size: 9px; 
       } 
       .encabezado {
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list { 
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:".$config[0]["valor"].";
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
    	 
       -->
       </style>";
  echo $style;
  }
?>
<style type="text/css" media="screen">
	@import "<?php echo($ruta_db_superior);?>css/title2note.css";
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
