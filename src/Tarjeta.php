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
    
    public function cargarCincuenta($monto){
    $this->saldo+=$monto; 
    }
}
