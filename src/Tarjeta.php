<?php
namespace TpFinal;
class Tarjeta {
protected $saldo;
    public function __construct(){
    $this->saldo=0;
    }
    public function saldo() {
        return 0;
    }
    public function getSaldo(){
        return $this->saldo;
    }
    
    public function cargar($monto){
      if($monto==332){
        $this->saldo+=388;
      }
      if($monto==624){
       $this->saldo+=776;   
      }
    else{    
    $this->saldo+=$monto;
    }
  }
}
?>
