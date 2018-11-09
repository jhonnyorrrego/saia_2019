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
include_once ($ruta_db_superior . "assets/librerias.php");
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");

if($_REQUEST["idformato"]){
  $idpantalla=$_REQUEST["idformato"];
  $datos_formato=busca_filtro_tabla("","formato","idformato=".$idpantalla,"",$conn);
}
?>
<html>
<head>
<title>Generador Pantallas SAIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />  
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= jqueryUi() ?>
    <?= icons() ?>
    <?= theme() ?>
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
	<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>

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
	$("#izquierdo_saia").find("iframe").height($(document).height());
	$("#izquierdo_saia").width($("#panel_izquierdo").width());
	
});    
</script>
<?php
?>

</head>
	<body>
			<div class="container-fluid">
				<div class="row">					
				    <div class="col-3 m-0 p-0" id="panel_izquierdo">         
				        <div id="izquierdo_saia">
				        	
				        </div>					   
				    </div>			
					<div class="col-9 m-0 p-0" id="admin_generador" style="margin-left:0px; margin-right: 0px; padding-left: 0px; padding-right: 0px;">
						<iframe border="0" id="iframe_generador" width="100%" src="<?php echo $ruta_db_superior."pantallas/generador/generador_pantalla.php?idformato=".$_REQUEST['idformato']; ?>" scrolling="yes"></iframe> 
					</div>
				</div>
			</div>
			
	</body>
</html>
<script> 
llamado_pantalla("<?php echo($ruta_db_superior);?>pantallas/formato/listado_formatos.php","no_kaiten=1&id=<?php echo($_REQUEST['idformato']);?>&cargar_seleccionado=1&tabla=formato&alto_pantalla="+alto,$("#izquierdo_saia"),"arbol_formato");  
//llamado_pantalla("<?php echo($ruta_db_superior);?>pantallas/formato/generador_pantallas.php","",$("#contenedor_formatos"),'detalles');
</script>