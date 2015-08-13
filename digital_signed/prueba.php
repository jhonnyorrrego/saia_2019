<?php
          try{
            //Componente para Firmar y Estampar
            $jarStampSignPDF                   = "java -jar StampSignPDF.jar";
            //Ruta del archivo que se va a estampar
            $rutaArchivo                 = '"prueba.pdf"';
            //El certificado con el cual se va a firmar.
            $rutaCertificadoFirma        = '"CertEstampa_Clientes.p12"';
            //Password del certificado
            $passwordFirma                     = "tNl8F61o";
            //El certificado con el cual se va a firmar la peticion de la estampa
            $rutaCertificadoEstampa      = '"CertEstampa_Clientes.p12"';
            //Password del certificado con el cual se va a firmar la peticion de la estampa
            $passwordEstampa             = "tNl8F61o";
            //La ruta del archivo que contendra la estampa correspondeinte al archivo $rutaArchivo
            $rutaArchivoEstampado   = '"DocumentoSigned.pdf"';
            //Razón de la firma
            $signReason = '"Razon de la firma"';
            //Lugar de la firma
            $signLocation = '"Pereira-Colombia"';
            //Nombre del campo de firma
            $signFieldName = '""';          
            //Funcionalidad para estampar
            echo ($jarStampSignPDF." ".$rutaArchivo." ".$rutaArchivoEstampado." ".$rutaCertificadoFirma." ".$passwordFirma." ".$rutaCertificadoEstampa." ".$passwordEstampa." ".$signReason." ".$signLocation." ".$signFieldName);
            if ($response == 0){
                  echo "<br/>Ejecutado";
            }
            else{
                  echo "<br/>Error";
            }
      }
      catch (Exception $ex){
            echo $ex;
      }           
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once("estampado_tiempo.php");
proceso_estampado_pdf($ruta_db_superior."digital_signed/prueba.pdf");
?>