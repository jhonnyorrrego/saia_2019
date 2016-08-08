<?php
include_once("db.php");
include_once("header.php");
$listado=array();
if(@$_REQUEST["tipo_modulo"]=="solicitudes"){
$categoria="ninguna";
$perfil=busca_filtro_tabla("lower(dependencia.nombre)","dependencia_cargo,dependencia","dependencia_iddependencia=iddependencia and dependencia.cod_padre=16716 and funcionario_idfuncionario=".usuario_actual("idfuncionario"),"",$conn); 
  
if($perfil["numcampos"])
{if(strpos($perfil[0][0],"administrativa"))
    $categoria="Sistemas_administrativa";
 elseif(strpos($perfil[0][0],"salud"))
    $categoria="Sistemas_salud";
 elseif(strpos($perfil[0][0],"general"))
    $categoria="Mantenimiento_general";
 elseif(strpos($perfil[0][0],"educacion"))
    $categoria="Sistemas_educacion";
}
$adicional="&categoria=".$categoria;
$modulos=busca_filtro_tabla("","modulo","cod_padre=605","orden",$conn);
$items_fila=3;
}
if(@$_REQUEST["tipo_modulo"]=="planes_mejoramiento"){

$perfil=busca_filtro_tabla("lower(dependencia.nombre)","dependencia_cargo,dependencia","dependencia_iddependencia=iddependencia and dependencia.cod_padre=16716 and funcionario_idfuncionario=".usuario_actual("idfuncionario"),"",$conn);
	
	
$adicional="";
$modulos=busca_filtro_tabla("","modulo","cod_padre=765","orden",$conn);
$items_fila=3;
}

$perm=new PERMISO();
$ok=$perm->acceso_modulo_perfil("hallazgos_area_responsable");
if($ok && @$_REQUEST["tipo_modulo"]=="planes_mejoramiento")
{
$texto="<br /><b>HALLAZGOS POR AREA RESPONSABLE:</b>&nbsp;&nbsp;<select id='area_responsable' onchange='if(this.value!=\"\") window.location=\"listado_hallazgos.php?tipo=dependencia&dependencia=\"+this.value;'>
         <option value=''>Seleccionar...</option>";
$dependencias=busca_filtro_tabla("nombre,iddependencia","dependencia","estado=1 and tipo=1","nombre",$conn);
for($i=0;$i<$dependencias["numcampos"];$i++)
   $texto.="<option value='".$dependencias[$i]["iddependencia"]."'>".$dependencias[$i]["nombre"]."</option>";        
$texto.="</select><br /><br />";
}
$texto.='<div align="center"><table border="1px" style="border-collapse:collapse;" cellpadding="20px"><tr>';
for($i=0,$j=0;$i<$modulos["numcampos"];$i++){
  $ok=$perm->acceso_modulo_perfil($modulos[$i]["nombre"]);
  if($ok && $modulos[$i]["enlace"]<>"#"){
    $texto.='<td title="'.$modulos[$i]["ayuda"].'" align="center" ><a href="'.$modulos[$i]["enlace"].$adicional.'" target="'.$modulos[$i]["destino"].'"><b>'.$modulos[$i]["etiqueta"].'</b><br /><br /><img style="width:60px;height:60px;" src="'.$modulos[$i]["imagen"].'" border="0px";></td>';
    $j++;
    if(($j%$items_fila==0) && $j>0){
      $texto.='</tr><tr>';
    }
  }
}
for($j;($j%$items_fila)!=0 && $j>0;$j++){
  $texto.="<td>&nbsp;</td>";
}                    
$texto.='</tr></table></div>';
echo($texto);
include_once("footer.php");
?>