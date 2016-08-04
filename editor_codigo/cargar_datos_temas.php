<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

if(@$_REQUEST["valor"]){
	$datos=busca_filtro_tabla("idmodulo,nombre,etiqueta,cod_padre","modulo","etiqueta like '%".htmlentities(str_replace(" ","%",trim($_REQUEST["valor"])))."%'","",$conn);
	$no_encontrados=array();
	if($datos['numcampos']){
		$html="<ul>";
		for($i=0;$i<$datos['numcampos'];$i++){
			$html.="<li onclick=\"cargar_datos_".@$_REQUEST["campo"]."(".$datos[$i]['idmodulo'].",'".eregi_replace("[\n|\r|\n\r]", "", trim($datos[$i]['etiqueta']))."')\">".eregi_replace("[\n|\r|\n\r]", "", trim($datos[$i]['etiqueta']))."</li>";
		}
		$html.="</ul>";
	}
	echo utf8_encode($html);
}
?>
