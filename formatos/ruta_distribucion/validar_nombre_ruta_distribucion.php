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

$nombre_ruta=@$_REQUEST['nombre_ruta'];
$retorno=array('existe'=>0);
if($nombre_ruta!=''){
	$existe=busca_filtro_tabla("idft_ruta_distribucion","ft_ruta_distribucion a,documento b"," lower(b.estado)='aprobado' AND a.documento_iddocumento=b.iddocumento AND lower(a.nombre_ruta)='".strtolower($nombre_ruta)."' ","",$conn);
	if($existe['numcampos']){
		$retorno['existe']=1;	
	}
}
echo(json_encode($retorno));
?>