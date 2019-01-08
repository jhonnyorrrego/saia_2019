<form method="POST" action="" class="form-horizontal" name="formulario_<?php echo($nombre);?>" id="formulario_<?php echo($nombre);?>">
  <fieldset id="content_form_name">
    <legend>Vincular funciones a la pantalla</legend>
  </fieldset>
  <div class="control-group">
    <label class="control-label" for="libreria">libreria</label>
    <div class="controls">
      <?php echo(@$pantalla_libreria[0]["ruta"]);?>
    </div>
  </div> 
    
  <div class="control-group">
    <label class="control-label" for="funcion">Funcion</label>
    <div class="controls">
      <?php                                                  
        echo($funcion_actual[0].'<input type="hidden" name="nombre" value="'.$funcion_actual[0].'">');                             
      ?>   
      <input type="hidden" name="idpantalla_libreria" id="idpantalla_libreria" value="<?php echo($_REQUEST["idpantalla_libreria"]);?>">
      <input type="hidden" name="parametros_funcion" value="<?php echo(@$funcion_actual[1]);?>" id="parametros_funcion">
      <!--input type="hidden" name="parametros_exe" value="" id="parametros_exe"-->
      <input type="hidden" name="tipo_funcion" value="<?php echo($pantalla_libreria[0]["tipo_archivo"]);?>" id="tipo_funcion">      
    </div>
  </div>
  <div class="control-group">
    <?php
      if(@$funcion_actual[1]&& $funcion_actual[1]!=''){
    ?>
    <table class="table table-bordered">
      <thead><th>Variable</th><th>Selecci&oacute;n</th><th>Valor</th></thead>
      <?php                                                                      
        $parametros_actual=explode(",",$funcion_actual[1]);
        foreach($parametros_actual AS $kparametro=>$vparametro){
          if($vparametro!=''){
            echo('<tr><td>'.$vparametro.'</td><td>'.selector_variable_funcion_pantalla($vparametro).'</td><td>'.opciones_variable_funcion_pantalla($vparametro).'</td></tr>');
          }
        }
      ?>
    </table>
    <?php
      }
    ?>
  </div>                
    
  <div class="form-actions">  	
    <button type="button" class="btn btn-primary" id="enviar_formulario_saia">Aceptar</button>
    <button type="button" class="btn" id="cancelar_formulario_saia">Cancel</button>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>




























  <div class="control-group">
    <label class="control-label" for="tipo_funcion">Tipo Funcion</label>
    <div class="controls"> 
      <label class="radio inline" for="funcion_php">
        <input type="radio" class="required" name="tipo_funcion" id="funcion_php" value="php" checked>
        PHP
      </label>
      <label class="radio inline" for="funcion_javascript">
        <input type="radio" class="required" name="tipo_funcion" id="funcion_js" value="js">
        Javascript
      </label>
      <!--label class="radio inline" for="funcion_otro">
        <input type="radio" class="required" name="tipo_funcion" id="funcion_otro" value="otro">
        Otro
      </label-->            
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="momento">Momento</label>
    <div class="controls"> 
      <label class="radio inline" for="momento_anterior">
        <input type="radio" class="required" name="momento" id="momento_anterior" value="1">
        Anterior a
      </label>
      <label class="radio inline" for="momento_posterior">
        <input type="radio" class="required" name="momento" id="momento_posterior" value="2" checked>
        Posterior a
      </label>            
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="accion">Acci&oacute;n</label>
    <div class="controls">
      <label class="radio inline" for="accion_ingresar">
        <input type="radio" class="required" name="accion" id="accion_ingresar" value="ingresar">
        Ingresar
      </label>
      <label class="radio inline" for="accion_submit">
        <input type="radio" class="required" name="accion" id="accion_submit" value="enviar" checked>
        Enviar
      </label>
      <label class="radio inline" for="accion_cancelar">
        <input type="radio" class="required" name="accion" id="accion_cancelar" value="cancelar">
        Cancelar
      </label>
      <label class="radio inline" for="accion_salir">
        <input type="radio" class="required" name="accion" id="accion_salir" value="salir">
        Salir
      </label>
      <label class="radio inline" for="accion_error">
        <input type="radio" class="required" name="accion" id="accion_error" value="error">
        Error
      </label>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pantalla">Vistas</label>
    <div class="controls">
      <label class="checkbox inline" for="vista_adicionar">
        <input type="checkbox" class="required" name="vistas[]" id=vista_adicionar" value="a" checked>
        Adicionar
      </label>
      <label class="checkbox inline" for="vista_editar">
        <input type="checkbox" class="required" name="vistas[]" id="vista_editar" value="e" checked>
        Editar
      </label>
      <label class="checkbox inline" for="vista_eliiminar">
        <input type="checkbox" class="required" name="vistas[]" id="vista_eliminar" value="d" checked>
        Eliminar
      </label>
      <label class="checkbox inline" for="vista_mostrar">
        <input type="checkbox" class="required" name="vistas[]" id="vista_mostrar" value="v" checked>
        Mostrar
      </label>
      <label class="checkbox inline" for="vista_buscar">
        <input type="checkbox" class="required" name="vistas[]" id="vista_buscar" value="s" checked>
        Buscar
      </label>
      <label class="checkbox inline" for="vista_listar">
        <input type="checkbox" class="required" name="vistas[]" id="vista_listar" value="l" checked>
        Listar
      </label>
    </div>
  </div>  