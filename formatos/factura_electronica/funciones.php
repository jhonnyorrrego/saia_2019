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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias_funciones_generales.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

function mostrar_datos_factura($idformato, $iddoc) {
    global $conn;
    $texto = "";
    $factura = busca_filtro_tabla("", "ft_factura_electronica", "documento_iddocumento = $iddoc", "", $conn);
    if ($factura["numcampos"]) {
        $texto = "No se encont&oacute; proveedor";
        if (!empty($factura[0]["proveedor"])) {
            $lineas = [];
            $tercero = busca_filtro_tabla("", "datos_ejecutor de join ejecutor e on de.ejecutor_idejecutor = e.idejecutor", "de.iddatos_ejecutor = {$factura[0]["proveedor"]}", "", $conn);
            if ($tercero["numcampos"]) {
                $lineas[] = "<div>";
                $lineas[] = $tercero[0]["nombre"];
                $lineas[] = $tercero[0]["identificacion"];
                $lineas[] = $tercero[0]["direccion"];
                $lineas[] = $factura[0]["num_factura"];
                $lineas[] = $factura[0]["fecha_factura"];
                $lineas[] = "</div>";
                $texto = implode("<br>", $lineas);
            }
        }
    }
    echo $texto;
}

function mostrar_detalle_factura($idformato, $iddoc) {
    global $conn;
    $texto = "";
    $factura = busca_filtro_tabla("", "ft_factura_electronica", "documento_iddocumento = $iddoc", "", $conn);
    if ($factura["numcampos"]) {
        $items = busca_filtro_tabla("", "ft_ite_factur_electronica", "ft_factura_electronica = {$factura[0]["idft_factura_electronica"]}", "", $conn);
        if ($items["numcampos"]) {
            $lineas = [];
            $lineas[] = '<table style="width:100%;">';
            $lineas[] = '<thead><tr>';
            $lineas[] = '<th style="text-align: center;">Descripci&oacute;n</th>';
            $lineas[] = '<th style="text-align: center;">Cantidad</th>';
            $lineas[] = '<th style="text-align: center;">V. Unitario</th>';
            //$lineas[] = '<th style="text-align: center;">IVA</th>';
            $lineas[] = '<th style="text-align: center;">Total</th>';
            $lineas[] = '</tr></thead>';
            $lineas[] = '<tbody>';
            for($i = 0; $i < $items["numcampos"]; $i++) {
                $lineas[] = '<tr>';
                $lineas[] = "<td>{$items[$i]['descripcion']}</td>";
                $vu = number_format($items[$i]['valor_unitario'], 0);
                $vt = number_format($items[$i]['valor_total'], 0);

                $lineas[] = "<td style='text-align: right;'>{$items[$i]['cantidad']}</td>";
                $lineas[] = "<td style='text-align: right;'>&#36;{$vu}</td>";
                //$lineas[] = "<td style='text-align: right;'>{$items[$i]['valor_iva']}</td>";
                $lineas[] = "<td style='text-align: right;'>&#36;{$vt}</td>";
                $lineas[] = '</tr>';
            }
            $lineas[] = '</tbody>';
            $lineas[] = '<tfoot><tr>';
            $lineas[] = '<th scope="row">Total</th>';
            $lineas[] = "<td></td>";
            $lineas[] = "<td></td>";
            //$lineas[] = "<td></td>";
            $tf = number_format($factura[0]['total_factura'], 0);
            $lineas[] = "<td style='text-align: right;'>&#36;{$tf}</td>";
            $lineas[] = '</tr></tfoot>';
            $lineas[] = '</table>';
            $texto = implode("\n", $lineas);
        }
    }
    echo $texto;
}