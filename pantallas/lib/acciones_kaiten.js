$(".kenlace_saia").live('click', function (){
  var enlace = $(this).attr('enlace');
  var titulo = $(this).attr('titulo');
  var conector = $(this).attr('conector');
  var ancho_columna ='100%';       
  var eliminar_hijos=0;
  if($(this).attr("ancho_columna")){
    ancho_columna=$(this).attr("ancho_columna")+"px";
  }
  if($(this).attr("eliminar_hijos_kaiten")){
    eliminar_hijos=$(this).attr("eliminar_hijos_kaiten");
  }
  var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo, kWidth:ancho_columna} ;
  if(typeof(parent.parent.crear_pantalla_busqueda)=="function"){
    parent.parent.crear_pantalla_busqueda(datos_pantalla,eliminar_hijos);
  }
  else if(typeof(parent.crear_pantalla_busqueda)=="function"){
    parent.crear_pantalla_busqueda(datos_pantalla,eliminar_hijos);
  }
  else if(typeof(crear_pantalla_busqueda)=="function"){   
    crear_pantalla_busqueda(datos_pantalla,eliminar_hijos);
  } 
  else{
    alert("Error en la matix");
  } 
});
function maximizar_actual_kaiten_saia(){
   $panel=obtener_panel_kaiten();
   parent.$('#contenedor_busqueda').kaiten("maximize",$panel);
   
}
function enlace_katien_saia(enlace,titulo,conector,ancho_columna){      
  var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo, kWidth:ancho_columna} ;   
  if(typeof(parent.crear_pantalla_busqueda)=="function"){
    parent.crear_pantalla_busqueda(datos_pantalla,0);
  }
  else if(typeof(crear_pantalla_busqueda)=="function"){   
    crear_pantalla_busqueda(datos_pantalla,0);
  } 
  else{
    alert("Error en la matix");
  }
}

$(".kenlace_saia_propio").live('click', function (){
  var enlace = $(this).attr('enlace');
  var titulo = $(this).attr('titulo');
  var eliminar_hijos=0;
  //$panel=obtener_panel_kaiten();
  if($(this).attr("eliminar_hijos_kaiten")){
    eliminar_hijos=$(this).attr("eliminar_hijos_kaiten");
    //Pendiente parent.$('#contenedor_busqueda').kaiten("removeChildren", $panel,0); 
  }
  window.open(enlace, "_self")
});
function obtener_panel_kaiten(){
   $id= $(".k-focus").attr("id").replace("kp","");
   $panel=$('#contenedor_busqueda').kaiten("getPanel",($id-1)); 
   return($panel);
}
function redireccion_panel_kaiten_actual(data_url,titulo){
    var $panel=obtener_panel_kaiten();
    parent.parent.$('#contenedor_busqueda').kaiten('reload',{ kConnector:'iframe', url:data_url, 'kTitle':titulo});
}
function eliminar_panel_kaiten(remover_hijos){
    $('#contenedor_busqueda').kaiten("remove", obtener_panel_kaiten());
    if(remover_hijos){
        $('#contenedor_busqueda').kaiten("removeChildren",  obtener_panel_kaiten(), 0);
    }
}
function refrescar_panel_kaiten(){
    alert('entra refresh');
    $('#contenedor_busqueda').kaiten("reload", obtener_panel_kaiten());
}
/*
 * @@actualizar_paneles_kaiten 
 * @param name
 */
function actualizar_paneles_kaiten(idregistro,componente){
  for(var i=0;i<25;i++){
    $panel=$('#contenedor_busqueda').kaiten("getPanel",i);    
    if(typeof($panel.attr("id"))=='undefined'){
      break;
    }
    else{        
     actualizar_informacion_info($panel,idregistro,componente);
    }
  }
}
function actualizar_informacion_info($panel,idregistro,componente){ 
    var consulta_busqueda=componente;
    var data="idbusqueda_componente="+consulta_busqueda+"&llave_unica="+idregistro;  
    if(consulta_busqueda!='undefined'){
      $.ajax({
        type:'GET',
        url: "busquedas/servidor_busqueda.php",
        data:data,
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            $.each(objeto.rows,function(i,item){
              $panel.find("iframe").contents().find("#resultado_pantalla_"+idregistro).html(item.info);
            });
          }
        }
      });    
    }
}
function receiveMessage(event) {
    var datos = event.data;
    actualizar_paneles_kaiten(datos.llave,datos.idbusqueda_componente);
    
    /*
                //ASI SE LLAMA DESDE OTRA PESATAÑA KAITEN
				var json={"idbusqueda_componente":220,"llave":5};
			    parent.postMessage(json,'*');       //actualiza contenedor del listado
			    parent.eliminar_panel_kaiten(0);    //cierra kaiten actual
    
    */    
}
window.addEventListener("message", receiveMessage, false);

function eliminar_info_paneles_kaiten(idregistro){
  for(var i=0;i<25;i++){
    $panel=parent.$('#contenedor_busqueda').kaiten("getPanel",i);    
    if(typeof($panel.attr("id"))=='undefined'){
      break;
    }
    else{        
      var consulta_busqueda=$panel.find("iframe").contents().find("#iddatos_componente").val();     
      if(consulta_busqueda!='undefined'){
        $panel.find("iframe").contents().find("#resultado_pantalla_"+idregistro).remove();
      }  
    }
  }  
}
