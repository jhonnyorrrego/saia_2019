<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "formatos/librerias/funciones_cliente.php";
include_once $ruta_db_superior . "class_transferencia.php";

function retornar_seleccionados($valor)
{
    global $ruta_db_superior;
    $vector = explode(",", str_replace("#", "d", $valor));
    $vector = array_unique($vector);
    foreach ($vector as $fila) {
        if (strpos($fila, 'd') > 0) {
            $ids_x = buscar_funcionarios2(str_replace("d", "", $fila));
            $cant = count($ids_x);
            for ($i = 0; $i < $cant; $i++) {
                $ids[] = $ids_x[$i];
            }
        } else {
            if ($pos = strpos($fila, "_"))
                $fila = substr($fila, 0, $pos);
            $ids[] = ($fila);
        }
    }
    return $ids;
}

function buscar_funcionarios2($dependencia, $arreglo = null)
{
    global $conn, $ruta_db_superior;

    include_once($ruta_db_superior . "class_transferencia.php");
    $dependencias = dependencias($dependencia);
    array_push($dependencias, $dependencia);

    $dependencias = array_unique($dependencias);

    $funcionarios = busca_filtro_tabla("A.funcionario_codigo", "funcionario A,dependencia_cargo B, cargo C,dependencia D", "B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia=D.iddependencia and B.dependencia_iddependencia IN(" . implode(",", $dependencias) . ") AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1", "", $conn);

    $arreglo = extrae_campo($funcionarios, "funcionario_codigo", "U");

    return ($arreglo);
}

function serie_subserie($idformato, $iddoc, $tipo = 0)
{
    global $conn;

    $formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
    $serie = busca_filtro_tabla("A.codigo,A.cod_padre", "serie A," . $formato[0]['nombre_tabla'] . " B", "B.serie_idserie=A.idserie and B.documento_iddocumento=$iddoc", "", $conn);
    if ($serie[0][0] == "") {
        $serie_papa = busca_filtro_tabla("codigo,cod_padre", "serie", "idserie=" . $serie[0][1], "", $conn);
        if ($tipo) {
            return ($serie_papa[0][0]);
        } else {
            echo $serie_papa[0][0];
        }
    } else {
        if ($tipo) {
            return ($serie[0][0]);
        } else {
            echo $serie[0][0];
        }
    }
}

/**
 * realiza la transferencia de un documento
 *
 * @param int $idformato si se van buscar en un documento los destinos
 * @param int $iddoc identificador del documento a transferir
 * @param string $destinos lista de funcionarios 
 * @param int $tipo tipo de destinos. 1: roles, 2: se busca en el formato, 3: funcionario_codigo
 * @param string $notas nota de transferencia
 * @param string $nombre nombre de transferencia
 * @return void
 */
function transferencia_automatica(
    $idformato = null,
    $iddoc,
    $destinos,
    $tipo,
    $notas = "",
    $nombre = "TRANSFERIDO"
) {
    global $conn;

    $adicionales = array();

    if ($tipo == "1") { // cuando es una lista de funcionarios fijos (roles)
        $vector = explode("@", $destinos);
    } elseif ($tipo == "3") { // cuando es una lista de funcionarios fijos (funcionario_codigo)
        $vector = explode("@", $destinos);
    } elseif ($tipo == "2") { // cuando el listado se toma de un campo del formato (roles)
        $formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=$idformato", "", $conn);
        $dato = busca_filtro_tabla($destinos, $formato[0][0], "documento_iddocumento=$iddoc", "", $conn);

        if ($dato['numcampos']) {
            $vector = explode(",", $dato[0][0]);
        } else {
            $vector = [];
        }
    }

    if ($notas) {
        $adicionales["notas"] = "'" . $notas . "'";
        $datos["ver_notas"] = 1;
    }

    foreach ($vector as $fila) {
        if (!strpos($fila, "#")) {
            if ($tipo == 3) {
                $lista = array(
                    $fila
                );
            } else {
                if ($fila) {
                    $codigos = busca_filtro_tabla("funcionario_codigo", "funcionario,dependencia_cargo", "funcionario_idfuncionario=idfuncionario AND iddependencia_cargo=$fila", "", $conn);
                    $lista = array(
                        $codigos[0]["funcionario_codigo"]
                    );
                }
            }
        } else {
            $lista = buscar_funcionarios(str_replace("#", "", $fila));
        }

        $datos["tipo_destino"] = "1";
        $datos["archivo_idarchivo"] = $iddoc;
        $datos["origen"] = $_SESSION["usuario_actual"];
        $datos["nombre"] = $nombre;
        $datos["tipo"] = "";
        $datos["tipo_origen"] = "1";
        transferir_archivo_prueba($datos, $lista, $adicionales);
    }
}

function mostrar_preparo($idformato, $iddoc)
{
    global $conn;
    $ejecutor = busca_filtro_tabla("ejecutor", "documento", "iddocumento=$iddoc", "", $conn);

    if ($ejecutor["numcampos"] == 0)
        return;
    else {
        $tabla = busca_filtro_tabla("nombre_tabla", "formato", "idformato=$idformato", "", $conn);
        $preparo = busca_filtro_tabla("iniciales", $tabla[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
        echo 'Prepar&oacute; :' . $preparo[0]["iniciales"] . ' ';
        return;
    }
}

function buscar_jefe_directo($dep)
{
    global $conn;
    $funcionario_dependencia = busca_filtro_tabla("c.funcionario_codigo", "dependencia_cargo a, cargo b, funcionario c", "a.funcionario_idfuncionario=c.idfuncionario and a.estado=1 and a.dependencia_iddependencia=" . $dep . " and a.cargo_idcargo=b.idcargo and (lower(b.nombre) like '%director%' OR lower(b.nombre) like '%lider%' OR lower(b.nombre) like '%jefe%')", "", $conn);

    if ($funcionario_dependencia["numcampos"])
        return ($funcionario_dependencia[0]["funcionario_codigo"]);
    else {
        $dependencia = busca_filtro_tabla("cod_padre", "dependencia", "iddependencia=" . $dep, "", $conn);
        if ($dependencia[0][0] == "") { // no encontró y retorna el predeterminado
            $configuracion = busca_filtro_tabla("valor", "configuracion", "nombre='jefe predeterminado'", "", $conn);
            return $configuracion[0][0];
        } else
            return buscar_jefe_directo($dependencia[0][0]);
    }
}

/*
 * <Clase>
 * <Nombre>nivel_cargo</Nombre>
 * <Parametros></Parametros>
 * <Responsabilidades>Devuelve el numero del nivel de un cargo<Responsabilidades>
 * <Notas>Se envia el id del cargo</Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
$niveles = 0;

function nivel_cargo($idcargo)
{
    global $conn, $ruta_db_superior, $niveles;
    $niveles++;
    if ($niveles > 10) {
        return false;
    }
    $cargo = busca_filtro_tabla("", "cargo", "idcargo=" . $idcargo, "", $conn);
    if ($cargo[0]["cod_padre"] != 0) {
        $idcargo = nivel_cargo($cargo[0]["cod_padre"]);
        return $idcargo;
    } else {
        return $niveles;
    }
}

/*
 * <Clase>
 * <Nombre>ejecutores_fbcomplete</Nombre>
 * <Parametros></Parametros>
 * <Responsabilidades>Devuelve un listado de etiquetas option con los ejecutores registrados en la base de datos<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function ejecutores_fbcomplete()
{
    global $conn;
    $ejecutores = busca_filtro_tabla("distinct nombre,identificacion,idejecutor", "ejecutor", "", "trim(lower(nombre))", $conn);
    $texto = '';
    if ($ejecutores["numcampos"]) {
        for ($i = 0; $i < $ejecutores["numcampos"]; $i++)
            $texto .= "<option value='" . $ejecutores[$i]["idejecutor"] . "'>" . $ejecutores[$i]["nombre"] . " " . $ejecutores[$i]["identificacion"] . "</option>";
    }
    return ($texto);
}

/*
 * <Clase>
 * <Nombre>mostrar_ultimo_upload</Nombre>
 * <Parametros>$idformato:id del formato;$campo:nombre del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Busca los archivos cargados en el campo y formato especificados y muestra el ultimo con un link para descargarlo<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function mostrar_ultimo_upload($idformato, $campo, $iddoc)
{
    global $conn;
    $campo = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre='$campo' and formato_idformato=$idformato", "", $conn);
    include_once("../../anexosdigitales/funciones_archivo.php");
    echo listar_anexos_documento($iddoc, $idformato, $campo[0][0], $_REQUEST["tipo"], "DESCARGAR|ULTIMO");
}

/*
 * <Clase>
 * <Nombre>componente_ejecutor</Nombre>
 * <Parametros>$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Presenta el formulario para llenar los datos de un ejecutor, segun los parametros enviados. se usa en las pantallas de adicionar y editar del formato en cuestion<Responsabilidades>
 * <Notas>
 * Se usa cuando un formato tiene un campo de etiqueta html 'Remitente'(ejecutor)
 * el valor en el campo debe ser de la forma:
 * tipo@a1,a2@b1,b2,b3@nombre_funcion
 * tipo:unico o multiple
 * a1,a2:nombres de los campos con autocompletar, pueden ser: nombre, identificacion o ambos
 * b1,b2,b3:nombres de los otros campos del formulario. los permitidos son:(identificacion,direccion,telefono,email,cargo,empresa,ciudad,titulo)
 * nombre_funcion: nombre de la funci�n que se va a llamar al momento de mostrar los datos en pantalla, si se deja vac�o se toma por defecto mostrar_valor_campo
 * Ej: multiple@nombre,identificacion@cargo,empresa,direccion,telefono,email,titulo,ciudad (usado en la carta)
 * </Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function componente_ejecutor($idcampo, $iddoc)
{
    global $conn;
    $adicionales = "";
    $campo = busca_filtro_tabla("", "campos_formato", "idcampos_formato=$idcampo", "", $conn);
    $formato = busca_filtro_tabla("", "formato", "idformato=" . $campo[0]["formato_idformato"], "", $conn);
    if ($iddoc != "")
        $adicionales = "&iddoc=$iddoc";
    if ($campo[0]["valor"] != "")
        $parametros = explode("@", $campo[0]["valor"]);
    else
        $parametros = array(
            "multiple",
            "nombre,identificacion",
            "cargo,empresa,direccion,telefono,email,titulo,ciudad"
        );
    // $parametros=explode("@",$campo[0]["valor"]);
    $campos = explode(",", $parametros[2]);
    echo '<iframe border=0 frameborder="0" style="background: #FFFFFF;" framespacing="0" name="frame_' . $campo[0]["nombre"] . '" id="frame_' . $campo[0]["nombre"] . '" src="../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=' . $campo[0]["nombre"] . '&tabla=' . $formato[0]["nombre_tabla"] . '&campos_auto=' . $parametros[1] . '&tipo=' . $parametros[0] . '&campos=' . $parametros[2] . $adicionales . '" width="100%" ></iframe>
            <script>
                $( document ).ready(function() {               
                    $(window).resize(function(){
                       console.log("1");
                       document.getElementById("frame_' . $campo[0]["nombre"] . '").style.height = "100px";
                       document.getElementById("frame_' . $campo[0]["nombre"] . '").style.height = $("#frame_' . $campo[0]["nombre"] . '").contents().height() + "px";
                    });
                });
            </script>';
}

/*
 * <Clase>
 * <Nombre>busca_campo</Nombre>
 * <Parametros>$campos:nombres de los campos;$llave:nombre del campo para hacer la comparacion;$tabla:nombre de la tabla,$id:valor a buscar</Parametros>
 * <Responsabilidades>Ejecuta una counsulta con los parametros recibidos y escribe en pantalla los datos encontrados<Responsabilidades>
 * <Notas>El sql queda de la sigiente forma:
 * SELECT $campos FROM $tabla WHERE $llave='$id'
 * </Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function busca_campo($campos, $llave, $tabla, $id)
{
    global $conn;
    $resultado = busca_filtro_tabla($campos, $tabla, $llave . "='" . $id . "'", "", $conn);

    if (strpos($campos, ",") > 0) {
        $lista = explode(",", $campos);
        foreach ($lista as $uno)
            echo $resultado[0][$uno] . " ";
    } else {
        echo $resultado[0][$campos];
    }
}

/*
 * <Clase>
 * <Nombre>combo_pais</Nombre>
 * <Parametros></Parametros>
 * <Responsabilidades>Crea un combo con la lista de los paises registrados en la base de datos<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function combo_pais()
{
    global $conn;
    $pais1 = busca_filtro_tabla("*", "pais", "", "nombre", $conn);
    echo "<select name='x_nacionalidadejecutor' id='x_nacionalidadejecutor'><option>Seleccionar  ...</option>";
    for ($i = 0; $i < $pais1["numcampos"]; $i++) {
        if ($pais1[$i]["idpais"] == 1)
            echo "<option value='" . $pais1[$i]["idpais"] . "' selected>" . $pais1[$i]["nombre"] . "</option>";
        else
            echo "<option value='" . $pais1[$i]["idpais"] . "'>" . $pais1[$i]["nombre"] . "</option>";
    }
    echo "</select>&nbsp;&nbsp;";
}

/*
 * <Clase>
 * <Nombre>cargos_memo</Nombre>
 * <Parametros>$func:dato;$fecha:fecha en que se cre� el documento;$tipo:define como se muestra el resultado;$campo:tipo de dato(1-codigo de funcionario,5-id del rol)</Parametros>
 * <Responsabilidades>Busca nombres, apellidos y cargo de un funcionario en cierta fecha y lo imprime en pantalla<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function cargos_memo($func, $fecha, $tipo, $campo)
{
    global $conn, $sql;
    switch ($campo) {
        case 1:
            /* $roles=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre","cargo,dependencia_cargo,funcionario,dependencia","dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND idfuncionario=funcionario_idfuncionario and lower(cargo.nombre)<>'distribuidor de documentos' and dependencia_cargo.estado=1 and funcionario.estado=1 AND dependencia.tipo<>0 and funcionario_codigo='$func'","",$conn); 	 */
            $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND idfuncionario=funcionario_idfuncionario and fecha_inicial<='$fecha' and fecha_final>='$fecha' and funcionario_codigo='$func'", "", $conn);
            if (!$roles["numcampos"])
                $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND idfuncionario=funcionario_idfuncionario and funcionario_codigo='$func'", "fecha desc", $conn);
            break;
        case 5:
            $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND idfuncionario=funcionario_idfuncionario and iddependencia_cargo=$func", "", $conn);
    }
    if ($tipo == "para")
        return ucwords($roles[0]["nombres"] . " " . $roles[0]["apellidos"]) . ", " . $roles[0]["nombre"];
    else
        return ucwords($roles[0]["nombre"]);
}

/*
 * <Clase>
 * <Nombre>listar_funcionarios</Nombre>
 * <Parametros>$idformato:id del formato;$nombre_campo:nombre del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Imprime la lista de los nombres de los funcionarios o dependencias cuyos codigos est�n en el campo y del formato seleccionados<Responsabilidades>
 * <Notas>Escribe cada nombre en una linea</Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function listar_funcionarios($idformato, $nombre_campo, $iddoc)
{
    global $conn;
    $formato = busca_filtro_tabla('nombre_tabla', 'formato', 'idformato=' . $idformato, '', $conn);
    $valor = busca_filtro_tabla($nombre_campo, $formato[0]["nombre_tabla"], 'documento_iddocumento=' . $iddoc, '', $conn);

    if ($valor["numcampos"]) {
        $lista = explode(',', $valor[0][0]);
        for ($i = 0; $i < count($lista); $i++) {
            if (strpos($lista[$i], '#') !== false) { // dependencia
                $nombre = busca_filtro_tabla('nombre', 'dependencia', 'iddependencia=' . str_replace("#", "", $lista[$i]), '', $conn);
            } else { // funcionario
                $nombre = busca_filtro_tabla('nombres,apellidos', 'funcionario', 'funcionario_codigo="' . $lista[$i] . '"', '', $conn);
                // $cargo=cargos_memo();
                $nombre[0]["nombre"] = $nombre[0]["nombres"] . " " . $nombre[0]["apellidos"];
            }
            echo ucwords($nombre[0]["nombre"]) . "<br />";
        }
    }
}

/*
 * <Clase>
 * <Nombre>listar_dependencias</Nombre>
 * <Parametros>$idformato:id del formato;$nombre_campo:nombre del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Imprime la lista de los nombres de las dependencias cuyos codigos est�n en el campo y del formato seleccionados<Responsabilidades>
 * <Notas>Escribe cada nombre en una linea</Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function listar_dependencias($idformato, $nombre_campo, $iddoc)
{
    global $conn;
    $formato = busca_filtro_tabla('nombre_tabla', 'formato', 'idformato=' . $idformato, '', $conn);
    $valor = busca_filtro_tabla($nombre_campo, $formato[0]["nombre_tabla"], 'documento_iddocumento=' . $iddoc, '', $conn);

    if ($valor["numcampos"]) {
        $lista = explode(',', $valor[0][0]);
        for ($i = 0; $i < count($lista); $i++) {
            $nombre = busca_filtro_tabla('nombre', 'dependencia', 'iddependencia=' . $lista[$i], '', $conn);
            echo $nombre[0]["nombre"] . "<br />";
        }
    }
}

/*
 * <Clase>
 * <Nombre></Nombre>
 * <Parametros></Parametros>
 * <Responsabilidades><Responsabilidades>
 * <Notas>NO SE EST� USANDO</Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

function editar_anexos_digitales($idformato, $idcampo, $iddoc = null)
{
    ?>
        <tr>
            <td title="Adjuntar archivos relacionados con el documento" width="21%" class="encabezado"><span>ADJUNTAR ANEXOS</span></td>
            <td bgcolor="#F5F5F5"><iframe src="../../upload.php?iddoc=<?php echo $iddoc; ?>" width="500" height="50" frameborder=0 scrolling="no" marginwidth=0> </iframe> </font>
            </td>
        </tr>
        <tr>
            <td title="Lista de archivos anexos" width="21%" class="encabezado">
                ARCHIVOS ANEXOS:</td>
            <td bgcolor="#F5F5F5"><iframe name='listar_archivos' id='listar_archivos' src="../../listar_anexos.php?iddoc=<?php echo $iddoc; ?>" width="100%" height="100%" frameborder=0 scrolling="no" marginwidth=0>
                </iframe></td>
        </tr>
    <?php

    }

    /*
 * <Clase>
 * <Nombre>guardar_plantilla</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc: id del documento</Parametros>
 * <Responsabilidades>Imprime la parte del formato que pregunta si se guarda el contenido como plantilla o no<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

    function guardar_plantilla($idformato, $idcampo, $iddoc = null)
    {
        $campo .= '<div class="form-group" id="tr_guardar_plantilla">
                <label title="">GUARDAR COMO PLANTILLA:</label>
                <div class="row">
                    <div class="px-1">
                        <div class="radio radio-success">
                            <input class="form-check-input" type="radio" name="plantilla" id="plsi" value="1" aria-required="true">
                            <label class="etiqueta_selector" for="si1">Si</label>
                        </div>
                    </div>
                    <div class="px-1">
                        <!--label class="etiqueta_selector" for="asplantilla">Asunto de la plantilla: </label-->
                        <input class="form-control" type="text" id="asplantilla" name="asplantilla" placeholder="Nombre de la plantilla">
                    </div>
                    <div class="col-3 px-4">
                        <div class="radio radio-success">
                            <input class="form-check-input" type="radio" name="plantilla" id="plno" value="0" checked aria-required="true">
                            <label class="etiqueta_selector" for="plno">No</label>
                        </div>
                    </div>
                    
                </div>
            </div>';
        echo $campo;
    }

    /*
 * <Clase>
 * <Nombre>ciudad</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento;$tipo:define si se retona el valor o se hace un echo</Parametros>
 * <Responsabilidades>Busca el nombre de la ciudad definida por defecto en la configuracion<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

    function ciudad($idformato = 0, $iddoc = 0, $tipo = 0)
    {
        global $conn;

        $ciudad = busca_filtro_tabla("valor", "configuracion", "nombre='ciudad'", "", $conn);
        if ($ciudad["numcampos"]) {
            $nombre_ciudad = busca_filtro_tabla("nombre", "municipio", "idmunicipio=" . $ciudad[0]["valor"], "", $conn);
            $ciudad_valor = $ciudad[0][0];
            $valor = $nombre_ciudad[0][0];
        } else {
            alerta("La ciudad y departamento por defecto no se encuentran configurados");
            $ciudad_valor = "658";
            $valor = "Pereira";
        }
        if ($tipo)
            return ($valor);
        else
            echo $valor;
    }

    /*
 * <Clase>
 * <Nombre>mostrar_fecha</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento;$tipo:define si se retona el valor o se hace un echo</Parametros>
 * <Responsabilidades>Busca en el formato un campo que se llame fecha_(nombre_formato) y devuelve o imprime el valor<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

    function mostrar_fecha($idformato, $iddoc, $tipo = null)
    {
        global $conn;
        $datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=$idformato", "", $conn);

        $resultado = busca_filtro_tabla(fecha_db_obtener("fecha_" . $datos[0]["nombre"], "Y-m-d") . " as fecha", $datos[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
        if (!$resultado["numcampos"])
            $resultado = busca_filtro_tabla(fecha_db_obtener("fecha", "Y-m-d") . " as fecha", "documento", "iddocumento=$iddoc", "", $conn);
        if ($tipo != null)
            return (fecha($resultado[0]["fecha"]));
        else
            echo fecha($resultado[0]["fecha"]);
    }

    /*
 * <Clase>
 * <Nombre>mostrar_anexos_memo</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento;$tipo:define si se retona el valor o se hace un echo</Parametros>
 * <Responsabilidades>Lista los anexos de un formato, tanto los f�sicos como los digitales<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

    function mostrar_anexos_memo($idformato, $iddoc = null)
    {
        global $conn, $ruta_db_superior;
        $datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
        $inf_memorando = busca_filtro_tabla("anexos_fisicos", $datos[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
        if ($inf_memorando["numcampos"]) {
            $anexos = array();
            if ($inf_memorando[0]["anexos_fisicos"] != "") {
                $anexos[] = $inf_memorando[0]["anexos_fisicos"];
                if (count($anexos) > 0) {
                    echo '<span><font size="2"><br />Anexos: ' . implode(", ", $anexos) . '</font></span>';
                }
            }
        }
        include_once($ruta_db_superior . "anexosdigitales/funciones_archivo.php");
        echo listar_anexos_documento($iddoc, null, null, $_REQUEST["tipo"], "DESCARGAR|ENCABEZADO");
    }

    /*
 * <Clase>
 * <Nombre>despedida</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento;$tipo:define si se retona el valor o se hace un echo</Parametros>
 * <Responsabilidades>Imprime el formulario para seleccionar la despedida, en el adicionar y en el editar del formato<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

    function despedida($idformato, $idcampo, $iddoc = null)
    {
        global $conn;
        if ($iddoc == null) {
            echo '<td width="79%" bgcolor="#F5F5F5" id="despedida">
          <select name="despedida" id="obligatorio">
              <option value="Atentamente,">Atentamente,</option>
              <option value="Cordialmente,">Cordialmente,</option>
            </select>
          <label style="text-decoration:underline;cursor: pointer"
          onclick="document.getElementById(' . "'despedida'" . ').innerHTML=' . "'<td><input type=text name=despedida id=obligatorio></td>'" . ';">OTRA
          </label>
          </td>';
        } else {
            $tabla = busca_filtro_tabla("nombre_tabla", "formato", "idformato=$idformato", "", $conn);
            $valor = busca_filtro_tabla("despedida", $tabla[0]['nombre_tabla'], "documento_iddocumento=$iddoc", "", $conn);
            echo '<td width="79%" bgcolor="#F5F5F5" id="despedida">
          <select name="despedida" id="obligatorio">';
            if ($valor[0]["despedida"] == "Atentamente,")
                echo '<option value="Atentamente," selected>Atentamente,</option>';
            else
                echo '<option value="Atentamente,">Atentamente,</option>';
            if ($valor[0]["despedida"] == "Cordialmente,")
                echo '<option value="Cordialmente," selected>Cordialmente,</option>';
            else
                echo '<option value="Cordialmente,">Cordialmente,</option>';
            if ($valor[0]["despedida"] != "Atentamente," && $valor[0]["despedida"] != "Cordialmente,")
                echo '<option value="' . $valor[0]["despedida"] . '" selected>' . $valor[0]["despedida"] . '</option>';
            echo '</select>
          <label style="text-decoration:underline;cursor: pointer"
          onclick="document.getElementById(' . "'despedida'" . ').innerHTML=' . "'<td><input type=text name=despedida id=obligatorio></td>'" . ';">OTRA
          </label>
          </td>';
        }
    }

    /*
 * <Clase>
 * <Nombre>anexos_fisicos</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Imprime los componentes para el manejo de los anexos f�sicos<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

    function anexos_fisicos($idformato, $idcampo, $iddoc = null)
    {
        global $conn;
        ?>
        <td bgcolor="#F5F5F5">
            <?php
                $anexos_fisicos = array();
                $anexos_fisicos["numcampos"] = 0;
                if ($iddoc != null) {
                    $tabla = busca_filtro_tabla("nombre_tabla", "formato A", "A.idformato=" . $idformato, "", $conn);
                    $anexos_fisicos = busca_filtro_tabla("A.anexos_fisicos", "" . $tabla[0]["nombre_tabla"] . " A", "A.documento_iddocumento=" . $iddoc, "", $conn);
                    if ($anexos_fisicos["numcampos"]) {
                        $listado_anexos = explode(",", $anexos_fisicos[0]["anexos_fisicos"]);
                    }
                }
                ?>
            <input type="hidden" name="anexos_fisicos" id="anexos_fisicos" value="<?php
                                                                                        if ($anexos_fisicos["numcampos"]) {
                                                                                            echo $anexos_fisicos[0]["anexos_fisicos"];
                                                                                        }
                                                                                        ?>">
            <input type=button value="Adicionar Anexo F&iacute;sico" onclick="adicionar_anexo();"> <input type=button value="Borrar Anexos F&iacute;sicos" onclick="document.getElementById('anexos_fisicos').value = ''; document.getElementById('mostrar_archivos2').innerHTML = '';">
            <div id=mostrar_archivos2>
                <?php
                    if ($anexos_fisicos[0]["anexos_fisicos"] != "") {
                        $cont = count($listado_anexos);
                        for ($i = 0; $cont && $i < $cont; $i++)
                            echo ("<LI>" . $listado_anexos[$i] . "</LI>");
                    }
                    ?>
            </div>
        </td>
        <?php

        }

        /*
 * <Clase>
 * <Nombre>genera_campo_listados_editar</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Maneja el adicionar y el editar de los campos tipo radiobutton, select y checkbox de los formatos<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function genera_campo_listados_editar($idformato, $idcampo, $iddoc = null, $buscar = 0)
        {
            global $conn;
            $columnas = 3;
            $campo = busca_filtro_tabla("*", "campos_formato", "idcampos_formato=" . $idcampo, "", $conn);
            $sql = trim($campo[0]["valor"]);
            $sql = str_replace('', '', $sql);
            $accion = strtoupper(substr($sql, 0, strpos($sql, ' ')));
            $llenado = "";
            // ***************** validaciones ******************
            $labelRequired = '';
            $valor = null;
            $required = '';
            if ($campo[0]["obligatoriedad"]) {
                $obligatorio[] = "class='required'";
                $labelRequired = '<label id="' . $campos[$h]["nombre"] . '-error" class="error" for="' . $campos[$h]["nombre"] . '" style="display: none;"></label>';
                $required = 'required';
            }

            $caracteristicas = busca_filtro_tabla("tipo_caracteristica as tipo,valor", "caracteristicas_campos", "idcampos_formato=$idcampo", "", $conn);
            for ($i = 0; $i < $caracteristicas["numcampos"]; $i++)
                $obligatorio[] = $caracteristicas[$i]["tipo"] . "='" . $caracteristicas[$i]["valor"] . "'";

            if (is_array($obligatorio) && count($obligatorio) > 0) {
                $obligatorio = implode(" ", $obligatorio);
            }
            // *************************************************

            $listado0 = array();
            if ($accion == "SELECT") {
                $datos = ejecuta_filtro_tabla($campo[0]["valor"], $conn);
                if ($datos["numcampos"]) {
                    for ($i = 0; $i < $datos["numcampos"]; $i++) {
                        array_push($listado0, html_entity_decode($datos[$i][0] . "," . $datos[$i][1]));
                    }
                    $llenado = implode(";", $listado0);
                }
                // else alerta("POSEE UN PROBLEMA EN LA BUSQUEDA CAMPO: ".$campo[0]["etiqueta"]);
            } else {
                $llenado = json_decode($campo[0]["opciones"], true);
            }
            $tipo = $campo[0]["etiqueta_html"];
            $nombre = $campo[0]["nombre"];

            $tabla = busca_filtro_tabla("nombre_tabla,item", "formato", "idformato=$idformato", "", $conn);
            if ($buscar) {
                $default = "";
            } elseif ($iddoc != null) {
                if ($tabla[0]["item"]) {
                    $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "id" . $tabla[0]['nombre_tabla'] . "=$iddoc", "", $conn);
                } else {
                    $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "documento_iddocumento=$iddoc", "", $conn);
                }
                $default = $valor[0][0];
            } else {
                $default = $campo[0]["predeterminado"];
            }

            $texto = "";
            $listado3 = array();
            if ($llenado != "" && $llenado != "Null") {
                $listado1 = $llenado;
                $cont1 = count($listado1);

                for ($i = 0; $i < $cont1; $i++) {
                    $listado2 = $listado1[$i];

                    array_push($listado3, $listado2);
                }
            }
            $cont3 = count($listado3);
            switch ($tipo) {
                case "radio":
                    $texto .= '<div class="radio radio-success">';
                    for ($j = 0; $j < $cont3; $j++) {

                        $texto .= '<input ' . $required . ' type="' . $tipo . '" ';
                        if ($buscar) {
                            $texto .= ' name="bqsaia_g@' . $nombre . '" id="' . $nombre . $j . '" value="' . $llenado[$j]['llave'] . '" class="radio"';
                        } else {
                            $texto .= ' name="' . $nombre . '" id="' . $nombre . $j . '" value="' . $llenado[$j]['llave'] . '"';
                        }
                        if (($llenado[$j]['llave']) == $default) {
                            $texto .= ' checked ';
                        }
                        if ($j == 0) {
                            $texto .= $obligatorio;
                        }
                        $texto .= ' aria-required="true"><label class="" for="' . $nombre . $j . '">' . $llenado[$j]['item'] . '</label>';
                    }
                    $texto .= "</div>";
                    break;
                case "checkbox":
                    $texto .= '<div class="checkbox check-success">';

                    $lista_default = explode(',', $default);
                    for ($j = 0; $j < $cont3; $j++) {
                        $texto .= '<input type="checkbox" ';

                        if ($j == 0 && $obligatorio) {
                            $required = "required";
                        } else {
                            $required = "";
                        }

                        $texto .= ' class="' . $required . ' checkbox" name="' . $nombre . '[]" id="' . $nombre . $j . '" value="' . $llenado[$j]['llave'] . '"';
                        if (in_array(($llenado[$j]['item']), $lista_default)) {
                            $texto .= ' checked ';
                        }
                        $texto .= '><label for="' . $nombre . $j . '">' . strip_tags($llenado[$j]['item']) . "</label><br>";
                    }
                    $texto .= "</div>";

                    // $texto .= "<tr><td colspan='$columnas'><label style='display:none' for='" . $nombre . "[]' class='error'>Campo obligatorio</label></td></tr></table></div>";
                    break;
                case "select":

                    $texto = ' <div class="form-group ">';
                    if ($buscar) {
                        $texto = '<select name="bqsaia_g@' . $nombre . '" id="' . $nombre . '" ' . $obligatorio . ' data-init-plugin="select2" class="full-width">
	  		  <option value="" selected >Por favor seleccione...</option>';
                    } else {
                        $texto = '<select name="' . $nombre . '" id="' . $nombre . '" ' . $obligatorio . ' data-init-plugin="select2" >
              <option value="" selected >Por favor seleccione...</option>';
                    }
                    for ($j = 0; $j < $cont3; $j++) {
                        $texto .= '<option value="' . $llenado[$j]['llave'] . '"';
                        if (($llenado[$j]['llave']) == $default) {
                            $texto .= ' selected ';
                        }
                        $texto .= '>' . $llenado[$j]['item'] . '</option>';
                    }
                    $texto .= '</select>';
                    $texto .= '
                     <script>
                    $(document).ready(function() {

                        $("#' . $nombre . '").select2();
                        $("#' . $nombre . '").addClass("full-width");
                    });
                    </script>
                     ';
                    break;
                case "dependientes":
                    $campo[0]["valor"] = html_entity_decode($campo[0]["valor"]);
                    $parametros = explode("|", $campo[0]["valor"]);
                    /*
             * parametros:
             * nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
             * (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=)
             */
                    $idcampo = $campo[0]["idcampos_formato"];
                    // dibujo el primer select
                    $select = explode(";", $parametros[0]);
                    $datos_padre = ejecuta_filtro_tabla($select[1], $conn);
                    if (count($parametros) > 2) {
                        $select2 = explode(";", $parametros[1]);
                        $hijo = $select2[0] . $idcampo;
                    } else
                        $hijo = $nombre;

                    $texto .= "<table width='100%'><tr><td width='20%'> " . ucfirst($select[0]) . "</td><td>
      <select name='" . $select[0] . "$idcampo' id='" . $select[0] . "$idcampo' idcomponente='" . $idcampo . "' pos='0' hijo='$hijo'><option value='' selected>Seleccionar...</option>";
                    for ($i = 0; $i < $datos_padre["numcampos"]; $i++) {
                        $texto .= "<option value='" . $datos_padre[$i]["id"] . "'>" . $datos_padre[$i]["nombre"] . "</option>";
                    }
                    $texto .= "</select></td></tr>";

                    for ($i = 1; $i < count($parametros); $i++) {
                        $select = explode(";", $parametros[$i]);
                        // si es el ultimo select
                        if ($i == (count($parametros) - 1)) {
                            $nombre2 = $nombre;
                            $hijo = "";
                        } elseif ($i == (count($parametros) - 2)) { // si es el penultimo
                            $nombre2 = $select[0] . $idcampo;
                            $hijo = " hijo='" . $nombre . "' ";
                        } else { // si es un select intermedio
                            $nombre2 = $select[0] . $idcampo;
                            $select3 = explode(";", $parametros[$i + 1]);
                            $hijo = " hijo='" . $select3[0] . $idcampo . "' ";
                        }

                        $texto .= "<tr><td>" . $select[0] . "</td><td><select name='$nombre2' id='$nombre2' pos='$i' idcomponente='" . $campo[0]["idcampos_formato"] . "' ";

                        if ($i == (count($parametros) - 1)) { // si es el ultimo select
                            $texto .= $obligatorio;
                        }
                        $texto .= " $hijo >";
                        if ($default && $i == (count($parametros) - 1)) {
                            preg_match("/(\w+) as id/", strtolower($select[1]), $llave);
                            $cuerpo = substr($select[1], 0, strpos($select[1], "where"));
                            // preg_match("/(.+) where/", strtolower($select[1]), $cuerpo);
                            $valor = ejecuta_filtro_tabla($cuerpo . " where " . $llave[1] . "=" . $default, $conn);
                            $texto .= "<option value='$default' selected>" . $valor[0]["nombre"] . "</option>";
                        } else
                            $texto .= "<option value='' selected>Seleccionar...</option>";
                        $texto .= "</select></td></tr>";
                    }
                    $texto .= "</table>";
                    break;
            }
            echo $texto;
        }

        /*
 * <Clase>
 * <Nombre>buscar_dependencia</Nombre>
 * <Parametros></Parametros>
 * <Responsabilidades>Busca los roles activos del funcionario y los lista, guarda el id del rol<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function buscar_dependencia($iformato = 0)
        {
            global $conn;
            if (isset($_REQUEST['iddoc'])) {
                $idformato = busca_filtro_tabla("idformato,nombre_tabla", "formato f,documento d", "lower(f.nombre)=lower(d.plantilla) and iddocumento=" . $_REQUEST['iddoc'], "", $conn);
                if ($idformato['numcampos']) {
                    $datos = busca_filtro_tabla("dependencia", $idformato[0]['nombre_tabla'] . " ft", "documento_iddocumento=" . $_REQUEST['iddoc'], "", $conn);
                    $dep_sel = $datos[0]['dependencia'];
                }
            } else {
                $dep_sel = "";
            }

            $hoy = date('Y-m-d');
            /*$dep = busca_filtro_tabla("distinct dependencia.nombre,iddependencia_cargo,cargo.nombre as cargo", 
            "funcionario,dependencia_cargo,dependencia,cargo", "dependencia_cargo.funcionario_idfuncionario=funcionario.idfuncionario  AND 
            cargo_idcargo=idcargo AND cargo.estado=1 AND dependencia_cargo.dependencia_iddependencia=dependencia.iddependencia AND dependencia_cargo.estado=1 AND 
            funcionario.login='" . usuario_actual('login') . "' AND cargo.tipo_cargo='1' AND " . fecha_db_obtener('dependencia_cargo.fecha_inicial', 'Y-m-d') . "<='" . $hoy . "' 
            AND " . fecha_db_obtener('dependencia_cargo.fecha_final', 'Y-m-d') . ">='" . $hoy . "'", "dependencia.nombre", $conn);
            */
            $query = Model::getQueryBuilder();

            $dep = $query
            ->select("dependencia, iddependencia_cargo, cargo")
            ->from("vfuncionario_dc")
            ->where("estado_dc = 1 and tipo_cargo = 1 and login = :login")
            ->andWhere(
                $query->expr()->lte('fecha_inicial', ':fechaI'),
                $query->expr()->gte('fecha_final', ':fechaF'),
            )->setParameter(":login", SessionController::getLogin())
            ->setParameter(':fechaI', new \DateTime("now"), "datetime")
            ->setParameter(':fechaF', new \DateTime("now"), "datetime")
            ->execute()->fetchAll();
            
            $numfilas = $dep["numcampos"];

            $html = '';
            if ($numfilas > 1) {
                $html .= '<select class ="full-width" name="dependencia" id="dependencia" required>';
                if ($dep_sel == '') {
                    $html .= "<option value='' selected>Por favor seleccione...</option>";
                }

                for ($i = 0; $i < $dep["numcampos"]; $i++) {
                    if ($dep_sel == $dep[$i]["iddependencia_cargo"]) {
                        $html .= "<option value='" . $dep[$i]["iddependencia_cargo"] . "' selected>" . $dep[$i]["nombre"] . " - (" . $dep[$i]["cargo"] . ")</option>";
                    } else {
                        $html .= "<option value='" . $dep[$i]["iddependencia_cargo"] . "'>" . $dep[$i]["nombre"] . " - (" . $dep[$i]["cargo"] . ")</option>";
                    }
                }
                $html .= '</select>'
                    . '<script>$("#dependencia").select2();</script>';
            } else if ($numfilas == 1) {
                $html .= "<input class='required' type='hidden' value='" . $dep[0]["iddependencia_cargo"] . "' id='dependencia' name='dependencia'><label class ='form-control'>" . $dep[0]["nombre"] . " - (" . $dep[0]["cargo"] . ")</label>";
            } else {
                alerta("Existe un problema al momento de definir su dependencia. Por favor Comuniquese con su administrador");
                redirecciona("../../responder.php");
            }
            echo $html;
        }

        /*
 * <Clase>
 * <Nombre>iniciales</Nombre>
 * <Parametros>$idformato:id del formao;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Crea un campo llamado iniciales y como valor le pone los nombres y apellidos del usuario actual<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function iniciales($idformato, $idcampo, $iddoc = null)
        {
            global $conn;
            if (!$iddoc) {
                $resultado = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . usuario_actual("funcionario_codigo"), "", $conn);
                // print_r($resultado);
                $nombres = explode(" ", $resultado[0]["nombres"]);
                $apellidos = explode(" ", $resultado[0]["apellidos"]);
                // $iniciales=@$nombres[0][0]."".@$nombres[1][0]."".$apellidos[0][0]."".$apellidos[1][0];
                $iniciales = $resultado[0]["nombres"];
            } else {
                $datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=$idformato", "", $conn);
                $campo = busca_filtro_tabla("iniciales", $datos[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
                $iniciales = $campo[0][0];
            }
            echo '<td width="79%" bgcolor="#F5F5F5">
         <input name="iniciales" readonly=true type="text" value="' . $iniciales . '" id="iniciales" size="20" style="font-size:10px"></td>';
        }

        /*
 * <Clase>
 * <Nombre>fecha_formato</Nombre>
 * <Parametros>$idformato:id del formao;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Crea un campo de texto no editable y como valor le asigna la fecha actual<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function fecha_formato($idformato, $idcampo, $iddoc = null)
        {
            global $conn;
            $datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=$idformato", "", $conn);
            $campo = busca_filtro_tabla("", "campos_formato", "idcampos_formato=$idcampo", "", $conn);

            if ($campo[0]["tipo_dato"] == 'DATE')
                $formato = "Y-m-d";
            elseif ($campo[0]["tipo_dato"] == 'DATETIME')
                $formato = "Y-m-d H:i";

            if ($iddoc == null) {
                $valor = date($formato);
            } else {
                $resultado = busca_filtro_tabla(fecha_db_obtener($campo[0]["nombre"], $formato) . " as fecha", $datos[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
                $valor = $resultado[0]["fecha"];
            }
            echo "<input type='text' class='form-control' name='" . $campo[0]["nombre"] . "' id='" . $campo[0]["nombre"] . "' value='$valor' readonly='true'>";
        }

        /*
 * <Clase>
 * <Nombre>mes
 * <Parametros>mes:numero que identifica el mes
 * <Responsabilidades>devuelve una cadena con el nombre del mes
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */

        function mes($mes)
        {
            switch ($mes) {
                case 1:
                    return "enero";
                case 2:
                    return "febrero";
                case 3:
                    return "marzo";
                case 4:
                    return "abril";
                case 5:
                    return "mayo";
                case 6:
                    return "junio";
                case 7:
                    return "julio";
                case 8:
                    return "agosto";
                case 9:
                    return "septiembre";
                case 10:
                    return "octubre";
                case 11:
                    return "noviembre";
                case 12:
                    return "diciembre";
            }
        }

        /*
 * <Clase>
 * <Nombre>fecha
 * <Parametros>dato-fecha en formato yyyy-mm-dd
 * <Responsabilidades>convierte una fecha de tipo 'yyyy-mm-dd' a 'dia+de+nombre_mes+de+ao'
 * <Notas>
 * <Excepciones>
 * <Salida>retorna una fecha en formato cadena
 * <Pre-condiciones>
 * <Post-condiciones>
 */

        function fecha($dato)
        {
            $fecha = substr($dato, 8, 2) . " de ";
            $fecha .= mes(substr($dato, 5, 2)) . " de ";
            $fecha .= substr($dato, 0, 4);
            return ($fecha);
        }

        function listar_item($campoenlace, $llave, $parametros, $edicion = 0)
        {
            global $conn;
            $vector_parametros = explode("@", $parametros);
            $filtro_campos = "";
            $filtro_funciones = "";
            $formato = $vector_parametros[0];

            if (isset($vector_parametros[1]) && $vector_parametros[1] != "")
                $filtro_campos = " and nombre in('" . implode("','", explode(",", $vector_parametros[1])) . "') ";
            if (isset($vector_parametros[2])) {
                if ($vector_parametros[2] != "")
                    $filtro_funciones = " and nombre_funcion in('" . implode("','", explode(",", $vector_parametros[2])) . "') ";
                else
                    $filtro_funciones = " and nombre_funcion in('') ";
            }
            $etiquetas_funciones = array();
            $info_formato = busca_filtro_tabla("etiqueta,nombre_tabla,nombre,ruta_editar,ruta_adicionar,ruta_mostrar", "formato", "idformato=" . $formato, "", $conn);

            $campos = busca_filtro_tabla("nombre,etiqueta", "campos_formato", "etiqueta_html not in('hidden','detalle') $filtro_campos and formato_idformato=" . $formato, "", $conn);

            $nombres_campos = extrae_campo($campos, "nombre", "");
            $etiquetas_campos = extrae_campo($campos, "etiqueta", "");
            $ids = busca_filtro_tabla("id" . $info_formato[0]["nombre_tabla"], $info_formato[0]["nombre_tabla"], "$campoenlace=$llave", "", $conn);
            $funciones = busca_filtro_tabla("", "funciones_formato", "formato=$formato and acciones like '%m%' $filtro_funciones", "", $conn);
            if ($funciones["numcampos"]) {
                $etiquetas_funciones = extrae_campo($funciones, "etiqueta", "U");
                $nombres_funciones = extrae_campo($funciones, "nombre_funcion", "U");
                $etiquetas_campos = array_merge($etiquetas_campos, $etiquetas_funciones);
                include_once("../" . $info_formato[0]["nombre"] . "/funciones.php");
            }
            if ($edicion)
                echo '<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type="text/javascript">
    hs.graphicsDir = "../../anexosdigitales/highslide-4.0.10/highslide/graphics/";
    hs.outlineType = "rounded-white";
</script>' . "<a  href='../" . $info_formato[0]["nombre"] . "/" . $info_formato[0]["ruta_adicionar"] . "?pantalla=padre&idpadre=" . $_REQUEST["iddoc"] . "&idformato=$formato&padre=$llave'>
<img width='16px' border=0 src='../../botones/formatos/adicionar.gif' />Adicionar " . $info_formato[0]["etiqueta"] . "</a>";
            if ($ids["numcampos"]) {
                echo "<table border='1' width='100%' style='border-collapse:collapse'>
         <tr class='encabezado_list'><td>" . implode("</td><td>", $etiquetas_campos) . "</td></tr>";

                for ($i = 0; $i < $ids["numcampos"]; $i++) {
                    echo "<tr>";
                    foreach ($nombres_campos as $fila)
                        echo "<td>" . mostrar_valor_campo($fila, $formato, $ids[$i][0], 1) . "</td>";
                    foreach ($nombres_funciones as $fila)
                        echo "<td>" . $fila($formato, $ids[$i][0], 1) . "</td>";
                    if ($edicion == 1 && (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1))
                        echo "<td><!--a onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" href='../" . $info_formato[0]["nombre"] . "/" . $info_formato[0]["ruta_mostrar"] . "?idformato=$formato&iddoc=" . $ids[$i][0] . "'>
          <img border=0 src='../../botones/intermedio/ver_documentos.png' /></a>&nbsp;&nbsp;<a href='../" . $info_formato[0]["nombre"] . "/" . $info_formato[0]["ruta_editar"] . "?idformato=$formato&item=" . $ids[$i][0] . "'><img border=0 src='../../botones/intermedio/editar_documento.png' /></a>&nbsp;&nbsp;--><a href='#' onclick='if(confirm(\"En realidad desea borrar este elemento?\")) window.location=\"../librerias/funciones_item.php?formato=$formato&idpadre=" . $_REQUEST["iddoc"] . "&accion=eliminar_item&tabla=" . $info_formato[0]["nombre_tabla"] . "&id=" . $ids[$i][0] . "\";'><img border=0 src='../../images/eliminar_pagina.png' /></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            // else echo "<font color='red'>No se han adicionado registros.</font>";
        }

        /*
 * <Clase>
 * <Nombre>mostrar_valor_campo</Nombre>
 * <Parametros>$idformato:id del formao;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Busca el valor del campo en el formato seleccionado<Responsabilidades>
 * <Notas>Se utiliza en el mostrar y en el editar de los formatos</Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function mostrar_valor_campo($campo, $idformato, $iddoc, $tipo = null)
        {
            global $conn, $ruta_db_superior;
            $datos = busca_filtro_tabla("nombre_tabla,detalle,etiqueta_html,valor,item,tipo_dato,autoguardado,A.nombre as formato,ruta_adicionar,ruta_editar,ruta_mostrar,tipo_edicion,B.opciones", "formato A,campos_formato B", "B.formato_idformato=A.idformato AND A.idformato=" . $idformato . " AND B.nombre LIKE '" . $campo . "'", "", $conn);
            if ($datos[0]["item"]) {
                $llave = "id" . $datos[0]["nombre_tabla"];
                if (@$_REQUEST["item"]) {
                    $iddoc = $_REQUEST["item"];
                }
            } else {
                $llave = "documento_iddocumento";
            }
            $retorno = "";
            if ($datos["numcampos"]) {
                if ($datos[0]["etiqueta_html"] == "item") {
                    $datos_detalle = busca_filtro_tabla("id" . $datos[0]["nombre_tabla"] . ",d.estado", $datos[0]["nombre_tabla"] . " f,documento d", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);

                    $editar = 0;
                    if (!isset($_REQUEST["tipo"]) || @$_REQUEST["tipo"] == 1) {
                        $permisos = busca_filtro_tabla("permisos", "permiso_documento", "funcionario='" . usuario_actual("funcionario_codigo") . "' and documento_iddocumento='" . $iddoc . "'", "", $conn);
                        $v_permisos = explode(",", @$permisos[0]["permisos"]);
                    }
                    if (($datos_detalle[0]["estado"] == "ACTIVO" || $datos[0]["tipo_edicion"] == "1") && in_array('m', $v_permisos)) {
                        $editar = 1;
                    }
                    listar_item($datos[0]["nombre_tabla"], $datos_detalle[0]["id" . $datos[0]["nombre_tabla"]], $datos[0]["valor"], $editar);
                } elseif ($datos[0]["etiqueta_html"] == "fecha") {
                    if ($datos[0]["tipo_dato"] == "DATE") {
                        $formato_fecha = "Y-m-d";
                    } else if ($datos[0]["tipo_dato"] == "TIME") {
                        $formato_fecha = "H:i";
                    } else {
                        $formato_fecha = "Y-m-d H:i";
                    }
                    if ($datos[0]["tipo_dato"] == "TIME") {
                        $campos = busca_filtro_tabla($campo, $datos[0]["nombre_tabla"], $llave . "=" . $iddoc, "", $conn);
                    } else {
                        $campos = busca_filtro_tabla(fecha_db_obtener($campo, $formato_fecha) . " as $campo", $datos[0]["nombre_tabla"], $llave . "=" . $iddoc, "", $conn);
                    }
                } else {
                    $campos = busca_filtro_tabla($campo, $datos[0]["nombre_tabla"], $llave . "=" . $iddoc, "", $conn);
                }
                if ($campos["numcampos"]) {

                    if ($datos[0]["etiqueta_html"] == "arbol") {
                        $tipo_arbol = explode(";", $datos[0]["valor"]);
                        $idcampo = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre like '$campo' and formato_idformato=" . $idformato, "", $conn);
                        $retorno = mostrar_seleccionados($idformato, $idcampo[0][0], $tipo_arbol[6], $iddoc, 1);
                    } elseif ($datos[0]["etiqueta_html"] == "arbol_fancytree") {
                        $idcampo = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre like '$campo' and formato_idformato=" . $idformato, "", $conn);
                        $retorno = mostrar_seleccionados_ft($idformato, $idcampo[0][0], $iddoc, 1);
                    } elseif ($datos[0]["etiqueta_html"] == "archivo") {
                        include_once("../../anexosdigitales/funciones_archivo.php");
                        $idcampo = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre like '$campo' and formato_idformato=" . $idformato, "", $conn);
                        $retorno = listar_anexos_ver_descargar($idformato, $iddoc, $idcampo[0][0], $_REQUEST["tipo"], 1);
                    } elseif ($datos[0]["etiqueta_html"] == "autocompletar") {
                        $retorno = $campos[0][0];
                    } elseif (preg_match("/textarea/", $datos[0]["etiqueta_html"])) {
                        $retorno = $campos[0][0];
                    } elseif ($datos[0]["etiqueta_html"] == "link" && basename($_SERVER["PHP_SELF"]) == basename($datos[0]["ruta_mostrar"])) {
                        $retorno = "<a target='_blank' href='" . $campos[0][0] . "'>" . $campos[0][0] . "</a>";
                    } elseif ($datos[0]["etiqueta_html"] == "valor" && strpos($_SERVER["PHP_SELF"], "edit") === false) {
                        $retorno = "$" . number_format($campos[0][$campo], 0, ",", ".");
                    } elseif ($datos[0]["etiqueta_html"] == "moneda") {
                        $retorno = "$" . $campos[0][$campo];
                    } elseif ($datos[0]["etiqueta_html"] == "ejecutor") {

                        if (basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_adicionar"]) && basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_editar"])) {
                            if ($datos[0]["valor"] == "") {
                                $parametros = array("multiple", "nombre,identificacion", "");
                            } else {
                                $parametros = explode("@", $datos[0]["valor"]);
                            }
                            $ejecutores = busca_filtro_tabla("", "ejecutor,datos_ejecutor", "ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(" . $campos[0][$campo] . ")", "", $conn);
                            if ($parametros[3] != "") {
                                include_once($ruta_db_superior . "/formatos/librerias/funciones_ejecutor.php");
                                $retorno .= llamado_ejecutor($parametros[3], $campo, $idformato, $iddoc);
                            } else {
                                $vector_mostrar = array("nombre");
                                foreach ($vector_mostrar as $fila_e) {
                                    for ($h = 0; $h < $ejecutores["numcampos"]; $h++) {
                                        if ($fila_e == "ciudad") {
                                            if ($ejecutores[$h][$fila_e]) {
                                                $ciudad = busca_filtro_tabla("nombre", "municipio", "idmunicipio=" . $ejecutores[$h][$fila_e], "", $conn);
                                                $datos_mostrar[$h][$fila_e] = $ciudad[0][0];
                                            } else {
                                                $datos_mostrar[$h][$fila_e] = "&nbsp;";
                                            }
                                        } else {
                                            $datos_mostrar[$h][$fila_e] = $ejecutores[$h][$fila_e];
                                        }
                                    }
                                }
                                if ($parametros[0] == "unico") {
                                    if ($parametros[4] == "1") {
                                        $retorno .= "<table>";
                                        foreach ($datos_mostrar[0] as $nombre => $fila) {
                                            if ($fila != "")
                                                $retorno .= "<tr><td>" . ucfirst($nombre) . ":</td><td>" . $fila . "</td></tr>";
                                        }
                                        $retorno .= "</table>";
                                    } else {
                                        $retorno = implode(", ", array_values($datos_mostrar[0]));
                                    }
                                } elseif ($parametros[0] == "multiple") {
                                    if ($parametros[4] == "1") {
                                        $retorno .= "<table border='1' width=100% style='border-collapse:collapse'>";
                                        $retorno .= "<tr align='center' bgcolor='lightgray' style='text-transform:capitalize'><td>" . implode("&nbsp;</td><td>", array_keys($datos_mostrar[0])) . "</td></tr><tr>";
                                        for ($h = 0; $h < count($datos_mostrar); $h++) {
                                            $retorno .= "<td>" . implode("&nbsp;</td><td>", array_values($datos_mostrar[$h])) . "</td>";
                                            $retorno .= "</tr>";
                                        }
                                        $retorno .= "</table>";
                                    } else {
                                        for ($h = 0; $h < count($datos_mostrar); $h++) {
                                            $retorno .= str_replace(", ,", "", implode(", ", array_values($datos_mostrar[$h])) . "<br />");
                                        }
                                    }
                                }
                            }
                        } else {
                            $retorno = $campos[0][$campo];
                        }
                    } else {
                        $retorno = formatea_campo($campos[0][$campo], $datos[0]["etiqueta_html"], $datos[0]["valor"], $datos[0]["opciones"]);
                    }
                }
                if (preg_match("/textarea/", $datos[0]["etiqueta_html"])) {
                    $retorno = stripslashes($retorno);
                } else {
                    $retorno = str_replace('"', "", stripslashes($retorno));
                }
                if ($_REQUEST["tipo"] != 5 && basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_editar"])) {
                    $retorno = str_replace("<p><!-- pagebreak --></p>", "<!-- pagebreak -->", $retorno);
                    $retorno = str_replace("<!-- pagebreak -->", "<div class='page_break'></div>", $retorno);
                } else if (basename($_SERVER["PHP_SELF"]) != basename($datos[0]["ruta_editar"])) {
                    $conf = busca_filtro_tabla("", "configuracion a", "a.nombre='exportar_pdf'", "", $conn);
                    if ($conf[0]["valor"] == "html2ps") {
                        $retorno = str_replace("<!-- pagebreak -->", '<pagebreak/>', $retorno);
                    } else if ($conf[0]["valor"] == "class_impresion") {
                        $retorno = str_replace("<!-- pagebreak -->", '<br pagebreak="true"/>', $retorno);
                    } else {
                        $retorno = str_replace("<!-- pagebreak -->", '<pagebreak/>', $retorno);
                    }
                }
                if ($tipo == null) {
                    echo (stripslashes($retorno));
                    return;
                }
                return (stripslashes($retorno));
            }
        }

        /*
 * <Clase>
 * <Nombre>formatea_campo</Nombre>
 * <Parametros>$valor:dato guardado en el campo;$tipo:etiqueta html;$llenado:parametros de configuracion del campo</Parametros>
 * <Responsabilidades>Formatea el valor segun el tipo del campo y su etiqueta html<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function formatea_campo($valor, $tipo, $llenado, $opciones)
        {
            global $conn;
            $resultado = array();
            $valores = explode(",", $valor);
            $select = array();
            if ($llenado != "" && strpos($llenado, "*}") === false) {
                if (strpos(strtoupper($llenado), "SELECT") !== false) {
                    if ($tipo != "dependientes") {
                        $valor2 = ejecuta_filtro_tabla($llenado, $conn);
                        for ($i = 0; $i < $valor2["numcampos"]; $i++) {
                            foreach ($valores as $fila) {
                                if ($valor2[$i]["id"] == $fila) {
                                    $resultado[] = $valor2[$i]["nombre"];
                                }
                            }
                        }
                    } else {
                        $llenado = html_entity_decode($llenado);
                        $parametros = explode("|", $llenado);
                        $select = explode(";", $parametros[count($parametros) - 1]);
                        $cuerpo = substr($select[1], 0, strpos($select[1], "where"));
                        preg_match("/(\w+) as id/", strtolower($select[1]), $llave);
                        $sql_datos = $cuerpo . " where " . $llave[1] . " in(" . $valor . ")";
                        $datos = ejecuta_filtro_tabla($sql_datos, $conn);
                        $valores = array();
                        for ($j = 0; $j < $datos["numcampos"]; $j++) {
                            $valores[] = $datos[$j]["nombre"];
                        }

                        if ($datos["numcampos"]) {
                            return (implode(", ", $valores));
                        } else {
                            return ("");
                        }
                    }
                } else {

                    $llenado = json_decode($opciones, true);
                    if ($llenado) {
                        if ($tipo == 'radio' || $tipo == 'select') {
                            return recursiveFind($llenado, $valor);
                        } else if ($tipo == 'checkbox') {
                            $valoresCheck = explode(",", $valor);
                            $cantidadCheck = count($valoresCheck);
                            $valoresMarcados = [];
                            for ($i = 0; $i < $cantidadCheck; $i++) {
                                $valoresMarcados[] = recursiveFind($llenado, $valoresCheck[$i]);
                            }
                            $valoresMarcados = implode(",", $valoresMarcados);
                            return $valoresMarcados;
                        } else {
                            $resultado[0] = $valor;
                        }
                    }
                }
                return implode(", ", $resultado);
            }
            return $valor;
        }

        function recursiveFind(array $haystack, $needle)
        {
            foreach ($haystack as $key => $value) {
                if ($value['llave'] == $needle) {
                    return $value['item'];
                    break;
                }
            }
        }

        /*
 * <Clase>
 * <Nombre>asignar_responsables</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Muestra los campos en el formulario para elegir si deben firmar una o varias personas<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function asignar_responsables($campo, $idformato, $iddoc = null)
        {
            global $conn;

            $campo = '<div class="form-group" id="tr_asignar_responsables">
                <label title="">ASIGNAR RESPONSABLES</label>
                        <div class="radio radio-success">
                            <input  type="radio" name="firmado" id="una" value="una" checked="" aria-required="true">
                            <label class="etiqueta_selector" for="una">Uno</label>
                            <input  type="radio" name="firmado" id="varias" value="varias" aria-required="true">
                            <label class="etiqueta_selector" for="varias">Varios</label>
                        </div>
            </div>';
            $nombre = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . usuario_actual("funcionario_codigo"), "", $conn);
            $responsable = html_entity_decode($nombre[0]["nombres"] . " " . $nombre[0]["apellidos"]);
            $responsable = strtoupper($responsable);
            $campo .= '<div class="form-group" id="tr_firma">
                <label title="">' . $responsable . ' FIRMA:</label>
                    <div class="radio radio-success">
                        <input class="form-check-input" type="radio" name="obligatorio" id="si1" value="1" aria-required="true">
                        <label class="etiqueta_selector" for="si1">Si</label>
                        <input class="form-check-input" type="radio" name="obligatorio" id="no1" value="0" checked aria-required="true">
                        <label class="etiqueta_selector" for="no1">No</label>
                    </div>
            </div>';
            $campo .= '<script type="text/javascript">
                $("#una").click(function(){
                    $("#si1").attr("checked","checked");
                    $("#tr_firma").hide();
                });
                $("#varias").click(function(){
                    $("#tr_firma").show();
                });
            </script>';
            echo ($campo);
        }

        /*
 * <Clase>
 * <Nombre>mostrar_imagenes</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Muestra en el formulario los campos para configurar si se muestran las imagenes de las firmas despues de confirmar y si se muestran el encabezado y pie de pagina<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function mostrar_imagenes($idformato, $campo, $iddoc = null)
        {
            global $conn;
            if ($iddoc != null) {
                $tabla = busca_filtro_tabla("nombre_tabla", "formato", "idformato=$idformato", "", $conn);
                $datos = busca_filtro_tabla("firma,encabezado", $tabla[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "", $conn);
            } else {
                $datos[0]["encabezado"] = 1;
                $datos[0]["firma"] = 1;
            }
            echo '<tr>
      <td class="encabezado" width="21%">MOSTRAR FIRMAS DIGITALIZADAS:</td>
      <td width="79%" bgcolor="#F5F5F5">
      <input type="radio" name="firma" id="si" value="1" ';
            if ($datos[0]["firma"] == 1)
                echo " checked ";
            echo '><label for="si">Si</label>
      <input type="radio" name="firma" id="no" value="0" ';
            if ($datos[0]["firma"] == 0)
                echo " checked ";
            echo '><label for="no">No</label>
      </td>
    </tr>
    <tr>
      <td class="encabezado" width="21%">MOSTRAR ENCABEZADO:</td>
      <td width="79%" bgcolor="#F5F5F5">
      <input type="radio" name="encabezado" id="esi" value="1" ';
            if ($datos[0]["encabezado"] == 1)
                echo " checked ";
            echo '><label for="esi">Si</label>
      <input type="radio" name="encabezado" id="eno" value="0" ';
            if ($datos[0]["encabezado"] == 0)
                echo " checked ";
            echo '><label for="eno">No</label>
      </td>
    </tr>';
        }

        /*
 * <Clase>
 * <Nombre>submit_formato</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Crea la parte del formato que lleva el boton de continuar, configura el tipo de radicado y la acci�n a seguir dependiendo del formato en que se est� (adicionar/editar)<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

        function submit_formato($formato, $iddoc = null)
        {
            global $conn, $ruta_db_superior;
            if (@$_REQUEST["idpaso_documento"]) {
                echo '<input type="hidden" name="idpaso_documento" value="' . $_REQUEST["idpaso_documento"] . '">';
            }
            if (isset($_REQUEST["anterior"])) {
                echo '<input type="hidden" name="anterior" value="' . $_REQUEST["anterior"] . '">';
            }
            $datos_f = busca_filtro_tabla("item,nombre,nombre_tabla,contador_idcontador", "formato", "idformato=" . $formato, "", $conn);
            if ($iddoc == null || $datos_f[0]["item"]) {
                echo '<input type="hidden" name="funcion" value="radicar_plantilla">
    <input type="hidden" name="tabla" value="' . $datos_f[0]["nombre_tabla"] . '">
    <input type="hidden" name="formato" value="' . $datos_f[0]["nombre"] . '">';
                $contador = busca_filtro_tabla("nombre", "contador", "idcontador=" . $datos_f[0]["contador_idcontador"], "", $conn);
                if ($contador["numcampos"] && $datos_f[0]["nombre"] != "oficio_word") { //Oficio word tiene seleccion de contador
                    echo '<input type="hidden" id="tipo_radicado" name="tipo_radicado" value="' . $contador[0]["nombre"] . '">';
                }

                $codigo_js = 'history.go(-1);';
                if ($datos_f["numcampos"] && $datos_f[0]["item"]) {
                    if ($_REQUEST["pantalla"] == 'padre') {
                        if ($_REQUEST["padre"]) {
                            $datos_padre = busca_filtro_tabla("nombre,idformato", "formato", "idformato=" . $_REQUEST["idformato"], "", $conn);
                            if ($datos_padre["numcampos"]) {
                                $cadena = $ruta_db_superior . FORMATOS_CLIENTE . $datos_padre[0]["nombre"] . '/mostrar_' . $datos_padre[0]["nombre"] . '.php?iddoc=' . $_REQUEST["idpadre"] . '&idformato=' . $datos_padre[0]["idformato"];
                                $codigo_js = '<script type="text/javascript">function redirecciona_padre(){window.open("' . $cadena . '","_self");}</script>';
                                echo ($codigo_js);
                            }
                        }
                    }
                }

                if ($datos_f[0]["item"] == 1) {
                    echo ('<div class="col-md-9 form-group px-0 pt-3"><button class="btn btn-complete" item="1" id="continuar" value="Continuar">Continuar</button>');
                    echo ('<button class="btn btn-danger cancel" onClick="javascript:redirecciona_padre(); return false;" id="cancel" value="Cancelar" >Cancelar</button>');
                    echo ('<div>');
                } else {
                    echo ('<div class="col-md-9 form-group px-0 pt-3"><button class="btn btn-complete submit" type="submit" id="continuar" value="Continuar">Continuar</button>');
                    echo ('<div>');
                }
            } else {

                echo '
		<input type="hidden" name="iddoc" value="' . $iddoc . '">
    <input type="hidden" name="tabla" value="' . $datos_f[0]["nombre_tabla"] . '">
    <script>formulario_formatos.action="../librerias/modificar_plantilla.php";</script>
    <div class="col-md-9">
	   <input class="btn btn-complete submit" type="submit" id="continuar" value="Continuar">
     <div>';
            }
            ?>
                <script>
                    $(document).ready(function() {
                        $("#continuar").click(function() {
                            $("#formulario_formatos").validate({
                                ignore: [],
                                submitHandler: function(form) {
                                    $("#continuar").hide();
                                    $("#continuar").after(
                                        $('<button>', {
                                            class: 'btn btn-success',
                                            disabled: true,
                                            id: 'boton_enviando',
                                            text: 'Enviando...'
                                        })
                                    );

                                    if ($("#continuar").attr("item") == 1) {
                                        $.ajax({
                                            async: false,
                                            type: 'POST',
                                            url: "../../formatos/librerias/funciones_item.php",
                                            dataType: "json",
                                            data: $("#formulario_formatos").serialize(),
                                            success: function(data) {
                                                if (data.success) {
                                                    top.notification({
                                                        type: 'success',
                                                        message: data.message
                                                    });
                                                    top.successModalEvent(data);
                                                    if (data.refresh) {
                                                        $("#boton_enviando").attr("disabled",false).hide();
                                                        $("#formulario_formatos")[0].reset();
                                                        $("#continuar").show();
                                                    } else {
                                                        top.closeTopModal();
                                                    }
                                                } else {
                                                    top.notification({
                                                        type: 'error',
                                                        message: data.message
                                                    });
                                                }
                                            }
                                        });
                                        return false;
                                    } else {
                                        form.submit();
                                    }

                                },
                                invalidHandler: function() {
                                    $("#continuar").show();
                                    $("#boton_enviando").remove();
                                }
                            });
                        });
                    });
                </script>
                <?php

                }

                /*
 * <Clase>
 * <Nombre>validar_valor_campo</Nombre>
 * <Parametros>$campo:id del campo</Parametros>
 * <Responsabilidades>valida si el campo tiene un valor predeterminado por defecto y lo devuelve, valida si es un campo de autoguardado que se recupere el texto anterior, si es una respuesta y debe tomar la descripci�n del padre tambien la devuelve<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function validar_valor_campo($campo)
                {
                    global $conn, $sql, $ruta_db_superior;
                    $campos = busca_filtro_tabla("*", "campos_formato A", "A.idcampos_formato=" . $campo, "", $conn);
                    
                    $padre = Model::getQueryBuilder()
                        ->select(["cod_padre","banderas","nombre"])
                        ->from("formato")
                        ->where("idformato = :idformato")
                        ->setParameter(':idformato', $campos[0]["formato_idformato"])
                        ->execute()->fetchAll();

                    $acciones = explode(",", $campos[0]["acciones"]);
                    $banderas = explode(",", $padre[0]["banderas"]);

                    if ($campos[0]["autoguardado"]) {
                        $campos = busca_filtro_tabla("contenido", "autoguardado", "usuario='" . usuario_actual("funcionario_codigo") . "' and formato='" . $padre[0]["nombre"] . "' and campo='" . $campos[0]["nombre"] . "'", "", $conn);
                        return ($campos[0][0]);
                    } elseif (in_array('p', $acciones) && in_array('r', $banderas)) {
                        if (isset($_REQUEST["anterior"]) && $padre[0][0] == "0") {
                            $desc = busca_filtro_tabla("a.descripcion,a.numero,b.nombre,b.idformato", "documento a, formato b", "a.iddocumento=" . $_REQUEST["anterior"] . " and lower(a.plantilla)=b.nombre", "", $conn);
                            if ($desc[0]["nombre"] == 'radicacion_entrada') {
                                $radicado = $desc[0]["numero"];
                                return ("Respondiendo a: " . str_replace("<br />", " ", strip_tags($desc[0]["descripcion"])) . ". Radicado No." . $radicado);
                            } else if ($desc[0]["nombre"] == 'memorando') {
                                include_once($ruta_db_superior . FORMATOS_CLIENTE . "memorando/funciones.php");
                                $radicado = strip_tags(formato_radicado_interno($desc[0]["idformato"], $_REQUEST["anterior"], 1));
                                return ("Respondiendo a: " . str_replace("<br />", " ", strip_tags($desc[0]["descripcion"])) . ". Radicado No." . $radicado);
                            } else if ($desc[0]["nombre"] == 'carta') {
                                include_once($ruta_db_superior . FORMATOS_CLIENTE . "carta/funciones.php");
                                $radicado = strip_tags(formato_radicado_enviada($desc[0]["idformato"], $_REQUEST["anterior"], 1));
                                return ("Respondiendo a: " . str_replace("<br />", " ", strip_tags($desc[0]["descripcion"])) . ". Radicado No." . $radicado);
                            } else {
                                return ("Respondiendo a: " . str_replace("<br />", " ", strip_tags($desc[0]["descripcion"])) . ". Radicado No." . $desc[0]["numero"]);
                            }
                        }
                    } elseif ($campos["numcampos"]) {
                        if ($campos[0]["predeterminado"] != "")
                            return ($campos[0]["predeterminado"]);
                    } else
                        return ("");
                }

                /*
 * <Clase>
 * <Nombre>acciones_detalles</Nombre>
 * <Parametros>$formato:vector con la informaci�n formato;$idregistro:id del formato(idft_carta,idft_memorando...);$doc:id del documentod;$padre:no se usa</Parametros>
 * <Responsabilidades>Se imprimen los botones con las acciones disponibles para el documento que se est� procesando<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function acciones_detalles($formato, $idregistro, $doc, $padre)
                {
                    global $conn, $iddoc, $idformato;
                    $cadena = "";
                    $accion = array(
                        "ver",
                        "detalle"
                    );
                    for ($j = 0; $j < count($accion); $j++) {
                        $cadena .= '<td bgcolor="#F5F5F5" align="center">';
                        switch ($accion[$j]) {
                            case "editar":
                                $cadena .= '<a href="' . "../" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_editar"] . '?iddoc=' . $doc . '&anterior=' . $iddoc . '&formato=' . $idformato . '" target="detalles"><img src="../../botones/general/editar.png" alt="Editar"  border="0"></a>';
                                break;
                            case "ver":
                                $cadena .= '<a href="' . "../" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . '?iddoc=' . $doc . '&anterior=' . $iddoc . '&formato=' . $idformato . '" target="detalles"><img src="../../botones/general/ver.png" alt="Ver" border="0"></a>';
                                break;
                            case "eliminar":
                                $cadena .= '<a href="' . "../" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_eliminar"] . '?iddoc=' . $doc . '" target="detalles"><img src="../../botones/general/borrar.png" alt="Borrar" border="0"></a>';
                                break;
                            case "detalle":
                                $cadena .= '<a href="../../ordenar.php?key=' . $doc . '" target="centro"><img src="../../botones/general/editar.png" alt="Detalles" border="0"></a>';
                                break;
                            default:
                                break;
                        }
                        $cadena .= '</td>';
                    }
                    return ($cadena);
                }

                /*
 * tabla_formato = Nombre de la tabla del formato principal como nombre
 * formato_detalle = id del formato detalle que va a ser listado
 *
 */
                /*
 * <Clase>
 * <Nombre>buscar_listado_formato</Nombre>
 * <Parametros>$tabla_formato:nombre de la tabla;$formato_detalle:id del formato</Parametros>
 * <Responsabilidades>Busca los documentos de cierto tipo de formato y que sean hijos de cierto documento y lista los campos que est�n marcados como descripcion o detalle, llama la funci�n que pone los botones con las acciones para cada documento<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function buscar_listado_formato($tabla_formato, $formato_detalle)
                {
                    global $conn, $idformato, $sql, $iddoc;
                    include_once("estilo_formulario.php");
                    $campos = array();
                    $texto = "";
                    $formato = busca_filtro_tabla("", "formato", "idformato=" . $formato_detalle, "", $conn);
                    if ($formato["numcampos"] && $tabla_formato != "") {
                        $listado_detalles = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $formato_detalle . " AND (A.acciones LIKE '%d%' OR acciones LIKE '%p%')", "orden ASC", $conn);
                        if ($listado_detalles["numcampos"]) {
                            $texto .= '<table border="0" cellspacing="1" cellpadding="1" width="100%" bgcolor="#CCCCCC">
   <tr>';
                            for ($i = 0; $i < $listado_detalles["numcampos"]; $i++) {
                                $texto .= '<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">' . $listado_detalles[$i]["etiqueta"] . '</span></td>';
                                array_push($campos, "A." . $listado_detalles[$i]["nombre"]);
                            }
                            $listado = busca_filtro_tabla("A.documento_iddocumento," . implode(",", $campos), $formato[0]["nombre_tabla"] . " A, " . $tabla_formato . " B,documento C", "A." . $tabla_formato . "=B.id" . $tabla_formato . " and A.documento_iddocumento=C.iddocumento AND C.estado<>'ELIMINADO' AND B.documento_iddocumento=" . $iddoc, "A.documento_iddocumento DESC", $conn);
                            /* Se busca el formato que esat relacionado con */
                            if ($iddoc && $idformato) {
                                $enlace = '<br /><a href="../../responder.php?idformato=' . $formato_detalle . '&iddoc=' . $iddoc . '" target="detalles">Adicionar ' . $formato[0]["etiqueta"] . '</a>';
                            }
                            $texto .= '<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ver</span></td><td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Detalles</span></td>';
                            $texto .= "</tr>";
                            for ($j = 0; $j < $listado["numcampos"]; $j++) {
                                $texto .= "<tr>";
                                // $listado[$j][$listado_detalles[$i]["nombre"]]
                                for ($i = 0; $i < $listado_detalles["numcampos"]; $i++) {
                                    $texto .= "<td bgcolor='#F5F5F5'><span class='phpmaker'>" . mostrar_valor_campo($listado_detalles[$i]["nombre"], $formato_detalle, $listado[$j]["documento_iddocumento"], 1) . "</span></td>";
                                }
                                $texto .= acciones_detalles($formato, $listado[$j]["id" . $formato[0]["nombre_tabla"]], $listado[$j]["documento_iddocumento"], $papa);
                                $texto .= "</tr>";
                            }
                            $texto .= "</table>";
                        } else {
                            $listado = busca_filtro_tabla("B.id" . $formato[0]["nombre_tabla"], "" . $tabla_formato . " A," . $formato[0]["nombre_tabla"] . " B", "A.documento_iddocumento=" . $iddoc . " AND A.id" . $formato[0]["nombre_tabla"] . " IN( B.id" . $formato[0]["nombre_tabla"] . ")", "", $conn);
                            $texto .= '<table border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
   <tr>';
                            $texto .= '<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">id ' . $formato[0]["nombre_tabla"] . '</span></td>';
                            $texto .= '<tr>';
                            if ($listado["numcampos"]) {
                                for ($i = 0; $i < $listado["numcampos"]; $i++) {
                                    $texto .= "<td bgcolor='#F5F5F5'><span class='phpmaker'>" . $listado[$i][0] . "</span></td>";
                                }
                            } else
                                $texto .= "<td>No existe detalle</td>";
                            $texto .= "</tr></table>";
                        }
                        echo ($enlace . $texto);
                    }
                }

                /*
 * <Clase>
 * <Nombre>datos_base_formato</Nombre>
 * <Parametros>$formato:vector con los datos de un formato</Parametros>
 * <Responsabilidades>Muestra los datos principales de cierto documento<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function datos_base_formato($formato)
                {
                    global $conn, $idformato, $iddoc;
                    if ($formato["numcampos"]) {
                        $campos = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $idformato . " AND (acciones LIKE '%d%' OR acciones LIKE '%p%')", "orden ASC", $conn);
                        if ($campos["numcampos"]) {
                            $cadena = '<table border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">';
                            for ($i = 0; $i < $campos["numcampos"]; $i++) {
                                $cadena .= '<tr><td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">' . $campos[$i]["etiqueta"] . '</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">' . mostrar_valor_campo($campos[$i]["nombre"], $idformato, $iddoc, 1) . '</span></td></tr>';
                            }
                            $cadena .= '</table>';
                        }
                        return ($cadena);
                    }
                }

                /*
 * <Clase>
 * <Nombre>cargar_seleccionados</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento;$tipo:indica si el resultado se retorna o se imprime</Parametros>
 * <Responsabilidades>devuelve el valor guardado en cierto campo de cierto formato elegido<Responsabilidades>
 * <Notas>Se utiliza en los campos que tiene arboles para cargar el valor que ya estaba seleccionados a la hora de editar</Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function cargar_seleccionados($idformato, $idcampo, $tipo = 1, $iddoc)
                {
                    global $conn;
                    $texto = "";
                    $vector = array();
                    $campo = busca_filtro_tabla("", "campos_formato", "idcampos_formato=$idcampo", "", $conn);
                    if ($iddoc != null) {
                        $tabla = busca_filtro_tabla("nombre_tabla,item", "formato", "idformato=$idformato", "", $conn);
                        if ($tabla[0]["item"])
                            $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "id" . $tabla[0]['nombre_tabla'] . "=" . $iddoc, "", $conn);
                        else
                            $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "documento_iddocumento=" . $iddoc, "", $conn);
                        // print_r($valor);
                        if ($valor["numcampos"]) {
                            if ($tipo) {
                                echo ($valor[0][0]);
                                return;
                            }
                        }
                    }
                    echo ($texto);
                }

                /*
 * <Clase>
 * <Nombre>mostrar_seleccionados</Nombre>
 * <Parametros>$idformato:id del formato;$idcampo:id del campo;$iddoc:id del documento;$tipo_arbol:3-muestra el valor que hay guardado,1-para arbol de series,0-para arbol de funcionarios,2-para arbol de dependencias</Parametros>
 * <Responsabilidades>Para el editar de los campos que son de tipo arbol, muestra la lista de elementos seleccionados actualmente<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function mostrar_seleccionados($idformato, $idcampo, $tipo_arbol, $iddoc, $tipo = 0)
                {
                    global $conn;
                    $campo = busca_filtro_tabla("nombre,valor", "campos_formato", "idcampos_formato=" . $idcampo, "", $conn);
                    $nombres = array();
                    if ($iddoc != null) {
                        $tabla = busca_filtro_tabla("nombre_tabla,item", "formato", "idformato=" . $idformato, "", $conn);
                        if ($tabla[0]["item"]) {
                            $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "id" . $tabla[0]['nombre_tabla'] . "=" . $iddoc, "", $conn);
                        } else {
                            $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "documento_iddocumento=" . $iddoc, "", $conn);
                        }
                        $ok = 0;
                        if (preg_match("/.*nombre_campo=([^&]+)/", $campo[0]["valor"], $nom_campo)) {
                            $ok = 1;
                            $nombre_campo = $nom_campo[1];
                        }
                        $vector = explode(",", str_replace("#", "d", $valor[0][0]));
                        $vector = array_unique($vector);
                        sort($vector);

                        foreach ($vector as $fila) {
                            switch ($tipo_arbol) {
                                case 0:
                                    //Funcionarios
                                    if (strpos($fila, 'd') > 0) {
                                        $datos = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . str_replace("d", "", $fila), "", $conn);
                                        if ($datos["numcampos"]) {
                                            $nombres[] = $datos[0]["nombre"];
                                        }
                                    } else {
                                        if ($pos = strpos($fila, "_")) {
                                            $fila = substr($fila, 0, $pos);
                                        }
                                        if ($ok) {
                                            $datos = busca_filtro_tabla($nombre_campo, "funcionario", "funcionario_codigo=" . $fila, "", $conn);
                                            if ($datos["numcampos"]) {
                                                $nombres[] = ucwords($datos[0][0]);
                                            }
                                        } else {
                                            $datos = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $fila, "", $conn);
                                            if ($datos["numcampos"]) {
                                                $nombres[] = ucwords($datos[0]["nombres"] . " " . $datos[0]["apellidos"]);
                                            }
                                        }
                                    }
                                    break;
                                case 1:
                                    //Series
                                    if ($ok) {
                                        $datos = busca_filtro_tabla($nombre_campo, "serie", "idserie=" . $fila, "", $conn);
                                    } else {
                                        $datos = busca_filtro_tabla("nombre", "serie", "idserie=" . $fila, "", $conn);
                                    }
                                    if ($datos["numcampos"]) {
                                        $nombres[] = ucwords($datos[0][0]);
                                    }
                                    break;
                                case 2:
                                    //Dependencia
                                    if ($ok) {
                                        $datos = busca_filtro_tabla($nombre_campo, "dependencia", "iddependencia=" . $fila, "", $conn);
                                    } else {
                                        $datos = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . $fila, "", $conn);
                                    }
                                    if ($datos["numcampos"]) {
                                        $nombres[] = ucwords($datos[0][0]);
                                    }
                                    break;
                                case 3:
                                    // Otros
                                    $nombres[] = $fila;
                                    break;
                                case 4:
                                    // valor de tabla cuando se llama a test_serie.php el unico campo que se puede mostrar de la tabla es nombre
                                    if ($campo["numcampos"]) {
                                        if (preg_match("/.*tabla=([^&]+)/", $campo[0]["valor"], $info_tabla)) {
                                            $tabla = $info_tabla[1];
                                            if ($ok) {
                                                $valor_tabla = busca_filtro_tabla($nombre_campo, $tabla, "id" . $tabla . " =" . $fila, "", $conn);
                                            } else {
                                                $valor_tabla = busca_filtro_tabla("nombre", $tabla, "id" . $tabla . " =" . $fila, "", $conn);
                                            }
                                            if ($valor_tabla["numcampos"]) {
                                                $nombres[] = $valor_tabla[0][0];
                                            }
                                        }
                                    }
                                    break;

                                case 5:
                                    //roles
                                default:
                                    if (strpos($fila, 'd') > 0) {
                                        $datos = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . str_replace("d", "", $fila), "", $conn);
                                        if ($datos["numcampos"]) {
                                            $nombres[] = $datos[0]["nombre"];
                                        }
                                    } else {
                                        if ($pos = strpos($fila, "_")) {
                                            $fila = substr($fila, 0, $pos);
                                        }
                                        if ($ok) {
                                            $datos = busca_filtro_tabla($nombre_campo, "vfuncionario_dc", "iddependencia_cargo='" . $fila . "'", "", $conn);
                                            if ($datos["numcampos"]) {
                                                $nombres[] = ucwords($datos[0][0]);
                                            }
                                        } else {
                                            $datos = busca_filtro_tabla("nombres,apellidos,cargo", "vfuncionario_dc", "iddependencia_cargo='" . $fila . "'", "", $conn);
                                            if ($datos["numcampos"]) {
                                                $nombres[] = ucwords($datos[0]["nombres"] . " " . $datos[0]["apellidos"] . " - " . $datos[0]["cargo"]);
                                            }
                                        }
                                    }
                                    break;
                            }
                        }
                    }
                    if (count($nombres)) {
                        $nombres = implode(", ", $nombres);
                    } else {
                        $nombres = "";
                    }

                    if ($tipo) {
                        return ($nombres);
                    } else {
                        echo ($nombres);
                    }
                }

                function mostrar_seleccionados_ft($idformato, $idcampo, $iddoc, $tipo = 0)
                {
                    global $conn;
                    //$campo = busca_filtro_tabla("nombre,valor", "campos_formato", "idcampos_formato=" . $idcampo, "", $conn);
                    $campo = Model::getQueryBuilder()
                    ->select("nombre,valor")
                    ->from("campos_formato")
                    ->where("idcampos_formato= :idcampo")
                    ->setParameter(":idcampo",$idcampo)
                    ->execute()
                    ->fetchAll();

                    if ($iddoc != null) {
                        $opciones = array();
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $opciones = json_decode($campo[0]["valor"], true);
                        }
                        $tipo_arbol = null;
                        $output_array = array();
                        if (preg_match('/arbol_([^.]+)/', $opciones["url"], $output_array)) {
                            if (count($output_array) > 1) {
                                $tipo_arbol = $output_array[1];
                            }
                        }
                        $tabla = busca_filtro_tabla("nombre_tabla,item", "formato", "idformato=" . $idformato, "", $conn);
                        if ($tabla[0]["item"]) {
                            $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "id" . $tabla[0]['nombre_tabla'] . "=" . $iddoc, "", $conn);
                        } else {
                            $valor = busca_filtro_tabla($campo[0]["nombre"], $tabla[0]['nombre_tabla'], "documento_iddocumento=" . $iddoc, "", $conn);
                        }
                        $vector = explode(",", str_replace("#", "d", $valor[0][0]));
                        $vector = array_unique($vector);
                        sort($vector);
                        $nombres = array();
                        foreach ($vector as $fila) {
                            switch ($tipo_arbol) {
                                case "funcionario":
                                    //Funcionarios
                                    if ($fila) {
                                        $datos = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $fila, "", $conn);
                                        if ($datos["numcampos"]) {
                                            $nombres[] = ucwords($datos[0]["nombres"] . " " . $datos[0]["apellidos"]);
                                        }
                                    }
                                    break;
                                case "serie":
                                    //Series
                                    $datos = busca_filtro_tabla("nombre", "serie", "idserie=" . $fila, "", $conn);
                                    if ($datos["numcampos"]) {
                                        $nombres[] = ucwords($datos[0][0]);
                                    }
                                    break;
                                case "dependencia":
                                    //Dependencia
                                    $datos = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . $fila, "", $conn);
                                    if ($datos["numcampos"]) {
                                        $nombres[] = ucwords($datos[0][0]);
                                    }
                                    break;

                                case "cargo":
                                    // cargo
                                    $datos = busca_filtro_tabla("nombre", "cargo", "idcargo=" . $fila, "", $conn);
                                    if ($datos["numcampos"]) {
                                        $nombres[] = ucwords($datos[0][0]);
                                    }
                                    break;
                                    //roles
                            }
                        }
                    }
                    if (count($nombres)) {
                        $nombres = implode(", ", $nombres);
                    } else {
                        $nombres = "";
                    }

                    if ($tipo) {
                        return ($nombres);
                    } else {
                        echo ($nombres);
                    }
                }

                if (isset($_REQUEST["accion"])) {
                    $parametros = "";
                    if ($_REQUEST["parametros"])
                        $parametros = $_REQUEST["parametros"];
                    $parametros = stripslashes($parametros);
                    call_user_func_array($_REQUEST["accion"], explode(",", $parametros));
                }

                /*
 * <Clase>
 * <Nombre>numero_radicado</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Imprime el n�mero de radicado del documento<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function numero_radicado($idformato, $iddoc)
                {
                    global $conn;
                    $doc = busca_filtro_tabla("numero", "documento", "iddocumento=" . $iddoc, "", $conn);
                    if ($doc["numcampos"]) {
                        echo ($doc[0]["numero"]);
                    } else
                        echo ("0");
                }

                /*
 * <Clase>
 * <Nombre>foto_pagina</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Busca las imagenes escaneadas de un documento, muestra la miniatura de la primera y un enlace para verla en el tama�o real<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function foto_pagina($idformato, $iddoc)
                {
                    global $conn, $ruta_db_superior;
                    $foto = busca_filtro_tabla("consecutivo,imagen,ruta", "pagina", "id_documento=" . $iddoc, "pagina ASC LIMIT 0,1", $conn);
                    if ($foto["numcampos"]) {
                        echo ("<a href='../../comentario_mostrar.php?key=" . $iddoc . "&pag=" . $foto[0]["consecutivo"] . "' border='0' target='centro'><img src='../../" . $foto[0]["imagen"] . "'></a>");
                    } else
                        echo ("<a href='" . $ruta_db_superior . "paginaadd.php?key=" . $iddoc . "&no_menu=1'><img src='" . $ruta_db_superior . "imagenes/sin_foto.jpg'></a>");
                }

                /*
 * <Clase>
 * <Nombre>datos_usuario_documento</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Imprime el nombre y apellido del funcionario creador del formato<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function datos_usuario_documento($idformato, $iddoc)
                {
                    global $conn;
                    $datos = busca_filtro_tabla("A.nombres,A.apellidos", "funcionario A,documento B", "B.iddocumento=" . $iddoc . " AND B.ejecutor=A.funcionario_codigo", "", $conn);
                    if ($datos["numcampos"]) {
                        echo ($datos[0]["nombres"] . " " . $datos[0]["apellidos"]);
                    } else
                        echo ("&nbsp;");
                }

                /*
 * <Clase>
 * <Nombre>listar_select_padres</Nombre>
 * <Parametros>$tabla:nombre de la tabla donde se guardan los datos de ese tipo de formato</Parametros>
 * <Responsabilidades>Busca todos los documentos de cierto tipo de formato y los lista en un select<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function listar_select_padres($tabla)
                {
                    global $conn;

                    if (!@$_REQUEST["anterior"]) {
                        $listado = busca_filtro_tabla("A.*, B.numero AS nombre_doc", $tabla . " A, documento B", "A.documento_iddocumento=B.iddocumento AND B.numero<>0", "", $conn);

                        if ($listado["numcampos"]) {
                            $campos = busca_filtro_tabla("A.nombre", "campos_formato A,formato B", "A.formato_idformato=B.idformato AND B.nombre_tabla LIKE'" . $tabla . "' AND acciones LIKE '%p%'", "orden", $conn);

                            $etiqueta = busca_filtro_tabla("etiqueta", "formato", "nombre_tabla like '$tabla'", "", $conn);

                            $nombres_campos = array();
                            for ($i = 0; $i < $campos["numcampos"]; $i++)
                                $nombres_campos[] = $campos[$i][0];
                            $valores = busca_filtro_tabla("A." . implode(",A.", $nombres_campos) . ",id$tabla", $tabla . " A,documento B", "A.documento_iddocumento=B.iddocumento AND B.numero<>0", "A." . implode(",A.", $nombres_campos), $conn);
                            // $etiqueta=substr(str_replace("_"," ",$tabla),2);

                            echo ('<tr ><td class="encabezado">' . strtoupper($etiqueta[0][0]) . '</td><td bgcolor="#F5F5F5">');
                            echo ('<select name="' . $tabla . '" obligatorio="obligatorio">');
                            for ($i = 0; $i < $valores["numcampos"]; $i++) { {
                                    $mostrar = array_values($valores[$i]);
                                    $mostrar = array_unique($mostrar);
                                    $mostrar = implode(" ", $mostrar);
                                    $mostrar = str_replace(" " . $valores[$i]["id" . $tabla], "", $mostrar);
                                    $mostrar = delimita(strip_tags($mostrar), 100);
                                    echo ('<option value="' . $valores[$i]["id" . $tabla] . '" >' . $mostrar . '</option>');
                                }
                            }
                            echo ("</td></tr>");
                        } else {
                            alerta("No es posible asociar este Formato con el padre");
                            volver(1);
                        }
                    }
                }

                /*
 * <Clase>
 * <Nombre>listado_100</Nombre>
 * <Parametros>$idforma:id del formato;$idcampo:id del campo</Parametros>
 * <Responsabilidades>Crea un listado del 0-100 en un campo tipo select con el nombre del campo especificado<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function listado_100($idforma, $idcampo)
                {
                    global $conn;
                    $ncampo = busca_filtro_tabla("", "campos_formato", "idcampos_formato=" . $idcampo, "", $conn);
                    if ($ncampo["numcampos"]) {
                        echo ('<td><select name="' . $ncampo[0]["nombre"] . '">');
                        for ($i = 0; $i < 101; $i++) {
                            echo ('<option value="' . $i . '">' . $i . '</option>');
                        }
                        echo ('</select></td>');
                    }
                }

                /*
 * <Clase>
 * <Nombre>listar_tareas</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Busca todas las tareas de nombre 'mantenimiento' relacionadas con el documento y las lista en una tabla<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function listar_tareas($idformato, $iddoc)
                {
                    global $conn;
                    $ltareas = busca_filtro_tabla("", "tarea A,asignacion B,asignacion_entidad C", "C.asignacion_idasignacion=B.idasignacion AND A.idtarea=B.tarea_idtarea AND A.nombre='mantenimiento' AND B.documento_iddocumento=" . $iddoc, "fecha_inicial DESC", $conn);
                    if ($ltareas["numcampos"]) {
                        echo ('<table width="100%">');
                        echo ('<tr class="encabezado_list"><td>Descripcion </td><td>Estado Tarea</td><td>Fecha Inicial</td><td>Fecha Vencimiento</td></tr>');
                        for ($i = 0; $i < $ltareas["numcampos"]; $i++) {
                            echo ('<tr><td>' . $ltareas[$i]["descripcion"] . '</td><td>' . $ltareas[$i]["estado"] . '</td><td>' . $ltareas[$i]["fecha_inicial"] . '</td><td>' . $ltareas[$i]["fecha_final"] . '</td></tr>');
                        }
                        echo ('</table><br /><br />');
                    }
                }

                function listar_formato_hijo($campos, $tabla, $campo_enlace, $llave, $orden, $alinear = 'center', $condicion = '')
                {
                    global $conn, $idformato;
                    $texto = "";
                    $where = "";
                    if (count($campos)) {
                        $where .= " AND A.nombre IN('" . implode("','", $campos) . "')";
                    }
                    $lcampos = busca_filtro_tabla("A.*,B.idformato", "campos_formato A,formato B", "B.nombre_tabla LIKE '" . $tabla . "' AND A.formato_idformato=B.idformato" . $where, "A.orden", $conn);
                    $hijo = busca_filtro_tabla("a.*", $tabla . " a,documento d", "documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and " . $campo_enlace . "=" . $llave . $condicion, $orden, $lcampos);

                    if ($hijo["numcampos"] && $lcampos["numcampos"]) {
                        $texto = '<table bordercolor="black" style="border-collapse:collapse" border="1" width="100%"><tr class="encabezado_list">';
                        for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
                            $texto .= '<td style="font-size:10pt;">' . $lcampos[$j]["etiqueta"] . "</td>";
                        }
                        $texto .= "</tr>";
                        for ($i = 0; $i < $hijo["numcampos"]; $i++) {
                            $texto .= '<tr class="celda_transparente" style="font-size:10pt;">';
                            for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
                                $texto .= '<td align="center">' . mostrar_valor_campo($lcampos[$j]["nombre"], $lcampos[$j]["formato_idformato"], $hijo[$i]["documento_iddocumento"], 1) . "</td>";
                            }
                            $texto .= '</tr>';
                        }
                        $texto .= '</table>';
                    }

                    return ($texto);
                }

                /*
 * <Clase>
 * <Nombre>formato_nombre</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento;$tipo:indica si la imprime o la retorna</Parametros>
 * <Responsabilidades>Busca la etiqueta de un formato<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function formato_nombre($idformato, $iddoc, $tipo = null)
                {
                    $formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
                    if ($formato["numcampos"]) {
                        if ($tipo)
                            return ($formato[0]["etiqueta"]);
                        else
                            echo ($formato[0]["etiqueta"]);
                    }
                }

                /*
 * <Clase>
 * <Nombre>diferencia_inicial_respuesta</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Busca las respuestas al documento actual y calcula la diferencia de tiempo entre la fecha de aprobaci�n del documento inicial y la fecha de creaci�n de sus respuestas, imprime los datos mas relevantes en pantalla<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function diferencia_inicial_respuesta($idformato, $iddoc)
                {
                    global $conn;
                    $tiempo_origen = busca_filtro_tabla("respuesta.*,documento.fecha AS fecha_aprob", "respuesta,documento", "origen=iddocumento AND origen=" . $iddoc, "", $conn);
                    if ($tiempo_origen) {
                        for ($i = 0; $i < $tiempo_origen["numcampos"]; $i++) {
                            $tiempo_respuesta = busca_filtro_tabla("A.*,B.nombre,B.ruta_mostrar", "documento A,formato B", "A.plantilla=B.nombre AND A.iddocumento=" . $tiempo_origen[$i]["destino"], "", $conn);
                            if ($tiempo_respuesta["numcampos"]) {

                                $diferencia = ejecuta_filtro("SELECT DATEDIFF('" . $tiempo_origen[$i]["fecha_aprob"] . "','" . $tiempo_respuesta[0]["fecha"] . "') AS dif_dias, TIMEDIFF('" . $tiempo_respuesta[0]["fecha"] . "','" . $tiempo_origen[$i]["fecha_aprob"] . "') AS dif_horas", $conn);
                                if ($diferencia["numcampos"]) {
                                    $tiempo = explode(":", $diferencia["dif_horas"]);
                                    echo ('<a href="' . PROTOCOLO_CONEXION . RUTA_PDF . '/formatos/' . $tiempo_respuesta[0]["nombre"] . '/' . $tiempo_respuesta[0]["ruta_mostrar"] . '?iddoc=' . $tiempo_respuesta[0]["iddocumento"] . '" target="_black">ver respuesta</a>&nbsp;');
                                    if ($tiempo_respuesta[0]["estado"] == 'ACTIVO') {
                                        echo ("<b>(documento por aprobar)</b><br />");
                                    }
                                    echo ("<br /><b>Fecha Inicial:</b> " . $tiempo_origen[$i]["fecha_aprob"] . "<br /><b>Fecha Respuesta:</b> " . $tiempo_respuesta[0]["fecha"] . "<br /><b>Diferencia:</b> " . $diferencia["dif_dias"] . "-D,  " . abs($tiempo[0]) . "-H, " . abs($tiempo[1]) . "-M, " . abs($tiempo[2]) . "-S<hr />");
                                }
                            }
                        }
                    } else {
                        echo ("<b>El documento no posee respuesta.</b>");
                    }
                    /*
     * <Clase>
     * <Nombre>reportar_respuesta</Nombre>
     * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
     * <Responsabilidades>Busca si el documento actual es respuesta de otro y si es as� le transfiere el documento actual a la persona que cre� el documento del cual es respuesta<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */
                }

                function reportar_respuesta($idformato, $iddoc)
                {
                    global $conn;
                    $respuesta = busca_filtro_tabla("origen", "respuesta", "destino=$iddoc", "", $conn);
                    if ($respuesta["numcampos"]) {
                        $origen = busca_filtro_tabla("", "documento", "iddocumento=" . $respuesta[0]["origen"], "", $conn);
                        if ($origen["numcampos"]) {
                            $datos["archivo_idarchivo"] = $iddoc;
                            $datos["nombre"] = "TRANSFERIDO";
                            $datos["tipo_destino"] = 1;
                            $datos["tipo"] = "";
                            transferir_archivo_prueba($datos, array(
                                $origen[0]["ejecutor"]
                            ), "");
                        }
                    }
                }

                function mostrar_firma_funcionario($func, $fechadoc, $retorno = 0)
                {
                    global $conn;
                    $ancho_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='ancho_firma'", "", $conn);
                    if (!$ancho_firma["numcampos"])
                        $ancho_firma[0]["valor"] = 200;
                    $alto_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='alto_firma'", "", $conn);
                    if (!$alto_firma["numcampos"])
                        $alto_firma[0]["valor"] = 100;
                    $func = busca_filtro_tabla("nombres,apellidos,firma,funcionario_codigo", "funcionario", "funcionario_codigo=" . $func, "", $conn);

                    $cargo = cargos_memo($func[0]["funcionario_codigo"], $fechadoc, "de", 1);

                    if ($func["firma"] != "") {
                        $texto = '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF . '/formatos/librerias/mostrar_foto.php?codigo=' . $func[0]["funcionario_codigo"] . '" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '"/>';
                    } else {
                        $texto = '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF . '/assets/images/firmas/blanco.jpg" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '" >';
                    }
                    $texto .= "<br /><b>" . mayusculas($func[0]["nombres"] . " " . $func[0]["apellidos"]) . "</b><br />" . $cargo;

                    if ($retorno)
                        return $texto;
                    else
                        echo $texto;
                }

                /*
 * <Clase>
 * <Nombre>registrar_imagenes_documento</Nombre>
 * <Parametros>$idformato:id del formato;
 * $iddoc:id del documento
 * $campo : Nombre del campo de la tabla donde se necesita modificar el contenido
 * </Parametros>
 * <Responsabilidades>
 * Se encarga de pasar la imagen temporal del tiny a la carpeta fuera de saia1.06 imagenes_documentos/año/iddoc/nombreimagen.extension
 * <Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function registrar_imagenes_documento($idformato, $iddoc, $campo)
                {
                    global $conn;
                    $max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
                    $ruta_db_superior = $ruta = "";
                    while ($max_salida > 0) {
                        if (is_file($ruta . "db.php")) {
                            $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
                        }
                        $ruta .= "../";
                        $max_salida--;
                    }

                    if ($iddoc == '')
                        $iddoc = $_REQUEST["iddoc"];

                    $formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
                    $contenido = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
                    $cadena = $contenido[0][$campo];

                    // --------------------------Creo el destino si no existe--------------------------
                    $atras = $ruta_db_superior . '../';

                    $destino = 'imagenes_documentos/' . date('Y') . '/' . $iddoc . '/';
                    if (!is_dir($atras . $destino))
                        crear_destino($atras . $destino);

                    $dir = 'images/' . usuario_actual("login") . '/';
                    if ($dh = @opendir($atras . $dir)) {
                        while (false !== ($obj = readdir($dh))) {
                            if ($obj == '.' || $obj == '..') {
                                continue;
                            }
                            rename($atras . $dir . $obj, $atras . $destino . $obj);
                            $reemplazo = str_replace($dir . $obj, $destino . $obj, $cadena);
                            $sql = "UPDATE " . $formato[0]["nombre_tabla"] . " set " . $campo . "='" . $reemplazo . "' WHERE documento_iddocumento=" . $iddoc;
                            phpmkr_query($sql);
                        }
                    }
                    closedir($dh);
                }

                function buscar_papa_formato_campo($idformato, $iddoc, $nombre_tabla, $campo)
                {
                    global $conn;
                    $formato = busca_filtro_tabla("nombre_tabla,idformato,cod_padre", "formato", "idformato=" . $idformato, "", $conn);

                    if ($formato["numcampos"]) {
                        $documento = busca_filtro_tabla("ft.*,d.estado,d.ejecutor,d.numero", $formato[0]["nombre_tabla"] . " ft,documento d", "d.iddocumento=ft.documento_iddocumento and ft.documento_iddocumento=" . $iddoc, "", $conn);

                        if ($formato[0]["nombre_tabla"] == $nombre_tabla && $documento["numcampos"]) {
                            return ($documento[0][$campo]);
                        } elseif ($formato[0]["cod_padre"] != '' && $formato[0]["cod_padre"] != 0) {
                            $papa = busca_filtro_tabla("", "formato", "idformato=" . $formato[0]["cod_padre"], "", $conn);
                            if ($papa["numcampos"]) {
                                $documento_papa = busca_filtro_tabla("", $papa[0]["nombre_tabla"], "id" . $papa[0]["nombre_tabla"] . "=" . $documento[0][$papa[0]["nombre_tabla"]], "", $conn);
                                if ($documento_papa["numcampos"]) {
                                    $doc = buscar_papa_formato_campo($papa[0]['idformato'], $documento_papa[0]["documento_iddocumento"], $nombre_tabla, $campo);
                                    // print_r($doc);
                                } else {
                                    return (0);
                                }
                            } else {
                                return (0);
                            }
                        } else {
                            return (0);
                        }
                    } else {
                        // alerta("ERROR EN EL FORMATO PRINCIPAL");
                        return (0);
                    }
                    return ($doc);
                }

                function formato_primero($idformato, $campo)
                {
                    global $conn;
                    $idformato_papa = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
                    if ($idformato_papa['numcampos']) {
                        if ($idformato_papa[0]['cod_padre'] == "") {
                            return ($idformato_papa[0][$campo]);
                        } else {
                            $dato = formato_primero($idformato_papa[0]['cod_padre'], $campo);
                        }
                    } else {
                        return (0);
                    }
                    return $dato;
                }

                function transferir_desde_papa($idformato, $iddoc, $destinos, $tipo, $notas = "")
                {
                    global $conn;

                    if ($tipo == "1") { // cuando es una lista de funcionarios fijos (roles)
                        $vector = explode("@", $destinos);
                    } elseif ($tipo == "2") { // cuando el listado se toma de un campo del formato (roles)
                        $formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
                        $dato = busca_filtro_tabla($destinos, $formato[0][0], "documento_iddocumento=" . $iddoc, "", $conn);
                        $vector = explode(",", @$dato[0][0]);
                    } elseif ($tipo == "3") { // cuando es una lista de funcionarios fijos (funcionario_codigo)
                        $vector = explode("@", $destinos);
                    }

                    foreach ($vector as $fila) {
                        if (strpos($fila, "#") === false) {
                            if ($tipo == 3) {
                                $lista = array(
                                    $fila
                                );
                            } else {
                                $codigos = busca_filtro_tabla("funcionario_codigo", "funcionario,dependencia_cargo", "funcionario_idfuncionario=idfuncionario and iddependencia_cargo=" . $fila, "", $conn);
                                $lista = array(
                                    $codigos[0]["funcionario_codigo"]
                                );
                            }
                        } else {
                            $lista = buscar_funcionarios(str_replace("#", "", $fila));
                        }
                    }

                    $ft_papa = formato_primero($idformato, 'nombre_tabla');
                    $idformato_papa = formato_primero($idformato, 'idformato');
                    $iddoc_papa = buscar_papa_formato($idformato, $iddoc, $ft_papa);
                    transferencia_automatica($idformato_papa, $iddoc_papa, implode("@", $lista), 3, $notas);
                }

                /**
                 * busca el iddocumento del primer
                 * papa en el proceso
                 *
                 * @param int $documentId iddocumento del documento actual
                 * @param int $exit numero de vuelta actual en la recursividad
                 * @return int iddocumento del papa
                 *
                 */
                function buscar_papa_primero($documentId, $exit = 0)
                {
                    global $conn;

                    if ($exit > 20) {
                        return false;
                    }

                    $documents = busca_filtro_tabla("B.cod_padre,B.nombre_tabla", "documento A, formato B", "lower(A.plantilla)=lower(B.nombre) AND B.cod_padre <> 0 AND iddocumento=" . $documentId, "", $conn);
                    if ($documents["numcampos"]) {
                        $parentFormat = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $documents[0]["cod_padre"], "", $conn);
                        $document = busca_filtro_tabla("B.documento_iddocumento", $documents[0]["nombre_tabla"] . " A," . $parentFormat[0]["nombre_tabla"] . " B", $parentFormat[0]["nombre_tabla"] . "=id" . $parentFormat[0]["nombre_tabla"] . " AND A.documento_iddocumento=" . $documentId, "", $conn);
                        return buscar_papa_primero($document[0]["documento_iddocumento"], ++$exit);
                    } else {
                        return $documentId;
                    }
                }

                /*
 * <Clase>
 * <Nombre>generar_ruta_documento</Nombre>
 * <Parametros>$iddoc:id del documento</Parametros>
 * <Responsabilidades>
 * Se encarga de generar la ruta de un documento de manera automatica.
 * <Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function generar_ruta_documento($idformato, $iddoc)
                {
                    global $conn;
                    $diagram_instance = busca_filtro_tabla('', 'paso_documento A, diagram_instance B', 'A.diagram_iddiagram_instance=B.iddiagram_instance AND A.documento_iddocumento=' . $iddoc, '', conn);
                    if ($diagram_instance["numcampos"]) {
                        $listado_pasos = busca_filtro_tabla("", "paso A, paso_actividad B, accion C", "B.estado=1 AND A.idpaso=B.paso_idpaso AND B.accion_idaccion=C.idaccion AND (C.nombre LIKE 'confirmar%' OR C.nombre LIKE 'aprobar%') AND A.diagram_iddiagram=" . $diagram_instance[0]["diagram_iddiagram"] . " AND B.paso_anterior=" . $diagram_instance[0]["paso_idpaso"], "", $conn);
                        $ruta = array();
                        // pasos_ruta se debe almacenar por medio de acciones si se va a confirmar, confirmar y firmar, aprobar o aprobar y firmar, confirmar y responsable, aprobar y responsable o confirmar y firma manual o confirmar y firma manual validar si se hace por medio del paso_actividad o por medio de la accion intencionalidad por medio del paso_actividad
                        for ($i = 0; $i < $listado_pasos["numcampos"]; $i++) {
                            array_push($ruta, array(
                                "funcionario" => -1,
                                "tipo_firma" => 1,
                                "paso_actividad" => $listado_pasos[$i]["idpaso_actividad"]
                            ));
                        }
                        if (count($ruta)) {
                            insertar_ruta($ruta, $iddoc, 0);
                        }
                    } else {
                        generar_ruta_documento_fija_formato($idformato, $iddoc);
                    }
                }

                function generar_ruta_documento_fija_formato($idformato, $iddoc)
                {
                    global $conn, $ruta_db_superior;
                    include_once($ruta_db_superior . "formatos/librerias/funciones_formatos_generales.php");
                    $dato = busca_filtro_tabla("", "formato_ruta", "formato_idformato=" . $idformato, "orden", $conn);
                    $rut = array();
                    for ($i = 0; $i < $dato["numcampos"]; $i++) {
                        $funcionario = "";
                        if ($dato[$i]["entidad"] == 1 && $dato[$i]["tipo_campo"] == 1) {
                            $funcionario = $dato[$i]["llave"];
                        } else if ($dato[$i]["entidad"] == 2 && $dato[$i]["tipo_campo"] == 1) {
                            $cargo = busca_filtro_tabla("", "cargo a, dependencia_cargo b, funcionario c", "idcargo=" . $dato[$i]["llave"] . " and cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and b.estado=1", "", $conn);
                            $funcionario = $cargo[0]["funcionario_codigo"];
                        } else if ($dato[$i]["entidad"] == 5 && $dato[$i]["tipo_campo"] == 1) {
                            $funcionario_temp = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo=" . $dato[$i]["llave"], "", $conn);
                            if ($funcionario_temp["numcampos"]) {
                                if ($funcionario_temp[0]["estado_dc"] && $funcionario_temp[0]["estado"]) {
                                    $funcionario = $funcionario_temp[0]["funcionario_codigo"];
                                } else {
                                    $funcionario_temp2 = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia=" . $funcionario_temp[0]["iddependencia"] . " AND idcargo=" . $funcionario_temp[0]["idcargo"] . " AND estado_dc=1 AND estado=1", "", $conn);
                                    if ($funcionario_temp2["numcampos"]) {
                                        $funcionario = $funcionario_temp2[0]["funcionario_codigo"];
                                    }
                                }
                            }
                        } else if ($dato[$i]["entidad"] == 1 && $dato[$i]["tipo_campo"] == 2) {
                            $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre as nom_campo", "formato a, campos_formato b", "formato_idformato=idformato and idcampos_formato=" . $dato[$i]["llave"], "", $conn);
                            $datos = busca_filtro_tabla($formato[0]["nom_campo"], $formato[0]["nombre_tabla"] . " a", "documento_iddocumento=" . $iddoc, "", $conn);
                            $funcionario = $datos[0][$formato[0]["nom_campo"]];
                        } else if ($dato[$i]["entidad"] == 5 && $dato[$i]["tipo_campo"] == 2) {
                            $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre as nom_campo", "formato a, campos_formato b", "formato_idformato=idformato and idcampos_formato=" . $dato[$i]["llave"], "", $conn);
                            $datos = busca_filtro_tabla($formato[0]["nom_campo"], $formato[0]["nombre_tabla"] . " a", "documento_iddocumento=" . $iddoc, "", $conn);
                            $funcionario_codigo = busca_filtro_tabla("B.funcionario_codigo", "dependencia_cargo A, funcionario B", "A.iddependencia_cargo=" . $datos[0][$formato[0]["nom_campo"]] . " AND A.funcionario_idfuncionario=B.idfuncionario", "", $conn);
                            $funcionario = $funcionario_codigo[0]["funcionario_codigo"];
                        } else if ($dato[$i]["tipo_campo"] == 3) {
                            include_once($ruta_db_superior . $dato[$i]["ruta"]);
                            $funcionario = call_user_func_array($dato[$i]["funcion"], array(
                                $idformato,
                                $iddoc
                            ));
                        }
                        if ($i == 0 && $funcionario == usuario_actual("funcionario_codigo"))
                            continue;
                        if ($funcionario != '') {
                            array_push($rut, array(
                                "funcionario" => $funcionario,
                                "tipo_firma" => $dato[$i]["firma"]
                            ));
                        }
                    }
                    if ($dato["numcampos"])
                        insertar_ruta($rut, $iddoc);
                    return;
                }

                /**
                 * *
                 */
                function transferencia_automatica_tareas($idformato, $iddoc, $origen, $destinos, $tipo, $notas = "")
                {
                    global $conn;
                    if ($tipo == "1") // cuando es una lista de funcionarios fijos (roles)
                        $vector = explode("@", $destinos);
                    elseif ($tipo == "3") // cuando es una lista de funcionarios fijos (funcionario_codigo)
                        $vector = explode("@", $destinos);
                    elseif ($tipo == "2") { // cuando el listado se toma de un campo del formato (roles)
                        $formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=$idformato", "", $conn);
                        $dato = busca_filtro_tabla($destinos, $formato[0][0], "documento_iddocumento=$iddoc", "", $conn);
                        $vector = explode(",", @$dato[0][0]);
                    }
                    $adicionales = array();
                    if ($notas != "") {
                        $adicionales["notas"] = "'" . $notas . "'";
                        $datos["ver_notas"] = 1;
                    }

                    foreach ($vector as $fila) {
                        if (!strpos($fila, "#")) {
                            if ($tipo == 3)
                                $lista = array(
                                    $fila
                                );
                            else {
                                $codigos = busca_filtro_tabla("funcionario_codigo", "funcionario,dependencia_cargo", "funcionario_idfuncionario=idfuncionario and iddependencia_cargo=$fila", "", $conn);
                                $lista = array(
                                    $codigos[0]["funcionario_codigo"]
                                );
                            }
                        } else
                            $lista = buscar_funcionarios(str_replace("#", "", $fila));

                        $datos["tipo_destino"] = "1";
                        $datos["archivo_idarchivo"] = $iddoc;
                        $datos["origen"] = $origen; // usuario_actual("funcionario_codigo");
                        $datos["nombre"] = "TRANSFERIDO";
                        $datos["tipo"] = "";
                        $datos["tipo_origen"] = "1";
                        transferir_archivo_prueba($datos, $lista, $adicionales);
                    }
                }

                /**
                 * **
                 */
                function buscar_papa_formato($idformato, $iddoc, $nombre_tabla)
                {
                    global $conn;
                    $formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
                    // print_r($formato);
                    if ($formato["numcampos"]) {
                        $documento = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
                        // print_r($documento);
                        // echo($nombre_tabla."<---->".$formato[0]["nombre_tabla"]."<br />");
                        if ($formato[0]["nombre_tabla"] == $nombre_tabla && $documento["numcampos"]) {
                            return ($documento[0]['documento_iddocumento']);
                        } elseif ($formato[0]["cod_padre"] != '' && $formato[0]["cod_padre"] != 0) {
                            $papa = busca_filtro_tabla("", "formato", "idformato=" . $formato[0]["cod_padre"], "", $conn);
                            if ($papa["numcampos"]) {
                                $documento_papa = busca_filtro_tabla("", $papa[0]["nombre_tabla"], "id" . $papa[0]["nombre_tabla"] . "=" . $documento[0][$papa[0]["nombre_tabla"]], "", $conn);
                                if ($documento_papa["numcampos"]) {
                                    $doc = buscar_papa_formato($papa[0]['idformato'], $documento_papa[0]["documento_iddocumento"], $nombre_tabla);
                                    // print_r($doc);
                                } else {
                                    return (0);
                                }
                            } else {
                                return (0);
                            }
                        } else {
                            return (0);
                        }
                    } else {
                        // alerta("ERROR EN EL FORMATO PRINCIPAL");
                        return (0);
                    }
                    return ($doc);
                }

                /*
 * <Clase>
 * <Nombre>actualizar_dependencia</Nombre>
 * <Parametros>$iddoc:id del documento</Parametros>
 * <Responsabilidades>
 * Se encarga de actualizar el campo dependencia para los SAIA's antiguos los cuales equivalían al iddependencia, los nuevos SAIA's debe ir el rol(iddependencia_cargo).
 * <Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */

                function actualizar_dependencia($iddoc)
                {
                    global $conn;

                    $fecha = busca_filtro_tabla("", "configuracion", "nombre='fecha_dependencia'", "", $conn);
                    $tabla = busca_filtro_tabla(fecha_db_obtener('fecha', 'Y-m-d') . " as fech,a.*,b.*", "documento a, funcionario b", "a.iddocumento=" . $iddoc . " and ejecutor=funcionario_codigo and a.fecha<=" . fecha_db_almacenar($fecha[0]["valor"], 'Y-m-d'), "", $conn);
                    if ($tabla["numcampos"]) {
                        $nombre_tabla = "ft_" . strtolower($tabla[0]["plantilla"]);
                        $formato = busca_filtro_tabla("dependencia", $nombre_tabla . " a", "a.documento_iddocumento=" . $iddoc, "", $conn);
                        $rol = busca_filtro_tabla("", "dependencia_cargo a", "a.funcionario_idfuncionario=" . $tabla[0]["idfuncionario"] . " and fecha_inicial<=" . fecha_db_almacenar($tabla[0]["fech"], 'Y-m-d') . " and fecha_final>=" . fecha_db_almacenar($doc[$i]["fech"], 'Y-m-d') . "", "", $conn);

                        if ($rol["numcampos"]) {
                            $sql1 = "UPDATE " . $nombre_tabla . " SET dependencia='" . $rol[0]["iddependencia_cargo"] . "' WHERE documento_iddocumento=" . $iddoc;
                        } else {
                            $rol = busca_filtro_tabla("", "dependencia_cargo a", "a.funcionario_idfuncionario=" . $tabla[0]["idfuncionario"], "", $conn);
                            $sql1 = "UPDATE " . $nombre_tabla . " SET dependencia='" . $rol[0]["iddependencia_cargo"] . "' WHERE documento_iddocumento=" . $iddoc;
                        }
                    } else {
                        return;
                    }
                }

                function firma_externa_funcion($idformato, $iddoc, $tabla, $campo = "firma_externa", $campo_tabla = "documento_iddocumento", $llave_modificar = "", $adicional, $retorno = 2)
                {
                    global $conn, $ruta_db_superior;
                    $formato = busca_filtro_tabla("", "formato a", "a.idformato=" . $idformato, "", $conn);
                    if (!$tabla)
                        $tabla = $formato[0]["nombre_tabla"];
                    if (!$llave_modificar)
                        $llave_modificar = $iddoc;
                    $ruta_firma = busca_filtro_tabla($campo, $tabla . " a", "a." . $campo_tabla . "=" . $llave_modificar, "", $conn);

                    if ($ruta_firma[0][$campo]) {
                        $ancho_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='ancho_firma'", "", $conn);
                        if (!$ancho_firma["numcampos"])
                            $ancho_firma[0]["valor"] = 200;
                        $alto_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='alto_firma'", "", $conn);
                        if (!$alto_firma["numcampos"])
                            $alto_firma[0]["valor"] = 100;
                        $texto = "<img src='" . $ruta_db_superior . "formatos/librerias/mostrar_foto_manual.php?campo_seleccion=" . $campo . $adicional . "&campo_tabla=" . $campo_tabla . "&llave_seleccion=" . $llave_modificar . "&tabla=" . $tabla . "' width='" . $ancho_firma[0]["valor"] . "' height='" . $alto_firma[0]["valor"] . "' style='background:white' />";
                    } else {
                        $texto = "<a href='" . $ruta_db_superior . "svg_edit/svg-editor.php?iddoc=" . $iddoc . "&idformato=" . $idformato . "&campo_modificar=" . $campo . $adicional . "&campo_tabla=" . $campo_tabla . "&llave_modificar=" . $llave_modificar . "&tabla=" . $tabla . "&ruta_retorno=../formatos/" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"] . "'>Firmar</a>";
                    }

                    if ($retorno == 2)
                        echo $texto;
                    else if ($retorno == 1)
                        return $texto;
                }

                /*
 * <Clase>
 * <Nombre>fk_idexpediente_funcion</Nombre>
 * <Parametros>$iddoc:id del documento
 * $idformato: idformato
 * </Parametros>
 * <Responsabilidades>
 * Funcion utilizada para los formatos sobre la cual se vincula un expediente segun una serie.
 * <Responsabilidades>
 * </Clase>
 */

                function fk_idexpediente_funcion($idformato, $campo, $iddoc)
                {
                    global $conn, $ruta_db_superior;
                    if (isset($_REQUEST["idexpediente"])) {
                        echo '<td id="td_fk_idexpediente"></td>';
                    } else {
                        $adicional = "";
                        $seleccionado = "";
                        if ($iddoc) {
                            $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre", "formato a, campos_formato b", "a.idformato=b.formato_idformato and a.idformato='" . $idformato . "' and b.idcampos_formato='" . $campo . "'", "", $conn);
                            $datos = busca_filtro_tabla($formato[0]["nombre"] . " as expediente", $formato[0]["nombre_tabla"] . " a", "a.documento_iddocumento=" . $iddoc, "", $conn);
                            $adicional = "&seleccionado=" . $datos[0]["expediente"];
                            $seleccionado = $datos[0]["expediente"];
                        }
                        ?>
                                <td id="td_fk_idexpediente" bgcolor="#F5F5F5">
                                    <div id="seleccionados"></div> <br /> Buscar: <input tabindex='2' type="text" id="stext_fk_idexpediente" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_fk_idexpediente.findItem((document.getElementById('stext_fk_idexpediente').value), 1)">
                                        <img src="../../assets/images/anterior.png" border="0px"></a> <a href="javascript:void(0)" onclick="tree_fk_idexpediente.findItem((document.getElementById('stext_fk_idexpediente').value), 0, 1)"><img src="../../assets/images/buscar.png" border="0px"></a> <a href="javascript:void(0)" onclick="tree_fk_idexpediente.findItem((document.getElementById('stext_fk_idexpediente').value))">
                                        <img src="../../assets/images/siguiente.png" border="0px"></a> <br />
                                    <div id="esperando_fk_idexpediente">
                                        <img src="../../assets/images/cargando.gif">
                                    </div>
                                    <div id="treeboxbox_fk_idexpediente" height="90%"></div>
                                    <input type="hidden" maxlength="255" class="required" name="fk_idexpediente" id="fk_idexpediente" value="<?php echo ($seleccionado); ?>"> <label style="display: none" class="error" for="fk_idexpediente">Campo obligatorio.</label>
                                    <script type="text/javascript">
                                        var browserType;
                                        if (document.layers) {
                                            browserType = "nn4"
                                        }
                                        if (document.all) {
                                            browserType = "ie"
                                        }
                                        if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                                            browserType = "gecko"
                                        }
                                        tree_fk_idexpediente = new dhtmlXTreeObject("treeboxbox_fk_idexpediente", "100%", "100%", 0);
                                        tree_fk_idexpediente.setImagePath("../../imgs/");
                                        tree_fk_idexpediente.enableIEImageFix(true);
                                        tree_fk_idexpediente.enableCheckBoxes(1);
                                        tree_fk_idexpediente.setOnLoadingStart(cargando_fk_idexpediente);
                                        tree_fk_idexpediente.setOnLoadingEnd(fin_cargando_fk_idexpediente);
                                        tree_fk_idexpediente.enableSmartXMLParsing(true);
                                        tree_fk_idexpediente.loadXML("../../test_expediente.php?accion=1&permiso_editar=1<?php echo ($adicional); ?>");
                                        tree_fk_idexpediente.setOnCheckHandler(onNodeSelect_fk_idexpediente);

                                        function onNodeSelect_fk_idexpediente(nodeId) {
                                            seleccionados = tree_fk_idexpediente.getAllChecked();
                                            nuevo = seleccionados.replace(/\,{2,}(d)*/gi, ",");
                                            nuevo = nuevo.replace(/\,$/gi, "");
                                            document.getElementById("fk_idexpediente").value = nuevo;
                                        }

                                        function fin_cargando_fk_idexpediente() {
                                            if (browserType == "gecko")
                                                document.poppedLayer =
                                                eval('document.getElementById("esperando_fk_idexpediente")');
                                            else if (browserType == "ie")
                                                document.poppedLayer =
                                                eval('document.getElementById("esperando_fk_idexpediente")');
                                            else
                                                document.poppedLayer =
                                                eval('document.layers["esperando_fk_idexpediente"]');
                                            document.poppedLayer.style.display = "none";
                                        }

                                        function cargando_fk_idexpediente() {
                                            if (browserType == "gecko")
                                                document.poppedLayer =
                                                eval('document.getElementById("esperando_fk_idexpediente")');
                                            else if (browserType == "ie")
                                                document.poppedLayer =
                                                eval('document.getElementById("esperando_fk_idexpediente")');
                                            else
                                                document.poppedLayer =
                                                eval('document.layers["esperando_fk_idexpediente"]');
                                            document.poppedLayer.style.display = "";
                                        }
                                    </script>
                                </td>
                            <?php

                                }
                            }

                            /*
 * <Clase>
 * <Nombre>vincular_expediente_documento</Nombre>
 * <Parametros>$iddoc:id del documento
 * $idformato: idformato
 * </Parametros>
 * <Responsabilidades>
 * Funcion utilizada para los formatos sobre la cual se realiza el proceso de vinculación interno sobre el documento.
 * <Responsabilidades>
 * </Clase>
 */

                            function vincular_expediente_documento($idformato, $iddoc)
                            {
                                global $conn;
                                $max_salida = 6;
                                $ruta_db_superior = $ruta = "";
                                while ($max_salida > 0) {
                                    if (is_file($ruta . "db.php")) {
                                        $ruta_db_superior = $ruta;
                                    }
                                    $ruta .= "../";
                                    $max_salida--;
                                }
                                if (@$_REQUEST["fk_idexpediente"]) {
                                    $expedientes = explode(",", $_REQUEST["fk_idexpediente"]);
                                    $cant = count($expedientes);
                                    include_once($ruta_db_superior . "pantallas/expediente/librerias.php");
                                    for ($i = 0; $i < $cant; $i++) {
                                        if ($expedientes[$i]) {
                                            vincular_documento_expediente($expedientes[$i], $iddoc);
                                        }
                                    }
                                } else if (@$_REQUEST["serie_idserie"]) {
                                    $idexpediente = busca_filtro_tabla("b.idexpediente", "serie a, expediente b", "a.idserie=" . $_REQUEST["serie_idserie"] . " and a.cod_padre=b.serie_idserie", "", $conn);
                                    if ($idexpediente["numcampos"]) {
                                        include_once($ruta_db_superior . "pantallas/expediente/librerias.php");
                                        vincular_documento_expediente($idexpediente[0]["idexpediente"], $iddoc);
                                    }
                                }
                                return;
                            }

                            function obtener_datos_documento($iddocumento)
                            {
                                global $conn;
                                $documento = busca_filtro_tabla(fecha_db_obtener("A.fecha", "Y-m-d") . " as fecha, A.numero, A.iddocumento, B.nombre, B.etiqueta, A.descripcion, B.nombre_tabla,B.idformato,A.estado", "documento A, formato B", "LOWER(A.plantilla) LIKE(B.nombre) AND A.iddocumento=" . $iddocumento, "", $conn);
                                if ($_REQUEST["funcionario_codigo"]) {
                                    $funcionario_codigo = $_REQUEST["funcionario_codigo"];
                                } else {
                                    $funcionario_codigo = $_SESSION["usuario_actual"];
                                }

                                if ($documento['numcampos']) {
                                    $documento = array(
                                        "iddocumento" => $documento[0]['iddocumento'],
                                        "numero" => $documento[0]['numero'],
                                        "idformato" => $documento[0]['idformato'],
                                        "estado" => $documento[0]['estado'],
                                        "version" => $documento[0]['version'] + 1,
                                        "plantilla" => $documento[0]['nombre'],
                                        "etiqueta" => $documento[0]['etiqueta'],
                                        "descripcion" => $documento[0]['descripcion'],
                                        "tabla" => $documento[0]['nombre_tabla'],
                                        "fecha" => $documento[0]['fecha'],
                                        "numero" => $documento[0]['numero'],
                                        "pdf" => $documento[0]['pdf'],
                                        "funcionario_codigo" => $funcionario_codigo
                                    );
                                } else {
                                    $documento = false;
                                }
                                return ($documento);
                            }

                            function resta_fechasphp($date1, $date2)
                            {
                                if (!is_integer($date1))
                                    $date1 = strtotime($date1);
                                if (!is_integer($date2))
                                    $date2 = strtotime($date2);
                                return floor(($date1 - $date2) / 60 / 60 / 24);
                            }

                            function suma_fechasphp($fecha, $dias)
                            {
                                $nuevafecha = strtotime('+' . $dias . ' day', strtotime($fecha));
                                $nuevafecha = date('Y-m-d', $nuevafecha);
                                return ($nuevafecha);
                            }

                            function cargar_anexos_documento_web($datos_documento, $anexos)
                            {
                                global $conn, $ruta_db_superior;
                                $retorno = array("exito" => 0, "msn" => "");
                                include_once($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
                                $formato_ruta = aplicar_plantilla_ruta_documento($datos_documento["iddocumento"]);
                                $tipo_almacenamiento = new SaiaStorage("archivos");
                                $funcionario = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $datos_documento["funcionario_codigo"], "", $conn);
                                $cant = 0;
                                $guar = 0;
                                foreach ($anexos as $key => $value) {
                                    $cant++;
                                    $ruta = $formato_ruta . "/anexos";
                                    $extension = pathinfo($value['filename']);
                                    $ruta .= "/" . rand() . "." . $extension["extension"];
                                    $contenido = base64_decode($value['content']);
                                    $guardados = $tipo_almacenamiento->almacenar_contenido($ruta, $contenido);
                                    if ($guardados) {
                                        $ruta_alm = array(
                                            "servidor" => $tipo_almacenamiento->get_ruta_servidor(),
                                            "ruta" => $ruta
                                        );
                                        $insert_anexo = "insert into anexos(documento_iddocumento, ruta, etiqueta, tipo, formato) VALUES (" . $datos_documento["iddocumento"] . ",'" . json_encode($ruta_alm) . "','" . $value['filename'] . "','" . $extencion["extension"] . "'," . $datos_documento["idformato"] . ")";
                                        phpmkr_query($insert_anexo);
                                        $idnexo = phpmkr_insert_id();
                                        if ($idnexo) {
                                            $guar++;
                                            $insert_permiso = "insert into permiso_anexo (anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES (" . $idnexo . "," . $funcionario[0]["idfuncionario"] . ",'lem', '', '', 'l')";
                                            phpmkr_query($insert_permiso, $conn, $datos_documento["funcionario_codigo"]);
                                        }
                                    }
                                }
                                if ($cant == $guar) {
                                    $retorno["exito"] = 1;
                                } else {
                                    $retorno["msn"] = "Error, se guardaron solo " . $guar . " anexos de " . $cant . " anexos";
                                }
                                return ($retorno);
                            }

                            function obtener_mes_letra($mes)
                            {
                                switch ($mes) {
                                    case 1:
                                        $mes = 'enero';
                                        break;
                                    case 2:
                                        $mes = 'febrero';
                                        break;
                                    case 3:
                                        $mes = 'marzo';
                                        break;
                                    case 4:
                                        $mes = 'abril';
                                        break;
                                    case 5:
                                        $mes = 'mayo';
                                        break;
                                    case 6:
                                        $mes = 'junio';
                                        break;
                                    case 7:
                                        $mes = 'julio';
                                        break;
                                    case 8:
                                        $mes = 'agosto';
                                        break;
                                    case 9:
                                        $mes = 'septiembre';
                                        break;
                                    case 10:
                                        $mes = 'octubre';
                                        break;
                                    case 11:
                                        $mes = 'noviembre';
                                        break;
                                    case 12:
                                        $mes = 'diciembre';
                                        break;
                                }

                                return $mes;
                            }

                            function obtener_anexos_paginas_documento($iddoc)
                            {
                                global $ruta_db_superior;
                                $documentos = array();
                                $anexos = busca_filtro_tabla("ruta, etiqueta, tipo, idanexos", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
                                if ($anexos["numcampos"]) {
                                    for ($i = 0; $i < $anexos['numcampos']; $i++) {
                                        $documentos['anexos'][] = array(
                                            "ruta" => $anexos[$i]['ruta'],
                                            "etiqueta" => $anexos[$i]['etiqueta'],
                                            "tipo" => $anexos[$i]['tipo'],
                                            "idanexo" => $anexos[$i]['idanexos']
                                        );
                                    }
                                }

                                $paginas = busca_filtro_tabla("ruta,pagina", "pagina", "id_documento=" . $iddoc, "", $conn);
                                if ($paginas["numcampos"]) {
                                    for ($i = 0; $i < $paginas['numcampos']; $i++) {
                                        $documentos['paginas'][] = array(
                                            "ruta" => $paginas[$i]['ruta'],
                                            "pagina" => $paginas[$i]['pagina']
                                        );
                                    }
                                }
                                return ($documentos);
                            }

                            function crear_pdf_documento_tcpdf($iddoc, $almacenar_temp = 0)
                            {
                                global $conn, $ruta_db_superior;
                                $retono = array(
                                    "exito" => 0,
                                    "msn" => ""
                                );
                                $datos_pdf = busca_filtro_tabla("pdf", "documento", "iddocumento=" . $iddoc, "", $conn);
                                if ($datos_pdf["numcampos"]) {
                                    $crear = 1;
                                    if ($datos_pdf[0]["pdf"] != "") {
                                        $ruta_archivo = json_decode($datos_pdf[0]["pdf"]);
                                        if (is_object($ruta_archivo)) {
                                            $bin_pdf = StorageUtils::get_file_content($datos_pdf[0]["pdf"]);
                                            if ($bin_pdf !== false) {
                                                $archivo_pdf = base64_encode($bin_pdf);
                                                $crear = 0;
                                                if ($almacenar_temp) {
                                                    $name = basename($ruta_archivo->ruta);
                                                    $ruta_temp_pdf = $_SESSION["ruta_temp_funcionario"] . $name;
                                                    if (is_file($ruta_db_superior . $ruta_temp_pdf)) {
                                                        unlink($ruta_db_superior . $ruta_temp_pdf);
                                                    }
                                                    file_put_contents($ruta_db_superior . $ruta_temp_pdf, base64_decode($archivo_pdf));
                                                    $retono["ruta_temp_pdf"] = $ruta_temp_pdf;
                                                } else {
                                                    $retono["base64_pdf"] = $archivo_pdf;
                                                }
                                            }
                                        }
                                    }
                                    if ($crear) {
                                        $ch = curl_init();
                                        $url = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/class_impresion.php?iddoc=" . $iddoc;
                                        $datos_session = "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&conexion_remota=1";
                                        $url = $url . $datos_session;
                                        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                        }
                                        curl_setopt($ch, CURLOPT_URL, $url);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        $responce = curl_exec($ch);
                                        curl_close($ch);

                                        $datos_pdf = busca_filtro_tabla("pdf", "documento", "iddocumento=" . $iddoc, "", $conn);
                                        if ($datos_pdf["numcampos"]) {
                                            $crear = 1;
                                            if ($datos_pdf[0]["pdf"] != "") {
                                                $ruta_archivo = json_decode($datos_pdf[0]["pdf"]);
                                                if (is_object($ruta_archivo)) {
                                                    $bin_pdf = StorageUtils::get_file_content($datos_pdf[0]["pdf"]);
                                                    if ($bin_pdf !== false) {
                                                        $archivo_pdf = base64_encode($bin_pdf);
                                                        $crear = 0;
                                                        if ($almacenar_temp) {
                                                            $name = basename($ruta_archivo->ruta);
                                                            $ruta_temp_pdf = $_SESSION["ruta_temp_funcionario"] . $name;
                                                            if (is_file($ruta_db_superior . $ruta_temp_pdf)) {
                                                                unlink($ruta_db_superior . $ruta_temp_pdf);
                                                            }
                                                            file_put_contents($ruta_db_superior . $ruta_temp_pdf, base64_decode($archivo_pdf));
                                                            $retono["ruta_temp_pdf"] = $ruta_temp_pdf;
                                                        } else {
                                                            $retono["base64_pdf"] = $archivo_pdf;
                                                        }
                                                    }
                                                }
                                            }
                                            if ($crear) {
                                                $retono["msn"] = "NO fue posible generar el pdf";
                                            } else {
                                                $retono["exito"] = 1;
                                                $retono["ruta_db"] = $datos_pdf[0]["pdf"];
                                            }
                                        }
                                    } else {
                                        $retono["exito"] = 1;
                                        $retono["ruta_db"] = $datos_pdf[0]["pdf"];
                                    }
                                } else {
                                    $retono["msn"] = "Datos No encontrados";
                                }
                                return $retono;
                            }

                            //Funcion para convertir numeros a letras
                            function numerotexto($numero)
                            {
                                // Primero tomamos el numero y le quitamos los caracteres especiales y extras
                                // Dejando solamente el punto "." que separa los decimales
                                // Si encuentra mas de un punto, devuelve error.
                                // NOTA: Para los paises en que el punto y la coma se usan de forma
                                // inversa, solo hay que cambiar la coma por punto en el array de "extras"
                                // y el punto por coma en el explode de $partes

                                $extras = array("/[\$]/", "/ /", "/,/", "/-/");
                                $limpio = preg_replace($extras, "", $numero);

                                $partes = explode(".", $limpio);

                                if (count($partes) > 2) {
                                    return "Error, el n&uacute;mero no es correcto";
                                    exit();
                                }

                                // Ahora explotamos la parte del numero en elementos de un array que
                                // llamaremos $digitos, y contamos los grupos de tres digitos
                                // resultantes

                                $digitos_piezas = chunk_split($partes[0], 1, "#");
                                $digitos_piezas = substr($digitos_piezas, 0, strlen($digitos_piezas) - 1);
                                $digitos = explode("#", $digitos_piezas);
                                $todos = count($digitos);
                                $grupos = ceil(count($digitos) / 3);

                                // comenzamos a dar formato a cada grupo

                                $unidad = array('un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve');
                                $decenas = array('diez', 'once', 'doce', 'trece', 'catorce', 'quince');
                                $decena = array('dieci', 'veinti', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa');
                                $centena = array('ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos');
                                $resto = $todos;

                                for ($i = 1; $i <= $grupos; $i++) {

                                    // Hacemos el grupo
                                    if ($resto >= 3) {
                                        $corte = 3;
                                    } else {
                                        $corte = $resto;
                                    }
                                    $offset = (($i * 3) - 3) + $corte;
                                    $offset = $offset * (-1);

                                    // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB

                                    $num = implode("", array_slice($digitos, $offset, $corte));
                                    $resultado[$i] = "";
                                    $cen = (int) ($num / 100);              //Cifra de las centenas
                                    $doble = $num - ($cen * 100);             //Cifras de las decenas y unidades
                                    $dec = (int) ($num / 10) - ($cen * 10);    //Cifra de las decenas
                                    $uni = $num - ($dec * 10) - ($cen * 100);   //Cifra de las unidades
                                    if ($cen > 0) {
                                        if ($num == 100)
                                            $resultado[$i] = "cien";
                                        else
                                            $resultado[$i] = $centena[$cen - 1] . ' ';
                                    } //end if
                                    if ($doble > 0) {
                                        if ($doble == 20) {
                                            $resultado[$i] .= " veinte";
                                        } elseif (($doble < 16) and ($doble > 9)) {
                                            $resultado[$i] .= $decenas[$doble - 10];
                                        } else {
                                            $resultado[$i] .= ' ' . $decena[$dec - 1];
                                        } //end if
                                        if ($dec > 2 and $uni <> 0)
                                            $resultado[$i] .= ' y ';
                                        if (($uni > 0) and ($doble > 15) or ($dec == 0)) {
                                            if ($i == 1 && $uni == 1)
                                                $resultado[$i] .= "uno";
                                            elseif ($i == 2 && $num == 1)
                                                $resultado[$i] .= "";
                                            else
                                                $resultado[$i] .= $unidad[$uni - 1];
                                        }
                                    }

                                    // Le agregamos la terminacion del grupo
                                    if ($i % 2 == 0) {
                                        $resultado[$i] .= ($resultado[$i] == "") ? "" : " mil ";
                                    } elseif ($i % 3 == 0) {
                                        $resultado[$i] .= ($num == 1) ? " millon " : " millones ";
                                    }
                                    $resto -= $corte;
                                }

                                // Sacamos el resultado (primero invertimos el array)
                                $resultado_inv = array_reverse($resultado, true);
                                $final = "";
                                foreach ($resultado_inv as $parte) {
                                    $final .= $parte;
                                }
                                if ($partes[1] && intval($partes[1]) != 0) {
                                    $final .= " CON " . numerotexto(substr($partes[1], 0, 2));
                                }
                                return strtoupper($final);
                            }

                            function generar_correo_confirmacion($idformato, $iddoc, $nomb_campo = "email_aprobar")
                            {
                                global $conn, $ruta_db_superior;
                                $formato = busca_filtro_tabla("nombre_tabla, nombre", "formato", "idformato=" . $idformato, "", $conn);
                                if ($formato["numcampos"]) {
                                    $datos_formato = busca_filtro_tabla($nomb_campo . ",d.estado", $formato[0]['nombre_tabla'] . " ft,documento d", "ft.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "", $conn);
                                    if ($datos_formato["numcampos"]) {
                                        $usuario_confirma = busca_filtro_tabla("destino", "buzon_entrada", "nombre='POR_APROBAR' and activo=1 and archivo_idarchivo=" . $iddoc, "idtransferencia asc", $conn);
                                        if ($datos_formato[0][$nomb_campo] == 1 && $usuario_confirma["numcampos"]) {
                                            $funcionario = busca_filtro_tabla("login,nombres,apellidos,funcionario_codigo", "vfuncionario_dc", "estado=1 and funcionario_codigo=" . $usuario_confirma[0]['destino'], "", $conn);
                                            if ($funcionario["numcampos"]) {
                                                $ch = curl_init();
                                                $fila = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/class_impresion.php?iddoc=" . $iddoc . "&conexion_remota=1&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA];
                                                curl_setopt($ch, CURLOPT_URL, $fila);
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                $contenido = curl_exec($ch);
                                                curl_close($ch);

                                                $anexos = array();
                                                $consulta = busca_filtro_tabla("pdf", "documento", "iddocumento=" . $iddoc, "", $conn);
                                                if ($consulta[0]['pdf'] != "") {
                                                    $ruta_imagen = json_decode($consulta[0]['pdf']);
                                                    if (is_object($ruta_imagen)) {
                                                        $anexos[] = $consulta[0]['pdf'];
                                                    } else {
                                                        if (file_exists($ruta_db_superior . $consulta[0]['pdf'])) {
                                                            $anexos[] = $ruta_db_superior . $consulta[0]['pdf'];
                                                        }
                                                    }
                                                }

                                                $adjuntos = busca_filtro_tabla("ruta", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
                                                if ($adjuntos["numcampos"]) {
                                                    for ($k = 0; $k < $adjuntos["numcampos"]; $k++) {
                                                        $ruta_imagen = json_decode($adjuntos[$k]['ruta']);
                                                        if (is_object($ruta_imagen)) {
                                                            $anexos[] = $adjuntos[$k]['ruta'];
                                                        } else {
                                                            if (file_exists($ruta_db_superior . $adjuntos[$k]['ruta'])) {
                                                                $anexos[] = $ruta_db_superior . $adjuntos[$k]["ruta"];
                                                            }
                                                        }
                                                    }
                                                }

                                                $info = 'iddoc-' . $iddoc . ',usuario-' . $funcionario[0]['login'];
                                                $resultado = base64_encode($info);
                                                $busca_configuracion_correo = busca_filtro_tabla("valor", "configuracion", "nombre='email_aprobacion'", "", $conn);
                                                $enlaces = '<a href="' . $busca_configuracion_correo[0]['valor'] . 'index.php?info=' . $resultado . '" target="_blank">Gestionar documento</a><br />';

                                                $mensaje = 'Saludos ' . $funcionario[0]['nombres'] . ' ' . $funcionario[0]['apellidos'] . ',<br /><br />
		      Por medio de la presente se permite solicitar su aprobación o rechazo al documento adjunto donde se encuentra usted como responsable de aprobación, para hacer esto por favor siga estos dos pasos:
		      <br /><br />
		      1. Haga lectura del documento adjunto.
		      <br /><br />
		      2. Una vez tenga conocimiento del documento, acceda al siguiente link y decida si Aprobar o Rechazar.
		      <br /><br />
		      ' . $enlaces . '<br /><br />';
                                                $ok = enviar_mensaje('', array("para" => "funcionario_codigo"), array("para" => array($funcionario[0]['funcionario_codigo'])), 'DOCUMENTO PARA APROBACION', $mensaje, $anexos, $iddoc);
                                                if ($ok !== true && !isset($_REQUEST["no_redirecciona"])) {
                                                    notificaciones("Error! No se pudo enviar el correo de confirmaci&oacute;n", "error");
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            function fecha_documento($idformato, $iddoc)
                            {
                                global $conn, $ruta_db_superior;
                                $fecha_creacion = '';
                                $consulta_datos = busca_filtro_tabla(fecha_db_obtener("fecha_creacion", "Y-m-d") . " as fecha_creacion", "documento", "iddocumento=" . $iddoc, "", $conn);
                                if ($consulta_datos['numcampos']) {
                                    $fecha_creacion = $consulta_datos[0]['fecha_creacion'];
                                }
                                echo $fecha_creacion;
                            }
                            ?>