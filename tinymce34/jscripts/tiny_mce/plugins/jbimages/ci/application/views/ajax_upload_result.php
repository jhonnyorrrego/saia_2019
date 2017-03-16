<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JustBoil's Result Page</title>
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
include_once($ruta_db_superior."define.php");
?>
<script language="javascript" type="text/javascript">
	window.parent.window.jbImagesDialog.uploadFinish({
		filename:'<?php echo codifica_encabezado(PROTOCOLO_CONEXION.RUTA_PDF."/".$file_name); ?>',
		result: '<?php echo $result; ?>',
		resultCode: '<?php echo $resultcode; ?>'
	});
</script>
</head>

<body>

Result: <?php echo $result; ?>

</body>
</html>
