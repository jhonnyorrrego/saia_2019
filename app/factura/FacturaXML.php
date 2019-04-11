<?php
class FacturaXML {
    private $archivo;
    private $contenido;
    private $documento;
    private $xpath;

    private $ns_cbc = "cbc:"; //CommonBasicComponents
    private $ns_fe = "fe:"; //facturaelectronica
    private $ns_cac = "cac:"; //CommonAggregateComponents
    private $ns_ext = "ext:"; //CommonExtensionComponents-2"
    private $ns_sts = "sts:"; //facturaelectronica/v1/Structures"

    private $ns_list = array(
        "fe"     => "http://www.dian.gov.co/contratos/facturaelectronica/v1",
        "cac"    => "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2",
        "cbc"    => "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2",
        // "cdt"    => "urn:DocumentInformation:names:specification:ubl:colombia:schema:xsd:DocumentInformationAggregateComponents-1",
        "clm54217" => "urn:un:unece:uncefact:codelist:specification:54217:2001",
        "clm66411" => "urn:un:unece:uncefact:codelist:specification:66411:2001",
        "clmIANAMIMEMediaType" => "urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003",
        // "cts"    => "urn:carvajal:names:specification:ubl:colombia:schema:xsd:CarvajalAggregateComponents-1",
        "ext"    => "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2",
        // "grl"    => "urn:General:names:specification:ubl:colombia:schema:xsd:GeneralAggregateComponents-1",
        "qdt"    => "urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2",
        "sts"    => "http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures",
        "udt"    => "urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"
    );

    public function __construct(array $parametros) {
        if(isset($parametros["contenido"]) && !empty($parametros["contenido"])) {
            $this->contenido = $parametros["contenido"];
        } else if(isset($parametros["archivo"]) && !empty($parametros["archivo"])) {
            $this->archivo = $parametros["archivo"];
            $this->contenido = file_get_contents($this->archivo);
        }
        $this->inicializar();
    }

    private function inicializar() {
        $this->documento = new DOMDocument();
        $this->documento->loadXML($this->contenido);
        $this->xpath = new DOMXpath($this->documento);
        $this->inicializar_ns();
    }

    private function inicializar_ns() {
        foreach ($this->ns_list as $key => $value) {
            $this->xpath->registerNamespace($key, $value);
        }

    }

    private function iterar_elementos($elements) {
        $result = array();
        if ($elements) {
            foreach ($elements as $element) {
                $nodes = $element->childNodes;
                foreach ($nodes as $node) {
                    if(!empty($node->nodeValue)) {
                        $result[] = trim($node->nodeValue);
                    }
                }
            }
        }
        return $result;
    }

    private function iterar_persona(DOMNodeList $elements) {
        $result = array();
        if ($elements) {
            foreach ($elements as $element) {
                $nodo_tipo = $this->xpath->query("{$this->ns_cbc}AdditionalAccountID", $element)->item(0);
                if($nodo_tipo) {
                    $result["tipo_persona"] = $nodo_tipo->nodeValue;
                }

                $nodo_id = $this->xpath->query("{$this->ns_fe}Party/{$this->ns_cac}PartyIdentification/{$this->ns_cbc}ID", $element)->item(0);
                if($nodo_id) {
                    $result["identificacion"] = $nodo_id->nodeValue;
                }

                //$nodo_nombre = $this->xpath->query("{$this->ns_fe}Party/{$this->ns_cac}PartyName/{$this->ns_cbc}Name", $element)->item(0);
                $nodo_nombre = $this->xpath->query("{$this->ns_fe}Party/{$this->ns_fe}PartyLegalEntity/{$this->ns_cbc}RegistrationName", $element)->item(0);

                if($nodo_nombre) {
                    $result["nombre"] = $nodo_nombre->nodeValue;
                }
                $nodo_direccion = $this->xpath->query("{$this->ns_fe}Party/{$this->ns_fe}PhysicalLocation", $element)->item(0);
                if($nodo_direccion) {
                    $desc_dir = $this->xpath->query("{$this->ns_fe}Address/{$this->ns_cac}AddressLine/{$this->ns_cbc}Line", $nodo_direccion);
                    $n_desc_dir = null;
                    if($desc_dir && $desc_dir->length > 0) {
                        $n_desc_dir = $desc_dir->item(0);
                        $result["direccion"] = $n_desc_dir->nodeValue;
                    }
                    if(!isset($result["direccion"]) || empty($result["direccion"])) {
                        $desc_dir = $this->xpath->query("{$this->ns_cbc}Description", $nodo_direccion);
                        if($desc_dir && $desc_dir->length > 0) {
                            $n_desc_dir = $desc_dir->item(0);
                            $result["direccion"] = $n_desc_dir->nodeValue;
                        }
                    }
                    $n_depto = $this->xpath->query("{$this->ns_fe}Address/{$this->ns_cbc}Department", $nodo_direccion)->item(0);
                    $result["departamento"] = $n_depto->nodeValue;
                    $n_ciudad = $this->xpath->query("{$this->ns_fe}Address/{$this->ns_cbc}CityName", $nodo_direccion)->item(0);
                    $result["ciudad"] = $n_ciudad->nodeValue;
                    $n_pais = $this->xpath->query("{$this->ns_fe}Address/{$this->ns_cac}Country/{$this->ns_cbc}IdentificationCode", $nodo_direccion)->item(0);
                    $result["pais"] = $n_pais->nodeValue;
                }
            }
        }
        return $result;
    }

    public function notas() {
        $elements = $this->xpath->query("/{$this->ns_fe}Invoice/{$this->ns_cbc}Note");
        $notas = implode("\n", $this->iterar_elementos($elements));
        return $notas;
    }

    public function numeroFactura() {
        $date_elements = $this->xpath->query("//{$this->ns_fe}Invoice/{$this->ns_cbc}ID");
        $factura = implode("", $this->iterar_elementos($date_elements));
        return $factura;
    }

    public function fechaExpedicion() {
        $date_elements = $this->xpath->query("//{$this->ns_cbc}IssueDate");
        $fechas = implode("", $this->iterar_elementos($date_elements));
        $time_elements = $this->xpath->query("//{$this->ns_cbc}IssueTime");
        $fechas .= " " . implode("", $this->iterar_elementos($time_elements));
        return $fechas;
    }

    public function datosCliente() {
        $elements = $this->xpath->query("//{$this->ns_fe}Invoice/{$this->ns_fe}AccountingCustomerParty");
        $cliente = $this->iterar_persona($elements);
        return $cliente;
    }

    public function nitCliente() {
        // Obtener el NIT
        $elements = $this->xpath->query("//{$this->ns_fe}Invoice/{$this->ns_fe}AccountingCustomerParty/{$this->ns_fe}Party/{$this->ns_cac}PartyIdentification/{$this->ns_cbc}ID");
        $cliente = implode("\n", $this->iterar_elementos($elements));
        return $cliente;
    }

    public function datosProveedor() {
        $elements = $this->xpath->query("//{$this->ns_fe}Invoice/{$this->ns_fe}AccountingSupplierParty");
        $proveedor = $this->iterar_persona($elements);
        return $proveedor;
    }

    public function nitProveedor() {
        // Obtener el NIT
        $elements = $this->xpath->query("//{$this->ns_fe}Invoice/{$this->ns_fe}AccountingSupplierParty/{$this->ns_fe}Party/{$this->ns_cac}PartyIdentification/{$this->ns_cbc}ID");
        $proveedor = implode("\n", $this->iterar_elementos($elements));
        return $proveedor;
    }

    public function items() {
        $elements = $this->xpath->query("//{$this->ns_fe}InvoiceLine");
        $items = $this->iterar_items($elements);
        return $items;
    }

    public function detalleImpuestos() {
        $elements = $this->xpath->query("//{$this->ns_fe}TaxTotal");
        //TODO: Iterar c/u de los elementos (hasta ahora 6 detectados):
        // Iva 19%, Iva 16%, Iva 5%, Imp Consumo 16%, Imp Consumo 8%, Imp Consumo 4%
        return array();
    }

    public function totalFactura() {
        $elements = $this->xpath->query("//{$this->ns_fe}LegalMonetaryTotal/{$this->ns_cbc}PayableAmount");
        //TODO: Iterar c/u de los elementos (hasta ahora 6 detectados):
        // Iva 19%, Iva 16%, Iva 5%, Imp Consumo 16%, Imp Consumo 8%, Imp Consumo 4%
        $total = implode("\n", $this->iterar_elementos($elements));
        return $total;
    }

    private function iterar_items(DOMNodeList $elements) {
        $result = array();
        if ($elements) {
            foreach ($elements as $element) {
                $item = array();

                $id_item = $this->xpath->query("{$this->ns_cbc}ID", $element)->item(0);
                if($id_item) {
                    $item["id"] = $id_item->nodeValue;
                }
                $cant_item = $this->xpath->query("{$this->ns_cbc}InvoicedQuantity", $element)->item(0);
                if($cant_item) {
                    $item["cantidad"] = trim($cant_item->nodeValue);
                }
                $precio_item = $this->xpath->query("{$this->ns_cbc}LineExtensionAmount", $element)->item(0);
                if($precio_item) {
                    $item["valor"] = trim($precio_item->nodeValue);
                }
                $gratis_item = $this->xpath->query("{$this->ns_cbc}FreeOfChargeIndicator", $element)->item(0);
                if($gratis_item) {
                    $item["gratis"] = $gratis_item->nodeValue;
                }
                $nodo_item = $this->xpath->query("{$this->ns_fe}Item", $element)->item(0);
                if($nodo_item) {
                    $desc_item = $this->xpath->query("{$this->ns_cbc}Description", $nodo_item)->item(0);
                    if($desc_item) {
                        $item["descripcion"] = trim($desc_item->nodeValue);
                    }
                    $id_item = $this->xpath->query("{$this->ns_cac}StandardItemIdentification/{$this->ns_cbc}ID", $nodo_item);
                    if($id_item && $id_item->length >0) {
                        $item["id_std"] = $id_item->item(0)->nodeValue;
                    }
                }

                $nodo_imp = $this->xpath->query("{$this->ns_cac}TaxTotal", $element)->item(0);
                if($nodo_imp) {
                    $total_imp = $this->xpath->query("{$this->ns_cbc}TaxAmount", $nodo_imp)->item(0);
                    if($total_imp) {
                        $item["impuestos"] = $total_imp->nodeValue;
                    }
                    // TODO: Falta iterar sobre el detalle de cada tipo de impuesto
                }


                $precio_item = $this->xpath->query("{$this->ns_fe}Price/{$this->ns_cbc}PriceAmount", $element)->item(0);
                if($precio_item) {
                    $item["precio"] = $precio_item->nodeValue;
                }
                if(!empty($item)) {
                    $result[] = $item;
                }
            }
        }
        return $result;
    }

}