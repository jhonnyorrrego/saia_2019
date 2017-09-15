-- Doctrine Migration File Generated on 2017-09-15 15:59:16

-- Version 20170915184511
CREATE TABLE distribucion (iddistribucion INT AUTO_INCREMENT NOT NULL, origen INT DEFAULT NULL, tipo_origen INT DEFAULT NULL, ruta_origen INT NOT NULL, mensajero_origen INT DEFAULT 0 NOT NULL, destino INT DEFAULT NULL, tipo_destino INT DEFAULT NULL, ruta_destino INT NOT NULL, mensajero_destino INT DEFAULT 0 NOT NULL, mensajero_empresad INT DEFAULT 0 NOT NULL, documento_iddocumento INT DEFAULT NULL, numero_distribucion VARCHAR(255) DEFAULT NULL, estado_distribucion INT DEFAULT 0, estado_recogida INT DEFAULT NULL, fecha_creacion DATETIME DEFAULT NULL, PRIMARY KEY(iddistribucion)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
INSERT INTO migrations (version) VALUES ('20170915184511');
