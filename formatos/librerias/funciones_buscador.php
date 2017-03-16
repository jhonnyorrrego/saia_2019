<?php
include_once("../../db.php");

echo(buscar_plantilla());
function buscar_plantilla($tipo=0){
   global $conn;
   $insertado=0;
   $lasignaciones=array();
   $valores=array();
   $campos=array();
   $lista_campos=array();
   $where_busqueda=array();
   $consulta_busqueda="";
   $_POST["fecha"]=date("Y-m-d H:i:s");
    if(isset($_REQUEST["origen"])){
    $pos=strpos($_REQUEST["origen"],"_");
     if($pos!==false){
      $_REQUEST["origen"]=substr($_REQUEST["origen"],0,$pos);
     }
    }
   $buscar = phpmkr_query("SELECT A.*,".fecha_db_obtener("A.fecha",'Y-m-d H:i:s')." as fecha FROM ".$_REQUEST["tabla"]." A WHERE 1=0",$conn);

   if(@$_REQUEST["idformato"]){
    $idformato=$_REQUEST["idformato"];
   }
   else if(@$_REQUEST["tabla"]){
    $formato = busca_filtro_tabla("idformato","formato","nombre_tabla LIKE '".strtolower($_REQUEST["tabla"])."'","",$conn);
    if($formato["numcampos"]){
      $idformato = $formato[0]["idformato"];
    }
    else
      $idformato=0;
   }
   else
    $idformato=0;
   for($i=0;$i<phpmkr_num_fields($buscar);$i++){
    $nombre_campo=phpmkr_field_name($buscar,$i);
    array_push($lista_campos,$nombre_campo);
   }

   if($idformato){
    $ltareas=array();
    $larchivos=array();
    $where= "formato_idformato=".$idformato;
    if($i)
      $where.=" AND nombre IN('".implode("','",$lista_campos)."')";
    $lcampos=busca_filtro_tabla("idcampos_formato,tipo_dato,nombre,etiqueta_html","campos_formato",$where,"",$conn);
    for($j=0;$j<$lcampos["numcampos"];$j++){
      if($lcampos[$j]["tipo_dato"]=="DATE" && $_REQUEST[$lcampos[$j]["nombre"]."_1"] && $_REQUEST[$lcampos[$j]["nombre"]."_2"])
        {$fecha_x=@$_REQUEST[$lcampos[$j]["nombre"]."_1"];
         $fecha_y=@$_REQUEST[$lcampos[$j]["nombre"]."_2"];
         array_push($where_busqueda,array($lcampos[$j]["nombre"]=>"(".$lcampos[$j]["nombre"]." >=".fecha_db_obtener($fecha_x,"Y-m-d").' AND '.$lcampos[$j]["nombre"]."<=".fecha_db_obtener($fecha_y,"Y-m-d").")"));
        }
      elseif($lcampos[$j]["tipo_dato"]=="DATETIME" && $_REQUEST[$lcampos[$j]["nombre"]."_1"] && $_REQUEST[$lcampos[$j]["nombre"]."_2"]) 
        {$fecha_x="'".@$_REQUEST[$lcampos[$j]["nombre"]."_1"]."'";
         $fecha_y="'".@$_REQUEST[$lcampos[$j]["nombre"]."_2"]."'";
         array_push($where_busqueda,array($j=>"(".$lcampos[$j]["nombre"]." >=".fecha_db_obtener($fecha_x,"Y-m-d H:i:s").' AND '.$lcampos[$j]["nombre"]."<=".fecha_db_obtener($fecha_y,"Y-m-d H:i:s").")"));
        } 
      elseif(@$_REQUEST[$lcampos[$j]["nombre"]]){
        /*Valida las etiquetas html Para organizar arreglos especificos para procesar Ej:detalles,tareas*/
        $procesado=0;
        switch(strtolower($lcampos[$j]["etiqueta_html"])){
  	     case "archivo":
              $dato_temporal=$_REQUEST[$lcampos[$j]["nombre"]];
              $texto_temp=array();
              
              foreach($dato_temporal AS $llave_temp=>$valor_temp){
                $texto_temp[]=" etiqueta LIKE '%".$valor_temp."%' ";
              }
              if(count($texto_temp)>0)
                 $texto_temp=" and (".implode(" ".$_REQUEST["compara_".$lcampos[$j]["nombre"]]." ",$texto_temp).")";
              else
                 $texto_temp="";   
              //die($texto_temp);
              if($texto_temp!=""){
    	         array_push($where_busqueda,array($j=>'(documento_iddocumento IN( SELECT documento_iddocumento FROM anexos WHERE campos_formato='.$lcampos[$j]["idcampos_formato"].' AND formato='.$idformato.$texto_temp.'))'));
    	         
    	        }
    	      $procesado=1;   
    	    break;    
    	    case "ejecutor":
    	        $dato_temporal=implode("%' ".$_REQUEST["compara_".$lcampos[$j]["nombre"]]." nombre like '%",$_REQUEST[$lcampos[$j]["nombre"]]);
              $condiciones=array();
              if($dato_temporal<>'')
              {if($_REQUEST[$lcampos[$j]["nombre"]][0]=="")
    	             $_REQUEST[$lcampos[$j]["nombre"]][0]=0;            
               $r_ejecutor=busca_filtro_tabla("distinct iddatos_ejecutor","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and (nombre like '%$dato_temporal%')","",$conn);
               //print_r($r_ejecutor);die();
              for($m=0;$m<$r_ejecutor["numcampos"];$m++)
                  $condiciones[]=$lcampos[$j]["nombre"]." like '".$r_ejecutor[$m][0]."' or ".$lcampos[$j]["nombre"]." like '%,".$r_ejecutor[$m][0]."' or ".$lcampos[$j]["nombre"]." like '".$r_ejecutor[$m][0].",%' or ".$lcampos[$j]["nombre"]." like '%,".$r_ejecutor[$m][0].",%' ";
               if(implode("",$condiciones)<>"")
                  array_push($where_busqueda,array($j=>"(".implode(" or ",$condiciones).")"));   
               
              }
             else
               $_REQUEST[$lcampos[$j]["nombre"]]="";
            $procesado=1;      
          break;
        }
      /*Validaciones especiales para los tipos de dato */
        if(!$procesado)
         {switch($lcampos[$j]["tipo_dato"]){
          case "BLOB":
            $contenido=strip_tags(@$_REQUEST[$lcampos[$j]["nombre"]]);
            $palabras=explode(" ",$contenido);
            $condiciones=array();
            for($h=0;$h<count($palabras);$h++)
               $condiciones[]="(lower(".$lcampos[$j]["nombre"].") like '%".htmlspecialchars($palabras[$h])."%')";
          
            $condiciones="(".implode($_REQUEST["compara_".$lcampos[$j]["nombre"]],$condiciones).")";   
            array_push($where_busqueda,array($j=>$condiciones));
           break;       
           default:
            if($_REQUEST["compara_".$lcampos[$j]["nombre"]]=="and" || $_REQUEST["compara_".$lcampos[$j]["nombre"]]=="or" )
               {if(is_array($_REQUEST[$lcampos[$j]["nombre"]]))
                  $destinos=$_REQUEST[$lcampos[$j]["nombre"]];
                else  
                  $destinos=explode(",",strip_tags($_REQUEST[$lcampos[$j]["nombre"]]));
                $nombre=$lcampos[$j]["nombre"];
               // echo  "<br /><br /><br />".strtolower($lcampos[$j]["etiqueta_html"]) ;
                if(strtolower($lcampos[$j]["etiqueta_html"])=="arbol")
                {$comparaciones=array();
                 for($h=0;$h<count($destinos);$h++)
                  {$comparaciones[]="($nombre like '".$destinos[$h]."' or $nombre like'%,".$destinos[$h]."' or $nombre like '".$destinos[$h].",%' or $nombre like '%,".$destinos[$h].",%')";
                  }
                 array_push($where_busqueda,array($j=>"(".implode($_REQUEST["compara_".$lcampos[$j]["nombre"]],$comparaciones).")"));
                 }
                else
                 {//$contenido=strip_tags(@$_REQUEST[$lcampos[$j]["nombre"]]);
                  //$palabras=explode(" ",$contenido);
                  $condiciones=array();
                  for($h=0;$h<count($destinos);$h++)
                     $condiciones[]="(lower(".$lcampos[$j]["nombre"].") like '%".htmlspecialchars($destinos[$h])."%')";
                
                  $condiciones="(".implode($_REQUEST["compara_".$lcampos[$j]["nombre"]],$condiciones).")";   
                  array_push($where_busqueda,array($j=>$condiciones));
                 }       
                
               }
            elseif($lcampos[$j]["etiqueta_html"]!="arbol"){
             if(@$_REQUEST[$lcampos[$j]["nombre"]]<>'')
                array_push($where_busqueda,array($lcampos[$j]["nombre"]=>((@$_REQUEST[$lcampos[$j]["nombre"]]))));
            }
          break;
        }
       } 
      }
     }
    }
//die();
$j=0;
for($i=0;$i<count($where_busqueda);$i++){
  foreach($where_busqueda[$i] as $llave=>$valor){
    //echo($llave."<---->".$valor."<br />");
    if($valor!=''){
      $condicion="AND";
      $compara=" = ";
      //echo($_REQUEST["condicion_".$llave]."<br />".$j."<br />");
      if(@$_REQUEST["condicion_".$llave]){
        $condicion=$_REQUEST["condicion_".$llave];
      }
      if(@$_REQUEST["compara_".$llave]){
        $compara=$_REQUEST["compara_".$llave];
      }
      if(is_int($llave)){
        if($j==0)
          $consulta_busqueda.=$valor;
        else $consulta_busqueda.=" ".$condicion." ".$valor;
      }
      else{
        $consulta_busqueda.=regenera_comparacion($condicion,$compara,$llave,$valor,$j);
      }
      $j++;
    }
  }
}

if($consulta_busqueda<>"")
{$resultado=ejecuta_filtro_tabla("SELECT documento_iddocumento FROM ".$_REQUEST["tabla"]." WHERE $consulta_busqueda",$conn);
 if($resultado["numcampos"])
   {$ids=extrae_campo($resultado,"documento_iddocumento","U");
    $consulta_busqueda="(".implode(",",$ids).")";
   }
 else
   $consulta_busqueda="(0)";
}
else
$consulta_busqueda="(0)";
/*tipo=1 es para desplegar por pantalla, */

if($tipo==1 || @$_REQUEST["tipo_despliegue"]==1){
  /*Generar pantalla*/
}
elseif($tipo==2 || isset($_REQUEST["campo__retorno"])){
  echo "<script>parent.document.getElementById('".$_REQUEST["campo__retorno"]."').value=\"$consulta_busqueda\";
        window.parent.hs.close();
        </script>";
}
else {
  return($consulta_busqueda);
}
}
function regenera_comparacion($condicion,$cadena,$llave,$valor,$j){
$retorno=array();
$cadena=str_replace("+","<",$cadena);
$cadena=str_replace("!","<>",$cadena);
$cadena=str_replace("-",">",$cadena);
$cadena=str_replace("@","",$cadena);
$comparar=explode("|",$cadena);
if($j==0)
  $consulta_busqueda="(".$llave." ".$comparar[0]." '".$comparar[1].$valor.$comparar[2]."')";
else
  $consulta_busqueda.=$condicion." (lower(".$llave.") ".$comparar[0]." '".$comparar[1].strtolower($valor).$comparar[2]."')";
return($consulta_busqueda);
}
?>
