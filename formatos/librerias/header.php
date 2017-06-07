<?php
if(!isset($_SESSION))
  session_start();
include_once("../db.php");
include_once("encabezado_pie_pagina.php");

//para exportar a word
if(isset($_REQUEST["export"])){
  $exportar=$_REQUEST["export"];
  if($exportar=="word"){

  }
}


  if(!isset($_REQUEST["tipo"]) || ($_REQUEST["tipo"]==1))
  $fondo="#cccccc";


global $conn,$dependencia,$encabezado,$plantilla;

//Definir estilos para tipo de letra y color de encabezado
$_REQUEST["iddoc"]=str_replace("'","",stripslashes($_REQUEST["iddoc"]));

if(isset($_REQUEST["idformato"]))
  $formato=busca_filtro_tabla("","formato,documento","lower(plantilla)=nombre and iddocumento=".$_REQUEST["iddoc"]." and idformato=".$_REQUEST["idformato"],"",$conn);
else
  $formato=busca_filtro_tabla("","formato,documento","lower(plantilla)=nombre and iddocumento=".$_REQUEST["iddoc"],"",$conn);
if(!isset($_REQUEST["tipo"]) || ($_REQUEST["tipo"]==1))
  leido(usuario_actual("funcionario_codigo"),$_REQUEST["iddoc"]);
?>
<html>
<head>
<?php
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
      .phpmaker
       {
       font-family: Verdana,Tahoma,arial;
       color:#000000;
       /*text-transform:Uppercase;*/
       }
       .encabezado
       {
       background-color:".$config[0]["valor"].";
       color:white ;
       padding:10px;
       text-align: left;
       }
       .encabezado_list
       {
       background-color:".$config[0]["valor"].";
       color:white ;
       vertical-align:middle;
       text-align: center;
       font-weight: bold;
       }
       </style>";
  echo $style;
  }
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra'", "", $conn);
$doc = $_REQUEST["iddoc"];
$nombre = $formato[0]["nombre"];
$_SESSION["pagina_actual"] = $doc;
$_SESSION["tipo_pagina"] = FORMATOS_CLIENTE . "$nombre/mostrar_$nombre.php?iddoc=$doc";
if (isset($_REQUEST["font_size"]) && $_REQUEST["font_size"])
	$formato[0]["font_size"] = $_REQUEST["font_size"];

if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1)
	echo "<style> body,table { font-size:9pt; font-family:verdana; } </style>";
elseif ($fuente["numcampos"])
	echo "<style> body { font-size:" . $formato[0]["font_size"] . "pt; font-family:" . $fuente[0]["valor"] . "; } </style>";

?>

</head>
<body bgcolor="<?php echo $fondo; ?>">

<?php

if( !isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1)
  {
   if(!isset($_REQUEST["export"])){
     echo"<div id='div1' style='background:white;width:26px;height:25px'>";
    if(!$formato[0]["item"]){
     //echo "<a target='_blank' href='../../html2ps/public_html/demo/html2ps.php?plantilla=".$formato[0]["nombre"]."&iddoc=".$_REQUEST["iddoc"];
     echo "<a target='_blank' href='../../class_impresion.php?iddoc=".$_REQUEST["iddoc"];
     if(isset($_REQUEST["vista"]))
        echo "&vista=".$_REQUEST["vista"];
     echo "'><img style='position:relative;left:5px;top:5px' src='../../enlaces/imprimir.png' title='Vista premiliminar' border='0'></a>";

    $margenes=explode(",",$formato[0]["margenes"]);
     if(isset($_REQUEST["vista"])&&$_REQUEST["vista"])
      {$vista=busca_filtro_tabla("encabezado","vista_formato","idvista_formato='".$_REQUEST["vista"]."'","",$conn);
       $encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato='".$vista[0]["encabezado"]."'","",$conn);
       $pie=busca_filtro_tabla("encabezado",$formato[0]["nombre_tabla"],"documento_iddocumento='".$_REQUEST["iddoc"]."'","",$conn);
       }
     else
       {$encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato='".$formato[0]["encabezado"]."'","",$conn);
        $pie=busca_filtro_tabla("encabezado",$formato[0]["nombre_tabla"],"documento_iddocumento='".$_REQUEST["iddoc"]."'","",$conn);
       }
     echo "</div>";
     }
    echo "<table  border='0' id='tabla1' width='100%' bgcolor='white' >";
    echo("<tr ><td><div style='width:".$margenes[0]."mm; height:".$margenes[2]."mm;'>&nbsp;</div></td><td>");
     echo "<div id='encabezado' style='background-color:white;'>";

      if($pie[0][0]&&$encabezado["numcampos"])
          {if(!isset($_REQUEST["tipo"])||$_REQUEST["tipo"]==1)
            $pagina=0;
           else
            $pagina=1;
           echo crear_encabezado_pie_pagina(stripslashes($encabezado[0][0]),$_REQUEST["iddoc"],$formato[0]["idformato"],$pagina);
          }
     echo "</div>";
    echo("</td><td><div style='width:".$margenes[1]."mm; height:".$margenes[2]."mm;'>&nbsp;</div></td></tr>");
    echo "<tr><td>&nbsp;</td><td>";
    }
  }
  echo $style;
 if(!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]<>5 )
    {
    echo '<table  width="100%" border="0"  valign="top" border="0" cellpadding="0" cellspacing="0" >';

    }
   else
     {echo '<table border="0" width="100%" cellpadding="0" cellspacing="0">';
     }
?>
