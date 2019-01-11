function llenar_valor(id,valor){
	$("#"+id).val(valor);
}
$(document).on('click', '#ksubmit_saia' ,function (){
	var enlace = $(this).attr('enlace');
  $.ajax({      
	  async: false,
	  url: enlace,
	  data:$("#kformulario_saia").serialize(),
	  type:"post",	  
	  dataType:"json",
	  success: function(data) {        
		 if(data.exito){
		 	 enlace=data.url;		 
		 } 
		 else {
		 	alert(data.mensaje);
      enlace='';
		 }
	  }
	});	
  if(enlace!=''){
    var titulo = $(this).attr('titulo');
    var conector = "iframe";
    var ancho_columna = $(this).attr('ancho_columna');    
    if(!ancho_columna || ancho_columna=="undefined"){
      ancho_columna="100%";
    }
    var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo , kWidth: ancho_columna} ;   
    parent.crear_pantalla_busqueda(datos_pantalla);
  }  
});
function enviar_formulario_saia(enlace_formulario,ruta_adicional,destino,redirecciona){
	var enlace='';
	var datos='';	
	$.ajax({      
	  async: false,
	  url: enlace_formulario,
	  data:$("#kformulario_saia").serialize(),
	  type:"post",	  
	  dataType:"json",
	  success: function(data) {        
		 if(data.exito){
		 	 enlace=ruta_adicional+data.url;
		 	 datos=data;				 	 
		 } 
		 else {
		 	alert(data.mensaje);
		 }
	  },
	  error: function(){
	  	alert("No existe formulario para procesar");
	  }
	});	  
	if(destino==''){
		destino='_self';
	}
	if(enlace!=''&& redirecciona){
    var datos_pantalla = { kConnector:'iframe', url:enlace, kTitle:'Reporte indicador' , kWidth: '100%'} ;   
    parent.crear_pantalla_busqueda(datos_pantalla);
		//window.open(enlace,destino);	
	}
	else{
		return(datos);
	}
		  
}
