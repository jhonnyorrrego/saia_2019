<?php
class SqlOracle extends Sql
{

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
    function Ejecutar_Limit($sql, $inicio, $fin)
    {
        $inicio = $inicio + 1;
        $fin += 1;
        $cuantos = $fin - $inicio;
        $sql = "SELECT *
		FROM (SELECT a.*, ROWNUM FILA
		FROM ($sql) a
		WHERE ROWNUM <= $fin)
		WHERE FILA >= $inicio";
        $stmt = OCIParse($this->connection, $sql);
        // echo $sql;
        OCIExecute($stmt, OCI_COMMIT_ON_SUCCESS);

        return $stmt;
    }
}
