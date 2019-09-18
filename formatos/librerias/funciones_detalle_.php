<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
<meta http-equiv="content-type" content="text/html; charset=utf-8"><?php
include_once("../../db.php");
    if (isset($_REQUEST["accion"])) {
        $_REQUEST["accion"]();
    }
    function editar()
    {
        
        $lista_campos = listar_campos_tabla();
        $update = array();
        $campos = array();
        foreach ($_REQUEST as $key => $valor) {
            if (in_array(strtolower($key), $lista_campos)) {
                $update[] = $key . "='" . (($valor)) . "'";
                $campos[] = $key;
            }
        }
        $sql = "update " . $_REQUEST["tabla"] . " set " . implode(",", $update) . " where id" . $_REQUEST["tabla"] . "=" . $_REQUEST["item"];
        phpmkr_query($sql);
        echo '<script>location="../librerias/funciones_detalle.php?accion=listar_detalle&tabla=' . $_REQUEST["tabla"] . '&campos=' . implode(",", $campos) . '&seleccionados="+parent.document.getElementById("' . $_REQUEST["padre"] . '").value+"&campo=' . $_REQUEST["padre"] . '&formato=' . $_REQUEST["tipo_radicado"] . '&padre=' . $_REQUEST["padre"] . '"</script>;';
    }
    function llamar_pagina()
    {
        if (strpos($_REQUEST["direccion"], "listar_detalle") > 0)   redirecciona(urldecode($_REQUEST["direccion"]));
        else   echo "<body bgcolor='#F5F5F5'><a href='" . urldecode($_REQUEST["direccion"]) . "'>Adicionar</a></body>";
    }
    function eliminar_detalle()
    {
        
        $sql = "delete from " . $_REQUEST["tabla"] . " where id" . $_REQUEST["tabla"] . "=" . $_REQUEST["id"];
        phpmkr_query($sql);
        echo "<script>eliminarItem_padre('" . $_REQUEST["campo"] . "','" . $_REQUEST["id"] . "','" . $_REQUEST["tabla"] . "','" . $_REQUEST["campos"] . "','" . $_REQUEST["formato"] . "');            </script>";
    }
    function listar_detalle()
    {
        
        include_once("estilo_formulario.php");
        $resultado = busca_filtro_tabla("id" . $_REQUEST["tabla"] . "," . $_REQUEST["campos"], $_REQUEST["tabla"], "id" . $_REQUEST["tabla"] . " in(" . $_REQUEST["seleccionados"] . ")", "");
        $campos = explode(",", $_REQUEST["campos"]);
        $encabezados = implode("</td><td class=encabezado_list >", $campos);
        echo "<body bgcolor='#F5F5F5'><table border=1 width=100%>         <tr align=center ><td class=encabezado_list >" . $encabezados . "</td><td colspan=2 class=encabezado_list>Opciones</td></tr>";
        for ($i = 0; $i < $resultado["numcampos"]; $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($campos); $j++) {
                if ($_REQUEST["tabla"] == "inicio_fin_proceso") {
                    $e_s = busca_filtro_tabla("distinct identrada_salida,proveedor,entrada", "entrada_salida", "identrada_salida=" . $resultado[$i][$j + 1], "proveedor,entrada");
                    echo "<td>" . codifica_encabezado(html_entity_decode($e_s[0]["proveedor"] . " - " . $e_s[0]["entrada"])) . "&nbsp;</td>";
                } elseif ($_REQUEST["tabla"] == "proveedores_usuarios") {
                    $e_s = busca_filtro_tabla("distinct nombre_proceso", "proceso", "idproceso=" . $resultado[$i][$j + 1], "");
                    echo "<td>" . codifica_encabezado(html_entity_decode($e_s[0]["nombre_proceso"])) . "&nbsp;</td>";
                } else             echo "<td>" . codifica_encabezado(html_entity_decode($resultado[$i][$j + 1])) . "&nbsp;</td>";
            }
            echo "<td align=center><a href='?accion=eliminar_detalle&id=" . $resultado[$i]["id" . $_REQUEST["tabla"]] . "&tabla=" . $_REQUEST["tabla"] . "&campo=" . $_REQUEST["campo"] . "&campos=" . $_REQUEST["campos"] . "&formato=" . $_REQUEST["formato"] . "'>Eliminar</a></td>";
            $direccion = "../" . $_REQUEST["formato"] . "/editar_" . $_REQUEST["formato"] . ".php?item=" . $resultado[$i]["id" . $_REQUEST["tabla"]] . "&campo=" . $_REQUEST["campo"];
            echo "<td align=center><a href='$direccion'>Editar</a></td></tr>";
        }
        echo "</table></body><script>var alto=window.document.body.scrollHeight;parent.document.getElementById(window.name).height=alto+'px'; </script>";
    }
    function guardar_detalle()
    {
        
        $lista_campos = listar_campos_tabla();
        foreach ($_REQUEST as $key => $valor) {
            if (in_array(strtolower($key), $lista_campos) && $key <> "id" . $_REQUEST["tabla"]) {
                $campos[] = $key;
                $valores[] = "'" . (($valor)) . "'";
            }
        }
        $sql = "insert into " . $_REQUEST["tabla"] . "(" . implode(",", $campos) . ") values(" . implode(",", $valores) . ")";
        ejecuta_sql($sql);
    }
?> 