<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170921185120 extends AbstractMigration {

	public function preUp($schema) {
		date_default_timezone_set("America/Bogota");

		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "La migration solo puede ser ejecutada con seguridad en 'mysql'.");

		$this->platform->registerDoctrineTypeMapping('enum', 'string');

		$table = $schema->getTable('busqueda_componente');
		if (!$table->hasIndex("ui_busqueda_componente_nombre")) {
			$this->addSql("DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 106");
			$this->addSql("DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 161");
			$this->addSql("DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 151");
			$this->addSql("DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 152");
			$this->addSql("DELETE FROM busqueda WHERE busqueda.idbusqueda = 18");
			$this->addSql("DELETE FROM busqueda WHERE busqueda.idbusqueda = 45");
			$this->addSql("DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 139");
			$this->addSql("DELETE FROM busqueda_componente WHERE busqueda_componente.idbusqueda_componente = 184");
			$this->addSql("UPDATE busqueda_componente SET nombre = 'listado_documentos_avanzado' WHERE busqueda_componente.idbusqueda_componente = 33");
			$this->addSql("UPDATE busqueda_componente SET nombre = 'listado_documentos_activar' WHERE busqueda_componente.idbusqueda_componente = 92");
			$this->addSql("UPDATE busqueda_componente SET nombre = 'pendiente_ingresar' WHERE busqueda_componente.idbusqueda_componente = 280");
		}

	}

	/**
	 *
	 * @param Schema $schema
	 */
	public function up(Schema $schema) {
		date_default_timezone_set("America/Bogota");

		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "La migration solo puede ser ejecutada con seguridad en 'mysql'.");

		$this->platform->registerDoctrineTypeMapping('enum', 'string');

		$table = $schema->getTable('busqueda');
		if (!$table->hasIndex("ui_busqueda_nombre")) {
			$table->addUniqueIndex([
					'nombre'
			], 'ui_busqueda_nombre');

			// $this->addSql('ALTER TABLE person ADD title VARCHAR(255) DEFAULT NULL');
		}

		$table = $schema->getTable('busqueda_componente');
		if (!$table->hasIndex("ui_busqueda_componente_nombre")) {
			$table->addUniqueIndex([
					'nombre'
			], 'ui_busqueda_componente_nombre');
		}

		$table = $schema->getTable('modulo');

		if (!$table->hasIndex("ui_modulo_nombre")) {
			$this->addSql("DELETE FROM modulo WHERE modulo.idmodulo = 1140");
		}

		$table = $schema->getTable('busqueda_grafico');
		if(!$table->hasColumn("nombre")) {
			$this->connection->exec("ALTER TABLE busqueda_grafico ADD nombre VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
		}

		$table = $schema->getTable('campos_formato');
		if(!$table->hasIndex("ix_campos_formato_formato")) {
			$table->addUniqueIndex([
					'formato_idformato', 'nombre'
			], 'ix_campos_formato_formato');
		}

		if($schema->hasTable("caracteristica")) {
			$this->addSql("DROP TABLE caracteristica");
		}
		if($schema->hasTable("correo_usuario")) {
			$this->addSql("DROP TABLE correo_usuario");
		}
		if($schema->hasTable("dependencia2")) {
				$this->addSql("DROP TABLE dependencia2");
		}

		$table = $schema->getTable('contador');
		if(!$table->hasIndex("ui_contador_nombre")) {
			$this->addSql("DELETE FROM contador WHERE contador.idcontador = 5");
		}

		$result = $this->connection->fetchAssoc("SHOW PROCEDURE STATUS like '%" . $schema->getName() . ".sp_asignar_radicado'");
		if($result) {
			$this->addSql("DROP PROCEDURE " . $schema->getName() . ".sp_asignar_radicado");
		}
	}

	public function postUp($schema) {
		$table = $schema->getTable('modulo');
		if (!$table->hasIndex("ui_modulo_nombre")) {
			$table->addUniqueIndex([
					'nombre'
			], 'ui_modulo_nombre');
		}

		if(!$table->hasIndex("ui_contador_nombre")) {
			$table->addUniqueIndex([
					'nombre'
			], 'ui_contador_nombre');
		}

		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(trim(etiqueta), ' ', '_'))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '__', '_'))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '\'', ''))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_de_', '_'))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_y_', '_'))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_en_', '_'))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_el_', '_'))");
		$this->addSql("UPDATE busqueda_grafico SET nombre=LOWER(REPLACE(nombre, '_la_', '_'))");

		$table = $schema->getTable('busqueda_grafico');
		$table->addUniqueIndex([
				'nombre'
		], 'ui_busqueda_grafico_nombre');

		$this->addSql("ALTER TABLE busqueda_grafico CHANGE nombre nombre VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");

		$this->connection->exec("CREATE PROCEDURE sp_asignar_radicado(IN iddoc INT, IN tipo INT, IN funcionario INT)
			BEGIN
			DECLARE valor VARCHAR(50);
			DECLARE sentencia VARCHAR(2000);
			SELECT consecutivo INTO valor FROM contador WHERE idcontador=tipo;
			UPDATE documento SET numero=valor WHERE iddocumento=iddoc;
			UPDATE contador SET consecutivo=consecutivo+1 WHERE idcontador=tipo;
			set sentencia = concat('UPDATE documento SET numero=', valor, ' WHERE iddocumento=',iddoc);
			INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'documento', valor, 0,sentencia,'No puede ir null');
			set sentencia = concat('UPDATE contador SET consecutivo=', valor+1, ' WHERE idcontador=',tipo);
			INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'contador', valor+1, 0,sentencia,'No puede ir null');
			END");
	}

	/**
	 *
	 * @param Schema $schema
	 */
	public function down(Schema $schema) {
		// this down() migration is auto-generated, please modify it to your needs
	}

}
