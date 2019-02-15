<?php
if(!@$_SESSION["LOGIN"]){
@session_start();
$_SESSION["LOGIN"]="cerok";
$_SESSION["usuario_actual"]="1";
}
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior.'pantallas/lib/librerias_cripto.php');
$parametros=request_encriptado();
if(@$parametros["idexpediente"]){
	mostrar_informacion_expediente($parametros["idexpediente"]);
}
else if(@$parametros["idcaja"]){
	mostrar_informacion_caja($parametros["idcaja"]);
}
function mostrar_informacion_expediente($idexpediente){
	global $conn, $arreglo2;
	$expediente=busca_filtro_tabla("","expediente A","A.idexpediente=".$idexpediente,"",$conn);
	$documentos=mostrar_contador_expediente($idexpediente);
  $arreglo2=array();
  obtener_expedientes_padre2($idexpediente);
  $cant=count($arreglo2);
  
	$tabla='';
	$tabla.='<table style="width:100%;border-collapse:collapse" border="1px">';
	$tabla.='<tr>';
	$tabla.='<td style="width:30%">Nombre expediente</td>';
	$tabla.='<td style="width:70%">'.$expediente[0]["nombre"].'</td>';
	$tabla.='</tr>';
	$tabla.='<tr>';
	$tabla.='<td>Cantidad documentos almacenados</td>';
	$tabla.='<td>'.$documentos.'</td>';
	$tabla.='</tr>';
  if($cant){
    $tabla.='<tr>';
    $tabla.='<td colspan="2" style="text-align:center"><b>Expedientes hijos</b></td>';
    $tabla.='</tr>';
    for($i=0;$i<$cant;$i++){
      $datos=explode("|-|",$arreglo2[$i]);
      $documentos=mostrar_contador_expediente($datos[0]);
      
      $tabla.='<tr>';
      $tabla.='<td>Nombre: </td>';
      $tabla.='<td>'.$datos[1].'</td>';
      $tabla.='</tr>';
      $tabla.='<tr>';
      $tabla.='<td>Cantidad documentos almacenados</td>';
      $tabla.='<td>'.$documentos.'</td>';
      $tabla.='</tr>';
    } 
  }
	$tabla.='</table>';
	echo($tabla);
}

function mostrar_informacion_caja($idcaja){
	global $conn;
	$caja=busca_filtro_tabla("","caja A","A.idcaja=".$idcaja,"",$conn);
	$expedientes=busca_filtro_tabla("A.nombre","expediente A","A.fk_idcaja=".$idcaja,"",$conn);
	$nombres=extrae_campo($expedientes,"nombre");
	$tabla='';
	$tabla.='<table style="width:100%;border-collapse:collapse" border="1px">';
	$tabla.='<tr>';
	$tabla.='<td style="width:30%">No consecutivo caja</td>';
	$tabla.='<td style="width:70%">'.$caja[0]["no_consecutivo"].'</td>';
	$tabla.='</tr>';
	$tabla.='<tr>';
	$tabla.='<td>Expedientes vinculados</td>';
	$tabla.='<td>'.implode(",", $nombres).'</td>';
	$tabla.='</tr>';
	$tabla.='</table>';
	echo($tabla);
}

function mostrar_contador_expediente($idexpediente){
	global $conn,$arreglo;
	$arreglo=array();
	$expedientes=array();
	obtener_expedientes_padre($idexpediente,$expedientes);
	$arreglo=array_merge($arreglo,array($idexpediente));
	
	$documentos=busca_filtro_tabla("count(B.iddocumento) as cantidad","expediente_doc A, documento B","A.expediente_idexpediente in(".implode(",",$arreglo).") AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO')","",$conn);
	
	if(!$documentos["numcampos"])$documentos[0]["cantidad"]=0;
	return($documentos[0]["cantidad"]);
}
function obtener_expedientes_padre($idexpediente){
	global $arreglo;
	$expediente=busca_filtro_tabla("","expediente A","A.cod_padre=".$idexpediente."","",$conn);
	if($expediente["numcampos"]){
		for($i=0;$i<$expediente["numcampos"];$i++){
			array_push($arreglo,$expediente[$i]["idexpediente"]);
			$hijos=busca_filtro_tabla("","expediente A","A.cod_padre=".$expediente[$i]["idexpediente"],"",$conn);
			if($hijos["numcampos"]){
				obtener_expedientes_padre($expediente[$i]["idexpediente"]);
			}
		}
	}
	return(true);
}
function obtener_expedientes_padre2($idexpediente){
  global $arreglo2;
  $expediente=busca_filtro_tabla("","expediente A","A.cod_padre=".$idexpediente."","",$conn);
  if($expediente["numcampos"]){
    for($i=0;$i<$expediente["numcampos"];$i++){
      array_push($arreglo2,$expediente[$i]["idexpediente"]."|-|".$expediente[$i]["nombre"]);
      $hijos=busca_filtro_tabla("","expediente A","A.cod_padre=".$expediente[$i]["idexpediente"],"",$conn);
      if($hijos["numcampos"]){
        obtener_expedientes_padre2($expediente[$i]["idexpediente"]);
      }
    }
  }
  return(true);
}
?>