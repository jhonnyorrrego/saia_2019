<?php

$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = '';
while ($max_salida > 0) {
    if (is_file($ruta.'db.php')) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= '../';
    --$max_salida;
}
include_once $ruta_db_superior.'db.php';
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
    @session_start();
    $_SESSION["LOGIN".LLAVE_SAIA]="cerok";
    $_SESSION["usuario_actual"]="1";
    $usuactual=$_SESSION["LOGIN".LLAVE_SAIA];
    global $usuactual;
}
$documentos=busca_filtro_tabla_limit("iddocumento","documento","pdf IS NULL AND estado='APROBADO'","",0,4,$conn);
if($documentos['numcampos']){
    for ($i=0; $i < $documentos['numcampos']; $i++) {
        /*GENERACION DEL PDF*/
        $ch = curl_init();
        $fila = "".PROTOCOLO_CONEXION . RUTA_PDF_LOCAL."/class_impresion.php?plantilla=carta&iddoc=".$documentos[$i]['iddocumento']."&conexion_remota=1&conexio_usuario=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&LLAVE_SAIA=".LLAVE_SAIA;
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_URL,$fila); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $contenido=curl_exec($ch);    
        curl_close ($ch); 
        /*TERMINA GENERACION*/
    }
    @session_destroy();
    unset($_SESSIONS);
    redirecciona("".PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/tareas_administrativas_saia/generar_pdf.php");
}else{
    die("Termino");
}
?>
