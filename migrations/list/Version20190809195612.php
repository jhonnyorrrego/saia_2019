<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190809195612 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $this->connection->update('formato', [
            'descripcion_formato' => "Rutas de distribuci&oacute;n"
        ], [
            'nombre' => 'ruta_distribucion'
        ]);

        $this->connection->update('formato', [
            'cuerpo' => "<table border=\"1\" cellspacing=\"0\" class=\"table table-bordered\" style=\"border-collapse:collapse; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"border-color:#b6b8b7; border-style:solid; border-width:1px; text-align:center\"><span><strong>RUTA DE DISTRIBUCI&Oacute;N</strong></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-color:#b6b8b7; border-style:solid; border-width:1px\"><strong>&nbsp;Fecha</strong></td>\r\n			<td style=\"border-color:#b6b8b7; border-style:solid; border-width:1px\">&nbsp;{*fecha_ruta_distribuc*}</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-color:#b6b8b7; border-style:solid; border-width:1px\"><strong>&nbsp;Nombre de la Ruta&nbsp;</strong></td>\r\n			<td style=\"border-color:#b6b8b7; border-style:solid; border-width:1px\">&nbsp;{*nombre_ruta*}</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-color:#b6b8b7; border-style:solid; border-width:1px\"><strong>&nbsp;Descripci&oacute;n Ruta&nbsp;</strong></td>\r\n			<td style=\"border-color:#b6b8b7; border-style:solid; border-width:1px\">&nbsp;{*descripcion_ruta*}&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>{*mostrar_datos_dependencias_ruta*}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>{*mostrar_datos_funcionarios_ruta*}</p>\r\n\r\n<p>{*mostrar_estado_proceso*}</p>\r\n"
        ], [
            'nombre' => 'ruta_distribucion'
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta_html' => "arbol_fancytree"
        ], [
            'nombre' => 'asignar_dependencias'
        ]);

        $this->connection->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_dependencia.php","checkbox":"checkbox"}'
        ], [
            'nombre' => 'asignar_dependencias'
        ]);

        $this->connection->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_dependencia.php","checkbox":"checkbox"}'
        ], [
            'nombre' => 'asignar_mensajeros'
        ]);

        $this->connection->update('formato', [
            'descripcion_formato' => 'funcionarios de la ruta'
        ], [
            'nombre' => 'funcionarios_ruta'
        ]);

        $this->connection->update('campos_formato', [
            'acciones' => 'a,e,b,p'
        ], [
            'nombre' => 'fecha_mensajero',
            'idcampos_formato' => 5008
        ]);

        $this->connection->update('campos_formato', [
            'acciones' => 'a,e,b,p'
        ], [
            'nombre' => 'fecha_mensajero',
            'idcampos_formato' => 5008
        ]);

        $this->connection->update('campos_formato', [
            'valor' => '1,Array',
            'opciones' => "[{\"llave\":1,\"item\":\"1\"}]"
        ], [
            'nombre' => 'mensajero_ruta',
            'idcampos_formato' => 5005
        ]);

        $this->connection->update('formato', [
            'descripcion_formato' => 'dependencia de la ruta'
        ], [
            'nombre' => 'dependencias_ruta'
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'Descripci&oacute;n'
        ], [
            'nombre' => 'descripcion_dependen',
            'idcampos_formato' => 4996
        ]);

        $this->connection->update('campos_formato', [
            'acciones' => 'a,e,b,p'
        ], [
            'nombre' => 'fecha_item_dependenc',
            'idcampos_formato' => 5002
        ]);

        $this->connection->update('campos_formato', [
            'valor' => '{\"url\":\"arboles/arbol_dependencia.php\",\"checkbox\":\"radio\"}',
            'etiqueta_html' => 'arbol_fancytree',
            'placeholder' => 'arbol_fancytree',
            'opciones' => '{\"url\":\"dependencia\",\"checkbox\":\"radio\"}'
        ], [
            'nombre' => 'dependencia_asignada',
            'idcampos_formato' => 4995
        ]);

        $this->connection->update('formato', [
            'descripcion_formato' => 'Entrega Interna'
        ], [
            'nombre' => 'despacho_ingresados',
            'idformato' => 353
        ]);

        $this->connection->update('campos_formato', [
            'valor' => '1,Array;2,Array',
            'opciones' => '[{\"llave\":1,\"item\":\"Matutina\"},{\"llave\":2,\"item\":\"Vespertina\"}]'
        ], [
            'nombre' => 'tipo_recorrido',
            'idcampos_formato' => 5087
        ]);

        $this->connection->update('campos_formato', [
            'valor' => 'pdf|doc|docx|jpg|jpeg|gif|png|bmp|xls|xlsx|ppt@unico',
            'opciones' => '{\"tipos\":\"pdf,doc,docx,jpg,jpeg,gif,png,bmp,xls,xlsx,ppt\",\"cantidad\":\"1\"}'
        ], [
            'nombre' => 'anexo',
            'idcampos_formato' => 5018
        ]);

        $this->connection->update('campos_formato', [
            'valor' => '',
            'etiqueta_html' => 'hidden'
        ], [
            'nombre' => 'serie_idserie',
            'idcampos_formato' => 52
        ]);
		
		$query = $this->connection->fetchAll("select idcampos_formato from campos_formato where nombre='fecha_documento' and formato_idformato='3'");
		if(!$query[0]['idcampos_formato']){
	        $this->connection->insert('campos_formato', [
	            'formato_idformato' => '3',
	            'nombre' => 'fecha_documento',
	            'etiqueta' => 'FECHA DOCUMENTO',
	            'tipo_dato' => 'DATE',
	            'longitud' => NULL,
	            'obligatoriedad' => '0',
	            'valor' => NULL,
	            'acciones' => 'a,e,b',
	            'ayuda' => NULL,
	            'predeterminado' => NULL,
	            'banderas' => NULL,
	            'etiqueta_html' => 'fecha',
	            'orden' => '8',
	            'mascara' => NULL,
	            'adicionales' => NULL,
	            'autoguardado' => '0',
	            'fila_visible' => '1',
	            'placeholder' => NULL,
	            'longitud_vis' => NULL,
	            'opciones' => NULL,
	            'estilo' => NULL,
	        ]);
        }
		
		$query = $this->connection->fetchAll("select idmodulo from modulo where nombre='configuracion_radicacion'");
		if(!$query[0]['idmodulo']){
	        $this->connection->insert('modulo', [
	            'pertenece_nucleo' => '0',
	            'nombre' => 'configuracion_radicacion',
	            'tipo' => '2',
	            'imagen' => 'fa fa-gears',
	            'etiqueta' => 'Configuraci&oacute;n',
	            'enlace' => "views/dashboard/kaiten_dashboard.php?panels=[{\"kConnector\": \"html.page\",\"url\": \"pantallas/busquedas/componentes_busqueda.php?idbusqueda=133\"}]",
	            'cod_padre' => '2007',
	            'orden' => '8'
	        ]);
	    }

        $this->connection->update('busqueda_componente', [
            'info' => 'Nombre|{*nombre*}|center|-|Estado|{*estado*}|center|-|Acciones|{*editar_cf@idcf_empresa_trans,nombre_tabla*}|center',
            'campos_adicionales' => "idcf_empresa_trans,nombre,case estado when 1 then 'Activo' else 'inactivo' end as estado, 'cf_empresa_trans' as nombre_tabla"
        ], [
            'idbusqueda_componente' => 299
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=322&table=cf_ventanilla',
            'info' => 'Nombre|{*nombre*}|center|-|Estado|{*estado*}|center|-|Acciones|{*editar_cf@idcf_ventanilla,nombre_tabla*}|center',
            'campos_adicionales' => "idcf_ventanilla,nombre, case estado when 1 then \'Activo\' else \'Inactivo\' end as estado, \'cf_ventanilla\' as nombre_tabla",
            'enlace_adicionar' => 'views/distribucion/transportadoras.php?table=cf_ventanilla'
        ], [
            'idbusqueda_componente' => 322
        ]);

        $table = $schema->getTable('cf_empresa_trans');
        $table->dropColumn('categoria');
        $table->dropColumn('tipo');
        $table->dropColumn('descripcion');
        $table->dropColumn('valor');
        $table->dropColumn('cod_padre');

        $ventanilla = $schema->getTable('cf_ventanilla');
        $ventanilla->dropColumn('categoria');
        $ventanilla->dropColumn('tipo');
        $ventanilla->dropColumn('descripcion');
        $ventanilla->dropColumn('valor');
        $ventanilla->dropColumn('cod_padre');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
