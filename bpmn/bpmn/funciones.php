<script type="text/javascript">
$(document).ready(function(){
	$(".habilitado").live("click",function(){
		if($(this).hasClass("task") || $(this).hasClass("task_ok") || $(this).hasClass("task_iniciada") || $(this).hasClass("task_error")){
			llamado_bpmn("<?php echo($ruta_db_superior);?>bpmn/tarea_usuario.php?idbpmn=<?php echo($_REQUEST['idbpmn'])?>&idfigura="+$(this).attr("data-activity-id")+"&vista_bpmn=<?php echo($_REQUEST['vista_bpmn']);?>&idbpmni=<?php echo($_REQUEST['idbpmni']);?>",720,440);
		}
		if($(this).hasClass("exclusivegateway")){
			llamado_bpmn("<?php echo($ruta_db_superior);?>bpmn/condicional.php?idbpmn=<?php echo($_REQUEST['idbpmn'])?>&idcondicional="+$(this).attr("data-activity-id")+"&tipo_evento=condicional&vista_bpmn=<?php echo($_REQUEST['vista_bpmn']);?>&idbpmni=<?php echo($_REQUEST['idbpmni']);?>",720,440);
		}	
	});	
});
function llamado_bpmn(ruta,ancho,alto){
	<?php 
		echo(' hs.htmlExpand( null, {
    src: ruta,				             	
    objectType: "iframe", 
    outlineType: "rounded-white", 
    wrapperClassName: "highslide-wrapper drag-header", 
    preserveContent: false,				
    width: ancho,
    height: alto							 
  });');
		?>
}
</script>