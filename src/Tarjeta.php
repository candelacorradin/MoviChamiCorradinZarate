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
    public function __construct($id){
    $this->saldo=0;
    $this->id=$id;
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

  public function Viaje($transporte, Boleto $b){  
    if( is_a($transporte,'Colectivo') ){
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
      
    if(is_a($transporte,'Bicicleta') )
    {
        $this->viajeBici();
    }

  }
    public function Normal(){
		$p  = $this->saldo - $this->saldoAcumulado - 9.70;
		if($p<0){
			$this->ViajePlus();
		}
		else{
			$this-saldo = $p;
			$this->saldoAcumulado = 0;
		}
		$this->fechaanterior=$this->fechatras;
		$this->diaanterior=$this->diasemana;
	}
}
?>
