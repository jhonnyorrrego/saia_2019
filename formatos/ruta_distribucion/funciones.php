<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias_funciones_generales.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "distribucion/funciones_distribucion.php");


/* ADICIONAR - EDITAR */

function add_edit_ruta_dist($idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    if ($_REQUEST["iddoc"]) {
        $opt = 1;
        $iddoc = $_REQUEST["iddoc"];
    } else {
        $iddoc = 0;
        $opt = 0;
    }
    ?>
    <script>
        $(document).ready(function () {
            var opt = parseInt(<?php echo $opt; ?>);
            var iddoc = parseInt(<?php echo $iddoc; ?>);
            $('#nombre_ruta').blur(function () {
                if ($(this).val() != "") {
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        data: {
                            nombre_ruta: $(this).val(),
                            opt: opt,
                            iddoc: iddoc
                        },
                        url: "validar_nombre_ruta_distribucion.php",
                        success: function (data) {
                            if (data.exito) {
                                $('#nombre_ruta').val('');
                                $('#nombre_ruta').focus();
                                top.noty({
                                    text: '<b>ATENCI&Oacute;N</b><br>El nombre de la ruta ya existe!',
                                    type: 'warning',
                                    layout: 'topCenter',
                                    timeout: 2500
                                });
                            }
                        }, error: function () {
                            top.noty({
                                text: '<b>Error!</b>Se detecto un error al procesar la solicitud',
                                type: 'error',
                                layout: 'topCenter',
                                timeout: 2500
                            });
                        }
                    });
                }
            });
        });
    </script>
    <?php
}

function enlace_item_dependencias_ruta($idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    $dato = busca_filtro_tabla("", "ft_ruta_distribucion A, documento B ",
            "A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=" . $iddoc,
            "",
            $conn);
    if ($_REQUEST['tipo'] != 5) {
        echo '<a class="btn btn-complete"  href="' . $ruta_db_superior . 'formatos/dependencias_ruta/adicionar_dependencias_ruta.php?pantalla=padre&amp;idpadre=' . $iddoc . '&amp;idformato=' . $idformato . '&amp;padre=' . $dato[0]['idft_ruta_distribucion'] . '" target="_self">Adicionar dependencias a la Ruta</a>';
    }
}

function mostrar_datos_dependencias_ruta($idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    $tabla = '';
    $dato = busca_filtro_tabla("idft_ruta_distribucion", "ft_ruta_distribucion A, documento B ", "A.documento_iddocumento=B.iddocumento AND B.estado not in ('ELIMINADO','ANULADO') AND B.iddocumento=" . $iddoc, "", $conn);
    if ($dato['numcampos']) {
        $item = busca_filtro_tabla(fecha_db_obtener("fecha_item_dependenc", "Y-m-d H:i:s") . " AS fecha_item_dependenc,dependencia_asignada,descripcion_dependen,estado_dependencia", "ft_dependencias_ruta A, ft_ruta_distribucion B", "idft_ruta_distribucion=ft_ruta_distribucion and A.ft_ruta_distribucion=" . $dato[0]['idft_ruta_distribucion'], "", $conn);
        if ($item["numcampos"]) {
            $estado = array(
                1 => "Activo",
                2 => "Inactivo"
            );
            $tabla .= '<form id="item_prerequisitos" action="'.$ruta_db_superior.'formatos/ruta_distribucion/guardar_datos_dependencias.php">
			<table class="table table-bordered">
			<tr style="font-weight:bold">
			    <td><center> Fecha</center></td>
			    <td><center>Dependencia</center></td>
			    <td><center>Descripci&oacute;n</center></td>
			    <td><center>Estado</center></td>
			</tr>';

            for ($j = 0; $j < $item["numcampos"]; $j++) {
                if ($item[$j]['estado_dependencia'] == 1) {//VINCULO RUTA DE DISTRIBUCION DE LAS DEPENDENCIAS ACTIVAS A LOS DOCUMENTOS
                    actualizar_dependencia_ruta_distribucion($dato[0]['idft_ruta_distribucion'], $item[$j]['dependencia_asignada'], 1);
                }
                $dependencia = busca_filtro_tabla('nombre', 'dependencia', 'iddependencia=' . $item[$j]['dependencia_asignada'], '', $conn);
                $tabla .= '<tr>
					<td>' . $item[$j]['fecha_item_dependenc'] . '</td>
					<td>' . $dependencia[0]['nombre'] . '<input type="hidden" name="dependencia_asignada[]" value="' . $item[$j]['dependencia_asignada'] . '"></td>';
                if ($item[$j]['descripcion_dependen'] == '') {
                    $tabla .= '<td>
                    <input type="text" class="form-control" name="descripcion[]">
                    </td>';
                } else {
                    $tabla .= '<td>' . $item[$j]['descripcion_dependen'] . '<input type="hidden" name="descripcion[]" value="' . $item[$j]['descripcion_dependen'] . '"></td>';
                }
                $seleccionar = array(
                    1 => "",
                    2 => ""
                );
                $seleccionar[$item[$j]['estado_dependencia']] = 'selected';
                $tabla .= '<td>
					<select class="cambio_estado_dependencia" data-idft_ruta_distribucion=' . $dato[0]['idft_ruta_distribucion'] . ' data-idft=' . $item[$j]['dependencia_asignada'] . ' name="estado[]">
						<option value="1" ' . $seleccionar[1] . '>Activo</option>
						<option value="2" ' . $seleccionar[2] . '>Inactivo</option>
					</select>
					</td>
				</tr>';
            }
            $tabla .= '</table><input class="btn btn-complete" type="submit" value="Guardar Cambios"/></form>';
        }
    }
    echo $tabla;
    if ($_REQUEST["tipo"] != 5) {
        ?>
        <script>
            $(document).ready(function () {
                $(".cambio_estado_dependencia").change(function () {
                    var estado = $(this).val();
                    var idft = $(this).attr("data-idft");
                    var idft_ruta_distribucion = $(this).attr("data-idft_ruta_distribucion");
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<? $ruta_db_superior.'formatos/ruta_distribucion/' ?>actualizar_estado_dependencias.php",
                        data: {
                            idft: idft,
                            estado: estado,
                            idft_ruta_distribucion: idft_ruta_distribucion
                        },
                        success: function (datos) {
                            var color = "success";
                            if (!datos.exito) {
                                color = "warning";
                            }
                            top.noty({
                                text: datos.mensaje,
                                type: color,
                                layout: 'topCenter',
                                timeout: 2500
                            });
                            location.reload();
                        }
                    });
                });
            });
        </script>
        <?php
    }
}

function enlace_item_funcionarios_ruta($idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    $dato = busca_filtro_tabla("", "ft_ruta_distribucion A, documento B ", "A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=" . $iddoc, "", $conn);
    if ($_REQUEST['tipo'] != 5) {
        echo '<a class="btn btn-complete" href="' . $ruta_db_superior . 'formatos/funcionarios_ruta/adicionar_funcionarios_ruta.php?pantalla=padre&amp;idpadre=' . $iddoc . '&amp;idformato=' . $idformato . '&amp;padre=' . $dato[0]['idft_ruta_distribucion'] . '" target="_self">Adicionar mensajeros a la Ruta</a>';
    }
}

function mostrar_datos_funcionarios_ruta($idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    $tabla = '';
    $dato = busca_filtro_tabla("idft_ruta_distribucion", "ft_ruta_distribucion A, documento B ", "A.documento_iddocumento=B.iddocumento AND B.estado NOT IN ('ELIMINADO','ANULADO') AND B.iddocumento=" . $iddoc, "", $conn);
    if ($dato['numcampos']) {
        $item = busca_filtro_tabla(fecha_db_obtener("fecha_mensajero", "Y-m-d") . " AS fecha_mensajero,mensajero_ruta,estado_mensajero,idft_funcionarios_ruta", "ft_funcionarios_ruta A, ft_ruta_distribucion B", "idft_ruta_distribucion=ft_ruta_distribucion and A.ft_ruta_distribucion=" . $dato[0]['idft_ruta_distribucion'], "", $conn);

        if ($item['numcampos']) {
            $estado = array(
                1 => "Activo",
                2 => "Inactivo"
            );

            $tabla .= '<table class="table table-bordered">
			<tr>
		    <td style="text-align:center;">Fecha</td>
		    <td style="text-align:center;">Mensajero</td>
		    <td style="text-align:center;">Estado</td>
		    <td style="text-align:center;">Asignar Ruta</td>
			</tr>';

            for ($j = 0; $j < $item['numcampos']; $j++) {
                $array_concat = array(
                    "nombres",
                    "' '",
                    "apellidos"
                );
                $cadena_concat = concatenar_cadena_sql($array_concat);
                $mensajero = busca_filtro_tabla($cadena_concat . ' AS nombre', 'vfuncionario_dc', 'iddependencia_cargo=' . $item[$j]['mensajero_ruta'], '', $conn);

                $boton_asginar_ruta = '<button class="asignar_distribuciones" idft_ruta_distribucion="' . $dato[0]['idft_ruta_distribucion'] . '" mensajero_ruta="' . $item[$j]['mensajero_ruta'] . '" >
					<i class="icon-ok"></i>
				</button>';
                if ($item[$j]['estado_mensajero'] == 2) {
                    $boton_asginar_ruta = '';
                }
                $seleccionar = array(
                    1 => "",
                    2 => ""
                );
                $seleccionar[$item[$j]['estado_mensajero']] = 'selected';
                $tabla .= '<tr>
					<td>' . $item[$j]['fecha_mensajero'] . '</td>
					<td>' . $mensajero[0]['nombre'] . '</td>
					<td>
						<select class="cambio_estado" name="estado[]" data-idft="' . $item[$j]['idft_funcionarios_ruta'] . '"  mensajero_ruta="' . $item[$j]['mensajero_ruta'] . '">
							<option value="1" ' . $seleccionar[1] . '>Activo</option>
							<option value="2" ' . $seleccionar[2] . '>Inactivo</option>
						</select>
					</td>
					<td style="text-align:center;">' . $boton_asginar_ruta . '</td>
				</tr>';
            }
            $tabla .= '</table><br/>';
        }
    }
    echo $tabla;
    ?>
    <script>
        $(document).ready(function () {
            $(".asignar_distribuciones").click(function () {
                var idft_ruta_distribucion = $(this).attr("idft_ruta_distribucion");
                var mensajero_ruta = $(this).attr("mensajero_ruta");
                $.ajax({
                    type: "POST",
                    url: "actualizar_mensajero_distribuciones_inactivas.php",
                    data: {
                        idft_ruta_distribucion: idft_ruta_distribucion,
                        mensajero_ruta: mensajero_ruta
                    },
                    success: function (datos) {
                        top.notification({
                            message: "Se ha asignado este mensajero exitosamente",
                            type: "success",
                            duration: "4000"
                        });
                    }
                });
            });

            $(".cambio_estado").change(function () {
                var estado = $(this).val();
                var idft = $(this).attr("data-idft");
                var mensajero_ruta = $(this).attr("mensajero_ruta");
                $.ajax({
                    type: "POST",
                    url: "actualizar_estado_mensajeros.php",
                    data: {
                        idft: idft,
                        estado: estado,
                        idft_ruta_distribucion: '<?php echo $dato[0]['idft_ruta_distribucion']; ?>',
                        iddependencia_cargo_mensajero: mensajero_ruta
                    },
                    success: function (datos) {
                        top.noty({
                            text: "Estado del funcionario actualizado correctamente",
                            type: "success",
                            layout: 'topCenter',
                            timeout: 4000
                        });
                        location.reload();
                    }
                });
            });
        });
    </script>
    <?php
}

function crear_items_ruta_distribucion($idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    $datos = busca_filtro_tabla("", "ft_ruta_distribucion", "documento_iddocumento=" . $iddoc, "", $conn);
    $dependencias = explode(",", $datos[0]['asignar_dependencias']);
    $mensajeros = explode(",", $datos[0]['asignar_mensajeros']);
    $fecha_almacenar = fecha_db_almacenar(date('Y-m-d'), 'Y-m-d');
    for ($i = 0; $i < count($dependencias); $i++) {
        $busca_dep = busca_filtro_tabla("idft_dependencias_ruta,estado", "ft_dependencias_ruta a,ft_ruta_distribucion b,documento c", "lower(c.estado)='aprobado' AND b.documento_iddocumento=c.iddocumento AND a.ft_ruta_distribucion=b.idft_ruta_distribucion AND  a.estado_dependencia=1 AND a.ft_ruta_distribucion<>" . $datos[0]['idft_ruta_distribucion'] . " AND a.dependencia_asignada=" . $dependencias[$i], "", $conn);
        $estado_dependencia = 1;
        if ($busca_dep['numcampos']) {
            $estado_dependencia = 2;
        }
        $cadena = "INSERT INTO ft_dependencias_ruta (fecha_item_dependenc,dependencia_asignada,estado_dependencia,ft_ruta_distribucion,orden_dependencia) VALUES (" . $fecha_almacenar . "," . $dependencias[$i] . "," . $estado_dependencia . "," . $datos[0]['idft_ruta_distribucion'] . "," . ($i + 1) . ")";
        phpmkr_query($cadena);
    }
    for ($i = 0; $i < count($mensajeros); $i++) {
        $cadena = "INSERT INTO ft_funcionarios_ruta (fecha_mensajero,mensajero_ruta,estado_mensajero,ft_ruta_distribucion) VALUES (" . $fecha_almacenar . "," . $mensajeros[$i] . ",1," . $datos[0]['idft_ruta_distribucion'] . ")";
        phpmkr_query($cadena);
    }
}

function vincular_dependencia_ruta_distribucion($idformato, $iddoc) {//POSTERIOR AL APROBAR
    global $conn, $ruta_db_superior;
    $datos = busca_filtro_tabla("a.idft_ruta_distribucion,b.dependencia_asignada", "ft_ruta_distribucion a, ft_dependencias_ruta b", "b.estado_dependencia=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.documento_iddocumento=" . $iddoc, "", $conn);
    if ($datos['numcampos']) {
        include_once ($ruta_db_superior . "distribucion/funciones_distribucion.php");
        for ($i = 0; $i < $datos['numcampos']; $i++) {
            actualizar_dependencia_ruta_distribucion($datos[$i]['idft_ruta_distribucion'], $datos[$i]['dependencia_asignada'], 1);
        }
    }
}
?>