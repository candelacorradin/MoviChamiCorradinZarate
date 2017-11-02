<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;
class BoletoTest extends TestCase {
  
  public function test_constructor(){
    $tarjeta = new Tarjeta( 1234, "Normal" );
    $cole = new Colectivo( "122 verde", "Semtur" );
    $b = new Boleto( $tarjeta, $cole );
    $this->assertEquals( $b->tar, $tarjeta );
    $this->assertEquals( $b->transporte, $cole );
    $this->assertEquals( $b->fecha, date( 'd-m-Y' ) );
    $this->assertEquals( $b->hora, date( 'H:i:s' ) );
  }
  public function test_get_boleto(){
      $tarjeta = new Tarjeta( 1234, "Normal" );
      $cole = new Colectivo( "122 verde", "Semtur" );
      $b = new Boleto( $tarjeta, $cole );
      $this->assertEquals( $b->get_boleto(), "FECHA: " . $b->fecha . "\nTIPO: Normal\nLINEA DE COLECTIVO: 122 verde\nSALDO: 0\nID: 1234" );
  }
  
}
