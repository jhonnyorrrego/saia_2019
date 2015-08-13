<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	if(!@$_REQUEST["iddoc"])$_REQUEST["iddoc"]=@$_REQUEST["key"];
	include_once("pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"]);
}
if(!isset($_SESION))
  session_start();
include_once("db.php");
include_once("formatos/librerias/estilo_formulario.php");
global $conn;
$_SESSION["pagina_actual"]="";
$formato=0;
$documento=0;
$error=0;
$complemento="?cmd=resetall";
if(@$_REQUEST["idpaso_documento"]){
  $complemento.='&idpaso_documento='.$_REQUEST["idpaso_documento"];
}
if(@$_REQUEST["idformato"]){ 
  $idformato=$_REQUEST["idformato"];
}
if(@$_REQUEST["iddoc"]){
  $iddoc=$_REQUEST["iddoc"];
}
if(@$_REQUEST["key"]){
  $iddoc=$_REQUEST["key"];
}  
if(@$idformato){
  $formato=busca_filtro_tabla("imagen,ruta_adicionar,nombre,etiqueta,cod_padre","formato A","idformato=".$idformato,"",$conn);

}
else{
  $lformatos=busca_filtro_tabla("imagen,ruta_adicionar,nombre,etiqueta,cod_padre,idformato","formato A","mostrar=1 AND detalle=0","etiqueta",$conn);
}
if(@$iddoc&& !@$idformato){
  $documento=busca_filtro_tabla("numero","documento A","A.iddocumento=".$iddoc,"",$conn);
  if($documento["numcampos"]){
    if(!$documento[0]["numero"]){
      alerta("No se puede responder el documento porque no ha terminado su proceso.");
      volver(1);  
    }
    else{
      $paso_documento=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc,"GROUP BY diagram_iddiagram_instance",$conn);
      if($paso_documento["numcampos"]){
        $complemento.='&idpaso_documento='.$paso_documento[0]["idpaso_documento"];
      }
    }  
   }     
   if(!$formato["numcampos"])
    $complemento.="&anterior=".$iddoc;
}

if($formato["numcampos"])
{
  if(is_file("formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"])){
    //if($documento["numcampos"]){
    $padre=busca_filtro_tabla("nombre_tabla","formato","idformato=".$formato[0]["cod_padre"],"",$conn);
    
    $idpadre=busca_filtro_tabla("documento_iddocumento",$padre[0][0],"id".$padre[0][0]."=".$iddoc,"",$conn);
    redirecciona("formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"]."?anterior=".$idpadre[0][0]."&padre=".$iddoc."&idformato=".$idformato);
    //}
    /*else{
      redirecciona("formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"]);
    }*/
  }
  else alerta("El formato ".$formato[0]["nombre"]." No ha sido enontrado!");   
}
if($documento["numcampos"]){
menu_ordenar($iddoc);
}
?>
<table border=0 cellspacing=2 width="500px" bgcolor=''>
  <tr>
    <td class="encabezado_list" width='40%'>PLANTILLAS DISPONIBLES</td>
  </tr>
<?php
$paso = false;
if(isset($_REQUEST["idpaso_actividad"])){
	$complemento .= '&idpaso_actividad='.$_REQUEST["idpaso_actividad"];
	$propios = buscar_formatos_paso($_REQUEST["idpaso_actividad"]);
	$paso = true;
}
else {
	if(@$paso_documento[0]["paso_idpaso"]){
		$actividad = busca_filtro_tabla("distinct(diagram_iddiagram)","paso","idpaso=".@$paso_documento[0]["paso_idpaso"],"",$conn);
		$pasos = busca_filtro_tabla("","paso,paso_actividad","diagram_iddiagram=".$actividad[0]["diagram_iddiagram"]." and paso_idpaso=idpaso and accion_idaccion=6","",$conn);
		if($pasos["numcampos"] > 0){
			$complemento .= '&idpaso_actividad='.$pasos[0]["idpaso_actividad"];
			$propios = buscar_formatos_paso($pasos[0]["idpaso_actividad"]);
			$paso = true;
		}
	}
}
$permiso=new PERMISO();

for($i=0;$i<$lformatos["numcampos"];$i++)
{ 
  $ok=$permiso->acceso_modulo_perfil($lformatos[$i]["nombre"]);
  if($ok && is_file("formatos/".$lformatos[$i]["nombre"]."/".$lformatos[$i]["ruta_adicionar"]) && $lformatos[$i]["nombre"]!="mensaje"){
  	if($paso == true){
	  	if(in_array($lformatos[$i]["idformato"],$propios))
		{
		    echo "<tr bgcolor='#CCCCCC'>";
		    echo "<td align=center height='30px'>";
		    echo "<a href='formatos/".$lformatos[$i]["nombre"]."/".$lformatos[$i]["ruta_adicionar"].$complemento."' target='centro' >".mayusculas($lformatos[$i]["etiqueta"])."</a>";
		   /* agrega_boton("texto","","formatos/".$lformatos[$i]["nombre"]."/".$lformatos[$i]["ruta_adicionar"]."?idformato=".$lformatos[$i]["idformato"].$complemento,"centro",utf8_encode(strtoupper(html_entity_decode($lformatos[$i]["etiqueta"]))),"",strtolower(utf8_encode($lformatos[$i]["nombre"])));  */
		    echo "</td>";
		    echo"</tr>";
		}
	}
	else{
		echo "<tr bgcolor='#CCCCCC'>";
	    echo "<td align=center height='30px'>";
	    echo "<a href='formatos/".$lformatos[$i]["nombre"]."/".$lformatos[$i]["ruta_adicionar"].$complemento."' target='centro' >".mayusculas($lformatos[$i]["etiqueta"])."</a>";
	   /* agrega_boton("texto","","formatos/".$lformatos[$i]["nombre"]."/".$lformatos[$i]["ruta_adicionar"]."?idformato=".$lformatos[$i]["idformato"].$complemento,"centro",utf8_encode(strtoupper(html_entity_decode($lformatos[$i]["etiqueta"]))),"",strtolower(utf8_encode($lformatos[$i]["nombre"])));  */
	    echo "</td>";
	    echo"</tr>";
	}
  }  
}
/*echo "<tr bgcolor='#CCCCCC'>";
echo("<td align=center height='30px'>");
agrega_boton("texto","","formatos/buscar_formato.php","centro",strtoupper("BUSCAR FORMATO"),"","formatos");    
echo "</td>";
echo"</tr>";*/ 
?>
</table>
<?php
function buscar_formatos_paso($idactividad){
	global $complemento,$conn;
	$activi = busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$idactividad,"",$conn);
	if($activi[0]["formato_idformato"] != NULL){
		$formatos = explode(",",$activi[0]["formato_idformato"]);
		$cantidad = count($formatos);
		if($cantidad == 1){
			$formato = busca_filtro_tabla("","formato","idformato=".$activi[0]["formato_idformato"],"",$conn);
			abrir_url("formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"].$complemento,"centro");
			//echo("formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"].$complemento);
		}
	}
	return $formatos;
}
?>