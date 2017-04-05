<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
if(is_file($ruta."db.php")){
  $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior . 'db.php');
$retorno["mensaje"]='';
$retorno["tipo_mensaje"]='error';
$retorno["exito"]=0;
if(!@$_REQUEST["perfil"]){
    $retorno["mensaje"]="Debe seleccionar un perfil";
    die(json_encode($retorno,JSON_FORCE_OBJECT));
}
if(!@$_REQUEST["modulo"]){
    $retorno["mensaje"]="Debe seleccionar un modulo";
    die(json_encode($retorno,JSON_FORCE_OBJECT));
}

if($_REQUEST["perfil"] && $_REQUEST["modulo"]){
    $existe=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
    if($existe["numcampos"]){
        $sql2="DELETE FROM permiso_perfil WHERE modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"];    
        phpmkr_query($sql2,$conn);
        $valida_existe=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
        if($valida_existe["numcampos"]){
            $retorno["mensaje"]="Error al eliminar el permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]."<br>".$sql2;
            $retorno["tipo_mensaje"]="error";
            $retorno["exito"]=0;
        }
        else{
            $retorno["mensaje"]="Permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]." eliminado correctamente";
            $retorno["tipo_mensaje"]="warning";
            $retorno["exito"]=1;
        }
    }
    else{
        $sql2="INSERT INTO permiso_perfil(modulo_idmodulo,perfil_idperfil,caracteristica_propio,caracteristica_grupo,caracteristica_total) VALUES (".$_REQUEST["modulo"].",".$_REQUEST["perfil"].",'lame','lame','lame')";
        phpmkr_query($sql2,$conn);
        $valida_existe=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
        if($valida_existe["numcampos"]){
            $retorno["mensaje"]="Permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]." adicionado correctamente";
            $retorno["tipo_mensaje"]="success";
            $retorno["exito"]=1;
        }
        else{
            $retorno["mensaje"]="Error al adicionar el permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]."<br>".$sql2;
            $retorno["tipo_mensaje"]="error";
            $retorno["exito"]=0;
        }
    }
    //$retorno["sql"]=$sql2;
    
}

echo(json_encode($retorno,JSON_FORCE_OBJECT));
?>
