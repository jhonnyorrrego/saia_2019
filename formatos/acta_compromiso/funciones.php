<?php
function fecha_reunion_funcion($idformato,$iddoc){
  global $conn;
  
  $fecha=busca_filtro_tabla("fecha_reunion","ft_acta_compromiso","documento_iddocumento=".$iddoc,"",$conn);
  //funcion que separa la fecha en tres: day, month, year
  $fech=date_parse($fecha[0]["fecha_reunion"]);
  //funcion para convertir fecha de 2012 a 12
  //toma tres parametro, cadena, inicio de nueva cadena, y tamaño de nueva cadena
  $ano=substr($fech["year"],2,2);

  echo $fech["day"]."-".mes_letras($fech["month"])."-".$ano;
}
function mes_letras($mes){
 switch($mes){
  case 1:
   $valor= "ene";
   break;
  case 2:
   $valor= "feb";
   break;
  case 3:
   $valor= "mar";
   break;
  case 4:
   $valor= "abr";
   break;
  case 5:
   $valor= "may";
   break;
  case 6:
   $valor= "jun";
   break;
  case 7:
   $valor= "jul";
   break;
  case 8:
   $valor= "ago";
   break;
  case 9:
   $valor= "sep";
   break;
  case 10:
   $valor= "oct";
   break;
  case 11:
   $valor= "nov";
   break;
  case 12:
   $valor= "dic";
   break;          
 }
return $valor;
}
function dependencia_creador($idformato,$iddoc){
	global $conn;
	
	$responsable=busca_filtro_tabla("c.dependencia_iddependencia","documento a, funcionario b, dependencia_cargo c","a.iddocumento=".$iddoc." AND a.ejecutor=b.funcionario_codigo AND b.idfuncionario=c.funcionario_idfuncionario AND b.estado=1","",$conn);
	$dependencia=busca_filtro_tabla("a.iddependencia, a.nombre","dependencia a","iddependencia=".$responsable[0]["dependencia_iddependencia"],"",$conn);	
	echo $dependencia[0]["nombre"];	
}
function nombre_dependencia($idformato,$iddoc){
  global $conn;
    $dependencia=busca_filtro_tabla("b.nombre","ft_acta_compromiso a, dependencia b","a.dependencia_reunion=b.iddependencia AND a.documento_iddocumento=".$iddoc." AND b.estado=1","",$conn);
    echo $dependencia[0]["nombre"];
}

?>
