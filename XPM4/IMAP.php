<?php
/**
 * LICENSE: The MIT License
 * Copyright (c) 2010 Chris Nizzardini (http://www.cnizz.com) 
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 * largely a wrapper class for php imap functions but since the classes on phpclasses.org are so shitty here we go....
 * @see http://www.php.net/manual/en/book.imap.php
 * @uses imap_mailboxmsginfo
 * @uses imap_headers
 * @uses imap_list
 * @uses imap_headerinfo
 */
class Imap
{
	private $stream;
	private $mbox;
	private $is_connected = 0;
	private $host;
	private $username;
	private $password;
	private $folder;
	private $port;
	private $tls;
	
	function __construct($host,$username,$password,$folder='INBOX',$port=143,$tls='notls')
	{
		$this->mbox = '{'.$host.':'.$port.'/'.$tls.'}'.$folder;
		$this->folder=$folder;
		$this->stream = imap_open($this->mbox,$username,$password);
		if($this->stream != false){
			$this->is_connected = 1;
		}
	}
	/**
	 * change_folder - Cambia la carpeta activa
	 * creada por cerok
	 */
	function change_folder($host,$folder,$port=143,$tls='notls')
	 {$this->folder=$folder;
    $this->mbox = '{'.$host.':'.$port.'/'.$tls.'}'.$folder;
    imap_reopen($this->stream,$this->mbox) or die(implode(", ", imap_errors()));
   }
	/**
	 * returnImapMailBoxmMsgInfoObj - Obtener informaci�n sobre el buz�n actual
	 * @see http://www.php.net/manual/en/function.imap-mailboxmsginfo.php
	 * @param void
	 * @return object
	 */
	public function returnImapMailBoxmMsgInfoObj(){
		return imap_mailboxmsginfo($this->stream);
	}
	
	/**
	 * returnMailBoxHeaderArr - Arreglo con los encabezados de la carpeta para todos los emails 
	 * @param void
	 * @return array
	 */
	public function returnMailBoxHeaderArr()
	{
		$array = array();
		$arr = $this->returnImapHeadersArr();
		if(is_array($arr)){
			foreach($arr as $i){
				$i = trim($i);
				// check for unread emails
				if(substr($i,0,1) == 'U'){
					$i = substr($i,1,strlen($i));
				}
				$i = trim($i);				
				// display if not pending deletion
				if(substr($i,0,1) != 'D'){
					$position = strpos($i,')');
					$msgno = substr($i,0,$position);
					$array[] = $this->returnEmailHeaderArr($msgno);
				}
			}
		}
		return $array;
	}
	
	/**
	 * returnMailboxListArr - Lista de las carpetas del correo
	 * @see http://www.php.net/manual/en/function.imap-list.php
	 * @param void
	 * @return array
	 */	
	public function returnMailboxListArr(){
		$retorno=imap_list($this->stream,$this->mbox,'*');
		foreach($retorno AS $key=>$value){
      $retorno[$key]=imap_utf7_decode(str_replace($this->mbox,"",$value));                                      
    }
    return($retorno);
	}
	
	/**
	 * returnEmailHeaderArr - Lista de la informacion completa de los encabezados del mensaje $messageNumber
	 * This returns detailed header information for the given message number
	 * @param messageNumber
	 * @return array
	 */
	public function returnEmailHeaderArr($messageNumber)
	{
		$head = $this->returnHeaderInfoObj($messageNumber);
		$array['date'] = $head->date;
		$array['subject'] = imap_mime_header_decode($head->subject);
		$array['to'] = $head->toaddress;
		$array['cc'] = $head->ccaddress;
		$array['bcc'] = $head->bccaddress;
		$array['message_id'] = $head->message_id;
		$array['from'] = $head->from[0]->mailbox.'@'.$head->from[0]->host;
		$array['sender'] = $head->sender[0]->mailbox.'@'.$head->sender[0]->host;
		$array['reply_toaddress'] = $head->reply_toaddress;
		$array['size'] = $head->Size;
		$array['msgno'] = $head->Msgno;
		
		if($head->Unseen == 'U'){
			$array['status'] = 'Unread';
		}
		else{
			$array['status'] = 'Read';
		}
		return $array;
	}
	
	/**
	 * returnEmailMessageArr - Muestra el mensaje completo con encabezados, parte plana, html, adjuntos (solo enunciados no envia el contenido del adjunto) en un Arreglo
	 * This returns the entire email for the given message number
	 * @param unknown_type $messageNumber
	 * @return array
	 * @example array('header'=>object,'plain'=>'','html'=>'','attachment'=>array());
	 */
	public function returnEmailMessageArr($messageNumber)
	{
		$array = array();
		$inline=array();
		$o = $this->returnMessageStructureObj($messageNumber);
		if(is_object($o))
		{
			$array['header'] = $this->returnEmailHeaderArr($messageNumber);
			if(is_array($o->parts))
			{ // first build plain and/or html part of array
				foreach($o->parts as $x => $i)
				{
					if(is_array($i->parts))
					{
						foreach($i->parts as $j => $k)
						{
							if($k->subtype == 'PLAIN'){
								$array['plain'] = imap_qprint($this->returnBodyStr($messageNumber,'1.1'));
								$array["body_charset"]=$k->parameters[0]->value;
							}
							else if($k->subtype == 'HTML'){
								$array['html'] = imap_qprint($this->returnBodyStr($messageNumber,'1.2'));
								$array["body_charset"]=$k->parameters[0]->value;
							}
							elseif(strtolower($k->disposition)== 'inline')
							 {$inline++;
								$array['inline'][] = array('type'=>$k->subtype,'bytes'=>$k->bytes,'name'=>$k->parameters[0]->value,'part'=>"2.".($j+1),'msgno'=>$messageNumber);            
							 }
             /*elseif(strtolower($k->disposition)== 'attachment')
							 {$attachments++;
								$array['attachments'][] = array('type'=>$k->subtype,'bytes'=>$k->bytes,'name'=>$k->parameters[0]->value,'part'=>"2",'msgno'=>$messageNumber);
							 }  */
						}
					}
					else{
						if($i->subtype == 'PLAIN'){
							$array['plain'] = imap_qprint($this->returnBodyStr($messageNumber,'1'));
							$array["body_charset"]=$i->parameters[0]->value;
						}
						else if($i->subtype == 'HTML'){
							$array['html'] = imap_qprint($this->returnBodyStr($messageNumber,'2'));
							$array["body_charset"]=$i->parameters[0]->value;
						}
						else if(strtolower($i->disposition) == 'attachment'){
							$attachments++;
							$array['attachments'][] = array('type'=>$i->subtype,'bytes'=>$i->bytes,'name'=>$i->parameters[0]->value,'part'=>"2");
						}
  					 else if($i->disposition == 'INLINE'){
								$inline++;
								$array['inline'][] = array('type'=>$i->subtype,'bytes'=>$i->bytes,'name'=>$i->parameters[0]->value,'part'=>($x+1),'msgno'=>$messageNumber);
							}		
					}
				}
				
				if($attachments > 1){
					$array['attachments'] = array();
					foreach($o->parts as $x => $i)
					{ 
						if(strtolower($i->disposition) == 'attachment')
						{
							$part = $x+1;
							$array['attachments'][] = array('type'=>$i->subtype,'bytes'=>$i->bytes,'name'=>$i->parameters[0]->value,'part'=>$part,'msgno'=>$messageNumber);
						}
					}
				}
			}
			// simple plain text email
			else if($o->subtype == 'PLAIN'){
			  if($o->type<>0)
				  $array["body_charset"]=$o->parameters[0]->value;
				$array['plain'] = imap_qprint($this->returnBodyStr($messageNumber,'1'));
			}
			else{
				$array['error'][] = 'Error encountered parsing email';
			}
		}
		else{ // report error
			
		}
		return $array;
	}
	
	/**
	 * saveAttachment - Retorna la ruta donde queda almacenado el adjunto del mensaje $messageNumber y vinculado con la parte $part si se desean almacenar todos los adjuntos ver saveAllAttachment
	 * @param messageNumber(int),part(str),saveToFile(str),path(str)
	 * @example saveToFile = '/var/www/attachment/myAttachement' (do not include an extension i do this for you at return!)
	 * @return string
	 */
	public function saveAttachment($messageNumber,$part,$saveToFile="",$path="")
	{
		$arr = $this->returnEmailMessageArr($messageNumber,1);
		if(is_array($arr['attachments']))
		{
			foreach($arr['attachments'] as $i){
				if($i['part'] == $part){
				  if($saveToFile==""){
            $saveToFile=$i['name'];
          }
          else{
					 $extensionArr = explode('.',$i['name']);
					 $extension = $extensionArr[(count($extensionArr) - 1)];
					 $saveToFile.='.'.$extension;
					}
					if($path=="")
					  $path=getcwd();
					$file = $path."/".$saveToFile;
					$f = fopen($file,'w+');			
					fwrite($f,base64_decode($this->returnBodyStr($messageNumber,$part)));
					fclose($f);
					/*$f = fopen($file,'r');
					fread($f,filesize($file));*/
					return $file;
				}
			}
		}
		return '';
	}
	/**
	 * saveAllAttachment - Retorna la ruta donde quedan almacenados los adjuntos del mensaje $messageNumber en una cadena separada por comas
	 * @param messageNumber(int),part(str),saveToFile(str)
	 * @example saveToFile = '/var/www/attachment/myAttachement' (do not include an extension i do this for you at return!)
	 * @return string
	 */	
  public function saveAllAttachment($messageNumber,$saveToFile="",$path=""){
		$arr = $this->returnEmailMessageArr($messageNumber,1);
		if(is_array($arr['attachments'])){
			if($path=="")
			  $path=getcwd();
			foreach($arr['attachments'] as $i){
				  if($saveToFile==""){
            $saveFile=$i['name'];
          }
          else{
					 $extensionArr = explode('.',$i['name']);
					 $extension = $extensionArr[(count($extensionArr) - 1)];
           $saveFile.=$saveToFile.'_'.$i.'.'.$extension;
					}
				$file = $path."/".$saveFile;
				$f = fopen($file,'w+');
				fwrite($f,base64_decode($this->returnBodyStr($messageNumber,$part)));
				fclose($f);
				/*$f = fopen($file,'r');
				fread($f,filesize($file));*/
				array_push($retorno,$file);
			}
		  return(implode(",",$retorno));  
    }
		return '';
	}	
	public function get_is_connected(){
		return $this->is_connected;
	}
	public function get_mbox(){
		return $this->mbox;
	}	
	public function get_host(){
		return $this->host;
	}
	public function get_username(){
		return $this->username;
	}	
	public function get_password(){
		return $this->password;
	}
	public function get_folder(){
		return $this->folder;
	}	
	public function get_port(){
		return $this->port;
	}
	public function get_tls(){
		return $this->tls;
	}	
	public function get_stream(){
		return $this->stream;
	}
	
	// METHODS BELOW ARE PRIVATE - YOU CAN CHANGE THESE TO PUBLIC IF NEED BE - BUT THE ABOVE METHODS SHOULD GIVE YOU EVERYTHING YOU NEED
	
	/**
	 * returnHeaderInfoObj
	 * @see http://www.php.net/manual/en/function.imap-headerinfo.php
	 * @param void
	 * @return object
	 */
	public function returnHeaderInfoObj($messageNumber){
		return @imap_headerinfo($this->stream,$messageNumber);
	}
	
	/**
	 * returnMessageStructureObj
	 * @see http://www.php.net/manual/en/function.imap-fetchstructure.php
	 * @param unknown_type $messageNumber
	 * @return object
	 */
	public function returnMessageStructureObj($messageNumber){
		return imap_fetchstructure($this->stream,$messageNumber);
	}
	
	/**
	 * returnRawMessageBodyStr
	 * @see http://www.php.net/manual/en/function.imap-body.php
	 * @param unknown_type $messageNumber
	 * @return string
	 */
	public function returnRawBodyStr($messageNumber){
		return imap_body($this->stream,$messageNumber);
	}
	
	/**
	 * returnImapHeadersArr - returns general info on emails in this box
	 * @see http://www.php.net/manual/en/function.imap-headers.php
	 * @param void
	 * @return array
	 */
	public function returnImapHeadersArr(){
		return imap_headers($this->stream);
	}
	
	/**
	 * returnMessageBodyStructureObj
	 * @see http://www.php.net/manual/en/function.imap-bodystruct.php
	 * @param $messageNumber(int),part(int)
	 * @return object
	 */
	public function returnBodyStructureObj($messageNumber,$part){
		return imap_bodystruct($this->stream,$messageNumber,$part);
	}
	
	/**
	 * returnBodyStr
	 * @see http://www.php.net/manual/en/function.imap-fetchbody.php
	 * @param $messageNumber(int),part(int)
	 * @return string
	 */
	public function returnBodyStr($messageNumber,$section){
		$dato=imap_fetchbody($this->stream,$messageNumber,$section);
    return $dato;
	}
}
?>