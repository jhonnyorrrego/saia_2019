<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180516205347 extends AbstractMigration {

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $table = $schema->getTable('pantalla');
        $this->abortIf(!$table, 'No ha configurado este SAIA para pantallas');
        $table->addColumn("cuerpo_pantalla", "text", [
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8',
            "notnull" => false
        ]);
        $table->addColumn("accion_eliminar", "integer", [
            "length" => 11,
            "notnull" => true,
            "default" => 2
        ]);
        $table2 = $schema->getTable('campos_formato');
        $table2->addColumn("placeholder", "string", [
            'length'  => '255',
            'collate' => 'utf8_unicode_ci',
            'charset' => 'utf8',
            'notnull' => false
        ]);
        
        $tabla_pantalla_componente = $schema->getTable('pantalla_componente');
        $tabla_pantalla_componente->addColumn("etiqueta_html","string", [
        		'length'  => '255',
        		'collate' => 'utf8_unicode_ci',
        		'charset' => 'utf8',
        		'notnull' => false
        ]);
        $conn = $this->connection;

        $conn->beginTransaction();

        $idmodulo = $this->buscar_modulo("crear_formato_saia");

        $busqueda = $this->buscar_busqueda("listado_formatos");
        $idbusq=$busqueda["idbusqueda"];
        $librerias=$busqueda["ruta_libreria"];
        if(strpos("pantallas/pantalla/librerias.php",$librerias)===false){
        	$this->addSql("UPDATE busqueda SET ruta_libreria='".$librerias.",pantallas/pantallas/librerias.php' WHERE idbusqueda=".$idbusq);
        }
        $componente1 = [
          'busqueda_idbusqueda' => $idbusq,
          'tipo' => '3',
          'conector' => '2',
          'url' => 'pantallas/busquedas/consulta_busqueda.php',
          'etiqueta' => 'Listar pantallas',
          'nombre' => 'listado_pantallas',
          'orden' => 2,
          'info' => '<div id="resultado_pantalla_{*idformato*}" class="well"><table style="width:40%;font-size:8pt;font-family:arial;border-collapse:collapse" border="1px"><tr><td style="width:20%">Nombre</td><td style="text-align:center;width:20%">Pdf</td></tr><tr><td><b><a class="kenlace_saia" enlace="pantallas/generador/generador_pantalla.php?idformato={*idformato*}" conector="iframe" titulo="Formato {*etiqueta*}" style="cursor:pointer">{*etiqueta*}-{*idformato*}</a></b></td><td style="text-align:center">{*pdf_funcion@idformato*}</td></tr></table></div>',
          'exportar' => NULL,
          'encabezado_componente' => '',
          'estado' => 2,
          'cargar' => 2,
          'campos_adicionales' => 'A.nombre,A.librerias,A.etiqueta,A.funcionario_idfuncionario,A.ayuda,A.banderas,A.tiempo_autoguardado',
          'tablas_adicionales' => '',
          'ordenado_por' => 'A.etiqueta',
          'direccion' => 'ASC',
          'agrupado_por' => '',
          'busqueda_avanzada' => '',
          'acciones_seleccionados' => '',
          'modulo_idmodulo' => $idmodulo,
          'menu_busqueda_superior' => 'menu_superior_adicionar@{*idformato*}',
          'enlace_adicionar' => NULL,
          'llave' => 'A.idformato'
        ];

        $idcmp1 = $this->guardar_componente($componente1);

        $cond1 = [
            "fk_busqueda_componente" => $idcmp1,
            "codigo_where" => "1=1",
            "etiqueta_condicion" => "condicion_listado_pantallas"
        ];

        $resp1 = $this->guardar_condicion($cond1);

        $enlace_modulo = 'pantallas/buscador_principal.php?idbusqueda='.$idbusq.'&cmd=resetall';

        $datos_mod = [
            'enlace' => $enlace_modulo
        ];
        $ident_mod = [
            'idmodulo' => $idmodulo
        ];
        $resp = $conn->update('modulo', $datos_mod, $ident_mod);

        $conn->commit();
        $conn->beginTransaction();
        if (!$schema->hasTable("formato_libreria")){
            $table = $schema->createTable("formato_libreria");
            $table->addColumn("idformato_libreria", "integer", [
                "length" => 11,
                "notnull" => false,
                'autoincrement' => true
            ]);
            $table->addColumn("fecha", "datetime", [
                "notnull" => false
            ]);
            $table->addColumn("formato_idformato", "integer", [
                "length" => 11,
                "notnull" => false
            ]);
            $table->addColumn("funcionario_idfuncionario", "integer", [
                "length" => 11,
                "notnull" => false
            ]);
            $table->addColumn("ruta", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("orden", "integer", [
                "length" => 11,
                "default" => 1,
                "notnull" => false
            ]);
            $table->setPrimaryKey([
                "idformato_libreria"
            ]);
        }
        $conn->commit();
    }

    public function postUp(Schema $schema) {
    	date_default_timezone_set("America/Bogota");
    	$this->platform->registerDoctrineTypeMapping('enum', 'string');
    	$conn = $this->connection;
    	$conn->beginTransaction();
    	$conn->executeQuery("Truncate pantalla_componente");
    	$conn->executeQuery("INSERT INTO `pantalla_componente` (`idpantalla_componente`, `nombre`, `etiqueta_html`, `etiqueta`, `clase`, `componente`, `opciones`, `procesar`, `categoria`, `estado`, `librerias`, `tipo_componente`, `eliminar`) VALUES
(1, 'text', 'text', 'Campo texto', 'icon-cuadro_texto', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*etiqueta_html*}\">{*clase_eliminar_pantalla_componente*}<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class=\"controls\"><input type=\"{*etiqueta_html*}\" name=\"{*nombre*}\" maxlength=\"{*longitud*}\" class=\"elemento_formulario\" placeholder=\"{*placeholder*}\" idpantalla_campos=\"{*idpantalla_campos*}\" value=\"{*procesar_texto*}\" id=\"{*nombre*}\" />{*procesar_opcion_buscar*}</div></div>', '{\"nombre\":\"campo_texto\",\"etiqueta\":\"Campo de texto\",\"tipo_dato\":\"varchar\",\"longitud\":255,\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"text\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"campo texto\"}', '', 'Texto', 1, NULL, 1, ''),
(2, 'radio', 'radio', 'Bot&oacute;n Selecci&oacute;n', 'icon-radio', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">\n  {*clase_eliminar_pantalla_componente*} \n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\"> \n    {*procesar_radio*}\n  </div>\n</div>', '{\"nombre\":\"radio\",\"etiqueta\":\"Boton de Seleccion Tipo 1\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"1,1;2,2;3,3;4,4\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"radio\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo texto\"}', 'mostrar_radio', 'Selectores', 1, NULL, 1, ''),
(3, 'arbol_checkbox', 'arbol_checkbox', 'Arbol checkbox', 'icon-checkbox', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*} \n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\"> \n    {*cargar_listado_inicial_arbol_checkbox*}  \n    {*busca_componente_arbol_checkbox*}\n    <div id=\"esperando_{*nombre*}\"><img src=\"{*obtener_ruta_db_superior*}imagenes/cargando.gif\"></div>\n    <div id=\"treebox_{*nombre*}\" height=\"90%\" class=\"arbol_saia\"></div>		    \n    <script type=\"text/javascript\">\n    $(document).ready(function(){\n    	var browserType;\n      if (document.layers) {browserType = \"nn4\"}\n      if (document.all) {browserType = \"ie\"}\n      if (window.navigator.userAgent.toLowerCase().match(\"gecko\")) {browserType= \"gecko\"}\n    	tree_{*nombre*}=new dhtmlXTreeObject(\"treebox_{*nombre*}\",\"100%\",\"\",0);\ntree_{*nombre*}.enableTreeImages(false);    	tree_{*nombre*}.setImagePath(\"{*obtener_ruta_db_superior*}imgs/\");\n    	tree_{*nombre*}.enableIEImageFix(true);              \n    	tree_{*nombre*}.setOnLoadingStart(cargando_{*nombre*});\n    	tree_{*nombre*}.setOnLoadingEnd(fin_cargando_{*nombre*});\n      tree_{*nombre*}.enableCheckBoxes(1);\n      {*padre_independiente_arbol_checkbox*}\n    	tree_{*nombre*}.setOnCheckHandler(onNodeSelect_{*nombre*});\n    	{*load_datos_arbol_checkbox*}	\n            function fin_cargando_{*nombre*}(){\n    		if (browserType == \"gecko\")\n    			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\')\n    		else if (browserType == \"ie\")\n    			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\');\n    		else\n    			document.poppedLayer = eval(\'document.layers[\"esperando_{*nombre*}\"]\');\n    			document.poppedLayer.style.display = \"none\";\n    	}\n            \n            function cargando_{*nombre*}() {\n    		if (browserType == \"gecko\" )\n    			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\');\n    		else if (browserType == \"ie\")\n    			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\');\n    		else\n    			document.poppedLayer =	eval(\'document.layers[\"esperando_{*nombre*}\"]\');\n    			document.poppedLayer.style.display = \"\";\n    	}\n      function onNodeSelect_{*nombre*}(nodeId){\n        valor_destino=document.getElementById(\"{*nombre*}\");\n				\n					destinos=tree_{*nombre*}.getAllChecked();\n					var nuevos_valores=destinos.split(\",\");\n					var cantidad=nuevos_valores.length;\n					var funcionarios=new Array();\n					var indice=0;\n					for(var i=0;i<cantidad;i++){\n						if(nuevos_valores[i].indexOf(\"#\")==\"-1\"){\n							if(nuevos_valores[i]!=\"\"){\n								funcionarios[indice]=nuevos_valores[i];\n								indice++;\n							}\n						}\n					}\n					valor_destino.value=funcionarios.join(\",\");\n				\n      }\n    	{*caracteristicas_arbol_checkbox*}		\n    });\n    </script>		\n  </div>\n</div>', '{\"nombre\":\"arbol_checkbox\",\"etiqueta\":\"Arbol de funcionario checkbox\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"pantallas/lib/arbol_funcionarios.php?rol=1|1|0|1|1|0|5\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"arbol_checkbox\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}', 'mostrar_arbol_checkbox', 'Arbol', 1, 'js/dhtmlXTree.js,js/dhtmlXCommon.js,css/dhtmlXTree.css,pantallas/lib/librerias_codificacion.js,pantallas/lib/librerias_arboles.js,css/bootstrap/saia/css/bootstrap_reescribir.css', 1, ''),
(4, 'checkbox', 'checkbox', 'Checkbox', 'icon-checkbox', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">\n  {*clase_eliminar_pantalla_componente*} \n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\"> \n    {*procesar_checkbox*}\n  </div>\n</div>', '{\"nombre\":\"checkbox\",\"etiqueta\":\"Checkbox\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"1,1;2,2;3,3;4,4\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"checkbox\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}', 'mostrar_checkbox', 'Selectores', 1, NULL, 1, ''),
(5, 'password', 'password', 'Password', 'icon-password', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class=\"controls\"><input type=\"{*etiqueta_html*}\" name=\"{*nombre*}\" id=\"{*nombre*}\" class=\"elemento_formulario\" placeholder=\"{*placeholder*}\" idpantalla_campos=\"{*idpantalla_campos*}\" value=\"{*procesar_password*}\" /></div></div>', '{\"nombre\":\"password\",\"etiqueta\":\"Password\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"password\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo texto\"}', '', 'Texto', 1, NULL, 1, ''),
(6, 'textarea', 'textarea', '&Aacute;rea de texto', 'icon-cuadro_texto', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class=\"controls\"><textarea name=\"{*nombre*}\" class=\"elemento_formulario\" placeholder=\"{*placeholder*}\" idpantalla_campos=\"{*idpantalla_campos*}\" id=\"{*nombre*}\">{*procesar_textarea*}</textarea></div></div>', '{\"nombre\":\"textarea\",\"etiqueta\":\"Textarea\",\"tipo_dato\":\"text\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"textarea\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Area de texto\"}', '', 'Texto', 1, NULL, 1, ''),
(7, 'select', 'select', 'Select', 'icon-select', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class=\"controls\">{*procesar_select*}</div></div>', '{\"nombre\":\"select\",\"etiqueta\":\"Select\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"1,1;2,2;3,3;4,4\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"select\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"seleccionar..\"}', 'mostrar_select', 'Selectores', 1, NULL, 1, ''),
(8, 'hidden', 'hidden', 'Hidden', 'icon-hidden', '{*procesar_hidden*}', '{\"nombre\":\"hidden\",\"etiqueta\":\"Campo Hidden\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"hidden\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo hidden\"}', '', 'Texto', 1, NULL, 1, ''),
(9, 'link', 'link', 'Link', 'icon-link', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class=\"controls\"><a {*procesar_link*} name=\"{*nombre*}\" class=\"elemento_formulario\" idpantalla_campos=\"{*idpantalla_campos*}\"><b>{*etiqueta*}</b></a></div></div>', '{\"nombre\":\"link\",\"etiqueta\":\"Link\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"#;_blank\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"link\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Campo hidden\"}', '', 'Texto', 1, NULL, 1, ''),
(10, 'arbol_radio', 'arbol_radio', 'Arbol radio', 'icon-radio', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*} \r\n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\r\n  </label>\r\n  <div class=\"controls\"> \r\n{*cargar_listado_inicial_arbol_radio*}  {*busca_componente_arbol_radio*}\r\n<div id=\"esperando_{*nombre*}\"><img src=\"{*obtener_ruta_db_superior*}imagenes/cargando.gif\"></div>\r\n<div id=\"treebox_{*nombre*}\" height=\"90%\"></div>		    \r\n<script type=\"text/javascript\">\r\n$(document).ready(function(){\r\n	var browserType;\r\n    if (document.layers) {browserType = \"nn4\"}\r\n    if (document.all) {browserType = \"ie\"}\r\n    if (window.navigator.userAgent.toLowerCase().match(\"gecko\")) {browserType= \"gecko\"}\r\n	tree_{*nombre*}=new dhtmlXTreeObject(\"treebox_{*nombre*}\",\"100%\",\"\",0);\r\ntree_{*nombre*}.enableTreeImages(false);	\r\ntree_{*nombre*}.setImagePath(\"{*obtener_ruta_db_superior*}imgs/\");\r\n	tree_{*nombre*}.enableIEImageFix(true);              \r\n	tree_{*nombre*}.setOnLoadingStart(cargando_{*nombre*});\r\n	tree_{*nombre*}.setOnLoadingEnd(fin_cargando_{*nombre*});\r\ntree_{*nombre*}.enableCheckBoxes(1);\r\ntree_{*nombre*}.enableRadioButtons(true);\r\n	tree_{*nombre*}.setOnCheckHandler(onNodeSelect_{*nombre*});\r\n	{*load_datos_arbol_radio*}	\r\n        function fin_cargando_{*nombre*}(){\r\n		if (browserType == \"gecko\")\r\n			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\')\r\n		else if (browserType == \"ie\")\r\n			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\');\r\n		else\r\n			document.poppedLayer = eval(\'document.layers[\"esperando_{*nombre*}\"]\');\r\n			document.poppedLayer.style.display = \"none\";\r\n	}\r\n        \r\n        function cargando_{*nombre*}() {\r\n		if (browserType == \"gecko\" )\r\n			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\');\r\n		else if (browserType == \"ie\")\r\n			document.poppedLayer = eval(\'document.getElementById(\"esperando_{*nombre*}\")\');\r\n		else\r\n			document.poppedLayer =	eval(\'document.layers[\"esperando_{*nombre*}\"]\');\r\n			document.poppedLayer.style.display = \"\";\r\n	}function onNodeSelect_{*nombre*}(nodeId){\r\nvalor_destino=document.getElementById(\"{*nombre*}\");	if(tree_{*nombre*}.isItemChecked(nodeId)){\r\n	if(valor_destino.value!==\"\")	tree_{*nombre*}.setCheck(valor_destino.value,false);						\r\n        var pos_destino=nodeId.lastIndexOf(\"_\");\r\n    if(pos_destino>0)					\r\n  {valor_destino.value=nodeId.substring(0,pos_destino);}\r\nelse{ valor_destino.value=nodeId;}\r\n		}\r\nelse{\r\n			valor_destino.value=\"\";\r\n		}\r\n	}\r\n	{*caracteristicas_arbol_radio*}		\r\n});\r\n</script>		\r\n  </div>\r\n</div>', '{\"nombre\":\"arbol_radio\",\"etiqueta\":\"Arbol de funcionario radio\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"pantallas/lib/arbol_funcionarios.php?rol=1|1|0|1|1|0|5\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"arbol_radio\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}', 'mostrar_arbol_radio', 'Arbol', 1, 'js/dhtmlXTree.js,js/dhtmlXCommon.js,css/dhtmlXTree.css,pantallas/lib/librerias_codificacion.js,pantallas/lib/librerias_arboles.js', 1, ''),
(11, 'datetime', 'fecha', 'Fecha y hora', 'icon-datetime', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">\n  {*clase_eliminar_pantalla_componente*} \n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\"> \n		<div id=\"{*nombre*}\" class=\"input-append date\">\n			{*procesar_datetime*}\n\n			<span class=\"add-on\">\n				<i data-time-icon=\"icon-time\" data-date-icon=\"icon-calendar\">\n				</i>\n			</span>\n		</div>\n  </div>\n</div>', '{\"nombre\":\"datetime\",	\"etiqueta\":\"Fecha y Hora\",\"tipo_dato\":\"datetime\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"yyyy-MM-dd hh:mm:ss\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"fecha\",\"orden\":1,\"mascara\":\"\",	\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,	\"placeholder\":\"0000-00-00\"}', '', 'Date', 1, 'css/bootstrap-datetimepicker.min.css,js/bootstrap-datetimepicker.js,pantallas/generador/datetime/adicional_js.js@h', 1, ''),
(12, 'daterange', 'fecha', 'Rango Fechas', 'icon-daterange', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\">\n	{*clase_eliminar_pantalla_componente*}\n	<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n	</label>\n  <div class=\"controls\">		\n<div class=\"input-append\">\n			<input type=\"text\" class=\"daterange\" name=\"etiqueta_{*nombre*}\" id=\"etiqueta_{*nombre*}\" value=\"\" readonly/>    \n			<input type=\"hidden\" name=\"{*nombre*}\" id=\"{*nombre*}\" value=\"\" />    \n			<span class=\"add-on\" id=\"boton_{*nombre*}\">\n				<i class=\"icon-calendar\">\n				</i>\n			</span>\n		</div>\n  </div>        \n</div>\n<script type=\"text/javascript\">\n$(document).ready(function(){\n	$(\"#boton_{*nombre*}\").daterangepicker({\n			startDate: moment().subtract(\"days\", 29),\n			opens: \"left\",\n			endDate: moment(),\n			showDropdowns: true,\n			showWeekNumbers: true,\n			timePicker: false,\n			timePickerIncrement: 1,\n			timePicker12Hour: true,\n			ranges: {\n					\"Hoy\": [moment(), moment()],\n					\"Pasados 30 Dias\": [moment().subtract(\"days\", 29), moment()],	\n					\"Mes Pasado\": [moment().subtract(\"month\", 1).startOf(\"month\"), moment().subtract(\"month\", 1).endOf(\"month\")]\n			},\n			opens: \"left\",\n			buttonClasses: [\"btn btn-default\"],\n			applyClass: \"btn-small btn-primary\",\n			cancelClass: \"btn-small\",\n			format: \"YYYY-MM-DD\",\n			separator: \" - \",\n			locale: {\n					applyLabel: \"Seleccionar\",\n					fromLabel: \"De\",\n					toLabel: \"A\",\n					customRangeLabel: \"Seleccione rango\",\n					daysOfWeek: [\"Do\", \"Lu\", \"Ma\", \"Mi\", \"Ju\", \"Vi\",\"Sa\"],\n					monthNames: [\"Enero\", \"Febrero\", \"Marzo\", \"Abril\", \"Mayo\", \"Junio\", \"Julio\", \"Agosto\", \"Septiembre\", \"Octubre\", \"Novimbre\", \"Diciembre\"],\n					firstDay: 1\n			}\n		},	    	   		\n		function(start, end) {              \n			$(\"#etiqueta_{*nombre*}\").val(start.format(\"YYYY-MM-DD\")+\" a \"+end.format(\"YYYY-MM-DD\"));\n			$(\"#{*nombre*}\").val(start.format(\"YYYY-MM-DD\")+\",\"+end.format(\"YYYY-MM-DD\"));\n		});\n});\n</script>', '{\"nombre\":\"daterange\",\"etiqueta\":\"Rango fechas\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"0000-00-00\",	\"acciones\":\"a,e,b\",	\"ayuda\":\"\",	\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"daterange\",\"orden\":1,\"mascara\":\"\",	\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}', '', 'Date', 1, 'js/daterangepicker.js,js/moment.js@h,css/daterangepicker-bs3.css,js/daterange_options.js', 1, ''),
(13, 'highslide', 'highslide', 'Highslide', 'icon-highslide', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\">\n    <div id=\"{*nombre*}\" class=\"highslide\" style=\"cursor:pointer;\" name=\"{*nombre*}\">{*etiqueta*}\n    </div>\n    <script type=\"text/javascript\">\n    $(document).ready(function(){\n      hs.graphicsDir = \"{*obtener_ruta_db_superior*}highslide/graphics/\";\n      hs.outlineType = \"rounded-white\";\n      $(\"#{*nombre*}\").live(\"click\",function(e){\n        e.preventDefault();\n        {*procesar_highslide*}\n      });\n    });    \n    </script>\n  </div>\n</div>', '{\"nombre\":\"highslide\",\"etiqueta\":\"Highslide\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"highslide\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Highslide\"}', '', 'Conectores', 1, 'anexosdigitales/highslide-4.0.10/highslide/highslide.css@h,anexosdigitales/highslide-4.0.10/highslide/highslide-full.js@h', 1, ''),
(14, 'date', 'fecha', 'Fecha', 'icon-datetime', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">\n  {*clase_eliminar_pantalla_componente*} \n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\"> \n		<div id=\"{*nombre*}\" class=\"input-append date\">\n			{*procesar_date*}\n			<span class=\"add-on\">\n				<i data-time-icon=\"icon-time\" data-date-icon=\"icon-calendar\">\n				</i>\n			</span>\n		</div>\n  </div>\n</div>\n<script type=\"text/javascript\">\n$(document).ready(function(){		\n	$(\'#{*nombre*}\').datetimepicker({\n      language: \'es\',\n      pick12HourFormat: true,\n      pickTime: false\n    }).on(\'changeDate\', function(e){\n    $(this).datetimepicker(\'hide\');\n});	\n});\n</script>', '{\"nombre\":\"date\",	\"etiqueta\":\"Fecha \",\"tipo_dato\":\"date\",	\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",	\"ayuda\":\"\",	\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"fecha\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",	\"autoguardado\":1,	\"fila_visible\":1,	\"placeholder\":\"0000-00-00\"}', '', 'Date', 1, 'css/bootstrap-datetimepicker.min.css,js/bootstrap-datetimepicker.js', 1, ''),
(15, 'textarea_tiny', 'textarea', '&Aacute;rea de texto(con tiny)', 'icon-cuadro_texto', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">\n{*clase_eliminar_pantalla_componente*}\n<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n</label><div class=\"controls\">\n{*procesar_textarea_tiny*}</div>\n</div>', '{\"nombre\":\"textarea_tiny\",\"etiqueta\":\"Area de texto\",\"tipo_dato\":\"text\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"avanzado\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"textarea\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Area de texto\"}', '', 'Texto', 1, 'tinymce/tinymce.min.js@h,pantallas/generador/textarea_tiny/encabezado_textarea.php', 1, ''),
(16, 'acciones_pantalla', 'acciones_pantalla', 'Accion Campo PHP', 'icon-acciones_pantalla', '{*procesar_accion_pantalla*}', '{\"nombre\":\"accion_pantalla\",\"etiqueta\":\"Accion pantalla\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones sobre las pantallas\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_pantalla\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Acciones pantalla\"}', '', 'Acciones pantalla', 1, NULL, 2, 'eliminar_funcion_accion_pantalla'),
(17, 'file', 'file', 'Anexos digitales', 'icon-file', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\n<label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class=\"controls\">{*procesar_file*}</div>\n</div>', '{\"nombre\":\"file\",\"etiqueta\":\"Anexos\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"file\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}', 'mostrar_file', 'Upload', 1, 'css/upload_style.css,css/jquery.fileupload-ui.css,js/jquery.ui.widget.js,js/jquery.iframe-transport.js,js/jquery.fileupload.js,js/jquery.fileupload-process.js,js/jquery.fileupload-validate.js,pantallas/anexos/js/anexos.js,pantallas/generador/file/js/adicional_anexos.php', 1, 'eliminar_funcion_file'),
(18, 'etiqueta', 'etiqueta', 'Etiqueta', 'icon-etiqueta', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\n{*procesar_etiqueta*}\n</div>', '{\"nombre\":\"etiqueta\",\"etiqueta\":\"Etiqueta\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"etiqueta\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1}', NULL, 'Texto', 1, NULL, 1, ''),
(19, 'acciones_pantalla_js', 'acciones_pantalla_js', 'Accion Pantalla JS', 'icon-acciones_pantalla_js', '{*procesar_accion_pantalla_js*}', '{\"nombre\":\"accion_pantalla_js\",\"etiqueta\":\"Accion pantalla JS\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones sobre las pantallas para bloques Javascript\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_pantalla_js\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Acciones pantalla Javascript\"}', '', 'Acciones pantalla', 0, NULL, 2, 'eliminar_funcion_accion_pantalla'),
(20, 'acciones_envio_correo', 'acciones_envio_correo', 'Env&iacute;o Correo', 'icon-email', '{*procesar_envio_correo*}', '{\"nombre\":\"acciones_envio_correo\",\"etiqueta\":\"Envio Correo\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para enviar un correo\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_envio_correo\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Enviar correo\"}', 'mostrar_acciones_correo', 'Acciones pantalla', 1, NULL, 2, 'eliminar_funcion_envio_correo'),
(21, 'acciones_transferir', 'acciones_transferir', 'Transferir', 'icon-transferir', '{*procesar_transferir*}', '{\"nombre\":\"acciones_transferir\",\"etiqueta\":\"Transferencia\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para transferir un documento\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_transferir\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Enviar correo\"}', 'mostrar_acciones_transferir', 'Documento', 1, NULL, 2, 'eliminar_funcion_transferir'),
(22, 'conector_hidden', 'conector_hidden', 'Hidden', 'icon-hidden', '{*procesar_conector_hidden*}', '{\"nombre\":\"conector_hidden\",\"etiqueta\":\"Conector hidden\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a\",\"ayuda\":\"Conector de un registro con otro\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"conector_hidden\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"\"}', NULL, 'Conectores', 1, NULL, 1, ''),
(23, 'conector_highslide', 'conector_highslide', 'Highslide-busqueda', 'icon-highslide', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\">\n    <div id=\"{*nombre*}\" class=\"highslide\" style=\"cursor:pointer;\" name=\"{*nombre*}\">{*etiqueta*}\n    </div>\n    <script type=\"text/javascript\">\n    $(document).ready(function(){\n      hs.graphicsDir = \"{*obtener_ruta_db_superior*}anexosdigitales/highslide-4.0.10/highslide/graphics/\";\n      hs.outlineType = \"rounded-white\";\n      $(\"#{*nombre*}\").click(function(e){\n        e.preventDefault();\n        {*procesar_conector_highslide*}\n      });\n    });    \n    </script>\n  </div>\n</div>', '{\"nombre\":\"conector_highslide\",\"etiqueta\":\"Conector hidden\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Conector de un registro con otro highslide\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"conector_highslide\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"\"}', NULL, 'Conectores', 1, 'anexosdigitales/highslide-4.0.10/highslide/highslide.css@h,anexosdigitales/highslide-4.0.10/highslide/highslide-full.js@h', 1, ''),
(25, 'acciones_confirmar_documento', 'acciones_confirmar_documento', 'Confirmar', 'icon-confirmar_documento', '{*procesar_confirmar_documento*}', '{\"nombre\":\"acciones_confirmar_documento\",\"etiqueta\":\"Confirmar documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Accion necesaria para confirmar documento\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_confirmar_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Confirmar documento\"}', 'mostrar_acciones_confirmar_documento', 'Documento', 1, NULL, 2, 'eliminar_acciones_confirmar_documento'),
(26, 'acciones_redireccionar', 'acciones_redireccionar', 'Redireccionar', 'icon-redireccionar', '{*procesar_redireccionar*}', '{\"nombre\":\"acciones_redireccionar\",\"etiqueta\":\"Redireccionar\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Accion necesaria para redireccionar despues de guardar\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_redireccionar\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Redireccionar\"}', NULL, 'Acciones pantalla', 1, NULL, 2, 'eliminar_acciones_redireccionar'),
(27, 'seguimiento_documento', 'seguimiento_documento', 'Hacer seguimiento a documento', 'icon-email', '{*procesar_seguimiento_documento*}', '{\"nombre\":\"seguimiento_documento\",\"etiqueta\":\"Hacer seguimiento documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para hacer el seguimiento a un documento\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"seguimiento_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Hacer seguimiento de documento\"}', 'mostrar_acciones_seguimiento_documento', 'Acciones pantalla', 1, NULL, 2, 'eliminar_funcion_seguimiento_documento'),
(28, 'contador', 'contador', 'Contador', 'icon-contador', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">\n  {*clase_eliminar_pantalla_componente*} \n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\"> \n		<div id=\"\" class=\"input-append\">\n			<input id=\"{*nombre*}\" type=\"text\" value=\"{*procesar_contador*}\" class=\"\" style=\"width:70px\" name=\"{*nombre*}\">\n<button class=\"btn\" type=\"button\" style=\"height:27px\" id=\"up_{*nombre*}\">+</button>\n<button class=\"btn\" type=\"button\" style=\"height:27px\" id=\"down_{*nombre*}\">-</button>\n		</div>\n  </div>\n</div>\n<script>\n$(document).ready(function(){\n    $(\"#up_{*nombre*}\").click(function(){\nvar campo=$(\"#{*nombre*}\").val();\nif(parseInt(campo)||campo==0)$(\"#{*nombre*}\").val(parseInt(campo)+1);\nelse $(\"#{*nombre*}\").val(0);\n    });\n$(\"#down_{*nombre*}\").click(function(){\nvar campo=$(\"#{*nombre*}\").val();\nif(parseInt(campo)||campo==0)$(\"#{*nombre*}\").val(parseInt(campo)-1);\nelse $(\"#{*nombre*}\").val(0);\n    });\n});\n</script>', '{\"nombre\":\"contador\",\"etiqueta\":\"Contador\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"contador\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"\"}', NULL, 'Texto', 1, '', 1, ''),
(29, 'usuario_actual', 'usuario_actual', 'Usuario actual', 'icon-hidden', '{*procesar_usuario_actual*}', '{\"nombre\":\"usuario_actual\",\"etiqueta\":\"Usuario actual\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"usuario_actual\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Usuario actual\"}', '', 'Acciones pantalla', 1, NULL, 1, ''),
(30, 'ruta_documento', 'ruta_documento', 'Ruta documento', 'icon-highslide', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\r\n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\r\n  </label>\r\n  <div class=\"controls\">\r\n    {*procesar_ruta_documento*}\r\n  </div>\r\n</div>', '{\"nombre\":\"ruta_documento\",\"etiqueta\":\"Ruta del documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"ruta_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Ruta del documento\"}', '', 'Documento', 1, 'anexosdigitales/highslide-4.0.10/highslide/highslide.css@h,anexosdigitales/highslide-4.0.10/highslide/highslide-full.js@h', 2, ''),
(31, 'ruta_fija_documento', 'ruta_fija_documento', 'Ruta Fija documento', 'icon-highslide', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\n  <label class=\"control-label\" for=\"{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\">\n    {*procesar_ruta_fija_documento*}\n  </div>\n</div>', '{\"nombre\":\"ruta_documento\",\"etiqueta\":\"Ruta fija del documento\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"ruta_fija_documento\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Ruta fija del documento\"}', '', 'Documento', 1, 'anexosdigitales/highslide-4.0.10/highslide/highslide.css@h,anexosdigitales/highslide-4.0.10/highslide/highslide-full.js@h', 2, ''),
(32, 'acciones_tarea_bpmni', 'acciones_tarea_bpmni', 'Instanciar Tarea BPMN', 'icon-email', '{*procesar_tarea_bpmni*}', '{\"nombre\":\"acciones_tarea_bpmni\",\"etiqueta\":\"Tarea BPMN\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"Acciones Necesarias para generar tarea instancia BPM\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"acciones_tarea_bpmni\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":0,\"placeholder\":\"Tarea instancia BPMN\"}', 'mostrar_tarea_bpmni', 'Acciones BPMN', 1, NULL, 2, 'eliminar_funcion_tarea_bpmni'),
(33, 'remitente', 'remitente', 'Remitente', 'icon-remitente', '<div class=\"control-group element\" idpantalla_componente=\"{*idpantalla_componente*}\" idpantalla_campo=\"{*idpantalla_campos*}\" id=\"pc_{*idpantalla_campos*}\" nombre=\"{*nombre_componente*}\">{*clase_eliminar_pantalla_componente*}\n  <label class=\"control-label\" for=\"label_{*nombre*}\"><b>{*etiqueta*}{*obligatoriedad*}</b>\n  </label>\n  <div class=\"controls\">\n    {*procesar_remitente*}\n    <script type=\"text/javascript\">\n    $(document).ready(function(){\n	  hs.graphicsDir = \"{*obtener_ruta_db_superior*}highslide/graphics/\";\n      hs.outlineType = \"rounded-white\";\n      $(\"#capa_{*nombre*}\").live(\"click\",function(e){\n		e.preventDefault();\n        hs.htmlExpand(this, { objectType: \'iframe\',width: 700, height: 500,contentId:\'cuerpo_paso\', preserveContent:false, src:\'{*obtener_ruta_db_superior*}pantallas/buscador_principal.php?idbusqueda=87&variable_busqueda={*nombre*}\',outlineType: \'rounded-white\',wrapperClassName: \'highslide-wrapper drag-header\'});\n      });\n    });    \n    </script>\n  </div>\n</div>', '{\"nombre\":\"remitente\",\"etiqueta\":\"Remitente\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"remitente\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"\"}', 'mostrar_remitente', 'Remitente', 1, 'anexosdigitales/highslide-4.0.10/highslide/highslide.css@h,anexosdigitales/highslide-4.0.10/highslide/highslide-full.js@h,pantallas/generador/remitente/funciones_remitente.php', 1, '');");
    	$conn->commit();
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $table = $schema->getTable('pantalla');
        $table->dropColumn("cuerpo_pantalla");
        $table->dropColumn("accion_eliminar");
        $schema->dropTable('formato_libreria');
        $table = $schema->getTable('campos_formato');
        $table->dropColumn("placeholder");
        $table = $schema->getTable('pantalla_componente');
        $table->dropColumn("etiqueta_html");
        $this->addSql("Truncate pantalla_componente");
    }
    private function buscar_busqueda($nombre) {
        if (empty($nombre)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idbusqueda,ruta_libreria from busqueda where nombre = :nombre", [
            'nombre' => $nombre
        ]);

        $idbusq = null;
        if (!empty($result)) {
            return($result[0]);
        } else {
            die("No es posible realizar la actualizacion porque la busqueda con nombre ".$nombre." no existe");
        }
        return(false);
    }

    private function guardar_componente($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);

        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda_componente"];
        } else {
            $resp = $conn->insert('busqueda_componente', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_componente");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }

    private function guardar_condicion($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idbusqueda_condicion from busqueda_condicion where etiqueta_condicion  = :etiqueta_condicion", [
            'etiqueta_condicion' => $datos["etiqueta_condicion"]
        ]);

        $idbusq = null;
        if (!empty($result)) {
            $idbusq = $result[0]["idbusqueda_condicion"];
        } else {
            $resp = $conn->insert('busqueda_condicion', $datos);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_condicion");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }

    private function buscar_modulo($datos) {
        if (empty($datos)) {
            return false;
        }

        $conn = $this->connection;

        $result = $conn->fetchAll("select idmodulo from modulo where nombre = :nombre", [
            'nombre' => $datos
        ]);

        $idmodulo = null;
        print_r($result);
        if (!empty($result)) {
            $idmodulo = $result[0]["idmodulo"];
            return($idmodulo);
        } else {
            die("El modulo ".$nombre." debe existir para realizar la actualizacion");        
        }
        return false;
    }

}
