<?php 
namespace TpFinal;
class Colectivo {
protected $linea;
protected $empresa;
  public function __construct ($linea,$empresa){
    $this->linea = $linea;
    $this->empresa = $empresa;
  }
  
  public function getLinea(){
   return $this->linea; 
  }
  public function getEmpresa(){
  return $this->empresa; 
  }
}
