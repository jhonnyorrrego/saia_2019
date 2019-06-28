<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
/*
<Archivo>
<Nombre>asignacion.php</Nombre> 
<Parametros></Parametros>
<ruta>saia1.06/asignacion.php</ruta>
<Responsabilidades>Relaiza el ingreso y salida de registros a la tabla asignacion que significa los documentos pendientes de los usuarios<Responsabilidades>
<Notas></Notas>
<Salida></Salida>
</Archivo>
 */
include_once $ruta_db_superior . "core/autoload.php";
/*
<Clase>
<Nombre>procesar_estados</Nombre> 
<Parametros>$idorigen:codigo del funcionario que realiza la accion;$iddestino:codigo del funcionario a quien va dirigida la accion;$nombre_transferencia:tipo de accion;$iddocumento:identificador del documento;$fecha_final:fecha de la accion</Parametros>
<Responsabilidades>Validar el tipo de accion y hacer el llamado para realizar el ingreso o la eilminacion en la tabla asignacion<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
 */
function procesar_estados($idorigen, $iddestino, $nombre_transferencia, $iddocumento = null, $fecha_final = null)
{
    switch ($nombre_transferencia) {
        case "TRANSFERIDO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "COPIA":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "DELEGADO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "REVISADO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;

        case "APROBADO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;

        case "DEVOLUCION":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "RESPONDIDO":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        case "TRAMITE":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        case "BORRADOR": 
        //asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
            break;
        case "TERMINADO":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        case "DISTRIBUCION":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        default:
            return;
            break;       
//Tener encuenta en el case aprobado que si el destino es el radicador de salida solo se cancela la tarea y yap sino se reasigna.
    }
    return true;
}
/*
<Clase>
<Nombre>eliminar_asignacion</Nombre> 
<Parametros>$funcionario:codigo del funcionario;$iddocumento:identifador del documento</Parametros>
<Responsabilidades>Elimina los registros en la tabla asignacion que corresponde con el funcionario y el documento<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
 */
function eliminar_asignacion($funcionario, $iddocumento)
{
    global $conn;
    $datos_asignacion = busca_filtro_tabla("idasignacion", "asignacion", "documento_iddocumento=$iddocumento AND entidad_identidad=1 AND llave_entidad=$funcionario and tarea_idtarea=2", "", $conn);
    if ($datos_asignacion["numcampos"]) {
        for ($i = 0; $i < $datos_asignacion["numcampos"]; $i++) { 
         //echo "delete from asignacion where idasignacion=".$datos_asignacion[$i]["idasignacion"];
            phpmkr_query("delete from asignacion where idasignacion=" . $datos_asignacion[$i]["idasignacion"], $conn);
        }
    } else {  
     //alerta("Problemas al Eliminar la tarea Error # 003");     
        return false;
    }
    return true;
}
/*
<Clase>
<Nombre>asignar_tarea_buzon</Nombre> 
<Parametros>$iddocumento:identificador del documento;$idserie:identificador de la serie(No se utiliza);$idtarea:identifcador de la tarea (pendientes);$list_entidad:codigo del funcionario destino;$identidad:tipo de entidad;$fecha_inicial:Null;$fecha_final:fecha de la accion (No se utiliza);$estado:estado de la asignacion;</Parametros>
<Responsabilidades>Adicionar en la tabla asignacion el registro para el documento y el funcionario<Responsabilidades>
<Notas>La fecha inicial es la fecha actual</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Campos obligatorios iddocumento y idtarea<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
 */
function asignar_tarea_buzon($iddocumento, $idserie = null, $idtarea = null, $list_entidad = null, $identidad = null, $fecha_inicial = null, $fecha_final = null, $estado = "PENDIENTE")
{
    global $conn;
    $formato = "Y-m-d H:i:s";
    if (!$fecha_inicial)
        $fecha_inicial = fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    if (($idserie || $iddocumento) && isset($idtarea)) {
        $sql = "INSERT INTO asignacion (documento_iddocumento,tarea_idtarea,fecha_inicial,estado,entidad_identidad,llave_entidad) VALUES ($iddocumento,$idtarea,$fecha_inicial,'$estado',1,$list_entidad)";
        phpmkr_query($sql);
    } else {
        alerta("Diligencie correctamente los datos e intente nuevamente");
        return false;
    }
    return true;
}
?>