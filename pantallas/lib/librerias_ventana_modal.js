$(".enlace_ventana_modal").live('click',function(){
   top.$("#ventana_modal").css("margin-top",0);
   top.$("#ventana_modal").css("top",0);
   top.$("#ventana_modal").css("margin-left",0);
   top.$("#ventana_modal").css("left",0);      
   var ancho_modal=$(this).attr("ancho_ventana_modal");
   var alto_modal=$(this).attr("alto_ventana_modal");
   var titulo_modal='',idregistro='',enlace='';
   var encabezado=$(this).attr("encabezado_ventana_modal");
   if (encabezado==undefined){
      encabezado='&nbsp;';
   }
   enlace=$(this).attr("enlace_ventana_modal");
   if(ancho_modal==undefined){
    ancho_modal="99%"; 
   }
   if(alto_modal==undefined){
    alto_modal="99%";
   }
   top.$("#ventana_modal").css("width",ancho_modal);   
   top.$("#ventana_modal").css("height",alto_modal);          
   top.$("#ventana_modal >.modal-header >#encabezado_modal").html(encabezado);
   top.$("#ventana_modal >.modal-body").html('<iframe src="'+enlace+'" width="100%" height="100%" frameborder="0" scrolling="auto"></ifame>');
   top.$("#ventana_modal").modal('show');
});
function cerrar_ventana_highslide(){
    if(typeof(parent.hs)!=='undefined'){
        parent.hs.close();
    }
    else if(typeof(hs)!=='undefined'){
        hs.close();
    }
}
