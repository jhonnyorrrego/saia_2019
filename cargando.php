<div id="waitDiv" style="position:absolute;left:0;top:20;visibility:hidden; border:none;">
	<img src="<?php echo "imagenes/cargando.gif"; ?>" border="0">
</div>
<script>
	var DHTML = (document.getElementById || document.all || document.layers);
	function ap_getObj(name) {
		if (document.getElementById) {
			return document.getElementById(name).style;
		} else if (document.all) {
			return document.all[name].style;
		} else if (document.layers) {
			return document.layers[name];
		}
	}

	function ap_showWaitMessage(div, flag) {
		var x = ap_getObj(div);
		x.visibility = (flag) ? 'visible' : 'hidden'
		if (!document.getElementById)
			if (document.layers) {
				x.left = 280 / 2;
			}
		return true;
	}
	ap_showWaitMessage('waitDiv', 3); 
</script>
