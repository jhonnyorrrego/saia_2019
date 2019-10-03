<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191002151042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', ['etiqueta' =>   'Áreas (Dependencias)',], [
            'nombre' => 'dependencia'
        ]);
        $this->connection->update('modulo', ['etiqueta' =>   'Manual Elaboración de Cartas',], [
            'nombre' => 'manual_carta'
        ]);
        $this->connection->update('modulo', ['etiqueta' =>   'Manual para configurar página',], [
            'nombre' => 'configuracion_de_pagina'
        ]);
        $this->connection->update('modulo', ['etiqueta' =>   'Manual de Búsquedas',], [
            'nombre' => 'manual_busquedas'
        ]);
        $this->connection->update('modulo', ['etiqueta' =>   'Manual Menú Detalles',], [
            'nombre' => 'manual_menu_detalles'
        ]);
        $this->connection->update('modulo', ['etiqueta' => 'RADICACIÓN FACTURAS DE OBRA',], [
            'nombre' => 'crear_facturas_obras',
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
