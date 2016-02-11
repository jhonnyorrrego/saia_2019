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
	usuario_actual("login");

	echo(estilo_bootstrap());
    echo(librerias_html5());
    echo(librerias_jquery("1.7"));
    echo(librerias_UI());
    echo(librerias_kaiten());   
    echo(librerias_acciones_kaiten()); 

	$idcategoria_formato=$_REQUEST['idcategoria_formato'];
	$lista_formatos=busca_filtro_tabla("","formato","cod_padre=0 AND (fk_categoria_formato like'".$idcategoria_formato."' OR   fk_categoria_formato like'%,".$idcategoria_formato."'  OR   fk_categoria_formato like'".$idcategoria_formato.",%' OR   fk_categoria_formato like'%,".$idcategoria_formato.",%') ","etiqueta ASC",$conn);
	$proceso=busca_filtro_tabla('','categoria_formato','idcategoria_formato='.$idcategoria_formato,'',$conn);
	$nombre_proceso=utf8_encode(html_entity_decode($proceso[0]['nombre']));
	$nombre_proceso=strtolower($nombre_proceso);
	$nombre_proceso=strtoupper($nombre_proceso);
	$nombre_proceso=$nombre_proceso;
	$texto='
		<br/>
		<div class="container">
			<table class="table table-hover">
			<tbody>
			<tr>
				<th style="text-align:center;"><b>'.$nombre_proceso.'</b></th>
			</tr>
	';
	for($i=0;$i<$lista_formatos['numcampos'];$i++){
		
		$modulo_formato=busca_filtro_tabla('','modulo','nombre="'.$lista_formatos[$i]['nombre'].'"','',$conn);
		$ok=acceso_modulo($modulo_formato[0]['idmodulo']);
		
		if($ok){
			$etiqueta=utf8_encode(html_entity_decode($lista_formatos[$i]['etiqueta']));
			$etiqueta=strtolower($etiqueta);
			$etiqueta=ucwords($etiqueta);
		
			$enlace_adicionar='formatos/'.$lista_formatos[$i]['nombre'].'/'.$lista_formatos[$i]['ruta_adicionar'];
			
			$texto.='
				<tr>
					<td>
						<div class="kenlace_saia" style="cursor:pointer" titulo="'.$etiqueta.'" title="'.$etiqueta.'" enlace="'.$enlace_adicionar.'" conector="iframe">  '.$etiqueta.' </div>
					</td>
				</tr>
			';
		}	
	}
	$texto.='</tbody></table></div>';
	echo($texto);
?>

<?php
	function acceso_modulo($idmodulo){
	  if($idmodulo=='' || $idmodulo==Null || $idmodulo==0 ||  usuario_actual("login")=="cerok"){
	    return true;
	  }
	  $ok=new Permiso();
	  $modulo=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"");
	  $acceso=$ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	  return $acceso;
	}	
	

?>