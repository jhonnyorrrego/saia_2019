<?php
//se hace la conexion con el servidor ldap
include_once("fabricato/saia_produccion/db.php");
$ds=ldap_connect("172.16.1.21");
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
$r=ldap_bind($ds,"SAIA@FABRICATO","SAIA2004");
if(!$r){
	echo "Error"; 
  print_r(ldap_error());
}
else{
	echo "Acceso exitoso !";
}
$user="aabril";
$filter = "sAMAccountname=$user";
$campos = array("samaccountname","physicaldeliveryofficename", "sn","description","givenname", "mail","employeenumber");
$sr=ldap_search($ds, "DC=FABRICATO, DC=LOCAL", $filter,$campos);
$info = ldap_get_entries($ds, $sr);

$fun=busca_filtro_tabla("","funcionario","login='funcionario1'","",$conn);
print_r($fun);  
?> 
