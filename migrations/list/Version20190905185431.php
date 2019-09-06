<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905185431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('update funciones_nucleo set ruta = REPLACE(ruta,"../../", "")');
        $this->connection->delete('configuracion', [
            'nombre' => 'campos_solo_lectura'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
