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
$probando = "<br>Este es un muy formato para generar salidas de los funcionarios con el permiso"; 
//"Este es un texto muy largo que quiero ver si funciona";
//$etiquetas = conseguirEtiquetas($probando);

$texto = strtolower($probando);
		$texto = preg_replace("/formato/", "", $texto);
		$texto = strip_tags($texto);	
		$texto = htmlentities($texto);
 		$texto = preg_replace('/\&(.)[^;]*;/', '\\1', $texto);
		print_r($texto);
 		$texto = quitar_preposiciones_articulos($texto);
		$j=0;
		for($i=0;$i<count($texto);$i++){
			$resultado[$j]=$texto[$i];
			$j++;
		}
		$cant = count($texto);
		$cant_espacio = $cant-1;
		$rest = 23-$cant_expacio;
		
		$total_caracteres = $rest/$cant;
		print_r($texto);		
		$cadena = array();
		for($i=0;$i<$cant;$i++)
		{
			if($texto[$i]!=""){
				$cantidad_caracteres = strlen($texto[$i]);
				$diferencia = $cantidad_caracteres-round($total_caracteres);
				if(strlen($texto[$i])>round($total_caracteres)){
					$quitar_caracteres = $diferencia*-1;
					$cadena[] = substr($texto[$i], 0, $quitar_caracteres);
				}
				else {
					$cadena[]=$texto[$i];
				}
			}
		}		
		if(count($cadena)>1)
		{
			$nuevo_texto = implode("_", $cadena);
		}
		else{
			$nuevo_texto = implode($cadena);
		}
		print_r($nuevo_texto);
		print_r(validar_nombres($nuevo_texto));
function quitar_preposiciones_articulos($texto){
    $separarTexto = explode(" ", $texto);
	
     /* con este foreach lo que hago es que quito las palabras que sean 
    de menos de 3 caracteres como lo son las, los, un, una y todas esas */
    
   /* foreach($separarTexto as $valor){
        $caracteres = strlen($valor); // cuento el numero de caracteres
        if($caracteres > '3'){ // verifico que sea mayor que 3
            $etiquetas[] = $valor; // agrego la palabra al array etiquetas si es mayor que 3
        }   
    }*/
$articulos_preposiciones = array('a', 'lo','los','la','el','es','un','de','muy','con','unos', 'unas', 'este','estos', 'esos', 'aquel', 'aquellos', 'esta', 'estas', 'esas', 'aquella', 'aquellas', 'éste', 'éstos', 'ésos', 'aquél', 'aquéllos', 'ésta', 'éstas', 'ésas', 'aquélla', 'aquéllas','delete','insert','update', 'ante', 'bajo', 'cabe', 'desde', 'contra', 'entre', 'hacia', 'hasta', 'para', 'por','según', 'segun', 'sin','sobre', 'tras');
 
/*- utilizo la funcion de PHP array_dif para que me compare las palabras
con las preposiciones y los articulos y me devuelva solo lo que en
realidad necesitamos, osea las palabras que merecen ser etiquetas */
//$resultado = array_diff($etiquetas, $articulos_preposiciones['articulos'], $articulos_preposiciones['preposiciones']);
//$resultado = array_diff($articulos_preposiciones,"",$etiquetas);

$resultado = array_diff($separarTexto,$articulos_preposiciones);
print_r($resultado);
for($i=0;$i<count($resultado);$i++)
{
	if($resultado[$i]==""){
		unset($resultado[$i]);
	}
}
$resultado=array_values($resultado);
// retorno el resultado
return $resultado;
}
function validar_nombres($texto){
	//buscar si existe el nombre
	$cant = strlen($texto);
	//print_r($texto);
	$buscar_nombres = busca_filtro_tabla("", "formato", "nombre='$texto'", "", $conn);
	$i=0;	
	if($buscar_nombres["numcampos"]){
		$i=substr($texto,-3);
		if(strpos($i,"_")){
			$i++;
		}
		else{
			$i=1;
		}
		if(($cant+3)<23){
			$sumar_cant = $cant+3;	
			//$invID = str_pad($invID, 4, '0', STR_PAD_LEFT);		
			$nuevo_texto = str_pad($texto, $sumar_cant, "_0".$i, STR_PAD_RIGHT);
			print_r($nuevo_texto);
			validar_nombres($nuevo_texto);
		}		
	}
	else{
			return $nuevo_texto;
		}
}