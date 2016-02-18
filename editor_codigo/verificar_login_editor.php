<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$salida=0;
$bValidPwd = false; 
$dias_sesion=busca_filtro_tabla("","configuracion","tipo='empresa' AND nombre='tiempo_cookie_login'","",$conn);
$retorno["mensaje"]="El nombre de usuario o contrase&ntilde;a introducidos no son correctos";
$retorno["ingresar"]=0;
if($dias_sesion["numcampos"]){
  $dias_sess=$dias_sesion[0]["valor"];
}
else $dias_sess=2;
$redirecciona='#';
$redirecciona_exito=$ruta_db_superior.'editor_codigo/editor_codigo.php';
if (@$_REQUEST["userid"]<>"" && @$_REQUEST["passwd"]<>"") {
  $_SESSION["LOGIN".LLAVE_SAIA_EDITOR]="";
  // Setup variables  
  $sUserId = @$_REQUEST["userid"];
  $sPassWd = @$_REQUEST["passwd"];    
  if (!($bValidPwd)) {      
      $sUserId = (!get_magic_quotes_gpc()) ? addslashes($sUserId) : $sUserId;
      $usuario = busca_filtro_tabla("A.*,".fecha_db_obtener("A.ultimo_pwd",'Y-m-d')." AS ultimo_pwd1 ,1 AS dep_estado,1 AS cargo_estado, ".resta_fechas('ultimo_pwd','')." AS dias","funcionario_editor A","A.login = '" . $sUserId . "' AND A.estado=1","",$conn);
      $pass=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='caducidad_password'","",$conn);
      $row=$usuario[0];                  
      if (@$row["estado"]) {
        if($row["dep_estado"]){    
          if($row["cargo_estado"]){
            if ($row["clave"] == encrypt_md5(trim($sPassWd))) {
              $_SESSION["LOGIN".LLAVE_SAIA_EDITOR]= $row["login"];
              $_SESSION["EMAIL".LLAVE_SAIA_EDITOR]= $row["email"];
              $bValidPwd = TRUE;
              almacenar_sesion_editor(1);
            }
            else{           
              $retorno["mensaje"]="Error en la clave de acceso.";
              $retorno["ingresar"]=0;
            }
          }
          else{
            $retorno["mensaje"]="El Cargo al que pertenece se encuentra inactiva por favor comuniquese con el administrador del sistema.";
            $retorno["ingresar"]=0;
          }
        }
        else{
          $retorno["mensaje"]="La dependencia a la que pertenece se encuentra inactiva por favor comuniquese con el administrador del sistema.";
          $retorno["ingresar"]=0;
        }
      }
      else{
          $retorno["mensaje"]="El funcionario esta inactivo o no pertenece al sistema.";
      }
   phpmkr_free_result($rs);
  }
  if ($bValidPwd) {
    if (@$_POST["rememberme"] <> "") {
      setCookie("alcalde_userid", $sUserId, time()+$dias_sess*24*60*60); 
      if (@$_POST["rememberme_pwd"] <> "") {
        setCookie("alcalde_pwd", $sPassWd, time()+$dias_sess*24*60*60); 
      }
      else setCookie("alcalde_pwd", "", 0);
    }
    else setCookie("alcalde_userid", "" ,0);
     $retorno["mensaje"]="Bienvenidos al editor de c&oacute;digo del sistema SAIA";
     $retorno["ruta"]=$redirecciona_exito; 
     $retorno["ingresar"]=1;   
  } 
  else {    
    almacenar_sesion(0,$sUserId);
    $retorno["ruta"]=$redirecciona;
  }
}
else{
$retorno["ruta"]=$redirecciona;
}
function almacenar_sesion_editor($exito=0){
    global $conn;
    $iplocal=getRealIP();
    $ipremoto=servidor_remoto();
    if($iplocal=="" || $ipremoto==""){
      if($iplocal=="")
          $iplocal=$ipremoto;
      else $ipremoto=$iplocal;
    }
    $sql2="INSERT INTO log_acceso_editor(iplocal,ipremota,login,fecha,exito) VALUES('$iplocal','$ipremoto','".$_SESSION["LOGIN".LLAVE_SAIA_EDITOR]."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$exito.")";
    $conn->Ejecutar_Sql($sql2);
}
echo(stripslashes(json_encode($retorno)));
?>