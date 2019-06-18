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
include_once $ruta_db_superior . "core/autoload.php";
include_once ($ruta_db_superior . "librerias_saia.php");

function limpiarContenido($texto){
      $textoLimpio = preg_replace('([^ A-Za-z0-9_-ñÑ,&;@\.\-])', '', utf8_decode($texto));                            
      return $textoLimpio;
}

if ($_REQUEST["idgrupo"] != "" && $_REQUEST["formulario"] == 1) {
    echo(estilo_bootstrap());
    echo(librerias_jquery("1.7"));
    echo(librerias_arboles());
    echo (librerias_validar_formulario("11"));
    $datos_dt = busca_filtro_tabla(fecha_db_obtener("fecha_oficio_entrada", "Y-m-d H:i") . " as fecha,*", "dt_datos_correo", "idgrupo='" . $_REQUEST["idgrupo"] . "'", "", $conn);
    $html = '';
    if ($datos_dt["numcampos"]) {
        $html .= '<table class="table table-bordered" align="center" style="width:80%">';
        $html .= '<thead>
            <tr>
                <th style="text-align:center">ASUNTO</th>
                <th style="text-align:center">FECHA</th>
                <th style="text-align:center">DE</th>
                <th style="text-align:center">PARA</th>
                <th style="text-align:center">ANEXOS</th>
            </tr>
        </thead>
        </tbody>';
        for ($i = 0; $i < $datos_dt["numcampos"]; $i++) {
            $html .= '<tr> <td>' . limpiarContenido($datos_dt[$i]["asunto"]) . '</td> <td>' . $datos_dt[$i]["fecha"] . '</td> <td>' . limpiarContenido($datos_dt[$i]["de"]) . '</td> <td>' . limpiarContenido($datos_dt[$i]["para"]) . '</td> <td>' . $datos_dt[$i]["anexos"] . '</td> </tr>';
        }
        $html .= '</tbody>
        </table>';
    }
                            
    $html .= '<form id="formulario" name="formulario"><table class="table table-bordered" align="center" style="width:80%">';
    $html .= '<tr> <td style="width:30%;font-weight:bold;">TRANSFERIR *</td> <td><input type="text" id="transferencia_correo_busqueda" size="100">  <input type="hidden" name="transferencia_correo" id="transferencia_correo"></td> </tr>';
    $html .= '<tr> <td style="font-weight:bold;">COPIA</td> <td><input type="hidden" maxlength="255" name="copia_correo" id="copia_correo" > <div id="esperando_copia_correo"><img src="../../imagenes/cargando.gif"></div> <div id="treeboxbox_copia_correo" height="90%" class="arbol_saia"></div></td> </tr>';
    $html .= '<tr> <td style="font-weight:bold;">COMENTARIO</td> <td><textarea name="comentario" style="width:300px;" rows="5"></textarea></td> </tr>';
    $html .= '<tr> <td colspan="2" style="text-align:center"><input type="hidden" name="registrar" value="1"><input type="hidden" id="idgrupo" name="idgrupo" value="'.$_REQUEST["idgrupo"].'"><button class="btn btn-mini btn-info">Guardar</button></td> </tr>';
    $html .= '</table></form>';
    echo $html;
?>
<script>
    $(document).ready(function() {
        
       $('#formulario').validate({
           submitHandler: function(form){
            id=$("#idgrupo").val();
            if(id!=""){
                transf=$("#transferencia_correo").val();
                if(transf!=""){
                    form.submit();
                }else{
                    top.noty({text: 'Por favor ingrese el campo obligatorio',type: 'error',layout: 'topCenter',timeout:1000});
                    return false;
                }
            }else{
                top.noty({text: 'No se encuentra el identificador',type: 'error',layout: 'topCenter',timeout:1000});
                return false;
            }
           }     
       });
        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        $("#transferencia_correo_busqueda").attr("autocomplete", "off").after("<br/><div id='ul_completar_transferencia_correo' class='ac_results'></div>");
        $("#transferencia_correo_busqueda").keyup(function() {
            var x_valor = $(this).val();
            delay(function() {
                $("#ul_completar_transferencia_correo").load("../../pantallas/funcionario/carga_campo_autocompletar.php", {
                    valor : x_valor,
                    campo : 'transferencia_correo'
                });
            }, 500);
        });
    });

    function cargar_datos_transferencia_correo(id, descripcion, tipo) {
        $("#ul_completar_transferencia_correo").empty();
        $("#informacion_transferencia_correo").remove();

        $("#transferencia_correo_busqueda").after("<table id='informacion_transferencia_correo'></table>");
        $("#informacion_transferencia_correo").append("<tr id='fila_" + id + "'><td>" + descripcion + "</td><td><img style='cursor:pointer' src='../../imagenes/eliminar_nota.gif' registro='" + id + "' onclick='eliminar_transferencia_correo(" + id + ");'></td></tr>");

        $("#transferencia_correo").val(id);
        $("#transferencia_correo_busqueda").val("");
    }

    function eliminar_transferencia_correo(id) {
        $("#fila_" + id).remove();
        var datos = $("#transferencia_correo").val().split(",");
        var cantidad = datos.length;
        var nuevos_datos = new Array();
        var nuevos_datos2 = new Array();
        var a = 0;
        for (var i = 0; i < cantidad; i++) {
            if (id != datos[i]) {
                nuevos_datos[a] = datos[i];
                nuevos_datos2[a] = datos2[i];
                a++;
            }
        }
        var datos_guardar = nuevos_datos.join(",");
        var datos_guardar2 = nuevos_datos2.join(",");
        $("#transferencia_correo").val(datos_guardar);
    }

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
    tree_copia_correo = new dhtmlXTreeObject("treeboxbox_copia_correo", "100%", "100%", 0);
    tree_copia_correo.setImagePath("../../imgs/");
    tree_copia_correo.enableIEImageFix(true);
    tree_copia_correo.enableCheckBoxes(1);
    tree_copia_correo.enableThreeStateCheckboxes(1);
    tree_copia_correo.setOnLoadingStart(cargando_copia_correo);
    tree_copia_correo.setOnLoadingEnd(fin_cargando_copia_correo);
    tree_copia_correo.setXMLAutoLoading("../../test_funcionario.php?rol=1");
    tree_copia_correo.loadXML("../../test_funcionario.php?rol=1");

    tree_copia_correo.setOnCheckHandler(onNodeSelect_copia_correo);
    function onNodeSelect_copia_correo(nodeId) {
        valor_destino = document.getElementById("copia_correo");
        destinos = tree_copia_correo.getAllChecked();
        nuevo = destinos.replace(/\,{2,}(d)*/gi, ",");
        nuevo = nuevo.replace(/\,$/gi, "");
        vector = destinos.split(",");
        for ( i = 0; i < vector.length; i++) {
            if (vector[i].indexOf("_") != -1) {
                vector[i] = vector[i].substr(0, vector[i].indexOf("_"));
            }
            nuevo = vector.join(",");
            if (vector[i].indexOf("#") != -1) {
                hijos = tree_copia_correo.getAllSubItems(vector[i]);
                hijos = hijos.replace(/\,{2,}(d)*/gi, ",");
                hijos = hijos.replace(/\,$/gi, "");
                vectorh = hijos.split(",");

                for ( h = 0; h < vectorh.length; h++) {
                    if (vectorh[h].indexOf("_") != -1)
                        vectorh[h] = vectorh[h].substr(0, vectorh[h].indexOf("_"));
                    nuevo = eliminarItem(nuevo, vectorh[h]);
                }
            }
        }
        nuevo = nuevo.replace(/\,{2,}(d)*/gi, ",");
        nuevo = nuevo.replace(/\,$/gi, "");
        valor_destino.value = nuevo;
    }

    function fin_cargando_copia_correo() {
        if (browserType == "gecko")
            document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
        else if (browserType == "ie")
            document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
        else
            document.poppedLayer = eval('document.layers["esperando_copia_correo"]');
        document.poppedLayer.style.display = "none";
    }

    function cargando_copia_correo() {
        if (browserType == "gecko")
            document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
        else if (browserType == "ie")
            document.poppedLayer = eval('document.getElementById("esperando_copia_correo")');
        else
            document.poppedLayer = eval('document.layers["esperando_copia_correo"]');
        document.poppedLayer.style.display = "";
    }
</script>
<?php
} elseif ($_REQUEST["idgrupo"]) {
    if($_REQUEST["registrar"]==1){
        $update="UPDATE dt_datos_correo SET comentario='".htmlentities(strip_tags($_REQUEST["comentario"]))."',transferir='".$_REQUEST["transferencia_correo"]."',copia='".$_REQUEST["copia_correo"]."' WHERE idgrupo='".$_REQUEST["idgrupo"]."'";
        phpmkr_query($update) or die("Error al actualizar los datos de la DT");
        notificaciones_saia("Por favor espere mientras se radican los Emails", "warning", 10000);
    }
    include_once ($ruta_db_superior . "class_transferencia.php");
    $datos = busca_filtro_tabla("TOP 1 " . fecha_db_obtener("fecha_oficio_entrada", "Y-m-d H:i") . " as fecha,*", "dt_datos_correo", "idgrupo='" . $_REQUEST["idgrupo"] . "' and iddoc_rad=0", "", $conn);
    if ($datos["numcampos"]) {
        $tabla = "ft_correo_saia";
        $dependencia = busca_filtro_tabla("funcionario_codigo,iddependencia_cargo,login", "vfuncionario_dc", "idfuncionario=" . $_SESSION["idfuncionario"] . " AND estado_dc=1", "", $conn);
        $serie = busca_filtro_tabla("predeterminado", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND B.nombre='serie_idserie'", "", $conn);
        $campos_formato = busca_filtro_tabla("", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "", $conn);
        $campos = extrae_campo($campos_formato, "idcampos_formato");

        $_REQUEST["asunto"] = limpiarContenido($datos[0]["asunto"]);
        $_REQUEST["fecha_oficio_entrada"] = $datos[0]["fecha"];
        $_REQUEST["de"] = limpiarContenido($datos[0]["de"]);
        $_REQUEST["para"] = limpiarContenido($datos[0]["para"]);
        $_REQUEST["transferencia_correo"] = $datos[0]["transferir"];
        $_REQUEST["copia_correo"] = $datos[0]["copia"];
        $_REQUEST["comentario"] = $datos[0]["comentario"];

        $_REQUEST["uid_correo"] = $datos[0]["uid"];
        $_REQUEST["buzon_correo"] = $datos[0]["buzon_email"];
        $_REQUEST["anexos"] = str_replace("\\", "/", $datos[0]["anexos"]);

        $_REQUEST["tipo_radicado"] = "radicacion_entrada";
        $_REQUEST["encabezado"] = "1";
        $_REQUEST["estado_documento"] = "1";
        $_REQUEST["firma"] = "1";
        $_REQUEST["dependencia"] = $dependencia[0]["iddependencia_cargo"];
        $_REQUEST["serie_idserie"] = $serie[0]["predeterminado"];
        $_REQUEST["ejecutor"] = $dependencia[0]["funcionario_codigo"];

        $_REQUEST["campo_descripcion"] = implode(",", $campos);
        $_REQUEST["formato"] = "correo_saia";
        $_REQUEST["idformato"] = $campos_formato[0]["idformato"];
        $_REQUEST["tabla"] = $tabla;
        $_REQUEST["no_redirecciona"] = 1;
        
        $_POST = $_REQUEST;
        $iddoc = radicar_plantilla();
        if ($iddoc) {
            $ok = busca_filtro_tabla("d.iddocumento,d.numero", $tabla . " ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
            if ($ok["numcampos"]) {
                $update_ok = "UPDATE dt_datos_correo SET iddoc_rad=" . $ok[0]["iddocumento"] . ",numero_rad=" . $ok[0]["numero"] . " WHERE iddt_datos_correo=" . $datos[0]["iddt_datos_correo"];
                phpmkr_query($update_ok) or die("Error al actualizar la DT");
            } else {
                $update = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $iddoc;
                phpmkr_query($update) or die("Error al Eliminar el documento");

                $update_dt = "UPDATE dt_datos_correo SET iddoc_rad=-1 WHERE iddt_datos_correo=" . $datos[0]["iddt_datos_correo"];
                phpmkr_query($update_dt) or die("Error al actualizar la DT");
            }
        } else {
            $update_dt = "UPDATE dt_datos_correo SET iddoc_rad=-1 WHERE iddt_datos_correo=" . $datos[0]["iddt_datos_correo"];
            phpmkr_query($update_dt) or die("Error al actualizar la DT");
        }
        redirecciona("radicar_correo_masivo.php?idgrupo=" . $_REQUEST["idgrupo"]);
        die();
    } else {
        $cant_error = busca_filtro_tabla("count(*) as cant", "dt_datos_correo", "idgrupo='" . $_REQUEST["idgrupo"] . "' and iddoc_rad=-1", "", $conn);
        $cant_ok = busca_filtro_tabla("count(*) as cant", "dt_datos_correo", "idgrupo='" . $_REQUEST["idgrupo"] . "' and iddoc_rad>0", "", $conn);
        if ($cant_error[0]["cant"] != 0) {
            $mensaje = "Hubo problemas al radicar los Emails:<br/>Email OK:" . $cant_ok[0]["cant"] . "<br/> Email Error:" . $cant_error[0]["cant"];
            $tipo = "warning";
        } else if ($cant_ok[0]["cant"] > 0) {
            $mensaje = "Se han radicado los Emails";
            $tipo = "success";
        }
        notificaciones_saia($mensaje, $tipo, 10000);
        abrir_url($ruta_db_superior . "index_correo.php", "_self");
        die();
    }
}
?>