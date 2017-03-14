<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
include_once("db.php");
include_once("phpmkrfn.php");
//require_once('class.jabber.php'); 
// User levels
$redirecciona="index.php"; 
if(@$_REQUEST["INDEX"]){
  $redirecciona.='?INDEX='.$_REQUEST["INDEX"];
  $redirecciona_exito="index_".$_REQUEST["INDEX"].".php";
}
else if(@$_SESSION){
  $redirecciona.='?INDEX='.$_SESSION["INDEX"];
  $redirecciona_exito="index_".$_SESSION["INDEX"].".php";
}

$salida=0;
$bValidPwd = false;	
$dias_sesion=busca_filtro_tabla("","configuracion","tipo='empresa' AND nombre='tiempo_cookie_login'","",$conn);
if($dias_sesion["numcampos"]){
  $dias_sess=$dias_sesion[0]["valor"];
}
else $dias_sess=2;

if (@$_REQUEST["boton_ui"] <> "") {
  $_SESSION["LOGIN".LLAVE_SAIA]="";
	// Setup variables	
	$sUserId = @$_POST["userid"];
	$sPassWd = @$_POST["passwd"];
	$nom_bd  = @$_POST["x_bd"];	
	/*$_SESSION["db"] = "saia";
	$_SESSION["db"] = $nom_bd;*/  	
	$configuracion=busca_filtro_tabla("A.valor","configuracion A","A.tipo='usuario' AND A.nombre='login_administrador'","",$conn);
	$clave_admin=busca_filtro_tabla("A.valor,A.encrypt","configuracion A","A.tipo='clave' AND A.nombre='clave_administrador'","",$conn);
	if($configuracion["numcampos"]&&$clave_admin["numcampos"]){
		if($clave_admin[0]["encrypt"]){
			include_once('pantallas/lib/librerias_cripto.php');
			$clave_admin[0]["valor"]=decrypt_blowfish($clave_admin[0]["valor"],LLAVE_SAIA_CRYPTO);			
		}	
	 if($configuracion[0]["valor"]==$sUserId && $clave_admin[0]["valor"]==$sPassWd){
	   $_SESSION["LOGIN".LLAVE_SAIA]=$configuracion[0]["valor"];
     alerta("IMPORTANTE: Acaba de ingresar como Administrador del sistema, todas las acciones que ejecute se registr�n bajo su responsabilidad.");
     $bValidPwd=true;
	 }  
  }
	if (!($bValidPwd)) {			
			$sUserId = (!get_magic_quotes_gpc()) ? addslashes($sUserId) : $sUserId;
			$usuario = busca_filtro_tabla("A.*,".fecha_db_obtener("A.ultimo_pwd",'Y-m-d')." AS ultimo_pwd1 ,1 AS dep_estado,1 AS cargo_estado, ".resta_fechas('ultimo_pwd','')." AS dias","funcionario A","A.login = '" . $sUserId . "' AND A.estado=1","",$conn);
      $pass=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='caducidad_password'","",$conn);
      $row=$usuario[0];                  
      if (@$row["estado"]) {
        if(($row["dias"]>30 || $row["ultimo_pwd1"]=="0000-00-00") && @$pass[0][0]){
          alerta("DEBE REALIZAR EL CAMBIO DE CLAVE!");
          abrir_url("changepwd.php?login=".$sUserId,"_top");
        }
        //$dependencia=busca_filtro_tabla("","dependencia_cargo B, dependencia D","B.dependencia_iddependencia=D.iddependencia AND B.funcionario_idfuncionario=".$row["idfuncionario"]." AND D.estado=1 AND B.estado=1","",$conn);
        if($row["dep_estado"]){
          //$cargo=busca_filtro_tabla("","dependencia_cargo B,cargo C"," B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=".$row["idfuncionario"]." AND C.estado=1 AND B.estado=1","",$conn);
          if($row["cargo_estado"]){
  			    //$row = phpmkr_fetch_array($rs);
    				if ($row["clave"] == $sPassWd) {
    					//$_SESSION["alcalde_status_User"]
              $_SESSION["LOGIN".LLAVE_SAIA]= $row["login"];
              //alerta(implode(",",$_SESSION));
              //conectar_mensajeria();
    					$bValidPwd = TRUE;
    				}
    				else{
              alerta("Error en la clave de acceso.");
              $salida=1;
            }
    			}
  				else{
            alerta("El Cargo al que pertenece se encuentra inactiva por favor comuniquese con el administrador del sistema.");
            $salir=1;
          }
        }
  			else{
          alerta("La dependencia a la que pertenece se encuentra inactiva por favor comuniquese con el administrador del sistema.");
          $salir=1;
        }
        if(@$salir){
			   	@session_unset();
          @session_destroy();
          //almacenar_sesion(0,$sUserId);
		      redirecciona($redirecciona);
        }
			  //$datos_int=busca_filtro_tabla("A.*","temporal_funcionario A","A.login = '".$_SESSION["LOGIN".LLAVE_SAIA]."'","",$conn);
			}
			else
			{
          alerta(codifica_encabezado("El funcionario esta inactivo o no pertenece al sistema."));
			   	@session_unset();
          @session_destroy();
          almacenar_sesion(0,$sUserId);
		      redirecciona($redirecciona);
			}
			  //die("<br>el valor de la bandera es: ".$bValidPwd." y de la session es:". $_SESSION["LOGIN".LLAVE_SAIA]);
	 phpmkr_free_result($rs);
	}
	if ($bValidPwd) 
  {
  	if (@$_POST["rememberme"] <> "") {
			setCookie("alcalde_userid", $sUserId, time()+$dias_sess*24*60*60); // change cookie expiry time here
  		if (@$_POST["rememberme_pwd"] <> "") {
  			setCookie("alcalde_pwd", $sPassWd, time()+$dias_sess*24*60*60); // change cookie expiry time here
  		}
  		else setCookie("alcalde_pwd", "", 0);
    }
    else setCookie("alcalde_userid", "" ,0);
		///////////////////////////REDIRECCION INTRANET////////////////////////////////////////
/*    if($datos_int["numcampos"])
    {
      for($col=0;$col<count($datos_int[0])/2-1;$col++)
		  {
        if($datos_int[0][$col]=="" OR !$datos_int[0][$col])
        {
          abrir_url("http://10.1.7.31/Apps/Consultas/Usuario.php?Login=".$_SESSION["LOGIN".LLAVE_SAIA],"_parent");
        }
      }
    }*/
    ///////////////////////////////////////////////////////////////////////////////////
    
     include_once("tarea_limpiar_carpeta.php");
     borrar_archivos_carpeta("temporal_".$_POST["userid"],false);
     abrir_url($redirecciona_exito,"_top");    
	} 
  else {	  
		alerta(codifica_encabezado("CLAVE DE ACCESO O NOMBRE DE USUARIO NO VALIDO."));
		@session_unset();
    @session_destroy();
    almacenar_sesion(0,$sUserId);
		redirecciona($redirecciona);
	}
}
else{
redirecciona($redirecciona);
}
?>