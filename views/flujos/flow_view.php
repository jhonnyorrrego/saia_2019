<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

echo bpmnViewer();
?>
<div id="visor_pbmn">

</div>
<script>
var viewer = new BpmnJS({ container: '#visor_pbmn' });

viewer.importXML(bpmnXML, function(err) {

    if (err) {
        console.log('error rendering', err);
    } else {
        console.log('we are good!');
    }
});
</script>