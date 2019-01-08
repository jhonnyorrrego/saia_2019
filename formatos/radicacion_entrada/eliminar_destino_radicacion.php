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

if(@$_REQUEST["idft_destino_radicacion"]){
    $idft_destino_radicacion=@$_REQUEST['idft_destino_radicacion'];
    $nombre_destino=@$_REQUEST['nombre_destino'];
    $campo=@$_REQUEST['campo'];

    $datos_destino=busca_filtro_tabla("ft_radicacion_entrada","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
    $datos_radicacion=busca_filtro_tabla($campo.",idft_radicacion_entrada","ft_radicacion_entrada","idft_radicacion_entrada=".$datos_destino[0]['ft_radicacion_entrada'],"",$conn);
    $lista_destinos=explode(',',$datos_radicacion[0][$campo]);
    $cantidad=count($lista_destinos);
    for($i=0;$i<$cantidad;$i++){
        if($lista_destinos[$i]==$nombre_destino){
            unset($lista_destinos[$i]);
        }
    }
    $lista_destinos=array_values($lista_destinos);
    $upd="UPDATE ft_radicacion_entrada SET ".$campo."='".implode(',',$lista_destinos)."' WHERE idft_radicacion_entrada=".$datos_radicacion[0]['idft_radicacion_entrada'];
    phpmkr_query($upd);
    $del="DELETE FROM ft_destino_radicacion WHERE idft_destino_radicacion=".$idft_destino_radicacion;
    phpmkr_query($del);
    echo(1);
} //fin if
?>