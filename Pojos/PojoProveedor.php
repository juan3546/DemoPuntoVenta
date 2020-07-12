<?php
	/**
	* 
	*/
    class PojoProveedor
	{
		//Definiendo atributos
		public $id_proveedor;
        public $nombre;
        public $estatus;


		function __construct1(){}

		function __construct2($id_proveedor,$nombre, $estatus)
		{
			$this->id_proveedor=$id_proveedor;
            $this->nombre=$nombre;
            $this->estatus=$estatus;
            
		}
	}
?>