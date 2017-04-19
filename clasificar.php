<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["iddocumento"]){
	$_REQUEST["iddoc"]=@$_REQUEST["iddocumento"];
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
else{
	include("db.php");
}
session_start();
include("header.php");
include ("phpmkrfn.php");
include_once ("class_transferencia.php");
global $conn;
?>
<script language="javascript" type="text/javascript">

function EW_checkMyForm(EW_this) 
{ 
    
  var list_funcionarios = tree2.getAllChecked();  
  var funcionarios = list_funcionarios.split(",");
  if(funcionarios.length>1)
  {
    alert("Se debe elegir s�lo una clasificaci�n del documento");
		return false;  
  }         
  else if(list_funcionarios!="")
    document.clasificar.x_serie.value=list_funcionarios;
    
  return true;   
}
</script>
<?php
$x_iddocumento = Null;
$x_serie = Null;
$x_dias = Null;

 if(isset($_REQUEST["x_serie"]))
   {//actulizo la serie del documento
     $dias='';
	 $doc=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST["iddocumento"],"",$conn);
	 if($doc[0]["numero"]){
	 	$dias=",dias='".$_REQUEST["x_dias"]."'";
	 }
	 else{
	 	alerta('Los dias no seran modificados porque el documento no ha sido aprobado');
	 }
     $sql_up = "update documento set serie='".$_REQUEST["x_serie"]."', responsable='".usuario_actual("idfuncionario")."'".$dias." where iddocumento=".$_REQUEST["iddocumento"];
     phpmkr_query($sql_up, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql_up);
    
     if($_REQUEST["origen"]!="documentoview")
       $origen="ordenar.php?accion=mostrar&key=".$_REQUEST["iddocumento"];
     else
       $origen="documentoview.php?key=".$_REQUEST["iddocumento"];  
      redirecciona($origen);
   }
   else
   {
      LoadData($_REQUEST["iddocumento"],$conn);
   }
?>
<!--div  align="center">
<?php menu_ordenar($_REQUEST["iddocumento"]); ?><br /><br />
</div-->
<table border="0">
<?php
if(isset($_GET["origen"]))
 $origen = "documentoview";
else
  $origen = "ordenar";
$detalle_doc=busca_filtro_tabla("numero,fecha,descripcion,serie,dias","documento","iddocumento=".$_REQUEST["iddocumento"],"",$conn);
if(is_object($detalle_doc[0]["fecha"]))$detalle_doc[0]["fecha"]=$detalle_doc[0]["fecha"]->format('Y-m-d');
?><tr><td><span class="internos">CLASIFICAR DOCUMENTO</span></td></tr>
<tr><td><a href="expediente_llenar.php?iddoc=<?php echo $_REQUEST['iddocumento']; ?>">Asociar este documento a un Expediente existente</a></td></tr>
<tr>
<td class="encabezado"><span class="phpmaker" style="color:#ffffff;">
N&Uacute;MERO DE RADICACI&Oacute;N&nbsp;
</span></td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $detalle_doc[0]["numero"];?>
</span></td>
</tr>
<tr>
<td class="encabezado"><span class="phpmaker" style="color:#ffffff;">
FECHA DE INICIO DE PROCESO
</span></td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($detalle_doc[0]["fecha"],5);?>
</span></td>
</tr>
<tr>
<td class="encabezado"><span class="phpmaker" style="color:#ffffff;">
DESCRIPCI&Oacute;N DEL DOCUMENTO&nbsp;
</span></td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", stripslashes($detalle_doc[0]["descripcion"])); ?>
</span></td>
</tr>
</table><br>
<form name="clasificar" id="clasificar" action="clasificar.php" method="post" onSubmit="return EW_checkMyForm(this);">
<input type="hidden" name="iddocumento" value="<?php echo $_REQUEST["iddocumento"]; ?>">
<input type="hidden" name="origen" value="<?php echo $origen; ?>">
<table>
<tr width=80%> 
        <td class="encabezado" title="Seleccione el tipo de documento de acuerdo a los tipos documentales de la entidad"><span  style="color: #FFFFFF;" class='phpmaker'>CLASIFICACI&Oacute;N DEL DOCUMENTO</span></td>       
            <td bgcolor="#F5F5F5" class='phpmaker'>
            <?php            
             if($detalle_doc[0]["serie"]!=0)
             { $serie = busca_filtro_tabla("nombre,dias_entrega,idserie","serie","idserie=".$detalle_doc[0]["serie"],"",$conn);               
               if($serie["numcampos"]>0)
                 echo ucwords($serie[0]["nombre"])."<br /><br />";
             }
             echo arbol_serie('?categoria=2'); ?> 
            <input type="hidden" name="x_serie" id="x_serie" value="<?php echo @$serie[0]["idserie"];?>">
            </td>
      </tr>
    <tr width=80%> 
        <td class="encabezado" title="D&iacute;as de entrega del documento">        
        <span style="color: #FFFFFF;" class='phpmaker'>TIEMPO DE RESPUESTA (D&Iacute;AS)</span></td>
        <td bgcolor="#F5F5F5"><span class='phpmaker'>
        <?php
         if($detalle_doc[0]["dias"]>0)
          echo $detalle_doc[0]["dias"]." d&iacute;as&nbsp;&nbsp;<br /><br />";
         elseif($detalle_doc[0]["serie"]!=0)
          echo $serie[0]["dias_entrega"]." d&iacute;as&nbsp;&nbsp;<br /><br />";  
        ?>
        <select id="dias" name="x_dias"><option value="0">..</option>
        <?php
        $dias="";
        for($i=0; $i<10; $i++)
        {
          $dias .= "<option value='".($i+1)."' ";
          if(($i+1) == $x_dias)
            $dias .= "selected";
          $dias .= ">".($i+1)."</option>";
        }
        echo $x_dias;
        echo $dias;         
        ?>
        </select>
        </span> 
    </td>
    </tr width=80%>    
      <tr>
      <td colspan="2" bgcolor="#F5F5F5" align="center" class='phpmaker'>
      <input type="submit" name="Action" id="Action" value="CONTINUAR" class="buttonSubmit">
      </td>
      </tr>
</table></form>
<?php
include("footer.php");

function LoadData($sKey,$conn)
{
	global $_SESSION;
	global $x_iddocumento;
  global $x_serie;
	global $x_dias;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT iddocumento, serie, dias FROM documento A";
	$sSql .= " WHERE iddocumento = " . $sKeyWrk;

	$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;	
		// Get the field contents
		$x_iddocumento = $row["iddocumento"];
		$x_serie = $row["serie"];
		$x_dias = $row["dias"];
	}
	phpmkr_free_result($rs);  	
	return $LoadData;
}


 
