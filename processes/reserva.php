<?php

class Reserva{  
    public $data;
    public $hora;
    public $estat;
    public function __construct($data,$hora,$estat)
    {
        $this->data=$data;
        $this->hora=$hora;
        $this->estat=$estat;
    }
}