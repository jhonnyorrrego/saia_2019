<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />
<script type="text/javascript" src="fancybox/jquery-1.4.3.min.js"></script>

	<script type="text/javascript" src="fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<link rel="stylesheet" href="fancybox/style.css" />
<script type="text/javascript">
    $(document).ready(function() {
    $("a").fancybox({
					'width'				: '75%',
					'height'			: '75%',
					'autoScale'			: false,
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'type'				: 'iframe'
			});
		});
    //-->
    </script>
  </head>
  <body>

  <?
  echo "<a href='arbol_funcionarios.php'>Abrir arbolito</a>";
    ?>
</body>
</html>