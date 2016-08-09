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
function opciones_control($idformato,$idcampo,$iddoc=NULL){
  global $conn; 
  echo "<tr><td class='encabezado'>LOS CONTROLES FRENTE AL RIESGO:</td>
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
  if($iddoc<>NULL){
    $datos=busca_filtro_tabla("","ft_seguimiento_riesgo","documento_iddocumento=$iddoc","",$conn);
    if($datos["numcampos"])
      echo "<script>
          document.getElementById('aplican".$datos[0]["aplican"]."').checked=true;
          document.getElementById('minimiza".$datos[0]["minimiza"]."').checked=true;
          document.getElementById('documentados".$datos[0]["documentados"]."').checked=true;
          </script>";
  } 
}
function opciones_valoracion($idformato,$idcampo,$iddoc=NULL){
  global $conn;
  echo "<tr><td class='encabezado' >VALORACION DEL RIESGO ".'<br />"La valoracion del riesgo es el producto de confrontar los resultados de la evaluaci&oacute;n del riesgo con los controles identificados en el elemento de control"'.":</td>
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
  if($iddoc<>NULL){
    $datos=busca_filtro_tabla("","ft_seguimiento_riesgo","documento_iddocumento=$iddoc","",$conn);
    if($datos["numcampos"])
      echo "<script>
          document.getElementById('impacto".$datos[0]["impacto"]."').checked=true;
          document.getElementById('probabilidad".$datos[0]["probabilidad"]."').checked=true;
          </script>";
  }else{
    $datos=recalcular_valores();
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
function recalcular_valores($iddoc=NULL){
  if($iddoc==NULL)
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
function notificar_seguimiento_riesgo($idformato,$iddoc){
  global $conn;
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
    for($i=0;$i<count($lista);$i++){
      if(strpos($lista[$i],"#")!==false)
        $lista[$i]=buscar_funcionarios(str_replace("#","",$lista[$i]),$lista[$i]);
      else
        $lista[$i]=array($lista[$i]);
      transferir_archivo_prueba($datos,$lista[$i],"");
    }  
  }
}
?>