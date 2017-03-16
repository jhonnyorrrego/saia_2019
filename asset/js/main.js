$(document).ready( function() {

	$("a").hover(function(){$(this).fadeTo(300,0.5);},function(){$(this).fadeTo(300,1);});
	
	$('#collapser_mainui').click(function() {
		$("#PanelLaterialMainUI").toggle('fast');
	});
	
	$("#iFrameContainer").height($(document).height()-150);

	/* Personalizacion de Formularios */
	$("input:text").addClass("ui-corner-all").addClass("forms").addClass("ancho100");
	$("input:file").addClass("ui-corner-all").addClass("forms").addClass("ancho100");
	$("input:password").addClass("ui-corner-all").addClass("forms").addClass("ancho100");
	$("select").addClass("ui-corner-all").addClass("forms").addClass("ancho100");
	$("textarea").addClass("ui-corner-all").addClass("forms").addClass("ancho100");
	
	$("input:reset").addClass("ui-corner-all").addClass("forms");
	$("input:button").addClass("ui-corner-all").addClass("forms");
	$("input:submit").addClass("ui-corner-all").addClass("forms");
	
	


	/* Modulos colapsables */
	$('.icon-collapser').live("click",function() {
		$(this).next().toggle('fast');
    $(this).addClass('icon-collapser-close');
    $(this).removeClass('icon-collapser');
	$(this).html(' <i id="icono" class="icon-plus icon-white"></i>');
		return false;
	}).next();
  $('.icon-collapser-close').live("click",function() {
		$(this).next().toggle('fast');
    $(this).addClass('icon-collapser');
    $(this).removeClass('icon-collapser-close');
    $(this).html(' <i id="icono" class="icon-minus icon-white"></i>');       
		return false;
	}).next();
	
	$('#ModulosSaiaTab').click(function() {
		$('#menu-modulos').show('fast');
		$('#busquedaRapidaForm').hide('fast');
		return false;
	});
	
	$('#BusquedaRapidaTab').click(function() {
		$('#menu-modulos').hide('fast');
		$('#busquedaRapidaForm').show('fast');
		return false;
	});
	$('#busquedaRapidaForm').hide();

	
	/* Accordion Modulos SAIA */
	$('#menu-modulos .ac-title').click(function() {
		$('#menu-modulos .ac-title').next().hide('fast');
		$(this).next().show('fast');
		return false;
	}).next().hide();
	$('#menu-modulos .ac-title').addClass("ui-corner-all");
	$('.ac-title:first').next().show('fast');
	
	//saiaPopup("http://www.bing.com/",600,400,"Nuevo google...",0);
	//saiaConfirm("Desea eliminar el documento seleccionado?","Confirme la acción",function(value){alert(value);},50);
	//saiaAlert("Mena va a invitar a cholao y a frisby.","Preguntas importantes a mena");
	
});
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
    var height = Math.max( $(document).height(),$(body).height() );
   return(height);
}
function ancho_pantalla(){    
   var width = Math.max( datos_ventana('ancho') );    
   return(width);
}
/*
Metodo para establecer el titulo del contenedor en el MainUI

	Ejemplo: if(parent.setTitulo){parent.setTitulo("Otro titulo... Establecido desde el iframe...");}

*/
function setTitulo(titulo){$('#TituloContenedor').html(titulo); }


/*
Metodos para abrir dialogos en el MainUI

	Ejemplo: if(parent.saiaPopup){parent.saiaPopup(ancho"Otro titulo... Establecido desde el iframe...");}

*/
function saiaPopup(url,ancho,alto,titulo,modal){
	
	ancho	= (ancho==null)?300:ancho;
	alto	= (alto==null)?300:alto;
	titulo	= (titulo==null)?"":titulo;
	modal	= (modal==null)?true:false;
	
	var horizontalPadding = 15;
	var verticalPadding = 15;
	dialog = $('<iframe id="site" src="' + url + '" />').dialog({
		title: titulo, autoOpen: true,
		width: ancho, height: alto,
		modal: modal, resizable: false,
		autoResize: true,
		overlay: {opacity: 0.5,background: "black"}
	}).width(ancho-horizontalPadding).height(alto-verticalPadding);
	
	return dialog;
}

function saiaAlert(mensaje,titulo,alto,modal){
	ancho	= 350;
	alto	= (alto==null)?50:alto;
	titulo	= (titulo==null)?"":titulo;
	mensaje	= (mensaje==null)?"":mensaje;
	modal	= (modal==null)?true:false;
	
	var horizontalPadding = 15;
	var verticalPadding = 15;
	dialog = $('<div class="saia-alert-dialog" aling="justify"><p>'+mensaje+'</p></div>').dialog({
		title: titulo, autoOpen: true,
		width: ancho, height: alto,
		modal: modal, resizable: false,
		autoResize: true,
		overlay: {opacity: 0.5,background: "black"},
		buttons: {"Aceptar": function() {$( this ).dialog("close");}}
	}).width(ancho-horizontalPadding).height(alto-verticalPadding);

	return dialog;
}

function saiaConfirm(mensaje,titulo,callback,alto,modal){
	ancho	= 350;
	alto	= (alto==null)?50:alto;
	titulo	= (titulo==null)?"":titulo;
	mensaje	= (mensaje==null)?"":mensaje;
	modal	= (modal==null)?true:false;
	var cb 	= (callback==null)?function(){}:callback;
	
	var horizontalPadding = 15;
	var verticalPadding = 15;
	dialog = $('<div class="saia-confirm-dialog" aling="justify"><p>'+mensaje+'</p></div>').dialog({
		title: titulo, autoOpen: true,
		width: ancho, height: alto,
		modal: modal, resizable: false,
		autoResize: true,
		overlay: {opacity: 0.5,background: "black"},
		buttons: {
				"Si, Confirmar": function() {
					cb(true);
					$( this ).dialog("close");
				},
				"No, Cancelar": function() {
					cb(false);
					$( this ).dialog("close");
				}
			}
	}).width(ancho-horizontalPadding).height(alto-verticalPadding);
	
	return dialog;
}


function cargando(){
   return('cargando..');
} 

//setInterval(function(){console.log($("#iFrameContainer").contents().height());},500);