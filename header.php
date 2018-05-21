<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
$style="";
if ($config["numcampos"]) {
	$style = "
     <style type=\"text/css\">
       .phpmaker 
       {
       font-family: Verdana,Tahoma,arial; 
       font-size: 9px; 
       color:#000000;
       /*text-transform:Uppercase;*/
       } 
       .encabezado 
       {
       background-color:" . $config[0]["valor"] . "; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list 
       { 
       background-color:" . $config[0]["valor"] . "; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td 
       {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:" . $config[0]["valor"] . ";
    		text-align: center;
        font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
        vertical-align:middle;    
    	 }
    	 table tbody td 
       {	
    		font-family: Verdana,Tahoma,arial; 
        font-size: 9px;
    	 }
       </style>";
}
?>
<html>
<head>
<title>..::ADMINISTRADOR DE ARCHIVO::.. </title>
<?php echo $style; ?>
<style type="text/css" media="screen">
	/* Se comentarea porque daña el dragdrop en la edicion de los posits.*/
	html, body {
		height: 95%;
		width: 100%;
		overflow: hidden;
	}
	#div_contenido {
		height: 100%;
		width: 98%;
		overflow: auto;
		position: relative;
		z-index: 2;
	}
</style>
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/ordenar_list.js"></script>
<link rel="stylesheet" href="<?php echo($ruta_db_superior); ?>css/bubble-tooltip.css" media="screen">
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/bubble-tooltip.js"></script>

<style type="text/css">
	.imagen_internos {
		vertical-align: middle
	}
	.internos {
		font-family: Verdana;
		font-size: 9px;
		font-weight: bold;
	}
	/* If you wish to highlight current sortable column, add layout effects below */
	.highlightedColumn {
		background-color: #CCC;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<script type="text/javascript">
	function findDOM(objectId) {//funciones para el zoom de las imagenes
		if (document.getElementById) {
			return (document.getElementById(objectId));
		}
		if (document.all) {
			return (document.all[objectId]);
		}
	}

	function zoom(type, imgx, sz, pag) {//Aleja y Acerca las paginas del documento
		imgd = findDOM(imgx);
		imgd.width = 750;
		imgd.height = 900;
		if (sz < 100)
			type = "-";
		else if (sz > 100)
			type = "+";
		else {
			window.location='<?php echo($ruta_db_superior); ?>comentario_mostrar.php?pagina=pagina&key=<?php echo @$_SESSION["iddoc"]; ?>&pag='+pag;
			return;
		}
		if (type == "+" && imgd.width < 1900) {
			imgd.width = (sz * imgd.width / 100);
			imgd.height = (sz * imgd.height / 100);
			//(30*sz);
		}
		if (type == "-" && imgd.width > 200) {
			imgd.width = (sz * imgd.width / 100);
			//30;
			imgd.height = (sz * imgd.height / 100);
			//(30*sz);
		}
	}
</script>
</head>