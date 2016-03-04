<?php
function barra_superior_cargo($idcargo){
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" enlace="cargo.php?key='.$idcargo.'" titulo="Datos cargo" conector="iframe"><i class="icon-signal"></i></button>
<button type="button" class="btn btn-mini tooltip_saia" titulo="Seleccionar cargo"><i class="adicionar_seleccionados icon-download" idregistro="'.$idcargo.'" ></i></button>
<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idcargo.'" titulo="Deseleccionar cargo"><i class="icon-edit"></i></button>
<button type="button" class="btn btn-mini tooltip_saia" titulo="Configurar cargo"><i class="icon-wrench"></i></button></div>';
return(($texto));
}
function adicionar_cargo($info_encriptada,$encriptada=true){
  global $data_form_saia;
  $data = json_decode($info_encriptada, true);
  if($encriptada){
    for($i = 0; $i < count($data); $i ++) {
      $data_form_saia["nombre"]=decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO);
      $data_form_saia["valor"]= decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
    }    
  }
  else{
    for($i = 0; $i < count($data); $i ++) {
      $data_form_saia["nombre"]=$data[$i]["name"];
      $data_form_saia["valor"]= $data[$i]["value"];
    }
  }
  
}
?>