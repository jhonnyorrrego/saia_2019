<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."db.php");

function fun_proveedor($idformato,$iddoc){
$provee=busca_filtro_tabla("A.nombre","ejecutor A,datos_ejecutor B,ft_informe_recibo C,ft_factura_proveedor D"," D.prooveedor=B.iddatos_ejecutor AND B.ejecutor_idejecutor=A.idejecutor AND  D.idft_factura_proveedor = C.ft_factura_proveedor and C.documento_iddocumento=".$iddoc,"",$conn);
//print_r($provee);
echo $provee[0]['nombre'];

}
function crear_ruta_recibo($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_informe_recibo","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario,"",$conn);
     //print_r($usuario);
   $contabilidad=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A","A.idcargo=42","",$conn);
   $finanzas=busca_filtro_tabla("","vfuncionario_dc A","A.idcargo=49","",$conn);
  //print_r($finanzas);
		    
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado
array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>0));

if($usuario<>$contabilidad[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$contabilidad[0]['funcionario_codigo'],"tipo_firma"=>2));//primera posicion
	} 
   
   if($usuario<>$finanzas[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$finanzas[0]['funcionario_codigo'],"tipo_firma"=>2));//primera posicion
	} 
   
 /*if($usuario<>$gestionH[0]['funcionario_codigo']){
   array_push($ruta,array("funcionario"=>$gestionH[0]['funcionario_codigo'],"tipo_firma"=>2));
    }*/
   
 
if(count($ruta)>1){
    //$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
//array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));
//print_r($ruta);die();
phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
 }
 
}  
function recibo_caja($idformato,$iddoc){
$factura=busca_filtro_tabla("","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
$area=busca_filtro_tabla("A.dependencia","vfuncionario_dc A,ft_informe_recibo B","A.iddependencia_cargo=".$factura[0]['dependencia']." AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $area[0]['dependencia'];

}
function quien_recibe($idformato,$iddoc){
$factura=busca_filtro_tabla("","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
$recibe=busca_filtro_tabla("A.nombres","vfuncionario_dc A,ft_informe_recibo B","A.iddependencia_cargo=".$factura[0]['dependencia']." AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $recibe[0]['nombres'];

}
function recibe_nit($idformato,$iddoc){
$factura=busca_filtro_tabla("","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
$recibe=busca_filtro_tabla("A.nombres","vfuncionario_dc A,ft_informe_recibo B","A.iddependencia_cargo=".$factura[0]['dependencia']." AND B.documento_iddocumento=".$iddoc,"",$conn);
echo $recibe[0]['nit'];

}


function proveedor_nit($idformato,$iddoc){
$provee=busca_filtro_tabla("A.identificacion","ejecutor A,datos_ejecutor B,ft_informe_recibo C,ft_factura_proveedor D"," D.prooveedor=B.iddatos_ejecutor AND B.ejecutor_idejecutor=A.idejecutor AND  D.idft_factura_proveedor = C.ft_factura_proveedor and C.documento_iddocumento=".$iddoc,"",$conn);
//print_r($provee);
echo $provee[0]['identificacion'];

}
function datos_factura($idformato,$iddoc){
$factura=busca_filtro_tabla("A.*,B.cantidad","ft_factura_proveedor A,ft_informe_recibo B","A.idft_factura_proveedor=B.ft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($factura);
//echo $factura[0]['nombres'];
$texto='<table style="; width: 100%;" border="1">
<tbody>
<tr>
<td style=font-size:12px><strong>Descripcion</strong></td>
<td style=font-size:12px><strong>Num factura</strong></td>
<td style=font-size:12px><strong>Valor</strong></td>
<td style=font-size:11px><strong>Cantidad</strong></td>
</tr>
<tr>
<td style=font-size:12px>'.$factura[0]['observaciones'].'</td>
<td style=font-size:12px>'.$factura[0]['num_factura'].'</td>
<td style=font-size:12px>$'.$factura[0]['valor_factura'].'</td>
<td style=font-size:12px>'.$factura[0]['cantidad'].'</td>
</tr>
</tbody>
</table>';
echo $texto;
}
function ver_factura($idformato,$iddoc){
	global $ruta_db_superior;
	$iddoc_papa=buscar_papa_formato($idformato,$iddoc,"ft_factura_proveedor");
	$url=$ruta_db_superior."ordenar.php?accion=mostrar&tipo_destino=1&mostrar_formato=1&key =".$iddoc_papa;
	echo "<a href='".$url."' target='centro'>Ver Factura</a>";
	//abrir_url($url,"centro");
}


?>