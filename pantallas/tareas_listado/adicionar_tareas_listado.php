<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");


  include_once($ruta_db_superior."pantallas/listado_tareas/librerias.php");
  echo(estilo_bootstrap());
  echo(estilo_file_upload());
  echo(librerias_jquery("1.7"));
  echo(librerias_arboles());
  echo(librerias_bootstrap());
  echo(librerias_datepicker_bootstrap());
  echo(librerias_notificaciones());

if(@$_REQUEST['guardar']==1){
	
	$fieldList=array();
	$fieldList["evaluador"] = $_REQUEST['evaluador'];	
	$fieldList["cod_padre"] = $_REQUEST['cod_padre'];
	$fieldList["listado_tareas_fk"] = $_REQUEST['listado_tareas_fk'];
	$fieldList["estado_tarea"] = $_REQUEST['estado_tarea'];
	$fieldList["fecha_creacion"] = $_REQUEST['fecha_creacion'];
	$fieldList["nombre_tarea"] = $_REQUEST['nombre_tarea'];
	$fieldList["tipo_tarea"] = $_REQUEST['tipo_tarea'];
	$fieldList["responsable_tarea"] = $_REQUEST['responsable_tarea'];
	$fieldList["co_participantes"] = implode(",",array_unique(explode(",",$_REQUEST['co_participantes'])));
	$fieldList["seguidores"] = implode(",",array_unique(explode(",",$_REQUEST['seguidores'])));
	$fieldList["descripcion_tarea"] = $_REQUEST['descripcion_tarea'];
	$fieldList["fecha_inicio"] = $_REQUEST['fecha_inicio'];
	$fieldList["fecha_limite"] = $_REQUEST['fecha_limite'];
	$fieldList["prioridad"] = $_REQUEST['prioridad'];
	$fieldList["tiempo_estimado"] = $_REQUEST['tiempo_estimado'];
	$fieldList["enviar_email"] = $_REQUEST['enviar_email'];
	$fieldList["creador_tarea"] = usuario_actual("idfuncionario");
	$fieldList["generica"] = @$_REQUEST['generica'];
	$fieldList["from_generica"] = @$_REQUEST['from_generica'];
	$fieldList["info_recurrencia"] = @$_REQUEST["info_recurrencia"];
	
	
	$strsql = "INSERT INTO tareas_listado (";
	$strsql .= implode(",", array_keys($fieldList));			
	$strsql .= ") VALUES ('";			
	$strsql .= implode("','", array_values($fieldList));			
	$strsql .= "')";
	$sql_insert=$strsql;
	phpmkr_query($sql_insert);
	$id=phpmkr_insert_id();
  if(@$_REQUEST["info_recurrencia"]!=''){
    $datos=json_decode($_REQUEST["info_recurrencia"],true);
    print_r($datos);
    $recurrencia=array("fk_tareas_listado"=>$id);
    foreach ($datos as $key => $value) {
      if(@isset($recurrencia[$value["name"]])){
        $recurrencia[$value["name"]].=",".$value["value"];
      }
      else{
        if($value["value"]!==''){
          $recurrencia[$value["name"]]=$value["value"];
        }
      }  
    }
    if($recurrencia["finaliza_el_fecha"]!=''){
      $recurrencia["finaliza_el_fecha"]=fecha_db_almacenar($recurrencia["finaliza_el_fecha"],"Y-m-d");
    }
    $recurrencia["ejecuta_proxima"]=fecha_db_almacenar($recurrencia["ejecuta_proxima"],"Y-m-d");
    $recurrencia["empieza_el"]=fecha_db_almacenar($recurrencia["empieza_el"],"Y-m-d");
    $excluidos=array("finaliza_el_fecha","ejecuta_proxima","empieza_el");
    foreach ($recurrencia as $key => $value) {
      if(!in_array($key, $excluidos)){
        $recurrencia[$key]="'".$value."'";
      }
    }
    $sql_insert_recur="INSERT INTO tareas_listado_recur(".implode(", ", array_keys($recurrencia)).") VALUES(".implode(", ", array_values($recurrencia)).")";
    phpmkr_query($sql_insert_recur);
  }
	if($_REQUEST['responsable_tarea']!="" && $id && $_REQUEST["enviar_email"]==0){
		$parte_msn="";
		$responsable=busca_filtro_tabla("funcionario_codigo,nombres,apellidos","funcionario f","idfuncionario=".$_REQUEST['responsable_tarea'],"",$conn);
		if($responsable["numcampos"]){
			$fun_codes=array();
			
			if($_REQUEST["co_participantes"]!=""){
				$co_participantes=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre,funcionario_codigo","funcionario","idfuncionario in (".str_replace("#", "", $_REQUEST["co_participantes"]).")","",$conn);
				if($co_participantes["numcampos"]){
					$participantes=extrae_campo($co_participantes,"nombre");
					$participantes=array_map('strtolower', $participantes);
					$participantes=array_map('ucwords', $participantes);
					$parte_msn.="Co-Participantes:".html_entity_decode(implode(",", $participantes))."<br/>";
					
					$fun_codes_coparticipantes=extrae_campo($co_participantes,"funcionario_codigo");
					$fun_codes=array_merge($fun_codes,$fun_codes_coparticipantes);
				}
			}
			if($_REQUEST["seguidores"]!=""){
				$seguidores=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre,funcionario_codigo","funcionario","idfuncionario in (".str_replace("#", "", $_REQUEST["seguidores"]).")","",$conn);
				if($seguidores["numcampos"]){
					$seguid=extrae_campo($seguidores,"nombre");
					$seguid=array_map('strtolower', $seguid);
					$seguid=array_map('ucwords', $seguid);					
					$parte_msn.="Seguidores:".html_entity_decode(implode(",", $seguid))."<br/>";
					
					$fun_codes_seguidores=extrae_campo($seguidores,"funcionario_codigo");
					$fun_codes=array_merge($fun_codes,$fun_codes_seguidores);					
				}
			}
			if(@$_REQUEST["evaluador"]!=""){
				$evaluador=busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre,funcionario_codigo","funcionario","idfuncionario=".$_REQUEST["evaluador"],"",$conn);
				if($evaluador["numcampos"]){
					$seguid=extrae_campo($evaluador,"nombre");
					$seguid=array_map('strtolower', $seguid);
					$seguid=array_map('ucwords', $seguid);							
					$parte_msn.="Evaluador:".html_entity_decode(implode(",", $seguid))."<br/>";
					
					$fun_codes[]=$evaluador[0]['funcionario_codigo'];
					
				}
			}	
			
			$parametro="?".base64_encode("idtareas_listado_unico=".$id); 
			$ruta=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/index.php";
			$link="<a href='".$ruta.$parametro."' target='_blank'>Ver Tarea</a>";	
			
			$descripcion_tarea=htmlentities($_REQUEST["descripcion_tarea"], ENT_QUOTES, "UTF-8");
			
			$mensaje="Saludos,<br/><br/>Usted esta vinculado a una nueva tarea<br/><br/>
			Nombre de la Tarea: <strong>".html_entity_decode($_REQUEST["nombre_tarea"])."</strong><br/>
			Descripcion: ".html_entity_decode($descripcion_tarea)."<br/>
			Fecha Inicio: ".$_REQUEST["fecha_inicio"]."<br/>
			Fecha Limite: ".$_REQUEST["fecha_limite"]."<br/><br/>
			Responsables: ".html_entity_decode($responsable[0]["nombres"]." ".$responsable[0]["apellidos"])."<br/>".$parte_msn."<br/><br/>".$link;
			$fun_codes[]=$responsable[0]["funcionario_codigo"];
			enviar_mensaje("","codigo",$fun_codes,"Nueva Tarea Asignada",$mensaje);
		}
	}

	if(isset($_SESSION['idanexo_tareas'])){
		$ids_actualizar=explode(',',$_SESSION['idanexo_tareas']);
		for($i=0;$i<count($ids_actualizar);$i++){
			$anexo_temporal=busca_filtro_tabla('','tareas_listado_anexos','idtareas_listado_anexos='.$ids_actualizar[$i],'',$conn);			
			$nombre_anexo=basename($ruta_db_superior.$anexo_temporal[0]['ruta']);			
			$ruta = RUTA_ANEXOS_TAREAS.@$_REQUEST["listado_tareas_fk"].'/'.$id.'/';
			crear_destino($ruta_db_superior.$ruta);
			copy($ruta_db_superior.$anexo_temporal[0]['ruta'], $ruta_db_superior.$ruta.$nombre_anexo);
			chmod($ruta_db_superior.$ruta,0777);
			chmod($ruta_db_superior.$ruta.$nombre_anexo,0777);
			unlink($ruta_db_superior.$anexo_temporal[0]['ruta']);
			$sql2 = " UPDATE tareas_listado_anexos SET ruta='".$ruta.$nombre_anexo."',fk_tareas_listado='".$id."' WHERE 	idtareas_listado_anexos=".$ids_actualizar[$i];
			phpmkr_query($sql2);				
		}
		unset($_SESSION['idanexo_tareas']);
	}
	

	if($_REQUEST['cod_padre']!=0){ //subtarea
	
		$tarea_padre=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST['cod_padre'],"",$conn);
		
		$vector_coparticipantes=explode(',',$tarea_padre[0]['co_participantes']);
		$vector_seguidores=explode(',',$tarea_padre[0]['seguidores']);
		
		$update=true;
		if(in_array($_REQUEST['responsable_tarea'], $vector_coparticipantes) || in_array($_REQUEST['responsable_tarea'], $vector_seguidores) || $tarea_padre[0]['responsable_tarea']==$_REQUEST['responsable_tarea'] || $tarea_padre[0]['evaluador']==$_REQUEST['responsable_tarea']){
			$update=false;
		}
		if($update){
			$vector_seguidores[]=$_REQUEST['responsable_tarea'];
			$cadena_seguidores=implode(',',$vector_seguidores);
			$sql3=" UPDATE tareas_listado SET seguidores='".$cadena_seguidores."' WHERE idtareas_listado=".$_REQUEST['cod_padre'];
			phpmkr_query($sql3);	
		}
	
		?>
		<script>
			parent.$('#cantidad_subtareas_'+<?php echo($_REQUEST['cod_padre']); ?>).html( parseInt(parent.$('#cantidad_subtareas_'+<?php echo($_REQUEST['cod_padre']); ?>).html())+1 );
			parent.parent.parent.$('#actualizar_info_index').click();
			notificacion_saia('Subtarea Ingresada Satisfactoriamente','success','',4000);
			parent.eliminar_panel_kaiten(0);
			
			
		</script>
		<?php
		//redirecciona($ruta_db_superior.'pantallas/busquedas/consulta_busqueda_subtareas_listado2.php?idbusqueda_componente=221&idtareas_listado='.$_REQUEST['cod_padre']);
	}else if(@$_REQUEST['from_tareas']){ //tarea adicionada desde tareas_listado
			?>
			<script>
				notificacion_saia('Tarea Ingresada Satisfactoriamente','success','',4000);
				parent.parent.parent.$('#actualizar_info_index').click();
			    parent.eliminar_panel_kaiten(0);				
				
			</script>
			<?php
			//redirecciona($ruta_db_superior.'pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idtareas_listado='.$id);
	}else if(@$_REQUEST['from_listado_tareas']){  //tarea_adicionada desde listado_tareas 
			?>
			<script>
				notificacion_saia('Tarea Ingresada Satisfactoriamente','success','',4000);
				parent.parent.parent.$('#actualizar_info_index').click();
				parent.$('#contador_tareas_<?php echo($_REQUEST['listado_tareas_fk']); ?>').html( parseInt(parent.$('#contador_tareas_<?php echo($_REQUEST['listado_tareas_fk']); ?>').html()) +1 );
			</script>	
			<?php
			    $componente_tareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='tareas_listado_reporte' ","",$conn);
				redirecciona($ruta_db_superior."pantallas/busquedas/consulta_busqueda_subtareas_listado2.php?idbusqueda_componente=".$componente_tareas[0]['idbusqueda_componente']."&ocultar_subtareas=1&idlistado_tareas=".$_REQUEST['listado_tareas_fk']);
	}
	
	
}else{

 	unset($_SESSION['idanexo_tareas']);
	
 
 	/*SUBTAREAS*/ 
  	$titulo_pantalla="Tareas";
	$titulo_input="tarea";
	$cod_padre=0;
	if(@$_REQUEST['cod_padre']){
		$titulo_pantalla="Subtareas";
		$titulo_input="subtarea";
		$cod_padre=$_REQUEST['cod_padre'];
	}
   /*----------*/
	?>
	<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend><?php echo($titulo_pantalla) ?></legend>
		</div>
		<form id="formulario_tareas" name="formulario_tareas" class="form-horizontal" method="post">
		<input type="hidden" name="cod_padre" id="cod_padre" value="<?php echo($cod_padre); ?>">	
		
		<?php
		if(@$_REQUEST['from_tareas']){
			?>
			<input type="hidden" name="from_tareas" id="from_tareas" value="1">	
			<?php
		}
		?>

		<?php
		if(@$_REQUEST['idlistado_tareas']){
			?>
			<input type="hidden" name="from_listado_tareas" id="from_listado_tareas" value="1">	
			<?php
		}
		?>		

		<div class="control-group">
			<label class="control-label" for="etiqueta">Tipo de <?php echo($titulo_input); ?>*:</label>
				<div class="controls">
					<input type="radio" class="required" name="tipo_tarea" id="tipo_tarea0" value="1" >&nbsp;Personal&nbsp;
					<input type="radio" name="tipo_tarea" id="tipo_tarea1" value="2">&nbsp;Cumplimiento&nbsp;
					<input type="radio" name="tipo_tarea" id="tipo_tarea2" value="3">&nbsp;Rutinaria
					<label class="error" for="tipo_tarea"></label>
				</div>
		</div>
	
		<?php
			$perfil_usuario_actual=usuario_actual('perfil');
			
			$busca_perfil_admin=busca_filtro_tabla("idperfil","perfil","lower(nombre)='admin_interno'","",$conn);
			
			if($busca_perfil_admin[0]['idperfil']==$perfil_usuario_actual || usuario_actual('login')=='cerok'){
				?>
				<div class="control-group">
					<label class="control-label" for="generica">Generica:</label>
						<div class="controls">
							<input type="radio"  name="generica" id="generica1" value="1" >Si
							<input type="radio" name="generica" id="generica0" value="0" checked>No
							<label class="error" for="generica"></label>
						</div>
				</div>			
				<?php
			}
		?>		
		
		<div class="control-group element">
  			<label class="control-label" for="cargar">Proceso / Listado*:
  			</label>
  			<div class="controls"> 
    			<input type="text"  class="required" name="listado_tareas_fk" id="listado_tareas_fk" value="<?php echo($_REQUEST['idlistado_tareas'])?>">
 			 </div>
		</div>		
		
		<?php
		if(!@$_REQUEST['cod_padre']){
		?>
		
		<!-- div class="control-group element">
  			<label class="control-label" for="nombre_tarea">Nombre de la <?php echo($titulo_input); ?>*
  			</label>
  			<div class="controls"> 
    			<select name="nombre_tarea_select" id="nombre_tarea_select" >
    				
    			</select>
 			 </div>
		</div -->	
		
		<?php
		}
		?>			
		
		<div class="control-group element">
  			<label class="control-label" for="nombre_tarea">Nombre de la <?php echo($titulo_input); ?>*
  			</label>
  			<div class="controls"> 
    			<input type="text" name="nombre_tarea" class="required" id="nombre_tarea" >
    			<input type="hidden" id="idtareas_listado">
 			 </div>
		</div>	
		
		
		
				
		<input type="hidden" name="from_generica" id="from_generica" value="0">	
		
		<div class="control-group element">
  			<label class="control-label" for="descripcion">Descripci&oacute;n
  			</label>
 			 <div class="controls"> 
    		<textarea name="descripcion_tarea" id="descripcion_tarea"></textarea>
  			</div>
		</div>	
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Responsable de la <?php echo($titulo_input); ?>*:</label>
			<div class="controls">
				
				<input type="text" name="responsable_tarea" id="responsable_tarea" class="required" value="<?php echo(usuario_actual('idfuncionario')); ?>">
			<?php
				
				autocompletar_funcionarios("responsable_tarea","pantallas/tareas_listado/autocompletar_funcionarios.php",1,"valida_creador");
			?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Co-participantes:</label>
			<div class="controls">
				<input type="text" name="co_participantes" id="co_participantes">
			<?php
			autocompletar_funcionarios("co_participantes","pantallas/tareas_listado/autocompletar_funcionarios.php",0);
			?>
			</div>
		</div>	
			
		<div class="control-group">
			<label class="control-label" for="etiqueta">Seguidores:</label>
			<div class="controls">
			<input type="text" name="seguidores" id="seguidores">
			<?php
			autocompletar_funcionarios("seguidores","pantallas/tareas_listado/autocompletar_funcionarios.php",0);
			?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="etiqueta">Evaluador*:</label>
			<div class="controls">
			<input type="text" name="evaluador" id="evaluador" class="required">
			<?php
			autocompletar_funcionarios("evaluador","pantallas/tareas_listado/autocompletar_funcionarios.php",1);
			?>
			</div>
		</div>



		<div class="control-group">
				<label class="control-label" for="etiqueta">Fecha de inicio*:</label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append">
    					<input data-format="yyyy-MM-dd" id="fecha_inicio" name="fecha_inicio" type="text" value="<?php echo date("Y-m-d"); ?>" class="required" ></input>
    					<span class="add-on">
      					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
    					</span>
  					</div>
				</div>
		</div>

		<div class="control-group">
				<label class="control-label" for="etiqueta">Fecha de vencimiento*:</label>
				<div class="controls">
					<div id="datetimepicker2" class="input-append">
    					<input data-format="yyyy-MM-dd" name="fecha_limite" id="fecha_limite"  type="text" value="" class="required"></input>
    					<span class="add-on">
      					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
    					</span>
  					</div>
				</div>
		</div>
		<script src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-full.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    <script type='text/javascript'>
    $(document).ready(function (){
      hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
      hs.outlineType = 'rounded-white';
    });
    </script>
    <div class="control-group">
      <label class="control-label" for="recurrencia">Recurrencia:</label>
        <div class="controls">
          <input type="text" name="info_recurrencia" id="info_recurrencia" value="" />
          <a id="enlace_recurrencia" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 380, height: 470,preserveContent:false})" href="<?php echo $ruta_db_superior; ?>pantallas/tareas_listado/opciones_recurrencias.php?fecha_inicial=<?php echo(date('Y-m-d'));?>">Opciones de Recurrencia</a>
        </div>
    </div>
		<div class="control-group">
			<label class="control-label" for="etiqueta">Prioridad*:</label>
				<div class="controls">
					<input type="radio" name="prioridad" id="prioridad0" value="0" class="required">&nbsp;&nbsp;<i class="icon-flag-amarillo"></i>&nbsp;Baja&nbsp;&nbsp;
					<input type="radio" name="prioridad" id="prioridad1" value="1" checked>&nbsp;&nbsp;<i class="icon-flag-naranja"></i>&nbsp;Media&nbsp;&nbsp;
					<input type="radio" name="prioridad" id="prioridad2" value="2">&nbsp;&nbsp;<i class="icon-flag-morado"></i>&nbsp;Alta&nbsp;&nbsp;
					<input type="radio" name="prioridad" id="prioridad3" value="3">&nbsp;&nbsp;<i class="icon-flag-rojo"></i>&nbsp;Cr&iacute;tica&nbsp;&nbsp;
					<label class="error" for="prioridad"></label>
				</div>
		</div>
		
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Tiempo estimado:</label>
			<div class="controls">
				<div id="datetimepicker3" class="input-append">
    				<input  name="tiempo_estimado" id="tiempo_estimado" type="hidden" />
    				<input type="text" id="h"  placeholder="H" style="width:50px;" />  
    				<input type="text" id="i"  placeholder="M" style="width:50px;"/>
    				<script>
    					$(document).ready(function(){
    						$('#h,#i').keyup(function(){
    							var valor=$(this).val();
    							valor=valor.replace(/[^0-9]/g, '');
    							$(this).val(valor);
    							
    							if( $('#h').val()>838 ){
    								$('#h').val(838);
    							}
    							if( $('#i').val()>59 ){
    								$('#i').val(59);
    							}    							
    							var h=$('#h').val();
    							var i=$('#i').val();
    							var hi=h+':'+i;
    							$('#tiempo_estimado').val(hi);
    						});
    					});
    				</script>
  				</div>
			</div>
		</div>			
		<div class="control-group">
			<label class="control-label" for="etiqueta">Enviar <?php echo($titulo_input); ?> por email*:</label>
				<div class="controls">
					<input type="radio" class="required" name="enviar_email" id="enviar_email0" value="0">&nbsp;&nbsp;Si&nbsp;&nbsp;
					<input type="radio" name="enviar_email" id="enviar_email1" value="1" checked>&nbsp;&nbsp;No
					<label class="error" for="enviar_email"></label>
				</div>
		</div>

 		<!-- div id="mensaje_file"></div>
		<div class="control-group">
			<label class="control-label" for="files[]">Anexos:</label>
        <div width="100%">
        	<div class="pull-left">                    
            <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;" id="contenedor_anexos">
                <i class="glyphicon-plus"></i>
                <span>Examinar</span>
                <input type="file" name="files[]" multiple ng-disabled="disabled" id="files">
            </span>
          
          </div>
        </div>
        <br/>   
		<table class="table table-striped" id="archivos"></table>        
		</div -->			

			<div class="control-group">
				<div class="controls">
		            <button type="button" class="btn btn-mini btn-primary start" data-ng-click="submit()">
		                <i class="glyphicon-upload"></i>
		                <span>Aceptar</span>
		            </button>  							
					<!-- input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar" -->
					<input type="hidden" name="iddoc" value="<?php echo($_REQUEST['iddoc'])?>">
					<input type="hidden" name="idtareas_listado" value="<?php echo($idtareas_listado[0]['idtareas_listado'])?>">
					<input data-format="yyyy-MM-dd"  name="fecha_creacion" type="hidden" value="<?php echo(date("Y-m-d"));?>" readonly ></input>
					<input type="hidden" class="required" name="estado_tarea" id="estado_tarea" placeholder="" readonly="true" value="PENDIENTE">
					<input type="hidden" name="guardar" value="1">
					<input type="hidden" name="idbusqueda_componente" value="<?php echo($_REQUEST['idbusqueda_componente'])?>">
				</div>
			</div>
		</form>

	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
	<style>
	label.error {
		font-weight: bold;
		color: red;
	}
	/*
	.form-horizontal .control-label {
     width: 60%;
  }
  */
	</style>
	<script>
		
	$(document).ready(function(){
		$("#formulario_tareas").validate(
			{
            submitHandler: function(form){
            	
            	<?php encriptar_sqli("formulario_tareas",0,"form_info",$ruta_db_superior);?>
            	
                var fecha_vencimiento=$('#fecha_limite').val();
        	    var fecha_inicio=$('#fecha_inicio').val();
            	if(fecha_vencimiento<fecha_inicio){
            		
				  	if( $('[name="tipo_tarea"]:checked').val()==2 ){
				  		
					  	$('#fecha_limite').val('');
					  	var mensaje='La fecha de vencimiento debe de ser mayor a la fecha de inicio';
					  	notificacion_saia('ATENCI&Oacute;N!<br/> '+mensaje,'error','',3000);
					  	$('.start').attr('disabled',false);
					  	return false;			  		
				  	}else{
				  		form.submit();  
				  	}            		
            	}else{
	            	if($('[name="tipo_tarea"]').val()==2 || $('[name="tipo_tarea"]').val()==3){
	            		if( $('#from_generica').val()==1 || $('[name="generica"]').val()==1){
	            			 form.submit();  
	            		}else{
	            			notificacion_saia('ATENCI&Oacute;N!<br/>Debe cargar una tarea','error','',3000);
	            			$('.start').attr('disabled',false);
	            			return false;
	            			
	            		}
	            	}else{
	            		form.submit();  
	            	}             		
            	}
            } 
		});
		$('#datetimepicker1,#datetimepicker2').datetimepicker({
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		}).on('changeDate', function(e){
            var fecha_vencimiento=$('#fecha_limite').val();
        	var fecha_inicio=$('#fecha_inicio').val();
  
            if(fecha_vencimiento<fecha_inicio){
            	
			  	if( $('[name="tipo_tarea"]:checked').val()!=1 ){
			  		
				  	$('#fecha_limite').val('');
				  	var mensaje='La fecha de vencimiento debe de ser mayor a la fecha de inicio';
				  	notificacion_saia('ATENCI&Oacute;N!<br/> '+mensaje,'error','',3000);	
				  	return false;  		
			  	}            		
            }			
			
			
			
			$(this).datetimepicker('hide');
			if($(this).attr("id")=="datetimepicker1"){
				
			  var finicio=e.date.toISOString().split("T");
			
			
			  var f = new Date();
			  var mes = (f.getMonth() +1);
			  if(mes<10 && mes>0){
			  	mes='0'+mes;
			  }
			  var fecha_actual=f.getFullYear() + '-' + mes + '-' + f.getDate();
			  if(finicio<fecha_actual){  //si la fecha inicio es menor que hoy
			  	$('#fecha_inicio').val('');
			  	notificacion_saia('ATENCI&Oacute;N!<br/>La fecha de inicio debe de ser mayor a la de hoy','error','',3000);
			  }else{
			  	
			  	var href=$("#enlace_recurrencia").attr("href");
			  	var href_vector=href.split('&');
			  	
			  	if(href_vector.length>1){
			  		$("#enlace_recurrencia").attr("href","<?php echo $ruta_db_superior; ?>pantallas/tareas_listado/opciones_recurrencias.php?fecha_inicial="+finicio[0]+"&"+href_vector[1]);
			  	}else{
			  		$("#enlace_recurrencia").attr("href","<?php echo $ruta_db_superior; ?>pantallas/tareas_listado/opciones_recurrencias.php?fecha_inicial="+finicio[0]);			  		
			  	}
			  } 
			}
		});
		/*
		$('#datetimepicker3').datetimepicker({
			pickDate: false,
			pickSeconds: false
		});*/
		
		var delay = (function(){
		  var timer = 0;
		  return function(callback, ms){
		    clearTimeout (timer);
		    timer = setTimeout(callback, ms);
		  };
		})();
		
		
		$("[name='tipo_tarea']").change(function (){
			var tipo=$(this).val();
			if(tipo==3 || tipo==1){
				$("#fecha_limite").removeClass("required");
			}else{
				$("#fecha_limite").addClass("required");
			}
		});
	});
	
	function valida_creador(id){
		var actual=parseInt(<?php echo usuario_actual("idfuncionario");?>);
		if(actual!=id){
			
			<?php
			
			$usuario_actual_seguidor=usuario_actual("idfuncionario");
			$usuario_actual_nombre=usuario_actual("nombres");
			$usuario_actual_nombre.=' '.usuario_actual("apellidos");
			
			?>
			
			 var cadena='';
			 var repetido=0;
			if( $('#informacion_buscar_radicado_seguidores').length==0 ){
				 cadena+='<table style="font-size:10px;" id="informacion_buscar_radicado_seguidores"><tbody>';
			}else{
				var lista_seguidores=$('#seguidores').val().split(',');
				for(i=0;i<lista_seguidores.length;i++){
					if(lista_seguidores[i]==<?php echo($usuario_actual_seguidor); ?>){
						repetido=1;
					}
				}	
			}	
			
			cadena+='<tr id="fila_<?php echo($usuario_actual_seguidor); ?>" opt="<?php echo($usuario_actual_seguidor); ?>">';
			cadena+='<td><?php echo($usuario_actual_nombre); ?></td>';
			cadena+='<td><img style="cursor:pointer" src="../../imagenes/eliminar_nota.gif" registro="<?php echo($usuario_actual_seguidor); ?>" onclick="eliminar_asociado_seguidores(<?php echo($usuario_actual_seguidor); ?>)"></td>';
			cadena+='</tr>';
			
			if( $('#informacion_buscar_radicado_seguidores').length==0 ){
				 cadena+='</tbody></table>';	
			}	
			if( $('#informacion_buscar_radicado_seguidores').length==0){
				$('#buscar_radicado_seguidores').after(cadena);
			}else{
				if(repetido==0){
					$('#informacion_buscar_radicado_seguidores').prepend(cadena);
				} 
			}
			
			if(  $('#seguidores').val()=='' ){
				 $('#seguidores').val( <?php echo($usuario_actual_seguidor); ?>);
			}else{
				if(repetido==0){
					$('#seguidores').val( $('#seguidores').val()+','+<?php echo($usuario_actual_seguidor); ?>);
				}
			}
		}
	}
	
	</script>
	
	<script>
		$(document).ready(function(){
			
			<?php if($titulo_input=='subtarea'){
				?>
					//$('#nombre_tarea').parent().parent().hide();
					$('[name="generica"]').parent().parent().hide();
					
				<?php
			} 
			
			?>
			
			$('[name="generica"]').click(function(){
				var valor=$(this).val();

				$('#nombre_tarea').val('');
				$("#informacion_buscar_radicado_tareas_listado").remove();
				$('#informacion_buscar_radicado_listado_tareas').remove();
		  		$("#listado_tareas_fk").val('');
		  		$("#buscar_radicado_listado_tareas").attr('readonly',false);			
				if($('#info_recurrencia').val()!=''){
					$('#info_recurrencia').val('');
					$('#enlace_recurrencia').attr('disabled',false);
				}	
				for(i=0;i<=3;i++){ 
					$('#prioridad'+i).show();
					$('#prioridad'+i).attr('checked',false);
				}
				if($('#tiempo_estimado').val()!=''){
					$('#tiempo_estimado').val('');
					$('#h').val('');
					$('#i').val('');
					$('#i,#h').attr('readonly',false);
				}
			//	refrescar_select_tareas();
				
				if(valor==1){

					//$('#nombre_tarea_select').html('');
					//$('#nombre_tarea_select').parent().parent().hide();
					$('#nombre_tarea').val('');
					//$('#nombre_tarea').parent().parent().show();
					
			    	$('#nombre_tarea').val('');
			        $('#nombre_tarea').show();
                    $("#buscar_radicado_tareas_listado").attr('readonly',false);					
					$("#buscar_radicado_tareas_listado").hide();
					
					
					
					$('#descripcion_tarea,#responsable_tarea,#co_participantes,#seguidores,#evaluador,[name="enviar_email"]').parent().parent().hide();
					$('#responsable_tarea,#evaluador,[name="enviar_email"],#fecha_inicio,#fecha_limite').removeClass('required');
   					$('#fecha_inicio,#fecha_limite').parent().parent().parent().hide();
    				$('#fecha_inicio,#fecha_limite').attr('aria-required',false);					
					$('#fecha_inicio,#fecha_limite').val('0000-00-00');
					
				}else{
					
					//$('#nombre_tarea_select').html('');
					//$('#nombre_tarea_select').parent().parent().show();
					
					$('#nombre_tarea').val('');
			        $('#nombre_tarea').hide();
                    $("#buscar_radicado_tareas_listado").attr('readonly',false);							
					$("#buscar_radicado_tareas_listado").show();
					//$('#nombre_tarea').parent().parent().hide();					
					//refrescar_select_tareas();
					
					$('#descripcion_tarea,#responsable_tarea,#co_participantes,#seguidores,#evaluador,[name="enviar_email"]').parent().parent().show();
					$('#responsable_tarea,#evaluador,[name="enviar_email"],#fecha_inicio,#fecha_limite').addClass('required');
   					$('#fecha_inicio,#fecha_limite').parent().parent().parent().show();
    				$('#fecha_inicio,#fecha_limite').attr('aria-required',true);							
									
				}
				
			});
			
		});
	</script>	

	
<?php
}
	
echo(librerias_file_upload());
?>

<script src="<?php echo($ruta_db_superior);?>pantallas/anexos/js/anexos.js"></script>
<script>
$(document).ready(function(){            
  var archivos = 0;
  var falla_archivos = 0;
  var exito_archivos = 0;
  var formulario= $('#formulario_tareas');
  var error=0;
  var data2;
  redireccion=1;
  
  $('.eliminar_file').on('click',function(){        
    $(this).closest("tr").remove();
  });
  $('#formulario_tareas').fileupload({        
      url: '<?php echo($ruta_db_superior);?>pantallas/tareas_listado/subir_archivo_tareas_listado.php',
      dataType: 'json',
      autoUpload: false            
  }).on('fileuploadadd', function (e, data) {
    redirecciona=0;
    $(".start").on('click', function () {
        if(formulario.valid()){	
        	data.submit();
        }
    });
    archivos++;      
    $.each(data.files, function (index, file) {       
      var texto='<tr><td>'+file.name+'</td><td>'+tamanio_archivo(file.size,2)+'</td><!--td><i class="icon-trash eliminar_file"></i></td--><td width="100px"><div class="progress progress-striped active"><div class="bar bar-success" id="'+file.size+'" ></div></div></td></tr>';                 
      $("#archivos").append(texto);                     
    });                           
  }).on('fileuploadprogress', function (e, data){
      var progress = parseInt(data.loaded / data.total * 100, 10);        
      $.each(data.files, function(index,file){                                  
        $('#'+file.size).css('width',(progress)+ '%');
        $('#'+file.size).html((progress)+"%");
      });                     
  }).on('fileuploaddone', function(e, data){
    redirecciona=0;
    $.each(data.result.files, function(index,file){       
      if(typeof(file.error)!="undefined"){
        $('#'+file.size).removeClass('bar-success');
        $('#'+file.size).addClass('bar-danger');
        falla_archivos++;
        notificacion_saia('Error:'+file.name+"<br>"+file.error,'error','',3500);
      }                   
      else{
        exito_archivos++;
      }
    });             
    if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
      notificacion_saia("Todos los archivos se cargaron con &eacute;xito","success","",2500);
      setTimeout(function(){ formulario.submit();  }, 1000);
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      setTimeout(function(){ formulario.submit();  }, 1000);
    }
    
   	
  }).on('fileuploadfail', function(e, data){              
    $.each(data.files, function(index,file){              
      notificacion_saia('Error:'+file.name+" <br> "+file.error,'error','',3500);   
      falla_archivos++; 
    });    
  });
  
  
   $(".start").on('click', function () {
       $(this).attr('disabled',true);
        if(formulario.valid()){ 
        	
        	 var fecha_vencimiento=$('#fecha_limite').val();
        	 var fecha_inicio=$('#fecha_inicio').val();
			  var f = new Date();
			  var mes = (f.getMonth() +1);
			  if(mes<10 && mes>0){
			  	mes='0'+mes;
			  }
			  var fecha_actual=f.getFullYear() + '-' + mes + '-' + f.getDate();
			  if(fecha_vencimiento<fecha_actual || fecha_vencimiento<fecha_inicio){  //si la fecha vencimiento es menor que hoy y que la fecha inicio
			  	
			  	if( $('[name="tipo_tarea"]').val()!=1 ){
				  	$('#fecha_limite').val('');
				  	
				  	if(fecha_vencimiento<fecha_actual){
				  		var mensaje='La fecha de vencimiento debe de ser mayor a la fecha de hoy';
				  	}else{
				  		var mensaje='La fecha de vencimiento debe de ser mayor a la fecha de inicio';
				  	}
				  	
				  	notificacion_saia('ATENCI&Oacute;N!<br/> '+mensaje,'error','',3000);
				  	
				  	 $(this).attr('disabled',false);
			  	}else{
			  		setTimeout(function(){ formulario.submit();  }, 1000);
			  	}

			  	
			  	
			  }else{
	        	if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
	        		setTimeout(function(){ formulario.submit();  }, 1000);
	        	}			  	
			  }        	          
        }else{
             $(this).attr('disabled',false);
        }
    });
   
});  

</script>




<?php


if(!@$_REQUEST['cod_padre']){
	autocompletar_listado_tareas();
	autocompletar_tareas_listado();
}else{
	
	$nombre_tarea=busca_filtro_tabla('nombre_tarea','tareas_listado','idtareas_listado='.$_REQUEST['cod_padre'],'',$conn);
	
	?>
		<script>
		    $('[name="info_recurrencia"]').hide();	
			$('#listado_tareas_fk').hide();
			$('#listado_tareas_fk').parent().siblings('label').html('Tarea padre: ');
			$('#listado_tareas_fk').after('<input type="text" readonly value="<?php echo($nombre_tarea[0]['nombre_tarea']); ?>" />');
			
		</script>
	<?php 

}



function autocompletar_listado_tareas() {
	global $ruta_db_superior;
	global $raiz_saia;
	$raiz_saia = $ruta_db_superior;
	
	if (@$_REQUEST ["listado_tareas_fk"] || @$_REQUEST ["idlistado_tareas"]) {
			
		if(@$_REQUEST ["idlistado_tareas"]){
			$_REQUEST ["listado_tareas_fk"]=$_REQUEST ["idlistado_tareas"];
		}	
			
			
		$listado_tareas=busca_filtro_tabla("idlistado_tareas,nombre_lista","listado_tareas","idlistado_tareas=".$_REQUEST ["listado_tareas_fk"],"",$conn);			
		$id = $_REQUEST["listado_tareas_fk"];
		$descripcion = '<b>Lista:</b> ' . $listado_tareas[0]['nombre_lista'];
		$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='" . $ruta_db_superior . "imagenes/eliminar_nota.gif' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";
	}
	

	?>
<style>

#informacion_buscar_radicado_listado_tareas tr td{
	font-size:10px;
}

.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li:hover {
	background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height: 10px;
	overflow: hidden;
}
.highslide-move {
   display: none;
}

</style>
<script>
$(document).ready(function(){
	$('[name="info_recurrencia"]').hide();	


  var delay = (function(){
          var timer = 0;
          return function(callback, ms){
                  clearTimeout (timer);
                  timer = setTimeout(callback, ms);
          };
  })();
  
  $("#listado_tareas_fk").hide();
  $("#listado_tareas_fk").parent().append("<input type='text' id='buscar_radicado_listado_tareas' size='50' name='buscar_radicado_listado_tareas'><div id='ul_completar_listado_tareas' class='ac_results'></div>");
  $("#buscar_radicado_listado_tareas").keyup(function (){
          if($(this).val()==0 || $(this).val()==""){
                  //alert("Ingrese Numero de Radicado");
          }else{
                  var x_valor=$(this).val();
                  delay(function(){
                          $("#ul_completar_listado_tareas").load( "autocompletar_listado_tareas.php", { nombre_lista: x_valor });
                  },500);			  		$('#from_generica').val(0);  
					
					$('#informacion_buscar_radicado_listado_tareas').remove();
		  			$("#listado_tareas_fk").val('');
		  			$("#buscar_radicado_listado_tareas").attr('readonly',false);			
					if($('#info_recurrencia').val()!=''){
						$('#info_recurrencia').val('');
						$('#enlace_recurrencia').attr('disabled',false);
					}	
					for(i=0;i<=3;i++){ 
						$('#prioridad'+i).show();
						$('#prioridad'+i).attr('checked',false);
					}
					if($('#tiempo_estimado').val()!=''){
						$('#tiempo_estimado').val('');
						$('#h').val('');
						$('#i').val('');
						$('#i,#h').attr('readonly',false);
					}
					//refrescar_select_tareas();
          }
  });
  
  <?php if(@$_REQUEST ["listado_tareas_fk"] || @$_REQUEST ["idlistado_tareas"]){ ?>
  $("#buscar_radicado_listado_tareas").after("<?php echo(addslashes($cadena)); ?>");
  $("#listado_tareas_fk").val("<?php echo($_REQUEST["listado_tareas_fk"]); ?>");
  $("#buscar_radicado_listado_tareas").attr('readonly',true);

  <?php } ?>
});
function cargar_datos_listado_tareas(iddoc,descripcion){
  $("#ul_completar_listado_tareas").empty();
  if(iddoc!=0){
          if(!$("#informacion_buscar_radicado_listado_tareas").length){
                  $("#buscar_radicado_listado_tareas").after("<table id='informacion_buscar_radicado_listado_tareas'></table>");
          }
          $("#informacion_buscar_radicado_listado_tareas").append("<tr id='fila_listado_tareas_"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_listado_tareas("+iddoc+");'></td></tr>");
          $("#listado_tareas_fk").val(iddoc);
          $("#buscar_radicado_listado_tareas").val("");
          $("#buscar_radicado_listado_tareas").attr('readonly',true);
  }else{
          $("#buscar_radicado_listado_tareas").val("");
  }
  
  //refrescar_select_tareas();
}
function eliminar_asociado_listado_tareas(iddoc){
  $("#fila_listado_tareas_"+iddoc).remove();
  $("#listado_tareas_fk").val('');
  $("#buscar_radicado_listado_tareas").attr('readonly',false);
  
  
  if( parseInt($('#from_generica').val())==1 ){
      eliminar_asociado_tareas_listado( $('#idtareas_listado').val() );
  }
  
  
  
  
  
  //refrescar_select_tareas();
}



</script>
<?php
}
?>

<?php
if(!@$_REQUEST['cod_padre']){ 
   
?>

<script>

	function refrescar_select_tareas(){	
		$.ajax({ 
            type:'POST',
            dataType: 'html',
            url: "cargar_info_tarea.php",
            data: {
                listado_tareas_fk:$('#listado_tareas_fk').val(),
            	opt:1,
            	select:1
            },
            success: function(datos){
				$('#nombre_tarea_select').html('');
				$('#nombre_tarea_select').html(datos);
        	}
    	});		
	}

	$(document).ready(function(){

	/* //DESARROLLO QUE PERMITE QUE AL ADICIONAR ESTE  POR DEFECTO "PERSONAL"
		$('#tipo_tarea0').attr('checked', true);
		$('#nombre_tarea').parent().parent().show();

		$('input[name="cargar_tarea"],#listado_tareas_fk,#responsable_tarea,#co_participantes,#seguidores,#evaluador,#info_recurrencia,input[name="prioridad"],input[name="enviar_email"],input[name="generica"]').parent().parent().hide();	
		$('#fecha_inicio,#fecha_limite,#tiempo_estimado').parent().parent().parent().hide();
		$('[name="files[]"]').parent().parent().parent().parent().hide();		
				
		$('#responsable_tarea,#evaluador,#fecha_limite').removeClass('required');
		$('#listado_tareas_fk').val('-1');
		$('#fecha_limite').attr('aria-required',false);

		$('#informacion_buscar_radicado_listado_tareas,#informacion_buscar_radicado_responsable_tarea,#informacion_buscar_radicado_co_participantes,#informacion_buscar_radicado_seguidores,#informacion_buscar_radicado_evaluador').remove();
		$('#buscar_radicado_listado_tareas,#buscar_radicado_responsable_tarea,#buscar_radicado_co_participantes,#buscar_radicado_seguidores,#buscar_radicado_evaluador').attr('readonly',false);
		*/	
		
		$('input[name="tipo_tarea"]').click(function(){
			if( $(this).val()==1 ){
				$('#nombre_tarea,#descripcion_tarea').parent().parent().show();
				
				$('#nombre_tarea').val('');
			    $('#nombre_tarea').show();
                $("#buscar_radicado_tareas_listado").attr('readonly',false);
				$("#buscar_radicado_tareas_listado").hide();
				$("#informacion_buscar_radicado_tareas_listado").remove();
				
				
				$('#from_generica').val(0);   
				$('#nombre_tarea_select').parent().parent().hide();
				$('#nombre_tarea_select').html('');
				
				$('input[name="cargar_tarea"],#listado_tareas_fk,#responsable_tarea,#co_participantes,#seguidores,#evaluador,#info_recurrencia,input[name="prioridad"],input[name="enviar_email"],input[name="generica"]').parent().parent().hide();	
				$('#fecha_inicio,#fecha_limite,#tiempo_estimado').parent().parent().parent().hide();
				$('[name="files[]"]').parent().parent().parent().parent().hide();		
				
				$('#responsable_tarea,#evaluador,#fecha_limite,[name="prioridad"]').removeClass('required');
				$('#listado_tareas_fk').val('-1');
				$('#fecha_limite').attr('aria-required',false);

				$('#informacion_buscar_radicado_listado_tareas,#informacion_buscar_radicado_responsable_tarea,#informacion_buscar_radicado_co_participantes,#informacion_buscar_radicado_seguidores,#informacion_buscar_radicado_evaluador').remove();
				$('#buscar_radicado_listado_tareas,#buscar_radicado_responsable_tarea,#buscar_radicado_co_participantes,#buscar_radicado_seguidores,#buscar_radicado_evaluador').attr('readonly',false);
			
			}else{
				$('#generica0').trigger('click');
				 	$('#from_generica').val(0);  
					$('#nombre_tarea').val('');
			        $('#nombre_tarea').hide();
                    $("#buscar_radicado_tareas_listado").attr('readonly',false);					
					$("#buscar_radicado_tareas_listado").show();
					$('#informacion_buscar_radicado_listado_tareas').remove();
		  			$("#listado_tareas_fk").val('');
		  			$("#buscar_radicado_listado_tareas").attr('readonly',false);			
					if($('#info_recurrencia').val()!=''){
						$('#info_recurrencia').val('');
						$('#enlace_recurrencia').attr('disabled',false);
					}	
					for(i=0;i<=3;i++){ 
						$('#prioridad'+i).show();
						$('#prioridad'+i).attr('checked',false);
					}
					if($('#tiempo_estimado').val()!=''){
						$('#tiempo_estimado').val('');
						$('#h').val('');
						$('#i').val('');
						$('#i,#h').attr('readonly',false);
					}
					//refrescar_select_tareas();
				
				//$('#nombre_tarea').parent().parent().hide();
				$('#nombre_tarea').val('');
				//$('#nombre_tarea_select').parent().parent().show();
				
				$('input[name="cargar_tarea"],#listado_tareas_fk,#responsable_tarea,#co_participantes,#seguidores,#evaluador,#info_recurrencia,input[name="prioridad"],input[name="enviar_email"],input[name="generica"]').parent().parent().show();	
				$('#fecha_inicio,#fecha_limite,#tiempo_estimado').parent().parent().parent().show();
				$('[name="files[]"]').parent().parent().parent().parent().show();		
				
				$('#responsable_tarea,#evaluador,#fecha_limite,[name="prioridad"]').addClass('required');
				$('#listado_tareas_fk').val('');
				$('#informacion_buscar_radicado_listado_tareas').html('');
				$('#buscar_radicado_listado_tareas').attr('readonly',false);
				$('#fecha_limite').attr('aria-required',true);
				
				//refrescar_select_tareas();		
			}
		});
		
		$('#tipo_tarea1').attr('checked', true); //POR DEFECTO CUMPLIMIENTO
		$('#tipo_tarea1').trigger('click');//POR DEFECTO CUMPLIMIENTO

		$('#nombre_tarea_select').change(function(){
			  var idtareas_listado=$(this).val();
			  if(idtareas_listado!=0){
		          $('#from_generica').val(1);  
		          
				  $.ajax({
		          	type:'POST',
		            dataType: 'json',
		            url: "cargar_info_tarea.php",
		            data: {
		            	idtareas_listado:idtareas_listado,
		            	opt:3
		            },
		            success: function(datos){
						$('#nombre_tarea').val(datos.nombre_tarea);
						$('#informacion_buscar_radicado_listado_tareas').remove();
		 				$("#buscar_radicado_listado_tareas").after(datos.descripcion_proceso_listado);
		  				$("#listado_tareas_fk").val(datos.listado_tareas_fk);
		  				$("#buscar_radicado_listado_tareas").attr('readonly',true);			
						if(datos.info_recurrencia!=''){
							$('#info_recurrencia').val(datos.info_recurrencia);
							$('#enlace_recurrencia').attr('disabled',true);
						}
						$('#prioridad'+(datos.prioridad-1)).attr('checked',true);
						for(i=0;i<=3;i++){
							$('#prioridad'+i).show();
							if((datos.prioridad-1)!=i){
								$('#prioridad'+i).hide();
							}
						}
						if(datos.tiempo_estimado){
							if(datos.tiempo_estimado!='00:00:00'){
								$('#tiempo_estimado').val(datos.tiempo_estimado);
								
								$('#h').val(datos.tiempo_estimado_h);
								$('#i').val(datos.tiempo_estimado_i);
								$('#i,#h').attr('readonly',true);
							}
						}
		            }
		          }); 			  	
			  }else{
			  		$('#from_generica').val(0);  
					$('#nombre_tarea').val('');
					$('#informacion_buscar_radicado_listado_tareas').remove();
		  			$("#listado_tareas_fk").val('');
		  			$("#buscar_radicado_listado_tareas").attr('readonly',false);			
					if($('#info_recurrencia').val()!=''){
						$('#info_recurrencia').val('');
						$('#enlace_recurrencia').attr('disabled',false);
					}	
					for(i=0;i<=3;i++){ 
						$('#prioridad'+i).show();
						$('#prioridad'+i).attr('checked',false);
					}
					if($('#tiempo_estimado').val()!=''){
						$('#tiempo_estimado').val('');
						$('#h').val('');
						$('#i').val('');
						$('#i,#h').attr('readonly',false);
					}
					//refrescar_select_tareas();
			  }
			  
		});

	}); //fin document.ready
</script>

<?php
}
?>

<script>
	$(document).ready(function(){
		
		
			
			<?php 
				$usuario_actual=usuario_actual('idfuncionario');
				$datos_usuario_actual=busca_filtro_tabla("a.nombres,a.apellidos,b.cod_padre","vfuncionario_dc a, cargo b ","a.idcargo=b.idcargo AND a.estado_dc=1 AND a.idfuncionario=".$usuario_actual,"",$conn);
					
				$datos_jefe_usuario_actual=busca_filtro_tabla("a.idfuncionario,a.nombres,a.apellidos","vfuncionario_dc a, cargo b ","b.idcargo=".$datos_usuario_actual[0]['cod_padre']."  AND a.idcargo=b.idcargo AND a.estado_dc=1","",$conn);
				
				$idevaluador=0;
				if($datos_jefe_usuario_actual['numcampos']){  //SOLO SI EL USUARIO TIENE JEFE APLICA VALIDACION
				
			
				$cadena='<tr id="fila_'.$datos_jefe_usuario_actual[0]['idfuncionario'].'" opt="'.$datos_jefe_usuario_actual[0]['idfuncionario'].'">';
					$cadena.='<td>'.$datos_jefe_usuario_actual[0]['nombres'].' '.$datos_jefe_usuario_actual[0]['apellidos'].'</td>';
					$cadena.='<td><img style="cursor:pointer" src="../../imagenes/eliminar_nota.gif" registro="'.$datos_jefe_usuario_actual[0]['idfuncionario'].'" onclick="eliminar_asociado_evaluador('.$datos_jefe_usuario_actual[0]['idfuncionario'].')"></td>';
				$cadena.='</tr>';
				$idevaluador=$datos_jefe_usuario_actual[0]['idfuncionario'];	
				
				$cadena2='<tr id="fila_'.$datos_jefe_usuario_actual[0]['idfuncionario'].'" opt="'.$datos_jefe_usuario_actual[0]['idfuncionario'].'">';
					$cadena2.='<td>'.$datos_jefe_usuario_actual[0]['nombres'].' '.$datos_jefe_usuario_actual[0]['apellidos'].'</td>';
					$cadena2.='<td><img style="cursor:pointer" src="../../imagenes/eliminar_nota.gif" registro="'.$datos_jefe_usuario_actual[0]['idfuncionario'].'" onclick="eliminar_asociado_seguidores('.$datos_jefe_usuario_actual[0]['idfuncionario'].')"></td>';
				$cadena2.='</tr>';				
				
				}else{
    				$cadena='<tr id="fila_'.$usuario_actual.'" opt="'.$usuario_actual.'">';
    					$cadena.='<td>'.$datos_usuario_actual[0]['nombres'].' '.$datos_usuario_actual[0]['apellidos'].'</td>';
    					$cadena.='<td><img style="cursor:pointer" src="../../imagenes/eliminar_nota.gif" registro="'.$usuario_actual.'" onclick="eliminar_asociado_evaluador('.$usuario_actual.')"></td>';
    				$cadena.='</tr>';
    				$idevaluador=$usuario_actual;
				}
			?>
		$('#responsable_tarea').change(function(){
			var usuario_actual='<?php echo(usuario_actual('idfuncionario')); ?>';
			if(usuario_actual==$('#responsable_tarea').val()){
				
				$('#evaluador').val('<?php echo($idevaluador); ?>');

				var cadena='';
				if( $('#informacion_buscar_radicado_evaluador').length==0 ){
					cadena+='<table style="font-size:10px;" id="informacion_buscar_radicado_evaluador"><tbody>';	
				}
				cadena+='<?php echo($cadena); ?>';
				if( $('#informacion_buscar_radicado_evaluador').length==0 ){
					cadena+='</tbody></table>';	
				}

				if( $('#informacion_buscar_radicado_evaluador').length==0 ){
					$('#buscar_radicado_evaluador').after('<br>'+cadena);
				}else{
					$('#informacion_buscar_radicado_evaluador').html('');
					$('#informacion_buscar_radicado_evaluador').append(cadena);
				}
				
				<?php  if($datos_jefe_usuario_actual['numcampos']){  //SOLO SI EL USUARIO TIENE JEFE APLICA VALIDACION ?>
				
				var continuar=true;
				var vector_seguidores=$('#seguidores').val().split(',');
				for(i=0;i<vector_seguidores.length;i++){
					if(vector_seguidores[i]=='<?php echo($datos_jefe_usuario_actual[0]['idfuncionario']); ?>'){
						continuar=false;
					}
				}
				
				if(continuar==true){
					if($('#seguidores').val()!=''){
						$('#seguidores').val( $('#seguidores').val()+',<?php echo($datos_jefe_usuario_actual[0]['idfuncionario']); ?>' );
					}else{
						$('#seguidores').val('<?php echo($datos_jefe_usuario_actual[0]['idfuncionario']); ?>');
					}

					cadena='';
					if( $('#informacion_buscar_radicado_seguidores').length==0 ){
						cadena+='<table style="font-size:10px;" id="informacion_buscar_radicado_seguidores"><tbody>';	
					}
					cadena+='<?php echo($cadena2); ?>';
					
					if( $('#informacion_buscar_radicado_seguidores').length==0 ){
						cadena+='</tbody></table>';	
					}
	
					if( $('#informacion_buscar_radicado_seguidores').length==0 ){
						$('#buscar_radicado_seguidores').after('<br>'+cadena);
					}else{
						$('#informacion_buscar_radicado_seguidores').append(cadena);
					}					
				}
				
				<?php } ?>
			}
		
		});	
		
		cargar_seleccionados_responsable_tarea();
		
		
		
		
			
	});

</script>

<?php

function autocompletar_tareas_listado() {
	global $ruta_db_superior;
	global $raiz_saia;
	$raiz_saia = $ruta_db_superior;
	?>
<style>

#informacion_buscar_radicado_tareas_listado tr td{
	font-size:10px;
}

.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li:hover {
	background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height: 10px;
	overflow: hidden;
}
.highslide-move {
   display: none;
}

</style>
<script>
$(document).ready(function(){
		


  var delay = (function(){
          var timer = 0;
          return function(callback, ms){
                  clearTimeout (timer);
                  timer = setTimeout(callback, ms);
          };
  })();
  
  $("#nombre_tarea").hide();
  $("#nombre_tarea").parent().append("<input type='text' id='buscar_radicado_tareas_listado' size='50' name='buscar_radicado_tareas_listado'><div id='ul_completar_tareas_listado' class='ac_results'></div>");
  $("#buscar_radicado_tareas_listado").keyup(function (){
          
         // alert($("#nombre_tarea").val());
      
          if($(this).val()==0 || $(this).val()==""){
                  //alert("Ingrese Numero de Radicado");
          }else{
                  var x_valor=$(this).val();
                  delay(function(){
                          $("#ul_completar_tareas_listado").load( "cargar_info_tarea.php", { nombre_tarea: x_valor,opt:1,autocompletar:1,listado_tareas_fk:$('#listado_tareas_fk').val() });
                  },500);			  		
                    $('#from_generica').val(0);  
					
					$('#informacion_buscar_radicado_tareas_listado').remove();
		  			$("#buscar_radicado_tareas_listado").attr('readonly',false);			
					if($('#info_recurrencia').val()!=''){
						$('#info_recurrencia').val('');
						$('#enlace_recurrencia').attr('disabled',false);
					}	
					for(i=0;i<=3;i++){ 
						$('#prioridad'+i).show();
						$('#prioridad'+i).attr('checked',false);
					}
					if($('#tiempo_estimado').val()!=''){
						$('#tiempo_estimado').val('');
						$('#h').val('');
						$('#i').val('');
						$('#i,#h').attr('readonly',false);
					}
				//	refrescar_select_tareas();
          }
          $("#nombre_tarea").val( $(this).val() );
  });
});
function cargar_datos_tareas_listado(iddoc,descripcion){
  $("#ul_completar_tareas_listado").empty();
  if(iddoc!=0){
          if(!$("#informacion_buscar_radicado_tareas_listado").length){
                  $("#buscar_radicado_tareas_listado").after("<table id='informacion_buscar_radicado_tareas_listado'></table>");
          }
          $("#informacion_buscar_radicado_tareas_listado").append("<tr id='fila_tareas_listado_"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_tareas_listado("+iddoc+");'></td></tr>");
          $("#buscar_radicado_tareas_listado").val("");
          $("#buscar_radicado_tareas_listado").attr('readonly',true);
          
                  var idtareas_listado=iddoc;
		          $('#from_generica').val(1);  
		          
				  $.ajax({
		          	type:'POST',
		            dataType: 'json',
		            url: "cargar_info_tarea.php",
		            data: {
		            	idtareas_listado:idtareas_listado,
		            	opt:3
		            },
		            success: function(datos){
						$('#nombre_tarea').val(datos.nombre_tarea);
						$('#idtareas_listado').val(datos.idtareas_listado);
						$('#informacion_buscar_radicado_listado_tareas').remove();
		 				$("#buscar_radicado_listado_tareas").after(datos.descripcion_proceso_listado);
		  				$("#listado_tareas_fk").val(datos.listado_tareas_fk);
		  				$("#buscar_radicado_listado_tareas").attr('readonly',true);			
						if(datos.info_recurrencia!=''){
							$('#info_recurrencia').val(datos.info_recurrencia);
							$('#enlace_recurrencia').attr('disabled',true);
						}
						$('#prioridad'+(datos.prioridad-1)).attr('checked',true);
						for(i=0;i<=3;i++){
							$('#prioridad'+i).show();
							if((datos.prioridad-1)!=i){
								$('#prioridad'+i).hide();
							}
						}
						if(datos.tiempo_estimado){
							if(datos.tiempo_estimado!='00:00:00'){
								$('#tiempo_estimado').val(datos.tiempo_estimado);
								
								$('#h').val(datos.tiempo_estimado_h);
								$('#i').val(datos.tiempo_estimado_i);
								$('#i,#h').attr('readonly',true);
							}
						}
		            }
		          }); 	          
  }else{
         
  }
  
  //refrescar_select_tareas();
}
function eliminar_asociado_tareas_listado(iddoc){
  $("#fila_tareas_listado_"+iddoc).remove();
  $("#nombre_tarea").val('');
  $("#idtareas_listado").val('');
  $("#buscar_radicado_tareas_listado").attr('readonly',false);
 
 
    $('#from_generica').val(0);  
	$('#nombre_tarea').val('');
	$('#informacion_buscar_radicado_listado_tareas').remove();
	$("#listado_tareas_fk").val('');
	$("#buscar_radicado_listado_tareas").attr('readonly',false);			
	if($('#info_recurrencia').val()!=''){
		$('#info_recurrencia').val('');
		$('#enlace_recurrencia').attr('disabled',false);
	}	
	for(i=0;i<=3;i++){ 
		$('#prioridad'+i).show();
		$('#prioridad'+i).attr('checked',false);
	}
	if($('#tiempo_estimado').val()!=''){
		$('#tiempo_estimado').val('');
		$('#h').val('');
		$('#i').val('');
		$('#i,#h').attr('readonly',false);
	} 
  //refrescar_select_tareas();
}



</script>
<?php
}
?>

