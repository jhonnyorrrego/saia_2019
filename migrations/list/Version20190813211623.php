<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813211623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda', [
            'campos' => 'a.numero,a.fecha,a.serie,a.plantilla,a.tipo_ejecutor,a.descripcion,a.estado,a.ejecutor,a.pdf,a.tipo_radicado,a.fecha_limite'
        ], [
            'idbusqueda' => 7
        ]);

        $this->connection->update('busqueda_componente', [
            'enlace_adicionar' => 'views/distribucion/ventanillas.php?table=cf_ventanilla',
            'busqueda_avanzada' => 'views/distribucion/busqueda_transportadoras.php'
        ], [
            'idbusqueda_componente' => 322
        ]);

        $this->connection->update('formato', [
            'etiqueta' => 'Registro de Correspondencia'
        ], [
            'idformato' => 3
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'Registro'
        ], [
            'idcampos_formato' => 54
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'FECHA DE REGISTRO'
        ], [
            'idcampos_formato' => 53
        ]);


        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=16',
            'info' => 'N&uacute;mero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|Fecha|{*fecha*}|center|-|Asunto|{*descripcion*}',
            'busqueda_avanzada' => 'views/distribucion/busqueda_pendientes.php'
        ], [
            'idbusqueda_componente' => 16
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=280',
            'info' => 'N&uacute;mero|{*mostrar_numero_enlace@numero,iddocumento*}|center|-|Fecha|{*fecha*}|center|-|Asunto|{*descripcion*}',
            'busqueda_avanzada' => 'views/distribucion/busqueda_pendientes.php'
        ], [
            'idbusqueda_componente' => 280
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=299&table=cf_ventanilla',
            'enlace_adicionar' => 'views/distribucion/transportadoras.php?table=cf_empresa_trans',
            'busqueda_avanzada' => 'views/distribucion/busqueda_transportadoras.php'
        ], [
            'idbusqueda_componente' => 299
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta_html' => 'hidden'
        ], [
            'idcampos_formato' => 52
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria_pantalla' => 'views/buzones/utilidades/acciones_cf.php'
        ], [
            'idbusqueda' => 133
        ]);

        $this->connection->update('busqueda_componente', [
            'busqueda_avanzada' => 'views/distribucion/busqueda_distribucion.php',
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=300',
        ], [
            'idbusqueda_componente' => 300
        ]);

        $this->connection->update('busqueda_componente', [
            'busqueda_avanzada' => 'views/distribucion/busqueda_distribucion.php',
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=301',
        ], [
            'idbusqueda_componente' => 301
        ]);

        $this->connection->update('busqueda_componente', [
            'busqueda_avanzada' => 'views/distribucion/busqueda_distribucion.php',
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=302',
        ], [
            'idbusqueda_componente' => 302
        ]);

        $this->connection->update('busqueda_componente', [
            'busqueda_avanzada' => 'views/distribucion/busqueda_distribucion.php',
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=303',
        ], [
            'idbusqueda_componente' => 303
        ]);
        
        $query = $this->connection->fetchAll("select idfunciones_formato from funciones_formato where idfunciones_formato=1472");
		if(!$query[0]['idmodulo']){
            $this->connection->insert('funciones_formato', [
                'idfunciones_formato' => '1472',
                'nombre' => '{*mostrar_num_pagina*}',
                'nombre_funcion' => 'mostrar_num_pagina',
                'parametros' => NULL,'etiqueta' => 'mostrar_num_pagina',
                'descripcion' => NULL,'ruta' => '../librerias/encabezado_pie_pagina.php',
                'formato' => '',
                'acciones' => 'm'
            ]);
        }  
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
