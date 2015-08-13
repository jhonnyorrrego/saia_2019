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
<style>
table{
  border:1px solid;
  border-collapse:collapse;
}
tr {
  border:1px solid;
  border-collapse:collapse;
}
td {
  border:1px solid;
  border-collapse:collapse;
}

</style>
<?php
$norma=busca_filtro_tabla("a.*","ft_norma_proceso a, documento b","b.iddocumento=a.documento_iddocumento  and b.estado<>'ELIMINADO' and a.ft_proceso=".$_REQUEST["idproceso"],"",$conn);
imprime_normas_secretaria($norma,"NORMOGRAMA DEL PROCESO");
imprime_normas_etiqueta($norma);
$norma=busca_filtro_tabla("a.*","ft_norma_procedimiento a,ft_procedimiento b,documento c, documento d","c.iddocumento=a.documento_iddocumento and d.iddocumento=b.documento_iddocumento  and d.estado<>'ELIMINADO' and c.estado<>'ELIMINADO' and a.ft_procedimiento=idft_procedimiento and b.ft_proceso=".$_REQUEST["idproceso"],"",$conn);
imprime_normas_procedimiento($norma,"NORMOGRAMA DE LOS PROCEDIMIENTOS");
echo '<br /><b>Convenci&oacute;n</b><br /><img src="../../js/imgs/guia.gif" />Norma Interna <img src="../../js/imgs/manual.gif" />Norma Externa';
function imprime_normas_secretaria($norma,$titulo){
$lsecretarias=array();
if($norma["numcampos"]){
  $arreglo1=explode(',',implode(",",extrae_campo($norma,"secretarias","U")));
  $lsecretarias=array_unique($arreglo1,SORT_STRING);
  sort($lsecretarias);
  $texto='<table width="100%"><tr class="encabezado_list"><td colspan=2><b>'.$titulo.'</b></td></tr>';
  $items_fila=2;
  for($i=0;$i<count($lsecretarias) && $lsecretarias[$i]!="";$i++){
    $dep=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("d","",$lsecretarias[$i]),"",$conn);
  $texto.='<tr><td colspan="'.$items_fila.'" align="center" border="1px"><br /><br /><b>'.strtoupper($dep[0]["nombre"]).'</b><br /><br /></td></tr><tr>';
  $encontrados=array();
  for($k=0;$k<$norma["numcampos"];$k++)
   {$secretarias=explode(",",$norma[$k]["secretarias"]);
    if(in_array($lsecretarias[$i],$secretarias)){ 
    $anexos=busca_filtro_tabla("a.idanexos,a.etiqueta,a.tipo,ruta,a.documento_iddocumento,a.formato,b.tipo as tiponorma","anexos a,ft_norma_calidad b","a.documento_iddocumento=b.documento_iddocumento and idanexos in(".$norma[$k]["normograma"].")","",$conn);
    
    if($anexos["numcampos"]){
      
      for($h=0,$j=0;$h<$anexos["numcampos"];$h++){      
       if(!in_array($anexos[$h]["idanexos"],$encontrados)){ 
        $llave=file_exists('../../imagenes/iconos_extensiones/'.strtoupper($anexos[$h]["tipo"]).'.png');
        if($llave)
          $imagen='../../imagenes/iconos_extensiones/'.strtoupper($anexos[$h]["tipo"]).'.png';
        else $imagen='../../imagenes/iconos_extensiones/Default.png';  
        if(strtolower($anexos[$h]["tiponorma"])=="interno")
          $tiponorma="<img src='../../js/imgs/guia.gif' border=0 width=\"20px\" />";
        else
          $tiponorma="<img src='../../js/imgs/manual.gif' border=0 width=\"20px\" />";  
        $texto.='<td border="1px" title="'.$anexos[$h]["etiqueta"].'" align="left" width="'.(100/$items_fila).'%"><div style="float:left"><a href="../../formatos/norma_calidad/mostrar_norma_calidad.php?iddoc='.$anexos[$h]["documento_iddocumento"].'&idformato='.$anexos[$h]["formato"].'" onclick=\'return hs.htmlExpand(this, { objectType: "iframe",width: 550, height:500,preserveContent:false } )\'>'.$tiponorma.'<img src="../../botones/general/buscar.png" border="0px"></a></div><a href="'.PROTOCOLO_CONEXION.RUTA_PDF."/".$anexos[$h]["ruta"].'" target="_blank"><img width="16px" src="'.$imagen.'" border="0px"; align="left"><b>'.delimita($anexos[$h]["etiqueta"],40).'</b><br /><br /></td>';
        $j++;
        if(($j%$items_fila==0) && $j>0){
          $texto.='</tr><tr>';
        }
       $encontrados[]=$anexos[$h]["idanexos"];
      }
      }
     }
    }
     $texto.='</tr>';
   } 
  }
  $texto.='</table>';
}  
echo($texto);
}

function imprime_normas_procedimiento($norma,$titulo){
$lsecretarias=array();
if($norma["numcampos"]){
  $arreglo1=explode(',',implode(",",extrae_campo($norma,"ft_procedimiento","U")));
  $procedimientos=array_unique($arreglo1,SORT_STRING);
  sort($procedimientos);

  $texto='<table width="100%"><tr class="encabezado_list"><td colspan=2><b>'.$titulo.'</b></td></tr>';
  $items_fila=2;
  for($i=0;$i<count($procedimientos);$i++){
    $dep=busca_filtro_tabla("nombre","ft_procedimiento","idft_procedimiento=".$procedimientos[$i],"",$conn);
   
  $texto.='<tr><td colspan="'.$items_fila.'" align="center" border="1px"><br /><br /><b>'.mayusculas($dep[0]["nombre"]).'</b><br /><br /></td></tr><tr>';
  $encontrados=array();
  for($k=0;$k<$norma["numcampos"];$k++)
   {if($norma[$k]["ft_procedimiento"]==$procedimientos[$i]){ 
    //$anexos=busca_filtro_tabla("idanexos,etiqueta,tipo,ruta,documento_iddocumento,formato","anexos","idanexos in(".$norma[$k]["normograma"].")","",$conn);
    $anexos=busca_filtro_tabla("a.idanexos,a.etiqueta,a.tipo,a.ruta,a.documento_iddocumento,a.formato,b.tipo as tiponorma","anexos a,ft_norma_calidad b","a.documento_iddocumento=b.documento_iddocumento and idanexos in(".$norma[$k]["normograma"].")","",$conn);
    if($anexos["numcampos"]){
      
      for($h=0,$j=0;$h<$anexos["numcampos"];$h++){      
       if(!in_array($anexos[$h]["idanexos"],$encontrados)){ 
        $llave=file_exists('../../imagenes/iconos_extensiones/'.strtoupper($anexos[$h]["tipo"]).'.png');
        if($llave)
          $imagen='../../imagenes/iconos_extensiones/'.strtoupper($anexos[$h]["tipo"]).'.png';
        else $imagen='../../imagenes/iconos_extensiones/Default.png';  
        if(strtolower($anexos[$h]["tiponorma"])=="interno")
          $tiponorma="<img src='../../js/imgs/guia.gif' border=0 width=\"20px\" />";
        else
          $tiponorma="<img src='../../js/imgs/manual.gif' border=0 width=\"20px\" />";  
        $texto.='<td border="1px" title="'.$anexos[$h]["etiqueta"].'" align="left" width="'.(100/$items_fila).'%"><div style="float:left"><a href="../../formatos/norma_calidad/mostrar_norma_calidad.php?iddoc='.$anexos[$h]["documento_iddocumento"].'&idformato='.$anexos[$h]["formato"].'" onclick=\'return hs.htmlExpand(this, { objectType: "iframe",width: 550, height:500,preserveContent:false } )\'>'.$tiponorma.'<img src="../../botones/general/buscar.png" border="0px"></a></div><a href="'.PROTOCOLO_CONEXION.RUTA_PDF."/".$anexos[$h]["ruta"].'" target="_blank"><img width="16px" src="'.$imagen.'" border="0px"; align="left"><b>'.delimita($anexos[$h]["etiqueta"],40).'</b><br /><br /></td>';
        $j++;
        if(($j%$items_fila==0) && $j>0){
          $texto.='</tr><tr>';
        }
       $encontrados[]=$anexos[$h]["idanexos"];
      }
      }
     }
    }
     $texto.='</tr>';
   } 
  }
  $texto.='</table>';
}  
echo($texto);
}

function imprime_normas_etiqueta($norma){
$lsecretarias=array();
if($norma["numcampos"]){
  $texto='<table width="100%"><tr ><td colspan=2><b></b></td></tr>';
  $items_fila=2;
  
  $encontrados=array();
  for($k=0;$k<$norma["numcampos"];$k++)
   {//$anexos=busca_filtro_tabla("idanexos,etiqueta,tipo,ruta","anexos","idanexos in(".$norma[$k]["normograma"].")","",$conn);
     $anexos=busca_filtro_tabla("a.idanexos,a.etiqueta,a.tipo,a.ruta,b.tipo as tiponorma","anexos a,ft_norma_calidad b","a.documento_iddocumento=b.documento_iddocumento and idanexos in(".$norma[$k]["normograma"].")","",$conn);
    if($anexos["numcampos"]&&$norma[$k]["etiqueta"]<>""){
     $texto.='<tr><td colspan="'.$items_fila.'" align="center" border="1px"><b>'.strtoupper($norma[$k]["etiqueta"]).'</b></td></tr><tr>'; 
      for($h=0,$j=0;$h<$anexos["numcampos"];$h++){      
       if(!in_array($anexos[$h]["idanexos"],$encontrados)){ 
        $llave=file_exists('../../imagenes/iconos_extensiones/'.strtoupper($anexos[$h]["tipo"]).'.png');
        if($llave)
          $imagen='../../imagenes/iconos_extensiones/'.strtoupper($anexos[$h]["tipo"]).'.png';
        else $imagen='../../imagenes/iconos_extensiones/Default.png';  
        if(strtolower($anexos[$h]["tiponorma"])=="interno")
          $tiponorma="<img src=\"../../js/imgs/guia.gif\" border=0 width=\"20px\"/>";
        else
          $tiponorma="<img src=\"../../js/imgs/manual.gif\" border=\"0\" width=\"20px\" />"; 
        $texto.='<td border="1px" title="'.$anexos[$h]["etiqueta"].'" align="left" width="'.(100/$items_fila).'%"><a '.PROTOCOLO_CONEXION.RUTA_PDF."/".$anexos[$h]["ruta"].'" target="_blank">'.$tiponorma.'<img width="16px" src="'.$imagen.'" border="0";  /><b>'.delimita($anexos[$h]["etiqueta"],40).'</b><br /><br /></td>';
        $j++;
        if(($j%$items_fila==0) && $j>0){
          $texto.='</tr><tr>';
        }
       $encontrados[]=$anexos[$h]["idanexos"];
      }
      }    
     }
     $texto.='</tr>';
   } 
  $texto.='</table>';
}  
echo($texto);
}
?>
