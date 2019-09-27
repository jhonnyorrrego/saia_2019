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
<div id='contenedorEntreSedes' data-ruta='<?= $ruta_db_superior ?>' data-registros='<?= $_REQUEST['registros'] ?>' class='mx-5 my-4 text-center'>
    <div class="row text-center">
        <div class='col-12 col-sm-12 col-md-6 mt-4'>
            <p>Sede</p>
            <select id='sede' style='width:200px'>
                <option value='0'>Seleccione</option>
            </select>
        </div>
        <div class='col-12 col-sm-12 col-md-6 mt-4'>
            <p>Mensajero</p>
            <select id='mensajerosSede' style='width:200px'>
                <option value='0'>Seleccione</option>
            </select>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#sede').select2();
            $('#mensajerosSede').select2();

            //* Carga las sedes en el select Sedes //////////////////////// 
            var rutaSuperior = $('#contenedorEntreSedes').data('ruta');
            var registros = $('#contenedorEntreSedes').data('registros');
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
                        $('#sede').append(`<option value="${sedes[count].id}" >${sedes[count].nombre}</option>`);
                        count++;
                    });
                }
            }); // Fin  carga de las sedes

            //* este Ajax Carga los mensajeros en el select mensajeros Sede//////////////////////// 
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
                        $('#mensajerosSede').append(`<option value="${mensajerosSede[count].id}">${mensajerosSede[count].nombre}</option>`);
                        count++;
                    });
                }
            }); // Fin carga de los mensajeros

            //* Evento del boton guardar de la ventana modal.

            $(document).off('click', '#btn_success').on('click', '#btn_success', function() {

                if (($('#sede').val() != '0') && ($('#mensajerosSede').val() != '0')) {
                    $.ajax({
                        url: `${rutaSuperior}app/distribucion/guardar_entre_sedes.php`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            token: localStorage.getItem('token'),
                            key: localStorage.getItem('key'),
                            registros: registros,
                            sede: $('#sede').val(),
                            mensajero: $('#mensajerosSede').val()
                        },
                        success: function(respuesta) {
                            successModalEvent();
                        }
                    });
                } // Fin validación campos
                else {
                    top.notification({
                        message: "No se ha seleccionado la sede o mensajero",
                        type: "error",
                        duration: "3500"
                    });
                }
            }); // Fin evento click de guardad entre sedes

        }); // Fin ready
    </script>