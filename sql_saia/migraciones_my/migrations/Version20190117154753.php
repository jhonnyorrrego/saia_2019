<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117154753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Actualiza mostrar del formato ruta_distribucion';
    }

    public function up(Schema $schema) : void
    {
        array(
  array('idformato' => '404','nombre' => 'ruta_distribucion','etiqueta' => 'Rutas de Distribuci&oacute;n','cod_padre' => '0','contador_idcontador' => '4','nombre_tabla' => 'ft_ruta_distribucion','ruta_mostrar' => 'mostrar_ruta_distribucion.php','ruta_editar' => 'editar_ruta_distribucion.php','ruta_adicionar' => 'adicionar_ruta_distribucion.php','librerias' => NULL,'estilos' => NULL,'javascript' => NULL,'encabezado' => '1',,'pie_pagina' => '9','margenes' => '15,20,30,20','orientacion' => '0','papel' => 'Letter','exportar' => 'mpdf','funcionario_idfuncionario' => '1','fecha' => '2019-01-17 09:13:51','mostrar' => '1','imagen' => NULL,'detalle' => '0','tipo_edicion' => '1','item' => '0','serie_idserie' => '0','ayuda' => NULL,'font_size' => '11','banderas' => 'm','tiempo_autoguardado' => '300000','mostrar_pdf' => '0','orden' => NULL,'enter2tab' => '0','firma_digital' => '0','fk_categoria_formato' => '2,3','flujo_idflujo' => '0','funcion_predeterminada' => '','paginar' => '0','pertenece_nucleo' => '1','permite_imprimir' => '1','firma_crt' => NULL,'pos_firma_crt' => NULL,'logo_firma_crt' => NULL,'pos_logo_firma_crt' => NULL,'descripcion_formato' => NULL,'proceso_pertenece' => '0','version' => '0','documentacion' => NULL,'mostrar_tipodoc_pdf' => '0')
);
        $this->connection->update("formato",
                ['cuerpo' => '<table class="table table-bordered" style="width: 100%;"><tbody><tr><td><strong>Fecha</strong></td><td>{*fecha_creacion*}&nbsp;</td><td style="text-align: center;" rowspan="2">&nbsp;{*mostrar_codigo_qr*} <br>Radicado: {*formato_numero*}</td></tr><tr><td><strong>Asunto</strong></td><td>{*asunto_documento*}</td></tr></table><br><table class="table table-bordered" style="width: 100%;"><tbody><tr>
    <td style="width:50%;"><strong>Fecha<strong></td>
    <td>{*fecha_ruta_distribuc*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Nombre de la Ruta<strong></td>
    <td>{*nombre_ruta*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Descripci&Oacute;n ruta<strong></td>
    <td>{*descripcion_ruta*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Dependencias de la Ruta<strong></td>
    <td>{*asignar_dependencias*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Mensajeros de la Ruta<strong></td>
    <td>{*asignar_mensajeros*}</td>
    </tr></tbody></table>'], ["idformato" => 404]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
