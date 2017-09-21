<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170921185120 extends AbstractMigration {

	/**
	 *
	 * @param Schema $schema
	 */
	public function up(Schema $schema) {
		date_default_timezone_set("America/Bogota");

		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "La migration solo puede ser ejecutada con seguridad en 'mysql'.");

		$this->platform->registerDoctrineTypeMapping('enum', 'string');

		// $this->addSql('ALTER TABLE person ADD title VARCHAR(255) DEFAULT NULL');
	}

	/**
	 *
	 * @param Schema $schema
	 */
	public function down(Schema $schema) {
		// this down() migration is auto-generated, please modify it to your needs
	}
}
