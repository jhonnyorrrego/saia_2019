<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php"); 
include_once($ruta_db_superior."pantallas/lib/svg/class_canvas.php");
include_once($ruta_db_superior."pantallas/lib/svg/class_imagen.php");
include_once($ruta_db_superior."pantallas/lib/svg/class_cuadro_texto.php");
include_once($ruta_db_superior."pantallas/lib/svg/class_circulo.php");
include_once($ruta_db_superior."bpmn/bpmn/class_bpmn.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
echo(estilo_bootstrap());
?>
<link rel="stylesheet" href="css/bpmn.css" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<?php
$bpmn=new bpmn();
$bpmn->get_bpmn($_REQUEST["idbpmn"]);
$idpaso_documento=0;
$idbpmni=0;
//Se debe tener en cuenta cambiar para los request ya que aquí se tiene en cuenta el idpaso_documento y no el bpmni 
if(@$_REQUEST["idpaso_documento"]){
	$idpaso_documento=$_REQUEST["idpaso_documento"];
}
	if(@$_REQUEST["idbpmni"]){
		$idbpmni=$_REQUEST["idbpmni"];
		$_REQUEST["bpmni"]=$_REQUEST["idbpmni"];
	}
	$bpmn->verificar_bpmn($idbpmni,$idpaso_documento);
	$bpmn->inicializar();
//$bpmn->imprimir_SVG(); 
?>
<?php 
  echo(librerias_jquery("1.7"));
  echo(librerias_highslide());
  echo(librerias_notificaciones());
	echo(librerias_kaiten());
	echo(librerias_acciones_kaiten());
	echo(librerias_bootstrap());
  include_once($ruta_db_superior."pantallas/lib/svg/librerias_adicionales.php");
  if(!@$_REQUEST["iddoc"] && @$_REQUEST["key"])
  	$_REQUEST["iddoc"]=@$_REQUEST["key"];
  if(!@$_REQUEST["vista_bpmn"]){
	  include_once($ruta_db_superior."workflow/libreria_paso.php");
	  $bpmn->get_tarea_inicio_instancia($idbpmni);
	  if($bpmn->tarea_inicio_instancia["numcampos"]){
	    //Se busca el estado actual del flujo lo que incluye el paso actual
	  	$bpmn->estado_flujo=estado_flujo_instancia($bpmn->tarea_inicio_instancia[0]["idpaso_documento"]);
	  	$bpmn->get_tareas_bpmn();
	  	$idpaso_documento=$bpmn->estado_flujo[0]["idpaso_documento"];
			$datos_documento=busca_filtro_tabla("","documento A","A.iddocumento=".$bpmn->estado_flujo[0]["documento_iddocumento"],"",$conn);
			$datos_doc_inicio=busca_filtro_tabla("","documento","iddocumento=".$bpmn->tarea_inicio_instancia[0]["documento_iddocumento"],"",$conn);
      
	  }
	}  
?>
<script type="text/javascript">
	hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
	hs.outlineType = 'rounded-white';
</script>
<div class="container-fluid ">
	<div class="row-fluid">
	<div class="span6">
		<i class="icon-info-sign"></i> <b>PROCESO: <?php echo($bpmn->bpmn[0]["title"]);?></b>
		<?php if(!@$_REQUEST["vista_bpmn"]){ ?>
		<address style="margin-bottom:0px; line-height: 15px;">
  		<b>Descripci&oacute;n:</b> <?php echo($bpmn->bpmn[0]["description"]); ?><br />
  		<b>Inicio del proceso:</b> <?php echo(mostrar_fecha_saia($bpmn->estado_flujo[0]["fecha_asignacion"]));?><br>
  		<!--b>Terminados:</b> (<?php echo(count($bpmn->tareas_exito)."/".$bpmn->tareas["numcampos"]);?>) : <?php echo($bpmn->estado_flujo["porcentaje"]);?>%<br-->
  		<b>Fecha L&iacute;mite:</b> <?php echo(mostrar_fecha_saia($bpmn->estado_flujo["fecha_final_diagrama"]));
  ?>  <br>
  		<b>Estado:</b> <?php echo($bpmn->imprime_estado_bpmni());?><br>
	  </address>
		<?php } ?>
	</div>
	<div class="span6">
		<?php if(!@$_REQUEST["vista_bpmn"]){ ?>
		<i class="icon-info-sign"></i> <b>Paso actual: </b><?php echo($bpmn->estado_flujo[0]["nombre_paso"]); ?><br />
		<address style="margin-bottom:0px; line-height: 15px;">
			<!--b>N&uacute;mero del flujo:</b> <?php echo($bpmn->estado_flujo[0]["iddiagram_instance"]); ?><br /-->
			<!--b>Radicado:</b> <?php echo($datos_documento[0]["numero"]); ?><br /-->
			<b>Descripci&oacute;n del documento principal:</b> <a href="<?php echo($ruta_db_superior);?>ordenar.php?key=<?php echo($datos_doc_inicio[0]["iddocumento"]); ?>&mostarr=1&mostrar_formato=1"><?php echo($datos_doc_inicio[0]["descripcion"]); ?></a><br />
			<?php if($datos_documento[0]["iddocumento"]!=$datos_doc_inicio[0]["iddocumento"]) {?>
        <b>Descripci&oacute;n del documento actual:</b> <a href="<?php echo($ruta_db_superior);?>ordenar.php?key=<?php echo($datos_documento[0]["iddocumento"]); ?>&mostarr=1&mostrar_formato=1"><?php echo($datos_documento[0]["descripcion"]); ?></a><br />			   
			<?php } ?>
			<!--a onclick="llamado_bpmn('<?php echo($ruta_db_superior); ?>workflow/rastro_flujo.php?idflujo_instancia=<?php echo($bpmn->estado_flujo[0]["iddiagram_instance"]); ?>','600','350');" style="cursor:pointer">Ver rastro del flujo</a-->
		</address>
		<?php } ?>		
	</div>
	</div>
	<div class="row-fluid " id="diagram" style="height:80%; position:relative; overflow: auto;">
	</div>
	
</div>
<div id="container"></div>

<script src="lib/require/require.js"></script>
<script>
  require({
    baseUrl: "./",
    paths: {
			'jquery' : 'lib/jquery/jquery-1.7.2.min',
      'bpmn/Bpmn' : 'js/bpmn.min',
      'bootstrap' : 'lib/bootstrap',
    },
    packages: [
      { name: "dojo", location: "lib/dojo/dojo" },
      { name: "bootstrap", location: "lib/bootstrap" },
      { name: "dojox", location: "lib/dojo/dojox"},
    ]
  });

  require(["bpmn/Bpmn", "dojo/domReady!"], function(Bpmn) {
    new Bpmn().renderUrl("<?php echo($ruta_db_superior.$bpmn->archivo); ?>", {
      diagramElement : "diagram",
      overlayHtml : '<div class="elemento_bpmn_saia" ></div>'
    }).then(function (bpmn){				
      bpmn.zoom(0.7);
      <?php $bpmn->imprimir_estados_tarea("bpmn"); ?>    
      //bpmn.getOverlay("Task_0hoaho2");
			//$(".bpmnElement").find("[data-activity-id='Task_0hoaho2']").addClass("prueba");
      //bpmn.annotation("Task_0hoaho2").setHtml('<span class="bluebox"  style="position: relative; top:100%">New Text</span>').addClasses(["highlight"]);
      //bpmn.annotation("Task_0hoaho2").addDiv("<span>Test Div</span>", ["testDivClass"]);
      //$(".bpmnElement").addClass("bluebox");
      /*$(".bpmnElement").each(function(){
				//alert($(this).attr("data-activity-id"));
				bpmn.annotation($(this).attr("data-activity-id")).addClasses(["prueba","bluebox"]);
      });*/
      
    });
  });
  
</script>
<?php
include_once($ruta_db_superior."bpmn/bpmn/funciones.php");
?>
