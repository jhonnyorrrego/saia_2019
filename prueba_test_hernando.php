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


if(@$_REQUEST['seleccionado']){
    echo('<tree style="font-family:verdana; font-size:7pt;" text="Nodo 1" id="n1" child="1">
<item style="font-family:verdana; font-size:7pt;" text="Nodo 1.1" id="n1.1" child="1">
</item>
<item style="font-family:verdana; font-size:7pt;" text="Nodo 1.2" id="n1.12" child="1">
</item>
</tree>');
    die();
    $arbol=crear_rama_padre_hijo($_REQUEST['seleccionado']);
    echo($arbol);
    die();    
}


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



function crear_rama_padre_hijo($nodeid){
    
    $ids_cadena=substr($nodeid,1, ( strlen( $nodeid )-1 ) );
    $vector_ids=explode('.',$ids_cadena);
    $arbol="";
    $consecutivo="";
    for($i=0;$i<count($vector_ids);$i++){
        if($i!=0){
            $consecutivo.=".";
        }        
        $consecutivo.=$vector_ids[$i];
        $llave="item";
        if($i==0){
            $llave="tree";
        }
        $arbol.="<".$llave." style=\"font-family:verdana; font-size:7pt;\" text=\"Nodo ".$consecutivo."\" id=\"n".$consecutivo."\" child=\"1\">\n";
        
    }
    for($i=0;$i<count($vector_ids);$i++){
        $llave="item";
        if( ($i+1)==count($vector_ids) ){
            $llave="tree";
        }
        $arbol.="</".$llave.">\n";
    }
    
    
    return($arbol);
}

function llena_padres(){
    global $cantidad_padres;
    $arbol_padres="";
    for($i=0;$i<$cantidad_padres;$i++){
        $arbol_padres.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Nodo ".($i+1)."\" id=\"n".($i+1)."\" child=\"1\">\n";
        $arbol_padres.="</item>\n";
    }
    return($arbol_padres);
}
function llena_hijos($idpadre){
    $numero_nodo_padre=explode('n',$idpadre);
    
    $consecutivo=1;
    if(@$_REQUEST['cantidad_hijos']){
        $consecutivo=$consecutivo+$_REQUEST['cantidad_hijos'];
    }
    
    $arbol_padres="<item style=\"font-family:verdana; font-size:7pt;\" text=\"Nodo ".$numero_nodo_padre[1].".".$consecutivo."\" id=\"".$idpadre.".".$consecutivo."\" child=\"1\">\n";
    $arbol_padres.="</item>\n"; 
    return($arbol_padres);
}
?>