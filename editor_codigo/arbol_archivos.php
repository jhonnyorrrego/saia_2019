<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo (estilo_bootstrap());
echo (librerias_jquery("1.7"));
echo (librerias_html5());
echo (librerias_arboles());
echo (librerias_notificaciones());
?>

<div id="esperando_archivo">
	<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
</div>
<div id="treeboxbox_tree3" class="arbol_saia"></div>
<div id="dialog-confirm"></div>

<script type="text/javascript">
$(document).ready(function(){
var alto=<?php echo(intval($_REQUEST["alto"]));?>;
var browserType;
var tab_acciones=false;
var nodoSeleccionado;
if (document.layers) {browserType = "nn4"}
if (document.all) {browserType = "ie"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {
   browserType= "gecko"
}
tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%",(alto-65),0);
tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
tree3.enableTreeImages(false);
tree3.enableTextSigns(true);
tree3.setOnLoadingStart(cargando_serie);
tree3.setOnLoadingEnd(fin_cargando_serie);
tree3.setOnClickHandler(manejadorClick);
tree3.enableThreeStateCheckboxes(true);
tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/lib/test_archivos_carpetas.php?extensiones_permitidas=php,js,css,json");

function manejadorClick(nodeId) {
	//ignorar si selecciono el mismo nodo
	//alert(nodoSeleccionado + ":" + nodeId);
	/*if(!nodoSeleccionado) {
		nodoSeleccionado=nodeId;
	} else if(nodoSeleccionado == nodeId) {
        return;
    }*/
    //se cambio el nodo
	//nodoSeleccionado=nodeId;
    //ignorar los nodos padre (folder)
    //Los nodos padre tienen un identificador del estilo "LVL-1-UID-55863dbe2e8ac"
    var pattern = /LVL-\d+-UID-/g;
    if(!pattern.test(nodeId)) {
    	//El mensaje puede ser de cualualquier tipo, string, number, array, object
        var message=nodeId;
        var ruta_archivo=tree3.getUserData(nodeId,"myurl");
        var nombre_archivo=tree3.getUserData(nodeId,"name_url");
        var extension=tree3.getUserData(nodeId,"myextension");
        if($.inArray(nodeId,parent.abiertos)===-1){
            parent.adicionar_tab(ruta_archivo,extension,nombre_archivo,nodeId);
            parent.abiertos.push(nodeId);
          }
          else{
            notificacion_saia("Archivo "+ruta_archivo+" ya se encuentra abierto","information","topRight",3000); 
            parent.abrir_tab_editor(nodeId);
          }
        //the '*' has to do with cross-domain messaging. leave it like it is for same-domain messaging.
        window.parent.postMessage({"tipo" : "cambioArchivoSeleccionado", "nodeId" : nodeId, "nodoActual":nodoSeleccionado , "rutaArchivo" : ruta_archivo, "extension" : extension},'*');
        //cargar_editor(nodeId);
    } else {
      	tree3.openItem(nodeId);    
    } 

}

function receiveMessage(event)
{
  // Do we trust the sender of this message?  (might be
  // different from what we originally opened, for example).
  /*if (event.origin !== "http://example.org") {
    return;
  }*/

  var source = event.source.frameElement; //this is the iframe that sent the message
  var message = event.data; //this is the message
  //viene json event.data.campo
  // message.nodeId contiene la ruta original (no traducida a ../../archivo
  //alert('Llego respuesta: '+message.nodeId);
  if(message.exito == 'false') {
	  //volver a seleccionar el anterior
	  tree3.selectItem(message.nodeId,false,false);
  }
  nodoSeleccionado=message.nodeId;
  // event.source is popup
  // event.data is "hi there yourself!  the secret response is: rheeeeet!"
}
window.addEventListener("message", receiveMessage, false);

function cargando_serie() {
	  if (browserType == "gecko" )
	     document.poppedLayer =
	         eval('document.getElementById("esperando_archivo")');
	  else if (browserType == "ie")
	     document.poppedLayer =
	        eval('document.getElementById("esperando_archivo")');
	  else
	     document.poppedLayer =
	         eval('document.layers["esperando_archivo"]');
	  document.poppedLayer.style.visibility = "visible";
}

function fin_cargando_serie() {
	  if (browserType == "gecko" )
	     document.poppedLayer =
	         eval('document.getElementById("esperando_archivo")');
	  else if (browserType == "ie")
	     document.poppedLayer =
	        eval('document.getElementById("esperando_archivo")');
	  else
	     document.poppedLayer =
	        eval('document.layers["esperando_archivo"]');
	  document.poppedLayer.style.visibility = "hidden";
}
});
</script>
<?php

?>
