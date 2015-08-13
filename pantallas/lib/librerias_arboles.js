function ancho_pantalla(){
    var body = document.body,html = document.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight,html.clientHeight, html.scrollHeight, html.offsetHeight );
   return(height);
}
function alto_pantalla(){
   var body = document.body,html = document.documentElement;    
   var width = Math.max( body.scrollWidth, body.offsetWidth,html.clientWidth, html.scrollWidth, html.offsetWidth );    
   return(width);
}
function strpos_javascript (haystack, needle, offset) {
  var i = (haystack+'').indexOf(needle, (offset || 0));
  return i === -1 ? false : i;
}
function redireccion_arbol_documentos(nodo,nodo_papa,ruta_inicial){
conexion="http://"+ruta_inicial+"/vacio.php";
    if(strpos_javascript(nodo,"-r")){
      var arreglo=nodo.split("-");
      nombre_formato=arreglo[1];
      var arreglo_llave=nodo_papa.split("-");      
      conexion='http://'+ruta_inicial+'/formatos/'+nombre_formato+'/previo_mostrar_'+nombre_formato+'.php?llave='+nodo_papa+'&padre='+arreglo_llave[2]+'&formato_padre='+arreglo_llave[0]+"&idformato="+arreglo[0]+"&iddoc="+arreglo[3]+"&enlace_adicionar_formato=1";    
    }
    else{
      var arreglo=nodo.split("-");    
      if(nodo_papa==0)
        nombre_formato=arreglo[1].substr(5);
      else{
        var arreglo_llave=nodo_papa.split("-");
        nombre_formato=arreglo_llave[1];
      }  
      conexion='http://'+ruta_inicial+'/formatos/'+nombre_formato+'/mostrar_'+nombre_formato+'.php?idformato='+arreglo[0]+'&iddoc='+arreglo[3];
    }
return(conexion);
}

function find_item_tree(texto,nombre){      
$(".selectedTreeRow").removeClass("selectedTreeRow"); 
var text=texto.split(" ");
$.each(text,function(item,element){
  $(".standartTreeRow:contains('"+element+"')").each(function(index,elemento){
    $(this).find("span").addClass("selectedTreeRow");
  });
  $(".standartTreeRow:contains('"+element.toUpperCase()+"')").each(function(index,elemento){
    $(this).find("span").addClass("selectedTreeRow");
  });
  $(".standartTreeRow:contains('"+element.toLowerCase()+"')").each(function(index,elemento){
    $(this).find("span").addClass("selectedTreeRow");
  });
});        
}