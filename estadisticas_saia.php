<?php
set_time_limit(0);
include_once("db.php");
include_once("header.php");
$anios=busca_filtro_tabla("min(to_char(fecha,'yyyy')) as minimo,max(to_char(fecha,'yyyy')) as maximo","documento","","",$conn);
$inicial=$anios[0]["minimo"];
echo "<br /><b>Estadisticas saia por a&ntilde;o</b><br /><br /><table border='1'>
      <tr class='encabezado_list'><td>A&Ntilde;O</td><td>DOCUMENTOS</td><td>PAGINAS (MB)</td><td>ANEXOS (MB)</td><td>PDF (MB)</td><td>TOTAL DISCO (MB)</td></tr>";
$total=0;  

for($inicial;$inicial<=$anios[0]["maximo"];$inicial++)
  {$docs=busca_filtro_tabla("count(*)","documento","to_char(fecha,'yyyy')='$inicial'","",$conn);
   $anexos=busca_filtro_tabla("ruta","anexos","documento_iddocumento in(select iddocumento from documento where to_char(fecha,'yyyy')='$inicial')","",$conn);
  $pdf=busca_filtro_tabla("pdf","documento","to_char(fecha,'yyyy')='$inicial' and pdf is not null","",$conn);
   $paginas=busca_filtro_tabla("imagen,ruta","pagina","id_documento in(select iddocumento from documento where to_char(fecha,'yyyy')='$inicial')","",$conn);
  
   $tanexos=0;
   $tpaginas=0;
   $tpdfs=0;  
   for($m=0;$m<$anexos["numcampos"];$m++)
     $tanexos+=filesize($anexos[$m]["ruta"]);    
   
   for($m=0;$m<$pdf["numcampos"];$m++)
     $tpdfs+=filesize($pdf[$m]["pdf"]);  
   
   for($m=0;$m<$paginas["numcampos"];$m++)
     $tpaginas+=filesize($paginas[$m]["ruta"])+filesize($paginas[$m]["imagen"]);
         
   echo '<tr align="right"><td>'.$inicial.'</td><td>'.number_format($docs[0][0],0,',','.').'</td><td>'.number_format($tpaginas/1048576,1,',','.').'</td><td>'.number_format($tanexos/1048576,1,',','.').'</td><td>'.number_format($tpdfs/1048576,1,',','.').'</td><td>'.number_format(($tpaginas+$tanexos+$tpdfs)/1048576,1,',','.').'</td></tr>';  
   $total+=$tpaginas+$tanexos+$tpdfs;
  }
echo "</table><br /><br />Total espacio ocupado en disco: ".number_format($total/1048576,1,',','.')."MB"; 
if(MOTOR=="Oracle"){
$libre_db=busca_filtro_tabla("sum(bytes)/1024/1024","dba_free_space","tablespace_name ='".TABLESPACE."' GROUP BY tablespace_name","",$conn);
$total_db=busca_filtro_tabla("sum(BYTES/1024/1024)","dba_data_files","tablespace_name ='".TABLESPACE."' GROUP BY tablespace_name","",$conn);
echo "<br />Total espacio ocupado en base de datos: ".number_format($total_db[0][0]-$libre_db[0][0],0,',','.')."MB (".number_format((($total_db[0][0]-$libre_db[0][0])*100)/$total_db[0][0],2)."%)";
}
include_once("footer.php");
?>
