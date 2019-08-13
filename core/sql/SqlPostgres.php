<?php
class SqlPostgres extends Sql implements ISql
{

	public function __construct()
	{
		return parent::__construct();
	}

	function connect()
	{
		throw new Exception("Error Processing Request", 1);
	}

	/**
	 * ejecuta una consulta
	 *
	 * @param string $sql
	 * @param integer $start limite inicial
	 * @param integer $end limite final
	 * @return array
	 */
	public function search($sql, $start = 0, $end = 0)
	{
		$response = [];
		$result = $end ? $this->Ejecutar_Limit($sql, $start, $end) : $this->query($sql);

		while (($row = $this->sacar_fila($result)) !== false) {
			$response[] = $row;
		}

		$this->liberar_resultado($result);
		return $response;
	}

	function liberar_resultado($rs)
	{
		if (!$rs) {
			$rs = $this->res;
		}
		@pg_free_result($rs);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>ejecutar_sql_postgres
	 * <Parametros>sql-cadena con el codigo a ejecutar
	 * <Responsabilidades>ejecutar el comando recibido en la cadena sql
	 * <Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
	 * la matriz con los valores del resultado se obtiene por medio de la función Resultado
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
	 */
	function query($sql)
	{
		$strsql = trim($sql);
		$strsql = str_replace(" =", "=", $strsql);
		$strsql = str_replace("= ", "=", $strsql);
		$accion = strtoupper(substr($strsql, 0, strpos($strsql, ' ')));
		if ($accion == "INSERT" || $accion == "UPDATE") {
			$this->ultimoInsert = 0;
			$sql = htmlentities($sql, ENT_NOQUOTES, "UTF-8", false);
			$sql = htmlspecialchars_decode($sql, ENT_NOQUOTES);
		}

		$this->filas = 0;
		if ($sql && $sql != "" && $this->connection) {
			// Quitar "from dual".
			$sql = preg_replace("/from\s+dual\s*$/i", "", $sql);
			$this->res = pg_query($this->connection, $sql); // or die("ERROR SQL " . pg_last_error($this->connection) . " en " . $_SERVER["PHP_SELF"] . " ->" . $sql); // or error//("Error al Ejecutar: $sql --- ".postgres_error());

			if ($this->res) {
				if (strpos(strtolower($sql), "insert") !== false)
					$this->ultimoInsert = $this->Ultimo_Insert();
				else if (strpos(strtolower($sql), "select") !== false) {
					$this->ultimoInsert = 0;
					$this->filas = pg_num_rows($this->res);
				} else {
					$this->ultimoInsert = 0;
				}

				$this->consulta = trim($sql);
				// $fin=strpos($this->consulta," ");
				// $accion=substr($this->consulta,0,$fin);
			}
			return ($this->res);
		}
	}

	function sacar_fila($rs = Null)
	{
		if ($rs) {
			$this->res = $rs;
		}
		// $arreglo = @pg_fetch_array($this->res, null, PGSQL_BOTH) or die("ERROR PG_FETCH ".pg_last_error($rs)." en ".$_SERVER["PHP_SELF"]);

		if ($arreglo = @pg_fetch_array($this->res, null, PGSQL_BOTH)) {
			$this->filas++;
			return ($arreglo);
		} else {
			return (FALSE);
		}
	}

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
	function Nombre_Campo($rs, $pos)
	{
		return pg_field_name($rs, $pos);
	}

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
	function Lista_Tabla($db)
	{
		$this->res = pg_query($this->connection, "SHOW TABLES") or die("Error en la Ejecucución del Proceso SQL: " . pg_last_error($this->connection));
		while ($row = pg_fetch_row($this->res))
			$resultado[] = $row[0];
		return ($resultado);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Busca_Tabla
	 * <Parametros>tabla-nombre de la tabla a examinar
	 * <Responsabilidades>Retornar en una matriz la lista de los campos de una tabla
	 * <Notas>
	 * <Excepciones>
	 * <Salida>matriz con la lista de los campos de una tabla
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Busca_tabla($tabla, $campo = "")
	{
		if (!$tabla && @$_REQUEST["tabla"])
			$tabla = $_REQUEST["tabla"];
		if (!$tabla)
			return (false);
		$where_campo = '';
		if ($campo != '') {
			$where_campo = " AND column_name='" . $campo . "'";
		}

		$this->consulta = "select * from information_schema.columns where table_schema = 'public' AND table_name  = '$tabla'" . $where_campo;
		$this->res = pg_query($this->connection, $this->consulta);
		$resultado = array();
		$i = 0;
		$resultado = array();
		for (; ($arreglo = $this->sacar_fila($this->res)); $i++) {
			$arreglo = array_change_key_case($arreglo, CASE_LOWER);
			array_push($resultado, $arreglo);
		}
		asort($resultado);
		$resultado["numcampos"] = $i;
		if ($i) {
			return $resultado;
		} else {
			return (FALSE);
		}
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Ejecutar_Limit
	 * <Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
	 * $conn-objeto de tipo sql
	 * <Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
	 * <Notas>Funciona igual que Buscar_postgres pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
	 * <Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
	 * <Salida>una matriz con los "limit" resultados de la busqueda
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// devuelve los registro en el rango $inicio:$fin de la consulta, para postgres
	function Ejecutar_Limit($sql, $inicio, $fin)
	{
		$cuantos = $fin - $inicio + 1;
		if ($inicio < 0)
			$inicio = 0;

		$consulta = "$sql LIMIT $cuantos OFFSET $inicio";
		$consulta = str_replace("key", "'key'", $consulta);
		// echo $consulta;
		$res = pg_query($this->connection, $consulta); // or die("consulta fallida ".pg_last_error($conn->connection));
		return ($res);
	}

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
	function Numero_Campos($rs)
	{
		if (!$rs) {
			return (0);
		}
		return ($rs->field_count);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Ultimo_Insert
	 * <Parametros>
	 * <Responsabilidades>Retornar el identificador del ultimo registro insertado
	 * <Notas>se utiliza después de la función insert
	 * <Excepciones>
	 * <Salida>identificador del ultimo registro insertado
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Ultimo_Insert()
	{
		if ($this->ultimoInsert) {
			return $this->ultimoInsert;
		}
		$insert_query = pg_query($this->connection, "SELECT lastval()");
		$insert_row = pg_fetch_row($this->connection, $insert_query);
		$insert_id = $insert_row[0];
		return $insert_id;
	}

	function resta_fechas($fecha1, $fecha2)
	{
		if ($fecha2 == "")
			$fecha2 = "now()";
		return "DATE_PART('day', $fecha1::date) - DATE_PART('day', $fecha2::date) ";
		// return "$fecha1-$fecha2 ";
	}

	static function fecha_db_almacenar($fecha, $formato = NULL)
	{
		if (is_object($fecha)) {
			$fecha = $fecha->format($formato);
		}

		if (!$fecha || $fecha == "") {
			$fecha = date($formato);
		}
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		$mystring = $fecha;
		$findme = 'TO_DATE';
		$pos = strpos($mystring, $findme);
		if ($pos === false) {
			$reemplazos = array(
				'M' => 'MON',
				'H' => 'HH24',
				'd' => 'DD',
				'm' => 'MM',
				'Y' => 'YYYY',
				'y' => 'YY',
				'h' => 'HH',
				'i' => 'MI',
				's' => 'SS',
				'yyyy' => 'YYYY'
			);
			$resfecha = $formato;
			foreach ($reemplazos as $ph => $mot) { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
				$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
				/*
				 * $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
				 * $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
				 * $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
				 * $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
				 * $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
				 */
			}

			$fsql = "TO_DATE('$fecha','$resfecha')";
		} else {
			$fsql = $fecha;
		}
		return $fsql;
	}

	// Fin Funcion fecha_db_almacenar
	static function fecha_db_obtener($campo, $formato = NULL)
	{
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		$reemplazos = array(
			'Y' => 'YYYY',
			'yyyy' => 'YYYY',
			'd' => 'DD',
			'M' => 'MON',
			'm' => 'MM',
			'y' => 'YY',
			'H' => 'HH24',
			'h' => 'HH',
			'i' => 'MI',
			's' => 'SS'
		);
		$resfecha = $formato;
		foreach ($reemplazos as $ph => $mot) { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
			$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
			// $resfecha=ereg_replace("$ph", "$mot", $resfecha);
		}
		$fsql = "TO_CHAR($campo,'$resfecha')";
		return $fsql;
	}

	// Fin Funcion fecha_db_obtener
	function mostrar_error()
	{
		if ($this->error != "")
			echo ($this->error . " en \"" . $this->consulta . "\"");
	}

	function suma_fechas($fecha1, $cantidad, $tipo = "")
	{
		if ($tipo == "")
			$tipo = 'DAY';
		return "DATE_ADD($fecha1, INTERVAL $cantidad $tipo)";
	}

	function resta_horas($fecha1, $fecha2)
	{
		if ($fecha2 == "")
			$fecha2 = "CURDATE()";
		return "timediff($fecha1,$fecha2)";
	}

	// /Recibe la fecha inicial y la fecha que se debe controlar o fecha de referencia, si tiempo =1 es que la fecha iniicial esta por encima ese tiempo de la fecha de control ejemplo si fecha_inicial=2010-11-11 y fecha_control=2011-12-11 quiere decir que ha pasado 1 año , 1 mes y 0 dias desde la fecha inicial a la de control
	function compara_fechas($fecha_control, $fecha_inicial)
	{
		if (!strlen($fecha_control)) {
			$fecha_control = date('Y-m-d');
		}
		$resultado = $this->ejecuta_filtro_tabla("SELECT " . $this->resta_fechas("'" . $fecha_control . "'", "'" . $fecha_inicial . "'") . " AS diff");
		return ($resultado);
	}

	function invocar_radicar_documento($iddocumento, $idcontador, $funcionario)
	{
		$strsql = "select sp_asignar_radicado($iddocumento, $idcontador, $funcionario)";
		$this->query($strsql) or die($strsql);
	}

	function listar_campos_tabla($tabla = NULL, $tipo_retorno = 0)
	{
		if ($tabla == NULL)
			$tabla = $_REQUEST["tabla"];
		$datos_tabla = $this->query("DESCRIBE " . $tabla);
		while ($fila = phpmkr_fetch_array($datos_tabla)) { // print_r($fila);
			if ($tipo_retorno) {
				$lista_campos[] = array_map(strtolower, $fila);
			} else {
				$lista_campos[] = strtolower($fila[0]);
			}
		}
		return ($lista_campos);
	}

	function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log = 1)
	{
		$resultado = TRUE;
		if ($tipo == "archivo") {
			$sql = "update $tabla set $campo='" . addslashes($contenido) . "' where $condicion";
			pg_query($this->connection, $sql);
			// TODO verificar resultado de la insecion $resultado=FALSE;
		} elseif ($tipo == "texto") {
			$contenido = codifica_encabezado($contenido);
			$sql = "update $tabla set $campo='" . addslashes(stripslashes($contenido)) . "' where $condicion";
			if ($log) {
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
				$llave = trim($resultados[1]);
				$anterior = $this->ejecuta_filtro_tabla("select $campo from $tabla where $condicion");
				$sql_anterior = "update $tabla set $campo='" . addslashes(stripslashes($anterior[0][0])) . "' where $condicion";

				$sqleve = "INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('" . usuario_actual("funcionario_codigo") . "','" . date('Y-m-d H:i:s') . "','MODIFICAR', '$tabla', $llave, '0','" . addslashes($sql_anterior) . "','" . addslashes($sql) . "')";
				$this->query($sqleve);
				$registro = $this->Ultimo_Insert();
				if ($registro) {
					$archivo = "$registro|||" . usuario_actual("funcionario_codigo") . "|||" . date('Y-m-d H:i:s') . "|||MODIFICAR|||$tabla|||0|||" . addslashes($sql_anterior) . "|||$llave|||" . addslashes($sql);
					evento_archivo($archivo);
				}
			}
			pg_query($this->connection, $sql) or die(pg_last_error($this->connection));
		}
		return ($resultado);
	}

	public function campo_formato_tipo_dato($tipo_dato, $longitud, $predeterminado, $banderas = null)
	{
		switch (strtoupper(@$tipo_dato)) {
			case "NUMBER":
				$campo .= " numeric";
				if ($longitud) {
					$campo .= "(" . intval($longitud) . ",0) ";
				} else {
					$campo .= "(10,0) ";
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
			case "DOUBLE":
				$campo .= " double";
				if ($longitud) {
					$campo .= "(" . intval($longitud) . ") ";
				} else {
					$campo .= "";
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
			case "CHAR":
				$campo .= " char ";
				if ($longitud) {
					$campo .= "(" . $this->maximo_valor(intval($longitud), 255) . ") ";
				} else {
					$campo .= "(10) ";
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . $this->maximo_valor(intval($predeterminado), 255) . "' ";
				}
				break;
			case "VARCHAR":
				$campo .= " varchar";
				if ($longitud) {
					$campo .= "(" . $this->maximo_valor(intval($longitud), 255) . ") ";
				} else {
					$campo .= "(255) ";
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
			case "TEXT":
				if ($longitud == "")
					$longitud = 4000;
				$campo .= " text ";
				break;
			case "DATE":
				$campo .= " date ";
				// $campo .= " DEFAULT now()";
				break;
			case "TIME":
				$campo .= " time ";
				break;
			case "DATETIME":
				$campo .= " timestamp ";
				$campo .= " DEFAULT  now()";
				break;
			case "BLOB":
				$campo .= " bytea ";
				break;
			default:
				$campo .= " integer ";
				$pos = strpos($banderas, 'pk');
				if ($pos !== false) {
					$campo .= ' SERIAL ';
				}

				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
		}
	}

	public function formato_crear_indice($bandera, $nombre_campo, $nombre_tabla)
	{
		$nombre_tabla = strtolower($nombre_tabla);
		$nombre_campo = strtolower($nombre_campo);

		$nombre_seq = $nombre_tabla . "_" . $nombre_campo . "_seq";
		if (strlen($nombre_tabla) > 26) {
			$aux = substr($nombre_tabla, 0, 26);
		} else {
			$aux = $nombre_tabla;
		}
		$this->filas = 0;

		switch (strtolower($bandera)) {
			case "pk":

				$sql2 = $this->ejecuta_filtro_tabla("SELECT last_value AS ultimo from " . $nombre_seq);

				if ($sql2["numcampos"]) {
					$siguiente = $sql2[0]["ultimo"];

					$inicio = $siguiente;
					$dato = "DROP SEQUENCE " . $nombre_seq . " CASCADE";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
				} else {
					$inicio = 1;
				}
				// $dato = "CREATE INDEX PK_" . $nombre_campo . " ON " . $nombre_tabla . "(" . $nombre_campo . ") LOGGING TABLESPACE " . TABLESPACE . " PCTFREE 10 INITRANS 2 MAXTRANS 255 STORAGE (INITIAL 128K MINEXTENTS 1 MAXEXTENTS 2147483645 PCTINCREASE 0 BUFFER_POOL DEFAULT) NOPARALLEL";
				// guardar_traza($dato, $nombre_tabla);
				// $this->Ejecutar_sql($dato);
				if ($this->verificar_existencia($nombre_tabla)) {
					$dato = "CREATE SEQUENCE " . $nombre_seq . " INCREMENT 1 START " . $inicio . " MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
					$dato = "ALTER TABLE $nombre_tabla ALTER COLUMN $nombre_campo SET DEFAULT nextval('$nombre_seq')";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
					$dato = "ALTER TABLE " . $nombre_tabla . " ADD CONSTRAINT PK_" . $nombre_campo . "  PRIMARY KEY (" . $nombre_campo . ")";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
				}

				// $dato = "CREATE OR REPLACE TRIGGER " . $aux . "_TRG BEFORE INSERT OR UPDATE ON " . $nombre_tabla . " FOR EACH ROW BEGIN IF INSERTING AND :NEW." . $nombre_campo . " IS NULL THEN SELECT " . $aux . "_SEQ.NEXTVAL INTO :NEW." . $nombre_campo . " FROM DUAL; END IF; END;";
				// guardar_traza($dato, $nombre_tabla);
				// $this->Ejecutar_sql($dato);
				break;
			case "u":
				if ($this->verificar_existencia($nombre_tabla)) {
					$dato = "ALTER TABLE " . $nombre_tabla . " ADD CONSTRAINT U_" . $nombre_campo . " UNIQUE( " . $nombre_campo . " )";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
				}
				break;
			case "i":
				$campo2 = $nombre_tabla . "_" . $nombre_campo;
				/*if (strlen($campo2) > 15) {
					$campo2 = str_replace("FT_", "", substr($campo2, 0, 15));
				}*/
				$index_name = "i_" . $campo2;
				$index_name = strtolower($index_name);
				$existe = $this->ejecuta_filtro_tabla("select * from pg_indexes where indexname like '$index_name'");
				if (!$existe["numcampos"]) {
					$dato = "CREATE INDEX i_" . $campo2 . " ON " . $nombre_tabla . " (" . $nombre_campo . ") TABLESPACE " . TABLESPACE;
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
				}

				break;
		}
	}

	public function formato_generar_tabla_motor($idformato, $formato, $campos_tabla, $campos, $tabla_esta)
	{
		$lcampos = array();
		if (!$tabla_esta) {
			$sql_tabla = "CREATE TABLE " . strtolower($formato[0]["nombre_tabla"]) . "(";
		} else {
			$this->formato_elimina_indices_tabla($formato[0]["nombre_tabla"]);
		}
		for ($i = 0; $i < $campos["numcampos"]; $i++) {
			if (MOTOR == "Oracle") {
				$datos_campo = ejecuta_filtro_tabla("SELECT CASE is_nullable WHEN 'YES' THEN 1 ELSE 0 END as nulo FROM information_schema.columns WHERE table_schema = 'public' AND table_name='" . $formato[0]["nombre_tabla"] . "' and column_name='{$campos[$i]["nombre"]}' ORDER BY column_name ASC", $conn);

				if ($datos_campo[0]["nulo"] != $campos[$i]["obligatoriedad"]) {
					if ($formato[0]["nombre_tabla"]) {
						$sql = "ALTER TABLE " . $formato[0]["nombre_tabla"] . " ALTER COLUMN " . $campos[$i]["nombre"];
						if (!$campos[$i]["obligatoriedad"]) {
							$sql .= " DROP NOT NULL";
						} else {
							$sql .= " SET NOT NULL";
						}
						guardar_traza($sql, $formato[0]["nombre_tabla"]);
						$this->query($sql);
					}
				}
			}

			$dato_campo = $this->crear_campo($campos[$i], $formato[0]["nombre_tabla"], $datos_campo);
			if ($dato_campo && $dato_campo != "") {
				if (!$tabla_esta) {
					array_push($lcampos, $dato_campo);
				} else {
					$pos = array_search(strtolower($campos[$i]["nombre"]), $campos_tabla);
					$dato = "";

					if ($pos === false) {
						if ($formato[0]["nombre_tabla"]) {
							$dato = "ALTER TABLE " . strtolower($formato[0]["nombre_tabla"]) . " ADD " . $dato_campo;
						}
					} else {
						if ($formato[0]["nombre_tabla"]) {
							$dato = "ALTER TABLE " . strtolower($formato[0]["nombre_tabla"]) . " TYPE " . $dato_campo;
						}
					}
					guardar_traza($dato, $formato[0]["nombre_tabla"]);
					$this->query($dato);
				}
			}
		}
		// die();
		return $lcampos;
	}

	public function formato_elimina_indices_tabla($tabla)
	{
		global $conn, $sql;
		$tabla = strtoupper($tabla);
		$envio = array();
		$sql2 = "select ai.index_name AS column_name, ai.uniqueness AS Key_name FROM all_indexes ai WHERE ai.TABLE_OWNER='" . DB . "' AND ai.table_name = '" . $tabla . "'";
		$sql2 = "SELECT tc.constraint_name,
				tc.constraint_type,
				tc.table_name,
				kcu.column_name,
				tc.is_deferrable,
				tc.initially_deferred
				FROM information_schema.table_constraints tc
				LEFT JOIN information_schema.key_column_usage kcu ON tc.constraint_catalog = kcu.constraint_catalog
					AND tc.constraint_schema = kcu.constraint_schema
					AND tc.constraint_name = kcu.constraint_name
				LEFT JOIN information_schema.referential_constraints rc ON tc.constraint_catalog = rc.constraint_catalog
					AND tc.constraint_schema = rc.constraint_schema
					AND tc.constraint_name = rc.constraint_name
				WHERE tc.table_schema = 'public'
				and tc.table_catalog = '" . DB . "'
				and kcu.column_name is not null
				AND tc.table_name = '$tabla'";
		$indices = ejecuta_filtro_tabla($sql2, $conn);
		for ($i = 0; $i < $indices["numcampos"]; $i++) {
			array_push($envio, array(
				"constraint_type" => $indices[$i]["constraint_type"],
				"constraint_name" => $indices[$i]["constraint_name"],
				"column_name" => $indices[$i]["column_name"]
			));
		}
		$numero_indices = count($envio);

		for ($i = 0; $i < $numero_indices; $i++) {
			$this->elimina_indice_campo($tabla, $envio[$i]);
		}
		return;
	}

	public function elimina_indice_campo($tabla, $campo)
	{
		global $conn;

		if ($this->verificar_existencia($tabla)) {
			$sql = "ALTER TABLE " . strtolower($tabla) . " DROP CONSTRAINT " . $campo["constraint_name"];
			guardar_traza($sql, strtolower($tabla));
			$this->query($sql);
			echo ($sql . "<br />");
		}
		return;
	}

	public function verificar_existencia($tabla)
	{
		$sql = "SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = 'public' AND table_name = '$tabla') as existe";
		$existe = $this->ejecuta_filtro_tabla($sql);
		if ($existe["numcampos"]) {
			return ($existe[0]["existe"] == 't');
		}
		return false;
	}

	public function concatenar_cadena($arreglo_cadena)
	{
		return (implode("||", $arreglo_cadena));
	}
}
