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

if(@$_REQUEST['asignar_quitar_permiso_crear'] && @$_REQUEST['idmodulo'] && @$_REQUEST['idperfil']){ //asigno o quito el permiso crear
    $accion=@$_REQUEST['accion'];
    
    if($accion){
        $sqlc="INSERT INTO permiso_perfil(modulo_idmodulo,perfil_idperfil,caracteristica_propio,caracteristica_grupo,caracteristica_total) VALUES (".$_REQUEST['idmodulo'].",".$_REQUEST["idperfil"].",'lame','lame','lame')";
    }else{
        $sqlc="DELETE FROM permiso_perfil WHERE modulo_idmodulo=".$_REQUEST['idmodulo']." AND perfil_idperfil=".$_REQUEST["idperfil"];    
    }
    phpmkr_query($sqlc,$conn);   
    if($accion){
        echo(1);
    }else{
        echo(0);
    }
    die();
}



if(@$_REQUEST['valida_permiso_crear_formato'] && @$_REQUEST['idmodulo'] && @$_REQUEST['idperfil']){   //pantalla high slide para dar o quoitar permiso crear (formatos)
   
    $modulo=busca_filtro_tabla("","modulo","idmodulo=".$_REQUEST['idmodulo'],"",$conn);
    $modulo_crear=busca_filtro_tabla("idmodulo","modulo","nombre='crear_".$modulo[0]['nombre']."'","",$conn);
    $existe_permiso_crear=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$modulo_crear[0]['idmodulo']." AND perfil_idperfil=".$_REQUEST["idperfil"],"",$conn);
    $checked0='checked';
    $checked1='';
    if($existe_permiso_crear['numcampos']){
        $checked0='';
        $checked1='checked';
    }
    include_once($ruta_db_superior . 'librerias_saia.php');
    echo(estilo_bootstrap());
    echo(librerias_jquery('1.7'));
    $html='
        <div class="container">
            <legend>Permiso para crear '.codifica_encabezado(html_entity_decode($modulo[0]['etiqueta'])).'</legend>
            <br>
            Si &nbsp; <input type="radio" value="1" '.$checked1.' name="asignar_permiso_crear"> &nbsp;&nbsp;
            No &nbsp; <input type="radio" value="0" '.$checked0.' name="asignar_permiso_crear">
        </div>
        <script>
            $(document).ready(function(){
                $("[name=\'asignar_permiso_crear\']").click(function(){
                    $.ajax({
                        type:"POST",
                        dataType: "html",
                        url: "'.$ruta_db_superior.'pantallas/permisos/validar_permiso_perfil.php",
                        data: {
                            asignar_quitar_permiso_crear:1,
                            accion:$(this).val(),
                            idmodulo:'.$modulo_crear[0]['idmodulo'].',
                            idperfil:'.$_REQUEST['idperfil'].'
                        },
                        success: function(exito){
                            var mensaje="retirado";
                            if(exito==1){
                                mensaje="adicionado";
                            }
                            top.noty({text: "<b>ATENCI&Oacute;N</b><br>Permiso "+mensaje+" con exito!",type: "success",layout: "topCenter",timeout:2500});
                            parent.hs.close();
                        }
                    });                     
                });
            });
        </script>
    ';
    echo($html);
    die();
}

if(@$_REQUEST['valida_modulo_formato'] && @$_REQUEST['idmodulo']){  //valida si el modulo es un formato
    $modulo_padre_formatos=busca_filtro_tabla("idmodulo","modulo","nombre='modulo_formatos'","",$conn);
    $modulo_formato=busca_filtro_tabla("cod_padre","modulo","idmodulo=".$_REQUEST["idmodulo"],"",$conn);    
    $echo=0;
    if($modulo_padre_formatos[0]['idmodulo']==$modulo_formato[0]['cod_padre']){ //es modulo de modulo_formatos
        $echo=1;
    }
    echo($echo);
    die();
}

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
    $modulo_padre_formatos=busca_filtro_tabla("idmodulo","modulo","nombre='modulo_formatos'","",$conn);
    $modulo_formato=busca_filtro_tabla("cod_padre,nombre","modulo","idmodulo=".$_REQUEST["modulo"],"",$conn);
    
    $existe=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
    if($existe["numcampos"]){
        $mensaje_permiso_crear='';
        if($modulo_padre_formatos[0]['idmodulo']==$modulo_formato[0]['cod_padre']){ //es modulo de modulo_formatos
            $modulo_crear_formato=busca_filtro_tabla("","modulo","nombre='crear_".$modulo_formato[0]['nombre']."'","",$conn); 
            $existe_permiso_crear=busca_filtro_tabla("idpermiso_perfil","permiso_perfil","modulo_idmodulo=".$modulo_crear_formato[0]['idmodulo']." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
            if($existe_permiso_crear['numcampos']){
                $sqlc="DELETE FROM permiso_perfil WHERE modulo_idmodulo=".$modulo_crear_formato[0]['idmodulo']." AND perfil_idperfil=".$_REQUEST["perfil"];    
                phpmkr_query($sqlc,$conn); 
                $mensaje_permiso_crear="<br> Tambien se elimina el permiso para crear el formato.";                  
            }
        }
        
        $sql2="DELETE FROM permiso_perfil WHERE modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"];    
        phpmkr_query($sql2,$conn);
        $valida_existe=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
        if($valida_existe["numcampos"]){
            $retorno["mensaje"]="Error al eliminar el permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]."<br>".$sql2;
            $retorno["tipo_mensaje"]="error";
            $retorno["exito"]=0;
        }
        else{
            $retorno["mensaje"]="Permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]." eliminado correctamente".$mensaje_permiso_crear;
            $retorno["tipo_mensaje"]="warning";
            $retorno["exito"]=1;
        }
    }
    else{
        $mensaje_permiso_crear='';
        if($modulo_padre_formatos[0]['idmodulo']==$modulo_formato[0]['cod_padre']){ //es modulo de modulo_formatos
            $modulo_crear_formato=busca_filtro_tabla("","modulo","nombre='crear_".$modulo_formato[0]['nombre']."'","",$conn); 
            $sqlc="INSERT INTO permiso_perfil(modulo_idmodulo,perfil_idperfil,caracteristica_propio,caracteristica_grupo,caracteristica_total) VALUES (".$modulo_crear_formato[0]['idmodulo'].",".$_REQUEST["perfil"].",'lame','lame','lame')";
            phpmkr_query($sqlc,$conn); 
            $mensaje_permiso_crear="<br> Tambien se adiciona el permiso para crear el formato.";
        }
        
        $sql2="INSERT INTO permiso_perfil(modulo_idmodulo,perfil_idperfil,caracteristica_propio,caracteristica_grupo,caracteristica_total) VALUES (".$_REQUEST["modulo"].",".$_REQUEST["perfil"].",'lame','lame','lame')";
        phpmkr_query($sql2,$conn);
        $valida_existe=busca_filtro_tabla("","permiso_perfil","modulo_idmodulo=".$_REQUEST["modulo"]." AND perfil_idperfil=".$_REQUEST["perfil"],"",$conn);
        if($valida_existe["numcampos"]){
            $retorno["mensaje"]="Permiso ".@$_REQUEST["nombre_modulo"]." para el perfil ".@$_REQUEST["nombre_modulo"]." adicionado correctamente".$mensaje_permiso_crear;
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
