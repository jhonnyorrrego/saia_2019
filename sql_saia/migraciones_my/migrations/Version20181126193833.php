<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Connection;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181126193833 extends AbstractMigration {

    private $eliminar = array(
        "acciones_tarea_bpmni",
        "arbol_checkbox",
        "date",
        "textarea_tiny"
    );

    private $cambios = [
        "arbol_fancytree" => [
            "categoria" => "&Aacute;rbol de Selecci&oacute;n",
            "etiqueta" => "&Aacute;rbol de Selecci&oacute;n",
            "estado" => 1,
            "clase" => "fa fa-sitemap"
        ],
        "datetime" => [
            "categoria" => "Fecha y Hora",
            "etiqueta" => "Fecha y Hora",
            "estado" => 1,
            "clase" => "fa fa-calendar"
        ],
        "ejecutor" => [
            "categoria" => "Terceros",
            "etiqueta" => "Terceros",
            "estado" => 1,
            "clase" => "fa fa-users"
        ],
        "checkbox" => [
            "categoria" => "Selectores",
            "etiqueta" => "Selecci&oacute;n m&uacute;ltiple",
            "estado" => 1,
            "clase" => "fa fa-check-square-o"
        ],
        "radio" => [
            "categoria" => "Selectores",
            "etiqueta" => "Selecci&oacute;n &uacute;nica",
            "estado" => 1,
            "clase" => "fa fa-check-circle-o"
        ],
        "select" => [
            "categoria" => "Selectores",
            "etiqueta" => "Lista desplegable",
            "estado" => 1,
            "clase" => "fa fa-caret-square-o-down"
        ],
        "etiqueta" => [
            "categoria" => "Texto",
            "etiqueta" => "T&iacute;tulo de secci&oacute;n",
            "estado" => 1,
            "clase" => "fa fa-header"
        ],
        "hidden" => [
            "categoria" => "Texto",
            "etiqueta" => "Campo oculto (Hidden)",
            "estado" => 1,
            "clase" => "fa fa-eye-slash"
        ],
        "text" => [
            "categoria" => "Texto",
            "etiqueta" => "Texto en una l&iacute;nea",
            "estado" => 1,
            "clase" => "fa fa-minus"
        ],
        "textarea" => [
            "categoria" => "Texto",
            "etiqueta" => "Texto en varias l&iacute;neas",
            "estado" => 1,
            "clase" => "fa fa-bars"
        ],
        "textarea_cke" => [
            "categoria" => "Texto",
            "etiqueta" => "Texto con formato",
            "estado" => 1,
            "clase" => "fa fa-newspaper-o"
        ],
        "archivo" => [
            "categoria" => "Adjuntos",
            "etiqueta" => "Adjuntos",
            "estado" => 1,
            "clase" => "fa fa-paperclip"
        ],
        "contador" => [
            "categoria" => "Texto",
            "etiqueta" => "Campo num&eacute;rico",
            "estado" => 1,
            "clase" => "fa fa-calculator"
        ]
    ];

    public function getDescription(): string {
        return 'Modifica pantalla_componente para cambiar etiquetas y ocultar opciones';
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
        $types = [
            Connection::PARAM_STR_ARRAY
        ];

        $conn = $this->connection;
        $sql = "update pantalla_componente set estado=0 where nombre IN (?)";
        $filtro = [
            $this->eliminar
        ];
        $result = $conn->executeUpdate($sql, $filtro, $types);

        $sql = "select idpantalla_componente, nombre, opciones from pantalla_componente where nombre IN (?)";
        $filtro = [
            array_keys($this->cambios)
        ];
        $stmt = $conn->executeQuery($sql, $filtro, $types);
        $result = $stmt->fetchAll();

        if (!empty($result)) {
            foreach ($result as $row) {
                $ident = [
                    'idpantalla_componente' => $row["idpantalla_componente"]
                ];
                $datos = $this->cambios[$row["nombre"]];

                $opciones = json_decode($row["opciones"], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $opciones["etiqueta"] = $datos["etiqueta"];
                    $datos["opciones"] = json_encode($opciones);
                }

                $resp = $conn->update('pantalla_componente', $datos, $ident);
            }
        }

    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        $types = [
            Connection::PARAM_STR_ARRAY
        ];

        $conn = $this->connection;
        $sql = "update pantalla_componente set estado=1 where nombre IN (?)";
        $filtro = [
            $this->eliminar
        ];
        $stmt = $conn->executeUpdate($sql, $filtro, $types);

    }
}
