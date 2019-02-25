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
            "fecha" => "2019-01-10 18:49:54",
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
            "fecha" => "2019-02-20 21:36:07",
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

    private $campos_factura_electronica = [
            [
                "formato_idformato" => 431,
                "nombre" => "anexos",
                "etiqueta" => "Anexos",
                "tipo_dato" => "VARCHAR",
                "longitud" => "255",
                "obligatoriedad" => 0,
                "valor" => null,
                "acciones" => "a,e,b",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => null,
                "etiqueta_html" => "archivo",
                "orden" => 5,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "dependencia",
                "etiqueta" => "DEPENDENCIA DEL CREADOR DEL DOCUMENTO",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 1,
                "valor" => "[*buscar_dependencia*]",
                "acciones" => "a,e",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => "i,fdc",
                "etiqueta_html" => "hidden",
                "orden" => 1,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "documento_iddocumento",
                "etiqueta" => "DOCUMENTO ASOCIADO",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 1,
                "valor" => null,
                "acciones" => "a,e",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => "i",
                "etiqueta_html" => "hidden",
                "orden" => 0,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "encabezado",
                "etiqueta" => "ENCABEZADO",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 1,
                "valor" => null,
                "acciones" => "a,e",
                "ayuda" => null,
                "predeterminado" => "1",
                "banderas" => null,
                "etiqueta_html" => "hidden",
                "orden" => 0,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "estado_documento",
                "etiqueta" => "ESTADO DEL DOCUMENTO",
                "tipo_dato" => "VARCHAR",
                "longitud" => "255",
                "obligatoriedad" => 0,
                "valor" => null,
                "acciones" => "a",
                "ayuda" => "",
                "predeterminado" => "",
                "banderas" => "",
                "etiqueta_html" => "hidden",
                "orden" => 0,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "fecha_factura",
                "etiqueta" => "Fecha factura",
                "tipo_dato" => "DATETIME",
                "longitud" => null,
                "obligatoriedad" => 0,
                "valor" => null,
                "acciones" => "a,e,b",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => null,
                "etiqueta_html" => "fecha",
                "orden" => 6,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "firma",
                "etiqueta" => "FIRMAS DIGITALES",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 1,
                "valor" => null,
                "acciones" => "a,e",
                "ayuda" => null,
                "predeterminado" => "1",
                "banderas" => "",
                "etiqueta_html" => "hidden",
                "orden" => 0,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "fk_datos_factura",
                "etiqueta" => "fk_datos_factura",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 0,
                "valor" => null,
                "acciones" => "a,e,b",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => null,
                "etiqueta_html" => "hidden",
                "orden" => 7,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "idft_factura_electronica",
                "etiqueta" => "FACTURA_ELECTRONICA",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 1,
                "valor" => null,
                "acciones" => "a,e",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => "ai,pk",
                "etiqueta_html" => "hidden",
                "orden" => 0,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "info_proveedor",
                "etiqueta" => "Informaci&oacute;n adicional del proveedor",
                "tipo_dato" => "TEXT",
                "longitud" => null,
                "obligatoriedad" => 0,
                "valor" => null,
                "acciones" => "a,e,b",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => null,
                "etiqueta_html" => "textarea",
                "orden" => 8,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "num_factura",
                "etiqueta" => "N&uacute;mero de factura",
                "tipo_dato" => "VARCHAR",
                "longitud" => "255",
                "obligatoriedad" => 1,
                "valor" => null,
                "acciones" => "a,e,p,b",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => null,
                "etiqueta_html" => "text",
                "orden" => 3,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "proveedor",
                "etiqueta" => "Proveedor",
                "tipo_dato" => "varchar",
                "longitud" => "255",
                "obligatoriedad" => 1,
                "valor" => "unico@nombre,identificacion@empresa,direccion,telefono,ciudad",
                "acciones" => "a,e,b",
                "ayuda" => "",
                "predeterminado" => "1",
                "banderas" => "",
                "etiqueta_html" => "ejecutor",
                "orden" => 2,
                "mascara" => "",
                "adicionales" => "",
                "autoguardado" => 1,
                "fila_visible" => 1,
                "placeholder" => "",
                "longitud_vis" => null,
                "opciones" => "[\"tipo\":\"unico\",\"adicional\":\"empresa,direccion,telefono,ciudad\"]",
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "serie_idserie",
                "etiqueta" => "SERIE DOCUMENTAL",
                "tipo_dato" => "INT",
                "longitud" => "11",
                "obligatoriedad" => 1,
                "valor" => "..\/..\/test\/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1",
                "acciones" => "a,e",
                "ayuda" => "Factura electr&oacute;nica",
                "predeterminado" => "0",
                "banderas" => "fk",
                "etiqueta_html" => "hidden",
                "orden" => 0,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ],
            [
                "formato_idformato" => 431,
                "nombre" => "total_factura",
                "etiqueta" => "Total factura",
                "tipo_dato" => "VARCHAR",
                "longitud" => "50",
                "obligatoriedad" => 0,
                "valor" => null,
                "acciones" => "a,e,b",
                "ayuda" => null,
                "predeterminado" => null,
                "banderas" => null,
                "etiqueta_html" => "text",
                "orden" => 4,
                "mascara" => null,
                "adicionales" => null,
                "autoguardado" => 0,
                "fila_visible" => 1,
                "placeholder" => null,
                "longitud_vis" => null,
                "opciones" => null,
                "estilo" => null
            ]
    ];

    private $campos_item  = [
        [
            "formato_idformato" => 453,
            "nombre" => "cantidad",
            "etiqueta" => "Cantidad",
            "tipo_dato" => "INT",
            "longitud" => "11",
            "obligatoriedad" => 1,
            "valor" => null,
            "acciones" => "a,e,b",
            "ayuda" => null,
            "predeterminado" => null,
            "banderas" => null,
            "etiqueta_html" => "text",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => null,
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "descripcion",
            "etiqueta" => "Descripci&oacute;n",
            "tipo_dato" => "varchar",
            "longitud" => "255",
            "obligatoriedad" => 1,
            "valor" => "",
            "acciones" => "a,e,b,p",
            "ayuda" => "",
            "predeterminado" => "",
            "banderas" => "",
            "etiqueta_html" => "text",
            "orden" => 2,
            "mascara" => "",
            "adicionales" => "",
            "autoguardado" => 1,
            "fila_visible" => 1,
            "placeholder" => "campo texto",
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => "[\"size\":\"50\"]"
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "documento_iddocumento",
            "etiqueta" => "Documento asociado",
            "tipo_dato" => "int",
            "longitud" => "11",
            "obligatoriedad" => 0,
            "valor" => "",
            "acciones" => "a",
            "ayuda" => "Documento asociado",
            "predeterminado" => "",
            "banderas" => "",
            "etiqueta_html" => "hidden",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 0,
            "placeholder" => "Documento",
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "ft_factura_electronica",
            "etiqueta" => "ite_factur_electronica",
            "tipo_dato" => "INT",
            "longitud" => "11",
            "obligatoriedad" => 1,
            "valor" => "431",
            "acciones" => "a",
            "ayuda" => " Item Factura Electr&oacute;nica(Formato padre)",
            "predeterminado" => null,
            "banderas" => "fk",
            "etiqueta_html" => "detalle",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => "Formato padre",
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "idft_ite_factur_electronica",
            "etiqueta" => "Identificador de formato",
            "tipo_dato" => "int",
            "longitud" => "11",
            "obligatoriedad" => 0,
            "valor" => "",
            "acciones" => "a",
            "ayuda" => "Identificador unico del formato (llave primaria)",
            "predeterminado" => "",
            "banderas" => "ai,pk",
            "etiqueta_html" => "hidden",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 0,
            "placeholder" => "idft_ite_factur_electronica",
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "impuesto_1",
            "etiqueta" => "IMP. 1",
            "tipo_dato" => "DOUBLE",
            "longitud" => null,
            "obligatoriedad" => 0,
            "valor" => null,
            "acciones" => "a,e,b",
            "ayuda" => null,
            "predeterminado" => null,
            "banderas" => null,
            "etiqueta_html" => "text",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => null,
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "impuesto_2",
            "etiqueta" => "IMP. 2",
            "tipo_dato" => "DOUBLE",
            "longitud" => null,
            "obligatoriedad" => 0,
            "valor" => null,
            "acciones" => "a,e,b",
            "ayuda" => null,
            "predeterminado" => null,
            "banderas" => null,
            "etiqueta_html" => "text",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => null,
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "serie_idserie",
            "etiqueta" => "Tipo de documento",
            "tipo_dato" => "int",
            "longitud" => "11",
            "obligatoriedad" => 0,
            "valor" => "..\/..\/test\/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1",
            "acciones" => "a,e",
            "ayuda" => "Tipo de documento",
            "predeterminado" => "54",
            "banderas" => "",
            "etiqueta_html" => "hidden",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => "Tipo documental",
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "valor_iva",
            "etiqueta" => "IVA",
            "tipo_dato" => "DOUBLE",
            "longitud" => null,
            "obligatoriedad" => 0,
            "valor" => null,
            "acciones" => "a,e,b",
            "ayuda" => null,
            "predeterminado" => null,
            "banderas" => null,
            "etiqueta_html" => "text",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => null,
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "valor_total",
            "etiqueta" => "Total",
            "tipo_dato" => "DOUBLE",
            "longitud" => null,
            "obligatoriedad" => 1,
            "valor" => null,
            "acciones" => "a,e,b",
            "ayuda" => null,
            "predeterminado" => null,
            "banderas" => null,
            "etiqueta_html" => "text",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => null,
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
        ],
        [
            "formato_idformato" => 453,
            "nombre" => "valor_unitario",
            "etiqueta" => "Valor unitario",
            "tipo_dato" => "DOUBLE",
            "longitud" => null,
            "obligatoriedad" => 1,
            "valor" => null,
            "acciones" => "a,e,b",
            "ayuda" => null,
            "predeterminado" => null,
            "banderas" => null,
            "etiqueta_html" => "text",
            "orden" => 0,
            "mascara" => null,
            "adicionales" => null,
            "autoguardado" => 0,
            "fila_visible" => 1,
            "placeholder" => null,
            "longitud_vis" => null,
            "opciones" => null,
            "estilo" => null
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

        if (!empty($idreg)) {
            $cond = ["idformato" => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->delete("formato", $cond);

            $cond2 = ["formato_idformato" => $idreg];
            //$datos["formato_idformato"] = $idformato;
            $resp = $conn->delete("campos_formato", $cond2);

            $idreg2 = $conn->fetchColumn("select idformato from formato where nombre = :nombre and cod_padre = :cod_padre", [
                'nombre' => "ite_factur_electronica",
                'cod_padre' => $idreg
            ]);
            if (!empty($idreg2)) {
                $cond3 = ["idformato" => $idreg2];
                //$datos["formato_idformato"] = $idformato;
                $resp = $conn->delete("formato", $cond3);

                $cond4 = ["formato_idformato" => $idreg2];
                $resp = $conn->delete("campos_formato", $cond4);
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

            foreach($this->campos_factura_electronica as $fila) {
                $fila['formato_idformato'] = $idfmt;
                $idcampo = $this->guardarCF($fila);
            }

            $this->formatos["ite_factur_electronica"]["cod_padre"] = $idfmt;
            $idfmt2 = $this->guardar("formato", $this->formatos["ite_factur_electronica"]);
            if($idfmt2) {
                foreach($this->campos_item as $fila) {
                    $fila['formato_idformato'] = $idfmt2;
                    $idcampo = $this->guardarCF($fila);
                }
            }
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

    private function guardarCF($datos) {
        $conn = $this->connection;

        $tabla = "campos_formato";
        $idreg = $conn->fetchColumn("select idcampos_formato from $tabla where nombre = :nombre AND formato_idformato = :idformato", [
            'nombre' => $datos["nombre"],
            'idformato' => $datos["formato_idformato"]
        ]);

        if (!empty($idreg)) {
            $cond = ["idcampos_formato" => $idreg];
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
