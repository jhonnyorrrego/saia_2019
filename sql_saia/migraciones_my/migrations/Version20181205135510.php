<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Connection;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181205135510 extends AbstractMigration
{
    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {        
        $modulo = $schema->getTable('modulo');
        
        if($modulo->hasColumn("enlace_mobil")){
            $this->addSql('alter table modulo drop column enlace_mobil;');
        }
        
        if($modulo->hasColumn("destino")) {
            $this->addSql('alter table modulo drop column destino;');
        }

        if($modulo->hasColumn("ayuda")) {
            $this->addSql('alter table modulo drop column ayuda;');
        }

        if($modulo->hasColumn("parametros")) {
            $this->addSql('alter table modulo drop column parametros;');
        }

        if($modulo->hasColumn("busqueda_idbusqueda")) {
            $this->addSql('alter table modulo drop column busqueda_idbusqueda;');
        }

        if($modulo->hasColumn("permiso_admin")) {
            $this->addSql('alter table modulo drop column permiso_admin;');
        }

        if($modulo->hasColumn("busqueda")) {
            $this->addSql('alter table modulo drop column busqueda;');
        }

        if($modulo->hasColumn("enlace_pantalla")) {
            $this->addSql('alter table modulo drop column enlace_pantalla;');
        }

        $modulo->getColumn("tipo")->setDefault(3);
        $modulo->getColumn("imagen")->setDefault(NULL);
        $modulo->getColumn("enlace")->setDefault(NULL);

        $this->connection->delete('modulo' ,[
            'nombre' => 'menu_documento'
        ]);
        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'nombre' => 'menu_documento',
            'etiqueta' => 'Acciones Documento'
        ]);

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('idmodulo')
            ->from('modulo')
            ->where("nombre=:nombre")
            ->setParameter("nombre", 'menu_documento');

        $result = $queryBuilder
            ->execute()
            ->fetchAll();
        
        $moduleId = $result[0]['idmodulo'];

        $types = [
            \PDO::PARAM_INT,
            Connection::PARAM_STR_ARRAY,
        ];
        $sql = "delete from modulo  where cod_padre=? and nombre IN (?)";
        $filtro = [
            $moduleId,
            [
                'responder',
                'responder_todos',
                'reenviar',
                'mover_expediente',
                'asignar_serie'
            ]
        ];
        $result = $this->connection->executeUpdate($sql, $filtro, $types);

        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'cod_padre' => $moduleId,
            'nombre' => 'responder',
            'etiqueta' => 'Responder'
        ]);

        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'cod_padre' => $moduleId,
            'nombre' => 'responder_todos',
            'etiqueta' => 'Respoder a todos'
        ]);

        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'cod_padre' => $moduleId,
            'nombre' => 'reenviar',
            'etiqueta' => 'Reenviar'
        ]);
        
        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'cod_padre' => $moduleId,
            'nombre' => 'mover_expediente',
            'etiqueta' => 'Mover a expediente'
        ]);
        
        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'cod_padre' => $moduleId,
            'nombre' => 'asignar_serie',
            'etiqueta' => 'Asignar tipo documental'
        ]);
        
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
