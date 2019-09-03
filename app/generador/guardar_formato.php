<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = (object) $_REQUEST;

    $data->nombre = trim($data->nombre);
    if (empty($data->nombre)) {
        throw new Exception("nombre del formato incorrecto", 1);
    }

    if ($data->fk_categoria_formato && is_array($data->fk_categoria_formato)) {
        $data->fk_categoria_formato = implode(',', $data->fk_categoria_formato);
    }

    if ($data->banderas && is_array($data->banderas)) {
        $data->banderas = implode(',', $data->banderas);
    }

    if ($data->funcion_predeterminada && is_array($data->funcion_predeterminada)) {
        $data->funcion_predeterminada = implode(',', $data->funcion_predeterminada);
    }

    $data->mostrar_pdf = $data->mostrar_pdf ?? 0;
    $data->firma_digital = $data->firma_digital ? (int) $data->firma_digital : 0;

    $data->contador_idcontador = $data->contador_idcontador ?
        $data->contador_idcontador : crear_contador($data->nombre);

    $data->mostrar_tipodoc_pdf = $data->mostrar_tipodoc_pdf ?
        $data->mostrar_tipodoc_pdf : 0;

    /*
     * Se valida que si el tiempo que llega es menor 
     * de 3000 milisegundos se multiplica
     * el valor por 60000 ya que se esta ingresando en minutos
     */
    if ($data->tiempo_autoguardado < 3000) {
        $data->tiempo_autoguardado = $data->tiempo_autoguardado * 60000;
    }

    $data->funcionario_idfuncionario = SessionController::getValue('usuario_actual');
    $data->nombre_tabla = "ft_" . $data->nombre;
    $data->margenes = sprintf(
        "%s,%s,%s,%s",
        $data->mizq * 10,
        $data->mder * 10,
        $data->msup * 10,
        $data->minf * 10
    );

    $data->ruta_mostrar = "mostrar_{$data->nombre}.php";
    $data->ruta_buscar = "mostrar_{$data->nombre}.php";
    $data->ruta_editar = "editar_{$data->nombre}.php";
    $data->ruta_adicionar = "adicionar_{$data->nombre}.php";

    if (!is_dir($ruta_db_superior . "formatos/" . $data->nombre)) {
        mkdir($ruta_db_superior . "formatos/" . $data->nombre, PERMISOS_CARPETAS);

        if (!intval($data->pertenece_nucleo)) {
            $content = '*';
        } else {
            $content = "{$data->ruta_adicionar}
            {$data->ruta_editar}
            {$data->ruta_buscar}
            {$data->ruta_mostrar}";
        }

        file_put_contents($ruta_db_superior . "formatos/" . $data->nombre . "/.gitignore", $content);
        chmod($ruta_db_superior . "formatos/" . $data->nombre . "/.gitignore", PERMISOS_ARCHIVOS);
    }

    if ($data->serie_idserie) {
        $topSerie = Serie::findByAttributes([
            'nombre' => 'Administracion de Formatos',
        ]);

        if (!$topSerie) {
            $topSerieId = Serie::newRecord([
                'nombre' => 'Administracion de Formatos',
                'cod_padre' => 0,
                'categoria' => 3
            ]);
        } else {
            $topSerieId = $topSerie->getPK();
        }

        $Serie =  Serie::findByAttributes([
            'nombre' => $data->etiqueta,
        ]);
        if ($Serie) {
            if ($nomb_serie->cod_padre != $topSerieId) {
                $Serie->cod_padre = $topSerieId;
                $Serie->save();
                $data->serie_idserie = $Serie->getPK();
            }
        } else {
            $pk = Serie::newRecord([
                'nombre' => $data->etiqueta,
                'cod_padre' => $topSerieId,
                'categoria' => 3
            ]);
            $data->serie_idserie = $pk;
        }
    } else {
        $data->serie_idserie = 0;
    }

    echo '<pre>';
    var_dump($data);
    echo '</pre>';

    $data = get_object_vars($data);
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
    $idformato = Formato::newRecord($data);
    echo '<pre>';
    var_dump($idformato);
    echo '</pre>';
    exit;
    if (!$idformato) {
        throw new Exception("Error al crear el formato", 1);
    }

    if (in_array("1", $data->funcion_predeterminada)) {
        vincular_funcion_responsables($idformato);
    }
    if (in_array("2", $data->funcion_predeterminada)) {
        vincular_funcion_digitalizacion($idformato);
    }
    if (in_array("3", $data->funcion_predeterminada)) {
        vincular_campo_anexo($idformato);
    }
    insertar_anexo_formato($idformato, $documentacion, $anexos);
    crear_modulo_formato($idformato);

    if ($fieldList["cod_padre"] && $idformato) {

        $formato_padre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $fieldList["cod_padre"], "", $conn);
        $sql_icf1 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html,placeholder) VALUES (" . $idformato . ",'" . $formato_padre[0]["nombre_tabla"] . "', " . $fieldList["nombre"] . ", 'INT', 11, 1," . $fieldList["cod_padre"] . ", 'a','" . str_replace("'", "", $fieldList["etiqueta"]) . "(Formato padre)', 'fk', 'detalle','Formato padre')";

        guardar_traza($sql_icf1, "ft_" . $data->nombre);
        phpmkr_query($sql_icf1) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_icf1);
    }

    if ($idformato && !$fieldList["item"]) {
        $sql_icf2 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html) VALUES (" . $idformato . ",'estado_documento', 'ESTADO DEL DOCUMENTO', 'VARCHAR', 255, 0,'', 'a','', '', 'hidden')";
        phpmkr_query($sql_icf2) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_icf2);

        $sql_icf3 = "INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, predeterminado, acciones, ayuda, banderas, etiqueta_html,valor) VALUES (" . $idformato . ",'serie_idserie', 'SERIE DOCUMENTAL', 'INT', 11, 1,'" . $fieldList["serie_idserie"] . "', 'a'," . $fieldList["etiqueta"] . ", 'fk', 'hidden','../../test/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1')";
        guardar_traza($sql_icf3, "ft_" . $data->nombre);
        phpmkr_query($sql_icf3) or die("Falla al Ejecutar INSERT " . phpmkr_error() . ' SQL:' . $sql_icf3);
    }
    /*
     * Se validan y adicionan los campos adicionales al formato como iddocumento, serie_idserie, idft , etc
     */

    $datos_permisos = $_REQUEST['permisosPerfil'];

    $consultaModulo = busca_filtro_tabla("idmodulo", "modulo", "nombre='crear_{$_REQUEST['nombre_formato']}' and enlace='formatos/{$_REQUEST['nombre_formato']}/adicionar_{$_REQUEST['nombre_formato']}.php' ", "", $conn);
    $idModulo = $consultaModulo[0]['idmodulo'];

    //$guardar_permisos = new PermisoPerfil($idModulo);
    $sqlDelete = "DELETE FROM permiso_perfil WHERE modulo_idmodulo='" . $idModulo . "'";
    phpmkr_query($sqlDelete);

    if (!empty($datos_permisos)) {
        $N = count($datos_permisos);
        for ($i = 0; $i < $N; $i++) {
            $sqlPermiso = "INSERT INTO permiso_perfil (modulo_idmodulo,perfil_idperfil) VALUES ('" . $idModulo . "','" . $datos_permisos[$i] . "')";
            phpmkr_query($sqlPermiso);
            //$guardar_permisos->setAttributes(['perfil_idperfil'=>$datos_permisos[$i],'modulo_idmodulo'=>$idModulo]);
            //$guardar_permisos->save();
        }
    }

    if ($idformato) {
        $retorno["adicionales"] = adicionar_pantalla_campos_formato($idformato, $fieldList);
        $retorno["mensaje"] = "EL formato se guardó con éxito";
        $retorno["idformato"] = $idformato;
        $retorno['exito'] = 1;
    } else {
        $retorno["error"] = "Error al insertar el Formato";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    echo '<pre>';
    var_dump($th);
    echo '</pre>';
    exit;
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

/**
 * crea el contador del formato en caso de no existir
 *
 * @param string $name
 * @return integer
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-09-02
 */
function createCounter($name)
{
    $Contador = Contador::findByAttributes([
        'nombre' => $name
    ]);

    if (!$Contador) {
        $counterId = Contador::newRecord([
            'nombre' => $name
        ]);
    } else {
        $counterId = $Contador->getPK();
    }

    return $counterId;
}
