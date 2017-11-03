<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;
class BicicletaTest extends TestCase {
    public function test_get_id(){
        $bici = new Bicicleta( 1 );
        $this->assertEquals( $bici->get_id(), 1 );
    }
    public function test_subir(){
        $bici= new Bicicleta( 1 );
        $bici->subir();
        $this->assertTrue( $bici->en_uso );
    }
    public function test_bajar(){
        $bici= new Bicicleta( 2 );
        $bici->bajar();
        $this->assertFalse( $bici->en_uso );
    }
}
