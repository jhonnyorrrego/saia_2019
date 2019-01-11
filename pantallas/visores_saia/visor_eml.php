<?php 

/**
*
* This code has been written by Alexis Ulrich (http://alx2002.free.fr)
* This code is in the public domain.
*
*/

define(EML_FILE_PATH,'./'); 
define(PICTURE_DIRECTORY_PATH,'img/'); 

// gets parameters 
$images = substr($_GET['images'],0,5); 
$filename =$_GET['filename']; 
if ($filename == '') $filename = 'mail.eml'; 
$eml_file = EML_FILE_PATH.$filename; 
// opens file 
if (!($content = fread(fopen($eml_file, 'r'), filesize($eml_file)))) 
    die('File not found ('.$eml_file.')'); 

$separator="Content-Type:";
$aContent = explode($separator,$content); 
$aImages = array();
$boundary=''; 
foreach($aContent as $thisContent) { 
    if (strpos($thisContent,'text/html') !== false) { 
        // email HTML body 
        $thisContent='Content-Type: '.$thisContent;
        $thisContent = substr($thisContent,strpos($thisContent,'<!DOCTYPE')); 
        $thisHTMLContent = quoted_printable_decode($thisContent); 
        //echo "<hr>$thisHTMLContent<hr>\n\n"; 
    } 
    if(strpos($thisContent,'multipart/related;') !== false) { 
        // Boundary (numero para identificar las partes de las imagenes embebidas consultar que es exactamente)
        $boundary_arr = explode("--",substr($thisContent,(strpos($thisContent,'boundary=')+9)));
        $boundary="--".trim($boundary_arr[0]);  
    }
    if (strpos($thisContent,'image/gif;') !== false) { 
        $aThisImage=genera_imagen("gif", $thisContent);
        $aImages[] = $aThisImage; 
    } 
    if (strpos($thisContent,'image/jpeg;') !== false) { 
        $aThisImage=genera_imagen("jpeg", $thisContent);
        $aImages[] = $aThisImage; 
    } 
    if (strpos($thisContent,'image/png;') !== false) {
      //echo($thisContent."<hr>");
      $aThisImage=genera_imagen("png", $thisContent);
      $aImages[] = $aThisImage;
    } 
} 
foreach($aImages as $image) {
    if ($images == 'filed') { 
        // image file creation 
        if (!file_exists(PICTURE_DIRECTORY_PATH.$image['location'].$image['type'])) { 
            if (!$handle = fopen (PICTURE_DIRECTORY_PATH.$image['location'].$image['type'], "wb")) 
                     die("Cannot open file (".PICTURE_DIRECTORY_PATH.$image['location'].$image['type']); 
            if (!fwrite($handle, base64_decode($image['base64']))) 
                       die("Cannot write into file (".PICTURE_DIRECTORY_PATH.$image['location'].$image['type']); 
            fclose($handle); 
        } 
        $thisHTMLContent = str_replace('cid:'.$image['id'],PICTURE_DIRECTORY_PATH.$image['location'].$image['type'],$thisHTMLContent); 
    } 
    else { 
        // images to be created on the fly 
        $imageLocation = urlencode($image['location']); 
        $file = urlencode($eml_file); 
        $thisHTMLContent = str_replace('cid:'.$image['id'],'data:image/'.$image['type'].';base64,'.$image["base64"],$thisHTMLContent); 
    } 
     
    //$thisHTMLContent = preg_replace("/<IMG HEIGHT=(\d*)/i","<img ",$thisHTMLContent); 
    // no base href referring to local file 
    //$thisHTMLContent = preg_replace("/href=\"file(.*)\"/i","",$thisHTMLContent); 
} 
function genera_imagen($tipo,$thisContent){
  // base64 png picture 
  global $boundary;
      $begin = strpos($thisContent,'Content-ID: <') + 13; 
      $long = strpos(substr($thisContent,strpos($thisContent,'Content-ID: <') + 13),'>'); 
      $img_id = substr($thisContent,$begin,$long);
       
      $pos1=strpos($thisContent,'name="')+6;
      //se quitan los 6 caracteres del name=" y se restan los del .png"
      $pos2=strpos($thisContent,'.'.$tipo.'"')-strpos($thisContent,'name="')-6;
      $img_name = substr($thisContent,$pos1,$pos2);
      if (strpos($imagen,'Content-Location: ') !== false) {
          $img_location = substr($thisContent,strpos($thisContent,'Content-Location: ')+18); 
          $img_location = substr($img_location,0,strpos($img_location,'.'.$tipo)); 
          $searched = 'Content-Location: ' . $img_location . '.'.$tipo; 
          $img_base64 = substr($imagen,strpos($thisContent,$searched)+strlen($searched)); 
      } 
      else { 
          $img_location = $img_name;  
        
          $pos_end = strpos($thisContent,'X-Attachment-Id:');
          if($pos_end!==false){
            $pos_end=$pos_end+21;
          }           
          else{
            //die($thisContent);  
            $pos_end=strpos($thisContent,'Content-Transfer-Encoding:')+6;
          }
          $pos_end=$pos_end+strlen($img_id);
          $end_content = substr($thisContent,$pos_end); 
          $long_end=strpos($thisContent,$boundary)-2;
          $img_base64 = substr($end_content,0,($long_end-$pos_end-2)); 
      } 
      $aThisImage = array('id'=>$img_id, 'name'=>$img_name, 'location'=>$img_location, 'type'=>$tipo, 'boundary'=>$boundary, 'base64'=>$img_base64);
      return($aThisImage);
}
echo ($thisHTMLContent); 
?> 