<?php $max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo($ruta_db_superior);?>css/daterangepicker-bs3.css" />
<style>
.daterangepicker .calendar th, .daterangepicker .calendar td {min-width:12px;}
.dropdown-menu ul {width: 100%;}
.input-append .add-on, .input-prepend .add-on{height:17px;}
#fecha{text-align:center;}
</style>
	<div class="container master-container">
		<form accept-charset="UTF-8" id="kformulario_saia"  method="post" class="form-horizontal">		
      <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
			<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="226" componente="226">		              
</form>
</div>
