<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
usuario_actual("login");
?>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
echo (estilo_bootstrap());
if (@$_REQUEST["idbusqueda"]) {
	$parte_where = "A.idbusqueda=" . $_REQUEST["idbusqueda"];
}
if (@$_REQUEST["nombre"]) {
	$parte_where = "A.nombre='" . $_REQUEST["nombre"] . "'";
}

$datos_buscador = busca_filtro_tabla("", "busqueda A", $parte_where . " AND estado=1", "", $conn);
if ($datos_buscador["numcampos"]) {
	if ($datos_buscador[0]["tipo_busqueda"] == 1 || $datos_buscador[0]["tipo_busqueda"] == 2) {
		$enlace_ruta_visualizacion = "?";
		if (strpos($datos_buscador[0]["ruta_visualizacion"], "?"))
			$enlace_ruta_visualizacion = "&";
		$where_componente = " AND estado<>0";
		if (@$_REQUEST["default_componente"]) {
			$where_componente .= " AND nombre LIKE '" . $_REQUEST["default_componente"] . "'";
		}
		$datos_componente = busca_filtro_tabla("", "busqueda_componente", "busqueda_idbusqueda=" . $datos_buscador[0]["idbusqueda"] . $where_componente, "estado DESC", $conn);
		if (@$_REQUEST["default_componente"] && $datos_componente["numcampos"]) {
			$datos_componente[0]["estado"] = 2;
			if ($datos_componente["numcampos"] && $datos_componente[0]["url"] != '') {
				if (strpos($datos_componente[0]["url"], "?"))
					$enlace_ruta_visualizacion = "&";
				$url_busqueda = $ruta_db_superior . $datos_componente[0]["url"] . $enlace_ruta_visualizacion . "idbusqueda_componente=" . $datos_componente[0]["idbusqueda_componente"];
			} else {
				$url_busqueda = $ruta_db_superior . $datos_buscador[0]["ruta_visualizacion"] . $enlace_ruta_visualizacion . "idbusqueda_componente=" . $datos_componente[0]["idbusqueda_componente"];
			}
		} else {
			$url_busqueda = $ruta_db_superior . $datos_buscador[0]["ruta_visualizacion"] . $enlace_ruta_visualizacion . "idbusqueda_componente=" . $datos_componente[0]["idbusqueda_componente"];
		}
		if (@$_REQUEST["parametros_adicionales_buscador"]) {
			$complemento = explode("|", $_REQUEST["parametros_adicionales_buscador"]);
			foreach ( $complemento as $key => $valor ) {
				$complemento2 = explode("@", $valor);
				$url_busqueda .= "&" . $complemento2[0] . "=" . $complemento2[1];
				$complemento_componente .= "&" . $complemento2[0] . "=" . $complemento2[1];
			}
		}
		echo (librerias_html5());
		echo (librerias_jquery("1.7"));
		echo (librerias_UI());
		echo (librerias_kaiten());
		echo (librerias_acciones_kaiten());
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
	<script type="text/javascript">
        $('#contenedor_busqueda').kaiten({
          columnWidth : '100%',
          startup : function(dataFromURL){
            this.kaiten('load', { kConnector:'html.page', url:'<?php echo("busquedas/componentes_busqueda.php?idbusqueda=".$datos_buscador[0]["idbusqueda"].$complemento_componente);?>', 'kTitle':'B&uacute;squeda '});
            <?php if($datos_componente["numcampos"] && acceso_modulo($datos_componente[0]["modulo_idmodulo"]) && $datos_componente[0]["estado"]!=1) {  ?>
            this.kaiten('load', { kConnector:'iframe', url:'<?php echo($url_busqueda); ?>', 'kTitle':'<?php echo($datos_componente[0]["etiqueta"]);?> '});
            <?php } ?>
          }
        });
        $("#ksubmit_saia").live('click', function (){
          var enlace = $(this).attr('enlace')+"?"+$("#kformulario_saia").serialize();
          var titulo='';
          if(typeof $(this).attr('title')!=='undefined'){
              titulo = $(this).attr('title');
          }
          else if(typeof $(this).attr('titulo')!=='undefined'){
              titulo=$(this).attr('titulo');
          }
          var conector = "iframe";
          var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo} ;
          crear_pantalla_busqueda(datos_pantalla,0);
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
<?php
	} else if ($datos_buscador[0]["ruta_visualizacion"]) {
		abrir_url(PROTOCOLO_CONEXION . RUTA_PDF . "/" . $datos_buscador[0]["ruta_visualizacion"], "centro");
	}
} else {
	error("No es posible encontrar la busqueda");
	die("No es posible encontrar la busqueda");
}

function acceso_modulo($idmodulo) {
	if ($idmodulo == '' || $idmodulo == Null || $idmodulo == 0 || usuario_actual("login") == "cerok") {
		return true;
	}
	$ok = new Permiso();
	$modulo = busca_filtro_tabla("", "modulo", "idmodulo=" . $idmodulo, "");
	$acceso = $ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	return $acceso;
}
?>
</body>
