<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181030222518 extends AbstractMigration
{
	public function getDescription(): string {
        return 'Modifica en la tabla busqueda y busqueda_componente el valor de la columna campo y/o campos_adicionales';
    }
	public function preUp(Schema $schema): void {
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
    public function up(Schema $schema): void
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'documento_pendiente');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'campos_adicionales' => 'b.fecha_inicial as fecha_iniciall'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }
		$queryBuilder = $conn->createQueryBuilder();
		$queryBuilder->select('idbusqueda')->from('busqueda')->where("nombre=:nombre")->setParameter("nombre", 'reporte_distribucion_general');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'campos' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion'
                ];
                $ident = [
                    'idbusqueda' => $row["idbusqueda"]
                ];
                $resp = $conn->update('busqueda', $data, $ident);
            }
        }

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
