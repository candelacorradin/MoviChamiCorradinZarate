<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;
class BicicletaTest extends TestCase {
    public function testgetId(){
        $bici= new Bicicleta(1);
        $this->assertEquals($bici->getId(),1);
    }
    public function testSubir(){
        $bici= new Bicicleta(1);
        $bici->Subir();
        $this->assertTrue($bici->EnUso);
    }
    public function testBajar(){
        $bici= new Bicicleta(2);
        $bici->Bajar();
        $this->assertFalse($bici->EnUso);
    }
}
