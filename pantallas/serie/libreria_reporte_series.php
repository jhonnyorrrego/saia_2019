<?php$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../$ruta_db_superior=$ruta="";while($max_salida>0){if(is_file($ruta."db.php")){$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada}$ruta.="../";$max_salida--;}include_once($ruta_db_superior."db.php");function codigo_serie($idserie){    global $ruta_db_superior,$conn;    $datos=busca_filtro_tabla('','serie','idserie='.$idserie,'',conn);    if($datos[0]['tipo']==1){        return $datos[0]['codigo'];    }    }function codigo_subserie($idserie){    global $ruta_db_superior,$conn;    $datos=busca_filtro_tabla('','serie','idserie='.$idserie,'',conn);    if($datos[0]['tipo']==2){        return $datos[0]['codigo'];    }}function nombre_serie($idserie){    global $ruta_db_superior,$conn;    $datos=busca_filtro_tabla('','serie','idserie='.$idserie,'',conn);    if($datos[0]['tipo']==1){        return ("<span style='color: red;'>".$datos[0]['nombre']."<span>");    }}