<div class='mx-5 my-4 text-center'>
    <div class="row text-center">
        <div class='col-6'>
            <p>Sede</p>
            <select id='sede'>
                <option>Seleccione</option>
            </select>
        </div>
        <div class='col-6'>
            <p>Mensajero</p>
            <select id='mensajerosSede'>
                <option>Seleccione</option>
            </select>
        </div>
    </div>
    <script>
        $('#sede').select2();
        $('#mensajerosSede').select2();
    </script>