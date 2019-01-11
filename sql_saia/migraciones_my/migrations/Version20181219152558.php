<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181219152558 extends AbstractMigration
{
    private $formato = array(
        array('idformato' => '353','nombre' => 'despacho_ingresados','etiqueta' => 'Entrega interna','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_despacho_ingresados','ruta_mostrar' => 'mostrar_despacho_ingresados.php','ruta_editar' => 'editar_despacho_ingresados.php','ruta_adicionar' => 'adicionar_despacho_ingresados.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '5','cuerpo' => '<p>{*mostrar_seleccionados_entrega*}</p>','pie_pagina' => '','margenes' => '15,20,30,20','orientacion' => '1','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2018-05-24 19:31:29','mostrar' => '0','imagen' => NULL,'detalle' => '0','tipo_edicion' => '1','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '9','banderas' => 'e','tiempo_autoguardado' => '300000','mostrar_pdf' => '1','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '1','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL)
    );

    private $campos_formato = array(
array('idcampos_formato' => '4072','formato_idformato' => '353','nombre' => 'serie_idserie','etiqueta' => 'SERIE DOCUMENTAL','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a','ayuda' => 'Entrega interna','predeterminado' => '1215','banderas' => 'fk','etiqueta_html' => 'hidden','orden' => '6','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4074','formato_idformato' => '353','nombre' => 'mensajero','etiqueta' => 'Seleccione Mensajero','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e,b','ayuda' => 'rol del funcionario mensajero','predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '8','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4075','formato_idformato' => '353','nombre' => 'idft_despacho_ingresados','etiqueta' => 'DESPACHO_INGRESADOS','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e','ayuda' => NULL,'predeterminado' => NULL,'banderas' => 'ai,pk','etiqueta_html' => 'hidden','orden' => '9','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4076','formato_idformato' => '353','nombre' => 'documento_iddocumento','etiqueta' => 'DOCUMENTO ASOCIADO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e','ayuda' => NULL,'predeterminado' => NULL,'banderas' => 'i','etiqueta_html' => 'hidden','orden' => '10','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4077','formato_idformato' => '353','nombre' => 'dependencia','etiqueta' => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '{*buscar_dependencia*}','acciones' => 'a,e','ayuda' => NULL,'predeterminado' => NULL,'banderas' => 'i','etiqueta_html' => 'hidden','orden' => '4','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4078','formato_idformato' => '353','nombre' => 'encabezado','etiqueta' => 'ENCABEZADO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e','ayuda' => NULL,'predeterminado' => '1','banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '11','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4079','formato_idformato' => '353','nombre' => 'firma','etiqueta' => 'FIRMAS DIGITALES','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e','ayuda' => NULL,'predeterminado' => '1','banderas' => '','etiqueta_html' => 'hidden','orden' => '12','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4080','formato_idformato' => '353','nombre' => 'fecha_entrega','etiqueta' => 'Fecha','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,p,d,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '13','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '4830','formato_idformato' => '353','nombre' => 'estado_documento','etiqueta' => 'ESTADO DEL DOCUMENTO','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e','ayuda' => NULL,'predeterminado' => '1','banderas' => '','etiqueta_html' => 'hidden','orden' => '3','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '5013','formato_idformato' => '353','nombre' => 'iddestino_radicacion','etiqueta' => 'destino_radicacion','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '1','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '2','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '5018','formato_idformato' => '353','nombre' => 'anexo','etiqueta' => 'anexo','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'archivo','orden' => '1','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '5087','formato_idformato' => '353','nombre' => 'tipo_recorrido','etiqueta' => 'Recorrido del dia','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '1,MATUTINA;2,VESPERTINA','acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'radio','orden' => '5','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '5088','formato_idformato' => '353','nombre' => 'docs_seleccionados','etiqueta' => 'Documentos seleccionados','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '7','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '5189','formato_idformato' => '353','nombre' => 'tipo_mensajero','etiqueta' => 'tipo_mensajero','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a,e,b','ayuda' => NULL,'predeterminado' => 'i','banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1'),
array('idcampos_formato' => '6623','formato_idformato' => '353','nombre' => 'idft_ruta_dist','etiqueta' => 'Id de la ruta','tipo_dato' => 'VARCHAR','longitud' => '255','obligatoriedad' => '0','valor' => NULL,'acciones' => 'a','ayuda' => NULL,'predeterminado' => NULL,'banderas' => NULL,'etiqueta_html' => 'hidden','orden' => '0','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1')
);
    public function getDescription() {
        return 'Crear formato despacho_ingresados';
    }
    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
    public function up(Schema $schema)
    {
        $conn = $this->connection;

        $idfmt_despacho_ingresados = $conn->fetchColumn("select idformato from formato where nombre = :nombre", [
            'nombre' => "despacho_ingresados"
        ]);

        if(empty($idfmt_despacho_ingresados)) {
            $idfmt_despacho_ingresados = $this->guardar_formato($this->formato);
        }
        if(!empty($idfmt_despacho_ingresados)) {
            $conn->beginTransaction();

            foreach ($this->campos_formato as $value) {
                $this->guardar_campo($idfmt_despacho_ingresados, $value);
            }
            $conn->commit();
        }

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
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
