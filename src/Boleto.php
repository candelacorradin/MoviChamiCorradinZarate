<?php

namespace TpFinal;
class Boleto{
	protected $fecha;
	protected $hora;
  protected $fechaantbici = " ";
	//protected $tipoboleto;
	//protected $saldo;
	//protected $saldoAcumulado;
	protected $linea;
	protected $id_tarj;
	protected $tar;
	protected $cole;	//lo de Tarjeta y Colectivo no va pq lo toma como string no como nombre de clase
	public function __construct(Tarjeta $tar, 
				    //$tipoboleto, 
				    Colectivo $cole 
				    //$saldoac = 0
				   ){
		$this->tar=$tar;
		$this->cole=$cole;
		$this->fecha = date('d-m-Y');
		//$this->tar->tipoboleto= $t;
		$this->hora = date('H:i:s');
		//$this->tar->saldoAcumulado = $saldoac;
	}

	public function getBoleto(){
		return "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipo. "\nLINEA DE COLECTIVO: ". $this->cole->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id_tarj;

	}

}
