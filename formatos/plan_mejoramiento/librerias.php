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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 

function obtener_enlace_mejoramiento($iddocumento,$numero){
		return('<center><div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" titulo="Radicado No '.$numero.'" conector="iframe"> <span class="badge">'.$numero.'</span></div></center>');	
}


function mostrar_estado_plan($estado,$iddocumento){
	
	$estado=mostrar_valor_campo('estado_plan_mejoramiento',1,$iddocumento,1);
 	if($estado==''){
 		$estado='Pendiente por Aprobar';
 	}
	$cerrado=busca_filtro_tabla("estado_terminado, estado_plan_mejoramiento","ft_plan_mejoramiento a","a.documento_iddocumento=".$iddocumento,"",$conn);
	if($cerrado[0]["estado_terminado"]==1){
		$estado='Terminado';
	}
	return($estado);
}

?>