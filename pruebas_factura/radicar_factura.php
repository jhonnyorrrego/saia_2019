<?php
require_once 'FacturaXML.php';
$factura = new FacturaXML(array("archivo" => "factura_ms.xml"));

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

//echo print_r($factura->notas());

?>