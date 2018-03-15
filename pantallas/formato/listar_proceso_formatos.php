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

$consulta=busca_filtro_tabla('idcategoria_formato,nombre','categoria_formato','cod_padre=2 and estado=1','nombre ASC',$conn);
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
	      for($i=0;$i<$consulta["numcampos"];$i++){
	      	
	      		$idcategoria_formato=$consulta[$i]['idcategoria_formato'];
			  	$mostrar=0;
				$cuantos_formatos=busca_filtro_tabla("nombre,ruta_adicionar","formato","mostrar=1 AND (cod_padre IS NULL OR cod_padre=0) AND (fk_categoria_formato like'".$idcategoria_formato."' OR   fk_categoria_formato like'%,".$idcategoria_formato."'  OR   fk_categoria_formato like'".$idcategoria_formato.",%' OR   fk_categoria_formato like'%,".$idcategoria_formato.",%') AND (fk_categoria_formato like'2' OR   fk_categoria_formato like'%,2'  OR   fk_categoria_formato like'2,%' OR   fk_categoria_formato like'%,2,%') ","etiqueta ASC",$conn);
				
				if($cuantos_formatos['numcampos']==1){
					$url=$ruta_db_superior.FORMATOS_CLIENTE.$cuantos_formatos[0]['nombre'].'/'.$cuantos_formatos[0]['ruta_adicionar']."?1=1";
					$proceso='';
					
					$modulo_formato=busca_filtro_tabla('idmodulo','modulo','nombre="crear_'.$cuantos_formatos[0]['nombre'].'"','',$conn);
					$ok=0;
					if($modulo_formato['numcampos']){
					    $ok=acceso_modulo($modulo_formato[0]['idmodulo']);
					}
					
					if($ok){
						$mostrar=1;
					}					
					
				}elseif($cuantos_formatos['numcampos']){
					for ($j=0; $j < $cuantos_formatos['numcampos']; $j++) { 
                        $modulo_formato=busca_filtro_tabla('idmodulo','modulo','nombre="crear_'.$cuantos_formatos[$j]['nombre'].'"','',$conn);
						$ok=0;
						if($modulo_formato['numcampos']){
							$ok=acceso_modulo($modulo_formato[0]['idmodulo']);
						}						
					
						if($ok){
							$url='listar_formatos.php?idcategoria_formato='.$consulta[$i]["idcategoria_formato"];
							$proceso='Proceso';
							$mostrar=1;
						}
					}
				}
		
				if($mostrar){						
					$etiqueta_formato=ucfirst(codifica_encabezado(html_entity_decode(strtolower($consulta[$i]["nombre"]))));	
											
		              $texto.='<div title="'.$etiqueta_formato.'" data-load=\'{"kConnector":"'.$conector.'", "url":"'.$url.$adicional.'", "kTitle":"'.$proceso.' '.$etiqueta_formato.'"}\' class="items navigable">';
		              $texto.='<div class="head"></div>';              				            
		              $texto.='<div class="label">'.$etiqueta_formato.'</div>';
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
	$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
	if (trim($configuracion[0]["valor"]) == trim($_SESSION["LOGIN" . LLAVE_SAIA])) {
	    return true;
	  }
	  $ok=new Permiso();
	$modulo = busca_filtro_tabla("nombre", "modulo", "idmodulo=" . $idmodulo, "", $conn);
	  $acceso=$ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	  return $acceso;
	}
?>
