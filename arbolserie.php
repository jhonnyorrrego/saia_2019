<?php		
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../		
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
include_once("formatos/librerias/header_formato.php");		
echo(librerias_jquery());
echo(librerias_arboles());
//echo(librerias_notificaciones());
?>
<html>
<body>
<head>
</head>
  <meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<script type="text/javascript" src="js/dhtmlxtree_xw.js"></script>
    <link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
			  <!--span style="font-family: Verdana; font-size: 9px;">CLASIFICACI&Oacute;N DEL DOCUMENTO<br><br></span-->
			  <span style="font-family: Verdana; font-size: 9px;">
        
        <!--a href='asignarserie_entidad.php' target='serielist'>Asignar o quitar serie/categoria</a-->
        <br><br>
			  <br />  Buscar: <input type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie_idserie').value),1)"> <img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a><a href="javascript:void(0)" onclick="buscar_nodo();"> <img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie_idserie').value))"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
                          
                          </span>
			  <div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2" width="100px" height="100px"></div>
	<script type="text/javascript">
  <!--
      var browserType;
      var result=[];
      var punteroi=0;
      var punteroj=0;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","85%",0);
			tree2.setImagePath("imgs/");
			tree2.enableTreeImages(false);
			tree2.enableIEImageFix(true);
			//tree2.setXMLAutoLoadingBehaviour("id");
			tree2.setOnClickHandler(onNodeSelect);
			tree2.setOnLoadingStart(cargando_serie);
      		tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.setXMLAutoLoading("test_dependencia_serie.php?tabla=dependencia&admin=1&carga_partes_dependencia=1&carga_partes_serie=1");
			tree2.loadXML("test_dependencia_serie.php?tabla=dependencia&admin=1&carga_partes_dependencia=1&carga_partes_serie=1");
		
			function validar_oc(nodeId){
				var datos=nodeId.split("-");
				if(datos[0]=='otras_categorias'){
					return(true);
				}else{
					return(false);
				}
			}
			function validar_ssa(nodeId){
				var datos=nodeId.split("-");
				if(datos[0]=='sin_asignar' || datos[0]=='asignada'){
					return(true);
				}else{
					return(false);
				}
			}			
			function onNodeSelect(nodeId){
				console.log(nodeId);
        		if(nodeId=='3-categoria-Otras categorias'){
                   	 parent.serielist.location = "serieadd.php?otras_categorias=1"; 
                }else if(nodeId=='series_sin_asignar'){
                        parent.serielist.location ="vacio.php";	
                }else if(validar_oc(nodeId)){
                    var datos=nodeId.split("-");
                    parent.serielist.location = "serieview.php?key=" + datos[1]; 
                }else if(validar_ssa(nodeId)){
                    var datos=nodeId.split("-");
                    	if(datos[0]=='sin_asignar'){
                    		parent.serielist.location = "serieview.php?sin_asignar=1&key=" + datos[1]; 
                    	}else{
                    		parent.serielist.location ="vacio.php";	
                    	}                      
                }else{	
        				
                    var datos=nodeId.split("-");
                    var datos2=nodeId.split("sub");
                    var dependencia_serie='';
                    if(datos[1] || datos2[1]){
                        var dato=datos[1];
                        if(datos2[1]){
                            dato=datos2[1];
            	            var datos3=dato.split("_tv");
            				var es_tvd = dato.indexOf("_tv");
            				var tvd='&tvd=1';
            	            if(es_tvd==-1){
            	            	tvd='';
            	            }                
                            
                            
                            dependencia_serie="&dependencia_serie="+datos2[0];
                        }
                        
                       parent.serielist.location = "serieview.php?key=" + datos3[0] + dependencia_serie+tvd; 
                       
                       
                    }else{    
                        var datos=nodeId.split("d");
                        var datos2=datos[1].split("_tv");
            			var es_tvd = datos[1].indexOf("_tv");
            			var tvd='&tvd=1';
                        if(es_tvd==-1){
                        	tvd='';
                        }
                        parent.serielist.location = "asignarserie_entidad.php?tipo_entidad=2&llave_entidad=" + datos2[0]+'&from_dependencia=1&dependencia_serie=' + datos2[0] + tvd;
                        //parent.serielist.location = "serieadd.php?from_dependencia=1&dependencia_serie=" + datos[1];
                        
                    }
                }  
                    //asignarserie_entidad.php
                    
                	//notificacion_saia("Esto es una dependencia","error","",2500);
      }
      function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.display = "none";
       
      /*  if(result.length>0){
        var llaves=Object.keys(result);
        /*console.log('punteroi: '+punteroi);
        console.log('punteroj: '+punteroj);
        console.log('llavei: '+llaves.length);
        console.log('llavej: '+result[llaves[punteroi]].length);
       
			if(punteroi<llaves.length){			
				
					if(punteroj<result[llaves[punteroi]].length){
			           	console.log(result[llaves[punteroi]][punteroj]);
			           	
			           	if(tree2.getOpenState(result[llaves[punteroi]][punteroj])==1){
			           		punteroj=punteroj+1;
							console.log('...-----................');
							fin_cargando_serie();
			           	}else{
			           		tree2.openItem(result[llaves[punteroi]][punteroj]);
				           	punteroj=punteroj+1;
				           	console.log('----------');
				           	fin_cargando_serie();
			           	}
			           	
					}else{
						punteroi=punteroi+1;
						punteroj=0;
						console.log('...................');
						fin_cargando_serie();		 					
					}
		           	
		        
		    }else{
		    	result=[];
		    }
	    }*/
        
        
        
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_serie")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_serie")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_serie"]');
        document.poppedLayer.style.display = "";
        
        
      }
      
      		   
      
        function buscar_nodo(){
        	
        	var delay = (function(){
			var timer = 0;
			 return function(callback, ms){
			   clearTimeout (timer);
			   timer = setTimeout(callback, ms);
			 };
			})();
			
       	$.ajax({
       		type:'POST',
       		async:false,
       		url: "buscar_test_serie.php",
       		dataType:"json",
       		data: {
       			nombre: $('#stext_serie_idserie').val(),
       			 tabla: "serie"
       		},
       		success: function(data){
           		//console.log(data.serie_base[0]);
           		result=data;
           		punteroj=0;
           		punteroi=0;
           		tree2.openItemsDynamic(data["datos"],true);
				//tree2.openItemsDynamic(data["datos"],true);
           		    		
       			/*$.each(data, function(i, item) {
console.log(typeof(item));
       				$.each(item, function(j, value) {
           				console.log(value);
       					tree2.openItem(value);
       					if(j==item.length-1){
       						tree2.selectItem(value,true,true);
       						//tree2.focusItem(value);
       					}
       				});
       			});*/
			}
		});
		

       // fin_cargando_serie();
       }
        
       
       
	--> 		
	</script>
	<script>
		$(document).ready(function(){
			$('body').attr('marginheight','15');
		});
	</script>
	</body>
</html>
