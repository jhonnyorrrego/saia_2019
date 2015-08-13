/*
<Clase>
<Nombre>validar_transferir</Nombre> 
<Parametros></Parametros>
<Responsabilidades>Busca los documentos seleccionados para transferir y hace el llamado a transferencia_plantillas.php<Responsabilidades>
<Notas></Notas>
<Excepciones>Se debe eligir un documento para transferir</Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function validar_transferir()
   {seleccionados=new Array();
    j=0;
    casillas=document.getElementsByName("transferir");
    for(i=0;i<casillas.length;i=i+1)
    {if(casillas[i].checked==true)
        {seleccionados[j]=casillas[i].value;
         j++;
        }
    }
    if(j==0)
       alert("Debe seleccionar por lo menos un documento.");
    else
       {window.location="transferenciaadd_plantillas.php?docs="+seleccionados.join(",")+","+"&retorno=expediente_detalles.php?key="+document.getElementById("idexpediente").value;
       }   
   }
/*
<Clase>
<Nombre>seleccionar_todos</Nombre> 
<Parametros>opcion:valor true o false</Parametros>
<Responsabilidades>selecciona todos los checkbox o los des-selecciona<Responsabilidades>
<Notas>Recorre todos los elementos checkbox del formulario</Notas>
<Excepciones>Se debe eligir un documento para transferir</Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/   
function seleccionar_todos(opcion)
{for(i=0;i<document.getElementById("form1").elements.length;i=i+1)
    {var objeto=document.getElementById("form1").elements[i];
     if(objeto.type=="checkbox")
        objeto.checked=opcion;
    } 
}
   