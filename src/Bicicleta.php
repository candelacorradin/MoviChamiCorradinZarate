<?php
namespace TpFinal;
class Bicicleta {
  public $EnUso;
  public $id;
  
  public function __construct ($id) {
    $this->id=$id;
    $this->EnUso=false;
      
  }
  
  public function getId(){
    return $this->id;
  }
    
  public function Subir(){
    $this->EnUso=true;
  }
  
  public function Bajar(){
    $this->EnUso=false;
  }
}
