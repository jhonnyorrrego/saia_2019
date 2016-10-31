<?php  
//codificacion arbol
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

$cantidad_padres=3;
$cantidad_hijos=3;
$cantidad_subhijos=3;
global $cantidad_padres,$cantidad_hijos,$cantidad_subhijos;

$arbol="<tree id=\"0\">\n";
$arbol.=llena_padres();
$arbol.="</tree>\n";

echo($arbol);

function llena_padres(){
    global $cantidad_padres;
    $arbol_padres="";
    for($i=0;$i<$cantidad_padres;$i++){
        $arbol_padres.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Padre ".($i+1)."\" id=\"padre_".($i+1)."\" child=\"1\">\n";
        $arbol_padres.=llena_hijos($i);
        $arbol_padres.="</item>\n";
    }
    return($arbol_padres);
}
function llena_hijos($padre){
    global $cantidad_hijos;
    
    $arbol_hijos="";
    for($j=0;$j<$cantidad_hijos;$j++){
        $arbol_hijos.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Hijo ".($padre+1).".".($j+1)."\" id=\"".($padre+1)."_hijo_".($j+1)."\" child=\"1\">\n";
        $arbol_hijos.=llena_subhijos($j);
        $arbol_hijos.="</item>\n";
    }    
    return($arbol_hijos);
}
function llena_subhijos($padre){
    global $cantidad_subhijos;
    
    $arbol_hijos="";
    for($j=0;$j<$cantidad_subhijos;$j++){
        $arbol_hijos.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Subhijo ".($padre+1).".".($j+1)."\" id=\"".($padre+1)."_subhijo_".($j+1)."\" child=\"0\">\n";
        $arbol_hijos.="</item>\n";
    }    
    return($arbol_hijos);
}
?>