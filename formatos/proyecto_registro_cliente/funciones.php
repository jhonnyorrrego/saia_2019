<?php
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
include_once($ruta_db_superior."db.php");

function ultima_propuesta($idformato,$iddoc){
	global $conn;
	$propuestas=busca_filtro_tabla("A.nombre_propuesta, A.documento_iddocumento","ft_seguimiento_cliente A, ft_proyecto_registro_cliente B","B.documento_iddocumento=".$iddoc." and A.ft_registro_cliente=B.ft_registro_cliente and A.estado_propuesta = 0","A.fecha desc",$conn);

	$enlace='<a href="../seguimiento_cliente/mostrar_seguimiento_cliente.php?iddoc='.$propuestas[0]["documento_iddocumento"].'&idformato249" style="opacity: 1;">'.$propuestas[0]["nombre_propuesta"].'</a>';
	echo($enlace);
}
function valor_proyecto($idformato,$iddoc){
	global $conn;
	$valor_proyecto=busca_filtro_tabla("valor","ft_proyecto_registro_cliente","documento_iddocumento=".$iddoc,"",$conn);

	echo("$".number_format($valor_proyecto[0]['valor'],0,",","."));
}
function separar_miles_proyecto($idformato,$iddoc){
	global $conn;
	?>
<body onload="cargar_puntos_r();">
	<script>
	function cargar_puntos_r(){
		Moneda_r($("#valor").attr('id'));
	}
	$("#valor").keyup(function(){
		Moneda_r($("#valor").attr('id'));
	});
	$("#valor").blur(function(){
		Moneda_r($("#valor").attr('id'));
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