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
ini_set ( "display_errors", true );
echo (estilo_bootstrap ());
?>
<style>
#panel_detalles {
	margin-top: 0px;
	width: 100%;
	border: 0px solid;
	overflow: auto;
	<?php if (@$_SESSION["tipo_dispositivo"] == 'movil') { ?>-webkit-overflow-scrolling: touch;	<?php } ?>
}

#detalles {
	height: 100%;
}

#panel_arbol_formato {
	border: 0px solid;
}
</style>

<!--aca va el toolbar-->
<div class="container-fluid">

<div class="btn-toolbar">
		<div class="btn-group">
			<div class="btn disabled" id="save" onclick="saveFile();"><i class="icon-hdd"></i>Guardar</div>
			<div class="btn disabled" id="discard"><i class="icon-trash"></i>Descartar</div>
			<div class="btn disabled" id="restore"><i class="icon-upload"></i>Recuperar</div>
		</div>
		<div class="btn-group">
			<div class="btn"><i class="icon-search"></i>Buscar</div>			
		</div>
</div>

<div class="container row-fluid" style="align: center">
	<div class="span3">
		<div id="izquierdo_saia"></div>
	</div>
	<div class="span9 pull-right" style="margin-left: 0px;">

		<div id="contenedor_saia"></div>

		<div>
			<input type="text" name="archivo_actual" value="" readonly="true" id="archivo_actual" width="100%" /> 
			<input type="text" name="archivo_temporal" value="" readonly="true" id="archivo_temporal" width="100%" /> 
			<input type="text"
				name="modificado" id="modificado" value="" readonly="true" />
			<h4 class="file-commit-form-heading">Confirmaci&oacute;n de cambios</h4>

			<label for="resumen_commit" class="hidden"> Resumen Commit </label> <input
				id="resumen_commit" placeholder="Actualizar mostrar.php"
				name="descripcion_commit" value="" type="text"> <label
				for="descripcion_commit" class="hidden"> Descripci&oacute;n
				extendida (Opcional) </label>
			<textarea id="descripcion_commit" name="descripcion_commit"
				class="input-block input-contrast commit-message js-new-blob-commit-description"
				placeholder="A&ntilde;adir una descripci&oacute; extendida opcional..."></textarea>

		</div>

	</div>

</div>



<?php
echo (librerias_jquery ( "1.7" ));
echo (librerias_principal ());
echo (librerias_notificaciones ());
?>
<script type="text/javascript">
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
    var contents = parent.editor.editor.getSession().getValue();
    //alert(contents);

    var ruta_archivo = $("#archivo_actual").val();
    var rutaTemporal = $("#archivo_temporal").val();
    var data = {'ruta' : ruta_archivo, "rutaTemporal" : rutaTemporal}; 
    data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
      type:'POST',
      url: 'guardar_archivo.php', 
      dataType:"json", 
      data: data,
      success: function(datos){                              
        if(datos){
            if(datos["resultado"]) {
                if(datos["resultado"] == 'ok') {
        	        notificacion_saia(datos["mensaje"],"success","",3000);
                } else {
            	    notificacion_saia(datos["ruta"] + ": " + datos["mensaje"],"error","",5000);
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
</script>

