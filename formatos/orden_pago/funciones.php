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
include_once($ruta_db_superior."formatos/librerias/num2letras.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function descripcion_papa($idformato,$iddoc){
$factura_papa=busca_filtro_tabla("A.*","ft_factura_proveedor A,ft_orden_pago B,ft_informe_recibo C","A.idft_factura_proveedor=C.ft_factura_proveedor AND B.ft_informe_recibo=C.idft_informe_recibo AND B.documento_iddocumento=".$iddoc,"",$conn);
$provee=busca_filtro_tabla("A.*","ejecutor A,datos_ejecutor B,ft_orden_pago C"," B.iddatos_ejecutor=".$factura_papa[0]['prooveedor']." AND A.idejecutor=B.ejecutor_idejecutor AND C.documento_iddocumento=".$iddoc,"",$conn);

//print_r($provee);

$texto='<table style="width: 100%; font-family: arial; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style=font-size:12px; class="encabezado_list">Nit del gasto</td>
<td style=font-size:12px; class="encabezado_list">Documento del gasto</td>
<td style=font-size:12px; class="encabezado_list">Valor del gasto</td>
<td style=font-size:12px; class="encabezado_list">Descripcion del gasto</td>
<td style=font-size:12px; class="encabezado_list">Cc.Ot, del gasto</td>

</tr>
<tr>
<td style=font-size:12px>'.$provee[0]['identificacion'].'</td>
<td></td>
<td style=font-size:12px>'.$factura_papa[0]['valor'].'</td>
<td style=font-size:12px>'.$factura_papa[0]['observaciones'].'</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>';
echo $texto;
}

function val_bruto($idformato,$iddoc)
{$factura_valor=busca_filtro_tabla("A.*","ft_factura_proveedor A,ft_orden_pago B,ft_informe_recibo C","A.idft_factura_proveedor=C.ft_factura_proveedor AND B.ft_informe_recibo=C.idft_informe_recibo AND B.documento_iddocumento=".$iddoc,"",$conn);
	echo "$".$factura_valor[0]['valor_factura'];
	//print_r($factura_valor);
}

function crear_ruta_pago($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_orden_pago","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C,ft_orden_pago D"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario."AND D.documento_iddocumento=".$iddoc,"",$conn);
     //print_r($usuario);
 $contabilidad=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A,ft_orden_pago B","A.idcargo=42 AND B.documento_iddocumento=".$iddoc,"",$conn);
  $finanzas=busca_filtro_tabla("","vfuncionario_dc A,ft_orden_pago B","A.idcargo=49 AND B.documento_iddocumento=".$iddoc,"",$conn);
  //print_r($finanzas);
		    
//Ultimo parametro      
//0->Ninguna
//1->Firma visible
//2->Revisado
array_push($ruta,array("funcionario"=>$usuario,"tipo_firma"=>0));

if($usuario<>$contabilidad[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$contabilidad[0]['funcionario_codigo'],"tipo_firma"=>2));//primera posicion
	} 
   
   /*if($usuario<>$finanzas[0]["funcionario_codigo"]){
	array_push($ruta,array("funcionario"=>$finanzas[0]['funcionario_codigo'],"tipo_firma"=>1));//primera posicion
	}*/ 
   
 /*if($usuario<>$gestionH[0]['funcionario_codigo']){
   array_push($ruta,array("funcionario"=>$gestionH[0]['funcionario_codigo'],"tipo_firma"=>2));
    }*/
   
 
if(count($ruta)>1){
    //$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=".$iddoc,"idtransferencia desc",$conn);
//array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));
//print_r($ruta);die();
phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
 }
 
}     

function ver_papa1($idformato,$iddoc){
	global $conn, $ruta_db_superior;
$papa=busca_filtro_tabla("A.documento_iddocumento","ft_factura_proveedor A,ft_orden_pago B,ft_informe_recibo C"," B.ft_informe_recibo=C.idft_informe_recibo AND C.ft_factura_proveedor =A.idft_factura_proveedor AND B.documento_iddocumento=".$iddoc,"",$conn);
//print_r($papa);
echo '<a href="'.$ruta_db_superior.'formatos/factura_proveedor/mostrar_factura_proveedor.php?iddoc='.$papa[0]["documento_iddocumento"].'&idformato=236">Ver Factura</a>';
}

function reponsables($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_orden_pago","documento_iddocumento=".$iddoc,"",$conn);
  $usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario,"",$conn);
     //print_r($usuario);
 $contabilidad=busca_filtro_tabla("A.nombre","vfuncionario_dc A","A.idcargo=42","",$conn);
  $finanzas=busca_filtro_tabla("A.nombre","vfuncionario_dc A","A.idcargo=49","",$conn);
  //print_r($finanzas);
		    
}     

?>