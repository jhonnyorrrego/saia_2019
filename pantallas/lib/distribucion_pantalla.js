function datos_ventana( tipo_dato){
    var widthViewport,heightViewport,xScroll,yScroll,widthTotal,heightTotal;
    if (typeof window.innerWidth != 'undefined'){
        widthViewport= window.innerWidth-17;
        heightViewport= window.innerHeight-17;
    }else if(typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth !='undefined' && document.documentElement.clientWidth != 0){
        widthViewport=document.documentElement.clientWidth;
        heightViewport=document.documentElement.clientHeight;
    }else{
        widthViewport= document.getElementsByTagName('body')[0].clientWidth;
        heightViewport=document.getElementsByTagName('body')[0].clientHeight;
    }
    widthTotal=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth,widthViewport);
    heightTotal=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight,heightViewport);
    if(tipo_dato=='alto')
      return [heightViewport,heightTotal];
    else
      return [widthViewport,widthTotal];
} 
function alto_pantalla(){
    var height = Math.max( $(document).height(),$('body').height() );
   return(height);
}
function ancho_pantalla(){    
   var width = Math.max( $(document).width(),$('body').width() );    
   return(width);
}