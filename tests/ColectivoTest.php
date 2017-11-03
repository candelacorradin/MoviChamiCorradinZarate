<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {
  
  public function test_linea_y_empresa(){
    $cole= new Colectivo( "122 verde", "Semtur" );
    $this->assertEquals( $cole->get_linea(), "122 verde" );
    $this->assertEquals( $cole->get_empresa(), "Semtur" );
  }
}
