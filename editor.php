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
    body {
        overflow: hidden;
    }
    
    #editor { 
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
  </style>
</head>
<body>

<pre id="editor"></pre>

<!-- load ace -->
<script src="src/ace.js"></script>
<!-- load emmet code and snippets compiled for browser -->
<script src="emmet.js"></script>
<script src="src/ext-emmet.js"></script> 
<script>
	var editor = ace.edit("editor");
	var modificado = parent.$('#modificado');

	modificado.val('false'); //inicialmente en true mientras carga el archivo
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
	        exec: parent.saveFile
	    });
	 editor.resize();
   editor.on('input', function () {
  		if (editor.curOp && editor.curOp.command.name) {
  	  		alert('Que hace: '+editor.curOp.command.name);
  			//parent.$('#save').removeClass("disabled");
  			//parent.$('#discard').removeClass("disabled");
		} else {
  			//editor.getSession().getUndoManager().reset();
		}
		//no tiene efecto!!!
  		if (editor.getSession().getUndoManager().hasUndo()) {
  			parent.$('#save').removeClass("disabled");
  			parent.$('#discard').removeClass("disabled");
  			modificado.val('true');
        } else {
  			parent.$('#save').addClass("disabled");
  			parent.$('#discard').addClass("disabled");
  			modificado.val('false');
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
	function cargar_editor(ruta_archivo, extension) {    
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
                    $("#archivo_actual").val(ruta_archivo);
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
                    $('#save').addClass("disabled");
                    $('#discard').addClass("disabled");
                    $('#modificado').val('false');
                }          
            }
        });                            
    }
}
<?php
if($_REQUEST["ruta_archivo"] && $_REQUEST["extension"]){
  echo('cargar_editor("'.$_REQUEST["ruta_archivo"].'", "'.$_REQUEST["extension"].'");');
}
?>
</script>
</body>
</html>
