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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");


$idft=$_REQUEST['idft'];
$estado=$_REQUEST['estado'];
$idft_ruta_distribucion=$_REQUEST['idft_ruta_distribucion'];
$retorno=array();
$retorno['exito']=1;

if($estado==1){
	$datos=busca_filtro_tabla("","ft_dependencias_ruta a,ft_ruta_distribucion b,documento c","lower(c.estado)='aprobado' AND b.documento_iddocumento=c.iddocumento AND a.ft_ruta_distribucion=b.idft_ruta_distribucion AND a.ft_ruta_distribucion<>".$idft_ruta_distribucion." AND a.estado_dependencia=1 AND a.dependencia_asignada=".$idft,"",$conn);
	if($datos['numcampos']){
		$retorno['mensaje']='La dependencia se encuentra activa actualmente en la ruta de distribucion: '.$datos[0]['nombre_ruta'];
		$retorno['exito']=0;
	}
	
}

if($retorno['exito']){
	$sql="UPDATE ft_dependencias_ruta SET estado_dependencia=$estado WHERE ft_ruta_distribucion=".$idft_ruta_distribucion." AND dependencia_asignada=$idft";
	phpmkr_query($sql);
	$retorno['mensaje']='Estado de la dependencia actualizado correctamente';
	
}




echo(json_encode($retorno));
