<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

require_once $ruta_db_superior . "define.php";

class Conexion {
	var $conn = null;
	var $Motor, $Host, $Usuario, $Pass, $Nombredb;
	var $Puerto;

	/*
	 * <Clase>Conexion
	 * <Nombre>Conexion
	 * <Parametros>$motor-con el que se desea trabajar; $host-ip del host; $user-usuario con el que me conecto a la base de datos;
	 * $pass-clave para $user; $db-nombre de la base de datos; $puerto-puerto por el que me deseo conectar
	 * <Responsabilidades>Poblar los atributos de la clase y llamar a la función que realiza la conexion a la base de datos
	 * <Notas>
	 * <Excepciones>cualquier problema con alguno de los parametros causa un error
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function __construct($datos = NULL) {
		if ($datos !== NULL) {
			$this->Motor = $datos["motor"];
			$this->Host = $datos["host"];
			$this->Usuario = $datos["user"];
			$this->Pass = $datos["pass"];
			$this->Nombredb = $datos["basedatos"];
			$this->Db = $datos["db"];
			$this->Puerto = $datos["port"];
		} else {
			$this->Motor = MOTOR;
			$this->Host = HOST;
			$this->Db = DB;
			$this->Usuario = USER;
			$this->Pass = PASS;
			$this->Nombredb = BASEDATOS;
			$this->Puerto = PORT;
		}
		$this->Conectar();
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Conectar()
	 * <Parametros>
	 * <Responsabilidades>llama a la función que crea la conexion a la base de datos
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Conectar() {
		switch ($this->Motor) {
			case "MySql" :
				$this->Conectar_Mysql();
				break;
			case "Oracle" :
				$this->Conectar_Oracle();
				break;
			case "SqlServer" :
				$this->Conectar_SqlServer();
				break;
			case "MSSql" :
				$this->Conectar_MSSql();
				break;
		}
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Conectar_Mysql()
	 * <Parametros>
	 * <Responsabilidades>Crea la conexion a una base de datos mysql
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Conectar_Mysql() {
		// $this->conn = mysqli_connect($this->Host, $this->Usuario, $this->Pass, $this->Db, $this->Puerto) or alerta("NO SE PUEDE CONECTAR A LA BASE DE DATOS " . $this->Db . ": " . mysqli_connect_error());
		$this->conn = new PDO(strtolower($this->Motor) . ":host=" . $this->Host . ";port=" . $this->Puerto . ";dbname=" . $this->Db . ";charset=utf8", $this->Usuario, $this->Pass);
	}

	function Conectar_SqlServer() {
		if ($this->Puerto) {
			$conecta = $this->Host . "," . $this->Puerto . ";Database=" . $this->Nombredb;
		} else if ($this->Host) {
			$conecta = $this->Host . ";Database=" . $this->Nombredb;
		} else {
			$conecta = $this->Nombredb;
		}

		// sqlsrv_query($this->conn, "USE " . $this->Db);
		$this->conn = new PDO("sqlsrv::Server=" . $conecta, $this->Usuario, $this->Pass);
	}

	function Conectar_MSSql() {
		$this->conn = new PDO("dblib:host=" . $this->Host . ":" . $port . ";dbname=" . $this->Nombredb, $this->Usuario, $this->Pass);
		// $this->conn = mssql_connect($this->Host, $this->Usuario, $this->Pass) or print_r(mssql_get_last_message());
		// mssql_query("USE " . $this->Db, $this->conn);
	}

	function Conectar_Oracle() {
		$db = "oci:dbname=" . $this->Nombredb;
		$this->conn = new PDO($db, $this->Usuario, $this->Pass);
		// $this->conn = @oci_connect($this->Usuario, $this->Pass, "(DESCRIPTION =(ADDRESS =(PROTOCOL = TCP)(HOST = " . $this->Host . ")(PORT =" . $this->Puerto . "))(CONNECT_DATA = (SID = " . $this->Nombredb . ")))");
		// print_r(oci_error($this->conn));
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Desconecta()
	 * <Parametros>
	 * <Responsabilidades>cierra la conexion con la base de datos
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>que exista una conexion a la base de datos
	 * <Post-condiciones>
	 */
	function Desconecta() {
		$this->conn = null;
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Reconexion
	 * <Parametros>nueva_db-nombre de la nueva base de datos
	 * <Responsabilidades>cambia la base de datos activa
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Reconexion($nueva_db) { /*
	                                  * if($nueva_db=="radica_camara")
	                                  * $this->Nombredb="saia8";
	                                  * if ($nueva_db=="formulario")
	                                  * $this->Nombredb="framework";
	                                  */
		$this->Nombredb = DB;
		mysqli_select_db($this->conn, $this->Nombredb) or die("error al conectarse a la bd: " . $nueva_db);
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Get_Motor
	 * <Parametros>
	 * <Responsabilidades>Devuelve el nombre del motor de base de datos que se está usando
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Get_Motor() {
		return $this->Motor;
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Set_Motor
	 * <Parametros>value-nombre del nuevo motor de base de datos
	 * <Responsabilidades>Cambiar el valor del atributo motor de base de datos
	 * <Notas>
	 * <Excepciones>
	 * <Salida>
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Set_Motor($value) {
		$this->Motor = value;
	}

	/*
	 * <Clase>Conexion
	 * <Nombre>Obtener_Conexion
	 * <Parametros>
	 * <Responsabilidades>retorna el puntero a la conexion actual
	 * <Notas>
	 * <Excepciones>
	 * <Salida>puntero al objeto conexion actual
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	function Obtener_Conexion() {
		return $this->conn;
	}
}
?>
