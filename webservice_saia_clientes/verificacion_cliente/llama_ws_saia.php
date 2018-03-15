<?php
ini_set("display_errors",false);
include_once("radicar_plantilla_saia.php");

    //  Initiate curl
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$_REQUEST['ruta_saia']."/tareas_administrativas_saia/alerta_espacio_disco.php");
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    
    $datos_servidor=json_decode($result,true);
    
    if($datos_servidor){
        $radica_verificacion=json_decode(radicacion_verificacion($_REQUEST["idft_cliente"]));

        radicacion_item_verificacion($radica_verificacion->idftpapa,$radica_verificacion->iddoc,"bd",$datos_servidor['bd'],"base de datos");
        
        for ($i=0; $i < count($datos_servidor['disco']); $i++) {
            
            radicacion_item_verificacion($radica_verificacion->idftpapa,$radica_verificacion->iddoc,"almacenamiento_total",round($datos_servidor['disco'][$i]['espacio_total'],2),$datos_servidor['disco'][$i]['particion']);
            radicacion_item_verificacion($radica_verificacion->idftpapa,$radica_verificacion->iddoc,"almacenamiento_libre",round($datos_servidor['disco'][$i]['espacio_libre'],2),$datos_servidor['disco'][$i]['particion']);
            radicacion_item_verificacion($radica_verificacion->idftpapa,$radica_verificacion->iddoc,"almacenamiento_porcent_libre",round($datos_servidor['disco'][$i]['porcent_libre'],2),$datos_servidor['disco'][$i]['particion']);
            
        }
    }
?>