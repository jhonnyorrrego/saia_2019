<html>
<head>
<script type="text/javascript">
function calcular(nombre_form)
{
var ret=document.forms[nombre_form].elements['rete'].value;
var valor=document.forms[nombre_form].elements['valor'].value;

document.forms[nombre_form].elements['total'].value=parseInt(valor)+parseInt(valor*ret/100);

}
</script>
</head>

<body>
<form id="frm1" name="frm1">
Valor
<input type="text" id="valor" name="valor" onchange="calcular('frm1')">
Retencion
<input type="text" id="rete"  name="rete" onchange="calcular('frm1')">
Total
<input type="text" id="total"  name="total" >
</form>
</body>
</html>
