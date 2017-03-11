<?php
echo(librerias_notificaciones());
?>
<script>
var isOpera="";
var isFirefox="";
var isSafari ="";
var isChrome="";
var isIE="";
$("document").ready(function(){
  $(".detalle_documento_saia").live("click",function(){
    $("#iframe_detalle").attr({
       'src':'<?php echo($ruta_db_superior);?>pantallas/documento/detalles_documento.php?iddoc='+$(this).attr("idregistro")+"&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]);?>&rand=<?php echo(rand());?>",
       'height': ($("#panel_body").height())
    });
  });
  $(".documento_leido").live("click",function(){
    //$(this).children("span").addClass("badge-info");
    $(this).qtip('option', 'content.text', $(this).attr("titulo").replace("sin leer","leido"));
  });
  $(".documento_prioridad").live("click",function(){
    var idregistro=$(this).attr("idregistro");
    //alert($(this).attr("prioridad")+$("#prioridad_"+idregistro).attr("prioridad"));
    if($(this).attr("prioridad")!=$("#prioridad_"+idregistro).attr("prioridad")){
      var clase=$(this).children("i").attr("class");
      var prioridad=$(this).attr("prioridad");
      $.post('<?php echo($ruta_db_superior."pantallas/documento/");?>actualizar_prioridad_documento.php',{iddocumento: idregistro,prioridad:prioridad}, function(resultado){
        if(resultado){
        	$("#prioridad_"+idregistro).removeClass();
          $("#prioridad_"+idregistro).addClass(clase);
          $("#prioridad_"+idregistro).attr("prioridad",prioridad);
        }
      });
    }
  });
  function actualizar_flujo(id){
  	var datos=$("#actualizar_info_flujodocumento_"+id).attr('idregistro').split("_");
  	var idpaso_documento=datos[0];
  	var iddoc=datos[1];
  	$.post('<?php echo($ruta_db_superior."pantallas/documento/");?>actualizar_info_flujodocumento.php',{idpaso_doc: idpaso_documento}, function(resultado){
  		$("#mostrar_informacion_"+iddoc).html(resultado);
  	});
  }
  $(".ver_indicador_documento").live("click",function(){
    var iddoc=$(this).attr('idregistro');
    var div=$(this).parent();
  	$.post('<?php echo($ruta_db_superior."pantallas/documento/");?>ver_barra_adicional_documento.php',{iddoc: iddoc}, function(resultado){
      div.children(".ver_indicador_documento").remove();
      div.prepend(resultado);
    });
  });

$(".exportar_listado_saia").click(function(){
	isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
	isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
	isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
	    // At least Safari 3+: "[object HTMLElementConstructor]"
	isChrome = !!window.chrome && !isOpera;              // Chrome 1+
	isIE = /*@cc_on!@*/false || !!document.documentMode;   // At least IE6
	if(isChrome||isIE){
		$("#barra_exp_ppal").html('<img src="<?php echo($ruta_db_superior); ?>imagenes/cargando.gif">');
		notificacion_saia('Espere un momento por favor, hasta que se habilite el enlace de descarga','success','',3500);
	}
  var docus=$("#seleccionados").val();
	if(docus){
		$.ajax({
		  async: false,
		  url: "procesa_filtro_busqueda.php",
		  data:"adicionar_consulta=1&json=1&bqsaia_a@iddocumento="+docus+"&bksaiacondicion_a@iddocumento=in&bqsaiaenlace_a@iddocumento=y&idbusqueda_componente=<?php echo $datos_busqueda[0]["idbusqueda_componente"]; ?>",
		  type:"post",
		  dataType:"json",
		  success: function(data){
				if(data.exito){
			 	 	var dato_filtro=data.filtro.replace("&idbusqueda_filtro_temp=","");
			 	 	exportar_funcion_excel(dato_filtro);
			 	}
			 	else{
			 		alert(data.mensaje);
			 	}
		  }
		});
	}
	else{
  	exportar_funcion_excel('<?php echo($_REQUEST["idbusqueda_filtro_temp"]); ?>');
 	}
});

});
function exportar_funcion_excel(idfiltro){
	var busqueda_total=$("#busqueda_total_paginas").val();
	var ruta_file="temporal_<?php echo(usuario_actual('login'));?>/reporte_<?php echo($datos_busqueda[0]["nombre"].'_'.date('Ymd').'.xls'); ?>";
	var url="exportar_saia.php?idbusqueda_componente=<?php echo $datos_busqueda[0]["idbusqueda_componente"]; ?>&page=1&exportar_saia=excel&ruta_exportar_saia="+ruta_file+"&rows="+$("#busqueda_registros").val()+"&actual_row=0&variable_busqueda="+$("#variable_busqueda").val()+"&idbusqueda_filtro_temp="+idfiltro+"&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>";
	window.open(url,"iframe_exportar_saia");
}

$(document).ready(function(){
  /*$('.boton_fecha_limite').live('click',function(){    	
        var enlace=$(this).attr('enlace');      
        var iddoc='?iddoc='+$(this).attr('iddoc');
        var idbusqueda_componente='&idbusqueda_componente='+$(this).attr('idbusqueda_componente');
        enlace+=iddoc+idbusqueda_componente;
        top.hs.htmlExpand(this, { objectType: 'iframe',width: 500, height: 250,contentId:'cuerpo_paso', 		preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});	
  });	*/
});
</script>
