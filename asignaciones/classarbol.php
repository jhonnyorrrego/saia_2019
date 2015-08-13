<?php
/*
 * UTILIZACION : Incluir y generar objetos de la clase 
 * 
 *   
 * Nodo Raiz  new TagXml(cod padre =0,codigo 1,"nombre");  ejemplo $dp = new TagXml(0,1,"Dependencias"); 
 * Adicionar nodo:
 *                1. $dp->$la->asigna_hijo("Contabilidad"); 
 *                   
 *                2.  $conta=$dp->$la->asigna_hijo("Contabilidad");  
 *  				  Asi $conta tendra el apuntador para adicionar mas nodos a contabilidad directamente 
 *                    o imprimir el subarbol de la dependencia contabilidad  	
 *                3.  $impuestos=$dp->asignahijo_xnombre("contabilidad","impuestos");
 * 				      esto adicionara un nodo hiho a el PRIMER TAG que se llame contabilidad, 
 * 					  en este caso adiciona el nodo "impuestos"
 * Asignar Atributos:
 * 				  1.  $conta->asigna_atributo("id","234"); //asigna el atributo a un tag  
 *      			  asigna un atributo a un objeto			
 * Generar Resultados:
 * 				  1.  echo $dp->r_xml(); // imprime el xml de dependencias recorriendo todos los tasg internos  
 *                    Cualquier objeto o subojeto puede generar su arbol XML completo
 *                2.  echo $dp->rtag(); // imprime solo el tag interno sin recorer los hijos    
 * 					  retorna el tag con sus atributos sin recorrer sus hijos
 * 
 *  Propiedad de Cerok LTDA  
 *  Programó Ing Carlos Uribe
 *  
 * */

//header("content-type: text/xml");

class TagXml
{ 
  var $contenido;        //informacion entre el inicio y final del tag <nombre>contenido</nombre> 
  var $id;               //id (cod_padre,cod_tag)  
  var $hijos=array();     
  var $atributos=array();//atributos array ((id,222),(nombre,carlos)) -> elemento    
  var $nombre;           // Nombre del tag <nombre> </nombre>
  var $codificacion;
function TagXml($id_pad,$id_hijo,$nom,$cont=NULL)
{ 
  $this->id=array("padre"=>$id_pad,"cod"=>$id_hijo); // para el nodo inicial se envia como padre 0
  $this->nombre=$nom;
  if(isset($cont))
  	$this->contenido=$cont;
  else 	
  $this->contenido=NULL;
  
}
//asigna un atributo a un tag
function asigna_atributo($atributo,$valor)
{   $art=array($atributo => $valor); 
	array_push($this->atributos,$art);
}
//Busca un nombre de atributo y retorna todas sus ocurrencias 
function r_atributo($atributo)
{   $resultado=array();
	if(array_key_exists($atributo,$this->atributos))
	{
	$localizados=array_keys($this->atributos,$atributo); // las posiciones donde esta el atributo 
	 foreach ($localizados as $key) {
	    array_push($resultado,$this->atributos[$key]);	
	 return($resultado);
	 }
	 
	}
 return FALSE;
} // Fin funcion
//asigna el valor interno del tag
function asigna_contenido($cont)
{
	$this->contenido=$cont;
}
//retorna el contenido interno del tag
function r_contenido($contenido)
{
	return $this->contenido;
}	
//asigna un hijo al tag retorna el objeto
function asigna_hijo($nomb,$cont=NULL)
 { 
   $hijotmp=new TagXml($this->id["cod"],count($this->hijos)+1,$nomb,$cont);
   array_push($this->hijos,$hijotmp);
   return($hijotmp);
 }
// Asiga todo un arbol xml creado al apuntador hijo Mantiene los que yas estan creados
function asignaarbol_hijo($arbol_hijos)
 { 
   array_push($this->hijos,$arbol_hijos);
   print_r($this->hijos);
   return($this->hijos);
 }
// retorna el cod) no el id del padre
function r_cod()
{
	return($this->id["cod"]);
} 
// retorna solamente este objeto tag organizando
function r_tag()
{  
    $tag="<".$this->nombre;
 if(isset($this->atributos))
   foreach($this->atributos As $at)
   { // print_r($at);
     $key=array_keys($at); //obtiene la clave (nombre del atributo)
     $key=$key[0];
     $tag.=" ".$key."=\"".$at[$key]."\" "; //concatena asi ej : id="3456"
   }
    $tag.=">".$this->contenido; //tag con su contenido  
    $tag.="</".$this->nombre.">";
 return($tag);  	
} 
// retorna el tag actual y los hijos  de forma organizada y recursiva 
function r_xml()
{ 
   $tag="<".$this->nombre;
 if(isset($this->atributos))
   foreach($this->atributos As $at)
   { // print_r($at);
     $key=array_keys($at); //obtiene la clave (nombre del atributo)
     $key=$key[0];
     $tag.=" ".$key."=\"".$at[$key]."\" "; //concatena asi ej : id="3456"
   }
    $tag.=">".$this->contenido; //tag con su contenido   
  if(isset($this->hijos))
   foreach($this->hijos As $hijo)
    $tag.=$hijo->r_xml();

    $tag.="</".$this->nombre.">";
   return($tag);  	

}
// retorna los hijos directos solamente
function r_nivel1()
{
 $tag="<".$this->nombre;
 if(isset($this->atributos))
   foreach($this->atributos As $at)
   { // print_r($at);
     $key=array_keys($at); //obtiene la clave (nombre del atributo)
     $key=$key[0];
     $tag.=" ".$key."=\"".$at[$key]."\" "; //concatena asi ej : id="3456"
   }
 $tag.=">".$this->contenido; //tag con su contenido   
  if(isset($this->hijos))
   foreach($this->hijos As $hijo)
    $tag.=$hijo->r_tag();
    $tag.="</".$this->nombre.">";
   return($tag);
	
}
/*
 * Funciones Inteligentes que buscan en el arbol xml
 */
// Asigna un nuevo tag hijo  al primer tag cuyo nombre coincida   
function asignahijo_xnombre($nomcompara,$nombhijo,$cont=NULL)
{
	if(strcasecmp($this->nombre,$nomcompara) == 0)
	{  return($this->asigna_hijo($nombhijo,$cont)); // enocntrado asigna y retorna
	}
	else 
	 if(isset($this->hijos)) 
	 {  $nhijo=NULL;
	 	foreach($this->hijos As $hijo)
        $nhijo=$hijo->asignahijo_xnombre($nomcompara,$nombhijo,$cont);
        if($nhijo) return($nhijo); // encontro y asigno el hijo 
	 }
	   
    else 	
       return NULL; // no realizo la asignacion ya no hay mas donde buscar 
}


}// Fin Clase tagxml

?>