<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");



$fun_cod=$_REQUEST['usuario'];
$iddoc=$_REQUEST['iddoc'];
$fecha=date('Y-m-d H:i:s');



$fun=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$fun_cod,"",$conn);


$sql="update ft_datos_solicitante set fecha_control='".$fecha."', control_interno='".$fun_cod."' where documento_iddocumento=".$iddoc;

phpmkr_query($sql);

$cadena=$fun[0]['nombres'].' '.$fun[0]['apellidos'].'<br>'.$fecha;



$datos_formato = array(
                                    "cadena" => $cadena,
                                    
                                    
                                );
echo(json_encode($datos_formato));


?>