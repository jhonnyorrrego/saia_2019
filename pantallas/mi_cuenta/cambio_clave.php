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

include_once($ruta_db_superior."librerias_saia.php");
//echo(librerias_jquery());
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
?>

<head>
<script type="text/javascript" src="pantallas/mi_cuenta/js/pwd_meter.js"></script>
<script>
$("#enviar_form").click(function(){
	var pass=$("#passwordOld").val();
	$.post('pantallas/mi_cuenta/buscar_clave.php',{clave:pass},function(respuesta){
		if(respuesta==1){
			$("#mensaje_actual").html('<span style="color:red">La contraseña que ha proporcionado no es válida.</span>');
			return false;
		}
		var nueva_con=$("#passwordPwd").val();
		var confi_con=$("#passwordTxt").val();
		
		if(nueva_con!=confi_con){
			$("#confirmacion_pass").html('<span style="color:red">Las contraseñas no coinciden.</span>');
			return false;
		}
		var bonus=$("#complexity").html();
		if(/Debil/.test(bonus)){
			$("#nueva_pass").html('<span style="color:red">La contraseña debe ser buena u optima.</span>');
			return false;
		}

		<?php encriptar_sqli("cambio_pass",0,"form_info",""); ?>		
		if(salida_sqli){
			$("#cambio_pass").submit();
		}
	});
	
});

$("#passwordOld").blur(function(){
	var pass=$("#passwordOld").val();
	$.post('pantallas/mi_cuenta/buscar_clave.php',{clave:pass},function(respuesta){
		if(respuesta==1){
			$("#mensaje_actual").html('<span style="color:red">La contraseña que ha proporcionado no es válida.</span>');
		}
		else{
			$("#mensaje_actual").html('');
		}
	});
});

$("#passwordTxt").blur(function(){
	var nueva_con=$("#passwordPwd").val();
	var confi_con=$("#passwordTxt").val();
	if(nueva_con!=confi_con){
		$("#confirmacion_pass").html('<span style="color:red">Las contraseñas no coinciden.</span>');
	}
	else{
		$("#confirmacion_pass").html('');
	}
});
$("#passwordPwd").blur(function(){
	var bonus=$("#complexity").html();
	
	if(/Debil/.test(bonus)){
		$("#nueva_pass").html('<span style="color:red">La contraseña debe ser buena u optima.</span>');
	}
	else{
		$("#nueva_pass").html('');
	}
});
</script>
<!--link rel="STYLESHEET" type="text/css" href="pantallas/mi_cuenta/css/password.css"-->
</head>
<div class="container">
<form class="form-vertical" method="post" action="pantallas/mi_cuenta/guardar_pass.php" id="cambio_pass">
            <div class="control-group">
                <label class="control-label" ><b>Contrase&ntilde;a actual</b></label>
              <div class="controls">
                  <input type="password" id="passwordOld" name="passwordPwd" autocomplete="off" placeholder="Contrase&ntilde;a Actual">
                  <div id="mensaje_actual"></div>
              </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="new_password"><b>Nueva Contrase&ntilde;a</b></label>
              <div class="controls">
                <input type="password" id="passwordPwd" name="passwordPwd" autocomplete="off" onkeyup="chkPass(this.value);" placeholder="Nueva Contrase&ntilde;a">
                <div id="nueva_pass"></div>
              </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="re_new_password"><b>Confirmar nueva Contrase&ntilde;a</b></label>
              <div class="controls">
                <input type="password" id="passwordTxt" name="passwordTxt" autocomplete="off" class="" placeholder="Confirmar nueva Contrase&ntilde;a">
                <div id="confirmacion_pass"></div>
              </div>
            </div>                               
            <div class="control-group">
                <label class="control-label" for="seguridad"><b>seguridad de la contrase&ntilde;a</b></label>
              <div class="controls">                              
                <div id="complexity" class="pull-left">Debil </div>
                <div id="scorebar" class="pull-left" style="background-position: 0px 50%; left:200px;">&nbsp;</div>
                <div id="score" style="display:none"></div>
                <br /><div id="nscore"></div>              
                <div class="exceed"></div>                           
                <div id="div_nAlphasOnly" style="display:none"></div>                
                <div id="nAlphaUC" style="display:none"></div>
                <div id="nAlphaLC" style="display:none"></div>
                <div id="nNumber" style="display:none"></div>
                <div id="nSymbol" style="display:none"></div>
                <div id="nMidChar" style="display:none"></div>
                <div id="nAlphasOnly" style="display:none"></div>
                <div id="nNumbersOnly" style="display:none"></div>
                <div id="nRepChar" style="display:none"></div>
                <div id="nConsecAlphaLC" style="display:none"></div>
                <div id="nSeqSymbol" style="display:none"></div>
                <div id="nSeqNumber" style="display:none"></div>
                <div id="nSeqAlpha" style="display:none"></div>
                <div id="nConsecNumber" style="display:none"></div>
                <div id="nConsecAlphaLC" style="display:none"></div>
                <div id="nRequirements" style="display:none"></div>
                <div id="nConsecAlphaUC" style="display:none"></div>
                <div id="nAlphaLCBonus" style="display:none"></div>
                <div id="nConsecNumberBonus" style="display:none"></div>
                <div id="div_nLength" style="display:none"></div>
                <div id="div_nAlphaUC" style="display:none"></div>
                <div id="div_nAlphaLC" style="display:none"></div>
                <div id="div_nNumber" style="display:none"></div>
                <div id="div_nSymbol" style="display:none"></div>
                <div id="div_nMidChar" style="display:none"></div>
                <div id="div_nRequirements" style="display:none"></div>
                <div id="div_nAlphasOnly" style="display:none"></div>
                <div id="div_nNumbersOnly" style="display:none"></div>
                <div id="div_nRepChar" style="display:none"></div>
                <div id="div_nConsecAlphaUC" style="display:none"></div>
                <div id="div_nConsecAlphaLC" style="display:none"></div>
                <div id="div_nConsecNumber" style="display:none"></div>
                <div id="div_nSeqAlpha" style="display:none"></div>
                <div id="div_nSeqNumber" style="display:none"></div>
                <div id="div_nSeqAlpha" style="display:none"></div>
                <div id="div_nSeqAlpha" style="display:none"></div>
                <div id="div_nSeqAlpha" style="display:none"></div>
                <div id="div_nSeqAlpha" style="display:none"></div>
                <div id="div_nSeqAlpha" style="display:none"></div>
                <div id="nLengthBonus" style="display:none"></div>
                <div id="nLength" style="display:none"></div>
                <div id="nLengthBonus" style="display:none"></div>
                <div id="nAlphaUCBonus" style="display:none"></div>
                <div id="nSymbolBonus" style="display:none"></div>
                <div id="nNumberBonus" style="display:none"></div>
                <div id="nMidCharBonus" style="display:none"></div>
                <div id="nRequirementsBonus" style="display:none"></div>
                <div id="nAlphasOnlyBonus" style="display:none"></div>
                <div id="nNumbersOnlyBonus" style="display:none"></div>
                <div id="nRepCharBonus" style="display:none"></div>
                <div id="nConsecAlphaUCBonus" style="display:none"></div>
                <div id="nSeqSymbolBonus" style="display:none"></div>
                <div id="nSeqNumberBonus" style="display:none"></div>
                <div id="nSeqAlphaBonus" style="display:none"></div>
                <div id="nConsecAlphaLCBonus" style="display:none"></div>  
              </div>
            </div> 
            <div class="control-group">
                <button type="button" class="btn btn-mini btn-primary" id="enviar_form">Cambiar contrase&ntilde;a</button>
                <button type="button" class="btn btn-mini " id="cancelar_form">Cancelar</button>
            </div>           
</form>
<div>
 <ul>
    <li>Usa cuatro caracteres como m&iacute;nimo.
    </li>
    <li>Elige una contrase&ntilde;a que no hayas utilizado.
    </li>
    <li>Combina letras, n&uacute;meros y s&iacute;mbolos para que tu contrase&ntilde;a sea m&aacute;s segura.
    </li>
 </ul>
</div>
</div>    

