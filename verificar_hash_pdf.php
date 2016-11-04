<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
echo(librerias_jquery('1.7'));
echo( estilo_bootstrap() );
echo( estilo_file_upload() );
?>

<form name="formulario_expediente" id="formulario_expediente">
    <legend>Crear expediente</legend>

    <div class="control-group element">
      <label class="control-label" for="numero">Numero de Radicado *
      </label>
      <div class="controls"> 
        <input type="text" name="numero" id="numero" class="required" >
      </div>
    </div>    
    <div class="control-group element">
      <label class="control-label" for="pdf">Numero de Radicado *
      </label>
      <div class="controls"> 
        <span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;" id="contenedor_pdf">
            <span>Examinar</span>
                <input type="file" multiple ng-disabled="disabled"  name="pdf" id="pdf">
        </span>	        
      </div>
    </div>     
</form>    