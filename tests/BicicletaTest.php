<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;
class BicicletaTest extends TestCase {
    public function testGetid(){
        $bici= new Bicicleta(1);
        $this->assertEquals($bici->getId(),1);
    }
    public function testSubir(){
        $bici= new Bicicleta(1);
        $bici->Subir();
        $this->assertTrue($bici->EnUso);
    }


}
