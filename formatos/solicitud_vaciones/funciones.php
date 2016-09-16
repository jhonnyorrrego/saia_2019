<?php
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."formatos/librerias/num2letras.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

   
function ruta_vaciones($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_solicitud_vaciones","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	$usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C,ft_solicitud_vaciones D"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario. " AND  D.documento_iddocumento=".$iddoc,"",$conn);
	    //print_r($usuario_logeado[0]['cod_padre']);
	$director=busca_filtro_tabla("A.*","vfuncionario_dc A,ft_solicitud_vaciones B","A.idcargo=".$usuario_logeado[0]['cod_padre']."   AND B.documento_iddocumento=".$iddoc,"",$conn);
         //print_r($director);
	$gestionH=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_solicitud_vaciones B ","A.iddependencia_cargo=B.gestio_humana  AND  B.documento_iddocumento=".$iddoc,"",$conn);
         //print_r($gestionH);
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado

	if($usuario<>$director[0]["funcionario_codigo"]){
		array_push($ruta,array("funcionario"=>$director[0]['funcionario_codigo'],"tipo_firma"=>1));//primera posicion
	} 
   
	if($director<>$gestionH[0]['funcionario_codigo']){
		array_push($ruta,array("funcionario"=>$gestionH[0]['funcionario_codigo'],"tipo_firma"=>2));
	}
 
	if(count($ruta)>1){
	   // $radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
	//array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));	
		phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
	  insertar_ruta($ruta,$iddoc,0);
	}
}     

/*********/
function calcula_fecha($idformato,$iddoc){
	$fechas=busca_filtro_tabla("A.fecha_ini_vacaciones,A.fecha_fin_vaciones,TIMESTAMPDIFF(DAY,fecha_ini_vacaciones,fecha_fin_vaciones) AS fecha","ft_solicitud_vaciones A","A.documento_iddocumento=".$iddoc,"",$conn);
	//print_r($fechas);
	
	//$fechas=busca_filtro_tabla(resta_fechas("A.fecha_ini_vacaciones","A.fecha_fin_vaciones")."as fecha","ft_solicitud_vaciones A","   A.documento_iddocumento=".$iddoc,"",$conn);
	 echo $fechas[0]["fecha"];
		
  
} 
/*******/
function nombre_gestionH($idformato,$iddoc){
	 $gestionH=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_solicitud_vaciones B ","A.iddependencia_cargo=B.gestion_humana  AND  B.documento_iddocumento=".$iddoc,"",$conn);
	 	 echo $gestionH[0]['gestion_humana'];
} 
 function fecha_in_vacaciones($idformato,$iddoc){
  global $conn;
  $fechaf=busca_filtro_tabla(fecha_db_obtener("fecha_ini_vacaciones","d")." as dia,"
  .fecha_db_obtener("fecha_ini_vacaciones","m")."as mes,".fecha_db_obtener("fecha_ini_vacaciones","Y")."as ano, documento_iddocumento as doc","ft_solicitud_vaciones","documento_iddocumento=".$iddoc,"",$conn);
  echo $fechaf[0]["dia"]." ".mes_letras($fechaf[0]["mes"]);
	echo " ".$fechaf[0]["ano"];
}
function mes_letras($mes){
 switch($mes){
  case 1:
   $valor= "enero";
   break;
  case 2:
   $valor= "febrero";
   break;
  case 3:
   $valor= "marzo";
   break;
  case 4:
   $valor= "abril";
   break;
  case 5:
   $valor= "mayo";
   break;
  case 6:
   $valor= "junio";
   break;
  case 7:
   $valor= "julio";
   break;
  case 8:
   $valor= "agosto";
   break;
  case 9:
   $valor= "septiembre";
   break;
  case 10:
   $valor= "octubre";
   break;
  case 11:
   $valor= "noviembre";
   break;
  case 12:
   $valor= "diciembre";
   break;          
 }
return $valor;
}

function fecha_fn_vacaciones($idformato,$iddoc){
  global $conn;
  $fechaf=busca_filtro_tabla(fecha_db_obtener("fecha_fin_vaciones","d")." as dia,"
  .fecha_db_obtener("fecha_fin_vaciones","m")."as mes,".fecha_db_obtener("fecha_fin_vaciones","Y")."as ano, documento_iddocumento as doc","ft_solicitud_vaciones","documento_iddocumento=".$iddoc,"",$conn);

  echo $fechaf[0]["dia"]." ".mes_letras($fechaf[0]["mes"]." ".$fecha[0]["ano"]);
	echo "  ".$fechaf[0]["ano"];
}

function fecha_inic_labores($idformato,$iddoc){
  global $conn;
  $fechaf=busca_filtro_tabla(fecha_db_obtener("fecha_ini_labores","d")." as dia,"
  .fecha_db_obtener("fecha_ini_labores","m")."as mes,".fecha_db_obtener("fecha_ini_labores","Y")."as ano, documento_iddocumento as doc","ft_solicitud_vaciones","documento_iddocumento=".$iddoc,"",$conn);

  echo $fechaf[0]["dia"]." ".mes_letras($fechaf[0]["mes"]."-".$fecha[0]["ano"]);
	echo "  ".$fechaf[0]["ano"];
}

function fecha_docu($idformato,$iddoc){
  global $conn;
  $fechaf=busca_filtro_tabla(fecha_db_obtener("fecha_ini_labores","d")." as dia,"
  .fecha_db_obtener("fecha_doc","m")."as mes,".fecha_db_obtener("fecha_doc","Y")."as ano, documento_iddocumento as doc","ft_solicitud_vaciones","documento_iddocumento=".$iddoc,"",$conn);

  echo $fechaf[0]["dia"]."-".mes_letras($fechaf[0]["mes"]."-".$fecha[0]["ano"]);
  echo "-".$fechaf[0]["ano"];
}

?>