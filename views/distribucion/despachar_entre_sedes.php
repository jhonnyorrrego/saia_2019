<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

?>
<div id='contenedorOpcionEntreSedes' data-ruta='<?= $ruta_db_superior ?>' class='mx-5 my-4 text-center'>
    <div class="row text-center">
        <div class='col-12 col-sm-12 col-md-6 mt-4'>
            <p>Sede</p>
            <select id='sede' style='width:200px'>
                <option>Seleccione</option>
            </select>
        </div>
        <div class='col-12 col-sm-12 col-md-6 mt-4'>
            <p>Mensajero</p>
            <select id='mensajerosSede' style='width:200px'>
                <option>Seleccione</option>
            </select>
        </div>
    </div>
    <script>
        $('#sede').select2();
        $('#mensajerosSede').select2();

        //* Carga las sedes en el select Sedes //////////////////////// 
        var rutaSuperior = $('#contenedorOpcionEntreSedes').data('ruta');
        $.ajax({
            url: `${rutaSuperior}app/distribucion/cargar_sedes.php`,
            type: 'POST',
            dataType: 'JSON',
            data: {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key')
            },
            success: function(respuesta) {
                var sedes = JSON.parse(respuesta.data);
                var count = 0;
                sedes.forEach(function() {
                    $('#sede').append(`<option>${sedes[count].nombre}</option>`);
                    count++;
                });
            }
        });

        //* Carga los mensajeros en el select mensajeros Sede//////////////////////// 
        $.ajax({
            url: `${rutaSuperior}app/distribucion/cargar_mensajeros.php`,
            type: 'POST',
            dataType: 'JSON',
            data: {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key')
            },
            success: function(respuesta) {
                var mensajerosSede = JSON.parse(respuesta.data);
                var count = 0;
                mensajerosSede.forEach(function() {
                    $('#mensajerosSede').append(`<option>${mensajerosSede[count]}</option>`);
                    count++;
                });
            }
        });
    </script>