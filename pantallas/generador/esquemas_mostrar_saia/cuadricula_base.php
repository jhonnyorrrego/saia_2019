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
if(@$_REQUEST["idpantalla"]){
	$pantalla=busca_filtro_tabla("A.*,A.nombre AS pantalla, A.librerias AS librerias_pantalla, A.etiqueta AS etiqueta_pantalla,B.*, B.tabla AS tabla_campo, B.nombre AS campo, B.etiqueta AS etiqueta_campo, B.orden AS orden_campo, C.*, C.nombre AS componente_nombre, C.librerias AS librerias_componente","pantalla A, pantalla_campos B, pantalla_componente C","A.idpantalla=B.pantalla_idpantalla AND B.tabla<>'' AND B.etiqueta_html=C.nombre AND A.idpantalla=".$_REQUEST["idpantalla"],"B.orden asc",$conn);
	
	if($pantalla["numcampos"]){
		$texto='<table class="table table-condensed table-bordered" border="1px" style="width:80%;border-collapse:collapse">';
		$texto.='<tr>';
		$texto.='<td colspan="2" style="text-align:center" class="encabezado">'.ucfirst(strtolower($pantalla[0]["etiqueta_pantalla"])).'</td>';
		$texto.='</tr>';
		for($i=0;$i<$pantalla["numcampos"];$i++){
			$texto.='<tr>';
			if($pantalla[$i]["campo"]!=="id".$pantalla[$i]["campo"]){
				$texto.='<td class="encabezado" width="30%">'.$pantalla[$i]["etiqueta_campo"];
				if($pantalla[$i]["obligatoriedad"]){
					//$texto.=' *';
				}
				$texto.='</td><td width="70%">{*'.$pantalla[$i]["campo"].'*}</td>';
			}
			$texto.='</tr>';
		}
		$texto.='</table>';
		echo($texto);
	}
}
?> 
