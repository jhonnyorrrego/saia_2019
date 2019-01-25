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
$consulta = array(
    "campoid" => "idfuncionario",
    "campotexto" => ["nombres", "apellidos"],
    "tablas" => ["funcionario"],
    "condicion" => "1=1",
    "orden" => "nombres, apellidos"
);

$consulta64 = base64_encode(json_encode($consulta));

?>
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
var consulta64 = "<?=$consulta64?>";
$('#funcionario').selectize({
    valueField: 'value',
    labelField: 'text',
    searchField: 'text',
	persist: false,
	createOnBlur: true,
	create: false,
	maxItems: 1,
	load: function(query, callback) {
        if (!query.length) return callback();
        $.ajax({
            url: "<?=$ruta_db_superior ?>autocompletar.php",
            type: 'POST',
            dataType: 'json',
            data: {
            	consulta: consulta64,
            	valor: query
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