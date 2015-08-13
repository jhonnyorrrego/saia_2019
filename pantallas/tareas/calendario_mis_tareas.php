<?php    
// Inicialiacin de las variables del calendario del planeador

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
$arreglo=array("exito"=>0);
$roles_funcionario=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
for($i=0;$i<$roles_funcionario['numcampos'];$i++){
	$roles[]=$roles_funcionario[$i]['iddependencia_cargo'];
}
$rol=implode(",",$roles);

$datos=busca_filtro_tabla("","tareas","fecha_tarea > ".fecha_db_obtener("'".date("Y-m-d",$_REQUEST["start"])."'","Y-m-d")." AND fecha_tarea < ".fecha_db_obtener("'".date("Y-m-d",$_REQUEST["end"])."'","Y-m-d")." AND responsable in(".$rol.")","",$conn);

if($datos["numcampos"]){
	$arreglo["exito"]=1;
	$arreglo["rows"]=array();
	for($i=0;$i<$datos["numcampos"];$i++){
		$funcionarios=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo IN(".$datos[$i]["responsable"].")","",$conn);
		if($funcionarios["numcampos"]){
			$responsables=array();
			for($j=0;$j<$funcionarios["numcampos"];$j++){
				array_push($responsables,$funcionarios[$j]["login"]);
			}
		}
		array_push($arreglo["rows"],array("id"=>$datos[$i]["idtareas"],"titulo"=>$datos[$i]["tarea"]."(".implode(",",$responsables).")","inicio"=>$datos[$i]["fecha_tarea"],"fin"=>$datos[$i]["fecha_tarea"],"url"=>"../pantallas/tareas/mostrar_tareas.php?idtareas=".$datos[0]["idtareas"],"color"=>""));
	}	
}

echo(json_encode($arreglo));
?>