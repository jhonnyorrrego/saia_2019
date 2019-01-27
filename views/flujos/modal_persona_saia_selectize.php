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

?>

<?= jquery() ?>

<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>css/selectize.css" />
<script type="text/javascript" src="<?php echo $ruta_db_superior;?>js/selectize.js"></script>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label class="my-0" for="funcionario">Funcionario</label>
            <select class="form-control" id="funcionario" multiple="multiple"></select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="funcionario_list"></div>
</div>
<script>

$('#funcionario').selectize({
    valueField: 'idfuncionario',
    labelField: 'nombres',
    searchField: 'nombres',
	persist: false,
	createOnBlur: true,
	create: false,
	maxItems: 1,
    render:       {
	    item: function(data) {
	        console.log(data);
	        let etiqueta = data.nombres + " " + data.apellidos;
	        //data['text'] = etiqueta;
	        let datos = ["<div data-value='", data.idfuncionario, "' data-email='", data.email,
	            "' data-type='", data.type, "' class='item'>", etiqueta, " </div>"];
	    	return datos.join();
	    }
    },
	
	load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: "buscar_funcionario.php",
            type: 'POST',
            dataType: 'json',
            data: {
            	termino: query
            },
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    },
    onItemAdd: function(valor, item) {
        console.log(valor, item);
    },
});
</script>