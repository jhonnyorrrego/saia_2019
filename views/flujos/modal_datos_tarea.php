<?php
$idtarea = null;
if(isset($_REQUEST["idtarea"])) {
    $idtarea = $_REQUEST["idtarea"];

?>
<form>
	<div class="form-group">
		<label for="info_flujo">Nombre</label>
		<input type="text" class="form-control" id="task_name" name="nombre" value="<?= $idtarea?>"></input>
	</div>
</form>
<?php
}
?>
