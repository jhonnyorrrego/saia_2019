<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

function add_edit_item_factura() {
	global $conn;
	?>
	<script>
		$(document).ready(function (){
			$("[name='pago_desde']").change(function (){
				if($(this).val()==2){
					$("#tr_no_convenio").show();
				}else{
					$("#tr_no_convenio").hide();
				}
			});
			$("[name='pago_desde']:checked").trigger("change");
			$("#tr_accion_item").hide();
		});
	</script>
	<?php
}