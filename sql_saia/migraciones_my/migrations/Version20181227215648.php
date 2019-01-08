<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181227215648 extends AbstractMigration {

    private $modulo =
        array('pertenece_nucleo' => '0','nombre' => 'borradores','tipo' => '2','imagen' => 'fa fa-eraser','etiqueta' => 'Borradores','enlace' => 'pantallas/buscador_principal.php?idbusqueda=25&default=borradores','cod_padre' => '4','orden' => '3');

    private $busqueda =
        array('nombre' => 'borradores','etiqueta' => 'Borradores','estado' => '1','ancho' => '200','campos' => 'a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,a.fecha_limite','llave' => 'a.iddocumento','tablas' => 'documento a','ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_flujo.php,pantallas/documento/librerias_transferencias.php,pantallas/documento/librerias_borradores.php','ruta_libreria_pantalla' => 'pantallas/documento/adicionales_js.php','cantidad_registros' => '20','tiempo_refrescar' => '500','ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php','tipo_busqueda' => '2','badge_cantidades' => NULL,'elastic' => '0');

    private $busqueda_componente =
        array('busqueda_idbusqueda' => '25','tipo' => '3','conector' => '2','url' => 'views/buzones/listado.php','etiqueta' => 'Borradores','nombre' => 'borradores','orden' => '1','info' => 'Documento|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|Nombre del formato|{*nombre_plantilla@plantilla,iddocumento*}|center|-|Tipo documental|{*serie_documento@serie*}|center|-|Fecha de creaci&oacute;n|{*fecha*}|center|-|Descripci&oacute;n|{*obtener_descripcion@descripcion*}|center','exportar' => 'Radicado,{*numero*}|-|Asunto,{*descripcion*}|-|Formato,plantilla|-|Fecha,{*fecha*}|-|Usuario ejecutor,{*origen_documento@iddocumento,numero,ejecutor,tipo_radicado,estado,serie,tipo_ejecutor*}','exportar_encabezado' => NULL,'encabezado_componente' => 'views/buzones/encabezado_recibidos.php','estado' => '2','ancho' => '320','cargar' => '2','campos_adicionales' => NULL,'tablas_adicionales' => 'formato C','ordenado_por' => 'a.fecha','direccion' => 'desc','agrupado_por' => NULL,'busqueda_avanzada' => NULL,'acciones_seleccionados' => NULL,'modulo_idmodulo' => NULL,'menu_busqueda_superior' => NULL,'enlace_adicionar' => NULL,'encabezado_grillas' => NULL,'llave' => 'a.iddocumento');

    public function getDescription() {
        return 'Actualizar buzon de borradores';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $conn = $this->connection;

        $conn->beginTransaction();

        $idmodulo = $this->guardar("modulo", $this->modulo);

        $idbusq = $this->guardar("busqueda", $this->busqueda);
        $this->busqueda_componente['busqueda_idbusqueda'] = $idbusq;

        $idcomp = $this->guardar("busqueda_componente", $this->busqueda_componente);

        $conn->commit();
    }

    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function guardar($tabla, $datos, $campo_nombre = "nombre", $idname = null) {
        $conn = $this->connection;

        if(empty($idname)) {
            $idname = "id$tabla";
        }
        $idreg = $conn->fetchColumn("select $idname from $tabla where $campo_nombre = :nombre", [
            'nombre' => $datos[$campo_nombre]
        ]);

        if (!empty($idreg)) {
            $cond = [$idname => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->update($tabla, $datos, $cond);
        } else {
            $resp = $conn->insert($tabla, $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion del $tabla");
            }
            $idreg = $conn->lastInsertId();
        }
        return $idreg;
    }
}
