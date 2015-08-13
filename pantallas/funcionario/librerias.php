<?php 
function barra_superior_funcionario($idfuncionario,$nombres,$apellidos){
$texto='<div class="btn-group barra_superior">
<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" title="Seleccionar Funcionario" idregistro="'.$idfuncionario.'"><i class="icon-uncheck"></i></button>
</div>';
return($texto);
}
function firma_digital_funcion($firma){
	$texto='<span style="color:#347BB8">Posee firma</span>';
	if($firma=='firma'){
		$texto='<span style="color:#EF414D">No posee firma</span>';
	}
	return($texto);
}
function seleccionar_perfil($idperfil,$idfuncionario){
  return($idperfil." AND idfuncionario=".$idfuncionario);
}
function prueba_accion(){
  $texto='<li><a href="#" id="accion2">Accion</a></li>';
  $texto.='<script>
    $("#accion2").click(function(){
      alert($("#seleccionados").val());
    } );
  </script>';
  return $texto;
}
function nombre_perfil($perfil){
	$nombre_perfil = busca_filtro_tabla("","perfil","idperfil in(".$perfil.")","",$conn);
	$perfiles=extrae_campo($nombre_perfil,"nombre");
	$cadena.= implode(", ",$perfiles);
	return addslashes($cadena);
}
function estado_funcionario($estado){
	$texto="";
	if($estado==1){
		$texto="Activo";
	}
	else if($estado==0){
		$texto="Inactivo";
	}
	else if($estado==2){
		$texto="Temporalmente inactivo";
	}
	return($texto);
}
?>