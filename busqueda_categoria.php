<?php 
include_once("db.php");
$adicional=Null;
$defecto=false;
if(@$_REQUEST["idcategoria_formato"]){
	$adicional="?idcategoria_formato=".$_REQUEST["idcategoria_formato"];
	$formatos=busca_filtro_tabla("","formato","","",$conn);
	for($i=0;$i<$formatos["numcampos"];$i++){
		$cat=explode(",",$formatos[$i]["fk_categoria_formato"]);
		$cantidad=count($cat);
		for($j=0;$j<$cantidad;$j++){
			if($cat[$j]==$_REQUEST["idcategoria_formato"]){
				$defecto="formatos/".$formatos[$i]["nombre"]."/adicionar_".$formatos[$i]["nombre"].".php";
				break;
			}
		}
		if($defecto)break;
	}
}

if(@$_REQUEST["defecto"]){
  $defecto="formatos/".$_REQUEST["defecto"]."/adicionar_".$_REQUEST["defecto"].".php";
}
else if(!$defecto){
  $defecto="formatos/radicacion_entrada/adicionar_radicacion_entrada.php";
}
?>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<style>
.column{float: left;}
</style>
<div id="container"> 
    <iframe src="categoria_formatos.php<?php echo $adicional; ?>" name="filtro1" id="filtro1" scrolling="no" frameborder="0" class="alto_frame column" width="20%" resizable="false">
    </iframe>
    <iframe src="<?php echo($defecto);?>" name="previsualizar" id="previsualiza" scrolling="auto" frameborder="0" class="alto_frame column" width="79%" resizable="false">
    </iframe>
</div>
<script type="text/javascript">
$("document").ready(function(){
  var alto=$(window).height()-25;
  $(".alto_frame").height(alto);
});
</script>  
