<?php
namespace TpFinal;
include 'Boleto.php';

class Tarjeta {
protected $saldo;
protected $saldoAcumulado;
protected $id;
protected $fechaanterior;
protected $diaanterior;
protected $tipo;
protected $fechatras;
protected $diasemana;
protected $tipo;
    public function __construct($id,$tipotarjeta){
    $this->saldo=0;
    $this->id=$id;
    $this->tipo=$tipotarjeta;
    }
    public function saldo() {
        return 0;
    }
    public function getSaldo(){
        return $this->saldo;
    }
    public function getId(){
     return $this->id;   
    }
    public function getTipo(){
     return $this->tipo;   
    }
    public function cargar($monto){
      if($monto==332){
        $this->saldo+=388;
      }
      elseif($monto==624){
       $this->saldo+=776;   
      }
    else{    
    $this->saldo+=$monto;
    }
  }

public function Viaje($transporte){  
	if( is_a($transporte,'Colectivo') ){
		$this->fechatras = new DateTime ("now");
		$this->diasemana = date('w');
	//ACÁ VAN LOS IF PARA VER SI ES TRASBORDO PRIMERO, CONVIENE HACER UNA FUNCIÓN QUE LO DETERMINE
		if( $this->tipo == "Normal" ){
           		$this->Normal();
        	}
        	if( $this->tipo == "MedioBoleto" ){
            		$this->Medio();
        	}
        	else {
        		return "Tipo de viaje invalido."
       		}
   	}
 	if(is_a($transporte,'Bicicleta') ) {
		$this->viajeBici();
    	}

  }
  public function Normal(){
	$p  = $this->saldo - $this->saldoAcumulado - 9.70;
		if($p<0) {
			$this->ViajePlus();
		}
		else {
			$this-saldo = $p;
			$this->saldoAcumulado = 0;
		}
	$this->fechaanterior=$this->fechatras;
	$this->diaanterior=$this->diasemana;
	}
	
public function Medio(){
	$p  = $this->saldo - $this->saldoAcumulado - 4.35;
	if( $p<0 ){
		echo "No tiene saldo suficiente para pagar medio boleto. Se realizará un viaje plus";
		$this->ViajePlus();
	}
	else{
		$this->saldo = $p;
		$this->saldoAcumulado = 0;
		$this->fechaanterior=$this->fechatras;
		$this->diaanterior=$this->diasemana;
	}
	}
	
public function Trasbordo () {
	if (this->tipo == "Medio"){
		$p  = $this->saldo - $this->saldoAcumulado - 1.60;
	}
	else {
		$p  = $this->saldo - $this->saldoAcumulado - 3.20;
	}
	if( $p<0 ) {
		echo "No tiene saldo suficiente para pagar trasbordo. Se realizará un viaje plus";
		$this->ViajePlus();
	}
	else{
		$this->saldo = $p;
		$this->saldoAcumulado = 0;
	}
	}
	
	public function ViajePlus() {
		if($this->saldoAcumulado < (9.70*2)){
			$this->saldoAcumulado= $this->saldoAcumulado + 9.70;
			$this->fechaanterior=$this->fechatras;
			$this->diaanterior=$this->diasemana;
		}
		else {
			return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";
		}
	}
	
	public function viajeBici(){
		
	}
}
?>
