<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
?>
<style>
    #panel_detalles{margin-top:0px; width: 100%; border:0px solid; overflow:auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>}
    #detalles{height:100%; }
    #panel_arbol_formato{border:0px solid;}

</style>
<div class="container row-fluid" style="align:center">
    <div class="span3">
        <div id="izquierdo_saia" >
        </div>
    </div>
    <div class="span9 pull-right" style="margin-left:0px;">
        <div id="contenedor_saia">
        </div>
    </div>
</div>
<?php
echo(librerias_jquery("1.7"));
?>
<script type="text/javascript">
var alto=($(document).height()-8);
function llamado_pantalla(ruta,datos,destino,nombre){
  if(datos!==''){
    ruta+="?"+datos;
  }
  if(nombre === "<?php echo($_REQUEST['destino_click']);?>"){
  	ruta = ruta+'&click_clase=<?php echo($_REQUEST['click_clase']); ?>';
  	destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>');
  }
  	destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>');
}
$(document).ready(function(){
    $("#panel_arbol_formato").height(alto);
    $("#arbol_formato").height(alto-2);
    $("#panel_detalles").height(alto);
});
</script>
<?php
if($formato["numcampos"]){
	//se valida si recibe el default_open es que requiere abrir una pantalla por defecto en el lado derecho, se debe tener en cuenta que no se deben enviar parametros o modificar para hacer la validacion
	if(@$_REQUEST["default_open"]){
		$default_open=$ruta_db_superior.$_REQUEST["default_open"]."?key=".$_REQUEST['idformato'];
	} else {
		$default_open=$ruta_db_superior. FORMATOS_SAIA . "formatoview.php?key=".$_REQUEST['idformato'];
	}
	?>
<script type="text/javascript">
llamado_pantalla("<?php echo($ruta_db_superior);?>formatos/arbol_formato.php","id=<?php echo($_REQUEST['idformato']);?>&cargar_dato_padre=1&tabla=formato&alto_pantalla="+alto,$("#izquierdo_saia"),"arbol_formato");
llamado_pantalla("<?php echo($default_open);?>","",$("#contenedor_saia"),'detalles');
</script>
<?php }
?>