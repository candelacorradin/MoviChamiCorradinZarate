<?php

namespace TpFinal;
class Boleto{
	
	protected $fecha;
	protected $hora;
	protected $tipoboleto;
	protected $saldo;
	protected $saldoAcumulado;
	protected $linea;
	protected $id_tarj;
	protected $fechaantbici = " ";
	public function __construct(Tarjeta $tar, $tipoboleto, $linea, $saldoac = 0){
		$fec=new DateTime('now');
		$this->fecha = $fec->format('Y\-m\-d\'');
		$this->tar->tipoboleto= $t;
		$this->hora = $fec->format('H:i:s');
		$this->tar->saldoAcumulado = $saldoac;
		$this->linea = $linea;
	}

	public getBoleto(){
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipoboleto. "\nLINEA DE COLECTIVO: ". $this->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id_tarj;

	}
	
	public function Normal(){
		$p  = $this->saldo - $this->saldoAcumulado - 9.70;
		if($p<0){
			$this->ViajePlusNormal();
		}
		else{
			$this->saldo = $p;
			$this->saldoAcumulado = 0;
		}
		$this->fechaanterior=$this->fecha;
		$this->horaanterior=$this->hora;
	}
	public function Medio(){
		$p  = $this->saldo - $this->saldoAcumulado - 4.35;
		if( $p<0 ){
			echo "No tiene saldo suficiente para pagar medioboleto. Se realizará un viaje plus";
			$this->ViajePlusNormal();
		}
		else{
			$this->saldo = $p;
			$this->saldoAcumulado = 0;
			$this->fechaanterior=$this->fecha;
			$this->horaanterior=$this->hora;
		}
	}
	
	public function Trasbordo () {
		
	}
	public function viajeBici(){
		if($fechaantbici==" "|| ($fecha->diff($fechaantbici))->d != 0){
			$this->saldo = $this->saldo - 12.45;
			$this->fechaanterior=$this->fecha;
			$this->horaanterior=$this->hora;
		}
		$this->getBoleto();
	
		}
		
		
	}
	public function ViajePlusNormal(){
		if($this->saldoAcumulado < (9.70*2)){
			$this->saldoAcumulado= $this->saldoAcumulado + 9.70;
			$this->fechaanterior=$this->fecha;
			$this->horaanterior=$this->hora;
			}
		else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";
		}
	}
}
