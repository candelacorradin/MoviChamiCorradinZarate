<?php
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
	protected $fechatras;
	protected $diasemana;
	public function __construct(Tarjeta $tar, $tipoboleto, $linea, $saldoac = 0){
		$this->fecha = date('d-m-Y');
		$this->tar->tipoboleto= $t;
		$this->hora = date('H:i:s');
		$this->tar->saldoAcumulado = $saldoac;
		$this->linea = $linea;
		$this->fechatras = new DateTime ("now");
		$this->diasemana = date('w');
	}

	public getBoleto(){
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipoboleto. "\nLINEA DE COLECTIVO: ". $this->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id_tarj;

	}
	
	public function Normal(){
		$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 9.70;
		if($p<0){
			$this->ViajePlusNormal();
		}
		else{
			$this->tar->saldo = $p;
			$this->tar->saldoAcumulado = 0;
		}
		$this->tar->fechaanterior=$this->fechatras;
		$this->tar->diaanterior=$this->diasemana;
	}
	public function Medio(){
		$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 4.35;
		if( $p<0 ){
			echo "No tiene saldo suficiente para pagar medioboleto. Se realizará un viaje plus";
			$this->ViajePlusNormal();
		}
		else{
			$this->tar->saldo = $p;
			$this->tar->saldoAcumulado = 0;
			$this->tar->fechaanterior=$this->fechatras;
			$this->tar->diaanterior=$this->diasemana;
		}
	}
	
	public function Transbordo () {
		
	}
	public function viajeBici(){
		
	}
	public function ViajePlusNormal(){
		if($this->tar->saldoAcumulado < (9.70*2)){
			$this->tar->saldoAcumulado= $this->tar->saldoAcumulado + 9.70;
			$this->tar->fechaanterior=$this->fechatras;
			$this->tar->diaanterior=$this->diasemana;
			}
		else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";
		}
	}
}
