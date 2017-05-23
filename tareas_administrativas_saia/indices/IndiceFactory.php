<?php

include_once ("IndiceMysql.php");
include_once ("IndiceOracle.php");
include_once ("IndiceSqlserver.php");

class IndiceFactory {

	public static function getIndice($conn, $tablespace = null) {
		//var_dump($conn);die();
		switch ($conn->motor) {
			case "MySql" :
				return new IndiceMysql($conn);
			case "Oracle" :
				return new IndiceOracle($conn, $tablespace);
			case "SqlServer" :
			case "MSSql" :
				return new IndiceSqlserver($conn);
		}
	}
}
?>