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


function ocultar_campo_trayectoria($idformato,$iddoc)
{global $conn;

?>  
<script>

 //("#trayecto0").click(function(){ $("#descripcion_trayecto").attr("class","")  } )
 ("#trayecto1").click(function(){ $("#descripcion_trayecto").attr("class",""); $("#descripcion_trayecto").show(); } )
</script>
<?php

}


function valor_letras($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","ft_solicitud_gastos_caja_menor","documento_iddocumento=".$iddoc,"",$conn);
//echo(cuenta_numero($consulta););

}
function guardar_traza($sql,$nombre_formato){
	global $conn,$ruta_db_superior;
	
	$nombre="../".$ruta_db_superior."evento_formato/".strtolower($nombre_formato)."/".DB."_log_formato_".date("Y_m_d").".txt";
	
	if(!@is_file($nombre)){
		crear_archivo($nombre);
	}
	if(is_file($nombre)){
		$link=fopen($nombre,"ab");
	}
	$contenido=$sql.";\n";
	fwrite($link,$contenido);
	fclose($link);
}
function guardar_traza_corregir($sql,$nombre_formato){
	global $conn,$ruta_db_superior;
	
	$ruta_evento=busca_filtro_tabla("valor","configuracion","nombre like 'ruta_evento'","",$conn);
	
	$nombre=$ruta_db_superior."../".$ruta_evento[0]['valor']."_formato/".strtolower($nombre_formato)."/".DB."_log_formato_".date("Y_m_d").".txt";
	
	if(!@is_file($nombre)){
		crear_archivo($nombre);
	}
	if(is_file($nombre)){
		$link=fopen($nombre,"ab");
	}
	$contenido=$sql.";\n";
	fwrite($link,$contenido);
	fclose($link);
}
?>