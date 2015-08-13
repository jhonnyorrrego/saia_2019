function despachar()
{var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("datos").elements.length;i=i+1)
    {var objeto=document.getElementById("datos").elements[i];
     if(objeto.checked==true && objeto.name.indexOf("despachar_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
  if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else 
    {$("#espacio_datos").html("<input type='hidden' name='docs' value='"+docs+"'>");
     document.getElementById("datos").action="despachar.php";
     document.getElementById("datos").submit();
    }
}
function almacenar_expediente()
{var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("datos").elements.length;i=i+1)
    {var objeto=document.getElementById("datos").elements[i];
     if(objeto.checked==true && objeto.name.indexOf("expediente_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
  if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else 
    {exp=$("#idexpediente").val();
     $("#espacio_datos").html("<input type='hidden' name='docs' value='"+docs+"'> <input type='hidden' name='idexpediente' value='"+exp+"'>");
     document.getElementById("datos").action="expediente_guardar.php";
     document.getElementById("datos").submit();
    }
}
function vincular_documento(){
var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("datos").elements.length;i=i+1)
    {var objeto=document.getElementById("datos").elements[i];
     if(objeto.checked==true && objeto.name.indexOf("vincular_documento_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
  if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else 
    {documento=$("#iddocumento_origen").val();
     $("#espacio_datos").html("<input type='hidden' name='docs' value='"+docs+"'> <input type='hidden' name='vincular_documento' value='"+documento+"'>");
     document.getElementById("datos").action="vincular_documento.php";
     document.getElementById("datos").submit();
    }
}