<?php
include_once ("conexion.php");
include_once ("SqlMysql.php");
include_once ("SqlSqlServer.php");
include_once ("SqlOracle.php");
include_once ("SqlMsSql.php");
include_once ("SqlPostgres.php");
use SqlMysql;
use SqlSqlServer;
use SqlOracle;
use SqlMsSql;
use Gaufrette\Exception;

abstract class SQL2 {
	protected $consulta;
	protected $motor;
	public $Conn;
	public $res = NULL;
	protected $error = NULL;
	protected $nombres_campos = array();
	protected $tipos_campos = array();
	protected $numcampos = NULL;
	protected $numfilas = NULL;
	public $ultimo_insert = NULL;
	protected $filas = 0;

	/*
	 * <Clase>SQL
	 * <Nombre>SQL.
	 * <Parametros>conn Recibe el objeto que tiene la conexion; motorBd Es el motor de base de datos que se está utilizando.
	 * <Responsabilidades>Constructor de la clase SQL.
	 * <Notas> Asocia las variables de la clase conexion que llegan como parametros con los de la clase SQL.
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>debe existir una conexion a la base de datos
	 * <Post-condiciones>
	 */
	public function __construct($conn, $motorBd) {
		$this->Conn = $conn;
		$this->motor = $motorBd;
	}

	public function __init($conn, $motorBd) {
		$this->Conn = $conn;
		$this->motor = $motorBd;
	}

	/**
	 * Segundo constructor a partir de una ruta_servidor
	 *
	 * @param unknown $server_path
	 * @return SaiaStorage
	 */
	public static function get_instance($conn, $motorBd) {
		$instance = null;
		switch ($motorBd) {
			case "MySql" :
				$instance = new SqlMysql($conn, $motorBd);
				break;
			case "Oracle" :
				$instance = new SqlOracle($conn, $motorBd);
				break;
			case "SqlServer" :
				$instance = new SqlSqlServer($conn, $motorBd);
				break;
			case "MSSql" :
				$instance = new SqlMsSql($conn, $motorBd);
				break;
			case "Postgres" :
				$instance = new SqlPostgres($conn, $motorBd);
				break;
		}

		// $instance->__init($server_path);
		return $instance;
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Buscar.
	 * <Parametros>campos-las columnas a buscar; tablas-las tablas en las que se hará la búsqueda;
	 * where-el filtro de la búsqueda; order_by-parametro para el orden.
	 * <Responsabilidades>Enmascarar una búsqueda de tipo select para cualquier motor,
	 * dependiendo del motor llama a la funcion que corresponda.
	 * <Notas>
	 * <Excepciones> las generadas por errores en la consulta, o permisos sobre las bd
	 * <Salida>devuelve una matriz con el resultado de la consulta
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Buscar($campos, $tablas, $where, $order_by);

	/*
	 * <Clase>SQL
	 * <Nombre>ejecutar_sql.
	 * <Parametros>sql-cadena con el codigo a ejecutar
	 * <Responsabilidades>dependiendo del motor llama la función que ejecutar el comando recibido en la cadena sql
	 * <Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
	 * <Salida>el objeto de conexion
	 * <Pre-condiciones>
	 * <Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
	 */
	function Ejecutar_Sql_Noresult($sql) {
		$sql = html_entity_decode(htmlentities(utf8_decode($sql)));
		return $this->Ejecutar_Sql($sql, "2");
	}

	public abstract function liberar_resultado($rs);

	/*
	 * <Clase>SQL
	 * <Nombre>ejecutar_sql.
	 * <Parametros>sql-cadena con el codigo a ejecutar
	 * <Responsabilidades>dependiendo del motor llama la función que ejecutar el comando recibido en la cadena sql
	 * <Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
	 * <Salida>una matriz con los resultados de la consulta, indices numericos y asociativos
	 * <Pre-condiciones>
	 * <Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
	 */
	public abstract function Ejecutar_Sql($sql);

	public abstract function sacar_fila($rs);

	public abstract function sacar_fila_vector($rs);

	/*
	 * <Clase>SQL
	 * <Nombre>Insertar.
	 * <Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se hará la inserción;
	 * valores-los valores a insertar
	 * <Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la inserción
	 * <Notas>Enmascarada para agregar otros motores de bases de datos
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Insertar($campos, $tabla, $valores);

	/*
	 * <Clase>SQL
	 * <Nombre>Modificar.
	 * <Parametros>tabla-nombre de la tabla donde se hará la modificacion;
	 * actualizaciones-Aquellos registros que serán modificados y sus nuevos valores;
	 * where-filtro de los registros que serán modificados
	 * <Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la modificacion
	 * <Notas>Enmascarada para agregar otros motores de bases de datos
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Modificar($tabla, $actualizaciones, $where);

	/*
	 * <Clase>SQL
	 * <Nombre>ejecutar_sql_tipo.
	 * <Parametros>sql-cadena con el codigo a ejecutar
	 * <Responsabilidades>según el motor llamar a la función que ejecutará la cadena sql
	 * <Notas>el vector retornado es del tipo. resultado[0]='campo',resultado[1]='valor_campo'...
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// ejecuta un sql que debe devuelve un solo registro
	public abstract function Ejecutar_Sql_Tipo($sql);

	/*
	 * <Clase>SQL
	 * <Nombre>Eliminar.
	 * <Parametros>tabla-nombre de la tabla donde se hará la eliminacion; where-cuales son los registros a eliminar
	 * <Responsabilidades>Llamar a la funcion que corresponda al motor de base de datos para realizar la eliminacion
	 * <Notas>Enmascarada para agregar otros motores de bases de datos
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Eliminar($tabla, $where);

	/*
	 * <Clase>SQL
	 * <Nombre>Rows_Count
	 * <Parametros>
	 * <Responsabilidades>Retornar el número de filas afectadas en la última consulta
	 * <Notas>se utiliza después de la función Insertar
	 * <Excepciones>
	 * <Salida>número de filas devueltas en la última consulta
	 * <Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
	 * <Post-condiciones>
	 */
	function Rows_Count() {
		mysqli_affected_rows($this->res);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Numero_Filas
	 * <Parametros>
	 * <Responsabilidades>Retornar el número de filas devueltas en la última consulta
	 * <Notas>se utiliza después de la función ejecutar_sql
	 * <Excepciones>
	 * <Salida>número de filas devueltas en la última consulta
	 * <Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
	 * <Post-condiciones>
	 */
	function Numero_Filas($rs = Null) {
		return ($this->filas);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Tipo_Campo
	 * <Parametros>pos-posición del campo en el array resultado
	 * <Responsabilidades>llama a la funcion requerida dependiendo del motor de bd
	 * <Notas>se utiliza después de la función ejecutar_sql
	 * <Excepciones>
	 * <Salida>tipo del campos especificado
	 * <Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
	 * <Post-condiciones>
	 */
	public abstract function Tipo_Campo($rs, $pos);

	/*
	 * <Clase>SQL
	 * <Nombre>Nombre_Campo
	 * <Parametros>pos-posición del campo en el array resultado
	 * <Responsabilidades>llama a la funcion requerida dependiendo del motor de bd
	 * <Notas>se utiliza después de la función ejecutar_sql
	 * <Excepciones>
	 * <Salida>nombre del campos especificado
	 * <Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
	 * <Post-condiciones>
	 */
	public abstract function Nombre_Campo($rs, $pos);

	/*
	 * <Clase>SQL
	 * <Nombre>Lista_Tabla
	 * <Parametros>db-nombre de la base de datos a listar
	 * <Responsabilidades>Retornar en una matriz las tablas de la base de datos especificada
	 * <Notas>
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Lista_Tabla($db);

	/*
	 * <Clase>SQL
	 * <Nombre>Busca_Tabla
	 * <Parametros>tabla-nombre de la tabla a examinar
	 * <Responsabilidades>segun el motor llama la función correspondiente
	 * <Notas>
	 * <Excepciones>
	 * <Salida>matriz con la lista de los campos de una tabla
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Busca_tabla($tabla, $campo);

	/*
	 * <Clase>SQL
	 * <Nombre>Buscar_Limit
	 * <Parametros>campos-los campos a buscar; tablas-tablas donde se realizará la busqueda;
	 * where-filtro de la búsqueda; order_by-columna para el orden; limit-numero de registros a recuperar
	 * <Responsabilidades>segun el motor llama la función correspondiente
	 * <Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
	 * <Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
	 * <Salida>una matriz con los "limit" resultados de la busqueda
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// devuelve los primeros $limit registros de la consulta en un array
	public abstract function Ejecutar_Limit($sql, $inicio, $fin);

	/*
	 * <Clase>SQL
	 * <Nombre>total_registros_tabla.
	 * <Parametros>tabla-nombre de la tabla a consultar
	 * <Responsabilidades>llama a la función deseada
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del comando generará una excepcion
	 * <Salida>devuelve un entero con el numero de filas de la tabla
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Total_Registros_Tabla($tabla);

	/*
	 * <Clase>SQL
	 * <Nombre>Numero_Campos
	 * <Parametros>
	 * <Responsabilidades>segun el motor llama la función deseada
	 * <Notas>se utiliza después de la hacer una consulta de seleccion (select)
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Numero_Campos($rs);

	// Fin Funcion General Ultimo Insert

	/*
	 * <Clase>SQL
	 * <Nombre>Ultimo_Insert
	 * <Parametros>
	 * <Responsabilidades>segun el motor llama la función deseada
	 * <Notas>se utiliza después de la función insert
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public abstract function Ultimo_Insert();

	public abstract function Guardar_log($strsql);

	public abstract function resta_fechas($fecha1, $fecha2);

	public abstract function fecha_db_almacenar($fecha, $formato);

	public abstract function fecha_db_obtener($campo, $formato);

	public abstract function mostrar_error();

	public abstract function fecha_db($campo, $formato);

	public abstract function case_fecha($dato, $compara, $valor1, $valor2);

	public abstract function suma_fechas($fecha1, $cantidad, $tipo);

	public abstract function resta_horas($fecha1, $fecha2);

	public abstract function fecha_actual($fecha1, $fecha2);

	public abstract function compara_fechas($fecha_control, $fecha_inicial);

	protected function ejecuta_filtro_tabla($sql2) {
		$retorno = array();
		$rs = $this->Ejecutar_Sql($sql2); // or alerta("Error en Busqueda de Proceso SQL: $sql2");
		$temp = $this->sacar_fila($rs);
		$i = 0;
		if ($temp) {
			array_push($retorno, $temp);
			$i++;
		}
		for($temp; $temp = $this->sacar_fila($rs); $i++) {
			array_push($retorno, $temp);
		}
		$retorno["numcampos"] = $i;
		$retorno["sql"] = $sql2;
		$this->liberar_resultado($rs);
		return ($retorno);
	}

	protected function maximo_valor($valor, $maximo) {
		if ($valor > $maximo || $valor == "NULL") {
			return ($maximo);
		}
		return ($valor);
	}

	public abstract function listar_campos_tabla($tabla, $tipo_retorno);

	public abstract function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log);

	public abstract function campo_formato_tipo_dato($tipo_dato, $longitud, $predeterminado, $banderas = null);

	public abstract function formato_crear_indice($bandera, $nombre_campo, $nombre_tabla);

	protected abstract function formato_elimina_indices_tabla($tabla);

	/*
	 * <Clase>
	 * <Nombre>elimina_indice_campo</Nombre>
	 * <Parametros>$tabla:define la tabla donde se debe hacer el cambio;$campo:arreglo que debe contener los siguentes parametros:
	 * Key_name:Nombre o tipo de LLave de la llave.
	 * Column_name: Nombre de la Columna.</Parametros>
	 * <Responsabilidades>Elimina el indice seleccionado<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	protected abstract function elimina_indice_campo($tabla, $campo);

	protected abstract function verificar_existencia($tabla);

	protected abstract function formato_generar_tabla_motor($idformato, $formato, $campos_tabla, $campos, $tabla_esta);

	public function formato_generar_tabla($idformato, $formato) {
		$resp = array("estado" => "KO", "mensaje" => "Error en formato_generar_tabla");
		$datos_tabla = $this->Busca_tabla($formato[0]["nombre_tabla"]);
		$tabla_esta = $datos_tabla["numcampos"];
		for($i = 0; $i < $datos_tabla["numcampos"]; $i++) {
			$datos_tabla[$i] = array_change_key_case($datos_tabla[$i], CASE_LOWER);
		}
		if ($datos_tabla["numcampos"]) {
			$campos_tabla = extrae_campo($datos_tabla, "field", "U,m"); // esto es para saber si existe el campo o no.
		} else {
			$campos_tabla = array();
		}

		$this->crear_campos_basicos_formato($idformato, $formato);
		// 20160916 FIN Agregar el campo estado_documento si no existe
		$campos = $this->ejecuta_filtro_tabla("select * from campos_formato A where A.formato_idformato=" . $idformato);
		if (!$campos["numcampos"]) {
			$resp["estado"] = "KO";
			$resp["mensaje"] = "Problemas al Generar la tabla, No existen Campos";
			return $resp;
		}

		if ($tabla_esta) {
			$this->formato_elimina_indices_tabla($formato[0]["nombre_tabla"]);
		}

		$lcampos = $this->formato_generar_tabla_motor($idformato, $formato, $campos_tabla, $campos, $tabla_esta);

		if (!$tabla_esta) {
			$sql_tabla = "CREATE TABLE " . strtolower($formato[0]["nombre_tabla"]) . "(";

			$sql_tabla .= implode(",", $lcampos);
			$sql_tabla .= ") ";
			guardar_traza($sql_tabla, $formato[0]["nombre_tabla"]);

			if ($this->Ejecutar_Sql($sql_tabla)) {
				$this->crear_indices_tabla($formato[0]["idformato"]);
				$resp["estado"] = "OK";
				$resp["mensaje"] = "Tabla " . $formato[0]["nombre_tabla"] . " Generada con Exito";
			} else {
				$resp["estado"] = "KO";
				$resp["mensaje"] = "No es posible Generar la tabla para el Formato " . $sql_tabla . "<br />" . $this->mostrar_error();
				return $resp;
			}
		} else {
			$this->crear_indices_tabla($formato[0]["idformato"]);
			$resp["estado"] = "OK";
			$resp["mensaje"] = "Indices para la tabla " . $formato[0]["nombre_tabla"] . " Generados con Exito";
		}
		return $resp;
	}

	/*
	 * <Clase>
	 * <Nombre>crear_indices_tabla</Nombre>
	 * <Parametros>$formato:id del formato</Parametros>
	 * <Responsabilidades>Busca en la configuraci�n de los campos los que deben ser indices y llama la funci�n que los crea<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	protected function crear_indices_tabla($formato) {
		$campos = $this->ejecuta_filtro_tabla("select * from campos_formato where formato_idformato=" . $formato . " AND (banderas IS NOT NULL OR banderas<>'')");
		$tabla = $this->ejecuta_filtro_tabla("select nombre_tabla from formato where idformato=" . $formato);
		for($i = 0; $i < $campos["numcampos"]; $i++) {
			$this->crear_indice($campos[$i]["banderas"], $campos[$i]["nombre"], $tabla[0]["nombre_tabla"]);
		}
	}

	/*
	 * <Clase>
	 * <Nombre>crear_indice</Nombre>
	 * <Parametros>$todas_banderas:cadena de texto con las banderas del campo separadas por comas;$nombre_campo:nombre del campo;$nombre_tabla:nombre de la tabla donde se va a crear el indice</Parametros>
	 * <Responsabilidades>Crea los indices en la tabla y campo especificados segun la informaci�n del campo bandera, el cual indica que tipo de indices se deben crear<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	protected function crear_indice($todas_banderas, $nombre_campo, $nombre_tabla) {
		if(empty($nombre_campo)) {
			throw new Exception();
		}
		$nombre_tabla = strtoupper($nombre_tabla);
		$nombre_campo = strtoupper($nombre_campo);
		$banderas = explode(",", $todas_banderas);
		for($j = 0; $j < count($banderas); $j++) {
			$this->formato_crear_indice($banderas[$j], $nombre_campo, $nombre_tabla);
		}
	}

	/*
	 * <Clase>
	 * <Nombre>crear_campo</Nombre>
	 * <Parametros>$datos_campo:vector con los datos de configuracion del campo, guardados en campos_formato;$tabla:tabla a la que pertenece el campo;$estructura_campo:estructura actual del campo en la base de datos</Parametros>
	 * <Responsabilidades>Compara los datos actuales del campo con la nueva configuraci�n y realiza los cambios necesarios<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	protected function crear_campo($datos_campo, $tabla, $estructura_campo = null) {
		$campo = "";

		if ($datos_campo["nombre"]) {
			if (!is_numeric($datos_campo["nombre"]))
				$campo .= strtolower(str_replace(" ", "_", trim($datos_campo["nombre"])));
			else
				return (false);
		}
		if ($datos_campo["etiqueta_html"] == "etiqueta") {
			return false;
		}
		$campo .= $this->campo_formato_tipo_dato($datos_campo["tipo_dato"], $datos_campo["longitud"], $datos_campo["predeterminado"], $datos_campo["banderas"]);
		// Valida si se uso por defecto int(11) o number(11)
		if ((MOTOR == "MySql" || MOTOR == "Oracle") && empty($datos_campo["longitud"]) && preg_match("/(int\(|NUMBER\()11/", $campo)) {
			$sql = "UPDATE campos_formato SET longitud=11 WHERE idcampos_formato=" . $datos_campo["idcampos_formato"];
			guardar_traza($sql, $tabla);
			$this->Ejecutar_Sql($sql);
		}

		if ($estructura_campo["nulo"] != $datos_campo["obligatoriedad"] && MOTOR == "MySql") {
			if (!$datos_campo["obligatoriedad"])
				$campo .= " NULL ";
			else
				$campo .= " NOT NULL ";
		}

		return ($campo);
	}

	protected function crear_campos_basicos_formato($idformato, $formato) {
		$pos = $this->ejecuta_filtro_tabla("select nombre from campos_formato where formato_idformato=" . $idformato . " and nombre='id{$formato[0]["nombre_tabla"]}'");
		if (!$pos["numcampos"]) {
			$sqlid = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html) VALUES('" . $idformato . "','id{$formato[0]["nombre_tabla"]}','" . strtoupper($formato[0]["nombre"]) . "','INT','11','1','ai,pk','a,e','hidden')";
			guardar_traza($sqlid, $formato[0]["nombre_tabla"]);
			$this->Ejecutar_Sql($sqlid) or die($sqlid);
		}
		$pos = $this->ejecuta_filtro_tabla("select nombre from campos_formato where formato_idformato=" . $idformato . " and nombre='documento_iddocumento'");
		if (!$pos["numcampos"] && !$formato[0]["item"]) {
			$sqldoc = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html) VALUES('" . $idformato . "','documento_iddocumento','DOCUMENTO ASOCIADO','INT','11','1','i','a,e','hidden')";
			guardar_traza($sqldoc, $formato[0]["nombre_tabla"]);
			$this->Ejecutar_Sql($sqldoc) or die($sqldoc);
		}
		$pos = $this->ejecuta_filtro_tabla("select nombre from campos_formato where formato_idformato=$idformato and nombre='dependencia'");
		if (!$pos["numcampos"] && !$formato[0]["item"]) {
			$sqldoc = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,valor) VALUES('" . $idformato . "','dependencia','DEPENDENCIA DEL CREADOR DEL DOCUMENTO','INT','11','1','i,fdc','a,e','hidden','{*buscar_dependencia*}')";
			guardar_traza($sqldoc, $formato[0]["nombre_tabla"]);
			$this->Ejecutar_Sql($sqldoc) or die($sqldoc);
		}
		$pos = $this->ejecuta_filtro_tabla("select nombre from campos_formato where formato_idformato=" . $idformato . " and nombre='encabezado'");
		if (!$pos["numcampos"] && !$formato[0]["item"]) {
			$sqldoc = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,acciones,etiqueta_html,predeterminado) VALUES('" . $idformato . "','encabezado','ENCABEZADO','INT','11','1','a,e','hidden',1)";
			guardar_traza($sqldoc, $formato[0]["nombre_tabla"]);
			$this->Ejecutar_Sql($sqldoc) or die($sqldoc);
		}
		$pos = $this->ejecuta_filtro_tabla("select nombre from campos_formato where formato_idformato=" . $idformato . " and nombre='firma'");
		if (!$pos["numcampos"] && !$formato[0]["item"]) {
			$sqldoc = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,predeterminado) VALUES('" . $idformato . "','firma','FIRMAS DIGITALES','INT','11','1','','a,e','hidden',1)";
			guardar_traza($sqldoc, $formato[0]["nombre_tabla"]);
			$this->Ejecutar_Sql($sqldoc) or die($sqldoc);
		}
		// 20160916 Agregar el campo estado_documento si no existe
		$pos = $this->ejecuta_filtro_tabla("select nombre from campos_formato where formato_idformato=" . $idformato . " and nombre='estado_documento'");
		if (!$pos["numcampos"] && !$formato[0]["item"]) {
			$sqldoc = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,predeterminado) VALUES('" . $idformato . "','estado_documento','ESTADO DEL DOCUMENTO','INT','11','1','','a,e','hidden',1)";
			guardar_traza($sqldoc, $formato[0]["nombre_tabla"]);
			$this->Ejecutar_Sql($sqldoc) or die($sqldoc);
		}
	}

}
?>
