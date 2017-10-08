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
        $tarjeta->cargar(50);
        $this->assertEquals($tarjeta->getSaldo(),50);
    }
    public function testSaldoTresTresDos(){
        $tarjeta= new Tarjeta;
        $tarjeta->cargar(332);
        $this->assertEquals($tarjeta->getSaldo(),388);
    }
    public function testSaldoSeisDosCuatro(){
        $tarjeta= new Tarjeta;
        $tarjeta->cargar(624);
        $this->assertEquals($tarjeta->getSaldo(),776);
    }
}
