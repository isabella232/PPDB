<?php

class PPDBErr extends Exception{
	#Library check
	public function CHECKLIBSNAME(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library name(string)';
    return $errorMsg;
	}
	public function CHECKLIBSVERSION(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library version(string)';
    return $errorMsg;
	}
	public function CHECKLIBSAPI(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library API(string)';
    return $errorMsg;
	}
	public function CHECKLIBSSL(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library SSL(boolean)';
    return $errorMsg;
	}
	public function CHECKLIBSLICENCE(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library licence(string)';
    return $errorMsg;
	}
	public function CONNECT_ERR(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> cannot connect to server';
    return $errorMsg;
	}
	public function isNotNumber(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a number';
    return $errorMsg;
	}
	public function isNotString(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a string';
    return $errorMsg;
	}
	public function isNotBoolean(){
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> must be a boolean';
    return $errorMsg;
	}
	
	
	
}


?>