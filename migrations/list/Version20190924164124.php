<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190924164124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('pantalla_componente', [
            'opciones' => '{"nombre":"hidden","etiqueta":"Campo oculto (Hidden)","tipo_dato":"string","longitud":"255","valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"hidden","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"Campo hidden"}'
        ], [
            'nombre' => 'hidden'
        ]);

        $this->connection->update('pantalla_componente', [
            'opciones_propias' => '{
                "schema": {
                "title": "",
                "description": "Editar propiedades",
                "type": "object",
                "properties": {
                    "fs_etiqueta": {
                    "type": "string",
                    "title": "Etiqueta del campo",                      
                    "maxLength": 255,                      
                    "required": true
                    }
                    }
                },
                    "options": {
                
                        "fields": {
                                    "fs_etiqueta": {
                                      "fields": {  
                                  }
                
                        }
                    }
                    }
                }'
        ], [
            'nombre' => 'hidden'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
