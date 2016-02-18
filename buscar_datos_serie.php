<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");




$serie_padre=busca_filtro_tabla('','serie','idserie='.@$_REQUEST['idserie'],'',$conn);




	
	$x_dias_entrega = @$serie_padre[0]["dias_entrega"];
	$x_codigo = @$serie_padre[0]["codigo"];
	$x_retencion_gestion = @$serie_padre[0]["retencion_gestion"];
	$x_retencion_central = @$serie_padre[0]["retencion_central"];
	$x_conservacion = @$serie_padre[0]["conservacion"];
	$x_seleccion = @$serie_padre[0]["seleccion"];
	$x_otro = @$serie_padre[0]["otro"];
	$x_procedimiento = @$serie_padre[0]["procedimiento"];
	$x_digitalizacion = @$serie_padre[0]["digitalizacion"];
	$x_copia = @$serie_padre[0]["copia"];
	
	
	$vector=array(
		'dias_entrega'=>$x_dias_entrega,
		'codigo' => $x_codigo,
		'retencion_gestion'=>$x_retencion_gestion,
		'retencion_central'=>$x_retencion_central,		
		'conservacion'=>$x_conservacion,		
		'seleccion'=>$x_seleccion,	
		'otro'=>$x_otro,
		'procedimiento'=>$x_procedimiento,
		'digitalizacion'=>$x_digitalizacion,	
		'copia'=>$x_copia,								
	);

	echo(json_encode($vector));
?>