<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function test_id_normal(){
     $tarjeta = new Tarjeta( 1234, "Normal" );
     $this->assertEquals( $tarjeta->get_id(), 1234 );
     $this->assertEquals( $tarjeta->get_tipo(), "Normal" );
        
    }
    public function test_saldo_cero_medio() {
        $tarjeta = new Tarjeta( 1234, "Medio" );
        $this->assertEquals( $tarjeta->saldo(), 0 );
        $this->assertEquals( $tarjeta->get_tipo(), "Medio" );
    }
    public function test_saldo_cincuenta(){
        $tarjeta = new Tarjeta(1234,"Normal");
        $tarjeta->cargar( 50 );
        $this->assertEquals( $tarjeta->get_saldo(), 50 );
    }
    public function test_saldo_tres_tres_dos(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 332 );
        $this->assertEquals( $tarjeta->get_saldo(), 388 );
    }
    public function test_saldo_seis_dos_cuatro(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 624 );
        $this->assertEquals( $tarjeta->get_saldo(), 776 );
    }
    public function test_dos_viajes(){
            $tarjeta = new Tarjeta( 1234, "Normal" );
            $colectivo = new Colectivo ( "120", "Semtur" );
            $tarjeta->cargar( 50 );
            $tarjeta->viaje( $colectivo );
            $tarjeta->viaje( $colectivo );
            $this->assertEquals( $tarjeta->get_saldo(), 30.6 );    
    }
    public function test_viaje_tras_amigue(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal, ahora el saldo tiene que ser 30.3
        $this->assertEquals( $tarjeta->get_saldo(), 30.3 );
        $fecha = new \DateTime( "now" );
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->get_saldo(), 27.1 );
        //hizo trasbordo
        $tarjeta->viaje( $colectivo2 ); //le paga al otre
        $this->assertEquals( $tarjeta->get_saldo(), 17.4 );
    }
    
    public function test_trasbordo(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal, ahora el saldo tiene que ser 30.3
        $this->assertEquals( $tarjeta->get_saldo(), 30.3 );
        $fecha = new \DateTime( "now" );
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->get_saldo(), 27.1 );
        //hizo trasbordo
    }
    public function test_viaje_colectivo_normal(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $tarjeta->viaje( $colectivo );
        $this->assertEquals( $tarjeta->get_saldo(), 30.3 );
    }
    public function test_viaje_colectivo_medio(){
        $tarjeta = new Tarjeta( 1234, "Medio" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $tarjeta->viaje( $colectivo );
        $this->assertEquals( $tarjeta->get_saldo(), 40-4.35 );
    }
    public function test_viaje_colectivo_medio_plus(){
        $tarjeta = new Tarjeta( 1234, "Medio" );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $tarjeta->viaje( $colectivo );
        $this->assertEquals( $tarjeta->saldo_acumulado, 9.70 );
    }
    public function test_viaje_colectivo_normal_plus(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $tarjeta->viaje( $colectivo );
        $this->assertEquals( $tarjeta->saldo_acumulado, 9.70 );
    }
    public function test_viaje_bici() {
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $bici = new Bicicleta( 456 );
        $tarjeta->viaje( $bici );
        $this->assertEquals( $tarjeta->get_saldo(), 27.55 );
    }
    public function test_alquilar_varias_veces(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $bici = new Bicicleta ( 120 );
        $bici2 = new Bicicleta ( 121 );
        $tarjeta->viaje( $bici );
        //hizo un viaje normal, ahora el saldo tiene que ser 27.55
        $this->assertEquals( $tarjeta->get_saldo(), 27.55 );
        $fecha = new \DateTime( "now" );
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $bici2 );
        //el saldo no tiene que cambiar ya que es el mismo dia
        $this->assertEquals( $tarjeta->get_saldo(), 27.55 );
    }
    public function test_tras_medio(){
        $tarjeta = new Tarjeta( 1234, "Medio" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal, ahora el saldo tiene que ser 40-4.35
        $this->assertEquals( $tarjeta->get_saldo(), 40-4.35 );
        $fecha = new \DateTime( "now" );
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->get_saldo(), (40-4.35)-1.6 );
        //hizo trasbordo
    }
    public function test_dos_viajes_medio(){
            $tarjeta = new Tarjeta( 1234, "Medio" );
            $colectivo = new Colectivo ( "120", "Semtur" );
            $tarjeta->cargar( 50 );
            $tarjeta->viaje( $colectivo );
            $tarjeta->viaje( $colectivo );
            $this->assertEquals( $tarjeta->get_saldo(), 50-( 4.35*2 ) );
    }
    public function test_tras_a_plus(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar(10);
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal
        $this->assertEquals( $tarjeta->get_saldo(), 0.3 );
        $fecha = new \DateTime( "now" );
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->saldo_acumulado, 9.7 );
    }
    public function test_plus_gastados(){
     $tarjeta = new Tarjeta( 123, "Normal" );
     $cole = new Colectivo( "122", "semtur" );
     $tarjeta->saldo_acumulado = 9.70*2;
     $this->assertEquals( $tarjeta->viaje_plus($cole), "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta." );
    }
    public function test_tras_sabado(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal, ahora el saldo tiene que ser 30.3
        $this->assertEquals( $tarjeta->get_saldo(), 30.3 );
        $fecha = new DateTime('2017-11-04 10:00:00');
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->get_saldo(), 27.1 );
        //hizo trasbordo
    }
    public function test_tras_domingo(){
        $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal, ahora el saldo tiene que ser 30.3
        $this->assertEquals( $tarjeta->get_saldo(), 30.3 );
        $fecha = new DateTime('2017-11-05 10:00:00');
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->get_saldo(), 27.1 );
        //hizo trasbordo
    }
    public function test_tras_nocturno(){
     $tarjeta = new Tarjeta( 1234, "Normal" );
        $tarjeta->cargar( 40 );
        $colectivo = new Colectivo ( "120", "Semtur" );
        $colectivo2 = new Colectivo ( "121", "Semtur" );
        $tarjeta->viaje( $colectivo );
        //hizo un viaje normal, ahora el saldo tiene que ser 30.3
        $this->assertEquals( $tarjeta->get_saldo(), 30.3 );
        $fecha = new DateTime('2017-11-04 03:00:00');
        $tarjeta->fechaanterior = $fecha->sub( new \DateInterval( 'PT0H1800S' ) );
        $tarjeta->viaje( $colectivo2 );
        $this->assertEquals( $tarjeta->get_saldo(), 27.1 );
        //hizo trasbordo   
    }
}
