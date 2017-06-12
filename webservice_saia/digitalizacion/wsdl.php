﻿<?php
$functions = array();
/**
 * ***************************************************************************
 * To access this WSDL specification run via: /wsdl.php?WSDL
 * Any other access to this WSDL will display as a HTML document
 *
 * 2013 (C) Copyright Lyndon Leverington / DarkerWhite
 * ****************************************************************************
 * Set up the web service parameters:
 * $serviceName: Plain Text to display when someone accesses this service
 * without the ?WSDL parameter in the URL. Whitespaces are
 * removed from this and this is then used as the ID for the
 * XML in the WSDL. Please only use A-Z, 0-9 and spaces.
 *
 * Declare all Functions for this Web Service
 * $functions Array Parameters:
 * funcName - Name of the particular function being served
 * doc - Documentation to report from Web Service regarding this function
 * inputParams - An array of arrays where name = name of field and type = data type
 * Omit if not required
 * outputParams - As above, but for responses
 * Omit if not required
 * soapAddress - The php file to send to to process SOAP requests
 * ***************************************************************************
 */

$serviceName = "Web Service Digitalizacion SAIA";

$protocol = "http://";
if(!empty($_SERVER['HTTPS'])) {
    $protocol = "https://";
}

$port = "";
if(!empty($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
    $port = ":" . $_SERVER["SERVER_PORT"];
}

//$soap_address = "http://localhost/~giovanni/saia_reborn/saia/webservice_saia/digitalizacion/digitalizacion_service.php";
$soap_address = $protocol .  $_SERVER["SERVER_NAME"] . $port . dirname($_SERVER['PHP_SELF']) . "/digitalizacion_service.php";
$functions[] = array(
        "funcName" => "consultar_info",
        "doc" => "Consultar informacion para digitalizar para un usuario.",
        "inputParams" => array(
                array(
                        "name" => "usuario",
                        "type" => "string"
                ),
                array(
                        "name" => "clave",
                        "type" => "string"
                )
        ),
        "outputParams" => array(
                array(
                        "name" => "status",
                        "type" => "int"
                ),
                array(
                        "name" => "iddoc",
                        "type" => "int",
                        "nillable" => "true"
                ),
                array(
                        "name" => "idfunc",
                        "type" => "int",
                        "nillable" => "true"
                ),
                array(
                        "name" => "message",
                        "type" => "string"
                )
        ),
        "soapAddress" => $soap_address
);

$functions[] = array(
        "funcName" => "actualizar_estado",
        "doc" => "Actualizar informacion para digitalizar para un usuario.",
        "inputParams" => array(
                array(
                        "name" => "iddoc",
                        "type" => "int"
                ),
                array(
                        "name" => "idfunc",
                        "type" => "int"
                )
        ),
        "outputParams" => array(
                array(
                        "name" => "status",
                        "type" => "int"
                ),
                array(
                        "name" => "message",
                        "type" => "string"
                )
        ),
        "soapAddress" => $soap_address
);

$functions[] = array(
        "funcName" => "verificar_login",
        "doc" => "Veficar informacion del usuario.",
        "inputParams" => array(
                array(
                        "name" => "usuario",
                        "type" => "string"
                ),
                array(
                        "name" => "clave",
                        "type" => "string"
                )
        ),
        "outputParams" => array(
                array(
                        "name" => "status",
                        "type" => "int"
                ),
                array(
                        "name" => "message",
                        "type" => "string"
                ),
                array(
                        "name" => "idfunc",
                        "type" => "int",
                        "nillable" => "true"
                )
        ),
        "soapAddress" => $soap_address
);

/*
 $types[] = array(
 "typeName" => "contacto",
 "elements" => array(
 array(
 "name" => "direccion",
 "type" => "direccion"
 ),
 array(
 "name" => "email",
 "type" => "string"
 ),
 array(
 "name" => "id",
 "type" => "int"
 ),
 array(
 "name" => "nombre",
 "type" => "string"
 ),
 array(
 "name" => "telefonos",
 "type" => "ArrayOfString"
 )
 )
 );
 $types[] = array(
 "typeName" => "direccion",
 "elements" => array(
 array(
 "name" => "city",
 "type" => "string"
 ),
 array(
 "name" => "nr",
 "type" => "string"
 ),
 array(
 "name" => "street",
 "type" => "string"
 ),
 array(
 "name" => "zipcode",
 "type" => "string"
 )
 )
 );
 $types[] = array(
 "typeName" => "contactoArray",
 "array" => "true",
 "type" => "contacto"
 );

 $types[] = array(
 "typeName" => "ArrayOfString",
 "array" => "true",
 "type" => "string"
 );
 */

// ----------------------------------------------------------------------------
// END OF PARAMETERS SET UP
// ----------------------------------------------------------------------------

/**
 * ***************************************************************************
 * Process Page / Request
 * ***************************************************************************
 */

if (stristr($_SERVER['QUERY_STRING'], "wsdl")) {
	// WSDL request - output raw XML
	// header("Content-Type: application/soap+xml; charset=utf-8");
	header("Content-Type: text/xml; charset=utf-8");
	echo DisplayXML();
} else {
	// Page accessed normally - output documentation
	$cp = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1); // Current page
	echo '<!-- Attention: To access via a SOAP client use ' . $cp . '?WSDL -->';
	echo '<html>';
	echo '<head><title>' . $serviceName . '</title></head>';
	echo '<body>';
	echo '<h1>' . $serviceName . '</h1>';
	echo '<p style="margin-left:20px;">To access via a SOAP client use <code>' . $cp . '?WSDL</code></p>';

	// Document each function
	echo '<h2>Available Functions:</h2>';
	echo '<div style="margin-left:20px;">';
	for($i = 0; $i < count($functions); $i++) {
		echo '<h3>Function: ' . $functions[$i]['funcName'] . '</h3>';
		echo '<div style="margin-left:20px;">';
		echo '<p>';
		echo $functions[$i]['doc'];
		echo '<ul>';
		if (array_key_exists("inputParams", $functions[$i])) {
			echo '<li>Input Parameters:<ul>';
			for($j = 0; $j < count($functions[$i]['inputParams']); $j++) {
				echo '<li>' . $functions[$i]['inputParams'][$j]['name'];
				echo ' (' . $functions[$i]['inputParams'][$j]['type'];
				echo ')</li>';
			}
			echo '</ul></li>';
		}
		if (array_key_exists("outputParams", $functions[$i])) {
			echo '<li>Output Parameters:<ul>';
			for($j = 0; $j < count($functions[$i]['outputParams']); $j++) {
				echo '<li>' . $functions[$i]['outputParams'][$j]['name'];
				echo ' (' . $functions[$i]['outputParams'][$j]['type'];
				echo ')</li>';
			}
			echo '</ul></li>';
		}
		echo '</ul>';
		echo '</p>';
		echo '</div>';
	}
	echo '</div>';

	echo '<h2>WSDL output:</h2>';
	echo '<pre style="margin-left:20px;width:800px;overflow-x:scroll;border:1px solid black;padding:10px;background-color:#D3D3D3;">';
	echo DisplayXML(false);
	echo '</pre>';
	echo '</body></html>';
}

exit();

/**
 * ***************************************************************************
 * Create WSDL XML
 *
 * @param
 *        	xmlformat=true - Display output in HTML friendly format if set false
 *        	***************************************************************************
 */
function DisplayXML($xmlformat = true) {
	global $functions; // Functions that this web service supports
	global $serviceName; // Web Service ID
	global $types;
	$default_types = array("byte", "short", "integer", "int", "long", "double", "decimal", "string", "date", "time", "dateTime", );
	$other_types = array("normalizedString", "token", "duration", "gDay", "gMonth", "gMonthDay", "gYear", "gYearMonth",
			"negativeInteger", "nonNegativeInteger", "nonPositiveInteger", "positiveInteger", "unsignedLong", "unsignedInt", "unsignedShort", "unsignedByte");
	$tipos_xsd = array_merge($default_types, $other_types);
	$i = 0; // For traversing functions array
	$j = 0; // For traversing parameters arrays
	$k = 0; // For traversing types arrays
	$str = ''; // XML String to output

	// Tab spacings
	$t1 = '    ';
	if (!$xmlformat)
		$t1 = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$t2 = $t1 . $t1;
		$t3 = $t2 . $t1;
		$t4 = $t3 . $t1;
		$t5 = $t4 . $t1;

		$serviceID = str_replace(" ", "", $serviceName);

		// Declare XML format
		$str .= '<?xml version="1.0" encoding="UTF-8" standalone="no"?>' . "\n\n";

		// Declare definitions / namespaces
		$str .= '<wsdl:definitions ' . "\n";
		$str .= $t1 . 'xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" ' . "\n";
		$str .= $t1 . 'xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" ' . "\n";
		$str .= $t1 . 'xmlns:s="http://www.w3.org/2001/XMLSchema" ' . "\n";
		$str .= $t1 . 'xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/" ' . "\n";
		$str .= $t1 . 'targetNamespace="http://www.cerok.com/" ' . "\n";
		$str .= $t1 . 'xmlns:tns="http://www.cerok.com/" ' . "\n";
		$str .= $t1 . 'name="' . $serviceID . '" ' . "\n";
		$str .= '>' . "\n\n";

		// Declare Types / Schema
		$str .= '<wsdl:types>' . "\n";
		$str .= $t1 . '<s:schema elementFormDefault="qualified" targetNamespace="http://www.cerok.com/">' . "\n";
		$total_tipos = count($types);
		for($k = 0; $k < $total_tipos; $k++) {
			$str .= $t2 . '<s:complexType name="' . $types[$k]["typeName"] . '">' . "\n";
			if (array_key_exists("array", $types[$k]) && $types[$k]["array"] == "true") {
				$tipo = $types[$k]['type'];
				$prefijo_tipo = "tns:";
				if(in_array($tipo, $tipos_xsd)) {
					$prefijo_tipo = "s:";
				}
				$str .= $t2 . "<s:complexContent>\n";
				$str .= $t3 . '<s:restriction base="soapenc:Array">' . "\n";
				$str .= $t4 . '<s:attribute wsdl:arrayType="' . $prefijo_tipo . $tipo . '[]" ref="soapenc:arrayType"/>' . "\n";
				$str .= $t3 . "</s:restriction>\n";

				$str .= $t2 . "</s:complexContent>\n";
			} else {
				$total_atributos = count($types[$k]['elements']);
				if ($total_atributos) {
					//$str .= $t2 . '<s:all>' . "\n";
					for($l = 0; $l < $total_atributos; $l++) {
						if (array_key_exists('nillable', $types[$k]['elements'][$l])) {
							$str .= $t3 . '<s:element nillable="' . $types[$k]['elements'][$l]['nillable'] . '" ';
						} else {
							$str .= $t3 . '<s:element minOccurs="1" maxOccurs="1" ';
						}
						$str .= 'name="' . $types[$k]['elements'][$l]['name'] . '" ';
						$tipo_dato = $types[$k]['elements'][$l]['type'];
						$prefijo_tipo = "tns:";
						if(in_array($tipo, $tipos_xsd)) {
							$prefijo_tipo = "s:";
						}
						$str .= 'type="' . $prefijo_tipo . $tipo_dato . '" />' . "\n";
					}
					//$str .= $t2 . '</s:all>' . "\n";
				}
			}
			$str .= $t2 . '</s:complexType>' . "\n";
			// $str .= $t2 . '</s:element>' . "\n";
		}
		for($i = 0; $i < count($functions); $i++) {
			// Define Request Types
			if (array_key_exists("inputParams", $functions[$i])) {
				$str .= $t2 . '<s:element name="' . $functions[$i]['funcName'] . 'Request">' . "\n";
				$str .= $t3 . '<s:complexType><s:sequence>' . "\n";
				for($j = 0; $j < count($functions[$i]['inputParams']); $j++) {
					$str .= $t4 . '<s:element minOccurs="1" maxOccurs="1" ';
					$str .= 'name="' . $functions[$i]['inputParams'][$j]['name'] . '" ';
					$str .= 'type="s:' . $functions[$i]['inputParams'][$j]['type'] . '" />' . "\n";
				}
				$str .= $t3 . '</s:sequence></s:complexType>' . "\n";
				$str .= $t2 . '</s:element>' . "\n";
			}
			// Define Response Types
			if (array_key_exists("outputParams", $functions[$i])) {
				$str .= $t2 . '<s:element name="' . $functions[$i]['funcName'] . 'Response">' . "\n";
				$str .= $t3 . '<s:complexType><s:sequence>' . "\n";
				for($j = 0; $j < count($functions[$i]['outputParams']); $j++) {
					if (array_key_exists('nillable', $functions[$i]['outputParams'][$j])) {
						$str .= $t4 . '<s:element nillable="' . $functions[$i]['outputParams'][$j]['nillable'] . '" ';
					} else {
						$str .= $t4 . '<s:element minOccurs="1" maxOccurs="1" ';
					}
					$str .= 'name="' . $functions[$i]['outputParams'][$j]['name'] . '" ';
					$str .= 'type="s:' . $functions[$i]['outputParams'][$j]['type'] . '" />' . "\n";
				}
				$str .= $t3 . '</s:sequence></s:complexType>' . "\n";
				$str .= $t2 . '</s:element>' . "\n";
			}
		}
		$str .= $t1 . '</s:schema>' . "\n";
		$str .= '</wsdl:types>' . "\n\n";

		// Declare Messages
		for($i = 0; $i < count($functions); $i++) {
			// Define Request Messages
			if (array_key_exists("inputParams", $functions[$i])) {
				$str .= '<wsdl:message name="' . $functions[$i]['funcName'] . 'Request">' . "\n";
				$str .= $t1 . '<wsdl:part name="parameters" element="tns:' . $functions[$i]['funcName'] . 'Request" />' . "\n";
				$str .= '</wsdl:message>' . "\n";
			}
			// Define Response Messages
			if (array_key_exists("outputParams", $functions[$i])) {
				$str .= '<wsdl:message name="' . $functions[$i]['funcName'] . 'Response">' . "\n";
				$str .= $t1 . '<wsdl:part name="parameters" element="tns:' . $functions[$i]['funcName'] . 'Response" />' . "\n";
				$str .= '</wsdl:message>' . "\n\n";
			}
		}

		// Declare Port Types
		for($i = 0; $i < count($functions); $i++) {
			$str .= '<wsdl:portType name="' . $functions[$i]['funcName'] . 'PortType">' . "\n";
			$str .= $t1 . '<wsdl:operation name="' . $functions[$i]['funcName'] . '">' . "\n";
			if (array_key_exists("inputParams", $functions[$i])) {
				$str .= $t2 . '<wsdl:input message="tns:' . $functions[$i]['funcName'] . 'Request" />' . "\n";
			}
			if (array_key_exists("outputParams", $functions[$i])) {
				$str .= $t2 . '<wsdl:output message="tns:' . $functions[$i]['funcName'] . 'Response" />' . "\n";
			}
			$str .= $t1 . '</wsdl:operation>' . "\n";
			$str .= '</wsdl:portType>' . "\n\n";
		}

		// Declare Bindings
		for($i = 0; $i < count($functions); $i++) {
			$str .= '<wsdl:binding name="' . $functions[$i]['funcName'] . 'Binding" type="tns:' . $functions[$i]['funcName'] . 'PortType">' . "\n";
			$str .= $t1 . '<soap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http" />' . "\n";
			$str .= $t1 . '<wsdl:operation name="' . $functions[$i]['funcName'] . '">' . "\n";
			$str .= $t2 . '<soap:operation soapAction="' . $functions[$i]['soapAddress'] . '#' . $functions[$i]['funcName'] . '" style="document" />' . "\n";
			if (array_key_exists("inputParams", $functions[$i])) {
				$str .= $t2 . '<wsdl:input><soap:body use="literal" /></wsdl:input>' . "\n";
			}
			if (array_key_exists("outputParams", $functions[$i])) {
				$str .= $t2 . '<wsdl:output><soap:body use="literal" /></wsdl:output>' . "\n";
			}
			$str .= $t2 . '<wsdl:documentation>' . $functions[$i]['doc'] . '</wsdl:documentation>' . "\n";
			$str .= $t1 . '</wsdl:operation>' . "\n";
			$str .= '</wsdl:binding>' . "\n\n";
		}

		// Declare Service
		$str .= '<wsdl:service name="' . $serviceID . '">' . "\n";
		for($i = 0; $i < count($functions); $i++) {
			$str .= $t1 . '<wsdl:port name="' . $functions[$i]['funcName'] . 'Port" binding="tns:' . $functions[$i]['funcName'] . 'Binding">' . "\n";
			$str .= $t2 . '<soap:address location="' . $functions[$i]['soapAddress'] . '" />' . "\n";
			$str .= $t1 . '</wsdl:port>' . "\n";
		}
		$str .= '</wsdl:service>' . "\n\n";

		// End Document
		$str .= '</wsdl:definitions>' . "\n";

		if (!$xmlformat)
			$str = str_replace("<", "&lt;", $str);
			if (!$xmlformat)
				$str = str_replace(">", "&gt;", $str);
				if (!$xmlformat)
					$str = str_replace("\n", "<br />", $str);
					return $str;
}

?>
