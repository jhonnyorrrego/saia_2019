<?php
function menu_superior_adicionar($idmodulo){
	global $ruta_db_superior;
	$texto='<li><div class="btn-group">                    
          <button class="btn btn-mini kenlace_saia" conector="iframe" id="adicionar_pantalla" destino="_self" title="Adicionar formato" enlace="pantallas/generador/generador_pantalla.php?idbusqueda_componente='.$idmodulo.'">Adicionar formato</button><button class="btn btn-mini kenlace_saia" conector="iframe" id="generar_pantallas" destino="_self" title="Generar pantallas" enlace="pantallas/generador/generar_todas_pantallas.php?idbusqueda_componente='.$idmodulo.'">Generar todas</button></div>';
      
	return($texto);
}
function pdf_funcion($idpantalla){
	global $conn;
	$pdf=busca_filtro_tabla("","pantalla_pdf a","a.fk_idpantalla=".$idpantalla,"",$conn);
	if(!$pdf["numcampos"]){
		$texto='<button title="Configurar pdf" titulo="Configurar pdf" class="btn btn-mini kenlace_saia link" enlace="pantallas/pantalla_pdf/adicionar_pantalla_pdf.php?idpantalla='.$idpantalla.'" conector="iframe"><i class="icon-print"></i></button>';
	}
	else{
		$texto='<button title="Configurar pdf" titulo="Configurar pdf" class="btn btn-mini kenlace_saia link" enlace="pantallas/pantalla_pdf/editar_pantalla_pdf.php?idpantalla_pdf='.$pdf[0]["idpantalla_pdf"].'" conector="iframe">Editar</button>';
	}
	return($texto);
}
?>