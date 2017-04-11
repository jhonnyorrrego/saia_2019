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
$documento=busca_filtro_tabla("","documento A","A.iddocumento=".$_REQUEST["key"],"",$conn);
if(@$_REQUEST["mostrar_formato"]==""||!$documento[0]["plantilla"]){
	$valores=array();
	foreach($_REQUEST as $nombre => $valor){
		$valores[]=$nombre."=".$valor;
	}
	redirecciona("ordenar_paginas.php?".implode("&",$valores));
}
include_once($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
$iddoc=$_REQUEST["key"];
$iddocumento=$_REQUEST["key"];
$texto='<span class="phpmaker">';
if($_REQUEST["key"]){
    $documento=  busca_filtro_tabla("", "documento", "iddocumento=".$_REQUEST["key"], "", $conn);
    if($documento){
        $formato=busca_filtro_tabla("B.nombre_tabla,B.idformato,B.nombre","formato B","'".strtolower($documento[0]["plantilla"])."'=B.nombre","",$conn);           
        if($formato["numcampos"]){
            $papas=busca_filtro_tabla("id".$formato[0]["nombre_tabla"]." AS llave",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddocumento,"id".$formato[0]["nombre_tabla"]." ASC",$conn);
            if($papas["numcampos"]){
                $iddoc=$formato[0]["idformato"]."-".$papas[0]["llave"]."-id".$formato[0]["nombre_tabla"];            
                $iddoc2=$iddoc;  
                $llave_formato=$formato[0]["idformato"]."-id".$formato[0]["nombre_tabla"]."-".$papas[0]["llave"];
            }
            else {
                $iddoc=0;
                $llave_formato=0;
            }
        }           
    }
    $_SESSION["iddoc"]=$documento[0]["iddocumento"];
    leido(usuario_actual("funcionario_codigo"),$iddocumento);
}
else {
  alerta("No se ha podido encontrar el Documento");
  //volver(1);
}
$_SESSION["iddoc"]=$iddocumento;
if(@$_REQUEST["seleccionar"]){
    $datos_seleccionar=explode("-",$_REQUEST["seleccionar"]);
    $id=busca_filtro_tabla("id".$datos_seleccionar[2],$datos_seleccionar[2],"documento_iddocumento=".$datos_seleccionar[3],"",$conn);
    $nodoinicial=$datos_seleccionar[0]."-".$datos_seleccionar[1]."-".$id[0]["id".$datos_seleccionar[2]];
}
elseif(@$_REQUEST["llave"]){
  $nodoinicial=$_REQUEST["llave"];
}
else $nodoinicial=$llave_formato;
$display_span_rigth="";
$span_left="span9";
$webkit="";
if($_SESSION["tipo_dispositivo"]=='movil'){
    $display_span_rigth=" display:none; ";
    $span_left="span12";
    $webkit="-webkit-overflow-scrolling:touch;";
}
?>
<style>
    #contenedor{margin-top:0px; width: 100%; border:0px solid; overflow:auto; <?php echo($webkit)?>} 
    #detalles{height:100%; } 
    #panel_arbol_formato{border:0px solid;}
    body{ padding-right: 0px; padding-left: 0px;}

</style>
<div class="container row-fluid" style="align:center">
    <div class="span3" style="<?php echo($display_span_rigth);?>">         
        <div id="izquierdo_saia" >          
        </div>
    </div>
    <div class="<?php echo($span_left);?> pull-right" style="margin-left:0px;">
        <div id="contenedor_saia">            
        </div>
    </div>
</div>
<?php 
echo(librerias_arboles());
echo(librerias_jquery("1.7"));
echo(librerias_principal());
echo(librerias_highslide());
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
    $llave="&idformato=".$formato[0]["idformato"]."&iddoc=".$iddocumento; 
?>
<script type="text/javascript">
llamado_pantalla("pantallas/documento/informacion_resumen_documento.php","<?php if(@$_REQUEST['click_mostrar']){echo('click_mostrar=1&');} ?>form_info=1<?php echo($llave);?>&alto_pantalla="+(alto-1),$("#izquierdo_saia"),"arbol_formato");
<?php if(!@$_REQUEST['click_mostrar']){
    ?>
    llamado_pantalla("","",$("#contenedor_saia"),'detalles');
    <?php
    
} ?>
    

hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.Expander.prototype.onAfterClose = function() {
	if (this.isClosing) {            
    var data=this.a.id;               
    window.frames.arbol_formato.click_funcion(data); 
	}
}
</script>
<?php }
else{ ?>
<script type="text/javascript">
$("#izquierdo_saia").html(<?php echo($documento[0]["descripcion"]);?>);
llamado_pantalla("pantallas/documento/listado_paginas.php","iddoc=<?php echo($iddocumento);?>",$("#contenedor_saia"));
</script>
<?php }
?>    
