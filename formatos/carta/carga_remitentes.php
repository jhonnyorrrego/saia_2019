<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
      $ruta_db_superior = $ruta;
  }
  $ruta .= "../";
  $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . "assets/librerias.php";
if($_REQUEST["opcion"]!=2){
	echo jquery();
	echo bootstrap();
}

switch ($_REQUEST["opcion"]) {
	case '1':
			$padre = busca_filtro_tabla("ejecutor,tipo_radicado,plantilla", "documento", "iddocumento=" . $_REQUEST["adicionales"], "", $conn);

			if ($_REQUEST["formato_origen"] != '' && $_REQUEST["adicionales"] != "") {
					$padre = busca_filtro_tabla("ejecutor,tipo_radicado,plantilla, b.*", "documento a, ft_" . $_REQUEST["formato_origen"] . " b", "iddocumento=" . $_REQUEST["adicionales"] . " AND documento_iddocumento=iddocumento", "", $conn);

					if ($padre["numcampos"]) {
							echo "1|" . $padre[0][$_REQUEST["campo"]];
					} else {
							$padre = busca_filtro_tabla("ejecutor,tipo_radicado,plantilla", "documento a", "iddocumento=" . $_REQUEST["adicionales"], "", $conn);
							if ($padre["numcampos"]) {
									echo "1|" . $padre[0]["ejecutor"];
							} else {
									echo "0";
							}
					}
			} else if ($padre[0]["tipo_radicado"] == 1 && $_REQUEST["adicionales"]) {
					echo "1|" . $padre[0]["ejecutor"];
			} else {
					echo "0";
			}
	break;

	case '2':
		require_once $ruta_db_superior . 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
		if(!empty($_REQUEST["destinos"])){
				$destinos=$_REQUEST["destinos"];
		}
		if(!empty($_REQUEST["copias"])){
				$destinos.=','.$_REQUEST["copias"];
		}
		
		$remitentes = busca_filtro_tabla(implode(",",$columnas),"vejecutor","iddatos_ejecutor IN(".$destinos.")","",$conn);
		// Crea un nuevo objeto PHPExcel
		$objPHPExcel = new PHPExcel();
		// Establecer propiedades
		$objPHPExcel->getProperties()->setCreator("Cero K")->setLastModifiedBy("Cero K")->setTitle("Remitentes")->setSubject("Remitentes")->setDescription("Remitentes")->setKeywords("Excel Office 2007 openxml php")->setCategory("Excel Remitentes");
		// Agregar Informacion
		
		$datoColumnas = array("nombre","identificacion","cargo","empresa","direccion","telefono","email","titulo","ciudad");

		$columnas = array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D',4 => 'E', 5 => 'F',6 => 'G', 7 => 'H', 8 => 'I');
		$remitentes = busca_filtro_tabla(implode(",",$datoColumnas),"vejecutor","iddatos_ejecutor IN(".$destinos.")","",$conn);
		$maxColumnas = 9;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Nombre');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'identificacion');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'cargo');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'empresa');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'direccion');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'telefono');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'email');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'titulo');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'ciudad');
		$num = 2;
		for($i = 0; $i < $remitentes["numcampos"]; $i++){
				for($j = 0; $j < $maxColumnas; $j++){
						if(trim($remitentes[$i][$datoColumnas[$j]])){
							if($columnas[$j] == 'I'){
									$dato_ciudad = busca_filtro_tabla("A.nombre AS ciudad,B.nombre AS departamento","municipio A,departamento B","A.departamento_iddepartamento=B.iddepartamento AND A.idmunicipio=".$remitentes[$i]['ciudad']);
										if($dato_ciudad["numcampos"]){
												$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$j].$num,utf8_encode(html_entity_decode($dato_ciudad[0]["ciudad"])));
										}else{
												$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$j].$num,'');
										}
							}else{
										if($remitentes[$i][$datoColumnas[$j]] == 'undefined'){
												$remitentes[$i][$datoColumnas[$j]] = '';
										}
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$j].$num,utf8_encode(html_entity_decode($remitentes[$i][$datoColumnas[$j]])));
								}
					}else{
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$j].$num,'');
					}
				}
				$num++;
		}
		// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
		$objPHPExcel->setActiveSheetIndex(0);
		// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
		//header('Content-type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment;filename="remitentes.xlsx"');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	break;
		
	case '4':
		if ($_FILES["anexo"]["error"] || !$_FILES) {
			alerta("No se pudo cargar el anexo", "error");
			redirecciona("carga_remitentes.php?opcion=3");
			die();
		} else {
			include_once $ruta_db_superior . "app/excel/funcionesExcel.php";
			$datos = Excelphp::leer_archivo_excel($_FILES["anexo"]["tmp_name"], array(1));
			$cant_datos = count($datos);
			
			if ($cant_datos > 0) {
					$cant_colum = count($datos[1]);
					if ($cant_colum != 9) {
						alerta("Deben ser 9 columnas y actualmente hay " . $cant_colum, "warning");
						redirecciona("carga_remitentes.php?opcion=3");
						die();
					} else {
							// determina los errores de cada fila segun longitud 
							//$validacion = longitud => columna
							
							$errores = array();
							$validaciones = array(
									'100' => array(0,2,3,5,6),
									'50'  => array(1,7,8),
									'255' => array(4)
							);
							
							for ($i = 2; $i <= $cant_datos; $i++) {
									if(!strlen($datos[$i][0])){ //si no existe nombre
											$errores[$i][] = $datos[1][0];
									}
									foreach ($datos[$i] as $key => $value) {
											foreach ($validaciones as $longitud => $campos) {
													if(in_array($key, $campos) && strlen($value) > $longitud){ //si no cumple la validacion de logintud
															$errores[$datos[$i][0]][] = $datos[1][$key];
													}
											}
									}
							}
							
							if(count($errores)){
									$errores = addslashes(json_encode($errores));
									redirecciona("carga_remitentes.php?opcion=3&errores=".$errores);
									die();
							}else{
									$valores = array();
															
									for ($i = 2; $i <= count($datos); $i++) {                        
											$valores[] = datos_proveedor($datos[$i][0], $datos[$i][1], $datos[$i][2], $datos[$i][3], $datos[$i][4], $datos[$i][5], $datos[$i][6], $datos[$i][7], $datos[$i][8]);
									}
																			
									if (count($valores)) {
											echo "<script>
													window.parent.document.getElementById('destinos').value='" . implode(",", $valores) . "';
													window.parent.document.getElementById('frame_destinos').src='../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=".$_REQUEST['campo']."&tabla=ft_carta&campos_auto=nombre,identificacion&tipo=multiple&campos=cargo,empresa,direccion,telefono,email,titulo,ciudad&destinos=" . implode(",", $valores) . "';
											</script>";
									}
									
									echo "<script>window.parent.hs.close();</script>";
									alerta("Se cargaron exitosamente " . count($valores) . " registros", "success");
							}
					}
			} else {
					alerta("Debe ingresar los valores en el excel", "error");
					redirecciona("carga_remitentes.php?opcion=3");
					die();
			}
	}
	break;
        case '3':
						echo bootstrap();
            if(isset($_REQUEST['errores'])){
                $errores = json_decode($_REQUEST['errores']);
            }
            
            ?>
<!DOCTYPE html>
<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="span12">
                    <form id="form_remitentes" class="form-search" id="form" name="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="4" name="opcion">
                        <input type="file" id="anexo" name="anexo" required="required" accept=".xls,.xlsx">
                        <button type="submit" class="btn btn-primary">Validar</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <blockquote>
                        <p>Recomendaciones.</p>
                    </blockquote>
                    <small>
                        <ul>
                            <li>El archivo de tener extensi&oacute;n .xls</li>
                            <li>El excel debe tener 9 columnas como lo muestra el siguiente ejemplo <a href="carga.xls" target="_blank">ejemplo.xls</a></li>
                            <li>En caso de que no exista alg&uacute;n dato se debe dejar vacio</li>
                            <li>La longitud máxima de caracteres en los campos es:                        
                            <ul>
                                <li>Nombre :100 </li>
                                <li>Identificación :50</li>
                                <li>Cargo :100</li>
                                <li>Empresa :100 </li>
                                <li>Dirección :255</li>
                                <li>Teléfono :100</li>
                                <li>Email :100</li>
                                <li>Titulo :50</li>
                                <li>Ciudad :50</li>
                            </ul>
                        </ul>
                    </small>
                </div>
            </div>
            <?php if(count($errores)):?>
                <div class="row">
                    <div class="span12">
                        <table class="table">
                            <?php foreach ($errores as $nombre => $columnas): ?>
                                <tr class="error"><td>El registro de <?php echo $nombre ?> presenta error en <?php echo implode(', ', $columnas); ?></td></tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
                <script>window.scrollTo(0,document.body.scrollHeight);</script>
            <?php endif; ?>
            <script>
                $(document).ready(function(){
                    $("#form_remitentes").submit(function(){
                        top.noty({
                            text: 'Cargando datos, esto puede tardar un poco!',
                            type: 'alert',
                            layout: 'topCenter',
                            timeout: 2000
                        });
                        return true;
                    });
                });
            </script>
        </div>
    </body>
</html>
    <?php
    break;
}

function datos_proveedor($nombre, $identificacion, $cargo, $empresa, $direccion, $telefono, $email, $titulo, $ciudad)
{
    global $conn;

    unset($_POST);

    $search = array('ñ', 'Ñ');
    $replace = array('&ntilde;', '&Ntilde;');
    $campos_ejecutor = array();

    if ($cargo) {
        $campos_ejecutor[] = "cargo";
        $_POST["cargo"] = str_replace($search, $replace, $cargo);
    }

    if ($empresa) {
        $campos_ejecutor[] = "empresa";
        $_POST["empresa"] = str_replace($search, $replace, $empresa);
    }

    if ($direccion) {
        $campos_ejecutor[] = "direccion";
        $_POST["direccion"] = str_replace($search, $replace, $direccion);
    }

    if ($telefono) {
        $campos_ejecutor[] = "telefono";
        $_POST["telefono"] = $telefono;
    }

    if ($email) {
        $campos_ejecutor[] = "email";
        $_POST["email"] = str_replace($search, $replace, $email);
    }

    if ($titulo) {
        $campos_ejecutor[] = "titulo";
        $_POST["titulo"] = str_replace($search, $replace, $titulo);
    }

    if ($ciudad) {
        $campos_ejecutor[] = "ciudad";
        $valor = busca_filtro_tabla("", "municipio A", "A.nombre like '" . $ciudad . "'", "", $conn);
        $_POST["ciudad"] = $valor[0]["idmunicipio"];
    }

    if ($nombre) {
        $nombre = str_replace($search, $replace, $nombre);
        $nombre = trim(str_replace(",", "", $nombre));
    }

    if ($identificacion) {
        $identificacion = trim(str_replace(",", "", $identificacion));
    }

    $ejecutor["numcampos"] = 0;
    if (trim($identificacion) != "") {
        $ejecutor = busca_filtro_tabla("", "ejecutor", "identificacion LIKE '" . @$identificacion . "'", "", $conn);

        if (!$ejecutor["numcampos"]) {
            $ejecutor = busca_filtro_tabla("", "ejecutor", "lower(nombre) LIKE lower('" . @$nombre . "') and (identificacion is null or identificacion='')", "", $conn);
        }
    } elseif (trim($nombre) != "") {
        $ejecutor = busca_filtro_tabla("", "ejecutor", "lower(nombre) LIKE lower('" . @$nombre . "')", "", $conn);
    }

    if ($ejecutor["numcampos"]) {
        $otros = "";

        if (isset($identificacion) && $identificacion && $identificacion != "undefined") {
            $otros .= ",identificacion='" . $identificacion . "'";
        }

        $sql = "UPDATE ejecutor SET nombre ='" . @$nombre . "'" . $otros . " WHERE idejecutor=" . $ejecutor[0]["idejecutor"];
        phpmkr_query($sql);
        $idejecutor = $ejecutor[0]["idejecutor"];
    } else {
        $sql = "INSERT INTO ejecutor(nombre,identificacion)VALUES('" . @$nombre . "','" . @$identificacion . "')";
        phpmkr_query($sql);
        $idejecutor = phpmkr_insert_id();
        $insertado = 1;
    }

    $campos_excluidos = array('nombre', 'identificacion');
    $campos_ejecutor = array_diff($campos_ejecutor, $campos_excluidos);
    sort($campos_ejecutor);

    $campos_todos = array(
        'direccion',
        'telefono',
        'email',
        'cargo',
        'empresa',
        'ciudad',
        'titulo',
        'codigo',
    );

    $condicion_actualiza = "";
    for ($i = 0; $i < count($campos_ejecutor); $i++) {
        if (isset($_POST[$campos_ejecutor[$i]])) {
            if ($_POST[$campos_ejecutor[$i]]) {
                $condicion_actualiza .= ' AND ' . $campos_ejecutor[$i] . "='" . $_POST[$campos_ejecutor[$i]] . "'";
            } else {
                $condicion_actualiza .= ' AND (' . $campos_ejecutor[$i] . " IS NULL or " . $campos_ejecutor[$i] . "='')";
            }
        }
    }
    $datos_ejecutor = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor . $condicion_actualiza, "", $conn);

    if ((!$datos_ejecutor["numcampos"] || $insertado) && $condicion_actualiza != "") {
        $datos_ejecutor = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor, "iddatos_ejecutor desc", $conn);
        $campos = array();
        $valores = array();

        if (!isset($_POST["ciudad"]) || strtolower($_POST["ciudad"]) == "undefined") {
            $config = busca_filtro_tabla("valor", "configuracion", "lower(nombre) like 'ciudad'", "", $conn);
            if ($config["numcampos"]) {
                $_POST["ciudad"] = $config[0][0];
            } else {
                $_POST["ciudad"] = 658;
            }

        }

        for ($i = 0; $i <= count($campos_todos); $i++) {
            if ($campos_todos[$i] != "fecha_nacimiento") {
                if (isset($_POST[$campos_todos[$i]]) && in_array($campos_todos[$i], $campos_ejecutor)) {
                    array_push($valores, $_POST[$campos_todos[$i]]);
                    array_push($campos, $campos_todos[$i]);
                    $actualizado = 1;
                } else if ($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_todos[$i]] != "") {
                    array_push($valores, $datos_ejecutor[0][$campos_todos[$i]]);
                    array_push($campos, $campos_todos[$i]);
                }
            }
        }

        if ($actualizado) {
            $valor_insertar = "'" . implode("','", str_replace("'", "''", $valores)) . "',";
            $campos_insertar = implode(",", $campos) . ",";
        }

        $sql = 'INSERT INTO datos_ejecutor(' . $campos_insertar . "ejecutor_idejecutor,fecha) VALUES(" . $valor_insertar . $idejecutor . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
        phpmkr_query($sql);

        $iddatos_ejecutor = phpmkr_insert_id();
    } else if ($datos_ejecutor["numcampos"]) {
        $iddatos_ejecutor = $datos_ejecutor[0]["iddatos_ejecutor"];
    }
    unset($_POST);
    return ($iddatos_ejecutor);
}
?>