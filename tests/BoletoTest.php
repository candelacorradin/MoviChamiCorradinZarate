<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;
class BoletoTest extends TestCase {
  
  public function testConstructor(){
    $tarjeta = new Tarjeta(1234,"Normal");
    $cole = new Colectivo("122 verde","Semtur");
    $b = new Boleto($tarjeta,$cole);
    $this->assertEquals($b->tar,$tarjeta);
    $this->assertEquals($b->transporte,$cole);
    $this->assertEquals($b->fecha,date('d-m-Y'));
    $this->assertEquals($b->hora,date('H:i:s'));
  }
  public function testgetBoleto(){
      $tarjeta = new Tarjeta(1234,"Normal");
      $cole = new Colectivo("122 verde","Semtur");
      $b = new Boleto($tarjeta,$cole);
      $this->assertEquals($b->getBoleto(), "FECHA: " . $b->fecha . "\nTIPO: Normal\nLINEA DE COLECTIVO: 122 verde\nSALDO: 0\nID: 1234");
  }
  
}
