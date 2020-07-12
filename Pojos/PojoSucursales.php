<?php
	/**
	* 
	*/
    class PojoSucursales
	{
		//Definiendo atributos
        public $id_sucursal;
        public $id_nombre_precio;
        public $nombre;
        public $no_corte;
        public $estatus;


		function __construct1(){}

		function __construct2($id_sucursal, $id_nombre_precio, $nombre, $no_corte , $estatus)
		{
            $this->id_sucursal=$id_sucursal;
            $this->id_nombre_precio = $id_nombre_precio;
            $this->nombre=$nombre;
            $this->no_corte = $no_corte;
            $this->estatus=$estatus;
            
		}
	}
?>