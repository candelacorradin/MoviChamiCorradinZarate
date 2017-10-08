<?php
namespace TpFinal;
class Tarjeta {
protected $saldo;
protected $id;
    public function __construct($id){
    $this->saldo=0;
    $this->id=$id;
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
      elseif($monto==624){
       $this->saldo+=776;   
      }
    else{    
    $this->saldo+=$monto;
    }
  }
}
?>
