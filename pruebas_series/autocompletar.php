<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

?>
<!DOCTYPE html>
<html>
<head>

<?php
echo (estilo_bootstrap());
?>
<link rel="stylesheet" type="text/css"
	href="<?php echo $ruta_db_superior;?>css/selectize.css" />


 <?php
echo librerias_jquery();
?>
<script type="text/javascript"
	src="<?php echo $ruta_db_superior;?>js/selectize.js"></script>

<?php
echo (librerias_notificaciones());
?>

</head>
<body>

	<div class="demo">
		<div class="control-group">
			<label for="input-tags">Tags:</label>
			<input type="text" id="input-tags" class="demo-default" value="">
		</div>
		<script>
			$('#input-tags').selectize({
			    valueField: 'value',
			    labelField: 'text',
			    searchField: 'text',
				persist: false,
				createOnBlur: true,
				create: false,
				maxItems: 1,
				load: function(query, callback) {
			        if (!query.length) return callback();
			        $.ajax({
			            url: 'json_funcionario.php',
			            type: 'POST',
			            dataType: 'json',
			            data: {
			                valor: query,
			            },
			            error: function() {
			                callback();
			            },
			            success: function(res) {
			                callback(res);
			            }
			        });
			    }
			});
		</script>
	</div>


</body>
</html>