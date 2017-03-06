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

if(isset($_REQUEST["campo"]) && trim($_REQUEST["dato_buscar"])!="" && $_REQUEST["opt"]==1){
 	$datos=busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","estado=1 and (nombres like '".$_REQUEST['dato_buscar']."%' OR apellidos like '".$_REQUEST['dato_buscar']."%')","nombres,apellidos",$conn);	
	$html="<ul>";
	if($datos['numcampos']){
		for($i=0;$i<2;$i++){
			$descripcion=trim($datos[$i]["nombres"])." ".trim($datos[$i]["apellidos"]);
			$html.="<li onclick=\"cargar_datos_".$_REQUEST["campo"]."(".$datos[$i]['idfuncionario'].",'".$descripcion."')\">".$descripcion."</li>";
		}
	}else{
		$html.="<li onclick=\"cargar_datos_".$_REQUEST["campo"]."(0)\">NO se encuentra el funcionario</li>";
	}
	$html.="</ul>";
	echo $html;
}

if (isset($_REQUEST['id']) && $_REQUEST['opt'] == 2) {
  $html = "---";
  $datos=busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","idfuncionario=".$_REQUEST["id"],"",$conn);
  if ($datos["numcampos"]) {
  	$html=codifica_encabezado(html_entity_decode(trim($datos[0]["nombres"])." ".trim($datos[0]["apellidos"])));
  }
  echo $html;
}

?>