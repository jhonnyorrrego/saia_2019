<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/encabezado_componente.php");
usuario_actual("login");
?>
<div class="panel-body">	
  <div class="block-nav">    
	<?php 
	      $texto='';
		  $conector='iframe';
	      	
            $idconfiguracion=@$_REQUEST['idconfiguracion'];
            $idmodulo=@$_REQUEST['idmodulo'];
		    $mostrar=1;
			$etiqueta_modulo=busca_filtro_tabla("etiqueta","modulo","idmodulo=".$idmodulo,"",$conn);
            $etiqueta=codifica_encabezado(html_entity_decode($etiqueta_modulo[0]['etiqueta']));	
            
            $configuracion_url=busca_filtro_tabla("valor","configuracion","idconfiguracion=".$idconfiguracion,"",$conn);
            $url=$ruta_db_superior.$configuracion_url[0]['valor'];
            
				if($mostrar){						
		              $texto.='<div title="'.$etiqueta.'" data-load=\'{"kConnector":"'.$conector.'", "url":"'.$url.'", "kTitle":"'.$etiqueta.'"}\' class="items navigable" id="enlace_pantallas_kaiten">';
		              $texto.='<div class="head"></div>';              				            
		              $texto.='<div class="label">'.$etiqueta.'</div>';
		              $texto.='<div class="info"></div>'; 		
		              $texto.='<div class="tail"></div>';
				      $texto.='</div>'; 
				}	
			 
	      
	      echo($texto);
	?>	
  </div>
</div>