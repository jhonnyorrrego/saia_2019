<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
/*
<Clase>
<Nombre>colilla
<Parametros>
<Responsabilidades>muestra la colilla con la informacion de radicado del documento especificado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
include_once("db.php");
clearstatcache();
$no_cache = md5(time());
$doc=FALSE;

//print_r($_REQUEST["formato"]);
$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["formato"],"",$conn);

if(isset($_REQUEST["doc"]))
  {$doc=$_REQUEST["doc"];
   registrar_accion_digitalizacion($doc,'IMPRIME COLILLA');
  }
else if(isset($_REQUEST["key"])){
  $doc=$_REQUEST["key"];
  registrar_accion_digitalizacion($doc,'IMPRIME COLILLA');
}
else
{
  $doc=generar_ingreso("radicacion_entrada");
}

if(isset($_REQUEST["enlace"]))
   {if(strpos($_REQUEST["enlace"],'?')>0)
      $enlace=$_REQUEST["enlace"]."&key=".$doc;
    else
      $enlace=$_REQUEST["enlace"]."?key=".$doc;
   }
else $enlace ="";

$plantilla = busca_filtro_tabla("plantilla","documento","iddocumento=".$doc,"",$conn);
$plantilla = strtolower($plantilla[0]["plantilla"]);
$id_formato = busca_filtro_tabla("idformato","formato","nombre='".$plantilla."'","",$conn);

if($enlace != ""){
  if($_REQUEST["enlace"] == "vacio.php")
  {
  	$enlace = "".PROTOCOLO_CONEXION.RUTA_PDF.FORMATOS_CLIENTE.$plantilla."/detalles_mostrar_".$plantilla.".php?iddoc=$doc&idformato=".$id_formato[0]["idformato"];
  }
    //$enlace = "$enlace&formato=".strtolower($plantilla[0]["plantilla"]);
}

if(isset($_REQUEST["pagina"]) || $enlace!="")
  $atras=2;
else
  {$atras=1;
   $enlace="";
  }
if($doc<>FALSE){

 $ejecutor=busca_filtro_tabla("nombre AS nombre, empresa","ejecutor A,datos_ejecutor B","A.idejecutor=B.ejecutor_idejecutor AND iddatos_ejecutor=".$datos[0]["ejecutor"],"",$conn);
   $radicador = busca_filtro_tabla("destino,D.nombre,B.nombres, B.apellidos","buzon_salida A,funcionario B,dependencia_cargo C,dependencia D","A.destino=B.funcionario_codigo AND B.idfuncionario=C.funcionario_idfuncionario AND C.dependencia_iddependencia=D.iddependencia AND A.archivo_idarchivo=$doc AND A.nombre='TRANSFERIDO'","A.idtransferencia ASC",$conn);
  $responsable=busca_filtro_tabla("B.nombre","documento A,dependencia B","A.responsable=B.iddependencia AND iddocumento=".$doc,"",$conn);
    if($radicador["numcampos"]){
      $usu=$radicador[0]["nombre"];
    }
    else
      $usu="RADICACION";
  if($datos[0]["tipo_radicado"]==1){

    $origen=$ejecutor[0]["nombre"];
    $destino=$usu;

  }
  else if($datos[0]["tipo_radicado"]==2){
    $origen=$responsable[0]["nombre"];
    $destino=$ejecutor[0]["nombre"];
  }
  else{
    $origen=$responsable[0]["nombre"];
    $destino=$radicador[0]["nombres"]." ".$radicador[0]["apellidos"];
  }

  $usuario = busca_filtro_tabla("nombres,apellidos","funcionario a,documento b,digitalizacion c"," b.iddocumento=$doc and b.iddocumento=c.documento_iddocumento and c.funcionario=a.funcionario_codigo and c.accion='CREACION DOCUMENTO'","",$conn);
  $usu=$usuario[0]["nombres"]." ".$usuario[0]["apellidos"];
  $configuracion=busca_filtro_tabla("*",DB.".configuracion A","A.tipo='impresion'","",$conn);

  $imprime=0;
  $imprime=0;
  for($i=0;$i<$configuracion["numcampos"];$i++){
   if($configuracion[$i]["nombre"]=="colilla")
    $imprime=$configuracion[$i]["valor"];
  }
  $web_empresa="";
  $nombre_empresa="EMPRESA";
  $logo_empresa="";
  $datos=busca_filtro_tabla("numero,tipo_radicado,".fecha_db_obtener("A.fecha",'Y-m-d H:i:s')." AS fecha_oracle",DB.".documento A","A.iddocumento=$doc","",$conn);

  $ano=busca_filtro_tabla(fecha_db_obtener("A.fecha",'Y')." AS ano",DB.".documento A","A.iddocumento=$doc","",$conn);

 $paginas=busca_filtro_tabla("COUNT(id_documento) as paginas","pagina","id_documento=$doc","",$conn);
  //print_r($datos); die();
  $pag=$paginas[0]['paginas'];
  $an=$ano[0]['ano'];
  $datos_fecha = $datos[0]['fecha_oracle'];
  $datos_numero = $datos[0]['numero'];
  if($datos["numcampos"]&&$imprime)
  {
  $tipo_r=busca_tabla("contador",$datos[0]["tipo_radicado"]);
  if($tipo_r["numcampos"])
  {
  switch($tipo_r[0]["nombre"]){
   case "radicacion_entrada": $tipo_radicado="REC";
   break;
   case "radicacion_salida": $tipo_radicado="EXT";
   break;
   default : $tipo_radicado="I";
   break;
   }
  }
  else $tipo_radicado="I";
  $empresa=busca_filtro_tabla("A.nombre, A.valor",DB.".configuracion A","A.tipo='empresa'","A.nombre",$conn);

  for($i=0;$i<$empresa["numcampos"];$i++){
    switch($empresa[$i]["nombre"]){
      case "nombre":
          $nombre_empresa=$empresa[$i]["valor"];
      break;
      case "logo":
          $logo_empresa=$empresa[$i]["valor"];
      break;
      case "web":
          $web_empresa=$empresa[$i]["valor"];
      break;
      default:
      break;
    }
  }
 //$logo_empresa="";
?>
<style type="text/css">
<!--
td {
	font-family: VERDANA;
	font-size:12px;
	height:14px;
}
-->
</style>
<script language="javascript">
<!--
/*
<Clase>
<Nombre>comando_documento
<Parametros>sComando-comando que se desea ejecutar
<Responsabilidades>Ejecuta el comando especificado sobre el documento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function comando_documento(sComando){
    if (!document.execCommand){
        alert("Funci?n no disponible en su explorador");
        return false;
    }
    document.execCommand(sComando);
}
/*
<Clase>
<Nombre>imprime
<Parametros>atras-numero de saltos desde la pagina que la llama
<Responsabilidades>retorna a la pagina que llam? a la colilla despu?s de mostrarla
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function imprime(atras){
  window.focus();
  var url = "<?php echo $enlace; ?>";
  window.print();
  //comando_documento('ClearAuthenticationCache');
  if(url!="")
     window.open("<?php echo $enlace; ?>","centro");
  else
     window.history.go(-atras);
}
-->
</script>
<html lang="en">
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.9.1.custom.min.css" />
<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.8rc3.custom.min.js"></script>
     <script>
    $(function() {
        $( "#dialog-form" ).dialog({
            autoOpen: true,
            height: 200,
            width: 250,
            modal: true,
            resizable: false,
            buttons: {
                "Continuar": function() {
                   var dato = $( ":checked" ).val();
                   $( "#table_alineacion" ).attr( "align",dato);
                   $( this ).dialog( "close" );
                }
            },
            close: function() {
                imprime('<?php echo $atras ?>');
            }
        });
    });
    </script>
</head>
<body>

<div id="dialog-form" title="Alineaci&oacute;n de la colilla en la p&aacute;gina">
    <form>
    <table><tr>
        <td>
        <input type="radio" id="izquierda" name="name" value="left" />Izquierda </td><td>
        <input type="radio" name="name" value="center" checked /><label>Centro</label> </td><td>
        <input type="radio" name="name" value="right" />Derecha </td>
    </tr>
    </table>
    </form>
</div>

<META HTTP-EQUIV="Cache-Control" CONTENT ="no-cache">
<table id="table_alineacion"  height="auto" align="center" border="0" cellspacing="0" cellpadding="0" style="padding-right:5px;font-size:10pt">
  <tr> <!-- Ancho maximo 80px Alto maximo 100px para la imagen -->
    <td rowspan=5 align="center" valign="middle" style="font-size:10pt"><?php if($logo_empresa<>"") echo("<img src=\"".$logo_empresa."\" >"); else echo("&nbsp;"); ?></td><td colspan="2" align="center" style="font-size:10pt"><strong><?php echo($nombre_empresa);?></strong></td>
  </tr>
  <tr>
    <td align="right" colspan='2' style="font-size:10pt"><strong>Radicaci&oacute;n No.:</strong><strong><?php echo($datos_numero."-$an");?></strong></td>
  </tr>
  <tr>
    <td align="right" colspan='2' style="font-size:10pt"><strong>Fecha:</strong><?php echo $datos_fecha; ?></font></td>
  </tr>
  <tr>
    <td align="right" colspan='2' style="font-size:10pt"><strong>Destino:</strong><?php echo($destino); ?></td>
  </tr>
  <tr>
    <td colspan='2' align='right' style="font-size:10pt"><strong>Digitales:</strong><?php echo $pag;?></td>
  </tr>
  <tr>
  <td colspan='3' align='center' style="font-size:10pt"><?php echo $web_empresa; ?></td>
  </tr>
</table>
</body>
</html>
  <?php
	}
  }
?>

