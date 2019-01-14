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
include_once($ruta_db_superior."db.php");
echo(librerias_notificaciones());
?>
<script>
var isOpera="";
var isFirefox="";
var isSafari ="";
var isChrome="";
var isIE="";
$(document).ready(function(){
  $(".detalle_documento_saia").live("click",function(){
  	var idformato = $(this).attr("idformato");
    $("#iframe_detalle").attr({
       'src':'<?php echo($ruta_db_superior);?>pantallas/formato/mostrar_arbol_proceso.php?idformato='+idformato+"&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]);?>&rand=<?php echo(rand());?>",
       'height': ($("#panel_body").height())
    });
  });
	
	/*$(".kenlace_saia").live("click",function(){
		window.open($(this).attr('enlace'),'_self');
	});*/
});
</script>
