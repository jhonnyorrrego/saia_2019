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
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
function editar_item_induccion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("","ft_adicionar_inducc","idft_adicionar_inducc=".$_REQUEST['item'],"",$conn);
	?>
	<script>
		tree_area_responsa.setOnLoadingEnd(fin_cargando_induccion);
		function fin_cargando_induccion(){
			var valor='<?php echo $datos[0]['area_responsa']; ?>';
			$("#area_responsa").val(valor);
			tree_area_responsa.setCheck(valor,true);
		}
		$("#area_responsa").change(function(){
			var valor='<?php echo $datos[0]['area_responsa']; ?>';
			tree_area_responsa.setCheck(valor,true);
		});
	</script>
	<?php	
}
?>