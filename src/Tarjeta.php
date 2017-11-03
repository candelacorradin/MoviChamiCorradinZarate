<?php
namespace TpFinal;
class Tarjeta {
	public $saldo;      //lo pongo public nomas porque sino  falla el test
	public $saldo_acumulado; //lo pongo public nomas porque sino  falla el test
	public $id;     //lo pongo public nomas porque sino  falla el test
	public $fechaanterior;
	protected $diaanterior;
	public $tipo;       //lo pongo public nomas porque sino  falla el test
	public $fechatras;
	protected $diasemana;
	protected $linea_anterior;
	public $fechaantbici;
	public function __construct( $id, $tipotarjeta ){
		$this->saldo = 0;
		$this->id = $id;
		$this->tipo = $tipotarjeta;
		$this->saldo_acumulado = 0;
		$this->fechaanterior = new \DateTime( "now" );
		$this->fechaantbici = NULL;
		$this->linea_anterior = NULL;
	}
	public function saldo() {
		return 0;
	}
	public function get_saldo(){
		return $this->saldo;
	}
	public function get_id(){
		return $this->id;   
	}
	public function get_tipo(){
		return $this->tipo;   
	}
	public function cargar( $monto ){
		if( 332 == $monto ){
			$this->saldo += 388;
		} elseif( 624 == $monto ){
			$this->saldo += 776;   
		} else{    
			$this->saldo += $monto;
		}
	}
	public function viaje( $transporte ){ 
		if( (is_a( $transporte, 'TpFinal\Colectivo' )) ){
			$this->fechatras = new \DateTime ("now");
			$this->diasemana = date( 'N' );
			$h = date( 'G' );
			$diff = ( $this->fechaanterior )->diff( $this->fechatras );
			if( $this->linea_anterior != $transporte->linea ){
				if( is_null( $this->linea_anterior ) ){
				//es el primer viaje que hace
				$this->linea_anterior = $transporte->linea;
				if ( "Medio" == $this->tipo ){
				$this->linea_anterior = $transporte->linea;
				$this->medio( $transporte );
					return;
				} else{
					$this->linea_anterior = $transporte->linea;
					$this->normal( $transporte );
					return;
				}		
			}
			if ( ( $this->diasemana < 6 ) && ( $h >=6 && $h <= 22 ) && ( ( ( $diff->h ) * 60 ) + $diff->i ) <= 60 )  {
					$this->trasbordo( $transporte );
				} elseif ( ( 6 == $this->diasemana ) && ( ( ( $h >=6 && $h <= 14 ) && ( ( ( $diff->h ) * 60 ) + $diff->i ) <= 60 ) || ( ( $h >= 14 && $h < 22 ) && ( ( ( $diff->h ) * 60 ) + $diff->i ) <= 90 ) ) ){
					$this->trasbordo( $transporte );
				} elseif( ( 7 == $this->diasemana ) && ( $h >= 6 && $h <= 22 ) && ( ( ( ( $diff->h ) * 60 ) + $diff->i ) <= 90 ) ) {
					$this->trasbordo( $transporte );	
				} elseif ( ( $h <= 6 || $h >= 22 ) && ((( $diff->h ) * 60 ) + $diff->i ) <= 90 ) {
					$this->trasbordo( $transporte );
				}
			} else {
				if ( "Medio" == $this->tipo ){
					$this->linea_anterior = $transporte->linea;
					$this->medio( $transporte );
				} else{
					$this->linea_anterior = $transporte->linea;
					$this->normal( $transporte );
				}
			}
		}
		if( is_a( $transporte, 'TpFinal\Bicicleta' ) ) {
			$this->viaje_bici( $transporte );
		}
	}
	public function normal( $transporte ){
		$p  = $this->saldo - $this->saldo_acumulado - 9.70;
		if( $p<0 ) {
			$this->viaje_plus( $transporte );
		} else {
			$this->saldo = $p;
			$this->saldo_acumulado = 0;
			$this->fechaanterior = $this->fechatras;
			$this->diaanterior = $this->diasemana;
			$this->linea_anterior = $transporte->linea;
			$b=new Boleto( $this, $transporte );
			$b->get_boleto();
		}
	}
	public function medio( $transporte ){
		$p  = $this->saldo - $this->saldo_acumulado - 4.35;
		if( $p<0 ) {
			$this->viaje_plus( $transporte );
		} else {
			$this->saldo = $p;
			$this->saldo_acumulado = 0;
			$this->fechaanterior = $this->fechatras;
			$this->diaanterior = $this->diasemana;
			$this->linea_anterior = $transporte->linea;
			$b=new Boleto( $this, $transporte );
			$b->get_boleto();
		}
	}
	public function trasbordo ( $transporte ) {
		if ( "Medio" == $this->tipo ){
			$p  = $this->saldo - $this->saldo_acumulado - 1.60;
		} else {
			$p  = $this->saldo - $this->saldo_acumulado - 3.20;
		}
		if( $p<0 ) {
			echo "No tiene saldo suficiente para pagar trasbordo. Se realizará un viaje plus";
			$this->viajeplus( $transporte );
		} else{
			$this->saldo = $p;
			$this->saldo_acumulado = 0;
			$this->fechaanterior = $this->fechatras;
			$this->diaanterior = $this->diasemana;
			$this->linea_anterior = $transporte->linea;
			$b=new Boleto( $this, $transporte );
			$b->get_boleto();
		}
		
	}
	public function viaje_plus( $transporte ) {
		if( $this->saldo_acumulado < ( 9.70*2 ) ){
			$this->saldo_acumulado = $this->saldo_acumulado + 9.70;
			$this->fechaanterior = $this->fechatras;
			$this->diaanterior = $this->diasemana;
			$this->linea_anterior = $transporte->linea;
			$b=new Boleto( $this, $transporte );
			$b->get_boleto();
		} else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";
		}
	}
	public function viaje_bici( $transporte ){
		$fecha = new \DateTime( "now" );
		if ( is_null( $this->fechaantbici ) ) {
			//esto es cuando viaja por primera vez ever
			$this->saldo = $this->saldo - 12.45;
			$this->fechaantbici = new \DateTime( 'now' );
		} elseif( 0 != ( ( $fecha->diff( $this->fechaantbici ) )->d) ){
			$this->saldo = $this->saldo - 12.45;
			$this->fechaantbici = new \DateTime( 'now' );
		}
		$b=new Boleto( $this, $transporte );
		$b->get_boleto();   
	}
}
