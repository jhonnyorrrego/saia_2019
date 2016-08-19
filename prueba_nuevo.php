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
include('db.php');
include_once("librerias_saia.php");



die();
include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");
$ruta_tem=busca_filtro_tabla("","configuracion","nombre='ruta_temporal'","",$conn);
$ruta_temporal=$ruta_tem[0]['valor'].'_'.usuario_actual('login');

$archivos=array($ruta_temporal.'/img(#11839)pag-4.docx');
$archivos_anexos=array();
$extension_image=array('jpg','jpeg'); 
$cant=count($archivos);
for($i=0;$i<$cant;$i++){
	$extension=explode('.',$archivos[$i]);
	$extension=array_map('strtolower', $extension);
	if( !in_array($extension[($cant-1)],$extension_image) ){
		$archivos_anexos[]=$archivos[$i];
		unset($archivos[$i]);
	}	
}
$archivos=array_values($archivos);

$iddoc=11796;
foreach ($archivos_anexos as $archivo) {
	$ruta_archivo=$ruta_db_superior.$archivo;
	if(file_exists($ruta_archivo)){
		vincular_anexo_documento($iddoc,$archivo);
	}
}



function vincular_anexo_documento($iddoc,$ruta_origen){
	global $conn,$ruta_db_superior;
	$ruta_destino=selecciona_ruta_anexos("",$iddoc,'archivo');
	$nombre_extension = basename($ruta_db_superior.$ruta_origen);

	$vector_nombre_extension = explode('.',$nombre_extension);
	$extencion=$vector_nombre_extension[(count($vector_nombre_extension)-1)];
	$nombre_temporal=time().".".$extencion;
	mkdir($ruta_db_superior.$ruta_destino,0777);
	$tmpVar = 1;
	while(file_exists($ruta_db_superior.$ruta_destino. $tmpVar . '_' . $nombre_temporal)){
		$tmpVar++;
	}
	$nombre_temporal=$tmpVar . '_' . $nombre_temporal;
	copy($ruta_db_superior.$ruta_origen,$ruta_db_superior.$ruta_destino.$nombre_temporal);
	
	$data_sql=array();
	$data_sql['documento_iddocumento']=$iddoc;
	$data_sql['ruta']=$ruta_destino.$nombre_temporal;
	$data_sql['etiqueta']=$nombre_extension;
	$data_sql['tipo']=$extencion;

	$tabla="anexos";
	$strsql = "INSERT INTO ".$tabla." (fecha_anexo,"; //fecha_anexo
	$strsql .= implode(",", array_keys($data_sql));			
	$strsql .= ") VALUES (".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'";	//fecha_anexo		
	$strsql .= implode("','", array_values($data_sql));			
	$strsql .= "')";
 	phpmkr_query($strsql,$conn);
	$idanexo=phpmkr_insert_id();
	
	
	$data_sql=array();
	$data_sql['anexos_idanexos']=$idanexo;
	$data_sql['idpropietario']=usuario_actual('idfuncionario');
	$data_sql['caracteristica_propio']='lem';
	$data_sql['caracteristica_total']='1';
	
	$tabla="permiso_anexo";
	$strsql = "INSERT INTO ".$tabla." ("; 
	$strsql .= implode(",", array_keys($data_sql));			
	$strsql .= ") VALUES ('";		
	$strsql .= implode("','", array_values($data_sql));			
	$strsql .= "')";
	$sql1=$strsql;
	phpmkr_query($sql1);	
	
	return($idanexo);	
}

die();

















print_r($archivos);
echo('<br><br><br><br><br><br>');
print_r($archivos_anexos);

die();
 llena_serie(0,'modulo','');

function llena_serie($serie,$tabla,$padre=''){
global $conn;
  $papas=busca_filtro_tabla("*",$tabla,"cod_padre=".$serie,"nombre ASC",$conn);

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {$hijos = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"],"",$conn);
   $hijos_seleccionados = busca_filtro_tabla("count(*)",$tabla,"cod_padre=".$papas[$i]["id$tabla"],"",$conn);
   
   // echo utf8_encode(html_entity_decode(($papas[$i]["etiqueta"])))." (".$papas[$i]["nombre"].") (".$papas[$i]["idmodulo"].") ---> PADRE: (".$padre.")";
    echo ''.$papas[$i]["idmodulo"].'  '.utf8_encode(html_entity_decode($papas[$i]["etiqueta"])).'';
    $padre='';
    if($hijos[0][0]){
        $padre=$papas[$i]["nombre"];  
    }
    echo('<br>');
    llena_serie($papas[$i]["id$tabla"],'modulo',$padre);
  }     
}
return;
}




die();

$formatos=busca_filtro_tabla("idformato,etiqueta","formato","cod_padre IS NULL OR cod_padre='' ","etiqueta ASC",$conn);

for($i=0;$i<$formatos['numcampos'];$i++){
	echo('<p><strong>'.($i+1).') '.ucwords(strtolower($formatos[$i]['etiqueta'])).' ('.$formatos[$i]['idformato'].')</strong></p>');
	$hijos=tiene_hijos($formatos[$i]['idformato']);
	if($hijos['hijos']){
		$lista_hijos=lista_hijos($hijos['cuales']);
	}
	//print_r($hijos);
	
	
}
function tiene_hijos($idformato){
	global $conn;

	$hijos=busca_filtro_tabla("idformato","formato","cod_padre=".$idformato,"",$conn);
	
	$retorno=array();
	$retorno['hijos']=0;
	if($hijos['numcampos']){
		$retorno['hijos']=1;
		$retorno['cuales']=implode(',',extrae_campo($hijos,'idformato'));
	}
	return($retorno);
}
function lista_hijos($cuales){
	global $conn;
	
	$hijos=busca_filtro_tabla("etiqueta,idformato","formato","idformato IN(".$cuales.")","etiqueta ASC",$conn);
	if($hijos['numcampos']){
		for($i=0;$i<$hijos['numcampos'];$i++){
			echo('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - '.ucwords(strtolower($hijos[$i]['etiqueta'])).' ('.$hijos[$i]['idformato'].')<br/>');
		}
	}
}



?>