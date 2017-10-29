<?php 
namespace TpFinal;
class Colectivo {
protected $linea;
protected $empresa;
  public function __construct ($linea,$empresa){
    $this->linea = $linea;
    $this->empresa = $empresa;
  }
  
}
