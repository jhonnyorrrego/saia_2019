<?php
require_once 'FacturaXML.php';


//print_r($_REQUEST);

$datos = array();
if(isset($_REQUEST["datos_correo"])) {
    $datos = json_decode($_REQUEST["datos_correo"], true);
    if(json_last_error() !== JSON_ERROR_NONE) {
        echo "error en la cadena json<br>";
        print_r($_REQUEST["datos_correo"]);
        die();
    }

}

if(!empty($datos)) {
    echo "Recibidos<br>";
    foreach ($datos["adjuntos"] as $archivo) {
        $es = file_exists($archivo);
        echo $archivo . " => ";
        echo "" . (!$es ? 'No' : 'Si');
        echo "<br>";
    }
}
die();

$factura = new FacturaXML(array("archivo" => "factura_ex.xml"));

$finl = "<br>";



echo "Factura No.: " . $factura->numeroFactura() . $finl;
echo "Fecha expedición: " . $factura->fechaExpedicion() . $finl;

$proveedor = $factura->datosProveedor();
echo "Proveedor: $finl";
if(is_array($proveedor)) {
    foreach ($proveedor as $key => $value) {
       echo "$key : $value $finl";
    }
} else {
    echo $proveedor . $finl;
}
echo $finl;
$cliente = $factura->datosCliente();
echo "Cliente: " .  $finl;
if(is_array($cliente)) {
    foreach ($cliente as $key => $value) {
        echo "$key : $value $finl";
    }
} else {
    echo $cliente . $finl;
}
echo $finl;

$items = $factura->items();
echo "Items: " . $finl;
if(is_array($items)) {
    foreach ($items as $key => $value) {
        echo "$key : $value $finl";
    }
} else {
    echo $items . $finl;
}
echo $finl;

$total = $factura->totalFactura();
print_r($total);
echo $finl;

//echo print_r($factura->notas());

?>