<?php
function transferir_docs(){
	global $ruta_db_superior;
	$idbusqueda=busca_filtro_tabla("busqueda_idbusqueda","busqueda_componente","idbusqueda_componente=".$_REQUEST["idbusqueda_componente"],"",$conn);
  $texto.='<li><a href="#" id="transferir_docs">Transferir documentos</a></li>';
  $texto.='<script>
    $("#transferir_docs").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	enlace_katien_saia("transferenciaadd_plantillas.php?docs="+docus+",&retorno=pantallas/buscador_principal.php?idbusqueda='.$idbusqueda[0]["busqueda_idbusqueda"].'","Transferencia de documentos","iframe","");
	  }
	  else{
	  	alert("Seleccione por lo menos un documento");
	  }
    });
  </script>';
  return $texto;
}
function terminar_docs(){
	global $ruta_db_superior;
	$idbusqueda=busca_filtro_tabla("busqueda_idbusqueda","busqueda_componente","idbusqueda_componente=".$_REQUEST["idbusqueda_componente"],"",$conn);
  $texto.='<li><a href="#" id="terminar_docs">Sacar de mis pendientes</a></li>';
  $texto.='<script>
    $("#terminar_docs").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	enlace_katien_saia("terminar_pendientes.php?docs="+docus+"&retorno=pantallas/buscador_principal.php?idbusqueda='.$idbusqueda[0]["busqueda_idbusqueda"].'","Sacar de mis pendientes","iframe","");
	  }
	  else{
	  	alert("Seleccione por lo menos un documento");
	  }
    });
  </script>';
  return $texto;
}
?>