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
<div class="container">
<form action="verificar_hash_pdf.php" method="POST" enctype="multipart/form-data">
    <legend>Crear expediente</legend>


    <div class="control-group element">
      <label class="control-label" for="plantilla">Numero de Radicado *
      </label>
      <div class="controls"> 
        <select name="plantilla" id="plantilla" class="required" >
            <option value="0">Seleccione...</option>
            <?php
                $plantillas=busca_filtro_tabla("lower(a.plantilla) as plantilla,b.etiqueta","documento a, formato b","lower(a.plantilla)=b.nombre AND a.estado NOT IN('ELIMINADO','ANULADO') GROUP BY a.plantilla","b.etiqueta ASC",$conn);
                
                for($i=0;$i<$plantillas['numcampos'];$i++){
                    echo('<option value="'.$plantillas[$i]['plantilla'].'">'.$plantillas[$i]['etiqueta'].'</option>');
                }
            ?>
            
        </select>
      </div>
    </div>  


    <div class="control-group element">
      <label class="control-label" for="numero">Numero de Radicado *
      </label>
      <div class="controls"> 
        <input type="text" name="numero" id="numero" class="required" >
      </div>
    </div>  
    
    <div class="control-group element">
      <label class="control-label" for="pdf">Pdf *
      </label>
      <div class="controls"> 
        <span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;" id="contenedor_pdf">
            <span>Examinar</span>
                <input type="file" multiple ng-disabled="disabled"  name="pdf" id="pdf">
        </span>	        
      </div>
    </div>
    
    
	<div class="control-group element">
	    <div class="controls">
	        <br/>
	        <br/>
	        <input type="hidden" name="verificar_hash" value="1">
		    <button type="submit" class="btn btn-mini btn-primary start" >
		        <i class="glyphicon-upload"></i>
		        <span>Aceptar</span>
            </button>   
        </div>
    </div>    
    
</form> 
</div>


<?php 

if(@$_REQUEST['verificar_hash']){
    
    $hash_original=busca_filtro_tabla("pdf_hash","documento","lower(plantilla)='".$_REQUEST['plantilla']."' AND numero='".$_REQUEST['numero']."'","",$conn);
    
    $hash_request=obtener_codigo_hash_pdf($_FILES["pdf"]["tmp_name"],"crc32",1);
    if($hash_original['numcampos']){
        $cadena="";
        $cadena.="
            Hash radicado: ".$hash_original[0]['pdf_hash']."
            </br>
            Hash Adjunto: ".$hash_request."
            </br>
            </br>
        ";
        if($hash_original[0]['pdf_hash']==$hash_request){
            $cadena.="<div class='badge alert-success'>El PDF es original</div>";
        }else{
            $cadena.="<div class='badge alert-warning'>El PDF fue modificado</div>";
        }
        echo($cadena);
    }
    
}


?>


