<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181109130233 extends AbstractMigration
{
   public function getDescription() {
        return 'Modificaciones en busqueda_componente, reporte tabla retencion';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'reporte_retencion');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'acciones_seleccionados' => null,
                    'estado'=>0
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }
		
		
		 $tabla=$this->getTable("busqueda_componente");
		 $datos=	 ["busqueda_idbusqueda"=>"98","tipo"=>"2","conector"=>"1","url"=>null,"etiqueta"=>"Tabla de retenci&oacute;","nombre"=>"listado_reporte_retencion",
"orden"=>"3","info"=>"<div title=\"Reporte Retenci\u00f3n\" data-load='{\"kConnector\":\"iframe\",\"url\":\"..\/pantallas\/serie\/busqueda_reporte_series_dependencias.php?idbusqueda_componente=272\",\"kTitle\":\"Retencion\",\"kWidth\":\"320px\"}' class=\"items navigable\">\r\n<div class=\"head\"><\/div>\r\n<div class=\"label\">Tabla de retenci&oacute;n<\/div>\r\n<div class=\"tail\"><\/div>\r\n<\/div>",
"exportar"=>null,"exportar_encabezado"=>null,"encabezado_componente"=>null,"estado"=>"1","ancho"=>"320","cargar"=>"1","campos_adicionales"=>null,"tablas_adicionales"=>null,
"ordenado_por"=>null,"direccion"=>null,"agrupado_por"=>null,"busqueda_avanzada"=>null,"acciones_seleccionados"=>null,"modulo_idmodulo"=>null,"menu_busqueda_superior"=>null,
"enlace_adicionar"=>null,"encabezado_grillas"=>null,"llave"=>""];
		$tabla->insert($datos);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
       $conn = $this->connection;

        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->select('idbusqueda_componente')->from('busqueda_componente')->where("nombre=:nombre")->setParameter("nombre", 'reporte_retencion');

        $result = $queryBuilder->execute()->fetchAll();

        if (!empty($result)) {           
            foreach ($result as $row) {
                $data = [
                    'acciones_seleccionados' => 'colocar_select_dependencias',
                    'estado'=>1
                ];
                $ident = [
                    'idbusqueda_componente' => $row["idbusqueda_componente"]
                ];
                $resp = $conn->update('busqueda_componente', $data, $ident);
            }
        }
    }
}
