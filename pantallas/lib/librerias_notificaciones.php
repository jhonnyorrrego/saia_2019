
<?php
function notificaciones($mensaje,$tipo,$tiempo){
if($mensaje!=''){
  if($tipo==''){
    $tipo='alert';
  }
  if($tiempo==''){
    $tiempo=3500;
  }
  ?>
  <script type="text/javascript">
  top.noty({text: '<?php echo($mensaje)?>',type: '<?php echo($tipo);?>',layout: "topCenter",timeout:<?php echo($tiempo);?>});
  </script>
  <?php
}
}
?>
