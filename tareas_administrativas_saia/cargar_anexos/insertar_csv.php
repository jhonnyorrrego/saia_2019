<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

$tabla_fun='temporal_funcionario';
$tabla_cargo='temporal_cargo';
$tabla_depen='temporal_dependencia';
$tabla_depen_cargo='temporal_dependencia_cargo';
$directorio=$ruta_db_superior."cargar_anexos/files/";
$fecha_final_rol='2013-01-01 01:00:00';
$conn->Ejecutar_Sql("truncate table ".$tabla_fun);
$conn->Ejecutar_Sql("truncate table ".$tabla_cargo);
$conn->Ejecutar_Sql("truncate table ".$tabla_depen);
$conn->Ejecutar_Sql("truncate table ".$tabla_depen_cargo);
if($dh = @opendir($directorio)){
	while (false !== ($obj = readdir($dh))) 
	{ 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        }
        $formato=explode(".",$obj);
		$cantidad=count($formato);
		if($formato[$cantidad-1]=='csv'){
			$archivo = fopen('files/'.$obj,'r');
			$a=1;
			while($linea = fgetcsv($archivo,0,",")){
				if($a==1){
					$cantidad=count($linea);
					for($i=0;$i<$cantidad;$i++){
						$dis=explode("-",$linea[$i]);
						examinar($dis,$i);
					}
					$a++;
					continue;
				}
				if(busqueda_funcionario($campos_funcionario,$linea,'idfuncionario')=="ok"){
					$id_fun=insertar_dato($campos_funcionario,$linea,$tabla_fun);
				}
				else{
					$llave=busqueda_funcionario($campos_funcionario,$linea,'idfuncionario');
					$id_fun=modificar_dato($campos_funcionario,$linea,$tabla_fun,'idfuncionario',$llave);
				}
				
				if(busqueda_cargo($campos_cargo,$linea,'idcargo')=="ok"){
					$id_car=insertar_dato($campos_cargo,$linea,$tabla_cargo);
				}
				else{
					$llave=busqueda_cargo($campos_cargo,$linea,'idcargo');
					$id_car=modificar_dato($campos_cargo,$linea,$tabla_cargo,'idcargo',$llave);
				}
				
				if(busqueda_depen($campos_dependencia,$linea,'iddependencia')=="ok"){
					$id_dep=insertar_dato($campos_dependencia,$linea,$tabla_depen);
				}
				else{
					$llave=busqueda_depen($campos_dependencia,$linea,'iddependencia');
					$id_dep=modificar_dato($campos_dependencia,$linea,$tabla_depen,'iddependencia',$llave);
				}
				$campos_rol=array('funcionario_idfuncionario', 'dependencia_iddependencia', 'cargo_idcargo', 'estado' , 'fecha_inicial', 'fecha_final', 'fecha_ingreso');
				$valores=array($id_fun,$id_dep,$id_car,1," ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." "," ".fecha_db_almacenar($fecha_final_rol,'Y-m-d H:i:s')." "," ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." ");
				insertar_dato($campos_rol,$valores,$tabla_depen_cargo);
				$a++;
				if($a>5){
					//die();
				}
			}
			while($linea = fgetcsv($archivo,0,",")){
				if($a==1){
					$a++;
					continue;
				}
				papa_cargo($campos_cargo,$linea);
				papa_dependencia($campos_dependencia,$linea);
				$a++;
				if($a>5){
					//die();
				}
			}
			fclose($archivo);
		}
		//unlink("files/".$obj);
	}  
}
echo "Datos insertados!";
function examinar($dis,$indice){
	global $conn;
	global $campos_funcionario,$funcionario;
	global $campos_cargo,$cargo;
	global $campos_dependencia,$dependencia;
	
	$tabla=$dis[1];
	$campo=$dis[0];
	switch($tabla){
		case 'cargo' : $cargo[]=$indice;
				$campos_cargo[$indice]=strtolower($campo);
		break;
		case 'funcionario' : $funcionario[]=$indice;
				$campos_funcionario[$indice]=strtolower($campo);
		break;
		case 'dependencia' : $dependencia[]=$indice;
				$campos_dependencia[$indice]=strtolower($campo);
		break;
	}
}
function busqueda_funcionario($campos,$dato,$campo_buscar){
	global $conn,$tabla_fun;
	$key=array_keys($campos,"funcionario_codigo");
	$fun_cod=($dato[$key[0]]);
	$busqueda=busca_filtro_tabla("",$tabla_fun,"funcionario_codigo=".$fun_cod,"",$conn);
	if($busqueda["numcampos"]>0){
		return $busqueda[0][$campo_buscar];
	}
	else{
		return 'ok';
	}
}
function busqueda_cargo($campos,$dato,$campo_buscar){
	global $conn,$tabla_cargo;
	$key=array_keys($campos,"nombre");
	$nom_car=($dato[$key[0]]);
	$busqueda=busca_filtro_tabla("",$tabla_cargo,"nombre like '".$nom_car."'","",$conn);
	if($busqueda["numcampos"]>0){
		return $busqueda[0][$campo_buscar];
	}
	else{
		return 'ok';
	}
}
function busqueda_depen($campos,$dato,$campo_buscar){
	global $conn,$tabla_depen;
	$key=array_keys($campos,"nombre");
	$nom_dep=($dato[$key[0]]);
	$busqueda=busca_filtro_tabla("",$tabla_depen,"nombre like '".$nom_dep."'","",$conn);
	if($busqueda["numcampos"]>0){
		return $busqueda[0][$campo_buscar];
	}
	else{
		return 'ok';
	}
}
function insertar_dato($campos,$valores,$tabla){
	global $conn;
	$ins="";
	foreach($campos as $clave => $valor){
		if(strpos($valores[$clave],'DATE_FORMAT')>0){
			$nuevos_valores[]=$valores[$clave];
		}
		else if($valores[$clave]==''){
			if($valor=='funcionario_codigo' && ($valores[$clave]=='' || $valores[$clave]==0)){
				$aleatorio=rand(1000,1000000);
				$resultado=busqueda_avanzado($aleatorio,$clave,$clave,$tabla);
				$codigo_fun=true;
				while($codigo_fun==true){
					if($resultado==0){
						$nuevos_valores[]="'".$aleatorio."'";
						$codigo_fun=false;
						break;
					}
					else{
						$aleatorio=rand(1000,1000000);
						$resultado=busqueda_avanzado($aleatorio,$clave,$clave,$tabla);
					}
				}
			}
			else{
				$nuevos_valores[]="''";
			}
		}
		else{
			$nuevos_valores[]="'".$valores[$clave]."'";
		}
	}
	$ins="INSERT INTO ".$tabla." (".implode(",",$campos).") VALUES (".implode(",",$nuevos_valores).")";
	phpmkr_query($ins);
	return phpmkr_insert_id();
}
function modificar_dato($campos,$valores,$tabla,$campo_llave,$llave){
	global $conn;
	foreach($campos as $clave => $valor){
		$nuevos_valores[]=$valor."='".$valores[$clave]."'";
	}
	$mod="";
	$mod="UPDATE ".$tabla." SET ".implode(",",$nuevos_valores)." WHERE ".$campo_llave."=".$llave;
	phpmkr_query($mod);
	return str_replace("'","",$llave);
}
function papa_cargo($campo,$valores){
	global $conn,$tabla_cargo;
	$padre=busqueda_cargo($campo,$valores,'cod_padre');
	if($padre!=''){
		$cod_padre=busqueda_avanzado($padre,'nombre','idcargo',$tabla_cargo);
		if($cod_padre!=0){
			$id=modificar_dato(array('cod_padre'),array($cod_padre),$tabla_cargo,'idcargo',$padre);
		}
	}
}
function papa_dependencia($campo,$valores){
	global $conn,$tabla_depen;
	$padre=busqueda_depen($campo,$valores,'cod_padre');
	if($padre!=''){
		$cod_padre=busqueda_avanzado($padre,'nombre','iddependencia',$tabla_depen);
		if($cod_padre!=0){
			$id=modificar_dato(array('cod_padre'),array($cod_padre),$tabla_depen,'iddependencia',$padre);
		}
	}
}

function busqueda_avanzado($valor,$campo_buscar,$campo_obtener,$tabla){
	global $conn;
	$busqueda=busca_filtro_tabla("",$tabla,$campo_buscar." like '".$valor."'","",$conn);
	if($busqueda["numcampos"]>0){
		return $busqueda[0][$campo_obtener];
	}
	else{
		return 0;
	}
}
?>