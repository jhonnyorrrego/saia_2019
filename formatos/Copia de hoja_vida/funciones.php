<?php
include_once("../../db.php");
include_once("../librerias/estilo_formulario.php");
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
global $conn;
$hoja_vida=busca_filtro_tabla("","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
$estructura=busca_filtro_tabla("","ft_estructura_hoja_vida","1=1","",$conn);
$texto.='';
$fanexos=72;
$festructura=73;
$adicionar='<img src="../../botones/general/adicionar.png">';
$ver='ver';
if($hoja_vida["numcampos"] && $estructura["numcampos"]){
  $texto='<style >img{border:0px;} text{font-family:verdana;font-size:10px;} table{border-collapse:collapse;empty-cells:show;} td{font-family:verdana;font-size:10px;}</style><table border=1px width="100%"><tr align="center" class="encabezado_list"><td>&nbsp;</td><td>Nombre</td><td>Obligatorio</td><td>Vigencia</td><td>N&uacute;mero<br />Anexos</td><td>Estado<br />(D&iacute;as)</td></tr>';
  for($i=0;$i<$estructura["numcampos"];$i++){
    $vigencia='<img src="../../botones/general/alerta.png" alt="Sin Datos">';
    $estado='<img src="../../botones/general/duda.png">';
    $obliga='<img src="../../botones/general/opcional.png" alt="Opcional">';
    $texto.='<tr>';
    $estado_anexos="";
    $texto.='<td><a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/anexos_hoja_vida/adicionar_anexos_hoja_vida.php?anterior='.$hoja_vida[0]["documento_iddocumento"].'&seleccionado='.$estructura[$i]["idft_estructura_hoja_vida"].'">'.$adicionar.'</a></td>';
    $texto.='<td align="left">';
    if($estructura[$i]["cod_padre"]){
      $texto.="-->";
    }
    $texto.=$estructura[$i]["nombre"].'</td>';
    if($estructura[$i]["obligatoriedad"])
      $obliga='<img src="../../botones/general/obligatorio.png" alt="Obligatorio">';
    $texto.='<td align="center">'.$obliga.'</td>';
    $anexos_estructura=busca_filtro_tabla("*,".resta_fechas('fecha_vigencia','')." AS dias_vigencia","ft_anexos_hoja_vida","ft_hoja_vida=".$hoja_vida[0]["idft_hoja_vida"]." AND estructura=".$estructura[$i]["idft_estructura_hoja_vida"],"fecha_vigencia DESC",$conn);
    if($anexos_estructura["numcampos"]){
      $texto.='<td align="center">';
      for($j=0;$j<$anexos_estructura["numcampos"];$j++){
        //$texto.='<td>Si</td>';
        if($anexos_estructura[$j]["fecha_vigencia"]=='0000-00-00'){
          $vigencia='No vence';
          $estado='<img src="../../botones/general/mas.png">';
        }
        else{
          $vigencia=$anexos_estructura[$j]["fecha_vigencia"];
          if($anexos_estructura[0]["dias_vigencia"]>=0){
            $estado=$anexos_estructura[0]["dias_vigencia"].' <img src="../../botones/general/mas.png">';
          }
          else{
            $estado=$anexos_estructura[$j]["dias_vigencia"].' <img src="../../botones/general/menos.png">';
          }
        }
        $texto.='<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/formatos/anexos_hoja_vida/mostrar_anexos_hoja_vida.php?iddoc='.$anexos_estructura[$j]["documento_iddocumento"].'&idformato='.$fanexos.'" target="_black">'.$vigencia.'</a><br />';
        $tabla_anexos=busca_filtro_tabla("count(*) AS num","anexos","formato=".$fanexos." AND documento_iddocumento=".$anexos_estructura[$j]["documento_iddocumento"],"",$conn);
        if($tabla_anexos[0]["num"]){
          $estado_anexos.='<a href="'.PROTOCOLO_CONEXION.RUTA_PDF.'/anexosdigitales/visor_anexos.php?key='.$anexos_estructura[$j]["documento_iddocumento"].'" target="_blank">'.$tabla_anexos[0]["num"].'</a><br />';
        }
        else{
          $estado_anexos.='Sin Anexos<br />';
        }
      }
    }
    else{
      if($estructura[$i]["obligatoriedad"]){
        $estado='<img src="../../botones/general/menos.png">';
      }
      else
        $estado='<img src="../../botones/general/mas.png">';
      $texto.='<td align="center">'.$vigencia.'</td>';
      //$texto.='<td>---</td>';
    }
    $texto.='<td align="center">'.$estado_anexos.'</td>';
    $texto.='<td align="right">'.$estado.'</td>';
    $texto.='</tr>';
  }
  $texto.='</table>';
}
echo($texto);
}
function foto_hoja_vida($idformato,$iddoc){
global $conn;
  $foto=busca_filtro_tabla("consecutivo,imagen,ruta","pagina","id_documento=".$iddoc,"pagina ASC LIMIT 0,1",$conn);
  if($foto["numcampos"]){
    echo("<img src='../../".$foto[0]["imagen"]."'>");
  }
  else echo("<a href='../../paginaadd.php?key=".$iddoc."&x_enlace=".$_SERVER["PHP_SELF"]."&idformato=".$idformato."&iddoc=$iddoc'>&nbsp;&nbsp;Sin Foto&nbsp;&nbsp;</a>");

}
?>
