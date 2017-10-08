<?php

namespace TpFinal;

class Tarjeta {
protected $saldo;
    public function saldo() {
        return 0;
    }
    public function cargar($monto){
    $this->saldo+=$monto;
    }
}
