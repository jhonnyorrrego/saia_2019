<?php  
$cantidad_padres=3;
$cantidad_hijos=3;

$arbol="<tree id=\"0\">\n";
$arbol.=llena_padres();
$arbol.="</tree>\n";



function llena_padres(){
    global $cantidad_padres;
    
    $arbol_padres="";
    for($i=0;$i<count($cantidad_padres);$i++){
        $arbol_padres.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Padre ".($i+1)."\" id=\"padre_".($i+1)."\" child=\"1\">";
        $arbol_padres.=llena_hijos($i);
        $arbol_padres.="</item>";
    }
    return($arbol_padres);
}
function llena_hijos($padre){
    global $cantidad_hijos;
    
    $arbol_hijos="";
    for($i=0;$i<count($cantidad_hijos);$i++){
        $arbol_hijos.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Hijo ".$padre.".".($i+1)."\" id=\"".$padre."_hijo_".($i+1)."\" child=\"0\">";
        $arbol_hijos.="</item>";
    }    
    return($arbol_hijos);
}
?>