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
global $cantidad_padres;





if(@$_REQUEST['id'] && @$_REQUEST['uid']){
    $arbol="<tree id=\"".$_REQUEST['id']."\">\n";   
    $arbol.=llena_hijos($_REQUEST['id']);
    $arbol.="</tree>\n";   
    echo($arbol);
    die();
}

$arbol="<tree id=\"0\">\n";
$arbol.=llena_padres();
$arbol.="</tree>\n";

echo($arbol);

function llena_padres(){
    global $cantidad_padres;
    $arbol_padres="";
    for($i=0;$i<$cantidad_padres;$i++){
        $arbol_padres.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Nodo ".($i+1)."(<button>Click Me</button>)\" id=\"n".($i+1)."\" child=\"1\">\n";
        $arbol_padres.="</item>\n";
    }
    return($arbol_padres);
}
function llena_hijos($idpadre){
    $numero_nodo_padre=explode('n',$idpadre);
    $arbol_padres="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Nodo ".$numero_nodo_padre[1].".".($i+1)."\" id=\"".$idpadre.".".($i+1)."\" child=\"1\">\n";
    $arbol_padres.="</item>\n"; 
    return($arbol_padres);
}
?>