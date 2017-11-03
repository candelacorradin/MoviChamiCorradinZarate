<?php 
namespace TpFinal;
class Colectivo {
public $linea;    //lo pongo pubic nomas porque sino me falla el test
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
