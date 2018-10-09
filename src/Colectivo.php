<?php 
namespace TpFinal;
class Colectivo {
public $linea;    //lo pongo pubic nomas porque sino me falla el test
protected $empresa;
    public function __construct ( $linea, $empresa ){
    $this->linea = $linea;
    $this->empresa = $empresa;
    }
  
    public function get_linea(){
        return $this->linea;
    }
    public function get_empresa(){
        return $this->empresa;
    }
}
