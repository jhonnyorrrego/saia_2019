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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
$formato=busca_filtro_tabla("","formato","1=1","",$conn);
for($i=0;$i<$formato["numcampos"];$i++){
  $nombre_formato=genera_formato_nombre($formato[$i]["nombre_tabla"]);
  $texto='CREATE OR REPLACE TRIGGER "'..'" BEFORE INSERT OR UPDATE ON BUSQUEDA FOR EACH ROW BEGIN
    IF INSERTING AND :NEW.IDBUSQUEDA IS NULL THEN
    SELECT BUSQUEDA_SEQ.NEXTVAL INTO :NEW.IDBUSQUEDA FROM DUAL;
    END IF;
  END; 
  /
  ALTER TRIGGER "IDBUSQUEDA_TRG" ENABLE;';
}
funtion genera_formato_nombre($cadena){
}
?>