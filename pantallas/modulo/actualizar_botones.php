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
include_once($ruta_db_superior . "db.php");

if (isset($_POST['nombre_nuevo'])) {
    $Nombreicon = busca_filtro_tabla("nombre", "modulo", "idmodulo=" . $_POST['nombre_nuevo'], "", $conn);
    if ($Nombreicon['numcampos'] > 0) {
        $archivo = file($ruta_db_superior . "/css/bootstrap/saia/css/bootstrap_iconos_segundarios.css", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $clave = (array_search("background-position: -" . $_POST['coord_izquierda'] . "px -" . $_POST['coord_superior'] . "px;", $archivo)-1);
		$nombre_duplicado = array_search(".icon-".$Nombreicon[0]['nombre']." {", $archivo);
		
		if ($nombre_duplicado!==false) {
			 echo "<script>alert('El nombre (".$Nombreicon[0]['nombre'] .") ya esta asignado');</script>";
		}else{

			if ($clave>=0) {
            $archivo[$clave] = ".icon-" . $Nombreicon[0]['nombre'] . " {";
            $nuevo_archivo = fopen($ruta_db_superior . "/css/bootstrap/saia/css/bootstrap_iconos_segundarios.css", "w+b");
            foreach ($archivo as $linea) {
                fwrite($nuevo_archivo, $linea . "\n");
            }
            fclose($nuevo_archivo);
           	 echo "<script>alert('Modificacion con Exito');location.reload();</script>";
       		 } else {
 				array_push($archivo, ".icon-" . $Nombreicon[0]['nombre'] . " {", "background-position: -" . $_POST['coord_izquierda'] . "px -" . $_POST['coord_superior'] . "px;", "}");	
	            $nuevo_archivo = fopen($ruta_db_superior . "/css/bootstrap/saia/css/bootstrap_iconos_segundarios.css", "w+b");
	            foreach ($archivo as $linea) {
	                fwrite($nuevo_archivo, $linea . "\n");
	            }
	            fclose($nuevo_archivo);
	            echo "<script>alert('Nombre Creado en CSS');location.reload();</script>";
        	}
		}
    } else {
         echo "<script>alert('Nombre de Modulo No Encontrado en la DB');</script>";
    }
}

if (isset($_POST['borrar_icono'])) {
	 $Nombreicon = busca_filtro_tabla("nombre", "modulo", "idmodulo=" . $_POST['borrar_icono'], "", $conn);
	if ($Nombreicon['numcampos'] > 0) {
		$archivo = file($ruta_db_superior . "/css/bootstrap/saia/css/bootstrap_iconos_segundarios.css", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $clave = array_search(".icon-" . $Nombreicon[0]['nombre'] . " {", $archivo);

		 	unset ($archivo[$clave]);
			unset ($archivo[$clave+1]);
			unset ($archivo[$clave+2]);
            $nuevo_archivo = fopen($ruta_db_superior . "/css/bootstrap/saia/css/bootstrap_iconos_segundarios.css", "w+b");
            foreach ($archivo as $linea) {
                fwrite($nuevo_archivo, $linea . "\n");
            }
            fclose($nuevo_archivo);
           	 echo "<script>alert('Eliminacion con Exito');location.reload();</script>";
	}else{
		  echo "<script>alert('No se ha Borrado');</script>";
	}
}

?>