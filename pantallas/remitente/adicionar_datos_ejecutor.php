<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_bootstrap());
echo(librerias_notificaciones());
echo (librerias_jquery("1.7"));
$pais = busca_filtro_tabla("", "pais A", "", "A.nombre asc", $conn);
$ult_datos=busca_filtro_tabla("","vejecutor","idejecutor=".$_REQUEST["idejecutor"],"iddatos_ejecutor desc",$conn);
if($ult_datos["numcampos"]){
	$cargo=$ult_datos[0]["cargo"];
	$empresa=$ult_datos[0]["empresa"];
	$direccion=$ult_datos[0]["direccion"];
	$telefono=$ult_datos[0]["telefono"];
	$titulo=$ult_datos[0]["titulo"];
	$ciudad=$ult_datos[0]["ciudad"];
	$correo=$ult_datos[0]["email"];
	$nom_ciudad=$ult_datos[0]["ciudad_ejecutor"]."<br/>";;
}else{
	$cargo="";
	$empresa="";
	$direccion="";
	$telefono="";
	$titulo="";
	$ciudad="";
	$nom_ciudad="";
}
?>
<form name="formulario_datos_ejecutor" id="formulario_datos_ejecutor">
	<table class="table table-bordered" style="width:70%;margin: 20px;margin-left: auto;margin-right: auto;">
		<tr>
			<td style="width:30%;" class="prettyprint"><b>Cargo</b></td>
			<td style="width:40%;">
			<input type="text" name="cargo" id="cargo" value="<?php echo $cargo;?>">
			</td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Contacto</b></td>
			<td>
			<input type="text" name="empresa" id="empresa" value="<?php echo $empresa;?>">
			</td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Direcci&oacute;n </b></td>
			<td>
			<input type="text" name="direccion" id="direccion" value="<?php echo $direccion;?>">
			</td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Tel&eacute;fono</b></td>
			<td>
			<input type="text" name="telefono" id="telefono" value="<?php echo $telefono;?>">
			</td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Email</b></td>
			<td>
				<input type="text" name="email" id="email" value="<?php echo $correo;?>">			
			</td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Titulo</b></td>
			<td>
			<select name="titulo" id="titulo">
				<option value="Se&ntilde;or" <?php if($titulo=='Se&ntilde;or')echo("selected"); ?> >Se&ntilde;or</option>
				<option value="Se&ntilde;ora" <?php if($titulo=='Se&ntilde;ora')echo("selected"); ?> >Se&ntilde;ora</option>
				<option value="Doctor" <?php if($titulo=='Doctor')echo("selected"); ?> >Doctor</option>
				<option value="Doctora" <?php if($titulo=='Doctora')echo("selected"); ?>>Doctora</option>
				<option value="Ingeniero" <?php if($titulo=='Ingeniero')echo("selected"); ?>>Ingeniero</option>
				<option value="Ingeniera" <?php if($titulo=='Ingeniera')echo("selected"); ?>>Ingeniera</option>
			</select></td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Ciudad</b></td>
			<td>
			<span id="nom_ciudad"><?php echo $nom_ciudad;?></span>
			<select class="span2" name="pais" id="pais">
				<option value="">Seleccione...</option>
				<?php
				for ($i = 0; $i < $pais["numcampos"]; $i++) {
					echo("<option value='" . $pais[$i]["idpais"] . "'>" . ucwords(strtolower($pais[$i]["nombre"])) . "</option>");
				}
				?>
			</select>
			<select class="span2" name="departamento" id="departamento">
				<option value=''>Seleccione...</option>
			</select>
			<select class="span2" id="municipios" name="ciudad" class="required">
				<option value=''>Seleccione...</option>
			<?php 
				if($ciudad!=""){
					echo "<option value='".$ciudad."' selected>".$nom_ciudad."</option>";
				}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center">
			<input type="hidden" name="ejecutor_idejecutor" id="ejecutor_idejecutor" value="<?php echo($_REQUEST["idejecutor"]); ?>">
			<button class="btn btn-primary btn-mini" id="submit_formulario_ejecutor">
				Aceptar
			</button>
			<button class="btn btn-mini" onclick="window.open('mostrar_datos_ejecutor.php?idejecutor=<?php echo(@$_REQUEST["idejecutor"]); ?>','_self'); return false;">
				Volver
			</button></td>
		</tr>
	</table>
</form>

<script>
	$(document).ready(function() {
	  $("#telefono").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9]/g, '');
	  });
	  $("#email").blur(function (){
	  	if($(this).val()!=""){
		  	if(!validar_email($(this).val())){
		  		notificacion_saia("Email NO valido", "error", "", 2500);
		  		$(this).focus();
		  	}
	  	}
	  });
		function validar_email(valor){
			var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			if(filter.test(valor)){
				return true;
			}else{
				return false;
			}
		}
		
		
		var formulario_remitente = $("#formulario_datos_ejecutor");
		$("#pais").change(function() {
			$("#nom_ciudad").empty();
			$.ajax({
				url : 'solicitud_ciudad.php',
				type : 'POST',
				data : {
					tipo : 1,
					idpais : $(this).val()
				},
				success : function(data) {
					$("#departamento").html("");
					$("#departamento").append(data);
					$("#municipios").html("<option value=''>Seleccione...</option>");
				}
			});
		});
		$("#departamento").change(function() {
			$.ajax({
				url : 'solicitud_ciudad.php',
				type : 'POST',
				data : {
					tipo : 2,
					iddepartamento : $(this).val()
				},
				success : function(data) {
					$("#municipios").html("");
					$("#municipios").append(data);
				}
			});
		});

		$("#submit_formulario_ejecutor").click(function() {
			if(confirm("Esta Seguro de Guardar?")){
				$.ajax({
					type : 'POST',
					async : false,
					dataType: 'json',
					url: "<?php echo($ruta_db_superior); ?>pantallas/remitente/ejecutar_acciones.php",
					data : "ejecutar_remitente=set_remitente&tipo_retorno=1&rand=" + Math.round(Math.random() * 100000) + "&" + formulario_remitente.serialize(),
					success : function(objeto) {
						if (objeto.exito) {
							notificacion_saia(objeto.mensaje, "success", "", 2500);
							window.open('mostrar_datos_ejecutor.php?idejecutor=<?php echo(@$_REQUEST["idejecutor"]); ?>','_self');
						}
					}
				});
				return false;
			}else{
				return false;
			}
		});
	}); 
</script>

