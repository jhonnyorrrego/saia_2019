<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

if (@$_REQUEST["tipo"] == 1) {
	$idpais = $_REQUEST["idpais"];
	$departamentos = busca_filtro_tabla("", "departamento A", "A.pais_idpais=" . $idpais, "A.nombre asc", $conn);
	$texto = "";
	$texto .= "<option value=''>Seleccione...</option>";
	for ($i = 0; $i < $departamentos["numcampos"]; $i++) {
		$texto .= "<option value='" . $departamentos[$i]["iddepartamento"] . "'>" . ucwords(strtolower($departamentos[$i]["nombre"])) . "</option>";
	}
	echo($texto);
}
if (@$_REQUEST["tipo"] == 2) {
	$iddepartamento = $_REQUEST["iddepartamento"];
	$municipios = busca_filtro_tabla("", "municipio A", "A.departamento_iddepartamento=" . $iddepartamento, "A.nombre asc", $conn);
	$texto = "";
	$texto .= "<option value=''>Seleccione...</option>";
	for ($i = 0; $i < $municipios["numcampos"]; $i++) {
		$texto .= "<option value='" . $municipios[$i]["idmunicipio"] . "'>" . ucwords(strtolower($municipios[$i]["nombre"])) . "</option>";
	}
	echo($texto);
}

if(@$_REQUEST["tipo"]==3){
	$retorno=array(); $retorno["exito"]=0; $retorno["html"]=""; $retorno["existe"]=0;
	if($_REQUEST["campo"]=="nombre"){
		$parte_where="lower(nombre) like '".strtolower($_REQUEST["valor"])."%'";
	}elseif($_REQUEST["campo"]=="identificacion"){
		$parte_where="identificacion like '".$_REQUEST["valor"]."%'";
	}
	$info=busca_filtro_tabla("idejecutor,nombre,identificacion","ejecutor",$parte_where,"nombre",$conn);
	if($info["numcampos"]){
		$retorno["exito"]=1;
		$retorno["html"].='<table class="table table-bordered" style="width:70%;margin: 20px;margin-left: auto;margin-right: auto;">
		<tr><td colspan="3" style="text-align:center"><b>COINCIDENCIAS POR '.strtoupper($_REQUEST["campo"]).'</b></td></tr>
		<tr><th class="prettyprint" style="text-align:center">Nombre</th> <th class="prettyprint" style="text-align:center">Identificaci&oacute;n</th> <th class="prettyprint">&nbsp;</th></tr>';
		for($i=0;$i<$info["numcampos"];$i++){
				$existe=0;
				if($_REQUEST["campo"]=="identificacion"){
					if($info[$i]["identificacion"]==$_REQUEST["valor"]){
						$existe=1;
					}
				}
				if($existe){
					$retorno["existe"]=1;
					$retorno["html"].='<tr style="background-color: #F78181"><td>'.$info[$i]["nombre"].'</td> <td>'.$info[$i]["identificacion"].'</td> <td><a href="'.$ruta_db_superior.'pantallas/remitente/mostrar_datos_ejecutor.php?idejecutor='.$info[$i]["idejecutor"].'" target="_self">Ver</a></td></tr>';
				}else{
					$retorno["html"].='<tr><td>'.$info[$i]["nombre"].'</td> <td>'.$info[$i]["identificacion"].'</td> <td><a href="'.$ruta_db_superior.'pantallas/remitente/mostrar_datos_ejecutor.php?idejecutor='.$info[$i]["idejecutor"].'" target="_self">Ver</a></td></tr>';
				}
		}
		$retorno["html"].='</table>';
	}
	echo json_encode($retorno);
}
?>

