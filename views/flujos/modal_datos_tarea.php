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

$idflujo = null;
if(isset($_REQUEST["idflujo"])) {
    $idflujo = $_REQUEST["idflujo"];
}

$idtarea = null;
if(isset($_REQUEST["idtarea"])) {
    $idtarea = $_REQUEST["idtarea"];
    $nombreTarea = $_REQUEST["nombreTarea"];
?>

    <!-- handlebars -->
    <script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/handlebars.js"></script>

    <!-- alpaca -->
    <link type="text/css" href="<?=$ruta_db_superior?>assets/theme/assets/js/alpaca.min.css" rel="stylesheet" />
    <script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/alpaca.min.js"></script>


<!-- <form>
	<div class="form-group">
		<label for="task_id">Id</label>
		<input type="text" class="form-control" id="task_id" name="idtarea" value="<?= $idtarea?>"></input>
	</div>
	<div class="form-group">
		<label for="task_name">Nombre</label>
		<input type="text" class="form-control" id="task_name" name="nombre" value="<?= $nombreTarea?>"></input>
	</div>


</form> -->


<div id="form1"></div>
<script type="text/javascript">
$("#form1").alpaca({
    "schema": {
        "title": "What do you think of Alpaca?",
        "type": "object",
        "properties": {
            "name": {
                "type": "string",
                "title": "Name"
            },
            "ranking": {
                "type": "string",
                "title": "Ranking",
                "enum": ['excellent', 'not too shabby', 'alpaca built my hotrod']
            }
        }
    }
});
</script>

<?php
}
?>
