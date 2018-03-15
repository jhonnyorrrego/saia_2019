<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
if(@$_REQUEST["idcaja"]){
	$adicional="?idcaja=".@$_REQUEST["idcaja"];
}
if(@$_REQUEST["idcarpeta"]){
	$adicional="?idcarpeta=".@$_REQUEST["idcarpeta"];
}
if(@$_REQUEST["idcaja"]&&@$_REQUEST["idcarpeta"]){
	$adicional="?idcarpeta=".@$_REQUEST["idcarpeta"]."&idcaja=".$_REQUEST["idcaja"];
}

if(@$_REQUEST["defecto"]){
    //$defecto= FORMATOS_CLIENTE . $_REQUEST["defecto"]."/adicionar_".$_REQUEST["defecto"].".php";
}
else if(!$defecto){
    //$defecto= FORMATOS_CLIENTE . "radicacion_entrada/adicionar_radicacion_entrada.php";
}
?>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery-1.4.2.js"></script>
<style>
.column{float: left;}
</style>
<div id="container"> 
    <iframe src="arbol_cajas.php<?php echo $adicional; ?>" name="filtro1" id="filtro1" scrolling="no" frameborder="0" class="alto_frame column" width="20%" resizable="false">
    </iframe>
    <iframe src="<?php echo($defecto);?>" name="previsualizar" id="previsualizar" scrolling="auto" frameborder="0" class="alto_frame column" width="79%" resizable="false">
    </iframe>
</div>
<script type="text/javascript">
$("document").ready(function(){
  var alto=$(window).height()-25;
  $(".alto_frame").height(alto);
});
</script>  
