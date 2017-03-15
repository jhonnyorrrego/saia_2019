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


include_once("../header.php");
include_once("../db.php");
include_once("librerias/funciones.php");

include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idcampo","idformato");
desencriptar_sqli('form_info');

if(!isset($_REQUEST["enviado"]))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  </head>
  <body>
  <br><center><b>CARACTERISTICAS ADICIONALES</b></center><br><br>
  <form name="adicionales" id="adicionales" method="post" action="">
<table>
<tr>
<td class="encabezado">Validar que el valor sea menor que</td>
<?php 
$resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='max'","",$conn);
?>
<td bgcolor="#F5F5F5"><input type=text size=5 name="max" value="<?php if($resultado["numcampos"]) echo $resultado[0][0]; ?>"></td>
</tr>
<tr>
<td class="encabezado">Validar que el valor sea mayor que</td>
<?php 
$resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='min'","",$conn);
?>
<td bgcolor="#F5F5F5"><input type=text size=5 value="<?php if($resultado["numcampos"]) echo $resultado[0][0]; ?>" name="min"></td>
</tr>
<tr>
<td class="encabezado">N&uacute;mero m&iacute;nimo de caracteres</td>
<?php 
$resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='minlength'","",$conn);
?>
<td bgcolor="#F5F5F5"><input type=text size=5 value="<?php if($resultado["numcampos"]) echo $resultado[0][0]; ?>" name="minc"></td>
</tr>

<tr>
<td class="encabezado">N&uacute;mero m&aacute;ximo de caracteres</td>
<?php 
$resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='maxlength'","",$conn);
?>
<td bgcolor="#F5F5F5"><input type=text size=5 value="<?php if($resultado["numcampos"]) echo $resultado[0][0]; ?>" name="maxc"></td>
</tr>
<tr>
<td class="encabezado">Validar que tenga formato de</td>
<td bgcolor="#F5F5F5">
<?php 
$resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='class'","",$conn);
?>
<input type=radio value="email" <?php if(@$resultado[0][0]=="email") echo "checked" ?> name="formateo">Email&nbsp;&nbsp;
<input type=radio value="url" <?php if(@$resultado[0][0]=="url") echo "checked" ?> name="formateo">URL&nbsp;&nbsp;
<input type=radio value="date" <?php if(@$resultado[0][0]=="date") echo "checked" ?> name="formateo">Fecha<br>
<input type=radio value="number" <?php if(@$resultado[0][0]=="number") echo "checked" ?> name="formateo">N&uacute;mero decimal&nbsp;&nbsp;
<input type=radio value="digits" <?php if(@$resultado[0][0]=="digits") echo "checked" ?> name="formateo">N&uacute;mero Entero
<input type=radio value="" <?php if(@$resultado[0][0]=="") echo "checked" ?> name="formateo">Ninguno
</tr>
<!--tr>
<td class="encabezado">Obligatorio si llenan</td>
<td bgcolor="#F5F5F5">
<?php

$campos=busca_filtro_tabla("nombre,etiqueta","campos_formato","formato_idformato=".$_REQUEST["idformato"]." and etiqueta_html<>'hidden' and idcampos_formato<>'".$_REQUEST["idcampo"]."'","etiqueta",$conn);
?>
<select name="depende">
<option value="" selected>Seleccionar...</option>
<?php
for($i=0;$i<$campos["numcampos"];$i++)
  echo "<option value='".$campos[$i]["nombre"]."'>".$campos[$i]["etiqueta"]."</option>";
?>
</select>
</td>
</tr-->
<tr>
<td class="encabezado">Atributos html Adicionales</td>
<td bgcolor="#F5F5F5">
<input type=text size=50 value="" name="adicionales">
</tr>
<tr>
<td bgcolor="#F5F5F5" colspan=2 align=center>
<input type="hidden" value="Aceptar" name="enviado">
<input type=submit value="Aceptar"></td>
<input type=hidden value="<?php echo $_REQUEST["idformato"]; ?>" name="idformato">
<input type=hidden value="<?php echo $_REQUEST["idcampo"]; ?>" name="idcampo">
</tr>
</table>
</form>
  </body>
</html>
<?php
encriptar_sqli("adicionales",1,"form_info",$ruta_db_superior);
}
else
{
 $formato=busca_filtro_tabla("","formato A","A.idformato=".$_REQUEST["idformato"],"",$conn);
 //************* tipo de campo ********************************
 if($_REQUEST["formateo"])
  {//busco si ya esta la validacion
   $resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='class'","",$conn);
   if(!$resultado["numcampos"]){
   		$sql="insert into caracteristicas_campos(tipo_caracteristica,valor,idcampos_formato) values('class','".$_REQUEST["formateo"]."','".$_REQUEST["idcampo"]."')";
	   	guardar_traza($sql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sql,$conn);
   }
   elseif($resultado[0][0]<>$_REQUEST["formateo"]){
   		$sql="update caracteristicas_campos set valor='".$_REQUEST["formateo"]."' where tipo_caracteristica='class' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	   	guardar_traza($sql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sql,$conn);
  }
 else{
 	$sql="delete from caracteristicas_campos where tipo_caracteristica='class' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	   	guardar_traza($sql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sql,$conn);
 	}
  }
//*********** minimo valor permitido *****************************  
 if($_REQUEST["min"])  
    {//busco si ya esta la validacion
   $resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='min'","",$conn);
   if(!$resultado["numcampos"]){
   		$sql="insert into caracteristicas_campos(tipo_caracteristica,valor,idcampos_formato) values('min','".$_REQUEST["min"]."','".$_REQUEST["idcampo"]."')";
	   	guardar_traza($sql,$formato[0]["nombre_tabla"]);
   		phpmkr_query($sql,$conn);
   }
   elseif($resultado[0][0]<>$_REQUEST["min"]){
   	$sql="update caracteristicas_campos set valor='".$_REQUEST["min"]."' where tipo_caracteristica='min' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	   	guardar_traza($sql,$formato[0]["nombre_tabla"]);
   		phpmkr_query ($sql,$conn);
   		}
    }
  else{
  	$sql="delete from caracteristicas_campos where tipo_caracteristica='min' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
	  phpmkr_query ($sql,$conn);
  	}    
//*********** maximo valor permitido *****************************      
 if($_REQUEST["max"])  
    {//busco si ya esta la validacion
   $resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='max'","",$conn);
   if(!$resultado["numcampos"]){
   	$sql="insert into caracteristicas_campos(tipo_caracteristica,valor,idcampos_formato) values('max','".$_REQUEST["max"]."','".$_REQUEST["idcampo"]."')";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
   	phpmkr_query($sql,$conn);
   }
   elseif($resultado[0][0]<>$_REQUEST["max"]){
   	$sql="update caracteristicas_campos set valor='".$_REQUEST["max"]."' where tipo_caracteristica='max' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
   	phpmkr_query ($sql,$conn);
   	}
    }
 else{
 	$sql="delete from caracteristicas_campos where tipo_caracteristica='max' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
 	phpmkr_query ($sql,$conn);
 	}        
 //*********** minimo numero de caracteres *****************************     
 if($_REQUEST["minc"])  
    {//busco si ya esta la validacion
   $resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='minlength'","",$conn);
   if(!$resultado["numcampos"]){
   	$sql="insert into caracteristicas_campos(tipo_caracteristica,valor,idcampos_formato) values('minlength','".$_REQUEST["minc"]."','".$_REQUEST["idcampo"]."')";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
   	phpmkr_query($sql,$conn);
   	}
   elseif($resultado[0][0]<>$_REQUEST["minc"]){
   	$sql="update caracteristicas_campos set valor='".$_REQUEST["minc"]."' where tipo_caracteristica='minlength' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
     phpmkr_query ($sql,$conn);
   }
    }
 else{
 	$sql="delete from caracteristicas_campos where tipo_caracteristica='minlength' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
    phpmkr_query ($sql,$conn);
 }      
 //*********** maximo numero de caracteres *****************************     
 if($_REQUEST["maxc"])  
    {//busco si ya esta la validacion
   $resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='maxlength'","",$conn);
   if(!$resultado["numcampos"]){
   	$sql="insert into caracteristicas_campos(tipo_caracteristica,valor,idcampos_formato) values('maxlength','".$_REQUEST["maxc"]."','".$_REQUEST["idcampo"]."')";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
     phpmkr_query($sql,$conn);
     }
   elseif($resultado[0][0]<>$_REQUEST["maxc"]){
   	$sql="update caracteristicas_campos set valor='".$_REQUEST["maxc"]."' where tipo_caracteristica='maxlength' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
     phpmkr_query ($sql,$conn);
   }
    } 
 else{
 	$sql="delete from caracteristicas_campos where tipo_caracteristica='maxlength' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
    phpmkr_query ($sql,$conn);
 } 
    
//*********** adicionales *****************************     
 if($_REQUEST["adicionales"])  
    {//busco si ya esta la validacion
   $resultado=busca_filtro_tabla("valor","caracteristicas_campos","idcampos_formato='".$_REQUEST["idcampo"]."' and tipo_caracteristica='adicionales'","",$conn);
   if(!$resultado["numcampos"]){
   	$sql="insert into caracteristicas_campos(tipo_caracteristica,valor,idcampos_formato) values('adicionales','".$_REQUEST["adicionales"]."','".$_REQUEST["idcampo"]."')";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
     phpmkr_query($sql,$conn);
   }
   elseif($resultado[0][0]<>$_REQUEST["adicionales"]){
   	$sql="update caracteristicas_campos set valor='".$_REQUEST["adicionales"]."' where tipo_caracteristica='adicionales' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
     phpmkr_query ($sql,$conn);
   }
    } 
 else{
 	$sql="delete from caracteristicas_campos where tipo_caracteristica='adicionales' and idcampos_formato='".$_REQUEST["idcampo"]."'";
	  guardar_traza($sql,$formato[0]["nombre_tabla"]);
    phpmkr_query ($sql,$conn);
    }            
?>
<script>
window.parent.hs.close();
</script>
<?php
}
?>
<script>
window.document.getElementById("header").style.display="none";
</script>
<?php
include_once("footer.php");
?>