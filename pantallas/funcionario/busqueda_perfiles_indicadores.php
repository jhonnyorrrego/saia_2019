<?php $max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
?>
	<div class="container master-container">
		<form accept-charset="UTF-8" id="kformulario_saia"  method="post" class="form-horizontal">		
      		<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
			<div class="control-group">
				<label class="string required control-label" for="perfil"> Perfiles
						<input type="hidden" name="bksaiacondicion_perfil" id="bksaiacondicion_perfil" value="=">
				</label>
			<div class="controls">
				<select name="bqsaia_perfil" id="bqsaia_perfil">
					<option value="">Seleccione...</option>
					<?php
					$perfiles = busca_filtro_tabla("", "perfil", "", "", $conn);						
					for ($i = 0; $i < $perfiles["numcampos"]; $i++) {
						echo '<option value="' . $perfiles[$i]["idperfil"] . '">' . $perfiles[$i]["nombre"] . '</option>';
					}
					?>
				</select>
				<div class="recargar_indicadores btn btn-mini" componente="3"><i class="icon-refresh"></i></div>
			</div>
			</div>				
<div class="form-actions">
<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
<input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
<!--button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="<?php echo($ruta_db_superior); ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>
<input class="btn btn-danger" name="commit" type="reset" value="Cancelar"-->
</div>
</form>
</div>