<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316173406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $result = $this->connection->fetchAll('select idmodulo from modulo where nombre=:nombre', [':nombre' => 'menu_documento']);

        if ($result[0]['idmodulo']) {
            $this->connection->delete('modulo', ['cod_padre' => $result[0]['idmodulo']]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'dar_tramite',
                'tipo' => 3,
                'imagen' => 'fa fa-flash',
                'etiqueta' => 'Dar tr&aacute;mite',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 1
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'responder',
                'tipo' => 3,
                'imagen' => 'fa fa-mail-reply',
                'etiqueta' => 'Responder',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 2
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'reenviar',
                'tipo' => 3,
                'imagen' => 'fa fa-share',
                'etiqueta' => 'Reenviar',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 3
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'responder_todos',
                'tipo' => 3,
                'imagen' => 'fa fa-mail-reply-all',
                'etiqueta' => 'Respoder a todos',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 4
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'guardar_expediente',
                'tipo' => 3,
                'imagen' => 'fa fa-folder',
                'etiqueta' => 'Guardar en expediente',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 5
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'crear_tarea',
                'tipo' => 3,
                'imagen' => 'fa fa-calendar',
                'etiqueta' => 'Crear una tarea',
                'enlace' => 'views/tareas/crear.php',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 6
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'asignar_responsable',
                'tipo' => 3,
                'imagen' => 'fa fa-eye',
                'etiqueta' => 'Seguir este documento',
                'enlace' => 'views/documento/seguidores.php',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 7
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'solicitar_aprobacion',
                'tipo' => 3,
                'imagen' => 'fa fa-thumbs-o-up',
                'etiqueta' => 'Solicitar aprobaci&oacute;n',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 8
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'discutir_documento',
                'tipo' => 3,
                'imagen' => 'fa fa-comments-o',
                'etiqueta' => 'Agregar comentario',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 9
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'etiquetar',
                'tipo' => 3,
                'imagen' => 'fa fa-tag',
                'etiqueta' => 'Etiquetar',
                'enlace' => 'views/documento/etiquetar.php',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 10
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'imprimir',
                'tipo' => 3,
                'imagen' => 'fa fa-print',
                'etiqueta' => 'Imprimir en PDF',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 11
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'anexos',
                'tipo' => 3,
                'imagen' => 'fa fa-paperclip',
                'etiqueta' => 'Adjuntar Anexo',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 12
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'vincular_otro_documento',
                'tipo' => 3,
                'imagen' => 'fa fa-chain',
                'etiqueta' => 'Vincular a otro documento',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 13
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'imprimir_radicado',
                'tipo' => 3,
                'imagen' => 'fa fa-qrcode',
                'etiqueta' => 'Imprimir radicado',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 14
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'actualizar_pdf',
                'tipo' => 3,
                'imagen' => 'fa fa-file-pdf-o',
                'etiqueta' => 'Actualizar PDF',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 15
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'crear_nueva_version',
                'tipo' => 3,
                'imagen' => 'fa fa-copy',
                'etiqueta' => 'Crear nueva versi&oacute;n',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 16
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'privacidad',
                'tipo' => 3,
                'imagen' => 'fa fa-lock',
                'etiqueta' => 'Privacidad',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 17
            ]);
            
            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'anular_documento',
                'tipo' => 3,
                'imagen' => 'fa fa-fire',
                'etiqueta' => 'Anular documento',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 18
            ]);

            $this->connection->insert('modulo', [
                'pertenece_nucleo' => 1,
                'nombre' => 'distribuir_fisicamente',
                'tipo' => 3,
                'imagen' => 'fa fa-truck',
                'etiqueta' => 'Distribuir f&iacute;sicamente',
                'enlace' => '',
                'cod_padre' => $result[0]['idmodulo'],
                'orden' => 19
            ]);
            
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
