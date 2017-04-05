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
//include_once($ruta_db_superior."pantallas/lib/encabezado_componente.php");
usuario_actual("login");
?>
<div class="panel-body">	
  <div class="block-nav">    
	<?php 
	      $texto='';
		  $conector='iframe';
	      	$mostrar=1;
            $idmodulo=@$_REQUEST['idmodulo'];
            $modulo=busca_filtro_tabla("etiqueta,enlace,idmodulo","modulo","idmodulo in(".$idmodulo.")","",$conn);
            for($i=0;$i<$modulo['numcampos'];$i++){
                $etiqueta=codifica_encabezado(html_entity_decode($modulo[$i]['etiqueta']));
                $url=$ruta_db_superior.$modulo[$i]['enlace'];
                $id_div='enlace_pantallas_kaiten_'.$modulo[$i]['idmodulo'];
            
				if($mostrar){						
		              $texto.='<div title="'.$etiqueta.'" data-load=\'{"kConnector":"'.$conector.'", "url":"'.$url.'", "kTitle":"'.$etiqueta.'"}\' class="items navigable" id="'.$id_div.'">';
		              $texto.='<div class="head"></div>';              				            
		              $texto.='<div class="label">'.$etiqueta.'</div>';
		              $texto.='<div class="info"></div>'; 		
		              $texto.='<div class="tail"></div>';
				      $texto.='</div>'; 
				}
			}	
	      echo($texto);
	?>	
  </div>
</div>