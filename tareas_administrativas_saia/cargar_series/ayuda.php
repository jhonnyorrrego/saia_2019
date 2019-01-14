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
include_once ($ruta_db_superior . "librerias_saia.php");
echo estilo_bootstrap();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			li p {
				font-weight: normal;
			}
			li {
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h5>El Excel debe tener la siguiente estructura:</h5>
			<ul>
				<li>
					C&Oacute;DIGO
					<p>
						Codigo de la serie
						<br/>
						Utilizado para los cruces de la serie padre
					</p>
				</li>
				<li>
					NOMBRE
					<p>
						Nombre de la Serie
					</p>
				</li>
				<li>
					C&Oacute;DIGO DEPENDENCIA ASOCIADA (Separadas por coma)
					<p>
						Debe ir el C&Oacute;DIGO o el IDDEPENDENCIA de la tabla dependencia, Default: C&oacute;digo
						<br/>
						<span style="color:red">NOTA: En el adicionar se pedira el tipo de campo</span>
					</p>
				</li>
				<li>
					CLASE (Serie,Subserie,Tipo Documental)
					<p>
						Solo debe ir una sola clase por registro, NO se permiten vacios
					</p>
				</li>
				<li>
					C&Oacute;DIGO SERIE SUPERIOR
					<p>
						Codigo de la serie padre
					</p>
				</li>
				<li>
					TIEMPO RESPUESTA
					<p>
						Tiempo de respuesta en dias,(solo numeros enteros) Default:8
					</p>
				</li>
				<li>
					RETENCI&Oacute;N GESTI&Oacute;N
					<p>
						Tiempo de retenci&oacute;n gesti&oacute;n en a&ntilde;os,(solo numeros enteros) Default:3
					</p>
				</li>
				<li>
					RETENCI&Oacute;N CENTRAL
					<p>
						Tiempo de retenci&oacute central en a&ntilde;os,(solo numeros enteros) Default:5
					</p>
				</li>
				<li>
					CONSERVACION TOTAL
					<p>
						Debe ir una equis (X) en caso de que la serie se CONSERVE, si existe "X" la columna ELIMINACION debe ir vacio
					</p>
				</li>
				<li>
					DIGITALIZACI&Oacute;N
					<p>
						Debe ir una equis (X) en caso para la opcion "SI", de lo contrario almacenara la opci&oacute;n "NO"
					</p>
				</li>
				<li>
					SELECCI&Oacute;N
					<p>
						Debe ir una equis (X) en caso para la opcion "SI", de lo contrario almacenara la opci&oacute;n "NO"
					</p>
				</li>
				<li>
					ELIMINACI&Oacute;N
					<p>
						Debe ir una equis (X) en caso de que la serie se ELIMINE, si existe "X" la columna CONSERVACION TOTAL debe ir vacio
					</p>
				</li>
				<li>
					PROCEDIMIENTO
					<p>
						Texto del procedimiento
					</p>
				</li>
				<li>
					PERMITIR COPIA
					<p>
						Debe ir una equis (X) en caso para la opcion "SI", de lo contrario almacenara la opci&oacute;n "NO"
					</p>
				</li>
				<li>
					PERMISOS POR CARGO (Separados por coma)
					<p>
						Debe ir el C&Oacute;DIGO o el IDCARGO de la tabla cargo, estos campos deben ser unicos. Default: C&oacute;digo cargo
						<br/>
						<span style="color:red">NOTA: En el adicionar se pedira el tipo de campo</span>
					</p>
				</li>
				<li>
					PERMISOS POR DEPENDENCIA (Separados por coma)
					<p>
						Debe ir el C&Oacute;DIGO o el IDDEPENDENCIA de la tabla dependencia, estos campos deben ser unicos. Default: C&oacute;digo
						<br/>
						<span style="color:red">NOTA: En el adicionar se pedira el tipo de campo</span>
					</p>
				</li>
			</ul>
		</div>
	</body>
</html>
