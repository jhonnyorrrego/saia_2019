<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/documento/librerias.php");

function obtener_informacion_documento($iddocumento,$fecha,$comentario,$funcionario){
	global $conn;
        
        if(is_numeric ($funcionario)){
            $nombre = busca_filtro_tabla("CONCAT(nombres, CONCAT(' ', apellidos)) AS funcionario","funcionario","funcionario_codigo=".$funcionario,"",$conn);
            $funcionario = $nombre[0]['funcionario'];            
        }        
	$texto ="<div class='row'>
                    <div class='span4 pull-left'>".$funcionario."</div>
                    <div class='span4 pull-left'>".$comentario."</div>
                    <div class='span4 pull-right'>".menu_informacion_documento($iddocumento)."</div>
                 </div>";
	
return($texto);
}

function mostrar_anexos_documento($iddoc,$ruta,$etiqueta){
	$texto ="
				<div class='row'>
					<div class='span4 pull-left'>
						<a href='../../".$ruta."'>".$etiqueta."</a>
					</div>
					<div class='span4'>
						Descripción
					</div>
					<div class='span4 pull-right'>
						".menu_informacion_documento($iddoc)."
					</div>
				</div>
			";
			
	return($texto);
}

function menu_informacion_documento($iddocumento,$idanexos,$ruta,$etiqueta,$extension){
	global $conn,$ruta_db_superior;
	$modulo_anexos = busca_filtro_tabla("idmodulo","modulo","nombre LIKE 'adjuntos_documento'","",$conn);		
	if($modulo_anexos['numcampos']){
		$modulo_hijos = busca_filtro_tabla("A.*","modulo A","A.cod_padre=".$modulo_anexos[0]['idmodulo'],"orden ASC",$conn);		
		if($modulo_hijos['numcampos']){
			$texto='<div class="pull-right">';
			$permiso=new PERMISO();
			for($i=0; $i< $modulo_hijos['numcampos']; $i++){
				//$ok=$permiso->permiso_usuario($modulo_hijos[$i]['nombre'],1);
				//if($ok){					
					switch ($modulo_hijos[$i]['nombre']) {
						case 'descargar_anexo':
							$texto.=redirecciona_visores($iddocumento,$idanexos,$ruta,$etiqueta,$extension);	
							$texto.='<a href="'.$ruta_db_superior.'pantallas/anexos/librerias.php?idanexo='.$idanexos.'&ejecutar_anexos=descargar_anexo"><i class="'.$modulo_hijos[$i]['imagen'].' tooltip_saia_izquierda" title="'.$modulo_hijos[$i]['ayuda'].'"></i></a>';
							break;						
						case 'informacion_anexos':
							//$texto.='<a href="#" style="border-width:0px; cursor:auto;" class="abrir_highslide" enlace="pantallas/anexos/informacion_anexos.php?idanexo='.$idanexos.'&iddocumento='.$iddocumento.'" id="adjuntos_documento"><i class="'.$modulo_hijos[$i]['imagen'].' tooltip_saia_izquierda" title="'.$modulo_hijos[$i]['ayuda'].'"></i></a>';							
							break;
						case 'permisos_anexo':							
							/*$permiso_anexo=busca_filtro_tabla("","permiso_anexo","anexos_idanexos=".$idanexos,"",$conn);
								$texto.='<a href="'.$ruta_db_superior.'anexosdigitales/anexos_permiso_add.php?idanexo='.$idanexos.'" class="highslide" onclick="return hs.htmlExpand( this, {objectType: \'iframe\', outlineWhileAnimating: true, width: 200 } )" style="border-width:0px; cursor:auto;"><i class="'.$modulo_hijos[$i]['imagen'].' tooltip_saia_derecha" title="'.$modulo_hijos[$i]['ayuda'].'"></i></a>';	
							if($permiso_anexo['numcampos']){
							}*/							
							break;
						case 'eliminar_anexo':
							/*$permiso_anexo=busca_filtro_tabla("","permiso_anexo","idpropietario=".usuario_actual("idfuncionario")." AND anexos_idanexos=".$idanexos,"",$conn);
							$documento_aprobado = busca_filtro_tabla("","documento A, anexos B","A.iddocumento=B.documento_iddocumento AND B.idanexos=".$idanexos,"",$conn);														
							if($permiso_anexo['numcampos']){
                $estado=strtolower($documento_aprobado[0]["estado"]);
								if($documento_aprobado['numcampos'] && (($estado=='activo' || $estado=='iniciado') || $documento_aprobado[0]["formato"]=="")){
									$texto.='<a href="#" style="border-width:0px; cursor:auto;" class="abrir_highslide" enlace="anexosdigitales/borrar_anexos.php?idanexo='.$idanexos.'&iddocumento='.$iddocumento.'" id="adjuntos_documento"><i class="'.$modulo_hijos[$i]['imagen'].' tooltip_saia_izquierda" title="'.$modulo_hijos[$i]['ayuda'].'"></i></a>'; 
								}	
							}	*/						
							break;																				
						default:
							$texto.='<a href="'.$modulo_hijos[$i]['enlace'].'"><i class="'.$modulo_hijos[$i]['imagen'].' tooltip_saia_derecha" title="'.$modulo_hijos[$i]['ayuda'].'"></i></a>';
							break;
					}
				//}				
			}
			$texto .= '</div>';
		}
	}	
	return($texto);
}
function redirecciona_visores($iddocumento,$idanexos,$ruta,$etiqueta,$extension){
global $conn,$ruta_db_superior;
	$html='';
	$array=array("pdf","jpg","png");
	if(in_array(strtolower($extension), $array)){
		//$html='<a href="'.$ruta_db_superior.$ruta.'" target="detalles"><i class="icon-ver_pag_documento" tooltip_saia_izquierda" title=""></i></a>';
		$ruta_mostrar='anexosdigitales/mostrar_menu_anexo.php?idanexo='.$idanexos.'&iddoc='.$iddocumento;
		$html='<a href="'.$ruta_db_superior.$ruta_mostrar.'" target="detalles"><i class="icon-ver_pag_documento" tooltip_saia_izquierda" title=""></i></a>';
	}
  if($extension=="eml"){
    $ruta=$ruta_db_superior."pantallas/visores_saia/visor_eml.php?filename=".$ruta_db_superior.$ruta;
    $html='<a href="'.$ruta.'" target="detalles"><i class="icon-ver_pag_documento" tooltip_saia_izquierda" title=""></i></a>';
  }
	return($html);
}

function funcionario($funcionario_codigo){
    $nombre = busca_filtro_tabla("nombres, apellidos","funcionario","funcionario_codigo=".$funcionario_codigo,"",$conn);     
    return($nombre[0]['nombres']." ".$nombre[0]["apellidos"]);
}
function ruta_anexo_documento($ruta,$etiqueta){
    global $ruta_db_superior;
    $texto = "<a href='".$ruta_db_superior.$ruta."'>".$etiqueta."</a>";
    return($texto);
} 
function funcionario_actual(){
	return(usuario_actual('funcionario_codigo'));
}
function mostrar_etiqueta($etiqueta, $tipo=null){
	$etiqueta2=str_replace(".".$tipo,"",utf8_encode(html_entity_decode($etiqueta)));	
	return(delimita($etiqueta2,14));
}                           
function obtener_descripcion_informacion($descripcion){
    return (delimita(strip_tags($descripcion), 20));    
}

function obtener_color_clase($origen, $destino){
	$funcionario = usuario_actual('funcionario_codigo');
	
	if($funcionario == $origen){
		return('class="alert-info"');
	}elseif($funcionario == $destino){
		return(' class="alert"');
	}else{
		return('');
	}		
}
function opcion_eliminar_anexos($idanexos,$iddocumento){
global $conn;
$permiso_anexo=busca_filtro_tabla("","permiso_anexo","idpropietario=".usuario_actual("idfuncionario")." AND anexos_idanexos=".$idanexos,"",$conn);
$documento_aprobado = busca_filtro_tabla("","documento A, anexos B","A.iddocumento=B.documento_iddocumento AND B.idanexos=".$idanexos,"",$conn);														
if($permiso_anexo['numcampos']){
  $estado=strtolower($documento_aprobado[0]["estado"]);
	if($documento_aprobado['numcampos'] && (($estado=='activo' || $estado=='iniciado') || $documento_aprobado[0]["formato"]=="")){     
    return('<input type="checkbox" name="anexos[]" class="cb_anexos" value="'.trim($idanexos).'">');
  }
}  
}
?>