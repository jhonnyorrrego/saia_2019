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
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 
echo(librerias_validar_formulario('1.16'));
?>    
<!DOCTYPE html>     
<html>
  <head>    
  </head>
  <body>
  	<div class="navbar navbar-fixed-top">
	    <div class="navbar-inner">                           
	      <ul class="nav pull-left">                                         
	        <li>          
	  	        <button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
	  	        	&nbsp;Buscar&nbsp;
	  	        </button>
	        </li>                 
	        <li class="divider-vertical">
	        </li>
	        <li>                     
	  	      <input class="btn btn-danger btn-mini reset" name="commit" type="reset" value="Cancelar">                    
	        </li>
	        <li class="divider-vertical">
	        </li> 
	      </ul>      
	    </div>
	  </div>
  	
    <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia" method="post">  
        <legend>Filtrar Expediente</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			<b>Nombres</b>
			<input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_nombre" name="bqsaia_nombre" size="50" type="text">
          </div>
        </div>


        <?php
            $campo_validar='nombre';
            $etiquetas_permitidas=array('documento_central','expediente');
            $etiqueta_reporte=busca_filtro_tabla($campo_validar,"busqueda_componente","lower(".$campo_validar.") IN('".implode("','",$etiquetas_permitidas)."')AND idbusqueda_componente=".@$_REQUEST["idbusqueda_componente"],"",$conn);
            $mostrar=0;
            if($etiqueta_reporte['numcampos']){
                switch(strtolower($etiqueta_reporte[0][$campo_validar])){
                    case 'expediente': //GESTION A CENTRAL
                         $mostrar=1;
                         $etiqueta='Central';
                        break;
                    case 'documento_central': //CENTRAL A HISTORICO
                         $mostrar=2;
                         $etiqueta='Historico';
                        break;
                }
            }
            
            if($mostrar){
        ?>

        <div class="control-group">
          <label class="string required control-label" for="prox_estado_archivo">
		  	<b> Pendientes por pasar a <?php echo($etiqueta); ?>:	</b>
			<input type="hidden" name="bksaiacondicion_prox_estado_archivo" id="bksaiacondicion_prox_estado_archivo" value="=">
          </label>
          <div class="controls">
            <?php if($mostrar==1){ ?>  
                <input id="bqsaia_prox_estado_archivo1" name="bqsaia_prox_estado_archivo"  type="checkbox" value="2">Si
            <?php } ?>
            
            <?php if($mostrar==2){ ?>  
                 <input id="bqsaia_prox_estado_archivo1" name="bqsaia_prox_estado_archivo"  type="checkbox" value="3">Si
                
            <?php } ?>            
          </div>
        </div>
        <?php } /*fin if mostrar_filtro*/ ?>
        
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">

      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
</script>