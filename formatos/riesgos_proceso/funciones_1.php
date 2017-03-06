<?php
include_once("../../db.php");
include_once("../seguimiento_riesgo/funciones.php");

function danio_riesgo($idformato,$iddoc){
  global $conn;
  $texto="";
  
  $rotulo=validar_cuadrante($iddoc);
  $texto.="<div style='width:100%; height=100%; background-color:".$rotulo["color"].";' >".$rotulo["nombre"]."</div>";
  echo($texto);
} 
function editar_riesgos_proceso($idformato,$iddoc){
  global $conn;
  $formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);
  if(!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1){
    $perm=new PERMISO(); 
    $ok=$perm->acceso_modulo_perfil("editar_riesgos_proceso");
      if($ok){ 
        ?>
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
        $().ready(function() {
       	$('#editar_riesgo').click(function(){
           window.location="<?php echo $formato[0]['ruta_editar'].'?idformato=$idformato&iddoc='.$iddoc; ?>";
         })
        });
        </script>
        <a href='#' id='editar_riesgo'>Editar Riesgo</a>
        <?php
      }       
  }
}
function impacto_nuevo($idformato,$iddoc){
  $etiquetas=array("5"=>"Leve","10"=>"Moderado","20"=>"Catastr&oacute;fico");
  $valores=recalcular_valores($iddoc);
  echo $etiquetas[$valores["impacto"]];
}
function probabilidad_nueva($idformato,$iddoc){
  $etiquetas=array("1"=>"Baja","2"=>"Media","3"=>"Alta");
  $valores=recalcular_valores($iddoc);
  //echo $etiquetas[$valores["probabilidad"]];
  echo mostrar_valor_campo("probabilidad",$idformato,$iddoc,1);
}
function ultimas_politicas($idformato,$iddoc){
  global $conn;
  $idformato_riesgos_proceso=busca_filtro_tabla("idformato","formato","nombre='riesgos_proceso'","",$conn);
  $riesgo=busca_filtro_tabla("","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn); 
  /* $seguimiento=busca_filtro_tabla("b.*","ft_seguimiento_riesgo b,documento c","b.ft_riesgos_proceso=".$riesgo[0]["idft_riesgos_proceso"]." AND b.documento_iddocumento=c.iddocumento and c.estado<>'ELIMINADO'","iddocumento desc",$conn);
  if($seguimiento["numcampos"])
    {$manejo=mostrar_valor_campo('manejo',14,$seguimiento[0]["documento_iddocumento"],1);
     $acciones=$seguimiento[0]["acciones"];
     $indicador=$seguimiento[0]["indicador"]; 
     $cronograma=$seguimiento[0]["cronograma"];
    }  
  else */
    {$manejo=mostrar_valor_campo('opciones_manejo',$idformato_riesgos_proceso[0]['idformato'],$iddoc,1);
     $acciones=$riesgo[0]["acciones"];
     $indicador=$riesgo[0]["indicador"];
     $cronograma=$riesgo[0]["cronograma"];
    } 
 echo htmlspecialchars_decode("<table WIDTH=100%>
       <tr><td class=encabezado WIDTH=30%>Opciones de manejo</td>
       <td>$manejo</td></tr>
       <tr><td class=encabezado>Acciones</td><td>$acciones</td></tr>
       <tr><td class=encabezado>Responsables</td><td>");
  if($seguimiento["numcampos"]){
     $idformato_seguimiento_riesgo=busca_filtro_tabla("idformato","formato","nombre='seguimiento_riesgo'","",$conn);
     listar_funcionarios($idformato_seguimiento_riesgo[0]['idformato'],"responsables",$seguimiento[0]["documento_iddocumento"]);      
  }else{
      listar_funcionarios($idformato_riesgos_proceso[0]['idformato'],"responsables",$iddoc);   
  }


       
  echo htmlspecialchars_decode("</td></tr>
       <tr><td class=encabezado>Indicador</td><td>$indicador</td></tr>
       <tr><td class=encabezado>Cronograma</td><td>$cronograma</td></tr>
       </table>");
}
function validar_cuadrante($iddoc){
  $valores=recalcular_valores($iddoc);

  $total=$valores["impacto"]*$valores["probabilidad"];
  switch($total){
      case 5:
    $rotulo=array("color"=>"#CCFF66","nombre"=>"Riesgo Aceptable");
    break;
      case 10: 
    $rotulo=array("color"=>"#71cc1e","nombre"=>"Riesgo Tolerable");
    break;
      case 15:    
    $rotulo=array("color"=>"yellow","nombre"=>"Riesgo Moderado");
    break;
      case 20:    
    $rotulo=array("color"=>"#FFCC00","nombre"=>"Riesgo Moderado");
    break; 
      case 30:    
    $rotulo=array("color"=>"#FFC0A0","nombre"=>"Riesgo Importante");
    break; 
      case 40:    
    $rotulo=array("color"=>"#FF6060","nombre"=>"Riesgo Importante");
    break; 
      case 60:    
    $rotulo=array("color"=>"red","nombre"=>"Riesgo Inaceptable");
    break; 
  }                 
return($rotulo);
}
function consecutivo_riesgo($idformato,$idcampo,$iddoc=NULL){
  global $conn;
  
  if($iddoc==NULL){
    $riesgos=busca_filtro_tabla("idft_riesgos_proceso,consecutivo","ft_riesgos_proceso r,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso=".$_REQUEST["padre"]." AND r.estado<>'INACTIVO'","consecutivo asc",$conn);
  }else{
    $padre=busca_filtro_tabla("ft_proceso","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn);
    $riesgos=busca_filtro_tabla("idft_riesgos_proceso,consecutivo","ft_riesgos_proceso r,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso=".$padre[0][0]." AND r.estado<>'INACTIVO'","consecutivo asc",$conn);   
  } 
  $j=1;
  for($i=0;$i<$riesgos["numcampos"];$i++){
    if($riesgos[$i]["consecutivo"]<>$j){
      $sql="update ".DB.".ft_riesgos_proceso set consecutivo=$j where idft_riesgos_proceso='".$riesgos[$i]["idft_riesgos_proceso"]."'";
      phpmkr_query($sql,$conn);
    }
    $j++;
   }
 
 if($iddoc==NULL) 
    $riesgos[0][0]=$j;
 else
    $riesgos=busca_filtro_tabla("consecutivo","ft_riesgos_proceso","documento_iddocumento=$iddoc","",$conn);     
 echo "<td><input type='text' name='consecutivo' value='".($riesgos[0][0])."' ></td>"; 
}
function notificar_riesgo($idformato,$iddoc){
  global $conn;
  $responsables=busca_filtro_tabla("responsables","ft_riesgos_proceso","documento_iddocumento=".$iddoc,"",$conn);
  //print_r($responsables);die();
  if($responsables["numcampos"]){
    $datos["archivo_idarchivo"]=$iddoc;
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
function controles_funcion($idformato,$iddoc){
	global $conn;
	$controles=busca_filtro_tabla("controles","ft_riesgos_proceso a","a.documento_iddocumento=".$iddoc,"",$conn);
	echo codifica_encabezado(html_entity_decode($controles[0]["controles"]));
}
?>