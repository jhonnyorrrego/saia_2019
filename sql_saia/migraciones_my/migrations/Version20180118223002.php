<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180118223002 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        
        $conn = $this->connection;
        
        //formato: solicitud_prestamo
        $result = $conn->fetchAll("select idformato from formato where nombre = :nombre", [
            'nombre' => 'solicitud_prestamo'
        ]);
        
        $conn->beginTransaction();
        
        if (!empty($result)) {
            $idformato1 = $result[0]["idformato"]; //412
            // campo: transferencia_presta
            $datos = ['etiqueta_html' => 'checkbox'];
            $ident = ['formato_idformato' => $idformato1, 'nombre' => 'transferencia_presta'];	
            $resp = $conn->update('campos_formato', $datos, $ident);
            
            $datos_ff = ['nombre' => '{*insertar_item_prestamo_exp*}', 'nombre_funcion' =>'insertar_item_prestamo_exp',  'etiqueta' => 'insertar_item_prestamo_exp', 
                'ruta' => 'funciones.php', 'formato' => $idformato1, 'acciones' => ''];
           
            $resp = $conn->insert('funciones_formato', $datos_ff);
            $id_ff = $conn->lastInsertId(); //958
            
            $datos_ffa = ['idfunciones_formato' => $id_ff, 'accion_idaccion' => 3, 'formato_idformato' => $idformato1, 'momento' => 'POSTERIOR', 'estado' => 1, 'orden' => 1];
            
            $resp = $conn->insert('funciones_formato_accion', $datos_ffa);
            
            $id_ffa = $conn->lastInsertId(); //307
        }
        
        //formato: transferencia_doc
        $result = $conn->fetchAll("select idformato from formato where nombre = :nombre", [
            'nombre' => 'transferencia_doc'
        ]);
        
        if (!empty($result)) {
            $idformato2 = $result[0]["idformato"]; //343
            $datos = ['etiqueta_html' => 'checkbox'];
            $ident = ['formato_idformato' => $idformato2, 'nombre' => 'expediente_vinculado'];
            $resp = $conn->update('campos_formato', $datos, $ident);
            
        }
        
        //formato: item_prestamo_exp
        $result = $conn->fetchAll("select idformato from formato where nombre = :nombre", [
            'nombre' => 'item_prestamo_exp'
        ]);
        
        
        $idformato = null;
        if (!empty($result)) {
            $idformato = $result[0]["idformato"];
        } else {
            $datos = ['nombre' => 'item_prestamo_exp', 'etiqueta' => 'item_prestamo_exp', 'cod_padre' => 412, 
                'contador_idcontador' => 235, 'nombre_tabla' => 'ft_item_prestamo_exp', 'ruta_mostrar' => 'mostrar_item_prestamo_exp.php', 
                'ruta_editar' => 'editar_item_prestamo_exp.php',
                'ruta_adicionar' => 'adicionar_item_prestamo_exp.php',
                'encabezado' => '', 'cuerpo' => '', 'pie_pagina' => '', 'margenes' => '15,20,30,20',
                'orientacion' => '0', 'papel' => 'A4', 'exportar' => 'tcpdf', 'funcionario_idfuncionario' =>  1,
                'fecha' => '2017-10-20 21:54:19', 'mostrar' => '0', 'detalle' => '0', 
                'tipo_edicion' => 0, 'item' => '1', 'serie_idserie' => 1347,
                'font_size' => '9', 'banderas' => 'm', 'tiempo_autoguardado' => '300000', 'mostrar_pdf' => 1, 
                'enter2tab' => 0, 'firma_digital' => 0, 'fk_categoria_formato' => '2,13',  'flujo_idflujo' => 0,
                'funcion_predeterminada' => '', 'paginar' => '1', 'pertenece_nucleo' => 0, 'permite_imprimir' => 1];
            
            $resp = $conn->insert('formato', $datos);
            
            $idformato = $conn->lastInsertId();
            
        }

        if (empty($idformato)) {
            $conn->rollBack();
            print_r($conn->errorInfo());
            die("Fallo la creacion del formato");
        }

        $table = $schema->getTable('campos_formato');
        
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'ft_solicitud_prestamo', 'etiqueta' => 'item_prestamo_exp', 'tipo_dato' => 'INT', 'longitud' => '11', 'obligatoriedad' => 1, 'valor' => '412', 'acciones' => 'a', 'ayuda' => 'item_prestamo_exp',  'banderas' => 'fk', 'etiqueta_html' => 'detalle', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'fk_expediente', 'etiqueta' => 'fk_expediente', 'tipo_dato' => 'INT', 'longitud' => '11', 'obligatoriedad' => 1,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'idft_item_prestamo_exp', 'etiqueta' => 'ITEM_PRESTAMO_EXP', 'tipo_dato' => 'INT', 'longitud' => '11', 'obligatoriedad' => 1,  'acciones' => 'a,e',   'banderas' => 'ai,pk', 'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'fecha_prestamo', 'etiqueta' => 'fecha_prestamo', 'tipo_dato' => 'DATETIME',  'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'fecha_devolucion', 'etiqueta' => 'fecha_devolucion', 'tipo_dato' => 'DATETIME',  'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'estado_prestamo', 'etiqueta' => 'estado_prestamo', 'tipo_dato' => 'INT', 'longitud' => '11', 'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'observacion_prestamo', 'etiqueta' => 'observacion_prestamo', 'tipo_dato' => 'VARCHAR', 'longitud' => '255', 'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'funcionario_prestamo', 'etiqueta' => 'funcionario_prestamo', 'tipo_dato' => 'INT', 'longitud' => '11', 'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'funcionario_devoluci', 'etiqueta' => 'funcionario_devoluci', 'tipo_dato' => 'INT', 'longitud' => '11', 'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        $datos = ['formato_idformato' => $idformato, 'nombre' => 'observacion_devolver', 'etiqueta' => 'observacion_devolver', 'tipo_dato' => 'VARCHAR', 'longitud' => '255', 'obligatoriedad' => 0,  'acciones' => 'a,e,b',    'etiqueta_html' => 'hidden', 'orden' => 0,   'autoguardado' => 0, 'fila_visible' => 1];
        $conn->insert('campos_formato', $datos);
        
        $busqueda = ['nombre' => 'reporte_solicitud_prestamo', 'etiqueta' => 'Prestamo', 'estado' => 1, 'ancho' => 200, 'campos' => 'a.fecha,a.ejecutor', 
            'llave' => 'a.iddocumento', 'tablas' => 'documento a', 'ruta_libreria' => 'formatos/solicitud_prestamo/librerias.php', 'ruta_libreria_pantalla' => 'formatos/solicitud_prestamo/funciones_js.php', 
            'cantidad_registros' => 30, 'tiempo_refrescar' => 500, 'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_reporte.php', 'tipo_busqueda' => 2];
        
        $idbusq = $this->guardar_busqueda($busqueda);  //54
        
        $componente1 = ['busqueda_idbusqueda' => $idbusq, 'tipo' => 3, 'conector' => 2, 'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php', 'etiqueta' => 'Prestamo', 'nombre' => 'reporte_solicitud_prestamo',
            'orden' => 2, 'info' => 'Fecha de solicitud|{*parsear_fecha_reserva1@fecha*}|left|-|Solicitante|{*nombre_solicitante@ejecutor*}|left|-|Solicitud de Prestamo|{*enlace_documento_reservar@documento_iddocumento*}|left|-|Expediente|{*mostrar_informacion_expediente@fk_expediente*}|left|300|-|Desde|{*parsear_fecha_reserva2@fecha_prestamo_rep*}|left|-|Hasta|{*parsear_fecha_reserva3@fecha_devolucion_rep*}|left|-|Entrega|{*accion_entrega@idft_item_prestamo_exp,funcionario_prestamo,fecha_prestamo,observacion_prestamo,estado_prestamo*}|center|-|Devolucion|{*accion_devuelto@idft_item_prestamo_exp,funcionario_devoluci,fecha_devolucion,observacion_devolver,estado_prestamo*}|center|-|Tiempo transcurrido|{*tiempo_transcurrido_reserva@fecha_prestamo,fecha_devolucion*}|left', 
            'estado' => 2, 'ancho' => 320, 'cargar' => 2, 'campos_adicionales' => 'b.documento_iddocumento, b.idft_solicitud_prestamo, b.serie_idserie, b.estado_documento, b.anexos, b.documento_archivo, b.observaciones, b.nombre_solicita, b.fecha, b.fecha_prestamo_rep, b.fecha_devolucion_rep, b.transferencia_presta,c.idft_item_prestamo_exp, c.fecha_prestamo, c.fecha_devolucion, c.estado_prestamo, c.funcionario_prestamo, c.observacion_prestamo,c.fecha_devolucion,c.observacion_devolver,c.funcionario_devoluci,c.fk_expediente', 
            'tablas_adicionales' => 'ft_solicitud_prestamo b, ft_item_prestamo_exp c', 'ordenado_por' => 'a.fecha', 'direccion' => 'desc',
            'acciones_seleccionados' => 'funcion_entregar_devolver'];
        
        $idcmp1 = $this->guardar_componente($componente1); //203
        
        $cond1 = ['fk_busqueda_componente' => $idcmp1, 'codigo_where' => "b.idft_solicitud_prestamo=c.ft_solicitud_prestamo AND a.iddocumento=b.documento_iddocumento and lower(a.estado) not in('eliminado','anulado','activo')",
            'etiqueta_condicion' => 'condicion_reporte_reserva_documentos'];
        
        $resp1 = $this->guardar_condicion($cond1); // 170

        $datos_busq = [
            'ruta_libreria' => 'pantallas/expediente/funciones_reporte_grid.php,pantallas/expediente/librerias.php'
        ];
        $ident_busq = [
            'nombre' => 'reporte_expediente_grid'
        ]; // idbusqueda = 115
        
        $resp = $conn->update('busqueda', $datos_busq, $ident_busq);

        //modulo: permiso_armin_archivo

        $datos_mod = array('pertenece_nucleo' => 0, 'nombre' => 'permiso_armin_archivo', 'tipo' => 'secundario', 'imagen' => 'botones/principal/defaut.png',
            'etiqueta' => 'Administraci&oacute;n de Archivo', 'enlace' => '#', 'destino' => '_self', 'cod_padre' => 45, 'orden' => 2, 'ayuda' => '',
            'busqueda_idbusqueda' => 0, 'permiso_admin' => 0, 'busqueda' => '', 'enlace_pantalla' => 0);
        
        $result = $conn->fetchAll("select idmodulo from modulo where nombre = :nombre", [
            'nombre' => 'permiso_armin_archivo'
        ]);
        
        if (!empty($result)) {
            $idmodulo = $result[0]["idmodulo"]; //1669
            $resp = $conn->update('modulo', $datos_mod, ["idmodulo" => $idmodulo]);
        } else {
            $resp = $conn->insert('modulo', $datos_mod);
            $idmodulo = $conn->lastInsertId(); //1669
        }
        
        $conn->commit();
        
    }

    public function postUp($schema) {
        
    }
    
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
    
    private function guardar_busqueda($datos) {
        if(empty($datos)) {
            return false;
        }
        
        $conn = $this->connection;
        
        $result = $conn->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);
        
        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda"];
        } else {
            $resp = $conn->insert('busqueda', $datos);
            
            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda");
            }
            $idbusq = $conn->lastInsertId();
            
        }
        return $idbusq;
    }
    
    private function guardar_componente($datos) {
        if(empty($datos)) {
            return false;
        }
        
        $conn = $this->connection;
        
        $result = $conn->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);
        
        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda_componente"];
        } else {
            $resp = $conn->insert('busqueda_componente', $datos);
            
            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_componente");
            }
            $idbusq = $conn->lastInsertId();
            
        }
        return $idbusq;
    }
    
    private function guardar_condicion($datos) {
        if(empty($datos)) {
            return false;
        }
        
        $conn = $this->connection;
        
        $result = $conn->fetchAll("select idbusqueda_condicion from busqueda_condicion where etiqueta_condicion  = :etiqueta_condicion", [
            'etiqueta_condicion' => $datos["etiqueta_condicion"]
        ]);
        
        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda_condicion"];
        } else {
            $resp = $conn->insert('busqueda_condicion', $datos);
            
            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_condicion");
            }
            $idbusq = $conn->lastInsertId();
            
        }
        return $idbusq;
    }
    
}
