<?php include_once("db.php");
// Initialize common variables
$x_consecutivo = Null;
$x_id_documento = Null;
$x_imagen = Null;
$fs_x_imagen = 0;
$fn_x_imagen = "";
$ct_x_imagen = "";
$w_x_imagen = 0;
$h_x_imagen = 0;
$a_x_imagen = "";
$x_pagina = Null;
$x_escaneo= Null;

if(isset($_REQUEST["key"]))
  $key = $_REQUEST["key"];
else
if(isset($_POST["x_id_documento"]))
  $key = $_POST["x_id_documento"];
else
 $key = @$_SESSION["iddoc"];
if(isset($_POST["x_enlace"]) && $_POST["x_enlace"])
  $x_enlace=$_POST["x_enlace"];
else if(isset($_GET["x_enlace"]) && $_GET["x_enlace"])
  $x_enlace=$_GET["x_enlace"];
     else $x_enlace="transferenciaadd.php?doc=".$key;
        if(strstr($x_enlace,"doc")||strstr($x_enlace,"key"))
        {
          if(strstr($x_enlace,"?"))
             $x_enlace.="&";
          else  $x_enlace.="?";
            $x_enlace.="doc=".$key;
        }
        else
         if(strstr($x_enlace,"mostrar"))
          $x_enlace="ordenar.php?key=".$key."&accion=mostrar";
         elseif(strstr($x_enlace,"view"))
           $x_enlace="documentoview.php?key=$key";
?>
<?php include_once ("phpmkrfn.php") ?>
<?php
// Get action
$sAction = @$_POST["a_add"];
$tabla="pagina";
if(@$_SESSION["tipo_doc"]=="registro")
  $tabla="pagina_registro";
if (($sAction == "") || (($sAction == NULL))) {
$sKey = $key;
$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
if ($sKey <> "") {
$sAction = "C"; // Copy record
}
else
{
$sAction = "I"; // Display blank record
}
}
/*else
{
// Get fields from form
$x_consecutivo = @$_POST["x_consecutivo"];
$x_id_documento = @$_POST["x_id_documento"];
$x_imagen = @$_POST["x_imagen"];
$x_pagina = @$_POST["x_pagina"];
$x_escaneo = @$_POST["x_escaneo"];
if(isset($_POST["x_enlace"]) && $_POST["x_enlace"])
  $x_enlace = @$_POST["x_enlace"];
if($sAction<>"A")
sincronizar_carpetas($tabla,$conn);
}    */
//print_r($_REQUEST);
switch ($sAction)
{
case "A": // Add
if($_REQUEST["x_tipo"]=="ejecutor")
{$ejecutor=busca_filtro_tabla("ejecutor_idejecutor","datos_ejecutor","iddatos_ejecutor=".$_REQUEST["key"],"",$conn);
 $destino="../fotos_ejecutores" ;
}
else
  $destino="../fotos_elementos";
  
if(!is_dir($destino))
  {mkdir($destino,0777);
  }
if(!is_dir("$destino/".$_REQUEST["key"]))
  {mkdir("$destino/".$_REQUEST["key"],0777);
  }
$dir="temporal_".usuario_actual("login");
$encontradas=0;  
if($dh = @opendir($dir))
  {while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 
     if(strpos($dir.'/'.$obj,"(#".$_REQUEST["key"].")")!==false)
       {$nombre=date("Y_m_d_").rand(0,100);
        while(is_file("$destino/".$_REQUEST["key"]."/$nombre.jpg"))
           $nombre=date("Y_m_d_").rand(0,100);
        rename($dir.'/'.$obj,"$destino/".$_REQUEST["key"]."/$nombre.jpg");  
        if($_REQUEST["x_tipo"]=="ejecutor")
          {$sql="insert into foto_ingreso(ruta,ejecutor_idejecutor) values('"."$destino/".$_REQUEST["key"]."/$nombre.jpg"."','".$ejecutor[0][0]."')";
           phpmkr_query($sql,$conn);
          }
        else
          {$sql="insert into foto_elemento(ruta,codigo_elemento) values('"."$destino/".$_REQUEST["key"]."/$nombre.jpg"."','".$_REQUEST["key"]."')";
           phpmkr_query($sql,$conn);
          }    
        $encontradas++;
       }
    }  
  } 
closedir($dh);
echo '<script>
      alert("'.$encontradas.' foto(s) adicionada(s).");
      if("'.$_REQUEST["x_tipo"].'"=="ejecutor")
        window.opener.link_actualizar.click();
      else
        window.opener.link_actualizar.click();
      window.close();  
      </script>';      
die();
/*if (sincronizar_carpetas($tabla,$conn)){  // Add New Record
$_SESSION["ewmsg"] = "NUEVO REGISTRO ADICIONADO CON EXITO";
}
die();
if($x_escaneo=="1")
{$enlace = "";
 if(strstr($x_enlace,"mostrar"))
   $enlace = "&x_enlace=mostrar";
 elseif(strstr($x_enlace,"view"))
   $enlace = "&x_enlace=view";
  $x_enlace="fotoadd.php?key=".$x_id_documento.$enlace;
}
abrir_url($x_enlace,"_self");
//ob_end_clean();
exit(); */
break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_id_documento && !EW_hasValue(EW_this.x_id_documento, "TEXT" )) {
if (!EW_onError(EW_this, EW_this.x_id_documento, "TEXT", "POR FAVOR INGRESE EL CAMPO REQUERIDO - DOCUMENTO ASOCIADO"))
return false;
}
if (EW_this.x_id_documento && !EW_checkinteger(EW_this.x_id_documento.value)) {
if (!EW_onError(EW_this, EW_this.x_id_documento, "TEXT", "ENTERO INCORRECTO - DOCUMENTO ASOCIADO"))
return false;
}
if (EW_this.x_imagen && !EW_hasValue(EW_this.x_imagen, "FILE" )) {
if (!EW_onError(EW_this, EW_this.x_imagen, "FILE", "POR FAVOR INGRESE EL CAMPO REQUERIDO - IMAGEN"))
return false;
}
}
-->
</script>
<div  align="center">
</div><br /><br />
<span class="internos"><img class="imagen_internos" src="botones/comentarios/adicionar.png" border="0">&nbsp;&nbsp;ADICI&Oacute;N DE FOTO</span>
<form name="paginaadd" id="paginaadd" action="fotoadd.php<?php echo("?key=".$key) ?>" method="POST" onSubmit="return EW_checkMyForm(this);">
<input type="hidden" name="a_add" value="A">
<?php
$dir="";
$dir2="";
$dir3="";
$usuario="";
$clave="";
$configuracion["numcampos"]=0;
$configuracion=busca_filtro_tabla("A.*","configuracion A","tipo='ruta' OR tipo='clave' OR tipo='usuario' or tipo='peso' OR tipo='imagen'","",$conn);
for($i=0;$i<$configuracion["numcampos"];$i++){
  switch($configuracion[$i]["nombre"]){
   case "ruta_servidor": $dir=$configuracion[$i]["valor"];
   break;
   case "ruta_ftp": $dir2=$configuracion[$i]["valor"]."_".$_SESSION["LOGIN".LLAVE_SAIA];
   break;
   case "ruta_temporal": $dir3=$configuracion[$i]["valor"]."_".$_SESSION["LOGIN".LLAVE_SAIA];
   break;
   case "clave_ftp": 
	if($configuracion[$i]['encrypt']){
		include_once('pantallas/lib/librerias_cripto.php');
		$configuracion[$i]['valor']=decrypt_blowfish($configuracion[$i]['valor'],LLAVE_SAIA_CRYPTO);					
	}	   
   $clave=$configuracion[$i]["valor"];
   break;
   case "usuario_ftp": $usuario=$configuracion[$i]["valor"];
   break;
   case "maximo_tamanio_upload": $peso=$configuracion[$i]["valor"];
   break;
   case "ancho_imagen": $ancho=$configuracion[$i]["valor"];
   break;
   case "alto_imagen": $alto=$configuracion[$i]["valor"];
   break;
  }
}
if($_REQUEST["tipo"]=="ejecutor")
  {$entidad=busca_filtro_tabla("","datos_ejecutor,ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$_REQUEST["key"],"",$conn);
   $etiqueta="RESPONSABLE DE INGRESO";
   $nombre=$entidad[0]["nombre"];
  }
elseif($_REQUEST["tipo"]=="elemento")
  {
   $etiqueta="CODIGO/SERIE ELEMENTO QUE INGRESA";
   $nombre=$_REQUEST["key"];
  }  
?>
<input type="hidden" name="EW_Max_File_Size" value="<?php echo($peso);?>">
<input type="hidden" name="x_enlace" value="<?php echo($x_enlace);?>">
  <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td width="205" class="encabezado" ><span class="phpmaker" style="color: #FFFFFF;"><?php  echo $etiqueta; ?></span></td>
      <td width="335" bgcolor="#F5F5F5"><span class="phpmaker">
        <?php
        if($key)
          $x_id_documento= $key;
        else
         $x_id_documento= 0;
        if(!is_dir($dir3))
        {
        //chmod($dir3,PERMISOS_CARPETAS);
        if(!mkdir($dir3,PERMISOS_CARPETAS))
          alerta("no es posible crear una carpeta temporal para su usuario por favor comuniquese con el administrador");
          volver("1");
        }
        //echo $dir3;
        chmod($dir3,PERMISOS_CARPETAS);
?>
        <input type="hidden" name="x_tipo" id="x_tipo" size="30" value="<?php echo $_REQUEST["tipo"]; ?>">  
        <input type="hidden" name="entidad" id="entidad" size="30" value="<?php echo $_REQUEST["key"]; ?>">
        <?php
        echo $nombre;
        ?> </span> </td>
      <td width="207" rowspan="2" bgcolor="#F5F5F5"><span class="phpmaker">
        <input type="submit" name="Action" value="CONTINUAR" />
        </span> <div align="center"></div></td>
    </tr>
    <!--tr>
      <td width="205" class="encabezado" ><span class="phpmaker" style="color: #FFFFFF;">ESCANEAR
        DE NUEVO</span></td>
      <td width="335" bgcolor="#F5F5F5"><span class="phpmaker"> SI
        <input type="radio" name="x_escaneo" value="1">
        NO
        <input type="radio" name="x_escaneo" value="0" checked>
        </span> </tr-->
  </table>
  <div>
    <applet code="uk.co.mmscomputing.application.imageviewer.MainApp.class"  archive="visor.jar" width =100% height="640" name="scaner">
      <param name="url" value="<?php print($dir3);  ?>">
      <param name="radica" value="<?php print($key);?>">
      <param name="host" value="<?php print($dir);?>">
      <param name="usuario" value="<?php print($usuario);?>">
      <param name="dftp" value="<?php print($dir2);?>">
      <param name="clave" value="<?php print($clave);?>">
      <param name="verLog" value="true">
      <param name="ancho" value="<?php print($ancho);?>">
      <param name="alto" value="<?php print($alto);?>">
      <param name="maxtabs" value="50">
    </applet>
    </div>
</form>
<?php include ("footer.php") ?>
<?php
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
function LoadData($sKey,$conn)
{
global $_SESSION;
global $x_consecutivo;
global $x_id_documento;
global $x_imagen;
global $x_pagina;
$sKeyWrk = "" . addslashes($sKey) . "";
$sSql = "SELECT * FROM pagina";
$sSql .= " WHERE consecutivo = " . $sKeyWrk;
$sGroupBy = "";
$sHaving = "";
$sOrderBy = "";
if ($sGroupBy <> "") {
$sSql .= " GROUP BY " . $sGroupBy;
}
if ($sHaving <> "") {
$sSql .= " HAVING " . $sHaving;
}
if ($sOrderBy <> "") {
$sSql .= " ORDER BY " . $sOrderBy;
}
$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
if (phpmkr_num_rows($rs) == 0) {
$LoadData = false;
}else{
$LoadData = true;
$row = phpmkr_fetch_array($rs);
// Get the field contents
$x_consecutivo = $row["consecutivo"];
$x_id_documento = $row["id_documento"];
$x_imagen = $row["imagen"];
$x_pagina = $row["pagina"];
}
phpmkr_free_result($rs);
return $LoadData;
}
?>
