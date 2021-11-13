<?php

class PDBErr extends Exception{
	#Library check
	public function CHECKLIBSNAME(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library name';
    return $errorMsg;
	}
	public function CHECKLIBSVERSION(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library version';
    return $errorMsg;
	}
	public function CHECKLIBSAPI(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library API';
    return $errorMsg;
	}
	public function CHECKLIBSSL(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library SSL';
    return $errorMsg;
	}
	public function CHECKLIBSLICENCE(){
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> is not a valid Library licence';
    return $errorMsg;
	}
	
	
	
	
}


?>