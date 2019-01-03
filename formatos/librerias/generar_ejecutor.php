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
include_once ($ruta_db_superior ."db.php");
include_once ($ruta_db_superior . "assets/librerias.php");
echo jquery();
echo bootstrap();
echo jqueryUi();
echo icons();
?>
<link href="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../../assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
<link class="main-stylesheet" href="../../assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
<?php
$campos = explode(",", $_REQUEST["campos"]);
$etiquetas = array("titulo" => "T&iacute;tulo","cargo" => "Cargo", "direccion" => "Direcci&oacute;n", "telefono" => "Tel&eacute;fono", "email" => "Email", "ciudad" => "Ciudad", "empresa" => "Contacto", "identificacion" => "Identificaci&oacute;n", "nombre" => "Nombres y apellidos", "nombre_pj" => "Entidad");
$texto .= '<div class="">';
foreach ($campos as $nombre) {
	if ($nombre <> '')
		$texto .= crear_campo($nombre);
}
$texto .= '</div>';
echo $texto;

function crear_campo($nombre) {
	global $conn, $etiquetas;
	if ($nombre == "fecha_nacimiento")
		$datos_ejecutor = busca_filtro_tabla(fecha_db_obtener($nombre, "Y-m-d") . " as fecha_nacimiento", "datos_ejecutor,ejecutor", "ejecutor_idejecutor=idejecutor and ejecutor_idejecutor=" . $_REQUEST["idejecutor"], "fecha desc", $conn);
	else
		$datos_ejecutor = busca_filtro_tabla($nombre, "datos_ejecutor,ejecutor", "ejecutor_idejecutor=idejecutor and ejecutor_idejecutor=" . $_REQUEST["idejecutor"], "fecha desc", $conn);
    if ($nombre != "titulo" && $nombre != "ciudad") {
        $texto = '<div class="row">
        <label id="label_' . $nombre . '" class="control-label col-5">' . $etiquetas[$nombre] . ':</label>';
    }
	if ($nombre == "titulo") {
	    $texto .= '<div class="row" id="div_titulo_ejecutor"><label id="label_' . $nombre . '" class="control-label col-5">' . $etiquetas[$nombre] .':</label><div id="div_select_titulo_ejecutor" class="col-5">
<script type="text/javascript">
    $("#otro_titulo_ejecutor").click(function() {
		$("#div_select_titulo_ejecutor").empty();
		$("#div_select_titulo_ejecutor").append(' . "'" . '<input type="text"  name="titulo_ejecutor" id="titulo_ejecutor" value="">' . "'" . ');
	});	
	</script>
	<script src="../../assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="../../assets/theme/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../../assets/theme/pages/js/pages.js"></script>
        <select style="width:90%" data-init-plugin="select2" name="titulo_ejecutor" id="titulo_ejecutor">';
		$titulos = array("Se&ntilde;or", "Se&ntilde;ora", 'Doctor', 'Doctora', 'Ingeniero', 'Ingeniera');
		if (!in_array(@$datos_ejecutor[0][$nombre], $titulos))
			$titulos[] = @$datos_ejecutor[0][$nombre];
		for ($i = 0; $i < count($titulos); $i++) {
			$texto .= '<option value="' . $titulos[$i] . '"';
			if ($titulos[$i] == @$datos_ejecutor[0][$nombre])
				$texto .= ' selected ';
			$texto .= '>' . $titulos[$i] . '</option>';
		}
		$texto .= '
        </select></div><div class="col-auto"><span class="label label-success" id="otro_titulo_ejecutor" style="cursor:pointer">Otro</span>
      </div></div>';
	} elseif ($nombre == "ciudad" || $nombre == "lugar_expedicion" || $nombre == "lugar_nacimiento") {
        $texto .= '<div id="div_' . $nombre . '_ejecutor" class="row">';
        if ($nombre == "ciudad") {
            $texto .= '<label id="label_' . $nombre . '" class="control-label col-5">' . $etiquetas[$nombre] . ':</label>';
        }
	    $texto .=  generar_ciudad(@$datos_ejecutor[0][$nombre], $nombre) . '';
	} elseif ($nombre == "estudios") {
	    $texto .= '<textarea style="font-size:x-small;font-family:verdana" id="' . $nombre . '_ejecutor" cols=35 rows=2>' . @$datos_ejecutor[0][$nombre] . '</textarea>';
	} elseif ($nombre == "fecha_nacimiento") {
		include_once ("../../calendario/calendario.php");
		if (@$datos_ejecutor[0][$nombre] <> "0000-00-00" && @$datos_ejecutor[0][$nombre] <> "")
			$valor = $datos_ejecutor[0][$nombre];
		else
			$valor = "0000-00-00";
		$texto .= '<input type="text" readonly="true" name="' . $nombre . '" id="' . $nombre . '" value="' . $valor . '">&nbsp;&nbsp;&nbsp;<a href="javascript:showcalendar(\'' . $nombre . '\',\'form1\',\'Y-m-d\',\'../../calendario/selec_fecha.php?nombre_campo=' . $nombre . '&nombre_form=form1&formato=Y-m-d&anio=' . date('Y') . '&mes=' . date('m') . '&css=default.css\',220,225)" ><img src="../../calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /></a>';
	} elseif ($nombre == "tipo_documento" || $nombre == "estado_civil" || $nombre == "sexo") {
		if ($nombre == "tipo_documento") {
			if (!$datos_ejecutor["numcampos"])
				$datos_ejecutor[0][$nombre] = 1;
			$opciones = array("Seleccionar...", "C&eacute;dula de Ciudadan&iacute;a", "C&eacute;dula de Extranjer&iacute;a", "Tarjeta de identidad", "C&eacute;dula Militar", "Pasaporte");
		} elseif ($nombre == "estado_civil")
			$opciones = array("Seleccionar...", "Casado", "Divorciado", "Soltero", "Union Libre", "Viudo");
		elseif ($nombre == "sexo")
			$opciones = array("Seleccionar...", "Femenino", "Masculino");

		$texto .= '<select style="width:50%;" data-init-plugin="select2"  name="' . $nombre . '" id="' . $nombre . '_ejecutor">';
		for ($i = 0; $i < count($opciones); $i++) {$texto .= '<option value="' . $i . '" ';
			if ($i == @$datos_ejecutor[0][$nombre])
				$texto .= ' selected ';
			$texto .= ' >' . $opciones[$i] . '</option>';
		}
		$texto .= '';
	} else
		$texto .= '
      <input type="text"  class="col-6" id="' . $nombre . '_ejecutor" name="cargo_ejecutor" value="' . @$datos_ejecutor[0][$nombre] . '"></div>
    ';
	return ($texto);
}

function generar_ciudad($ciudad, $campo) {
	global $conn;
	if (!$ciudad) {$ciudad_conf = busca_filtro_tabla("valor", "configuracion", "nombre='ciudad'", "", $conn);
		if ($ciudad_conf["numcampos"]) {
			$ciudad_valor = $ciudad_conf[0][0];
		} else {
			$ciudad_valor = "658";
		}
	} else
		$ciudad_valor = $ciudad;
	$municipio = busca_filtro_tabla("idmunicipio,iddepartamento,idpais", "municipio A,departamento B, pais C", "A.departamento_iddepartamento=B.iddepartamento AND C.idpais=B.pais_idpais AND A.idmunicipio=" . $ciudad_valor, "", $conn);
	if ($municipio["numcampos"]) {
		$paises = busca_filtro_tabla("", "pais", "", "lower(nombre)", $conn);
		$departamentos = busca_filtro_tabla("", "departamento", "pais_idpais=" . $municipio[0]["idpais"], "lower(nombre)", $conn);
		$municipios = busca_filtro_tabla("", "municipio", "departamento_iddepartamento=" . $municipio[0]["iddepartamento"], "lower(nombre)", $conn);
		$texto = '<script src="../../assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="../../assets/theme/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../../assets/theme/pages/js/pages.js"></script><script type="text/javascript">
    $("#pais_ejecutor_' . $campo . '").change(function(){
      actualiza_ciudad_' . $campo . '($("#pais_ejecutor_' . $campo . '").find(' . "':selected'" . ').val(),0);
    });
    
    function boton_guardar_' . $campo . '()
    { parametros="formato=1&pais="+$("#pais_' . $campo . '").val()+"&provincia="+$("#depto_' . $campo . '").val()+"&ciudad="+$("#municipio_' . $campo . '").val();

     if($("#pais_' . $campo . '").val()&&$("#depto_' . $campo . '").val()&&$("#municipio_' . $campo . '").val())
     {$.ajax({
        type:' . "'POST'" . ',
        url:' . "'../../municipioadd.php'" . ',
        data: parametros,
        success: function(datos,exito){
          $("#div_' . $campo . '_ejecutor").html("<input class=\"col-4\" type=\"hidden\" name=\"' . $campo . '\" id=\"' . $campo . '\" value="+datos+">"+$("#municipio_' . $campo . '").val());
        }
      });
     }
     else
      {alert("Faltan datos por llenar");}
    }
    $("#nuevo_municipio_' . $campo . '").click(function(){
        codigo="<label class=\"control-label col-5\">Pais</label><input class=\"col-4\"  type=\"text\" id=\"pais_' . $campo . '\" class=\"form-control\"><label class=\"control-label col-5\">Estado/Provincia</label><input class=\"col-4\"  type=\"text\" id=\"depto_' . $campo . '\" class=\"form-control\"><label class=\"control-label col-5\">Ciudad</label><input class=\"col-4\" type=\"text\" id=\"municipio_' . $campo . '\" class=\"form-control\"><a href=\"JavaScript:boton_guardar_' . $campo . '();\" id=\"guardar_municipio_' . $campo . '\" >Guardar</a>";
        $("#div_' . $campo . '_ejecutor").html(codigo);
    });
    $("#departamento_ejecutor_' . $campo . '").change(function(){
      actualiza_ciudad_' . $campo . '($("#pais_ejecutor_' . $campo . '").find(' . "':selected'" . ').val(),$("#departamento_ejecutor_' . $campo . '").find(' . "':selected'" . ').val());
    });
    function actualiza_ciudad_' . $campo . '(pais,departamento){
      $.ajax({
        type:' . "'POST'" . ',
        url:' . "'../librerias/generar_ciudades.php'" . ',
        data:' . "'pais='+pais+'&departamento='+departamento+'&campo=" . $campo . "'," . '
        success: function(datos,exito){
        
          $("#div_titulo_ejecutor").find(".select2").remove();
          $("#div_seleccionados_multiple").find(".select2").remove();
          $("#div_select_' . $campo . '_ciudades").empty();
          $("#div_select_' . $campo . '_ciudades").append(datos);
        }
      });
    }
  </script>';
		$texto .= '<div class="row" id="div_select_' . $campo . '_ciudades"><div class="col-auto px-1"><select  name="pais_ejecutor_' . $campo . '" id="pais_ejecutor_' . $campo . '"  data-init-plugin="select2">';
		for ($i = 0; $i < $paises["numcampos"]; $i++) {
			$texto .= '<option value="' . $paises[$i]["idpais"] . '"';
			if ($paises[$i]["idpais"] == $municipio[0]["idpais"])
				$texto .= " SELECTED ";
			$texto .= ">" . $paises[$i]["nombre"] . '</option>';
		}
		$texto .= '</select></div><div class="col-auto px-1"><select  name="departamento_ejecutor_' . $campo . '" id="departamento_ejecutor_' . $campo . '"  data-init-plugin="select2">';
		for ($i = 0; $i < $departamentos["numcampos"]; $i++) {
			$texto .= '<option value="' . $departamentos[$i]["iddepartamento"] . '"';
			if ($departamentos[$i]["iddepartamento"] == $municipio[0]["iddepartamento"])
				$texto .= " SELECTED ";
			$texto .= ">" . $departamentos[$i]["nombre"] . '</option>';
		}
		$texto .= '</select></div><div class="col-auto px-1"><select name="' . $campo . '" id="' . $campo . '"  data-init-plugin="select2">';
		for ($i = 0; $i < $municipios["numcampos"]; $i++) {
			$texto .= '<option value="' . $municipios[$i]["idmunicipio"] . '"';
			if ($municipios[$i]["idmunicipio"] == $municipio[0]["idmunicipio"])
				$texto .= " SELECTED ";
			$texto .= ">" . $municipios[$i]["nombre"] . '</option>';
		}
		$texto .= '</select></div><div class="col-auto px-1"><span class="label label-success" style="cursor:pointer;" id="nuevo_municipio_' . $campo . '">Otro</span></div></div>';

	}
	return ($texto);
}
?>

