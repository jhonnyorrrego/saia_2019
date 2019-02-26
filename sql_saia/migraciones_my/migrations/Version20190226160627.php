<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226160627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Eliminacion de ventanillas y creacion de ventanilla por defecto. Actualizacion columna ventanilla en reportes de distribucion';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("truncate table cf_ventanilla");

        $this->addSql("INSERT INTO `cf_ventanilla` (`idcf_ventanilla`, `nombre`, `valor`, `cod_padre`, `descripcion`, `tipo`, `categoria`, `estado`) VALUES
(1, 'Sin Ventanilla', NULL, NULL, NULL, NULL, NULL, 1)");

        $this->addSql("ALTER TABLE `funcionario` CHANGE `ventanilla_radicacion` `ventanilla_radicacion` INT(11) NOT NULL DEFAULT '1'");
        $conn = $this->connection;
        //Busqueda
        $this->connection->update('busqueda', ['campos' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla','tablas' => 'distribucion a, documento b,funcionario c, cf_ventanilla d'], ["nombre" => "reporte_distribucion_general"]);

        //busqueda_componente
        $this->connection->update('busqueda_componente', ['info' => 'No. Registro|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|Fecha de registro|{*fecha*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'], ["idbusqueda_componente" => "300"]);
        $this->connection->update('busqueda_componente', ['info' => 'No. Registro|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|Fecha de registro|{*fecha*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|center|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'], ["idbusqueda_componente" => "301"]);
        $this->connection->update('busqueda_componente', ['info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'], ["idbusqueda_componente" => "302"]);
        $this->connection->update('busqueda_componente', ['info' => 'Radicado|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|center|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|center|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|center|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'], ["idbusqueda_componente" => "303"]);

        //busqueda_condicion
        $this->connection->update('busqueda_condicion', ['codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=1 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_distribucion*}'], ["fk_busqueda_componente" => "300"]);
        $this->connection->update('busqueda_condicion', ['codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=2 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_distribucion*}'], ["fk_busqueda_componente" => "301"]);
        $this->connection->update('busqueda_condicion', ['codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=3 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_distribucion*}'], ["fk_busqueda_componente" => "302"]);
        $this->connection->update('busqueda_condicion', ['codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=0 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_distribucion*}'], ["fk_busqueda_componente" => "303"]);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
