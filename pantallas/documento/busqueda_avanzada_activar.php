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
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <legend>Buscar documentos</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			N&uacute;mero de radicado
			<input type="hidden" name="bksaiacondicion_numero" id="bksaiacondicion_numero" value="in">
          </label>
          <div class="controls">
            <input id="bqsaia_numero" name="bqsaia_numero" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_numero" id="bqsaiaenlace_numero" value="" />
		</div>​
        <br>
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Plantilla
            <input type="hidden" name="bksaiacondicion_plantilla" id="bksaiacondicion_plantilla" value="in">
            </label>
            <div class="controls">
            	<?php
            	$filtro_documentos_activo=busca_filtro_tabla("a.idcategoria_formato","categoria_formato a, configuracion b","b.nombre like 'filtro_documentos_activos' AND a.nombre=b.valor","",$conn);
            	?>
              	<select name="bqsaia_plantilla" id="bqsaia_plantilla">
              		<option value="">Seleccione...</option>
              		<?php
              		$where="";
              		if($filtro_documentos_activo["numcampos"]){
              			$lista_in=explode(",",$filtro_documentos_activo[0]['idcategoria_formato']);
						for($i=0;$i<count($lista_in);$i++){
							$lista_in[$i]="'".$lista_in[$i]."'";
						}
						$lista_in=implode(",",$lista_in);
              			$where=" AND fk_categoria_formato not in(".$lista_in.")";
              		}
              		$formatos=busca_filtro_tabla("A.nombre,A.etiqueta","formato A, modulo B","A.nombre=B.nombre AND busqueda=1".$where,"etiqueta asc",$conn);
					for($i=0;$i<$formatos["numcampos"];$i++){
						echo '<option value="'.strtoupper($formatos[$i]["nombre"]).'">'.$formatos[$i]["etiqueta"].'</option>';
					}
              		?>
              	</select>
            </div>          
          </div> 
        </div>
        
           
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
        
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <?php 
  //echo(librerias_validar_formulario());
  echo(librerias_bootstrap());
  ?>
</html>