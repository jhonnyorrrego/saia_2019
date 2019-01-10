<?php 
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."define.php");


if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN"]="radicador_web";
  $_SESSION["usuario_actual"]="111222333";
  $_SESSION["conexion_remota"]=1; 
}


include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
if(@$_REQUEST['ejecutar']){
$expedientes=busca_filtro_tabla("a.idexpediente,a.estado_archivo,a.serie_idserie,".fecha_db_obtener('a.fecha_cierre','Y-m-d')." AS fecha_inicial","expediente a","a.fecha_cierre IS NOT NULL AND a.estado_archivo IN(1,2) AND a.serie_idserie IS NOT NULL","",$conn);
$exito=0;
if($expedientes['numcampos']){
    for($i=0;$i<$expedientes['numcampos'];$i++){
        $campo_dias='';
        $prox_estado_archivo=0;
        switch($expedientes[$i]['estado_archivo']){
            case 1:  //GESTION
                $campo_dias='retencion_gestion';
                $prox_estado_archivo=2;
                break;  
            case 2:  //CENTRAL
                $campo_dias='retencion_central';
                $prox_estado_archivo=3;
                break;
        } //fin switch estado_archivo
        
        $datos_serie=busca_filtro_tabla($campo_dias,"serie","idserie=".$expedientes[$i]['serie_idserie'],"",$conn);
        if($datos_serie['numcampos']){
            $exito=1;
            
            $dias_anio=365*$datos_serie[0][$campo_dias];
            
            //$fecha_habil=dias_habiles_listado($dias_anio,'Y-m-d',$expedientes[$i]['fecha_inicial']);
            $fecha_habil=calculaFecha("days",+$dias_anio,$expedientes[$i]['fecha_inicial']);
            if($fecha_habil==date('Y-m-d')){
                $sql="UPDATE expediente SET prox_estado_archivo=".$prox_estado_archivo." WHERE idexpediente=".$expedientes[$i]['idexpediente'];
                phpmkr_query($sql);
            } //fin if $fecha_habil==hoy
           
        } //fin if $datos_serie numcampos
    } //fin for expedientes
} //fin if expedientes numcampos
echo("Exito: ".$exito."\n");
} //fin if ejecutar
?>