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
echo (librerias_principal());
echo (librerias_notificaciones ());
if(!isset($_SESSION["LOGIN".LLAVE_SAIA_EDITOR]) || !isset($_SESSION["EMAIL".LLAVE_SAIA_EDITOR])){
  abrir_url($ruta_db_superior."editor_codigo/index.php","_top");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Editor de Código SAIA</title>
  <style type="text/css" media="screen">
    #editor { 
        margin: 0;
        top: 0;
        left: 0;
        right: 0;
    }
    div#ul_completar_comentario_tema li {
        border-bottom: 1px solid;
        list-style-type: none;
    }    
  </style>
</head>
<body>
  <div id="editor"></div>
  <div class="row-fluid" id="panel_inferior_editor">
    <div class="span9">
        <div class="row-fluid">
            <h4><span id="icono_modificado"><i class="icon-thumbs-up"></i></span>Commit de cambios</h4>
        </div>
      <form class="form" id="form_commit">
        <div class="control-group">
          <div class="controls">
            <input type="hidden" name="modificado" id="modificado" value="false">
            <input type="hidden" name="info_commit" id="info_commit" value="false">
            <input type="hidden" name="archivo_actual" id="archivo_actual" value="false">
            <input type="text" name="archivo_temporal" id="archivo_temporal" value="">
            <div class="btn btn-warning" id="guardar">Guardar Temporal</div>
            <div class="btn btn-success" id="guardar_cerrar">Guardar</div>
            <div class="btn btn-danger" id="cerrar">Cerrar</div>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <input type="text" id="comentario_tema" name="comentario_tema" class="input-xlarge" placeholder="Tema relacionado con la actividad seg&uacute;n m&oacute;dulo">
            <input type="text" id="comentario" name="comentario" class="input-xlarge" placeholder="Escriba un comentario"><br>
            <div id='ul_completar_comentario_tema' class='ac_results'></div>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <textarea id="comentario_extendido" rows="4" name="comentario_extendido"  class="input-xxlarge" placeholder="Adicionar al comentario m&aacute;s detalles"></textarea>
          </div>
        </div>
      </form>
    </div>
    <div class="span3" id="utilidades">
      <div id='ayuda_editor'></div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12" id="barra_estado">
      <div class="span2">
      <h6 style="margin-top:0px;">Ruta real archivo:</h6>  
      </div>
      <div class="span7">
        <span id="ruta_real">Ruta Real</span>
      </div>
      <div class="span3">
        <span id="icono_commit"><i class="icon-globe"></i></span>  
        <span id="icono_wrap"><i class="icon-resize-small"></i></span>
      </div>
    </div>
  </div>
</body>
</html>
<script src="src/ace.js"></script>
<!-- load ace -->
<script src="src/ext-language_tools.js"></script>
<!-- load emmet code and snippets compiled for browser -->
<script src="emmet.js"></script>
<script src="src/ext-emmet.js"></script> 
<script type="text/javascript">
	var editor = ace.edit("editor");
    $("#guardar_cerrar").click(function(){
        saveFile('gyc');
    });
    $("#guardar").click(function(){
        if(!$(this).hasClass("disabled"))
            saveFile('');
    });
    $("#cerrar").click(function(){
        if($("#modificado").val()==="false"){
            parent.cerrar_tab_editor("<?php echo($_REQUEST['numero']);?>",1,"success");
        }
        else{
            //1 para que saque la alerta del archivo que cerro de lo contrario muestra el mensaje de guardado
           parent.cerrar_tab_editor("<?php echo($_REQUEST['numero']);?>",1);
        }
    });
    $("#editor").height($(document).height()-120);
    $("#modificado").val('false'); //inicialmente en true mientras carga el archivo
	$("#icono_modificado").html('<i class="icon-thumbs-up"></i>');
	parent.tab_commit_completo(<?php echo($_REQUEST['numero']);?>);
	$("#icono_commit").html('<i class="icon-globe"></i>');
	$("#icono_wrap").html('<i class="icon-resize-small"></i>');
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
	
	$("#comentario_tema").attr("autocomplete","off");
	$("#comentario_tema").keyup(function() {
		var x_valor=$(this).val();
		delay(function(){
  		$("#ul_completar_comentario_tema").load( "cargar_datos_temas.php", { valor: x_valor, campo: 'comentario_tema'});
  	},300);
	});
	function cargar_datos_comentario_tema(id,descripcion){
		$("#ul_completar_comentario_tema").empty();
		$("#comentario_tema").val(descripcion);
	}
	function eliminar_comentario_tema(id){
		$("#fila_"+id).remove();
	}
  	editor.setTheme("ace/theme/twilight");
  	editor.session.setMode("ace/mode/php"); 
  	var langTools =ace.require("ace/ext/language_tools");
  	editor.getSession().setUseWrapMode(true);
  	var snippetManager = ace.require("ace/snippets").snippetManager;
    var config = ace.require("ace/config");
    var dom = ace.require("ace/lib/dom");
    var permite_consulta=1;
    editor.setOptions({
        "enableBasicAutocompletion": true,
        "enableSnippets": true,
        "enableLiveAutocompletion": true,
        "enableEmmet": true
    });
    var PHPCompleter = {
        getCompletions: function(editor, session, pos, prefix, callback) {
            if (prefix.length >= 1) { 
                $.getJSON(
                    "<?php echo($ruta_db_superior.'editor_codigo/php_function_list.json')?>",
                    function(wordList) {
                        callback(null, wordList.filter(function(item){
                            return(item.text.indexOf(prefix)!==-1);
                        }).map(function(item) {
                            return {name: item.text, value: item.text, score: item.snippet, meta: item.type+" PHP"}
                        }));
                        
                    }
                );
            }
            else{
                callback(null, []); 
                return; 
            }
        }    
    }
    console.log(PHPCompleter);
    langTools.addCompleter(PHPCompleter);
    editor.$blockScrolling = Infinity;
    //var popup = editor.completer.popup;
    editor.commands.addCommand({
        name: 'save',
        bindKey: {win: 'Ctrl-S', mac: 'Command-S', sender: 'editor|cli'},
        exec: function(env, args, request) {saveFile('gyc');}
    });
    editor.commands.addCommand({
        name: 'saveTemp',
        bindKey: {win: 'Ctrl-Shift-S', mac: 'Command-Shift-S', sender: 'editor|cli'},
        exec: function(env, args, request) {saveFile('');}
    });
    editor.commands.addCommand({
        name: 'find',
        bindKey: {win: 'Ctrl-B', mac: 'Command-B'},
        exec: function(editor) {
        ace.config.loadModule("ace/ext/searchbox", function(e) {e.Search(editor, true)});
        },
        readOnly: true
    });
    /*editor.commands.addCommand({
        name: 'find_help',
        bindKey: {win: 'Ctrl-Shift-A', mac: 'Command-Shift-A'},
        exec: function(editor) {
            var cad_help_php=editor.getSession().doc.getTextRange(editor.selection.getRange());
            if(cad_help_php){
                cad_help_php.replace("_","-");
                $.ajax({
                  type:'POST',
                  url: 'http://php.net/manual/es/function.'+cad_help_php+'.php', 
                  dataType:"json", 
                  success: function(datos) { 
                    $("#ayuda_editor").html(datos);
                  },
                  error:function(){
                    $("#ayuda_editor").html('<div class="alert alert-danger">No soportado</div>');  
                    permite_consulta=0;
                  }
                });
            }    
        },
        readOnly: true
    });*/
    editor.commands.addCommand({
        name: "Toggle Fullscreen",
        bindKey: {win: 'Ctrl-K', mac: 'Command-K'},
        exec: function(editor) {
            parent.toggle=!parent.toggle;
            top.$("#panel_izquierdo").toggle();
            if(parent.toggle){
                top.$("#panel_derecho").removeClass("span9");
                top.$("#panel_derecho").addClass("span11");
                $("#panel_inferior_editor").hide();
                parent.$(".panel_editor").each(function(){
                    $(this).contents().find("#panel_inferior_editor").hide();
                    $(this).contents().find("#editor").css("height","+=250");
                });
            }
            else{
                top.$("#panel_derecho").removeClass("span11");
                top.$("#panel_derecho").addClass("span9");
                $("#panel_inferior_editor").show();
                parent.$(".panel_editor").each(function(){
                    $(this).contents().find("#panel_inferior_editor").show();
                    $(this).contents().find("#editor").css("height","-=250");
                });
            }
		    editor.resize()
        }
    });
	editor.resize();
	editor.focus();
	editor.getSession().setTabSize(2);
	editor.getSession().on('change', function(e) {
        alert(e);
    });
    editor.on('input', function () {
  		if (editor.curOp && editor.curOp.command.name) {
  	  		alert('Que hace: '+editor.curOp.command.name);
		  } else {
  			//editor.getSession().getUndoManager().reset();
		  }
		  //no tiene efecto!!!
  		if (editor.getSession().getUndoManager().hasUndo()){
  			$('#guardar').removeClass("disabled");
  			$("#guardar_cerrar").removeClass("disabled");
  			
  			$("#modificado").val('true');
  			parent.tab_pendiente_commit(<?php echo($_REQUEST["numero"]); ?>);
  			$("#icono_modificado").html('<i class="icon-thumbs-down"></i>');
  			$("#icono_commit").html('<i class="icon-warning-sign"></i>');
      } else {
  			$('#guardar').addClass("disabled");
  			$("#guardar_cerrar").addClass("disabled");
  			$("#modificado").val('false');
  			parent.tab_commit_completo(<?php echo($_REQUEST["numero"]); ?>);
  			$("#icono_modificado").html('<i class="icon-thumbs-up"></i>');
  			$("#icono_commit").html('<i class="icon-globe"></i>');
      }
	});
    $("#icono_wrap").live("click",function(){
        var editor_wrap=$(this).find(".icon-resize-small");
        if(editor_wrap.length){
            editor.getSession().setUseWrapMode(true);
            $(editor_wrap).removeClass("icon-resize-small");
            $(editor_wrap).addClass("icon-resize-full");
        }
        else{
            var editor_wrap=$(this).find(".icon-resize-full");
            editor.getSession().setUseWrapMode(false);
            $(editor_wrap).removeClass("icon-resize-full");
            $(editor_wrap).addClass("icon-resize-small");
        }
        editor.container.webkitRequestFullscreen();
    });
    ace.config.loadModule("ace/snippets/php", function(m) {
        if (m) {
            snippetManager.files.php = m;
            m.snippets = snippetManager.parseSnippetFile(m.snippetText);
            var texto_snippets='';
            $.ajax({
              type:'POST',
              url: '<?php echo($ruta_db_superior)?>editor_codigo/src/snippets/saia.js', 
              dataType:"json", 
              success: function(datos) { 
                if(datos.length){ 
                    for(i=0;i<datos.length;i++){
                        m.snippets.push(datos[i]);    
                    }
                    snippetManager.register(m.snippets, m.scope);
                } else {
                    notificacion_saia("Sin respuesta","error","",3000);
                }
              }
            });
        } 
    });
	function saveFile() {
	    alert('Capturado evento Ctrl-S');
	}

  function saveFile(save_type) {
    var contenido = editor.getSession().getValue();
    var ruta_archivo = $('#archivo_actual').val();
    var rutaTemporal = $('#archivo_temporal').val();

    var comentario = "";
    if($("#comentario_tema").val() && ($("#comentario").val()||$("#comentario_extendido").val())){
        comentario="["+$("#comentario_tema").val()+"]["+parent.autor+"]"+$("#comentario").val()+" "+$("#comentario_extendido").val();
    }    
    //save_type=='gyc' es guardar y cerrar
    if(comentario==="" && save_type==='gyc'){
        notificacion_saia("Debe escribir un tema y un comentario para el commit","error","",5000);
        return false;
    }
    var data = {'ruta_archivo' : ruta_archivo, "rutaTemporal" : rutaTemporal, "comentario" : comentario,  "contenido" : contenido, "gitInfo" : gitInfo, "saveType" : save_type}; 
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
                    //if(save_type=="gyc"){
                      //parent.cerrar_tab_editor("<?php echo($_REQUEST['numero']);?>",0);
                    //}
                    parent.tab_commit_completo(<?php echo($_REQUEST['numero']);?>);
                    $("#icono_modificado").html('<i class="icon-thumbs-up"></i>');
                    
                    return true;
                } else {
                    notificacion_saia(datos["ruta_archivo"] + ": " + datos["mensaje"],"error","",5000);
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

	
	function cargar_editor(ruta_archivo, extension) {    
    //var ruta_archivo=tree3.getUserData(nodeId,"myurl");
    //var extension=tree3.getUserData(nodeId,"myextension");
    if(extension == 'js') {
        extension = 'javascript';
    }
    if(ruta_archivo!=='' && ruta_archivo!==undefined && extension!=='' && extension!==undefined) {
        var data = {'ruta_archivo' : ruta_archivo, "rand" : Math.round(Math.random()*100000)};   
        data = $(this).serialize() + "&" + $.param(data);
        $.ajax({
            type:'POST',
            url: 'procesar_archivo.php', 
            dataType:"json", 
            data: data,
            //beforeSend: cargando_serie(),
            success: function(datos) {
                if(datos) {
                    $("#ruta_real").html(datos["ruta_archivo"]);
                    $("#archivo_actual").val(datos["ruta_archivo"]);
                    $("#archivo_temporal").val(datos["rutaTemporal"]);
                    notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","topRight",3000);
                    //se crea una nueva sesion para resetear el undoManager
                    
                    var sesion = ace.createEditSession(datos["contenido"], "ace/mode/"+extension);
                    gitInfo = datos["gitInfo"];
                    errorInfo = datos["errorInfo"];
                    //alert(JSON.stringify(gitInfo));
                    if(gitInfo) {
                        $("#git_info").val(JSON.stringify(gitInfo));
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
                          notificacion_saia("Error git: "+ errorInfo, "warning","topRight",3000);
                      }
                    }
                    editor.setSession(sesion);
                    $('#guardar').addClass("disabled");
                    $("#guardar_cerrar").addClass("disabled");
                    $('#modificado').val('false');
                    $("#icono_modificado").html('<i class="icon-thumbs-up"></i>');
                    parent.tab_commit_completo(<?php echo($_REQUEST['numero']);?>);
                    $("#icono_commit").html('<i class="icon-globe"></i>');
                    
                }          
            }
        });                            
    }
    else{
      notificacion_saia("Error al cargar el archivo: "+ ruta_archivo, "warning","topRight",3000);
    }
}
<?php
if($_REQUEST["ruta_archivo"] && $_REQUEST["extension"]){
  echo('cargar_editor("'.$_REQUEST["ruta_archivo"].'", "'.$_REQUEST["extension"].'");');
}
?>
</script>
