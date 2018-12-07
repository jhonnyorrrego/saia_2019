<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Connection;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181205135510 extends AbstractMigration {

    private $datos_modulo = [
        'responder' => [
            'pertenece_nucleo' => 1,
            'nombre' => 'responder',
            'etiqueta' => 'Responder'
        ],
        'responder_todos' => [
            'pertenece_nucleo' => 1,
            'nombre' => 'responder_todos',
            'etiqueta' => 'Respoder a todos'
        ],
        'reenviar' => [
            'pertenece_nucleo' => 1,
            'nombre' => 'reenviar',
            'etiqueta' => 'Reenviar'
        ],
        'mover_expediente' => [
            'pertenece_nucleo' => 1,
            'nombre' => 'mover_expediente',
            'etiqueta' => 'Mover a expediente'
        ],

        'asignar_serie' => [
            'pertenece_nucleo' => 1,
            'nombre' => 'asignar_serie',
            'etiqueta' => 'Asignar tipo documental'
        ]
    ];

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
        $modulo = $schema->getTable('modulo');

        if ($modulo->hasColumn("enlace_mobil")) {
            $modulo->dropColumn("enlace_mobil");
        }

        if ($modulo->hasColumn("destino")) {
            $modulo->dropColumn("destino");
        }

        if ($modulo->hasColumn("ayuda")) {
            $modulo->dropColumn("ayuda");
        }

        if ($modulo->hasColumn("parametros")) {
            $modulo->dropColumn("parametros");
        }

        if ($modulo->hasColumn("busqueda_idbusqueda")) {
            $modulo->dropColumn("busqueda_idbusqueda");
        }

        if ($modulo->hasColumn("permiso_admin")) {
            $modulo->dropColumn("permiso_admin");
        }

        if ($modulo->hasColumn("busqueda")) {
            $modulo->dropColumn("busqueda");
        }

        if ($modulo->hasColumn("enlace_pantalla")) {
            $modulo->dropColumn("enlace_pantalla");
        }

        $modulo->getColumn("tipo")->setDefault(3);
        $modulo->getColumn("imagen")->setDefault(NULL);
        $modulo->getColumn("enlace")->setDefault(NULL);

        $this->connection->delete('modulo', [
            'nombre' => 'menu_documento'
        ]);
        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'nombre' => 'menu_documento',
            'etiqueta' => 'Acciones Documento'
        ]);

        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('idmodulo')
            ->from('modulo')
            ->where("nombre=:nombre")
            ->setParameter("nombre", 'menu_documento');

        $moduleId = $queryBuilder->execute()->fetchColumn();

        $types = [
            \PDO::PARAM_INT,
            Connection::PARAM_STR_ARRAY
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

        foreach ($this->datos_modulo as $key => $value) {
            $result = $this->connection->fetchColumn("select idmodulo from modulo where nombre=:nombre", [
                "nombre" => $key
            ]);
            $value['cod_padre'] = $moduleId;

            if (!$result) {
                $this->connection->insert("modulo", $value);
            } else {
                $this->connection->update("modulo", $value, [
                    "idmodulo" => $result
                ]);
            }
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
