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
include_once ($ruta_db_superior . "db.php");

$array_create = array();
$array_alter = array();

$tablas = $conn->Lista_Tabla();
$tablespace = "SAIA_INDEX01";
$tablas["numcampos"] = count($tablas);
for($i = 0; $i < $tablas["numcampos"]; $i++) {
	if (MOTOR == 'Oracle') {
		$indices = ejecuta_filtro_tabla("SELECT user_tables.table_name, user_indexes.index_name, user_indexes.tablespace_name, user_ind_columns.column_name FROM user_tables JOIN user_indexes on user_indexes.table_name = user_tables.table_name JOIN user_ind_columns ON user_indexes.index_name = user_ind_columns.index_name  WHERE user_tables.table_name='" . $tablas[$i] . "' ORDER BY user_tables.table_name,user_indexes.index_name", $conn);
	} else if (MOTOR == 'MSSql' || MOTOR == 'SqlServer') {
		$indices = ejecuta_filtro_tabla("SELECT  t.name AS table_name, i.name AS index_name, s.name AS tablespace_name, c.name AS column_name
    from sys.schemas s
    inner join sys.tables t on t.schema_id = s.schema_id
    inner join sys.indexes i on i.object_id = t.object_id
    inner join sys.index_columns ic on ic.object_id = t.object_id
    and ic.index_id=i.index_id
    inner join sys.columns c on c.object_id = t.object_id
    and ic.column_id = c.column_id
    where t.name='" . $tablas[$i] . "'
    order by index_name", $conn);
	}
	$exito = 0;
	$exito_documento = 0;
	for($j = 0; $j < $indices["numcampos"]; $j++) {
		if ($indices[$j]["tablespace_name"] != $tablespace && MOTOR == 'Oracle') {
			$array_alter[] = ("ALTER INDEX " . $indices[$j]["index_name"] . " REBUILD TABLESPACE " . $tablespace . ";");
		}
		if (strtoupper($indices[$j]["column_name"]) == "ID" . strtoupper($tablas[$i]) || strtoupper($indices[$j]["column_name"]) == "IDTRANSFERENCIA") {
			$exito = 1;
			if (strtoupper($indices[$j]["index_name"]) != strtoupper($tablas[$i] . "_PK")) {
				if (MOTOR == 'Oracle') {
					$array_alter[] = ("ALTER INDEX " . strtoupper($indices[$j]["index_name"]) . " RENAME TO " . strtoupper($tablas[$i]["nombre"]) . "_PK;");
				} else if (MOTOR == 'MSSql' || MOTOR == 'SqlServer') {
					$array_alter[] = ("EXEC sp_rename N'" . ($indices[$j]["tablespace_name"]) . "." . ($indices[$j]["table_name"]) . "." . ($indices[$j]["index_name"]) . "', N'" . ($tablas[$i]) . "_PK', N'INDEX';");
				}
			}
		}

		if (strtoupper($indices[$j]["column_name"]) == "DOCUMENTO_IDDOCUMENTO") {
			$exito_documento = 1;
			if (MOTOR == "Oracle") {
				if (strtoupper($indices[$j]["index_name"]) != strtoupper($tablas[$i] . "_DOC")) {
					$array_alter[] = ("ALTER INDEX " . strtoupper($indices[$j]["index_name"]) . " RENAME TO " . strtoupper($tablas[$i]) . "_DOC;");
				}
			} else if (MOTOR == 'MSSql' || MOTOR == 'SqlServer') {
				if (strtoupper($indices[$j]["index_name"]) != strtoupper($tablas[$i] . "_DOC")) {
					$array_alter[] = ("EXEC sp_rename N'" . ($indices[$j]["tablespace_name"]) . "." . ($indices[$j]["table_name"]) . "." . ($indices[$j]["index_name"]) . "', N'" . ($tablas[$i]) . "_DOC', N'INDEX';");
				}
			}
		}
	}

	if ($exito == 0) {
		$array_create[] = ("CREATE INDEX " . ($tablas[$i]) . "_PK  on " . ($tablas[$i]) . " (id" . ($tablas[$i]) . ");");
	}

	if (!$exito_documento) {
		$campos = $conn->Busca_tabla($tablas[$i], "documento_iddocumento");
		if (count($campos)) {
			$array_create[] = ("CREATE INDEX " . ($tablas[$i]) . "_DOC  on " . ($tablas[$i]) . " (documento_iddocumento);");
		}
	}
}
echo ("CREATE<hr>");
echo implode("<br/>", $array_create);
echo ("<hr>ALTER O RENAME<hr>");
echo implode("<br/>", $array_alter);

?>