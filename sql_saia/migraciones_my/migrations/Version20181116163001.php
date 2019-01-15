<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181116163001 extends AbstractMigration
{
	public function getDescription(): string {
        return 'Modifica busqueda_componente del reporte de secciones';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'reporte_secciones');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'campos_adicionales' => 'd.iddependencia, d.codigo, d.nombre, d.fecha_ingreso, d.cod_padre, d.tipo, case d.estado when 1 then "activo" else "inactivo" end as estado, d.codigo_tabla, d.extension, d.ubicacion_dependencia, d.orden'];
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
    public function down(Schema $schema): void
    {
       $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'reporte_secciones');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'd.iddependencia, d.codigo, d.nombre, d.fecha_ingreso, d.cod_padre, d.tipo, case d.estado when 1 then "activo" else "inactivo" end as estado, d.codigo_tabla, d.extension, d.ubicacion_dependencia, d.logo, d.orden'];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }

    }
}
