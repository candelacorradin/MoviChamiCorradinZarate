<?php
namespace TpFinal;
use PHPUnit\Framework\TestCase;
class BicicletaTest extends TestCase {
    public function testgetId(){
     $bici= new Bicicleta(1);
     $this->assertEquals($bici->getId(),1);
    }}
