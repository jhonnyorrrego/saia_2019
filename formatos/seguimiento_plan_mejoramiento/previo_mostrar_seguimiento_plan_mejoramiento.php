<?php




$idformato_seguimiento_plan_mejoramiento=busca_filtro_tabla("idformato","formato","nombre='seguimiento_plan_mejoramiento'","",$conn);

?>

<?php include_once('../librerias/estilo_formulario.php'); include_once('../librerias/funciones_formatos_generales.php');?><?php listado_hijos_formato($idformato_seguimiento_plan_mejoramiento[0]['idformato'],$_REQUEST["iddoc"]); ?>