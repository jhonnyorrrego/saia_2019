<?php
include_once("db.php");

function generar_archivo_intranet()
{
 $conn_mysql = mysql_connect("10.1.0.101","root","root") or alerta("NO SE PUEDE CONECTAR A LA BASE DE DATOS 1");
 mysql_select_db("intranet",$conn_mysql) or alerta("NO SE PUEDE CONECTAR A LA BASE DE DATOS 2");
 $anio=date("Y-m-d");
 $archivo="/var/www/html/usuariosIntranet.txt";
 $cont=0;
 $fp=Null;
 // ESTE ES EL QUE HACE EL BORRADO, PARA CUANDO SE HAGA LA MIGRACION 
  /*if(is_file($archivo)){
    unlink($archivo);
  } */
  // CONSULTA ANTIGUA
  //$sql="select DISTINCT NULL AS idfuncionario_temporal, c.cuenta_id,c.cuenta_login,c.cuenta_nombre,c.cuenta_apellido,cg.cargo_nombre, d.dependencia_nombre, date(now()),ci.info_empleado_id, d.cod_centro, d.cod_padre INTO OUTFILE '/var/www/html/usuariosIntranet.txt' FIELDS TERMINATED BY ';' from ximma_cuentas c, ximma_cuentas_info ci, ximma_cargos_empleados cg,ximma_dependencias d where c.cuenta_login=ci.info_login AND  cg.cargo_id =ci.info_cargo AND ci.info_dependencia=d.dependencia_id AND cuenta_estado=1 AND c.cuenta_tipo='U' AND d.cod_centro IS NOT NULL ORDER BY CAST(d.cod_centro AS SIGNED) ASC";
  $sql="select c.cuenta_id,c.cuenta_login,c.cuenta_nombre,c.cuenta_apellido,cg.cargo_nombre, d.dependencia_nombre, date(now()),ci.info_empleado_id, d.cod_centro, d.cod_padre INTO OUTFILE '/var/www/html/usuariosIntranet.txt' FIELDS TERMINATED BY ',' LINES TERMINATED BY ';' from ximma_cuentas c, ximma_cuentas_info ci, ximma_cargos_empleados cg,ximma_dependencias d where c.cuenta_login=ci.info_login AND  cg.cargo_id =ci.info_cargo AND ci.info_dependencia=d.dependencia_id AND cuenta_estado=1 AND c.cuenta_tipo='U' AND d.cod_centro IS NOT NULL ORDER BY CAST(d.cod_centro AS SIGNED) ASC";
  if(mysql_query($sql,$conn_mysql)){
    $fp = @fopen ($archivo,"r");
    alerta("cargado el archivo");
   }
  else {
  alerta("No Se Realizo la Carga de los Datos de Intranet");
  mysql_close($conn_mysql);
  return(false);
  }
  mysql_close($conn_mysql);
}

function carga_funcionarios()
{
 global $conn;
 $archivo="Funcionarios_ultimo.csv";
 $gestor = fopen($archivo, "rb");
 if($gestor)
    $contenido = fread($gestor, filesize($archivo));
 else
 {
    alerta("No Se Realizo la Actualizacion de Datos de Intranet por el archivo");
    return(false);
 }
 fclose($gestor);
 $records = explode("\n",$contenido);
 if(count($records)>0)
 {
    phpmkr_query("DELETE FROM temporal_funcionario",$conn);
 }
 echo"<br><br>";
 for($i=0; $i<count($records)-1; $i++)
 {
    $fila = explode(";",utf8_encode(str_replace('"','',strtolower($records[$i]))));
    for($ind=0; $ind<count($fila);$ind++)
      if($fila[$ind]=="\\N")
        $fila[$ind] = "";

    $sql = "INSERT INTO temporal_funcionario(codigo_intranet,login,nombres,apellidos,cargo,dependencia,fecha,nit,cod_padre,idfunc,cod_centro) VALUES(".$fila[1].",'".$fila[2]."','".ltrim($fila[3])."','".$fila[4]."','".$fila[5]."','".$fila[6]."',SYSDATE,'','".$fila[9]."','".$fila[0]."','".$fila[10]."')";
  phpmkr_query($sql,$conn);
 }
 return(actualiza_funcionarios());  
}

function actualiza_funcionarios_rol()
{
 global $conn,$sql;
 $sql = "update dependencia_cargo set estado=0 where tipo='0' and fecha_inicial = fecha_final";
 phpmkr_query($sql,$conn);
 return(TRUE); 
}
  
function actualiza_funcionarios()
{
  global $conn;
  $listado_temporal_funcionario=busca_filtro_tabla("A.*","temporal_funcionario A","","",$conn);
  $conf_admin=busca_filtro_tabla("A.*","configuracion A","nombre='login_administrador'","",$conn);
  $sql="update funcionario A set A.estado=0 WHERE A.login not like '".$conf_admin[0]["valor"]."' AND A.tipo='0'";
  phpmkr_query($sql,$conn); 
  $sql="update dependencia_cargo set estado=0";
  phpmkr_query($sql,$conn);
  $dias=0;
  $fecha_correo="";
  $envio_correo=FALSE;
  $valores_pendientes=busca_filtro_tabla("A.*","configuracion A","tipo ='pendientes'","",$conn);
  for($j=0;$j<$valores_pendientes["numcampos"];$j++)
    switch($valores_pendientes[$j]["nombre"])
    {
      case "dias_correo_pendientes":
        $dias=$valores_pendientes[$j]["valor"];
        break;
      case "fecha_correo_pendientes":
        $fecha_correo=$valores_pendientes[$j]["valor"];
        break;
      case "enviar_correo_pendientes":
        $envio_correo=$valores_pendientes[$j]["valor"];
        break;
    }
  if($envio_correo)
  {
    if($fecha_correo && $dias)
    {
      $fecha_envio=ejecuta_filtro("Select ADDDATE('$fecha_correo',INTERVAL $dias DAY) AS dias",$conn);
      if($fecha_envio["numcampos"]&&$fecha_envio["dias"]<=date('Y-m-d'))
        $envio_correo=TRUE;
      else $envio_correo=FALSE;  
    }
    else $envio_correo=FALSE;
  }
  for($i=0;$i<$listado_temporal_funcionario["numcampos"];$i++)
  {
    $idfuncionario=0; $idcargo=0;$iddependencia=0;$iddependencia_cargo=0;
    $funcionario=busca_filtro_tabla("idfuncionario,funcionario_codigo","funcionario","funcionario_codigo=".$listado_temporal_funcionario[$i]["codigo_intranet"],"",$conn);
    $cargo=busca_filtro_tabla("idcargo,nombre","cargo","nombre LIKE '".$listado_temporal_funcionario[$i]["cargo"]."'","nombre ASC",$conn);
    $dependencia=busca_filtro_tabla("A.*","dependencia A","tipo=1 AND codigo LIKE '".$listado_temporal_funcionario[$i]["cod_centro"]."'","",$conn);
    $padre=busca_filtro_tabla("iddependencia","dependencia","codigo='".$listado_temporal_funcionario[$i]["cod_padre"]."'","",$conn);
    if(!$padre["numcampos"]){
      $padre[0]["iddependencia"]=1;
    }

    if($funcionario["numcampos"])
    {
      $sql="update funcionario set estado=1,login='".$listado_temporal_funcionario[$i]["login"]."',nombres='".strtolower($listado_temporal_funcionario[$i]["nombres"])."',apellidos='".strtolower($listado_temporal_funcionario[$i]["apellidos"])."',nit='".trim(str_replace(".","",$listado_temporal_funcionario[$i]["nit"]))."' WHERE idfuncionario=".$funcionario[0]["idfuncionario"];
      phpmkr_query($sql,$conn);
      $idfuncionario=$funcionario[0]["idfuncionario"];
    }
    else{
      $sql="INSERT INTO funcionario(idfuncionario,cod_padre,funcionario_codigo,login,nombres,apellidos,estado,clave,nit) VALUES('".$listado_temporal_funcionario[$i]["idfunc"]."','".$listado_temporal_funcionario[$i]["cod_padre"]."','".$listado_temporal_funcionario[$i]["codigo_intranet"]."','".$listado_temporal_funcionario[$i]["login"]."','".strtolower($listado_temporal_funcionario[$i]["nombres"])."','".strtolower($listado_temporal_funcionario[$i]["apellidos"])."',1,'".$listado_temporal_funcionario[$i]["login"]."','".trim(str_replace(".","",$listado_temporal_funcionario[$i]["nit"]))."')";
      phpmkr_query($sql,$conn);
      $idfuncionario=phpmkr_insert_id();
    }
      //validacion para enviar alertas al correo de los funcionarios que tienen un documento sin leer durante mas de un dia o un documento sin contestar durante mas de dos dias.
    if($envio_correo){    
      $sql_pendientes = "SELECT DISTINCT ADDDATE(documento.fecha,INTERVAL $dias DAY ) AS fecha,documento.descripcion,documento.numero,buzon_entrada.origen,buzon_entrada.destino FROM buzon_entrada,documento WHERE archivo_idarchivo NOT IN (SELECT e.archivo_idarchivo FROM buzon_entrada e INNER JOIN buzon_salida s ON e.origen = s.origen AND e.archivo_idarchivo = s.archivo_idarchivo WHERE e.origen =".$listado_temporal_funcionario[$i]["codigo_intranet"]." GROUP BY e.archivo_idarchivo HAVING max( s.fecha ) > max( e.fecha ))AND origen =".$listado_temporal_funcionario[$i]["codigo_intranet"]." and archivo_idarchivo=iddocumento AND nombre<>'TERMINADO' AND documento.estado <> 'ELIMINADO' ORDER BY fecha";       
      $rs_pendientes = phpmkr_query($sql_pendientes,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sql_pendientes);
      while($row = @phpmkr_fetch_array($rs_pendientes)){ //print_r($row);
       $origen = $listado_temporal_funcionario[$i]["codigo_intranet"];
       $fecha = $row["fecha"];
       if($fecha > date("Y-m-d")){   //   die();
         //*****************
         include_once("email/mail.inc.php");
          //  Creacion del Correo a Enviar 
          $mail = new MyMailer;
          // Contenido del Correo
          $mail->AddAddress("saia@camarapereira.org.co", $listado_temporal_funcionario[$i]["login"]);
          $mail->Subject = "Recordatorio - Gestion de Archivos - SAIA";
          $funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$row["destino"],"",$conn);
          $mail->Body    = "Por favor leer los documentos que tiene pendientes en el sistema de Archivos (SAIA): \n\r NUMERO DE RADICADO: ".$row["numero"].".  \n\r RESUMEN: ".$row["descripcion"].". \n\r ENVIADO POR: ".$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"];        
          if(!$mail->Send()){
             alerta("Ocurrio un error al tratar de enviar el mensaje");
             return(FALSE);
          }        
          //alerta("Message was sent successfully");
         // die();
       } 
         //*****************    
     } 
     $sql_pendientes = "Update configuracion SET valor='".date("Y-m-d")."' WHERE nombre='fecha_correo_pendientes'";
     ejecuta_sql($sql_pendientes,$conn);
    }  
    //fin de cambios 
    if($cargo["numcampos"]){
      $idcargo=$cargo[0]["idcargo"];
    }
    else{
      $sql="INSERT INTO cargo(nombre) VALUES('".strtolower($listado_temporal_funcionario[$i]["cargo"])."')";
      phpmkr_query(utf8_encode($sql),$conn);
      $idcargo=phpmkr_insert_id();
    }
    if($dependencia["numcampos"]){
      $iddependencia=$dependencia[0]["iddependencia"];
      $sql="UPDATE dependencia SET estado=1,codigo='".$listado_temporal_funcionario[$i]["cod_centro"]."',nombre='".strtolower($listado_temporal_funcionario[$i]["dependencia"])."',cod_padre='".$padre[0]["iddependencia"]."' WHERE iddependencia=".$dependencia[0]["iddependencia"];
      phpmkr_query(utf8_encode($sql),$conn);
    }
    else {
      $sql="INSERT INTO dependencia(nombre,codigo,cod_padre) VALUES('".strtolower($listado_temporal_funcionario[$i]["dependencia"])."','".$listado_temporal_funcionario[$i]["cod_centro"]."','".$padre[0]["iddependencia"]."')";
      phpmkr_query(utf8_encode($sql),$conn);  
      $iddependencia=phpmkr_insert_id();
    }
    $dependencia_cargo=busca_filtro_tabla("A.*","dependencia_cargo A","funcionario_idfuncionario=".$idfuncionario." AND cargo_idcargo=".$idcargo." AND dependencia_iddependencia=".$iddependencia,"",$conn);    
    if($dependencia_cargo["numcampos"]){
      $sql="UPDATE dependencia_cargo SET estado=1 WHERE iddependencia_cargo=".$dependencia_cargo[0]["iddependencia_cargo"];
      phpmkr_query(utf8_encode($sql),$conn);
    }
    else
    {
      $sql="INSERT INTO dependencia_cargo(funcionario_idfuncionario,cargo_idcargo,dependencia_iddependencia,fecha_inicial) VALUES('$idfuncionario','$idcargo','$iddependencia',to_date('".date("Y-m-d")."','YYYY-MM-DD'))";
      phpmkr_query(utf8_encode($sql),$conn);      
    }
    carga_permisos('idfuncionario',$funcionario[0]["idfuncionario"]);
  }
  phpmkr_query("UPDATE dependencia SET COD_PADRE='' WHERE iddependencia=1",$conn);
//$sql="update dependencia_cargo set estado=1 where dependencia_iddependencia IN (Select iddependencia from dependencia WHERE tipo=0)";
//ejecuta_sql($sql,$conn);
return(TRUE);
//print_r($listado_temporal_funcionario);
}

// Revisar que datos le deben llegar, el login o el id del funcionario
function actualiza_un_funcionario($login)
{
  global $conn;
  $listado_temporal_funcionario=busca_filtro_tabla("A.*","temporal_funcionario A","login='".$login."'","",$conn);
  $sql="update funcionario set estado=0 WHERE login='".$login."'";
  phpmkr_query($sql,$conn);
  $sql="update dependencia_cargo set estado=0 WHERE login='".$login."'";
  phpmkr_query($sql,$conn);
  $idfuncionario=0; $idcargo=0;$iddependencia=0;$iddependencia_cargo=0;
  $funcionario=busca_filtro_tabla("idfuncionario,funcionario_codigo","funcionario","funcionario_codigo=".$listado_temporal_funcionario[0]["codigo_intranet"],"",$conn);
  $cargo=busca_filtro_tabla("idcargo,nombre","cargo","nombre LIKE '".$listado_temporal_funcionario[0]["cargo"]."'","nombre ASC",$conn);
  $dependencia=busca_filtro_tabla("A.*","dependencia A","tipo=1 AND codigo LIKE '".$listado_temporal_funcionario[0]["cod_centro"]."'","",$conn);
  $padre=busca_filtro_tabla("iddependencia","dependencia","codigo='".$listado_temporal_funcionario[0]["cod_padre"]."'","",$conn);
  if(!$padre["numcampos"]){
    $padre[0]["iddependencia"]=1;
  }
  if($funcionario["numcampos"])
  {
    $sql="update funcionario set estado=1,login='".$listado_temporal_funcionario[0]["login"]."',nombres='".$listado_temporal_funcionario[0]["nombres"]."',apellidos='".$listado_temporal_funcionario[0]["apellidos"]."',nit='".trim(str_replace(".","",$listado_temporal_funcionario[0]["nit"]))."' WHERE idfuncionario=".$funcionario[0]["idfuncionario"];
    phpmkr_query(utf8_encode($sql),$conn);
    $idfuncionario=$funcionario[0]["idfuncionario"];
  }
  else
  {
    $sql="INSERT INTO funcionario(funcionario_codigo,login,nombres,apellidos,estado,clave,nit) VALUES('".$listado_temporal_funcionario[0]["codigo_intranet"]."','".$listado_temporal_funcionario[0]["login"]."','".$listado_temporal_funcionario[0]["nombres"]."','".$listado_temporal_funcionario[0]["apellidos"]."',1,'".$listado_temporal_funcionario[0]["login"]."','".trim(str_replace(".","",$listado_temporal_funcionario[0]["nit"]))."')";
    phpmkr_query(utf8_encode(strtolower($sql)),$conn);
    $idfuncionario=phpmkr_insert_id();
  }

  if($cargo["numcampos"]){
    $idcargo=$cargo[0]["idcargo"];
  }
  else{
    $sql="INSERT INTO cargo(nombre) VALUES('".strtolower($listado_temporal_funcionario[0]["cargo"])."')";
    phpmkr_query(utf8_encode($sql),$conn);
    $idcargo=phpmkr_insert_id();
  }
  if($dependencia["numcampos"]){
    $iddependencia=$dependencia[0]["iddependencia"];
    $sql="UPDATE dependencia SET estado=1,codigo='".$listado_temporal_funcionario[0]["cod_centro"]."',nombre='".$listado_temporal_funcionario[0]["dependencia"]."',cod_padre='".$padre[0]["iddependencia"]."' WHERE iddependencia=".$dependencia[0]["iddependencia"];
    phpmkr_query(utf8_encode($sql),$conn);
  }
  else 
  {
    $sql="INSERT INTO dependencia(nombre,codigo,cod_padre) VALUES('".strtolower($listado_temporal_funcionario[0]["dependencia"])."','".$listado_temporal_funcionario[0]["cod_centro"]."','".$padre[0]["iddependencia"]."')";
    phpmkr_query(utf8_encode($sql),$conn);  
    $iddependencia=phpmkr_insert_id();
  }
  $dependencia_cargo=busca_filtro_tabla("A.*","dependencia_cargo A","funcionario_idfuncionario=".$idfuncionario." AND cargo_idcargo=".$idcargo." AND dependencia_iddependencia=".$iddependencia,"",$conn);    
  if($dependencia_cargo["numcampos"]){
     $sql="UPDATE dependencia_cargo SET estado=1 WHERE iddependencia_cargo=".$dependencia_cargo[0]["iddependencia_cargo"];
  phpmkr_query(utf8_encode($sql),$conn);
  }
  else
  {
    $sql="INSERT INTO dependencia_cargo(funcionario_idfuncionario,cargo_idcargo,dependencia_iddependencia,fecha_inicial) VALUES('$idfuncionario','$idcargo','$iddependencia',to_date('".date("Y-m-d")."','YYYY-MM-DD'))";
    phpmkr_query(utf8_encode($sql),$conn);      
  }
  carga_permisos('idfuncionario',$funcionario[0]["idfuncionario"]);
return(TRUE);
}

 

function carga_permisos($tipo,$valor){
global $conn;
$sql_borra="";
$sql_radicacion="";
$sql_documento="";
$sql_configuracion="";
$sql_pagina="";
$sql_seguimiento_doc="";
$sql_permiso="";
$funcionario=array();
$funcionario=busca_filtro_tabla("A.*","funcionario A","estado=1 AND idfuncionario='".$valor."'","",$conn);   
if($funcionario["numcampos"]){
      //inicio de cambios de permisos por perfil            
      $permisos = busca_filtro_tabla("A.*","permiso_perfil A","perfil_idperfil=".$funcionario[0]["perfil"],"",$conn);      
      if($permisos["numcampos"]>0)
      {
       $sql_borra="delete from permiso where funcionario_idfuncionario=".$funcionario[0]["idfuncionario"];
       phpmkr_query($sql_borra,$conn);
       for($i=0; $i<$permisos["numcampos"]; $i++)
       {
         $sql_permiso = "INSERT INTO permiso(modulo_idmodulo,funcionario_idfuncionario,caracteristica_total,caracteristica_grupo,caracteristica_propio,tipo) VALUES";
         $sql_permiso.="('".$permisos[$i]["modulo_idmodulo"]."','".$funcionario[0]["idfuncionario"]."','".$permisos[$i]["caracteristica_total"]."','".$permisos[$i]["caracteristica_grupo"]."','".$permisos[$i]["caracteristica_propio"]."','0')";
         phpmkr_query($sql_permiso,$conn); 
       }       
      }
  }
}
if(@$_POST["accion"])
{
  //generar_archivo_intranet();
  carga_funcionarios();
  alerta("Los datos han sido cargados desde la intranet");
//  redirecciona("login.php");
}
else
{
?>
REALMENTE DESEA RECARGAR LA BASE DE DATOS CON LA INFORMACION DE LA INTRANET. TENGA EN CUENTA QUE
LA INFORMACION DE FUNCIONARIOS, DEPENDENCIAS, ROLES Y CARGOS SERA MODIFICADA.
<form action="pppMod.php" name="formulario" method="post">
<input type="hidden" name="accion" id="accion">
<input type="button" name="Aceptar" value="Aceptar" onclick="opcion(1)">
<input type="button" name="Cancelar" value="Cancelar" onclick="opcion(0)">
</form>
<?php
}
?>
<script>
function opcion(op)
{
  if(op==1)
  {
    document.getElementById('accion').value = op;
    formulario.submit();
  }
  else
    window.location="login.php";
}
</script>
