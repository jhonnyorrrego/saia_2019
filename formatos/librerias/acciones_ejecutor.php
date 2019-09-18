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
include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . "assets/librerias.php";

$campos_auto = explode(",", $_REQUEST["campos_auto"]);
$campos = explode(",", $_REQUEST["campos"]);
$orden_campos_pn = array("titulo", "cargo", "direccion", "telefono", "email");
$orden_campos_pj = array("cargo", "direccion", "telefono", "contacto", "email");

foreach ($campos as $key => $valor) {

  if (array_search(trim($valor), $orden_campos_pj) === false) {
    unset($orden_campos_pj[$id_arreglo1]);
  }

  if (array_search(trim($valor), $orden_campos_pn) === false) {
    unset($orden_campos_pn[$id_arreglo2]);
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
  <?= jquery() ?>
  <?= bootstrap() ?>
  <?= theme() ?>
  <?= notificacion() ?>
  <?= select2() ?>
</head>

<body style="background:white">
  <div>
    <div style="background:white" class="col-12 pl-0">
      <div class="form-group">
        <form name="form1" id="form1">
          <input type="hidden" id="destinos_seleccionados" name="destinos_seleccionados">
          <input type="hidden" id="idejecutor" name="idejecutor_temp" value="">
          <?php
          if (!empty($_REQUEST['iddoc'])) {
            $destinos = busca_filtro_tabla($_REQUEST["campo_autocompletar"], $_REQUEST["tabla"], "documento_iddocumento=" . $_REQUEST["iddoc"], "");

            if ($destinos["numcampos"]) {
              $lista = busca_filtro_tabla("iddatos_ejecutor,nombre", "datos_ejecutor,ejecutor", "ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(" . $destinos[0][0] . ")", "nombre");
            } else {
              echo "<input type=hidden name='iddoc' value='" . $_REQUEST['iddoc'] . "'>";
            }
          }

          if (!empty($_REQUEST["destinos"])) {
            $lista = busca_filtro_tabla("iddatos_ejecutor,nombre", "datos_ejecutor,ejecutor", "ejecutor_idejecutor=idejecutor and iddatos_ejecutor in(" . $_REQUEST["destinos"] . ")", "nombre");
          }

          if ($_REQUEST["tipo"] == "multiple") {
            ?>
            <div id="div_seleccionados_multiple" class="row">
              <div class="col-md-6">
                <div id="div_seleccionados" class="form-group form-group-default-select2">
                  <label class="mb-0" for="estado_actualizacion">Seleccionados:</label>
                  <select style="width:90%;" id="estado_actualizacion" name="seleccionados_ejecutor" varios="true">
                    <option value="0">Listado de Seleccionados...</option>
                    <?php
                      if (isset($lista) && $lista["numcampos"]) {
                        echo ("<optgroup label='Listado de Seleccionados'>");
                        for ($i = 0; $i < $lista["numcampos"]; $i++) {
                          echo "<option value='" . $lista[$i]["iddatos_ejecutor"] . "'>" . $lista[$i]["nombre"] . "</option>";
                        }
                        echo ("</optgroup>");
                      }
                      ?>
                  </select>
                  <span id="eliminar" class="label label-danger" style="cursor:pointer">Quitar</span>
                </div>
              </div>
            </div>
          <?php
          } else if ($_REQUEST["tipo"] == "unico") {
            echo "<label id='estado_actualizacion'>" . @$lista[0]["nombre"] . "</label>";
          }
          ?>
          <div class="row">
            <div class="radio radio-success pl-3 pl-md-0 ">
              <input type="radio" value="1" name="tipo_ejecutor" id="tipo_ejecutor1" checked="checked" class="tipo_ejecutor">
              <label for="tipo_ejecutor1">Persona natural</label>
              <input type="radio" value="2" name="tipo_ejecutor" id="tipo_ejecutor2" value="2" class="tipo_ejecutor">
              <label for="tipo_ejecutor2">Persona Jur&iacute;dica</label>
            </div>
          </div>
          <?php

          echo ('<div id="camposTipoRemitente"></div>');
          echo (campoCiudad('', 'ciudad'));

          if ($_REQUEST["tipo"] == "unico") {
            ?>
            <div id="datos_ejecutor">
              <div class="row">
                <div class="pl-3 pl-md-0">
                  <span id="actualizar" class="label label-success" style="cursor:pointer">Guardar datos</span>
                </div>
                <div class="pl-sm-3 pl-md-1">
                  <span id="editar" class="label label-info hide" style="cursor:pointer">Editar datos</span>
                  <span id="borrar_todos" class="label label-danger" style="cursor:pointer">Limpiar campos</span>
                </div>
              </div>
              <input type="hidden" id="destinos_seleccionados" name="destinos_seleccionados">
            </div>
          <?php
          } else {
            ?>
            <div id="datos_ejecutor">
              <div class="row">
                <div class="pl-3 pl-md-0">
                  <span id="limpiar" class="label label-info" style="cursor:pointer">Adicionar Nuevo</span>
                </div>
                <div class="pl-1">
                  <span id="actualizar" class="label label-success" style="cursor:pointer">Guardar datos</span>
                  <span id="editar" class="label label-info hide" style="cursor:pointer">Editar datos</span>
                </div>
                <div class="pl-3 pl-md-1">
                  <span id="borrar_todos" class="label label-danger" style="cursor:pointer">Quitar todos</span>
                </div>
              </div>

            </div>
          <?php
          }
          ?>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      if ($("#estado_actualizacion").attr("varios")) {
        $("#estado_actualizacion").select2();
      }

      if ($("#estado_actualizacion").find("option").length <= 1) {
        $("#div_seleccionados_multiple").hide();
      }
      $("#pais_ejecutor_ciudad").select2();
      $("#departamento_ejecutor_ciudad").select2();
      $("#ciudad").select2();
      $.ajax({
        type: 'POST',
        url: 'camposRemitente.php',
        dataType: "html",
        data: {
          tipoEjecutor: 1,
          campos: <?php echo (json_encode($orden_campos_pn)) ?>
        },
        success: function(datos) {
          $("#label_nombre").html('Persona Juridica');
          $("#camposTipoRemitente").html(datos);
          $("#nombre_ejecutor").hide();
          $("#nombre_ejecutor").parent().append("<input class='form-control elementos_remitente' type='text' id='buscar_nombre'  name='buscar_nombre' autocomplete='off'><div id='ul_completar' class='ac_results' style='cursor:pointer'></div>");
          $("#buscar_nombre").keyup(function() {
            if ($(this).val() == 0 || $(this).val() == "") {
              top.notification({
                message: "Debe Ingresar el Nombre",
                type: "error",
                timeout: 3000
              });
            } else {
              $("#ul_completar").load("<?php echo $ruta_db_superior; ?>formatos/librerias/seleccionar_ejecutor.php?tipo=nombre", {
                nombre: $(this).val()
              }, function(response) {
                if (response) {
                  $("#ul_completar").html(response);
                } else {
                  $("#nombre_ejecutor").val($("#buscar_nombre").val());
                }
              });
            }
          });
          $("#" + window.frames.name + "", window.parent.document).height($(document).height());
          $("#" + window.frames.name + "", window.parent.document).css("background", "#FFFFFF");
        }
      });

      <?php
      if (@$_REQUEST['funcion_javascript']) {
        $funcion_parametros = explode('@', $_REQUEST['funcion_javascript']);
        if (intval(count($funcion_parametros)) > 1) {
          echo ('' . $funcion_parametros[0] . '(' . $funcion_parametros[1] . ');');
        } else {
          echo ('' . $_REQUEST['funcion_javascript'] . '();');
        }
      }
      ?>

      $("#actualizar").click(function(e) {
        e.preventDefault();
        //titulo_ejecutor
        if ($("#titulo_ejecutor").attr("type") == "text") {
          titulo = $("#titulo_ejecutor").val();
        } else {
          titulo = $("#titulo_ejecutor").find(':selected').val();
        }
        //ciudad residencia
        if ($("#ciudad").attr("type") == "hidden") {
          ciudad = $("#ciudad").val();
        } else {
          ciudad = $("#ciudad").find(':selected').val();
        }

        if ($("#nombre_ejecutor").val() != "") {
          $.ajax({
            type: 'POST',
            url: 'actualizar_ejecutor.php',
            data: {
              seleccionados_ejecutor: $("#seleccionados_ejecutor").val(),
              iddatos_ejecutor: $("#iddatos_ejecutor").val(),
              nombre: $("#nombre_ejecutor").val(),
              campos: "<?php echo $_REQUEST['campos']; ?>",
              titulo: titulo,
              ciudad: ciudad,
              direccion: $("#direccion_ejecutor").val(),
              telefono: $("#telefono_ejecutor").val(),
              cargo: $("#cargo_ejecutor").val(),
              email: $("#email_ejecutor").val(),
              contacto: $("#contacto_ejecutor").val(),
              identificacion: $("#identificacion_ejecutor").val(),
              tipo_ejecutor: $(".tipo_ejecutor:checked").val(),
            },
            success: function(datos, exito) {
              vector = datos.split("|");
              if ("unico" == "<?php echo $_REQUEST['tipo']; ?>") {
                $("#estado_actualizacion").html(vector[1]);
              } else {
                $("#estado_actualizacion").append($("<option>", {
                  value: vector[0],
                  id: vector[0],
                  text: $("#nombre_ejecutor").val()
                }));
                $("#estado_actualizacion option[value=" + vector[0] + "]").attr("selected", true);
                $("#div_seleccionados_multiple").show();
              }
              $("#destinos_seleccionados").val(vector[0]);
              llenar_llamado();
              console.log("2");
              top.notification({
                message: "ATENCI&Oacute;N</b><br>Contacto actualizado satisfactoriamente",
                type: "success",
                timeout: 4000
              });
              //limpiarRemitente();
              $("#buscar_nombre").focus();
              var cantidad = "<?php echo $_REQUEST['tipo'] ?>";
              //if(cantidad == "unico"){
              $("#actualizar").addClass("hide");
              $("#limpiar").removeClass("hide");
              //}
              $(".elementos_remitente").attr("disabled", true);
              $(".elementos_remitente").css("color", "#2c2c2c");
              $("#editar").removeClass("hide");
              $("#" + window.frames.name + "", window.parent.document).height($(document).height());
            }
          });
        } else {
          console.log("3");
          top.notification({
            message: "Debe Ingresar un nombre",
            type: "error",
            timeout: 3000
          });
        }
      });

      $("#limpiar").click(function(e) {
        e.preventDefault();
        limpiarRemitente();
        $("#editar").addClass("hide");
        $(".elementos_remitente").attr("disabled", false);
        $("#actualizar").removeClass("hide");
      });

      $("#borrar_todos").click(function(e) {
        e.preventDefault();
        $("#estado_actualizacion").empty();
        if ("multiple" == "<?php echo $_REQUEST['tipo']; ?>") {
          $("#estado_actualizacion").append('<option value="0">Listado de Seleccionados</option>');
          $("#div_seleccionados_multiple").hide();
        }
        $(".elementos_remitente").attr("disabled", false);
        $("#editar").addClass("hide");
        $("#actualizar").removeClass("hide");
        limpiarRemitente();
      });

      $(".tipo_ejecutor").click(function() {
        $.ajax({
          type: 'POST',
          url: 'camposRemitente.php',
          dataType: "html",
          data: {
            tipoEjecutor: $(this).val()
          },
          success: function(datos) {
            $("#camposTipoRemitente").html(datos);
            $("#nombre_ejecutor").hide();
            $("#nombre_ejecutor").parent().append("<input class='form-control elementos_remitente' type='text' id='buscar_nombre'  name='buscar_nombre' autocomplete='off'><div id='ul_completar' class='ac_results' style='cursor:pointer'></div>");
            $("#buscar_nombre").keyup(function() {
              if ($(this).val() == 0 || $(this).val() == "") {
                top.notification({
                  message: "Debe Ingresar el Nombre",
                  type: "error",
                  timeout: 3000
                });
              } else {
                $("#ul_completar").load("<?php echo $ruta_db_superior; ?>formatos/librerias/seleccionar_ejecutor.php?tipo=nombre", {
                  nombre: $(this).val()
                }, function(response) {
                  if (response) {
                    $("#ul_completar").html(response);
                  } else {
                    $("#nombre_ejecutor").val($("#buscar_nombre").val());
                  }
                });
              }
            });
            $("#" + window.frames.name + "", window.parent.document).height(100);
            $("#" + window.frames.name + "", window.parent.document).height($(document).height());
          }
        });
      });

      $("#editar").click(function(e) {
        $(".elementos_remitente").attr("disabled", false);
        $("#actualizar").removeClass("hide");
        $("#editar").addClass("hide");
        $("#limpiar").addClass("hide");
      });

      $("#eliminar").click(function(e) {
        var f = $("#estado_actualizacion").find(":selected");
        if (f.val() != 0) {
          $("#de_" + f.val()).remove();
          f.remove();
          campo_padre = (parent.<?php echo $_REQUEST["formulario_autocompletar"] . "." . $_REQUEST["campo_autocompletar"]; ?>);
          campo_padre.value = ($("#estado_actualizacion option").map(function() {
            if ($(this).val() !== "0") {
              return $(this).val();
            } else return;
          }).get());
          if ($("#estado_actualizacion").find("option").length <= 1) {
            $("#div_seleccionados_multiple").hide();
          }
        }
      });

      $("#pais_ejecutor_ciudad").change(function() {
        $.ajax({
          type: "POST",
          async: false,
          url: "generar_ciudades.php",
          dataType: "html",
          data: {
            pais: $(this).val()
          },
          success: function(datos) {
            $("#departamento_ejecutor_ciudad").empty();
            $("#departamento_ejecutor_ciudad").append(datos);
            $("#ciudad").empty();
          }
        });
      });

      $("#departamento_ejecutor_ciudad").change(function() {
        $.ajax({
          type: "POST",
          async: false,
          url: "generar_ciudades.php",
          dataType: "html",
          data: {
            departamento: $(this).val()
          },
          success: function(datos) {
            $("#ciudad").empty();
            $("#ciudad").append(datos);
          }
        });
      });

      $("#nuevo_municipio_ciudad").click(function() {
        codigo = "<div class=\"row\" id=\"nuevaCiudad\"><div class=\"col-md-4\"><div class=\"form-group form-group-default\"><label for=\"pais\">Pais</label><input type=\"text\" class=\"form-control\"  id=\"pais_ciudad\" name=\"pais_ciudad\"></div></div><div class=\"col-md-4\"><div class=\"form-group form-group-default\"><label for=\"Departamento\">Departamento</label><input type=\"text\" class=\"form-control\"  id=\"depto_ciudad\" name=\"depto_ciudad\"></div></div><div class=\"col-md-4\"><div class=\"form-group form-group-default\"><label for=\"Municipio\">Municipio</label><input type=\"text\" class=\"form-control\"  id=\"municipio_ciudad\" name=\"municipio_ciudad\"></div></div><div class=\"pl-sm-3 pl-md-0\"><span class=\"label label-success\" style=\"cursor:pointer\"><a style=\"color:#FFFFFF;\" href=\"JavaScript:boton_guardar_ciudad();\" id=\"guardar_municipio_ciudad\" >Guardar Ciudad</a></span> <span class=\"label label-danger\" style=\"cursor:pointer\"><a style=\"color:#FFFFFF;\" href=\"JavaScript:boton_cancelar_ciudad();\" id=\"cancelar_municipio_ciudad\" >Cancelar</a></span></div>";
        $("#div_ciudad_ejecutor").after(codigo);
        $("#div_ciudad_ejecutor").hide();
      });
    });

    function iddatos_ejecutor(idejecutor, nombre) {
      $("#idejecutor").val(idejecutor);
      $.ajax({
        type: 'POST',
        url: 'ultimo_dato_ejecutor.php',
        data: 'idejecutor=' + idejecutor,
        success: function(datos, exito) {
          vector = datos.split("|");
          $("#destinos_seleccionados").val(vector[1]);
          $("#estado_actualizacion").html(nombre);
          llenar_llamado();
        }
      });
    }

    function limpiarRemitente() {
      $("#nombre_ejecutor").val("");
      $("#buscar_nombre").val("");
      $("#identificacion_ejecutor").val("");
      $("#titulo_ejecutor").val("");
      $("#cargo_ejecutor").val("");
      $("#direccion_ejecutor").val("");
      $("#telefono_ejecutor").val("");
      $("#email_ejecutor").val("");
      $("#contacto_ejecutor").val("");
      $("#destinos_seleccionados").val("");
      $('#titulo_ejecutor').val(0).trigger('change.select2');
    }


    function llenar_llamado() {
      <?php
      if (@$_REQUEST["formulario_autocompletar"] && @$_REQUEST["campo_autocompletar"]) {
        echo ('var campo=window.parent.document.' . $_REQUEST["formulario_autocompletar"] . '.' . $_REQUEST["campo_autocompletar"] . ";");
      }
      ?>
      if ($("#destinos_seleccionados").val() > 0) {
        if (campo.value == "" || "unico" == "<?php echo $_REQUEST['tipo']; ?>")
          campo.value = $("#destinos_seleccionados").val();
        else
          campo.value += "," + $("#destinos_seleccionados").val();
      }
    }

    function cargar_datos(idejecutor, nombre, identificacion, direccion, titulo, telefono, cargo, email, ciudad) {
      $("#ul_completar").empty();

      if (idejecutor != 0) {
        $("#identificacion_ejecutor").val(identificacion);
        $("#direccion_ejecutor").val(direccion);
        $("#nombre_ejecutor").val(nombre);
        $("#buscar_nombre").val(nombre);
        $("#telefono_ejecutor").val(telefono);
        $("#cargo_ejecutor").val(cargo);
        $("#email_ejecutor").val(email);
        tipoTitulos = ["Se&ntilde;or", "Se&ntilde;ora", 'Doctor', 'Doctora', 'Ingeniero', 'Ingeniera'];
        if (tipoTitulos.indexOf(titulo) > 0) {
          $("#titulo_ejecutor option[value=" + titulo + "]").attr("selected", true);
        } else {
          $("#titulo_ejecutor").append('<option value="' + titulo + '">' + titulo + '</option>');
          $("#titulo_ejecutor option[value=" + titulo + "]").attr("selected", true);
        }
        $('#titulo_ejecutor').val(titulo).trigger('change.select2');

        $.ajax({
          type: 'POST',
          async: false,
          url: 'seleccionar_ejecutor.php',
          dataType: "json",
          data: {
            datosCiudad: ciudad
          },
          success: function(datos) {
            $('#pais_ejecutor_ciudad').val(0).trigger('change.select2');
            $('#pais_ejecutor_ciudad').val(datos.pais).trigger('change.select2');
            $('#pais_ejecutor_ciudad').trigger("change");
            setTimeout("$('#departamento_ejecutor_ciudad').val(" + datos.departamento + ").trigger('change.select2'); $('#departamento_ejecutor_ciudad').trigger('change')", 1200);
            setTimeout("$('#ciudad').val(" + ciudad + ").trigger('change.select2')", 1700);
          }
        });

        $("#actualizar").trigger("click");
      }
    };

    function eliminar_asociado(idejecutor) {
      $("#fila_" + idejecutor).remove();
      var datos = $("#nombre_ejecutor").val().split(",");
      var cantidad = datos.length;
      var nuevos_datos = new Array();
      var a = 0;
      for (var i = 0; i < cantidad; i++) {
        if (idejecutor != datos[i]) {
          nuevos_datos[a] = datos[i];
          a++;
        }
      }
      var datos_guardar = nuevos_datos.join(",");
      $("#nombre_ejecutor").val(datos_guardar);
    }
  </script>
  <script src="../../assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
  <script src="../../assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <script type="text/javascript" src="../../assets/theme/assets/plugins/select2/js/select2.full.min.js"></script>
</body>

</html>
<?php
if (@$_REQUEST['funcion']) {
  $funcion_parametros = explode('@', $_REQUEST['funcion']);
  if (count($funcion_parametros) > 1) {
    echo ($funcion_parametros[0](implode(',', $funcion_parametros[1])));
  } else {
    echo ($_REQUEST['funcion']());
  }
}


function campoCiudad($ciudad = null, $campo)
{
  
  if (!$ciudad) {
    $ciudad_conf = busca_filtro_tabla("valor", "configuracion", "nombre='ciudad'", "");
    if ($ciudad_conf["numcampos"]) {
      $ciudad_valor = $ciudad_conf[0]["valor"];
    } else {
      $ciudad_valor = "658";
    }
  } else
    $ciudad_valor = $ciudad;

  $municipio = Model::getQueryBuilder()
    ->select(["idmunicipio", "iddepartamento", "idpais"])
    ->from("municipio", "A")
    ->join("A", "departamento", "B", "A.departamento_iddepartamento=B.iddepartamento")
    ->join("B", "pais", "C", "C.idpais=B.pais_idpais")
    ->where("A.idmunicipio=:idmunicipio")
    ->setParameter(":idmunicipio", $ciudad_valor)->execute()->fetchAll();

  if (count($municipio)) {
    $paises = busca_filtro_tabla("", "pais", "", "lower(nombre)");
    $departamentos = busca_filtro_tabla("", "departamento", "pais_idpais=" . $municipio[0]["idpais"], "lower(nombre)");
    $municipios = busca_filtro_tabla("", "municipio", "departamento_iddepartamento=" . $municipio[0]["iddepartamento"], "lower(nombre)");

    $texto = '
		<div id="div_ciudad_ejecutor">
		<div class="row" id="div_select_' . $campo . '_ciudades">
			<div class="col-md-4">
				<div class="form-group form-group-default-select2">
					<label class="mb-0" for="pais_ejecutor_' . $campo . '">Pais</label>
					<select style="width: 100%;" name="pais_ejecutor_' . $campo . '" id="pais_ejecutor_' . $campo . '" >';

    for ($i = 0; $i < $paises["numcampos"]; $i++) {
      $texto .= '<option value="' . $paises[$i]["idpais"] . '"';
      if ($paises[$i]["idpais"] == $municipio[0]["idpais"]) {
        $texto .= " SELECTED ";
      }
      $texto .= ">" . $paises[$i]["nombre"] . '</option>';
    }

    $texto .= '
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group form-group-default-select2">
					<label class="mb-0" for="departamento_ejecutor_' . $campo . '">Departamento</label>	
					<select style="width: 100%;" name="departamento_ejecutor_' . $campo . '" id="departamento_ejecutor_' . $campo . '" >';

    for ($i = 0; $i < $departamentos["numcampos"]; $i++) {
      $texto .= '<option value="' . $departamentos[$i]["iddepartamento"] . '"';
      if ($departamentos[$i]["iddepartamento"] == $municipio[0]["iddepartamento"]) {
        $texto .= " SELECTED ";
      }
      $texto .= ">" . $departamentos[$i]["nombre"] . '</option>';
    }

    $texto .= '
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group form-group-default-select2">
					<label class="mb-0" for="' . $campo . '">Municipio</label>
					<select style="width: 100%;" name="' . $campo . '" id="' . $campo . '" >';

    for ($i = 0; $i < $municipios["numcampos"]; $i++) {
      $texto .= '<option value="' . $municipios[$i]["idmunicipio"] . '"';
      if ($municipios[$i]["idmunicipio"] == $municipio[0]["idmunicipio"]) {
        $texto .= " SELECTED ";
      }
      $texto .= ">" . $municipios[$i]["nombre"] . '</option>';
    }
    $texto .= '
					</select>
				</div>
			</div>
			<br class="col-md-4 pl-sm-3 pl-md-3">
				<span class="label label-success" style="cursor:pointer;" id="nuevo_municipio_' . $campo . '">Agregar Ciudad</span></br>
			</div>
		</div>
	</div>';
  }
  return ($texto);
}

?>
<script type="text/javascript">
  function boton_guardar_ciudad() {
    parametros = "formato=1&pais=" + $("#pais_ciudad").val() + "&provincia=" + $("#depto_ciudad").val() + "&ciudad=" + $("#municipio_ciudad").val();

    if ($("#pais_ciudad").val() && $("#depto_ciudad").val() && $("#municipio_ciudad").val()) {
      $.ajax({
        type: 'POST',
        url: 'generar_ciudades.php',
        data: parametros,
        success: function(datos, exito) {
          $.ajax({
            type: "POST",
            async: false,
            url: "generar_ciudades.php",
            dataType: "html",
            data: {
              ubicacion: 1
            },
            success: function(datos) {
              $("#pais_ejecutor_ciudad").empty();
              $("#departamento_ejecutor_ciudad").empty();
              $("#ciudad").empty();
              $("#pais_ejecutor_ciudad").append(datos);
              top.notification({
                message: "Nuevos datos almacenados",
                type: "success",
                timeout: 3000
              });
              boton_cancelar_ciudad();
            }
          });
        }
      });
    } else {
      top.notification({
        message: "Los campos Pais, Departamento y Municipio son obligatorios",
        type: "error",
        timeout: 3000
      });
    }
  }

  function boton_cancelar_ciudad() {
    $("#nuevaCiudad").html("");
    $("#div_ciudad_ejecutor").show();
  }
</script>