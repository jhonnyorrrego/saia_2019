<?php
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
$salida=0;
$bValidPwd = false;	
$dias_sesion=busca_filtro_tabla("","configuracion","tipo='empresa' AND nombre='tiempo_cookie_login'","",$conn);
$retorno["mensaje"]="<b>El nombre de usuario o contrase&ntilde;a introducidos no son correctos!</b> <br> intente de nuevo";
$retorno["ingresar"]=0;
if($dias_sesion["numcampos"]){
  $dias_sess=$dias_sesion[0]["valor"];
}
else $dias_sess=2;
$redirecciona='#';
$redirecciona_exito='index_'.$_REQUEST["INDEX"].".php";
if (@$_REQUEST["userid"]<>"" && @$_REQUEST["passwd"]<>"") {
  $_SESSION["LOGIN".LLAVE_SAIA]="";
	// Setup variables	
	$sUserId = @$_REQUEST["userid"];
	$sPassWd = @$_REQUEST["passwd"];  	
	$configuracion=busca_filtro_tabla("A.valor","configuracion A","A.tipo='usuario' AND A.nombre='login_administrador'","",$conn);
	$clave_admin=busca_filtro_tabla("A.valor,A.encrypt","configuracion A","A.tipo='clave' AND A.nombre='clave_administrador'","",$conn); 
	if($clave_admin['numcampos']){
		if($clave_admin[0]["encrypt"]){
			$clave_admin[0]["valor"]=decrypt_blowfish($clave_admin[0]["valor"],LLAVE_SAIA_CRYPTO);	
		}	
	}
	if($configuracion["numcampos"]&&$clave_admin["numcampos"] && $configuracion[0]["valor"]==$sUserId && $clave_admin[0]["valor"]==$sPassWd){
	$estado_admin=busca_filtro_tabla("estado","funcionario","lower(login)='".strtolower($sUserId)."'","",$conn);
	if($estado_admin[0]['estado']){
        $_SESSION["LOGIN".LLAVE_SAIA]=$sUserId;
        cerrar_sesiones_activas($sUserId);
        $bValidPwd=true;
        $retorno["mensaje"]="<b>IMPORTANTE!</b> <br> Acaba de ingresar como Administrador del sistema, todas las acciones realizadas son registradas bajo su responsabilidad";    
        $retorno["ingresar"]=1;
        $retorno["ruta"]=$redirecciona_exito;
        die(stripslashes(json_encode($retorno)));  	    
	}else{
	     $retorno["ingresar"]=0;
	      $retorno["mensaje"]="<span style='color:white;'><b>El funcionario esta inactivo o no pertenece al sistema!<b> <br> por favor comuniquese con el administrador del sistema.</span>";
	      die(stripslashes(json_encode($retorno)));  	  
	}
	
         
  }
    if (!($bValidPwd)) {			
	    $sUserId = (!get_magic_quotes_gpc()) ? addslashes($sUserId) : $sUserId;
		$usuario = busca_filtro_tabla("A.*,".fecha_db_obtener("A.ultimo_pwd",'Y-m-d')." AS ultimo_pwd1, ".resta_fechas('ultimo_pwd','')." AS dias,1 AS cargo_estado","vfuncionario_dc A","A.login = '" . $sUserId . "'","",$conn);
        $pass=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='caducidad_password'","",$conn);
        $row=$usuario[0]; 
        $rol=0;  
        for($i=0;$i<$usuario["numcampos"];$i++){
            if($usuario[$i]["estado_dc"] && $rol==0 && ( $usuario[$i]["fecha_final"]>=date('Y-m-d- H:i:s'))){
                $rol=1;
                break;
            }
        }
        if(!$rol){
          $usuario = busca_filtro_tabla("A.*,".fecha_db_obtener("A.ultimo_pwd",'Y-m-d')." AS ultimo_pwd1, ".resta_fechas('ultimo_pwd','')." AS dias,1 AS cargo_estado","funcionario A","A.login = '" . $sUserId . "'","",$conn);
          if(!$usuario["numcampos"]){
              $retorno["mensaje"]="<b>El funcionario no pertenece al sistema!<b> <br> por favor comuniquese con el administrador del sistema.";
              die(stripslashes(json_encode($retorno)));  	  
          }
          $retorno["mensaje"]="<b>Error en roles !</b> <br> El usuario no cuenta con roles activos";
          $retorno["ingresar"]=0;
          die(stripslashes(json_encode($retorno)));  	  
        }
      else if (@$row["estado"]) {
        if(($row["dias"]>30 || $row["ultimo_pwd1"]=="0000-00-00") && @$pass[0]["valor"]){
          $retorno["mensaje"]="<b>ATENCION!</b> <br>DEBE REALIZAR EL CAMBIO DE CLAVE!";
          $retorno["ruta"]="changepwd.php?login=".$sUserId;
          $retorno["ingresar"]=1;          
        }
        if($row["estado_dep"]){    
          if($row["cargo_estado"]){
    		if ($row["clave"] == encrypt_md5(trim($sPassWd))) {
              $_SESSION["LOGIN".LLAVE_SAIA]= $row["login"];
    		  $bValidPwd = TRUE;
              cerrar_sesiones_activas($row["login"]);
    		}
    		else{           
              $retorno["mensaje"]="<b>Error en la clave de acceso!</b> <br> intente de nuevo";
              $retorno["ingresar"]=0;
            }
    	  }
  		  else{
            $retorno["mensaje"]="<b>El Cargo al que pertenece se encuentra inactivo!</b><br> por favor comuniquese con el administrador del sistema.";
            $retorno["ingresar"]=0;
          }
        }
  	    else{
          $retorno["mensaje"]="<b>La dependencia a la que pertenece se encuentra inactiva!</b><br> por favor comuniquese con el administrador del sistema.";
          $retorno["ingresar"]=0;
        }
        if(@$retorno["ingresar"]==0){
			   	/*@session_unset();
          @session_destroy();*/
          //almacenar_sesion(0,$sUserId); 
        }
			}
			else{
          $retorno["mensaje"]="<b>El funcionario esta inactivo o no pertenece al sistema!<b> <br> por favor comuniquese con el administrador del sistema.";
			   	/*@session_unset();
          @session_destroy();*/
          //almacenar_sesion(0,$sUserId);
			}
	 phpmkr_free_result($rs);
	}
	if ($bValidPwd) {
  	if (@$_POST["rememberme"] <> "") {
			setCookie("saia_userid", $sUserId, time()+$dias_sess*24*60*60); 
  		if (@$_POST["rememberme_pwd"] <> "") {
  			setCookie("saia_pwd", $sPassWd, time()+$dias_sess*24*60*60); 
  		}
  		else setCookie("saia_pwd", "", 0);
    }
    else setCookie("saia_userid", "" ,0);
     include_once("tarea_limpiar_carpeta.php");
     borrar_archivos_carpeta("temporal_".$_POST["userid"],false);
     $retorno["mensaje"]="<b>Bienvenido</b> <br>has ingresado al sistema SAIA";
     $retorno["ruta"]=$redirecciona_exito; 
     $retorno["ingresar"]=1;   
	} 
  else {	  
		/*@session_unset();
    @session_destroy();*/
    $dato=almacenar_sesion(0,$sUserId);
		if($dato["mensaje"]){
			$retorno["mensaje"]=$dato["mensaje"];
		}
		$retorno["ruta"]=$redirecciona;
	}
}
else{
$retorno["ruta"]=$redirecciona;
}
echo(stripslashes(json_encode($retorno)));
?>
