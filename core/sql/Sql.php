<?php
abstract class Sql
{
	/**
	 * instancia de sql segun el motor
	 *
	 * @var object
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019
	 */
	private static $instance;

	/**
	 * obtiene la instancia de sql, en caso de no
	 * existir la genera
	 *
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019-06-19
	 */
	public static function getInstance()
	{
		if (!Sql::$instance) {
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

	/**
	 * asigna el limite a un sql
	 *
	 * @param string $sql
	 * @param integer $offset
	 * @param integer $limit
	 * @return string
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019
	 */
	public abstract function addLimit($sql, $offset, $limit);
}
