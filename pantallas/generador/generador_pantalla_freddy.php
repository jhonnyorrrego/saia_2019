<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/generador/librerias_pantalla.php");
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");
echo (estilo_bootstrap());
echo (librerias_jquery("1.8.3"));
echo(librerias_html5());
if($_REQUEST["idformato"]){
  $idpantalla=$_REQUEST["idformato"];
  $datos_formato=busca_filtro_tabla("","formato","idformato=".$idpantalla,"",$conn);
}
?>
<html>
<head>
<title>Generador Pantallas SAIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<script type="text/javascript">
var alto=($(window).height()-8); 
function llamado_pantalla(ruta,datos,destino,nombre){				
  if(datos!==''){
    ruta+="?"+datos;
  }  
  if(nombre === "<?php echo($_REQUEST['destino_click']);?>"){  	
  	ruta = ruta+'&click_clase=<?php echo($_REQUEST['click_clase']); ?>';  	
  	destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
  }
  	destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>'); 
}
$(document).ready(function(){
	$("#iframe_generador").height($(document).height());
	$("#iframe_generador").width($("#admin_generador").width());
	

 	console.log($("#iframe_generador").length)
});    
</script>
<?php
?>
	<link href="<?php echo($ruta_db_superior);?>pantallas/generador/css/generador_pantalla.css" rel="stylesheet"><style>
    .well{ margin-bottom: 3px; min-height: 11px; padding: 4px;}
    .progress{margin-bottom: 0px;}
    #tabs_formulario, #tabs_opciones{margin-bottom: 0px;}
    .tab-content {padding-top:0px;}
    </style>
    <style>
    #panel_detalles{margin-top:0px; width: 100%; border:0px solid; overflow:auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>} 
    #detalles{height:20%; } 
    #panel_arbol_formato{border:0px solid;}
</style>
</head>
	<body>
			<div class="container-fluid">
				<div class="row-fluid">					
				    <div class="span2">         
				        <div id="izquierdo_saia" >          
				        </div>					   
				        <div id="contenedor_formatos">            
				        </div>
				    </div>			
					<div class="span10" id="admin_generador">
						<iframe id="iframe_generador" width="100%" src="<?php echo $ruta_db_superior."pantallas/generador/iframe_generador.php?idformato=".$_REQUEST['idformato']; ?>"></iframe> 
					</div>
				</div>
			</div>

	</body>
</html>
<script> 
llamado_pantalla("<?php echo($ruta_db_superior);?>pantallas/formato/listado_formatos.php","id=<?php echo($_REQUEST['idformato']);?>&cargar_dato_padre=1&tabla=formato&alto_pantalla="+alto,$("#izquierdo_saia"),"arbol_formato");  
llamado_pantalla("<?php echo($default_open);?>","",$("#contenedor_formatos"),'detalles');
</script>
