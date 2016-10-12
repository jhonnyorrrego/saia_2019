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

if(isset($_REQUEST['num_radicado'])){
	$datos=busca_filtro_tabla("funcionario_codigo,concat(nombres,' ',apellidos) as nombre_funcionario,cargo","vfuncionario_dc","estado_dc=1 AND (nombres LIKE '%".$_REQUEST['num_radicado']."%' OR apellidos LIKE '%".$_REQUEST['num_radicado']."%')","nombres,apellidos",$conn);		
	$html="<ul>";
	if($datos['numcampos']){
		for($i=0;$i<$datos['numcampos'];$i++){
			$descripcion=$datos[$i]['nombre_funcionario']." ( ".$datos[$i]['cargo']." )";
			$descripcion=ucwords(strtolower($descripcion));
			$html.="<li onclick=\"cargar_datos(".$datos[$i]['funcionario_codigo'].",'".$descripcion."')\">".$descripcion."</li>";
		}
	}else{
		$html.="<li onclick=\"cargar_datos(0)\">NO hay funcionarios con el nombre ingresado</li>";
	}
	$html.="</ul>";
	echo $html;
}





?>