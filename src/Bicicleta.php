<?php
namespace TpFinal;
class Bicicleta {
  protected $EnUso;
  protected $fechaantbici;
  protected $id;
  
  public function __construct ($id) {
    $this->id=$id;
    $this->EnUso=false;
    $fec=new DateTime('now');
    $this->fechaantbici = $fec->format('Y\-m\-d\'');
    
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
