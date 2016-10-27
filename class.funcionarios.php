<?php
include_once("db.php");
/*Busca todos los datos relacionados con un funcionario particular 
como los cargos, las dependencias, las series, los permisos a modulos */
/* Esat Funcion esta casi lista*/
function busca_datos_administrativos_funcionario($funcionario,$filtrar=array()){
global $conn,$sql;
$serie_f=array();
$serie_c=array();
$serie_d=array();


if(!$funcionario){
  $funcionario=usuario_actual("idfuncionario"); 
}

//consulta dependencia
$dependencia = busca_filtro_tabla("B.*","dependencia_cargo A, dependencia B","A.dependencia_iddependencia=B.iddependencia AND A.funcionario_idfuncionario=$funcionario AND B.estado=1 AND A.estado=1","",$conn);


//consulta cargo
$cargo = busca_filtro_tabla("B.*","dependencia_cargo A, cargo B","A.cargo_idcargo=B.idcargo AND A.funcionario_idfuncionario=$funcionario AND A.estado=1","",$conn);

//consulta modulos
$modulo = busca_filtro_tabla("A.idpermiso,B.*","permiso A, modulo B","A.modulo_idmodulo=B.idmodulo AND A.funcionario_idfuncionario=$funcionario","",$conn);  

//consulta rol
$rol = busca_filtro_tabla("A.*","dependencia_cargo A","A.funcionario_idfuncionario=$funcionario AND A.estado=1","",$conn);


//extraccion
$cargos=extrae_campo($cargo,"idcargo","U");
$dependencias=extrae_campo($dependencia,"iddependencia","U");
$modulos=extrae_campo($modulo,"idpermiso","U");
$roles = extrae_campo($rol,"iddependencia_cargo","U");


//series asignadas funcionario
$serie_func = busca_filtro_tabla("A.identidad_serie, B.*","entidad_serie A, serie B,entidad C"," A.estado=1 AND B.estado=1 AND C.nombre like 'funcionario' AND A.llave_entidad=$funcionario AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ","B.nombre",$conn);


//series asignadas al cargo
if(@$cargos){
    $serie_cargo = busca_filtro_tabla("A.identidad_serie, B.*","entidad_serie A, serie B,entidad C","A.estado=1 AND B.estado=1 AND C.nombre like 'cargo' AND A.llave_entidad IN(".implode(",",$cargos).") AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ","B.nombre",$conn);   
}else{
    $serie_cargo["numcampos"]=0;     
} 
   
//series asignadas al la dependencia
if(@$dependencias){
    $serie_dependencia = busca_filtro_tabla("A.identidad_serie, B.*","entidad_serie A, serie B,entidad C","A.estado=1 AND B.estado=1 AND C.nombre like 'dependencia' AND A.llave_entidad IN(".implode(",",$dependencias).") AND A.entidad_identidad=C.identidad AND A.serie_idserie=B.idserie ","B.nombre",$conn);    
}else{
    $serie_dependencia["numcampos"]=0;   
}


$serie_f=extrae_campo($serie_func,"idserie","U");
$serie_c=extrae_campo($serie_cargo,"idserie","U");
$serie_d=extrae_campo($serie_dependencia,"idserie","U");
$datos=array();
$datos[0] = array("informacion","","Informaci&oacute;n del Funcionario");
$datos[1] = array("roles","","Listado de Roles (Dependencia-Cargo) ");
$datos[2] = array("permisos","permiso","Listado de Permisos");
$datos[4] = array("series_funcionario","serie","Series Asignadas al Funcionario");
$datos[3] = array("perfil","","Listado de Permisos del Perfil");
$datos["informacion"][0] = $funcionario;
$datos["informacion"]["numcampos"]=1;
$datos["cargos"] = $cargos;
$datos["dependencias"] = $dependencias;
$datos["roles"] = $roles;
$datos["modulos"] = $modulos;
$datos["series"]=busca_series_funcionario($serie_f,$serie_c,$serie_d);
$serie_f1=extrae_campo($serie_func,"identidad_serie","U");
$serie_c1=extrae_campo($serie_cargo,"identidad_serie","U");
$serie_d1=extrae_campo($serie_dependencia,"identidad_serie","U");
$datos["series_funcionario"] = $serie_f1;
$datos["series_cargo"] = $serie_c1;
$datos["series_dependencia"] =$serie_d1; 
return($datos);
}
/* Esat Funcion esta casi lista*/ 
function busca_series_funcionario($serie_f,$serie_c,$serie_d){
global $conn;
$series=array_merge((array)$serie_f,(array)$serie_c,(array)$serie_d);
$series_gen=array_unique($series);
sort($series_gen);
//print_r($series_gen);
return($series_gen);
}

/* Esat Funcion esta casi lista*/
function estilo(){
global $conn;
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); 
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
     <!--INPUT, TEXTAREA, SELECT {
        font-family: Tahoma; 
        font-size: 10px; 
        text-transform:Uppercase;
       } 
       .phpmaker {
       font-family: Verdana; 
       font-size: 9px; 
       text-transform:Uppercase;
       } 
       .encabezado {
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       padding:5px; 
       text-align: left;	
       } 
       .encabezado_list { 
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:".$config[0]["valor"].";
    		text-align: center;
        font-family: Verdana; 
        font-size: 9px;
        text-transform:Uppercase;
        vertical-align:middle;    
    	 }
    	 table tbody td {	
    		font-family: Verdana; 
        font-size: 9px;
    	 }
       -->
       </style>";
  echo $style;
  }
}
/* Esat Funcion esta casi lista*/
function mostrar_informacion_funcionario($funcionario,$acciones){
global $conn;
  echo(estilo());
  $dato=busca_filtro_tabla("funcionario.*,".fecha_db_obtener("fecha_ingreso","Y-m-d")." as fecha_ingreso","funcionario","idfuncionario=".$funcionario,"",$conn);
  if($dato["numcampos"]){
  
    $cadena='<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[0]["nit"].'</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">LOGIN (intranet)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[0]["login"].'</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CLAVE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    ********
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[0]["nombres"].' '.$dato[0]["apellidos"].'
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EMAIL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[0]["email"].'
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[0]["fecha_ingreso"].'
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">';
    switch ($dato[0]["estado"]) {
    	case "1":
		    $sTmp = "Activo";
		  break;
	    case "0":
		    $sTmp = "Inactivo";
		  break;
	   default:
		    $sTmp = "";
    }
    $cadena.=$sTmp;
    $cadena.='</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERFIL DE ACCESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">';
    $nombre_perfil = busca_filtro_tabla("","perfil","idperfil in(".$dato[0]["perfil"].")","",$conn);
		if($nombre_perfil["numcampos"]){
			$perfiles=extrae_campo($nombre_perfil,"nombre");
			$cadena.= implode(", ",$perfiles);
		}
    $cadena.='</span></td>
	</tr>
  </table>';
  }  
  return($cadena);
}
/* Esat Funcion esta casi lista*/
function mostrar_informacion_general($arreglo,$accion,$tabla){
global $conn,$sql;
$cont=0;
$cadena='';
if($accion && is_array($accion))
$cont=count($accion);  
  if(is_array($arreglo))
   $dato=busca_filtro_tabla("*",$tabla,"id$tabla IN(".implode(",",$arreglo).")","",$conn);
      if(@$dato["numcampos"]){
        $cadena='<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
     <tr> 
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>';
        for($j=0;$j<$cont;$j++)
          $cadena.='<td class="encabezado"></td>';
      }
    for($i=0;$i<$dato["numcampos"];$i++){
      $cadena.='<tr>
  		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[$i]["nombre"].'
      </span></td>
  		<td bgcolor="#F5F5F5"><span class="phpmaker">';
  		if(isset($dato[$i]["estado"]))
        switch ($dato[$i]["estado"]) {
        	case "1":
    		    $cadena.= "Activo";
    		  break;
    	    case "0":
    		    $cadena.= "Inactivo";
    		  break;
    	   default:
    		    $cadena.= "";
        }
       $cadena.='</span></td>'; 
      for($j=0;$j<$cont;$j++){
        $cadena.='<td bgcolor="#F5F5F5" >';
        switch($accion[$j]){
          case "adiciona":
            //$cadena.='<a href="'.$tabla.'add.php"' 
          break;
          case "ver":
            $cadena.='<a href="'.$tabla.'view.php?key='.$dato[$i][0].'" target="detalles"><img src="botones/general/ver.png" alt="Ver"   border="0"></a>';
          break;
          default:
          break;
        }
        $cadena.='</td>';
      }  
      $cadena.='</tr>';
    }
    if($dato["numcampos"]){  
      $cadena.='</table>';
    }  
  return($cadena);
}
/* Esta Funcion esta casi lista*/
function mostrar_informacion_roles($arreglo,$accion){
global $conn,$sql;
$cont=0;
$cadena="";
if($accion && is_array($accion))
$cont=count($accion);

if(is_array($arreglo)&&count($arreglo)>0)
 $datos=busca_filtro_tabla("*","dependencia_cargo A","A.iddependencia_cargo IN(".implode(",",$arreglo).")","",$conn);
  if(@$datos["numcampos"]){
    $cadena='<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
     <tr> 
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA</span></td>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO</span></td>
    <!--td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">INICIO <br />DE ACTIVIDADES</span></td>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FINAL <br />DE ACTIVIDADES</span></td-->
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACTIVO</span></td>';
    for($j=0;$j<$cont;$j++)
      $cadena.='<td class="encabezado"></td>';
    for($i=0;$i<$datos["numcampos"];$i++){
      $dato_c=array();
      $dato_d=array();
      $dato_c=busca_filtro_tabla("*","cargo A","A.idcargo=".$datos[$i]["cargo_idcargo"],"",$conn);
      $dato_d=busca_filtro_tabla("*","dependencia A","A.iddependencia=".$datos[$i]["dependencia_iddependencia"],"",$conn);

      if($dato_c["numcampos"] || $dato_d["numcampos"]){
        if($dato_c["numcampos"]){
          if(!$dato_c[0]["estado"]){
            $estado_c='<img src="botones/general/menos.png">';
          }
          else{
            $estado_c='<img src="botones/general/mas.png">';
          }
          if(!$dato_d[0]["estado"]){
            $estado_d='<img src="botones/general/menos.png">';
          }
          else{
            $estado_d='<img src="botones/general/mas.png">';
          }
        }
        $cadena.='<tr>
    		<td bgcolor="#F5F5F5"><span class="phpmaker">'.$estado_d." ".$dato_d[0]["nombre"].'
        </span></td><td bgcolor="#F5F5F5"><span class="phpmaker">'.$estado_c." ".$dato_c[0]["nombre"].'
        </span></td>';
       	if(isset($datos[$i]["estado"])){
      	  $cadena.='<td bgcolor="#F5F5F5" align="center"><span class="phpmaker">';
          switch ($datos[$i]["estado"]) {
          	case "1":
      		    $cadena.= "SI";
      		  break;
      	    case "0":
      		    $cadena.= "NO";
      		  break;
      	   default:
      		    $cadena.= "";
          }
          $cadena.='</span></td>';
        }
        for($j=0;$j<$cont;$j++){
          $cadena.='<td bgcolor="#F5F5F5" >';
          switch($accion[$j]){
            case "editar":
              $cadena.='<a href="dependencia_cargoedit.php?key='.$datos[$i][0].'" target="detalles"><img src="botones/general/editar.png" alt="Editar"  border="0"></a>'; 
            break;
            case "ver":
              $cadena.='<a href="dependencia_cargoview.php?key='.$datos[$i][0].'" target="detalles"><img src="botones/general/ver.png" alt="Ver" border="0"></a>';
            break;
            case "eliminar":
              $cadena.='<a href="dependencia_cargodelete.php?key='.$datos[$i][0].'" target="detalles"><img src="botones/general/borrar.png" alt="Borrar" border="0"></a>';
            break;
            default:
            break;
          }
          $cadena.='</td>';
        } 
        $cadena.='</tr>';
      }  
    }
    $cadena.='</table>';
    }
  return($cadena);
}
/* Esat Funcion esta casi lista*/
function mostrar_informacion_serie($arreglo,$key){
global $conn,$sql;
$cont=2;
$cadena='';

if(@$arreglo[0][0]!=""){
  $dato_f=busca_filtro_tabla("*","entidad_serie","identidad_serie IN(".implode(",",$arreglo[0]).")","",$conn);
  $dato_f["tipo"]="funcionario";
}  
if(@$arreglo[1][0]!=""){
  $dato_c=busca_filtro_tabla("*","entidad_serie","identidad_serie IN(".implode(",",$arreglo[1]).")","",$conn);
  $dato_c["tipo"]="cargo";
}
if(@$arreglo[2][0]!=""){
  $dato_d=busca_filtro_tabla("*","entidad_serie","identidad_serie IN(".implode(",",$arreglo[2]).")","",$conn);
  $dato_d["tipo"]="dependencia";
}
if(@$dato_f["numcampos"]||@$dato_c["numcampos"]||@$dato_d["numcampos"]){
 $cadena='<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
   <tr> 
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACTIVO</span></td>';
  for($j=0;$j<$cont;$j++)
    $cadena.='<td class="encabezado"></td>';
  $cadena.='</tr>';
  if(@$dato_f)
    $cadena.=muestra_serie($dato_f,array("eliminar","ver"));
  if(@$dato_c)  
    $cadena.=muestra_serie($dato_c,array("",""));
  if(@$dato_d)  
    $cadena.=muestra_serie($dato_d,array("",""));
  $cadena.='</table>';
}  
return($cadena);
}
/* Esat Funcion esta casi lista*/
function muestra_serie($dato,$accion){
$cadena='';
global $conn;
if(is_array($accion)){
  $cont=count($accion);
}
/*else {
$accion=array("","","");
$cont=3;
}*/
for($i=0;$i<$dato["numcampos"];$i++){
  $dato_serie=busca_filtro_tabla("*","serie A","A.idserie=".$dato[$i]["serie_idserie"],"",$conn);
  $cadena.='<tr>
	<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato_serie[0]["nombre"].'
  </span></td>
	<td bgcolor="#F5F5F5" align="center"><span class="phpmaker">';
  switch ($dato["tipo"]) {
  	case "funcionario":
	    $cadena.= "F";
	  break;
    case "cargo":
	    $cadena.= "C";
	  break;
    case "dependencia":
	    $cadena.= "D";
	  break;		  
   default:
	    $cadena.= "";
  }
  $cadena.='</span></td>';
 	if(isset($dato[0]["estado"])){
	  $cadena.='<td bgcolor="#F5F5F5" align="center"><span class="phpmaker">';
    switch ($dato[0]["estado"]) {
    	case "1":
		    $cadena.= "SI";
		  break;
	    case "0":
		    $cadena.= "NO";
		  break;
	   default:
		    $cadena.= "";
    }
   $cadena.='</span></td>';
  }
  for($j=0;$j<$cont;$j++){
    $cadena.='<td bgcolor="#F5F5F5" >';
    switch($accion[$j]){
      case "editar":
        $cadena.='<a href="entidad_serieedit.php?key='.$dato[$i][0].'" target="detalles"><img src="botones/general/editar.png" alt="Editar" border="0"></a>'; 
      break;
      case "ver":
        $cadena.='<a href="entidad_serieview.php?key='.$dato[$i][0].'" target="detalles"><img src="botones/general/ver.png" alt="Ver"  border="0"></a>';
      break;
      case "eliminar":
        $cadena.='<a href="entidad_seriedelete.php?key='.$dato[$i][0].'" target="detalles"><img src="botones/general/borrar.png" alt="Borrar"  border="0"></a>';
      break;
      default:$cadena.="";
      break;
    }
    $cadena.='</td>';
  }
  $cadena.='</tr>';
}
return($cadena);   
}
/* Esta Funcion esta casi lista*/
function mostrar_informacion_permisos($funcionario,$tipo,$accion){
global $conn,$sql;
$cont=0;
if(is_array($accion)){
  $cont=count($accion);
}
$cadena="";
if($tipo<>"permiso"){
  $tabla="permiso_perfil";
  $condicion="perfil_idperfil";
  $accion_dato=0;
  $volver="&volver=funcionario";
  $dato_f=busca_filtro_tabla("perfil","funcionario A","A.idfuncionario=".$funcionario,"",$conn);    
}  
else{ 
  $tabla="permiso";
  $condicion="funcionario_idfuncionario";
  $volver="";
  $accion_dato=1;
  $dato_f["numcampos"]=1;
  $dato_f[0][0]=$funcionario;
}    
if($dato_f){
  $dato=busca_filtro_tabla("*",$tabla." A, modulo B","A.modulo_idmodulo=B.idmodulo AND A.".$condicion." in(".$dato_f[0][0].")","",$conn);
  if($dato["numcampos"]){
    $cadena='<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
     <tr>';
    if($accion_dato)
      $cadena.='<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION</span></td>'; 
    $cadena.='<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MODULO</span></td>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MODULO PADRE</span></td>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;"></span></td></tr>';
    /*for($j=0;$j<$cont;$j++)
      $cadena.='<td class="encabezado"></td>';*/
    for($i=0;$i<$dato["numcampos"];$i++){
      $dato_p=array();
      $dato_p["numcampos"]=0;
      $padre="";
      if($dato[$i]["cod_padre"])
        $dato_p=busca_filtro_tabla("*","modulo A","A.idmodulo=".$dato[$i]["cod_padre"],"",$conn);
      if($dato_p["numcampos"]){
        $padre=$dato_p[0]["nombre"];
      }
        $cadena.='<tr>';
        if($accion_dato){
          $cadena.='<td bgcolor="#F5F5F5" align="center"><span class="phpmaker">';
          switch($dato[$i]["accion"]){
            case 1: $imagen_accion="botones/general/mas.png";
            break;
            default: $imagen_accion="botones/general/menos.png";
            break;
          }  
          $cadena.='<img border="0" src="'.$imagen_accion.'"/></span></td>';
        }
    		$cadena.='<td bgcolor="#F5F5F5"><span class="phpmaker">'.$dato[$i]["nombre"].'
        </span></td>
        <td bgcolor="#F5F5F5"><span class="phpmaker">'.$padre.'
        </span></td>';
				if($tabla=="permiso"){
	        for($j=0;$j<$cont;$j++){
	          $cadena.='';
	          switch($accion[$j]){
	            /*case "editar":
	              $cadena.='<td bgcolor="#F5F5F5" ><a href="'.$tabla.'edit.php?key='.$dato[$i][0].$volver.'"  target="detalles"><img src="botones/general/editar.png" alt="Editar"  border="0"></a></td>'; 
	            break;
	            case "ver":
	              $cadena.='<td bgcolor="#F5F5F5" ><a href="'.$tabla.'view.php?key='.$dato[$i][0].$volver.'" target="detalles"><img src="botones/general/ver.png" alt="Ver"  border="0"></a></td>';
	            break;*/
	            case "eliminar":
	              $cadena.='<td bgcolor="#F5F5F5" ><a href="'.$tabla.'delete.php?key='.$dato[$i][0].$volver.'" target="detalles"><img src="botones/general/borrar.png" alt="Borrar" border="0"></a></td>';
	            break;  
	            default:
	            break;
	          }
	        }
        }
        $cadena.='</tr>';
      }  
    $cadena.='</table>';
    }
}
return($cadena);
}
/*
Esta funcion retorna un listado con los datos de funcionarios que cumplen con 
tipo_campo(pertenecen a la dependencia, poseen el cargo,poseen la serie) y su valor
retorna el listado de funcionarios ordenado Ascendentemente
*/
function busca_funcionarios($tipo_dato,$valor){
global $conn;
$larreglo=array();
$lfuncionario=array();
switch($tipo_dato){
  case "cargo":
    $cargo=busca_filtro_tabla("*","cargo A","A.nombre LIKE '".$valor."' and A.estado=1","",$conn);
    $larreglo=extrae_campo($cargo,"idcargo","U");
    if($cargo["numcampos"]){
      $funcionario=busca_filtro_tabla("*","dependencia_cargo A","A.cargo_idcargo IN(".implode(",",$larreglo).") and A.estado=1","",$conn);
      //print_r($funcionario);
      $lfuncionario=extrae_campo($funcionario,"funcionario_idfuncionario","U");
      $nfuncionarios=count($lfuncionario);
      if($nfuncionarios)
        return($lfuncionario);
    }  
    return($larreglo);  
  break;
  case "dependencia":
  
  break;
}

}
function verificar_existencia_funcionario($entidad,$llave_entidad,$funcionario_codigo){
global $conn;
//llave_entidad =-1 es la llave generica es decir cualquiera lo puede hacer
if($llave_entidad==-1)
  return(true);

$condicion='';
switch($entidad){
    case 1://funcionario
        $condicion="funcionario_codigo=".$funcionario_codigo." AND funcionario_codigo In(".$llave_entidad.")";
    break;
    case 2://dependencia
        $condicion='iddependencia IN('.$llave_entidad.") AND funcionario_codigo=".$funcionario_codigo;
    break;
    case 3://ejecutor
    break;
    case 4://cargo
        $condicion='idcargo IN('.$llave_entidad.") AND funcionario_codigo=".$funcionario_codigo;
    break;
    case 5://dependencia cargo
    break;            
}
$dato=busca_filtro_tabla("","vfuncionario_dc",$condicion." AND estado_dc=1 AND estado_dep=1 AND estado=1","",$conn);
//print_r($dato);
//die();
if($dato["numcampos"]){
    return(true);
}
return(false);
}
function listar_funcionarios_existentes($entidad,$llave_entidad){
global $conn;
$condicion='';
$funcionario_codigo=array();
switch($entidad){
    case 1://funcionario
        $condicion="funcionario_codigo IN(".$llave_entidad.")";
    break;
    case 2://dependencia
        $condicion='iddependencia IN('.$llave_entidad.")";
    break;
    case 3://ejecutor
    break;
    case 4://cargo
        $condicion='idcargo IN('.$llave_entidad.")";
    break;
    case 5://dependencia cargo
    break;            
}
$dato=busca_filtro_tabla("","vfuncionario_dc",$condicion." AND estado_dc=1 AND estado_dep=1 AND estado=1","",$conn);
//print_r($dato);
$funcionario_codigo=extrae_campo($dato,"funcionario_codigo");
return($funcionario_codigo);
}
?>