<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
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
        <legend>Filtrar funcionarios</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Login
			<input type="hidden" name="bksaiacondicion_login" id="bksaiacondicion_login" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_login" name="bqsaia_login" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_login',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_login',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_login" id="bqsaiaenlace_login" value="" />
		</div>
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Nombres
			<input type="hidden" name="bksaiacondicion_nombres" id="bksaiacondicion_nombres" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_nombres" name="bqsaia_nombres" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombres',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombres',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombres" value="" />
		</div>
		<br>
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Apellidos
			<input type="hidden" name="bksaiacondicion_apellidos" id="bksaiacondicion_apellidos" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_apellidos" name="bqsaia_apellidos" size="50" type="text">
          </div>
        </div>         
    <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_apellidos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_apellidos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_apellidos" value="" />
		</div>​
		<br>
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Nit
            <input type="hidden" name="bksaiacondicion_nit" id="bksaiacondicion_nit" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_nit" name="bqsaia_nit" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nit',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nit',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nit" id="bqsaiaenlace_nit" value="" />
		</div>
        <br>
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Estado
            <input type="hidden" name="bksaiacondicion_estado" id="bksaiacondicion_estado" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_estado1" name="bqsaia_estado" type="radio" value="1">Activo
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_estado2" name="bqsaia_estado" type="radio" value="0">Inactivo
              </label>
            </div>          
          </div> 
        </div>  
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_estado" id="bqsaiaenlace_estado" value="" />
		</div>
        <br>
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Perfil
            <input type="hidden" name="bksaiacondicion_idperfil" id="bksaiacondicion_idperfil" value="=">
            </label>
            <div class="controls">
              	<select name="bqsaia_idperfil" id="bqsaia_idperfil">
              		<option value="">Seleccione...</option>
              		<?php
									$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
									$parte = "lower(nombre)<>'administrador'";
									if ($configuracion["numcampos"] && trim($configuracion[0]["valor"]) == trim($_SESSION["LOGIN" . LLAVE_SAIA])) {
										$parte = "";
									}
									$cons_perfil = busca_filtro_tabla("A.idperfil, A.nombre ", "perfil A", $parte, "A.nombre ASC", $conn);
									if ($cons_perfil["numcampos"]) {
										for ($i = 0; $i < $cons_perfil["numcampos"]; $i++) {
											$x_perfil_idperfilList .= '<option value="' . $cons_perfil[$i]["idperfil"] . '">' . $cons_perfil[$i]["nombre"] . '</option>';
										}
									}
									echo $x_perfil_idperfilList;
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
		echo(librerias_bootstrap());
  ?>
</html>
<script>
	$(document).keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			$("#ksubmit_saia").click();
		}
	}); 
</script>