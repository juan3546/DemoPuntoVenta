<?php
	/**
	* 
	*/
    class PojoMetodoPago
	{
		//Definiendo atributos
        public $id_metodo_pago;
        public $abreviatura;
        public $nombre;
        public $estatus;


		function __construct1(){}

		function __construct2($id_metodo_pago, $abreviatura, $nombre, $estatus)
		{
            $this->id_metodo_pago=$id_metodo_pago;
            $this->abreviatura = $abreviatura;
            $this->nombre=$nombre;
            $this->estatus=$estatus;
            
		}
	}
?>