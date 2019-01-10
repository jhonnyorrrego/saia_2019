<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181019134251 extends AbstractMigration
{
	public function getDescription() {
        return 'Modificaciones en busqueda_componente, info';
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'expediente_admin');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'info' => '<div id="resultado_pantalla_{*idexpediente*}" class="well">{*enlaces_adicionales_expediente@idexpediente,nombre*}{*enlace_expediente@idexpediente,nombre*}<br/><div class="descripcion_documento">{*descripcion*}</div></div>'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }

    }
	
	public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
	
	public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'expediente_admin');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'info' => '<div id="resultado_pantalla_{*idexpediente*}" class="well"><div class="btn btn-mini enlace_expediente pull-right" idregistro="{*idexpediente*}" title="{*nombre*}"><i class="icon-info-sign"></i></div>{*enlaces_adicionales_expediente@idexpediente,nombre*}<div class="btn btn-mini enlace_expediente tooltip_saia pull-right" idregistro="{*idexpediente*}" title="Asignar {*nombre*}" enlace="pantallas/expediente/asignar_expediente.php?idexpediente={*idexpediente*}"><i class="icon-lock"></i></div>{*mostrar_contador_expediente@idexpediente,cod_arbol*}<i class=" icon-folder-open pull-left"></i>{*enlace_expediente@idexpediente,nombre*}<br/><div class="descripcion_documento">{*descripcion*}</div></div>'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }

    }
}
