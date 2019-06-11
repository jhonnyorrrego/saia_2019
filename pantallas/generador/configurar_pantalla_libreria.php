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
include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "pantallas/generador/librerias.php";
include_once $ruta_db_superior . "pantallas/lib/buscar_patron_archivo.php";
$_REQUEST["ruta"]=str_replace("../","",@$_REQUEST["ruta"]);

if(@$_REQUEST["idformato"] && @$_REQUEST["ruta"]){  
  $listado_funciones=buscar_patron_archivo($_REQUEST["ruta"],"function",0);         
}
else{
  alerta("No es posible vincular la libreria");
  die();  
}
if($listado_funciones["exito"]){
  $funciones=array();
?>
<input type="hidden" name="ruta" id="ruta" value="<?php echo($_REQUEST["ruta"]);?>">
<br />
<legend>Funciones vinculadas con el archivo <?php echo($_REQUEST["ruta"]);?> <button class="btn btn-mini btn-default" id="vincular_libreria_pantalla"><i class="icon-ok" title="Vincular Libreria"></i></button> </legend>
<br />                                           
<div class="accordion" id="acordion_libreria">  
<?php  
  foreach($listado_funciones["resultado"] AS $key=>$valor){
    $cant_funciones='';
    $pos1=strpos($valor,"(");
    $pos2=strpos($valor,")");
    $nombre=trim(substr($valor,8,($pos1-8)));        
    $dato=trim(substr($valor,8));
    if($nombre=='')continue;
?> 
  <div >
    <div funcion="<?php echo($dato);?>" nombre="<?php echo($nombre);?>">
      <span>
      	&nbsp;-&nbsp;<?php echo($valor); ?>
      <span>
    </div>
    <div id="funcion_<?php echo($nombre);?>" class="accordion-body collapse">
    	<div class="accordion-inner" id="historial_funcion_<?php echo($nombre);?>">
    		
    	</div>
      <div class="accordion-inner" id="contenedor_funcion_<?php echo($nombre);?>">
       
      </div>
      <div class="form-actions">  	
		    <button type="button" class="btn btn-primary enviar_formulario_saia" formulario="formulario_<?php echo($nombre);?>" nombre="<?php echo($nombre);?>">Aceptar</button>
		    <button type="button" class="btn cancelar_formulario_saia" formulario="formulario_<?php echo($nombre);?>" nombre="<?php echo($nombre);?>" funcion="<?php echo($dato);?>">Cancel</button>
		    <div class="pull-right" id="cargando_enviar_<?php echo($nombre);?>"></div>
		  </div>
    </div>
  </div>
<?php
  }
?>
</div>  
<?php  
}
$input_variable_formulario='<input type="text" name="_dato" value="" class="lparametros">';
?>
<script type="text/javascript">
$(document).ready(function(){  
  $('#vincular_libreria_pantalla').click(function(){
        $.ajax({
            type:'POST',
            dataType:'json',
            url:"<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php",
            data:{
                idformato:'<?php echo($_REQUEST['idformato']); ?>',
                ruta_libreria:'<?php echo($_REQUEST['ruta']); ?>',
                funciones_vuncular:$('[name="funciones_vuncular[]"]').val(),
                ejecutar_datos_pantalla:'vincular_libreria_pantalla'
            },
            success:function(datos){
                if(datos.exito_libreria==1){
                    notificacion_saia('Libreria Creada con exito',"success","",2500);
                }   
				//cargar el listado en librerias_en_uso
        		$.ajax({
        	        type:'POST',
        	        url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=listado_archivos_incluidos',
        	        data:'idformato='+'<?php echo($_REQUEST['idformato']); ?>',
        	        success: function(html){
        	        if(html){
        	          	var objeto=jQuery.parseJSON(html);
        	            if(objeto.exito){
        	              $('#librerias_en_uso').html(objeto.codigo_html);
        	              //iniciar_tooltip();
        	           	}
        	       	}
        	      }
        	    });                       
                if(datos.existe_include){
                    notificacion_saia('<b>ATENCI&Oacute;N!</b><br>La libreria ya se encuentra vinculada',"warning","",2500);
                }                
                
            }
        });       
  });
});	
</script>