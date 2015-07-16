<?php
ini_set('display_errors', '1');

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
//ini_set ( "display_errors", true );
echo (estilo_bootstrap ());

?>
<style>
#panel_detalles {
    margin-top: 0px;
    width: 100%;
    border: 0px solid;
    overflow: auto;
    <?php if (@$_SESSION["tipo_dispositivo"] == 'movil') { ?>-webkit-overflow-scrolling: touch;    <?php } ?>
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
.modal {
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
body.loading .modal {
    display: block;
}

</style>

<!--aca va el toolbar-->

<div class="btn-toolbar">
        <div class="btn-group">
            <div class="btn disabled" id="save" onclick="saveFile();"><i class="icon-hdd"></i>Guardar</div>
            <div class="btn disabled" id="discard"><i class="icon-trash"></i>Descartar</div>
            <div class="btn disabled" id="restore" onclick="restoreFile();"><i class="icon-upload"></i>Recuperar</div>
        </div>
        <div class="btn-group">
            <div class="btn"><i class="icon-search"></i>Buscar</div>            
        </div>
</div>

<div class="container row-fluid" style="align: center">
    <div class="span3">
        <div id="izquierdo_saia" style="width: 100%"></div>
    </div>
    <div class="span9 pull-right" style="margin-left: 0px;">

        <div id="contenedor_saia" style="width: 100%"></div>

        <div>
            <input type="text" name="archivo_actual" value="" readonly="true" id="archivo_actual" width="100%" /> 
            <input type="text" name="archivo_temporal" value="" readonly="true" id="archivo_temporal" /> 
            <input type="text"
                name="modificado" id="modificado" value="" readonly="true" />
            <input type="text" name="git_info" value="" readonly="true" id="git_info" /> 
            <h4 class="file-commit-form-heading">Confirmaci&oacute;n de cambios</h4>

            <!-- <label for="descripcion_commit" class="hidden"> Resumen Commit </label><input
                id="resumen_commit" placeholder="Actualizar mostrar.php"
                name="descripcion_commit" value="" type="text">-->
                <label for="descripcion_commit"> Descripci&oacute;n
                extendida </label>
            <textarea id="descripcion_commit" name="descripcion_commit"
                class="input-block input-contrast commit-message js-new-blob-commit-description"
                placeholder="A&ntilde;adir una descripci&oacute; extendida opcional..."></textarea>

        </div>

    </div>

</div>

<div class="modal"><!-- Place at bottom of page --></div>

<div id="dialog-confirm"></div>

<?php
echo (librerias_jquery ( "1.7" ));
echo (librerias_principal());
echo (librerias_notificaciones ());
echo (librerias_bootstrap());
//echo (librerias_highslide());

?>
<script src="src/ace.js"></script>

<script type="text/javascript">

var gitInfo;
var archivosMergeSeleccionados;

$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});

window.addEventListener("message", procesarMensaje, false);  

$("#dialog-ok").on("click", function () {
    var seleccionados = [];
    
	$('.modal-body input').each(function(){
    if($(this).prop('checked')== true)
    	//alert($(this).val());
    	seleccionados.push($(this).val());
    });
    actualizarRepositorio(seleccionados);
});

function actualizarRepositorio(seleccionados) {
    //$("#dialog2").modal("show").addClass("fade");
	if(seleccionados) {
        //var valor = $(".ui-dialog-content").html();
	    alert('Llamdo ajax: ' + seleccionados);
	}
    $("#dialog_merge").removeClass("fade").modal("hide");
    
}
function procesarMensaje(event) {
    //var source = event.source;
    var source = event.source.frameElement; //this is the iframe that sent the message
    var message = event.data; //this is the message
    //viene json event.data.campo
    // message.nodeId contiene la ruta original (no traducida a ../../archivo
    if(message.tipo == 'cambioArchivoSeleccionado') {
        if(hayCambios()) {
            var comentario = $("#descripcion_commit").val();

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
    return parent.editor.editor.getSession().getUndoManager().hasUndo();
}

$(document).ready(function(){

    var alto=($(document).height()-8); 

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
            $("#panel_editor").height(alto-alto_menu);
            $("#editor").height(alto-alto_menu-2);
        });
        
    llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/arbol_archivos.php","alto="+alto,$("#izquierdo_saia"),'arbol_archivos');
    llamado_pantalla("<?php echo($ruta_db_superior);?>editor_codigo/editor.php","",$("#contenedor_saia"),"editor");
});


function saveFile() {
    var contenido = editor.editor.getSession().getValue();

    var ruta_archivo = $("#archivo_actual").val();
    var rutaTemporal = $("#archivo_temporal").val();
    var comentario = $("#descripcion_commit").val();
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
                    $("#archivo_actual").val(nodeId);
                    $("#archivo_temporal").val(datos["rutaTemporal"]);
                    notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000);
                    //se crea una nueva sesion para resetear el undoManager
                    var sesion = ace.createEditSession(datos["contenido"], "ace/mode/"+extension);
                    gitInfo = datos["gitInfo"];
                    errorInfo = datos["errorInfo"];
                    //alert(JSON.stringify(gitInfo));
                    if(gitInfo) {
                        $("#git_info").val(JSON.stringify(gitInfo));
                    }
                    if(errorInfo) {
                    	alert(errorInfo);
                    	if(errorInfo.indexOf("FETCH_HEAD") >= 0) {
                            //var lista = [1,2,3,5];
                            var mensaje = '<p>Seleccione los archivos que va a restaurar desde el servidor<p>';
                            archivosMergeSeleccionados = [];
                            showMergeDialog(mensaje, datos["listaArchivos"]);
                            return false;
                    	} else {
                        	notificacion_saia("Error git: "+ errorInfo, "warning","",3000);
                    	}
                    }
                    editor.editor.setSession(sesion);
                    $('#save').addClass("disabled");
                    $('#discard').addClass("disabled");
                    $('#modificado').val('false');
                }          
            }
        });                            
    }
}

function restoreFile() {
    var ruta_archivo = $("#archivo_actual").val();
    var rutaTemporal = $("#archivo_temporal").val();
    //alert('rutaTemporal: ' + rutaTemporal)
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

function showMergeDialogJQ(mensaje, lista){

	$("#dialog_merge").dialog({
	    
	    show:'fade' , position:'center', resizable: false, modal:true, width: "400px", stack: false,
	    open: function (event, ui) {
	        if(lista) {
	            var valor = $(".ui-dialog-content").html();
	            var text = mensaje;
	            for(var i in lista) {
	                text = text + '<p><input value="' +lista[i] +'" type="checkbox"/>' + lista[i] + '<br>';
	            }
	            $('#dialog_merge').append(text);
	        }
	    },
	    beforeClose: function( event, ui ) {
	        //if(text){
	            $('#dialog_merge').empty();
	        //} 
	    },    
	    buttons: {
	    
	        Continuar: function() { 
	            $('.ui-dialog-content input').each(function(){
    	            if($(this).prop('checked')== true)
    	                //alert($(this).val());
    	            	archivosMergeSeleccionados = $(this).val();
    	            });
	            //TODO: Yo creo que hay que procesarlo manualmente
	            $(this).dialog("close"); 
	            alert( $.toJSON(archivosMergeSeleccionados) );
	        },
	        /*Cancel: function() { 
	            
	            alert("No!"); 
	            $(this).dialog("close"); 

	        }*/
	    
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

</script>

<div id="dialog_merge" class="modal hide">
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
