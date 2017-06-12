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

if(@$_REQUEST['asignar_quitar_permiso_crear']){ //asigno o quito el permiso crear
    $accion=@$_REQUEST['accion'];
    $idfuncionario=$_REQUEST['idfuncionario'];
    $idmodulo=$_REQUEST['idmodulo'];       
    
    if($accion){
         $sqlc="INSERT INTO permiso (funcionario_idfuncionario,modulo_idmodulo,accion,tipo) VALUES(".$idfuncionario.",".$idmodulo.",'1','1')";
    }else{
        $sqlc="DELETE FROM permiso WHERE funcionario_idfuncionario=".$idfuncionario." AND modulo_idmodulo=".$idmodulo; 
    }
    phpmkr_query($sqlc,$conn);   
    if($accion){
        echo(1);
    }else{
        echo(0);
    }
    die();
}

if(@$_REQUEST['valida_permiso_crear_formato']){   //pantalla high slide para dar o quitar permiso crear (formatos)
    $idfuncionario=$_REQUEST['idfuncionario'];
    $idmodulo=$_REQUEST['idmodulo'];   
    
    $modulo=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"",$conn);
    $modulo_crear=busca_filtro_tabla("idmodulo","modulo","nombre='crear_".$modulo[0]['nombre']."'","",$conn);
    $existe_permiso_crear=busca_filtro_tabla("","permiso","modulo_idmodulo=".$modulo_crear[0]['idmodulo']." AND funcionario_idfuncionario=".$idfuncionario,"",$conn);
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
                        url: "'.$ruta_db_superior.'pantallas/permisos/validar_permiso_funcionario.php",
                        data: {
                            asignar_quitar_permiso_crear:1,
                            accion:$(this).val(),
                            idmodulo:'.$modulo_crear[0]['idmodulo'].',
                            idfuncionario:'.$idfuncionario.'
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


if(@$_REQUEST['valida_modulo_formato']){  //valida si el modulo es un formato
    $modulo_padre_formatos=busca_filtro_tabla("idmodulo","modulo","nombre='modulo_formatos'","",$conn);
    $modulo_formato=busca_filtro_tabla("cod_padre","modulo","idmodulo=".$_REQUEST["idmodulo"],"",$conn);    
    $echo=0;
    if($modulo_padre_formatos[0]['idmodulo']==$modulo_formato[0]['cod_padre']){ //es modulo de modulo_formatos
        $echo=1;
    }
    echo($echo);
    die();
}

if(@$_REQUEST['adicionar_quitar_permiso']){ //PARA ADICIONAR O QUITAR AMBOS PERMISOS
    $idfuncionario=$_REQUEST['idfuncionario'];
    $idmodulo=$_REQUEST['idmodulo'];
    
    $existe=busca_filtro_tabla("","permiso","funcionario_idfuncionario=".$idfuncionario." AND modulo_idmodulo=".$idmodulo,"",$conn);
    if($existe['numcampos']){ //eliminar
        $sql1="DELETE FROM permiso WHERE funcionario_idfuncionario=".$idfuncionario." AND modulo_idmodulo=".$idmodulo; 
        $accion=0;
    }else{ //adicionar
        $sql1="INSERT INTO permiso (funcionario_idfuncionario,modulo_idmodulo,accion,tipo) VALUES(".$idfuncionario.",".$idmodulo.",'1','1')";
        $accion=1;
    }
    phpmkr_query($sql1);
    
    
    //MODULO FORMATO CREAR
    $mensaje_crear_formato='';
    $modulo_padre_formatos=busca_filtro_tabla("idmodulo","modulo","nombre='modulo_formatos'","",$conn);
    $modulo_formato=busca_filtro_tabla("cod_padre,nombre","modulo","idmodulo=".$idmodulo,"",$conn);   
    if($modulo_padre_formatos[0]['idmodulo']==$modulo_formato[0]['cod_padre']){ //es modulo de modulo_formatos
        $modulo_crear_formato=busca_filtro_tabla("","modulo","nombre='crear_".$modulo_formato[0]['nombre']."'","",$conn); 
        $existe_permiso_crear=busca_filtro_tabla("idpermiso","permiso","modulo_idmodulo=".$modulo_crear_formato[0]['idmodulo']." AND funcionario_idfuncionario=".$idfuncionario,"",$conn);
        if($existe_permiso_crear['numcampos']){
            if(!$accion){
                $sql2="DELETE FROM permiso WHERE funcionario_idfuncionario=".$idfuncionario." AND modulo_idmodulo=".$modulo_crear_formato[0]['idmodulo']." AND idpermiso=".$existe_permiso_crear[0]['idpermiso']; 
                $mensaje_crear_formato="<br> Tambien se retira el permiso para crear el formato."; 
            }
        }else{
             if($accion){
                $sql2="INSERT INTO permiso (funcionario_idfuncionario,modulo_idmodulo,accion,tipo) VALUES(".$idfuncionario.",".$modulo_crear_formato[0]['idmodulo'].",'1','1')";
                $mensaje_crear_formato="<br> Tambien se adiciona el permiso para crear el formato."; 
            }           
        } 
        phpmkr_query($sql2); 
    }
    
    $retorno=array();
    $retorno['accion']=$accion;
    $retorno['mensaje_crear_formato']=$mensaje_crear_formato;
    echo(json_encode($retorno));
    die();
}
?>