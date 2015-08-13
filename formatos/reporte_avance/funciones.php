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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
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
include_once($ruta_db_superior."formatos/librerias/num2letras.php");


function fecha_reporte($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","ft_reporte_avance","documento_iddocumento=".$iddoc,"",$conn);
$fecha=busca_filtro_tabla("A.fecha","documento A"," A.iddocumento=".$iddoc,"",$conn);
//print_r($fecha);

echo $fecha[0]["fecha"]."";
}
function categoria_soporte($idformato,$iddoc)
{global $conn;
$consulta=busca_filtro_tabla("","ft_reporte_avance","documento_iddocumento=".$iddoc,"",$conn);
$categoria=busca_filtro_tabla("A.nombre","serie A,ft_reporte_avance B","A.cod_padre=884 AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $categoria[0]["nombre"];
//print_r($categoria);
}

function estado_proceso($idformato,$iddoc)
{global $conn,$ruta_db_superior;
$consulta=busca_filtro_tabla("max(A.documento_iddocumento),A.estado_proceso","ft_reporte_avance","documento_iddocumento=".$iddoc,"",$conn);
echo $consulta[0]["estado_proceso"];
//print_r($consulta);
}

function vinculos_reporte($idformato,$iddoc)
{global $conn, $ruta_db_superior;

$consulta=busca_filtro_tabla("","ft_solicitud_soporte A,ft_reporte_avance B,vfuncionario_dc C","A.dependencia=C.iddependencia_cargo AND A.idft_solicitud_soporte=B.ft_solicitud_soporte AND B.documento_iddocumento=".$iddoc,"",$conn);
$fecharespuesta=busca_filtro_tabla("A.fecha","documento A"," A.iddocumento=".$iddoc,"",$conn);
$papa=busca_filtro_tabla("A.documento_iddocumento","ft_solicitud_soporte A,ft_reporte_avance B"," A.idft_solicitud_soporte=B.ft_solicitud_soporte AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($papa);

$texto.='<table style="width: 55%;" border="0">
<tr>
<td style=font-size:12px;WIDTH:40; >Descripcion:</td>
<td style=font-size:12px>'.html_entity_decode($consulta[0]['descripcion']).'</td>
</tr>
<tr>
<td style=font-size:12px; >Solicitante:</td>
<td style=font-size:12px>'.html_entity_decode($consulta[0]['nombres']).'</td>
</tr> 
<tr>
<td style=font-size:12px; >Fecha solicitud:</td>
<td style=font-size:12px>'.html_entity_decode($consulta[0]['fecha_soporte']).'</td>
</tr>
<tr>
<td style=font-size:12px; >Fecha respuesta:</td>
<td style=font-size:12px>'.html_entity_decode($fecharespuesta[0]['fecha']).'</td>
</tr>
<tr>
<td style=font-size:12px; ><a href="'.$ruta_db_superior.'formatos/solicitud_soporte/mostrar_solicitud_soporte.php?iddoc='.$papa[0]["documento_iddocumento"].'&idformato=218">Ver solicitud</a></td>






</tr>
</table>';
echo $texto;
}


/********Ruta Respuesta***************/
function crear_ruta_soporte($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_reporte_avance ","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario,"",$conn);

 $director=busca_filtro_tabla("A.*","vfuncionario_dc A","A.idcargo=".$usuario_logeado[0]['cod_padre']."  AND A.iddependencia = ".$usuario_logeado[0]['dependencia_iddependencia'],"",$conn);
 
 $gestionH=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_solicitud_permiso B ","A.iddependencia_cargo=B.gestion_humana  AND  B.documento_iddocumento=".$iddoc,"",$conn);

		    
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado
array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>0));

if($usuario<>$director[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$director[0]['funcionario_codigo'],"tipo_firma"=>1));//primera posicion
	} 
   
 if($usuario<>$gestionH[0]['funcionario_codigo']){
   array_push($ruta,array("funcionario"=>$gestionH[0]['funcionario_codigo'],"tipo_firma"=>2));
    }
   
 
if(count($ruta)>1){
    $radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));
//print_r($ruta);die();
phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
 }
 
}     
?>