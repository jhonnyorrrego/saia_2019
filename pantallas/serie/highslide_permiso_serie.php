
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
include_once ($ruta_db_superior . 'db.php');
include_once ($ruta_db_superior . 'librerias_saia.php');
?>
<html>
<head>
<?php
	echo(estilo_bootstrap());
	echo(librerias_jquery('1.7'));
	$checked1="";	
	$checked0="";
	if(isset($_REQUEST["serie"]) && isset($_REQUEST['tipo_entidad']) && isset($_REQUEST['entidad'])){
		
		$serie =$_REQUEST["serie"];
		$entidad_identidad=$_REQUEST['tipo_entidad'];
		$entidad=$_REQUEST['entidad'];
		$buscar_permisos = busca_filtro_tabla("", "permiso_serie", "estado=1 and serie_idserie=".$serie." and entidad_identidad=".$entidad_identidad." and llave_entidad=".$entidad." and permiso like '%a,v'", "", $conn);
		
		if($buscar_permisos["numcampos"]){//ya tiene permisos
			$checked1 = 'checked="checked"';		
		}
		else {
			$checked0 = 'checked="checked"';
		}
	}	
?>
</head>	
<body>
	<form>
        <div class="container">
            <legend>Tiene permiso para editar</legend>
            <br>
            Si &nbsp; <input type="radio" value="1" name="permiso_editar" <?php echo $checked1; ?>> &nbsp;&nbsp;
            No &nbsp; <input type="radio" value="2" name="permiso_editar" <?php echo $checked0; ?>
        </div>
	</form>
</body>
</html>
 <script>
    $(document).ready(function(){
    	var ruta_db_superior = "<?php echo $ruta_db_superior; ?>";
        $("[name=\'permiso_editar\']").click(function(){
            $.ajax({
                type:"POST",
                dataType: "html",
                url: ruta_db_superior+"pantallas/serie/validar_permisos_entidad.php",
                data: {
                    asignar_quitar_permiso_editar:2,
                    accion:2,
                    permiso:$(this).val(),
                    serie:"<?php echo $serie; ?>",
                    tipo_entidad:"<?php echo $entidad_identidad; ?>",
                    id:"<?php echo $entidad; ?>",
                    
                },
                success: function(exito){
                    var mensaje="retirado";
                    if(exito==1){
                        mensaje="adicionado";
                    }
                    top.noty({text: "<b>ATENCI&Oacute;N</b><br>Permiso "+mensaje+" con exito!",type: "success",layout: "topCenter",timeout:2500});
                    parent.hs.close();
                }
            });                     
        });
    });
</script>