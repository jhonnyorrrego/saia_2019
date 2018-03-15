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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
usuario_actual("login");
?>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=9">
	<?php
	echo(estilo_bootstrap());
	echo(librerias_html5());
	echo(librerias_jquery("1.7"));
	echo(librerias_UI());
	echo(librerias_kaiten());
	echo(librerias_acciones_kaiten());
?>
</head>
<body>
	<style>
		body {
			padding: 0px;
		}
		#k-breadcrumb ul, ol {
			margin: 0 0 0 0
		}
		.k-panel .block-nav .items span {
			line-height: 30px;
			text-shadow: 0 -1px 0 transparent;
		}
		.k-panel .block-nav .items .label {
			color: #000000;
			line-height: 30px;
			text-shadow: 0 -1px 0 transparent;
			background-color: rgba(153, 153, 153, 0)
		}
	</style>
	<div id="contenedor_busqueda"></div>
	<?php
	$adicional = "";
	$request = array();
	foreach (@$_REQUEST as $id => $value) {
		$request[] = $id . "=" . $value;
	}
	if (count($request)) {
		$adicional = "?" . implode("&", $request);
	}
	?>
<script type="text/javascript">   
	$('#contenedor_busqueda').kaiten({ 
		columnWidth : '100%',
		startup : function(dataFromURL){          
			this.kaiten('load', { kConnector:'html.page', url:'listar_proceso_formatos.php<?php echo($adicional); ?>', 'kTitle':'Procesos '});
		}
	});
	function crear_pantalla_busqueda(datos,elimina){
		$panel=$('#contenedor_busqueda').kaiten("getPanel",1);
		if(elimina){
			if(typeof($panel)!='undefined'){
				$('#contenedor_busqueda').kaiten("removeChildren",$panel);
			}
		}  
		datos["url"]="<?php echo($ruta_db_superior);?>"+datos["url"];
		$('#contenedor_busqueda').kaiten("load",datos);                                                  
	}              
</script>
	
</body>
</html>
