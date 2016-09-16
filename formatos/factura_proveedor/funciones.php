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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function funcion1_proveedor($idformato,$iddoc){
$provee=busca_filtro_tabla("A.nombre","ejecutor A,datos_ejecutor B,ft_factura_proveedor C"," B.iddatos_ejecutor=C.prooveedor AND A.idejecutor=B.ejecutor_idejecutor AND C.documento_iddocumento=".$iddoc,"",$conn);
//print_r($provee);
echo $provee[0]['nombre'];

}
function crear_ruta_factura($idformato,$iddoc){
	global $conn;
  $documento=busca_filtro_tabla("","ft_factura_proveedor","documento_iddocumento=".$iddoc,"",$conn);
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

function formatear_valor_numero($idformato,$iddoc){
global $conn;
?>
<script>
function cargar_puntos(){
Moneda_r($("#valor_factura").attr('id'));

}

cargar_puntos();
$("#valor_factura").keyup(function(){
Moneda_r($("#valor_factura").attr('id'));
});
$("#valor_factura").blur(function(){
Moneda_r($("#valor_factura").attr('id'));
});
/**/

$('#formulario_formatos').
validate({
submitHandler: function(form){
var valor_ =new String($("#valor_factura").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#valor_factura").val(nuevo_valor);


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
function mostrar_anexos_factura($idformato,$iddoc){
global $conn,$ruta_db_superior;

$anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);
if($anexos["numcampos"]>0){
for ($i=0;$i<$anexos["numcampos"];$i++) {
echo "<a href=../../".$anexos[$i]["ruta"].">".html_entity_decode($anexos[$i]["etiqueta"])."</a><br />";
}
} 
}
function validar_digitalizacion_factura_1($idformato,$iddoc)
{global $conn;
//alerta($_REQUEST["digitalizacion"]);
  if($_REQUEST["digitalizacion"]==1){
    redirecciona($ruta_db_superior."paginaadd.php?&key=".$iddoc."&enlace=formatos/factura_proveedor/adicionar_factura_proveedor.php");
	  //mostrar colilla
	  
	  
  }
} 
function digitalizacion_factura_1()
{//echo "<tr><td class='encabezado'>DESEA DIGITALIZAR</td><td><input name='digitalizacion' id='digitalizacion1' type='radio' value='1' checked>Si  <input name='digitalizacion' id='digitalizacion0' type='radio' value='0'>No</td></tr>";
echo "<input name='digitalizacion' id='digitalizacion1' type='hidden' value='1'>";

}

?>