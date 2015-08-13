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
function link_cuadro_mando($idformato,$iddoc)
{global $conn;
 $radicador = new PERMISO();
 $permiso = false;
 $permiso=$radicador->acceso_modulo_perfil("cuadro_control_indicadores");
 if($permiso)
    echo "<a target='_blank' href='cuadro_mando_indicadores.php?proceso=$iddoc'>Cuadro de mando Indicadores</a>";
}
function icono_detalles($idformato,$iddoc)
{global $conn;
$funcionario=usuario_actual("funcionario_codigo");
 $responsable=busca_filtro_tabla("","documento A, ft_proceso B","(A.iddocumento=B.documento_iddocumento AND iddocumento=".$iddoc.") AND (A.ejecutor=".$funcionario." OR permisos_acceso like '%,$funcionario' or permisos_acceso like '$funcionario' or permisos_acceso like '%,$funcionario,%' or permisos_acceso like '$funcionario,%' OR lider_proceso like '%,$funcionario' or lider_proceso like '$funcionario' or lider_proceso like '%,$funcionario,%' or lider_proceso like '$funcionario,%' OR B.responsable like '%,$funcionario' or B.responsable like '$funcionario' or B.responsable like '%,$funcionario,%' or B.responsable like '$funcionario,%')","",$conn);
//print_r($responsable);
 $ruta="../../ordenar.php?accion=mostrar&mostrar_formato=1&key=$iddoc";
 if(!isset($_REQUEST["tipo"])||$_REQUEST["tipo"]==1 ){
 if($responsable["numcampos"]>0 || usuario_actual("login")=="catalina.camacho" ||usuario_actual("login")=="lina.alzate"||usuario_actual("login")=="0k")
   echo "<a href='$ruta' target='centro'><img border=0 src='../../botones/comentarios/detalles.png' /></a>";
  } 
}
function asignar_permisos_indicadores($idformato,$iddoc)
{global $conn;
 $modulos=array('1525','1965','1966','1968','1967','1105');
 $responsable=busca_filtro_tabla("permisos_acceso","ft_proceso","documento_iddocumento=$iddoc","",$conn);
 $funcionarios=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo in('".implode("','",explode(",",$responsable[0][0]))."')","",$conn);
 for($i=0;$i<$funcionarios["numcampos"];$i++)
   {foreach($modulos as $fila)
      {$permiso=busca_filtro_tabla("accion,idpermiso","permiso","funcionario_idfuncionario='".$funcionarios[$i][0]."' and modulo_idmodulo=$fila","",$conn);
       if(!$permiso["numcampos"])
         phpmkr_query("insert into ".DB.".permiso(modulo_idmodulo,funcionario_idfuncionario,accion) values('".$fila."','".$funcionarios[$i][0]."',1)"); 
       elseif($permiso[0]["accion"]==0)
         phpmkr_query("update ".DB.".permiso set accion=1 where idpermiso=".$permiso[0]["idpermiso"]);
      }
   }
}
function actividades_proceso($idformato,$iddoc){
global $conn;
$texto="No existen Pasos Para este Procedimiento";
$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"",$conn);
if($formato["numcampos"]){
  $proceso=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
  //print_r($proceso);
  if($proceso["numcampos"]){
    $anexo=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc." AND campos_formato=615","",$conn);
    //print_r($anexo) ;
    if($anexo["numcampos"]){
      $texto="Descripcion Completa del Proceso:<br />".mostrar_valor_campo('descripcion_proceso',$formato[0]["idformato"],$iddoc,1);
    }
    else{
      $campos=array("proveedor","entrada","nombre","punto_control","salida","cliente");
      $texto=listar_formato_hijo($campos,"ft_actividad_proceso","ft_proceso",$proceso[0]["id".$formato[0]["nombre_tabla"]],"",'left');
    }
  }
}
echo($texto);
}

/*function arbol_procedimientos($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 $valor="";
 $formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"",$conn);
 $campo=busca_filtro_tabla("nombre","campos_formato B","B.idcampos_formato=".$idcampo,"",$conn); 
 if($iddoc<>NULL)
   {$resultado=busca_filtro_tabla($campo[0]["nombre"],$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
    $valor=$resultado[0][0];
    $anexos=busca_filtro_tabla("etiqueta","anexos","idanexos in(".$valor.")","",$conn);
    for($i=0;$i<$anexos["numcampos"];$i++)
      $etiquetas[]=$anexos[$i]["etiqueta"];  
   }
 
 echo "<td>".implode(",",@$etiquetas)."<br /><input type='hidden' name='".$campo[0]["nombre"]."' id='".$campo[0]["nombre"]."' value='$valor'>
       <a onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )\" target='_blank' href='../arboles/arbol_procedimientos.php?campo=".$campo[0]["nombre"]."'>SELECCIONAR</a></td>" ;
}*/


function enlace_normograma($idformato,$iddoc){
global $conn,$ruta_db_superior;
$proceso=busca_filtro_tabla("","ft_proceso A","A.documento_iddocumento='".$iddoc."'","",$conn);
$norma1=busca_filtro_tabla("a.*","ft_norma_proceso a, documento b","b.iddocumento=a.documento_iddocumento  and b.estado<>'ELIMINADO' and a.ft_proceso=".$proceso[0]["idft_proceso"],"",$conn);
$norma2=busca_filtro_tabla("a.*","ft_norma_procedimiento a,ft_procedimiento b,documento c, documento d","c.iddocumento=a.documento_iddocumento and d.iddocumento=b.documento_iddocumento  and d.estado<>'ELIMINADO' and a.ft_procedimiento=idft_procedimiento and b.ft_proceso=".$proceso[0]["idft_proceso"],"",$conn);
$texto="NORMOGRAMA NO ASIGNADO";
if($norma1["numcampos"] || $norma1["numcampos"]){
  $texto="<a href=".$ruta_db_superior."/formatos/proceso/normograma_proceso.php?idproceso=".$proceso[0]["idft_proceso"]." target='_blank'>Ver Normograma</a>";  
}
echo($texto);
}
function mostrar_riesgos($idformato,$iddoc)
{global $conn;
 $valor=busca_filtro_tabla ("riesgos","ft_proceso","documento_iddocumento=".$iddoc,"",$conn);
 $vector=explode(",",$valor[0][0]);
 foreach($vector as $fila)
   {echo "<ul>";
    if($fila<>"")
      {$anexo=busca_filtro_tabla("","anexos","idanexos=".$fila,"",$conn);
       echo "<li><a href='".PROTOCOLO_CONEXION.RUTA_PDF."/".$anexo[0]["ruta"]."'>".$anexo[0]["etiqueta"]."</a></li>";
      }
    echo "</ul>";  
   }
}
function enlace_riesgos($idformato,$iddoc){
global $conn,$ruta_db_superior;
$id=busca_filtro_tabla("idft_proceso","ft_proceso","documento_iddocumento=$iddoc","",$conn);
$texto="<a href='../riesgos_proceso/previo_mostrar_riesgos_proceso.php?llave=$idformato-idft_proceso-".$id[0][0]."&iddoc=$iddoc&no_menu=1'>Riesgos</a>";


/*$texto="No existen Riesgos Para este Proceso";
$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"",$conn);
if($formato["numcampos"]){
  $proceso=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"nombre ASC",$conn);
  if($proceso["numcampos"]){
    $texto='<a href="../riesgos_proceso/previo_mostrar_riesgos_proceso.php?llave=9-idft_proceso-'.$proceso[0]["idft_proceso"].'&iddoc='.$iddoc.'&no_menu=1">Riegos del Proceso</a>';
    $campos=array("consecutivo","descripcion");
    $texto=listar_formato_hijo($campos,"ft_riesgos_proceso","ft_proceso",$proceso[0]["id".$formato[0]["nombre_tabla"]],"idft_riesgos_proceso ASC",'left');
  }
}*/
echo($texto);
}

function enlace_listado_maestro_documentos($idformato,$iddoc){
global $conn;
$listadof=busca_filtro_tabla("","formato A,campos_formato B","A.idformato=B.formato_idformato AND A.nombre_tabla LIKE 'ft_listados_maestros' AND B.nombre LIKE 'soporte'","",$conn);
$listado=busca_filtro_tabla("","ft_listados_maestros","estado <>'INACTIVO'","",$conn);
for($i=0;$i<$listado["numcampos"] && $listadof["numcampos"];$i++){
  echo(listar_anexos($listadof[0]["idcampos_formato"],$listadof[0]["formato_idformato"],$listado[$i]["idft_listados_maestros"],1));
}
}
function listar_control_proceso($idformato,$iddoc){
global $conn;
$texto="No existen Controles Para este Procedimiento";
$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"",$conn);
if($formato["numcampos"]){
  $proceso=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
  if($proceso["numcampos"]){
    $campos=array("nombre","hoja_vida_indicador");
    $texto=listar_formato_hijo($campos,"ft_control_proceso","ft_proceso",$proceso[0]["id".$formato[0]["nombre_tabla"]],"",'left'," and a.estado<>'INACTIVO'");
  }
}
echo($texto);
}

function listar_politicas_proceso($idformato,$iddoc){
global $conn;
$texto="No existen Politicas Para este Proceso";
$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"",$conn);
if($formato["numcampos"]){
  $proceso=busca_filtro_tabla($formato[0]["nombre_tabla"].".*,".fecha_db_obtener("fecha_revision","Y-m-d H:i:s")." as fecha_revision,".fecha_db_obtener("fecha_aprobacion","Y-m-d H:i:s")." as fecha_aprobacion",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"nombre ASC",$conn);
 // print_r($proceso);
  if($proceso["numcampos"]){
    $campos=array("nombre","soporte");
    $texto=listar_formato_hijo($campos,"ft_politicas_proceso","ft_proceso",$proceso[0]["id".$formato[0]["nombre_tabla"]],"idft_politicas_proceso ASC",'left');
  }
}
echo($texto);
}
function aprobacion($idformato,$iddoc){
global $conn;
$texto="Documento no Aprobado";

$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"",$conn);
//print_r($formato);
if($formato["numcampos"]){
  if($formato[0]["nombre"]=="proceso")
    {$proceso=busca_filtro_tabla($formato[0]["nombre_tabla"].".*,".fecha_db_obtener("fecha_revision","Y-m-d H:i:s")." as fecha_revision,".fecha_db_obtener("fecha_aprobacion","Y-m-d H:i:s")." as fecha_aprobacion",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"nombre ASC",$conn);
     $aprobado=busca_filtro_tabla("lower(nombres) as nombres,lower(apellidos) as apellidos,cargo.nombre,funcionario_codigo,firma","funcionario,cargo,dependencia_cargo","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$proceso[0]["aprobado_por"],"",$conn);

     $revisado=busca_filtro_tabla("lower(nombres) as nombres,lower(apellidos) as apellidos,cargo.nombre,funcionario_codigo,firma","funcionario,cargo,dependencia_cargo","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$proceso[0]["revisado_por"],"",$conn);
    }
  else
    {$proceso=busca_filtro_tabla($formato[0]["nombre_tabla"].".*",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"nombre ASC",$conn);
     $aprobado["numcampos"]=0;
     $revisado["numcampos"]=0;
    }
  //print_r($proceso);  
  
 /********** tama�o de la firma*************/ 
  $ancho_firma=busca_filtro_tabla("valor",DB.".configuracion A","A.nombre='ancho_firma'","",$conn);
 if(!$ancho_firma["numcampos"])
  $ancho_firma[0]["valor"]=200;
 $alto_firma=busca_filtro_tabla("valor",DB.".configuracion A","A.nombre='alto_firma'","",$conn);
 if(!$alto_firma["numcampos"])
  $alto_firma[0]["valor"]=100;
 /******************************************/ 
  if($proceso["numcampos"]){
    if($proceso[0]["acta"]){
      $campo=busca_filtro_tabla("","campos_formato","formato_idformato=".$idformato." AND nombre='acta'","",$conn);

      if($campo["numcampos"]){
        //include_once($ruta_db_superior."formatos/librerias/funciones_archivo.php");
        $anexos=mostrar_valor_campo('acta',10,$_REQUEST['iddoc'],1);
        
        if($anexos<>"")
          echo $anexos;
        else if($proceso[0]["aprobado_por"]||$proceso[0]["revisado_por"]) 
          { if($aprobado["numcampos"]||$revisado["numcampos"])
          {echo "<table width='100%'>
                     <tr><td width='50%'>Revisado Por</td><td>Aprobado Por</td></tr>
                     <tr><td>Nombre: ".ucwords(@$revisado[0]["nombres"]." ".@$revisado[0]["apellidos"])." </td>
                     <td>Nombre: ".ucwords(@$aprobado[0]["nombres"]." ".@$aprobado[0]["apellidos"])."</td></tr>
                     <tr><td>Cargo: ".ucwords(@$revisado[0]["nombre"])."</td><td>Cargo: ".ucwords(@$aprobado[0]["nombre"])."</td></tr>
                     <tr><td>";
          if(@$revisado[0]["firma"]<>"")
            echo "<img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/librerias/mostrar_foto.php?codigo=".@$revisado[0]["funcionario_codigo"]."' />";
          else 
            echo "<img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/firmas/blanco.jpg'/>";  
          if(@$aprobado[0]["firma"]<>"")
            echo "</td><td><img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/librerias/mostrar_foto.php?codigo=".@$aprobado[0]["funcionario_codigo"]."' />";
          else 
            echo "<img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/firmas/blanco.jpg'/>";
          echo "</td></tr>
                     <tr><td>Fecha: ".@$proceso[0]["fecha_revision"]."</td><td>Fecha: ".@$proceso[0]["fecha_aprobacion"]."</td></tr>
                     </table>";
          }
          else
           {echo("Aprobado por<br />".$proceso[0]["aprobado_por"]);
           } 
          }
        return(TRUE);
      }
    }
    else if($proceso[0]["aprobado_por"]||$proceso[0]["revisado_por"]) {
      if($aprobado["numcampos"]||$revisado["numcampos"])
      {echo "<table width='100%'>
                 <tr><td width='50%'>Revisado Por</td><td>Aprobado Por</td></tr>
                 <tr><td>Nombre: ".ucwords(@$revisado[0]["nombres"]." ".@$revisado[0]["apellidos"])." </td>
                 <td>Nombre: ".ucwords(@$aprobado[0]["nombres"]." ".@$aprobado[0]["apellidos"])."</td></tr>
                 <tr><td>Cargo: ".ucwords(@$revisado[0]["nombre"])."</td><td>Cargo: ".ucwords(@$aprobado[0]["nombre"])."</td></tr>
                 <tr><td>";
      if(@$revisado[0]["firma"]<>"")
        echo "<img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/librerias/mostrar_foto.php?codigo=".@$revisado[0]["funcionario_codigo"]."' />";
      else 
        echo "<img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/firmas/blanco.jpg'/>";  
      if(@$aprobado[0]["firma"]<>"")
        echo "</td><td><img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/librerias/mostrar_foto.php?codigo=".@$aprobado[0]["funcionario_codigo"]."' />";
      else 
        echo "<img width='".$ancho_firma[0]["valor"]."' height='".$alto_firma[0]["valor"]."' src='".PROTOCOLO_CONEXION.RUTA_PDF."/firmas/blanco.jpg'/>";
      echo "</td></tr>
                 <tr><td>Fecha: ".@$proceso[0]["fecha_revision"]."</td><td>Fecha: ".@$proceso[0]["fecha_aprobacion"]."</td></tr>
                 </table>";
      }
      else
       {echo ("Aprobado por<br />".$proceso[0]["aprobado_por"]);
       }           
      return(TRUE);
    }
  }
}
echo($texto);
return(FALSE);

}
function listar_politicas($idformato,$iddoc)
{global $conn;
 $politicas=busca_filtro_tabla("pol.descripcion","ft_politica_proceso pol,ft_proceso p","ft_proceso=idft_proceso and p.documento_iddocumento=$iddoc","",$conn);
 if($politicas["numcampos"]){
 echo "<table border='1' width='100%' style='border-collapse:collapse'>";
 for($i=0;$i<$politicas["numcampos"];$i++)
   {echo "<tr><td>".$politicas[$i]["descripcion"]."</td></tr>";
   }
  echo "</table>"; 
 }  
}
?>
