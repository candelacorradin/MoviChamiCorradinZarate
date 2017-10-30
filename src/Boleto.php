<?php
<?php
namespace TpFinal;
class Boleto{
	protected $fecha;
	protected $hora;
	//protected $tipoboleto;
	//protected $saldo;
	//protected $saldoAcumulado;
	protected $linea;
	protected $id_tarj;
	protected Tarjeta $tar;
	protected Colectivo $cole;
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

	public getBoleto(){
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipo. "\nLINEA DE COLECTIVO: ". $this->cole->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id_tarj;

	}
}
