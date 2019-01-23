<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123130329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void {
$this->skipIf(true);

      $table = $schema->getTable('configuracion');
        if($table->hasColumn("valor")) {
            $this->addSql("ALTER TABLE configuracion CHANGE valor valor TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");           
        }
     
        

    }

    public function up(Schema $schema) : void
    {
      
        $table = $schema->getTable('configuracion');
        if ($table->hasColumn("valor")) {
            $this->addSql("UPDATE configuracion SET valor = '{'documento_iddocumento':'documento_iddocumento', 'ft_tabla':'idft_', 'estado_documento':'estado_documento' , 'documento_iddocumento':'documento_iddocumento', 'firma':'firma', 'serie_idserie':'serie_idserie' ,'encabezado':'encabezado','dependencia':'dependencia'}' WHERE nombre = 'campos_solo_lectura'");
        } 

        $componente1 = [
                'nombre' => "qr_formato", // busqueda_idbusqueda = 48
                'valor' => "{'servidor':'local://../almacenamiento/','ruta':'configuracion/qr_formato_saia/qr_formato.png'}",
                'tipo' => "formato"
        ];

        $resp = $this->connection->insert('configuracion', $datos);
        if (empty($resp)) {
            $conn->rollBack();
            print_r($conn->errorInfo());
            die("Fallo la creacion de la configuraion");
        }


    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
