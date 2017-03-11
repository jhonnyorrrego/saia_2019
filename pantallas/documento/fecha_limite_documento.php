<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once ($ruta_db_superior.'db.php');
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery('1.7'));
echo(librerias_notificaciones());
if(@$_REQUEST['guardar']){
    $sql="UPDATE documento SET fecha_limite=".fecha_db_almacenar($_REQUEST['fecha_limite'], 'Y-m-d')." WHERE iddocumento=".$_REQUEST['iddoc'];
    phpmkr_query($sql);
	echo('
	<script>
			notificacion_saia("<b>ATENC&Oacute;N</b><br>La fecha limite se ha actualizado satisfactoriamente!","success","",3000);
				var json={"idbusqueda_componente":'.@$_REQUEST['idbusqueda_componente'].',"llave":'.@$_REQUEST['iddoc'].'};
			   parent.postMessage(json,"*");       //actualiza contenedor del listado
			   parent.eliminar_panel_kaiten(0);    //cierra kaiten actual
			   
	</script>
	');
	die();
}
if(@$_REQUEST['iddoc']){
	include_once($ruta_db_superior."calendario/calendario.php");

	echo(estilo_bootstrap());

	$consulta_fecha_limite=busca_filtro_tabla("fecha_limite","documento","iddocumento=".$_REQUEST['iddoc'],"",$conn);
?>
<div class="container">
	<br>
	<br>
<form id="form1" name="form1" method="post" action="<?php echo($ruta_db_superior); ?>pantallas/documento/fecha_limite_documento.php">

	<legend>Adicionar Fecha Limite al documento</legend>

<div class="control-group element">
    <label class="control-label" for="fecha_limite"> Este documento requiere una respuesta?
  </label>
  <div class="controls">
  	Si&nbsp;<input type="radio" name="necesita_respuesta" id="necesita_respuesta1" value="1">
  	No&nbsp;<input type="radio" name="necesita_respuesta" id="necesita_respuesta2" value="0" checked>
  </div>
</div> 	
<div class="control-group element contenedor_fecha_limite">
    <label class="control-label" for="fecha_limite"> Fecha Limite de Respuesta
  </label>
  <div class="controls">
  	
      <?php 
          $fecha_limite='0000-00-00';
          if($doc[0]['fecha_limite']){
            $fecha_limite=$consulta_fecha_limite[0]['fecha_limite'];
          }
      ?>
      
      <input id="fecha_limite" name="fecha_limite" style="width:100px" type="text" value="<?php echo($fecha_limite); ?>" readonly />
      <?php selector_fecha("fecha_limite","form1","Y-m-d",date("m"),date("Y"),"default.css",$ruta_db_superior,""); ?>
  </div>
</div>
 <input type="hidden" name="iddoc" value="<?php echo(@$_REQUEST['iddoc']) ?>">
  <input type="hidden" name="idbusqueda_componente" value="<?php echo(@$_REQUEST['idbusqueda_componente']) ?>">
  <input type="hidden" name="guardar" value="1">
 <input type="submit" value="Continuar" class="btn btn-primary btn-mini">
</form>
</div>
<script>
	$(document).ready(function(){
		$('#icono_calendario').attr('width',28);
		$('.contenedor_fecha_limite').hide();
		$('[name="necesita_respuesta"]').click(function(){
			$('#fecha_limite').val('0000-00-00');
			var valor=parseInt($(this).val());
			if(valor==1){  //si
				$('.contenedor_fecha_limite').show();
			}else{  //no
				$('.contenedor_fecha_limite').hide();
			}
		});
	});
</script> 
<?php 
}
?>