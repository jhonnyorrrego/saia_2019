<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190917221454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $fields = [
            'anexos_transferencia' => 'fecha',
            'busqueda_filtro_temp' => 'fecha',
            'buzon_entrada' => 'respuesta',
            'buzon_salida' => 'respuesta',
            'calendario_saia' => 'fecha',
            'carrusel' => 'fecha_inicio',
            'carrusel' => 'fecha_fin',
            'categoria_formato' => 'fecha',
            'contenidos_carrusel' => 'fecha_inicio',
            'contenidos_carrusel' => 'fecha_fin',
            'documento' => 'fecha_oficio',
            'documento' => 'fecha_limite',
            'documento_anulacion' => 'fecha_solicitud',
            'documento_anulacion' => 'fecha_anulacion',
            'documento_limite' => 'fecha_limite',
            'documento_ruta_aprob' => 'fecha_vencimiento',
            'documento_verificacion' => 'fecha',
            'entidad_caja' => 'fecha',
            'expediente' => 'fecha_extrema_i',
            'expediente' => 'fecha_extrema_f',
            'funcionario' => 'fecha_fin_inactivo',
            'nota_funcionario' => 'fecha',
            'noticia_index' => 'fecha',
            'rcmail_users' => 'failed_login',
            'reemplazo_equivalencia' => 'fecha_fin_rol',
            'reemplazo_saia' => 'fecha_inicio',
            'reemplazo_saia' => 'fecha_fin',
            'salidas' => 'fecha',
            'salidas' => 'fecha_despacho',
            'vdocumentos_proceso' => 'fecha_limite',
            'wf_flujo' => 'fecha_creacion',
            'wf_flujo' => 'fecha_modificacion'
        ];

        foreach ($fields as $table => $field) {
            if ($schema->hasTable($table)) {

                $table = $schema->getTable($table);
                $Column = $table->getColumn($field);
                $Type = Type::getType('datetime');
                $Column->settype($Type);
            }
        }
    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function preDown(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
