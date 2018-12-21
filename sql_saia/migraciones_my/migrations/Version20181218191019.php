<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181218191019 extends AbstractMigration {

    private $formato =
        array('nombre' => 'factura_electronica','etiqueta' => 'Factura electr&oacute;nica','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_factura_electronica','ruta_mostrar' => 'mostrar_factura_electronica.php','ruta_editar' => 'editar_factura_electronica.php','ruta_adicionar' => 'adicionar_factura_electronica.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '','cuerpo' => '<p><strong>Factura No.</strong>: {*num_factura*}<br /><strong>NIT</strong>: {*nit_proveedor*}<br /><strong>Proveedor</strong>: {*nombre_proveedor*}<br /><strong>Direcci&oacute;n</strong>: {*direccion_proveedor*} {*ciudad_proveedor*} {*estado_proveedor*} {*pais_proveedor*}<br /><strong>Total</strong>: {*total_factura*}</p>','pie_pagina' => '','margenes' => '15,20,15,30','orientacion' => '0','papel' => 'A4','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2018-12-19 15:14:53','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '1','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'm','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '0','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0');

	private $campos_formato = array(
		array('nombre' => 'anexos','etiqueta' => 'Anexos','tipo_dato' => 'TEXT','longitud' => NULL,'obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'archivo','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'ciudad_proveedor','etiqueta' => 'Ciudad proveedor','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'direccion_proveedor','etiqueta' => 'Direcci&oacute;n proveedor','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'estado_documento','etiqueta' => 'ESTADO DEL DOCUMENTO','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a','ayuda' => '','predeterminado' => '','banderas' => '','etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'estado_proveedor','etiqueta' => 'Departamento proveedor','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'fecha_factura','etiqueta' => 'Fecha factura','tipo_dato' => 'DATETIME','longitud' => NULL,'obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'fecha','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'fk_datos_factura','etiqueta' => 'fk_datos_factura','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'info_proveedor','etiqueta' => 'Informaci&oacute;n adicional del proveedor','tipo_dato' => 'TEXT','longitud' => NULL,'obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'textarea','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'nit_proveedor','etiqueta' => 'NIT Proveedor','tipo_dato' => 'VARCHAR','longitud' => '20','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e,p,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'nombre_proveedor','etiqueta' => 'Nombre proveedor','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'num_factura','etiqueta' => 'N&uacute;mero de factura','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e,p,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'pais_proveedor','etiqueta' => 'Pais proveedor','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'serie_idserie','etiqueta' => 'SERIE DOCUMENTAL','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '../../test/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1','acciones' => 'a,e','ayuda' => 'Factura electr&oacute;nica','predeterminado' => '0','banderas' => 'fk','etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL),
		array('nombre' => 'total_factura','etiqueta' => 'Total factura','tipo_dato' => 'VARCHAR','longitud' => '50','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'text','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL)
	);

	public function getDescription() {
		return 'Crear formato facturas_electronica';
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
        if (!$schema->hasTable("dt_datos_factura")) {
            $table = $schema->createTable("dt_datos_factura");
            $table->addColumn("iddt_datos_factura", "integer", ["length" => 11, 'autoincrement' => true, "notnull" => true]);
            $table->addColumn("fk_datos_correo", "integer", ["length" => 11, "notnull" => true]);
            $table->addColumn("idgrupo", "string", ["length" =>255 , "notnull" => true]);
            $table->addColumn("num_factura", "string", ["length" => 255, "notnull" => true]);
            $table->addColumn("nit_proveedor", "string", ["length" =>15, "notnull" => true]);
            $table->addColumn("fecha_factura", "datetime", ["notnull" => false]);
            $table->addColumn("nombre_proveedor", "string", ["length" =>255, "notnull" => true]);
            $table->addColumn("direccion_proveedor", "string", ["length" =>255, "notnull" => false]);
            $table->addColumn("ciudad_proveedor", "string", ["length" =>255, "notnull" => false]);
            $table->addColumn("estado_proveedor", "string", ["length" =>255 , "notnull" => false]);
            $table->addColumn("pais_proveedor", "string", ["length" =>255, "notnull" => false]);
            $table->addColumn("info_proveedor", "text", ["notnull" => false]);
            $table->addColumn("anexos", "text", ["notnull" => false]);
            $table->addColumn("total_factura", "decimal", ["precision"=>20, "scale"=>5, "notnull" => false]);
            $table->addColumn("iddoc_rad", "integer", ["length" => 11, "notnull" => false]);
            $table->addColumn("numero_rad", "integer", ["length" => 11, "notnull" => false]);
            $table->setPrimaryKey(["iddt_datos_factura"]);
        }
    }

    public function postUp(Schema $schema) {
    	$conn = $this->connection;

    	$idfmt_factura = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
    			'nombre' => "factura_electronica"
    	]);

    	if(empty($idfmt_factura)) {
    		$idfmt_factura = $this->guardar_formato($this->formato);
    	}
    	if(!empty($idfmt_factura)) {
    		$conn->beginTransaction();

    		foreach ($this->campos_formato as $value) {
    			$this->guardar_campo($idfmt_factura, $value);
    		}
    		$conn->commit();
    	}
    }

    public function preDown(Schema $schema) {
    	date_default_timezone_set("America/Bogota");

    	if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
    		$this->platform->registerDoctrineTypeMapping('enum', 'string');
    	}
    }
    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function guardar_formato($datos) {
    	if (empty($datos)) {
    		return false;
    	}

    	$conn = $this->connection;

    	$idbusq = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
    			'nombre' => $datos["nombre"]
    	]);

    	if (!empty($idbusq)) {
    		$cond = ["idformato" => $idbusq];
    		//$datos["formato_idformato"] = $idformato;
    		$resp = $conn->update('formato', $datos, $cond);
    	} else {
    		$resp = $conn->insert('formato', $datos);

    		if (empty($resp)) {
    			$conn->rollBack();
    			print_r($conn->errorInfo());
    			die("Fallo la creacion del campo_formato");
    		}
    		$idbusq = $conn->lastInsertId();
    	}
    	return $idbusq;
    }

    private function guardar_campo($idformato, $datos) {
    	if (empty($datos)) {
    		return false;
    	}

    	$conn = $this->connection;

    	$idbusq = $conn->fetchColumn("select idcampos_formato from campos_formato where nombre = :nombre and formato_idformato = :idformato", [
    			'nombre' => $datos["nombre"],
    			'idformato' => $idformato
    	]);

    	if (!empty($idbusq)) {
    		$cond = ["idcampos_formato" => $idbusq];
    		//$datos["formato_idformato"] = $idformato;
    		$resp = $conn->update('campos_formato', $datos, $cond);
    	} else {
    		$datos["formato_idformato"] = $idformato;
    		$resp = $conn->insert('campos_formato', $datos);

    		if (empty($resp)) {
    			$conn->rollBack();
    			print_r($conn->errorInfo());
    			die("Fallo la creacion del campo_formato");
    		}
    		$idbusq = $conn->lastInsertId();
    	}
    	return $idbusq;
    }
}
