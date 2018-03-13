<?php 

echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script>
i=0;
flag=0;
 
window.onload=function(event){
    window.onclick=rectangulo;  
    }
function rectangulo(event){
if(flag==0){
var x=event.clientX;
var y=event.clientY;
var div=document.createElement("div");
div.id=i
i++;
div.style.position="absolute";
div.style.zIndex=i;
div.style.left=x+"px";
div.style.top=y+"px";
div.style.backgroundColor="#000";
document.body.appendChild(div);
window.onmousemove=function(event){
div.style.width=(event.clientX-x)+"px";
div.style.height=(event.clientY-y)+"px";
}
flag=1;
}
else{flag=0; window.onmousemove=false;
    }
    }
 
 
</script>
<body>
</body>
</html>');


?>