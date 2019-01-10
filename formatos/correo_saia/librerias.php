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

function mostrar_documento_factura_correo($iddoc, $numero) {
    global $conn, $ruta_db_superior;
    if (!is_numeric($numero)) {
        $numero = 0;
    }
    return ('<div class="link kenlace_saia" enlace="ordenar.php?key=' . $iddoc . '&accion=mostrar&mostrar_formato=1" conector="iframe" titulo="No Factura ' . $numero . '"><span class="badge">' . $numero . '</span></div>');
}

function transferido_correo($funcionario_codigo) {
    global $conn;
    $funcionario = busca_filtro_tabla('nombres,apellidos', 'funcionario', 'funcionario_codigo=' . $funcionario_codigo, '', $conn);
    return ($funcionario[0]['nombres'] . ' ' . $funcionario[0]['apellidos']);
}

function nombre_proveedor_reporte($iddatos_ejecutor){
	global $conn,$ruta_db_superior;
	
	$proveedor=busca_filtro_tabla("nombre","vejecutor","iddatos_ejecutor=" . $iddatos_ejecutor,"",$conn);
	
	return $proveedor[0]['nombre'];
}

function pago_desde_reporte($pago_desde){
	global $conn,$ruta_db_superior;
	
	$pago_desde_mostrar=array(1=>'Fecha factura',2=>'Fecha oficio entrada');
	
	return $pago_desde_mostrar[$pago_desde];
}


?>