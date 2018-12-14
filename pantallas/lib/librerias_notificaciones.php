<?php
function notificaciones($message, $type, $duration){
  echo '<script type="text/javascript">
    top.notification({
      message: "'.$message.'",
      type: "'.$type.'",
      duration: "'.$duration.'"
    });
  </script>';
}
?>
