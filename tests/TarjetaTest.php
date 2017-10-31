<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testIdNormal(){
     $tarjeta = new Tarjeta(1234,"Normal");
     $this->assertEquals($tarjeta->getId(),1234);
     $this->assertEquals($tarjeta->getTipo(),"Normal");
        
    }
    public function testSaldoCeroMedio() {
        $tarjeta = new Tarjeta(1234,"Medio");
        $this->assertEquals($tarjeta->saldo(), 0);
        $this->assertEquals($tarjeta->getTipo(),"Medio");
    }
    public function testSaldoCincuenta(){
        $tarjeta = new Tarjeta(1234,"Normal");
        $tarjeta->cargar(50);
        $this->assertEquals($tarjeta->getSaldo(),50);
    }
    public function testSaldoTresTresDos(){
        $tarjeta = new Tarjeta(1234,"Normal");
        $tarjeta->cargar(332);
        $this->assertEquals($tarjeta->getSaldo(),388);
    }
    public function testSaldoSeisDosCuatro(){
        $tarjeta = new Tarjeta(1234,"Normal");
        $tarjeta->cargar(624);
        $this->assertEquals($tarjeta->getSaldo(),776);
    }
    public function testViajeColectivoNormal{
        $tarjeta = new Tarjeta(1234, "Normal");
        $tarjeta->cargar(40);
        protected $carga = 40;
        $colectivo = new Colectivo ("120", "Semtur");
        $tarjeta->viaje ($colectivo);
        $this->assertEquals($tarjeta->getSaldo(), $this->carga-9.70);
    }
    public function testViajeColectivoMedio{
        $tarjeta = new Tarjeta(1234, "Medio");
        $tarjeta->cargar(40);
        protected $carga = 40;
        $colectivo = new Colectivo ("120", "Semtur");
        $tarjeta->viaje ($colectivo);
        $this->assertEquals($tarjeta->GetSaldo(), $this->carga-4.35);
    }
    public function testViajeColectivoMedioPlus{
        $tarjeta = new Tarjeta(1234, "Medio");
        $colectivo = new Colectivo ("120", "Semtur");
        $tarjeta->viaje ($colectivo);
        $this->assertEquals($tarjeta->saldoAcumulado, 9.70);
    }
    public function testViajeColectivoNormalPlus{
        $tarjeta = new Tarjeta(1234, "Normal");
        $colectivo = new Colectivo ("120", "Semtur");
        $tarjeta->viaje ($colectivo);
        $this->assertEquals($tarjeta->saldoAcumulado, 9.70);
    }
}
