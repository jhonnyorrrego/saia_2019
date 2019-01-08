<?php

require_once 'newfile.php';

if ($_REQUEST["ejecutar"]) {

	ini_set("display_errors", 1);
	$cadena = file_get_contents("http://saia-release.loc/saia_release/saia/webservice_saia/digitalizacion/wsdl.php?wsdl");

	$bom = pack('H*','EFBBBF');
	//$cadena = preg_replace("/^$bom/", '', $cadena);

	//print_r($cadena); die();

	/*libxml_use_internal_errors(true);
	$xml = simplexml_load_string($cadena);

	if ($xml === false) {
		echo "Failed loading XML\n";
		foreach(libxml_get_errors() as $error) {
			echo "\t", $error->message;
		}
	}
	print_r($xml); die();*/

	$soapclient = new WSDLSoapClient('http://saia-release.loc/saia_release/saia/webservice_saia/digitalizacion/wsdl.php?wsdl');

	// Use the functions of the client, the params of the function are in
	// the associative array
	$params = array(
			'usuario' => 'cerok',
			'clave' => 'cerok_saia421_5'
	);
	$response = $soapclient->consultar_info($params);

	var_dump($response);

	// Get the Cities By Country
	$param = array(
			'CountryName' => 'Spain'
	);
	$response = $soapclient->getCitiesByCountry($param);

	var_dump($response);
} else {

	?>

<form method="POST">
	<label>Acci&oacute;n</label> <select name="accion" size="1">
		<option value="imp">Importar</option>
		<option value="exp">Exportar</option>
	</select>
	<br />
	<label>Usuario</label> <input type="text" name="usuario">
	<br />
	 <label>Clave</label> <input type="password" 	name="clave">
	 <br />
	 <label>Reporte</label> <input type="text" name="phone">
	 	<br />
	  <label>URL (WSDL)</label> <input type="text" name="wsurl">

	<input type="hidden" name="ejecutar" value="1">
	<input type="submit" value="Enviar">
	<input type="reset" value="Limpiar">

</form>
<?php
}
?>