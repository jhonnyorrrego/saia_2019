<?php
class SqlMsSql extends Sql implements ISql
{

	public function __construct()
	{
		return parent::__construct();
	}

	function connect()
	{
		$this->connection = mssql_connect($this->host, $this->usuario, $this->password) or print_r(mssql_get_last_message());
		mssql_query("USE " . $this->db, $this->connection);
	}

	function disconnect()
	{
		return mssql_close($this->connection);
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
		@mssql_free_result($rs);
	}

	function query($sql)
	{
		$strsql = trim($sql);
		$strsql = str_replace(" =", "=", $strsql);
		$strsql = str_replace("= ", "=", $strsql);
		$accion = strtoupper(substr($strsql, 0, strpos($strsql, ' ')));
		if ($accion == "INSERT" || $accion == "UPDATE") {
			$sql = htmlentities($sql, ENT_NOQUOTES, "UTF-8", false);
			$sql = htmlspecialchars_decode($sql, ENT_NOQUOTES);
		}

		$this->filas = 0;
		if ($sql && $sql != "") {
			// mssql_query("USE ".$this->db,$this->connection);
			$this->res = mssql_query($sql, $this->connection);
			if (!$this->res) {
				// La consulta ha fallado, muestra un mensaje de error
				// utilizando mssql_get_last_message()
				die('MSSQL error: ' . mssql_get_last_message() . " " . $sql);
			} // or die($sql);
			// echo $sql.'<br />';
			// print_r(mssql_get_last_message());
			if ($this->res) {
				if ($this->res != 1)
					$filas = mssql_num_rows($this->res);
				if (strpos(strtolower($sql), "insert") !== false)
					$this->ultimoInsert = $this->Ultimo_Insert();
				else if (strpos(strtolower($sql), "select") !== false) {
					$this->ultimoInsert = 0;
					$this->filas = $filas;
				} else {
					$this->ultimoInsert = 0;
				}

				$this->consulta = trim($sql);
				$fin = strpos($this->consulta, " ");
				$accion = substr($this->consulta, 0, $fin);
			}
			return ($this->res);
		}
	}

	function sacar_fila($rs = Null)
	{
		if ($rs)
			$this->res = $rs;
		if ($arreglo = @mssql_fetch_array($this->res, MSSQL_BOTH)) {
			$this->filas++;
			return (array_map("trim", $arreglo));
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
		$dato = mssql_field_name($rs, $pos);
		return ($dato);
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
		mssql_query("USE " . $this->db, $this->connection);
		$this->res = mssql_query("select name AS nombre from sysobjects where type='U'", $this->connection) or die("Error en la Ejecucucion del Proceso MSSQL: " . mssql_get_last_message());
		while ($row = mssql_fetch_array($this->res, MSSQL_NUM))
			$resultado[] = $row[0];
		asort($resultado);
		return ($resultado);
	}

	function Busca_tabla($tabla, $campo = "")
	{
		if (!$tabla && @$_REQUEST["tabla"])
			$tabla = $_REQUEST["tabla"];
		else if (!$tabla)
			return (false);
		$this->consulta = "select COLUMN_NAME from information_schema.columns WHERE TABLE_NAME LIKE '" . $tabla . "'";
		// echo "select * from information_schema.columns WHERE TABLE_NAME LIKE '".$tabla."'<br />";
		mssql_query("USE " . $this->db, $this->connection) or die($this->consulta);
		$this->res = mssql_query($this->consulta, $this->connection);
		while ($row = mssql_fetch_array($this->res, MSSQL_NUM))
			$resultado[] = $row[0];
		asort($resultado);
		return ($resultado);
	}

	function Ejecutar_Limit($sql, $inicio, $fin)
	{
		$consulta = trim($sql);
		$search = array(
			"ORDER BY",
			"order by"
		);
		$replace = array(
			"order by",
			"order by"
		);
		if (strpos(str_replace($search, $replace, $consulta), "order by") > 0) {
			$sql_count = substr($consulta, 0, strpos(str_replace($search, $replace, $consulta), "order by"));
			$parte_orden = substr($consulta, strpos(str_replace($search, $replace, $consulta), "order by"));

			$array_order = explode(",", $parte_orden);
			$cant = count($array_order);
			$orders = array();
			for ($i = 0; $i < $cant; $i++) {
				$valor = explode(".", $array_order[$i]);
				if (strpos(trim($array_order[$i]), ".") > 0) {
					if ($i == 0) {
						$orders[] = "order by " . $valor[1];
					} else {
						$orders[] = $valor[1];
					}
				} else {
					$orders[] = $valor[0];
				}
			}
			$order = implode(",", $orders);
		} else {
			$sql_count = $consulta;
			$order = "order by (select 1)";
		}

		mssql_query("USE " . $this->db, $this->connection);
		$complemento = substr($sql_count, strpos($sql_count, ' '));
		/*
		 * $sql_cantidad="SELECT COUNT(*) as cant FROM (".$sql_count.") cantidad_reg";
		 * $res_cant=mssql_query($sql_cantidad,$conn->connection) or die("consulta fallida ---- $sql_cantidad ");
		 * $total=mssql_fetch_array($res_cant,MSSQL_NUM);
		 * $cant=intval($total[0]);
		 */
		// $select=str_replace("/*union*/", "TOP ".$cant, "SELECT TOP ".$cant.$complemento); //UTILIZADO PARA LOS UNION
		$select = "SELECT " . $complemento;
		if ($fin < ($inicio + 1)) {
			$fin = ($inicio + 1);
		}
		$consulta = "WITH informacion_tabla AS(
	SELECT *,ROW_NUMBER() OVER(" . $order . ") as numfila__oculto FROM (" . $select . ") datos
	) SELECT * FROM informacion_tabla WHERE numfila__oculto BETWEEN " . ($inicio + 1) . " AND " . ($fin);

		$res = mssql_query($consulta, $this->connection) or die("consulta fallida ---- $consulta ");
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
		$numero = mssql_num_fields($rs);
		return ($numero);
	}

	function Ultimo_Insert()
	{
		mssql_query("USE " . $this->db, $this->connection);
		$this->res = mssql_query("SELECT @@identity", $this->connection) or print_r(mssql_get_last_message());
		$total = mssql_fetch_array($this->res, MSSQL_NUM) or print_r(mssql_get_last_message());
		return ($total[0]);
	}

	function resta_fechas($fecha1, $fecha2)
	{
		if ($fecha2 == "")
			$fecha2 = "CURRENT_TIMESTAMP";
		return "DATEDIFF(DAY,$fecha2,$fecha1)";
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

		// solo se relacionan los principales si se requiere de cualquier otro se debe adicionar al switch
		switch ($formato) {
			case 'Y-m-d H:i:s':
				$fsql = "CONVERT(datetime,'" . $fecha . "',20)";
				break;
			case 'Y-m-d H:i':
				$fsql = "CONVERT(datetime,'" . $fecha . "',20)";
				break;
			case 'H:i:s':
				$fsql = "CONVERT(time,'" . $fecha . "',20)";
				break;
			case 'd-m-y':
				$fsql = " CONVERT(datetime, '" . $fecha . "', 3) ";
				break;
			default:
				// deafault Y-m-d Standar
				$fsql = "CONVERT(datetime,'" . $fecha . "',20)";
				break;
		}
		return $fsql;
	}

	// Fin Funcion fecha_db_almacenar
	static function fecha_db_obtener($campo, $formato = NULL)
	{
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		// solo se relacionan los principales si se requiere de cualquier otro se debe adicionar al switch
		switch ($formato) {
			case 'Y-m-d H:i:s':
				$fsql = "CONVERT(CHAR(19)," . $campo . ",120) ";
				break;
			case 'Y-m-d H:i':
				$fsql = "CONVERT(CHAR(16)," . $campo . ",20)";
				break;
			case 'H:i:s':
				$fsql = "CONVERT(CHAR(8)," . $campo . ",108)";
				break;
			case 'h:i:s':
				$fsql = "SUBSTRING(CONVERT(CHAR(20)," . $campo . ",100),12,20)";
				break;
			case 'd/m/Y-H:i:s':
				$fsql = "CONVERT(CHAR(255)," . $campo . ",103)+'-'+SUBSTRING(CONVERT(CHAR(20)," . $campo . ",100),12,20)";
				break;
			default:
				// deafault Y-m-d Standar
				$fsql = " CONVERT(VARCHAR(10), " . $campo . ", 120) ";
				break;
		}
		return $fsql;
	}

	function mostrar_error()
	{
		if ($this->error != "")
			echo ($this->error["message"] . " en \"" . $this->consulta . "\"");
	}

	function suma_fechas($fecha1, $cantidad, $tipo = "")
	{
		if ($tipo == "")
			$tipo = 'DAY';
		return "DATEADD($tipo,$cantidad,$fecha1)";
	}

	function resta_horas($fecha1, $fecha2)
	{
		if ($fecha2 == "")
			$fecha2 = "CURRENT_TIMESTAMP";
		return "DATEDIFF(HOUR,$fecha2,$fecha1)";
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
		$strsql = "EXEC sp_asignar_radicado @iddoc=$iddocumento, @tipo=$idcontador, @funcionario=$funcionario;";
		$this->query($strsql) or die($strsql);
	}

	function listar_campos_tabla($tabla = NULL, $tipo_retorno = 0)
	{
		return ($this->Busca_Tabla());
	}

	function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log = 1)
	{
		$resultado = TRUE;
		if ($tipo == "archivo") {
			$dato = busca_filtro_tabla("$campo", "$tabla", "$condicion", "", $this);
			// CODIFICA EL ARCHIVO PARA SER GUARDADO
			$fileData = $contenido;
			$fileData = unpack("H*hex", $fileData);
			$content = "0x" . $fileData['hex'];

			if ($dato[0][0] == "") {
				$sql = "UPDATE " . $tabla . " SET " . $campo . " .write(convert(varbinary(max),'XXX'),0,NULL) WHERE " . $condicion;
				$this->ejecutar_sql($sql);
			}
			$sql = "UPDATE " . $tabla . " SET " . $campo . " = " . $content . " WHERE " . $condicion;
			$this->ejecutar_sql($sql);
		} elseif ($tipo == "texto") {
			$contenido = codifica_encabezado($contenido);
			$sql = "update $tabla set $campo='" . str_replace("'", '"', stripslashes($contenido)) . "' where $condicion";
			if ($log) {
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
				$llave = trim($resultados[1]);
				$anterior = busca_filtro_tabla("$campo", "$tabla", "$condicion", "", $this);
				$sql_anterior = "update $tabla set $campo='" . str_replace("'", '"', stripslashes($anterior[0][0])) . "' where $condicion";
				$sqleve = "INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('" . usuario_actual("funcionario_codigo") . "','" . date('Y-m-d H:i:s') . "','MODIFICAR', '$tabla', $llave, '0','" . addslashes($sql_anterior) . "','" . addslashes($sql) . "')";
				$this->query($sqleve);
				$registro = $this->Ultimo_Insert();
				if ($registro) {
					$archivo = "$registro|||" . usuario_actual("funcionario_codigo") . "|||" . date('Y-m-d H:i:s') . "|||MODIFICAR|||$tabla|||0|||" . addslashes($sql_anterior) . "|||$llave|||" . addslashes($sql);
					evento_archivo($archivo);
				}
			}
			if (MOTOR == "SqlServer") {
				sqlsrv_query($this->connection, "USE " . $this->db);
				sqlsrv_query($this->connection, $sql) or die("consulta fallida ---- $sql " . implode("<br />", sqlsrv_errors()));
			} else {
				mssql_query($sql, $this->connection) or die("consulta fallida ---- $sql " . implode("<br />", mssql_get_last_message()));
			}
		}

		return ($resultado);
	}

	public function campo_formato_tipo_dato($tipo_dato, $longitud, $predeterminado, $banderas = null)
	{
		switch (strtoupper(@$tipo_dato)) {
			case "NUMBER":
				$campo .= " decimal ";
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
				$campo .= " FLOAT";
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
				$campo .= " text";
				break;
			case "DATE":
				$campo .= " DATETIME ";
				$campo .= " DEFAULT  getdate()";
				break;
			case "TIME":
				$campo .= " DATETIME ";
				break;
			case "DATETIME":
				$campo .= " DATETIME ";
				$campo .= " DEFAULT  getdate()";
				break;
			case "BLOB":
				$campo .= " varBinary(MAX) ";
				break;
			default:
				$campo .= " int ";
				$pos = strpos($banderas, 'pk');
				if ($pos !== false) {
					$campo .= ' IDENTITY(1,1) NOT NULL ';
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
		}
		return $campo;
	}

	public function formato_crear_indice($bandera, $nombre_campo, $nombre_tabla)
	{
		$nombre_tabla = strtoupper($nombre_tabla);
		$nombre_campo = strtoupper($nombre_campo);
		$traza = array();
		if (strlen($nombre_tabla) > 26) {
			$aux = substr($nombre_tabla, 0, 26);
		} else {
			$aux = $nombre_tabla;
		}
		$dato = "";
		switch ($bandera) {
			case "pk":
				// $datos_tabla=ejecuta_filtro_tabla("select c.* from syscolumns c, sysobjects o where c.status & 128 = 128 and o.id = c.id AND o.name='".$nombre_tabla."'",$conn);
				$dato = "ALTER TABLE " . strtolower($nombre_tabla) . " ADD CONSTRAINT PK_" . strtoupper($nombre_campo) . "_" . rand() . " PRIMARY KEY CLUSTERED( " . strtolower($nombre_campo) . ")";
				break;
			case "u":
				$dato = "ALTER TABLE " . $nombre_tabla . " ADD CONSTRAINT UQ_" . strtoupper($nombre_campo) . "_" . rand() . " UNIQUE( " . $nombre_campo . " )";
				break;
			case "i":
				$dato = "CREATE UNIQUE NONCLUSTERED INDEX (I_" . strtoupper($nombre_campo) . "_" . rand() . ") ON " . $nombre_tabla . "( " . $nombre_campo . " )";
				break;
		}
		$this->Ejecutar_sql($dato);
		return $traza;
	}

	public function formato_generar_tabla_motor($idformato, $formato, $campos_tabla, $campos, $tabla_esta)
	{
		$lcampos = array();
		for ($i = 0; $i < $campos["numcampos"]; $i++) {

			$dato_campo = $this->crear_campo($campos[$i], $formato[0]["nombre_tabla"], $datos_campo);
			if ($dato_campo && $dato_campo != "") {
				if (!$tabla_esta) {
					array_push($lcampos, $dato_campo);
				} else {
					$pos = array_search(strtolower($campos[$i]["nombre"]), $campos_tabla);
					$dato = "";

					if ($pos === false) {
						$dato = "ALTER TABLE " . strtolower($formato[0]["nombre_tabla"]) . " ADD " . $dato_campo;
					} else {
						$dato = "ALTER TABLE " . strtolower($formato[0]["nombre_tabla"]) . " ALTER COLUMN " . $dato_campo;
					}
					if ($dato != "") {
						guardar_traza($dato, $formato[0]["nombre_tabla"]);
						$this->query($dato);
					}
				}
			}
		}
		// die();
		return $lcampos;
	}

	public function formato_elimina_indices_tabla($tabla)
	{
		$tabla = strtoupper($tabla);
		$sql2 = "SELECT name AS column_name FROM sys.objects WHERE type_desc LIKE '%CONSTRAINT' AND OBJECT_NAME(parent_object_id)='" . $tabla . "'";
		$indices = $this->ejecuta_filtro_tabla($sql2);
		$numero_indices = count($indices);
		for ($i = 0; $i < $numero_indices; $i++) {
			$this->elimina_indice_campo($tabla, $indices[$i]);
		}
		return;
	}

	public function elimina_indice_campo($tabla, $campo)
	{
		global $conn;
		$sql = "ALTER TABLE " . strtolower($tabla) . " DROP CONSTRAINT " . $campo["Column_name"];
		$this->Ejecutar_sql($sql);
		return;
	}

	public function verificar_existencia($tabla)
	{
		$sql = "SELECT COUNT(table_name) FROM information_schema.tables WHERE table_name = '$tabla'";
		$rs = $this->Ejecutar_sql($sql);
		$fila = $this->sacar_fila($rs);
		if ($fila) {
			return ($fila["existe"] > 0);
		}
		return false;
	}

	public function concatenar_cadena($arreglo_cadena)
	{
		return (implode("+", $arreglo_cadena));
	}
}
