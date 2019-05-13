<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190506140623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Cambios reporte de distirbución';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda_componente', [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|left|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'
        ], [
            'nombre' => 'reporte_distribucion_general_sinrecogida'
        ]);
        $this->connection->update('busqueda_componente', [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'
        ], [
            'nombre' => 'reporte_distribucion_general_finalizado'
        ]);
        $this->connection->update('busqueda_componente', [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|Fecha de registro|{*fecha*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|left|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|left|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'
        ], [
            'nombre' => 'reporte_distribucion_general_endistribucion'
        ]);
        $this->connection->update('busqueda_componente', [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|Fecha de registro|{*fecha*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|left|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|left|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left'
        ], [
            'nombre' => 'reporte_distribucion_general_pordistribuir'
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
