<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testSaldoCero() {
        $tarjeta = new Tarjeta;
        $this->assertEquals($tarjeta->saldo(), 0);
    }
    public function testSaldoCincuenta(){
        $tarjeta= new Tarjeta;
        $tarjeta->cargarCincuenta(50);
        $this->assertEquals($tarjeta->getSaldo(),50);
    }
}
