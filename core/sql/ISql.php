<?php

interface ISql
{
	/**
	 * gestiona la conexion a la base de datos
	 *
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019
	 */
	public function connect();

	/**
	 * finaliza la conexion de base de datos
	 *
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019
	 */
	public function disconnect();

	/**
	 * ejecuta una consulta
	 *
	 * @param string $sql
	 * @param integer $start limite inicial
	 * @param integer $end limite final
	 * @return array
	 */
	public function search($sql, $start = 0, $end = 0);

	/**
	 * ejecuta una sentencia sql
	 *
	 * @param string $sql
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019-08-13
	 */
	public function query($sql);

	/**
	 * obtiene el identificador del ultimo
	 * registro insertado
	 *
	 * @return void
	 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
	 * @date 2019-08-13
	 */
	public function lastInsertId();

	/**
	 * Devuelve la sentencia para concatenar el listado de valores en el motor respectivo
	 * @param array $arreglo_cadena
	 * @return string sentencia concatenar adecuada para el motor configurado
	 */
	public function concatenar_cadena($arreglo_cadena);

	public function liberar_resultado($rs);

	public function sacar_fila($rs);

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
	public function Nombre_Campo($rs, $pos);

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
	public function Lista_Tabla($db);

	/*
	 * <Clase>SQL
	 * <Nombre>Busca_Tabla
	 * <Parametros>tabla-nombre de la tabla a examinar
	 * <Responsabilidades>segun el motor llama la función correspondiente
	 * <Notas>
	 * <Excepciones>
	 * <Salida>matriz con la lista de los campos de una tabla
	 * <Pre-condiciones>
	 * <Post-condiciones>
	 */
	public function Busca_tabla($tabla, $campo = "");

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
	public function Numero_Campos($rs);

	public function resta_fechas($fecha1, $fecha2);

	public static function fecha_db_almacenar($fecha, $formato);

	public static function fecha_db_obtener($campo, $formato);

	public function suma_fechas($fecha1, $cantidad, $tipo);

	public function resta_horas($fecha1, $fecha2);

	public function compara_fechas($fecha_control, $fecha_inicial);

	public function invocar_radicar_documento($iddocumento, $idcontador, $funcionario);

	public function listar_campos_tabla($tabla, $tipo_retorno);

	public function guardar_lob($campo, $tabla, $condicion, $contenido, $tipo, $log);

	public function campo_formato_tipo_dato($tipo_dato, $longitud, $predeterminado, $banderas = null);

	public function formato_crear_indice($bandera, $nombre_campo, $nombre_tabla);

	public function formato_elimina_indices_tabla($tabla);

	/*
	 * <Clase>
	 * <Nombre>elimina_indice_campo</Nombre>
	 * <Parametros>$tabla:define la tabla donde se debe hacer el cambio;$campo:arreglo que debe contener los siguentes parametros:
	 * Key_name:Nombre o tipo de LLave de la llave.
	 * Column_name: Nombre de la Columna.</Parametros>
	 * <Responsabilidades>Elimina el indice seleccionado<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	public function elimina_indice_campo($tabla, $campo);

	public function verificar_existencia($tabla);

	public function formato_generar_tabla_motor($idformato, $formato, $campos_tabla, $campos, $tabla_esta);
}
