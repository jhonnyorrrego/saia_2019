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

if(isset($_REQUEST['nombre'])){
	
	$nombre=strtolower($_REQUEST['nombre']);
	
	$datos=busca_filtro_tabla("nombre","ft_activo_fijo"," lower(nombre) LIKE '%".$nombre."%' and tipo_activo=".$_REQUEST['tipo_activo']." group by nombre","",$conn);	
	
	$html="<ul>";
	if($datos['numcampos']){
		for($i=0;$i<$datos['numcampos'];$i++){
				
				$descripcion=$datos[$i]['nombre'];
				$html.="<li onclick=\"cargar_datos('".strtoupper($datos[$i]['nombre'])."','".$descripcion."')\">".$descripcion."</li>";
		}
	}else{

				$html.="<li onclick=\"cargar_datos('".strtoupper($_REQUEST['nombre'])."','".strtoupper($_REQUEST['nombre'])."')\">".strtoupper($_REQUEST['nombre'])."</li>";
	}
	$html.="</ul>";
	echo $html;
}   
?>