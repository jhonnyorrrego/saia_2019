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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_html5());
echo(librerias_arboles());
echo(librerias_notificaciones()); 
?>
<div id="esperando_archivo">
	<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
</div> 
<div id="treeboxbox_tree3" class="arbol_saia"></div>
<script type="text/javascript">
var alto=<?php echo(intval($_REQUEST["alto"]));?>;
var browserType;
var tab_acciones=false;
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
tree3.setOnClickHandler(cargar_editor);
tree3.enableThreeStateCheckboxes(true);
tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/lib/test_archivos_carpetas.php?carpeta_inicial=pantallas,formatos,bpmn&extensiones_permitidas=php,js");

function cargar_editor(nodeId){	
    var ruta_archivo=tree3.getUserData(nodeId,"myurl");
    var extension=tree3.getUserData(nodeId,"myextension"); 
    if(ruta_archivo!=='' && ruta_archivo!==undefined && extension!=='' && extension!==undefined){
	    
	    var data = {'ruta' : ruta_archivo, "rand" : Math.round(Math.random()*100000)};   
	    data = $(this).serialize() + "&" + $.param(data);
	    $.ajax({
	      type:'POST',
	      url: 'procesar_archivo.php', 
	      dataType:"json", 
	      data: data,
	      beforeSend: cargando_serie(),
	      success: function(datos){                              
	        if(datos){  
		        //alert(datos);
	        	//var objData = $.parseJSON(datos);        
	          parent.$("#archivo_actual").val(ruta_archivo);
	          parent.$("#archivo_temporal").val(datos["rutaTemporal"]);
	          notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000); 
	          parent.editor.editor.session.setMode("ace/mode/"+extension);
	          //limpiar el buffer de deshacer antes de cargar el nuevo archivo     
	          parent.editor.editor.session.setValue();
	          //evitar que seleccione el texto
	          parent.editor.editor.setValue(datos["contenido"], -1);
	          parent.editor.editor.session.getUndoManager().reset();
	          //parent.editor.editor.resize();
	        	//parent.editor.editor.getSession().getUndoManager().markClean();
	          fin_cargando_serie();           	                	                                      
	      	}      	
	      }
	  	});                            
  }
  else{
  	tree3.openItem(nodeId);    
  }
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
</script> 
<?php 

?>