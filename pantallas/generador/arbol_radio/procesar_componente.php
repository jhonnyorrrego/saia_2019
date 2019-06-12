<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';
function caracteristicas_arbol_radio($idcampo='',$seleccionado='',$accion='',$campo=''){

}
function busca_componente_arbol_radio($idcampo='',$seleccionado='',$accion='',$campo=''){
	global $conn,$ruta_db_superior;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
		$campo=$dato[0];
	}
	$parametros=explode(";", $campo["valor"]);
	if(@$parametros[4]){
		/*$texto='<div id="arbol_buscar_'.$campo["nombre"].'">
 Buscar:
<input type="text" id="stext_'.$campo["nombre"].'">
<a href="javascript:void(0)" onclick="tree_'.$campo["nombre"].'.findItem(document.getElementById(\'stext_'.$campo["nombre"].'\'.value),1)">
<img src="'.$ruta_db_superior.'assets/images/anterior.png" border="0px">
</a>
<a href="javascript:void(0)" onclick="tree_'.$campo["nombre"].'.findItem(document.getElementById(\'stext_'.$campo["nombre"].'\').value,0,1)">
<img src="'.$ruta_db_superior.'assets/images/buscar.png"border="0px">
</a>
<a href="javascript:void(0)" onclick="tree_'.$campo["nombre"].'.findItem(document.getElementById(\'stext_'.$campo["nombre"].'\').value)">
<img src="'.$ruta_db_superior.'assets/images/siguiente.png"border="0px"></a>
</div>';*/

		$texto='<div id="arbol_buscar_'.$campo["nombre"].'">
<input type="text" id="stext_'.$campo["nombre"].'" width="200px" size="25" placeholder="Buscar">

<a href="javascript:void(0)" onclick="tree_'.$campo["nombre"].'.openAllItems(0);find_item_tree(htmlentities(document.getElementById(\'stext_'.$campo["nombre"].'\').value),\''.$campo["nombre"].'\')">
<img src="'.$ruta_db_superior.'assets/images/buscar.png" alt="Buscar" border="0px"></a>

</div>';
	}
return($texto);
}
/**
* Cargar datos del arbol radio button
*
* Carga los datos iniciales del arbol, se le adiciona la cadena de seleccionados por defecto a la ruta del arbol, se debe tener en cuenta para hacer el check al generar el arbol.
*
* @access public
*
* @date 2013-11-25
* @author Hernando Trejos<hernando.trejos@cerok.com>
*
* @copyright <pendiente>
*
* @param integer $idcampo //id del campo
* @param string $seleccionado //valor de llenado por defecto
* @param string $accion //instancia
* @param array $campo //array de datos del camponente consultados de la tabla pantallas_campos
* @return string $text // Retorna la cinfiguraci�n del plugin
*/
function load_datos_arbol_radio($idcampo='',$seleccionado='',$accion='',$campo=''){
$cadena='';
global $conn,$ruta_db_superior;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
		$campo=$dato[0];
	}
	$parametros=explode(";", $campo["valor"]);
  if($parametros[0]!=''){
  	$adicional="";
  	if($parametros[7]){
  		$datos_enviar=explode(";",$parametros[7]);
			$cant=count($datos_enviar);
			$envio=array();
			for($i=0;$i<$cant;$i++){
				$datos_enviar2=explode(",",$datos_enviar[$i]);
				if($datos_enviar2[1][0]=="F"){
					$envio[]=$datos_enviar2[0]."=".str_replace("F","",$datos_enviar2[1]);
				}
				else{
					$envio[]=$datos_enviar2[0]."=".$_REQUEST[$datos_enviar2[1]];
				}
			}
			if(!strpos($parametros[0],"?")){
				$adicional="?".implode("&",$envio);
			}
			else{
				$adicional="&".implode("&",$envio);
			}
  	}
    $cadena='tree_'.$campo["nombre"].'.loadXML("'.$ruta_db_superior.$parametros[0].$adicional;
      if($seleccionado!=''){
        if(strpos($cadena,"?")===false){
          $cadena.='?';
        }
        else{
          $cadena.='&';
        }
        $cadena.="seleccionado=".$seleccionado;
      }
    $cadena.='");'."\n";
    }
return($cadena);
}

/**
* Cargar listado inicial del arbol radio button
*
* Se debe adicionar un parametro en la posicion 7 del arreglo del registro en el campo valor con la ruta partiendo de la raiz coma (,) y el nombre de la funcion ej: pantallas/lib/librerias_componentes.php,cargar_default_arbol_funcionarios.
* A esta funcion se le envian el campo y el seleccionado y debe retornar el componente completo a mostrar.
*
* @access public
*
* @date 2013-11-25
* @author Hernando Trejos<hernando.trejos@cerok.com>
*
* @copyright <pendiente>
*
* @param integer $idcampo //id del campo
* @param string $seleccionado //valor de llenado por defecto
* @param string $accion //instancia
* @param array $campo //array de datos del camponente consultados de la tabla pantallas_campos
* @return string $text // Retorna la cinfiguraci�n del plugin
*/
function cargar_listado_inicial_arbol_radio($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
	$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
	$campo=$dato[0];
}
if($seleccionado==''){
  if($campo["predeterminado"]!=''){
    $seleccionado=$campo["predeterminado"];
  }
}
$parametros=explode(";", $campo["valor"]);
if(@$parametros[7]!==''){
  $librerias=explode("-",$parametros[7]);
  if(@$librerias[0]&&@$librerias[1]){
    include_once($ruta_db_superior.$librerias[0]);
    $texto.=call_user_func_array($librerias[1],array($campo,$seleccionado));
  }
}
$arbol=explode(";",$campo["valor"]);
$valores=mostrar_seleccionados_arbol_radio($seleccionado,$arbol[6],$campo["valor"]);

$adicional="";
if($campo["obligatoriedad"]==1 && $accion!="buscar")$adicional=" required ";

$texto.='<input type="hidden" name="'.$campo["nombre"].'" value="'.$seleccionado.'" id="'.$campo["nombre"].'" '.$adicional.'>';
if($accion=="editar")
	$texto.='<div>'.$valores.'</div>';
return($texto);
}
function mostrar_arbol_radio($idcampo='',$seleccionado='',$accion='',$campo=''){
	global $conn,$ruta_db_superior;
	if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
		$campo=$dato[0];
	}
	$arbol=explode(";",$campo["valor"]);
	$valores=mostrar_seleccionados_arbol_radio($seleccionado,$arbol[6],$campo["valor"]);
	return($valores);
}

function mostrar_seleccionados_arbol_radio($seleccionado,$tipo_arbol,$dato_completo){
  global $conn;
	$vector=explode(",",str_replace("#","d",$seleccionado));
	$vector=array_unique($vector);
	sort($vector);
	$nombres=array();
 	if($tipo_arbol==3){ //valor almacenado
		if($valor["numcampos"]){
			$nombres[]=$valor[0][$campo[0]["nombre"]];
		}
	}
	 foreach($vector as $fila){
	   if($tipo_arbol==1)//arbol de series
	     {$datos=busca_filtro_tabla("nombre","serie","idserie=".$fila,"",$conn);
	        $nombres[]=$datos[0]["nombre"];
	     }
	   elseif($tipo_arbol==0)//arbol de funcionarios
	     {if(strpos($fila,'d')>0)
	        {$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("d","",$fila),"",$conn);
	        $nombres[]=$datos[0]["nombre"];
	        }
	      else
	        {if($pos=strpos($fila,"_"))
	           $fila=substr($fila,0,$pos);
	         $datos=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$fila,"",$conn);

	         $nombres[]=ucwords($datos[0]["nombres"]." ".$datos[0]["apellidos"]);
	        }
	     }
	    elseif($tipo_arbol==5)//arbol de roles
	     {if(strpos($fila,'d')>0)
	        {$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("d","",$fila),"",$conn);
	        $nombres[]=$datos[0]["nombre"];
	        }
	      else{if($pos=strpos($fila,"_"))
	        $fila=substr($fila,0,$pos);
	      $datos=busca_filtro_tabla("nombres,apellidos,cargo.nombre as cargo","funcionario,dependencia_cargo,cargo","funcionario_idfuncionario=idfuncionario and cargo_idcargo=idcargo and iddependencia_cargo='".$fila."'","",$conn);
	      $nombres[]=ucwords($datos[0]["nombres"]." ".$datos[0]["apellidos"]." - ".$datos[0]["cargo"]);
	      }
	     }
	    elseif($tipo_arbol==2)//arbol de dependencias
	     {$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".$fila,"",$conn);
	      $nombres[]=ucwords($datos[0]["nombre"]);
	     }
	    elseif($tipo_arbol==4){ //valor de tabla cuando se llama a test_serie.php el unico campo que se puede mostrar de la tabla es nombre
        $arreglo=explode(";",$dato_completo);
        if(strpos($arreglo[0],"est_serie")){
          $pos_tabla=strpos($arreglo[0],"tabla");
          $tabla1=substr($arreglo[0],$pos_tabla);
          $tabla2=explode("=",$tabla1);
					$tabla3=explode("&",$tabla2[1]);
          if($tabla3[0]){
            $valor_tabla=busca_filtro_tabla("",$tabla3[0],"id".$tabla3[0]." =".$fila,"",$conn);
            $nombres[]=ucfirst(strtolower($valor_tabla[0]["nombre"]));
          }
        }
	    }
	  }
	 $nombres= implode(", ",$nombres);
return($nombres);
}
?>
