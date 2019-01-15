<?php
function notificaciones($message, $type = 'success', $duration = 5000 ){
  echo '<script type="text/javascript">
    top.notification({
      message: "'.$message.'",
      type: "'.$type.'",
      duration: "'.$duration.'"
    });
  </script>';
}
?>
