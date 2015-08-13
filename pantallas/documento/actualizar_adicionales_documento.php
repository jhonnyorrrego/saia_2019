<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior="";
$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}   
include_once($ruta_db_superior."db.php");
$dato=explode("_",$_REQUEST["iddocumento"]);
$anexos=busca_filtro_tabla("count(*) AS anexos","anexos","documento_iddocumento=".$dato[0],"",$conn);      
$paginas=busca_filtro_tabla("count(*) AS paginas","pagina","id_documento=".$dato[0],"",$conn);
$where_comentarios='';
if(@$dato[1]!=="funcionario"){
  $where_comentarios=" AND (funcionario=".$dato[1].")";
}

$comentarios=busca_filtro_tabla("count(*) AS notas","comentario_img","documento_iddocumento=".$dato[0].$where_comentarios,"",$conn);
$where_notas='';
if(@$dato[1]!=="funcionario"){
  $where_notas=" AND (destino=".$dato[1]." OR origen=".$dato[1]." OR ver_notas<>0)";
}
$notas_transferencia=busca_filtro_tabla("count(notas) AS notas","buzon_salida","archivo_idarchivo=".$dato[0]." AND (notas!='' OR notas IS NOT NULL)".$where_notas,"",$conn);
$response->paginas=$paginas[0]["paginas"];
$response->anexos=$anexos[0]["anexos"];
$response->notas=($comentarios[0]["notas"]+$notas_transferencia[0]["notas"]);
echo stripslashes(json_encode($response));
?>