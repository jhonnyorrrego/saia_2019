<?php 
$carpeta="webservice_saia/exportar_importar_formato/exportar_importar_medio/define_remoto.php";
if(file_exists($carpeta)){
    chmod($carpeta,0777);
    echo "Permisos Agregados a la carpeta ".$carpeta;
}else{
    echo "la carpeta ".$carpeta." no existe";
}

?>

