<?php
include_once("../../db.php");
$campos=explode(",",$_REQUEST["campos"]);
for($i=0;$i<count($campos);$i++)
{
$consulta=busca_filtro_tabla("","autoguardado","usuario='".usuario_actual("funcionario_codigo")."' and formato='".$_REQUEST["formato"]."' and campo='".$campos[$i]."'","",$conn);

if(!$consulta["numcampos"])
{$sql1="insert into autoguardado(usuario,formato,contenido,campo) values('".usuario_actual("funcionario_codigo")."','".$_REQUEST["formato"]."','".$_REQUEST[$campos[$i]]."','".$campos[$i]."')";
}
else
{$sql1="update autoguardado set contenido='".$_REQUEST[$campos[$i]]."' where idautoguardado='".$consulta[0]["idautoguardado"]."'";
}

phpmkr_query($sql1,$conn);
}

?>
