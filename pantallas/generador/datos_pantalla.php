<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta .= "../";
  $max_salida--;
}

////// Ya se han cargado en generador_pantalla.php

//include_once $ruta_db_superior . 'core/autoload.php';
//include_once $ruta_db_superior . "librerias_saia.php";
//include_once $ruta_db_superior . "pantallas/lib/librerias_componentes.php";
//include_once $ruta_db_superior . "pantallas/generador/librerias_pantalla.php";
//include_once $ruta_db_superior . "arboles/crear_arbol_ft.php";
//include_once $ruta_db_superior . "assets/librerias.php";

//////////////////////////////////////////////////////////////////////////

echo librerias_notificaciones();
echo select2();
echo librerias_UI("1.12");

if ($_REQUEST['idformato']) {
  $formato = busca_filtro_tabla("", "formato", "idformato=" . $_REQUEST['idformato'], "", $conn);
  $formato = procesar_cadena_json($formato, array("cuerpo", "ayuda", "etiqueta"));
  $cod_padre = $formato[0]["cod_padre"];

  $cod_proceso_pertenece = $formato[0]["proceso_pertenece"];
  $categoria = $formato[0]["fk_categoria_formato"];
  if ($formato[0]["tiempo_autoguardado"] > 3000) {
    $formato[0]["tiempo_autoguardado"] = $formato[0]["tiempo_autoguardado"] / 60000;
  }
  $funcionPredeterminada = strpos($formato[0]['funcion_predeterminada'], "1");
  $checkResponsables = '';
  if ($funcionPredeterminada !== false) {
    $checkResponsables = "checked";
  }
  //$formato = json_encode($formato);
  if ($cod_proceso_pertenece) {
    $adicional_cod_proceso = "&seleccionado=" . $cod_proceso_pertenece;
  }
  if ($cod_padre) {
    $nombre_cod_padre = busca_filtro_tabla("", "formato a", "a.idformato=" . $cod_padre, "", $conn);
    $adicional_cod_padre = "&seleccionado=" . $cod_padre;
  }
  if ($categoria) {
    $nombre_categoria = busca_filtro_tabla("", "categoria_formato a", "a.idcategoria_formato IN($categoria)", "", $conn);
    $adicional_categoria = "&seleccionado=" . $categoria;
  }

  $origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("id" => $_REQUEST['id'], "excluido" => $_REQUEST['idformato'], "seleccionados" => $cod_padre, "seleccionable" => "radio"));
  $opciones_arbol = array("keyboard" => true, "selectMode" => 1, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => radio);
  $extensiones = array("filter" => array());
  $arbol = new ArbolFt("codigo_padre_formato", $origen, $opciones_arbol, $extensiones, $validaciones);

  $origenCategoria = array("url" => "arboles/arbol_categoria_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("tipo" => "1", "seleccionados" => $formato[0]["fk_categoria_formato"], "seleccionable" => "checkbox"));
  $opcionesArbolCategoria = array("keyboard" => true, "selectMode" => 3, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => checkbox);
  $extensionesCategoria = array("filter" => array());
  $arbolCategoria = new ArbolFt("fk_categoria_formato", $origenCategoria, $opcionesArbolCategoria, $extensionesCategoria, $validaciones);
} else {

  $origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("seleccionable" => "radio"));
  $opciones_arbol = array("keyboard" => true, "selectMode" => 1, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => radio);
  $extensiones = array("filter" => array());
  $arbol = new ArbolFt("codigo_padre_formato", $origen, $opciones_arbol, $extensiones, $validaciones);

  $origenCategoria = array("url" => "arboles/arbol_categoria_formatos.php", "ruta_db_superior" => $ruta_db_superior, "params" => array("tipo" => "1", "seleccionado" => $formato[0]["fk_categoria_formato"], "seleccionable" => "checkbox"));
  $opcionesArbolCategoria = array("keyboard" => true, "selectMode" => 3, "seleccionarClick" => 1, "busqueda_item" => 1, "checkbox" => checkbox);
  $extensionesCategoria = array("filter" => array());
  $arbolCategoria = new ArbolFt("fk_categoria_formato", $origenCategoria, $opcionesArbolCategoria, $extensionesCategoria, $validaciones);
}

$tipoDocumental = busca_filtro_tabla("", "serie", "tipo=3 and estado=1", "lower(nombre)", $conn);


/**
 * Esta funcion puede servir para
 */
function procesar_cadena_json($resultado, $lista_valores)
{
  for ($i = 0; $i < $resultado["numcampos"]; $i++) {
    $busqueda = $resultado[$i];
    foreach ($busqueda as $key => $valor) {
      if (is_numeric($key)) {
        unset($busqueda[$key]);
      } else if (in_array($key, $lista_valores)) {
        $busqueda[$key] = str_replace("\n", "", $busqueda[$key]);
        $busqueda[$key] = str_replace("\r", "", $busqueda[$key]);
        $busqueda[$key] = html_entity_decode($busqueda[$key]);
        $busqueda[$key] = addslashes($busqueda[$key]);
      }
    }
    $resultado[$i] = $busqueda;
  }
  return ($resultado);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <style type="text/css">
    .arbol_saia>.containerTableStyle {
      overflow: hidden;
    }

    ul.fancytree-container {
      overflow: auto;
      position: relative;
      border: none !important;
      outline: none !important;
    }

    span.fancytree-title {
      font-family: Ubuntu, sans-serif;
      font-size: 12px;
    }

    span.fancytree-checkbox.fancytree-radio {
      vertical-align: middle;
    }

    span.fancytree-expander {
      vertical-align: middle !important;
    }
  </style>

  <script type="text/javascript" src="<?= $ruta_db_superior ?>pantallas/generador/editar_componente_generico.js"></script>

</head>

<body>

  <form name="datos_formato" id="datos_formato">
    <div class="row mx-4 mb-1">

      <div class="col-9">
        <div class="title my-0">
          Información general
        </div>
        <hr />

        <input type="hidden" name="nombre_formato" id="nombre_formato" value="" required>
        <div class="row-fluid">

          <div class="my-3">
            <label class="control-label" for="etiqueta"><strong>Nombre del formato<span class="require-input">*</span></strong></label>
            <input type="text" class="col-12" name="etiqueta" id="etiqueta_formato" placeholder="Nombre" value="" required <?php if ($_REQUEST["idformato"]) echo ("readonly"); ?>>

          </div>

          <?php
          $valor_item = 0;
          $valor_mostrar = "0";

          if ($formato["numcampos"]) {
            $valor_item = $formato[0]["item"];
            $valor_mostrar = $formato[0]["mostrar_pdf"];
            $descripcionFormato = html_entity_decode($formato[0]["descripcion_formato"]);
          }
          ?>


          <div class="my-3">
            <label class="control-label" for="descripcion"><strong>Descripci&oacute;n del formato</strong><span class="require-input">*</span></label>

            <textarea class="col-12" name="descripcion_formato" id="descripcion_formato" placeholder="Descripci&oacute;n" rows="3" required></textarea>

          </div>

          <div class="my-3">
            <div class="row">
              <div class="col-9">
                <label class="control-label" for="serie_idserie"><strong>Tipo documental asociado</strong></label>
                <div id="select_serie">
                  <div id="esperando_arbol_serie_formato"></div>

                  <select style="width:100%;" name="serie_idserie" id="serie_idserie">
                    <?php
                    $tipo = '';
                    for ($i = 0; $i < $tipoDocumental["numcampos"]; $i++) {
                      echo '<option value="' . $tipoDocumental[$i]["idserie"] . '" class="codigoSerie" codigo="' . $tipoDocumental[$i]["codigo"] . '" >' . ucwords(strtolower($tipoDocumental[$i]["nombre"])) . '</option>';
                    }
                    ?>
                  </select>

                  <div id="treebox_arbol_serie_formato" class="arbol_saia"></div>

                  <?php
                  /// buscando error!!! 
                  //crear_arbol("arbol_serie_formato", $url);
                  ?>
                </div>
              </div>
              <div class="my-1 col-3">
                <div>
                  <strong>C&oacute;digo</strong>
                </div>
                <div class="my-2">
                  <input type="text" disabled id="codigoSerieInput" style="background:#fff;height:36px;width:100%" />
                </div>
              </div>
            </div>
          </div>


          <div class="col 12">

            <label class="control-label" for="codigo_padre" data-toggle="tooltip" title="Seleccione el formato principal al cual pertenece"><strong>Relaci&oacute;n con otro Formato</strong></label>

            <?php echo ($nombre_cod_padre[0]["etiqueta"]); ?>
            <div class="col-6">
              <input id="codigo_padre_formato" type="hidden" name="cod_padre" value="<?php echo ($cod_padre); ?>">
              <?= $arbol->generar_html() ?>
            </div>



          </div>


          <div class="col-12 my-4">
            <div class="col-12">
              <label for="banderas"><strong>Atributos del formato</strong></label>
            </div>
            <div class="col-12">
              <input type="checkbox" class="paginar" name="paginar" id="paginar" <?php check_banderas('paginar'); ?>><span class="paginar">Paginar al mostrar</span>
              <input type="checkbox" name="banderas[]" id="banderas" <?= check_banderas('aprobacion_automatica'); ?>>Aprobacion Automatica
              <input type="checkbox" name="banderas[]" style="display:none;" id="banderas" <?php check_banderas('asunto_padre'); ?> checked>
              <input type="checkbox" class="tipo_edicion" name="tipo_edicion" id="tipo_edicion" <?php check_banderas('tipo_edicion'); ?>><span class="tipo_edicion">Edicion Continua</span>
              <!--<input type="checkbox" name="mostrar" id="mostrar" <?php check_banderas('mostrar'); ?>>Mostrar-->

              <!--Tomar el asunto del padre al responder-->
            </div>

            <input type="hidden" name="mostrar" id="mostrar" <?php check_banderas('mostrar', false); ?>>
            <input type="hidden" name="paginar" id="paginar" <?php check_banderas('paginar', false); ?>>



          </div>

        </div>

      </div>

      <div class="col-3 my-4 pl-4">

        <div class="my-3 pt-3">

          <label class="control-label" for="version"><strong>Versi&oacute;n<span class="require-input">*</span></strong></label>
          <div class="my-0">
            <input type="text" name="version" id="version" placeholder="Versi&oacute;n" value="" style="height:44px;width:100%;" required>
          </div>

        </div>

        <div class="my-0">

          <label class="control-label" for="tipos"><strong>Tipo de registro<span class="require-input">*</span></strong></label>
          <div class="my-0">
            <select style="height:44px;width:100%;" name="tipo_registro" id="tipo_registro" data-toggle="tooltip">
              <option value="">Por favor seleccione</option>
              <option value="1">Documento oficial (PDF)</option>
              <option value="2">Registro de apoyo</option>
              <option value="3">Registro del tipo Item</option>
            </select>
          </div>

        </div>

        <div class="my-3">

          <label class="control-label" for="mostrar_tipodoc_pdf">&nbsp;</label>
          <div class="my-1 py-2">
            <input type="checkbox" name="mostrar_tipodoc_pdf" id="mostrar_tipodoc_pdf" value="1" <?php if (@$formato[0]["mostrar_tipodoc_pdf"] == 1) echo (' checked="checked"'); ?>>
            <span id="texto_tipodoc">Mostrar código en el nombre del Formato.</span>
          </div>

        </div>

        <div class="my-3 py-3">

          <label class="control-label" for="contador"><strong>Consecutivo asociado<span class="require-input">*</span></strong></label>
          <div class="mt-4">
            <select style="height:44px;width:100%" name="contador_idcontador" data-toggle="tooltip" title="Escoja un contador" id="contador_idcontador" required>
              <?php
              $contadores = busca_filtro_tabla("", "contador", "nombre<>'' and estado=1", "nombre", $conn);
              $reinicia_contador = 1;
              for ($i = 0; $i < $contadores["numcampos"]; $i++) {
                echo ('<option value="' . $contadores[$i]["idcontador"] . '"');
                if ($formato[0]["contador_idcontador"] == $contadores[$i]["idcontador"]) {
                  echo (" selected='selected' ");
                  $reinicia_contador = $contadores[$i]["reiniciar_cambio_anio"];
                }
                echo ('>' . $contadores[$i]["etiqueta_contador"] . '</option>');
              }
              ?>
            </select>
          </div>

        </div>

      </div>

    </div>



    <div class="row mx-4 mb-5">

      <div class="col-9">

        <div class="title my-0 mt-5">
          Configuraci&oacute;n de p&aacute;gina
        </div>
        <hr />

        <div class="my-4 py-1">
          <label class="control-label" for="papel"><strong>Tama&ntilde;o de la p&aacute;gina</strong></label>
          <div class="my-2">
            <select name="papel" id="papel" style="height:44px;">
              <option value="Letter" <?= $formato[0]["papel"] == "Letter" ? ' selected' : '' ?>>Carta (21,6 cm x 27,9 cm)</option>
              <option value="Legal" <?= $formato[0]["papel"] == "Legal" ? ' selected' : '' ?>>Legal (21,6 cm x 35,6 cm)</option>
              <option value="A4" <?= $formato[0]["papel"] == "A4" ? ' selected' : '' ?>>A4 (21,0 cm x 29,7 cm)</option>
              <option value="A5" <?= $formato[0]["papel"] == "A5" ? ' selected' : '' ?>>Media Carta (14,0 cm x 21,6 cm)</option>
            </select>
          </div>
        </div>
        <div class="row my-4">
          <div class="col-6">

            <label class="control-label" for="orientacion"><strong>Orientaci&oacute;n</strong></label>
            <div class="py-2">
              <input type="radio" name="orientacion" id="orientacion_0" value="0" <?php if (!@$formato[0]["orientacion"]) echo (' checked="checked"'); ?>> Vertical &nbsp;&nbsp;
              <input type="radio" name="orientacion" id="orientacion_1" value="1" <?php if (@$formato[0]["orientacion"]) echo (' checked="checked"'); ?>> Horizontal
            </div>

          </div>

          <div class="col-6 mx-0>
              <label class=" control-label" for="font_size"><strong>Tama&ntilde;o de letra</strong></label>
            <div class="my-2 mx-4">
              <select name="font_size" id="font_size" data-toggle="tooltip" title="Seleccione el tamaño de letra para los formatos" style="height:44px;">
                <?php
                $tam_letras = [8, 10, 11, 12, 14, 16, 18, 22, 24, 30, 36];
                $default_font_size = 11;
                if (@$formato["numcampos"]) {
                  $default_font_size = $formato[0]["font_size"];
                }

                foreach ($tam_letras as $value) {
                  echo ('<option value="' . $value . '"');
                  if ($value == $default_font_size) {
                    echo (' selected="selected"');
                  }
                  echo ('>' . $value . '</option>');
                }
                ?>
              </select>
            </div>
          </div>
        </div>


        <div class="my-4">


          <label class="control-label" for="fk_categoria_formato" data-toggle="tooltip" title="Escoja en donde ser&aacute; ubicado el formato"><strong>Categor&iacute;a del formato</strong></label>
          <div class="col-6">
            <?= $arbolCategoria->generar_html() ?>
          </div>


        </div>

        <div class="my-4">
          <div class="my-1">
            <label class="control-label" for="funcion_predeterminada"><strong>Ruta de aprobaci&oacute;n</strong></label>
          </div>
          <div class="my-1">
            Varios responsables <input type="checkbox" name="funcion_predeterminada[]" id="funcion_predeterminada_1" value="1" <?php echo $checkResponsables; ?> data-toggle="tooltip" title="Opción que realiza ruta de aprobación">
          </div>
        </div>

      </div>

      <div class="col-3 my-5">

        <div class="my-5 py-4">

          <?php
          $margen_defecto = array(2.5, 2.5, 1.9, 2.5);
          if ($formato["numcampos"] && !empty($formato[0]["margenes"])) {
            $margen_defecto = explode(",", $formato[0]["margenes"]);
            $margen_defecto = array_map(function ($val) {
              return $val / 10; // esta guardado en milimetros
            }, $margen_defecto);
          }
          ?>

          <label class="control-label ml-2" for="margenes"><strong>M&aacute;rgenes (cent&iacute;metros)</strong></label>
          <div class="row-fluid text-right col-9">
            <div class="my-3">
              <label for="msup">Superior </label>
              <input type="number" min="0" max="10" step="0.1" class="ml-4 input-mini" name="msup" id="msup" value="<?= $margen_defecto[2] ?>" style="width:50%;height:44px">

            </div>

            <div class="my-3">
              <label for="minf">Inferior </label>
              <input type="number" min="0" max="10" step="0.1" class="ml-4 pl-1 input-mini" name="minf" id="minf" value="<?= $margen_defecto[3] ?>" style="width:50%;height:44px">

            </div>

            <div class="my-3">
              <label for="mizq">Izquierda</label>
              <input type="number" min="0" max="10" step="0.1" class="ml-4 input-mini" name="mizq" id="mizq" value="<?= $margen_defecto[0] ?>" style="width:50%;height:44px">

            </div>


            <div class="my-3">
              <label for="mder">Derecha</label>
              <input type="number" min="0" max="10" step="0.1" class="ml-4 input-mini" name="mder" id="mder" value="<?= $margen_defecto[1] ?>" style="width:50%;height:44px">

            </div>

          </div>

        </div>

      </div>


      <input type="hidden" name="exportar" value="mpdf">
      <input type="hidden" name="pertenece_nucleo" value="0">
      <input type="hidden" id="tiempo_formato" name="tiempo_autoguardado" value="5">

  </form>

  <?php
  //echo(librerias_jquery("1.7"));
  echo librerias_notificaciones();

  ?>

  <script type="text/javascript">
    /*$("#elemento1").mouseenter(function(e){
      $("#tip1").css("left", e.pageX + 5);
      $("#tip1,").css("top", e.pageY + 5);
      $("#tip1").css("display", "block");
   });
   $("#elemento1").mouseleave(function(e){
      $("#tip1").css("display", "none");
   }); */

    $("document").ready(function() {
      $("#serie_idserie").select2();
      $($("#select2-serie_idserie-container").siblings()[0]).hide();
      $("input[name='when_is_escrow_set_to_close']").hide();
      if ($("#codigo_serie").val() == '') {
        $("#mostrar_tipodoc_pdf").hide();
        $("#texto_tipodoc").hide();
      }
      $(".paginar").hide();
      $('[data-toggle="tooltip"]').tooltip();
      /*$("#nombre_formato").blur(function() {
      	//console.log($("#nombre_formato").val());
      	if($("#nombre_formato").val()) {
      		$.ajax({
      		    type:'POST',
      		    dataType:'json',
      		    url: "<?php echo ($ruta_db_superior); ?>pantallas/lib/llamado_ajax.php",
      		    async:false,
      		    data: "librerias=pantallas/generador/librerias_formato.php&funcion=verificar_nombre_formato&parametros="+$("#nombre_formato").val()+"&rand="+Math.round(Math.random()*100000),
      		    success: function(objeto) {
      		        if(objeto.exito) {
      		      	  notificacion_saia(objeto.mensaje,'success','topCenter',3000);
      		        } else {
      		      	  //notificacion_saia(objeto.mensaje,'error','topCenter',3000);
      		      	  $("#nombre_formato").focus();
      		        }
      		    }
      		});
      	}
      });*/

      $("#etiqueta_formato").change(function() {
        var valor = $(this).val();
        if (valor) {
          var nombre = normalizar(valor);
          $("#nombre_formato").val(nombre);
        }
      });
      var descripcion_formato = "<?php echo $descripcionFormato; ?>";
      var formulario = $("#datos_formato");
      var formato = <?php echo (json_encode($formato)); ?>;


      var nombre_formato = "";
      if ($("#nombre_formato").val() != "") {
        var nombre_formato = $("#nombre_formato").val();
      }

      $("#enviar_datos_formato").click(function(event) {
        event.preventDefault();
        if (formulario.valid()) {

          var buttonAcep = $(this);
          //buttonAcep.attr('disabled', 'disabled');
          //parsear_items();
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias_pantalla.php",
            data: "ejecutar_datos_pantalla=" + buttonAcep.attr('value') + "&tipo_retorno=1&rand=" + Math.round(Math.random() * 100000) + '&' + formulario.serialize() + "&nombre=" + nombre_formato,
            success: function(objeto) {
              if (objeto.exito && objeto.editar != 1) {
                notificacion_saia(objeto.mensaje, 'success', 'topCenter', 3000);
                window.parent.location.href = window.parent.location.pathname + "?idformato=" + objeto.idformato;
              } else if (objeto.exito && objeto.editar == 1) {
                $("#pantalla_principal").next().find("a").trigger("click");
                notificacion_saia(objeto.mensaje, 'success', 'topCenter', 3000);
              } else {
                notificacion_saia(objeto.error, 'error', 'topCenter', 3000);
                buttonAcep.removeAttr('disabled');
              }
            }
          });
        } else {
          notificacion_saia('Debe diligenciar los campos obligatorios', 'warning', 'topCenter', 3000);
          $(".error").first().focus();
          return false;
        }
      });

      $("#tipo_registro").change(function() {
        var valor = $(this).val();
        switch (valor) {
          case "1":
            $("#item").val("0");
            $("#mostrar_pdf").val("1");
            $(".tipo_edicion").show();
            $("input[name='paginar']").attr("checked", "checked");
            break;
          case "2":
            $("#item").val("0");
            $("#mostrar_pdf").val("0");
            $(".tipo_edicion").hide();
            $("input[name='paginar']").attr("checked", false);
            break;
          case "3":
            $("#item").val("1");
            $("#mostrar_pdf").val("0");
            $(".tipo_edicion").hide();
            break;
          default:
            $("#item").val("0");
            $("#mostrar_pdf").val("0");
            $("input[name='paginar']").attr("checked", false);
            break;
        }
      });

      if (formato !== null && formato.numcampos) {
        $('#nombre_formato').val(formato[0].nombre);
        $('#etiqueta_formato').val(formato[0].etiqueta);
        //$('#tabla_formato').val(formato[0].tabla);
        $('#descripcion_formato').val(descripcion_formato);
        $('#proceso_pertenece').val(formato[0].proceso_pertenece);
        $('#serie_id_serie').val(formato[0].serie_idserie);
        $('#version').val(formato[0].version);
        $('#librerias_formato').val(formato[0].librerias);
        $('#etiqueta_formato').val(formato[0].etiqueta);
        $('#ruta_formato').val(formato[0].ruta_formato);
        $('#ayuda_formato').val(formato[0].ayuda);
        //$('#prefijo_formato').val(formato[0].prefijo);
        $('#ruta_almacenamiento_formato').val(formato[0].ruta_almacenamiento);
        $('#idformato').val(formato[0].idformato);
        $('#tipo_formato_' + formato[0].tipo_formato).attr('checked', "checked");
        $('#versionar_' + formato[0].versionar).attr('checked', "checked");
        $('#accion_eliminar_' + formato[0].accion_eliminar).attr('checked', "checked");
        if (formato[0].tipo_formato == 2) {
          $("#campos_formato").show();
        }
        $('#aprobacion_automatica_' + formato[0].aprobacion_automatica).attr('checked', "checked");
        $('#enviar_datos_formato').val('editar_datos_formato');
        $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
        $('#componentes_acciones').hide();
        $('.nav li').removeClass('disabled');

        var item = formato[0].item;
        var mostrar_pdf = formato[0].mostrar_pdf;
        if (item == 0 && mostrar_pdf == 0) {
          $("#tipo_registro").val(2);
          $(".tipo_edicion").hide();
        }
        if (item == 0 && mostrar_pdf == 1) {
          $("#tipo_registro").val(1);
          $(".tipo_edicion").show();
        }
        if (item == 1 && mostrar_pdf == 0) {
          $("#tipo_registro").val(3);
          $(".tipo_edicion").hide();
        }

      } else {
        $('.nav li').addClass('disabled');
        $('#generar_pantalla').addClass('disabled');

        $("#contenidos_componentes").hide();
        $('#tabs_formulario li:first').removeClass('disabled');
        $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
      }

      //tree_arbol_serie_formato.setOnCheckHandler(parsear_serie_formato);

      $("#serie_idserie").change(function() {

        obtenerCodigoSerie();

      });

    });

    function obtenerCodigoSerie() {

      $(".codigoSerie").each(function() {

        if ($(this).val() == $("#serie_idserie").val()) {
          $("#codigoSerieInput").val($(this).attr("codigo"));
        }

      });
    }

    obtenerCodigoSerie();

    function parsear_serie_formato(nodeId) {
      //console.log(nodeId);
      var datos = tree_arbol_serie_formato.getUserData(nodeId, "serie_codigo");
      //console.log(datos);
      $("#codigo_serie").val(datos);
      if (datos) {
        $("#mostrar_tipodoc_pdf").show();
        $("#texto_tipodoc").show();
      } else {
        $("#mostrar_tipodoc_pdf").hide();
        $("#texto_tipodoc").hide();
      }

      /*if(datos) {
      	$('[name="expediente_serie"]').val(datos);
      } else {
      	$('[name="expediente_serie"]').val("");
      }
      if(idexpediente_idserie.length > 1) {
      	$('[name="expediente_serie"]').val(idexpediente_idserie[0]);
      }
      var seleccionados = tree_serie_idserie.getAllChecked();
      var vector_seleccionados = seleccionados.split(',');
      for ( i = 0; i < vector_seleccionados.length; i++) {
      	if (vector_seleccionados[i] != nodeId) {
      		tree_serie_idserie.setCheck(vector_seleccionados[i], 0);
      	}
      }*/
    }


    function parsear_items() {
      var nombre_formato = $("#nombre_formato").val();
      if (nombre_formato.indexOf("ft_") == "-1") {
        $("#nombre_formato").val("ft_" + nombre_formato);
      }
      $("#prefijo_formato").val("ft_");
    }
  </script>

  <?php
  function check_banderas($bandera, $chequear = true)
  {
    global $formato;

    if ($bandera == "aprobacion_automatica") {
      echo ' value="e" ';
      if (strpos($formato[0]["banderas"], "e") !== false) {
        echo ' checked="checked" ';
      }
    } else if ($bandera == "asunto_padre") {
      echo ' value="r" ';
      if (strpos($formato[0]["banderas"], "r") !== false) {
        echo ' checked="checked" ';
      }
    } else if ($bandera && $formato[0][$bandera]) {
      $texto = ' value="' . $formato[0][$bandera] . '"';
      if ($chequear) {
        $texto .= ' checked="checked" ';
      }
      echo $texto;
    }
  }

  function crear_arbol($nombre, $url, $tipo = "radio")
  {
    global $ruta_db_superior;
    ?>
  <script>
    $("document").ready(function() {
      var browserType;
      if (document.layers) {
        browserType = "nn4"
      }
      if (document.all) {
        browserType = "ie"
      }
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
        browserType = "gecko"
      }

      tree_<?php echo ($nombre); ?> = new dhtmlXTreeObject("treebox_<?php echo ($nombre); ?>", "100%", "", 0);
      tree_<?php echo ($nombre); ?>.setImagePath("<?php echo ($ruta_db_superior); ?>imgs/");
      tree_<?php echo ($nombre); ?>.enableTreeImages(false);
      tree_<?php echo ($nombre); ?>.enableTextSigns(true);
      tree_<?php echo ($nombre); ?>.enableIEImageFix(true);
      tree_<?php echo ($nombre); ?>.setOnLoadingStart(cargando_arbol_<?php echo ($nombre); ?>);
      tree_<?php echo ($nombre); ?>.setOnLoadingEnd(fin_cargando_arbol_<?php echo ($nombre); ?>);

      tree_<?php echo ($nombre); ?>.enableCheckBoxes(1);
      <?php if ($tipo == "radio") { ?>
      tree_<?php echo ($nombre); ?>.enableRadioButtons(true);
      tree_<?php echo ($nombre); ?>.setOnCheckHandler(onNodeSelect_<?php echo ($nombre); ?>);

      function onNodeSelect_<?php echo ($nombre); ?>(nodeId) {
        //alert(nodeId);
        var valor_destino = document.getElementById("<?php echo ($nombre); ?>");
        if (tree_<?php echo ($nombre); ?>.isItemChecked(nodeId)) {
          //alert(valor_destino.value);
          if (valor_destino.value !== "") {
            tree_<?php echo ($nombre); ?>.setCheck(valor_destino.value, false);
          }
          if (nodeId.indexOf("_") != -1) {
            nodeId = nodeId.substr(0, nodeId.indexOf("_"));
          }
          valor_destino.value = nodeId;
        } else {
          valor_destino.value = "";
        }
      }
      <?php
        } else {
          ?>
      tree_<?php echo ($nombre); ?>.setOnCheckHandler(onNodeSelect_check_<?php echo ($nombre); ?>);

      function onNodeSelect_check_<?php echo ($nombre); ?>(nodeId) {
        var valor_destino = document.getElementById("<?php echo ($nombre); ?>");
        valor_destino.value = tree_<?php echo ($nombre); ?>.getAllChecked();
      }
      <?php

        }
        ?>
      /*tree_<?php echo ($nombre); ?>.enableThreeStateCheckboxes(true);*/


      tree_<?php echo ($nombre); ?>.loadXML("<?php echo ($url); ?>");

      function fin_cargando_arbol_<?php echo ($nombre); ?>() {
        if (browserType == "gecko")
          document.poppedLayer = eval('document.getElementById("esperando_<?php echo ($nombre); ?>")')
        else if (browserType == "ie")
          document.poppedLayer = eval('document.getElementById("esperando_<?php echo ($nombre); ?>")');
        else
          document.poppedLayer = eval('document.layers["esperando_<?php echo ($nombre); ?>"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_arbol_<?php echo ($nombre); ?>() {
        if (browserType == "gecko")
          document.poppedLayer = eval('document.getElementById("esperando_<?php echo ($nombre); ?>")');
        else if (browserType == "ie")
          document.poppedLayer = eval('document.getElementById("esperando_<?php echo ($nombre); ?>")');
        else
          document.poppedLayer = eval('document.layers["esperando_<?php echo ($nombre); ?>"]');
        document.poppedLayer.style.display = "";
      }
    });
  </script>

</body>

</html>
<?php

}

?>