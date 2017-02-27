<?php
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

include_once("../db.php");
include_once("../header.php");

include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
?>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
$texto='';
$where="";
if(@$_REQUEST["lgraficos"]){
  $whereg=" AND  idgrafico IN(".$_REQUEST["lgraficos"].")";
}
if(@$_REQUEST["lreportes"]){
  $wherer=" AND  idreporte IN(".$_REQUEST["lreportes"].")";
}
/*graficos_y_reportes*/
$lgraficos=busca_filtro_tabla("g.*,m.nombre as modulo","grafico g,modulo m","modulo_idmodulo=idmodulo and g.estado=1".$whereg,"",$conn);
//print_r($lgraficos);
if(!isset($_REQUEST["lreportes"]))
$texto.="<br /><br />".agrega_boton("texto","","elegir_filtro.php?accion=listar","_self","ADMINISTRACION GRAFICOS Y REPORTES","","adicionar_grafico",1)."";
//$texto.="&nbsp;&nbsp;&nbsp;".agrega_boton("texto","","reporteadd.php","_self","Adicionar Reporte","","adicionar_reporte",1); 

  if($lgraficos["numcampos"] && !isset($_REQUEST["lreportes"])){
    $texto.='<br /><br /><b>Seleccione del listado de graficos </b><br />';
    $texto.='<form name="form_grafico" id="form_grafico" action="graficas.php"><table style="border-collapse:collapse" border="1" width="100%"><tr>';
    $perm=new PERMISO();
    for($i=0;$i<$lgraficos["numcampos"];$i++){
      $ok=FALSE;
      $ok=$perm->acceso_modulo_perfil($lgraficos[$i]["modulo"]);
      if($ok){
      
      $texto.='<td align="center" class="celda_normal" width="20%">'.$lgraficos[$i]["etiqueta"].'</td>
      <td align="center" class="celda_normal" width="5%">
      <a style="cursor:pointer" title="Elegir filtro" href="elegir_filtro.php?id='.$i.'&accion=elegir&tipo=grafico&grafica='.$lgraficos[$i]["idgrafico"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )">Filtro</a>
      </td>
      <td align=center>
      <input type="hidden" name="filtrografico'.$i.'" id="filtro'.$i.'" value="">
      <input type="hidden" name="etiquetasfiltrografico'.$i.'" id="etiquetasfiltrografico'.$i.'" value="">
      <a title="Ver gr&aacute;fico" style="cursor:pointer" onclick="JavaScript:document.getElementById(\'idgrafico\').value='.$lgraficos[$i]["idgrafico"].';document.getElementById(\'filtro_grafico\').value=document.getElementById(\'filtro'.$i.'\').value; document.getElementById(\'etiquetasfiltro_grafico\').value=document.getElementById(\'etiquetasfiltrografico'.$i.'\').value;form_grafico.submit();">
      <img src="../botones/graficos_reportes/'.$lgraficos[$i]["tipo_grafico"].'.png" border="0px"></a></td>';
      if($i>0 && $i%2==0){
        $texto.='</tr><tr>';
       }
      }
    }
    $texto.='</tr></table>
             <input type="hidden" name="idgrafico" id="idgrafico" value="">
             <input type="hidden" name="filtro" id="filtro_grafico" value="">
             <input type="hidden" name="etiquetasfiltro" id="etiquetasfiltro_grafico" value="">
             </form>';
  }
//  $texto.="<hr />";
  $lreporte=busca_filtro_tabla("r.*,m.nombre as modulo","reporte r,modulo m","modulo_idmodulo=idmodulo and r.estado=1".$wherer,"",$conn);
  //print_r($lreporte);
  if($lreporte["numcampos"]){
    $texto.='<br /><br /><b>Seleccione del listado de Reportes</b> <br /><form name="form_reporte" id="form_reporte" method=post action="../exportar_reporte.php">
    <input type="hidden" name="idreporte" id="idreporte" value="">
    <input type="hidden" name="filtro_reporte" id="filtro_reporte" value="">
    <input type="hidden" name="etiquetasfiltroreporte" id="etiquetasfiltroreporte" value="">
    <input type="hidden" name="exportar" id="export" value="">
    <input type="hidden" name="lreportes" id="lreportes" value="'.@$_REQUEST["lreportes"].'">
    <input type="hidden" name="lgraficos" id="lgraficos" value="'.@$_REQUEST["lgraficos"].'">
    <table style="border-collapse:collapse" border="1" width="100%">';
    for($i=0;$i<$lreporte["numcampos"];$i++){
      $ok=FALSE;
      $perm=new PERMISO();   
      $ok=$perm->acceso_modulo_perfil($lreporte[$i]["modulo"]);
      if($ok){
      if($i%2==0){
        $texto.='<tr>';
      }
      $texto.='<td align="center" class="celda_normal" width="20%">'.$lreporte[$i]["nombre"].'
      </td>
      <td align="center" class="celda_normal" width="5%"><a style="cursor:pointer" title="Elegir filtro" href="elegir_filtro.php?id='.$i.'&accion=elegir&tipo=reporte&reporte='.$lreporte[$i]["idreporte"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )">Filtro<input type="hidden" name="filtroreporte'.$i.'" id="filtroreporte'.$i.'" value="">
      <input type="hidden" name="etiquetasfiltroreporte'.$i.'" id="etiquetasfiltroreporte'.$i.'" value=""></a></td>
      <td align="center" class="celda_normal" width="10%">
      <a href="#" onclick="reporte('.$i.',\''.$lreporte[$i]["idreporte"].'\',\'\')"><img src="../botones/graficos_reportes/page_world.png" border="0"></a>
      &nbsp;&nbsp;&nbsp;<a href="#" onclick="reporte('.$i.',\''.$lreporte[$i]["idreporte"].'\',\'word\')"><img src="../botones/graficos_reportes/page_word.png" border="0"></a>
      &nbsp;&nbsp;&nbsp;<a href="#" onclick="reporte('.$i.',\''.$lreporte[$i]["idreporte"].'\',\'excel\')"><img src="../botones/graficos_reportes/page_excel.png" border="0"></a>
      &nbsp;&nbsp;&nbsp;<a href="#" onclick="reporte('.$i.',\''.$lreporte[$i]["idreporte"].'\',\'csv\')"><img src="../botones/graficos_reportes/page_save.png" border="0"></a></td>';
      if($i>0 && $i%4==0){
        $texto.='</tr>';
       }
      }
    }
    $texto.='</table>';
  }
echo($texto);

include_once("../footer.php");
?>
<script>
function reporte(id,reporte,exportar)
{document.getElementById("idreporte").value=reporte;
 document.getElementById("filtro_reporte").value=document.getElementById("filtroreporte"+id).value;
 document.getElementById("export").value=exportar; 
 document.getElementById("etiquetasfiltroreporte").value=document.getElementById("etiquetasfiltroreporte"+id).value;
 form_reporte.submit();
 <?php encriptar_sqli("form_reporte",0,"form_info",$ruta_db_superior); ?>		
		if(salida_sqli){
			form_reporte.submit();
		}
 
}
</script>