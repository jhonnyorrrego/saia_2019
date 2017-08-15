<?php
include_once ("conexion.php");

class SqlSqlServer extends SQL2 {

	public function __construct($conn, $motorBd) {
		parent::__construct($conn, $motorBd);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Buscar.
	 * <Parametros>campos-las columnas a buscar; tablas-las tablas en las que se hará la búsqueda;
	 * where-el filtro de la búsqueda; order_by-parametro para el orden.
	 * <Responsabilidades>ejecutar consulta de selección para mysql
	 * <Notas>
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
	 * <Salida>una matriz con los resultados de la consulta
	 * la matriz es del tipo: resultado[0]['campo']='valor'
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Buscar($campos, $tablas, $where, $order_by) {
		if ($campos == "" || $campos == null)
			$campos = "*";
		$this->consulta = "SELECT " . $campos . " FROM " . $tablas;
		if ($where != "" && $where != null)
			$this->consulta .= " WHERE " . $where;
		if ($order_by != "" && $order_by != null)
			$this->consulta .= " ORDER BY " . $order_by;
		// ejecucion de la consulta, a $this->res se le asigna el resource
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, $this->consulta);
		// se le asignan a $resultado los valores obtenidos
		if ($this->Numero_Filas() > 0) {
			for($i = 0; $i < $this->Numero_Filas(); $i++)
				$resultado[] = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_ASSOC);
			return $resultado;
		} else {// se retorna la matriz
			return (false);
		}
	}

	function liberar_resultado($rs) {
		if (!$rs) {
			$rs = $this->res;
		}
		@sqlsrv_cancel($rs);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>ejecutar_sql_MySql
	 * <Parametros>sql-cadena con el codigo a ejecutar
	 * <Responsabilidades>ejecutar el comando recibido en la cadena sql
	 * <Notas>Se utiliza generalmente para busquedas cuyos comandos se optienen de referencias que están en la base de datos,
	 * la matriz con los valores del resultado se obtiene por medio de la función Resultado
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>la matriz con los valores del resultado se obtiene por medio de la función Resultado
	 */
	function Ejecutar_Sql($sql) {
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
			sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
			$this->res = sqlsrv_query($this->Conn->conn, $sql, array(), array(
					"Scrollable" => SQLSRV_CURSOR_KEYSET
			));
			if ($this->res) {
				$filas = sqlsrv_num_rows($this->res) or print_r(sqlsrv_errors());
				if (strpos(strtolower($sql), "insert") !== false)
					$this->ultimo_insert = $this->Ultimo_Insert();
				else if (strpos(strtolower($sql), "select") !== false) {
					$this->ultimo_insert = 0;
					$this->filas = $filas;
				} else {
					$this->ultimo_insert = 0;
				}

				$this->consulta = trim($sql);
				$fin = strpos($this->consulta, " ");
				$accion = substr($this->consulta, 0, $fin);
			}
			return ($this->res);
		}
	}

	function sacar_fila($rs = Null) {
		if ($rs)
			$this->res = $rs;
		if ($arreglo = @sqlsrv_fetch_array($this->res, SQLSRV_FETCH_BOTH)) {
			$this->filas++;
			return ($arreglo);
		} else {
			return (FALSE);
		}
	}

	function sacar_fila_vector($rs = Null) {
		if ($rs == Null)
			$rs = $this->res;
		if ($arreglo = @sqlsrv_fetch_array($rs, SQLSRV_FETCH_NUMERIC)) {
			return ($arreglo);
		} else
			return (FALSE);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Insertar.
	 * <Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se hará la inserción;
	 * valores-los valores a insertar
	 * <Responsabilidades>Ejecutar una consulta del tipo insert en una base de datos sql server
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del INSERT generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Insertar($campos, $tabla, $valores) {
		if ($campos == "" || $campos == null)
			$insert = "INSERT INTO " . $tabla . " VALUES (" . $valores . ")";
		else
			$insert = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valores . ")";
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, $insert);
		$this->Guardar_log($insert);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Modificar.
	 * <Parametros>tabla-nombre de la tabla donde se hará la modificacion;
	 * actualizaciones-Aquellos registros que serán modificados y sus nuevos valores;
	 * where-filtro de los registros que serán modificados
	 * <Responsabilidades>Ejecutar una sentencia de tipo UPDATE en una base de datos Sql Server
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del UPDATE generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Modificar($tabla, $actualizaciones, $where) {
		$actualizaciones = html_entity_decode(htmlentities(utf8_decode($actualizaciones)));
		if ($where != null && $where != "")
			$update = "UPDATE " . $tabla . " SET " . $actualizaciones . " WHERE " . $where;
		else
			$update = "UPDATE " . $tabla . " SET " . $actualizaciones;
		$this->Guardar_log($update);
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, $update);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>ejecutar_sql_tipo.
	 * <Parametros>sql-cadena con el codigo a ejecutar
	 * <Responsabilidades>Ejecuta una consulta sql
	 * <Notas>el vector retornado es del tipo. resultado[0]='campo',resultado[1]='valor_campo'...
	 * <Excepciones>Cualquier problema que ocurra con la busqueda en la base de datos
	 * <Salida>un vector con los resultados de la consulta
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Ejecutar_Sql_Tipo($sql) {
		$sql = html_entity_decode(htmlentities(utf8_decode($sql)));
		$this->consulta = $sql;
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, $this->consulta);
		$this->Guardar_log($sql);
		while($fila = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_NUMERIC)) {
			foreach ( $fila as $valor )
				$resultado[] = $valor;
		}
		return $resultado;
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Eliminar.
	 * <Parametros>tabla-nombre de la tabla donde se hará la eliminacion; where-cuales son los registros a eliminar
	 * <Responsabilidades>Ejecutar una sentencia DELETE en una base de datos SqlServer
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del DELETE generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Eliminar($tabla, $where) {
		if ($where != null && $where != "")
			$delete = "DELETE FROM " . $tabla . " WHERE " . $where;
		else
			$delete = "DELETE FROM " . $tabla;
		// ejecucion de la consulta
		$this->Guardar_log($delete);
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, $delete);
		//
	}

	function Resultado() {
		$resultado["sql"] = $this->consulta;
		$resultado["numcampos"] = $this->Numero_Filas();
		if ($this->Numero_Filas() > 0) {
			for($i = 0; $i < $this->Numero_Filas(); $i++) {
				$resultado[$i] = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_ASSOC);
				$j = 0;
				foreach ( $resultado[$i] as $key => $valor ) {
					$resultado[$i][$j] = $resultado[$i][$key];
					$j++;
				}
			}
		}
		return $resultado;
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
	function Tipo_Campo($rs, $pos) {
		$dato = sqlsrv_field_metadata($rs);
		return ($dato[$pos]["Type"]);
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
	function Nombre_Campo($rs, $pos) {
		$dato = sqlsrv_field_metadata($rs);
		return ($dato[$pos]["Name"]);
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
	function Lista_Tabla($db) {
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, "select name AS nombre from sysobjects where type='U'");
		while($row = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_NUMERIC))
			$resultado[] = $row[0];
		asort($resultado);
		return ($resultado);
	}

	function Busca_tabla($tabla, $campo) {
		if (!$tabla && @$_REQUEST["tabla"])
			$tabla = $_REQUEST["tabla"];
		else if (!$tabla)
			return (false);
		if ($campo != "") {
			$this->consulta = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME like '" . $tabla . "' AND COLUMN_NAME='" . $campo . "'";
		} else {
			$this->consulta = "select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME like '" . $tabla . "'";
		}
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db) or die($this->consulta);
		$this->res = sqlsrv_query($this->Conn->conn, $this->consulta);
		while($row = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_NUMERIC))
			$resultado[] = $row[0];

		asort($resultado);
		return ($resultado);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Ejecutar_Limit
	 * <Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
	 * $conn-objeto de tipo sql
	 * <Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
	 * <Notas>Funciona igual que Buscar_SqlServer pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
	 * <Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
	 * <Salida>una matriz con los "limit" resultados de la busqueda
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// devuelve los registro en el rango $inicio:$fin de la consulta, para SqlServer
	function Ejecutar_Limit($sql, $inicio, $fin) {
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
			for($i = 0; $i < $cant; $i++) {
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

		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$complemento = substr($sql_count, strpos($sql_count, ' '));
		/*
		 * $sql_cantidad="SELECT COUNT(*) as cant FROM (".$sql_count.") cantidad_reg";
		 * $res_cant=sqlsrv_query($conn->Conn->conn,$sql_cantidad) or die("consulta fallida. ---- $sql_cantidad ");
		 * $total=sqlsrv_fetch_array($res_cant,SQLSRV_FETCH_NUMERIC);
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

		$res = sqlsrv_query($this->Conn->conn, $consulta) or die("consulta fallida. ---- $consulta ");
		return ($res);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>total_registros_tabla.
	 * <Parametros>tabla-nombre de la tabla a consultar
	 * <Responsabilidades>consultar el número total de registros de una tabla para SqlServer
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del comando generará una excepcion
	 * <Salida>devuelve un entero con el numero de filas de la tabla
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Total_Registros_Tabla($tabla) {
		$this->consulta = "SELECT COUNT( * ) AS TOTAL FROM " . $tabla;
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, $this->consulta);
		$total = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_NUMERIC);
		return ($total[0]);
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
	function Numero_Campos($rs) {
		if (!$rs) {
			return (0);
		}
		$numero = sqlsrv_num_fields($rs);
		return ($numero);
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
	function Ultimo_Insert() {
		sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
		$this->res = sqlsrv_query($this->Conn->conn, "SELECT @@identity") or print_r(sqlsrv_errors());
		$total = sqlsrv_fetch_array($this->res, SQLSRV_FETCH_NUMERIC) or print_r(sqlsrv_errors());
		return ($total[0]);
	}

	function Guardar_log($strsql) {
		$sqleve = "";
		$sql = trim($strsql);
		$sql = str_replace('', '', $sql);
		$accion = strtoupper(substr($sql, 0, strpos($sql, ' ')));
		// echo $strsql;
		if ($accion == 'SELECT')
			return false;
		$tabla = "";
		$llave = 0;
		$string_detalle = "";
		$func = $_SESSION["usuario_actual"];
		$this->ultimo_insert = 0;
		if (isset($_SESSION)) {
			$fecha = fecha_db_almacenar(date("Y-m-d h:i:s"), "Y-m-d h:i:s");
			if ($sqleve != "") {
				sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
				$result = sqlsrv_query($this->Conn->conn, $sqleve);
				if (!$result)
					die(" Error en la consulta: " . sqlsrv_errors());
					$registro = $this->Ultimo_Insert();
			}
		}
	}

	function resta_fechas($fecha1, $fecha2) {
		if ($fecha2 == "")
			$fecha2 = "CURRENT_TIMESTAMP";
		return "DATEDIFF(DAY,$fecha2,$fecha1)";
	}

	function fecha_db_almacenar($fecha, $formato = NULL) {
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
			case 'Y-m-d H:i:s' :
				$fsql = "CONVERT(datetime,'" . $fecha . "',20)";
				break;
			case 'Y-m-d H:i' :
				$fsql = "CONVERT(datetime,'" . $fecha . "',20)";
				break;
			case 'H:i:s' :
				$fsql = "CONVERT(time,'" . $fecha . "',20)";
				break;
			case 'd-m-y' :
				$fsql = " CONVERT(datetime, '" . $fecha . "', 3) ";
				break;
			default :
				// deafault Y-m-d Standar
				$fsql = "CONVERT(datetime,'" . $fecha . "',20)";
				break;
		}
		return $fsql;
	}

	// Fin Funcion fecha_db_almacenar
	function fecha_db_obtener($campo, $formato = NULL) {
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		// solo se relacionan los principales si se requiere de cualquier otro se debe adicionar al switch
		switch ($formato) {
			case 'Y-m-d H:i:s' :
				$fsql = "CONVERT(CHAR(19)," . $campo . ",120) ";
				break;
			case 'Y-m-d H:i' :
				$fsql = "CONVERT(CHAR(16)," . $campo . ",20)";
				break;
			case 'H:i:s' :
				$fsql = "CONVERT(CHAR(8)," . $campo . ",108)";
				break;
			case 'h:i:s' :
				$fsql = "SUBSTRING(CONVERT(CHAR(20)," . $campo . ",100),12,20)";
				break;
			case 'd/m/Y-H:i:s' :
				$fsql = "CONVERT(CHAR(255)," . $campo . ",103)+'-'+SUBSTRING(CONVERT(CHAR(20)," . $campo . ",100),12,20)";
				break;
			default :
				// deafault Y-m-d Standar
				$fsql = " CONVERT(VARCHAR(10), " . $campo . ", 120) ";
				break;
		}
		return $fsql;
	}

	// Fin Funcion fecha_db_obtener
	function mostrar_error() {
		if ($this->error != "")
			echo ($this->error["message"] . " en \"" . $this->consulta . "\"");
	}

	function fecha_db($campo, $formato = NULL) {
	}

	// Fin Funcion fecha_db_obtener
	function case_fecha($dato, $compara, $valor1, $valor2) {
		if ($compara = "" || $compara == 0)
			$compara = ">0";
		return ("CASE WHEN $dato$compara THEN $valor2 ELSE $valor1 END");
	}

	function suma_fechas($fecha1, $cantidad, $tipo = "") {
		if ($tipo == "")
			$tipo = 'DAY';
		return "DATEADD($tipo,$cantidad,$fecha1)";
	}

	function resta_horas($fecha1, $fecha2) {
		if ($fecha2 == "")
			$fecha2 = "CURRENT_TIMESTAMP";
		return "DATEDIFF(HOUR,$fecha2,$fecha1)";
	}

	function fecha_actual($fecha1, $fecha2) {
		return "CONVERT(CHAR(10),CURRENT_TIMESTAMP,20)";
	}

	// /Recibe la fecha inicial y la fecha que se debe controlar o fecha de referencia, si tiempo =1 es que la fecha iniicial esta por encima ese tiempo de la fecha de control ejemplo si fecha_inicial=2010-11-11 y fecha_control=2011-12-11 quiere decir que ha pasado 1 año , 1 mes y 0 dias desde la fecha inicial a la de control
	function compara_fechas($fecha_control, $fecha_inicial) {
		if (!strlen($fecha_control)) {
			$fecha_control = date('Y-m-d');
		}
		$resultado = $this->ejecuta_filtro_tabla("SELECT " . $this->resta_fechas("'" . $fecha_control . "'", "'" . $fecha_inicial . "'") . " AS diff");
		return ($resultado);
	}

	function listar_campos_tabla($tabla = NULL, $tipo_retorno = 0) {
		return ($this->Busca_Tabla());
	}

	function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log = 1) {
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
			$contenido = codifica_encabezado(limpia_tabla($contenido));
			$sql = "update $tabla set $campo='" . str_replace("'", '"', stripslashes($contenido)) . "' where $condicion";
			if ($log) {
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
				$llave = trim($resultados[1]);
				$anterior = busca_filtro_tabla("$campo", "$tabla", "$condicion", "", $this);
				$sql_anterior = "update $tabla set $campo='" . str_replace("'", '"', stripslashes($anterior[0][0])) . "' where $condicion";
				$sqleve = "INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('" . usuario_actual("funcionario_codigo") . "','" . date('Y-m-d H:i:s') . "','MODIFICAR', '$tabla', $llave, '0','" . addslashes($sql_anterior) . "','" . addslashes($sql) . "')";
				$this->Ejecutar_Sql($sqleve);
				$registro = $this->Ultimo_Insert();
				if ($registro) {
					$archivo = "$registro|||" . usuario_actual("funcionario_codigo") . "|||" . date('Y-m-d H:i:s') . "|||MODIFICAR|||$tabla|||0|||" . addslashes($sql_anterior) . "|||$llave|||" . addslashes($sql);
					evento_archivo($archivo);
				}
			}
			if (MOTOR == "SqlServer") {
				sqlsrv_query($this->Conn->conn, "USE " . $this->Conn->Db);
				sqlsrv_query($this->Conn->conn, $sql) or die("consulta fallida ---- $sql " . implode("<br />", sqlsrv_errors()));
			} else {
				mssql_query($sql, $this->Conn->conn) or die("consulta fallida ---- $sql " . implode("<br />", mssql_get_last_message()));
			}
		}

		return ($resultado);
	}
}
