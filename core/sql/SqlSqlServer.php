<?php
class SqlSqlServer extends Sql
{

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

        sqlsrv_query($this->connection, "USE " . $this->db);
        $complemento = substr($sql_count, strpos($sql_count, ' '));
        /*
         * $sql_cantidad="SELECT COUNT(*) as cant FROM (".$sql_count.") cantidad_reg";
         * $res_cant=sqlsrv_query($conn->connection,$sql_cantidad) or die("consulta fallida. ---- $sql_cantidad ");
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

        $res = sqlsrv_query($this->connection, $consulta) or die("consulta fallida. ---- $consulta ");
        return ($res);
    }
}
