<?php
include_once ("conexion.php");

class SqlOracle extends SQL2 {

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
		$this->res = $this->Ejecutar_Sql($this->consulta);
		// se le asignan a $resultado los valores obtenidos
		$i = 0;
		$resultado = array();
		for(; ($arreglo = $this->sacar_fila($this->res)); $i++) {
			$arreglo = array_change_key_case($arreglo, CASE_LOWER);
			array_push($resultado, $arreglo);
		}
		$resultado["numcampos"] = $i;
		$this->filas = $i;
		if ($i)
			return $resultado;
		else
			return (FALSE);
	}

	function liberar_resultado($rs) {
		if (!$rs) {
			$rs = $this->res;
		}
		@OCIFreeStatement($rs);
	}

	function Ejecutar_Sql($sql) {
		$strsql = trim($sql);
		$strsql = str_replace(" =", "=", $strsql);
		$strsql = str_replace("= ", "=", $strsql);
		$accion = strtoupper(substr($strsql, 0, strpos($strsql, ' ')));
		if ($accion == "INSERT" || $accion == "UPDATE") {
			$sql = htmlentities($sql, ENT_NOQUOTES, "UTF-8", false);
			$sql = htmlspecialchars_decode($sql, ENT_NOQUOTES);
		}

		$this->consulta = $sql;
		$rs = @OCIParse($this->Conn->conn, $sql);
		if ($rs) {
			if (@OCIExecute($rs, OCI_COMMIT_ON_SUCCESS)) {
				$this->res = $rs;

				if (strpos(strtolower($sql), "insert") !== false) {
					$this->ultimo_insert = $this->Ultimo_Insert();
				}
				if (strpos(strtolower($sql), "alter") !== false) {
				} else {
					$this->ultimo_insert = 0;
				}
			}
		}
		if (strpos(strtolower($sql), 'select') !== false) {
			$rs2 = @OCIParse($this->Conn->conn, "select count(*) as contarfilas from(" . $sql . ")");

			if (!OCIExecute($rs2, OCI_COMMIT_ON_SUCCESS)) {
				// print_r($sql);
				// die();
			}
			$temp = $this->sacar_fila($rs2);
			$this->filas = $temp["contarfilas"];
		}
		return ($rs);
	}

	function sacar_fila($rs = Null) {
		if ($rs)
			$this->res = $rs;
		$arreglo = array();
		if (@OCIFetchInto($this->res, $arreglo, OCI_ASSOC + OCI_NUM + OCI_RETURN_NULLS + OCI_RETURN_LOBS)) {
			$arreglo = array_change_key_case($arreglo, CASE_LOWER);
			$this->filas++;
			return ($arreglo);
		} else {
			// print_r(oci_error($this->res));
			return (FALSE);
		}
	}

	function sacar_fila_vector($rs = Null) {
		if ($rs == Null)
			$rs = $this->res;
		if (@OCIFetchInto($rs, $arreglo, OCI_NUM)) {
			return ($arreglo);
		} else
			return (FALSE);
	}

	function Insertar($campos, $tabla, $valores) {
	}

	function Modificar($tabla, $actualizaciones, $where) {
	}

	function Ejecutar_Sql_Tipo($sql) {
	}

	function Eliminar($tabla, $where) {
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
		return (oci_field_type($rs, $pos + 1));
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
		return (strtolower(oci_field_name($rs, $pos + 1)));
	}

	function Lista_Tabla($db) {
	}

	function Busca_tabla($tabla, $campo = '') {
		if (!$tabla && @$_REQUEST["tabla"])
			$tabla = $_REQUEST["tabla"];
		else if (!$tabla)
			return (false);
		$where_campo = '';
		if ($campo != '') {
			$where_campo = " AND column_name='" . $campo . "'";
		}
		$this->consulta = "SELECT column_name AS Field FROM user_tab_columns WHERE table_name='" . strtoupper($tabla) . "' " . $where_campo . " ORDER BY column_name ASC";
		$this->res = $this->Ejecutar_Sql($this->consulta);
		// se le asignan a $resultado los valores obtenidos
		$i = 0;
		$resultado = array();
		for(; ($arreglo = $this->sacar_fila($this->res)); $i++) {
			$arreglo = array_change_key_case($arreglo, CASE_LOWER);
			array_push($resultado, $arreglo);
		}
		$resultado["numcampos"] = $i;
		$this->filas = $i;
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
	 * <Notas>Funciona igual que Buscar_MySql pero con el parametro limit, fue necesaria su creacion al no tener en cuenta este parametro con anterioridad
	 * <Excepciones>Cualquier problema con la ejecucion del SELECT generará una excepcion
	 * <Salida>una matriz con los "limit" resultados de la busqueda
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	// devuelve los registro en el rango $inicio:$fin de la consulta, para oracle
	function Ejecutar_Limit($sql, $inicio, $fin) {
		$inicio = $inicio + 1;
		$fin += 1;
		$cuantos = $fin - $inicio;
		$sql = "SELECT *
		FROM (SELECT a.*, ROWNUM FILA
		FROM ($sql) a
		WHERE ROWNUM <= $fin)
		WHERE FILA >= $inicio";
		$stmt = OCIParse($this->Conn->conn, $sql);
		// echo $sql;
		if (!OCIExecute($stmt, OCI_COMMIT_ON_SUCCESS))
			$this->error = OCIError();
		return $stmt;
	}

	function Total_Registros_Tabla($tabla) {
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
		return (OCINumCols($rs));
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
		$identificador = 0;
		$sql = $this->consulta;
		$this->consulta = trim($sql);
		$fin = strpos($this->consulta, " ");
		$accion = strtoupper(substr($this->consulta, 0, $fin));

		switch ($accion) {
			case "SELECT" :
				$identificador = 0;
				break;
			case "UPDATE" :
				$identificador = 0;
				break;
			case "INSERT" :
				$posinto = strpos(strtoupper($this->consulta), "INTO");
				$posval = strpos(strtoupper($this->consulta), "VALUES");
				$tabla = substr($this->consulta, $posinto + 4, $posval - $posinto);
				$tabla = trim($tabla);

				$parent = strpos($tabla, "(");
				if ($parent)
					$tabla = substr($tabla, 0, $parent);

				$tabla = trim($tabla);
				$posicion = strpos($tabla, ".");
				if ($posicion) {
					$long = strlen($tabla);
					$tabla = substr($tabla, ($posicion + 1), $long);
				}
				if (strlen($tabla) > 26)
					$aux = substr($tabla, 0, 26);
				else
					$aux = $tabla;
				$sql_id = "SELECT " . $aux . "_SEQ.currval FROM DUAL";

				$rs_temp = @OCIParse($this->Conn->conn, $sql_id);
				if (@OCIExecute($rs_temp)) {
					@OCIFetchInto($rs_temp, $arreglo, OCI_NUM);
					$identificador = $arreglo[0];
				}

				@OCIFreeStatement($rs_temp);
				@ocicancel($rs_temp);
				break;
		}
		return ($identificador);
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
				$rs = @ OCIParse($this->Conn->conn, $sqleve);
				if ($rs) {
					if (@OCIExecute($rs, OCI_COMMIT_ON_SUCCESS)) {
						$this->res = $rs;
					} else {
						$this->error = OCIError($rs);
					}
				}
				$registro = $this->Ultimo_Insert();
			}
		}
	}

	function resta_fechas($fecha1, $fecha2) {
		if ($fecha2 == "")
			$fecha2 = "sysdate";
		return "$fecha1-$fecha2 ";
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

			$fsql = "TO_DATE('$fecha','$resfecha')";
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
		foreach ( $reemplazos as $ph => $mot ) {
			$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
			// $resfecha=ereg_replace("$ph", "$mot", $resfecha);
		}
		$fsql = "TO_CHAR($campo,'$resfecha')";
		return $fsql;
	}

	// Fin Funcion fecha_db_obtener
	function mostrar_error() {
		if ($this->error != "")
			echo ($this->error["message"] . " en \"" . $this->consulta . "\"");
	}

	function fecha_db($campo, $formato = NULL) {
		if (!$formato)
			$formato = "Y-m-d"; // formato por defecto php

		$reemplazos = array(
				'd' => 'DD',
				'm' => 'MM',
				'y' => 'YY',
				'Y' => 'YYYY',
				'h' => 'HH',
				'H' => 'HH24',
				'i' => 'MI',
				's' => 'SS',
				'M' => 'MON',
				'yyyy' => 'YYYY'
		);
		$resfecha = $formato;
		foreach ( $reemplazos as $ph => $mot ) { // echo $ph," = ",$mot,"<br>","^$ph([-/:])", "%Y\\1","<br>";
			$resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
		}

		return $fsql;
	}

	// Fin Funcion fecha_db_obtener
	function case_fecha($dato, $compara, $valor1, $valor2) {
		return ("decode($dato,$compara,$valor1,$valor2)");
	}

	function suma_fechas($fecha1, $cantidad, $tipo = "") {
		if ($tipo == "HOUR") {
			return "$fecha1+($cantidad/24)";
		}
		if ($tipo == "" || $tipo == "DAY")
			return "$fecha1+$cantidad";
		else if ($tipo == "MONTH")
			return "ADD_MONTHS($fecha1,$cantidad)";
		else if ($tipo == "YEAR")
			return "ADD_MONTHS($fecha1,$cantidad*12)";
	}

	function resta_horas($fecha1, $fecha2) {
		if ($fecha2 == "")
			$fecha2 = "sysdate";
		return "($fecha1-$fecha2)*24";
	}

	function fecha_actual($fecha1, $fecha2) {
		return "sysdate";
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
		$datos_tabla = $this->Ejecutar_Sql("SELECT column_name AS Field FROM user_tab_columns WHERE table_name='" . strtoupper($tabla) . "' ORDER BY column_name ASC");
		$lista_campos = array();
		while($fila = $this->sacar_fila($datos_tabla)) {
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
		$sql = "SELECT " . $campo . " FROM " . $tabla . " WHERE " . $condicion . " FOR UPDATE";
		$stmt = OCIParse($this->Conn->conn, $sql) or print_r(OCIError($stmt));
		// Execute the statement using OCI_DEFAULT (begin a transaction)
		OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError($stmt));
		// Fetch the SELECTed row
		OCIFetchInto($stmt, $row, OCI_ASSOC);

		if (!count($row)) { // soluciona el problema del size() & ya no se necesita el emty_clob() en bd en los campos clob
			oci_rollback($this->Conn->conn);
			oci_free_statement($stmt);

			$up_clob = "UPDATE " . $tabla . " SET " . $campo . "=empty_clob() WHERE " . $condicion;
			$this->Ejecutar_Sql($up_clob);
			$stmt = OCIParse($this->Conn->conn, $sql) or print_r(OCIError($stmt));
			// Execute the statement using OCI_DEFAULT (begin a transaction)
			OCIExecute($stmt, OCI_DEFAULT) or print_r(OCIError($stmt));
			// Fetch the SELECTed row
			OCIFetchInto($stmt, $row, OCI_ASSOC);
		}

		if (FALSE === $row) {
			OCIRollback($this->Conn->conn);
			alerta("No se pudo modificar el campo.");
			die($sql);
			$resultado = FALSE;
		} else { // Now save a value to the LOB
			if ($tipo == "texto") { // para campos clob como en los formatos
				if ($row[strtoupper($campo)]->size() > 0)
					$contenido_actual = htmlspecialchars_decode($row[strtoupper($campo)]->read($row[strtoupper($campo)]->size()));
				else
					$contenido_actual = "";

				if ($contenido_actual != $contenido) {
					if ($row[strtoupper($campo)]->size() > 0 && !$row[strtoupper($campo)]->truncate()) {
						oci_rollback($this->Conn->conn);
						alerta("No se pudo modificar el campo.");
						$resultado = FALSE;
					} else {
						$contenido = limpia_tabla($contenido);
						if (!$row[strtoupper($campo)]->save(trim((($contenido))))) {
							oci_rollback($this->Conn->conn);
							$resultado = FALSE;
						} else
							oci_commit($this->Conn->conn);
						// *********** guardo el log en la base de datos **********************
						preg_match("/.*=(.*)/", strtolower($condicion), $resultados);
						$llave = trim($resultados[1]);

						if ($log) {
							$sqleve = "INSERT INTO evento(funcionario_codigo, fecha, evento, tabla_e, registro_id, estado) VALUES('" . usuario_actual("funcionario_codigo") . "',to_date('" . date('Y-m-d H:i:s') . "','YYYY-MM-DD HH24:MI:SS') ,'MODIFICAR', '$tabla', $llave, '0')";

							$this->Ejecutar_Sql($sqleve);
							$registro = $this->Ultimo_Insert();
							$texto_ant = "DECLARE
								cont$   CLOB;
								BEGIN
								UPDATE $tabla SET $campo=EMPTY_CLOB()
								WHERE $condicion;
								SELECT $campo
								INTO cont$
								FROM $tabla
								WHERE $condicion
								FOR UPDATE;
								DBMS_LOB.WRITE (cont$, DBMS_LOB.getlength('$contenido_actual'), 1, '$contenido_actual');
								COMMIT;
								END";
							$texto_sig = "DECLARE
								cont$   CLOB;
								BEGIN
								UPDATE $tabla SET $campo=EMPTY_CLOB()
								WHERE $condicion;
								SELECT $campo
								INTO cont$
								FROM $tabla
								WHERE $condicion
								FOR UPDATE;
								DBMS_LOB.WRITE (cont$, DBMS_LOB.getlength('$contenido'), 1, '$contenido');
								COMMIT;
								END";
							guardar_lob('codigo_sql', 'evento', "idevento=" . $registro, $texto_sig, 'texto', $this, 0);
							guardar_lob('detalle', 'evento', "idevento=" . $registro, $texto_ant, 'texto', $this, 0);
							$archivo = "$registro|||" . usuario_actual("funcionario_codigo") . "|||" . date('Y-m-d H:i:s') . "|||MODIFICAR|||$tabla|||0|||$texto_ant|||$llave|||$texto_sig";
							evento_archivo($archivo);
							// *********************************
						}
					}
				}
			} elseif ($tipo == "archivo") { // para campos blob como la firma
			                                // echo ($campo.$tabla.$condicion.$contenido);
				if (!$row[strtoupper($campo)]->truncate()) {
					oci_rollback($this->Conn->conn);
					alerta("No se pudo modificar el campo.");
					$resultado = FALSE;
				}
				if (!$row[strtoupper($campo)]->save($contenido)) {
					oci_rollback($this->Conn->conn);
					alerta("No se pudo modificar el campo.");
					$resultado = FALSE;
				} else
					oci_commit($this->Conn->conn);
			}
			oci_free_statement($stmt);
			$row[strtoupper($campo)]->free();
		}
		return ($resultado);
	}
}
