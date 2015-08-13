<?php
   $idtarea=$_REQUEST["idtarea"];
  // include_once('../header.php'); 
?>     

<frameset cols="300px,*">

<!-- #######################

The first row is divided into 2 columns. This is the start tag for the cols frameset. Two frames follow which are the two columns in the FIRST ROW

####################### -->

<frame name="menu" target="main" noresize="noresize" scrolling="no" src="control_tareaadd.php?idtarea=<?php echo $idtarea; ?>" />

<frame name="menu" target="main" noresize="noresize" scrolling="no" src="control_tarealist.php?idtarea=<?php echo $idtarea; ?>" />

<?php include_once('../footer.php'); ?>
