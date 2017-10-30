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
	protected $fechatras;
	protected $diasemana;
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
		$this->fechatras = new DateTime ("now");
		$this->diasemana = date('w');
	}

	public getBoleto(){
		print "FECHA: ". $this->fecha . "\nTIPO: ". $this->tar->tipoboleto. "\nLINEA DE COLECTIVO: ". $this->cole->linea . "\nSALDO: ". $this->tar->saldo . "\nID: ". $this->tar->id_tarj;

	}
	
	public function Normal(){
		$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 9.70;
		if($p<0){
			$this->ViajePlus();
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
			echo "No tiene saldo suficiente para pagar medio boleto. Se realizará un viaje plus";
			$this->ViajePlus();
		}
		else{
			$this->tar->saldo = $p;
			$this->tar->saldoAcumulado = 0;
			$this->tar->fechaanterior=$this->fechatras;
			$this->tar->diaanterior=$this->diasemana;
		}
	}
	
	public function Trasbordo () {
		if (this->tipoboleto == "Medio"){
			$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 1.60;
		}
		else {
			$p  = $this->tar->saldo - $this->tar->saldoAcumulado - 3.20;
		}
		if( $p<0 ) {
			echo "No tiene saldo suficiente para pagar trasbordo. Se realizará un viaje plus";
			$this->ViajePlus();
		}
		else{
			$this->tar->saldo = $p;
			$this->tar->saldoAcumulado = 0;
		}
	}
	
	public function viajeBici(){
		
	}
		
	}
	public function ViajePlus(){
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
