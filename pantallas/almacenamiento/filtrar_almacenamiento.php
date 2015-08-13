<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
formulario();
function formulario(){
	global $conn,$ruta_db_superior;
	$cajas=busca_filtro_tabla("","caja a","","",$conn);
	?>
	<form method="post" name="buscar" id="buscar" action="<?php echo $ruta_db_superior; ?>pantallas/almacenamiento/almacenamientolist.php" target="centro">
	<table style="font-family:arial">
		<tr class="encabezado">
			<td colspan="2" style="text-align:center"><b>Buscar</b></td>
		</tr>
		<tr>
			<td class="encabezado"><b>Caja</b></td>
			<td><select name="caja_idcaja" id="caja_idcaja"><option value="">Por favor seleccione...</option>
<?php
for($i=0;$i<$cajas["numcampos"];$i++){
	echo '<option value="'.$cajas[$i]["idcaja"].'">'.$cajas[$i]["fondo"].'</option>';
}
?>
			</select>
			</td>
		</tr>
		
		<tr>
			<td class="encabezado"><b>Numero orden</b></td>
			<td>
				<input type="text" name="numero_orden" id="numero_orden">
			</td>
		</tr>
		
		<tr>
			<td class="encabezado"><b>Nombre del expediente</b></td>
			<td>
				<input type="text" name="nombre_expediente" id="nombre_expediente">
			</td>
		</tr>
		
		<tr>
			<td class="encabezado"><b>No tomo</b></td>
			<td>
				<input type="text" name="no_tomo" id="no_tomo">
			</td>
		</tr>
		
		<tr>
			<td class="encabezado"><b>Codigo numero</b></td>
			<td>
				<input type="text" name="codigo_numero" id="codigo_numero">
			</td>
		</tr>
		
		<tr>
			<td class="encabezado"><b>Fondo</b></td>
			<td>
				<input type="text" name="fondo" id="fondo">
			</td>
		</tr>
		
		<tr>
			<td colspan="2"><input type="submit" value="Buscar"></td>
		</tr>
	</table>
	<input type="hidden" name="filtrar" value="1">
	</form>
	<?php
}
?>