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
include_once ($ruta_db_superior . 'db.php');
include_once ($ruta_db_superior . "pantallas/busquedas/PHPExcel/funciones_excelphp.php");
require_once ($ruta_db_superior . 'pantallas/busquedas/PHPExcel.php');

$idanexo_word = $_REQUEST['anexo_word'];
$idanexo_csv = $_REQUEST['anexo_csv'];
$idformato = $_REQUEST['idformato'];
$usuario = usuario_actual('idfuncionario');

$retorno = array();
$retorno['exito'] = 1;
$plantilla_csv = busca_filtro_tabla("ruta","anexos_tmp","idanexos_tmp = ".$idanexo_csv,"",$conn);
$plantilla_word = busca_filtro_tabla("ruta","anexos_tmp","idanexos_tmp = ".$idanexo_word,"",$conn);

if(file_exists($ruta_db_superior.$plantilla_word[0]['ruta']) && $idanexo_word != ''){	
	require_once $ruta_db_superior . 'pantallas/lib/PhpWord/SaiaTemplateProcessor.php';
	$obligatoria = array("formato_numero","ciudad_fecha","nombre_funcionario","cargo","nombre_dependencia");
	$varibles_sistema = array("nombre_funcionario1","cargo1","nombre_dependencia1","espacio_firma","espacio_firma1","elaborado_por","espacio_firma","espacio_firma1","logo_empresa","nombre_formato","codigo_qr","nombre_revisado");
	$no_validar = array_merge($varibles_sistema, $obligatoria);
	
	$templateProcessor = new SaiaTemplateProcessor($ruta_db_superior.$plantilla_word[0]['ruta']);
	$campos_word = $templateProcessor -> getVariables();
	
	$cant = count($obligatoria);
	$cant_campos_word = count($obligatoria);
	for($i=0; $i<$cant; $i++){
		if(!in_array($obligatoria[$i], $campos_word)){
			$retorno['exito'] = 0;
			break;
		}
	}
	$valores_validar = array_diff($campos_word, $no_validar);
}
if(file_exists($ruta_db_superior.$plantilla_csv[0]['ruta']) && $idanexo_csv != ''){
	$archivo = $ruta_db_superior.$plantilla_csv[0]['ruta'];
	$info = new SplFileInfo($archivo);
	$extension = $info->getExtension();
	$header = array();
	if ($extension == "xls" || $extension == 'xlsx') {
		$inputFileType = PHPExcel_IOFactory::identify($archivo);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader -> setReadDataOnly(true);
        $objPHPExcel = $objReader -> load($archivo);
        $objWorksheet = $objPHPExcel -> getActiveSheet();

        foreach ($objWorksheet->getRowIterator() as $row) {
           	$j = 0;
            $col = 'A';
            $cellIterator = $row -> getCellIterator();
            $cellIterator -> setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                if ($i == 0) {
                    if (trim($cell -> getValue())) {
                        $header[$j] = str_replace(" ", "_", $cell -> getValue());
                    } else {
                        $header[$j] = $col;
                    }
                }              
            }
        }
	} else {
		$fila = 1;
		if (($gestor = fopen($archivo, "r")) !== FALSE) {
			while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
				if ($fila == 1) {
					$header = $datos;
					$fila++;
					continue;
				}
			}
			fclose($gestor);
		}
	}
	$no_existe = array();
	$cant_excel = count($header);
	if($cant_excel == 0){
		$retorno['exito'] = 3; 
	}
	foreach($valores_validar as $valores){
		if(!in_array($valores, $header)){
			$no_existe[] = $valores;
			$retorno['exito'] = 2;
		}
	}
	$retorno['faltante'] = implode(",", $no_existe);
}
echo(json_encode($retorno));
?>