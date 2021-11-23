<?php

class PPDBErr extends Exception{
	#Library check
	public function CHECKLIBSNAME(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library name(string)<br/>';
    return $errorMsg;
	}
	public function CHECKLIBSVERSION(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library version(string)<br/>';
    return $errorMsg;
	}
	public function CHECKLIBSAPI(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library API(string)<br/>';
    return $errorMsg;
	}
	public function CHECKLIBSSL(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library SSL(boolean)<br/>';
    return $errorMsg;
	}
	public function CHECKLIBSLICENCE(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library licence(string)<br/>';
    return $errorMsg;
	}
	public function CONNECT_ERR(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> cannot connect to server<br/>';
    return $errorMsg;
	}
	public function isNotNumber(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a number<br/>';
    return $errorMsg;
	}
	public function isNotString(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a string<br/>';
    return $errorMsg;
	}
	public function isNotBoolean(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a boolean<br/>';
    return $errorMsg;
	}
	public function isNotAlign(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a JUSTIFY, LEFT, CENTER, RIGHT<br/>';
    return $errorMsg;
	}
	public function isNotArray(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a array<br/>';
    return $errorMsg;
	}
	public function noOpenSSL(){
		$errorMsg = $this->getMessage();
    return $errorMsg;
	}
	public function fileNotFound(){
			$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> file does not exist<br/>';
    return $errorMsg;
	}
	public function isNotRenamed(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> cannot be renamed<br/>';
    return $errorMsg;
	}
	
	
	
	
	
}


?>
