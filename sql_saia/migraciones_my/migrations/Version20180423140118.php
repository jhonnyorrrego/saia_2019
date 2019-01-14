<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180423140118 extends AbstractMigration {

    public function getDescription(): string {
        return 'Ejemplo de reporte usando elastic-search';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        $table = $schema->getTable('busqueda');
        $this->abortIf(!$table->hasColumn("elastic"), 'No ha configurado este SAIA para eleasticsearch');

        $this->crear_ejemplo_elastic();
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

    public function crear_ejemplo_elastic() {
        $conn = $this->connection;

        $conn->beginTransaction();

        $modulo = [
            'pertenece_nucleo' => 0,
            'nombre' => 'modulo_prueba_elastic',
            'tipo' => 'secundario',
            'imagen' => 'botones/principal/defaut.png',
            'etiqueta' => 'Por distribuir elastic',
            'enlace' => 'pantallas/buscador_principal.php?idbusqueda=110&default_componente=reporte_radicacion_correspondencia_elastic',
            'destino' => 'centro',
            'cod_padre' => 2,
            'orden' => 1,
            'ayuda' => '',
            'parametros' => '',
            'busqueda_idbusqueda' => 0,
            'permiso_admin' => 0,
            'busqueda' => '',
            'enlace_pantalla' => 0
        ];

        $idmodulo = $this->guardar_modulo($modulo);

        $busqueda = [
            'nombre' => 'reporte_radicacion_correspondencia_elastic',
            'etiqueta' => 'Despacho Radicaci&oacute;n de Correspondencia Elastic',
            'estado' => 1,
            'ancho' => 200,
            'campos' => '{"filter": [    { "term":  { "documento.estado": "aprobado" }},    { "term":  { "ft_radicacion_entrada.despachado": "1" }},    { "terms":  { "ft_radicacion_entrada.tipo_destino": [1, 2] }},    {"has_child":{                    "type" : "DESTINO_RADICACION",                     "query" : {"term" : {"ft_destino_radicacion.estado_item":"1"}},                   "inner_hits" : {"from" : 0}                    }                }]}',
            'llave' => 'documento.iddocumento',
            'tablas' => '{"index" : "radicacion_entrada"}',
            'ruta_libreria' => 'formatos_cliente/radicacion_entrada/libreria_reporte_radicacion.php',
            'ruta_libreria_pantalla' => 'formatos_cliente/radicacion_entrada/adicionales_js.php',
            'cantidad_registros' => 300,
            'tiempo_refrescar' => 500,
            'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
            'tipo_busqueda' => 2,
            'elastic' => 1
        ];

        $idbusq = $this->guardar_busqueda($busqueda);

        $componente1 = [
            'busqueda_idbusqueda' => $idbusq,
            'tipo' => 3,
            'conector' => 2,
            'url' => 'pantallas/busquedas/consulta_busqueda_reporte.php',
            'etiqueta' => '1. Despacho Radicacion de Correspondencia Por Distribuir Elastic',
            'nombre' => 'reporte_radicacion_correspondencia_elastic',
            'orden' => 1,
            'info' => 'Radicado|{*ver_items@iddocumento,numero,fecha_radicacion_entrada,tipo_radicado*}|center|-|No. Item|{*numero_item*}|center|-|Tramite|{*mostrar_tramite_radicacion@idft_destino_radicacion,tipo_mensajeria,estado_recogida*}|center|-|Mensajero|{*mostrar_mensajeros_dependencia@idft_destino_radicacion*}|center|-|Planilla Asociada|{*planilla_mensajero@idft_destino_radicacion,mensajero_encargado*}|center|-|Generar planilla|{*planilla_mensajero2@idft_destino_radicacion,mensajero_encargado*}|center|-|Tipo de origen|{*mostrar_tipo_origen_reporte@tipo_origen*}|center|-|Fecha de Radicaci&oacute;n|{*fecha_radicacion_entrada*}|center|-|Asunto|{*descripcion*}|left|-|Origen|{*mostrar_origen_reporte@idft_radicacion_entrada*}|center|-|Destino|{*mostrar_destino_reporte@idft_destino_radicacion*}|center|-|Observaciones|{*observacion_destino*}|left|-|Ruta|{*mostrar_ruta_reporte@idft_destino_radicacion*}|left|-|Descripci&oacute;n o Asunto|{*descripcion*}|center|-|Estado|{*estado_item*}|center',
            'estado' => 2,
            'ancho' => 600,
            'cargar' => 1,
            'tablas_adicionales' => 'documento, ft_radicacion_entrada, ft_destino_radicacion',
            'ordenado_por' => '{"sort" : [{"ft_radicacion_entrada.fecha_radicacion_entrada" : {"order" :"asc"}}]}',
            'direccion' => 'DESC',
            'busqueda_avanzada' => 'formatos_cliente/radicacion_entrada/busqueda_reporte_elastic.php?idbusqueda_componente=301',
            'modulo_idmodulo' => $idmodulo
        ];

        $idcmp1 = $this->guardar_componente($componente1);

        $cond1 = [
            "fk_busqueda_componente" => $idcmp1,
            "codigo_where" => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=0 {*condicion_adicional_distribucion*}",
            "etiqueta_condicion" => "condicion_reporte_distribucion_general_sinrecogida"
        ];

        $resp1 = $this->guardar_condicion($cond1);

        $conn->commit();

        //Actualizar los enlaces
        $busqueda_avanzada = "formatos_cliente/radicacion_entrada/busqueda_reporte_elastic.php?idbusqueda_componente=$idcmp1";

        $enlace_modulo = "pantallas/buscador_principal.php?idbusqueda=$idbusq&default_componente=reporte_radicacion_correspondencia_elastic";

        $datos_comp = [
            'busqueda_avanzada' => $busqueda_avanzada,
        ];
        $ident_comp = [
            'idbusqueda_componente' => $idcmp1
        ];
        $resp = $conn->update('busqueda_componente', $datos_comp, $ident_comp);

        $datos_mod = [
            'enlace' => $enlace_modulo
        ];
        $ident_mod = [
            'idmodulo' => $idmodulo
        ];
        $resp = $conn->update('modulo', $datos_mod, $ident_mod);

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
