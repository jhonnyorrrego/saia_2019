<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190227220453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

    }

    public function up(Schema $schema) : void
    {
        $busqueda = $schema->getTable('busqueda');
        $busqueda->dropColumn('ancho');
        $busqueda->dropColumn('elastic');
        $busqueda->dropColumn('tiempo_refrescar');
        $busqueda->dropColumn('badge_cantidades');

        $this->connection->delete('busqueda', [
            'nombre' => 'funcionario'
        ]);

        $this->connection->insert('busqueda', [
            'nombre' => 'funcionario',
            'etiqueta' => 'funcionarios',
            'estado' => 1,
            'tablas' => 'funcionario',
            'ruta_libreria' => 'app/funcionario/librerias.php',
            'tipo_busqueda' => 2
        ]);

        $busqueda = $this->connection->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
            'nombre' => 'funcionario'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'funcionario'
        ]);

        $this->connection->insert('busqueda_componente', [
            'busqueda_idbusqueda' => $busqueda[0]['idbusqueda'],
            'tipo' => 3,
            'conector' => 2,
            'url' => 'pantallas/busquedas/consulta_busqueda_tabla.php',
            'etiqueta' => 'Funcionarios',
            'nombre' => 'funcionario',
            'orden' => 1,
            'info' => 'Nombre|{*get_name@idfuncionario,nombres,apellidos*}|center|-|Identificacion|{*nit*}|center|-|Login|{*login*}|center|-|Perfil|{*get_profile@perfil*}|center|-|Estado|{*get_state@estado*}|center',
            'estado' => 1,
            'campos_adicionales' => 'idfuncionario,nombres,apellidos,login,nit,perfil,estado',
            'ordenado_por' => 'nombres',
            'direccion' => 'asc',
            'busqueda_avanzada' => 'views/funcionario/busqueda_avanzada.php',
            'enlace_adicionar' => 'views/funcionario/adicionar.php',
            'llave' => 'idfuncionario'
        ]);

        $result = $this->connection->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
            'nombre' => 'funcionario'
        ]);
        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'Funcionario'
        ]);
        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'funcionario'
        ]);
        $this->connection->insert('busqueda_condicion', [
            'fk_busqueda_componente' => $result[0]['idbusqueda_componente'],
            'codigo_where' => '{*user_condition*}',
            'etiqueta_condicion' => 'funcionario'
        ]);

        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{\"kConnector\": \"html.page\",\"url\": \"pantallas/busquedas/componentes_busqueda.php?idbusqueda='.$busqueda[0]['idbusqueda'].'\"}]'
        ], [
            'nombre' => 'funcionario'
        ]);

        $this->addSql("delete from funcionario where login is null or login=''");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
