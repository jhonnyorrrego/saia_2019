<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923205803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('pantalla_componente', [
            'opciones' => '{
                "nombre": "datetime",
                "etiqueta": "Fecha y Hora",
                "tipo_dato": "datetime",
                "longitud": null,
                "obligatoriedad": 0,
                "valor": "",
                "acciones": "a,e",
                "ayuda": null,
                "predeterminado": null,
                "banderas": null,
                "etiqueta_html": "fecha",
                "orden": null,
                "mascara": null,
                "adicionales": null,
                "fila_visible": 1,
                "placeholder": ""
            }'
        ], [
            'nombre' => 'datetime'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
