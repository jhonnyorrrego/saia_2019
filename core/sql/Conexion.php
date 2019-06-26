<?php

class Conexion
{
	public $conn = null;
	public $Motor;
	public $Host;
	public $Usuario;
	public $Pass;
	public $Nombredb;
	public $Puerto;

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
		$this->Motor = MOTOR;
		$this->Host = HOST;
		$this->Usuario = USER;
		$this->Pass = PASS;
		$this->Nombredb = BASEDATOS;
		$this->Db = DB;
		$this->Puerto = PORT;
	}

	/**
	 * llama el metodo conectar segun el motor de bd
	 *
	 * @return void
	 * @date 2019
	 */
	function connect()
	{
		switch ($this->Motor) {
			case "MySql":
				$this->Conectar_Mysql();
				break;
			case "Oracle":
				$this->Conectar_Oracle();
				break;
			case "SqlServer":
				$this->Conectar_SqlServer();
				break;
			case "MSSql":
				$this->Conectar_MSSql();
				break;
		}
	}

	function Conectar_Mysql()
	{
		$this->conn = mysqli_connect(
			$this->Host,
			$this->Usuario,
			$this->Pass,
			$this->Db,
			$this->Puerto
		) or alerta("NO SE PUEDE CONECTAR A LA BASE DE DATOS " . $this->Db . ": " . mysqli_connect_error());
	}

	function Conectar_SqlServer()
	{
		if ($this->Puerto)
			$conecta = $this->Host . "\\" . $this->Nombredb . "," . $this->Puerto;
		else if ($this->Host)
			$conecta = $this->Host . "\\" . $this->Nombredb;
		else
			$conecta = $this->Nombredb;
		$this->conn = sqlsrv_connect($conecta, array(
			"UID" => $this->Usuario,
			"PWD" => $this->Pass,
			"Database" => $this->Db
		)) or print_r(sqlsrv_errors());
		sqlsrv_query($this->conn, "USE " . $this->Db);
	}

	function Conectar_MSSql()
	{
		$this->conn = mssql_connect($this->Host, $this->Usuario, $this->Pass) or print_r(mssql_get_last_message());
		mssql_query("USE " . $this->Db, $this->conn);
	}

	function Conectar_Oracle()
	{
		$this->conn = @oci_connect($this->Usuario, $this->Pass, "(DESCRIPTION =(ADDRESS =(PROTOCOL = TCP)(HOST = " . $this->Host . ")(PORT =" . $this->Puerto . "))(CONNECT_DATA = (SID = " . $this->Nombredb . ")))");
	}

	/**
	 * cierra la conexion con la base de datos
	 *
	 * @return void
	 * @date 2019
	 */
	function Desconecta()
	{
		switch ($this->Motor) {
			case "MySql":
				if ($this->conn)
					mysqli_close($this->conn);
				break;
			case "Oracle":
				if ($this->conn)
					oci_close($this->conn);
				break;
			case "SqlServer":
				if ($this->conn)
					sqlsrv_close($this->conn);
				break;
			case "MSSql":
				if ($this->conn)
					mssql_close($this->conn);
				break;
		}
	}
}
