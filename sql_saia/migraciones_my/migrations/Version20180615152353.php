<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180615152353 extends AbstractMigration {
	public function up(Schema $schema) {
		date_default_timezone_set("America/Bogota");
		$this -> platform -> registerDoctrineTypeMapping('enum', 'string');
		$cadena_sql = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'nombre_serie\'><b>Serie: </b>{*nombre_serie*}</div><br/><div class=\'descripcion_documento\'>{*descripcion*}</div></div>' WHERE idbusqueda_componente = 9";
		$this -> addSql($cadena_sql);

		$cadena_sql2 = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'nombre_serie\'><b>Serie: </b>{*nombre_serie*}</div><br/><div class=\'descripcion_documento\'>{*descripcion*}</div></div>' WHERE idbusqueda_componente = 10";
		$this -> addSql($cadena_sql2);

		$cadena_sql3 = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'descripcion_documento\'>{*mostrar_informacion_adicional_expediente@idexpediente*}</div></div>' WHERE idbusqueda_componente = 110";
		$this -> addSql($cadena_sql3);

		$cadena_sql4 = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idcategoria_formato*}\" class=\"well\"><b>{*nombre*}</b>{*enlaces_categoria_formato@idcategoria_formato,nombre*}{*validar_activo_inactivo_categoria_formato@idcategoria_formato,estado*}<br/><br/><br/></div>' WHERE idbusqueda_componente = 286";
		$this -> addSql($cadena_sql4);
	}

	public function down(Schema $schema) {
		date_default_timezone_set("America/Bogota");
		$this -> platform -> registerDoctrineTypeMapping('enum', 'string');
		$cadena_sql = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\"><div class=\"btn btn-mini enlace_expediente pull-right\" idregistro=\"{*idexpediente*}\" title=\"{*nombre*}\"><i class=\"icon-info-sign\"></i></div>{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'nombre_serie\'><b>Serie: </b>{*nombre_serie*}</div><br/><div class=\'descripcion_documento\'>{*descripcion*}</div></div>' WHERE idbusqueda_componente = 9";
		$this -> addSql($cadena_sql);

		$cadena_sql2 = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\"><div class=\"btn btn-mini enlace_expediente pull-right\" idregistro=\"{*idexpediente*}\" title=\"{*nombre*}\"><i class=\"icon-info-sign\"></i></div>{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'nombre_serie\'><b>Serie: </b>{*nombre_serie*}</div><br/><div class=\'descripcion_documento\'>{*descripcion*}</div></div>' WHERE idbusqueda_componente = 10";
		$this -> addSql($cadena_sql2);

		$cadena_sql3 = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\"><div class=\"btn btn-mini enlace_expediente pull-right\" idregistro=\"{*idexpediente*}\" title=\"{*nombre*}\"><i class=\"icon-info-sign\"></i></div>{*enlaces_adicionales_expediente@idexpediente,nombre,estado_cierre,propietario,agrupador*}{*enlace_expediente@idexpediente,nombre*}<br/><div class=\'descripcion_documento\'>{*mostrar_informacion_adicional_expediente@idexpediente*}</div></div>' WHERE idbusqueda_componente = 110";
		$this -> addSql($cadena_sql3);

		$cadena_sql4 = "UPDATE busqueda_componente SET info = '<div id=\"resultado_pantalla_{*idcategoria_formato*}\" class=\"well\"><b>{*nombre*}</b>	<div class=\"btn btn-mini enlace_detalles_categoria_formato pull-right\" idregistro=\"{*idcategoria_formato*}\" title=\"Ver {*nombre*}\"><i class=\"icon-info-sign\"></i>	</div>	<div class=\"btn btn-mini enlace_editar_categoria_formato pull-right\" idregistro=\"{*idcategoria_formato*}\" title=\"Editar {*nombre*}\" enlace=\"pantallas/categoria_formato/editar_categoria_formato.php\"><i class=\"icon-edit\"></i>	</div><div class=\"btn btn-mini enlace_inactivar_categoria_formato pull-right\" idregistro=\"{*idcategoria_formato*}\" title=\"{*nombre*}\" id=\"enlace_inactivar_categoria_formato_{*idcategoria_formato*}\"><i class=\"icon-ban-circle\"></i>	</div><div class=\"btn btn-mini enlace_activar_categoria_formato pull-right\" idregistro=\"{*idcategoria_formato*}\" title=\"{*nombre*}\" id=\"enlace_activar_categoria_formato_{*idcategoria_formato*}\"><i class=\"icon-ok\"></i>	</div>{*validar_activo_inactivo_categoria_formato@idcategoria_formato,estado*}<br/><br/><br/></div>' WHERE idbusqueda_componente = 286";
		$this -> addSql($cadena_sql4);
	}

}
