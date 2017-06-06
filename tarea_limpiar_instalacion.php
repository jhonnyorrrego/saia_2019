<?php
die();
include_once("db.php");


echo "Ejecutando limpieza, espere un momento por favor<br />";
//-----------------limpiar base de datos------------/

$conn->Ejecutar_Sql("delete from asignacion where tarea_idtarea=2"); 
 //tablas relacionadas para limpiar todo lo referente a los documentos
$conn->Ejecutar_Sql("truncate table almacenamiento");
$conn->Ejecutar_Sql("truncate table anexos");
$conn->Ejecutar_Sql("truncate table asignacion");
$conn->Ejecutar_Sql("truncate table asignacion_entidad");
$conn->Ejecutar_Sql("truncate table asignacion_terminar");
$conn->Ejecutar_Sql("truncate table autoguardado");
$conn->Ejecutar_Sql("truncate table binario");
//$conn->Ejecutar_Sql("truncate table busqueda");
//$conn->Ejecutar_Sql("truncate table busqueda_componente");
//$conn->Ejecutar_Sql("truncate table busqueda_condicion");
//$conn->Ejecutar_Sql("truncate table busqueda_condicion_enlace");
//$conn->Ejecutar_Sql("truncate table busqueda_filtro");
//$conn->Ejecutar_Sql("truncate table busqueda_filtro_temp");
//$conn->Ejecutar_Sql("truncate table busqueda_grafico");
//$conn->Ejecutar_Sql("truncate table busqueda_ruta");
//$conn->Ejecutar_Sql("truncate table busqueda_union");
//$conn->Ejecutar_Sql("truncate table busqueda_usuario");
$conn->Ejecutar_Sql("truncate table buzon_entrada");
$conn->Ejecutar_Sql("truncate table buzon_salida");
//$conn->Ejecutar_Sql("truncate table calendario_saia");
//$conn->Ejecutar_Sql("truncate table campos");
//$conn->Ejecutar_Sql("truncate table campos_formato");
//$conn->Ejecutar_Sql("truncate table caracteristica");
//$conn->Ejecutar_Sql("truncate table caracteristicas_campos");
//$conn->Ejecutar_Sql("truncate table caracteristica_p");
//$conn->Ejecutar_Sql("truncate table cargo");
//$conn->Ejecutar_Sql("truncate table carrusel");
//$conn->Ejecutar_Sql("truncate table categoria_formato");
$conn->Ejecutar_Sql("truncate table campo_busqueda_usuario");
//$conn->Ejecutar_Sql("truncate table carrusel");
$conn->Ejecutar_Sql("truncate table comentario_img");
//$conn->Ejecutar_Sql("truncate table configuracion");
$conn->Ejecutar_Sql("update contador set consecutivo=1");
//$conn->Ejecutar_Sql("truncate table contenidos_carrusel");
$conn->Ejecutar_Sql("truncate table correo_usuario");
$conn->Ejecutar_Sql("truncate table datos_ejecutor");
//$conn->Ejecutar_Sql("truncate table departamento");
//$conn->Ejecutar_Sql("truncate table dependencia");
//$conn->Ejecutar_Sql("truncate table dependencia_cargo");
//--------flujos-----------------
//$conn->Ejecutar_Sql("truncate table diagram");
//$conn->Ejecutar_Sql("truncate table diagramdata");
//$conn->Ejecutar_Sql("truncate table diagram_closed");
//$conn->Ejecutar_Sql("truncate table diagram_finished");
//$conn->Ejecutar_Sql("truncate table diagram_history");
$conn->Ejecutar_Sql("truncate table diagram_instance");
$conn->Ejecutar_Sql("truncate table digitalizacion");
$conn->Ejecutar_Sql("truncate table documento");
$conn->Ejecutar_Sql("truncate table documento_accion");
$conn->Ejecutar_Sql("truncate table documento_anulacion");
$conn->Ejecutar_Sql("truncate table documento_etiqueta");
$conn->Ejecutar_Sql("truncate table documento_tareas");
$conn->Ejecutar_Sql("truncate table documento_verificacion");
$conn->Ejecutar_Sql("truncate table documento_vinculados");
//$conn->Ejecutar_Sql("truncate table documento_version");
$conn->Ejecutar_Sql("truncate table ejecutor");
//$conn->Ejecutar_Sql("truncate table encabezado_formato");
//$conn->Ejecutar_Sql("truncate table entidad");
$conn->Ejecutar_Sql("truncate table entidad_expediente");
$conn->Ejecutar_Sql("truncate table entidad_pretexto");
//$conn->Ejecutar_Sql("truncate table entidad_serie");
$conn->Ejecutar_Sql("truncate table error");
$conn->Ejecutar_Sql("truncate table estadisticas_saia_size");
$conn->Ejecutar_Sql("truncate table etiqueta");
$conn->Ejecutar_Sql("truncate table evento");
//$conn->Ejecutar_Sql("truncate table expediente");
//$conn->Ejecutar_Sql("truncate table expediente_doc");
//$conn->Ejecutar_Sql("truncate table filtro_grafica");
//$conn->Ejecutar_Sql("truncate table filtro_reporte");
$conn->Ejecutar_Sql("truncate table folder");
//$conn->Ejecutar_Sql("truncate table formato");
//$conn->Ejecutar_Sql("truncate table formato_ruta");


/*$formatos=busca_filtro_tabla("nombre_tabla","formato","","",$conn);
	for($i=0;$i<$formatos["numcampos"];$i++)	
    $conn->Ejecutar_Sql("truncate table ".$formatos[$i]["nombre_tabla"]);*/
    

//$conn->Ejecutar_Sql("truncate table funcion");
//$conn->Ejecutar_Sql("truncate table funcionario");
//$conn->Ejecutar_Sql("truncate table funcionario_validacion");
//$conn->Ejecutar_Sql("truncate table funciones_formato");
//$conn->Ejecutar_Sql("truncate table funciones_formato_accion");
//$conn->Ejecutar_Sql("truncate table funciones_paso");
//$conn->Ejecutar_Sql("truncate table funciones_paso_accion");
//$conn->Ejecutar_Sql("truncate table grafico");
//$conn->Ejecutar_Sql("truncate table grafico_serie");
$conn->Ejecutar_Sql("truncate table log_acceso");
$conn->Ejecutar_Sql("truncate table mensaje_formato");
//$conn->Ejecutar_Sql("truncate table modulo");
//$conn->Ejecutar_Sql("truncate table modulo_exterior");
//$conn->Ejecutar_Sql("truncate table modulo_temp");
//$conn->Ejecutar_Sql("truncate table municipio");
//$conn->Ejecutar_Sql("truncate table municipio_exterior");
//$conn->Ejecutar_Sql("truncate table noticias_index");
$conn->Ejecutar_Sql("truncate table pagina");
//$conn->Ejecutar_Sql("truncate table pais");
//$conn->Ejecutar_Sql("truncate table pantalla");
//$conn->Ejecutar_Sql("truncate table paso");
//$conn->Ejecutar_Sql("truncate table paso_actividad");
$conn->Ejecutar_Sql("truncate table paso_actividad_anexo");
//$conn->Ejecutar_Sql("truncate table paso_actividad_funciones");
//$conn->Ejecutar_Sql("truncate table paso_actividad_programacion");
//$conn->Ejecutar_Sql("truncate table paso_devolucion");
$conn->Ejecutar_Sql("truncate table paso_documento");
//$conn->Ejecutar_Sql("truncate table paso_enlace");
$conn->Ejecutar_Sql("truncate table paso_enlace_temporal");
$conn->Ejecutar_Sql("truncate table paso_instancia_pendiente");
$conn->Ejecutar_Sql("truncate table paso_instancia_rastro");
$conn->Ejecutar_Sql("truncate table paso_instancia_terminada");
$conn->Ejecutar_Sql("truncate table paso_inst_terminacion");
$conn->Ejecutar_Sql("truncate table paso_rastro");
$conn->Ejecutar_Sql("truncate table paso_tareas");
$conn->Ejecutar_Sql("truncate table paso_temporal");
$conn->Ejecutar_Sql("truncate table permiso_anexo");
//$conn->Ejecutar_Sql("truncate table perfil");
$conn->Ejecutar_Sql("truncate table permiso");
$conn->Ejecutar_Sql("truncate table permiso_anexos");
$conn->Ejecutar_Sql("truncate table permiso_documento");
//$conn->Ejecutar_Sql("truncate table permiso_formato");
$conn->Ejecutar_Sql("truncate table permiso_funcionario");
$conn->Ejecutar_Sql("truncate table permiso_listado_tareas");
$conn->Ejecutar_Sql("truncate table permiso_perfil");
$conn->Ejecutar_Sql("truncate table pretexto");
$conn->Ejecutar_Sql("truncate table prioridad_documento");
$conn->Ejecutar_Sql("truncate table permiso_expediente");
$conn->Ejecutar_Sql("truncate table reemplazo");
$conn->Ejecutar_Sql("truncate table radicados_carta");
$conn->Ejecutar_Sql("truncate table respuesta");
$conn->Ejecutar_Sql("truncate table ruta");
$conn->Ejecutar_Sql("truncate table salidas");
//$conn->Ejecutar_Sql("truncate table serie");
//$conn->Ejecutar_Sql("truncate table tarea");
$conn->Ejecutar_Sql("truncate table tareas");
$conn->Ejecutar_Sql("truncate table tareas_buzon");
//$conn->Ejecutar_Sql("truncate table userdiagram");
//$conn->Ejecutar_Sql("truncate table user_workflow);
//$conn->Ejecutar_Sql("truncate table reserva");
//$conn->Ejecutar_Sql("truncate table solicitud");

//TAREAS AVANZADAS
$conn->Ejecutar_Sql("truncate table tareas_listado");
$conn->Ejecutar_Sql("truncate table tareas_listado_anexos");
$conn->Ejecutar_Sql("truncate table tareas_listado_etiquetas");
$conn->Ejecutar_Sql("truncate table tareas_listado_evalua");
$conn->Ejecutar_Sql("truncate table tareas_listado_notas");
$conn->Ejecutar_Sql("truncate table tareas_listado_recur");
$conn->Ejecutar_Sql("truncate table tareas_listado_tiempo");
$conn->Ejecutar_Sql("truncate table tareas_planeadas");
$conn->Ejecutar_Sql("truncate table tareas_progreso");

$conn->Ejecutar_Sql("truncate table dependencia_cargo");
$conn->Ejecutar_Sql("truncate table serie");
$conn->Ejecutar_Sql("truncate table entidad_serie");
$conn->Ejecutar_Sql("truncate table contador");

//EXPEDIENTES
$conn->Ejecutar_Sql("truncate table expediente");
$conn->Ejecutar_Sql("truncate table expediente_abce");
$conn->Ejecutar_Sql("truncate table expediente_doc");
$conn->Ejecutar_Sql("truncate table entidad_expediente");
$conn->Ejecutar_Sql("truncate table caja");
$conn->Ejecutar_Sql("truncate table entidad_caja");

limpiar_formatos();
limpiar_busquedas();
limpiar_indicadores();
limpiar_funcionarios();

asignar_permisos_cerok();


echo ("Fin de la limpieza");

function limpiar_formatos(){
    global $conn;
    $formatos_eliminar=busca_filtro_tabla("idformato,nombre,contador_idcontador,nombre_tabla,serie_idserie,fk_categoria_formato","formato","pertenece_nucleo=0","",$conn);
    for ($i=0; $i < $formatos_eliminar['numcampos']; $i++) { 
        eliminar_contador($formatos_eliminar[$i]['contador_idcontador']);
        eliminar_serie($formatos_eliminar[$i]['serie_idserie']);
        elimina_modulo($formatos_eliminar[$i]['nombre']);
        elimina_campos_formato($formatos_eliminar[$i]['idformato']);
        elimina_funciones_formato($formatos_eliminar[$i]['idformato']);
        elimina_funciones_formato_accion($formatos_eliminar[$i]['idformato']);
        $elimina_formato="DELETE FROM formato WHERE idformato=".$formatos_eliminar[$i]['idformato'];
        phpmkr_query($elimina_formato);
    }
}
function limpiar_busquedas(){
    $busquedas_eliminar=busca_filtro_tabla("idbusqueda","busqueda","pertenece_nucleo=0","",$conn);
    for ($i=0; $i < $busquedas_eliminar['numcampos']; $i++) { 
        $componentes=busca_filtro_tabla("idbusqueda_componente","busqueda_componente","busqueda_idbusqueda=".$busquedas_eliminar[$i]['idbusqueda'],"",$conn);
        for ($j=0; $j < $componentes['numcampos']; $j++) { 
            $elimina_condicion="DELETE from busqueda_condicion WHERE fk_busqueda_componente=".$componentes[$j]['idbusqueda_componente'];
            phpmkr_query($elimina_condicion);
            $elimina_componente="DELETE from busqueda_componente WHERE idbusqueda_componente=".$componentes[$j]['idbusqueda_componente'];
            phpmkr_query($elimina_componente);
        }
    }
}
function limpiar_indicadores(){
    $indicadores_eliminar=busca_filtro_tabla("idindicador","indicador","pertenece_nucleo=0","",$conn);
    for ($i=0; $i < $indicadores_eliminar['numcampos']; $i++) { 
        $busqueda_grafico_eliminar=busca_filtro_tabla("idbusqueda_grafico","busqueda_grafico","indicador_idindicador=".$indicadores_eliminar[$i]['idindicador'],"",$conn);
        for ($j=0; $j < $busqueda_grafico_eliminar['numcampos']; $j++) { 
            $elimina_busqueda_grafico_serie="DELETE FROM busqueda_grafico_serie WHERE busqueda_grafico_idbusqueda_grafico=".$busqueda_grafico_eliminar[$j]['idbusqueda_grafico'];
            phpmkr_query($elimina_busqueda_grafico_serie);
            $elimina_busqueda_grafico="DELETE FROM busqueda_grafico WHERE idbusqueda_grafico=".$busqueda_grafico_eliminar[$j]['idbusqueda_grafico'];
            phpmkr_query($elimina_busqueda_grafico);
        }
        $elimina_busqueda_indicador="DELETE FROM busqueda_indicador WHERE indicador_idindicador=".$indicadores_eliminar[$i]['idindicador'];
        phpmkr_query($elimina_busqueda_indicador);
        $elimina_indicador="DELETE FROM indicador WHERE idindicador=".$indicadores_eliminar[$i]['idindicador'];
        phpmkr_query($elimina_indicador);
    }
}
function limpiar_funcionarios(){
    global $conn;
    $eliminar_funcionario="DELETE FROM funcionario WHERE pertenece_nucleo=0";
    phpmkr_query($eliminar_funcionario);
    $eliminar_cargo="DELETE FROM cargo WHERE pertenece_nucleo=0";
    phpmkr_query($eliminar_cargo);
    $eliminar_dependencia="DELETE FROM dependencia WHERE pertenece_nucleo=0";
    phpmkr_query($eliminar_dependencia);
}
function eliminar_contador($idcontador){
    $busca_contador_formatos=busca_filtro_tabla("idformato","formato","contador_idcontador=".$idcontador,"",$conn);
    if(!$busca_contador_formatos['numcampos'] || $busca_contador_formatos['numcampos']==1){
        $elimina_contador="DELETE FROM contador WHERE idcontador=".$idcontador;
        phpmkr_query($elimina_contador);
    }
}
function eliminar_serie($idserie){
    $busca_serie_formatos=busca_filtro_tabla("idformato","formato","serie_idserie=".$idserie,"",$conn);
    if(!$busca_serie_formatos['numcampos'] || $busca_serie_formatos['numcampos']==1){
        $elimina_serie="DELETE FROM serie WHERE idserie=".$idserie;
        phpmkr_query($elimina_serie);
    }
}
function eliminar_categoria($idcategoria){
    $busca_categoria_formatos=busca_filtro_tabla("idformato","formato","fk_categoria_formato=".$idcategoria,"",$conn);
    if(!$busca_categoria_formatos['numcampos'] || $busca_categoria_formatos['numcampos']==1){
        $elimina_categoria="DELETE FROM categoria_formato WHERE idcategoria_formato=".$idcategoria;
        phpmkr_query($elimina_categoria);
    }
}
function elimina_modulo($nombre){
    $elimina_modulo_permiso="DELETE FROM modulo WHERE nombre='".$nombre."'";
    phpmkr_query($elimina_modulo_permiso);
    $elimina_modulo_crear="DELETE FROM modulo WHERE nombre='crear_".$nombre."'";
    phpmkr_query($elimina_modulo_crear);
}
function elimina_campos_formato($idformato){
    $campos_formato=busca_filtro_tabla("idcampos_formato","campos_formato","formato_idformato=".$idformato,"",$conn);
    for ($i=0; $i < $campos_formato['numcampos']; $i++) { 
        $elimina_caracteristicas="DELETE FROM caracteristicas_campos WHERE campos_formato=".$campos_formato[0]['idcampos_formato'];
        phpmkr_query($elimina_caracteristicas);
        $elimina_campo="DELETE FROM campos_formato WHERE idcampos_formato=".$campos_formato[0]['idcampos_formato'];
        phpmkr_query($elimina_campo);
    }
}
function elimina_funciones_formato($idformato){
    $elimina_funciones_formato="DELETE FROM funciones_formato WHERE formato_idformato=".$idformato;
    phpmkr_query($elimina_funciones_formato);
}
function elimina_funciones_formato_accion($idformato){
    $elimina_funciones_formato_accion="DELETE FROM funciones_formato_accion WHERE formato_idformato=".$idformato;
    phpmkr_query($elimina_funciones_formato_accion);
}

function asignar_permisos_cerok(){
	$modulos=busca_filtro_tabla("idmodulo","modulo","","",$conn);
	for($i=0;$i<$modulos['numcampos'];$i++){
		$sqlp="INSERT INTO permiso (funcionario_idfuncionario,modulo_idmodulo,accion) VALUES (1,".$modulos[$i]['idmodulo'].",1)";
		phpmkr_query($sqlp);
	}
}


?>