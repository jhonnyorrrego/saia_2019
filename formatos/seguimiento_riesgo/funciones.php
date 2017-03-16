<?php
/*
function validar_politicas($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 $riesgo=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=".$_REQUEST["anterior"],"",$conn); 
  $seguimiento=busca_filtro_tabla("b.*","ft_seguimiento_riesgo b,documento c","b.ft_riesgos_proceso=".$riesgo[0]["idft_riesgos_proceso"]." AND b.documento_iddocumento=c.iddocumento and c.estado<>'ELIMINADO'","iddocumento desc",$conn);
  
  if($seguimiento["numcampos"])
    {$manejo=$seguimiento[0]["manejo"];
     $acciones=$seguimiento[0]["acciones"];
     $responsables=explode(",",$seguimiento[0]["responsables"]);
     $indicador=$seguimiento[0]["indicador"]; 
     $cronograma=$seguimiento[0]["cronograma"];
    }
  else
    {$manejo=$riesgo[0]["opciones_manejo"];
     $acciones=$riesgo[0]["acciones"];
     $responsables=explode(",",$riesgo[0]["responsables"]);
     $indicador=$riesgo[0]["indicador"];
     $cronograma=$riesgo[0]["cronograma"];
    } 

  echo "<script>
        $().ready(function() {
        
        document.getElementById('acciones').innerHTML='$acciones';
        document.getElementById('indicador').innerHTML='$indicador'; 
        document.getElementById('cronograma').innerHTML='$cronograma';
        document.getElementById('responsables').value='".implode(",",$responsables)."';
        $('#manejo option[value=$manejo]').attr('selected', 'selected');
        function llenar_responsables(){";
  for($i=0;$i<count($responsables);$i++)
     {echo "tree_responsables.setCheck('".$responsables[$i]."',true);";
     }      
  echo "}
       tree_responsables.setOnLoadingEnd(llenar_responsables);
       });</script>";  
}
*/
function opciones_control($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 
 echo "<tr style='display:none'><td class='encabezado'>LOS CONTROLES FRENTE AL RIESGO:</td>
       <td>
       <table>
       <tr><td>&iquest;SE EST&Aacute;N APLICANDO EN LA ACTUALIDAD?*</td>
       <td><input type='radio' value='1' name='aplican' id='aplican1'>Si
        &nbsp;&nbsp;&nbsp;<input type='radio' value='0' checked name='aplican' id='aplican0'>No
       </td>
       </tr>
       <tr><td>&iquest;SON EFECTIVOS PARA MINIMIZAR EL RIESGO?*</td>
       <td><input type='radio' value='1' name='minimiza'  id='minimiza1'>Si
        &nbsp;&nbsp;&nbsp;<input type='radio' value='0' checked name='minimiza'  id='minimiza0'>No
       </td>
       </tr>
       <tr><td>&iquest;EST&Aacute;N DOCUMENTADOS?*</td>
       <td><input type='radio' value='1' name='documentados' id='documentados1'>Si
        &nbsp;&nbsp;&nbsp;<input type='radio' value='0' checked name='documentados' id='documentados0'>No
       </td>
       </tr>
       </table>
       </td>
       </tr>";
 if($iddoc<>NULL)
   {$datos=busca_filtro_tabla("","ft_seguimiento_riesgo","documento_iddocumento=$iddoc","",$conn);
    if($datos["numcampos"])
      echo "<script>
          document.getElementById('aplican".$datos[0]["aplican"]."').checked=true;
          document.getElementById('minimiza".$datos[0]["minimiza"]."').checked=true;
          document.getElementById('documentados".$datos[0]["documentados"]."').checked=true;
          </script>";
   }
 
}

function opciones_valoracion($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 echo "<tr style='display:none'><td class='encabezado' >VALORACION DEL RIESGO ".'<br />"La valoracion del riesgo es el producto de confrontar los resultados de la evaluaci&oacute;n del riesgo con los controles identificados en el elemento de control"'.":</td>
       <td>
       <table>
       <tr><td>EL IMPACTO*</td>
       <td>
        <input type='radio' value='1' name='impacto' id='impacto1'>Disminuye
        &nbsp;&nbsp;<input type='radio' value='2' checked name='impacto' id='impacto2'>Continua igual
        &nbsp;&nbsp;<input type='radio' value='3' name='impacto' id='impacto3'>Aumenta
       </td>
       </tr>
       <tr><td>LA PROBABILIDAD*</td>
       <td>
        <input type='radio' value='1' name='probabilidad' id='probabilidad1'>Disminuye
        &nbsp;&nbsp;<input type='radio' value='2' checked name='probabilidad' id='probabilidad2'>Continua igual
        &nbsp;&nbsp;<input type='radio' value='3' name='probabilidad' id='probabilidad3'>Aumenta
       </td>
       </tr>
       </table>
       </td>
       </tr>";
 if($iddoc<>NULL)
   {$datos=busca_filtro_tabla("","ft_seguimiento_riesgo","documento_iddocumento=$iddoc","",$conn);
    if($datos["numcampos"])
      echo "<script>
          document.getElementById('impacto".$datos[0]["impacto"]."').checked=true;
          document.getElementById('probabilidad".$datos[0]["probabilidad"]."').checked=true;
          </script>";
   }
 else 
  {$datos=recalcular_valores();
   if($datos["impacto"]==20)
      echo "<script>  document.getElementById('impacto3').disabled=true; </script>";
   elseif($datos["impacto"]==5)
      echo "<script>  document.getElementById('impacto1').disabled=true; </script>";
   
   if($datos["probabilidad"]==1)
      echo "<script>  document.getElementById('probabilidad1').disabled=true; </script>";
   elseif($datos["probabilidad"]==3)
      echo "<script>  document.getElementById('probabilidad3').disabled=true; </script>";
  }   
}
function recalcular_valores($iddoc=NULL)
{if($iddoc==NULL)
   $riesgos=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=".$_REQUEST["anterior"],"",$conn); 
 else
   $riesgos=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn); 
 $seguimientos=busca_filtro_tabla("b.*","ft_seguimiento_riesgo b,documento c","b.ft_riesgos_proceso=".$riesgos[0]["idft_riesgos_proceso"]." AND b.documento_iddocumento=c.iddocumento and c.estado<>'ELIMINADO'","iddocumento asc",$conn);
 // print_r($riesgos);
  if($seguimientos["numcampos"]){ 
   for($j=0;$j<$seguimientos["numcampos"];$j++) 
    {if(/*$seguimientos[$j]["aplican"]&&$seguimientos[$j]["minimiza"]&&*/$seguimientos[$j]["probabilidad"]<>2)                                                
       {if($seguimientos[$j]["probabilidad"]==1 && $riesgos[0]["probabilidad"]>1)
         $riesgos[0]["probabilidad"]--;
        elseif($seguimientos[$j]["probabilidad"]==3 && $riesgos[0]["probabilidad"]<3) 
         $riesgos[0]["probabilidad"]++;
       }  
     if(/*$seguimientos[$j]["aplican"]&&$seguimientos[$j]["minimiza"]&&*/$seguimientos[$j]["impacto"]<>2) 
       {if($seguimientos[$j]["impacto"]==1 && $riesgos[0]["impacto"]>5)
          $riesgos[0]["impacto"]/=2;
        elseif($seguimientos[$j]["impacto"]==3 && $riesgos[0]["impacto"]<20) 
          $riesgos[0]["impacto"]*=2;
       } 
    }
    
  }
  //print_r($riesgos);
 return(array("impacto"=>$riesgos[0]["impacto"],"probabilidad"=>$riesgos[0]["probabilidad"])); 
} 
function notificar_seguimiento_riesgo($idformato,$iddoc)
{global $conn;
$responsables=busca_filtro_tabla("a.responsables,b.documento_iddocumento as id","ft_seguimiento_riesgo a,ft_riesgos_proceso b","ft_riesgos_proceso=idft_riesgos_proceso and a.documento_iddocumento=".$iddoc,"",$conn);
//print_r($responsables);die();
 if($responsables["numcampos"]){
  $datos["archivo_idarchivo"]=$responsables[0]["id"];
  $datos["origen"]=usuario_actual("funcionario_codigo");
  $datos["nombre"]="TRANSFERIDO";
  $datos["tipo"]="";
  $datos["tipo_origen"]="1";      
  $datos["tipo_destino"]="1";
  $lista=explode(",",$responsables[0]["responsables"]);
  for($i=0;$i<count($lista);$i++)
  {if(strpos($lista[$i],"#")!==false)
    $lista[$i]=buscar_funcionarios(str_replace("#","",$lista[$i]),$lista[$i]);
   else
     $lista[$i]=array($lista[$i]);
   transferir_archivo_prueba($datos,$lista[$i],"");
  }  
}

}
function accion_funcion($idformato,$iddoc){
	global $conn;
	if(@$_REQUEST["padre"]!=''){
		$padre=$_REQUEST["padre"];
	}
	else{
		$accion=busca_filtro_tabla("","ft_seguimiento_riesgo a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$padre=$accion[0]["ft_riesgos_proceso"];
	}
	
	$valoracion=busca_filtro_tabla("acciones_accion, idft_acciones_riesgo","ft_acciones_riesgo a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$padre,"idft_acciones_riesgo asc",$conn);
	
	$select='';
	$select.='<select name="accion_vinculacion" id="accion_vinculacion" class="required"><option value="">Por favor seleccione...</option>';
	for($i=0;$i<$valoracion["numcampos"];$i++){
		$selected='';
		if($accion[0]["accion_vinculacion"]==$valoracion[$i]["idft_acciones_riesgo"])$selected='selected';
		$select.='<option value="'.$valoracion[$i]["idft_acciones_riesgo"].'" '.$selected.'>'.ucfirst(strip_tags((html_entity_decode($valoracion[$i]["acciones_accion"])))).'</option>';
	}
	$select.='</select>';
	echo "<td>".$select."</td>";
}
function traer_nombre_accion($idformato,$iddoc){
	global $conn;
	$valor=busca_filtro_tabla("accion_vinculacion","ft_seguimiento_riesgo a","documento_iddocumento=".$iddoc,"",$conn);
	$descripcion=busca_filtro_tabla("acciones_accion","ft_acciones_riesgo a","a.idft_acciones_riesgo=".$valor[0]["accion_vinculacion"],"",$conn);
	echo ucfirst(strip_tags((html_entity_decode($descripcion[0]["acciones_accion"]))));
}

function listar_acciones_riesgo($idformato, $iddoc){
	global $conn;	
	
	if($_REQUEST['anterior']){
		$contrato = busca_filtro_tabla("B.idft_acciones_riesgo, B.acciones_accion","ft_riesgos_proceso A, ft_acciones_riesgo B","A.idft_riesgos_proceso=B.ft_riesgos_proceso AND A.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	}else{
			$contrato = busca_filtro_tabla("B.idft_acciones_riesgo, B.acciones_accion","ft_riesgos_proceso A, ft_acciones_riesgo B, ft_seguimiento_riesgo C","A.idft_riesgos_proceso=B.ft_riesgos_proceso AND A.idft_riesgos_proceso=C.ft_riesgos_proceso AND C.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);		
	}	
		
	$select ="<select name='accion_vinculacion' id='accion_vinculacion'>
				<option>Seleccione...</option>
			 ";
		for ($i=0; $i < $contrato['numcampos']; $i++) { 
			$select .="<option value='".$contrato[$i]['idft_acciones_riesgo']."'>".delimita($contrato[$i]['acciones_accion'],150)."</option>";
			
		}
	$select .="</select>";
	
	echo("<td>".$select."</td>");	
}

function botones_seguimiento_riesgos($idformato, $iddoc){
  global $ruta_db_superior;
    
  $seguimiento = busca_filtro_tabla("a.documento_iddocumento","ft_riesgo_proceso a, ft_seguimiento_riesgo b","a.idft_riesgos_proceso=b.ft_riesgos_proceso AND b.documento_iddocumento=".$iddoc,"",$conn);  
    
  $boton  = '<button type="button" id = "editar_seguimiento_riesgo">Editar</button>';
  $boton .= '<button type="button" id = "eliminar_seguimiento_riesgo" >Eliminar</button>';
    
  echo ($boton);
?>
<script type="text/javascript">
  $(document).ready(function(){    
    $("#editar_seguimiento_riesgo").click(function(){
      console.log("sdfsdf");
      window.open("<?php echo($ruta_db_superior);?>formatos/seguimiento_riesgo/editar_seguimiento_riesgo.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato);?>","_self");
    });
    
    $("#eliminar_seguimiento_riesgo").click(function(){        
      $.ajax({
        url: 'cambiar_estado_documento_seguimiento_riesgo.php',
        type: 'POST',
        dataType: 'json',
        data: {
          iddocumento: '<?php echo($iddoc); ?>'  
          },
        success: function(){
          window.open("<?php echo($ruta_db_superior);?>/formatos/riesgos_proceso/mostrar_riesgos_proceso.php?iddoc=<?php echo($seguimiento[0]["documento_iddocumento"]); ?>&idformato=13","_self");  
            
        }
    });
  });
 });
</script>
<?php
}
?>