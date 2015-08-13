<?php

include("SQL.php");

class Visual
  {
    var $nueva,$tablaRef,$idregistro,$idregistro_tabla;
/*
<Clase>Visual
<Nombre>Visual
<Parametros>
<Responsabilidades>Crea la conexion a la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/     
    function Visual()
      {$this->nueva =new Conexion("MySql", "localhost","root","","formulario","3306");
       $this->idregistro = "0";
      }
/*
<Clase>Visual
<Nombre>autocompl
<Parametros>
<Responsabilidades>Consulta en la base de datos los valores similares al valor del campo
de tipo autocompletar
<Notas>
<Excepciones>
<Salida>una lista con los valores similares al valor escrito en la casilla
<Pre-condiciones>se ejecuta una función en javascript que llama esta función, la cual
es disparada por el evento onkeydown
<Post-condiciones>se llena un div con la lista de los valores
*/       
    function autocompl()
    { 
        if ($_POST["digitado"] == "")
            echo "";
        $consulta = new SQL($this->nueva->Obtener_Conexion(), $this->nueva->Motor);
        $cargo = $consulta->Buscar("db, tabla, valor", "referencia_entrada", "componente_idcomponente = ".$_POST["idcomponente"],'');
        $dbRef = $cargo[0]["db"];
        $tablaRef = $cargo[0]["tabla"];
        $valorRef = $cargo[0]["valor"];
        $this->nueva->Reconexion($dbRef);
        $consultaRef = new SQL($this->nueva->Obtener_Conexion(), $this->nueva->Motor);
        $valores = $consultaRef->Buscar($valorRef, $tablaRef, $valorRef." LIKE '".$_POST["digitado"]."%'", "");
        if ($valores=="")
            echo "";
        $opciones = "";
        $i = 1;
        if ($valores<>"")
          {foreach ($valores as $val)
            {
              $opciones.= "<div id=\"d".$_POST["idcomponente"]."comp".$i."\" title=\"".$i."\" onmousedown=\"clickLista(this, 'auto".$_POST["idcomponente"];
              $opciones.="', 'comple".$_POST["idcomponente"]."');\" onMouseOver=\"mouseDentro(this, ".$_POST["idcomponente"].");\">".$val[$valorRef]."</div>";
              $i++;
            }
          echo $opciones;
         } 
    }
  }
if(array_key_exists("op",$_POST))
  {$clase=new Visual();
   $clase->$_POST["op"]();
  }
if(array_key_exists("codigo",$_GET))
  echo $_GET["codigo"];
?>
