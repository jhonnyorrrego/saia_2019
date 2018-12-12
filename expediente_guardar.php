<?php
include_once ("db.php");
include_once ("pantallas/expediente/librerias.php");
include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros = array(
    "iddoc",
    "expediente_actual"
);
desencriptar_sqli('form_info');

//var_dump($_REQUEST);

if (@$_REQUEST["iddoc"]) { // si estoy llenando desde la pantalla del menu intermedio del documento
	if($_REQUEST["expediente"]){
		$datos = explode(".", $_REQUEST["expediente"]);
		$_REQUEST['serie_idserie']=$datos[0];
		$expedientes = $datos[1];
	}
    if (@$_REQUEST['serie_idserie']) {
        $sqlus = "UPDATE documento SET serie=" . @$_REQUEST['serie_idserie'] . " WHERE iddocumento=" . $_REQUEST["iddoc"];
        phpmkr_query($sqlus) or die($sqlus);
    }

    //$expedientes = explode(",", $_REQUEST["expedientes"]);
    if (is_array($expedientes) && $_REQUEST["iddoc"] && @$_REQUEST["accion"] != 4) {
        if ($_REQUEST["accion"] == 3) { // mover a otro expediente
            $sql_elimina = "delete from expediente_doc where expediente_idexpediente='" . $_REQUEST["expediente_actual"] . "' and documento_iddocumento in (" . $_REQUEST["iddoc"] . ")";
            phpmkr_query($sql_elimina) or die($sql_elimina);
            $_REQUEST["accion"] = 1;
        }
        foreach ($expedientes as $fila) {
            if (!empty($fila)) {
                $documentos = explode(",", $_REQUEST["iddoc"]);
                $cant = count($documentos);
                for ($i = 0; $i < $cant; $i++) {
                    if ($_REQUEST["accion"] == 1) { // adicionar a un expediente
                        $busqueda = busca_filtro_tabla("", "expediente_doc A", "A.expediente_idexpediente=" . $fila . " AND documento_iddocumento=" . $documentos[$i], "", $conn);
                        if (!$busqueda["numcampos"]) {
                            $sql_nuevo = "insert into expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) values('$fila','" . $documentos[$i] . "'," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
                            phpmkr_query($sql_nuevo) or die($sql_nuevo);
                            // terminar_actividad_flujo($documentos[$i]);
                        }
                    } else if ($_REQUEST["accion"] == 0) { // quitar de un expediente
                        $sql_quitar = "delete from expediente_doc where expediente_idexpediente='$fila' and documento_iddocumento='" . $documentos[$i] . "'";
                        phpmkr_query($sql_quitar) or die($sql_quitar);
                    }
                }
            }
        }
        alerta("Accion realizada");
        if (@$_REQUEST["pantalla"] == "listado") {
            redirecciona("expediente_detalles.php?key=" . $_REQUEST["expediente_actual"]);
        } else {
            redirecciona("expediente_llenar.php?iddoc=" . $_REQUEST["iddoc"]);
        }
    } else if (@$_REQUEST["accion"] == 4) {
    	// Guarda en los expedientes seleccionados
        //$expedientes = $//$_REQUEST["expedientes"];
        //$expedientes = explode(",", $expedientes);
        //$expedientes = array_filter($expedientes);
        $expediente_almacenado = busca_filtro_tabla("A.expediente_idexpediente", "expediente_doc A", "A.documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
       // $expedientes_doc = extrae_campo($expediente_almacenado, "expediente_idexpediente");
		if($expediente_almacenado["numcampos"]){
			$expedientes_doc = $expediente_almacenado[0]["expediente_idexpediente"];
       		if($expedientes_doc!=$expedientes){
        	//$quitar = array_diff($expedientes_doc, $expedientes);
        	//$quitar = array_merge($quitar);
				$quitar=$expedientes_doc;
				
        	//$adicionales = array_diff($expedientes, $expedientes_doc);
        	//$adicionales = array_merge($adicionales);
				$adicionales=$expedientes;
			}
        	/*$cantidad_eliminar = count($quitar);
        	$cantidad_adicionar = count($adicionales);

	        if ($cantidad_eliminar) {
	            $expedientes_asignados = arreglo_expedientes_asignados();
	            $nuevos_quitar = array_intersect($quitar, $expedientes_asignados);
	            if(!empty($nuevos_quitar)) {
	                $sql1 = "DELETE FROM expediente_doc WHERE documento_iddocumento=" . $_REQUEST["iddoc"] . " AND expediente_idexpediente IN(" . implode(",", $nuevos_quitar) . ")";*/
	                $sql1 = "DELETE FROM expediente_doc WHERE documento_iddocumento=" . $_REQUEST["iddoc"] . " AND expediente_idexpediente = " . $quitar;
	                phpmkr_query($sql1) or die($sql1);
	            /*}
	        }
	        if ($cantidad_adicionar) {
	            for ($i = 0; $i < $cantidad_adicionar; $i++) {
	                $sql1 = "INSERT INTO expediente_doc (documento_iddocumento,expediente_idexpediente,fecha) VALUES(" . $_REQUEST["iddoc"] . "," . $adicionales[$i] . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";*/
	                $sql1 = "INSERT INTO expediente_doc (documento_iddocumento,expediente_idexpediente,fecha) VALUES(" . $_REQUEST["iddoc"] . "," . $adicionales . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
	                phpmkr_query($sql1) or die($sql1);
	            /*}
	        }*/
	    }
		else {
			$sql1 = "INSERT INTO expediente_doc (documento_iddocumento,expediente_idexpediente,fecha) VALUES(" . $_REQUEST["iddoc"] . "," . $expedientes . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
	                phpmkr_query($sql1) or die($sql1);
		}
    }
    alerta("Accion realizada");
    // terminar_actividad_flujo($_REQUEST["iddoc"]);
    if (@$_REQUEST["pantalla"] == "listado") {
        redirecciona("expediente_detalles.php?key=" . $_REQUEST["expediente_actual"]);
    } else {
        redirecciona("expediente_llenar.php?iddoc=" . $_REQUEST["iddoc"]);
    }
} else { // si estoy llenando desde el expediente
    $documentos = explode(",", $_REQUEST["docs"]);
    $idexp = $_REQUEST["idexpediente"];
    if (is_array($documentos) && $idexp) {
        foreach ($documentos as $fila) {
            if (!empty($fila)) {
                $sql_ins = "insert into expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) values('$idexp','$fila'," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
                phpmkr_query($sql_ins) or die($sql_ins);
            }
        }
        redirecciona("expediente_detalles.php?key=$idexp");
    }
}

function terminar_actividad_flujo($iddoc) {
    global $conn;
    $max_salida = 6;
    // Previene algun posible ciclo infinito limitando a 10 los ../
    $ruta_db_superior = $ruta = "";
    while ($max_salida > 0) {
        if (is_file($ruta . "db.php")) {
            $ruta_db_superior = $ruta;
            // Preserva la ruta superior encontrada
        }
        $ruta .= "../";
        $max_salida--;
    }
    include_once ($ruta_db_superior . "workflow/libreria_paso.php");

    $paso_documento = busca_filtro_tabla("", "paso_documento A", "documento_iddocumento=" . $iddoc, "idpaso_documento desc", $conn);
    if ($paso_documento["numcampos"]) {
        terminar_actividad_paso($iddoc, '', 2, $paso_documento[0]["idpaso_documento"], 7);
    }
}
?>