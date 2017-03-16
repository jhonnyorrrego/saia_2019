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
$salida=0;
$bValidPwd = false;	
$dias_sesion=busca_filtro_tabla("","configuracion","tipo='empresa' AND nombre='tiempo_cookie_login'","",$conn);
if($dias_sesion["numcampos"]){
  $dias_sess=$dias_sesion[0]["valor"];
}
else $dias_sess=2;

if (@$_REQUEST["submit"] <> "") {
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
			$sSql = "SELECT A.*,DATE_FORMAT(A.ultimo_pwd,'%Y-%m-%d') AS ultimo_pwd1 ,1 AS dep_estado,1 AS cargo_estado, DATEDIFF(CURDATE(),ultimo_pwd) AS dias FROM funcionario A";
			$sSql .= " WHERE A.login = '" . $sUserId . "' AND A.estado=1";

			$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
      $row = phpmkr_fetch_array($rs);
      /*print_r($row);
      die($sSql); */
      $pass=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='caducidad_password'","",$conn);
      if (isset($row["estado"]) && $row["estado"]) {
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
        if($salir){
			   	@session_unset();
          @session_destroy();
          //almacenar_sesion(0,$sUserId);
		      redirecciona("login.php");
        }
			  //$datos_int=busca_filtro_tabla("A.*","temporal_funcionario A","A.login = '".$_SESSION["LOGIN".LLAVE_SAIA]."'","",$conn);
			}
			else
			{
          alerta(utf8_encode("El funcionario esta inactivo o no pertenece al sistema."));
			   	@session_unset();
          @session_destroy();
          almacenar_sesion(0,$sUserId);
		      redirecciona("login.php");
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
     abrir_url("index.php","_top");    
	} 
  else {	  
		alerta(utf8_encode("CLAVE DE ACCESO O NOMBRE DE USUARIO NO VALIDO."));
		@session_unset();
    @session_destroy();
    almacenar_sesion(0,$sUserId);
		redirecciona("login.php");
	}
}
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
	if (!EW_hasValue(EW_this.userid, "TEXT" )) {
		if  (!EW_onError(EW_this, EW_this.userid, "TEXT", "POR FAVOR INGRESE SU NOMBRE DE USUARIO"))
			return false;
	}
	if (!EW_hasValue(EW_this.passwd, "PASSWORD" )) {
		if (!EW_onError(EW_this, EW_this.passwd, "PASSWORD", "POR FAVOR INGRESE LA CLAVE DE ACCESO"))
			return false;
	}
	return true;
}
//-->
</script>
<style type="text/css">
<!--
body {
	background-image: url(imagenes/entrar_demo.jpg);
	background-repeat:no-repeat;
	background-position:center;
}
#Layer1 {
	position:absolute;
	top:234px;
	width:683px;
	height:100px;
	z-index:1;
	left: 22px;
}
-->
</style>
<?php include_once ("header.php") ?>
<?php
if(!isset($_SESSION["LOGIN".LLAVE_SAIA]) || ($_SESSION["LOGIN".LLAVE_SAIA]=="")||$bValidPwd){
?>
<div id="Layer1" align="right">
  <form action="login.php" method="post" onsubmit="return EW_checkMyForm(this);">
    <table border="0" cellspacing="0" cellpadding="4" >
      <tr>
        <td><span class="phpmaker"><font color="white">NOMBRE DE USUARIO</font></span></td>
        <td><span class="phpmaker">
          <input type="text" name="userid" size="20" value="<?php echo @$_COOKIE["alcalde_userid"]; ?>" style="text-transform:none;"/>
        </span></td>
      </tr>
      <tr>
        <td><span class="phpmaker"><font color="white">CLAVE DE ACCESO</font></span></td>
        <td><span class="phpmaker">
          <input type="password" name="passwd" size="20" value="<?php echo @$_COOKIE["alcalde_pwd"]; ?>" style="text-transform:none;"/>
        </span></td>
      </tr>
      <?php 
        $opciones_logueo=busca_filtro_tabla("","configuracion","tipo LIKE 'empresa' AND nombre='recordar_usuario_login'","",$conn);
        if($opciones_logueo["numcampos"] && $opciones_logueo[0]["valor"]){ ?>
      <tr>
        <td colspan="2" title="Recuerda su nombre de usuario en este equipo por <?php echo($dias_sess);?> dias desde la ultima vez que ingrese al sistema con la opcion seleccionada"><span class="phpmaker">
          <input type="checkbox" name="rememberme" value="true" <?php if(@$_COOKIE["alcalde_userid"]) echo("checked");?> />
          RECORDAR USUARIO</span></td>
      </tr>
      <?php
      $opciones_logueo=busca_filtro_tabla("","configuracion","tipo LIKE 'empresa' AND nombre='recordar_passwd_login'","",$conn);
        if($opciones_logueo["numcampos"] && $opciones_logueo[0]["valor"]){ ?>
        <tr>
          <td colspan="2" title="Recuerda su nombre de Clave de Acceso en este equipo por <?php echo($dias_sess);?> dias desde la ultima vez que ingrese al sistema con la opcion seleccionada,Utilice esta opcion bajo su propia responsabilidad" ><span class="phpmaker">
            <input type="checkbox" name="rememberme_pwd" value="true" <?php if(@$_COOKIE["alcalde_pwd"]) echo("checked");?>/>
            RECORDAR CONTRASE&Ntilde;A</span></td>
        </tr>
        <?php
        }
      } ?>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center"><div align="left"><span class="phpmaker">
          <input type="submit" name="submit" value="INGRESAR"/>
        </span></div></td>
      </tr>
    </table>
  </form>
</div>
<?php }
 include ("footer.php"); ?>
