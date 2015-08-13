<?php
include_once("../../db.php");
include_once("../../header.php");
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/jquery.media.js"></script>
<script type="text/javascript">
    $(function() {
      /*$.fn.media.mapFormat('tif','quicktime');
      $.fn.media.mapFormat('tiff','quicktime');*/
      $('a.media').media({width:110, height:200});
    });
function cadena_anexos(f)
{ var id="";
  for (i=0;i<document.form.elements.length;i++) 
   if(document.form.elements[i].type == "checkbox") 
    //if(document.form.elements[i].checked)
      id += document.form.elements[i].value+",";
    /*else
      id += "0,";
     */   
  if(id!="")
  { document.form.editar.value=id;
    return true;
  }
  else
  { alert("Debe seleccionar un anexo para editar.");
     return false;
  } 
}    
</script>
<?php
if(isset($_REQUEST["editar"]))
{ $est = array();
  $est=explode(",",$_REQUEST["editar"]);
  if(edicion_estructura_anexos($est))
  { echo "<script>window.close();</script>";
  } 
}
if(@$_REQUEST["iddoc"] && @$_REQUEST["idformato"]){
  $anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
  $dato_formato=busca_filtro_tabla("","ft_anexos_hoja_vida","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
  $texto='';
  $encabezado='';
  if($dato_formato["numcampos"]){
    $encabezado.='Estructura:'.$dato_formato[0]["fecha_vigencia"]."<br /><br />";
    $lestructura=busca_filtro_tabla("","ft_estructura_hoja_vida","1=1","",$conn);
    $texto.='<form name="form" action="reasignar_anexos.php" Onsubmit="return cadena_anexos(this);"><table width="100%" border="1px"><input type="hidden" name="editar" value="si"><input type="hidden" name="iddoc" value="'.$_REQUEST["iddoc"].'"><input type="hidden" name="idhv" value="'.$dato_formato[0]["ft_hoja_vida"].'"><input type="hidden" name="estructura" value="'.$dato_formato[0]["estructura"].'">';
    $texto.='<tr class="encabezado_list"><td>Nombre Anexo</td><td>Estructura</td><td>&nbsp;</td></tr>';
    for($i=0;$i<$anexos["numcampos"];$i++){
      $radio = '<input type="checkbox" id="idanexo'.$i.'" value="'.$anexos[$i]["idanexos"].'"> ';
      $texto.='<tr><td>'.$radio.$anexos[$i]["etiqueta"].'</td>';
      if($lestructura["numcampos"]){
        $texto.='<td><select name="idehv'.$i.'" onchange="document.form.idanexo'.$i.'.checked=1;">';
        for($j=0;$j<$lestructura["numcampos"];$j++){
          $texto.='<option value="'.$lestructura[$j]["idft_estructura_hoja_vida"].'"';
          if($dato_formato[0]["estructura"]==$lestructura[$j]["idft_estructura_hoja_vida"]){
            $texto.=' SELECTED ';
          }
          $texto.='>'.$lestructura[$j]["nombre"].'</option>';
        }
        $texto.='</select></td>';
      }
      $texto.='</td><td>'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$anexos[$i]["ruta"].'" class="media">Descargar</a></td></tr>';
      //$texto.='</td><td><a href="http://'.RUTA_PDF.'/'.$anexos[$i]["ruta"].'" class="media">Descargar</a></td></tr>';
    }
    $texto.='<tr align="center"><td colspan="3"><input type="submit"></td></tr>';
    $texto.='</table></form>';
  }
echo($encabezado.$texto);
}

function edicion_estructura_anexos($idanexos)
{ 
  global $conn;
  $iddoc = $_REQUEST["iddoc"];
  $idhv = $_REQUEST["idhv"];
  $estructura = $_REQUEST["estructura"];
  for($i=0; $i<count($idanexos)-1; $i++)
  { $idehv = $_REQUEST["idehv".$i];
   if($estructura != $idehv)
   {
    $anexo_formato = busca_filtro_tabla("*","ft_anexos_hoja_vida","ft_hoja_vida=".$idhv." AND estructura=".$idehv,"",$conn);
    /*print_r($_REQUEST);
    print_r($anexo_formato);
    die();*/
    if($anexo_formato["numcampos"]>0)
    { $iddoc=$anexo_formato[0]["documento_iddocumento"];       
    }
    else
     {
      $nuevo = "insert into ft_anexos_hoja_vida (ft_hoja_vida,serie_idserie,estructura,fecha_vigencia,documento_iddocumento) values($idhv,0,$idehv,'".date("Y-m-d H:i:s")."',0)";    
      phpmkr_query($nuevo,$conn);
      $arreglo["idtabla"]=phpmkr_insert_id();      
      $arreglo["plantilla"]="ANEXOS_HOJA_VIDA";    
      $arreglo["tabla"]="ft_anexos_hoja_vida";    
      $arreglo["idplantilla"]=72;
      $arreglo["responsable"]='NULL';
      $iddoc=migrar_formato_hoja($arreglo);        
     }
     phpmkr_query("update anexos set documento_iddocumento=$iddoc where idanexos=".$idanexos[$i],$conn);
   }
  } 
  return true;        
}

function migrar_formato_hoja($arreglo){
include_once("../../class_transferencia.php");
  global $conn,$sql;
  $plantilla=$arreglo["plantilla"];
  $tabla=$arreglo["tabla"];
  $idtabla=$arreglo["idtabla"];
  $idplantilla=$arreglo["idplantilla"];
  $valores=array("fecha"=>fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s'));
  $valores["responsable"]=$arreglo["responsable"];
  $valores["municipio_idmunicipio"]=658;
  $valores["descripcion"]="'";
  $_POST["encabezado"]=1;
  $_POST["iddoc"]=0;
  //hace el ejecutor igual al codigo del funcionario logueado actualmente
  if(!@$_POST["ejecutor"])
    $_POST["ejecutor"]=$_SESSION["usuario_actual"];
  $valores["ejecutor"]=$_POST["ejecutor"];  
  //si en el formato no existe descripcion le pongo el asunto
  $campo=busca_filtro_tabla("","campos_formato","formato_idformato =".$idplantilla." AND acciones LIKE '%d%'","orden",$conn);  
  $dato_formato=busca_filtro_tabla("",$tabla,"id".$tabla."=".$idtabla,"",$conn);
  for($i=0;$i<$campo["numcampos"];$i++){
    $valores["descripcion"].=$campo[$i]["nombre"].":".$dato_formato[0][$campo[$i]["nombre"]]."<br />";
  }
  $valores["descripcion"].="'";
  $valores["plantilla"]="'".$plantilla."'";
  $formato=busca_filtro_tabla("","formato","idformato=".$idplantilla,"",$conn);
  if($formato["numcampos"] && @$formato[0]["contador_idcontador"]){
    echo("<br />1<br />");
    $tipo_rad=busca_filtro_tabla("","contador","idcontador=".$formato[0]["contador_idcontador"],"",$conn);
    if($tipo_rad["numcampos"]){
      $tipo_radicado=$tipo_rad[0]["nombre"];
      $valores["tipo_radicado"]=$tipo_rad[0]["idcontador"];
    }
  }  
  $_POST["iddoc"]=radicar_documento_prueba($tipo_radicado,$valores);
  if($_POST["iddoc"]){
    $sql='UPDATE '.DB.'.'.$tabla.' SET documento_iddocumento='.$_POST["iddoc"].' WHERE id'.$tabla.'='.$idtabla;
    phpmkr_query($sql,$conn);
    if($formato["numcampos"])
      $banderas=explode(",",$formato[0]["banderas"]);
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="BORRADOR";
    $datos["tipo_destino"]=1;
    $datos["tipo"]="";
    $aux_destino[0]=$_SESSION["usuario_actual"];
    //realizo la primera transferencia del creador de la plantilla para el mismo,
    //para poder editarla antes de enviarla
    transferir_archivo_prueba($datos,$aux_destino,$adicionales,"");
    //para enviarla a los otros destinos si los tiene
    //Aprobar documento
    $rs=busca_filtro_tabla("f.funcionario_codigo as cod",DB.".configuracion A,funcionario f","A.nombre like 'radicador_salida' and f.login=A.valor","",$conn);    
    if($rs["numcampos"]>0)
     {      
        $datos["nombre"]="POR_APROBAR";        
        $aux_destino[0]= $rs[0]["cod"];
        $adicionales["activo"]=1;               
        transferir_archivo_prueba($datos,$aux_destino,$adicionales,"");
        aprobar($_POST["iddoc"]);                          
     }    
  }  
return(@$_POST["iddoc"]);
}
include_once("../../footer.php");
?>
