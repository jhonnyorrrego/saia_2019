<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idnoticia_index");
desencriptar_sqli('form_info');

/* ------------------------- ADICIONAR ------------------------ */

if (isset($_REQUEST['adicionar2'])) {
    
    require_once $ruta_db_superior . 'StorageUtils.php';
    require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

    $form_uuid = $_REQUEST["form_uuid"];
    
    $archivos = busca_filtro_tabla("", "anexos_tmp", "uuid = '$form_uuid'", "", $conn);
    
    for ($j = 0; $j < $archivos["numcampos"]; $j++) {
        $ruta_temporal = $ruta_db_superior . $archivos[$j]["ruta"];
        
        if (file_exists($ruta_temporal)) {
            $datos_anexo = pathinfo($ruta_temporal);
            $ruta = RUTA_NOTICIA_IMAGENES;
            $tipo_almacenamiento = new SaiaStorage("archivos");
            
            $extension = $datos_anexo["extension"];
                
            $ruta .= uniqid() . '.' . $extension;
            $ruta_anexos = array(
                "servidor" => $tipo_almacenamiento->get_ruta_servidor(),
                "ruta" => $ruta
            );
            $ruta_anexos = json_encode($ruta_anexos);

            // aqui movemos el archivo desde la ruta temporal a nuestra ruta
            if ($tipo_almacenamiento->almacenar_recurso($ruta, $ruta_temporal)) {
                $fecha = fecha_db_almacenar(date('Y-m-d'), 'Y-m-d');
                $previo = substr($_REQUEST['noticia'], 0, 200);
                $sql1 = "INSERT INTO noticia_index (noticia,previo,imagen,titulo,subtitulo,fecha) values ('" . $_REQUEST['noticia'] . "','" . $previo . "','" . $ruta_anexos . "','" . $_REQUEST['titulo'] . "','" . $_REQUEST['subtitulo'] . "'," . $fecha . ")";
                phpmkr_query($sql1) or die($sql1);
                echo "Noticia adicionada satisfactoriamente";
                
                @unlink($ruta_temporal);
                unlink("$ruta_temporal.lock");
                
                // Eliminar los pendientes de la tabla temporal
                $sql2 = "DELETE FROM anexos_tmp WHERE idanexos_tmp = " . $archivos[$j]["idanexos_tmp"];
                phpmkr_query($sql2) or die($sql2);
            } else {
                echo "No se pudo copiar la imagen $ruta_temporal";
                die();
            }
        } else {
            echo "No existe la imagen $ruta_temporal";
            die();
        }
    }
}

/* ------------------------- CHECKBOX MOSTRAR O NO ------------------------ */

if (isset($_REQUEST['mostrar'])) {
    
    $mensaje = '';
    $retorno = 0;
    
    $noticia_puntual = busca_filtro_tabla('', 'noticia_index', 'estado=1 AND mostrar=1 AND idnoticia_index=' . $_REQUEST['idnoticia_index'], '', $conn);
    
    if ($noticia_puntual['numcampos'] > 0) {
        
        $sql = "UPDATE noticia_index SET mostrar=0 WHERE idnoticia_index=" . $_REQUEST['idnoticia_index'];
        phpmkr_query($sql);
        $mensaje = "Noticia desvinculada satisfactoriamente";
    } else {
        
        $noticias = busca_filtro_tabla('', 'noticia_index', 'estado=1 AND mostrar=1', '', $conn);
        
        if ($noticias['numcampos'] >= 2) {
            $mensaje = 'No se pueden seleccionar mas de 2 noticias';
            $retorno = 2;
        } else {
            $sql = "UPDATE noticia_index SET mostrar=1 WHERE idnoticia_index=" . $_REQUEST['idnoticia_index'];
            phpmkr_query($sql);
            $mensaje = "Noticia seleccionada satisfactoriamente";
        }
    }
    
    $vector = array(
        'mensaje' => $mensaje,
        'idnoticia_index' => $_REQUEST['idnoticia_index'],
        'retorno' => $retorno
    );
    echo (json_encode($vector));
}

/* ------------------------- ACTUALIZAR TITULO PRINCIPAL ------------------------ */

if (isset($_REQUEST['actualizar_titulo'])) {
    
    $sql = "UPDATE configuracion SET valor='" . $_REQUEST['titulo'] . "' WHERE nombre='titulo_index' ";
    phpmkr_query($sql);
    echo ($_REQUEST['titulo']);
}

/* ------------------------- ACTUALIZAR SUBTITULO PRINCIPAL ------------------------ */

if (isset($_REQUEST['actualizar_subtitulo'])) {
    
    $sql = "UPDATE configuracion SET valor='" . $_REQUEST['subtitulo'] . "' WHERE nombre='subtitulo_index' ";
    phpmkr_query($sql);
    echo ($_REQUEST['subtitulo']);
}

    

?>