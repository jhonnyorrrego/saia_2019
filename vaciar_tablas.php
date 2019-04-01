<?php
/*
include_once("db.php");
include_once("vaciar_tablas.php");
echo "Ejecutando limpieza, espere un momento por favor<br />";
/*****************limpiar base de datos************/

/*
$conn->Ejecutar_Sql("truncate almacenamiento");
$conn->Ejecutar_Sql("truncate anexos");
$conn->Ejecutar_Sql("truncate asignacion");
$conn->Ejecutar_Sql("truncate asignacion_entidad");
$conn->Ejecutar_Sql("truncate asignacion_terminar");
$conn->Ejecutar_Sql("truncate autoguardado");
$conn->Ejecutar_Sql("truncate binario");
$conn->Ejecutar_Sql("truncate buzon_entrada");
$conn->Ejecutar_Sql("truncate buzon_salida");
$conn->Ejecutar_Sql("truncate comentario_img");
$conn->Ejecutar_Sql("truncate control");
$conn->Ejecutar_Sql("truncate control_asignacion");
$conn->Ejecutar_Sql("truncate control_tarea");
$conn->Ejecutar_Sql("truncate caja");
$conn->Ejecutar_Sql("truncate digitalizacion");
$conn->Ejecutar_Sql("truncate documento");
$conn->Ejecutar_Sql("truncate documento_anulacion");
$conn->Ejecutar_Sql("truncate documento_etiqueta");
$conn->Ejecutar_Sql("truncate documento_version");
$conn->Ejecutar_Sql("truncate doc_calidad");
$conn->Ejecutar_Sql("truncate etiqueta");
$conn->Ejecutar_Sql("truncate expediente");
$conn->Ejecutar_Sql("truncate expediente_doc");
$conn->Ejecutar_Sql("truncate folder");
$conn->Ejecutar_Sql("truncate pagina");
$conn->Ejecutar_Sql("truncate permiso_anexo");
$conn->Ejecutar_Sql("truncate permiso_documento");
$conn->Ejecutar_Sql("truncate permiso_expediente");
$conn->Ejecutar_Sql("truncate permiso_funcionario");
$conn->Ejecutar_Sql("truncate pretexto");
$conn->Ejecutar_Sql("truncate reserva");
$conn->Ejecutar_Sql("truncate respuesta");
$conn->Ejecutar_Sql("truncate ruta");
$conn->Ejecutar_Sql("truncate salidas");
$conn->Ejecutar_Sql("truncate solicitud");
$conn->Ejecutar_Sql("truncate evento");
$conn->Ejecutar_Sql("truncate tarea");
$conn->Ejecutar_Sql("truncate entidad_pretexto");
$conn->Ejecutar_Sql("truncate log_acceso");
$conn->Ejecutar_Sql("truncate radicados_carta");
$conn->Ejecutar_Sql("update contador set consecutivo=1");
$conn->Ejecutar_Sql("truncate datos_ejecutor");
$conn->Ejecutar_Sql("truncate ejecutor");


$formatos=busca_filtro_tabla("nombre_tabla","formato","","",$conn);
{for($i=0;$i<$formatos["numcampos"];$i++)
    $conn->Ejecutar_Sql("truncate ".$formatos[$i]["nombre_tabla"]);
}

echo ("Fin de la limpieza");

*/