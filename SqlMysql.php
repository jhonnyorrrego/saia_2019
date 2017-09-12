<?php
include_once ("conexion.php");

class SqlMysql extends SQL2 {

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
		$this->res = mysqli_query($this->Conn->conn, $this->consulta);
		// se le asignan a $resultado los valores obtenidos
		if ($this->Numero_Filas() > 0) {
			for($i = 0; $i < $this->Numero_Filas(); $i++)
				$resultado[] = mysqli_fetch_array($this->res, MYSQLI_ASSOC);
			return $resultado;
		} else { // se retorna la matriz
			return (false);
		}
	}

	function liberar_resultado($rs) {
		if (!$rs) {
			$rs = $this->res;
		}
		@mysqli_free_result($rs);
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
			$this->ultimo_insert = 0;
			$sql = htmlentities($sql, ENT_NOQUOTES, "UTF-8", false);
			$sql = htmlspecialchars_decode($sql, ENT_NOQUOTES);
		}

		$this->filas = 0;
		if ($sql && $sql != "" && $this->Conn->conn) {
			$this->res = mysqli_query($this->Conn->conn, $sql); // or die("ERROR SQL ".mysqli_error($this->Conn->conn)." en ".$_SERVER["PHP_SELF"]." ->".$sql);// or error//("Error al Ejecutar: $sql --- ".mysql_error());

			if ($this->res) {
				if (strpos(strtolower($sql), "insert") !== false)
					$this->ultimo_insert = $this->Ultimo_Insert();
				else if (strpos(strtolower($sql), "select") !== false) {
					$this->ultimo_insert = 0;
					$this->filas = $this->res->num_rows;
				} else {
					$this->ultimo_insert = 0;
				}

				$this->consulta = trim($sql);
				// $fin=strpos($this->consulta," ");
				// $accion=substr($this->consulta,0,$fin);
			}
			return ($this->res);
		}
	}

	function sacar_fila($rs = Null) {
		if ($rs)
			$this->res = $rs;
		if ($arreglo = @mysqli_fetch_array($this->res, MYSQLI_BOTH)) {
			$this->filas++;
			return ($arreglo);
		} else {
			return (FALSE);
		}
	}

	function sacar_fila_vector($rs = Null) {
		if ($rs == Null)
			$rs = $this->res;
		if ($arreglo = @mysqli_fetch_row($rs)) {
			return ($arreglo);
		} else
			return (FALSE);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Insertar.
	 * <Parametros>campos-los campos a insertar; tabla-nombre de la tabla donde se hará la inserción;
	 * valores-los valores a insertar
	 * <Responsabilidades>Ejecutar una consulta del tipo insert en una base de datos mysql
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
		$this->res = mysqli_query($this->Conn->conn, $insert);
		$this->Guardar_log($insert);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Modificar.
	 * <Parametros>tabla-nombre de la tabla donde se hará la modificacion;
	 * actualizaciones-Aquellos registros que serán modificados y sus nuevos valores;
	 * where-filtro de los registros que serán modificados
	 * <Responsabilidades>Ejecutar una sentencia de tipo UPDATE en una base de datos MySql
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del UPDATE generará una excepcion
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// función update para mysql
	function Modificar($tabla, $actualizaciones, $where) {
		$actualizaciones = html_entity_decode(htmlentities(utf8_decode($actualizaciones)));
		if ($where != null && $where != "")
			$update = "UPDATE " . $tabla . " SET " . $actualizaciones . " WHERE " . $where;
		else
			$update = "UPDATE " . $tabla . " SET " . $actualizaciones;
		// ejecucion de la consulta
		$this->Guardar_log($update);
		$this->res = mysqli_query($this->Conn->conn, $update);
		//
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
		$this->res = mysqli_query($this->Conn->conn, $this->consulta);
		$this->Guardar_log($sql);
		while($fila = mysqli_fetch_row($this->res)) {
			foreach ( $fila as $valor )
				$resultado[] = $valor;
		}
		return $resultado;
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Eliminar.
	 * <Parametros>tabla-nombre de la tabla donde se hará la eliminacion; where-cuales son los registros a eliminar
	 * <Responsabilidades>Ejecutar una sentencia DELETE en una base de datos MySql
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
		$this->res = mysqli_query($this->Conn->conn, $delete);
		//
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Resultado.
	 * <Parametros>
	 * <Responsabilidades>Retornar en una matriz el resultado de la última consulta
	 * <Notas>se utiliza para obtener los resultados de la función Ejecutar_Sql
	 * <Excepciones>
	 * <Salida>devuelve una matriz asociativa con los valores de la última consulta
	 * <Pre-condiciones>$this->res debe apuntar al objeto de consulta utilizado la última vez
	 * <Post-condiciones>
	 */
	function Resultado() {
		$resultado["sql"] = $this->consulta;
		$resultado["numcampos"] = $this->Numero_Filas();
		if ($this->Numero_Filas() > 0) {
			for($i = 0; $i < $this->Numero_Filas(); $i++) {
				$resultado[$i] = mysqli_fetch_array($this->res, MYSQLI_ASSOC);
				$j = 0;
				foreach ( $resultado[$i] as $key => $valor ) {
					$resultado[$i][$j] = $resultado[$i][$key];
					$j++;
				}
			}
		}
		return $resultado;
		// se retorna la matriz
		/*
		 * else
		 * return(false);
		 */
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
		$dato = mysqli_fetch_field_direct($rs, $pos);
		return ($dato->type);
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
		$dato = mysqli_fetch_field_direct($rs, $pos);
		return ($dato->name);
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
		$this->res = mysqli_query($this->Conn->conn, "SHOW TABLES") or die("Error en la Ejecucución del Proceso SQL: " . mysqli_error($this->Conn->conn));
		while($row = mysqli_fetch_row($this->res))
			$resultado[] = $row[0];
		return ($resultado);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Lista_Bd
	 * <Parametros>
	 * <Responsabilidades>Retornar en una matriz la lista de las bases de datos existentes
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Lista_Bd() {
		$this->res = mysqli_query($this->Conn->conn, "SHOW DATABASES") or die("Error " . mysqli_error($this->Conn->conn));
		while($row = mysqli_fetch_row($this->res))
			$resultado[] = $row[0];
		asort($resultado);
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
	function Busca_tabla($tabla, $campo) {
		if (!$tabla && @$_REQUEST["tabla"])
			$tabla = $_REQUEST["tabla"];
		else if (!$tabla)
			return (false);
		$this->consulta = "show columns from " . $tabla;
		$this->res = mysqli_query($this->Conn->conn, $this->consulta);
		$resultado = array();
		$i = 0;
		while($row = mysqli_fetch_row($this->res)) {
			if ($campo && $campo == $row[0]) {
				array_push($resultado, $row[0]);
				$i++;
			} else if ($campo == '') {
				array_push($resultado, $row[0]);
				$i++;
			}
		}
		asort($resultado);
		$resultado["numcampos"] = $i;
		return ($resultado);
	}

	function Busca_tabla_new($tabla, $campo) {
		$datos_tabla = $this->ejecuta_filtro_tabla("DESCRIBE " . $tabla);
		return $datos_tabla;
	}

	/*
	 * <Clase>SQL
	 * <Nombre>Ejecutar_Limit
	 * <Parametros>$sql-consulta a ejecutar; $inicio-primer registro a buscar; $fin-ultimo registro a buscar;
	 * $conn-objeto de tipo sql
	 * <Responsabilidades>Realizar la busqueda de cierta cantidad de filas de una tabla
	 * <Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
	 * <Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
	 * <Salida>una matriz con los "limit" resultados de la busqueda
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// devuelve los registro en el rango $inicio:$fin de la consulta, para mysql
	function Ejecutar_Limit($sql, $inicio, $fin) {
		$cuantos = $fin - $inicio + 1;
		if ($inicio < 0)
			$inicio = 0;

		$consulta = "$sql LIMIT $inicio,$cuantos";
		$consulta = str_replace("key", "'key'", $consulta);
		// echo $consulta;
		$res = mysqli_query($this->Conn->conn, $consulta); // or die("consulta fallida ".mysqli_error($conn->Conn->conn));
		return ($res);
	}

	/*
	 * <Clase>SQL
	 * <Nombre>total_registros_tabla.
	 * <Parametros>tabla-nombre de la tabla a consultar
	 * <Responsabilidades>consultar el número total de registros de una tabla para mysql
	 * <Notas>
	 * <Excepciones>Cualquier problema con la ejecucion del comando generará una excepcion
	 * <Salida>devuelve un entero con el numero de filas de la tabla
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Total_Registros_Tabla($tabla) {
		$this->consulta = "SELECT COUNT( * ) AS TOTAL FROM " . $tabla;
		$this->res = mysqli_query($this->Conn->conn, $this->consulta);
		$total = mysqli_fetch_row($this->res);
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
	function Ultimo_Insert() {
		if ($this->ultimo_insert) {
			return $this->ultimo_insert;
		}
		return @mysqli_insert_id($this->Conn->conn);
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
			$fecha = $this->fecha_db_almacenar(date("Y-m-d h:i:s"), "Y-m-d h:i:s");
			if ($sqleve != "") {
				$result = mysqli_query($this->Conn->conn, $sqleve);
				if (!$result)
					die(" Error en la consulta: " . mysqli_error($this->Conn->conn));
				$registro = $this->Ultimo_Insert();
			}
		}
	}

	function resta_fechas($fecha1, $fecha2) {
		if ($fecha2 == "")
			$fecha2 = "CURDATE()";
		return "DATEDIFF($fecha1,$fecha2)";
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

		$mystring = $fecha;
		$findme = 'DATE_FORMAT';
		$pos = strpos($mystring, $findme);
		if ($pos === false) {
			$reemplazos = array(
					'd' => '%d',
					'm' => '%m',
					'y' => '%y',
					'Y' => '%Y',
					'h' => '%H',
					'H' => '%H',
					'i' => '%i',
					's' => '%s',
					'M' => '%b',
					'yyyy' => '%Y'
			);
			$resfecha = $formato;
			foreach ( $reemplazos as $ph => $mot ) { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
				$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
				/*
				 * $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
				 * $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
				 * $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
				 * $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
				 * $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
				 */
			}

			$fsql = "DATE_FORMAT('$fecha','$resfecha')";
		} else {
			$fsql = $fecha;
		}
		return $fsql;
	}

	// Fin Funcion fecha_db_almacenar
	function fecha_db_obtener($campo, $formato = NULL) {
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		$reemplazos = array(
				'd' => '%d',
				'm' => '%m',
				'y' => '%y',
				'Y' => '%Y',
				'h' => '%h',
				'H' => '%H',
				'i' => '%i',
				's' => '%s',
				'M' => '%b',
				'yyyy' => '%Y'
		);
		$resfecha = $formato;
		foreach ( $reemplazos as $ph => $mot ) { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
			$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
			/*
			 * $resfecha=preg_replace('/'.$ph.'/', "$mot", $resfecha);
			 * $resfecha=ereg_replace("^$ph([-/:])", "$mot\\1", $resfecha);
			 * $resfecha=ereg_replace("( )$ph([-/:])", "\\1$mot\\2", $resfecha);
			 * $resfecha=ereg_replace("^$ph", "$mot", $resfecha);
			 * $resfecha=ereg_replace("([-/:])$ph([-/:])", "\\1$mot\\2", $resfecha);
			 * $resfecha=ereg_replace("([-/:])$ph$", "\\1$mot", $resfecha);
			 * $resfecha=ereg_replace("$ph( )", "$mot\\1", $resfecha); // espacio entre fecha y hora
			 */
		}
		$fsql = "DATE_FORMAT($campo,'$resfecha')";
		return $fsql;
	}

	// Fin Funcion fecha_db_obtener
	function mostrar_error() {
		if ($this->error != "")
			echo ($this->error . " en \"" . $this->consulta . "\"");
	}

	function fecha_db($campo, $formato = NULL) {
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		$reemplazos = array(
				'd' => '%d',
				'm' => '%m',
				'y' => '%y',
				'Y' => '%Y',
				'h' => '%h',
				'H' => '%H',
				'i' => '%i',
				's' => '%s',
				'M' => '%b',
				'yyyy' => '%Y'
		);
		$resfecha = $formato;
		foreach ( $reemplazos as $ph => $mot ) { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
			$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
		}
		$fsql = "DATE_FORMAT($campo,'$resfecha')";

		return $fsql;
	}

	// Fin Funcion fecha_db_obtener
	function case_fecha($dato, $compara, $valor1, $valor2) {
		if ($compara = "" || $compara == 0)
			$compara = ">0";
		return ("IF($dato$compara,$valor2,$valor1)");
	}

	function suma_fechas($fecha1, $cantidad, $tipo = "") {
		if ($tipo == "")
			$tipo = 'DAY';
		return "DATE_ADD($fecha1, INTERVAL $cantidad $tipo)";
	}

	function resta_horas($fecha1, $fecha2) {
		if ($fecha2 == "")
			$fecha2 = "CURDATE()";
		return "timediff($fecha1,$fecha2)";
	}

	function fecha_actual($fecha1, $fecha2) {
		return "CURDATE()";
	}

	// /Recibe la fecha inicial y la fecha que se debe controlar o fecha de referencia, si tiempo =1 es que la fecha iniicial esta por encima ese tiempo de la fecha de control ejemplo si fecha_inicial=2010-11-11 y fecha_control=2011-12-11 quiere decir que ha pasado 1 año , 1 mes y 0 dias desde la fecha inicial a la de control
	function compara_fechas($fecha_control, $fecha_inicial) {
		if (!strlen($fecha_control)) {
			$fecha_control = date('Y-m-d');
		}
		$resultado = $this->ejecuta_filtro_tabla("SELECT " . $this->resta_fechas("'" . $fecha_control . "'", "'" . $fecha_inicial . "'") . " AS diff FROM dual");
		return ($resultado);
	}

	function listar_campos_tabla($tabla = NULL, $tipo_retorno = 0) {
		if ($tabla == NULL)
			$tabla = $_REQUEST["tabla"];
		$datos_tabla = $this->Ejecutar_Sql("DESCRIBE " . $tabla);
		while($fila = $this->sacar_fila($datos_tabla)) { // print_r($fila);
			if ($tipo_retorno) {
				$lista_campos[] = array_map(strtolower, $fila);
			} else {
				$lista_campos[] = strtolower($fila[0]);
			}
		}
		return ($lista_campos);
	}

	function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log = 1) {
		$resultado = TRUE;
		if ($tipo == "archivo") {
			$sql = "update $tabla set $campo='" . addslashes($contenido) . "' where $condicion";
			mysqli_query($this->Conn->conn, $sql);
			// TODO verificar resultado de la insecion $resultado=FALSE;
		} elseif ($tipo == "texto") {
			$contenido = codifica_encabezado(limpia_tabla($contenido));
			$sql = "update $tabla set $campo='" . addslashes(stripslashes($contenido)) . "' where $condicion";
			if ($log) {
				preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
				$llave = trim($resultados[1]);
				$anterior = busca_filtro_tabla($campo, $tabla, $condicion, "", $this);
				$sql_anterior = "update $tabla set $campo='" . addslashes(stripslashes($anterior[0][0])) . "' where $condicion";

				$sqleve = "INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado,detalle,codigo_sql) VALUES('" . usuario_actual("funcionario_codigo") . "','" . date('Y-m-d H:i:s') . "','MODIFICAR', '$tabla', $llave, '0','" . addslashes($sql_anterior) . "','" . addslashes($sql) . "')";
				$this->Ejecutar_Sql($sqleve);
				$registro = $this->Ultimo_Insert();
				if ($registro) {
					$archivo = "$registro|||" . usuario_actual("funcionario_codigo") . "|||" . date('Y-m-d H:i:s') . "|||MODIFICAR|||$tabla|||0|||" . addslashes($sql_anterior) . "|||$llave|||" . addslashes($sql);
					evento_archivo($archivo);
				}
			}
			mysqli_query($this->Conn->conn, $sql) or die(mysqli_error($this->Conn->conn));
		}
		return ($resultado);
	}

	public function campo_formato_tipo_dato($tipo_dato, $longitud, $predeterminado, $banderas = null) {
		switch (strtoupper(@$tipo_dato)) {
			case "NUMBER" :
				$campo .= " decimal";
				if ($longitud) {
					$campo .= "(" . intval($longitud) . ",0) ";
				} else {
					$campo .= "(10,0) ";
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
			case "DOUBLE" :
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
			case "CHAR" :
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
			case "VARCHAR" :
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
			case "TEXT" :
				if ($longitud == "")
					$longitud = 4000;
				$campo .= " text ";
				break;
			case "DATE" :
				$campo .= " date ";
				break;
			case "TIME" :
				$campo .= " time ";
				break;
			case "DATETIME" :
				$campo .= " DATETIME ";
				break;
			case "BLOB" :
				$campo .= " blob ";
				break;
			default :
				$campo .= " int";
				if ($longitud) {
					$campo .= "(" . intval($longitud) . ") ";
				} else {
					$campo .= "(11) ";
				}
				if ($predeterminado) {
					$campo .= " DEFAULT '" . intval($predeterminado) . "' ";
				}
				break;
		}
		return $campo;
	}

	public function formato_crear_indice($bandera, $nombre_campo, $nombre_tabla) {
		$nombre_tabla = strtoupper($nombre_tabla);
		$nombre_campo = strtoupper($nombre_campo);
		$banderas = explode(",", $todas_banderas);
		$traza = array();
		if (strlen($nombre_tabla) > 26) {
			$aux = substr($nombre_tabla, 0, 26);
		} else {
			$aux = $nombre_tabla;
		}
		$this->filas = 0;

		switch (strtolower($bandera)) {
			case "pk" :
				$dato = "ALTER TABLE " . strtolower($nombre_tabla) . " ADD PRIMARY KEY ( " . strtolower($nombre_campo) . ")";
				guardar_traza($dato, $nombre_tabla);
				$this->Ejecutar_sql($dato);
				$dato = "ALTER TABLE " . strtolower($nombre_tabla) . " CHANGE " . strtolower($nombre_campo) . " " . strtolower($nombre_campo) . " INT(11) NOT NULL AUTO_INCREMENT ";
				guardar_traza($dato, $nombre_tabla);
				$this->Ejecutar_sql($dato);

				break;
			case "u" :
				if ($this->verificar_existencia($nombre_tabla)) {
					$dato = "ALTER TABLE " . $nombre_tabla . " ADD UNIQUE( " . $nombre_campo . " )";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
				}
				break;
			case "i" :
				if ($this->verificar_existencia($nombre_tabla)) {
					$dato = "ALTER TABLE " . $nombre_tabla . " ADD INDEX ( " . $nombre_campo . " )";
					guardar_traza($dato, $nombre_tabla);
					$this->Ejecutar_sql($dato);
				}
				break;
		}
		return $traza;
	}

	protected function formato_generar_tabla_motor($idformato, $formato, $campos_tabla, $campos, $tabla_esta) {
		$lcampos = array();
		for($i = 0; $i < $campos["numcampos"]; $i++) {

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
							$dato = "ALTER TABLE " . strtolower($formato[0]["nombre_tabla"]) . " MODIFY " . $dato_campo;
						}
					}
					if ($dato != "") {
						guardar_traza($dato, $formato[0]["nombre_tabla"]);
						$this->Ejecutar_Sql($dato);
					}
				}
			}
		}
		return $lcampos;
	}

	protected function formato_elimina_indices_tabla($tabla) {
		$tabla = strtoupper($tabla);
		$indices = $this->ejecuta_filtro_tabla("SHOW INDEX FROM " . strtolower($tabla), $conn);
		for($i = 0; $i < $indices["numcampos"]; $i++) {
			$this->elimina_indice_campo($tabla, $indices[$i]);
		}
		return;
	}

	protected function elimina_indice_campo($tabla, $campo) {
		if ($campo["Key_name"] == "PRIMARY") {
			if ($this->verificar_existencia($tabla)) {
				$sql = "ALTER TABLE " . strtolower($tabla) . " CHANGE " . $campo["Column_name"] . " " . $campo["Column_name"] . " INT( 11 ) NOT NULL";
				guardar_traza($sql, strtolower($tabla));
				phpmkr_query($sql, $conn);
				$sql = "ALTER TABLE " . strtolower($tabla) . " DROP PRIMARY KEY";
				guardar_traza($sql, strtolower($tabla));
				phpmkr_query($sql, $conn);
			}
		} else {
			$sql = "DROP INDEX " . $campo["Column_name"] . " ON " . $tabla;
			guardar_traza($sql, strtolower($tabla));
			phpmkr_query($sql, $conn);
		}
		return;
	}

	protected function verificar_existencia($table) {
		$res = $this->Ejecutar_sql("SHOW TABLES LIKE '$table'");
		return mysqli_num_rows($res) > 0;
	}
}
