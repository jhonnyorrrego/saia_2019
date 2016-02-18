<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior ."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
if(@$_REQUEST["idanexo"]){ 
	$anexo=busca_filtro_tabla("","anexos","idanexos=".$_REQUEST["idanexo"],"",$conn);	
}else{
	die("No es posible realizar la consulta anexo desconocido");
}
echo(estilo_bootstrap());
?>
<style>
	body{padding-top: 0px;}
	.form-horizontal .control-label{padding-top:0px; font-weight:bolder;}
</style>
<div class="container fluid">
<form class="form-horizontal" id="informacion_anexos" method="POST"  action="" enctype="multipart/form-data">
		<legend class="texto-azul">Informaci&oacute;n anexo</legend>
		<div class="control-group">
	    <label class="control-label" for="fecha">Fecha</label>
	    <div class="controls">	      
        <?php echo(mostrar_fecha_saia($anexo[0]["fecha"]));?>                     
	    </div>
	  </div>  
	  <div class="control-group">
	    <label class="control-label" for="etiqueta">Anexo</label>
	    <div class="controls">	      
        <?php echo($anexo[0]["etiqueta"]);?>                     
	    </div>
	  </div> 
	  <div class="control-group">
	    <label class="control-label" for="justificacion">Descripci&oacute;n</label>
	    <div class="controls">
	      <?php echo($anexo[0]["descripcion"]);?>        
	    </div>
	  </div>
	  <?php 
	  $funcionario=busca_filtro_tabla("","funcionario","idfuncionario=".$anexo[0]["funcionario_idfuncionario"],"",$conn);
		if($funcionario["numcampos"]){
	  ?>
	  <div class="control-group">
	    <label class="control-label" for="justificacion">Autor</label>
	    <div class="controls">
	      <?php 
	      echo($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]);?>        
	    </div>
	  </div>	     
	  <?php } ?>
    <table class="table table-striped" id="archivos">       
    </table>
</form>
</div>