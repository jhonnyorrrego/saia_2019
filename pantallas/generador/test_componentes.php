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
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else { 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");
include_once($ruta_db_superior."db.php");
llena_categorias(); 
echo("</tree>\n");
$activo = "";
?>
<?php

function llena_categorias(){
global $conn;
$where='';
if(@$_REQUEST["categoria"]){
	$where=" AND lower(categoria)='".strtolower($_REQUEST["categoria"])."'";
}
$categorias=busca_filtro_tabla("","pantalla_componente","estado=1".$where,"GROUP BY categoria",$conn);
if($categorias["numcampos"]){ 
  for($i=0; $i<$categorias["numcampos"]; $i++){    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($categorias[$i]["categoria"])."\" id=\"".$categorias[$i]["categoria"]."\">");        
    llena_componentes($categorias[$i]["categoria"]);
    echo("</item>\n");
  }     
}
return;
}
function llena_componentes($nombre){
global $conn;
$componentes=busca_filtro_tabla("","pantalla_componente","estado=1 AND lower(categoria)='".strtolower($nombre)."'","nombre",$conn);	
if($componentes["numcampos"]){ 
  for($i=0; $i<$componentes["numcampos"]; $i++){    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($componentes[$i]["etiqueta"])."\" id=\"".$componentes[$i]["idpantalla_componente"]."\">");
    echo("</item>\n");
  }     
}
}
?>
