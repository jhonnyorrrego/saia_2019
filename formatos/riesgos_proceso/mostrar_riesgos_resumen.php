<?php
include_once("../librerias/funciones_generales.php");
include_once('../librerias/estilo_formulario.php');
  
if ($_REQUEST["export"] == "excel"){
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=listado.xls");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}
elseif ($_REQUEST["export"] == "word"){
	header('Content-Type: application/vnd.ms-word');
	header("Content-Disposition: attachment; filename=listado.doc");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}
elseif(@$_REQUEST["export"] == ""){
include ("../../header.php");
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<style>
.alineados{
  padding: 0;
  margin: 0;
  border: 0;
  background-color:#CCCCCC;
  text-shadow: #333 1px 1px 3px;
  text-align: center;
  cursor: pointer;
  display:inline;
}
</style>
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<form name='form1' id='form1' method='post'><p><br /><a href="mostrar_riesgos_resumen.php?llave=<?php echo(@$_REQUEST["llave"]);?>">VER COMO LISTADO</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="previo_mostrar_riesgos_proceso.php?llave=<?php echo(@$_REQUEST["llave"]);?>">VER COMO CUADRO DE MANDO</a>&nbsp;&nbsp;

<a href='#' onclick='exportar("word")' title='Exportar a word'><img src='../../botones/graficos_reportes/page_word.png' border='0'></a>
&nbsp;&nbsp;
<a href='#' onclick='exportar("excel")' title='Exportar a excel'><img src='../../botones/graficos_reportes/page_excel.png' border='0'></a>
   
     <input type="hidden" name="export" id="export" value="">
     
     <script>
     function exportar(tipo)
     {if(tipo=='pdf')
        {window.open("../../html2ps/public_html/demo/html2ps.php?resumen_riesgos=1&llave=<?php echo(@$_REQUEST["llave"]);?>");
        }
      else{  
        document.getElementById("export").value=tipo;
        form1.submit();
       } 
     }
     </script>
     </p> 
<?php
}
echo listar_riesgos();

function listar_riesgos(){
global $conn;
$datos=explode("-",$_REQUEST["llave"]);
$formato_hallazgo=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_riesgos_proceso'","",$conn);
$hallazgos=busca_filtro_tabla("",$formato_hallazgo[0]["nombre_tabla"],"ft_proceso=".$datos[2]." and estado<>'INACTIVO'","consecutivo",$conn);

if($hallazgos["numcampos"]){
  $texto="";
  $texto.='<table class="tabla_borde" border="1px">';
  $texto.='<thead><tr>';
  if (@$_REQUEST["export"] == "")
  $texto.='<td class="encabezado_list" valign="middle">
&nbsp;
</td>';
  $texto.='<td class="encabezado_list" valign="middle">
N&uacute;mero
</td><td class="encabezado_list" valign="middle">
Actividad
</td>
<td class="encabezado_list" valign="middle">
Area Responsable
</td>
<td class="encabezado_list" valign="middle">
Descripcion
</td>
<td class="encabezado_list" valign="middle">
Fuente/ Causa
</td>
<td class="encabezado_list" valign="middle">
Consecuencia
</td>
<td class="encabezado_list" valign="middle">
Controles Existentes
</td>
<td class="encabezado_list" valign="middle">
Probabilidad
</td>
<td class="encabezado_list" valign="middle">
Impacto
</td>
<td class="encabezado_list" valign="middle">
Da&ntilde;o
</td>
<td class="encabezado_list" valign="middle">
Opciones de Manejo
</td>
<td class="encabezado_list" valign="middle">
Acciones
</td>
<td class="encabezado_list" valign="middle">
Responsables
</td>
<td class="encabezado_list" valign="middle">
Conograma
</td>
<td class="encabezado_list" valign="middle">
Indicador
</td>';
if (@$_REQUEST["export"] == "")
$texto.='<td class="encabezado_list" valign="middle">
&nbsp;
</td>';
$texto.='</tr>
</thead><tbody style="overflow:auto;">';
$ingresa=0;
  for($i=0;$i<$hallazgos["numcampos"];$i++){
    $rotulo=validar_cuadrante($hallazgos[$i]["documento_iddocumento"]);
    $seguimiento[0]["total_porcentaje"]=0;
    $seguimiento=busca_filtro_tabla("A.*","ft_seguimiento_riesgo A","A.ft_riesgos_proceso=".$hallazgos[$i]["idft_riesgos_proceso"],"idft_seguimiento_riesgo DESC",$conn);
    $texto.='<tr>';

    if (@$_REQUEST["export"] == "")
    $texto.='<td class="transparente"><a href="../riesgos_proceso/mostrar_riesgos_proceso.php?iddoc='.$hallazgos[$i]["documento_iddocumento"].'&idformato='.$formato_hallazgo[0]["idformato"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'".'iframe'."'".',width: 500, height:400 } )">Ver</a></td>';
    $texto.='<td align="center">'.$hallazgos[$i]["consecutivo"].'</td>';    
    $texto.='<td class="transparente">'.mostrar_valor_campo("nombre",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo('area_responsable',$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("descripcion",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("fuente_causa",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("consecuencia",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("controles",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("probabilidad",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("impacto",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente" style="width:100%; height=100%; background-color:'.$rotulo["color"].';">'.$rotulo["nombre"].'</td><td class="transparente">'.mostrar_valor_campo("opciones_manejo",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("acciones",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo('responsables',$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td><td class="transparente">'.mostrar_valor_campo("cronograma",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td>'.'</td><td class="transparente">'.mostrar_valor_campo("indicador",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["documento_iddocumento"],1).'</td>';
  if (@$_REQUEST["export"] == ""){  
    if($seguimiento["numcampos"]){
      $texto.='<td class="transparente" align="center"><a href="listado_seguimientos_riesgos_proceso.php?idriesgo='.$hallazgos[$i]["idft_riesgos_proceso"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'".'iframe'."'".',width: 400, height:250 } )">Seguimientos</a></td>';
    }
    else $texto.='<td class="transparente">&nbsp;</td>';
    $texto.='</tr>';
   } 
  }
  $texto.='</tbody></table></div>';
}
echo($texto_enlaces.$texto);
}
include ("../../footer.php");
function validar_cuadrante($iddoc)
{
 $valores=recalcular_valores($iddoc);

 $total=$valores["impacto"]*$valores["probabilidad"];
switch($total)
{case 5:
  $rotulo=array("color"=>"#CCFF66","nombre"=>"Riesgo Aceptable");
  break;
 case 10: 
  $rotulo=array("color"=>"#71cc1e","nombre"=>"Riesgo Tolerable");
  break;
 case 15:    
  $rotulo=array("color"=>"yellow","nombre"=>"Riesgo Moderado");
  break;
 case 20:    
  $rotulo=array("color"=>"#FFCC00","nombre"=>"Riesgo Moderado");
  break; 
 case 30:    
  $rotulo=array("color"=>"#FFC0A0","nombre"=>"Riesgo Importante");
  break; 
 case 40:    
  $rotulo=array("color"=>"#FF6060","nombre"=>"Riesgo Importante");
  break; 
 case 60:    
  $rotulo=array("color"=>"red","nombre"=>"Riesgo Inaceptable");
  break; 
}                 
return($rotulo);
}
function recalcular_valores($iddoc=NULL)
{if($iddoc==NULL)
   $riesgos=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=".$_REQUEST["anterior"],"",$conn); 
 else
   $riesgos=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn); 
 $seguimientos=busca_filtro_tabla("b.*","ft_seguimiento_riesgo b,documento c","b.ft_riesgos_proceso=".$riesgos[0]["idft_riesgos_proceso"]." AND b.documento_iddocumento=c.iddocumento and c.estado<>'ELIMINADO'","iddocumento asc",$conn);
 // print_r($riesgos);
  if($seguimientos["numcampos"]){ 
   for($j=0;$j<$seguimientos["numcampos"];$j++) 
    {if(/*$seguimientos[$j]["aplican"]&&$seguimientos[$j]["minimiza"]&&*/$seguimientos[$j]["probabilidad"]<>2)                                                
       {if($seguimientos[$j]["probabilidad"]==1 && $riesgos[0]["probabilidad"]>1)
         $riesgos[0]["probabilidad"]--;
        elseif($seguimientos[$j]["probabilidad"]==3 && $riesgos[0]["probabilidad"]<3) 
         $riesgos[0]["probabilidad"]++;
       }  
     if(/*$seguimientos[$j]["aplican"]&&$seguimientos[$j]["minimiza"]&&*/$seguimientos[$j]["impacto"]<>2) 
       {if($seguimientos[$j]["impacto"]==1 && $riesgos[0]["impacto"]>5)
          $riesgos[0]["impacto"]/=2;
        elseif($seguimientos[$j]["impacto"]==3 && $riesgos[0]["impacto"]<20) 
          $riesgos[0]["impacto"]*=2;
       } 
    }
    
  }
  //print_r($riesgos);
 return(array("impacto"=>$riesgos[0]["impacto"],"probabilidad"=>$riesgos[0]["probabilidad"])); 
} 
?>
