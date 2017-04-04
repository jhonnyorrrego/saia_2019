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

$adicional="";
$request=array();
foreach(@$_REQUEST as $id => $value){
  $request[]=$id."=".$value;
}
if(count($request)){
  $adicional="&".implode("&",$request);
}
?>
<div class="panel-body">	
  <div class="block-nav">    
	<?php 
	      $texto='';
		  $conector='iframe';
	      	
	      		$idcategoria_formato=1;
			  	$mostrar=0;
				$cuantos_formatos=busca_filtro_tabla("","formato","(cod_padre IS NULL OR cod_padre=0) AND (concat(',',fk_categoria_formato,',') like'%,".$idcategoria_formato.",%')","etiqueta ASC",$conn);
				
				for($i=0;$i<$cuantos_formatos['numcampos'];$i++){
					$url=$ruta_db_superior.'formatos/'.$cuantos_formatos[$i]['nombre'].'/'.$cuantos_formatos[$i]['ruta_adicionar']."?1=1";
					$proceso='';
					
					$modulo_formato=busca_filtro_tabla('idmodulo','modulo','nombre="crear_'.$cuantos_formatos[$i]['nombre'].'"','',$conn);
					
					$ok=0;
					if($modulo_formato['numcampos']){
					    $ok=acceso_modulo($modulo_formato[0]['idmodulo']);
					}
					if($ok){
						$mostrar=1;
					}					
				if($mostrar){						
		              $texto.='<div title="'.$cuantos_formatos[$i]["etiqueta"].'" data-load=\'{"kConnector":"'.$conector.'", "url":"'.$url.$adicional.'", "kTitle":"'.$proceso.' '.$cuantos_formatos[$i]["etiqueta"].'"}\' class="items navigable">';
		              $texto.='<div class="head"></div>';              				            
		              $texto.='<div class="label">'.codifica_encabezado(html_entity_decode($cuantos_formatos[$i]["etiqueta"])).'</div>';
		              $texto.='<div class="info"></div>'; 		
		              $texto.='<div class="tail"></div>';
				      $texto.='</div>'; 
				}	
			}  
	      
	      echo($texto);
	?>	
  </div>
</div>


<?php
	function acceso_modulo($idmodulo){
	  if(usuario_actual("login")=="cerok"){
	    return true;
	  }
	  $ok=new Permiso();
	  $modulo=busca_filtro_tabla("nombre","modulo","idmodulo=".$idmodulo,"");
	  $acceso=$ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	  return $acceso;
	}	
?>