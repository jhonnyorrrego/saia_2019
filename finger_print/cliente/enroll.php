<html>
<head>
</head>

<body onbeforeunload="Finalize()">

<OBJECT ID="GrFingerX" CLASSID="CLSID:71944DD6-B5D2-4558-AD02-0435CB2B39DF"></OBJECT>

<script LANGUAGE="JavaScript" src="GrFinger.js"></script>

<script type="text/javascript">
var i = 0;
</script>

<SCRIPT FOR="GrFingerX" EVENT="SensorPlug(id)" LANGUAGE="javascript">
GrFingerX.CapStartCapture(id);
document.getElementById('log').value ="";
document.getElementById('log').value = document.getElementById('log').value + "Started\n";
</SCRIPT>

<SCRIPT FOR="GrFingerX" EVENT="SensorUnplug(id)" LANGUAGE="javascript">
GrFingerX.CapStopCapture(id);
document.getElementById('log').value = document.getElementById('log').value + "Stopped\n";
</SCRIPT>

<SCRIPT FOR="GrFingerX" EVENT="FingerDown(id)" LANGUAGE="javascript">
document.getElementById('log').value = document.getElementById('log').value + "FingerDown\n";
</SCRIPT>

<SCRIPT FOR="GrFingerX" EVENT="FingerUp(id)" LANGUAGE="javascript">
document.getElementById('log').value = document.getElementById('log').value + "FingerUp\n";
</SCRIPT>

<SCRIPT FOR="GrFingerX" EVENT="ImageAcquired(id, w, h, rawImg, res)" LANGUAGE="javascript">
GrFingerX.CapSaveRawImageToFile(rawImg, w, h, "C:\\teste.bmp", 501);
Start();
if(document.getElementById('img').style.display == 'none')
	document.getElementById('img').style.display = 'block';
CallEnroll(rawImg, w, h, res);
</SCRIPT>

<input type = "button" value = "Enroll" onclick = "Initialize()" />

<br/>

 <IMG id="img" style="display: none;" border="1" name="refresh" />
    <SCRIPT language="JavaScript" type="text/javascript">
    <!--
    function Start() {
    document.getElementById("img").src = "C:\\teste.bmp?ts" + encodeURIComponent( new Date().toString() );   
    }
    // -->
    </SCRIPT> 
	
<br/>
	  
<textarea name="log" id = "log" rows = "15" cols = "75" ></textarea>

</body>
</html>