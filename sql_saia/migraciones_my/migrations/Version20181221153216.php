<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181221153216 extends AbstractMigration
{
    private $busqueda = array(
        array('idbusqueda' => '1','nombre' => 'funcionario','etiqueta' => 'funcionarios','estado' => '1','ancho' => '200','campos' => 'f.nombres,f.apellidos,f.nit,f.funcionario_codigo,f.login,f.estado,f.email','llave' => 'f.idfuncionario','tablas' => 'funcionario f','ruta_libreria' => 'pantallas/funcionario/librerias.php,pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php,pantallas/funcionario/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '2','nombre' => 'cargo','etiqueta' => 'cargos','estado' => '1','ancho' => '200','campos' => 'nombre','llave' => 'idcargo','tablas' => 'cargo','ruta_libreria' => 'pantallas/cargo/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '3','nombre' => 'documentos_recibidos','etiqueta' => 'documentos recibidos','estado' => '1','ancho' => '200','campos' => 'a.idtransferencia,a.destino,a.fecha,a.origen,b.iddocumento,b.numero,lower(b.plantilla) as plantilla,b.fecha_limite,b.descripcion,150 as limit_description','llave' => 'b.iddocumento','tablas' => 'buzon_salida a,documento b','ruta_libreria' => 'pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'views/buzones/utilidades/recibidos.php','cantidad_registros' => '20','tiempo_refrescar' => '1000','ruta_visualizacion' => 'views/buzones/listado.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '4','nombre' => 'temas_saia','etiqueta' => 'Temas Saia','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => NULL,'ruta_visualizacion' => NULL,'tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '5','nombre' => 'documentos_enviados','etiqueta' => 'Documentos enviados','estado' => '1','ancho' => '200','campos' => 'a.idtransferencia,a.destino,a.fecha,a.origen,b.iddocumento,b.numero,lower(b.plantilla) as plantilla,b.fecha_limite,b.descripcion,150 as limit_description','llave' => 'b.iddocumento','tablas' => 'buzon_salida a,documento b','ruta_libreria' => 'pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'views/buzones/utilidades/recibidos.php','cantidad_registros' => '20','tiempo_refrescar' => '1000','ruta_visualizacion' => 'views/buzones/listado.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '6','nombre' => 'busqueda_documento','etiqueta' => 'busqueda de documentos','estado' => '1','ancho' => '200','campos' => 'a.numero,a.fecha, a.descripcion,a.estado,a.plantilla,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/busqueda_documento/librerias_busqueda_documento.php,pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '7','nombre' => 'pendiente_ingresar','etiqueta' => 'Pendientes por Ingresar','estado' => '1','ancho' => '200','campos' => 'a.numero,a.fecha,a.serie,a.plantilla,a.tipo_ejecutor,a.descripcion,a.estado,a.ejecutor,a.pdf,a.tipo_radicado,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_pendientes_entrada.php,distribucion/funciones_distribucion.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '8','nombre' => 'no_transferidos','etiqueta' => 'No transferidos','estado' => '1','ancho' => '200','campos' => 'a.numero,a.fecha,a.descripcion,a.serie,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a left join buzon_salida z on (a.iddocumento = z.archivo_idarchivo)','ruta_libreria' => 'pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '9','nombre' => 'ingresados_radicacion','etiqueta' => 'Ingresados','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => NULL,'ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_transferencias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '10','nombre' => 'pendiente_salida','etiqueta' => 'Pendientes salida','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '11','nombre' => 'dependencia_cargo','etiqueta' => 'roles','estado' => '1','ancho' => '200','campos' => 'a.nombres,a.apellidos,a.login,b.nombre as nom_dependencia,c.nombre as nom_cargo, case d.estado when 0 then \'inactivo\' when 1 then \'activo\' end as estado_rol, case c.estado when 0 then \'inactivo\' when 1 then \'activo\'  end as estado_car, case b.estado when 0 then \'inactivo\' when 1 then \'activo\' end as estado_dep','llave' => 'd.iddependencia_cargo','tablas' => 'funcionario a, dependencia b, cargo c, dependencia_cargo d','ruta_libreria' => 'pantallas/rol/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '12','nombre' => 'ejecutor_antiguo','etiqueta' => 'ejecutores','estado' => '1','ancho' => '200','campos' => 'a.nombre,a.identificacion,a.fecha_ingreso','llave' => 'a.idejecutor','tablas' => 'ejecutor a','ruta_libreria' => 'pantallas/remitente/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '16','nombre' => 'modulo','etiqueta' => 'modulos','estado' => '1','ancho' => '200','campos' => 'a.nombre,a.etiqueta,a.enlace,a.destino,a.imagen,a.cod_padre,a.permiso_admin,a.orden,a.tipo','llave' => 'a.idmodulo','tablas' => 'modulo a','ruta_libreria' => 'pantallas/modulo/librerias.php','ruta_libreria_pantalla' => 'pantallas/modulo/js/validaciones.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '17','nombre' => 'busqueda_avanzada','etiqueta' => 'busqueda avanzada','estado' => '1','ancho' => '250','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_busqueda_avanzada.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=33','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '19','nombre' => 'configuracion','etiqueta' => 'Configuracion','estado' => '1','ancho' => '200','campos' => '','llave' => '','tablas' => '','ruta_libreria' => 'pantallas/configuracion/librerias.php,pantallas/admin_cf/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '20','nombre' => 'componentes','etiqueta' => 'Componentes','estado' => '1','ancho' => '200','campos' => 'A.nombre as nombre_busqueda,A.etiqueta as etiqueta_busqueda,A.estado as estado_busqueda,A.ancho as ancho_busqueda,A.campos,A.llave,A.tablas,A.ruta_libreria,B.campos_adicionales,B.tablas_adicionales,B.ordenado_por,B.agrupado_por,A.idbusqueda','llave' => 'B.idbusqueda_componente','tablas' => 'busqueda A, busqueda_componente B','ruta_libreria' => 'pantallas/busquedas/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '21','nombre' => 'evento','etiqueta' => 'Historial','estado' => '1','ancho' => '200','campos' => 'A.funcionario_codigo,A.fecha,A.tabla_e,A.estado,A.registro_id,B.nombres,B.apellidos','llave' => 'A.idevento','tablas' => 'evento A, funcionario B','ruta_libreria' => 'pantallas/evento/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '22','nombre' => 'activar_documento','etiqueta' => 'Activar documentos','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/documento/busqueda_avanzada_activar.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '23','nombre' => 'listado_flujos','etiqueta' => 'Listado de flujos','estado' => '1','ancho' => '200','campos' => 'a.title,a.description,a.publico, a.createdDate,a.lastUpdate','llave' => 'a.id','tablas' => 'diagram a','ruta_libreria' => 'bpmn/bpmn/librerias.php','ruta_libreria_pantalla' => 'pantallas/diagramas/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '24','nombre' => 'documentos_importantes','etiqueta' => 'Documentos con Indicador','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a, prioridad_documento b','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_prioridad_documentos.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '25','nombre' => 'borradores','etiqueta' => 'Borradores','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_borradores.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '26','nombre' => 'anulaciones','etiqueta' => 'Anulaciones','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.plantilla,a.numero,a.serie,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_proceso.php,pantallas/documento/librerias_anulaciones.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '27','nombre' => 'todos_documentos','etiqueta' => 'Todos los documentos','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_busqueda_avanzada.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=96','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '28','nombre' => 'datos_documento','etiqueta' => 'Datos del documento','estado' => '1','ancho' => '200','campos' => 'a.*','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/anexos/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '31','nombre' => 'busquedas','etiqueta' => 'listado de busquedas','estado' => '1','ancho' => '200','campos' => 'A.nombre,A.estado,A.etiqueta,A.campos,A.tablas,A.ruta_libreria','llave' => 'A.idbusqueda','tablas' => 'busqueda A','ruta_libreria' => 'pantallas/busquedas/librerias.php','ruta_libreria_pantalla' => '','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '34','nombre' => 'despachados','etiqueta' => 'Despachados','estado' => '1','ancho' => '200','campos' => 'a.numero,a.fecha,a.descripcion,a.plantilla,a.tipo_ejecutor,a.serie,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias_tramitados.php,pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '35','nombre' => 'almacenamiento','etiqueta' => 'Almacenamiento','estado' => '1','ancho' => '200','campos' => 'a.fondo,a.subseccion,a.division,a.codigo,a.serie_idserie,a.no_carpetas,a.no_cajas,a.no_consecutivo,a.no_correlativo,a.fecha_extrema_i,a.fecha_extrema_f,a.estanteria,a.panel,a.material,a.seguridad','llave' => 'a.idcaja','tablas' => 'caja a','ruta_libreria' => 'pantallas/almacenamiento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '36','nombre' => 'vinculados_carpetas','etiqueta' => 'Vinculados a carpetas','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/almacenamiento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '1000','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '37','nombre' => 'expediente','etiqueta' => 'Mis expedientes','estado' => '1','ancho' => '200','campos' => 'distinct a.fecha,a.nombre,a.descripcion,a.cod_arbol,a.estado_cierre,a.nombre_serie,a.propietario,agrupador','llave' => 'a.idexpediente','tablas' => 'vexpediente_serie a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_proceso.php,pantallas/expediente/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php,pantallas/expediente/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_expediente.php?variable_busqueda=1','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '38','nombre' => 'reporte_contacto','etiqueta' => 'Reporte de contactos','estado' => '1','ancho' => '200','campos' => 'A.documento_iddocumento','llave' => 'A.documento_iddocumento','tablas' => 'ft_registro_cliente A','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_proceso.php,pantallas/expediente/librerias.php,formatos/registro_cliente/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php,pantallas/expediente/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '44','nombre' => 'listado_formatos','etiqueta' => 'Admin. Formatos','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => 'pantallas/formato/librerias_formato.php,pantallas/plantillas_word/librerias.php,pantallas/pantallas/librerias.php,pantallas/pantallas/librerias.php','ruta_libreria_pantalla' => '','cantidad_registros' => '20','tiempo_refrescar' => '1000','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '47','nombre' => 'documentos_propios','etiqueta' => 'Documentos propios','estado' => '1','ancho' => '200','campos' => NULL,'llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias_busqueda_avanzada.php,pantallas/documento/librerias_documentos_propios.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '48','nombre' => 'cajas','etiqueta' => 'Cajas','estado' => '1','ancho' => '200','campos' => 'a.estanteria,a.panel,a.material,a.seguridad,a.no_consecutivo,a.fondo,a.seccion,a.subseccion,a.codigo,a.codigo_dependencia,a.codigo_serie','llave' => 'a.idcaja','tablas' => 'caja a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_proceso.php,pantallas/caja/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php,pantallas/caja/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_caja.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '49','nombre' => 'busquedas_informacion_documento','etiqueta' => 'Informaci&oacute;n documento','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => 'pantallas/documento/listado_informacion_documento.php,pantallas/documento/librerias.php,pantallas/pagina/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busqueda/componentes_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '50','nombre' => 'contador','etiqueta' => 'contador','estado' => '1','ancho' => '200','campos' => 'idcontador','llave' => 'nombre','tablas' => 'contador','ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '53','nombre' => 'documentos_destacados','etiqueta' => 'Documentos destacados','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor','llave' => 'a.iddocumento','tablas' => 'documento a, prioridad_documento b','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_prioridad_documentos.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '54','nombre' => 'reporte_solicitud_prestamo','etiqueta' => 'Prestamo','estado' => '1','ancho' => '200','campos' => NULL,'llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'formatos/solicitud_prestamo/librerias.php','ruta_libreria_pantalla' => 'formatos/solicitud_prestamo/funciones_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '55','nombre' => 'listado_tareas','etiqueta' => 'Tareas','estado' => '1','ancho' => '200','campos' => 'a.fecha_tarea,a.tarea,a.responsable,a.descripcion,a.prioridad,a.ejecutor, documento_iddocumento,a.estado_tarea','llave' => 'a.idtareas','tablas' => 'tareas a','ruta_libreria' => 'pantallas/tareas/librerias.php, pantallas/lib/acciones_kaiten.js','ruta_libreria_pantalla' => 'pantallas/tareas/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => '1','elastic' => '0'),
        array('idbusqueda' => '56','nombre' => 'Reemplazos','etiqueta' => 'Reemplazos','estado' => '1','ancho' => '200','campos' => 'f.nombres,f.apellidos,f.nit,f.funcionario_codigo,f.login,f.estado,f.email','llave' => 'A.idreemplazo_saia','tablas' => 'funcionario f','ruta_libreria' => 'pantallas/reemplazos/librerias.php,pantallas/documento/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '59','nombre' => 'versiones_documento','etiqueta' => 'Versiones de documento','estado' => '1','ancho' => '200','campos' => 'a.numero','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/versiones/reporte.php,pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '1000','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_documento.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '60','nombre' => 'formatos','etiqueta' => 'Formatos','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'listar_formatos.php?formato=no','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '62','nombre' => 'documentos_recibidos_proceso','etiqueta' => 'Documento Recibidos','estado' => '1','ancho' => '200','campos' => 'c.nombre,c.etiqueta,c.cod_padre','llave' => 'c.idformato','tablas' => 'formato c','ruta_libreria' => 'pantallas/documento/librerias_documentos_recibidos_proceso.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '64','nombre' => 'carrusel','etiqueta' => 'Carrusel','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'carrusel/sliderconfig.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '65','nombre' => 'noticias','etiqueta' => 'Noticias','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'noticia_index/noticia_detalles.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '66','nombre' => 'dependencias','etiqueta' => 'Dependencias','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'dependencia.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '67','nombre' => 'cargos','etiqueta' => 'Cargos','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'cargo.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '68','nombre' => 'series','etiqueta' => 'Series','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'serielist.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '69','nombre' => 'permisos','etiqueta' => 'Permisos','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'permiso_perfiladd.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '71','nombre' => 'calendario','etiqueta' => 'Calendario','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'calendario/festivos_list.php?cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '87','nombre' => 'lista_tareas','etiqueta' => 'Lista de Tareas','estado' => '1','ancho' => '100','campos' => 'a.idlistado_tareas,a.nombre_lista,a.descripcion_lista,a.cliente_proyecto','llave' => 'a.idlistado_tareas','tablas' => 'listado_tareas a left join permiso_listado_tareas p on a.idlistado_tareas=p.fk_listado_tareas and p.entidad_identidad=1','ruta_libreria' => 'pantallas/listado_tareas/librerias.php, pantallas/lib/acciones_kaiten.js ,pantallas/documento/librerias.php, pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_proceso.php','ruta_libreria_pantalla' => 'pantallas/listado_tareas/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_listado_tareas.php','tipo_busqueda' => '1','badge_cantidades' => '1','elastic' => '0'),
        array('idbusqueda' => '88','nombre' => 'tareas_listado_actualizar','etiqueta' => 'Tareas','estado' => '1','ancho' => '200','campos' => '','llave' => 'a.idtareas_listado','tablas' => 'tareas_listado a','ruta_libreria' => 'pantallas/tareas_listado/librerias.php','ruta_libreria_pantalla' => 'pantallas/tareas_listado/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => '1','elastic' => '0'),
        array('idbusqueda' => '89','nombre' => 'tareas_listado','etiqueta' => 'Lista de Tareas','estado' => '1','ancho' => '100','campos' => 'a.descripcion_tarea, a.nombre_tarea,a.responsable_tarea,a.listado_tareas_fk,a.progreso,a.prioridad,a.calificacion,a.estado_tarea,a.evaluador,a.creador_tarea,a.fecha_limite,a.generica,a.tiempo_estimado,a.fecha_inicio','llave' => 'a.idtareas_listado','tablas' => 'tareas_listado a LEFT JOIN listado_tareas b ON a.listado_tareas_fk=b.idlistado_tareas LEFT JOIN tareas_listado_etiquetas c ON a.idtareas_listado=c.tareas_listado_fk ','ruta_libreria' => 'pantallas/tareas_listado/reporte.php','ruta_libreria_pantalla' => 'pantallas/tareas_listado/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tareas_listado.php','tipo_busqueda' => '1','badge_cantidades' => '1','elastic' => '0'),
        array('idbusqueda' => '90','nombre' => 'subtareas_listado','etiqueta' => 'Lista de SubTareas','estado' => '1','ancho' => '100','campos' => 'a.descripcion_tarea, a.nombre_tarea,a.responsable_tarea,a.listado_tareas_fk,a.progreso,a.prioridad,a.calificacion,a.estado_tarea,a.creador_tarea,a.evaluador,a.fecha_limite,a.generica','llave' => 'a.idtareas_listado','tablas' => 'tareas_listado a LEFT JOIN tareas_listado_etiquetas c ON a.idtareas_listado=c.tareas_listado_fk ','ruta_libreria' => 'pantallas/tareas_listado/reporte.php','ruta_libreria_pantalla' => 'pantallas/tareas_listado/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_subtareas_listado.php','tipo_busqueda' => '1','badge_cantidades' => '1','elastic' => '0'),
        array('idbusqueda' => '91','nombre' => 'tareas_listado_planeador','etiqueta' => 'Lista de Tareas planeador','estado' => '1','ancho' => '100','campos' => 'a.descripcion_tarea, a.nombre_tarea,a.responsable_tarea,a.listado_tareas_fk,a.progreso,a.prioridad,a.calificacion,a.estado_tarea,a.evaluador,a.creador_tarea,a.fecha_limite','llave' => 'a.idtareas_listado','tablas' => 'tareas_listado a LEFT JOIN 
	tareas_planeadas b
		ON a.idtareas_listado=b.fk_tareas_listado','ruta_libreria' => 'pantallas/tareas_listado/reporte.php','ruta_libreria_pantalla' => 'pantallas/tareas_listado/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tareas_listado.php','tipo_busqueda' => '1','badge_cantidades' => '1','elastic' => '0'),
        array('idbusqueda' => '92','nombre' => 'reporte_estado_tareas_funcionario','etiqueta' => 'Tareas Actuales','estado' => '1','ancho' => '200','campos' => '','llave' => 'b.idtareas_listado','tablas' => 'funcionario a, listado_tareas c, tareas_listado b, tareas_planeadas d','ruta_libreria' => 'pantallas/tareas_listado/reporte_estado_tareas_funcionario.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '93','nombre' => 'reporte_tareas_cierre_dia','etiqueta' => 'Reporte Cierre D&iacute;a','estado' => '1','ancho' => '200','campos' => 'concat(a.nombres,\' \',a.apellidos) as nombre_funcionario','llave' => 'a.idfuncionario','tablas' => 'funcionario a','ruta_libreria' => 'pantallas/tareas_listado/reporte_tareas_cierre_dia.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/tareas_listado/busqueda_tareas_cierre_dia.php?idbusqueda_componente=266','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '94','nombre' => 'reporte_tareas_cierre_dia_filtrada','etiqueta' => 'Reporte Cierre D&iacute;a (Tareas)','estado' => '1','ancho' => '200','campos' => 'a.nombre_tarea,a.responsable_tarea,a.co_participantes,a.estado_tarea,a.progreso,a.seguidores,a.evaluador','llave' => 'a.idtareas_listado','tablas' => 'tareas_listado a left join tareas_listado_tiempo b ON a.idtareas_listado=b.fk_tareas_listado ','ruta_libreria' => 'pantallas/tareas_listado/reporte_tareas_cierre_dia_filtrada.php','ruta_libreria_pantalla' => 'pantallas/tareas_listado/reporte_tareas_cierre_dia_filtrada_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '95','nombre' => 'reporte_tareas_tiempos_registrados','etiqueta' => 'Tiempos Registrados','estado' => '1','ancho' => '200','campos' => 'b.nombre_tarea,b.listado_tareas_fk,a.hora_inicio,a.hora_final,b.tiempo_estimado,a.tiempo_registrado,a.comentario,a.fecha_inicio,a.funcionario_idfuncionario','llave' => 'a.idtareas_listado_tiempo','tablas' => 'tareas_listado_tiempo a LEFT JOIN tareas_listado b ON a.fk_tareas_listado=b.idtareas_listado LEFT JOIN listado_tareas c ON b.listado_tareas_fk=c.idlistado_tareas','ruta_libreria' => 'pantallas/tareas_listado/reporte_tareas_tiempos_registrados.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '98','nombre' => 'reporte_trd','etiqueta' => 'TRD GD','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => 'pantallas/serie/libreria_reporte_series.php','ruta_libreria_pantalla' => 'pantallas/serie/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '100','nombre' => 'reporte_acceso_usuarios','etiqueta' => 'Reporte  usuarios','estado' => '1','ancho' => '200','campos' => 'F.nit AS documento,concat(nombres,\'  \',apellidos) AS nombre,F.email AS correo,F.login','llave' => 'idfuncionario','tablas' => 'funcionario F','ruta_libreria' => 'pantallas/funcionario/libreria_reporte_acceso.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '101','nombre' => 'ejecutor','etiqueta' => 'ejecutores','estado' => '1','ancho' => '200','campos' => 'a.nombre,a.identificacion,a.fecha_ingreso','llave' => 'a.idejecutor','tablas' => 'vejecutor a','ruta_libreria' => 'pantallas/remitente/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '102','nombre' => 'reporte_inventario','etiqueta' => 'Reporte de Inventario','estado' => '1','ancho' => '200','campos' => 'a.plantilla','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/inventario_documental/libreria.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '103','nombre' => 'reporte_radicacion_correspondencia2','etiqueta' => 'Despacho Radicacion de Correspondencia','estado' => '1','ancho' => '200','campos' => 'd.numero','llave' => 'd.iddocumento','tablas' => 'documento d','ruta_libreria' => 'formatos/radicacion_entrada/libreria_reporte_radicacion.php','ruta_libreria_pantalla' => 'formatos/radicacion_entrada/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '105','nombre' => 'reporte_radicacion_correspondencia_dependencias','etiqueta' => 'Reporte de Correspondencia','estado' => '1','ancho' => '200','campos' => 'd.numero,d.ventanilla_radicacion','llave' => 'd.iddocumento','tablas' => 'documento d','ruta_libreria' => 'formatos/radicacion_entrada/libreria_reporte_radicacion.php','ruta_libreria_pantalla' => 'formatos/radicacion_entrada/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '106','nombre' => 'admin_categoria_formato','etiqueta' => 'Categoria Formato','estado' => '1','ancho' => '200','campos' => 'nombre,estado','llave' => 'idcategoria_formato','tablas' => 'categoria_formato','ruta_libreria' => 'pantallas/categoria_formato/reporte.php','ruta_libreria_pantalla' => 'pantallas/categoria_formato/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_categoria_formato.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '107','nombre' => 'radicacion_rapida_kaiten','etiqueta' => 'Radicaci&oacute;n Rapida','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1&cmd=resetall','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '109','nombre' => 'reporte_distribucion_general','etiqueta' => 'Distribuci&oacute;n','estado' => '1','ancho' => '200','campos' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion','llave' => 'a.iddistribucion','tablas' => 'distribucion a, documento b','ruta_libreria' => 'distribucion/funciones_distribucion.php','ruta_libreria_pantalla' => 'distribucion/funciones_distribucion_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '115','nombre' => 'reporte_expediente_grid_exp','etiqueta' => 'Inventario Documental','estado' => '1','ancho' => '200','campos' => 'a.nombre,a.codigo_numero,a.nombre_serie,a.fecha_extrema_i,a.fecha_extrema_f,a.indice_uno,a.indice_dos,a.indice_tres,a.no_folios,a.no_unidad_conservacion,a.soporte,a.notas_transf','llave' => 'a.idexpediente','tablas' => 'vexpediente_serie a','ruta_libreria' => 'pantallas/expediente/funciones_reporte_grid.php,pantallas/expediente/librerias.php','ruta_libreria_pantalla' => 'pantallas/expediente/funciones_reporte_grid_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '116','nombre' => 'reporte_docs_expediente_grid','etiqueta' => 'Indice de Expediente','estado' => '1','ancho' => '200','campos' => 'C.expediente_idexpediente,B.fecha AS fecha,C.documento_iddocumento','llave' => 'a.idexpediente','tablas' => 'vexpediente_serie a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_proceso.php,pantallas/expediente/librerias.php,pantallas/expediente/funciones_reporte_grid.php','ruta_libreria_pantalla' => 'pantallas/expediente/funciones_reporte_grid_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '120','nombre' => 'usuarios_concurrentes','etiqueta' => 'Reporte Usuario Concurrentes','estado' => '1','ancho' => '200','campos' => 'nit,nombre_completo,login,cant_conexiones','llave' => 'funcionario_codigo','tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '127','nombre' => 'reporte_radicacion_correspondencia_elastic','etiqueta' => 'Despacho Radicaci&oacute;n de Correspondencia Elastic','estado' => '1','ancho' => '200','campos' => '{"filter": [    { "term":  { "documento.estado": "aprobado" }},    { "term":  { "ft_radicacion_entrada.despachado": "1" }},    { "terms":  { "ft_radicacion_entrada.tipo_destino": [1, 2] }},    {"has_child":{                    "type" : "DESTINO_RADICACION",                     "query" : {"term" : {"ft_destino_radicacion.estado_item":"1"}},                   "inner_hits" : {"from" : 0}                    }                }]}','llave' => 'documento.iddocumento','tablas' => '{"index" : "radicacion_entrada"}','ruta_libreria' => 'formatos_cliente/radicacion_entrada/libreria_reporte_radicacion.php','ruta_libreria_pantalla' => 'formatos_cliente/radicacion_entrada/adicionales_js.php','cantidad_registros' => '300','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '1'),
        array('idbusqueda' => '128','nombre' => 'ayuda','etiqueta' => 'Ayuda','estado' => '1','ancho' => '200','campos' => NULL,'llave' => 'idmanual','tablas' => NULL,'ruta_libreria' => 'pantallas/manuales/librerias.php','ruta_libreria_pantalla' => NULL,'cantidad_registros' => NULL,'tiempo_refrescar' => NULL,'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '129','nombre' => 'pantallas','etiqueta' => 'Pantallas','estado' => '1','ancho' => '200','campos' => '','llave' => NULL,'tablas' => '','ruta_libreria' => 'pantallas/pantallas/librerias.php','ruta_libreria_pantalla' => '','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '131','nombre' => 'generador_formatos','etiqueta' => 'Administraci&oacute;n de formatos','estado' => '1','ancho' => '200','campos' => NULL,'llave' => NULL,'tablas' => NULL,'ruta_libreria' => NULL,'ruta_libreria_pantalla' => NULL,'cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/formato/listado_formatos.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0'),
        array('idbusqueda' => '132','nombre' => 'etiquetados','etiqueta' => 'etiquetados','estado' => '1','ancho' => '200','campos' => 'a.iddocumento,a.ejecutor,a.numero,a.fecha,lower(a.plantilla) as plantilla,a.descripcion,150 as limit_description,fecha_limite','llave' => NULL,'tablas' => 'documento a,etiqueta_documento b,etiqueta c','ruta_libreria' => 'pantallas/documento/librerias.php','ruta_libreria_pantalla' => 'views/buzones/utilidades/recibidos.php','cantidad_registros' => '30','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busqueda/componentes_busqueda.php','tipo_busqueda' => '1','badge_cantidades' => NULL,'elastic' => '0')
    );
    private $busqueda_componente = array(
        array('idbusqueda_componente' => '1','busqueda_idbusqueda' => '4','tipo' => '3','conector' => '2','url' => 'views/configuracion/cambio_tema.php','etiqueta' => 'Temas Predeterminados','nombre' => 'interfaz_predeterminado_saia','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '3','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '2','busqueda_idbusqueda' => '4','tipo' => '3','conector' => '2','url' => 'pantallas/temas_saia/interfaz_saia.php','etiqueta' => 'Temas','nombre' => 'interfaz_saia','orden' => '2','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '7','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '3','busqueda_idbusqueda' => '1','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Funcionarios','nombre' => 'funcionario','orden' => '1','info' => '<table style="width: 100%;font-size:10px" class="" border="0px">
<tbody>
<tr>
    <td style="width:35%;">
        <strong>Nombres y Apellidos:</strong> <span style="color:#347BB8"><a style="cursor:pointer" class="kenlace_saia" enlace="funcionario.php?key={*idfuncionario*}" title="{*nombres*} {*apellidos*}" titulo="{*nombres*} {*apellidos*}" conector="iframe"> {*nombres*} {*apellidos*} </a> </span>
        <br/>
        <b>Identificaci&oacute;n:</b> <span style="color:#347BB8"> {*nit*}</span>
        <br/>
        <br/>
        {*barra_superior_funcionario@idfuncionario,nombres,apellidos*}
    </td>
    <td style="width:15%;">
        <b>Login:</b> <span style="color:#347BB8">{*login*}</span>
    </td>
    <td style="width:20%;">
        <b>Perfil:</b> <span style="color:#347BB8">{*nombre_perfil@perfil*}</span>
    </td>
    <td style="width:15%;">
        <b>Estado:</b> <span style="color:#347BB8">{*estado_funcionario@estado*}</span>
    </td>
    <td style="width:15%;">
        {*fotografia_funcionario@idfuncionario*}
    </td>
</tr>
</tbody>
</table> 
','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'f.perfil','tablas_adicionales' => 'perfil p','ordenado_por' => 'nombres','direccion' => 'asc','agrupado_por' => 'f.idfuncionario,f.nombres,f.apellidos,f.nit,f.funcionario_codigo,f.login,f.estado,f.email,f.perfil','busqueda_avanzada' => 'pantallas/funcionario/busqueda_avanzada_funcionario.php','acciones_seleccionados' => '','modulo_idmodulo' => '15','menu_busqueda_superior' => NULL,'enlace_adicionar' => 'funcionarioadd.php','encabezado_grillas' => NULL,'llave' => 'f.idfuncionario'),
        array('idbusqueda_componente' => '4','busqueda_idbusqueda' => '4','tipo' => '3','conector' => '2','url' => 'pantallas/modulo/botones_bootstrap.php','etiqueta' => 'Iconos Saia','nombre' => 'iconos_saia','orden' => '3','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '8','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '5','busqueda_idbusqueda' => '4','tipo' => '3','conector' => '2','url' => 'pantallas/logo/adicionar_logo.php','etiqueta' => 'Logo Ingreso','nombre' => 'logo_saia','orden' => '4','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '1188','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '6','busqueda_idbusqueda' => '2','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Cargos','nombre' => 'cargo','orden' => '2','info' => '{*barra_superior_cargo@idcargo*}<div>{*nombre*}<br><div enlace="cargoview.php?key={*idcargo*}" titulo="Ver cargo" conector="iframe" class="kenlace_saia btn btn-primary btn-mini" >Ver cargo</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/cargo/busqueda_avanzada_cargo.php','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'idcargo'),
        array('idbusqueda_componente' => '7','busqueda_idbusqueda' => '3','tipo' => '3','conector' => '2','url' => 'views/buzones/listado.php','etiqueta' => 'Documentos Recibidos','nombre' => 'documentos_recibidos','orden' => '1','info' => '<div class="" style="line-height:1;font-size: 12px;">
    <div class="row mx-0">
        {*origin_pending_document@iddocumento,origen,numero,fecha,plantilla,idtransferencia*}        
    </div>
    <div class="row mx-0">
        <div class="col-1 px-0">
            <div class="row p-0 m-0">
                <div class="col-12 p-0 text-center">{*unread@iddocumento,fecha*}</div>
                <div class="col-12 p-0 text-center">{*has_files@iddocumento*}</div>
                <div class="col-12 p-0 text-center">{*priority@iddocumento*}</div>
            </div>
        </div>
        <div class="col-11 pr-0">
            <p class="text-justify" style="line-height: 1;">
                {*limit_description@descripcion,limit_description*}
            </p>
        </div>
    </div>
    <div class="row mx-0 pt-1">
        <div class="col-1 px-0 text-center">
            <span class="my-2" id="checkbox_location" ></span>            
        </div>
        <div class="col">{*documental_type@iddocumento*}</div>
        <div class="col-auto text-right pr-0">{*expiration@fecha_limite*}</div>
    </div>
</div>','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => 'views/buzones/encabezado_recibidos.php','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => '','tablas_adicionales' => '','ordenado_por' => '','direccion' => '','agrupado_por' => '','busqueda_avanzada' => NULL,'acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '9','busqueda_idbusqueda' => '37','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_expediente.php?variable_busqueda=3','etiqueta' => 'Archivo Hist&oacute;rico','nombre' => 'documento_historico','orden' => '3','info' => '<div id="resultado_pantalla_{*idexpediente*}" class="well">{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'nombre_serie\'><b>Serie: </b>{*nombre_serie*}</div><br/><div class=\'descripcion_documento\'>{*descripcion*}</div></div>','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.idexpediente','direccion' => 'desc','agrupado_por' => 'a.idexpediente','busqueda_avanzada' => 'pantallas/expediente/buscar_expediente.php','acciones_seleccionados' => 'adicionar_expediente,transferencia_documental,prestamo_documento','modulo_idmodulo' => '1646','menu_busqueda_superior' => 'barra_superior_busqueda','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '10','busqueda_idbusqueda' => '37','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_expediente.php?variable_busqueda=2','etiqueta' => 'Archivo Central','nombre' => 'documento_central','orden' => '2','info' => '<div id="resultado_pantalla_{*idexpediente*}" class="well">{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'nombre_serie\'><b>Serie: </b>{*nombre_serie*}</div><br/><div class=\'descripcion_documento\'>{*descripcion*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.idexpediente','direccion' => 'desc','agrupado_por' => 'a.idexpediente','busqueda_avanzada' => 'pantallas/expediente/buscar_expediente.php','acciones_seleccionados' => 'adicionar_expediente,transferencia_documental,prestamo_documento','modulo_idmodulo' => '1645','menu_busqueda_superior' => 'barra_superior_busqueda','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '12','busqueda_idbusqueda' => '3','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Recibidos ultima semana','nombre' => 'pendientes_ultima_semana','orden' => '3','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'asignacion B','ordenado_por' => 'B.fecha_inicial','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => 'transferir_docs,terminar_docs,vincular_documentos','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '13','busqueda_idbusqueda' => '3','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Recibidos ultimo mes','nombre' => 'pendientes_ultimo_mes','orden' => '4','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'asignacion B','ordenado_por' => 'B.fecha_inicial','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => 'transferir_docs,terminar_docs,vincular_documentos','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '14','busqueda_idbusqueda' => '5','tipo' => '3','conector' => '2','url' => 'views/buzones/listado.php','etiqueta' => 'Documentos Enviados','nombre' => 'documentos_enviados','orden' => '1','info' => '<div class="" style="line-height:1;">
    <div class="row mx-0">
        {*origin_pending_document@iddocumento,origen,numero,fecha,plantilla,idtransferencia*}        
    </div>
    <div class="row mx-0">
        <div class="col-1 px-0">
            <div class="row p-0 m-0">
                <div class="col-12 p-0 text-center">{*unread@iddocumento,fecha*}</div>
                <div class="col-12 p-0 text-center">{*has_files@iddocumento*}</div>
                <div class="col-12 p-0 text-center">{*priority@iddocumento*}</div>
            </div>
        </div>
        <div class="col-11 pr-0">
            <p class="text-justify" style="line-height: 1;font-size: 12px;">
                {*limit_description@descripcion,limit_description*}
            </p>
        </div>
    </div>
    <div class="row mx-0 pt-1">
        <div class="col-1 px-0 text-center">
            <span class="my-2" id="checkbox_location" ></span>            
        </div>
        <div class="col">{*documental_type@iddocumento*}</div>
        <div class="col-auto text-right pr-0">{*expiration@fecha_limite*}</div>
    </div>
</div>','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => 'views/buzones/encabezado_recibidos.php','estado' => '2','ancho' => '200','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => '','direccion' => 'desc','agrupado_por' => '','busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '15','busqueda_idbusqueda' => '6','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Busqueda de documentos','nombre' => 'busqueda_documento','orden' => '1','info' => '<div>{*barra_superior_documento@iddocumento,plantilla,numero*}<b>Numero Radicado: {*numero*}</b><br><b>Fecha:</b>{*fecha*}<br><b>Descripcion:</b> {*descripcion*}<br>{*origen_documento@ejecutor,plantilla*}<br>{*plantilla_formato@plantilla*}<br>{*serie_documento@serie*}<br>{*fecha_documento@iddocumento*}{*estado_documento@iddocumento,estado,funcionario*}{*barra_inferior_documento@iddocumento,funcionario*}{*validacion_flujos@iddocumento*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'buzon_salida B','ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => 'A.iddocumento','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php','acciones_seleccionados' => 'vincular_documentos','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '16','busqueda_idbusqueda' => '7','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Pendientes por ingresar - Origen Externo','nombre' => 'pendientes_ingresar','orden' => '1','info' => 'numero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|fecha|{*fecha*}|center|-|Asunto|{*descripcion*}|-|Fecha Limite|{*fecha_limite*}|center','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'ft_radicacion_entrada b','ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '17','busqueda_idbusqueda' => '8','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'No transferidos','nombre' => 'no_transferidos','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'A.fecha','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => 'vincular_documentos','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '18','busqueda_idbusqueda' => '9','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Origen Externo','nombre' => 'origen_externo_entradas','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'documento a,formato c','ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=18','acciones_seleccionados' => 'vincular_documentos,transferir_docs','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '19','busqueda_idbusqueda' => '10','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Pendientes salida','nombre' => 'pendiente_salida','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'A.fecha','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => 'vincular_documentos','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '20','busqueda_idbusqueda' => '11','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Roles','nombre' => 'dependencia_cargo','orden' => '2','info' => '<div>
{*barra_superior_rol@iddependencia_cargo*}
<br>
<b>Login:</b> {*login*}<br>
<b>Nombres:</b> {*nombres*} {*apellidos*}<br>
<b>Dependencia:</b> {*nom_dependencia*}<br>
<b>Cargo:</b> {*nom_cargo*}
<br>
<b>Estado rol:</b> {*estado_rol*}
<br>
<b>Estado dependencia:</b> {*estado_dep*}
<br>
<b>Estado cargo:</b> {*estado_car*}
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/rol/busqueda_avanzada_rol.php','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => 'dependencia_cargoadd.php','encabezado_grillas' => NULL,'llave' => 'd.iddependencia_cargo'),
        array('idbusqueda_componente' => '21','busqueda_idbusqueda' => '12','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Ejecutores','nombre' => 'ejecutor','orden' => '1','info' => '<div>
{*mostrar_nombre@nombre,idejecutor*}<br>
<b>Identificacion:</b> {*identificacion*}<br>
<b>Fecha de ingreso:</b> {*fecha_ingreso*}
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idejecutor'),
        array('idbusqueda_componente' => '23','busqueda_idbusqueda' => '9','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Origen Interno','nombre' => 'origen_interno_salidas','orden' => '2','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '600','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'documento a,formato c','ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=23','acciones_seleccionados' => 'vincular_documentos,transferir_docs','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '30','busqueda_idbusqueda' => '16','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Modulos','nombre' => 'modulo','orden' => '2','info' => '<div>
{*barra_superior_modulo@idmodulo*}<br>
<b>Nombre:</b> {*nombre*}<br>
<b>Etiqueta:</b>{*etiqueta*}<br>
<b>Imagen:</b> {*imagen*}<br>
<b>tipo:</b> {*tipo*}<br>
<b>Enlace:</b> {*enlace*}<br>
<b>Destino:</b> {*destino*}<br>
<b>Padre:</b> {*nombre_padre@cod_padre*}<br>
<b>Orden:</b> {*orden*}<br>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/modulo/busqueda_avanzada_modulo.php','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => 'moduloadd.php?accion=adicionar','encabezado_grillas' => NULL,'llave' => 'a.idmodulo'),
        array('idbusqueda_componente' => '33','busqueda_idbusqueda' => '17','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Documentos','nombre' => 'listado_documentos_avanzado','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '470','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'buzon_salida z, formato C','ordenado_por' => 'A.fecha','direccion' => 'ASC','agrupado_por' => 'A.iddocumento','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '84','busqueda_idbusqueda' => '19','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Configuracion','nombre' => 'configuracion','orden' => '1','info' => 'Nombre|{*nombre*}|center|-|Valor|{*mostrar_valor_configuracion_encrypt@valor,encrypt*}|center|-|Tipo|{*tipo*}|center|-|Fecha|{*fecha*}|center|-|Acciones|{*barra_superior_configuracion@idconfiguracion*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'A.idconfiguracion,A.nombre,A.valor,A.tipo,A.fecha,A.encrypt','tablas_adicionales' => 'configuracion A','ordenado_por' => 'A.nombre','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/configuracion/busqueda_avanzada_configuracion.php?idbusqueda_componente=84','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'configuracionadd.php','encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '86','busqueda_idbusqueda' => '20','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Listado de componentes','nombre' => 'listado_componentes','orden' => '2','info' => '<div>
<b>idbusqueda:</b> {*idbusqueda*}<br>
<b>Etiqueta:</b> {*etiqueta_busqueda*}<br>
<b>Ruta libreria</b> {*ruta_libreria*}<br>
<b>Ancho</b> {*ancho_busqueda*}<br><br>
{*mostrar_consulta@campos,llave,tablas,campos_adicionales,tablas_adicionales,ordenado_por,agrupado_por,idbusqueda_componente,idbusqueda*}
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '600','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'B.idbusqueda_componente'),
        array('idbusqueda_componente' => '87','busqueda_idbusqueda' => '21','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'historial','nombre' => 'Evento','orden' => '1','info' => '<div>
<b>Funcionario:</b> {*nombres*} {*apellidos*}<br>
<b>Registro Id:</b> {*registro_id*}<br>
<b>Tabla:</b> {*tabla_e*}<br>
<b>Fecha:</b> {*fecha*}
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'A.idevento'),
        array('idbusqueda_componente' => '88','busqueda_idbusqueda' => '22','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Listado de documentos activos','nombre' => 'listado_documentos_activos','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>{*barra_inferior_documentos_activos@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '600','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '90','busqueda_idbusqueda' => '23','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Listado de flujos','nombre' => 'listado_flujos','orden' => '2','info' => '<div>{*barra_superior_diagramas@id*}
<br>
<b>Id:</b> {*id*}<br>
<b>Nombre:</b> {*title*}<br>
<b>Descripci&oacute;n:</b> {*description*}
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.title','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'bpmn/bpmn/adicionar_bpmn.php','encabezado_grillas' => NULL,'llave' => 'a.id'),
        array('idbusqueda_componente' => '92','busqueda_idbusqueda' => '22','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Listado de documentos','nombre' => 'listado_documentos_activar','orden' => '2','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>{*barra_inferior_documentos_noactivos@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_activar.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '93','busqueda_idbusqueda' => '24','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Documentos con Indicador','nombre' => 'documentos_importantes','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => 'formato C','ordenado_por' => 'a.fecha','direccion' => '','agrupado_por' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite,a.iddocumento','busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '94','busqueda_idbusqueda' => '25','tipo' => '3','conector' => '2','url' => 'views/buzones/listado.php','etiqueta' => 'Borradores','nombre' => 'borradores','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => 'views/buzones/encabezado.php','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'formato C','ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '95','busqueda_idbusqueda' => '26','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Anulaciones pendientes por procesar','nombre' => 'anulaciones_pendientes','orden' => '1','info' => '<div><b>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}{*fecha_creacion_documento@fecha,plantilla*}</b><br><br>{*descripcion*}<br><br>{*acciones_anulaciones@iddocumento*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'b.descripcion,b.fecha_solicitud','tablas_adicionales' => 'documento_anulacion b, funcionario c','ordenado_por' => 'b.fecha_solicitud','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '96','busqueda_idbusqueda' => '27','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Todos los documentos','nombre' => 'todos_documentos','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento_excel@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '470','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => 'a.iddocumento','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '98','busqueda_idbusqueda' => '28','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Anexos Documento','nombre' => 'anexos_documento','orden' => '1','info' => '<table class="table table-bordered">
<tr>
<td>{*vista_previa_anexo@idanexos,tipo*}</td>
<td>{*etiqueta*}</td>
<td>{*descargar_anexo@idanexos,ruta*}</td>
</tr>
</table>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'b.idanexos,b.ruta,b.etiqueta,b.tipo','tablas_adicionales' => 'anexos b','ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '99','busqueda_idbusqueda' => '26','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Anulaciones procesadas','nombre' => 'anulaciones_procesadas','orden' => '2','info' => '<div><b>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}{*fecha_creacion_documento@fecha,plantilla*}</b><br><br>{*descripcion*}{*estado_anulacion@iddocumento*}<br><br>{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'b.descripcion,b.fecha_solicitud','tablas_adicionales' => 'documento_anulacion B, funcionario f','ordenado_por' => 'b.fecha_solicitud','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '101','busqueda_idbusqueda' => '31','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'listado busquedas','nombre' => 'busquedas','orden' => '1','info' => '<div>{*barra_superior_busqueda@idbusqueda*}<b>Nombre:</b> {*nombre*}<br /><b>Etiqueta:</b>{*etiqueta*}<br /><b>Estado:</b>{*estado*}<br /><b>Tablas:</b> {*tablas*}<br /><b>Campos:</b>{*campos*}<br /><b>Librerias:</b> {*ruta_libreria*}','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.etiqueta','direccion' => 'asc','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => NULL,'menu_busqueda_superior' => 'menu_ingreso_elementos','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'A.idbusqueda'),
        array('idbusqueda_componente' => '105','busqueda_idbusqueda' => '34','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Despachados','nombre' => 'despachados','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<br><br><div>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '600','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'salidas b, formato c','ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => 'a.iddocumento','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_despachados.php','acciones_seleccionados' => 'vincular_documentos,transferir_docs','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '107','busqueda_idbusqueda' => '35','tipo' => '3','conector' => '2','url' => 'pantallas/almacenamiento/caja/cajaadd.php','etiqueta' => 'Adicionar caja','nombre' => 'adicionar_caja','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idcaja'),
        array('idbusqueda_componente' => '108','busqueda_idbusqueda' => '36','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Vinculados a carpetas','nombre' => 'vinculados_carpetas','orden' => '1','info' => '<div><div style=\'float:left;\' class=\'link kenlace_saia\' enlace=\'ordenar.php?key={*iddocumento*}&accion=mostrar&mostrar_formato=1\' conector=\'iframe\' titulo=\'Documento No.{*numero*}\'><b>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}</div> {*fecha_creacion_documento@fecha,plantilla*}</b><br><br>{*descripcion*}<br><br>{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => 'almacenamiento b','ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '109','busqueda_idbusqueda' => '35','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Carpetas','nombre' => 'carpetas','orden' => '3','info' => '<b>Nombre expediente:</b>{*nombre_expediente*}<br>
{*ver_carpeta@idfolder*}','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'b.nombre_expediente,b.idfolder','tablas_adicionales' => 'folder b','ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/almacenamiento/carpeta/busqueda_avanzada.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idcaja'),
        array('idbusqueda_componente' => '110','busqueda_idbusqueda' => '37','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_expediente.php?variable_busqueda=1','etiqueta' => 'Archivo de Gesti&oacute;n','nombre' => 'expediente','orden' => '1','info' => '<div id="resultado_pantalla_{*idexpediente*}" class="well">{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'descripcion_documento\'>{*mostrar_informacion_adicional_expediente@idexpediente*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.nombre','direccion' => 'desc','agrupado_por' => 'a.fecha,a.nombre,a.descripcion,a.cod_arbol,a.estado_cierre,a.nombre_serie,a.propietario,agrupador,a.idexpediente','busqueda_avanzada' => 'pantallas/expediente/buscar_expediente.php','acciones_seleccionados' => 'adicionar_expediente,compartir_expediente,transferencia_documental,prestamo_documento','modulo_idmodulo' => '1644','menu_busqueda_superior' => 'barra_superior_busqueda','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '111','busqueda_idbusqueda' => '37','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Expediente Documento','nombre' => 'expediente_documento','orden' => '1','info' => '<div id="resultado_pantalla_{*iddocumento*}" class="well"><b>{*origen_documento_expediente@iddocumento,numero,ejecutor,tipo_radicado,estado_doc,serie_doc,tipo_ejecutor*}</b>{*fecha_creacion_documento_expediente@fecha_doc,plantilla,iddocumento*}<br><br><div class=\'descripcion_documento\'>{*obtener_descripcion@descripcion_doc*}</div><div class=\'row-fluid\'>
{*barra_inferior_documento_expediente@iddocumento,numero,idexpediente*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => 'B.iddocumento,B.fecha AS fecha_doc, B.numero,B.descripcion AS descripcion_doc,B.estado AS estado_doc,B.serie AS serie_doc,B.tipo_radicado,B.plantilla,B.fecha_limite','tablas_adicionales' => 'documento B,expediente_doc C','ordenado_por' => 'B.fecha','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '122','busqueda_idbusqueda' => '38','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=122&no_slaces=1','etiqueta' => 'Reporte de contactos','nombre' => 'reporte_contacto','orden' => '3','info' => 'Detalle|{*mostrar_documento@documento_iddocumento*}|center|-Nombre Cliente|{*mostrar_nombre@nombre_cliente*}|center|-|nit.|{*mostrar_nit@nombre_cliente*}|center|-|Estado del cliente|{*mostrar_estado@estado_cliente*}|center|-|Sector|{*mostrar_sector@sector*}|center|-|Origen del documento|{*descripcion_origen_contacto*}|center|-|Direccion|{*mostrar_direccion@nombre_cliente*}|center|-|Pais|{*mostrar_pais@nombre_cliente*}|center|-|Departamento|{*mostrar_departamento@nombre_cliente*}|center|-|Ciudad|{*mostrar_municipio@nombre_cliente*}|center|-|P&aacute;gina web|{*pagina_web*}|center|','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'A.nombre_cliente,A.estado_cliente,A.sector,A.descripcion_origen_contacto,A.pagina_web','tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'A.documento_iddocumento'),
        array('idbusqueda_componente' => '148','busqueda_idbusqueda' => '44','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Admin. Formatos','nombre' => 'listado_formatos','orden' => '1','info' => '<div class="link kenlace_saia" enlace="formatos/detalle_formato.php?idformato={*idformato*}" conector="iframe" titulo="Detalles formato {*etiqueta*}" onclick=" ">
<dl class="dl-horizontal">
  <dt>Etiqueta</dt>
  <dd>{*etiqueta*}</dd>
</dl>
</div>
<dl class="dl-horizontal">
  <dt>nombre</dt>
  <dd>{*nombre*}</dd>
</dl>
<dl class="dl-horizontal">
  <dt>Idformato</dt>
  <dd>{*idformato*}</dd>
</dl>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'idformato,etiqueta,nombre','tablas_adicionales' => 'formato','ordenado_por' => 'etiqueta','direccion' => 'asc','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/formato/busqueda_avanzada_formato.php','acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => 'menu_principal_formatos@{*idformato*}','enlace_adicionar' => 'formatos/formatoadd.php','encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '158','busqueda_idbusqueda' => '47','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Documentos propios','nombre' => 'documentos_propios','orden' => '1','info' => 'No radicado|{*ver_documento_propio@iddocumento,numero*}|center|-|Fecha|{*parsear_fecha_propio@fecha*}|left|-|Asunto|{*descripcion*}|left|-|Formato|{*obtener_plantilla_propio@plantilla*}|left|-|Respuesta|{*respuestas_propio@iddocumento*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => 'a.numero,a.fecha,a.descripcion,plantilla','tablas_adicionales' => 'buzon_salida z','ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => 'a.iddocumento,a.numero,a.fecha,a.descripcion,plantilla','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_propio.php?idbusqueda_componente=158','acciones_seleccionados' => NULL,'modulo_idmodulo' => '1887','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '159','busqueda_idbusqueda' => '17','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_documento.php','etiqueta' => 'Documentos por serie','nombre' => 'documentos_serie','orden' => '2','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>
{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '470','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => 'a.iddocumento','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '160','busqueda_idbusqueda' => '37','tipo' => '2','conector' => '1','url' => NULL,'etiqueta' => 'Listado Cajas','nombre' => 'cajas','orden' => '4','info' => '<div title="Cajas" data-load=\'{"kConnector":"iframe","url":"../pantallas/busquedas/consulta_busqueda_caja.php?idbusqueda_componente=323","kTitle":"Cajas","kWidth":"320px"}\' class="items navigable">
<div class="head"></div>
<div class="label">Cajas</div>
<div class="tail"></div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '1647','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '162','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Notas del documento','nombre' => 'notas_documento','orden' => '1','info' => '<div><b>Fecha:</b>{*fecha*}<br /><b>Nota:</b>{*comentario*}<br /><b>Autor:</b> {*funcionario*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'B.documento_iddocumento,B.fecha,B.comentario,B.funcionario','tablas_adicionales' => 'comentario_img B','ordenado_por' => 'B.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '163','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Anexos','nombre' => 'anexos','orden' => '1','info' => '<div class="row-fluid">
	<div class="pull-left tooltip_saia_abajo" title="{*etiqueta*}">
		{*mostrar_etiqueta@etiqueta,tipo*}
	</div>
	<div>
		{*menu_informacion_documento@documento_iddocumento,idanexos,ruta,etiqueta,tipo*}
	</div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'C.documento_iddocumento,C.idanexos,C.ruta,C.etiqueta,C.tipo','tablas_adicionales' => 'anexos C','ordenado_por' => 'C.idanexos','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '164','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Paginas documento','nombre' => 'paginas_documento','orden' => '1','info' => '<div class="div_pagina" pagina="{*consecutivo*}"><img src="{*imagen_pagina_documento@imagen*}" class="img-polaroid pagina_documento enlace" idpagina="{*consecutivo*}" iddocumento="{*id_documento*}">&nbsp;<div class="npagina"><input type="checkbox" class="cb_pagina" value="{*consecutivo*}">&nbsp;P&aacute;gina {*pagina*}</div></div>','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'D.consecutivo,D.id_documento,D.imagen,D.ruta,D.pagina','tablas_adicionales' => 'pagina D','ordenado_por' => 'D.pagina','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '165','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Vinculados  como respuesta','nombre' => 'documentos_respuesta','orden' => '1','info' => '<div class="row-fluid"><div class="pull-left tootltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=\'pull-right\'><a href="#" enlace=\'ordenar.php?key={*iddocumento*}&mostrar_formato=1\' conector=\'iframe\'  titulo="Documento No.{*numero*}" class=\'kenlace_saia pull-left\' ><i class=\'icon-download tooltip_saia_izquierda\' title=\'Ver documento\'></i></a></div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'G.fecha, G.origen,A.numero,A.ejecutor,A.descripcion,A.iddocumento,A.plantilla','tablas_adicionales' => 'respuesta G, documento A','ordenado_por' => 'G.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '166','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Buzon salida','nombre' => 'buzon_salida','orden' => '1','info' => '<div {*obtener_color_clase@origen,destino*}><strong>Fecha:</strong>{*fecha*}<br /><strong>Nota:</strong> {*notas*}<br /><strong>Autor:</strong> {*funcionario@origen*}<div class="pull-right"></div></></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'E.archivo_idarchivo,E.fecha,E.notas,E.origen,E.destino,E.idtransferencia,E.nombre,E.ver_notas','tablas_adicionales' => 'buzon_salida E','ordenado_por' => 'E.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '167','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'asociado a','nombre' => 'documentos_relacionados','orden' => '1','info' => '<div class="row-fluid"><div class="pull-left tootltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=\'pull-right\'><a href="#" enlace=\'ordenar.php?key={*iddocumento*}&mostrar_formato=1\' conector=\'iframe\'  titulo="Documento No.{*numero*}" class=\'kenlace_saia pull-left\' ><i class=\'icon-download tooltip_saia_izquierda\' title=\'Ver documento\'></i></a></div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'G.fecha, G.origen,A.numero,A.ejecutor,A.descripcion,A.iddocumento,A.plantilla','tablas_adicionales' => 'respuesta G, documento A','ordenado_por' => 'G.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '168','busqueda_idbusqueda' => '50','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'contador','nombre' => 'contador','orden' => '1','info' => 'contador|{*idcontador*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'idcontado','direccion' => 'desc','agrupado_por' => 'idcontador','busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'nombre'),
        array('idbusqueda_componente' => '186','busqueda_idbusqueda' => '53','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Documentos destacados','nombre' => 'documentos_destacados','orden' => '1','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => 'a.iddocumento','busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '203','busqueda_idbusqueda' => '54','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Prestamo','nombre' => 'reporte_solicitud_prestamo','orden' => '2','info' => 'Fecha de solicitud|{*parsear_fecha_reserva1@fecha*}|left|-|Solicitante|{*nombre_solicitante@dependencia*}|left|-|Solicitud de Prestamo|{*enlace_documento_reservar@iddocumento,numero*}|center|-|Expediente|{*mostrar_informacion_expediente@fk_expediente*}|left|300|-|Desde|{*parsear_fecha_reserva2@fecha_prestamo_rep*}|left|-|Hasta|{*parsear_fecha_reserva3@fecha_devolucion_rep*}|left|-|Entrega|{*accion_entrega@idft_item_prestamo_exp,funcionario_prestamo,fecha_prestamo,observacion_prestamo,estado_prestamo*}|center|-|Devolucion|{*accion_devuelto@idft_item_prestamo_exp,funcionario_devoluci,fecha_devolucion,observacion_devolver,estado_prestamo*}|center|-|Tiempo transcurrido|{*tiempo_transcurrido_reserva@fecha_prestamo,fecha_devolucion*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'a.numero,a.fecha,b.dependencia,b.fecha_prestamo_rep,b.fecha_devolucion_rep,c.fk_expediente,c.idft_item_prestamo_exp,c.funcionario_prestamo,c.fecha_prestamo,c.observacion_prestamo,c.estado_prestamo,c.funcionario_devoluci,c.fecha_devolucion,c.observacion_devolver','tablas_adicionales' => 'ft_solicitud_prestamo b, ft_item_prestamo_exp c','ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => 'funcion_entregar_devolver','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '205','busqueda_idbusqueda' => '55','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Todas mis tareas','nombre' => 'listado_mis_tareas','orden' => '1','info' => '<div>
<div class="link kenlace_saia_tareas" enlace="../tareas/mostrar_tareas.php?idtareas={*idtareas*}" titulo="{*tarea*}"><b>{*mostrar_texto_codificado@tarea*}</b></div></br>
<div class="pull-right">{*fecha_tarea*}</div></br>
<div class="pull-right">{*estado_tarea_actual@estado_tarea*}</div>
<b>Responsable: {*mostrar_funcionario@responsable*}</b></br>
<b>Prioridad:</b> {*mostrar_prioridad@prioridad*}</br>
<b>Descripci&oacute;n:</b> {*mostrar_texto_codificado@descripcion*}</br>
<b>Asignado por: </b> {*mostrar_funcionario_asignado_por@ejecutor*}</br>
<div>
{*informacion_tarea_documento@documento_iddocumento*}
</div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas'),
        array('idbusqueda_componente' => '206','busqueda_idbusqueda' => '55','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas pendientes asignadas a mi','nombre' => 'mis_tareas_pendientes','orden' => '4','info' => '<div>
<div class="link kenlace_saia_tareas" enlace="../tareas/mostrar_tareas.php?idtareas={*idtareas*}" titulo="{*$tarea*}"><b>{*tarea*}</b></div></br>
<div class="pull-right">{*fecha_tarea*}</div></br>
<div class="pull-right">{*estado_tarea_actual@estado_tarea*}</div>
<b>Responsable: {*mostrar_funcionario@responsable*}</b></br>
<b>Prioridad:</b> {*mostrar_prioridad@prioridad*}</br>
<b>Descripci&oacute;:</b> {*descripcion*}</br>
<b>Asignado por: </b> {*mostrar_funcionario_asignado_por@ejecutor*}</br>
<div>
{*informacion_tarea_documento@documento_iddocumento*}
</div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas'),
        array('idbusqueda_componente' => '207','busqueda_idbusqueda' => '55','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas pendientes asignadas por mi','nombre' => 'mis_tareas_asignadas','orden' => '5','info' => '<div>
<div class="link kenlace_saia_tareas" enlace="../tareas/mostrar_tareas.php?idtareas={*idtareas*}" titulo="{*tarea*}"><b>{*mostrar_texto_codificado@tarea*}</b></div></br>
<div class="pull-right">{*fecha_tarea*}</div></br>
<div class="pull-right">{*estado_tarea_actual@estado_tarea*}</div>
<b>Responsable: {*mostrar_funcionario@responsable*}</b></br>
<b>Prioridad:</b> {*mostrar_prioridad@prioridad*}</br>
<b>Descripci&oacute;n:</b> {*mostrar_texto_codificado@descripcion*}</br>
<b>Asignado por: </b> {*mostrar_funcionario_asignado_por@ejecutor*}</br>
<div>
{*informacion_tarea_documento@documento_iddocumento*}
</div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas'),
        array('idbusqueda_componente' => '208','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Tareas','nombre' => 'tareas_documento','orden' => '1','info' => '<div class="row-fluid"><div class="pull-left"><b>{*tarea*} - {*fecha_tarea*}</b></div><div class="pull-right"><a href="#"><i enlace="pantallas/tareas/mostrar_tareas.php?idtareas={*idtareas*}&iddoc={*documento_iddocumento*}"class="icon-download tooltip_saia_izquierda tarea" title="Mostrar tarea"></i></a></div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'a.idtareas,a.documento_iddocumento,a.tarea,a.descripcion,a.fecha_tarea','tablas_adicionales' => 'tareas a','ordenado_por' => 'a.fecha','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => 'menu_informacion_documento','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '211','busqueda_idbusqueda' => '55','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php?pendientes=1','etiqueta' => 'Tareas Pendientes','nombre' => 'listado_tareas_pendientes','orden' => '1','info' => '<div>
<div class="link kenlace_saia_tareas" enlace="../tareas/mostrar_tareas.php?idtareas={*idtareas*}" titulo="{*$tarea*}"><b>{*tarea*}</b></div></br>
<div class="pull-right">{*fecha_tarea*}</div></br>
<div class="pull-right">{*estado_tarea_actual@estado_tarea*}</div>
<b>Responsable: {*mostrar_funcionario@responsable*}</b></br>
<b>Prioridad:</b> {*mostrar_prioridad@prioridad*}</br>
<b>Descripci&oacute;:</b> {*descripcion*}</br>
<b>Asignado por: </b> {*mostrar_funcionario_asignado_por@ejecutor*}</br>
<div>
{*informacion_tarea_documento@documento_iddocumento*}
</div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas'),
        array('idbusqueda_componente' => '212','busqueda_idbusqueda' => '56','tipo' => '3','conector' => '2','url' => NULL,'etiqueta' => 'Reemplazos','nombre' => 'Reemplazos','orden' => '1','info' => '<div class="row-fluid"><div class="span8"><div class="row-fluid pull-left"><div class="span3 legend">Funcionario:</div><div class="span3">{*nombres*} {*apellidos*}</div><div class="span3 legend">Reemplazo:</div><div class="span3">{*mostrar_tipo_reemplazo@tipo_reemplazo*}</div></div><div class="row-fluid pull-left"><div class="span3 legend">Usuario:</div><div class="span3">{*login*}</div><div class="span1 legend">Inicio:</div><div class="span2">{*fecha_inicio*}</div><div class="span1 legend">Fin:</div><div class="span2">{*mostrar_fecha_fin_reemplazo@fecha_fin*}</div></div><div class="row-fluid pull-left"><div class="span3 legend">Funcionario<br>Reemplazo:</div><div class="span3">{*nombres_nuevo*} {*apellidos_nuevo*}</div><div class="span2 legend">Observaciones:</div><div class="span4">{*observaciones*}</div><div class="span2 legend">Estado:</div><div class="span4">{*ver_estado_reem@estado_reem*}</div></div>  </div>  <div class="span2 pull-center">{*barra_acciones_reemplazos@idreemplazo_saia,estado_reem,tipo_reemplazo,procesado*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'A.antiguo,A.nuevo,date_format( a.fecha_inicio, \'%Y-%m-%d\') as fecha_inicio,date_format(a.fecha_fin, \'%Y-%m-%d\') as fecha_fin,C.nombres AS nombres_nuevo,C.apellidos AS apellidos_nuevo,A.tipo_reemplazo,A.observaciones,A.estado as estado_reem,procesado','tablas_adicionales' => 'reemplazo_saia A, funcionario C','ordenado_por' => 'idreemplazo_saia','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/reemplazos/adicionar_reemplazos.php?idbusqueda_componente=212','encabezado_grillas' => NULL,'llave' => 'A.idreemplazo_saia'),
        array('idbusqueda_componente' => '213','busqueda_idbusqueda' => '56','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_reemplazo.php','etiqueta' => 'Detalle Reemplazos','nombre' => 'reemplazo_detalle','orden' => '2','info' => '<div class="row-fluid">  <div class="row-fluid well span5"><span class="legend">Cargo:</span>{*cargo_origen*}<br /><br /><span class="legend">Dependencia:</span>{*dependencia_origen*}<br /><br />  </div><div class="span1 pull-center"><i class="icon-circle-arrow-right"></i></div><div class="row-fluid well span6"><span class="legend">Cargo:</span>{*cargo_destino*}<br /><br /><span class="legend">Dependencia:</span>{*dependencia_destino*}<br /><br />  </div>  </div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => 'B.dependencia AS dependencia_origen,C.dependencia AS dependencia_destino,B.cargo AS cargo_origen,C.cargo AS cargo_destino','tablas_adicionales' => 'reemplazo_saia A,reemplazo_equivalencia D, vfuncionario_dc B, vfuncionario_dc C','ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'A.idreemplazo_saia'),
        array('idbusqueda_componente' => '223','busqueda_idbusqueda' => '59','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Versiones de documento','nombre' => 'versiones_documento','orden' => '1','info' => '<div class="row-fluid"><div class="pull-left tooltip_saia_abajo" title="{*numero*}">{*mostrar_version@iddocumento,version,idversion_documento*}</div>
</div>','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'b.version,b.funcionario_idfuncionario,b.idversion_documento','tablas_adicionales' => 'version_documento b','ordenado_por' => 'b.version','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => '','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '224','busqueda_idbusqueda' => '37','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_expediente.php','etiqueta' => 'Listado expedientes Admin','nombre' => 'expediente_admin','orden' => '1','info' => '<div id="resultado_pantalla_{*idexpediente*}" class="well">{*enlaces_adicionales_expediente@idexpediente,nombre*}{*enlace_expediente@idexpediente,nombre*}<br/><div class="descripcion_documento">{*descripcion*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.nombre','direccion' => 'asc','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/expediente/buscar_expediente.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => '1395','menu_busqueda_superior' => 'barra_superior_busqueda','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '225','busqueda_idbusqueda' => '60','tipo' => '2','conector' => '2','url' => 'responder.php?formato=no','etiqueta' => 'Formatos','nombre' => 'formatos','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '228','busqueda_idbusqueda' => '62','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Documento Recibidos','nombre' => 'documentos_recibidos_proceso','orden' => '1','info' => '
<div class="row-fluid">
    <div class="span2">
        <b>{*mostrar_etiqueta_beauty@etiqueta*} &nbsp;&nbsp; </b>
    </div>
    <div class="span2">
       <span class="badge">{*mostrar_cantidad_proceso@plantilla*}</span>
    </div>
    <div class="span2">
        
    </div>
    <div class="span2">
       
    </div>
    <div class="span2">
        
    </div>
    <div class="span2">
       
    </div>
</div>
','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'a.iddocumento,a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,date_format(b.fecha_inicial,\'Y-m-d\') as fecha_iniciall','tablas_adicionales' => 'documento a, asignacion b','ordenado_por' => 'c.idformato','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'c.idformato'),
        array('idbusqueda_componente' => '230','busqueda_idbusqueda' => '64','tipo' => '2','conector' => '2','url' => 'carrusel/sliderconfig.php?cmd=resetall','etiqueta' => 'Carrusel','nombre' => 'carrusel','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '231','busqueda_idbusqueda' => '65','tipo' => '2','conector' => '2','url' => 'noticia_index/noticia_detalles.php?cmd=resetall','etiqueta' => 'Noticias','nombre' => 'noticias','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '232','busqueda_idbusqueda' => '66','tipo' => '2','conector' => '2','url' => 'dependencia.php?cmd=resetall','etiqueta' => 'Dependencias','nombre' => 'dependencias','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '233','busqueda_idbusqueda' => '67','tipo' => '2','conector' => '2','url' => 'cargo.php?cmd=resetall','etiqueta' => 'Cargos','nombre' => 'cargos','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '234','busqueda_idbusqueda' => '68','tipo' => '2','conector' => '2','url' => 'serielist.php?cmd=resetall','etiqueta' => 'Series','nombre' => 'series','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '235','busqueda_idbusqueda' => '69','tipo' => '2','conector' => '2','url' => 'permiso_perfiladd.php?cmd=resetall','etiqueta' => 'Permisos','nombre' => 'permisos','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '237','busqueda_idbusqueda' => '71','tipo' => '2','conector' => '2','url' => 'calendario/festivos_list.php?cmd=resetall','etiqueta' => 'Calendario','nombre' => 'calendario','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '238','busqueda_idbusqueda' => '56','tipo' => '3','conector' => '2','url' => '','etiqueta' => 'Documentos reemplazo','nombre' => 'reemplazo_documento','orden' => '3','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha_inicial,plantilla,iddocumento*} <br><br><div>{*descripcion*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => 'B.iddocumento,B.numero,B.ejecutor,B.tipo_radicado,B.estado as estado_doc,B.serie,B.tipo_ejecutor,B.descripcion','tablas_adicionales' => 'reemplazo_documento D,documento B,reemplazo_saia A','ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'A.idreemplazo_saia'),
        array('idbusqueda_componente' => '256','busqueda_idbusqueda' => '87','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_listado_tareas.php','etiqueta' => 'Listado de Tareas','nombre' => 'listado_tareas_reporte','orden' => '5','info' => '<div class="well">
<div class="btn-group pull-rigth btn-under">{*enlaces_listado_tareas@idlistado_tareas,nombre*}
<div class="btn btn-mini enlace_listado_tareas tooltip_saia pull-right" idregistro="{*idlistado_tareas*}" titulo="Informacion" title="{*nombre_lista*}" titulo="Informacion listado">
<i class="icon-info-sign"></i>
</div>
{*mostrar_contador_tareas@idlistado_tareas*} 
<br/>
</div>
<b>{*nombre_lista*}</b><br/><br/>
<div class=\'descripcion_documento\'>{*obtener_descripcion_listado_tareas@descripcion_lista*}</div>
<br/>
{*checkbox_listado_tareas@idlistado_tareas*}
</div>
','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '200','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.idlistado_tareas','direccion' => 'DESC','agrupado_por' => 'a.idlistado_tareas','busqueda_avanzada' => 'pantallas/listado_tareas/buscar_listado_tareas.php','acciones_seleccionados' => 'permiso_masivo_listado_tareas,seleccionar_todos_listado_tareas','modulo_idmodulo' => NULL,'menu_busqueda_superior' => 'barra_superior_busqueda','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idlistado_tareas'),
        array('idbusqueda_componente' => '257','busqueda_idbusqueda' => '88','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas Responsable','nombre' => 'listado_tareas_responsable','orden' => '1','info' => '','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => '','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '258','busqueda_idbusqueda' => '88','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas Co-participante','nombre' => 'listado_tareas_coparticipante','orden' => '1','info' => '','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => '','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '259','busqueda_idbusqueda' => '88','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas Seguidor','nombre' => 'listado_tareas_seguidor','orden' => '1','info' => '','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => '','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '260','busqueda_idbusqueda' => '88','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas Evaluador','nombre' => 'listado_tareas_evaluador','orden' => '1','info' => '','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => '','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '261','busqueda_idbusqueda' => '88','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas.php','etiqueta' => 'Tareas Total','nombre' => 'listado_tareas_total','orden' => '1','info' => '','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => '','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '262','busqueda_idbusqueda' => '89','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas_listado2.php','etiqueta' => 'Listado de Tareas','nombre' => 'tareas_listado_reporte','orden' => '5','info' => '{*ocultar_tarea_terminada@idtareas_listado,estado_tarea,evaluador,creador_tarea,listado_tareas_fk,generica*}
<div class="well" id="well_{*idtareas_listado*}">
    
    <table class="contenedor_informacion_primaria">
    <tr>	
    <td class="linea_primaria" style="width:3%;">
    	{*mostrar_cantidad_subtareas@idtareas_listado*}
    </td>
    <td class="linea_primaria" style="width:2%;">
    	<span class="texto_cajon">{*mostrar_prioridad_tarea_reporte@idtareas_listado,prioridad,progreso*}</span>
    </td>
    <td class="linea_primaria" style="width:32%;">
    	<span style="cursor:pointer;" class="div_idtareas_listado linea_primaria" id="{*idtareas_listado*}" data-toggle="collapse" data-target="#div_info_doc_{*idtareas_listado*}" >
       	 <span class="contenedor_nombre_tarea linea_primaria">{*mostrar_previa_nombre_tarea@nombre_tarea*}</span> 
   	   </span>
   </td>
   <td class="linea_primaria" style="width:5%;" >
   		<span class="texto_cajon"> {*mostrar_funcionarios_1@responsable_tarea*}</span>
   </td>
   <td class="linea_primaria" style="width:5%;">
   	 <span class="texto_cajon linea_primaria" data-toggle="tooltip" title="{*estado_tarea*}">{*mostrar_estado_tarea@estado_tarea,progreso,idtareas_listado*}</span>
   	  
   </td>  
   <td class="linea_primaria" style="width:10%;">
     <span class="texto_cajon" data-toggle="tooltip" title="{*tiempo_estimado*}"> {*mostrar_tiempo_transcurrido@idtareas_listado*}</span>
   </td>     
   <td  class="linea_primaria" style="width:15%;">

    <div class="navbar reescribir_navbar menu_componentes"id="ocultar_mostrar_menu_componentes{*idtareas_listado*}" >
      <div class="navbar-inner reescribir_navbar-inner" >
          <div class="container" style="display:none;">        
            <ul class="nav contenedor_enlace_componente">                                                                  
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="binformacion{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab4_{*idtareas_listado*}" data-toggle="tab"><i class="icon-info-sign " data-toggle="tooltip" title="Informaci&oacute;n"></i></a></div>
               </li>
              <li>      
          		<div class="btn btn-mini boton_linea_primaria" id="bprogreso{*idtareas_listado*}" idtarea="{*idtareas_listado*}" ><a href="#tab1_{*idtareas_listado*}" data-toggle="tab" ><i class="icon-resize-horizontal " data-toggle="tooltip" title="Progreso"></i></a></div>  
              </li>               
              <li>      
         	  	<div class="btn btn-mini boton_linea_primaria" id="bcronometro{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab3_{*idtareas_listado*}" data-toggle="tab"><i class="icon-time " data-toggle="tooltip" title="Avance"></i></a></div>
              </li>
              <li>      
       		   <div class="btn btn-mini boton_linea_primaria" id="bprioridades{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab5_{*idtareas_listado*}" data-toggle="tab"><i class="icon-flag " data-toggle="tooltip" title="Prioridad"></i></a></div>
              </li>
              <li>      
        		  <div class="btn btn-mini boton_linea_primaria" id="bfecha{*idtareas_listado*}" class="fecha_tarea" idtarea="{*idtareas_listado*}" ><a href="#tab6_{*idtareas_listado*}" data-toggle="tab"><i class="icon-calendar " data-toggle="tooltip" title="Fecha de la Tarea"></i></a></div>
              </li>               
              <li>      
          		<div class="btn btn-mini boton_linea_primaria" id="bnotas{*idtareas_listado*}" idtarea="{*idtareas_listado*}" ><a href="#tab7_{*idtareas_listado*}" data-toggle="tab"><i class="icon-comment " data-toggle="tooltip" title="Notas"></i></a></div>
              </li>
              <!--li>      
				<div class="btn btn-mini boton_linea_primaria" id="banexos{*idtareas_listado*}" idtarea="{*idtareas_listado*}" ><a href="#tab8_{*idtareas_listado*}" data-toggle="tab"><i class="icon-file " data-toggle="tooltip" title="Anexos"></i></a></div>
              </li-->   
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="bcalificacion{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab9_{*idtareas_listado*}" data-toggle="tab"><i class="icon-ok " data-toggle="tooltip" title="Calificaci&oacute;n"></i></a></div>
              </li>   
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="brecurrencia{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab10_{*idtareas_listado*}" data-toggle="tab"><i class="icon-repeat " data-toggle="tooltip" title="Recurrencia"></i></a></div> 
              </li>   
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="bseguidores{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab11_{*idtareas_listado*}" data-toggle="tab"><i class="icon-eye-open " data-toggle="tooltip" title="Seguidores"></i></a></div> 	
              </li>     
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="betiquetas{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab12_{*idtareas_listado*}" data-toggle="tab"><i class="icon-tags " data-toggle="tooltip" title="Etiquetas"></i></a></div> 	
              </li>                                                                      
              </ul>
             </div>
            </div>
           </div> 
   </td> 
   
    	<td style="width:10%;">
    		<span class="texto_cajon" data-toggle="tooltip" >{*mostrar_fecha_inicio@fecha_inicio,idtareas_listado*}</span>
    		 <span class="texto_cajon" data-toggle="tooltip" title="{*mostrar_dias_fecha_vencimiento@fecha_limite,idtareas_listado*}">{*mostrar_fecha_vencimiento@fecha_limite,idtareas_listado*}</span>
    	</td>    
   
     <td class="linea_primaria" style="width:10%;">
     	{*mostrar_enlaces_tareas_listado@idtareas_listado*}
     </td>   
  </tr>
  </table>
  

  <!--   ---------------------------------------  -->
  
  
  
<div id="div_info_doc_{*idtareas_listado*}"  class="collapse info_tareas">
<table class="table table-bordered contenedor_componentes">
  <tr>
    <td width="40%"  colspan="3">



            <div class="tabbable" id="secciones{*idtareas_listado*}">
        <ul class="nav nav-tabs">
          <li id="informacion{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab4_{*idtareas_listado*}" data-toggle="tab"><i class="icon-info-sign" data-toggle="tooltip" title="Informaci&oacute;n"></i></a></li>
          <li id="progreso{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab1_{*idtareas_listado*}" data-toggle="tab" ><i class="icon-resize-horizontal" data-toggle="tooltip" title="Progreso"></i></a></li>     
          <li id="cronometro{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab3_{*idtareas_listado*}" data-toggle="tab"><i class="icon-time" data-toggle="tooltip" title="Avance"></i></a></li>
          <li id="prioridades{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab5_{*idtareas_listado*}" data-toggle="tab"><i class="icon-flag" data-toggle="tooltip" title="Prioridad"></i></a></li>
          <li id="fecha{*idtareas_listado*}" class="fecha_tarea boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab6_{*idtareas_listado*}" data-toggle="tab"><i class="icon-calendar" data-toggle="tooltip" title="Fecha de la Tarea"></i></a></li>
          <li id="notas{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab7_{*idtareas_listado*}" data-toggle="tab"><i class="icon-comment" data-toggle="tooltip" title="Notas"></i></a></li>
          <!--li id="anexos{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab8_{*idtareas_listado*}" data-toggle="tab"><i class="icon-file" data-toggle="tooltip" title="Anexos"></i></a></li -->
          <li id="calificacion{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab9_{*idtareas_listado*}" data-toggle="tab"><i class="icon-ok" data-toggle="tooltip" title="Calificaci&oacute;n"></i></a></li>
          <li id="recurrencia{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab10_{*idtareas_listado*}" data-toggle="tab"><i class="icon-repeat" data-toggle="tooltip" title="Recurrencia"></i></a></li>          
          <li id="seguidores{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab11_{*idtareas_listado*}" data-toggle="tab"><i class="icon-eye-open" data-toggle="tooltip" title="Seguidores"></i></a></li> 
          <li id="etiquetas{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab12_{*idtareas_listado*}" data-toggle="tab"><i class="icon-tags" data-toggle="tooltip" title="Etiquetas"></i></a></li>                          
        </ul>
            </div>


      <div class="tab-content">
          <div class="tab-pane " id="tab4_{*idtareas_listado*}">
            <script>
                        $(\'[data-toggle=\\"tooltip\\"]\').tooltip();   
            $(\'#informacion{*idtareas_listado*},#binformacion{*idtareas_listado*}\').live("click",function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:4,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
                  $(\'#tab4_{*idtareas_listado*}\').html(\'\');
                  $(\'#tab4_{*idtareas_listado*}\').append(datos.valor);
                } 
                }); 
            });

            </script>
          </div>
        <div class="tab-pane" id="tab1_{*idtareas_listado*}">
            {*generar_slider_progreso@idtareas_listado,progreso*}
        </div>
          <div class="tab-pane" id="tab5_{*idtareas_listado*}">
            <script>
            $("#prioridades{*idtareas_listado*},#bprioridades{*idtareas_listado*}").click(function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:5,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
            
                  $(\'#tab5_{*idtareas_listado*}\').html(\'\');
                    $(\'#tab5_{*idtareas_listado*}\').append(datos.valor);
                  
                    $("[name=\\\'prioridad_{*idtareas_listado*}\\\']").change(function(){
                      var priorid=$(this).val();
                      var idtarea=parseInt({*idtareas_listado*});
                      guardar_prioridad(idtarea,priorid);
                    });
                    
                    
                    
                } 
              }); 
          });
            </script>
          </div>
         <div class="tab-pane" id="tab6_{*idtareas_listado*}">
              <input id="date-range{*idtareas_listado*}" size="40" value="" class="fechas_tarea">
            <div  id="date-range{*idtareas_listado*}-container"></div>
              <script>
                    $(\'#date-range{*idtareas_listado*}\').dateRangePicker({
                      inline:true,
                      separator:\'|\',
                      container: \'#date-range{*idtareas_listado*}-container\', 
                      alwaysOpen:true,
                      shortcuts : {
                        \'next-days\': [3 ,5 ,7 ],
                        \'next\': [\'week\',\'month\',\'year\']
                      },
                      showShortcuts: true
                    }).bind(\'datepicker-change\',function(event,obj){
                        var fecha1=obj.date1.toISOString().split("T");
                        var fecha2=obj.date2.toISOString().split("T");
                        save_fechas_tarea({*idtareas_listado*},"\\\'"+fecha1[0]+"\\\'","\\\'"+fecha2[0]+"\\\'");
                    }).bind(\'datepicker-opened\',function(){
						console.log(\'after open\');
					});
              </script>          
          </div>
          <div class="tab-pane" id="tab7_{*idtareas_listado*}">
          	<div id="contenedor_notas_anexos_{*idtareas_listado*}"></div>
          	
      <script>
            $("#notas{*idtareas_listado*},#bnotas{*idtareas_listado*}").click(function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:7,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
                   	
                	
                	
                  $(\'#contenedor_notas_anexos_{*idtareas_listado*}\').html(\'\');
                    $(\'#contenedor_notas_anexos_{*idtareas_listado*}\').append(datos.valor);
                    
                    $(\'#registrar_nota_{*idtareas_listado*}\').click(function(){
                      var idtarea=parseInt({*idtareas_listado*});
                      var nota=$("#avance_notas_"+idtarea).val();
                      var enviar_email=$("[name=\\\'enviar_correo_"+idtarea+"\\\']:checked").val();
                      if(nota.trim()==""){
                        notificacion_saia("<font color=\\\'EEEEEE\\\'>Ingrese el avance</font>","error","",3000);
                      }else{
                        guardar_notas_tareas(idtarea,nota,enviar_email);
                      }
                      
                    });
                    

			      $(\'#archivos_{*idtareas_listado*}\').html(\'\');
			      if(datos.bloquear_anexos==1){
			      	  $(\'#contenedor_input_file_{*idtareas_listado*}\').hide();
			      }else{
			      	  $(\'#contenedor_input_file_{*idtareas_listado*}\').show();
			      }                           
                      
                    $(\'#muestra_anexos_componente_{*idtareas_listado*}\').html(\'\');
                    $(\'#muestra_anexos_componente_{*idtareas_listado*}\').append(datos.valor_anexos);
                } 
              }); 
          });
            </script>   
            
<!-- DESARROLLO UPLOAD -->
      <form class="form-horizontal" id="subir_anexo_componente_{*idtareas_listado*}" method="POST"  action="" enctype="multipart/form-data">
          <legend class="texto-azul">Anexos </legend>  
          <br>
          <div id="mensaje_file_{*idtareas_listado*}"></div>                  
                  <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:10px;" id="contenedor_input_file_{*idtareas_listado*}">
                      <i class="glyphicon-plus"></i>
                      <span>Examinar</span>
                      <input type="file" name="files[]" multiple ng-disabled="disabled" id="files_{*idtareas_listado*}">
                  </span>
      </form>
                <br/>
          <table class="table table-striped" id="archivos_{*idtareas_listado*}"></table>      
        <div id="muestra_anexos_componente_{*idtareas_listado*}"></div>
<script>
$("#anexos{*idtareas_listado*},#banexos{*idtareas_listado*}").click(function(){
  $.ajax({
    type:\'POST\',
    dataType: \'json\',
    url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
    data:{opcion:10,idtareas_listado:{*idtareas_listado*},idlistado_tareas:{*listado_tareas_fk*}},
    success: function(datos){

    } 
  }); 
});
$(document).ready(function(){            
  var archivos = 0;
  var falla_archivos = 0;
  var exito_archivos = 0;
  var formulario= $(\'#subir_anexo_componente_{*idtareas_listado*}\');
  var error=0;
  var data_{*idtareas_listado*}=null;
  redireccion=1;
  $(\'#subir_anexo_componente_{*idtareas_listado*}\').fileupload({        
      url: \'{*traer_ruta_superior*}pantallas/tareas_listado/subir_archivo_tareas_listado.php?idlistado_tareas={*listado_tareas_fk*}&idtareas_listado={*idtareas_listado*}&aleatorio={*generar_rand*}\',
      dataType: \'json\',             
      autoUpload: true                 
  }).on(\'fileuploadadd\', function (e, data_{*idtareas_listado*}) {
    redirecciona=0;
    archivos++;  
    $.each(data_{*idtareas_listado*}.files, function (index, file) {       
      var texto=\'<tr id=\\"file_{*idtareas_listado*}_\'+index+\'\\"><td>\'+file.name+\'</td><td>\'+tamanio_archivo(file.size,2)+\'</td><!--td><i class=\\"icon-trash eliminar_file_{*idtareas_listado*}\\"></i></td--><td width=\\"100px\\"><div class=\\"progress progress-striped active\\"><div class=\\"bar bar-success\\" id=\\"\'+file.size+\'\\" ></div></div></td></tr>\';   
                
      $("#archivos_{*idtareas_listado*}").append(texto); 
      $("#start_{*idtareas_listado*}").attr(\'disabled\',false);
      $(".cancel_{*idtareas_listado*}").attr(\'disabled\',false);                    
    });                           
  }).on(\'fileuploadprogress\', function (e, data_{*idtareas_listado*}){
    
      var progress = parseInt(data_{*idtareas_listado*}.loaded / data_{*idtareas_listado*}.total * 100, 10);        
      $.each(data_{*idtareas_listado*}.files, function(index,file){                                  
        $(\'#\'+file.size).css(\'width\',(progress)+ \'%\');
        $(\'#\'+file.size).html((progress)+"%");
      });                     
  }).on(\'fileuploaddone\', function(e, data_{*idtareas_listado*}){
    redirecciona=0;
    $.each(data_{*idtareas_listado*}.result.files, function(index,file){
      if(typeof(file.error)!="undefined"){
        $(\'#\'+file.size).removeClass(\'bar-success\');
        $(\'#\'+file.size).addClass(\'bar-danger\');
        falla_archivos++;
        notificacion_saia(\'<span style=\\"color:white;font-weight:bold;\\">Error:\'+file.name+"<br>"+file.error+\'</span>\',\'error\',\'\',5000);
      }                   
      else{
        exito_archivos++;
        delete file;
        file=null;
        $("#file_{*idtareas_listado*}_"+index).remove();
        
      }
    });  
    delete data_{*idtareas_listado*}.result.files;
    if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
      notificacion_saia("Todos los archivos se cargaron con &eacute;xito","success","",2500);
      redireccion=1;
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      redireccion=1;        
    } 
    $("#notas{*idtareas_listado*}").click();
    $("#start_{*idtareas_listado*}").attr(\'disabled\',true);
    $(".cancel_{*idtareas_listado*}").attr(\'disabled\',true);
    $(\'#files_{*idtareas_listado*}\').val("");
    archivos=0;
    exito_archivos=0;
    falla_archivos=0; 
    delete(data_{*idtareas_listado*});
  }).on(\'fileuploadfail\', function(e, data){ 
    $.each(data_{*idtareas_listado*}.files, function(index,file){              
      notificacion_saia(\'<span style=\\"color:white;font-weight:bold;\\">Error:\'+file.name+" <br> "+file.error+\'</span>\',\'error\',\'\',5000);   
      falla_archivos++; 
      redireccion=1;
    });    
    
     
  });       
});  
</script>
<!-- CIERRA DESARROLLO UPLOAD -->            
            
            
            
            
            
            
            
            
                  
          </div>
          <div class="tab-pane" id="tab9_{*idtareas_listado*}">
            {*generar_linea_calificacion@idtareas_listado,calificacion,progreso*}
          </div>
          <div class="tab-pane" id="tab10_{*idtareas_listado*}">
            	{*mostrar_informacion_recurrencia@idtareas_listado,fk_tarea_recurrencia*}
          </div>   
           <div class="tab-pane" id="tab11_{*idtareas_listado*}">
            	{*mostrar_informacion_seguidores@idtareas_listado*}
          </div>           
           <div class="tab-pane" id="tab12_{*idtareas_listado*}">
            	{*mostrar_informacion_etiquetas@idtareas_listado*}
          </div>             
                 
   <div class="tab-pane" id="tab3_{*idtareas_listado*}">
            <script>
            $("#cronometro{*idtareas_listado*},#bcronometro{*idtareas_listado*}").live("click",function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:3,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
                  $(\'#tab3_{*idtareas_listado*}\').html(\'\');
                  $(\'#tab3_{*idtareas_listado*}\').append(datos.valor);
                  
              	  if(datos.time_transcurrido!=0){
				  	$("#time_transcurrido_{*idtareas_listado*}").empty().html(datos.time_transcurrido);
				  }                  
                  
                  $("[id^=\\\'datetimepicker_fecha_ini_\\\']").datetimepicker({
                        language: \'es\',
                        pick12HourFormat: true,
                        pickTime: false
                      }).on(\'changeDate\', function(e){
                        $(this).datetimepicker(\'hide\');
                      });
                      
                    $("[id^=\\\'datetimepicker_hora_ini_\\\'],[id^=\\\'datetimepicker_hora_fin_\\\']").datetimepicker({
                      pickDate: false,
                      pickSeconds: false
                    }).on(\'changeDate\', function(e){
                        validar_tiempo(1,$(this).attr("idtarea"));
                    });
                    
                    $("[id^=\\\'hora_inicio_\\\'],[id^=\\\'hora_final_\\\']").blur(function (){
                      validar_tiempo(1,$(this).attr("idtarea"));
                    });
                    $("[id^=\\\'horas_tiempo_\\\'],[id^=\\\'minutos_tiempo_\\\']").keyup(function (){
                      this.value = (this.value + \'\').replace(/[^0-9]/g, \'\');
                    });
                    $("[id^=\\\'horas_tiempo_\\\']").blur(function (){
                      var valor=parseInt($(this).val());
                      if(valor>23){
                        $(this).val("23");
                      }
                      if(valor<10){
                        $(this).val("0"+valor);
                      }
                      validar_tiempo(2,$(this).attr("idtarea"));
                    });
                    $("[id^=\\\'minutos_tiempo_\\\']").blur(function (){
                      var valor=parseInt($(this).val());
                      if(valor>59){
                        $(this).val("59");
                      }
                      if(valor<10){
                        $(this).val("0"+valor);
                      }
                      validar_tiempo(2,$(this).attr("idtarea"));
                    });
                    
                    function validar_tiempo(opt,idtarea){
                        if(opt==1){
                          var h_ini=$("#hora_inicio_"+idtarea).val();
                          var h_fin=$("#hora_final_"+idtarea).val();  
                          if(h_ini>=h_fin){
                            $("#horas_tiempo_"+idtarea).val("");
                            $("#minutos_tiempo_"+idtarea).val("");
                            return false;
                          }else{
                            $.ajax({
                              type:\'POST\',
                              dataType: \'json\',
                              url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
                              data:{idtarea:idtarea,hora_ini:h_ini,hora_fin:h_fin,ejecutar_accion_tarea:"obtenter_tiempo_tareas", mensaje_exito:"Tiempo Cargado"},
                              success: function(datos){
                                if(datos.exito!=1){
                                  notificacion_saia("<font color=\\\'EEEEEE\\\'>"+datos.mensaje+"</font>","error","",3000);
                                }else{
                                  tiempo=datos.tiempo.split("-");
                                  $("#horas_tiempo_"+idtarea).val(tiempo[0]);
                                  $("#minutos_tiempo_"+idtarea).val(tiempo[1]);
                                }
                              } 
                            });
                          }
                        }else if(opt==2){
                          var hora_ini=$("#hora_inicio_"+idtarea).val();
                          var h=parseInt($("#horas_tiempo_"+idtarea).val());
                          if(isNaN(h)){h=0}
                          var m=parseInt($("#minutos_tiempo_"+idtarea).val());
                          if(isNaN(m)){m=0}
                          if(hora_ini==""){
                            $("#horas_tiempo_"+idtarea).val("");
                            $("#minutos_tiempo_"+idtarea).val("");
                            notificacion_saia("<font color=\\\'EEEEEE\\\'>Ingrese Hora Inicial</font>","error","",3000);
                            return false;
                          }else if(h!=0 || m!=0){
                            $.ajax({
                              type:\'POST\',
                              dataType: \'json\',
                              url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
                              data:{idtarea:idtarea,hora:h,minutos:m,hora_inicial:hora_ini,ejecutar_accion_tarea:"obtenter_fecha_final_tareas", mensaje_exito:"Tiempo Cargado"},
                              success: function(datos){
                                if(datos.exito!=1){
                                  notificacion_saia("<font color=\\\'EEEEEE\\\'>"+datos.mensaje+"</font>","error","",3000);
                                }else{
                                  $("#hora_final_"+idtarea).val(datos.tiempo);
                                }
                              } 
                            });
                          }else{
                            $("#hora_final_"+idtarea).val("");
                          }
                        }
                      }
                      $(".guardar_avance_tarea").click(function(){
                        var idtarea=$(this).attr("idtarea");
                        var hora_fin=$("#hora_final_"+idtarea).val();
                        if(hora_fin!=""){
                          var fecha_ini=$("#fecha_inicio_"+idtarea).val();
                          var hora_ini=$("#hora_inicio_"+idtarea).val();
                          var estado=$("#estado_tarea_"+idtarea).val();
                          var comentario=$("#comentario_avance_tarea_"+idtarea).val();
                          var minutos=parseInt($("#minutos_tiempo_"+idtarea).val())*60;
                          if(isNaN(minutos)){minutos=0;}
                          var horas=parseInt($("#horas_tiempo_"+idtarea).val())*3600;
                          if(isNaN(horas)){horas=0;}
                          var tiempo_tarea=minutos+horas;
                          $.ajax({
                            type:\'POST\',
                            dataType: \'json\',
                            url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
                            data:{idtarea:idtarea,tiempo_tarea:tiempo_tarea,fecha_inicial:fecha_ini,hora_inicio:hora_ini,hora_final:hora_fin,estado:estado,comentario:comentario,ejecutar_accion_tarea:"registrar_tiempo_tarea_listado", mensaje_exito:"Tiempo Guardado"},
                            success: function(datos){
                              if(datos.exito!=1){
                                notificacion_saia("<font color=\\\'EEEEEE\\\'>"+datos.mensaje+"</font>","error","",3000);
                              }else{
                                notificacion_saia(datos.mensaje,"success","",3000);
                                 $("#cronometro"+idtarea).click();
                              }
                            } 
                          });
                        }else{
                          notificacion_saia("<font color=\\\'EEEEEE\\\'>Por favor ingrese el Tiempo</font>","error","",3000);
                        }
                      });

                } 
              }); 
            });
            </script>
  </div>
          <!--div class="tab-pane" id="tab8_{*idtareas_listado*}">
          </div -->
         </div>
        </td>
        </tr>
  </table>
</div>    
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '200','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha_limite','direccion' => 'ASC','agrupado_por' => 'a.idtareas_listado','busqueda_avanzada' => 'pantallas/tareas_listado/buscar_tareas_listado.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => '','enlace_adicionar' => 'pantallas/tareas_listado/adicionar_tareas_listado.php?from_tareas=1','encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '263','busqueda_idbusqueda' => '90','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_subtareas_listado.php','etiqueta' => 'Listado de SubTareas','nombre' => 'subtareas_listado','orden' => '5','info' => '{*ocultar_tarea_terminada@idtareas_listado,estado_tarea,evaluador,creador_tarea,listado_tareas_fk,generica*}
<div class="well" id="well_{*idtareas_listado*}">
    
    <table class="contenedor_informacion_primaria">
    <tr>	
    <td class="linea_primaria" style="width:3%;">
    	{*mostrar_cantidad_subtareas@idtareas_listado*}
    </td>
    <td class="linea_primaria" style="width:2%;">
    	<span class="texto_cajon">{*mostrar_prioridad_tarea_reporte@idtareas_listado,prioridad,progreso*}</span>
    </td>
    <td class="linea_primaria" style="width:32%;">
    	<span style="cursor:pointer;" class="div_idtareas_listado linea_primaria" id="{*idtareas_listado*}" data-toggle="collapse" data-target="#div_info_doc_{*idtareas_listado*}" >
       	 <span class="contenedor_nombre_tarea linea_primaria">{*mostrar_previa_nombre_tarea@nombre_tarea*}</span> 
   	   </span>
   </td>
   <td class="linea_primaria" style="width:5%;" >
   		<span class="texto_cajon"> {*mostrar_funcionarios_1@responsable_tarea*}</span>
   </td>
   <td class="linea_primaria" style="width:5%;">
   	 <span class="texto_cajon linea_primaria" data-toggle="tooltip" title="{*estado_tarea*}">{*mostrar_estado_tarea@estado_tarea,progreso,idtareas_listado*}</span>
   	  
   </td>  
   <td class="linea_primaria" style="width:10%;">
     <span class="texto_cajon" data-toggle="tooltip" title="{*tiempo_estimado*}"> {*mostrar_tiempo_transcurrido@idtareas_listado*}</span>
   </td>     
   <td  class="linea_primaria" style="width:15%;">

    <div class="navbar reescribir_navbar menu_componentes"id="ocultar_mostrar_menu_componentes{*idtareas_listado*}" >
      <div class="navbar-inner reescribir_navbar-inner" >
          <div class="container" style="display:none;">        
            <ul class="nav contenedor_enlace_componente">                                                                  
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="binformacion{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab4_{*idtareas_listado*}" data-toggle="tab"><i class="icon-info-sign " data-toggle="tooltip" title="Informaci&oacute;n"></i></a></div>
               </li>
              <li>      
          		<div class="btn btn-mini boton_linea_primaria" id="bprogreso{*idtareas_listado*}" idtarea="{*idtareas_listado*}" ><a href="#tab1_{*idtareas_listado*}" data-toggle="tab" ><i class="icon-resize-horizontal " data-toggle="tooltip" title="Progreso"></i></a></div>  
              </li>               
              <li>      
         	  	<div class="btn btn-mini boton_linea_primaria" id="bcronometro{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab3_{*idtareas_listado*}" data-toggle="tab"><i class="icon-time " data-toggle="tooltip" title="Avance"></i></a></div>
              </li>
              <li>      
       		   <div class="btn btn-mini boton_linea_primaria" id="bprioridades{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab5_{*idtareas_listado*}" data-toggle="tab"><i class="icon-flag " data-toggle="tooltip" title="Prioridad"></i></a></div>
              </li>
              <li>      
        		  <div class="btn btn-mini boton_linea_primaria" id="bfecha{*idtareas_listado*}" class="fecha_tarea" idtarea="{*idtareas_listado*}" ><a href="#tab6_{*idtareas_listado*}" data-toggle="tab"><i class="icon-calendar " data-toggle="tooltip" title="Fecha de la Tarea"></i></a></div>
              </li>               
              <li>      
          		<div class="btn btn-mini boton_linea_primaria" id="bnotas{*idtareas_listado*}" idtarea="{*idtareas_listado*}" ><a href="#tab7_{*idtareas_listado*}" data-toggle="tab"><i class="icon-comment " data-toggle="tooltip" title="Notas"></i></a></div>
              </li>
              <!--li>      
				<div class="btn btn-mini boton_linea_primaria" id="banexos{*idtareas_listado*}" idtarea="{*idtareas_listado*}" ><a href="#tab8_{*idtareas_listado*}" data-toggle="tab"><i class="icon-file " data-toggle="tooltip" title="Anexos"></i></a></div>
              </li-->   
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="bcalificacion{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab9_{*idtareas_listado*}" data-toggle="tab"><i class="icon-ok " data-toggle="tooltip" title="Calificaci&oacute;n"></i></a></div>
              </li>   
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="brecurrencia{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab10_{*idtareas_listado*}" data-toggle="tab"><i class="icon-repeat " data-toggle="tooltip" title="Recurrencia"></i></a></div> 
              </li>   
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="bseguidores{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab11_{*idtareas_listado*}" data-toggle="tab"><i class="icon-eye-open " data-toggle="tooltip" title="Seguidores"></i></a></div> 	
              </li>     
              <li>      
              	<div class="btn btn-mini boton_linea_primaria" id="betiquetas{*idtareas_listado*}" idtarea="{*idtareas_listado*}"><a href="#tab12_{*idtareas_listado*}" data-toggle="tab"><i class="icon-tags " data-toggle="tooltip" title="Etiquetas"></i></a></div> 	
              </li>                                                                      
              </ul>
             </div>
            </div>
           </div> 
   </td> 
   
    	<td style="width:10%;">
    		<span class="texto_cajon" data-toggle="tooltip" >{*mostrar_fecha_inicio@fecha_inicio,idtareas_listado*}</span>
    		 <span class="texto_cajon" data-toggle="tooltip" title="{*mostrar_dias_fecha_vencimiento@fecha_limite,idtareas_listado*}">{*mostrar_fecha_vencimiento@fecha_limite,idtareas_listado*}</span>
    	</td>    
   
     <td class="linea_primaria" style="width:10%;">
     	{*mostrar_enlaces_tareas_listado@idtareas_listado*}
     </td>   
  </tr>
  </table>
  

  <!--   ---------------------------------------  -->
  
  
  
<div id="div_info_doc_{*idtareas_listado*}"  class="collapse info_tareas">
<table class="table table-bordered contenedor_componentes">
  <tr>
    <td width="40%"  colspan="3">



            <div class="tabbable" id="secciones{*idtareas_listado*}">
        <ul class="nav nav-tabs">
          <li id="informacion{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab4_{*idtareas_listado*}" data-toggle="tab"><i class="icon-info-sign" data-toggle="tooltip" title="Informaci&oacute;n"></i></a></li>
          <li id="progreso{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab1_{*idtareas_listado*}" data-toggle="tab" ><i class="icon-resize-horizontal" data-toggle="tooltip" title="Progreso"></i></a></li>     
          <li id="cronometro{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab3_{*idtareas_listado*}" data-toggle="tab"><i class="icon-time" data-toggle="tooltip" title="Avance"></i></a></li>
          <li id="prioridades{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab5_{*idtareas_listado*}" data-toggle="tab"><i class="icon-flag" data-toggle="tooltip" title="Prioridad"></i></a></li>
          <li id="fecha{*idtareas_listado*}" class="fecha_tarea boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab6_{*idtareas_listado*}" data-toggle="tab"><i class="icon-calendar" data-toggle="tooltip" title="Fecha de la Tarea"></i></a></li>
          <li id="notas{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab7_{*idtareas_listado*}" data-toggle="tab"><i class="icon-comment" data-toggle="tooltip" title="Notas"></i></a></li>
          <!--li id="anexos{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab8_{*idtareas_listado*}" data-toggle="tab"><i class="icon-file" data-toggle="tooltip" title="Anexos"></i></a></li -->
          <li id="calificacion{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab9_{*idtareas_listado*}" data-toggle="tab"><i class="icon-ok" data-toggle="tooltip" title="Calificaci&oacute;n"></i></a></li>
          <li id="recurrencia{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab10_{*idtareas_listado*}" data-toggle="tab"><i class="icon-repeat" data-toggle="tooltip" title="Recurrencia"></i></a></li>          
          <li id="seguidores{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab11_{*idtareas_listado*}" data-toggle="tab"><i class="icon-eye-open" data-toggle="tooltip" title="Seguidores"></i></a></li> 
          <li id="etiquetas{*idtareas_listado*}" class="boton_linea_secundaria" idtarea="{*idtareas_listado*}"><a href="#tab12_{*idtareas_listado*}" data-toggle="tab"><i class="icon-tags" data-toggle="tooltip" title="Etiquetas"></i></a></li>                          
        </ul>
            </div>


      <div class="tab-content">
          <div class="tab-pane " id="tab4_{*idtareas_listado*}">
            <script>
                        $(\'[data-toggle=\\"tooltip\\"]\').tooltip();   
            $(\'#informacion{*idtareas_listado*},#binformacion{*idtareas_listado*}\').live("click",function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:4,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
                  $(\'#tab4_{*idtareas_listado*}\').html(\'\');
                  $(\'#tab4_{*idtareas_listado*}\').append(datos.valor);
                } 
                }); 
            });

            </script>
          </div>
        <div class="tab-pane" id="tab1_{*idtareas_listado*}">
            {*generar_slider_progreso@idtareas_listado,progreso*}
        </div>
          <div class="tab-pane" id="tab5_{*idtareas_listado*}">
            <script>
            $("#prioridades{*idtareas_listado*},#bprioridades{*idtareas_listado*}").click(function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:5,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
            
                  $(\'#tab5_{*idtareas_listado*}\').html(\'\');
                    $(\'#tab5_{*idtareas_listado*}\').append(datos.valor);
                  
                    $("[name=\\\'prioridad_{*idtareas_listado*}\\\']").change(function(){
                      var priorid=$(this).val();
                      var idtarea=parseInt({*idtareas_listado*});
                      guardar_prioridad(idtarea,priorid);
                    });
                    
                    
                    
                } 
              }); 
          });
            </script>
          </div>
         <div class="tab-pane" id="tab6_{*idtareas_listado*}">
              <input id="date-range{*idtareas_listado*}" size="40" value="" class="fechas_tarea">
            <div  id="date-range{*idtareas_listado*}-container"></div>
              <script>
                    $(\'#date-range{*idtareas_listado*}\').dateRangePicker({
                      inline:true,
                      separator:\'|\',
                      container: \'#date-range{*idtareas_listado*}-container\', 
                      alwaysOpen:true,
                      shortcuts : {
                        \'next-days\': [3 ,5 ,7 ],
                        \'next\': [\'week\',\'month\',\'year\']
                      },
                      showShortcuts: true
                    }).bind(\'datepicker-change\',function(event,obj){
                        var fecha1=obj.date1.toISOString().split("T");
                        var fecha2=obj.date2.toISOString().split("T");
                        save_fechas_tarea({*idtareas_listado*},"\\\'"+fecha1[0]+"\\\'","\\\'"+fecha2[0]+"\\\'");
                    }).bind(\'datepicker-opened\',function(){
						console.log(\'after open\');
					});
              </script>          
          </div>
          <div class="tab-pane" id="tab7_{*idtareas_listado*}">
          	<div id="contenedor_notas_anexos_{*idtareas_listado*}"></div>
          	
      <script>
            $("#notas{*idtareas_listado*},#bnotas{*idtareas_listado*}").click(function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:7,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
                   	
                	
                	
                  $(\'#contenedor_notas_anexos_{*idtareas_listado*}\').html(\'\');
                    $(\'#contenedor_notas_anexos_{*idtareas_listado*}\').append(datos.valor);
                    
                    $(\'#registrar_nota_{*idtareas_listado*}\').click(function(){
                      var idtarea=parseInt({*idtareas_listado*});
                      var nota=$("#avance_notas_"+idtarea).val();
                      var enviar_email=$("[name=\\\'enviar_correo_"+idtarea+"\\\']:checked").val();
                      if(nota.trim()==""){
                        notificacion_saia("<font color=\\\'EEEEEE\\\'>Ingrese el avance</font>","error","",3000);
                      }else{
                        guardar_notas_tareas(idtarea,nota,enviar_email);
                      }
                      
                    });
                    

			      $(\'#archivos_{*idtareas_listado*}\').html(\'\');
			      if(datos.bloquear_anexos==1){
			      	  $(\'#contenedor_input_file_{*idtareas_listado*}\').hide();
			      }else{
			      	  $(\'#contenedor_input_file_{*idtareas_listado*}\').show();
			      }                           
                      
                    $(\'#muestra_anexos_componente_{*idtareas_listado*}\').html(\'\');
                    $(\'#muestra_anexos_componente_{*idtareas_listado*}\').append(datos.valor_anexos);
                } 
              }); 
          });
            </script>   
            
<!-- DESARROLLO UPLOAD -->
      <form class="form-horizontal" id="subir_anexo_componente_{*idtareas_listado*}" method="POST"  action="" enctype="multipart/form-data">
          <legend class="texto-azul">Anexos </legend>  
          <br>
          <div id="mensaje_file_{*idtareas_listado*}"></div>                  
                  <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:10px;" id="contenedor_input_file_{*idtareas_listado*}">
                      <i class="glyphicon-plus"></i>
                      <span>Examinar</span>
                      <input type="file" name="files[]" multiple ng-disabled="disabled" id="files_{*idtareas_listado*}">
                  </span>
      </form>
                <br/>
          <table class="table table-striped" id="archivos_{*idtareas_listado*}"></table>      
        <div id="muestra_anexos_componente_{*idtareas_listado*}"></div>
<script>
$("#anexos{*idtareas_listado*},#banexos{*idtareas_listado*}").click(function(){
  $.ajax({
    type:\'POST\',
    dataType: \'json\',
    url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
    data:{opcion:10,idtareas_listado:{*idtareas_listado*},idlistado_tareas:{*listado_tareas_fk*}},
    success: function(datos){

    } 
  }); 
});
$(document).ready(function(){            
  var archivos = 0;
  var falla_archivos = 0;
  var exito_archivos = 0;
  var formulario= $(\'#subir_anexo_componente_{*idtareas_listado*}\');
  var error=0;
  var data_{*idtareas_listado*}=null;
  redireccion=1;
  $(\'#subir_anexo_componente_{*idtareas_listado*}\').fileupload({        
      url: \'{*traer_ruta_superior*}pantallas/tareas_listado/subir_archivo_tareas_listado.php?idlistado_tareas={*listado_tareas_fk*}&idtareas_listado={*idtareas_listado*}&aleatorio={*generar_rand*}\',
      dataType: \'json\',             
      autoUpload: true                 
  }).on(\'fileuploadadd\', function (e, data_{*idtareas_listado*}) {
    redirecciona=0;
    archivos++;  
    $.each(data_{*idtareas_listado*}.files, function (index, file) {       
      var texto=\'<tr id=\\"file_{*idtareas_listado*}_\'+index+\'\\"><td>\'+file.name+\'</td><td>\'+tamanio_archivo(file.size,2)+\'</td><!--td><i class=\\"icon-trash eliminar_file_{*idtareas_listado*}\\"></i></td--><td width=\\"100px\\"><div class=\\"progress progress-striped active\\"><div class=\\"bar bar-success\\" id=\\"\'+file.size+\'\\" ></div></div></td></tr>\';   
                
      $("#archivos_{*idtareas_listado*}").append(texto); 
      $("#start_{*idtareas_listado*}").attr(\'disabled\',false);
      $(".cancel_{*idtareas_listado*}").attr(\'disabled\',false);                    
    });                           
  }).on(\'fileuploadprogress\', function (e, data_{*idtareas_listado*}){
    
      var progress = parseInt(data_{*idtareas_listado*}.loaded / data_{*idtareas_listado*}.total * 100, 10);        
      $.each(data_{*idtareas_listado*}.files, function(index,file){                                  
        $(\'#\'+file.size).css(\'width\',(progress)+ \'%\');
        $(\'#\'+file.size).html((progress)+"%");
      });                     
  }).on(\'fileuploaddone\', function(e, data_{*idtareas_listado*}){
    redirecciona=0;
    $.each(data_{*idtareas_listado*}.result.files, function(index,file){
      if(typeof(file.error)!="undefined"){
        $(\'#\'+file.size).removeClass(\'bar-success\');
        $(\'#\'+file.size).addClass(\'bar-danger\');
        falla_archivos++;
        notificacion_saia(\'<span style=\\"color:white;font-weight:bold;\\">Error:\'+file.name+"<br>"+file.error+\'</span>\',\'error\',\'\',5000);
      }                   
      else{
        exito_archivos++;
        delete file;
        file=null;
        $("#file_{*idtareas_listado*}_"+index).remove();
        
      }
    });  
    delete data_{*idtareas_listado*}.result.files;
    if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
      notificacion_saia("Todos los archivos se cargaron con &eacute;xito","success","",2500);
      redireccion=1;
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      redireccion=1;        
    } 
    $("#notas{*idtareas_listado*}").click();
    $("#start_{*idtareas_listado*}").attr(\'disabled\',true);
    $(".cancel_{*idtareas_listado*}").attr(\'disabled\',true);
    $(\'#files_{*idtareas_listado*}\').val("");
    archivos=0;
    exito_archivos=0;
    falla_archivos=0; 
    delete(data_{*idtareas_listado*});
  }).on(\'fileuploadfail\', function(e, data){ 
    $.each(data_{*idtareas_listado*}.files, function(index,file){              
      notificacion_saia(\'<span style=\\"color:white;font-weight:bold;\\">Error:\'+file.name+" <br> "+file.error+\'</span>\',\'error\',\'\',5000);   
      falla_archivos++; 
      redireccion=1;
    });    
    
     
  });       
});  
</script>
<!-- CIERRA DESARROLLO UPLOAD -->            
            
            
            
            
            
            
            
            
                  
          </div>
          <div class="tab-pane" id="tab9_{*idtareas_listado*}">
            {*generar_linea_calificacion@idtareas_listado,calificacion,progreso*}
          </div>
          <div class="tab-pane" id="tab10_{*idtareas_listado*}">
            	{*mostrar_informacion_recurrencia@idtareas_listado,fk_tarea_recurrencia*}
          </div>   
           <div class="tab-pane" id="tab11_{*idtareas_listado*}">
            	{*mostrar_informacion_seguidores@idtareas_listado*}
          </div>           
           <div class="tab-pane" id="tab12_{*idtareas_listado*}">
            	{*mostrar_informacion_etiquetas@idtareas_listado*}
          </div>             
                 
   <div class="tab-pane" id="tab3_{*idtareas_listado*}">
            <script>
            $("#cronometro{*idtareas_listado*},#bcronometro{*idtareas_listado*}").live("click",function(){
              $.ajax({
                type:\'POST\',
                dataType: \'json\',
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:3,idtareas_listado:{*idtareas_listado*}},
                success: function(datos){
                  $(\'#tab3_{*idtareas_listado*}\').html(\'\');
                  $(\'#tab3_{*idtareas_listado*}\').append(datos.valor);
                  
              	  if(datos.time_transcurrido!=0){
				  	$("#time_transcurrido_{*idtareas_listado*}").empty().html(datos.time_transcurrido);
				  }                  
                  
                  $("[id^=\\\'datetimepicker_fecha_ini_\\\']").datetimepicker({
                        language: \'es\',
                        pick12HourFormat: true,
                        pickTime: false
                      }).on(\'changeDate\', function(e){
                        $(this).datetimepicker(\'hide\');
                      });
                      
                    $("[id^=\\\'datetimepicker_hora_ini_\\\'],[id^=\\\'datetimepicker_hora_fin_\\\']").datetimepicker({
                      pickDate: false,
                      pickSeconds: false
                    }).on(\'changeDate\', function(e){
                        validar_tiempo(1,$(this).attr("idtarea"));
                    });
                    
                    $("[id^=\\\'hora_inicio_\\\'],[id^=\\\'hora_final_\\\']").blur(function (){
                      validar_tiempo(1,$(this).attr("idtarea"));
                    });
                    $("[id^=\\\'horas_tiempo_\\\'],[id^=\\\'minutos_tiempo_\\\']").keyup(function (){
                      this.value = (this.value + \'\').replace(/[^0-9]/g, \'\');
                    });
                    $("[id^=\\\'horas_tiempo_\\\']").blur(function (){
                      var valor=parseInt($(this).val());
                      if(valor>23){
                        $(this).val("23");
                      }
                      if(valor<10){
                        $(this).val("0"+valor);
                      }
                      validar_tiempo(2,$(this).attr("idtarea"));
                    });
                    $("[id^=\\\'minutos_tiempo_\\\']").blur(function (){
                      var valor=parseInt($(this).val());
                      if(valor>59){
                        $(this).val("59");
                      }
                      if(valor<10){
                        $(this).val("0"+valor);
                      }
                      validar_tiempo(2,$(this).attr("idtarea"));
                    });
                    
                    function validar_tiempo(opt,idtarea){
                        if(opt==1){
                          var h_ini=$("#hora_inicio_"+idtarea).val();
                          var h_fin=$("#hora_final_"+idtarea).val();  
                          if(h_ini>=h_fin){
                            $("#horas_tiempo_"+idtarea).val("");
                            $("#minutos_tiempo_"+idtarea).val("");
                            return false;
                          }else{
                            $.ajax({
                              type:\'POST\',
                              dataType: \'json\',
                              url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
                              data:{idtarea:idtarea,hora_ini:h_ini,hora_fin:h_fin,ejecutar_accion_tarea:"obtenter_tiempo_tareas", mensaje_exito:"Tiempo Cargado"},
                              success: function(datos){
                                if(datos.exito!=1){
                                  notificacion_saia("<font color=\\\'EEEEEE\\\'>"+datos.mensaje+"</font>","error","",3000);
                                }else{
                                  tiempo=datos.tiempo.split("-");
                                  $("#horas_tiempo_"+idtarea).val(tiempo[0]);
                                  $("#minutos_tiempo_"+idtarea).val(tiempo[1]);
                                }
                              } 
                            });
                          }
                        }else if(opt==2){
                          var hora_ini=$("#hora_inicio_"+idtarea).val();
                          var h=parseInt($("#horas_tiempo_"+idtarea).val());
                          if(isNaN(h)){h=0}
                          var m=parseInt($("#minutos_tiempo_"+idtarea).val());
                          if(isNaN(m)){m=0}
                          if(hora_ini==""){
                            $("#horas_tiempo_"+idtarea).val("");
                            $("#minutos_tiempo_"+idtarea).val("");
                            notificacion_saia("<font color=\\\'EEEEEE\\\'>Ingrese Hora Inicial</font>","error","",3000);
                            return false;
                          }else if(h!=0 || m!=0){
                            $.ajax({
                              type:\'POST\',
                              dataType: \'json\',
                              url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
                              data:{idtarea:idtarea,hora:h,minutos:m,hora_inicial:hora_ini,ejecutar_accion_tarea:"obtenter_fecha_final_tareas", mensaje_exito:"Tiempo Cargado"},
                              success: function(datos){
                                if(datos.exito!=1){
                                  notificacion_saia("<font color=\\\'EEEEEE\\\'>"+datos.mensaje+"</font>","error","",3000);
                                }else{
                                  $("#hora_final_"+idtarea).val(datos.tiempo);
                                }
                              } 
                            });
                          }else{
                            $("#hora_final_"+idtarea).val("");
                          }
                        }
                      }
                      $(".guardar_avance_tarea").click(function(){
                        var idtarea=$(this).attr("idtarea");
                        var hora_fin=$("#hora_final_"+idtarea).val();
                        if(hora_fin!=""){
                          var fecha_ini=$("#fecha_inicio_"+idtarea).val();
                          var hora_ini=$("#hora_inicio_"+idtarea).val();
                          var estado=$("#estado_tarea_"+idtarea).val();
                          var comentario=$("#comentario_avance_tarea_"+idtarea).val();
                          var minutos=parseInt($("#minutos_tiempo_"+idtarea).val())*60;
                          if(isNaN(minutos)){minutos=0;}
                          var horas=parseInt($("#horas_tiempo_"+idtarea).val())*3600;
                          if(isNaN(horas)){horas=0;}
                          var tiempo_tarea=minutos+horas;
                          $.ajax({
                            type:\'POST\',
                            dataType: \'json\',
                            url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
                            data:{idtarea:idtarea,tiempo_tarea:tiempo_tarea,fecha_inicial:fecha_ini,hora_inicio:hora_ini,hora_final:hora_fin,estado:estado,comentario:comentario,ejecutar_accion_tarea:"registrar_tiempo_tarea_listado", mensaje_exito:"Tiempo Guardado"},
                            success: function(datos){
                              if(datos.exito!=1){
                                notificacion_saia("<font color=\\\'EEEEEE\\\'>"+datos.mensaje+"</font>","error","",3000);
                              }else{
                                notificacion_saia(datos.mensaje,"success","",3000);
                                 $("#cronometro"+idtarea).click();
                              }
                            } 
                          });
                        }else{
                          notificacion_saia("<font color=\\\'EEEEEE\\\'>Por favor ingrese el Tiempo</font>","error","",3000);
                        }
                      });

                } 
              }); 
            });
            </script>
  </div>
          <!--div class="tab-pane" id="tab8_{*idtareas_listado*}">
          </div -->
         </div>
        </td>
        </tr>
  </table>
</div>    
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '200','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha_limite','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => '','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '264','busqueda_idbusqueda' => '91','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tareas_listado.php','etiqueta' => 'Listado de Tareas planeador','nombre' => 'tareas_listado_paneador','orden' => '5','info' => '<div id=\'evento_{*idtareas_listado*}\' idevento=\'{*idtareas_listado*}\' class=\'fc-event\' orden=\'\' {*generar_semaforo_planeador@fecha_limite*} url=\'pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idbusqueda_componente=220&ocultar_subtareas=1&rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico={*idtareas_listado*}&id={*idtareas_listado*}\'>{*nombre_tarea*}({*fecha_limite*})</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '200','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha_limite','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/tareas_listado/buscar_tareas_listado.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => '','enlace_adicionar' => 'pantallas/tareas_listado/adicionar_tareas_listado.php?from_tareas=1','encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '265','busqueda_idbusqueda' => '92','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Tareas Actuales','nombre' => 'reporte_estado_tareas_funcionario','orden' => NULL,'info' => 'Funcionario|{*nombre_funcionario*}|left|-|Tareas Actuales|{*mostrar_tareas_actuales@idtareas_listado*}|left|-|Hora|{*mostrar_hora_tareas_actuales@idtareas_listado*}|left|-|Macroproceso|{*mostrar_nombre_macroproceso@listado_tareas_fk*}|left|-|Proceso|{*mostrar_nombre_proceso@listado_tareas_fk*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => 'concat(a.nombres,\' \',a.apellidos) as nombre_funcionario,a.idfuncionario, c.macro_proceso, b.listado_tareas_fk','tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/tareas_listado/busqueda_estado_tareas_funcionario.php?idbusqueda_componente=265','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'b.idtareas_listado'),
        array('idbusqueda_componente' => '266','busqueda_idbusqueda' => '93','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Reporte Cierre D&iacute;a','nombre' => 'reporte_tareas_cierre_dia','orden' => NULL,'info' => 'Fecha|{*mostrar_fecha_cierre*}|center|-|Funcionario|{*nombre_funcionario*}|left|-|Responsable|{*mostrar_tiempo_responsable@idfuncionario*}|center|-|Co-participante|{*mostrar_tiempo_coparticipante@idfuncionario*}|center|-|Seguidor|{*mostrar_tiempo_seguidor@idfuncionario*}|center|-|Evaluador|{*mostrar_tiempo_evaluador@idfuncionario*}|center|-|Total|{*mostrar_tiempo_total@idfuncionario,nombre_funcionario*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/tareas_listado/busqueda_tareas_cierre_dia.php?idbusqueda_componente=266','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idfuncionario'),
        array('idbusqueda_componente' => '267','busqueda_idbusqueda' => '94','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Reporte Cierre D&iacute;a (Tareas)','nombre' => 'reporte_tareas_cierre_dia_filtrada','orden' => NULL,'info' => 'Tarea|{*mostrar_enlace_nombre_tarea@idtareas_listado,nombre_tarea*}|left|-|Avance|{*mostrar_avance_tarea@idtareas_listado*}|center|-|Rol|{*mostrar_rol@responsable_tarea,co_participantes,seguidores,evaluador*}|center|-|Estado Tarea|{*estado_tarea*}|center|-|Progreso|{*mostrar_progreso@progreso*}|center|-|Total Avance|{*mostrar_avance_total_tarea@idtareas_listado*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha_creacion','direccion' => 'DESC','agrupado_por' => 'a.nombre_tarea,a.responsable_tarea,a.co_participantes,a.estado_tarea,a.progreso','busqueda_avanzada' => '','acciones_seleccionados' => 'exportar_reporte_cierre_dia','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado'),
        array('idbusqueda_componente' => '268','busqueda_idbusqueda' => '95','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Tiempos Registrados','nombre' => 'reporte_tareas_tiempos_registrados','orden' => NULL,'info' => 'Macroproceso|{*mostrar_nombre_macroproceso@listado_tareas_fk*}|left|-|Proceso|{*mostrar_nombre_proceso@listado_tareas_fk*}|left|-|Listado|{*mostrar_nombre_listado_tareas@listado_tareas_fk*}|left|-|Tarea|{*nombre_tarea*}|left|-|Usuario|{*mostrar_nombre_funcionario_avance@funcionario_idfuncionario*}|center|-|Fecha|{*fecha_inicio*}|center|-|Inicia|{*hora_inicio*}|center|-|Finaliza|{*hora_final*}|center|-|Tiempo planeado|{*mostrar_tiempo_estimado@tiempo_estimado*}|center|-|Tiempo registrado|{*mostrar_tiempo_registrado@tiempo_registrado*}|center|-|Comentario|{*comentario*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/tareas_listado/busqueda_tareas_tiempos_registrados.php?idbusqueda_componente=268','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idtareas_listado_tiempo'),
        array('idbusqueda_componente' => '270','busqueda_idbusqueda' => '98','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Secciones','nombre' => 'reporte_secciones','orden' => '1','info' => 'CODIGO|{*codigo*}|right|80|-|NOMBRE|{*nombre*}|left|200|-|ESTADO|{*estado*}|center|100','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'd.iddependencia, d.codigo, d.nombre, d.fecha_ingreso, d.cod_padre, d.tipo, case d.estado when 1 then "activo" else "inactivo" end as estado, d.codigo_tabla, d.extension, d.ubicacion_dependencia, d.orden','tablas_adicionales' => 'dependencia d','ordenado_por' => 'codigo','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/serie/busqueda_reporte_dependencias.php?idbusqueda_componente=270','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '271','busqueda_idbusqueda' => '98','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Cuadro de clasificaci&oacute;n','nombre' => 'reporte_clasificacion','orden' => '2','info' => 'CODIGO|{*orden_dependencia_serie*}|right|200|-|SECCION|{*dependencia*}|left|200|-|TIPO|{*tipo*}|center|110|-|NOMBRE|{*nombre*}|left|400|-|ESTADO|{*estado*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'orden_dependencia_serie,dependencia,idserie,nombre,tipo,codigo,estado','tablas_adicionales' => 'vdependencia_serie','ordenado_por' => 'orden_dependencia_serie','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/serie/busqueda_reporte_series.php?idbusqueda_componente=271','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '272','busqueda_idbusqueda' => '98','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Tabla de retenci&oacute;n','nombre' => 'reporte_retencion','orden' => '3','info' => 'CODIGO|{*orden_dependencia_serie*}|right|200|-|SECCION|{*dependencia*}|left|200|-|TIPO|{*tipo*}|center|100|-|NOMBRE|{*nombre*}|left|280|-|ARCHIVO DE GESTION|{*retencion_gestion*}|center|100|-|ARCHIVO CENTRAL|{*retencion_central*}|center|90|-|CONSERVACION|{*conservacion*}|center|90|-|PROCEDIMIENTO|{*procedimiento*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '0','ancho' => '320','cargar' => '1','campos_adicionales' => 'codigo,nombre,retencion_gestion,retencion_central,conservacion,seleccion,digitalizacion, procedimiento as procedimiento,tipo,dependencia,orden_dependencia_serie','tablas_adicionales' => 'vdependencia_serie','ordenado_por' => 'orden_dependencia_serie','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/serie/busqueda_reporte_series_dependencias.php?idbusqueda_componente=272','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '275','busqueda_idbusqueda' => '100','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Reporte usuarios','nombre' => 'reporte_acceso_usuarios','orden' => '1','info' => 'Documento|{*documento*}|center|-|Nombre|{*nombre*}|center|-|Correo|{*correo*}|center|-|Login|{*login*}|center|-|Ultimo Acceso|{*calcular_ultimo_acceso@login*}|center|-|Documentos Pendientes|{*documentos_pendientes_reporte@documento*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'F.nombres','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/funcionario/busqueda_reporte_acceso.php?idbusqueda_componente=275','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'idfuncionario'),
        array('idbusqueda_componente' => '276','busqueda_idbusqueda' => '101','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Remitentes','nombre' => 'remitentes','orden' => '1','info' => '<div class="row">
<div class="span5">{*mostrar_nombre@nombre,idejecutor*}<br/><b>Identificaci&oacute;n:</b> {*identificacion*}<br/><b>Fecha de ingreso:</b> {*fecha_ingreso*}</div>
<div class="span3"><b>Contacto:</b> {*empresa*}<br/><b>Cargo:</b> {*cargo*}<br/><b>Email:</b> {*email*}</div>
<div class="span4"><b>Direcci&oacute;n:</b> {*direccion*}<br/><b>Tel&eacute;fono:</b> {*telefono*}<br/><b>Ciudad:</b> {*ciudad_ejecutor*}</div>
</div>{*barra_inferior_remitente@idejecutor*}','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'empresa,cargo,email,telefono,direccion,ciudad_ejecutor','tablas_adicionales' => NULL,'ordenado_por' => 'a.nombre,a.identificacion','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/remitente/filtros_ejecutores.php?idbusqueda_componente=276','acciones_seleccionados' => 'inactivar_remitentes','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/remitente/adicionar_ejecutor.php','encabezado_grillas' => NULL,'llave' => 'a.idejecutor'),
        array('idbusqueda_componente' => '277','busqueda_idbusqueda' => '101','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Remitentes Inactivos','nombre' => 'remitentes_inactivos','orden' => '2','info' => '<div class="row">
<div class="span5">{*mostrar_nombre@nombre,idejecutor*}<br/><b>Identificaci&oacute;n:</b> {*identificacion*}<br/><b>Fecha de ingreso:</b> {*fecha_ingreso*}</div>
<div class="span3"><b>Contacto:</b> {*empresa*}<br/><b>Cargo:</b> {*cargo*}<br/><b>Email:</b> {*email*}</div>
<div class="span4"><b>Direcci&oacute;n:</b> {*direccion*}<br/><b>Tel&eacute;fono:</b> {*telefono*}<br/><b>Ciudad:</b> {*ciudad_ejecutor*}</div>
</div>{*barra_inferior_remitente@idejecutor*}','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'empresa,cargo,email,telefono,direccion,ciudad_ejecutor','tablas_adicionales' => NULL,'ordenado_por' => 'a.nombre,a.identificacion','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/remitente/filtros_ejecutores.php?idbusqueda_componente=277','acciones_seleccionados' => 'activar_remitentes','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idejecutor'),
        array('idbusqueda_componente' => '278','busqueda_idbusqueda' => '102','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Reporte Inventario','nombre' => 'reporte_inventario','orden' => '1','info' => 'Ver|{*funcion_ver_documento@iddocumento*}|center|80|-|Ubicaci&oacute;n|{*ubicacion*}|center|100|-|No. Caja|{*numero_caja*}|center|80|-|Descripci&oacute;n General|{*mostrar_datos_descripcion@iddocumento,plantilla*}|left|300|-|Fecha Inicial|{*fecha_inicial*}|center|100|-|Fecha Final|{*fecha_extrema_final*}|center|100|-|Folios|{*folios*}|center|80|-|Observaciones|{*observaciones*}|left|150|-|Tipo de Inventario|{*mostrar_tipo_inventario@plantilla*}|center|100','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'b.ubicacion, b.numero_caja, b.fecha_extrema_inicia as fecha_inicial, b.fecha_extrema_final, b.folios, b.observaciones','tablas_adicionales' => 'vreporte_inventario b','ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/inventario_documental/busqueda_avanzada.php?idbusqueda_componente=278','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '279','busqueda_idbusqueda' => '103','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '1. Despacho Radicacion de Correspondencia Por Distribuir','nombre' => 'reporte_radicacion_correspondencia','orden' => '1','info' => 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Acci&oacute;n|{*generar_accion_destino_radicacion@idft_destino_radicacion,mensajero_encargado,estado_item*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '600','cargar' => '1','campos_adicionales' => 'a.tipo_origen,a.idft_radicacion_entrada,a.fecha_radicacion_entrada,a.descripcion,a.descripcion_general,b.idft_destino_radicacion,b.mensajero_encargado,b.observacion_destino,b.numero_item,b.recepcion_fecha,CASE b.estado_item WHEN 0 THEN \'RADICADO EN VENTANILLA\' WHEN 1 THEN \'POR DISTRIBUIR\' WHEN 2 THEN \'EN DISTRIBUCI&Oacute;N\' ELSE \'FINALIZADO\' END as estado_item,a.fecha_radicacion_entrada,d.tipo_radicado,b.anexos,a.tipo_mensajeria,b.idft_destino_radicacion,b.estado_recogida','tablas_adicionales' => 'ft_radicacion_entrada a, ft_destino_radicacion b','ordenado_por' => 'fecha_radicacion_entrada','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'formatos/radicacion_entrada/busqueda_reporte.php?idbusqueda_componente=279','acciones_seleccionados' => 'filtrar_mensajero,select_finalizar_generar_item','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'd.iddocumento'),
        array('idbusqueda_componente' => '280','busqueda_idbusqueda' => '7','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Pendientes por ingresar - Origen Interno','nombre' => 'pendiente_ingresar','orden' => '1','info' => 'numero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|fecha|{*fecha*}|center|-|Asunto|{*descripcion*}|-|Fecha Limite|{*fecha_limite*}|center','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'ft_radicacion_entrada b','ordenado_por' => 'A.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '281','busqueda_idbusqueda' => '103','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '2. Despacho Radicacion de Correspondencia En Distribuci&oacute;n','nombre' => 'reporte_radicacion_correspondencia_distribucion','orden' => '2','info' => 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Acci&oacute;n|{*generar_accion_destino_radicacion_endistribucion@idft_destino_radicacion,mensajero_encargado,estado_item*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '600','cargar' => '1','campos_adicionales' => 'a.tipo_origen,a.idft_radicacion_entrada,a.fecha_radicacion_entrada,a.descripcion,a.descripcion_general,b.idft_destino_radicacion,b.mensajero_encargado,b.observacion_destino,b.numero_item,b.recepcion_fecha,CASE b.estado_item WHEN 0 THEN \'RADICADO EN VENTANILLA\' WHEN 1 THEN \'POR DISTRIBUIR\' WHEN 2 THEN \'EN DISTRIBUCI&Oacute;N\' ELSE \'FINALIZADO\' END as estado_item,a.fecha_radicacion_entrada,d.tipo_radicado,b.anexos,a.tipo_mensajeria,b.idft_destino_radicacion,b.estado_recogida','tablas_adicionales' => 'ft_radicacion_entrada a, ft_destino_radicacion b','ordenado_por' => 'fecha_radicacion_entrada','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'formatos/radicacion_entrada/busqueda_reporte.php?idbusqueda_componente=281','acciones_seleccionados' => 'filtrar_mensajero,select_finalizar_generar_item','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'd.iddocumento'),
        array('idbusqueda_componente' => '282','busqueda_idbusqueda' => '103','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '3. Despacho Radicacion de Correspondencia Finalizado','nombre' => 'reporte_radicacion_correspondencia_finalizado','orden' => '3','info' => 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Estado|{*mostrar_estado_destino_radicacion@idft_destino_radicacion*}|center|-|Diligencia|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion,estado_item*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Observaciones|{*observacion_destino*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '600','cargar' => '1','campos_adicionales' => 'a.tipo_origen,a.idft_radicacion_entrada,a.fecha_radicacion_entrada,a.descripcion,a.descripcion_general,b.idft_destino_radicacion,b.mensajero_encargado,b.observacion_destino,b.numero_item,b.recepcion_fecha,CASE b.estado_item WHEN 0 THEN \'RADICADO EN VENTANILLA\' WHEN 1 THEN \'POR DISTRIBUIR\' WHEN 2 THEN \'EN DISTRIBUCI&Oacute;N\' ELSE \'FINALIZADO\' END as estado_item,a.fecha_radicacion_entrada,d.tipo_radicado,b.anexos,a.tipo_mensajeria,b.idft_destino_radicacion,b.estado_recogida','tablas_adicionales' => 'ft_radicacion_entrada a, ft_destino_radicacion b','ordenado_por' => 'fecha_radicacion_entrada','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'formatos/radicacion_entrada/busqueda_reporte.php?idbusqueda_componente=282','acciones_seleccionados' => 'filtrar_mensajero','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'd.iddocumento'),
        array('idbusqueda_componente' => '284','busqueda_idbusqueda' => '105','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Correspondencia','nombre' => 'reporte_radicacion_correspondencia_dependencias','orden' => '1','info' => 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_distribucion*}|center|-|Ventanilla|{*mopstrar_nombre_ventanilla_radicacion@ventanilla_radicacion*}|center|-|Tipo de origen|{*mostrar_tipo_origen_reporte@tipo_origen*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Origen|{*mostrar_origen_reporte@iddistribucion*}|center|-|Destino|{*mostrar_destino_reporte@iddistribucion*}|center|-|Ruta|{*mostrar_ruta_reporte@iddistribucion*}|left|-|Descripci&oacute;n o Asunto|{*descripcion*}|center|-|Estado|{*estado_distribucion*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '600','cargar' => '1','campos_adicionales' => 'a.tipo_origen,a.idft_radicacion_entrada,a.fecha_radicacion_entrada,a.descripcion,a.descripcion_general,b.iddistribucion,b.mensajero_destino,b.numero_distribucion,b.finaliza_fecha,CASE b.estado_distribucion WHEN 0 THEN \'RADICADO EN VENTANILLA\' WHEN 1 THEN \'POR DISTRIBUIR\' WHEN 2 THEN \'EN DISTRIBUCI&Oacute;N\' ELSE \'FINALIZADO\' END as estado_distribucion,a.fecha_radicacion_entrada,d.tipo_radicado,c.dependencia','tablas_adicionales' => 'ft_radicacion_entrada a, distribucion b, vfuncionario_dc c','ordenado_por' => 'fecha_radicacion_entrada','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'formatos/radicacion_entrada/busqueda_reporte.php?idbusqueda_componente=284','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'd.iddocumento'),
        array('idbusqueda_componente' => '285','busqueda_idbusqueda' => '105','tipo' => '3','conector' => '2','url' => 'pantallas/indicadores_saia/index_indicadores.php?idindicador=11','etiqueta' => 'Indicadores de Correspondencia','nombre' => 'indicadores_reporte_radicacion_correspondencia_dependencias','orden' => '2','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'd.iddocumento'),
        array('idbusqueda_componente' => '286','busqueda_idbusqueda' => '106','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_categoria_formato.php	','etiqueta' => 'Categoria Formato','nombre' => 'admin_categoria_formato','orden' => '1','info' => '<div id="resultado_pantalla_{*idcategoria_formato*}" class="well"><b>{*nombre*}</b>{*enlaces_categoria_formato@idcategoria_formato,nombre*}{*validar_activo_inactivo_categoria_formato@idcategoria_formato,estado*}<br/><br/><br/></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'nombre','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/categoria_formato/adicionar_categoria_formato.php?idbusqueda_componente=286','encabezado_grillas' => NULL,'llave' => 'idcategoria_formato'),
        array('idbusqueda_componente' => '287','busqueda_idbusqueda' => '98','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Listado Series','nombre' => 'reporte_listado_series','orden' => '3','info' => 'CODIGO|{*codigo*}|right|200|-|TIPO|{*tipo*}|center|100|-|NOMBRE|{*nombre*}|left|280|-|ESTADO|{*estado*}|center|100','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'codigo,nombre,case tipo when 1 then "Serie" when 2 then "Subserie" else "Tipo documental" end as tipo,case estado when 1 then "Activo" else "Inactivo" end as estado','tablas_adicionales' => 'serie','ordenado_por' => 'codigo','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '290','busqueda_idbusqueda' => '107','tipo' => '2','conector' => '2','url' => 'formatos/radicacion_entrada/radicacion_rapida.php?idcategoria_formato=1&cmd=resetall','etiqueta' => 'Radicaci&oacute;n Rapida','nombre' => 'radicacion_rapida_kaiten','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '291','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Vinculado  por el funcionario','nombre' => 'documentos_relacionados_a','orden' => '1','info' => '<div class="row-fluid"><div class="pull-left tooltip_saia_abajo" title="{*etiqueta*}">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=\'pull-right\'><a href="#" enlace=\'ordenar.php?key={*iddocumento*}&mostrar_formato=1\' conector=\'iframe\'  titulo="Documento No.{*numero*}" class=\'kenlace_saia pull-left\' ><i class=\'icon-download tooltip_saia_izquierda\' title=\'Ver documento\'></i></a></div></div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'F.fecha,F.documento_origen,F.documento_destino,F.funcionario_idfuncionario,F.observaciones,A.ejecutor,A.numero,A.iddocumento,A.descripcion','tablas_adicionales' => 'documento_vinculados F, documento A','ordenado_por' => 'F.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '297','busqueda_idbusqueda' => '1','tipo' => '3','conector' => '2','url' => 'pantallas/indicadores_saia/index_indicadores.php?idindicador=1','etiqueta' => 'Indicadores Funcionarios','nombre' => 'indicadores_funcionario','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'f.idfuncionario'),
        array('idbusqueda_componente' => '298','busqueda_idbusqueda' => '7','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Pendientes por ingresar - PQRSF','nombre' => 'pendientes_ingresar_pqrsf','orden' => '1','info' => 'numero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|fecha|{*fecha*}|center|-|Asunto|{*descripcion*}|-|Fecha Limite|{*fecha_limite*}|center','exportar' => '','exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'ft_pqrsf B','ordenado_por' => 'A.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '299','busqueda_idbusqueda' => '19','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Empresas Transportadoras','nombre' => 'cf_empresa_trans','orden' => '2','info' => 'Nombre|{*nombre*}|center|-|Valor|{*valor*}|center|-|Categoria|{*categoria*}|center|-|Estado|{*estado*}|center|-|Acciones|{*barra_superior_cf@idcf_empresa_trans,nombre_tabla*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'idcf_empresa_trans,nombre,valor,categoria, case estado when 1 then \'activo\' else \'inactivo\' end as estado, \'cf_empresa_trans\' as nombre_tabla','tablas_adicionales' => 'cf_empresa_trans','ordenado_por' => 'nombre','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/admin_cf/busqueda_avanzada_cf.php?tabla=cf_empresa_trans&idbusqueda_componente=299','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/admin_cf/pantalla_cf_adicionar.php?tabla=cf_empresa_trans','encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '300','busqueda_idbusqueda' => '109','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '2. Por Distribuir','nombre' => 'reporte_distribucion_general_pordistribuir','orden' => '2','info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '600','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'iddistribucion','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=300','acciones_seleccionados' => 'filtro_mensajero_distribucion,opciones_acciones_distribucion,filtro_ventanilla_radicacion','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddistribucion'),
        array('idbusqueda_componente' => '301','busqueda_idbusqueda' => '109','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '3. En distribuci&oacute;n','nombre' => 'reporte_distribucion_general_endistribucion','orden' => '3','info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '600','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'iddistribucion','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=301','acciones_seleccionados' => 'filtro_mensajero_distribucion,opciones_acciones_distribucion,filtro_ventanilla_radicacion','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddistribucion'),
        array('idbusqueda_componente' => '302','busqueda_idbusqueda' => '109','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '4. Finalizado','nombre' => 'reporte_distribucion_general_finalizado','orden' => '4','info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '600','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'iddistribucion','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=302','acciones_seleccionados' => '','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddistribucion'),
        array('idbusqueda_componente' => '303','busqueda_idbusqueda' => '109','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '1. Entregas Interna a ventanilla','nombre' => 'reporte_distribucion_general_sinrecogida','orden' => '1','info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Acci&oacute;n|{*generar_check_accion_distribucion@iddistribucion*}|center|80|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '600','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'iddistribucion','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=303','acciones_seleccionados' => 'filtro_mensajero_distribucion,opciones_acciones_distribucion,filtro_ventanilla_radicacion','modulo_idmodulo' => '1655','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddistribucion'),
        array('idbusqueda_componente' => '304','busqueda_idbusqueda' => '120','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Reporte Usuario Concurrentes','nombre' => 'usuarios_conectados_concurrentes','orden' => '1','info' => 'Identificacion|{*nit*}|left|-|Nombres|{*nombre_completo*}|left|-|Login|{*login*}|left|-|Conexiones|{*cant_conexiones*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'vusuarios_concurrentes','ordenado_por' => 'nombre_completo','direccion' => 'ASC','agrupado_por' => 'funcionario_codigo,nit,nombre_completo,login','busqueda_avanzada' => 'pantallas/funcionario/filtros_usu_recurrentes.php?idbusqueda_componente=304','acciones_seleccionados' => NULL,'modulo_idmodulo' => '1670','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'funcionario_codigo'),
        array('idbusqueda_componente' => '320','busqueda_idbusqueda' => '115','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Inventario Documental','nombre' => 'reporte_expediente_grid_exp','orden' => '2','info' => 'SELECCIONE|{*check_expedientes@idexpediente*}|center|80|-|CODIGO|{*codigo_numero*}|left|80|-|NOMBRE DEL EXPEDIENTE|{*nombre*}|left|200|-|SERIE|{*nombre_serie*}|left|200|-|FECHA INICIAL|{*fecha_extrema_i*}|center|80|-|FECHA FINAL|{*fecha_extrema_f*}|center|80|-|INDICE 1|{*indice_uno*}|left|130|-|INDICE 2|{*indice_dos*}|left|130|-|INDICE 3|{*indice_tres*}|left|130|-|FOLIOS|{*no_folios*}|center|80|-|UNID CONSERV|{*no_unidad_conservacion*}|left|80|SOPORTE 3|{*soporte*}|left|80|-|NOTAS|{*notas_transf*}|left|200|-|Retenci&oacute;n|{*fecha_reten@idexpediente*}|left|200|','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => 'a.fecha','direccion' => '','agrupado_por' => 'a.nombre,a.codigo_numero,a.nombre_serie,a.fecha_extrema_i,a.fecha_extrema_f,a.indice_uno,a.indice_dos,a.indice_tres,a.no_folios,a.no_unidad_conservacion,a.soporte,a.notas_transf,a.idexpediente','busqueda_avanzada' => '','acciones_seleccionados' => 'acciones_expediente','modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '321','busqueda_idbusqueda' => '116','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Indice de Expediente','nombre' => 'reporte_docs_expediente_grid_exp','orden' => '2','info' => 'Radicado|{*radicado_exp_doc@documento_iddocumento*}|left|80|-|Tipo de documento|{*tipo_doc@documento_iddocumento*}|left|180|-|Descripcion|{*descripcion_doc@documento_iddocumento*}|left|220|-|Fecha|{*fecha*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'documento B,expediente_doc C','ordenado_por' => 'a.fecha','direccion' => 'asc','agrupado_por' => 'b.iddocumento','busqueda_avanzada' => '','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '322','busqueda_idbusqueda' => '19','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => 'Ventanillas de Radicaci&oacute;n','nombre' => 'cf_ventanilla','orden' => '3','info' => 'Nombre|{*nombre*}|center|-|Valor|{*valor*}|center|-|Categoria|{*categoria*}|center|-|Estado|{*estado*}|center|-|Acciones|{*barra_superior_cf@idcf_ventanilla,nombre_tabla*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'idcf_ventanilla,nombre,valor,categoria, case estado when 1 then \'activo\' else \'inactivo\' end as estado, \'cf_ventanilla\' as nombre_tabla','tablas_adicionales' => 'cf_ventanilla','ordenado_por' => 'nombre','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/admin_cf/busqueda_avanzada_cf.php?tabla=cf_ventanilla&idbusqueda_componente=322','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/admin_cf/pantalla_cf_adicionar.php?tabla=cf_ventanilla','encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '323','busqueda_idbusqueda' => '48','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_caja.php','etiqueta' => 'Cajas','nombre' => 'cajas1','orden' => '1','info' => '<div id="resultado_pantalla_{*idcaja*}" class="well"><div class="btn btn-mini enlace_caja pull-right" idregistro="{*idcaja*}" title="{*no_consecutivo*}"><i class="icon-info-sign"></i></div>{*enlaces_adicionales_caja@idcaja,funcionario_idfuncionario*}<i class=\' icon-caja-cerrada pull-left\'></i>{*enlace_caja@idcaja,codigo_dependencia,codigo_serie,no_consecutivo*}<br/><div class=\'descripcion_documento\'>{*obtener_descripcion_caja@fondo,seccion,subseccion,codigo*}</div></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'funcionario_idfuncionario','tablas_adicionales' => 'entidad_caja e','ordenado_por' => 'a.idcaja','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => 'pantallas/caja/buscar_caja.php?idbusqueda_componente=323','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => 'barra_superior_busqueda','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idcaja'),
        array('idbusqueda_componente' => '324','busqueda_idbusqueda' => '37','tipo' => '4','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=203','etiqueta' => 'Prestamo','nombre' => 'enlace_reporte_prestamo','orden' => '6','info' => '','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => '','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => '1666','menu_busqueda_superior' => '','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.idexpediente'),
        array('idbusqueda_componente' => '325','busqueda_idbusqueda' => '17','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Documentos por expediente','nombre' => 'documentos_expediente','orden' => '3','info' => '<div>{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*} {*fecha_creacion_documento@fecha,plantilla,iddocumento*}<div><br>{*descripcion*}</div><br><br>{*barra_inferior_documento@iddocumento,numero*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '470','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'expediente_doc b','ordenado_por' => 'a.fecha','direccion' => 'ASC','agrupado_por' => 'a.iddocumento','busqueda_avanzada' => 'pantallas/documento/busqueda_avanzada_documento.php','acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento'),
        array('idbusqueda_componente' => '326','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Notas del PDF','nombre' => 'notas_pdf','orden' => '1','info' => '<div><b>Fecha:</b>{*fecha_comentario*}<br /><b>Nota:</b>{*comentario*}<br /><b>Autor:</b> {*funcionario*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'B.iddocumento,B.fecha_comentario,B.comentario,B.funcionario','tablas_adicionales' => 'comentario_pdf B','ordenado_por' => 'B.fecha_comentario','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '328','busqueda_idbusqueda' => '49','tipo' => '3','conector' => '2','url' => 'busquedas/consulta_busqueda.php','etiqueta' => 'Vinculado  por el funcionario','nombre' => 'documentos_relacionados_dest','orden' => '1','info' => '<div class="row-fluid"><div class="pull-left tooltip_saia_abajo">{*numero*}-{*obtener_descripcion_informacion@descripcion*}</div><div class=\'pull-right\'><a href="#" enlace=\'ordenar.php?key={*iddocumento*}&mostrar_formato=1\' conector=\'iframe\'  titulo="Documento No.{*numero*}" class=\'kenlace_saia pull-left\' ><i class=\'icon-download tooltip_saia_izquierda\' title=\'Ver documento\'></i></a></div></div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => 'F.fecha,F.documento_origen,F.documento_destino,F.funcionario_idfuncionario,F.observaciones,A.ejecutor,A.numero,A.iddocumento,A.descripcion','tablas_adicionales' => 'documento_vinculados F, documento A','ordenado_por' => 'F.fecha','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '356','busqueda_idbusqueda' => '127','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda_tabla.php','etiqueta' => '1. Despacho Radicacion de Correspondencia Por Distribuir Elastic','nombre' => 'reporte_radicacion_correspondencia_elastic','orden' => '1','info' => 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Tramite|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Generar planilla|{*planilla_mensajero2@idft_destino_radicacion,mensajero_encargado*}|center|-|Tipo de origen|{*mostrar_tipo_origen_reporte@tipo_origen*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Observaciones|{*observacion_destino*}|left|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|left|-|Descripci&oacute;n o Asunto|{*descripcion*}|center|-|Estado|{*estado_item*}|center','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '600','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => 'documento, ft_radicacion_entrada, ft_destino_radicacion','ordenado_por' => '{"sort" : [{"ft_radicacion_entrada.fecha_radicacion_entrada" : {"order" :"asc"}}]}','direccion' => 'DESC','agrupado_por' => NULL,'busqueda_avanzada' => 'formatos_cliente/radicacion_entrada/busqueda_reporte_elastic.php?idbusqueda_componente=356','acciones_seleccionados' => NULL,'modulo_idmodulo' => '1903','menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'documento.iddocumento'),
        array('idbusqueda_componente' => '357','busqueda_idbusqueda' => '128','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Manuales','nombre' => 'manuales','orden' => '1','info' => '<div>{*listar_manuales@idmanual,agrupador,ruta_anexo,etiqueta,estado,descripcion,idcomp*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'etiqueta,descripcion,agrupador,ruta_anexo,estado, \'357\' as idcomp','tablas_adicionales' => 'manual','ordenado_por' => 'agrupador desc,etiqueta','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/manuales/','encabezado_grillas' => NULL,'llave' => 'idmanual'),
        array('idbusqueda_componente' => '358','busqueda_idbusqueda' => '128','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Manuales Inactivos','nombre' => 'manuales_inactivos','orden' => '2','info' => '<div>{*listar_manuales@idmanual,agrupador,ruta_anexo,etiqueta,estado,descripcion,idcomp*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'etiqueta,descripcion,agrupador,ruta_anexo,estado, \'357\' as idcomp','tablas_adicionales' => 'manual','ordenado_por' => 'agrupador desc,etiqueta','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/manuales/','encabezado_grillas' => NULL,'llave' => 'idmanual'),
        array('idbusqueda_componente' => '359','busqueda_idbusqueda' => '44','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Admin. Plantillas Word','nombre' => 'admin_plantillas_word','orden' => '2','info' => '  <div>{*listar_plantillas_word@idplantilla_word,ruta_anexo,nombre,estado,descripcion,extension*}</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '1','ancho' => '320','cargar' => '2','campos_adicionales' => 'idplantilla_word,nombre,descripcion,estado,extension,ruta_anexo','tablas_adicionales' => 'plantilla_word','ordenado_por' => 'nombre','direccion' => 'asc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => '','modulo_idmodulo' => '0','menu_busqueda_superior' => NULL,'enlace_adicionar' => 'pantallas/plantillas_word/','encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '362','busqueda_idbusqueda' => '44','tipo' => '3','conector' => '2','url' => 'pantallas/busquedas/consulta_busqueda.php','etiqueta' => 'Listar pantallas','nombre' => 'listado_pantallas','orden' => '2','info' => '<div id=\'resultado_pantalla_{*idformato*}\' class=\'well\'><table style="width:40%;font-size:8pt;font-family:arial;border-collapse:collapse" border="1px"><tr><td style="width:20%">Nombre</td><td style="text-align:center;width:20%">Pdf</td></tr><tr><td><b><a class="kenlace_saia" enlace="pantallas/generador/generador_pantalla.php?idformato={*idformato*}" conector=\'iframe\' titulo=\'Formato {*etiqueta*}\' style="cursor:pointer">{*etiqueta*}-{*idformato*}</a></b></td><td style="text-align:center">{*pdf_funcion@idformato*}</td></tr></table></div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => '','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => 'A.nombre,A.librerias,A.etiqueta,A.funcionario_idfuncionario,A.ayuda,A.banderas,A.tiempo_autoguardado','tablas_adicionales' => 'formato A','ordenado_por' => 'A.etiqueta','direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => '','acciones_seleccionados' => '','modulo_idmodulo' => '1917','menu_busqueda_superior' => 'menu_superior_adicionar@{*idformato*}','enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'A.idformato'),
        array('idbusqueda_componente' => '363','busqueda_idbusqueda' => '131','tipo' => '3','conector' => '2','url' => 'pantallas/formato/listado_formatos.php','etiqueta' => 'Administraci&oacute;n de formatos','nombre' => 'generador_formatos','orden' => '1','info' => NULL,'exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => 'ASC','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => NULL),
        array('idbusqueda_componente' => '364','busqueda_idbusqueda' => '98','tipo' => '2','conector' => '1','url' => NULL,'etiqueta' => 'Tabla de retenci&oacute;','nombre' => 'listado_reporte_retencion','orden' => '3','info' => '<div title="Reporte Retenci&oacute;n" data-load=\'{"kConnector":"iframe","url":"../pantallas/serie/busqueda_reporte_series_dependencias.php?idbusqueda_componente=272","kTitle":"Retencion","kWidth":"320px"}\' class="items navigable">
<div class="head"></div>
<div class="label">Tabla de retenci&oacute;n</div>
<div class="tail"></div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => NULL,'estado' => '1','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => ''),
        array('idbusqueda_componente' => '365','busqueda_idbusqueda' => '132','tipo' => '3','conector' => '2','url' => 'views/buzones/listado.php','etiqueta' => 'etiquetados','nombre' => 'etiquetados','orden' => '1','info' => '<div class="" style="line-height:1;">
    <div class="row mx-0">
        {*origin_pending_document@iddocumento,ejecutor,numero,fecha,plantilla,idtransferencia*}        
    </div>
    <div class="row mx-0">
        <div class="col-1 px-0">
            <div class="row p-0 m-0">
                <div class="col-12 p-0 text-center">{*unread@iddocumento,fecha*}</div>
                <div class="col-12 p-0 text-center">{*has_files@iddocumento*}</div>
                <div class="col-12 p-0 text-center">{*priority@iddocumento*}</div>
            </div>
        </div>
        <div class="col-11">
            <p class="text-justify" style="line-height: 1;font-size: 12px;">
                {*limit_description@descripcion,limit_description*}
            </p>
        </div>
    </div>
    <div class="row mx-0 pt-1">
        <div class="col-1 px-0 text-center">
            <span class="my-2" id="checkbox_location" ></span>            
        </div>
        <div class="col">{*documental_type@iddocumento*}</div>
        <div class="col-auto text-right">{*expiration@fecha_limite*}</div>
    </div>
</div>','exportar' => NULL,'exportar_encabezado' => NULL,'encabezado_componente' => 'views/buzones/encabezado_recibidos.php','estado' => '2','ancho' => '320','cargar' => '1','campos_adicionales' => NULL,'tablas_adicionales' => NULL,'ordenado_por' => NULL,'direccion' => NULL,'agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => NULL)
    );
    public function getDescription() {
        return 'Actualiza busqueda y busqueda_componente, reportes de correspondencia y distribución';
    }
    public function preUp(Schema $schema)
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    public function up(Schema $schema)
    {
        $conn = $this->connection;

        $platform   = $conn->getDatabasePlatform();

        $conn->executeUpdate($platform->getTruncateTableSQL('busqueda', true /* whether to cascade */));
        $conn->executeUpdate($platform->getTruncateTableSQL('busqueda_componente', true /* whether to cascade */));

        $conn->beginTransaction();

        foreach ($this->busqueda as $value) {
            $this->guardar_campo($value,"busqueda");
        }
        $conn->commit();
        $conn->beginTransaction();

        foreach ($this->busqueda_componente as $value) {
            $this->guardar_campo($value,"busqueda_componente");
        }
        $conn->commit();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        return true;
    }
    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    private function guardar_campo($datos,$tabla) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;
        $resp = $conn->insert($tabla, $datos);
        if (empty($resp)) {
            $conn->rollBack();
            print_r($conn->errorInfo());
            die("Fallo la insercion de la tabla ".$tabla);
        }
        $idbusq = $conn->lastInsertId();

        return $idbusq;
    }
}
