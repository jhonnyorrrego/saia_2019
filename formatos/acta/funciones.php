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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function nombre_grupo_funcion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.grupo_reunido","ft_acta A","A.documento_iddocumento=".$iddoc,"",$conn);
	return($datos[0]['grupo_reunido']);
}


/*function mostrar_listado_asistentes($idformato,$iddoc){
	global $conn;
	
	$funcionarios_asistentes = busca_filtro_tabla("A.asistentes","ft_acta A","A.documento_iddocumento=".$iddoc,"",$conn);	
	
	$funcionarios = explode(',',$funcionarios_asistentes[0]['asistentes']);	
	
	$array_funcionario=array();
	for($i=0; $i<sizeof($funcionarios); $i++){
		if(strpos($funcionarios[$i],'#')){
			$codigos=buscar_funcionarios3(str_replace('#','',$funcionarios[$i]));
			$cant=count($codigos);
			for($j=0;$j<$cant;$j++){
				$funcionario = busca_filtro_tabla("nombres,apellidos, funcionario_codigo, nit","funcionario a, dependencia_cargo b","iddependencia_cargo='".$codigos[$j]."' and b.funcionario_idfuncionario=a.idfuncionario","",$conn);
				$cargo_funcionario=busca_filtro_tabla("C.nombre AS cargo","funcionario A, dependencia_cargo B, dependencia C","A.idfuncionario=B.funcionario_idfuncionario AND B.dependencia_iddependencia=C.iddependencia AND A.estado='1' AND B.estado='1' AND C.estado='1' AND A.funcionario_codigo=".$funcionario[0]['funcionario_codigo'],"",$conn);
				if(!in_array($funcionario[0]['funcionario_codigo'],$codigos)){
					if($funcionario[0]['nit'])$funcionario[0]['funcionario_codigo']=$funcionario[0]['nit'];
					array_push($array_funcionario,array('nombre'=> ucwords(strtolower($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].' - '.$cargo_funcionario[0]['cargo'])),'cedula'=>$funcionario[0]['funcionario_codigo']));
					$codigos[]=$funcionario[0]['funcionario_codigo'];
				}
			}
		}else{
			$funcionario = busca_filtro_tabla("nombres,apellidos,funcionario_codigo, nit","funcionario a, dependencia_cargo b","a.idfuncionario=b.funcionario_idfuncionario and b.iddependencia_cargo=".$funcionarios[$i],"",$conn);
			$cargo_funcionario=busca_filtro_tabla("C.nombre AS cargo","funcionario A, dependencia_cargo B, cargo C","A.idfuncionario=B.funcionario_idfuncionario AND B.cargo_idcargo=C.idcargo AND A.estado='1' AND B.estado='1' AND C.estado='1' AND A.funcionario_codigo=".$funcionario[0]['funcionario_codigo'],"",$conn);
			if(!in_array($funcionario[0]['funcionario_codigo'],$codigos)){
				if($funcionario[0]['nit'])$funcionario[0]['funcionario_codigo']=$funcionario[0]['nit'];
				array_push($array_funcionario,array('nombre'=> ucwords(strtolower($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].' - '.$cargo_funcionario[0]['cargo'])),'cedula'=> $funcionario[0]['funcionario_codigo']));
				$codigos[]=$funcionario[0]['funcionario_codigo'];
			}
		}
	}	
	
	asort($array_funcionario);
	$tabla = '<table style="border-collapse: collapse; font-size: 15px; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
				<tr>
					<td style="text-align:center;"><b>NOMBRE PERSONA ASISTENTE</b></td>
					<td style="text-align:center;"><b>FIRMA</b></td>
				</tr>
			 ';
	foreach ($array_funcionario as $key){
		$tabla .='<tr>
					<td style="width:50%;"><br/><br/>'.$key['nombre'].'<br/><br/><br/></td>
					<td><br/><br/>&nbsp;<br/><br/><br/></td>
				  </tr>
		         ';	 
	}
	$tabla .='</table>';
	echo($tabla);	
}*/

function mostrar_listado_asistentes($idformato,$iddoc){
global $conn;

	$datos=busca_filtro_tabla("vp.nombres as nombre_p,vp.apellidos as apellidos_p,vs.nombres as nombre_s,vs.apellidos as apellidos_s","ft_acta,vfuncionario_dc vp,vfuncionario_dc vs","firma_presidente=vp.iddependencia_cargo and firma_secretaria=vs.iddependencia_cargo and documento_iddocumento=".$iddoc,"",$conn);
	$tabla = '<table style="border-collapse: collapse; font-size: 15px; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
				<tr>
					<td style="text-align:center;"><b>NOMBRES FIRMANTES</b></td>
					<td style="text-align:center;"><b>FIRMA</b></td>
				</tr>
			 ';

		$tabla .='<tr>
					<td style="width:50%;"><br/><br/>'.$datos[0]['nombre_p'].' '.$datos[0]['apellidos_p'].' - PRESIDENTE(A) <br/><br/></td>
					<td><br/><br/>&nbsp;<br/><br/><br/></td>
				  </tr>';	 
				  
		$tabla .='<tr>
					<td style="width:50%;"><br/><br/>'.$datos[0]['nombre_s'].' '.$datos[0]['apellidos_s'].' - SECRETARIO(A)<br/><br/></td>
					<td><br/><br/>&nbsp;<br/><br/><br/></td>
				  </tr>';	 				  
	
	$tabla .='</table>';
	if($datos['numcampos']){
		echo($tabla);	
	}
}


function listado_funcionarios_funcion($idformato,$iddoc){
	global $conn;
	$funcionarios_asistentes = busca_filtro_tabla("A.asistentes","ft_acta A","A.documento_iddocumento=".$iddoc,"",$conn);		
	$funcionarios = explode(',',$funcionarios_asistentes[0]['asistentes']);	
	
	$array_funcionario=array();
	for($i=0; $i<sizeof($funcionarios); $i++){
		if(strpos($funcionarios[$i],'#')){
			$codigos=buscar_funcionarios3(str_replace('#','',$funcionarios[$i]));
			$cant=count($codigos);
			for($j=0;$j<$cant;$j++){
				$funcionario = busca_filtro_tabla("nombres,apellidos, funcionario_codigo, nit","funcionario a, dependencia_cargo b","iddependencia_cargo='".$codigos[$j]."' and b.funcionario_idfuncionario=a.idfuncionario","",$conn);
				$cargo_funcionario=busca_filtro_tabla("C.nombre AS cargo","funcionario A, dependencia_cargo B, dependencia C","A.idfuncionario=B.funcionario_idfuncionario AND B.dependencia_iddependencia=C.iddependencia AND A.estado='1' AND B.estado='1' AND C.estado='1' AND A.funcionario_codigo=".$funcionario[0]['funcionario_codigo'],"",$conn);
				if(!in_array($funcionario[0]['funcionario_codigo'],$codigos)){
					if($funcionario[0]['nit'])$funcionario[0]['funcionario_codigo']=$funcionario[0]['nit'];
					array_push($array_funcionario,array('nombre'=> ucwords(strtolower($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].' - '.$cargo_funcionario[0]['cargo'])),'cedula'=>$funcionario[0]['funcionario_codigo']));
					$codigos[]=$funcionario[0]['funcionario_codigo'];
				}
			}
		}else{
			$funcionario = busca_filtro_tabla("nombres,apellidos,funcionario_codigo, nit","funcionario a, dependencia_cargo b","a.idfuncionario=b.funcionario_idfuncionario and b.iddependencia_cargo=".$funcionarios[$i],"",$conn);
			$cargo_funcionario=busca_filtro_tabla("C.nombre AS cargo","funcionario A, dependencia_cargo B, cargo C","A.idfuncionario=B.funcionario_idfuncionario AND B.cargo_idcargo=C.idcargo AND A.estado='1' AND B.estado='1' AND C.estado='1' AND A.funcionario_codigo=".$funcionario[0]['funcionario_codigo'],"",$conn);
			if(!in_array($funcionario[0]['funcionario_codigo'],$codigos)){
				if($funcionario[0]['nit'])$funcionario[0]['funcionario_codigo']=$funcionario[0]['nit'];
				array_push($array_funcionario,array('nombre'=> ucwords(strtolower($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].' - '.$cargo_funcionario[0]['cargo'])),'cedula'=> $funcionario[0]['funcionario_codigo']));
				$codigos[]=$funcionario[0]['funcionario_codigo'];
			}
		}
	}	
	
	asort($array_funcionario);
	$tabla = '';
	foreach ($array_funcionario as $key){
		$tabla .=" * ".$key['nombre'].'<br/>';	 
	}
	echo($tabla);	
}

function buscar_funcionarios3($dependencia, $arreglo=NULL){	
	global $conn, $ruta_db_superior;
	include_once($ruta_db_superior."class_transferencia.php");
	$dependencias=dependencias_asistentes($dependencia);
	
	array_push($dependencias,$dependencia);
	$dependencias=array_unique($dependencias);
	$funcionarios = busca_filtro_tabla("B.iddependencia_cargo","funcionario A,dependencia_cargo B, cargo C,dependencia D","B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia=D.iddependencia and B.dependencia_iddependencia IN(".implode(",",$dependencias).") AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1","",$conn);
	$arreglo=extrae_campo($funcionarios,"iddependencia_cargo","U");
	
	return($arreglo);
}

function estilo_tabla($idformato,$iddoc){
  echo "<style>
  table{
    border-collapse: collapse; 
    width: 100%;
    font-family: Arial,verdana; 
    font-size: 14px;
  }
</style>";
}
?>

