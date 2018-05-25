<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180516205347 extends AbstractMigration {

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $table = $schema->getTable('pantalla');
        $this->abortIf(!$table, 'No ha configurado este SAIA para pantallas');
        $table->addColumn("cuerpo_pantalla", "text", [
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8',
            "notnull" => false
        ]);
        $table->addColumn("accion_eliminar", "integer", [
            "length" => 11,
            "notnull" => true,
            "default" => 2
        ]);
        $table2 = $schema->getTable('campos_formato');
        $table2->addColumn("placeholder", "string", [
            'length'  => '255',
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8',
            'notnull' => false
        ]);
        $conn = $this->connection;

        $conn->beginTransaction();

        $modulo = [
            'pertenece_nucleo' => 1,
            'nombre' => 'pantallas',
            'tipo' => 'secundario',
            'imagen' => 'botones/principal/admin_formatos.png',
            'etiqueta' => 'Admin. Pantallas',
            'enlace' => ' ',
            'destino' => 'centro',
            'cod_padre' => 2,
            'orden' => 1,
            'ayuda' => 'Permite generar pantallas y particularmente formatos',
            'parametros' => '',
            'busqueda_idbusqueda' => 0,
            'permiso_admin' => 1,
            'busqueda' => '',
            'enlace_pantalla' => 0
        ];

        $idmodulo = $this->guardar_modulo($modulo);

        $busqueda = [
          'nombre' => 'pantallas',
          'etiqueta' => 'Pantallas',
          'estado' => '1',
          'campos' => '',
          'tablas' => '',
          'ruta_libreria' => 'pantallas/pantallas/librerias.php',
          'ruta_libreria_pantalla' => '',
          'cantidad_registros' => 20,
          'tiempo_refrescar' => 500,
          'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda.php',
          'tipo_busqueda' => 1,
          'elastic' => 0
        ];

        $idbusq = $this->guardar_busqueda($busqueda);

        $componente1 = [
          'busqueda_idbusqueda' => $idbusq,
          'tipo' => '3',
          'conector' => '2',
          'url' => 'pantallas/busquedas/consulta_busqueda.php',
          'etiqueta' => 'Listar pantallas',
          'nombre' => 'listado_pantallas',
          'orden' => 2,
          'info' => '<div id=\'resultado_pantalla_{*idpantalla*}\' class=\'well\'><table style="width:40%;font-size:8pt;font-family:arial;border-collapse:collapse" border="1px"><tr><td style="width:20%">Nombre</td><td style="text-align:center;width:20%">Pdf</td></tr><tr><td><b><a class="kenlace_saia" enlace="pantallas/generador/generador_pantalla.php?idpantalla={*idpantalla*}" conector=\'iframe\' titulo=\'Pantalla {*etiqueta*}\' style="cursor:pointer">{*etiqueta*}-{*idpantalla*}</a></b></td><td style="text-align:center">{*pdf_funcion@idpantalla*}</td></tr></table></div>',
          'exportar' => NULL,
          'encabezado_componente' => '',
          'estado' => 2,
          'cargar' => 2,
          'campos_adicionales' => 'A.nombre,A.librerias,A.etiqueta,A.funcionario_idfuncionario,A.ayuda,A.banderas,A.tiempo_autoguardado',
          'tablas_adicionales' => 'pantalla A',
          'ordenado_por' => 'A.etiqueta',
          'direccion' => 'ASC',
          'agrupado_por' => '',
          'busqueda_avanzada' => '',
          'acciones_seleccionados' => '',
          'modulo_idmodulo' => $idmodulo,
          'menu_busqueda_superior' => 'menu_superior_adicionar@'.$idbusq,
          'enlace_adicionar' => NULL,
          'llave' => 'A.idpantalla'
        ];

        $idcmp1 = $this->guardar_componente($componente1);

        $cond1 = [
            "fk_busqueda_componente" => $idcmp1,
            "codigo_where" => "1=1",
            "etiqueta_condicion" => "condicion_listado_pantallas"
        ];

        $resp1 = $this->guardar_condicion($cond1);

        $enlace_modulo = 'pantallas/buscador_principal.php?idbusqueda='.$idbusq.'&cmd=resetall';

        $datos_mod = [
            'enlace' => $enlace_modulo
        ];
        $ident_mod = [
            'idmodulo' => $idmodulo
        ];
        $resp = $conn->update('modulo', $datos_mod, $ident_mod);

        $conn->commit();
        $conn->beginTransaction();
        if (!$schema->hasTable("formato_libreria")){
            $table = $schema->createTable("formato_libreria");
            $table->addColumn("idformato_libreria", "integer", [
                "length" => 11,
                "notnull" => false,
                'autoincrement' => true
            ]);
            $table->addColumn("fecha", "datetime", [
                "notnull" => false
            ]);
            $table->addColumn("formato_idformato", "integer", [
                "length" => 11,
                "notnull" => false
            ]);
            $table->addColumn("funcionario_idfuncionario", "integer", [
                "length" => 11,
                "notnull" => false
            ]);
            $table->addColumn("ruta", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("orden", "integer", [
                "length" => 11,
                "default" => 1,
                "notnull" => false
            ]);
            $table->setPrimaryKey([
                "idformato_libreria"
            ]);
        }
        $conn->commit();




        /**
         *
         *UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"campo_texto\",\"etiqueta\":\"Campo de texto\",\"tipo_dato\":\"varchar\",\"longitud\":255,\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"text\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"campo texto\"}' WHERE idpantalla_componente=1;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"radio\",\"etiqueta\":\"Boton de Seleccion Tipo 1\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"1,1;2,2;3,3;4,4\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"radio\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo texto\"}' WHERE idpantalla_componente=2;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"arbol_checkbox\",\"etiqueta\":\"Arbol de funcionario checkbox\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"pantallas/lib/arbol_funcionarios.php?rol=1|1|0|1|1|0|5\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"arbol_checkbox\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}' WHERE idpantalla_componente=3;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"checkbox\",\"etiqueta\":\"Checkbox\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"1,1;2,2;3,3;4,4\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"checkbox\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}' WHERE idpantalla_componente=4;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"password\",\"etiqueta\":\"Password\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"password\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo texto\"}' WHERE idpantalla_componente=5;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"textarea\",\"etiqueta\":\"Textarea\",\"tipo_dato\":\"text\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"textarea\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Area de texto\"}' WHERE idpantalla_componente=6;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"select\",\"etiqueta\":\"Select\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"1,1;2,2;3,3;4,4\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"select\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"seleccionar..\"}' WHERE idpantalla_componente=7;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"hidden\",\"etiqueta\":\"Campo Hidden\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"hidden\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo hidden\"}' WHERE idpantalla_componente=8;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"link\",\"etiqueta\":\"Link\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"#;_blank\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"link\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo hidden\"}' WHERE idpantalla_componente=9;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"arbol_radio\",\"etiqueta\":\"Arbol de funcionario radio\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"pantallas/lib/arbol_funcionarios.php?rol=1|1|0|1|1|0|5\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"arbol_radio\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}' WHERE idpantalla_componente=10;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"datetime\",	\"etiqueta\":\"Fecha y Hora\",\"tipo_dato\":\"datetime\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"yyyy-MM-dd hh:mm:ss\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"datetime\",\"orden\":1,\"mascara\":\"\",	\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,	\"placeholder\":\"0000-00-00\"}' WHERE idpantalla_componente=11;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"daterange\",\"etiqueta\":\"Rango fechas\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"0000-00-00\",	\"acciones\":\"a,e,b\",	\"ayuda\":\"\",	\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"daterange\",\"orden\":1,\"mascara\":\"\",	\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}' WHERE idpantalla_componente=12;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"highslide\",\"etiqueta\":\"Highslide\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"highslide\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Highslide\"}' WHERE idpantalla_componente=13;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"date\",	\"etiqueta\":\"Fecha \",\"tipo_dato\":\"date\",	\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"yyyy-MM-dd\",\"acciones\":\"a,e,b\",	\"ayuda\":\"\",	\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"date\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",	\"autoguardado\":1,	\"fila_visible\":1,	\"placeholder\":\"0000-00-00\"}' WHERE idpantalla_componente=14;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"textarea_tiny\",\"etiqueta\":\"Area de texto\",\"tipo_dato\":\"text\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"avanzado\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"textarea_tiny\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Area de texto\"}' WHERE idpantalla_componente=15;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"accion_pantalla\",\"etiqueta\":\"Accion pantalla\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones sobre las pantallas\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_pantalla\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Acciones pantalla\"}' WHERE idpantalla_componente=16;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"file\",\"etiqueta\":\"Anexos\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"file\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}' WHERE idpantalla_componente=17;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"etiqueta\",\"etiqueta\":\"Etiqueta\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"etiqueta\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}' WHERE idpantalla_componente=18;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"accion_pantalla_js\",\"etiqueta\":\"Accion pantalla JS\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones sobre las pantallas para bloques Javascript\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_pantalla_js\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Acciones pantalla Javascript\"}' WHERE idpantalla_componente=19;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"acciones_envio_correo\",\"etiqueta\":\"Envio Correo\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para enviar un correo\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_envio_correo\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Enviar correo\"}' WHERE idpantalla_componente=20;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"acciones_transferir\",\"etiqueta\":\"Transferencia\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para transferir un documento\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_transferir\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Enviar correo\"}' WHERE idpantalla_componente=21;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"conector_hidden\",\"etiqueta\":\"Conector hidden\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a\",\"ayuda\":\"Conector de un registro con otro\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"conector_hidden\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"\"}' WHERE idpantalla_componente=22;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"conector_highslide\",\"etiqueta\":\"Conector hidden\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Conector de un registro con otro highslide\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"conector_highslide\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"\"}' WHERE idpantalla_componente=23;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"campo_heredado\",\"etiqueta\":\"Campo heredado\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Campo heredado\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"campo_heredado\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"\"}' WHERE idpantalla_componente=24;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"acciones_confirmar_documento\",\"etiqueta\":\"Confirmar documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Accion necesaria para confirmar documento\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_confirmar_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Confirmar documento\"}' WHERE idpantalla_componente=25;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"acciones_redireccionar\",\"etiqueta\":\"Redireccionar\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Accion necesaria para redireccionar despues de guardar\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_redireccionar\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Redireccionar\"}' WHERE idpantalla_componente=26;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"seguimiento_documento\",\"etiqueta\":\"Hacer seguimiento documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para hacer el seguimiento a un documento\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"seguimiento_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Hacer seguimiento de documento\"}' WHERE idpantalla_componente=27;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"contador\",\"etiqueta\":\"Contador\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"contador\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"\"}' WHERE idpantalla_componente=28;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"usuario_actual\",\"etiqueta\":\"Usuario actual\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"usuario_actual\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Usuario actual\"}' WHERE idpantalla_componente=29;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"ruta_documento\",\"etiqueta\":\"Ruta del documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"ruta_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Ruta del documento\"}' WHERE idpantalla_componente=30;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"ruta_documento\",\"etiqueta\":\"Ruta fija del documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"ruta_fija_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Ruta fija del documento\"}' WHERE idpantalla_componente=31;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"acciones_tarea_bpmni\",\"etiqueta\":\"Tarea BPMN\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para generar tarea instancia BPM\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_tarea_bpmni\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Tarea instancia BPMN\"}' WHERE idpantalla_componente=32;
UPDATE pantalla_componente2 SET opciones='{\"nombre\":\"remitente\",\"etiqueta\":\"Remitente\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"remitente\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"\"}' WHERE idpantalla_componente=33;
         *
         **/


    }

    public function postUp(Schema $schema) {

    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $table = $schema->getTable('pantalla');
        $table->dropColumn("cuerpo_pantalla");
        $table->dropColumn("accion_eliminar");
        $schema->dropTable('formato_libreria');
        $table = $schema->getTable('campos_formato');
        $table->dropColumn("placeholder");
    }
    private function guardar_busqueda($datos) {
        if (empty($datos)) {
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
        if (empty($datos)) {
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
        if (empty($datos)) {
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

    private function guardar_modulo($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idmodulo from modulo where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);

        $idmodulo = null;
        if (!empty($result)) {
            $idmodulo = $result[0]["idmodulo"];
        } else {
            $resp = $conn->insert('modulo', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion del modulo");
            }
            $idmodulo = $conn->lastInsertId();
        }
        return $idmodulo;
    }

}
