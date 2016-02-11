<?php
include_once("db.php");
include_once("email/mail.inc.php");
$mail = new MyMailer;
if(@$_REQUEST["idasignacion"]){
$argv[1]="asignacion=".$_REQUEST["idasignacion"];
}
if($argv[1]!=""){
  $parametros=parsea_parametros($argv[1]);
  foreach($parametros AS $llave=>$valor){
    if($valor[0]=="asignacion"){
      $asignacion=busca_filtro_tabla("","asignacion","idasignacion=".$valor[1],"",$conn);
      if($asignacion["numcampos"]){
        $cuerpo="Esto es un sistema automatico por favor no responda a este correo \n TAREAS PROGRAMADAS SAIA:\n";
        if($asignacion[0]["documento_iddocumento"]){
          $documento=busca_filtro_tabla("","documento","iddocumento=".$asignacion[0]["documento_iddocumento"],"",$conn);
          if($documento["numcampos"]){
            $cuerpo.=" Usted posee el(la) ".$documento[0]["plantilla"]." con Radicado: ".$documento[0]["numero"]." \nDescripcion: ".$documento[0]["descripcion"];
          }
          else $cuerpo.=" Existen problemas con la verificacion del documento que posee el ID:".$asigancion[0]["documento_iddocumento"];
        }
        if($asignacion[0]["tarea_idtarea"]){
          $tarea=busca_filtro_tabla("","tarea","idtarea=".$asignacion[0]["tarea_idtarea"],"",$conn);
          if($tarea["numcampos"]){
            $cuerpo.=" \nTarea: ".$tarea[0]["nombre"];
          }
          else $cuerpo.=" Existe problemas con la verificacion de la tarea que posee el ID:".$asigancion[0]["tarea_idtarea"];
        }

        $funcionario=busca_funcionarios_entidad($asignacion[0]["entidad_identidad"],$asignacion[0]["llave_entidad"],"login,email,nombres,apellidos");
        if($funcionario["numcampos"]){
          for($j=0;$j<$funcionario["numcampos"];$j++){
            if($funcionario[$j]["email"] && $funcionario[$j]["email"]!=""){
              $email=$funcionario[$j]["email"];
            }
            else $email=EMAIL_ADMINISTRADOR;
            if($funcionario[$j]["nombres"]!=""){
              $nombres=$funcionario[$j]["nombres"]." ".$funcionario[$j]["apellidos"];
            }
            else $nombre= " Usuario SAIA ";
            $mail->AddAddress($email, $nombres);
          }
        }
        else {
          $email=EMAIL_ADMINISTRADOR;
          $nombre=" ERROR SAIA ";
          $mail->AddAddress($email, $nombres);
        }
      }
      else $cuerpo=" Existe un problema con la verificacion de la asignacion con valor ID:".$valor[1];
    }
    else if($valor[0]=="lasignaciones"){
    alerta("HOLA",'success',4000);
    }
  }
}
else  {
  $cuerpo=" Se intento realizar una notificacion de Tarea y no pudo realizarse por favor notificar a su Administrador ";
  $email=EMAIL_ADMINISTRADOR;
  $nombre=" ERROR SAIA ";
  $mail->AddAddress($email, $nombres);
}
$mail->Subject = "Tareas Programadas con  - SAIA ".date("Y-m-d H:i");
$mail->Body    = strip_tags($cuerpo);
if(!$mail->Send()){
  echo(false);
}
else {
  echo(true);
}
function parsea_parametros($cadena){
$parametros=array();
$datos=explode(";",$cadena);
if(!is_array($datos)){
  $datos=array($cadena);
}
foreach($datos AS $llave=>$valor){
  array_push($parametros,explode("=",$valor));
}
return($parametros);
}
function busca_funcionarios_entidad($entidad,$llave,$campos){
global $conn;
  $funcionario=array();
  $funcionario["numcampos"]=0;
  switch($entidad){
    case 1:
      $funcionario=busca_filtro_tabla($campos,"funcionario","funcionario_codigo='".$llave."'","",$conn);
      if($funcionario["numcampos"]){
        return $funcionario;
      }
    break;
  }
 return($funcionario);
}
?>
