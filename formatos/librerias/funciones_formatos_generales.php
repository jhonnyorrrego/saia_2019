<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

include_once($ruta_db_superior."db.php");
include_once("funciones_generales.php");
$alto_frame="100%";
function listado_hijos_formato($idformato,$iddoc){
global $conn,$alto_frame;
if($idformato){
  $formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);

  if($formato["numcampos"]){
    $campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$idformato." AND etiqueta_html NOT IN('detalle','hidden')","",$conn);
    //$datos_hijo=busca_filtro_tabla("",$formato[0]["nombre_tabla"],$_REQUEST["llave"]."=".$iddoc,"",$conn);
    /*campos:arreglo con datos a mostrar
tabla: Tabla a mostrar
campo: campo que sirve de enlace entre padre e hijo
llave: llave que sirve de enlace id del padre
orden: campo por el que se debe ordenar
*/
    $lcampos=extrae_campo($campos,"nombre","U");
    $tabla=$formato[0]["nombre_tabla"];

    $formato_padre=busca_filtro_tabla("","formato","idformato=".$formato[0]["cod_padre"],"",$conn);
    $id_padre=busca_filtro_tabla("id".$formato_padre[0]["nombre_tabla"]." as id",$formato_padre[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);

    $campo_enlace=$formato_padre[0]["nombre_tabla"];
    $id=$id_padre[0]["id"];
    $enlace_adicionar="";
    array_push($lcampos,"id".$tabla);

    if(@$_REQUEST["iddoc"]){
      agrega_boton("texto","../../botones/formatos/adicionar.gif","../../responder.php?idformato=".$idformato."&iddoc=".$_REQUEST["padre"],"","Adicionar ".$formato[0]["etiqueta"],$formato[0]["nombre_tabla"],"","",0);
      $enlace_adicionar.="<br /><br />";
      $alto_frame="94%";
    }
    $texto.=$enlace_adicionar.listar_formato_hijo2($lcampos,$tabla,$campo_enlace,$id,$orden);
    echo($texto);
  }
}
}
function listar_formato_hijo2($campos,$tabla,$campo_enlace,$llave,$orden){
global $conn,$idformato,$alto_frame;
$where="";
$condicion=" AND B.estado<>'ELIMINADO'";
if(in_array("estado",$campos) && !@$_REQUEST["enlace_adicionar_formato"]){
  $condicion.=" AND A.estado<>'INACTIVO'";
}

if(count($campos)){
  $where.=" AND A.nombre IN('".implode("','",$campos)."')";
}
$lcampos=busca_filtro_tabla("A.*,B.idformato,B.nombre AS nombre_formato,B.ruta_mostrar","campos_formato A,formato B","B.nombre_tabla LIKE '".$tabla."' AND A.formato_idformato=B.idformato".$where,"A.orden",$conn);

$hijo=busca_filtro_tabla("",$tabla." A, documento B","A.documento_iddocumento=B.iddocumento AND A.".$campo_enlace."=".$llave.$condicion,$orden,$conn);

    if($hijo["numcampos"] && $lcampos["numcampos"]){
      $texto.='<div style="overflow:auto; border:1px solid; width:100%; height:'.$alto_frame.';"><table border="1px" style="border-collapse:collapse;width:60%" ><thead><tr class="encabezado_list">';
      for($j=0;$j<$lcampos["numcampos"];$j++){
        if($lcampos[$j]["nombre"]=="id".$tabla){
          $texto.='<td>&nbsp;</td>';
        }
        else
          $texto.='<td>'.$lcampos[$j]["etiqueta"]."</td>";
      }
      $texto.='</tr></thead><tbody style="overflow:auto; ">';
      for($i=0;$i<$hijo["numcampos"];$i++){
        $texto.='<tr class="celda_transparente">';
        for($j=0;$j<$lcampos["numcampos"];$j++){
        	$avance = '';
        	if($lcampos[$j]["nombre"] == 'avance')
        		$avance = '%&nbsp;';
          if($lcampos[$j]["nombre"]=="id".$tabla){
            $texto.='<td><a href="../'.$lcampos[0]["nombre_formato"].'/'.$lcampos[0]["ruta_mostrar"].'?idformato='.$lcampos[0]["idformato"].'&iddoc='.$hijo[$i]["documento_iddocumento"].'">Ver</a></td>';
          }
          else
            $texto.='<td align="center">'.mostrar_valor_campo($lcampos[$j]["nombre"],$lcampos[$j]["formato_idformato"],$hijo[$i]["documento_iddocumento"],1)."&nbsp;".$avance."</td>";
        }
        $texto.='</tr>';
      }
      $texto.='</tbody></table></div>';
    }
return($texto);
}
/*<Clase>
<Nombre>Insertar Ruta</Nombre>
<Parametros>$ruta:Arreglo con los funcionarios(funcionario_codigo) que se deben incluir en la ruta y el tipo de firma en cada componente como un arreglo ej: $ruta=array(array([funcionario]=>10,[tipo_firma]=>1),array([funcionario]=>2,["tipo_firma"]=>0)) en este caso queda en la ruta el funcionario 10 que debe firmar y el funcionario 2 que no firma;$iddoc:Id del documento:$firma1: Si el primero de la ruta debe o no firmar</Parametros>
<Responsabilidades>Crear la ruta del documento<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones>El radicador de salida se adiciona en la funcion<Pre-condiciones>
<Post-condiciones>Ruta completa del documento<Post-condiciones>
</Clase> */


function insertar_ruta($ruta2,$iddoc,$firma1=1){
global $conn;
  $ruta=array();
  array_push($ruta,array("funcionario"=>usuario_actual("funcionario_codigo"),"tipo_firma"=>$firma1,"tipo"=>1));
  $ruta=array_merge($ruta,$ruta2);
  if(count($ruta)>0){
    $radicador=busca_filtro_tabla("f.funcionario_codigo","configuracion c,funcionario f","c.nombre='radicador_salida' and f.login=c.valor","",$conn);
    array_push($ruta,array("funcionario"=>$radicador[0]["funcionario_codigo"],"tipo_firma"=>0,"tipo"=>1));
    //Se modifica estado activo=0 para que no queden activos los por_aprobar en el buzon
    phpmkr_query("UPDATE buzon_entrada SET activo=0, nombre=".concatenar_cadena_sql(array("'ELIMINA_'","nombre"))." where archivo_idarchivo='$iddoc' and (nombre='POR_APROBAR' OR nombre='REVISADO' OR nombre='APROBADO' OR nombre='VERIFICACION')");
    phpmkr_query("UPDATE buzon_salida SET nombre=".concatenar_cadena_sql(array("'ELIMINA_'","nombre"))." WHERE archivo_idarchivo='$iddoc' and nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')",$conn);
    phpmkr_query("delete from ruta where documento_iddocumento='$iddoc'");
  }

  for($i=0;$i<count($ruta)-1;$i++){ //ANTES ESTABA "count($ruta)-1", se cambia a "count($ruta)-2" y se arregla las rutas en flujos y la devolucion de documentos
    if(!isset($ruta[$i]["tipo_firma"])){
      $ruta[$i]["tipo_firma"]=1;
    }
    if(!isset($ruta[$i]["tipo"])){
      $ruta[$i]["tipo"]=1;
    }
    if(!isset($ruta[$i+1]["tipo"])){
      $ruta[$i+1]["tipo"]=1;
    }

    $sql="insert into ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio,idenlace_nodo) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',".$ruta[$i]["tipo"].",".$ruta[$i+1]["tipo"].",$i,".$ruta[$i]["tipo_firma"].",'".@$ruta[$i]["paso_actividad"]."')" ;
    phpmkr_query($sql);
    $idruta=phpmkr_insert_id();
    $fecha=fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');
    if($ruta[$i]["tipo"]==5){
      $func_codigo1=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta[$i]["funcionario"],"",$conn);
      $funcionario1=$func_codigo1[0]['funcionario_codigo'];
    }else{
      $funcionario1=$ruta[$i]["funcionario"];
    }
    if($ruta[$i+1]["tipo"]==5){
      $func_codigo2=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta[$i+1]["funcionario"],"",$conn);
      $funcionario2=$func_codigo2[0]['funcionario_codigo'];
    }else{
      $funcionario2=$ruta[$i+1]["funcionario"];
    }
    $sql="insert into buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre,fecha) values('".$funcionario2."','".$funcionario1."','$iddoc',1,".$ruta[$i+1]["tipo"].",".$ruta[$i]["tipo"].",$idruta,'POR_APROBAR',".$fecha.")" ;
    phpmkr_query($sql);
  }
}


 /*
function insertar_ruta($ruta2,$iddoc,$firma1=1){
global $conn;
  $ruta=array();
  array_push($ruta,array("funcionario"=>usuario_actual("funcionario_codigo"),"tipo_firma"=>$firma1,"tipo"=>1));
  $ruta=array_merge($ruta,$ruta2);
  if(count($ruta)>0){
    $radicador=busca_filtro_tabla("f.funcionario_codigo","configuracion c,funcionario f","c.nombre='radicador_salida' and f.login=c.valor","",$conn);
    array_push($ruta,array("funcionario"=>$radicador[0]["funcionario_codigo"],"tipo_firma"=>0,"tipo"=>1));
    phpmkr_query("UPDATE buzon_entrada SET nombre=".concatenar_cadena_sql(array("'ELIMINA_'","nombre"))." where archivo_idarchivo='$iddoc' and (nombre='POR_APROBAR' OR nombre='REVISADO' OR nombre='APROBADO' OR nombre='VERIFICACION')");
    phpmkr_query("UPDATE buzon_salida SET nombre=".concatenar_cadena_sql(array("'ELIMINA_'","nombre"))." WHERE archivo_idarchivo='$iddoc' and nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')",$conn);
    phpmkr_query("DELETE FROM ruta WHERE documento_iddocumento='$iddoc'");
  }

  for($i=0;$i<count($ruta)-1;$i++){
    if(!isset($ruta[$i]["tipo_firma"])){
      $ruta[$i]["tipo_firma"]=1;
    }
    if(!isset($ruta[$i]["tipo"])){
      $ruta[$i]["tipo"]=1;
    }
    if(!isset($ruta[$i+1]["tipo"])){
      $ruta[$i+1]["tipo"]=1;
    }

    $sql="insert into ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',".$ruta[$i]["tipo"].",".$ruta[$i+1]["tipo"].",$i,".$ruta[$i]["tipo_firma"].")" ;
    phpmkr_query($sql);
    $idruta=phpmkr_insert_id();
    $fecha=fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');
    if($ruta[$i]["tipo"]==5){
      $func_codigo1=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta[$i]["funcionario"],"",$conn);
      $funcionario1=$func_codigo1[0]['funcionario_codigo'];
    }else{
      $funcionario1=$ruta[$i]["funcionario"];
    }
    if($ruta[$i+1]["tipo"]==5){
      $func_codigo2=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$ruta[$i+1]["funcionario"],"",$conn);
      $funcionario2=$func_codigo2[0]['funcionario_codigo'];
    }else{
      $funcionario2=$ruta[$i+1]["funcionario"];
    }
    $sql="insert into buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre,fecha) values('".$funcionario2."','".$funcionario1."','$iddoc',1,".$ruta[$i+1]["tipo"].",".$ruta[$i]["tipo"].",$idruta,'POR_APROBAR',".$fecha.")" ;
    phpmkr_query($sql);
  }
}
*/

/*<Clase>
<Nombre>validar_digitalizacion_formato_radicacion</Nombre>
<Parametros>$_REQUEST["digitalizacion"]:Debe aparecer la opcion desea digitalizar Si/No en el formato con el nombre digitalizacion;  $idformto:Llave del formato que se vincula ;$iddoc=documento que  debe vincular con la accion</Parametros>
<Responsabilidades>Redirecciona a la pantalla de adicionar pagina<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase> */
function validar_digitalizacion_formato($idformato,$iddoc)
{global $conn,$ruta_db_superior;
  if($_REQUEST["digitalizacion"]==1){
    redirecciona(RUTA_SAIA . "paginaadd.php?&key=".$iddoc."&x_enlace=mostrar");
  }
}
/*<Clase>
<Nombre>digitalizacion_formato_radicacion</Nombre>
<Parametros>$_REQUEST["digitalizacion"]:Debe aparecer la opcion desea digitalizar Si/No en el formato con el nombre digitalizacion;  $idformto:Llave del formato que se vincula ;$iddoc=documento que  debe vincular con la accion</Parametros>
<Responsabilidades>Redirecciona a la pantalla de adicionar pagina<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase> */
function digitalizar_formato($idformato,$iddoc)
{global $conn;
  echo "<tr><td class='encabezado'>DESEA DIGITALIZAR</td><td><input name='digitalizacion' type='radio' value='1'>Si  <input name='digitalizacion' type='radio' value='0' checked>No</td></tr>";
}
/*****/
function diferenciaEntreFechas2($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false){
   $f0 = strtotime($fecha_principal);
   $f1 = strtotime($fecha_secundaria);
   //if ($f0 < $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp; }
   $resultado = ($f0 - $f1);
   switch ($obtener) {
       default: break;
       case "MINUTOS"   :   $resultado = $resultado / 60;   break;
       case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
       case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
       case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
   }
   if($redondear) $resultado = round($resultado);
   return $resultado;
}
?>