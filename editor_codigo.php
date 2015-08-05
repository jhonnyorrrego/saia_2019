<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
    if (is_file ( $ruta . "db.php" )) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap ());
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo (librerias_principal());
echo (librerias_notificaciones ());
?>
<style>
#panel_detalles {
    margin-top: 0px;
    width: 100%;
    border: 0px solid;
    overflow: auto;
    <?php if (@$_SESSION["tipo_dispositivo"] == 'movil') { ?>-webkit-overflow-scrolling: touch;    <?php } ?>
}
.panel{
  margin-left: 0px;
}
#detalles {
    height: 100%;
}

#panel_arbol_formato {
    border: 0px solid;
}

/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modalload {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     140%;
    width:      120%;
    background: rgba( 255, 255, 255, .6 ) 
                url('<?php echo($ruta_db_superior);?>/images/loader-ajax.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modalload {
    display: block;
}
.div_editor {
    overflow:hidden;
    position:relative;
    margin:0 auto;
    padding:5px;
    padding-top:22px;
}
.div_opciones {
    overflow:hidden;
    position:relative;
    margin:0 auto;
    /*padding:5px;
    padding-top:22px;*/
}
.lista_tab_editor {
    position:absolute;
    left:0px;
    top:0px;
    min-width:3000px;
    margin-left:0px;
    margin-top:0px;
    margin-bottom:0px;
}
.lista_tab_editor li{
  display:table-cell;
  position:relative;
  text-align:center;
  cursor:grab;
  cursor:-webkit-grab;
  color:#efefef;
  vertical-align:middle;
}
.scroller {
  text-align:center;
  cursor:pointer;
  display:none;
  padding:7px;
  padding-top:11px;
  white-space:no-wrap;
  vertical-align:middle;
  background-color:#fff;
}

.scroller-right{
  float:right;
}

.scroller-left {
  float:left;
}
.btn-append{
  height:21px;
}
input[type=text] {
  font-size:12px;
}
.nodo_archivo{
  margin-bottom:2px;
  padding:2px;
}
</style>
<div class="row-fluid" style="align: center">
  <div id="panel_izquierdo" class="span3 panel">
     <div class="div_opciones" id="contendor_opciones">
      <ul class="nav nav-tabs lista_tab_opciones" id="lista_opciones">
        <li class="tab_opciones active" id="explorador"><a class="enlace_opciones" id="enlace_explorador" href="#izquierdo_saia">Explorar</a></li>
        <li class="tab_opciones" id="nuevo"><a class="enlace_opciones" id="enlace_nuevo" href="#div_nuevo">Nuevo</a></li>
        <li class="tab_opciones" id="buscar"><a class="enlace_opciones" id="enlace_buscar" href="#div_buscar">Buscar</a></li>
        <li class="tab_opciones" id="varios"><a class="enlace_opciones" id="enlace_varios" href="#div_varios">Varios</a></li>
      </ul>
      <div class="tab-content tab_opciones">
        <div class="tab-pane active" id="izquierdo_saia" style="width: 100%"></div>
        <div class="tab-pane" id="div_nuevo">Nuevo</div>
        <div class="tab-pane" id="div_buscar">
          <div class="input-append">
            <input type="text"  name="buscar_infecciones" id="buscar_infecciones" placeholder="Cadena">
            <div class="btn btn-mini btn-primary btn-append" id="btn_buscar_infecciones">Buscar</div>
          </div>
          Buscar dentro del archivo  <input type="checkbox" id="op_buscar_infecciones" class="check_op" value="in_file"><br />
          Reemplazar dentro del archivo  <input type="checkbox" id="op_reemplazar_buscar_infecciones" class="check_op" value="reemplazar">
          <div id="div_reemplazo" style="display:none;">
            <input type="text"  name="buscar_infecciones_reemplazo" id="buscar_infecciones_reemplazo" placeholder="Reemplazar por ">
          </div>
          <div id="cargando_resultado_busqueda"></div>
          <div id="resultados_busqueda">
            
          </div>
        </div>
        <div class="tab-pane" id="div_varios">
          <div id="reproductor_video">
            <div class="input-append">
              <input type="text"  name="buscar_musica" id="buscar_musica" placeholder="M&uacute;sica a buscar">
              <div class="btn btn-mini btn-primary btn-append" id="btn_buscar_yt">Buscar</div>
            </div>
              <iframe width="100%" height="300" allowfullscreen name="player_yt" id="player_yt" src="" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>
    <!--div class="btn-toolbar">
        <div class="btn-group">
            <div class="btn btn-mini disabled" id="archivo_nuevo"><i class="icon-hdd"></i>Nuevo</div>
            <div class="btn btn-mini disabled" id="sincronizar"><i class="icon-upload"></i>Sincronizar</div>
        </div>
    </div-->
  </div>
  <div id="panel_derecho" class="span9 panel">
    <div class="scroller scroller-left"><i class="icon-chevron-left"></i></div>
    <div class="scroller scroller-right"><i class="icon-chevron-right"></i></div>
    <div class="div_editor" id="contendor_editor">
      <ul class="nav nav-tabs lista_tab_editor" id="lista_archivos">
        <li class="tab_editor" numero="1"></li>
      </ul>
      <div class="tab-content tab-editor">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
alert("1");
var alto=($(document).height()-8); 
var alto_menu=30;
var abiertos=Array();

var gitInfo;
var archivosMergeSeleccionados;

$(document).ready(function(){
  $("#panel_arbol_archivos").height(alto-alto_menu-80);
  $("#izquierdo_saia").height(alto-alto_menu-80);
  $("#arbol_archivos").height(alto-alto_menu-80);
  $("#panel_editor").height(alto-alto_menu-80);
  $("#editor").height(alto-alto_menu-32);
  $(".tab_editor").live("click",function(){
    var numero=$(this).attr("numero");
    $('.lista_tab_editor a[href=#div_tab'+numero+']').tab('show') ;
  });
  $(".tab_editor").live("dblclick",function(){
    var numero=$(this).attr("numero");
    document.getElementById("editor_"+numero).contentWindow.document.getElementById("ocultar_arbol").click();
  });
  $("#btn_buscar_yt").click(function(){
    var url_video="http://www.youtube.com/embed?listType=search&amp;list="+$("#buscar_musica").val()+"&autoplay=1&autohide=0&modestbranding=1";
    window.open(url_video,"player_yt");
  });
  $("#archivo_nuevo").click(function(){
    adicionar_tab(ruta_archivo,extension,nombre_archivo,nodeId)  
  });
  $("#btn_buscar_infecciones").click(function(){
    $("#cargando_resultado_busqueda").html("cargando...");
    var buscar_contenido=0;
    var palabra=$("#buscar_infecciones").val();
    var palabra_reemplazar='';
    var reemplazar=''
    var buscar_archivo=1;
    var dir='<?php echo("../".$ruta_db_superior);?>';
    if($("#op_buscar_infecciones:checked").val()==='in_file'){
      buscar_contenido=1;
      buscar_archivo=0; 
    }
    else{
      buscar_archivo=1;
    }
    if($("#op_buscar_reemplazar_infecciones:checked").val()==='in_file'){
      reemplazar=1;
      palabra_reemplazar=$("#buscar_infecciones_reemplazo").val();
      buscar_archivo=0;
    }
    var datos_post = "librerias=pantallas/lib/librerias_archivo.php&funcion=buscar_archivos&parametros="+dir+";"+palabra+";"+buscar_contenido+";"+buscar_archivo+";"+reemplazar+";"+palabra_reemplazar;
    $.ajax({
      type:'POST',
      url: '<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php', 
      data: datos_post,
      success: function(datos) {
        if(datos){
          var objeto=jQuery.parseJSON(datos);
          $("#resultados_busqueda").html("");
          $.each(objeto,function(i,item){
            $("#resultados_busqueda").append('<div class="well nodo_archivo" nodoid="'+item.nodeid+'" nombre_archivo="'+item.nombre_archivo+'" extension="'+item.extension+'" class="enlace_resultado_buscar_infeccion">'+item.nombre_archivo+"</div>");
          });
        }else {
          notificacion_saia("Sin respuesta","error","",3000);
        }
      },
      error:function(){
        alert("ERROR");
      }
    });
  $(".enlace_resultado_buscar_infeccion").live("click",function(){
    adicionar_tab($(this).attr("nodoid"),$(this).attr("nombre_archivo"),$(this).attr("nodoid"));
  });  
  $("#cargando_resultado_busqueda").html("");
  });  
  $(".check_op").click(function(){
   if($("#op_reemplazar_buscar_infecciones:checked").val()==='reemplazar'){
    $("#div_reemplazo").show(); 
    $("#btn_buscar_infecciones").html("Reemplazar");
   } 
   else{
     $("#div_reemplazo").hide();
     $("#buscar_infecciones_reemplazo").val("");
     $("#btn_buscar_infecciones").html("Buscar");
   }
   
  });
  /*
    $("#dialog-ok").on("click", function () {
        var seleccionados = [];

    	$('.modal-body input').each(function(){
        if($(this).prop('checked')== true)
        	//alert($(this).val());
        	seleccionados.push($(this).val());
        });
        actualizarRepositorio(seleccionados);
    });*/
    
    function llamado_pantalla(ruta,datos,destino,nombre){                
          if(datos!==''){
            ruta+="?"+datos;
          }
          if(nombre === "<?php echo(@$_REQUEST['destino_click']);?>"){      
              ruta = ruta+'&click_clase=<?php echo(@$_REQUEST['click_clase']); ?>';      
              destino.html('<div id="panel_'+nombre+'" border="1px"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
          }
              destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
    }
    llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/editor.php","",$("#contenedor_saia"),"editor");
    });

function actualizarRepositorio(seleccionados) {
    //$("#dialog2").modal("show").addClass("fade");
	if(seleccionados) {
        //var valor = $(".ui-dialog-content").html();
	    //    public function processUnMerge($lista_archivos, $comentario, &$estado_git)
	    var comentario = $("#descripcion_commit").val();
	    if(!comentario){
	    	comentario = "Recuperar archivos desde version anterior";
	    }
        var data = {'lista' : seleccionados, "comentario" : comentario};   
        data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type:'POST',
            url: 'solucionar_merge.php', 
            dataType:"json", 
            data: data,
            //beforeSend: cargando_serie(),
            success: function(datos) {
                if(datos){ 
                    if(datos["resultado"]) {
                        if(datos["resultado"] == 'ok') {
                            notificacion_saia(datos["mensaje"],"success","",3000);
                        } else {
                            notificacion_saia(datos["ruta"] + ": " + datos["mensaje"],"error","",5000);
                        }
                        gitErrorInfo = datos["gitErrorInfo"];
                        //alert(JSON.stringify(gitInfo));
                        if(gitErrorInfo) {
                            notificacion_saia("Error git: "+ gitErrorInfo, "warning","",3000);
                        }
                    } else {
                        notificacion_saia("Sin resultado en el llamado","error","",3000);
                    }
                } else {
                    notificacion_saia("Sin respuesta","error","",3000);
                }
            }
        });                            
	}
    $("#dialog_merge").removeClass("fade").modal("hide");
}
$(document).ready(function (){
  
  var hidWidth;
  var scrollBarWidths = 40;
    
  $(window).on('resize',function(e){  
      reAdjust();
  });
  
  $('.scroller-right').click(function() {
    
    $('.scroller-left').fadeIn('slow');
    $('.scroller-right').fadeOut('slow');
    
    $('.lista_tab_editor').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){
  
    });
  });
  
  $('.scroller-left').click(function() {
    $('.scroller-right').fadeIn('slow');
    $('.scroller-left').fadeOut('slow');
    
      $('.lista_tab_editor').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){
      
      });
  }); 
});  
var widthOfList = function(){
  var itemsWidth = 0;
  $('.lista_tab_editor li').each(function(){
    var itemWidth = $(this).outerWidth();
    itemsWidth+=itemWidth;
  });
  return itemsWidth;
};

var widthOfHidden = function(){
  return (($('.div_editor').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
  return $('.lista_tab_editor').position().left;
};
  
var reAdjust = function(){
  if (($('.div_editor').outerWidth()) < widthOfList()) {
    $('.scroller-right').show();
  }
  else {
    $('.scroller-right').hide();
  }
  
  if (getLeftPosi()<0) {
    $('.scroller-left').show();
  }
  else {
    $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
    $('.scroller-left').hide();
  }
}
reAdjust();

function llamado_pantalla(ruta,datos,destino,nombre){
  var alto_frame=($(document).height()-60);                
  if(datos!==''){
    ruta+="?"+datos;
  }
  if(nombre === "<?php echo(@$_REQUEST['destino_click']);?>"){      
    ruta = ruta+'&click_clase=<?php echo(@$_REQUEST['click_clase']); ?>';      
    destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0" height="'+alto_frame+'"></iframe></div>'); 
  }
  destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0" height="'+alto_frame+'"></iframe></div>'); 
}
function adicionar_tab(ruta_archivo,extension,nombre_archivo,nodeId){
  var numero=parseInt($(".tab_editor:last").attr("numero"))+1;
  $(".lista_tab_editor").append('<li class="tab_editor" numero="'+numero+'"><a class="enlace_tab" id="enlace_tab'+(numero)+'" href="#div_tab'+numero+'" nodoid="'+nodeId+'">'+(nombre_archivo+"."+extension)+'</a></li>');
  $(".tab-editor").append('<div class="tab-pane" id="div_tab'+numero+'" ></div>');
  reAdjust();
  llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/editor.php","ruta_archivo="+ruta_archivo+"&extension="+extension+"&numero="+numero,$("#div_tab"+numero),"editor_"+numero);
  $('.lista_tab_editor a[href=#div_tab'+numero+']').tab('show') ;
}

function abrir_tab_editor(nodeId){
  $('.lista_tab_editor a[nodoid="'+nodeId+'"]').tab('show') ;
}
$(".tab_opciones").click(function(){
  $('#enlace_'+$(this).attr("id")).tab('show') ;
});
function abrir_tab_opciones(opcion){
  $('.lista_tab_editor a[nodoid="'+nodeId+'"]').tab('show') ;
}
function cerrar_tab_editor(numero,notificar_cierre){
  var tabContentId = $("#enlace_tab"+numero).attr("href");
  var nodoid=$("#enlace_tab"+numero).attr("nodoid");
  $("#enlace_tab"+numero).parent().remove(); //remove li of tab
  $(tabContentId).remove(); //remove respective tab content
  var numero_abrir=($(".tab_editor:last").attr("numero"));
  abiertos.remove(nodoid,true);
  $('.lista_tab_editor a[href=#div_tab'+numero_abrir+']').tab('show') ;
  if(notificar_cierre==1){
    notificacion_saia("Archivo "+nodoid+" cerrado","error","topRight",4500);
  }
}
if (!Array.prototype.remove) {
  Array.prototype.remove = function(val, all) {
    var i, removedItems = [];
    if (all) {
      for(i = this.length; i--;){
        if (this[i] === val) removedItems.push(this.splice(i, 1));
      }
    }
    else {  //same as before...
      i = this.indexOf(val);
      if(i>-1) removedItems = this.splice(i, 1);
    }
    return removedItems;
  };
}
llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/arbol_archivos.php","alto="+(alto-alto_menu-40),$("#izquierdo_saia"),'arbol_archivos');
</script>

<div id="dialog_merge" class="modal hide" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <h3 class="modal-title">Selecci&oacute;n de archivos</h3>

            </div>
            <div class="modal-body">Seleccione los archivos que va a restaurar desde el servidor</div>
            <div class="modal-footer">
                <button type="button" id="dialog-ok" class="btn btn-default">Continuar</button>
            </div>
        </div>
    </div>
</div>
