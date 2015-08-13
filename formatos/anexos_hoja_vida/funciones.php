<?php
include_once("../../db.php");
include_once("../../formatos/librerias/funciones_genereales.php");
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
function estructura_hoja_vida($idformato,$iddoc){
global $conn;
if(@$_REQUEST["estructura"]){
  $condicion=" idft_estructura_hoja_vida = ".$_REQUEST["estructura"];
}
else $condicion="1=1";
$hoja=busca_filtro_tabla("","ft_estructura_hoja_vida",$condicion,"",$conn);
$texto='<td> <select name="estructura" id="estructura">';
for($i=0;$i<$hoja["numcampos"];$i++){
  $texto.='<option value="'.$hoja[$i]["idft_estructura_hoja_vida"].'">'.$hoja[$i]["nombre"].'</option>
  ';
}
$texto.='</select></td>';
echo($texto);
}
function digitales_anexos_hoja_vida($idformato,$iddoc){
global $conn,$ruta_db_superior;
$no=1;
$idft_anexos=busca_filtro_tabla("","ft_anexos_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
if($idft_anexos["numcampos"]){
  $digitales=busca_filtro_tabla("","anexos","formato=".$idformato." AND documento_iddocumento=".$iddoc,"",$conn);
  if($digitales["numcampos"]){
  	print_r($digitales);
    $no=0;
    echo("<ol>");
    for($i=0;$i<$digitales["numcampos"];$i++){
      echo('<li><a href="'.$ruta_db_superior.$digitales[$i]["ruta"].'">'.$digitales[$i]["etiqueta"].'</a></li>');
    }
    echo("</ol>");
  }
}
echo('<iframe width="100%" height="100%" src="'.$ruta_db_superior.'anexosdigitales/anexos_documento.php?key='.$ft_anexos[0]["documento_iddocumento"].'&menu=0"></iframe>');
if($no==1)
  echo("No posee documentos digitales");
}
function reasignar_anexos($idformato,$iddoc){
global $conn;
  $texto='';
  $anexos=busca_filtro_tabla("count(*) AS cantidad","anexos","documento_iddocumento=".$iddoc,"",$conn);
  if($anexos["numcampos"] && $anexos[0]["cantidad"]){
    $texto='<a href="reasignar_anexos.php?iddoc='.$iddoc.'&idformato='.$idformato.'">Reasignar Anexos</a>';
  }
  $texto.='<br /><a href="../../paginaadd_anexos.php?iddoc='.$iddoc.'">Adicionar documentos escaneados</a><br />';
  
  /*$texto.='<br /><a href="../../anexosdigitales/anexos_documento_edit.php?key='.$iddoc.'&idformato='.$idformato.'&idcampo=884">Adicionar digitales</a><br />';*/
  
$texto.='<a <a href="../../anexosdigitales/anexos_documento_edit.php?key='.$iddoc.'&idformato='.$idformato.'&idcampo=884"class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width:400, height:400,preserveContent:false } )"style="text-decoration: underline; cursor:pointer;">Adicionar digitales</a><br>';
echo($texto);
}
function adicionar_estructura_seleccionada_hv($idformato,$iddoc){
global $conn;
$texto='<td><select name="estructura" id="estructura" class="required">';
$datos=busca_filtro_tabla("","ft_estructura_hoja_vida","1=1","",$conn);
for($i=0;$i<$datos["numcampos"];$i++){
  $texto.='<option value="'.$datos[$i]["idft_estructura_hoja_vida"].'"';
  if(@$_REQUEST["seleccionado"]==$datos[$i]["idft_estructura_hoja_vida"])
    $texto.=" SELECTED ";
  $texto.='>'.$datos[$i]["nombre"].'</option>';  
}
$texto.="</select></td>";
echo($texto);
}

function mostrar_datos_estructura($idformato,$iddoc)
{ global $conn;
  $estruc = busca_filtro_tabla("estructura","ft_anexos_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
  $datos_estruc = busca_filtro_tabla("if(obligatoriedad>0,'Si','No') as obligatoriedad,nombre,caracteristicas,cod_padre","ft_estructura_hoja_vida","idft_estructura_hoja_vida=".$estruc[0]["estructura"],"",$conn);
  if($datos_estruc["numcampos"]>0)
  echo '<table border="1" width="100%"><tr><td colspan=6>Datos de la Estructura</td></tr>
        <tr><td>Nombre</td><td>'.$datos_estruc[0]["nombre"].'</td></tr>
        <tr><td>Codigo del Padre</td><td>'.$datos_estruc[0]["cod_padre"].'</td></tr>
        <tr><td>Caracteristicas</td><td>'.htmlspecialchars_decode($datos_estruc[0]["caracteristicas"]).'</td></tr>
        <tr><td>Obligatoriedad</td><td>'.$datos_estruc[0]["obligatoriedad"].'</td></tr>
        </table>'; 
}

function ver_anexos_hoja($idformato,$iddoc)
{ global $conn;


  $digitales=busca_filtro_tabla("","anexos","campos_formato=884 and formato=".$idformato." AND documento_iddocumento=".$iddoc,"",$conn);
  if($digitales["numcampos"]){
    
    echo("<table border='0' cellspacing=0 cellpadding=0 >
<tr>
<td>Anexos Digitales:</td></tr>");
    for($i=0;$i<$digitales["numcampos"];$i++){
    $objeto='<img name="permisos" src="../../botones/anexos/application_delete.png">'; 
      echo('<tr><td>'.$digitales[$i]["etiqueta"].'</td><td>
<a href="../../anexosdigitales/parsea_accion_archivo.php?idanexo='.$digitales[$i]["idanexos"].'&accion=descargar" ><img src="../../botones/anexos/application.png" /></a><td>');
$ok=FALSE;
$perm=new PERMISO();
$ok=$perm->permiso_usuario("eliminar_anexos_hojas_vida","");

if($ok){
 echo('<td><div class="textwrapper">
		<a href="../../anexosdigitales/borrar_anexos.php?idanexo='.$digitales[$i]["idanexos"].'" id="el_'.$digitales[$i]["idanexos"].'" class="highslide" onclick="return hs.htmlExpand( this, {
		objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
		outlineWhileAnimating: true, preserveContent: false, width: 250 } )">'.$objeto.'</a>
		</div></td></tr>');
		}
    }
    echo('</table>');
  }


} 
?>
