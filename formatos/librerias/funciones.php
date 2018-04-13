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
/*sql es el $sql que se ejecuta, $sql_export es el dato que se almacena para el export representado por un json con
el sql y las variables estos 2 campos del json deben tener el sql a ejecutar y en variables cada una de las variables
que se relacionan en el sql y nombre_formato siempre debe enviar el nombre de la tabla en la base de datos
*/
function guardar_traza($sql, $nombre_formato, $sql_export) {
    global $conn, $ruta_db_superior;
    $nombre = strtolower($nombre_formato) . "/" . DB . "_" . date("Ymd") . ".txt";
    $alm = new SaiaStorage(RUTA_EVENTO_FORMATO);
    $nombre_export = strtolower($nombre_formato) . "/export_" . DB . "_" . date("Ymd") . ".txt";

    if($alm->get_filesystem()->write($nombre, $sql)) {
        if ($sql_export) {
            if (!$alm->get_filesystem()->has($nombre_export)) {
                $arreglo_export = array();
            } else {
                $json_export = $alm->get_filesystem()->read($nombre_export);
                $arreglo_export = json_decode($json_export);
            }
            array_push($arreglo_export, $sql_export);
            $alm->get_filesystem()->write($nombre_export, json_encode($arreglo_export));
        }
    }
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