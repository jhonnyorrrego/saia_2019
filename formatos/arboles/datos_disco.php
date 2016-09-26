<?
$include=valida("lib","../../db.php");
$inicio=valida("inicio","../../../procesos/");
//$texto="<?xml version=\"1.0\" encoding=\"UTF-8\"?".">";
$texto="";
if($include<>""){
  include_once($include);
  include_once("../librerias/funciones_archivo.php");
}
function listar_directorios_ruta2($ruta,$nivel,$padre){
   // abrir un directorio y listarlo recursivo
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            $info=info_archivo($ruta,$file,$nivel);
            $info["nivel"]=$nivel;
            $info["cod_padre"]=$padre;
            if($file!="." && $file!=".."){
               if (is_dir($ruta ."/". $file)){
                 //solo si el archivo es un directorio, distinto que "." y ".."
                 $fdir=valida("fdir","directorio");
                 if($fdir<>""){
                  $fdir($info);
                 }
                 else{
                  if(function_exists("directorio"))
                    directorio($info);
                  else
                    listar_directorios_ruta2($info["siguiente"]. "/",$info["nivel"]+1,$info["cod_padre"]);
                 }
               }
              else{
                $farch=valida("farch","archivo");
                if($farch<>""){
                  $farch($info);
                }
                else {
                  if(function_exists("archivo")){
                    archivo($info);
                  }
                }
              }
            }
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
return($info["nombre"]);
}

function directorio($info){
global $texto,$conn;
//$texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
//$texto.="text=\"".$info["nombre"]."\" id=\"".$info["nivel"]."-r".rand()."\">\n";
//$texto.="<userdata name='myurl'>larchivo2.php?inicio=".str_replace("//","/",$info["ruta"]."/".$info["nombre"])."/&farch=archivo&fdir=directorio</userdata>\n";
print_r($info);
$texto=busca_filtro_tabla("","ft_proceso","nombre LIKE '".$info["etiqueta"]."'","",$conn);
//print_r($texto);
listar_directorios_ruta2($info["siguiente"],$info["nivel"]+1,$info["cod_padre"]);
//$texto.="</item>\n";
}
function archivo($info){
global $texto,$conn;
$id=0;
$nombre=$info["etiqueta"];
$arreglo=explode("-",$nombre);
$nombre_tabla="";
if($texto["numcampos"]){
  switch($arreglo[0]){
    case "F":
      $nombre_tabla="ft_formato";
    break;
    case "G":
      $nombre_tabla="ft_guia";
    break;
    case "Pc":
      $nombre_tabla="ft_plan_calidad";
    break;
    case "I":
      $nombre_tabla="ft_instructivo";
    break;
    case "M":
      $nombre_tabla="ft_manual";
    break;
    default:
      $nombre_tabla="ft_otros_calidad";
    break;
  }
  $datos_tabla=busca_filtro_tabla("",$nombre_tabla,"nombre LIKE '".$arreglo[1]."' AND ft_proceso =".$texto[0]["idft_proceso"],"",$conn);
  if($nombre_tabla<>"" && $datos_tabla["numcampos"]==0){
    $sql="INSERT INTO ".$nombre_tabla." (nombre,ft_proceso) VALUES('".$arreglo[1]."',".$texto[0]["idft_proceso"].")";
    mysql_query($sql,$conn->Conn->conn);
    $id=mysql_insert_id();
    echo("SQL:".$sql."<br />ID:".$id."<br />");
  }
  if($id){
    $formato=busca_filtro_tabla("A.nombre AS formato,B.*","formato A,campos_formato B","A.idformato=B.formato_idformato AND A.nombre_tabla LIKE '".$nombre_tabla."' AND B.nombre LIKE 'soporte'","",$conn);
    //print_r($formato);
    //die();
    if($formato["numcampos"]){
      $ruta_destino="";
      vincular_archivo(array($formato[0]["idcampos_formato"]),$formato[0]["formato_idformato"],$id,$info["ruta"]."/".$info["nombre"].".".$info["extension"],$ruta_destino,$arreglo[1],1);
    }
  }
}
//$texto.="<item style=\"font-family:verdana; font-size:7pt;\" ";
//$texto.="text=\"".$info["nombre"].".".$info["extension"]."\" id=\"".$info["nivel"]."-r".rand()."\">";
//$texto.="<userdata name='myurl'>".str_replace("//","/",$info["ruta"]."/".$info["nombre"]).".".$info["extension"]."</userdata>\n";
//$texto.="</item>\n";
/*$nueva_ruta=str_replace("//","/",str_replace($_REQUEST["inicio"],$_REQUEST["nueva"]."/",$info["ruta"]));
$nuevo=str_replace("//","/",$nuevo);
$anterior=str_replace("//","/",$info["ruta"]."/".$info["nombre"].".".$info["extension"]);
//echo $anterior."---".$nuevo."<br/>";
if(!isdir(str_replace("//","/",str_replace($_REQUEST["inicio"],$_REQUEST["nueva"]."/",$info["ruta"]))))
	{mkdir();

	}
if(!copy($anterior,$nuevo))
	echo "error al copiar $anterior";
	*/
}
function valida($var,$default){
if(isset($_GET[$var]))
  return($_GET[$var]);
else if(isset($_POST[$var]))
  return($_POST[$var]);
else return($default);
}
function info_archivo($ruta,$cadena){
$info=array();
//echo $ruta."/".$cadena."<br/>";
$info["tipo"]=filetype($ruta."/".$cadena);
$info["ruta"]=$ruta;
$info["longitud"]=strlen($cadena);
if(is_dir($ruta."/".$cadena)){
  $info["siguiente"]=str_replace("//","/",$ruta."/".$cadena);
  if($cadena != "." && $cadena != ".."){
    $info["nombre"]=$cadena;
    $info["etiqueta"]=str_replace("_"," ",$cadena);
  }
}
else{
  $punto=strrpos($cadena,".");
  $info["nombre"]=substr($cadena,0,$punto);
  $info["extension"]=substr($cadena,$punto+1);
  $info["etiqueta"]=str_replace("_"," ",$info["nombre"]);
  //echo($info["etiqueta"].".".$info["extension"]."<br />\n");
  //$info["ruta"]="documentos/".$info["nombre"]."-".$info["extencion"].".".$info["extencion"];
}
return($info);
}
$nivel=0;
//$texto.="<tree id=\"0\">\n";
listar_directorios_ruta2($inicio,$nivel,0);
//$texto.="</tree>\n";
//crear_archivo("test_upload.xml",$texto);
?>
