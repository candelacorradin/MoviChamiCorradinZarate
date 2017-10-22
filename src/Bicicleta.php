<?php
namespace TpFinal;
class Bicicleta {
  protected $EnUso;
  protected $HoraDeSubida;
  protected $id;
  
  public function __construct ($id) {
    $this->id=$id;
    $this->EnUso=false;
  }
    
  public function Subir {
    $this->EnUso=true;
  }
  
  public function Bajar {
    $this->EnUso=false;
  }
}
