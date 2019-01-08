<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
@session_start();
@ob_start();
$_SESSION['login'] = 'cerok';
$_SESSION["usuario_actual"] = 1;

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "db_externo.php");
ini_set("display_errors", true);

if (!@$_REQUEST['ejecutar_migracion']) {
	include_once ($ruta_db_superior . "sql.php");
	include_once ($ruta_db_superior . "librerias_saia.php");
	echo (estilo_bootstrap());
	echo (librerias_jquery('1.7'));
	echo (librerias_validar_formulario(11));

   ?>
   <br>
   <div class="container">
       <form method="POST" class="form-horizontal" id="formulario_migrar_datos">
            <fieldset>
                <legend>Migraci&oacute;n de Datos</legend>

                <div class="control-group element">
                  <label class="control-label" for="host">HOST *
                  </label>
                  <div class="controls">
                    <input type="text" name="host" id="host" required>
                  </div>
                </div>

                <div class="control-group element">
                  <label class="control-label" for="user">USER *
                  </label>
                  <div class="controls">
                    <input type="text" name="user" id="user" required>
                  </div>
                </div>

                <div class="control-group element">
                  <label class="control-label" for="pass">PASSWORD *
                  </label>
                  <div class="controls">
                    <input type="password" name="pass" id="pass" required>
                  </div>
                </div>

                <div class="control-group element">
                  <label class="control-label" for="db">DB *
                  </label>
                  <div class="controls">
                    <input type="text" name="db" id="db"  required>
                  </div>
                </div>

                <div class="control-group element">
                  <label class="control-label" for="motor">MOTOR *
                  </label>
                  <div class="controls">
                      <select name="motor" id="motor" required>
                            <option value="">Seleccione...</option>
                            <option value="MySql">MySql</option>
                            <option value="Oracle">Oracle</option>
                            <option value="SqlServer">SqlServer</option>
                            <option value="MSSql">MSSql</option>
                      </select>
                  </div>
                </div>

                <div class="control-group element">
                  <label class="control-label" for="port">PORT *
                  </label>
                  <div class="controls">
                    <input type="text" name="port" id="port" required>
                  </div>
                </div>
                <div class="control-group element">
                  <label class="control-label" for="basedatos">BASEDATOS *
                  </label>
                  <div class="controls">
                    <input type="text" name="basedatos" id="basedatos" required>
                  </div>
                </div>

            </fieldset>
            <fieldset>
                <legend>Informaci&oacute;n a Migrar</legend>

                <div class="control-group element">
                  <label class="control-label" for="motor">TABLA *
                  </label>
                  <div class="controls">
                      <select name="tabla" id="tabla" required>
                            <option value="">Seleccione...</option>
                            <?php
                            $tablas=$conn->Lista_Tabla();
                            $select_tablas='';
                            if(count($tablas)){
                                for($i=0;$i<count($tablas);$i++){
                                    $select_tablas.='<option value="'.$tablas[$i].'">'.$tablas[$i].'</option>';
                                }
                            }
                            echo($select_tablas);
                            ?>
                      </select>
                  </div>
                </div>

                <div class="control-group element">
                  <label class="control-label" for="primary_key">LLAVE PRIMARIA *
                  </label>
                  <div class="controls">
                    <input type="text" name="primary_key" id="primary_key" required>
                  </div>
                </div>
                <input type="button" class="btn btn-primary btn-mini" id="preparar_datos_conexion" value="Aceptar">

            </fieldset>
       </form>
   </div>
   <script>
       $(document).ready(function(){
            var formulario_migrar_datos=$("#formulario_migrar_datos");
            formulario_migrar_datos.validate();

           $('#preparar_datos_conexion').click(function(){

               if(formulario_migrar_datos.valid()){

                   var tabla=$('#tabla').val();
                   var primary_key=$('#primary_key').val();
                   var host=$('#host').val();
                   var user=$('#user').val();
                   var pass=$('#pass').val();
                   var db=$('#db').val();
                   var motor=$('#motor').val();
                   var port=$('#port').val();
                   var basedatos=$('#basedatos').val();

                   var datos_conexion='{';
                   datos_conexion+='"tabla":"'+tabla+'",';
                   datos_conexion+='"primary_key":"'+primary_key+'",';
                   datos_conexion+='"host":"'+host+'",';
                   datos_conexion+='"user":"'+user+'",';
                   datos_conexion+='"pass":"'+pass+'",';
                   datos_conexion+='"db":"'+db+'",';
                   datos_conexion+='"motor":"'+motor+'",';
                   datos_conexion+='"port":"'+port+'",';
                   datos_conexion+='"basedatos":"'+basedatos+'"';
                   datos_conexion+='}';

                   datos_conexion=btoa(datos_conexion); //base64_encode

                   //console.log(datos_conexion);

                   var url='migrar_datos.php?ejecutar_migracion=1&conn='+datos_conexion;
                   window.location=url;

               } //fin if valid
           });
       });
   </script>
   <?php

} else if (@$_REQUEST['ejecutar_migracion']) {
	// ///// definicion de variables///////

	$parametros_get = '&ejecutar_migracion=' . $_REQUEST['ejecutar_migracion'] . '&conn=' . $_REQUEST['conn'];

	$datos_conexion = base64_decode($_REQUEST['conn']);
	$vector_datos_conexion = json_decode($datos_conexion, 1);
	// print_r($vector_datos_conexion);die();
	$contador = 0;
	$maximo = 0;
	$incremento = 3;
	$tabla = $vector_datos_conexion['tabla'];
	$llave = $vector_datos_conexion['primary_key'];
	$datos_externo = array();
	$datos_externo["HOST"] = $vector_datos_conexion['host'];
	$datos_externo["USER"] = $vector_datos_conexion['user'];
	$datos_externo["PASS"] = $vector_datos_conexion['pass'];
	$datos_externo["DB"] = $vector_datos_conexion['db'];
	$datos_externo["MOTOR"] = $vector_datos_conexion['motor'];
	$datos_externo["PORT"] = $vector_datos_conexion['port'];
	$datos_externo["BASEDATOS"] = $vector_datos_conexion['basedatos'];

	$conn2 = phpmkr_db_connect_externo($datos_externo["HOST"], $datos_externo["USER"], $datos_externo["PASS"], $datos_externo["DB"], $datos_externo["MOTOR"], $datos_externo["PORT"], $datos_externo["BASEDATOS"]);
	// print_r($conn2);die();
	// phpmkr_db_close_externo($conn2);
	// echo("<hr>");
	// print_r($conn2);
	// die();
	if (isset($_REQUEST['contador'])) {
		$contador = intval($_REQUEST['contador']);
	}
	if (!isset($_REQUEST['max'])) {
		$info = busca_filtro_tabla("MAX(" . $llave . ") as maximo", $tabla, "", "", $conn);
		$maximo = $info[0]['maximo'];
	} else {
		$maximo = intval($_REQUEST['max']);
	}
	if (@$contador === 0) {
		file_put_contents("errores_migracion_" . $tabla . ".txt", "");
	}
	$campos_tabla_externo = listar_campos_tabla_externa($tabla, $conn2, 1);
	$campos_tabla = listar_campos_tabla($tabla, 1);
	$campos_diff = array_diff($campos_tabla, $campos_tabla_externo);
	$lcampos = array();
	$tipos = array();
	$campos_fecha = array();
	$campos_fecha_hora = array();
	$campos_enteros = array();
	$campos_clob = array();
	foreach ( $campos_tabla as $key => $campo ) {
		if (is_array($campo)) {
			if (isset($campo["field"])) {
				$field = $campo["field"];
			} else {
				$field = $campo["Field"];
			}
			if (isset($campo["type"])) {
				$type = $campo["type"];
			} else {
				$type = $campo["Type"];
			}
			if ($field != "check_exportar_saia") {
				array_push($lcampos, $field);
				array_push($tipos, $type);
				if ($type == "date") {
					array_push($campos_fecha, $field);
				} else if ($type == "datetime" || $type == "timestamp") {
					array_push($campos_fecha_hora, $field);
				} else if (strpos($type, "int") !== false) {
					array_push($campos_enteros, $field);
				} else if (strpos($type, "text") !== false) {
					array_push($campos_clob, $field);
				}
			}
		} else {
			array_push($lcampos, $campo);
			array_push($tipos, "");
		}
	}
/*$sql_info="SELECT * FROM ".$tabla." WHERE ".$llave."=".$maximo;
 $conn->Ejecutar_Sql($sql_info)or die(mysql_error()." ".$sql_info);
 $cant_campos=count($lcampos);
 for($i=0;$i<$cant_campos;$i++){
 $tipo[phpmkr_field_name($conn->Conn->conn,$i)]=phpmkr_field_type($conn->Conn->conn,$i);
 }
 print_r($tipo);
 die("Prueba de tipos campo");*/
	$dato = busca_filtro_tabla(implode(",", $lcampos), $tabla, "check_exportar_saia=0 AND " . $llave . ">=" . $contador . " AND " . $llave . "<" . ($contador + $incremento), $llave, $conn);
	if ($dato['numcampos'] && $conn2 && ($maximo > $contador)) {
		for($i = 0; $i < $dato['numcampos']; $i++) {
			$insert_campos = array();
			$insert = null;
			$insertado = busca_filtro_tabla_externo($llave, $tabla, $llave . "=" . $dato[$i][$llave], "", $conn2);
			if ($insertado['numcampos']) {
				$update = "UPDATE " . $tabla . " SET check_exportar_saia=1 WHERE " . $llave . "=" . $dato[$i][$llave];
				$conn->Ejecutar_Sql($update);
			} else {
				foreach ( $campos_fecha as $key => $valor_date ) {
					if ($dato[$i][$valor_date] == '0000-00-00' || $dato[$i][$valor_date] == 'null' || $dato[$i][$valor_date] == '') {
						$dato[$i][$valor_date] = 'null';
					} else {
						$dato[$i][$valor_date] = "to_date('" . $dato[$i][$valor_date] . "','YYYY-MM-DD')";
					}
				}
				foreach ( $campos_fecha_hora as $key2 => $valor_time ) {
					if ($dato[$i][$valor_time] == '0000-00-00 00:00:00' || $dato[$i][$valor_time] == 'null' || $dato[$i][$valor_time] == '') {
						$dato[$i][$valor_time] = 'null';
					} else {
						$dato[$i][$valor_time] = "to_date('" . $dato[$i][$valor_time] . "','YYYY-MM-DD HH24:MI:SS')";
					}
				}
				foreach ( $campos_enteros as $key4 => $valor_int ) {
					if ($dato[$i][$valor_int] == '') {
						$dato[$i][$valor_int] = 0;
					} else {
						$dato[$i][$valor_int] = intval($dato[$i][$valor_int]);
					}
				}
				foreach ( $campos_clob as $key_clob => $valor_clob ) {
					if ($dato[$i][$valor_clob] == '') {
						$dato[$i][$valor_clob] = null;
					}
				}
				$insert = 'INSERT INTO ' . $tabla . '(' . implode(",", $lcampos) . ') VALUES(';
				foreach ( $lcampos as $key3 => $valor3 ) {
					if ($dato[$i][$valor3] === '') {
						$dato[$i][$valor3] = ' ';
					}
					if (in_array($valor3, $campos_clob)) {
						if ($dato[$i][$valor3] && $conn2->Conn->Motor == "Oracle") {
							array_push($insert_campos, "empty_clob()");
						} else {
							array_push($insert_campos, "NULL");
						}
					} else if (in_array($valor3, $campos_fecha) === false && in_array($valor3, $campos_fecha_hora) === false) {
						array_push($insert_campos, "'" . $dato[$i][$valor3] . "'");
					} else {
						array_push($insert_campos, $dato[$i][$valor3]);
					}
				}
				$insert .= implode(",", $insert_campos) . ')';
				phpmkr_query_externo($insert, $conn2);
				$insertado = busca_filtro_tabla_externo($llave, $tabla, $llave . "=" . $dato[$i][$llave], "", $conn2);
				if ($insertado['numcampos']) {
					foreach ( $campos_clob as $key_clob => $valor_clob ) {
						if ($dato[$i][$valor_clob]) {
							guardar_lob_externa($valor_clob, $tabla, $llave . "=" . $dato[$i][$llave], $dato[$i][$valor_clob], "texto", $conn2, 0);
						}
					}
					$update = "UPDATE " . $tabla . " SET check_exportar_saia=1 WHERE " . $llave . "=" . $dato[$i][$llave];
					$conn->Ejecutar_Sql($update);
				} else {
					file_put_contents("errores_migracion_" . $tabla . ".txt", $insert . ";\n\n", FILE_APPEND);
				}
			}
		}
		$contador += $incremento;
		phpmkr_db_close_externo($conn2);
		redirecciona("migrar_datos.php?max=" . $maximo . "&contador=" . $contador . $parametros_get);
	} else {
		if ($maximo < $contador) {
			die("Terminamos<hr>");
		} else {
			$contador += $incremento;
			phpmkr_db_close_externo($conn2);
			redirecciona("migrar_datos.php?max=" . $maximo . "&contador=" . $contador . $parametros_get);
		}
	}
	die("Vamos aqui");
} // fin if $_REQUEST ejecutar_migracion
?>
