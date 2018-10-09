<?php
namespace TpFinal;
class Bicicleta {
    public $en_uso;
    public $id;
  
    public function __construct ( $id ) {
    $this->id = $id;
    $this->en_uso = false;
    }
  
    public function get_id(){
    return $this->id;
    }
    
    public function subir(){
    $this->en_uso = true;
    }
  
    public function bajar(){
    $this->en_uso = false;
    }
}
