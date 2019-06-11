<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(librerias_html5());
echo(estilo_bootstrap());
$pantalla_busqueda=busca_filtro_tabla("","pantalla","idpantalla=".$_REQUEST["idpantalla"],"",$conn);
$busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.nombre LIKE 'pantalla_".$pantalla_busqueda[0]["nombre"]."'","",$conn);
?>
<html>
	<head>
    <link href="<?php echo($ruta_db_superior);?>pantallas/generador/css/generador_pantalla.css" rel="stylesheet">
  </head>
  <body>                                                                            
    <textarea name="editor_listar" id="editor_listar" class="editor_tiny">
      <?php  
        if($busqueda["numcampos"]){                          
          echo($busqueda[0]["info"]);
        }  
      ?>
    </textarea>
    <input type="hidden" name="campo_pantalla_busqueda" id="campo_pantalla_busqueda" value="">
  </body>
</html>
<?php
echo(librerias_tiny());
echo(estilo_bootstrap());
?>
<script type="text/javascript">
$(document).ready(function(){
  var alto=$(window).height();  
  tinymce.init({
   	selector:'.editor_tiny', 
   	language:'es',
   	height:(alto-($(".mce-toolbar-grp").height()+$(".mce-menubar").height()+220)),
   	statusbar : false,
   	browser_spellcheck : true ,
   	plugins : 'advlist autolink lists charmap print preview pagebreak table code contextmenu responsivefilemanager image link',
   	toolbar:'bold italic underline strikethrough alignleft aligncenter alignright alignjustify | cut copy paste bullist numlist outdent indent blockquote undo redo | removeformat subscript superscript code jbimages responsivefilemanager image link ',
   	external_filemanager_path:"<?php echo(PROTOCOLO_CONEXION.RUTA_PDF);?>/tinymce/filemanager/",
    filemanager_title:"Administrador Imagenes" ,
    external_plugins: { 
    		"filemanager" : "<?php echo(PROTOCOLO_CONEXION.RUTA_PDF);?>/tinymce/filemanager/plugin.min.js"
    },
    content_css : "<?php echo($ruta_db_superior);?>css/bootstrap.css",
    extended_valid_elements :"div[*]"
  });
});
function actualizar_campo_pantalla_busqueda(){
	var ocultar=tinyMCE.get('editor_listar').getContent();
	$("#campo_pantalla_busqueda").val(ocultar);
}
</script>