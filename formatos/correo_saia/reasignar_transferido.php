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
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "assets/librerias.php");
include_once($ruta_db_superior . "app/documento/class_transferencia.php");
echo (librerias_html5());
echo (jquery());
echo (bootstrap());
echo (librerias_validar_formulario('11'));

$iddoc = @$_REQUEST['iddoc'];
$idformato = @$_REQUEST['idformato'];

if (@$_REQUEST['continuar']) {

    $insert_item = "INSERT INTO ft_reasignar_transferid(ft_correo_saia,fecha_reasignacion,transferencia_correo) VALUES (" . @$_REQUEST['ft_correo_saia'] . "," . fecha_db_almacenar(@$_REQUEST['fecha_reasignacion'], 'Y-m-d') . ",'" . @$_REQUEST['anterior'] . "');";
    phpmkr_query($insert_item);

    $update_transferido = "UPDATE ft_correo_saia SET transferencia_correo='" . @$_REQUEST['transferencia_correo'] . "' WHERE idft_correo_saia=" . @$_REQUEST['ft_correo_saia'];
    phpmkr_query($update_transferido);

    transferencia_automatica($idformato, $iddoc, @$_REQUEST['transferencia_correo'], 1);

    echo ('<script>window.parent.hs.close();setTimeout(function(){ window.parent.location.reload(); }, 50);</script>');
} else {
    $datos = busca_filtro_tabla('idft_correo_saia,transferencia_correo', 'ft_correo_saia', 'documento_iddocumento=' . $iddoc, '');

    ?>
    <html>

    <head>
        <title>Reasignar el transferido</title>
    </head>

    <body>
        <form action="" method="post" id="formulario_formatos" enctype="multipart/form-data">
            <table style="width: 100%;" border="0">
                <tr>
                    <td colspan="2" style="text-align: center; font-size: 12px;" class="encabezado_list"> Reasignar el transferido</td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Fecha</td>
                    <td style="font-size: 12px;"><input type="text" name="fecha_reasignacion" id="fecha_reasignacion" style="width: 100px;" value="<?php echo (date('Y-m-d')) ?>"/ readonly></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Transferir</td>
                    <td style="font-size: 12px;">
                        <input type="hidden" name="transferencia_correo" id="transferencia_correo" style="width: 70%;" value="" />
                        <?php cargar_autocompletar('transferencia_correo', 'formatos/correo_saia/funcionarios_reasignar.php', 0, false, array())
                            ?>
                    </td>

                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; font-size: 10px;"><br>
                        <input type="hidden" name="iddoc" value="<?php echo ($iddoc); ?>" />
                        <input type="hidden" name="idformato" value="<?php echo ($idformato); ?>" />
                        <input type="hidden" name="ft_correo_saia" value="<?php echo ($datos[0]['idft_correo_saia']); ?>" />
                        <input type="hidden" name="anterior" value="<?php echo ($datos[0]['transferencia_correo']); ?>" />
                        <input class="btn btn-info" type="submit" id="continuar" name="continuar" value="Guardar">
                    </td>
                </tr>
            </table>
        </form>

        <table style="width: 100%;" border="0">
            <tr>
                <td colspan="2" style="text-align: center; font-size: 12px;" class="encabezado_list">Historial reasignaciones</td>
            </tr>
            <tr>
                <td class="encabezado_list" style="width: 50%; font-size: 12px;">Fecha</td>
                <td class="encabezado_list" style="width: 50%; font-size: 12px;">Transferido</td>
            </tr>
            <?php
                $datos_item = busca_filtro_tabla(fecha_db_obtener('fecha_reasignacion', 'Y-m-d') . 'as fecha,transferencia_correo', 'ft_reasignar_transferid', 'ft_correo_saia=' . $datos[0]['idft_correo_saia'], 'idft_reasignar_transferid DESC');
                for ($i = 0; $i < $datos_item['numcampos']; $i++) {
                    $nombre_transferido = busca_filtro_tabla('nombres, apellidos', 'vfuncionario_dc', 'iddependencia_cargo=' . $datos_item[$i]['transferencia_correo'], '');
                    echo '<tr>
                        	<td style="text-align:center;">' . $datos_item[$i]['fecha'] . '</td>
                        	<td style="text-align:center;">' . $nombre_transferido[0]['nombres'] . ' ' . $nombre_transferido[0]['apellidos'] . '</td>
                        </tr>';
                }
                ?>
        </table>
    </body>

    </html>
<?php
}
?>