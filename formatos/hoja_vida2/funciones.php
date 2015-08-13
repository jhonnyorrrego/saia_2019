<?php
include_once("../../db.php");
include_once("../librerias/estilo_formulario.php");
include_once("../librerias/funciones_generales.php");
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
    $texto.='<td><a href="../anexos_hoja_vida/adicionar_anexos_hoja_vida.php?anterior='.$hoja_vida[0]["documento_iddocumento"].'&seleccionado='.$estructura[$i]["idft_estructura_hoja_vida"].'">'.$adicionar.'</a></td>';
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
        $texto.='<a href="../anexos_hoja_vida/mostrar_anexos_hoja_vida.php?iddoc='.$anexos_estructura[$j]["documento_iddocumento"].'&idformato='.$fanexos.'"  target="_blank">'.$vigencia.'</a><br />';
        $tabla_anexos=busca_filtro_tabla("count(*) AS num","anexos","formato=".$fanexos." AND documento_iddocumento=".$anexos_estructura[$j]["documento_iddocumento"]." and estado_anexo=1","",$conn);
        if($tabla_anexos[0]["num"]){
          $estado_anexos.='<a href="#" onclick=\'window.open("../../anexosdigitales/visor_anexos.php?key='.$anexos_estructura[$j]["documento_iddocumento"].'&user='.$_SESSION["usuario_actual"].'","Anexos","width=700,height=650,status=YES,location=YES,Resizable=YES,Scrollbars=YES")\';>'.$tabla_anexos[0]["num"].'</a><br />';
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
  $foto=busca_filtro_tabla("consecutivo,imagen,ruta","pagina","id_documento=".$iddoc,"pagina DESC LIMIT 0,1",$conn);
  if($foto["numcampos"]){
    echo("<a href='../../paginaadd.php?key=".$iddoc."&x_enlace=".$_SERVER["PHP_SELF"]."&idformato=".$idformato."&iddoc=$iddoc'><img src='../../".$foto[0]["imagen"]."'></a>");
  }
  else echo("<a href='../../paginaadd.php?key=".$iddoc."&x_enlace=".$_SERVER["PHP_SELF"]."&idformato=".$idformato."&iddoc=$iddoc'>&nbsp;&nbsp;Sin Foto&nbsp;&nbsp;</a>");
}

function editar_foto_hoja_vida($idformato,$iddoc,$indice=0){
global $menu2;
$texto="<a href='../../paginaadd.php?key=".$iddoc."&x_enlace=".$_SERVER["PHP_SELF"]."&idformato=".$idformato."&iddoc=$iddoc'>&nbsp;&nbsp;Editar foto&nbsp;&nbsp;</a>";
echo($texto);
}

function menu_hoja_vida($idformato,$iddoc){
global $conn,$menu2;
$menu=busca_filtro_tabla("","modulo","nombre LIKE 'hojas_vida_menu'","",$conn);
if($menu["numcampos"]){
  $menu2=busca_filtro_tabla("","modulo","cod_padre=".$menu[0]["idmodulo"],"orden",$conn);
  if($menu2["numcampos"]){
    $ok=FALSE;
    $perm=new PERMISO();
    echo ('<table border="1"><tr>');
    for($i=0;$i<$menu2["numcampos"];$i++){
      $ok=$perm->permiso_usuario($menu2[$i]["nombre"],"");      
      if($ok && $menu2[$i]["parametros"]!=""){      
        echo('<td>');
          call_user_func_array($menu2[$i]["parametros"],array($idformato,$iddoc,$i));
        echo('</td>');
      }
    }
    echo('</tr></table>');
  }
}
//actualizar_pantalla($idformato,$iddoc);
}
function recargar_hoja_vida($idformato,$iddoc,$indice=0){
global $menu2;
$texto="<a href='../hoja_vida/mostrar_hoja_vida.php?idformato=".$idformato."&iddoc=$iddoc'>&nbsp;&nbsp;Recargar&nbsp;&nbsp;</a>";
echo($texto);
}

function anterior_hoja_vida($idformato,$iddoc,$indice=0)
{ global $conn,$menu2;
  $actual = busca_filtro_tabla("idft_hoja_vida","ft_hoja_vida","documento_iddocumento=$iddoc","",$conn);
  $ant = busca_filtro_tabla("documento_iddocumento","ft_hoja_vida","idft_hoja_vida=".($actual[0]["idft_hoja_vida"]-1),"",$conn);
  if($ant["numcampos"]>0)
    echo "<a href='mostrar_hoja_vida.php?idformato=".$idformato."&iddoc=".$ant[0]["documento_iddocumento"]."'>Anterior</a>&nbsp;&nbsp;";
}
function siguiente_hoja_vida($idformato,$iddoc,$indice=0)
{ global $conn,$menu2;
  $actual = busca_filtro_tabla("idft_hoja_vida","ft_hoja_vida","documento_iddocumento=$iddoc","",$conn);
  $sig = busca_filtro_tabla("documento_iddocumento","ft_hoja_vida","idft_hoja_vida=".($actual[0]["idft_hoja_vida"]+1),"",$conn);
  if($sig["numcampos"]>0)
    echo "<a href='mostrar_hoja_vida.php?idformato=".$idformato."&iddoc=".$sig[0]["documento_iddocumento"]."'>Siguiente</a>&nbsp;&nbsp;";
}
function editar_hoja_vida($idformato,$iddoc,$indice=0){
global $menu2;
$texto="<a href='../hoja_vida/editar_hoja_vida.php?idformato=".$idformato."&iddoc=$iddoc'>&nbsp;&nbsp;Editar&nbsp;&nbsp;</a>";
echo($texto);
}
function cambiar_estado_hoja_vida($idformato,$iddoc,$indice=0){
global $menu2;
$texto="<a href='../hoja_vida/ejecutar_sql_hoja_vida.php?idformato=".$idformato."&iddoc=$iddoc'>&nbsp;&nbsp;Cambiar estado&nbsp;&nbsp;</a>";
echo($texto);
}
function listado_hojas_vida($idformato,$iddoc){
global $menu2;
$texto="<a href='../../hoja_vidalist1.php'>&nbsp;&nbsp;Ir al listado&nbsp;&nbsp;</a>";
echo($texto);
}
function transferir_hoja_vida($idformato,$iddoc)
{
 echo "<a href='../../transferenciaadd.php?key=$iddoc'>&nbsp;&nbsp;Transferir&nbsp;&nbsp;</a>";
 return true;
}
?>
