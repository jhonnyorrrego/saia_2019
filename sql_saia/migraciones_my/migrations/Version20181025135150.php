<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181025135150 extends AbstractMigration
{
	public function getDescription() {
        return 'Modifica agrupado_por en busqueda_componente';
    }
	public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            //Type::addType('interval day(2) to second(6)', 'string');

            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'listado_documentos_avanzado');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'agrupado_por' => 'A.iddocumento,a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,
a.fecha_limite'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
