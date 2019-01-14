<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181128160534 extends AbstractMigration {

    private $modulo = array(
        array('pertenece_nucleo' => '1','nombre' => 'dashboard','tipo' => '1','imagen' => 'fa fa-home','etiqueta' => 'Dashboard','enlace' => 'views/dashboard/index_dashboard.php?idbusqueda_componente=7','cod_padre' => '-1','orden' => '0'),
        array('pertenece_nucleo' => '1','nombre' => 'agrupador_dashboard','tipo' => 'grouper','imagen' => 'fa fa-dashboard','etiqueta' => 'Dashboard','enlace' => '','cod_padre' => '0','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'etiquetas','tipo' => '1','imagen' => 'fa fa-tag','etiqueta' => 'Etiquetados','enlace' => '','cod_padre' => '1942','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'agrupador_administracion','tipo' => 'grouper','imagen' => 'fa fa-building','etiqueta' => 'Administraci&oacute;n','enlace' => '','cod_padre' => '0','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'gestion_administracion','tipo' => '1','imagen' => 'fa fa-cutlery','etiqueta' => 'Gesti&oacute;n','enlace' => '','cod_padre' => '1944','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'comunicacion','tipo' => '1','imagen' => 'fa fa-bullhorn','etiqueta' => 'Comunicaci&oacute;n','enlace' => '','cod_padre' => '1944','orden' => '3'),
        array('pertenece_nucleo' => '1','nombre' => 'agrupador_configuracion','tipo' => 'grouper','imagen' => 'fa fa-cogs','etiqueta' => 'Configuraci&oacute;n','enlace' => '','cod_padre' => '0','orden' => '3'),
        array('pertenece_nucleo' => '1','nombre' => 'imagen_sistema','tipo' => '1','imagen' => 'fa fa-image','etiqueta' => 'Imagen del sistema','enlace' => '','cod_padre' => '1948','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'reportes_configuracion','tipo' => '1','imagen' => 'fa fa-bar-chart-o','etiqueta' => 'Reportes','enlace' => '','cod_padre' => '1948','orden' => '3'),
        array('pertenece_nucleo' => '1','nombre' => 'novedades_comunicacion','tipo' => '2','imagen' => 'fa fa-newspaper-o','etiqueta' => 'Novedades','enlace' => '','cod_padre' => '1947','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'log_transacciones','tipo' => '2','imagen' => 'fa fa-repeat','etiqueta' => 'Log de transacciones','enlace' => '','cod_padre' => '1950','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'menu_documento','tipo' => '3','imagen' => NULL,'etiqueta' => 'Acciones Documento','enlace' => '','cod_padre' => NULL,'orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'responder','tipo' => '3','imagen' => NULL,'etiqueta' => 'Responder','enlace' => '','cod_padre' => '1980','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'responder_todos','tipo' => '3','imagen' => NULL,'etiqueta' => 'Respoder a todos','enlace' => '','cod_padre' => '1980','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'reenviar','tipo' => '3','imagen' => NULL,'etiqueta' => 'Reenviar','enlace' => '','cod_padre' => '1980','orden' => '1')
    );

    private $modulo_u = array(
        array('pertenece_nucleo' => '1','nombre' => 'configuracion','tipo' => '1','imagen' => 'fa fa-cogs','etiqueta' => 'Configuraci&oacute;n','enlace' => '','cod_padre' => '1948','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'documentos_recibidos','tipo' => '2','imagen' => 'fa fa-inbox','etiqueta' => 'Bandeja de Entrada','enlace' => 'views/buzones/index.php?idbusqueda_componente=7','cod_padre' => '4','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'documentos_enviados','tipo' => '2','imagen' => 'fa fa-paper-plane','etiqueta' => 'Bandeja de Salida','enlace' => 'views/buzones/index.php?idbusqueda_componente=14','cod_padre' => '4','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'gestion','tipo' => '2','imagen' => 'fa fa-folder-open','etiqueta' => 'Expedientes','enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=37"}]','cod_padre' => '4','orden' => '4'),
        array('pertenece_nucleo' => '1','nombre' => 'dias_habiles','tipo' => '1','imagen' => 'fa fa-calendar','etiqueta' => 'Mi Calendario','enlace' => '','cod_padre' => '1942','orden' => '4'),
        array('pertenece_nucleo' => '1','nombre' => 'organizacion','tipo' => '1','imagen' => 'fa fa-building-o','etiqueta' => 'Organizaci&oacute;n','enlace' => '','cod_padre' => '1944','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'reportes_graficos','tipo' => '1','imagen' => 'fa fa-bar-chart-o','etiqueta' => 'Reportes','enlace' => '','cod_padre' => '1942','orden' => '5'),
        array('pertenece_nucleo' => '1','nombre' => 'logo_saia','tipo' => '2','imagen' => 'fa fa-cube','etiqueta' => 'Logo de inicio','enlace' => 'pantallas/logo/adicionar_logo.php','cod_padre' => '1949','orden' => '2'),
        array('pertenece_nucleo' => '1','nombre' => 'temas_saia','tipo' => '2','imagen' => 'fa fa-paint-brush','etiqueta' => 'Temas Saia','enlace' => 'pantallas/buscador_principal.php?idbusqueda=4','cod_padre' => '1949','orden' => '1'),
        array('pertenece_nucleo' => '1','nombre' => 'mis_tareas','tipo' => '1','imagen' => 'fa fa-tasks','etiqueta' => 'Mis Tareas','enlace' => '','cod_padre' => '1942','orden' => '3'),
        array('pertenece_nucleo' => '1','nombre' => 'manuales','tipo' => '2','imagen' => 'fa fa-support','etiqueta' => 'Ayuda','enlace' => 'pantallas/buscador_principal.php?idbusqueda=128','cod_padre' => '0','orden' => '9')
    );

    public function getDescription() {
        return 'Actualizar los modulos para la nueva interfaz';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $conn = $this->connection;
        foreach ($this->modulo as $value) {
            $result = $conn->fetchColumn("select idmodulo from modulo where nombre=:nombre", [
                "nombre" => $value["nombre"]
            ]);

            if(!$result) {
                $conn->insert("modulo", $value);
            }
        }

        foreach ($this->modulo_u as $value) {
            $result = $conn->fetchColumn("select idmodulo from modulo where nombre=:nombre", [
                "nombre" => $value["nombre"]
            ]);

            if($result) {
                $conn->update("modulo", $value, ["idmodulo" => $result]);
            }
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
