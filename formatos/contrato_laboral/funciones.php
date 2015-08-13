<?php 

include_once("../../db.php");
include_once("../../formatos/librerias/funciones_genereales.php");
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
function formatear_numero($idformato,$iddoc){
global $conn;
?>
<script>
function cargar_puntos(){
Moneda_r($("#sueldo_ini").attr('id'));
Moneda_r($("#sueldo_final").attr('id'));
}

cargar_puntos();
$("#sueldo_ini").keyup(function(){
Moneda_r($("#sueldo_ini").attr('id'));
});
$("#sueldo_ini").blur(function(){
Moneda_r($("#sueldo_ini").attr('id'));
});

$("#sueldo_final").keyup(function(){
Moneda_r($("#sueldo_final").attr('id'));
});
$("#sueldo_final").blur(function(){
Moneda_r($("#sueldo_final").attr('id'));
});

$('#formulario_formatos').
validate({
submitHandler: function(form){
var valor_ =new String($("#sueldo_ini").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#sueldo_ini").val(nuevo_valor);

var valor_ =new String($("#sueldo_final").val());
var nuevo_valor = valor_.replace(/\./g,"");
$("#sueldo_final").val(nuevo_valor);

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
function mostrar_anexos_hoja_vida($idformato,$iddoc){
global $conn,$ruta_db_superior;

$anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);
if($anexos["numcampos"]>0){
for ($i=0;$i<$anexos["numcampos"];$i++) {
echo "<a href=../../".$anexos[$i]["ruta"].">".html_entity_decode($anexos[$i]["etiqueta"])."</a><br />";
}
} 
}
?>
 