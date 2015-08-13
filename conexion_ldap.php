
<?php
include_once("db.php");
//se hace la conexion con el servidor ldap
$ds=ldap_connect("192.168.1.218");
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
$r=ldap_bind($ds,"administrador","P3r3ir4/*");
if(!$r){
	echo "Error"; 
  echo ldap_error();
}
else{
	echo "Acceso exitoso !";
}
//se busca si hay registros en el ldap con el campo samaccountname lleno
?> 