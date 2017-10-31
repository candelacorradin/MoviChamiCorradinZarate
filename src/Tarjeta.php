<?php
namespace TpFinal;
include 'Boleto.php';
class Tarjeta {
public $saldo;      //lo pongo public nomas porque sino  falla el test
public $saldoAcumulado; //lo pongo public nomas porque sino  falla el test
public $id;     //lo pongo public nomas porque sino  falla el test
public $fechaanterior;
protected $diaanterior;
public $tipo;       //lo pongo public nomas porque sino  falla el test
public $fechatras;
protected $diasemana;
protected $linea_anterior;
public $fechaantbici;
    public function __construct($id,$tipotarjeta){
    	$this->saldo=0;
    	$this->id=$id;
    	$this->tipo=$tipotarjeta;
    	$this->saldoAcumulado=0;
	$this->fechaanterior= new DateTime("now");
	$this->fechaantbici= NULL;
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
        if( (is_a($transporte,'Colectivo')) ){
            $this->fechatras = new DateTime ("now");
            $this->diasemana = date('N');
            $h=date('G');
            $diff = ($this->fechaanterior)->diff($this->fechatras);
            
            if($this->linea_anterior != $transporte->linea){
               $this->linea_anterior= $transporte->linea;
             
               //if( ((
		    if (($this->diasemana<6) && ($h>=6 && $h<=22) && ((($diff->h) * 60) + $diff->i) <= 60)  {
		    //|| ( ($this->diasemana==6) && ($h>=6 && $h<=14))) && ( ( (($diff->h) * 60) + $diff->i) <= 60) || ( ( (($diff->h) * 60) + $diff->i) >= 90)) ){
                  		$this->Trasbordo();
		    }
		    elseif (($this->diasemana==6) && ( ( ($h>=6 && $h<=14) && ( ( ($diff->h) * 60) + $diff->i) <= 60) || ( ($h>=14 && $h<22) && ( ( ($diff->h) * 60) + $diff->i) <= 90)  )){
			    	$this->Trasbordo();
			}
			elseif(($this->diasemana==7) && ($h>=6 && $h<=22) && (((($diff->h) * 60) + $diff->i) <= 90) ){
				$this->Trasbordo();	
			}
				
		    elseif (($h<=6 && $h>=22) && ((($diff->h) * 60) + $diff->i) <= 90) {
			   	$this->Trasbordo();
		    }
	}
			    
			   /* Lunes a viernes de 6 a 22 y sábados de 6 a 14 hs: tiempo máximo 60 minutos.
•Sábados de las 14 a 22 hs, domingos y feriados de 6 a 22 hs: tiempo máximo 90
minutos.
•Noche, comprende franja horaria de 22 a 6 hs: tiempo máximo 90 minutos.  */
                if ($this->tipo == "Medio"){
			$this->linea_anterior= $transporte->linea;
                    	$this->Medio();
                }
                else{
		$this->linea_anterior= $transporte->linea;
                $this->Normal();
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
            	$this->saldo = $p;
            	$this->saldoAcumulado = 0;
            	$this->fechaanterior=$this->fechatras;
            	$this->diaanterior=$this->diasemana;
		$this->getBoleto();
        }
       }
	public function Medio(){
        $p  = $this->saldo - $this->saldoAcumulado - 4.35;
            if($p<0) {
                $this->ViajePlus();
            }
            else {
            	$this->saldo = $p;
            	$this->saldoAcumulado = 0;
            	$this->fechaanterior=$this->fechatras;
            	$this->diaanterior=$this->diasemana;
		$this->getBoleto();
        }
       }
    public function Trasbordo () {
	if ($this->tipo == "Medio"){
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
	    $this->getBoleto();
	}
	
    public function ViajePlus() {
        if($this->saldoAcumulado < (9.70*2)){
            	$this->saldoAcumulado= $this->saldoAcumulado + 9.70;
            	$this->fechaanterior=$this->fechatras;
            	$this->diaanterior=$this->diasemana;
		$this->getBoleto();
        }
        else {
            return "Ya han sido utilizados los dos (2) viajes plus. Recargue su tarjeta.";
        }
    }
    
    public function viajeBici(){
	    	$fecha = new DateTime("now");
        	if(!is_null($this->fechaantbici) && ($fecha->diff($fechaantbici))->d != 0){
            	$this->saldo = $this->saldo - 12.45;
            	$this->fechaantbici= new DateTime('now');
        }
		$this->getBoleto();
    }
}
