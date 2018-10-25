<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181024155507 extends AbstractMigration
{
	public function getDescription() {
        return 'Cambio en campos de expedientes,documento y creacion tabla vista_formato';
    }
	public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
        if ($this->connection->getDatabasePlatform()->getName() == "oracle") {
            //Type::addType('interval day(2) to second(6)', 'string');

            $this->platform->registerDoctrineTypeMapping('interval day(2) to second(6)', "string");
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
         $tabla = $schema->getTable('expediente');

        if ($tabla->hasColumn('indice_uno')) {
            $opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('indice_uno', $opciones);
        }
		
		$tabla = $schema->getTable('expediente');

        if ($tabla->hasColumn('indice_dos')) {
            $opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('indice_dos', $opciones);
        }
		
		$tabla = $schema->getTable('expediente');

        if ($tabla->hasColumn('indice_tres')) {
            $opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('indice_tres', $opciones);
        }
        
		$tabla = $schema->getTable('documento');

        if ($tabla->hasColumn('descripcion')) {
            $opciones = [
                "length" => 4000,
                "type" => Type::getType(Type::STRING)
            ];
            $tabla->changeColumn('descripcion', $opciones);
        }
		
		$tabla = $schema->getTable('ft_carta');

        if ($tabla->hasColumn('version_carta')) {
        	$opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('version_carta', $opciones);
        }
		
		$tabla = $schema->getTable('buzon_entrada');

        if ($tabla->hasColumn('ruta_idruta')) {
        	$opciones = [
                "notnull" => false
            ];
            $tabla->changeColumn('ruta_idruta', $opciones);
        }
		
		$conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'expediente_documento');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'agrupado_por' => 'a.idexpediente,a.fecha,a.nombre,a.descripcion,a.cod_arbol,a.estado_cierre,a.nombre_serie,a.propietario,agrupador,B.iddocumento,B.fecha, B.numero,B.descripcion,B.estado,B.serie,B.tipo_radicado,B.plantilla,B.fecha_limiteexpediente_documento'
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }
		
		if (!$schema->hasTable("vista_formato")) {
			$table3 = $schema->createTable("vista_formato" );
            $table3->addColumn("idvista_formato", "integer", [
                "length" => 11,
                "notnull" => true,
                'autoincrement' => true
            ]);
            
			$table3->addColumn("nombre", "string", ["length" => 255] );
			$table3->addColumn("etiqueta", "string", ["length" => 255] );
			$table3->addColumn("formato_padre", "number", ["length" => 11, "default" => 0]);
			$table3->addColumn("ruta_mostrar", "string", ["length" => 255]);
			$table3->addColumn("librerias", "string", ["length" => 255]);
			$table3->addColumn("estilos", "string", ["length" => 255]);
			$table3->addColumn("javascript", "string", ["length" => 255]);
			$table3->addColumn("encabezado", "text", ["default"=> "empty_clob()"]);
			$table3->addColumn("cuerpo", "text", ["default"=> "empty_clob()"]);
			$table3->addColumn("pie_pagina", "text", ["default"=> "empty_clob()"]);
			$table3->addColumn("margenes", "string", ["length" => 50, "default" => '30,30,30,30']);
			$table3->addColumn("orientacion", "string", ["length" => 50]);
			$table3->addColumn("papel", "string", ["length" => 50, "default" => 'letter']);
			$table3->addColumn("exportar", "string", ["length" => 255, "default" => 'pdf']);
			$table3->addColumn("funcionario_idfuncionario", "number", ["length" => 11, "default" => 0]);
			$table3->addColumn("fecha", "date", ["default"=> "CURRENT_TIMESTAMP"]);
			$table3->addColumn("imagen", "string", ["length" => 255]);
			$table3->addColumn("ayuda", "string", ["length" => 400]);
			$table3->addColumn("font_size", "string", ["length" => 4, "default" => '12']);
			$table3->addColumn(
			"banderas", "string", ["length" => 255, "default" => 'nd']);
			
			$table3->setPrimaryKey(["idvista_formato" ]);
		}
	}
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        

    }
}
