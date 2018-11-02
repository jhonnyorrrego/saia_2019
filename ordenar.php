<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";

global $conn;

$iddocumento = $_REQUEST["key"];
$documento = busca_filtro_tabla("*", "documento a,formato b", "lower(a.plantilla) = lower(b.nombre) and a.iddocumento=" . $iddocumento, "", $conn);

if (!$_REQUEST["mostrar_formato"] || !$documento[0]["plantilla"]) {
    $valores = array();
    foreach ($_REQUEST as $nombre => $valor) {
        $valores[] = $nombre . "=" . $valor;
    }
    redirecciona("ordenar_paginas.php?" . implode("&", $valores));
}

if ($documento['numcampos']) {
    $llave = "idformato=" . $documento[0]["idformato"] . "&iddoc=" . $iddocumento;
    $_SESSION["iddoc"] = $iddocumento;

    leido(usuario_actual("funcionario_codigo"), $iddocumento);
} else {
    alerta("No se ha podido encontrar el Documento");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= librerias_arboles() ?>
    <?= librerias_principal() ?>
    <?= librerias_highslide() ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-none d-md-block col-md-3 px-0 mx-0" id="izquierdo_saia"></div>
            <div class="col-12 col-md-9 px-0 mx-0" id="contenedor_saia"></div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var documento = '<?= $documento["numcampos"] ?>';            
            
            function llamado_pantalla(ruta,datos,destino,nombre){
                if(datos){
                    ruta += "?" + datos;
                }

                if(nombre === "<?= $_REQUEST['destino_click'] ?>"){
                    ruta = ruta + '&click_clase=<?= $_REQUEST['click_clase'] ?>';
                }
                
                destino.html('<iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0" scrolling="no" onload="js:$(\'#'+nombre+'\').height($(document).height()-6)"></iframe>');
            }
            
            if(documento){
                var click_mostrar = '<?= $_REQUEST['click_mostrar'] ?>';
                var param = 'form_info=<?= $llave ?>';
                
                if(click_mostrar) {
                    param += '&click_mostrar=1';
                }else{
                    llamado_pantalla("","",$("#contenedor_saia"),'detalles');
                }
                
                llamado_pantalla("<?= $ruta_db_superior ?>pantallas/documento/informacion_resumen_documento.php",param,$("#izquierdo_saia"),"arbol_formato");
            }else{
                $("#izquierdo_saia").html('<?= $documento[0]["descripcion"] ?>');
                llamado_pantalla("<?= $ruta_db_superior ?>pantallas/documento/listado_paginas.php","iddoc=<?= $iddocumento ?>",$("#contenedor_saia"));
            }
        });
    </script>
</body>
</html>