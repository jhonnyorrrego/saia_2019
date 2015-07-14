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

<!-- load emmet code and snippets compiled for browser -->
<script src="emmet.js"></script>

<!-- load ace -->
<script src="src/ace.js"></script>
<!-- load ace emmet extension 
<script src="src/ext-emmet.js"></script> -->
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
</script>
</body>
</html>