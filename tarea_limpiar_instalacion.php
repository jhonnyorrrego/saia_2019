<?php
if(!isset($_REQUEST["0k"])){
	die("--");
}
include_once("db.php");
echo "Ejecutando limpieza, espere un momento por favor<br />";

//-----------------limpiar base de datos------------/
//$conn -> Ejecutar_Sql("TRUNCATE TABLE accion");
$conn->Ejecutar_Sql("TRUNCATE TABLE almacenamiento");
$conn->Ejecutar_Sql("TRUNCATE TABLE anexos");
$conn -> Ejecutar_Sql("TRUNCATE TABLE anexos_despacho");
$conn -> Ejecutar_Sql("TRUNCATE TABLE anexos_transferencia");
$conn -> Ejecutar_Sql("TRUNCATE TABLE anexos_version");
$conn -> Ejecutar_Sql("TRUNCATE TABLE anexos_vinculados");
$conn->Ejecutar_Sql("TRUNCATE TABLE asignacion");
$conn->Ejecutar_Sql("TRUNCATE TABLE autoguardado");
$conn->Ejecutar_Sql("TRUNCATE TABLE binario");
//$conn->Ejecutar_Sql("TRUNCATE TABLE busqueda");
//$conn->Ejecutar_Sql("TRUNCATE TABLE busqueda_componente");
//$conn->Ejecutar_Sql("TRUNCATE TABLE busqueda_condicion");
//$conn->Ejecutar_Sql("TRUNCATE TABLE busqueda_condicion_enlace");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE busqueda_encabezado");
$conn -> Ejecutar_Sql("TRUNCATE TABLE busqueda_filtro");
$conn -> Ejecutar_Sql("TRUNCATE TABLE busqueda_filtro_temp");
//$conn->Ejecutar_Sql("TRUNCATE TABLE busqueda_grafico");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE busqueda_grafico_serie");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE busqueda_indicador");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE busquedas");
$conn->Ejecutar_Sql("TRUNCATE TABLE buzon_entrada");
$conn->Ejecutar_Sql("TRUNCATE TABLE buzon_salida");
$conn -> Ejecutar_Sql("TRUNCATE TABLE caja");
//$conn->Ejecutar_Sql("TRUNCATE TABLE calendario_saia");
$conn -> Ejecutar_Sql("TRUNCATE TABLE campos");
//$conn->Ejecutar_Sql("TRUNCATE TABLE campos_formato");
//$conn->Ejecutar_Sql("TRUNCATE TABLE caracteristicas_campos");
//$conn->Ejecutar_Sql("TRUNCATE TABLE cargo");
//$conn->Ejecutar_Sql("TRUNCATE TABLE carrusel");
//$conn->Ejecutar_Sql("TRUNCATE TABLE categoria_formato");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_beneficios");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_categoria_viaje");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_centro_costo");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_empresa_trans");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_etapa_actividad");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_indice_saia");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_material");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_motivo_incapacidad");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_ventanilla");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE cf_verificacion_ingreso");
$conn->Ejecutar_Sql("TRUNCATE TABLE comentario_img");
$conn -> Ejecutar_Sql("TRUNCATE TABLE comentario_pdf");
//$conn->Ejecutar_Sql("TRUNCATE TABLE configuracion");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE contador");
//$conn->Ejecutar_Sql("TRUNCATE TABLE contenidos_carrusel");
$conn->Ejecutar_Sql("TRUNCATE TABLE datos_ejecutor");
//$conn->Ejecutar_Sql("TRUNCATE TABLE departamento");
//$conn->Ejecutar_Sql("TRUNCATE TABLE dependencia");
//$conn->Ejecutar_Sql("TRUNCATE TABLE dependencia_cargo");
$conn -> Ejecutar_Sql("TRUNCATE TABLE diagram");
$conn -> Ejecutar_Sql("TRUNCATE TABLE diagram_closed");
$conn->Ejecutar_Sql("TRUNCATE TABLE diagram_instance");
$conn->Ejecutar_Sql("TRUNCATE TABLE digitalizacion");
$conn->Ejecutar_Sql("TRUNCATE TABLE documento");
$conn->Ejecutar_Sql("TRUNCATE TABLE documento_accion");
$conn->Ejecutar_Sql("TRUNCATE TABLE documento_anulacion");
$conn->Ejecutar_Sql("TRUNCATE TABLE documento_etiqueta");
$conn -> Ejecutar_Sql("TRUNCATE TABLE documento_limite");
$conn -> Ejecutar_Sql("TRUNCATE TABLE documento_por_vincular");
$conn -> Ejecutar_Sql("TRUNCATE TABLE documento_ruta_aprob");
$conn->Ejecutar_Sql("TRUNCATE TABLE documento_verificacion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE documento_version");
$conn->Ejecutar_Sql("TRUNCATE TABLE documento_vinculados");
$conn -> Ejecutar_Sql("TRUNCATE TABLE dt_actividad_tarea");
$conn -> Ejecutar_Sql("TRUNCATE TABLE dt_estado_actividad");
$conn -> Ejecutar_Sql("TRUNCATE TABLE editor_archivo");
$conn->Ejecutar_Sql("TRUNCATE TABLE ejecutor");
//$conn->Ejecutar_Sql("TRUNCATE TABLE encabezado_formato");
//$conn->Ejecutar_Sql("TRUNCATE TABLE entidad");
$conn -> Ejecutar_Sql("TRUNCATE TABLE entidad_caja");
$conn->Ejecutar_Sql("TRUNCATE TABLE entidad_expediente");
$conn->Ejecutar_Sql("TRUNCATE TABLE entidad_pretexto");
//$conn->Ejecutar_Sql("TRUNCATE TABLE entidad_serie");
$conn->Ejecutar_Sql("TRUNCATE TABLE error");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE estado_documento");
$conn->Ejecutar_Sql("TRUNCATE TABLE etiqueta");
$conn->Ejecutar_Sql("TRUNCATE TABLE evento");
$conn -> Ejecutar_Sql("TRUNCATE TABLE evento_despacho");
$conn -> Ejecutar_Sql("TRUNCATE TABLE expediente");
$conn -> Ejecutar_Sql("TRUNCATE TABLE expediente_abce");
$conn -> Ejecutar_Sql("TRUNCATE TABLE expediente_doc");
$conn -> Ejecutar_Sql("TRUNCATE TABLE filtro_grafica");
$conn -> Ejecutar_Sql("TRUNCATE TABLE filtro_reporte");
$conn->Ejecutar_Sql("TRUNCATE TABLE folder");
//$conn->Ejecutar_Sql("TRUNCATE TABLE formato");
//$conn->Ejecutar_Sql("TRUNCATE TABLE formato_ruta");


/*$formatos=busca_filtro_tabla("nombre_tabla","formato","","",$conn);
	for($i=0;$i<$formatos["numcampos"];$i++)	
    $conn->Ejecutar_Sql("TRUNCATE TABLE ".$formatos[$i]["nombre_tabla"]);*/
    

//$conn->Ejecutar_Sql("TRUNCATE TABLE funcion");
//$conn->Ejecutar_Sql("TRUNCATE TABLE funcionario");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE funcionario_editor");
$conn -> Ejecutar_Sql("TRUNCATE TABLE funcionario_validacion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE funciones_busqueda");
//$conn->Ejecutar_Sql("TRUNCATE TABLE funciones_formato");
//$conn->Ejecutar_Sql("TRUNCATE TABLE funciones_formato_accion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE funciones_paso");
$conn -> Ejecutar_Sql("TRUNCATE TABLE funciones_paso_accion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE grafico_serie");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE indicador");
$conn -> Ejecutar_Sql("TRUNCATE TABLE lista_negra_acceso");
$conn -> Ejecutar_Sql("TRUNCATE TABLE listado_tareas");
$conn->Ejecutar_Sql("TRUNCATE TABLE log_acceso");
$conn -> Ejecutar_Sql("TRUNCATE TABLE log_acceso_editor");
$conn->Ejecutar_Sql("TRUNCATE TABLE mensaje_formato");
$conn -> Ejecutar_Sql("TRUNCATE TABLE migrations");
//$conn->Ejecutar_Sql("TRUNCATE TABLE modulo");
//$conn->Ejecutar_Sql("TRUNCATE TABLE municipio");
$conn -> Ejecutar_Sql("TRUNCATE TABLE municipio_exterior");
$conn -> Ejecutar_Sql("TRUNCATE TABLE notas_pdf");
$conn -> Ejecutar_Sql("TRUNCATE TABLE noticia_index");
$conn->Ejecutar_Sql("TRUNCATE TABLE pagina");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pagina_vinculados");
//$conn->Ejecutar_Sql("TRUNCATE TABLE pais");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_accion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_anexos");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_busqueda");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_campos");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_componente");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_encabezado");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_esquema");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_func_param");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_funcion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_funcion_exe");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_impresion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_include");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_libreria");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_libreria_def");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_pdf");
$conn -> Ejecutar_Sql("TRUNCATE TABLE pantalla_ruta");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_actividad");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_actividad_anexo");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_actividad_programacion");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_condicional");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_condicional_admin");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_devolucion");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_documento");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_enlace");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_enlace_temporal");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_evento");
$conn -> Ejecutar_Sql("TRUNCATE TABLE paso_inst_terminacion");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_instancia_pendiente");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_instancia_rastro");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_instancia_terminada");
$conn->Ejecutar_Sql("TRUNCATE TABLE paso_rastro");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE perfil");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE permiso");
$conn->Ejecutar_Sql("TRUNCATE TABLE permiso_anexo");
$conn->Ejecutar_Sql("TRUNCATE TABLE permiso_documento");
$conn -> Ejecutar_Sql("TRUNCATE TABLE permiso_formato");
$conn->Ejecutar_Sql("TRUNCATE TABLE permiso_funcionario");
$conn->Ejecutar_Sql("TRUNCATE TABLE permiso_listado_tareas");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE permiso_perfil");
$conn->Ejecutar_Sql("TRUNCATE TABLE pretexto");
$conn->Ejecutar_Sql("TRUNCATE TABLE prioridad_documento");

$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_cache");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_cache_index");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_cache_messages");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_cache_shared");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_cache_thread");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_contactgroupmembers");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_contactgroups");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_contacts");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_dictionary");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_identities");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_searches");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_session");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_system");
$conn -> Ejecutar_Sql("TRUNCATE TABLE rcmail_users");

$conn -> Ejecutar_Sql("TRUNCATE TABLE reemplazo_documento");
$conn -> Ejecutar_Sql("TRUNCATE TABLE reemplazo_equivalencia");
$conn -> Ejecutar_Sql("TRUNCATE TABLE reemplazo_expediente");
$conn -> Ejecutar_Sql("TRUNCATE TABLE reemplazo_saia");
//$conn -> Ejecutar_Sql("TRUNCATE TABLE reporte");
$conn->Ejecutar_Sql("TRUNCATE TABLE respuesta");
$conn->Ejecutar_Sql("TRUNCATE TABLE ruta");
$conn->Ejecutar_Sql("TRUNCATE TABLE salidas");
$conn -> Ejecutar_Sql("TRUNCATE TABLE seguimiento_planes");
//$conn->Ejecutar_Sql("TRUNCATE TABLE serie");
//$conn->Ejecutar_Sql("TRUNCATE TABLE tarea");
$conn -> Ejecutar_Sql("TRUNCATE TABLE tarea_dig");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas");
$conn -> Ejecutar_Sql("TRUNCATE TABLE tareas_avance");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_buzon");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado_anexos");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado_etiquetas");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado_evalua");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado_notas");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado_recur");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_listado_tiempo");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_planeadas");
$conn->Ejecutar_Sql("TRUNCATE TABLE tareas_progreso");
$conn -> Ejecutar_Sql("TRUNCATE TABLE tmp_tarea_dig");
$conn -> Ejecutar_Sql("TRUNCATE TABLE version_anexos");
$conn -> Ejecutar_Sql("TRUNCATE TABLE version_documento");
$conn -> Ejecutar_Sql("TRUNCATE TABLE version_notas");
$conn -> Ejecutar_Sql("TRUNCATE TABLE version_pagina");
$conn -> Ejecutar_Sql("TRUNCATE TABLE version_pivote_anexo");
//-----------------termina limpieza base de datos------------/

$conn -> Ejecutar_Sql("update contador set consecutivo=1");

//limpiar_formatos();
//limpiar_busquedas();
//limpiar_indicadores();
//limpiar_funcionarios();
//asignar_permisos_cerok();

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

		$elimina_formato2 = "DROP TABLE " . $formatos_eliminar[$i]['nombre_tabla'];
		phpmkr_query($elimina_formato2);
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
