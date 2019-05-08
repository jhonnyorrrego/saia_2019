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

if (isset($_REQUEST["datosCiudad"])){
	$ubicacion = array();
	$departamento = busca_filtro_tabla("departamento_iddepartamento","municipio","idmunicipio = " . $_REQUEST["datosCiudad"],"",$conn);
	$ubicacion["departamento"] = $departamento[0]['departamento_iddepartamento'];

	$pais = busca_filtro_tabla("pais_idpais","departamento","iddepartamento = " . $departamento[0]['departamento_iddepartamento'],"",$conn);
	$ubicacion["pais"] = $pais[0]['pais_idpais'];
	echo(json_encode($ubicacion));
} else {
	$where = ' and ejecutor_idejecutor=idejecutor';
	$tabla = ',datos_ejecutor';
	$select = 'distinct(idejecutor),nombre,identificacion,direccion,titulo,telefono,cargo,email,ciudad';
	if(@$_REQUEST["tipo"]){
	$tipo=@$_REQUEST["tipo"];
	}else{
		$tipo="nombre";
	}
	if($tipo == 'codigo'){
		$select = 'distinct(idejecutor),nombre,identificacion';
	}
	$where_estado=' and estado=1';
	$busqueda=busca_filtro_tabla("".$select,"ejecutor".$tabla,"lower(".$tipo.") LIKE lower('".$_REQUEST['nombre']."%')".$where.$where_estado,"",$conn);

	if($busqueda['numcampos']){
		$html='<ul class="list-group">';
		for($i=0;$i<$busqueda["numcampos"];$i++){
			foreach ($busqueda[$i] as $key => $value) {
				if(!$busqueda[$i][$key]){
					$busqueda[$i][$key]='';
				}
			}	
			$html.="<li class='list-group-item' onclick=\"cargar_datos(".$busqueda[$i]["idejecutor"].",'".html_entity_decode($busqueda[$i]["nombre"])."','".$busqueda[$i]["identificacion"]."','".$busqueda[$i]["direccion"]."','".$busqueda[$i]["titulo"]."','".$busqueda[$i]["telefono"]."','".$busqueda[$i]["cargo"]."','".$busqueda[$i]["email"]."','".$busqueda[$i]["ciudad"]."')\">".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]))."</li>";	
				if($tipo == 'codigo'){
					$html.="<li onclick=\"cargar_datos(".$busqueda[$i]["idejecutor"].",'".html_entity_decode($busqueda[$i]["nombre"])."','".$busqueda[$i]["identificacion"]."','".$busqueda[$i]["direccion"]."','".$busqueda[$i]["codigo"]."','".$busqueda[$i]["ciudad"]."')\">".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]))."</li>";				
				}	
		}
	$html.="</ul>";
	}else{
		$html='';
	}
	echo $html;
}
?>
