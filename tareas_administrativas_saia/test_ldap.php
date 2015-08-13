<?php

if($_POST['user']){
	$servidor=$_POST['servidor'];
	$dominio=$_POST['dominio'];
	if($dominio){
		$user=$_POST['user']."@".$dominio;
	}else{
		$user=$_POST['user'];
	}
	$pass=$_POST['clave'];
	$ds=ldap_connect($servidor);
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
	echo("<b>Servidor:</b>  ".$servidor."<br/>");
	echo("<b>Dominio:</b>  ".$dominio."<br/>");
	echo("<b>Usuario:</b>  ".$_POST['user']."<br/>");
	echo("<b>Clave:</b>  **********<br/>");
	echo("<b>Cadena de conexion:</b>  ".$servidor.",".$user.",********<br/><br/>");
	if(!$ds){
		echo("Error al conectarse al servidor ".$servidor);
	}
	$r_usuario=ldap_bind($ds,$user,$pass);
	if($r_usuario ){ 
	    echo("<label style='color:green'>Logueado!</label>");
	}
	else{
		$cadena=ldap_error($ds);
		if($cadena){
			echo("<label style='color:red'>El acceso al Directorio activo retorna el siguiente error ".$cadena."</label>");
		}
	}
}
?>
<form method="post" name="login_prueba" action="login_prueba.php">
	<table style="border-collapse:collapse;" border="0">
		<tr><td>Servidor: </td><td> <input type="text" name='servidor' value="appad.intracoomeva.com.co"/></td>
		</tr>
		<tr><td>Dominio: </td><td> <input type="text" name='dominio' value="coomeva.nal"/></td>
		</tr>
		<tr><td>Usuario: </td><td> <input type="text" name='user' /></td>
		</tr>
		<tr><td>Clave: </td><td><input type="password" name='clave'/></td>
		</tr>
		<tr><td><input type="submit" value='Enviar'/></td></tr>
	</table>
</form>
