<?php
namespace TpFinal;
class Boleto{
	protected $fecha;
	protected $hora;
	protected $tipo;
	protected $saldo;
	protected $saldoAcumulado;
	protected $linea;
	protected $id_tarj;


	public function __construct( int $id_tarjeta, int $saldo, $saldoac = 0 ){
		$this->fecha = date('d-m-Y');
		$this->hora = date('H:m:s');
		$this->saldoAcumulado = $saldoac;
		$this->saldo = $saldo;
		$this->id_tarj = $id_tarjeta;

	}

	public getBoleto(){
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tipo . "\nLINEA DE COLECTIVO: ". $this->linea . "\nSALDO: ". $this->saldo . "\nID: ". $this->id_tarj;

	}
	public function Pasaje(){
		if($this->tipo == "Normal"){
			Normal();
		}
		if($this->tipo == "MedioBoleto"){
			Medio();
		}
		else{
			return "Tipo de pasaje invalido."
		}
		


	}


	public function Normal(){
		$p  = $this->saldo - $this->saldoAcumulado - 9.70;
		if($p<0){
			ViajePlus();
		}
		else{
			$this->saldo = $p;
			$this->saldoAcumulado = 0;
		}

		//AGREGAR CASO DE TRASBORDO y medio boleto
		
	}

	public function ViajePlus(){
		if($this->saldoAcumulado < (9.70*2)){
			$this->saldoAcumulado= $this->saldoAcumulado - 9.70;
		}
		else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";

		}


	}

	public function Medio(){
		$p  = $this->saldo - $this->saldoAcumulado - 4.35;
		if($p<0){
			ViajePlus();
		}
		else{
			$this->saldo = $p;
			$this->saldoAcumulado = 0;
		}
		
	}

}
