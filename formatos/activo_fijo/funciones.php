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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
 
 
 
 function crear_ruta_activo($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_activo_fijo","documento_iddocumento=".$iddoc,"",$conn);
 	$ruta=array();
 	$usuario=usuario_actual("funcionario_codigo");   
   
	//Funcionario actual
	 $usuario_logeado=busca_filtro_tabla("B.cod_padre,C.dependencia_iddependencia","funcionario A,cargo B,dependencia_cargo C"," A.idfuncionario=C.funcionario_idfuncionario  AND C.cargo_idcargo=B.idcargo AND A.funcionario_codigo=".$usuario,"",$conn);
     //print_r($usuario);
     $contabilidad=busca_filtro_tabla("A.funcionario_codigo","vfuncionario_dc A","A.idcargo=42","",$conn);
 // $finanzas=busca_filtro_tabla("","vfuncionario_dc A","A.idcargo=49","",$conn);
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
    $radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=$iddoc","idtransferencia desc",$conn);
array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0));
//print_r($ruta);die();
phpmkr_query("update buzon_entrada set activo=0,nombre='ELIMINA_POR_APROBAR' where archivo_idarchivo='$iddoc' and nombre='POR_APROBAR'");
  insertar_ruta($ruta,$iddoc,0);
 }
 
}     
 
function mostrar_foto($idformato,$iddoc){
	global $ruta_db_superior;
	
$consulta=busca_filtro_tabla("A.ruta","anexos A","  A.documento_iddocumento=".$iddoc,"",$conn);	
	echo "<img src='".$ruta_db_superior.$consulta[0]['ruta']."'WIDTH=200 HEIGHT=200>";
}

function mostrar_soporte($idformato,$iddoc)
{global $conn;

$consulta=busca_filtro_tabla("","ft_activo_fijo A,ft_solicid_matenimiento B"," A.idft_activo_fijo=B.ft_activo_fijo AND A.documento_iddocumento=".$iddoc,"",$conn);
$fecharespuesta=busca_filtro_tabla("A.fecha","documento A"," A.iddocumento=".$iddoc,"",$conn);
$solicitud=busca_filtro_tabla("A.* ","ft_soporte A,ft_activo_fijo B","A.activos=".$iddoc,"",$conn);
//print_r($solicitud);


$texto.='<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado_list" colspan="4"; style="font-size:12px">Solicitud soporte</td>
</tr>
<tr>
<td class="encabezado_list"; style="font-size:12px">Fecha</td>
<td class="encabezado_list"; style="font-size:12px">Categor&iacute;a</td>
<td class="encabezado_list"; style="font-size:12px">Prioridad</td>
<td class="encabezado_list"; style="font-size:12px">Descripci&oacuten</td>
</tr>
<tr>
<td ; style="font-size:12px">'.html_entity_decode($consulta[0]['fecha_solicitud']).'</td>
<td style="font-size:12px">'.mostrar_valor_campo("categoria",232,$consulta[0]['documento_iddocumento'],1).'</td>
<td ; style="font-size:12px">'.mostrar_valor_campo("prioridad",232,$consulta[0]['documento_iddocumento'],1).'</td>
<td ; style="font-size:12px">'.html_entity_decode($consulta[0]['descripcion']).'</td>
</tr>
<tr>
<td ; style="font-size:12px">'.html_entity_decode($solicitud[0]['fecha_soporte']).'</td>
<td ; style="font-size:12px">'.mostrar_valor_campo("categoria",233,$solicitud[0]['documento_iddocumento'],1).'</td>
<td ; style="font-size:12px">'.mostrar_valor_campo("prioridad",233,$solicitud[0]['documento_iddocumento'],1).'</td>
<td ; style="font-size:12px">'.html_entity_decode($solicitud[0]['descripcion']).'</td>
</tr>
</tbody>
</table>';
echo $texto;
}
/********************/


function formatear_numeros($idformato,$iddoc){
global $conn;
?>
<script>
function cargar_puntos(){
Moneda_r($("#valor_compra").attr('id'));
Moneda_r($("#valor_venta").attr('id'));
Moneda_r($("#valor_seguro").attr('id'));
}

cargar_puntos();
$("#valor_compra").keyup(function(){
Moneda_r($("#valor_compra").attr('id'));
});
$("#valor_compra").blur(function(){
Moneda_r($("#valor_compra").attr('id'));
});
/**/
$("#valor_seguro").keyup(function(){
Moneda_r($("#valor_seguro").attr('id'));
});
$("#valor_seguro").blur(function(){
Moneda_r($("#valor_seguro").attr('id'));
});

/**/
$("#valor_venta").keyup(function(){
Moneda_r($("#valor_venta").attr('id'));
});
$("#valor_venta").blur(function(){
Moneda_r($("#valor_venta").attr('id'));
});

$('#formulario_formatos').
validate({
submitHandler: function(form){
var valor_ =new String($("#valor_compra").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#valor_compra").val(nuevo_valor);

var valor_ =new String($("#valor_venta").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#valor_venta").val(nuevo_valor);


var valor_ =new String($("#valor_seguro").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#valor_seguro").val(nuevo_valor);



form.submit(); 
} 
});

function Moneda_r(input){
var num = $("#"+input).val().replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
$("#"+input).val(num);
}
}
</script>
<?php
} 
?>