<?php
require_once 'FacturaXML.php';
$factura = new FacturaXML(array("archivo" => "factura_ms.xml"));

$finl = "\n";

echo "Factura No.: " . $factura->numeroFactura() . $finl;
echo "Fecha expedición: " . $factura->fechaExpedicion() . $finl;

$proveedor = print_r($factura->datosProveedor(), true);
echo "Proveedor: " . $proveedor . $finl;

$cliente = print_r($factura->datosCliente(), true);
echo "Cliente: " . $cliente . $finl;

$items = print_r($factura->items(), true);
echo "Items: " . $items . $finl;

echo print_r($factura->notas());

?>