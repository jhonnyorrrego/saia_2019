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
echo(librerias_highslide());
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
</style>
<div class="row-fluid" style="align: center">
  <div class="span3 panel">
    <div class="btn-toolbar">
        <div class="btn-group">
            <div class="btn btn-mini disabled" id="save" onclick="saveTempFile();"><i class="icon-hdd"></i>Guardar</div>
            <div class="btn btn-mini disabled" id="discard"><i class="icon-trash"></i>Descartar</div>
            <div class="btn btn-mini disabled" id="restore" onclick="restoreFile();"><i class="icon-upload"></i>Recuperar</div>
        </div>
        <!--div class="form-search pull-left">
          <div class="input-append">
            <input type="text" class="span2 search-query">
            <button type="submit" class="btn btn-mini btn-buscar">Buscar</button>
          </div>
        </div-->
    </div>
    <div id="izquierdo_saia" style="width: 100%"></div>
  </div>
  <div class="span9 panel">
    <div class="scroller scroller-left"><i class="icon-chevron-left"></i></div>
    <div class="scroller scroller-right"><i class="icon-chevron-right"></i></div>
    <div class="div_editor" id="contendor_editor">
      <ul class="nav nav-tabs lista_tab_editor" id="lista_archivos">
        <li class="tab_editor" numero="1"></li>
      </ul>
      <div class="tab-content">
      </div>
    </div>
  </div>
</div>
<script src="src/ace.js"></script>
<script type="text/javascript">
var alto=($(document).height()-8); 
var abiertos=Array();

var gitInfo;
var archivosMergeSeleccionados;

$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});

window.addEventListener("message", procesarMensaje, false);  

function procesarMensaje(event) {
    //var source = event.source;
    var source = event.source.frameElement; //this is the iframe that sent the message
    var message = event.data; //this is the message
    //viene json event.data.campo
    // message.nodeId contiene la ruta original (no traducida a ../../archivo
    if(message.tipo == 'cambioArchivoSeleccionado') {
        if(hayCambios()) {
            //var comentario = $("#descripcion_commit").val();
            var comentario = $('iframe[name=editor]').contents().find('#descripcion_commit').val()
            var r = confirm("Quiere guardar los cambios hechos al documento?");
            if (r == true) {
                if(!comentario){
                    alert("Debe escribir un comentario para el commit");
                    event.source.postMessage({"exito":"false", "nodeId":message.nodoActual},
                            event.origin);
                    return false;
                }
                if(comentario.length < 20) {
                    alert("El comentario debe ser descriptivo");
                    event.source.postMessage({"exito":"false", "nodeId":message.nodoActual},
                            event.origin);
                    return false;                    
                }
                //TODO: Cambiar saveFile por saveTempFile cuando se terminen de implementar los tabs 
                //saveTempFile();
                saveFile();
            }
        }

        //message.nodeId tiene la ruta completa del archivo desde la raiz de saia
        cargar_editor(message.rutaArchivo, message.extension, message.nodeId);
        event.source.postMessage({"exito":"true", "nodeId":message.nodeId},
                event.origin);
    }
}

function hayCambios() {
    //return parent.editor.editor.getSession().getUndoManager().hasUndo();
    return false;
}

$(document).ready(function(){

    var alto=($(document).height()-8); 

    $("#dialog-ok").on("click", function () {
        var seleccionados = [];

    	$('.modal-body input').each(function(){
        if($(this).prop('checked')== true)
        	//alert($(this).val());
        	seleccionados.push($(this).val());
        });
        actualizarRepositorio(seleccionados);
    });
    
    function llamado_pantalla(ruta,datos,destino,nombre){                
          if(datos!==''){
            ruta+="?"+datos;
          }
          if(nombre === "<?php echo(@$_REQUEST['destino_click']);?>"){      
              ruta = ruta+'&click_clase=<?php echo(@$_REQUEST['click_clase']); ?>';      
              destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
          }
              destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
    }
    
    $(document).ready(function(){
            var alto_menu=30;
            $("#panel_arbol_archivos").height(alto-alto_menu);
            $("#arbol_archivos").height(alto-alto_menu-2);
            $("#panel_editor").height(alto-alto_menu-30);
            $("#editor").height(alto-alto_menu-32);
        });
        
    llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/arbol_archivos.php","alto="+alto,$("#izquierdo_saia"),'arbol_archivos');
    llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/editor.php","",$("#contenedor_saia"),"editor");
});


function saveFile() {
    var contenido = editor.editor.getSession().getValue();

    //var ruta_archivo = $("#archivo_actual").val();
    var ruta_archivo = $('iframe[name=editor]').contents().find('#archivo_actual').val();
    //var rutaTemporal = $("#archivo_temporal").val();
    var rutaTemporal = $('iframe[name=editor]').contents().find('#archivo_temporal').val();
    //var comentario = $("#descripcion_commit").val();
    var comentario = $('iframe[name=editor]').contents().find("#descripcion_commit").val();
    if(!comentario){
        alert("Debe escribir un comentario para el commit");
        return false;
    }
    var data = {'ruta' : ruta_archivo, "rutaTemporal" : rutaTemporal, "comentario" : comentario,  "contenido" : contenido, "gitInfo" : gitInfo}; 
    data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
      type:'POST',
      url: 'guardar_archivo.php', 
      dataType:"json", 
      data: data,
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

function saveTempFile() {
    var contenido = editor.editor.getSession().getValue();

    //var ruta_archivo = $("#archivo_actual").val();
    //var rutaTemporal = $("#archivo_temporal").val();
    var rutaTemporal = $('iframe[name=editor]').contents().find('#archivo_temporal').val();
    alert(rutaTemporal);
    var data = {"rutaTemporal" : rutaTemporal, "contenido" : contenido}; 
    data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
      type:'POST',
      url: 'guardar_archivo_temporal.php', 
      dataType:"json", 
      data: data,
      success: function(datos) {                              
        if(datos){ 
            if(datos["resultado"]) {
                if(datos["resultado"] == 'ok') {
                    notificacion_saia(datos["mensaje"],"success","",3000);
                } else {
                    notificacion_saia(datos["rutaTemp"] + ": " + datos["mensaje"],"error","",5000);
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

function cargar_editor(ruta_archivo, extension, nodeId) {    

    //var ruta_archivo=tree3.getUserData(nodeId,"myurl");
    //var extension=tree3.getUserData(nodeId,"myextension");
    if(extension == 'js') {
        extension = 'javascript';
    }
    if(ruta_archivo!=='' && ruta_archivo!==undefined && extension!=='' && extension!==undefined) {
        
        var data = {'ruta' : ruta_archivo, "rand" : Math.round(Math.random()*100000)};   
        data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type:'POST',
            url: 'procesar_archivo.php', 
            dataType:"json", 
            data: data,
            //beforeSend: cargando_serie(),
            success: function(datos) {
                if(datos) {
                    //$("#archivo_actual").val(nodeId);
                    $('iframe[name=editor]').contents().find('#archivo_actual').val(nodeId);
                    //$("#archivo_temporal").val(datos["rutaTemporal"]);
                    $('iframe[name=editor]').contents().find('#archivo_temporal').val(datos["rutaTemporal"]);
                    notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000);
                    //se crea una nueva sesion para resetear el undoManager
                    
                    var sesion = ace.createEditSession(datos["contenido"], "ace/mode/"+extension);
                    gitInfo = datos["gitInfo"];
                    errorInfo = datos["errorInfo"];
                    //alert(JSON.stringify(gitInfo));
                    if(gitInfo) {
                        //$("#git_info").val(JSON.stringify(gitInfo));
                        $('iframe[name=editor]').contents().find('#git_info').val(JSON.stringify(gitInfo));
                    }
                    if(errorInfo) {
                    	//alert(errorInfo);
                    	if(errorInfo.indexOf("FETCH_HEAD") >= 0) {
                            //var lista = [1,2,3,5];
                            $body.removeClass("loading");
                            var mensaje = '<p>Seleccione los archivos que va a restaurar desde el servidor<p>';
                            archivosMergeSeleccionados = [];
                            //showMergeDialog(mensaje, datos["listaArchivos"]);
                            showMergeDialog(datos["listaArchivos"]);
                            return false;
                    	} else {
                        	notificacion_saia("Error git: "+ errorInfo, "warning","",3000);
                    	}
                    }
                    editor.editor.setSession(sesion);
                    $('#save').addClass("disabled");
                    $('#discard').addClass("disabled");
                    //$('#modificado').val('false');
                    $('iframe[name=editor]').contents().find('#modificado').val('false');
                }          
            }
        });                            
    }
}

function restoreFile() {
    //var ruta_archivo = $("#archivo_actual").val();
    var ruta_archivo = $('iframe[name=editor]').contents().find('#archivo_actual').val();
    //var rutaTemporal = $("#archivo_temporal").val();
    var rutaTemporal = $('iframe[name=editor]').contents().find('#archivo_temporal').val();
    var data = {'ruta' : ruta_archivo, 'rutaTemporal' : rutaTemporal}; 
    data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
      type:'POST',
      url: 'restaurar_archivo.php', 
      dataType:"json", 
      data: data,
      success: function(datos){                              
        if(datos){
            if(datos["resultado"] == 'ok') {
                   notificacion_saia(datos["mensaje"],"success","",3000);
                editor.editor.setValue(datos["contenido"]);
            } else {
                notificacion_saia(datos["ruta"] + ": " + datos["mensaje"],"error","",5000);
            }
        } else {
            notificacion_saia("Sin respuesta","error","",3000);
        }
    }
    });

}

function showMergeDialog(lista) {
    //$("#dialog_merge").removeClass("fade").modal("hide");
    $("#dialog_merge").modal("show").addClass("fade");
    //$("#dialog_merge").modal("show");
 	if(lista) {
	    var valor = $(".ui-dialog-content").html();
	    var text = '';
	    for(var i in lista) {
	        text = text + '<p><input value="' +lista[i] +'" type="checkbox">' + lista[i] + '<br>';
	    }
	    $('#dialog_merge .modal-body').append(text);
 	}
    
}

function actualizarRepositorio(seleccionados) {
    //$("#dialog2").modal("show").addClass("fade");
	if(seleccionados) {
        //var valor = $(".ui-dialog-content").html();
	    alert('Llamado ajax: ' + seleccionados);
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
  
  $("#adicionar_tab").click(function(){
    adicionar_tab();
  });  
  
  $(".tab_editor").live("click",function(){
    var numero=$(this).attr("numero");
    $(".tab_editor").removeClass("active");
    $(".tab-pane").removeClass("active");
    $(this).addClass("active");
    $("#div_tab"+numero).addClass("active");
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
  $(".lista_tab_editor").append('<li class="tab_editor" numero="'+numero+'"><a class="enlace_tab" id="enlace_tab'+(numero)+'" href="#div_tab'+numero+'" nodoid="'+nodeId+'">'+(nombre_archivo+"."+extension)+'<span class="icon-remove cerrar_tab" id="cerrar_tab'+numero+'"></span></a></li>');
  $(".tab-content").append('<div class="tab-pane" id="div_tab'+numero+'" ></div>');
  reAdjust();
  llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/editor.php","ruta_archivo="+ruta_archivo+"&extension="+extension,$("#div_tab"+numero),"editor_"+numero);
  $('.nav-tabs a[href=#div_tab'+numero+']').tab('show') ;
}
hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.forceAjaxReload = true;
hs.outlineType = 'rounded-white';
hs.targetX = 'descriptor -350px';
hs.targetY = 'descriptor 300px';
hs.zIndexCounter = 10010;
hs.Expander.prototype.onAfterClose = function() {
  alert("AQUI"); 
  if (this.isClosing) {
    alert(this);
    console.log(this);          
    //cerrar_tab_editor("#"+$(this).attr("id"));                      
  }
}
$(".cerrar_tab").live("click",function(e){
  var enlace="guardar_editor.php"
  hs.htmlExpand(this, { objectType: 'iframe',width: 350, height: 350,contentId:'commit', preserveContent:false, src:enlace, outlineType: 'rounded-white', wrapperClassName:'highslide-wrapper drag-header'});
  e.preventDefault();
  e.stopPropagation();
});
function cerrar_tab_editor(enlace){
  var tabContentId = $(enlace).parent().attr("href");
  var nodoid=$(enlace).parent().attr("nodoid");
  $(enlace).parent().parent().remove(); //remove li of tab
  $(tabContentId).remove(); //remove respective tab content
  var numero=($(".tab_editor:last").attr("numero"));
  abiertos.remove(nodoid,true);
  //$('#enlace_tab'+numero).click();
  $('.nav-tabs a[href=#div_tab'+numero+']').tab('show') ;
}
function abrir_tab_editor(nodeId){
  $('.nav-tabs a[nodoid="'+nodeId+'"]').tab('show') ;
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
llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/arbol_archivos.php","alto="+alto,$("#izquierdo_saia"),'arbol_archivos');
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
