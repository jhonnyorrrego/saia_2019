<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\ColumnDiff;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Schema\TableDiff;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181010123722 extends AbstractMigration {

    public function getDescription() {
        return 'Ajustes campos not null';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $motor = $this->connection->getDatabasePlatform()->getName();
        switch ($motor) {
            case "oracle":
                $this->addSql("ALTER TABLE EVENTO MODIFY (CODIGO_SQL DEFAULT empty_clob() NULL)");
                $this->addSql("ALTER TABLE BUZON_ENTRADA MODIFY (RUTA_IDRUTA NULL)");
                $this->addSql("ALTER TABLE ENTIDAD_EXPEDIENTE MODIFY (ESTADO NUMBER(10) DEFAULT 1 )");
                $this->addSql($this->modificar_vista_exp());
                break;
            case "mysql":
                $this->addSql("ALTER TABLE buzon_entrada MODIFY ruta_idruta INT(11)");
                break;
            case "sqlsrv":
            case "mssql":
                $this->addSql("ALTER TABLE buzon_entrada ALTER COLUMN ruta_idruta INT NULL");
                $this->addSql($this->modificar_sp_radicado_sqlsrv());
                break;
            default:
                $this->abortIf(true, "Motor '$motor', no soportado");
                break;
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function modificar_vista_exp() {
        $motor = $this->connection->getDatabasePlatform()->getName();
        $modificar = "CREATE OR REPLACE ";
        if($motor == "mssql" || $motor == "sqlsrv") {
            $modificar = "alter ";
        }
        $vista = $modificar . " VIEW vexpediente_serie AS 
    select
    a.propietario AS propietario,
    c.nombre AS nombre_serie,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    TO_CHAR(a.descripcion) AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS identidad_exp,
    b.llave_entidad AS llave_exp,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    TO_CHAR(a.notas_transf) AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    0 AS desde_serie
from expediente a
left join entidad_expediente b on a.idexpediente = b.expediente_idexpediente
left join serie c on a.serie_idserie = c.idserie
union select
    a.propietario AS propietario,
    c.nombre AS nombre,
    a.serie_idserie AS serie_idserie,
    a.fecha AS fecha,
    a.nombre AS nombre,
    TO_CHAR(a.descripcion) AS descripcion,
    a.cod_arbol AS cod_arbol,
    a.cod_padre AS cod_padre,
    a.estado_archivo AS estado_archivo,
    a.fk_idcaja AS fk_idcaja,
    a.estado_cierre AS estado_cierre,
    a.idexpediente AS idexpediente,
    b.entidad_identidad AS entidad_identidad,
    b.llave_entidad AS llave_entidad,
    a.prox_estado_archivo AS prox_estado_archivo,
    a.fecha_extrema_i AS fecha_extrema_i,
    a.fecha_extrema_f AS fecha_extrema_f,
    a.no_unidad_conservacion AS no_unidad_conservacion,
    a.no_folios AS no_folios,
    a.no_carpeta AS no_carpeta,
    a.soporte AS soporte,
    TO_CHAR(a.notas_transf) AS notas_transf,
    a.tomo_no AS tomo_no,
    a.agrupador AS agrupador,
    a.indice_uno AS indice_uno,
    a.indice_dos AS indice_dos,
    a.indice_tres AS indice_tres,
    a.codigo_numero AS codigo_numero,
    1
from expediente a
join permiso_serie b on a.serie_idserie = b.serie_idserie
join serie c on b.serie_idserie = c.idserie";
        return $vista;
    }

    private function modificar_sp_radicado_sqlsrv() {
        $sql = <<<FINSQL
ALTER PROCEDURE [dbo].[sp_asignar_radicado]
   @iddoc int,
   @tipo int,
   @funcionario int
AS
   BEGIN
      SET  XACT_ABORT  ON
      SET  NOCOUNT  ON
      DECLARE @valor nvarchar(50)
      DECLARE @sentencia nvarchar(2000)
      DECLARE @valor_int int
      SELECT @valor = CAST(contador.consecutivo AS varchar(50)) FROM dbo.contador WHERE contador.idcontador = @tipo

      UPDATE dbo.documento SET numero = @valor WHERE documento.iddocumento = @iddoc

      UPDATE dbo.contador SET consecutivo = contador.consecutivo + 1 WHERE contador.idcontador = @tipo
      SET @sentencia = concat('UPDATE documento SET numero=', @valor, ' WHERE iddocumento=', @iddoc)
      SET @valor_int = CAST(@valor as int) + 1
      INSERT INTO dbo.evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(@funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'documento', @valor, 0, @sentencia, null)
      SET @sentencia = concat('UPDATE contador SET consecutivo=', @valor_int, ' WHERE idcontador=', @tipo)
      INSERT INTO dbo.evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado, codigo_sql, detalle) VALUES(@funcionario, CURRENT_TIMESTAMP, 'MODIFICAR', 'contador', @valor+1, 0, @sentencia,null)
   END
FINSQL;
        return $sql;
    }
}
