<?php include_once("db.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php 
//Sql para cambiar la tabla funcionario ALTER TABLE funcionario ADD ultimo_pwd DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
include ("phpmkrfn.php"); 
$_SESSION["LOGIN".LLAVE_SAIA]=="";
if (@$_POST["submit"] <> "") {
	$bValidPwd = False;
	$bPwdUpdated = False;
	// Setup variables
	$sUserID = @$_POST["usuario"];
	$sOPwd = @$_POST["passwordAnt"];
	
	die();
	$sNPwd = @$_POST["passwordPwd"];
	$sCPwd = @$_POST["repasswordPwd"];
	if ($sNPwd == $sCPwd) {
		$sUserID = (!get_magic_quotes_gpc()) ? addslashes($sUserID) : $sUserID;
    //phpmkr_db_connect();
    //print_r($conn);
    $strsql="Select * FROM funcionario WHERE login = '" . $sUserID . "' AND estado=1";
    $rs=phpmkr_query($strsql,$conn);
    $temp=phpmkr_fetch_array($rs);
    $row=array();
    $row["sql"]=$sql;
    for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
      array_push($row,$temp);
    $row["numcampos"]=$i;  
    phpmkr_free_result($rs);
		if ($row["numcampos"]) {
			if ($sOPwd == $row[0]["clave"]) {			   
				$sSql = "Update funcionario";
				$sSql .= " set clave = '" . $sNPwd . "', ultimo_pwd=DATE_FORMAT('".date('Y-m-d H:i:s')."','%Y-%m-%d %H:%i:%s') ";
				$sSql .= " WHERE idfuncionario = '" . $row[0]["idfuncionario"] . "'";
				//die($sSql);
				phpmkr_query($sSql,$conn) or die("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
				$bValidPwd = true;
				$bPwdUpdated = true;
        $_SESSION["LOGIN".LLAVE_SAIA]=$row[0]["login"];				
			}
			else{
			  alerta("LA CLAVE DE ACCESO ANTERIOR NO COINCIDE");
      }
		}
		else {
      alerta("NO SE ENCUENTRA EL USUARIO O EL USUARIO NO ESTA ACTIVO");
    }
		phpmkr_free_result($rs);		
	}
	else{
    alerta("CLAVE DE ACCESO NO COINCIDE");
  } 
	if ($bPwdUpdated) {
		alerta("CLAVE DE ACCESO ACTUALIZADA");		
		abrir_url("index.php","_top");				
	}
}
else
{
	$bValidPwd = true;
}
?>
<body>
<link href="css/password.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="js/pwd_meter.js"></script>
<script type="text/javascript" language="javascript" src="ew.js"></script>
<!--[if lt IE 7]>
	<link href="css/ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript">
<!-- 
function  EW_checkMyForm(EW_this) {
if  (!EW_hasValue(EW_this.usuario, "TEXT" )) {
  if  (!EW_onError(EW_this, EW_this.usuario, "TEXT", "POR FAVOR INGRESE SU USUARIO"))
    return false;
}
if  (!EW_hasValue(EW_this.passwordAnt, "TEXT" )) {
  if  (!EW_onError(EW_this, EW_this.passwordAnt, "TEXT", "POR FAVOR INGRESE LA CLAVE DE ACCESO ANTERIOR"))
    return false;
}
if(EW_hasValue(EW_this.oldpwd, "TEXT" ) && EW_this.oldpwd.value!=EW_this.passwordAnt.value){
    alert("LA CLAVE DE ACCESO ANTERIOR NO COINCIDE");
    // alert(EW_this.oldpwd);
     return false;
}  
if  (!EW_hasValue(EW_this.passwordPwd, "TEXT" )) {
  if  (!EW_onError(EW_this, EW_this.passwordPwd, "TEXT", "POR FAVOR INGRESE LA NUEVA CLAVE DE ACCESO"))
    return false;
}
if(EW_this.oldpwd.value==EW_this.passwordPwd.value){
    alert("LA CLAVE DE ACCESO ANTERIOR Y LA NUEVA NO DEBEN COINCIDIR");
    return false;
}  
if  (!EW_hasValue(EW_this.repasswordPwd, "TEXT" )) {
  if  (!EW_onError(EW_this, EW_this.repasswordPwd, "TEXT", "POR FAVOR REPITA LA CLAVE DE ACCESO"))
    return false;
}
if  (EW_this.passwordPwd.value != EW_this.repasswordPwd.value) {
  if  (!EW_onError(EW_this, EW_this.repasswordPwd, "TEXT", "CLAVES DE ACCESO NO COINCIDE"))
    return false;
}
if(EW_this.nscore.value<60){
  alert("SU CLAVE DEBE TENER MAYOR SEGURIDAD");
  return false;
}  
return true;
}
-->
</script> 
<?php include_once("header.php") ?>
<form onSubmit="return EW_checkMyForm(this);" method="POST" action="changepwd.php" id="formPassword" name="formPassword">
  <table id="tablePwdCheck" cellpadding="5" cellspacing="1" border="0">
    <tr>
     <td> </td>
    </tr><tr>
      <th colspan="4" class="encabezado">CAMBIO DE CONTRASE&Ntilde;A</th>
    </tr>
     <tr>
          <th class="encabezado">Usuario*:</th>
          <td>
            <?php
              if(@$_REQUEST["login"]){
            ?>
          	<input type="text" id="usuario" name="usuario" maxlength="16" autocomplete="off" value="<?php echo($_REQUEST["login"]);?>"/>
            <?php                
              }
              else if(!@$_SESSION["usuario_actual"]){ ?>
          	<input type="text" id="usuario" name="usuario" maxlength="16" autocomplete="off" />
            <?php 
              } 
              else{
              $login=usuario_actual("login");
              echo($login)
            ?>
                <input type="hidden" id="usuario" name="usuario" value="<?php echo(usuario_actual("login"));?>" />
            <?php
              }
            ?> 	
          </td>
          <td rowspan="5"  class="encabezado">
              <ul>
                  <!--li>Digite como m&iacute;nimo 8 caracteres</li-->
                  <li>Debe contener 3/4 de los siguientes items:<br />
                      - May&uacute;sculas<br />
                      - Min&uacute;sculas<br />
                      - N&uacute;meros<br />
                      - S&iacute;mbolos<br />
                  </li>
                  <li>La clave Anterior y la nueva no pueden ser Iguales </li>
              </ul>
              <br /><b>Valoraci&oacute;n:</b><br />
              <table border="0">
                    <tr>
                      <th  class="encabezado">Ocultar:</th>
                      <td><input type="checkbox" id="mask" name="mask" value="1" checked="checked" onclick="togPwdMask();" /></td>
                  </tr>
                  <tr>
                      <th  class="encabezado">Puntaje:</th>
                      <td>
                          <div id="scorebarBorder">
                          <div id="score">0%</div>
                          <div id="scorebar">&nbsp;</div>
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <th  class="encabezado">Complejidad:</th>
                      <td><div id="complexity">Muy corta</div></td>
                  </tr>
              </table>
          </td>
      </tr>  
     <tr>
        <th  class="encabezado">Contrase&ntilde;a Anterior*:</th>
        <td>
        	<input type="password" id="passwordAnt" name="passwordAnt" maxlength="16" autocomplete="off"  />
        </td>

     </tr>                
     <tr>
          <th  class="encabezado">Nueva Contrase&ntilde;a*:</th>
          <td>
          	<input type="password" id="passwordPwd" name="passwordPwd" maxlength="16" autocomplete="off" onkeyup="chkPass(this.value);" />
	<input type="text" id="passwordTxt" name="passwordTxt" maxlength="16" autocomplete="off" onkeyup="chkPass(this.value);" class="hide" />
          </td>          
      </tr>
     <tr>
          <th  class="encabezado">Repetir Contrase&ntilde;a*:</th>
          <td>
          	<input type="password" id="repasswordPwd" name="repasswordPwd" maxlength="16" autocomplete="off" />
          </td>
      </tr>  
      <tr>
        <td colspan="2"  align="center">  
          <input type="hidden" name="submit" value="1">
          <input type="hidden" id="nscore" name="nscore" />
          <?php 
              $oldpwd="";
              if(@$_SESSION["usuario_actual"]){
                $oldpwd=usuario_actual("clave");
              } 
          ?>          
          <input type="hidden" id="oldpwd" name="oldpwd" value="<?php echo($oldpwd);?>" />
          <input type="submit">
        </td>
      </tr>              
  </table>
</form>
  <table id="tablePwdStatus" cellpadding="5" cellspacing="1" border="0">
      <tr>
          <th colspan="2"  class="encabezado">Consideraciones</th>
          <th class="encabezado">Caracteres</th>
          <th class="encabezado">Valor</th>
      </tr>
      <tr>
          <td width="1%"><div id="div_nLength" class="fail">&nbsp;</div></td>
          <td width="94%">N&uacute;mero Total de Caracteres</td>
          <td width="1%"><div id="nLength" class="box">&nbsp;</div></td>
          <td width="1%"><div id="nLengthBonus" class="boxPlus">&nbsp;</div></td>
      </tr>	
      <tr>
          <td><div id="div_nAlphaUC" class="fail">&nbsp;</div></td>
          <td>Letras may&uacute;sculas</td>
          <td><div id="nAlphaUC" class="box">&nbsp;</div></td>
          <td><div id="nAlphaUCBonus" class="boxPlus">&nbsp;</div></td>
      </tr>	
      <tr>
          <td><div id="div_nAlphaLC" class="fail">&nbsp;</div></td>
          <td>Letras Min&uacute;sculas</td>
          <td><div id="nAlphaLC" class="box">&nbsp;</div></td>
          <td><div id="nAlphaLCBonus" class="boxPlus">&nbsp;</div></td>
      </tr>
      <tr>
          <td><div id="div_nNumber" class="fail">&nbsp;</div></td>
          <td>N&uacute;meros</td>
          <td><div id="nNumber" class="box">&nbsp;</div></td>
          <td><div id="nNumberBonus" class="boxPlus">&nbsp;</div></td>
      </tr>
      <tr>
          <td><div id="div_nSymbol" class="fail">&nbsp;</div></td>
          <td>S&iacute;mbolos</td>
          <td><div id="nSymbol" class="box">&nbsp;</div></td>
          <td><div id="nSymbolBonus" class="boxPlus">&nbsp;</div></td>
      </tr>
      <tr>
          <td><div id="div_nMidChar" class="fail">&nbsp;</div></td>
          <td>N&uacute;meros en medio de S&iacute;mbolos</td>
          <td><div id="nMidChar" class="box">&nbsp;</div></td>
          <td><div id="nMidCharBonus" class="boxPlus">&nbsp;</div></td>
      </tr>
      <tr>
          <td><div id="div_nRequirements" class="fail">&nbsp;</div></td>
          <td>Requerimientos</td>
          <td><div id="nRequirements" class="box">&nbsp;</div></td>
          <td><div id="nRequirementsBonus" class="boxPlus">&nbsp;</div></td>
      </tr>
      <tr>
          <th colspan="6"  class="encabezado">Deduce por</th>
      </tr>
			<tr>
        <td width="1%"><div id="div_nAlphasOnly" class="pass">&nbsp;</div></td>
        <td width="94%">Solo letras</td>
        <td width="1%"><div id="nAlphasOnly" class="box">&nbsp;</div></td>
        <td width="1%"><div id="nAlphasOnlyBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nNumbersOnly" class="pass">&nbsp;</div></td>
        <td>Solo n&uacute;meros</td>
        <td><div id="nNumbersOnly" class="box">&nbsp;</div></td>
        <td><div id="nNumbersOnlyBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nRepChar" class="pass">&nbsp;</div></td>
        <td>Caracteres repetidos (No diferencia M de m)</td>
        <td><div id="nRepChar" class="box">&nbsp;</div></td>
        <td><div id="nRepCharBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nConsecAlphaUC" class="pass">&nbsp;</div></td>
        <td>Letras may&uacute;sculas consecutivas</td>
        <td><div id="nConsecAlphaUC" class="box">&nbsp;</div></td>
        <td><div id="nConsecAlphaUCBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nConsecAlphaLC" class="pass">&nbsp;</div></td>
        <td>Letras min&uacute;sculas Consecutivas</td>
        <td><div id="nConsecAlphaLC" class="box">&nbsp;</div></td>
        <td><div id="nConsecAlphaLCBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nConsecNumber" class="pass">&nbsp;</div></td>
        <td>N&uacute;meros consecutivos</td>
        <td><div id="nConsecNumber" class="box">&nbsp;</div></td>
        <td><div id="nConsecNumberBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nSeqAlpha" class="pass">&nbsp;</div></td>
        <td>Letras en secuencia (3+)</td>
        <td><div id="nSeqAlpha" class="box">&nbsp;</div></td>
        <td><div id="nSeqAlphaBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
			<tr>
        <td><div id="div_nSeqNumber" class="pass">&nbsp;</div></td>
        <td>Numeros en secuencia (3+)</td>
        <td><div id="nSeqNumber" class="box">&nbsp;</div></td>
        <td><div id="nSeqNumberBonus" class="boxMinus">&nbsp;</div></td>
			</tr>	
      <tr>
        <th colspan="6"  class="encabezado">Glosario</th>
      </tr>
      <tr>
        <td colspan="4">
            <ul id="listLegend">
                <li><div class="exceed imgLegend">&nbsp;</div> <span class="bold">Excelente:</span> Excede lo requerido.</li>
                <li><div class="pass imgLegend">&nbsp;</div> <span class="bold">Suficiente:</span> Mantiene el estandar.</li>
                <li><div class="warn imgLegend">&nbsp;</div> <span class="bold">Cuidado:</span> Es una mala pr&aacute;ctica.</li>
                <li><div class="fail imgLegend">&nbsp;</div> <span class="bold">Falla:</span> No cumple con el estandar.</li>
            </ul>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <b>Debe tener en cuenta:</b> 
          <ul>
            <li>
              Las consideraciones son los items a tener en cuenta para aumentar puntos al seleccionar su clave.
            </li>
            <li>
              Deduce por es como su nombre lo indica deducciones o sanciones por malas pr&aacute;ctucas en la elecci&oacute;n de su clave;
            </li>  
            <li>
              Puntaje es el indicador del puntaje total obtenido, teniendo en cuenta las consideraciones y las deducciones.
            </li>          
            <li>
              La complejidad debe ser como m&iacute;nimo Fuerte para que el sistema permita accesar la aplicaci&oacute;n
            </li>
          </ul>
        </td>
      </tr>
		</table>
</body>
<?php include_once("footer.php") ?>