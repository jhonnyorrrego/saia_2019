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
?>

<!DOCTYPE HTML>

<html lang="es">
<head>

<link href="dist/dropzone.css" type="text/css" rel="stylesheet" />
<link href="bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />

<script src="dist/dropzone.js"></script>

</head>
<body>
	<form action="cargar_archivos.php" class="dropzone" id="my-awesome-dropzone"></form>

</body>
<script type="text/javascript">
</script>
</html>