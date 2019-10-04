<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190930205743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $value = <<<WHERE
        a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion in (1,3) AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}
WHERE;

        $this->connection->update(
            'busqueda_condicion',
            [
                'codigo_where' => $value,
            ],
            [
                'fk_busqueda_componente' => '300'
            ]
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
