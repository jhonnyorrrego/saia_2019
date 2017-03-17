<?php
include_once("../../db.php");
?>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
$listado_estructuras=array();
function documentos_vinculados_hoja_vida($idformato,$iddoc){
global $conn,$listado_estructuras;
/*$hijos=busca_filtro_tabla("","respuesta","origen=".$iddoc,"",$conn);
for($h=0;$h<$hijos["numcampos"];$h++){*/
$formato_estructura=71;
$papa=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$condicion="1=1";
if($papa["numcampos"]){
  echo('<spam >');  
  listado_estructuras($papa[0]["idft_hoja_vida"],1);
  listado_estructuras($papa[0]["idft_hoja_vida"],0); 
  if(count($listado_estructuras))
    $condicion="idft_estructura_hoja_vida NOT IN(".implode(",",array_unique($listado_estructuras)).")";
  $estructura=busca_filtro_tabla("","ft_estructura_hoja_vida",$condicion,"obligatoriedad DESC",$conn);
  $texto="<br /><br />Listado de Documentos Obligatorios Pendientes:<br />";
  $obligatorio=0;
  for($i=0;$i<$estructura["numcampos"];$i++){
    if(!$estructura[$i]["obligatoriedad"] && !$obligatorio){
      $texto.="<br /><br /> Listado de Documentos no obligatorios Pendientes:<br />";
      $obligatorio=1;
    }
    $texto.='<br /><a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/anexos_hoja_vida/adicionar_anexos_hoja_vida.php?anterior='.$papa[0]["documento_iddocumento"].'&seleccionado='.$estructura[$i]["idft_estructura_hoja_vida"].'">'.mostrar_valor_campo("nombre",$formato_estructura,$estructura[$i]["documento_iddocumento"],1).'</a><br />';
  }
  echo($texto);
  echo('</spam>');
}

}
//tipo=1 estructura valida
//tipo=0 estructura vencida
function listado_estructuras($id,$tipo){
global $conn,$listado_estructuras;
  $texto="";
  $campos=array("estructura","fecha_vigencia","descripcion");
  $tabla="ft_anexos_hoja_vida";
  $campo_enlace="ft_hoja_vida";
  $llave=$id;
  $orden="GROUP BY estructura ";
  $where="";
  $titulo="<br />Lista de Documentos Correctamente Diligenciados:<br />";
if($tipo){
  $where_hijo=" AND (fecha_vigencia >'".date("Y-m-d")."' OR fecha_vigencia = '0000-00-00')";
  
}
else{ 
  $where_hijo=" AND (fecha_vigencia <'".date("Y-m-d")."' AND fecha_vigencia <> '0000-00-00') AND (estructura NOT IN (".implode(",",array_unique($listado_estructuras))."))";
  $titulo="<br />Listado de documentos Vencidos:<br />";  
}
if(count($campos)){
    $where.=" AND A.nombre IN('".implode("','",$campos)."')";
  }
  $lcampos=busca_filtro_tabla("A.*,B.idformato","campos_formato A,formato B","B.nombre_tabla LIKE '".$tabla."' AND A.formato_idformato=B.idformato".$where,"A.orden",$conn);
  $hijo=busca_filtro_tabla("",$tabla,$campo_enlace."=".$llave.$where_hijo,$orden,$conn);
  //print_r($hijo);
  if($hijo["numcampos"] && $lcampos["numcampos"]){
    $texto=$titulo.'<table class="tabla_borde" border="1" width="100%"><tr class="encabezado_list">';
    for($j=0;$j<$lcampos["numcampos"];$j++){
      $texto.='<td>'.ucfirst($lcampos[$j]["etiqueta"])."</td>";
    }
    $texto.="<td>&nbsp;</td></tr>";
    for($i=0;$i<$hijo["numcampos"];$i++){
      $texto.='<tr class="celda_transparente">';
      for($j=0;$j<$lcampos["numcampos"];$j++){
        $texto.='<td align="center">'.mostrar_valor_campo($lcampos[$j]["nombre"],$lcampos[$j]["formato_idformato"],$hijo[$i]["documento_iddocumento"],1)."</td>";
      }
      $texto.='<td><a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/anexos_hoja_vida/mostrar_anexos_hoja_vida.php?idformato='.$lcampos[0]["formato_idformato"].'&iddoc='.$hijo[$i]["documento_iddocumento"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'".'iframe'."'".',width: 400, height:250 } )">ver</a></td>';
      array_push($listado_estructuras,$hijo[$i]["estructura"]);
      $texto.='</tr>';
    }
    $texto.='</table>';
  }
echo($texto);
}
?>
