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
include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
menu_principal_documento(@$_REQUEST["id"],1);


$datos=explode("-",@$_REQUEST["id"]);
$tipo=$datos[0];
$ruta="";
if($tipo=='ppal'){
    $dato=busca_filtro_tabla("","version_documento a","a.idversion_documento=".$datos[1],"",$conn);
    $ruta=$dato[0]["pdf"];
}
else if($tipo=='pdf'){
    $dato=busca_filtro_tabla("","version_documento a","a.idversion_documento=".$datos[1],"",$conn);
    $ruta=$dato[0]["pdf"];
}else if($tipo=='anexo'){
    $dato=busca_filtro_tabla("","version_anexos a","a.idversion_anexos=".$datos[1],"",$conn);
    $ruta=$dato[0]["ruta"];
}else if($tipo=='pagina'){
    $dato=busca_filtro_tabla("","version_pagina a","a.idversion_pagina=".$datos[1],"",$conn);
    $ruta=$dato[0]["ruta"];
}else if($tipo=='vista'){
    $dato=busca_filtro_tabla("","version_vista a","a.idversion_vista=".$datos[1],"",$conn);
    $ruta=$dato[0]["pdf"];
}

$ruta64 = base64_encode($ruta);
$ruta_mostrar = $ruta_db_superior . "filesystem/mostrar_binario.php?ruta=" . $ruta64;

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
<iframe id="detalles" width="100%" frameborder="0" name="detalles"
	src="<?php echo($ruta_mostrar); ?>"></iframe>
