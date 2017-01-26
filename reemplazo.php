<?php
/*
<Archivo>
<Nombre>reemplazo.php</Nombre> 
<Parametros>$_REQUEST["formato_adicionar"]:indica que se va a adicionar un registro, $_REQUEST["antiguo"]=idrol del funcionario antiguo, $_REQUEST["nuevo"]: idrol del funcionario nuevo, $_REQUEST["formato_revertir"]:muetra el listado de todos los reemplazos para desactivarlos, $_REQUEST["revertir"]:id de reemplazo a inactivar</Parametros>
<ruta>saia1.06/reemplazo.php</ruta>
<Responsabilidades>Administra los reemplazon de funcionarios en SAIA<Responsabilidades>
<Notas>Se basa en cambio de roles y delegacion de documentos</Notas>
<Salida>Formulario en pantalla para adicionar, inactivar y litar reemplazos</Salida>
</Archivo>
*/
include_once("db.php");
enviar_mensaje("","e-interno",array('fredysmf@gmail.com'),'$asunto','$mensaje',"","",""); 
?>
