<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190606221215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Actualizacion de etiquetas y ordenes de campos del formato correspondencia';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('campos_formato', [
            'etiqueta' => 'despachado','orden' => '1'
        ], [
            'nombre' => 'despachado',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'ESTADO DEL DOCUMENTO','orden' => '2'
        ], [
            'nombre' => 'estado_documento',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO','orden' => '3'
        ], [
            'nombre' => 'dependencia',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'etiqueta_datos_gener','orden' => '4'
        ], [
            'nombre' => 'etiqueta_datos_gener',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'FECHA DE REGISTRO','orden' => '5'
        ], [
            'nombre' => 'fecha_registro',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'N&Uacute;MERO DE REGISTRO','orden' => '6'
        ], [
            'nombre' => 'numero_registro',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'ORIGEN DEL DOCUMENTO','orden' => '7'
        ], [
            'nombre' => 'tipo_origen',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'etiqueta_origen','orden' => '8'
        ], [
            'nombre' => 'etiqueta_origen',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'PERSONA NATURAL/JUR&Iacute;DICA*','orden' => '9'
        ], [
            'nombre' => 'persona_natural',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Funcionario responsable','orden' => '10'
        ], [
            'nombre' => 'area_responsable',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'DISTRIBUIDO ENTRE SEDES','orden' => '11'
        ], [
            'nombre' => 'distribuid_entre_sedes',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'N&Uacute;MERO DE DOCUMENTO','orden' => '12'
        ], [
            'nombre' => 'numero_oficio',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'FECHA DEL DOCUMENTO','orden' => '13'
        ], [
            'nombre' => 'fecha_documento',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'ASUNTO','orden' => '14',
            'tipo_dato' => 'varchar','longitud' => '255',
            'valor' => '','etiqueta_html' => 'text',
            'estilo' => '{"size":"50"}'

        ], [
            'nombre' => 'descripcion',
            'formato_idformato' => 3
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'ANEXOS FISICOS','orden' => '15'
        ], [
            'nombre' => 'descripcion_anexos',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Descripci&oacute;n general','orden' => '16'
        ], [
            'nombre' => 'descripcion_general',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'FECHA L&Iacute;MITE DE RESPUESTA','orden' => '17'
        ], [
            'nombre' => 'tiempo_respuesta',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Requiere servicio de recogida?','orden' => '18'
        ], [
            'nombre' => 'requiere_recogida',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Requiere servicio de entrega?','orden' => '19'
        ], [
            'nombre' => 'tipo_mensajeria',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'N&Uacute;MERO DE GU&Iacute;A','orden' => '20'
        ], [
            'nombre' => 'numero_guia',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'EMPRESA TRANSPORTADORA','orden' => '21'
        ], [
            'nombre' => 'empresa_transportado',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'etiqueta_destino','orden' => '22'
        ], [
            'nombre' => 'etiqueta_destino',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'DESTINO DEL DOCUMENTO','orden' => '23'
        ], [
            'nombre' => 'tipo_destino',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'DESTINO','orden' => '24'
        ], [
            'nombre' => 'destino',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'COPIA ELECTR&Oacute;NICA A','orden' => '25'
        ], [
            'nombre' => 'copia_a',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'TIPO DOCUMENTAL','orden' => '26'
        ], [
            'nombre' => 'serie_idserie',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Persona natural o jur&iacute;dica*','orden' => '27'
        ], [
            'nombre' => 'persona_natural_dest',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'ENCABEZADO','orden' => '28'
        ], [
            'nombre' => 'encabezado',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'DOCUMENTO ASOCIADO','orden' => '29'
        ], [
            'nombre' => 'documento_iddocumento',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'RADICACION_ENTRADA','orden' => '30'
        ], [
            'nombre' => 'idft_radicacion_entrada',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Estado documento','orden' => '31'
        ], [
            'nombre' => 'estado_radicado',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'FIRMAS DIGITALES','orden' => '32'
        ], [
            'nombre' => 'firma',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Colilla','orden' => '33'
        ], [
            'nombre' => 'colilla',
            'formato_idformato' => 3
        ]);
        $this->connection->update('campos_formato', [
            'etiqueta' => 'Anexos digitales','orden' => '34'
        ], [
            'nombre' => 'anexos_digitales',
            'formato_idformato' => 3
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
