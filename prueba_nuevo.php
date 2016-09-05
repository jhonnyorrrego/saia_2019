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
include_once($ruta_db_superior.'pruebas_ruben/dias_habiles_nuevo/festivos_colombia.php');
date_default_timezone_set('America/Bogota');

ini_set('display_errors',true);
$fecha="2016-12-01";
print_r(esCambioAnio($fecha,40));


function esCambioAnio($fecha,$dias){
    $fecha_fin=calculaFecha("days",$dias,$fecha);
    
    $ar_fechafin=date_parse($fecha_fin);
    $aniofinal=$ar_fechafin["year"];
    $mesfinal=$ar_fechafin["month"];
    $diafinal=$ar_fechafin["day"];  
    
    $ar_fechaini=date_parse($fecha);
    $anioini=$ar_fechaini["year"];
    $mesini=$ar_fechaini["month"];
    $diaini=$ar_fechaini["day"];    
    
    
    $retorno=array('cambio'=>0,'fecha_part2'=>'');
    if($aniofinal>date('Y')){
        $retorno['cambio']=1;
        //$retorno['fecha_part1']=$anioini.'-'.$mesini.'-'.$diaini.'|'.$anioini.'-12-31';
        $part1_date1=date_create($anioini.'-'.$mesini.'-'.$diaini);
        $part1_date2=date_create($anioini.'-12-31');
        $diff=date_diff($part1_date1,$part1_date2);
        $diferencia_parte_uno=$diff->format("%a");
        
        $part1_date1=$anioini.'-'.$mesini.'-'.$diaini;
        $festivos2 = new CalendarCol(date('Y'));
        $cantidad_festivos_part1=0;
        for($i=1;$i<=$diferencia_parte_uno;$i++){
           $fecha=calculaFecha("days",$i,$part1_date1);
          
           if($festivos2->esFestivo($fecha)){
              $cantidad_festivos_part1++;
           }
        }        
        $part2_fecha_fin=calculaFecha("days",$cantidad_festivos_part1,$aniofinal.'-'.$mesfinal.'-'.$diafinal);
        
        $part2_date1=date_create($aniofinal.'-01-01');
        $part2_date2=date_create($part2_fecha_fin);
        $diff2=date_diff($part2_date1,$part2_date2);
        $retorno['diferencia_part2']=$diff2->format("%a");  
        $retorno['fecha_part2']=$aniofinal.'-01-01'.'|'.$part2_fecha_fin;
        
        
    }
    
    
    return($retorno);

}
die();
function calculaFecha($modo,$valor,$fecha_inicio=false,$formato=false){
    
    if(!$formato){
        $formato="Y-m-d";
    }
	if($fecha_inicio!=false) {
		$fecha_base = strtotime($fecha_inicio); 

	}else {
   		$time=time();          
		$fecha_actual=date($formato,$time);       
		$fecha_base=strtotime($fecha_actual);  
	}     
	$calculo = strtotime("$valor $modo","$fecha_base");    
	return date($formato, $calculo);  
}




function esDiaNoHabil(){
        global $conn;
        
        $dias_no_habiles=busca_filtro_tabla("valor","configuracion","tipo='festivos' AND nombre='dias_no_habiles'","",$conn);
        $vector_dias_no_habiles=explode(',',$dias_no_habiles[0]['valor']);
        $vector_dias_no_habiles_int=array();
        $vector_config=array('l'=>1,'m'=>2,'x'=>3,'j'=>4,'v'=>5,'s'=>6,'d'=>7); //dias de las semana segun php  date('N', strtotime($needle)
        for($i=0;$i<count($vector_dias_no_habiles);$i++){
            $vector_dias_no_habiles_int[]=$vector_config[ $vector_dias_no_habiles[$i] ];
        }
        $vector_dias_no_habiles_int=array_map('strtolower',$vector_dias_no_habiles_int);
        return($vector_dias_no_habiles_int);
    }

die();
function dias_habiles_nuevo($dias,$formato=NULL,$fecha_inicial=NULL){ 
  global $conn; 
   if(!$formato)
     $formato="d-m-Y"; 
   $formato_bd= "dd-mm-YYYY"; // Formato validor para el motor y DEBE SER COMPATIBLE CON $formato
   if(!$fecha_inicial)
     $fecha_inicial =date($formato);
 
   $ar_fechaini=date_parse($fecha_inicial);
   $anioinicial=$ar_fechaini["year"];
   $mesinicial=$ar_fechaini["month"];
   $diainicial=$ar_fechaini["day"];
   
   $fecha_final=date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias,$anioinicial));
    $asignaciones=busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","asignacion","asignacion.documento_iddocumento='-1'  AND asignacion.fecha_inicial < ".fecha_db_almacenar($fecha_final,$formato)." AND asignacion.fecha_final > ".fecha_db_almacenar($fecha_inicial,$formato),"",$conn); 

  if($asignaciones["numcampos"]){  
    $no_laborales=$asignaciones["numcampos"]; 
	  $fecha_legal= date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias,$anioinicial)); 
    return(dias_habiles_nuevo($no_laborales,$formato,$fecha_legal));    
   }
 $fecha_legal= date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + $dias - 1 ,$anioinicial));   
 return($fecha_legal);
}




die();

include_once("pantallas/lib/librerias_cripto.php");




	$funcionarios=busca_filtro_tabla("","funcionario a","a.estado=1 AND a.funcionario_codigo NOT IN ('1','2','9','111222333')","",$conn);
	$reemplazos=busca_filtro_tabla("","reemplazo_saia b","b.estado=1","",$conn);
	$funcionarios_activos=$funcionarios['numcampos'];
	$reemplazos_activos=$reemplazos['numcampos'];
	$cupos_usados=$funcionarios_activos+$reemplazos_activos;
	
	//Consulta la cantidad de usuarios definidos en la configuracion y desencripta el valor
	$consulta_usuarios=busca_filtro_tabla("valor","configuracion","nombre='numero_usuarios'","",$conn);
	$numero_encript=$consulta_usuarios[0]['valor'];
	$numero_usuarios=decrypt_blowfish($numero_encript,LLAVE_SAIA_CRYPTO);
	
	//Verifica si ya se alzanzó el número de usuarios activos
	
	echo($cupos_usados.'>='.$numero_usuarios);die();
	if($cupos_usados>=$numero_usuarios){
	    
	    
	    
	}


die();





include_once("librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

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