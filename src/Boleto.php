<?php

namespace TpFinal;
class Boleto{
	public $fecha;		//lo pongo pubic nomas porque sino me falla el test
	public $hora;		//lo pongo pubic nomas porque sino me falla el test
  	protected $fechaantbici = " ";
	//protected $tipoboleto;
	//protected $saldo;
	//protected $saldoAcumulado;
	//protected $linea;
	//protected $id_tarj;
	public $tar;		//lo pongo pubic nomas porque sino me falla el test
	public $transporte;	//lo de Tarjeta y Colectivo no va pq lo toma como string no como nombre de clase
			//lo pongo pubic nomas porque sino me falla el test
	
	public function __construct(Tarjeta $tar, 
				    //$tipoboleto, 
				    $transporte
				    //$saldoac = 0
				   ){
		$this->tar=$tar;
		$this->transporte=$transporte;
		$this->fecha = date('d-m-Y');
		//$this->tar->tipoboleto= $t;
		$this->hora = date('H:i:s');
		//$this->tar->saldoAcumulado = $saldoac;
	}
	public function getBoleto(){
		if( (is_a($this->transporte,'Colectivo')) ){
			print "entra en boleto is colectivo\n";
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipo. "\nLINEA DE COLECTIVO: ". $this->transporte->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id;
		}
		else{
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipo. "\nID BICI: ". $this->transporte->id . "\nSALDO: ". $this->tar->saldo . "\nID TARJETA: ". $this->tar->id;
		   }
	}
}
