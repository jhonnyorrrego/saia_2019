<?php
include_once("db.php");
$idformato=3;
$campos=array();
$valores=array();
$registros=busca_filtro_tabla("","formato","idformato IN (".$idformato.")","",$conn);
$campos=parsear_array(array_keys($registros[0]),'',"estructura");
$valores=parsear_array(array_keys($registros[0]),array_values($registros[0]),"valores");
$sql1.='Formato<br><br>';
$sql1.="INSERT INTO formato(".implode(",",$campos).") VALUES(".implode(",",$valores).")<br><br>";

$campos_formato=busca_filtro_tabla("","campos_formato","formato_idformato IN (".$idformato.")","",$conn);
$campos=array();
$valores=array();
$campos=parsear_array(array_keys($campos_formato[0]),'',"estructura");
$sql1.='Campos formato<br><br>';
for($i=0;$i<$campos_formato["numcampos"];$i++){
	$valores=parsear_array(array_keys($campos_formato[0]),array_values($campos_formato[$i]),"valores");
	$sql1.="INSERT INTO campos_formato(".implode(",",$campos).") VALUES(".implode(",",$valores).")<br>";
}


echo $sql1;
function parsear_array($arreglo,$arreglo2,$tipo){
	$cantidad=count($arreglo);
	$aux=array();
	for($i=0;$i<$cantidad;$i++){
		if(!is_int($arreglo[$i])){
			if($tipo=='estructura'){
				if($arreglo[$i]!='idcampos_formato'){
					$aux[]=$arreglo[$i];
				}
			}
			else if($tipo=='valores'){
				if($arreglo[$i]=='cuerpo'){
					$aux[]="'".addslashes($arreglo2[$i])."'";
				}
				else if($arreglo[$i]=='formato_idformato'){
					$aux[]="'88'";
				}
				else if($arreglo[$i]!='idcampos_formato'){
					$aux[]="'".$arreglo2[$i]."'";
				}
			}
		}
	}
	return $aux;
}
?>