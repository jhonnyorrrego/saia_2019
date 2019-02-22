<?php
declare(strict_types = 1);
namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190222191758 extends AbstractMigration {


    private $formatos = ["factura_electronica" => [
            "nombre" => "factura_electronica",
            "etiqueta" => "Factura electr&oacute;nica",
            "cod_padre" => 0,
            "contador_idcontador" => 4,
            "nombre_tabla" => "ft_factura_electronica",
            "ruta_mostrar" => "mostrar_factura_electronica.php",
            "ruta_editar" => "editar_factura_electronica.php",
            "ruta_adicionar" => "adicionar_factura_electronica.php",
            "librerias" => null,
            "estilos" => null,
            "javascript" => null,
            "encabezado" => "0",
            "cuerpo" => "<p><strong>Factura No.<\/strong>: {*num_factura*}<br \/><strong>NIT<\/strong>: {*nit_proveedor*}<br \/><strong>Proveedor<\/strong>: {*nombre_proveedor*}<br \/><strong>Direcci&oacute;n<\/strong>: {*direccion_proveedor*} {*ciudad_proveedor*} {*estado_proveedor*} {*pais_proveedor*}<br \/><strong>Total<\/strong>: {*total_factura*}<\/p>",
            "pie_pagina" => "",
            "margenes" => "15,20,15,30",
            "orientacion" => "0",
            "papel" => "A4",
            "exportar" => "mpdf",
            "funcionario_idfuncionario" => 1,
            "fecha" => "2019-01-10T18=>49=>54Z",
            "mostrar" => "1",
            "imagen" => null,
            "detalle" => "0",
            "tipo_edicion" => 1,
            "item" => "0",
            "serie_idserie" => 0,
            "ayuda" => null,
            "font_size" => "11",
            "banderas" => "m",
            "tiempo_autoguardado" => "300000",
            "mostrar_pdf" => 0,
            "orden" => null,
            "enter2tab" => 0,
            "firma_digital" => 0,
            "fk_categoria_formato" => "2,3",
            "flujo_idflujo" => 0,
            "funcion_predeterminada" => "",
            "paginar" => "1",
            "pertenece_nucleo" => 0,
            "permite_imprimir" => 1,
            "firma_crt" => null,
            "pos_firma_crt" => null,
            "logo_firma_crt" => null,
            "pos_logo_firma_crt" => null,
            "descripcion_formato" => null,
            "proceso_pertenece" => 0,
            "version" => 0,
            "documentacion" => null,
            "mostrar_tipodoc_pdf" => 0,
            "publicar" => 0
        ],
        "ite_factur_electronica" => [
            "nombre" => "ite_factur_electronica",
            "etiqueta" => "Item Factura Electr&oacute;nica",
            "cod_padre" => 431,
            "contador_idcontador" => 4,
            "nombre_tabla" => "ft_ite_factur_electronica",
            "ruta_mostrar" => "mostrar_ite_factur_electronica.php",
            "ruta_editar" => "editar_ite_factur_electronica.php",
            "ruta_adicionar" => "adicionar_ite_factur_electronica.php",
            "librerias" => "",
            "estilos" => null,
            "javascript" => null,
            "encabezado" => null,
            "cuerpo" => null,
            "pie_pagina" => null,
            "margenes" => "25,25,25,25",
            "orientacion" => "0",
            "papel" => "Letter",
            "exportar" => "mpdf",
            "funcionario_idfuncionario" => 1,
            "fecha" => "2019-02-20T21=>36=>07Z",
            "mostrar" => "1",
            "imagen" => null,
            "detalle" => "0",
            "tipo_edicion" => 0,
            "item" => "1",
            "serie_idserie" => 54,
            "ayuda" => null,
            "font_size" => "11",
            "banderas" => "r",
            "tiempo_autoguardado" => "300000",
            "mostrar_pdf" => 0,
            "orden" => null,
            "enter2tab" => 0,
            "firma_digital" => 0,
            "fk_categoria_formato" => "2,3",
            "flujo_idflujo" => 0,
            "funcion_predeterminada" => "",
            "paginar" => "0",
            "pertenece_nucleo" => 0,
            "permite_imprimir" => 1,
            "firma_crt" => null,
            "pos_firma_crt" => null,
            "logo_firma_crt" => null,
            "pos_logo_firma_crt" => null,
            "descripcion_formato" => "Item Factura Electr&oacute;nica",
            "proceso_pertenece" => 0,
            "version" => 1,
            "documentacion" => "5c6dc81af0810",
            "mostrar_tipodoc_pdf" => 0,
            "publicar" => 0
        ]
        ];


    public function getDescription(): string {
        return '';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $conn = $this->connection;

        $idreg = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
            'nombre' => "factura_electronica"
        ]);

        $tablas = [];
        if (!empty($idreg)) {
            $cond = ["idformato" => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->delete("formato", $cond);


            $idreg2 = $conn->fetchColumn("select idformato from formato where nombre = :nombre and cod_padre = :cod_padre", [
                'nombre' => "ite_factur_electronica",
                'cod_padre' => $idreg
            ]);
            if (!empty($idreg)) {
                $cond2 = ["idformato" => $idreg2];
                //$datos["formato_idformato"] = $idformato;
                $resp = $conn->delete("formato", $cond2);
            }
        }

        $sm = $conn->getSchemaManager();
        if($schema->hasTable("ft_factura_electronica")) {
            $sm->dropTable("ft_factura_electronica");
        }
        if($schema->hasTable("ft_ite_factur_electronica")) {
            $sm->dropTable("ft_ite_factur_electronica");
        }
    }

    public function up(Schema $schema): void {
        $idfmt = $this->guardar("formato", $this->formatos["factura_electronica"]);
        if($idfmt) {
            $this->formatos["ite_factur_electronica"]["cod_padre"] = $idfmt;
            $idfmt2 = $this->guardar("formato", $this->formatos["ite_factur_electronica"]);
        }
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function guardar($tabla, $datos, $campo_nombre = "nombre", $idname = null) {
        $conn = $this->connection;

        if (empty($idname)) {
            $idname = "id$tabla";
        }
        $idreg = $conn->fetchColumn("select $idname from $tabla where $campo_nombre = :nombre", [
            'nombre' => $datos[$campo_nombre]
        ]);

        if (!empty($idreg)) {
            $cond = [$idname => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->update($tabla, $datos, $cond);
        } else {
            $resp = $conn->insert($tabla, $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion del $tabla");
            }
            $idreg = $conn->lastInsertId();
        }
        return $idreg;
    }

}
