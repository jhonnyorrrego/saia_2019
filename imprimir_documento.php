<?php
include_once("db.php");
if(isset($_REQUEST["iddoc"]) && $_REQUEST["iddoc"])
  $iddoc=$_REQUEST["iddoc"];
else $iddoc=$_SESSION["iddoc"];
?>
<div  align="center">
<iframe src="menu/menu.php?modulo=64&color=black&key=<?php echo $iddoc; ?>" allowtransparency="yes" width="100%" height="55px" border=0 frameborder="0" scrolling="No" >
</iframe><br /><br />
</div><br /><br />
<?php
$dir="pdfs/".$iddoc."/";
if(!is_dir($dir))
  if(!mkdir($dir,0777)){
    alerta ("Problemas con la carpeta ".$dir);
    exit();
  }    
$nameFile=$dir."/consolidado_".$iddoc.".pdf";
$file=$nameFile;
if(is_file($nameFile)){
?>
  <iframe id="centro_prueba" name="centro_prueba" style="position:relative; left:10px; top:-20;" height="1150pt" width="900pt" scrolling="auto" frameborder="no" src="<?php echo $file; ?>" allowtransparency="yes" onload="ocultar_enlaces();"></iframe>
<?php
 //abrir_url($file,"centro");
 }
elseif(dbToPdf_($nameFile, "pagina","id_documento",$iddoc)){  
  ?>
  <iframe id="centro_prueba" name="centro_prueba" style="position:relative; left:10px; top:-20;" height="1150pt" width="900pt" scrolling="auto" border=0 frameborder="0"  src="<?php echo $file; ?>" allowtransparency="yes"></iframe>
  <?php
  //abrir_url($file,"centro");
}
else 
 {alerta("No se ha generado el PDF");   
  echo "<script>window.history.go(-1);</script>";
 }
function dbToPdf_($nameFile, $tabla,$campo,$idcampo)
{
global $conn;
require_once('html2ps/public_html/fpdf/fpdf.php');
$listado=busca_filtro_tabla(" * ",$tabla,"$campo=$idcampo","pagina",$conn);

if($listado["numcampos"])
{
//Coordenadas X, Y iniciales en las que se ubicará la imagen
define("X0",0.5);
define("Y0",0.3);
//Ancho y alto de la imagen (ajustada a una hoja de tamaño carta)
if(!isset($_REQUEST["notas"]) || !$_REQUEST["notas"]){
  define("W",215);
  define("H",278.4);
}
else{
  define("W",215);
  define("H",278.4);
} 
$pag=0;
for($i=0;isset($listado[$i]);$i++)
{
  $path=pathinfo($listado[$i]["ruta"]);
  if($path && is_dir($path["dirname"])){
    if(is_file($path["dirname"]."/".$path["basename"])){
      if($path["extension"]=="jpg"){
      if($pag==0)
        $pdf=new FPDF("P","mm","Letter");
      $pag++;
      $pdf->AddPage();  
      $pdf->Image($listado[$i]["ruta"],X0,Y0,W,H);
      }
    }
   else alerta("Problemas con el archivo ".$path["dirname"]."/".$path["basename"]); 
  }
  else alerta("Problemas con la carpeta ".$path["dirname"]);
}
if($pag>0){
  $pdf->Output($nameFile);
  return(TRUE);
}
}
else
 { alerta("El documento no tiene paginas escaneadas");
   volver(1);
 }
}
?>
