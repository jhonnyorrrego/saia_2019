<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."librerias_saia.php");
if((@$_REQUEST["iddoc"] || @$_REQUEST["key"]) && @$_REQUEST["no_menu"]!=1){
	if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
$imprimir='';
if(@$_REQUEST['idanexo']){
	$idanexo=$_REQUEST['idanexo'];
	$anexo=busca_filtro_tabla("","anexos","idanexos=".$idanexo,"",$conn);
	if($anexo['numcampos']){
		$array=array("pdf","jpg","png");
		if(in_array(strtolower($anexo[0]['tipo']), $array)){
				$imprimir=$ruta_db_superior.$anexo[0]['ruta'];
		}else{
			$imprimir='<div class="alert alert-warning"><b>ATENCI&Oacute;N</b><br>No es posible visualizar la extension '.$anexo[0]['tipo'].'</div>';
		}
	}
}else{
	$imprimir='<div class="alert alert-warning"><b>ATENCI&Oacute;N</b><br>No hay ningun anexo para mostrar</div>';
}


echo(librerias_jquery('1.7'));
?>
<script>
$(document).ready(function(){
	var alto_menu=$("#menu_principal_documento").height();
	if(parseInt(alto_menu)>=0){
		var alto=($(document).height());
		$("#detalles").height((alto-alto_menu)-20);
	}
	else{
		var alto=($(document).height());
		$("#detalles").height(alto-20);
	}
});
</script>
<iframe id="detalles" width="100%" frameborder="0" name="detalles" src="<?php echo($imprimir); ?>"></iframe>