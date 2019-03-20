<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");

echo (estilo_bootstrap());
echo (librerias_arboles());
echo (librerias_jquery("1.7"));
echo (librerias_bootstrap());
echo (librerias_tooltips());
$file_img = $ruta_db_superior . "/imgs/glyphicons-halflings.png";
$imagen = getimagesize($file_img);
$ancho_img = $imagen[0];
$alto_img = $imagen[1];
$alto_fila = 24;
$ancho_fila = 24;
$filas = round(($alto_img / $alto_fila), 0, PHP_ROUND_HALF_DOWN);
$columnas = round(($ancho_img / $ancho_fila), 0, PHP_ROUND_HALF_DOWN);

function nombre_icon($pos_izq, $pos_sup) {
    global $ruta_db_superior;
    $archivo = file($ruta_db_superior . "css/bootstrap/saia/css/bootstrap_iconos_segundarios.css", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $clave = array_search("background-position: -" . $pos_izq . "px -" . $pos_sup . "px;", $archivo);
    if ($clave !==false) {
        echo substr($archivo[($clave-1)], 6, -2);
    } else {
        echo "Imagen (" . $pos_izq . "-" . $pos_sup . ") No Existe";
    }
}
?>
<html>
    <head>
        <style>
            #principal{
                width:<?php echo $ancho_img ?>px;
                height:<?php echo $alto_img; ?>px;
                border-collapse:collapse;
                background-image: url("<?php echo $file_img; ?>");
                background-position: center; 
                background-repeat: no-repeat;    
            }
            #principal td
            {
                width:24px;
                height:24px;
            }
            #principal th, #principal td {
                border-left: 0px solid #dddddd;
            }
            #principal tbody tr:nth-child(odd) td, #principal tbody tr:nth-child(odd) th{
                background-color:transparent;
            } 
            #principal th, #principal td{
                padding: 0px;
                line-height: 10px;
                border-top: none;
            }
            /*table#principal td:hover
            {
            background-color: #000;
            }*/
        </style>


    </head>

    <body style="margin:10px">
        <br>	
        <table class="table table-bordered table-striped">
            <tr>
                <td style="text-align: center; background-color:#57B0DE; color: #ffffff;">Modulo</td>  
                <td><br>
                    <input type="hidden" name="nombre_nuevo" id="nombre_nuevo"  value="" >

                    <input type="text" id="stext_3" width="200px" size="20">
                    <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value, 1)">
                        <img src="../../assets/images/anterior.png" border="0px" alt="Anterior"></a>
                    <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value, 0, 1)">
                        <img src="../../assets/images/buscar.png" border="0px" alt="Buscar"></a>
                    <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
                        <img src="../../assets/images/siguiente.png" border="0px" alt="Siguiente"></a>
                    <br /><div id="esperando_modulo">
                        <img src="../../imagenes/cargando.gif"></div>
                    <div id="treeboxbox_tree3" class="arbol_saia"></div>

                    <script type="text/javascript">
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
                        tree3 = new dhtmlXTreeObject("treeboxbox_tree3", "100%", "100%", 0);
                        tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
                        tree3.setOnLoadingStart(cargando_serie);
                        tree3.setOnLoadingEnd(fin_cargando_serie);
                        tree3.enableIEImageFix(true);
                        tree3.enableAutoTooltips(1);
                        tree3.enableRadioButtons(true);
                        tree3.loadXML("<?php echo($ruta_db_superior);?>test_permiso_modulo.php");
                        tree3.setOnCheckHandler(onNodeSelect_tree3);
                        function fin_cargando_serie() {
                            if (browserType == "gecko")
                                document.poppedLayer =
                                        eval('document.getElementById("esperando_modulo")');
                            else if (browserType == "ie")
                                document.poppedLayer =
                                        eval('document.getElementById("esperando_modulo")');
                            else
                                document.poppedLayer =
                                        eval('document.layers["esperando_modulo"]');
                            document.poppedLayer.style.visibility = "hidden";
                            $('#nombre_nuevo').val(tree3.getAllChecked());
                        }

                        function onNodeSelect_tree3(nodeId) {
                            valor_destino = document.getElementById("nombre_nuevo");
                            if (tree3.isItemChecked(nodeId))
                            {
                                if (valor_destino.value !== "")
                                    tree3.setCheck(valor_destino.value, false);
                                if (nodeId.indexOf("_") != -1) {
                                    nodeId = nodeId.substr(0, nodeId.length);
                                    valor_destino.value = nodeId;
                                }
                            } else {
                                valor_destino.value = "";
                            }
                            document.getElementById("nombre_nuevo").value = tree3.getAllChecked();
                        }
                        function cargando_serie() {
                            if (browserType == "gecko")
                                document.poppedLayer =
                                        eval('document.getElementById("esperando_modulo")');
                            else if (browserType == "ie")
                                document.poppedLayer =
                                        eval('document.getElementById("esperando_modulo")');
                            else
                                document.poppedLayer =
                                        eval('document.layers["esperando_modulo"]');
                            document.poppedLayer.style.visibility = "visible";
                        }
                    </script>
                   <input type="button" value="Borrar" onclick="borrar_icono()"/>  
                </td>
            </tr>
            <tr> <td style="text-align: center; background-color:#57B0DE; color: #ffffff;">Imagen Bootstrap:</td>
                <td>
                    <table id="principal">
                        <?php
                        $izq = 0;
                        $sup = 0;
                        for ($i = 0; $i < $filas; $i++) {
                            ?>
                            <tr>
                                <?php
                                for ($j = 0; $j < $columnas; $j++) {
                                    ?>	
                                    <td class="tooltip_saia" title="<?php echo nombre_icon($izq, $sup);?>" izquierda="<?php echo($izq);?>" superior="<?php echo($sup);?>">&nbsp;</td>
                                    <?php
                                    $izq = $izq + $ancho_fila;
                                }
                                ?>
                            </tr>
                            <?php
                            $izq = 0;
                            $sup = $sup + $alto_fila;
                        }
                        ?>
                    </table>
                    <!-- <input type="button" value="Nueva Fila" onclick="nueva_fila(<?php echo $columnas; ?>)" --> 
                </td>
            </tr>

        </table><br/> 

        <div id="resultado" style="text-align:center"></div>


    </body>
    <script>
        $(document).ready(function() {
            iniciar_tooltip();
            $(document).delegate("#principal td", "click", function() {
                var td_prin = $("#principal td:eq(0)").position();              
                var position = $(this).position();
                var izquierda = $(this).attr("izquierda");
                var superior = (parseInt(position.top) - parseInt(td_prin.top));
                var nombre_nuevo = $("#nombre_nuevo").val();

                if (nombre_nuevo.length == 0) {
                    alert("Debe Seleccionar un Modulo");
                } else if (confirm("Seguro de Cambiar el Nombre ?") == true) {
                    $("#resultado").load("actualizar_botones.php", {coord_izquierda: izquierda, coord_superior: superior, nombre_nuevo: nombre_nuevo});
                }
            });

        });
        function borrar_icono(){
        	var nombre_nuevo = $("#nombre_nuevo").val();
        	 if (nombre_nuevo.length == 0) {
                    alert("Seleccionar el Nombre Modulo");
              }else{
              	 $("#resultado").load("actualizar_botones.php", {borrar_icono: nombre_nuevo});
              }
        }
        function nueva_fila(column) {
            var html = "";
            for (var j = 0; j < column; j++) {
                html += "<td>&nbsp;</td>";
            }
            $("#principal").append("<tr>" + html + "</tr>");
        }
    </script>
</html>