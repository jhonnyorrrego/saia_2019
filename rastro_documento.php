<?php
include_once("db.php");
$iddoc=$_REQUEST["iddoc"];
$x_doc=$iddoc;
$start=$_REQUEST["inicio"];

$cantidad=busca_filtro_tabla("count(*) as cant","buzon_salida","archivo_idarchivo=$iddoc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","",$conn);

$cantidad_maxima_rastro=busca_filtro_tabla("","configuracion a","nombre='cantidad_maxima_rastro' and tipo='rastro'","",$conn);

$recorrido=busca_filtro_tabla_limit("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$iddoc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","order by idtransferencia desc",$start,($cantidad_maxima_rastro[0]["valor"]-1),$conn);

$limite=($start+$cantidad_maxima_rastro[0]["valor"])-1;

$mostrar='';

for($i=0;$i<$recorrido["numcampos"];$i++){

  	$sItemRowClass = " bgcolor=\"#FFFFFF\"";    	
  	if ($i % 2 <> 0)  // Display alternate color for rows
  		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
    if($recorrido[$i]["nombre"]!='BORRADOR')         
      $leidos=recorrido($x_doc,$recorrido[$i]["origen"],$recorrido[$i]["fecha_format"],"leido");               	        	
    $mostrar.=('<tr'.$sItemRowClass.'><td><span class="phpmaker" ><a href="#" '.$leidos.'>'.codifica_encabezado(busca_entidad_ruta(1,$recorrido[$i]["origen"]))."</a></span></td>");
		
		$accion=str_replace("COPIA","Transferido con copia a",str_replace('TRANSFERIDO','Transferido a Destino Responsable',$recorrido[$i]["nombre"]));            
    $mostrar.=('<td><span class="phpmaker" >'.$accion."</span></td>");
		
    $sig="";
    //if($recorrido[$i]["nombre"]!='BORRADOR')         
      $sig=recorrido($x_doc,$recorrido[$i]["destino"],$recorrido[$i]["fecha_format"],"siguiente");
    $leido = mostrar_leido($x_doc,$recorrido[$i]["destino"],$recorrido[$i]["fecha_format"]);                   
    if($recorrido[$i]["nombre"]=="DISTRIBUCION" && strpos($recorrido[$i]["notas"],"enviado por e-mail")===false)
      {if($documento[0]["plantilla"]=="")
         $mostrar.=('<td><span class="phpmaker" ><a href="#" '.$sig.'>'.codifica_encabezado(busca_entidad_ruta(2,$recorrido[$i]["destino"])).'</a></span></td>');          
       elseif($documento[0]["plantilla"]=="CARTA")
         {$destinos=busca_filtro_tabla("destinos","ft_carta","documento_iddocumento=$x_doc","",$conn);
          $codigos=explode(",",$destinos[0]["destinos"]);
          $mostrar.=('<td><span class="phpmaker" >');
          foreach($codigos as $filacod)
            $mostrar.= codifica_encabezado(busca_entidad_ruta(2,$filacod))."<br />";
          $mostrar.= ('</span></td>');
         }
       else
         {$mostrar.=('<td><span class="phpmaker" >');
          $mostrar.= codifica_encabezado(busca_entidad_ruta(1,$recorrido[$i]["destino"]))."<br />";
          $mostrar.= ('</span></td>');
         }  
      }
    else  
      $mostrar.=('<td><span class="phpmaker" >'.$leido.'<a href="#" '.$sig.'>'.codifica_encabezado(busca_entidad_ruta(1,$recorrido[$i]["destino"])).'</a></span></td>');
		
    $mostrar.=('<td><span class="phpmaker" >'.$recorrido[$i]["fecha_format"]."</span></td>");
    if($_SESSION["usuario_actual"]==$recorrido[$i]["origen"] || $_SESSION["usuario_actual"]==$recorrido[$i]["destino"] || $recorrido[$i]["ver_notas"]==1)          
      $mostrar.=('<td><span class="phpmaker" >'.$recorrido[$i]["notas"]."</span></td>");
    else
      $mostrar.=('<td><span class="phpmaker" >&nbsp;</span></td>');
}
if($cantidad[0]["cant"]>$limite){
	$mostrar.=('<tr '.$sItemRowClass.' id="fila_mostrar_mas"><td id="mostrar_mas" onclick="mostrar_mas_rastro();" colspan="6" style="cursor:pointer" inicio="'.($start+$cantidad_maxima_rastro[0]["valor"]).'"><button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Ver mas...</button></td></tr>');
}
echo $mostrar;


/*
<Clase>
<Nombre>recorrido</Nombre> 
<Parametros>$x_doc: iddocumento,$fun:funcionario codigo,$fecha:fecha base para la busqueda,$tipo:identifica para saber si muetra el recorrido siguiente del coumento o muetra quien ha leido el documento </Parametros>
<Responsabilidades>Mostra dependiendo el tipo el rastro del documento<Responsabilidades>
<Notas>Esta se ejecuta pora un POSIT</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Librerias showTooltip <Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function recorrido($x_doc,$fun,$fecha,$tipo)
{
 global $conn;
 $texto = "";
 switch($tipo)
 {
  case "siguiente":
   $buzon_sig = busca_filtro_tabla("origen,destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and origen=".$fun." and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." >='$fecha' ","fecha DESC",$conn);
   
   if($buzon_sig["numcampos"]>0)
   {
    $texto .= "<table border=1>"; 
    for($j=0; $j<$buzon_sig["numcampos"]; $j++)
    {if($buzon_sig[$j]["nombre"]=='BORRADOR')
       $buzon_sig[$j]["nombre"]='LEIDO' ;
     if($buzon_sig[$j]["nombre"]=='LEIDO')            
      $texto.= "<tr><td colspan = 4>".$buzon_sig[$j]["nombre"]." ".$buzon_sig[$j]["fecha"]."</td></tr>";         
     else
      $texto.= "<tr><td>".$buzon_sig[$j]["nombre"]." </td><td> ".codifica_encabezado(busca_entidad_ruta(1,$buzon_sig[$j]["destino"]))." ".$buzon_sig[$j]["fecha"]."</td></tr>";             
    }
    $texto .= "</table>"; 
   }
  break; 
  case "leido":
   /*$transferencias = busca_filtro_tabla("destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and origen=".$fun." and nombre not in('LEIDO','BORRADOR')","",$conn);
   if($transferencias["numcampos"]>0)
   { $texto .= "<table border=1><tr><td align=center>Destino</td><td align=center>Fecha de leido</td></tr>";
     for($i=0; $i<$transferencias["numcampos"]; $i++)
     { $buzon_sig = busca_filtro_tabla("destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and nombre='LEIDO' AND origen=".$transferencias[$i]["destino"]." and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." > '".$transferencias[$i]["fecha"]."'","",$conn);       
       if($buzon_sig["numcampos"]>0)        
         $texto .= "<tr><td> ".codifica_encabezado(busca_entidad_ruta(1,$buzon_sig[0]["destino"]))."</td><td>&nbsp;".$buzon_sig[0]["fecha"]."</tr>";       
       else
         $texto .= "<tr><td>".codifica_encabezado(busca_entidad_ruta(1,$transferencias[$i]["destino"]))."</td><td>No se ha leido</tr>";         
     }
   } */  
  break;
 } 
 if($texto!="")
 { 
   $texto = 'onmouseout="hideTooltip()" onMouseOver=\'showTooltip(event,"'.$texto.'");return false\'';
 } 
 return($texto); 
}
/*
<Clase>
<Nombre>busca_entidad_ruta</Nombre> 
<Parametros>$tipo: funcionario o ejecutor
$llave: identificador del tipo
</Parametros>
<Responsabilidades>Validar el tipo y retorna el nombre si es funcionario retorna el nombre y apellido, si es ejecutor retorna el nombre.<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function busca_entidad_ruta($tipo,$llave)
{
  global $conn;
  switch($tipo){
    case 1:// Funcionario
      $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo='".$llave."'","",$conn);
      if($dato["numcampos"])
        return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
      else return("Funcionario no encontrado");
      break;
    case 2:// Ejecutor
      $dato=busca_filtro_tabla("b.nombre","datos_ejecutor A,ejecutor b","idejecutor=ejecutor_idejecutor and iddatos_ejecutor='".$llave."'","",$conn);
      //print_r($dato);
      if($dato["numcampos"])
        return(ucwords($dato[0]["nombre"]));
      else return("Destinatario no encontrado");
      break;    
  }
}
/*
<Clase>
<Nombre>mostrar_leido</Nombre> 
<Parametros>$x_doc: iddocumento,$fun: codigo del funcionario, $fecha: fecha base para la consulta</Parametros>
<Responsabilidades>muestra la imagen de leido o no leido dependiendo si el documento ya fue leido<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_leido($x_doc,$fun,$fecha)
{
 global $conn;
 $leido = busca_filtro_tabla("idtransferencia","buzon_salida","archivo_idarchivo=$x_doc and origen=$fun and (nombre='LEIDO' or nombre='BORRADOR') and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." >= '$fecha'","",$conn); 
 if($leido["numcampos"]>0)
  $texto.= "<img src='images/leido.png' border='0'>";
 else 
  $texto.= "<img src='images/no_leido.png' border='0'>";
 return $texto;  
}
?>