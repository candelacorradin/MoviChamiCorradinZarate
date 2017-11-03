<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {
  
  public function testLineaYEmpresa(){
    $cole= new Colectivo("122 verde","Semtur");
    $this->assertEquals($cole->getLinea(),"122 verde");
    $this->assertEquals($cole->getEmpresa(),"Semtur");
  }
}
