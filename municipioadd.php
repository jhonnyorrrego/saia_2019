<?php include_once("db.php");

if(isset($_POST["ciudad"]))
{
 $pais=busca_filtro_tabla("idpais,nombre","pais","lower(nombre) LIKE '%".strtolower((html_entity_decode(($_POST["pais"]))))."%'","",$conn);
// print_r($pais);
 if($pais["numcampos"]>0)
   $idpais = $pais[0]["idpais"];
 else
   { phpmkr_query("INSERT INTO pais (nombre) VALUES ('".$_POST["pais"]."')",$conn);
     $idpais = phpmkr_insert_id();
   }
   //die($idapis."fin INSERT INTO pais (nombre) VALUES ('".$_POST["pais"]."')");      
 $dep = busca_filtro_tabla("iddepartamento","departamento","nombre LIKE '%".$_POST["provincia"]."%' and pais_idpais=$idpais","",$conn); 
 if($dep["numcampos"]>0) 
   $iddep = $dep[0]["iddepartamento"];
 else
   { phpmkr_query("INSERT INTO departamento (nombre,pais_idpais) VALUES ('".$_POST["provincia"]."',$idpais)",$conn);
     $iddep = phpmkr_insert_id();
   }      
 //phpmkr_query("INSERT INTO municipio (nombre,departamento_iddepartamento) VALUES ('".$_POST["ciudad"]."',$iddep)",$conn);
 phpmkr_query("INSERT INTO municipio (nombre,departamento_iddepartamento) VALUES ('".$_POST["ciudad"]."',$iddep)",$conn);
 $idmun = phpmkr_insert_id();  
 //die("INSERT INTO municipio (nombre,departamento_iddepartamento) VALUES ('".$_POST["ciudad"]."',$iddep)");
 //alerta($idmun." INSERT INTO municipio (nombre,departamento_iddepartamento) VALUES ('".$_POST["ciudad"]."',$iddep)");
if(isset($_POST["formato"]))
  { //die("formatos/carta/funciones_adicionales.php?funcion=validar_destino".$_POST["parametros"]);
    //redirecciona("formatos/carta/funciones_adicionales.php?funcion=validar_destino".$_POST["parametros"]."&ciudad_destino=".$idmun);
    echo $idmun;
  }
 else 
 volver(2); 


}
else
{
?>

<script>

function validar(f)
{
 if(f.pais.value=="")
 { alert("Debe ingresar un Pais");
   return false;
 } 
 if(f.ciudad.value=="")
 { alert("Debe ingresar una ciudad");
   return false;
 }
 if(f.provincia.value=="")
  f.provincia.value = f.ciudad.value;
 alert(f.provincia.value+" - "+f.ciudad.value+" - "+f.pais.value);  
 return true; 
}

</script>

<?php
/* $parametros = "";
 
 if($_REQUEST["formato"]=='carta')
 {               
  //$parametros = "<input type='hidden' name='parametros' value='&mostrar=".$_REQUEST["mostrar"]."&cargo=".$_REQUEST["cargo"]."&empresa=".$_REQUEST["empresa"]."&direccion=".$_REQUEST["direccion"]."&telefono=".$_REQUEST["telefono"]."&email=".$_REQUEST["email"]."&titulo=".$_REQUEST["titulo"]."'>";
  $parametros = "<input type='hidden' name='parametros' value='carta'>";   
 }         */
include_once("header.php");
?>

<font size="1,5" face="Verdana, Arial, Helvetica, sans-serif">
<p><span class="internos"><img class="imagen_internos" src="botones/general/radicacion_entrada.gif" border="0">&nbsp;&nbsp;ADICIONAR NUEVA CIUDAD DEL EXTERIOR</p>
</font>
<form action="municipioadd.php" method="POST" onsubmit="return validar(this);">
<table border="0">
<?php //echo $parametros; ?>
<tr><td class="encabezado">Pais: </td>
<td bgcolor="#f5f5f5"><input type="text" name="pais" value=""></td>
</tr>
<tr><td class="encabezado">Estado o Provincia: </td>
<td bgcolor="#f5f5f5"><input type="text" name="provincia" value=""></td>
</tr>
<tr><td class="encabezado">Ciudad: </td>
<td bgcolor="#f5f5f5"><input type="text" name="ciudad" value=""></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" value="Adicionar"></td></tr>
</table></form>
<?php
include_once("footer.php");
}
?>
  