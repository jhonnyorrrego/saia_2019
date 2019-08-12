<?php
abstract class Sql
{
	public $connection = null;
	public $motor;
	public $host;
	public $usuario;
	public $password;
	public $nombreDb;
	public $db;
	public $puerto;
	public $res = null;
	protected $consulta;
	protected $error = null;
	protected $nombres_campos = [];
	protected $tipos_campos = [];
	protected $numcampos = null;
	protected $numfilas = null;
	protected $ultimoInsert = null;
	protected $filas = 0;

	/**
	 * instancia de sql segun el motor
	 *
	 * @var object
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019
	 */
	private static $instance;

	/**
	 * inicio del proceso
	 * seteo credenciales y conecto la db
	 *
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019
	 */
	function __construct()
	{
		$this->setAttributes();
		$this->connect();
	}

	/**
	 * setea las credenciales de la base de datos
	 *
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019-06-20
	 */
	public function setAttributes()
	{
		$this->motor = MOTOR;
		$this->host = HOST;
		$this->usuario = USER;
		$this->password = PASS;
		$this->nombreDb = BASEDATOS;
		$this->db = DB;
		$this->puerto = PORT;
	}

	/**
	 * obtiene la instancia de sql, en caso de no
	 * existir la genera
	 *
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019-06-19
	 */
	public static function getInstance($newInstance = false)
	{
		if (!Sql::$instance || $newInstance) {
			switch (MOTOR) {
				case "MySql":
					Sql::$instance = new SqlMysql();
					break;
				case "Oracle":
					Sql::$instance = new SqlOracle();
					break;
				case "SqlServer":
					Sql::$instance = new SqlSqlServer();
					break;
				case "MSSql":
					Sql::$instance = new SqlMsSql();
					break;
				case "Postgres":
					Sql::$instance = new SqlPostgres();
					break;
				default:
					Sql::$instance = null;
					break;
			}
		}

		return Sql::$instance;
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
	function Numero_Filas($rs = null)
	{
		return $this->filas;
	}

	protected function ejecuta_filtro_tabla($sql2)
	{
		$retorno = array();
		$rs = $this->Ejecutar_Sql($sql2);
		// or alerta("Error en Busqueda de Proceso SQL: $sql2");
		$temp = $this->sacar_fila($rs);
		$i = 0;
		if ($temp) {
			array_push($retorno, $temp);
			$i++;
		}
		for ($temp; $temp = $this->sacar_fila($rs); $i++) {
			array_push($retorno, $temp);
		}
		$retorno["numcampos"] = $i;
		$retorno["sql"] = $sql2;
		$this->liberar_resultado($rs);
		return ($retorno);
	}

	protected function maximo_valor($valor, $maximo)
	{
		if ($valor > $maximo || $valor == "NULL") {
			return ($maximo);
		}
		return ($valor);
	}

	public function formato_generar_tabla($idformato, $formato)
	{
		$resp = array("estado" => "KO", "mensaje" => "Error en formato_generar_tabla");
		$datos_tabla = $this->Busca_tabla($formato[0]["nombre_tabla"]);
		$tabla_esta = $datos_tabla["numcampos"];
		if ($datos_tabla["numcampos"]) {
			for ($i = 0; $i < $datos_tabla["numcampos"]; $i++) {
				$datos_tabla[$i] = array_change_key_case($datos_tabla[$i], CASE_LOWER);
			}
			$campos_tabla = extrae_campo($datos_tabla, "field", "U,m"); // esto es para saber si existe el campo o no.
		} else {
			$campos_tabla = array();
		}

		$this->crear_campos_basicos_formato($idformato, $formato);
		// 20160916 FIN Agregar el campo estado_documento si no existe
		$campos = $this->ejecuta_filtro_tabla("select * from campos_formato A where A.formato_idformato=" . $idformato);
		if (empty($campos["numcampos"])) {
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
	protected function crear_indices_tabla($formato)
	{
		$campos = $this->ejecuta_filtro_tabla("select * from campos_formato where formato_idformato=" . $formato . " AND (banderas IS NOT NULL OR banderas<>'')");
		$tabla = $this->ejecuta_filtro_tabla("select nombre_tabla from formato where idformato=" . $formato);
		for ($i = 0; $i < $campos["numcampos"]; $i++) {
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
	protected function crear_indice($todas_banderas, $nombre_campo, $nombre_tabla)
	{
		if (empty($nombre_campo)) {
			throw new Exception();
		}
		$nombre_tabla = strtoupper($nombre_tabla);
		$nombre_campo = strtoupper($nombre_campo);
		$banderas = explode(",", $todas_banderas);
		for ($j = 0; $j < count($banderas); $j++) {
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
	protected function crear_campo($datos_campo, $tabla, $estructura_campo = null)
	{
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

	protected function crear_campos_basicos_formato($idformato, $formato)
	{
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
			$sqldoc = "INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,obligatoriedad,banderas,acciones,etiqueta_html,valor,orden) VALUES('" . $idformato . "','dependencia','DEPENDENCIA DEL CREADOR DEL DOCUMENTO','INT','11','1','i,fdc','a,e','hidden','{*buscar_dependencia*}',1)";
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
