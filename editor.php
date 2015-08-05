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
///echo(librerias_bootstrap());
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
  </style>
</head>
<body>
  <div id="editor"></div>
  <div class="row-fluid">
    <div class="span9">
      <h4>Commit de cambios</h4>
      <form class="form" id="form_commit">
        <div class="control-group">
          <div class="controls">
            <input type="text" id="comentario" name="comentario" class="input-xxlarge" placeholder="Escriba un comentario que sea expl&iacute;cito">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <textarea id="comentario_extendido" rows="4" name="comentario_extendido"  class="input-xxlarge" placeholder="Adicionar al comentario m&aacute;s detalles"></textarea>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <input type="hidden" name="modificado" id="modificado" value="false">
            <input type="hidden" name="info_commit" id="info_commit" value="false">
            <input type="hidden" name="archivo_actual" id="archivo_actual" value="false">
            <input type="text" name="archivo_temporal" id="archivo_temporal" value="">
            <div class="btn btn-warning" id="guardar">Guardar</div>
            <div class="btn btn-success" id="guardar_cerrar">Guardar y cerrar</div>
            <div class="btn btn-danger" id="cerrar">Cancelar</div>
          </div>
        </div>
      </form>
    </div>
    <div class="span3" id="utilidades">
      Utilidades
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
        <span id="icono_modificado"><i class="icon-eye-close"></i></span>
        <span id="icono_commit"><i class="icon-globe"></i></span>
      </div>
    </div>
  </div>
</body>
</html>
<script src="src/ace.js"></script>
<!-- load ace -->

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
    //1 para que saque la alerta del archivo que cerro de lo contrario muestra el mensaje de guardado
    parent.cerrar_tab_editor("<?php echo($_REQUEST['numero']);?>",1);
  });
  $("#editor").height($(document).height()-120);
	$("#modificado").val('false'); //inicialmente en true mientras carga el archivo
	$("#icono_modificado").html('<i class="icon-eye-close"></i>');
	$("#icono_commit").html('<i class="icon-globe"></i>');
  	editor.setTheme("ace/theme/twilight");
  	editor.session.setMode("ace/mode/php"); 
  	editor.getSession().setUseWrapMode(true);
	ace.config.loadModule('ace/ext/language_tools', function () {
    editor.setOptions({
        "enableBasicAutocompletion": true,
        "enableLiveAutoComplete": true,
        "enableSnippets": true,
        "enableEmmet": true
    });

    editor.commands.addCommand({
        name: 'save',
        bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
        exec: saveFile
    });
	  editor.resize();
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
  			$("#icono_modificado").html('<i class="icon-eye-open"></i>');
  			$("#icono_commit").html('<i class="icon-warning-sign"></i>');
      } else {
  			$('#guardar').addClass("disabled");
  			$("#guardar_cerrar").addClass("disabled");
  			$("#modificado").val('false');
  			$("#icono_modificado").html('<i class="icon-eye-close"></i>');
  			$("#icono_commit").html('<i class="icon-globe"></i>');
      }
	});

	    var snippetManager = ace.require("ace/snippets").snippetManager;
	    var config = ace.require("ace/config");

	    ace.config.loadModule("ace/snippets/php", function(m) {
	        if (m) {
	            snippetManager.files.php = m;
	            m.snippets = snippetManager.parseSnippetFile(m.snippetText);
	            m.snippets.push({
	        	    content: "$${1:variable}=buscar_filtro_tabla(${2:''},${3:''},${4:''},${5:''},${6:conn});",
	        	    name: "busca_filtro_tabla",
	        	    tabTrigger: "saia_bft"
	        	  });
	            m.snippets.push({
	        	    content: "$${1:max_salida} = 6; $${1:ruta_db_superior} = $${1:ruta} = ''; while ($${1:max_salida} > 0) {if (is_file($${1:ruta} . 'db.php')) {$${1:ruta_db_superior} = $${1:ruta};}$${1:ruta}.='../';$${1:max_salida}--;}\n\include_once($${1:ruta_db_superior} . 'db.php');",
	        	    name: "ruta_superior",
	        	    tabTrigger: "saia_ruta"
	        	  });
	            snippetManager.register(m.snippets, m.scope);
	        }
	    });
	});
	
  function saveFile(save_type) {
    var contenido = editor.getSession().getValue();
    var ruta_archivo = $('#archivo_actual').val();
    var rutaTemporal = $('#archivo_temporal').val();

    var comentario = $("#comentario").val()+" "+$("#comentario_extendido").val();
    //save_type=='gyc' es guardar y cerrar
    if(comentario===" " && save_type==='gyc'){
        notificacion_saia("Debe escribir un comentario para el commit","error","",5000);
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
                    if(save_type=="gyc"){
                      parent.cerrar_tab_editor("<?php echo($_REQUEST['numero']);?>",0);
                    }
                    $("#icono_modificado").html('<i class="icon-eye-close"></i>');
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
                    $("#icono_modificado").html('<i class="icon-eye-close"></i>');
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
