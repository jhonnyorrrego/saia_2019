<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<div id="div_contenido">
<style>
.alineados{
  padding: 0;
  margin: 0;
  border: 0;
  background-color:#CCCCCC;
  text-shadow: #333 1px 1px 3px;
  text-align: center;
  cursor: pointer;
  display:inline;
}
.vertical {
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}

INPUT, TEXTAREA, SELECT
{
font-family: Verdana,Tahoma,arial; 
font-size: 10px; 
/*text-transform:Uppercase;*/
}

table thead td 
   {
      font-weight:bold;
    cursor:pointer;
    background-color:".$config[0]["valor"].";
    text-align: center;
    font-family: Verdana,Tahoma,arial; 
    font-size: 9px;
    /*text-transform:Uppercase;*/
    vertical-align:middle;    
   }
   table tbody td 
   {  
    font-family: Verdana,Tahoma,arial; 
    font-size: 9px;
   }
</style>  
  <table border="1px" style="border-collapse:collapse" width="99%">
    <thead>
      <tr>
        <td style="background:#D2D3D5;"  colspan="14">MAPA DE RIESGOS</td>
      </tr>
      <tr>
        <td colspan="14" style="background:#D2D3D5;text-align:left">PROCESO: EVALUACION INDEPENDIENTE</td>
      </tr>
      <tr>
        <td colspan="14" style="background:#D2D3D5;text-align:left">
          OBJETIVO: Realizar un examen autónomo y objetivo al sistema de control interno, la gestión institucional y sus resultados; así mismo, brindar asesoría, acompañamiento y fomentar la cultura del control para coadyuvar al mejoramiento continuo de los sistemas de gestión.
        </td>
      </tr>
      <tr height="80px">
        <td style="background:#E7E7E9;"  rowspan="2" width="10%"><p class="vertical">RIESGO</p></td>
        <td style="background:#E7E7E9;"  colspan="2"><p class="vertical">CALIFICACI&Oacute;N</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="6%"><p class="vertical">EVALUACION RIESGO</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="5%"><p class="vertical">CONTROLES</p></td>
        <td style="background:#E7E7E9;"  colspan="2"><p class="vertical">NUEVA<br>CALIFICACION</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="5%"><p class="vertical">NUEVA EVALUACION</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="5%"><p class="vertical">OPCIONES<br>MANEJO</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="5%"><p class="vertical">ACCIONES</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="10%"><p class="vertical">RESPONSABLE DE LA ACCI&Oacute;N</p></td>
        <td style="background:#E7E7E9;"  rowspan="2" width="10%"><p class="vertical">INDICADOR</p></td>
      </tr>
      <tr height="80px">
        <td style="background:#E7E7E9;" width="6%"><p class="vertical">Probabilidad</p></td>
        <td style="background:#E7E7E9;" width="6%"><p class="vertical">Impacto</p></td>
        <td style="background:#E7E7E9;" width="6%"><p class="vertical">Probabilidad</p></td>
        <td style="background:#E7E7E9;" width="6%"><p class="vertical">Impacto</p></td>
      </tr>
    </thead>
      <tr>
        <td align="center" rowspan="1" width="10%">
          1-Desconocimiento de antecedentes, normas, actividades y operaci&oacute;n del proceso o area auditada.
        </td>
        <td align="center" rowspan="1" width="6%">
          (3)<br>Posible
        </td>
        <td align="center" rowspan="1" width="6%">
          (3)<br>Moderado
        </td>
        <td class="transparente" align="center" style="background:#DAAAA6" rowspan="1" width="6%">
          Zona de riesgo alta
        </td>
        <td class="transparente" width="5%">
          Se analizan los procedimientos, normas, antecedentes y demas elementos que permitan un adecuado conocimiento del proceso o area auditada.
        </td>
        <td class="transparente" align="center" rowspan="1" width="6%">
          (1)<br>Raro
        </td>
        <td class="transparente" align="center" rowspan="1" width="6%">
          (3)<br>Moderado
        </td>
        <td class="transparente" align="center" style="background:yellow" rowspan="1" width="5%">
          Zona de riesgo moderada
        </td>
        <td class="transparente" align="center" rowspan="1" width="5%">
          Asumir el riesgo, reducir el riesgo
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td align="center" rowspan="1" width="10%">
          2-No establecer un adecuado plan de Auditoria
        </td>
        <td align="center" rowspan="1" width="6%">
          (3)<br>Posible
        </td>
        <td align="center" rowspan="1" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:yellow" rowspan="1" width="6%">
          Zona de riesgo moderada
        </td>
        <td class="transparente" width="5%">
          Se establece un plan de auditoria con las actividades que permitan cumplir los objetivos y alcance propuestos
        </td>
        <td class="transparente" align="center" rowspan="1" width="6%">
          (1)<br>Raro
        </td>
        <td class="transparente" align="center" rowspan="1" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:green" rowspan="1" width="5%">
          Zona de riesgo baja
        </td>
        <td class="transparente" align="center" rowspan="1" width="5%">
          Asumir el riesgo
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td align="center" rowspan="2" width="10%">
          3-No aplicar las herramientas y tecnicas de Auditoria
        </td>
        <td align="center" rowspan="2" width="6%">
          (3)<br>Posible
        </td>
        <td align="center" rowspan="2" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:yellow" rowspan="2" width="6%">
          Zona de riesgo moderada
        </td>
        <td class="transparente" width="5%">
          Se realizan procesos de capacitaci&oacute;n y formaci&oacute;n para fortalecer la competencia de los auditores
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (1)<br>Raro
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:green" rowspan="2" width="5%">
          Zona de riesgo baja
        </td>
        <td class="transparente" align="center" rowspan="2" width="5%">
          Asumir el riesgo
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td class="transparente" width="5%">
          Se desarrollan las actividades de la auditoria, utilizando las herramientas y tecnicas m&aacute;s apropiadas
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td align="center" rowspan="2" width="10%">
          4-Incumplimiento de las normas de Auditoria Generalmente aceptadas
        </td>
        <td align="center" rowspan="2" width="6%">
          (3)<br>Posible
        </td>
        <td align="center" rowspan="2" width="6%">
          (3)<br>Moderado
        </td>
        <td class="transparente" align="center" style="background:#DAAAA6" rowspan="2" width="6%">
          Zona de riesgo alta
        <td>
        <td class="transparente" width="5%">
          Seguimiento a la ejecuci&oacute;n de la auditoria por parte del responsable del proceso.
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (1)<br>Raro
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (3)<br>Moderado
        </td>
        <td class="transparente" align="center" style="background:yellow" rowspan="2" width="5%">
          Zona de riesgo moderada
        </td>
        <td class="transparente" align="center" rowspan="2" width="5%">
          Asumir el riesgo, reducir el riesgo
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>        
      </tr>
      <tr>
        <td class="transparente" width="5%">
          Se realizan procesos de capacitaci&oacute;n y formaci&oacute;n &nbsp;sobre las normas de auditoria
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td align="center" rowspan="2" width="10%">
          5-Que no se establezcan acciones correctivas, preventivas o de mejora &nbsp;
        </td>
        <td align="center" rowspan="2" width="6%">
          (3)<br>Posible
        </td>
        <td align="center" rowspan="2" width="6%">
          (4)<br>Mayor
        </td>
        <td class="transparente" align="center" style="background:red" rowspan="2" width="6%">
          Zona de riesgo extrema
        </td>
        <td class="transparente" width="5%">
          Cuando se detecta el incumplimiento en la formulaci&oacute;n de un plan de mejoramiento o un compromiso suscrito se comunica al responsable del proceso o area para que tome los correctivos del caso.&nbsp;
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (1)<br>Raro
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:green" rowspan="2" width="5%">
          Zona de riesgo baja
        </td>
        <td class="transparente" align="center" rowspan="2" width="5%">
          Asumir el riesgo
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td class="transparente" width="5%">
          Se verifica que los hallazgos negativos (administrativos) detectados en la auditoria se plasmen en un plan de mejoramiento, a traves del aplicativo implementado en saia.&nbsp;&nbsp;
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td align="center" rowspan="2" width="10%">
          6-Que no se realicen seguimientos a los planes de mejoramiento
        </td>
        <td align="center" rowspan="2" width="6%">
          (3)<br>Posible
        </td>
        <td align="center" rowspan="2" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:yellow" rowspan="2" width="6%">
          Zona de riesgo moderada
        </td>
        <td class="transparente" width="5%">
          Se tiene implementado un aplicativo para el adecuado seguimiento y control de los planes de mejoramiento
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (1)<br>Raro
        </td>
        <td class="transparente" align="center" rowspan="2" width="6%">
          (2)<br>Menor
        </td>
        <td class="transparente" align="center" style="background:green" rowspan="2" width="5%">
          Zona de riesgo baja
        </td>
        <td class="transparente" align="center" rowspan="2" width="5%">
          Asumir el riesgo
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
      <tr>
        <td class="transparente" width="5%">
          Se programan dos seguimientos semestrales a los planes de mejoramiento y se generan informes de seguimiento por cada plan.
        </td>
        <td class="transparente" width="5%"></td>
        <td class="transparente" width="10%"></td>
        <td class="transparente" width="10%"></td>
      </tr>
    </table>
 </body>
</html>